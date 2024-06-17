<?php

namespace Core;

use Core\Database\DB;
use Core\Database\GlobalDB;
use Core\Helper\Mailer;
use Core\Helper\Notification;
use Exception;
use Game\AllianceBonus\AllianceBonus;
use Game\Buildings\BuildingAction;
use Game\Formulas;
use Game\NoticeHelper;
use function logError;
use function microtime;
use Model\AccountDeleter;
use Model\AllianceBonusModel;
use Model\ArtefactsModel;
use Model\AutomationModel;
use Model\BattleModel;
use Model\ClubApi;
use Model\FarmListModel;
use Model\InfoBoxModel;
use Model\MarketModel;
use Model\MarketPlaceProcessor;
use Model\MasterBuilder;
use Model\MessageModel;
use Model\Movements\AdventureProcessor;
use Model\Movements\EvasionProcessor;
use Model\Movements\ReinforcementProcessor;
use Model\Movements\ReturnProcessor;
use Model\Movements\SettlersProcessor;
use Model\MovementsModel;
use Model\MultiAccount;
use Model\NatarsModel;
use Model\OasesModel;
use Model\PublicMsgModel;
use Model\RegisterModel;
use Model\TaskQueue;
use Model\TrainingModel;
use Model\VillageModel;
use resources\View\PHPBatchView;
use SQLite3;
use function getCustom;
use function getGameElapsedSeconds;
use function getGameSpeed;
use function getWorldId;
use function getWorldUniqueId;
use function miliseconds;
use function nanoseconds;
use function strtolower;
use const INCLUDE_PATH;
use const MAP_SIZE;

class Automation
{

    private static $_self;

    public static function getInstance()
    {
        if (!(self::$_self instanceof self)) {
            self::$_self = new self();
        }
        return self::$_self;
    }

    public function autoFarmlist()
    {
        $m = new FarmListModel();
        $m->processAutoRaid();
    }

    public function buildComplete()
    {
        $db = DB::getInstance();
        $m = new MasterBuilder();
        $result = $db->query("SELECT * FROM building_upgrade WHERE commence<=" . (time()) . " ORDER BY commence ASC, id ASC LIMIT 100");
        while ($row = $result->fetch_assoc()) {
            if ($row['isMaster']) {
                $m->process($row);
            } else {
                $db->query("DELETE FROM building_upgrade WHERE id={$row['id']}");
                if ($db->affectedRows()) {
                    BuildingAction::upgrade($row['kid'], $row['building_field']);
                }
            }
        }
        $db = DB::getInstance();
        $result = $db->query("SELECT * FROM demolition WHERE end_time <= " . (time()) . " ORDER BY end_time ASC, id ASC LIMIT 50");
        while ($row = $result->fetch_assoc()) {
            $db->query("DELETE FROM demolition WHERE id={$row['id']}");
            if ($db->affectedRows()) {
                BuildingAction::downgrade($row['kid'], $row['building_field'], 1, $row['complete']);
            }
        }
    }


    public function attackMovementComplete()
    {
        $db = DB::getInstance();
        $movements = $db->query("SELECT * FROM movement WHERE mode=0 AND end_time <= " . miliseconds() . " ORDER BY end_time ASC, id ASC LIMIT 250");
        $this->processMovementComplete($movements);
    }

    public function otherMovementComplete()
    {
        $db = DB::getInstance();
        $movements = $db->query("SELECT * FROM movement WHERE mode=1 AND end_time <= " . miliseconds() . " ORDER BY end_time ASC, id ASC LIMIT 250");
        $this->processMovementComplete($movements);
    }

    public function processMovementComplete(\mysqli_result $movements)
    {
        $db = DB::getInstance();
        mt_srand(make_seed());
        while ($row = $movements->fetch_assoc()) {
            $db->query("DELETE FROM movement WHERE id={$row['id']}");
            if (!$db->affectedRows()) {
                continue;
            }
            if ($row['mode'] == 1) {
                new ReturnProcessor($row);
                continue;
            }
            switch ($row['attack_type']) {
                case MovementsModel::ATTACKTYPE_EVASION:
                    new EvasionProcessor($row);
                    break;
                case MovementsModel::ATTACKTYPE_REINFORCEMENT:
                    new ReinforcementProcessor($row);
                    break;
                case MovementsModel::ATTACKTYPE_NORMAL:
                case MovementsModel::ATTACKTYPE_RAID:
                case MovementsModel::ATTACKTYPE_SPY:
                    new BattleModel($row);
                    break;
                case MovementsModel::ATTACKTYPE_ADVENTURE:
                    new AdventureProcessor($row);
                    break;
                case MovementsModel::ATTACKTYPE_SETTLERS:
                    new SettlersProcessor($row);
                    break;
            }
        }
    }

    public function handleAllianceBonusTasks()
    {
        $db = DB::getInstance();
        $config = Config::getInstance();
        $donate_reset_interval = $config->allianceBonus->donate_reset_interval;
        $lastDonateReset = $db->fetchScalar("SELECT lastAllianceContributeReset FROM config");
        if ($lastDonateReset < $config->game->start_time) {
            $lastDonateReset = $config->game->start_time;
            $db->query("UPDATE config SET lastAllianceContributeReset=$lastDonateReset");
        }
        if (!(($lastDonateReset + $donate_reset_interval) > time())) {
            $lastDonateReset = $lastDonateReset + $donate_reset_interval;
            $db->query("UPDATE config SET lastAllianceContributeReset=" . $lastDonateReset);
            $db->query("UPDATE users SET alliance_contributions=0");
        }
        $m = new AllianceBonusModel();
        $stmt = $db->query("SELECT * FROM alliance_bonus_upgrade_queue WHERE time < " . time() . " LIMIT 100");
        while ($row = $stmt->fetch_assoc()) {
            $db->query("DELETE FROM alliance_bonus_upgrade_queue WHERE id={$row['id']}");
            $m->levelUpBonus($row['aid'], $row['type']);
        }
    }

    public function marketComplete()
    {
        $db = DB::getInstance();
        $time = (time());
        $result = $db->query("SELECT * FROM send WHERE end_time < $time ORDER BY end_time ASC, id ASC");
        $processor = new MarketPlaceProcessor();
        while ($row = $result->fetch_assoc()) {
            $processor->processRow($row);
        }
    }

    public function researchComplete()
    {
        $db = DB::getInstance();
        $result = $db->query("SELECT id, kid, nr, mode FROM research WHERE end_time <= " . (time()) . " ORDER BY end_time ASC, id ASC LIMIT 100");
        while ($row = $result->fetch_assoc()) {
            $db->query("DELETE FROM research WHERE id={$row['id']}");
            if ($row['mode'] == 1) {
                $db->query("UPDATE tdata SET u{$row['nr']}=1 WHERE kid={$row['kid']}");
            } else {
                $db->query("UPDATE smithy SET u{$row['nr']}=IF(u{$row['nr']}+1>20, 20, u{$row['nr']}+1) WHERE kid={$row['kid']}");
            }
        }
    }

    public function trainingComplete()
    {
        $db = DB::getInstance();
        $training = new TrainingModel();
        $delay = 0;
        $time = getGame("useNanoseconds") ? (nanoseconds() - $delay * 1e9) : (getGame("useMilSeconds") ? (miliseconds() - $delay * 1000) : (time() - $delay));
        $immediate_train = implode(",", [9, 10, 11]);
        $result = $db->query("SELECT * FROM training WHERE nr IN($immediate_train) AND commence < $time LIMIT 100");
        while ($row = $result->fetch_assoc()) {
            $training->handleTrainingCompleteResult($row);
        }
        if (getGameSpeed() > 20) {
            $delay = min(max(0, floor(getGameSpeed() / 1000) * 5), 30);
        }
        $time = getGame("useNanoseconds") ? (nanoseconds() - $delay * 1e9) : (getGame("useMilSeconds") ? (miliseconds() - $delay * 1000) : (time() - $delay));
        $result = $db->query("SELECT * FROM training WHERE nr NOT IN($immediate_train) AND commence < $time LIMIT 100");
        while ($row = $result->fetch_assoc()) {
            $training->handleTrainingCompleteResult($row);
        }
    }

    public function zeroPopVillages()
    {
        $db = DB::getInstance();
        $result = $db->query("SELECT kid, owner FROM vdata WHERE pop<=0 AND isWW=0 LIMIT 50");
        $accountDeleter = new AccountDeleter();
        while ($row = $result->fetch_assoc()) {
            if (true === $accountDeleter->isVillageDestroyAble(0, $row['kid'], $row['owner'])) {
                $accountDeleter->deleteVillage($row['kid']);
            }
        }
    }

    public function checkForArtifactActivation()
    {
        $db = DB::getInstance();
        $interval = ArtefactsModel::getArtifactActivationTime();
        $time = time() - $interval;
        $result = $db->query("SELECT * FROM artefacts WHERE active=0 AND IF(uid=1, FALSE, conquered < $time) ORDER BY conquered ASC, id ASC");
        $art = new ArtefactsModel();
        while ($row = $result->fetch_assoc()) {
            $art->activateArtifact($row);
        }
    }

    public function updateFoolArtifact()
    {
        $artifact = new ArtefactsModel();
        $artifact->updateFoolArtes();
    }

    public function boughtGoldMessage()
    {
        $db = DB::getInstance();
        $message = new MessageModel();
        $result = $db->query("SELECT * FROM voting_reward_queue LIMIT 50");
        while ($row = $result->fetch_assoc()) {
            $db->query("DELETE FROM voting_reward_queue WHERE id={$row['id']}");
            $arr = ['TopG', 'ArenaTop100', 'GTop100'];
            if (in_array($row['votingName'], $arr) && !empty(Config::getProperty("Voting", $row['votingName'], "link"))) {
                $gift_gold = Config::getProperty("Voting", $row['votingName'], "gold");
                $db->query("UPDATE users SET gift_gold=gift_gold+$gift_gold WHERE id={$row['uid']}");
                $message->sendMessage(0, $row['uid'], null, $gift_gold, 4);
            }
        }
        $result = $db->query("SELECT * FROM buyGoldMessages LIMIT 50");
        while ($row = $result->fetch_assoc()) {
            $db->query("DELETE FROM buyGoldMessages WHERE id={$row['id']}");
            if ($row['type'] == 1) {
                $title = T("Global", "BuyGoldSubject");
                $msg = sprintf(T("Global", "BuyGoldText"), $row['gold'], $row['trackingCode']);
            } else {
                $title = T("Global", "voucherTitle");
                $msg = sprintf(T("Global", "voucherText"), $row['gold'], $row['trackingCode']);
            }
            $message->sendMessage(0, $row['uid'], $title, $msg);
        }
    }

    public function banProgress()
    {
        (new MultiAccount())->runProgress();
        $db = DB::getInstance();
        $result = $db->query("SELECT * FROM banQueue WHERE end>0 AND end < " . time() . " LIMIT 10");
        $infoBox = new InfoBoxModel();
        while ($row = $result->fetch_assoc()) {
            $db->query("DELETE FROM banQueue WHERE id={$row['id']}");
            $db->query("UPDATE users SET access=1 WHERE id={$row['uid']}");
            $infoBox->deleteInfoByType($row['uid'], 14);
        }
    }

    public function referenceCheck()
    {
        $inviteGold = Config::getProperty("gold", "invitePlayerGold");
        $refLimit = Config::getAdvancedProperty("refLimit");

        $db = DB::getInstance();
        $result = $db->query("SELECT * FROM player_references WHERE rewardGiven=0 LIMIT 100");
        while ($row = $result->fetch_assoc()) {
            $totalVillagesCount = $db->fetchScalar("SELECT total_villages FROM users WHERE id={$row['uid']}");
            if (!$totalVillagesCount) {
                $db->query("DELETE FROM player_references WHERE id={$row['id']}");
                continue;
            }
            $countTotal = $db->fetchScalar("SELECT COUNT(id) FROM player_references WHERE rewardGiven=1 AND ref_uid={$row['ref_uid']}");
            if ($countTotal >= $refLimit) {
                $db->query("UPDATE player_references SET rewardGiven=2 WHERE id={$row['id']}");
                continue;
            }
            if ($totalVillagesCount >= 2) {
                $db->query("UPDATE player_references SET rewardGiven=1 WHERE id={$row['id']}");
                $db->query("UPDATE users SET gift_gold=gift_gold+$inviteGold WHERE id={$row['ref_uid']}");
            }
        }
    }

    public function deleteOasisComplete()
    {
        $db = DB::getInstance();
        $result = $db->query("SELECT * FROM odelete WHERE end_time <= " . (time()) . " ORDER BY end_time ASC, id ASC LIMIT 10");
        $m = new AccountDeleter();
        while ($row = $result->fetch_assoc()) {
            $db->query("DELETE FROM odelete WHERE id={$row['id']}");
            OasesModel::releaseOasis($row['oid'], $row['kid']);
            $enforces = $db->query("SELECT * FROM enforcement WHERE to_kid={$row['oid']}");
            while ($enforce = $enforces->fetch_assoc()) {
                $m->returnTrappedOrEnforcementRow($enforce, true);
            }
            $find = $db->query("SELECT * FROM movement WHERE to_kid={$row['oid']} AND mode=0");
            while ($row = $find->fetch_assoc()) {
                $m->cancelMovement($row['id'], $row['to_kid'], $row['kid']);
            }
        }
    }

    public function tradeRoutes()
    {
        $usePeriodicTradeRoutes = getGame("usePeriodicTradeRoutes");
        $db = DB::getInstance();
        $result = $db->query("SELECT * FROM traderoutes WHERE enabled=1 AND time <= " . (time()) . " LIMIT 100");
        $marketModel = new MarketModel();
        while ($row = $result->fetch_assoc()) {
            if ($usePeriodicTradeRoutes) {
                $db->query("UPDATE traderoutes SET time=time+{$row['start_hour']} WHERE id={$row['id']}");
            } else {
                $db->query("UPDATE traderoutes SET time=time+86400 WHERE id={$row['id']}");
            }
            $uid = $marketModel->getVillageOwner($row['kid']);
            if ($uid === 0) {
                $db->query("DELETE FROM traderoutes WHERE kid={$row['kid']} OR to_kid={$row['kid']}");
            }
            $race = $marketModel->getPlayerRace($uid);
            $market = $marketModel->getMarketAndTradeOfficeLevel($row['kid']);
            if (!$market[17]) {
                continue;
            }
            $cur_resources = array_map("floor", $marketModel->getVillageResources($row['kid']));
            $resources_to_send = [
                1 => $row['r1'],
                2 => $row['r2'],
                3 => $row['r3'],
                4 => $row['r4'],
            ];
            $zeroCount = 0;
            $resources_to_send = array_map("floor", $resources_to_send);
            foreach ($resources_to_send as $k => $v) {
                if ($v > $cur_resources[$k]) {
                    $resources_to_send[$k] = $cur_resources[$k];
                }
                if ($v <= 0) {
                    $zeroCount++;
                }
            }
            if (!array_sum($resources_to_send)) {
                continue;
            }
            $alliance_bonus = 1;
            $alliance = $db->query("SELECT aid, alliance_join_time FROM users WHERE id=$uid")->fetch_assoc();
            if ($alliance['aid'] > 0) {
                $alliance_bonus = AllianceBonus::getTradersBonus($alliance['aid'], $alliance['alliance_join_time']);
            }
            $merchant_cap = Formulas::merchantCAP($race, $market[28], $alliance_bonus);
            $total_resources = array_sum($resources_to_send);
            $total_available_merchants = $market[17] - $marketModel->getOfferingMerchantsCount($row['kid'], $merchant_cap) - $marketModel->getOnTheWayMerchantsCount($row['kid'], $merchant_cap);
            if (!$total_available_merchants) {
                continue;
            }
            $total_need_merchants = ceil($total_resources / $merchant_cap);
            if ($total_need_merchants > $total_available_merchants) {
                $resourcesTogo = [1 => 0, 2 => 0, 3 => 0, 4 => 0];
                $max = $total_available_merchants * $merchant_cap;
                for ($i = 1; $i <= 4; $i++) {
                    $resourcesTogo[$i] = max(min($max, $resources_to_send[$i]), 0);
                    $max -= $resourcesTogo[$i];
                }
                $resources_to_send = $resourcesTogo;
            }
            $marketModel->sendResources($row['kid'], $row['to_kid'], $race, $resources_to_send[1], $resources_to_send[2], $resources_to_send[3], $resources_to_send[4], $row['times'], $row['time']);
            $db->query("UPDATE vdata SET wood=wood-{$resources_to_send[1]}, clay=clay-{$resources_to_send[2]}, iron=iron-{$resources_to_send[3]}, crop=crop-{$resources_to_send[4]} WHERE kid={$row['kid']}");
        }
    }

    public function cleanupServer()
    {
        $halfDay = time() - 86400 / 2;
        $oneHour = time() - 3600;
        $tenMin = time() - 600;
        $db = DB::getInstance();
        $db->query("DELETE FROM login_handshake WHERE time < $tenMin");
        $db->query("DELETE FROM newproc WHERE time < $halfDay");
        $db->query("DELETE FROM adventure WHERE end=1");
        $db->query("DELETE FROM auction WHERE finish=1 AND uid=0 AND time < " . (time() - 2 * 86400));
        $db->query("DELETE FROM a2b WHERE timestamp < $oneHour");
        $db->query("DELETE FROM infobox WHERE showTo<>0 AND showTo < $tenMin AND (type < 7 OR type > 10)");
        $db->query("DELETE FROM casualties WHERE time < " . (time() - 5 * 86400));
        $db->query("DELETE FROM surrounding WHERE time < " . (time() - 3 * 86400));
        $db->query("DELETE FROM log_ip WHERE time < " . (time() - 15 * 86400));
        $db->query("DELETE FROM ndata WHERE non_deletable=0 AND (uid=1 OR (deleted=1 AND time < ($halfDay))) LIMIT 20000");
        if (getCustom("removeReports")) {
            $XY = time() - getCustom("removeReports");
            $db->query("DELETE FROM ndata WHERE non_deletable=0 AND (uid=1 OR (archive=0 AND time < $XY)) LIMIT 20000");
        }
        $types = implode(",", [
            NoticeHelper::TYPE_WON_AS_ATTACK_WITHOUT_CASUALTIES,
            NoticeHelper::TYPE_WON_DEFENSE_WITHOUT_LOSSES,
        ]);
        if (getCustom("removeReportsBelow30Percent")) {
            $db->query("DELETE FROM ndata WHERE non_deletable=0 AND type IN($types) AND time < $tenMin AND losses <= 30 AND archive=0 LIMIT 20000");
        }
        $db->query("DELETE FROM mdata WHERE viewed=1 AND time < " . (time() - 2 * 86400));
        //if(filesize(INCLUDE_PATH . "error_log.log")) {
        //    Notification::notify("Error log", "There are some errors in error_log.");
        //}
    }

    private function addFakeUsers()
    {
        $fakeUsersCount = Config::getProperty("fakeUsersCount");
        if ($fakeUsersCount <= 0) return;
        $sqlite = new SQLite3(INCLUDE_PATH . "schema/users.sqlite");
        $stmt = $sqlite->query("SELECT username FROM users ORDER BY RANDOM() LIMIT $fakeUsersCount");
        $users = [];
        while ($row = $stmt->fetchArray(SQLITE3_ASSOC)) {
            $users[] = $row['username'];
        }
        $sqlite->close();
        $register = new RegisterModel();
        $count = $register->addFakeUser($users);
        Notification::notify("StartEmail", "$count fake users were added.");
    }

    public function setUpNewServer()
    {
        $db = DB::getInstance();
        $installationTime = (int)$db->fetchScalar("SELECT installationTime FROM config");
        if ($installationTime == 0 || (time() - $installationTime) < 120) {
            return;
        }
        $conf = Config::getInstance();
        $startEmailsSent = $db->fetchScalar("SELECT startEmailsSent FROM config");
        if (!$startEmailsSent && time() >= ($conf->game->start_time - 3600)) {
            $db = DB::getInstance();
            $db->query("UPDATE config SET startEmailsSent=1");
            $conf->dynamic->startEmailsSent = 1;
            $totalCount = 0;
            //server emails
            $order = ['[PLAYERNAME]', '[SERVER_NAME]', '[SERVER_URL]', '[SERVER_START_TIME]'];
            $result = $db->query("SELECT * FROM activation");
            while ($row = $result->fetch_assoc()) {
                $replace = [
                    $row['name'],
                    $conf->settings->serverName,
                    $conf->settings->gameWorldUrl,
                    date("Y-m-d H:i", $conf->game->start_time) . ' (GMT ' . getTimeZone() . ')',
                ];
                $emailHTML = str_replace($order, $replace, T("Email", "serverStartEmail"));
                Mailer::sendEmail($row['email'], T("Email", "serverStartEmailSubject"), $emailHTML);
            }
            $totalCount += $result->num_rows;
            //non-activated emails
            $globalDbConnection = GlobalDB::getAConnection();
            $result = $globalDbConnection->query("SELECT * FROM activation WHERE used=0 AND worldId={$conf->settings->worldUniqueId}");
            while ($row = $result->fetch_assoc()) {
                //$row['name']
                $replace = [
                    $row['name'],
                    $conf->settings->serverName,
                    $conf->settings->gameWorldUrl,
                    date("Y-m-d H:i", $conf->game->start_time) . ' (GMT ' . getTimeZone() . ')',
                ];
                $emailHTML = str_replace($order, $replace, T("Email", "serverStartEmail"));
                Mailer::sendEmail($row['email'], T("Email", "serverStartEmailSubject"), $emailHTML);
            }
            $totalCount += $result->num_rows;
            $globalDbConnection->close();
            (new NatarsModel())->createFarmVillages();
            $this->addFakeUsers();
            Notification::notify("StartEmail", "Start emails were sent to $totalCount emails.");
        }
        $startConfigurationDone = $db->fetchScalar("SELECT startConfigurationDone FROM config");
        if (!$startConfigurationDone && time() > $conf->game->start_time) {
            $db->query("UPDATE config SET startConfigurationDone=1");
            $conf->dynamic->startConfigurationDone = 1;
            $m = new InfoBoxModel();
            $m->addInfo(0, 1, 8, '', 0, 0);
            $m->addInfo(0, 1, 9, '', 0, 0);
            if ($conf->game->catapultAvailableTime > $conf->game->start_time) {
                $m->addInfo(0, 1, 15, '', 0, 0);
            }
            if ($conf->timers->AutoFinishTime > 0) {
                //$m->addInfo(0, 1, 10, '', $conf->timers->AutoFinishTime - 3 * 86400, $conf->timers->AutoFinishTime);
            }
            //(new NatarsModel())->createLotsOfNatarsVillages(max(min(2*$conf->game->speed, 600), 300));
            Notification::notify("System notification",
                sprintf("Game server %s started.", Config::getProperty("settings", "serverName")));
            Log::addLog(0, "Server started", "Game server is now started.");
        }
    }

    public function refreshCountryFlag()
    {
        $db = DB::getInstance();
        $time = time() - 7200;
        $result = $db->query("SELECT id, access, countryFlag FROM users WHERE (access!=3 OR lastCountryFlagCheck=0) AND (lastCountryFlagCheck <= $time) LIMIT 100");
        while ($row = $result->fetch_assoc()) {
            if ($row['access'] == 3) {
                $countryFlag = AutomationModel::getRandomCountryFlag();
            } else {
                $countryFlag = $this->getCountryFlag($row['id']);
                if (getDisplay("suppressIranFlag") && $countryFlag == 'ir') {
                    if (!in_array($row['countryFlag'], ['', ' ', '-'])) {
                        $countryFlag = $row['countryFlag'];
                    } else {
                        $countryFlag = AutomationModel::getRandomCountryFlag();
                    }
                }
            }
            $db->query("UPDATE users SET countryFlag='$countryFlag', lastCountryFlagCheck=" . time() . " WHERE id={$row['id']}");
        }
    }

    private function getCountryFlag($uid)
    {
        $db = DB::getInstance();
        $ip = $db->query("SELECT ip, COUNT(*) AS `repeatCount` FROM log_ip WHERE uid=$uid GROUP BY ip ORDER BY repeatCount DESC LIMIT 1");
        $countryFlag = '-';
        if ($ip->num_rows) {
            if (function_exists("geoip_country_code_by_name")) {
                try {
                    $countryFlag = strtolower(geoip_country_code_by_name(long2ip($ip->fetch_assoc()['ip'])));
                } catch (Exception $e) {

                }
            }
        }
        return $countryFlag;
    }

    public function checkAutoFinish()
    {
        if (Config::getProperty("timers", "WWConstructStartTime") < 10 || Config::getProperty("timers", "AutoFinishTime") <= 10) {
            return;
        }
        $db = DB::getInstance();
        $stmt = $db->query("SELECT serverFinished, WWAlertSent FROM config");
        if (!$stmt->num_rows) return;
        $stmt = $stmt->fetch_assoc();
        if (!$stmt['WWAlertSent'] && time() > Config::getProperty("timers", "WWConstructStartTime")) {
            $db->query("UPDATE config SET WWAlertSent=1");
            $m = new PublicMsgModel();
            $m->haveNewMessage('[NatarsAreBuildingWW]');
        }
        $config = Config::getInstance();
        if (!$stmt['serverFinished']) {
            $wwLevel = floor(max(time() - $config->timers->WWConstructStartTime, 0) / $config->timers->WWUpLvlInterval);
            if ($wwLevel > 0) {
                $db->query("UPDATE fdata SET f99=IF($wwLevel>100, 100, $wwLevel) WHERE kid=" . Formulas::xy2kid(0, 0));
            }
            if ($wwLevel >= 100) {
                (new AutomationModel())->finishTheGame(2);
            } else if (time() >= Config::getProperty("timers", "AutoFinishTime")) {
                (new AutomationModel())->finishTheGame(2);
            }
        }
    }

    public function resetDailyGold()
    {
        $db = DB::getInstance();
        $dailyGold = Config::getProperty("gold", "dailyGold");
        if ($dailyGold <= 0) return;
        $lastDailyGold = $db->fetchScalar("SELECT lastDailyGold FROM config");
        if ($lastDailyGold == 0) {
            $lastDailyGold = Config::getProperty("game", "start_time");
            $db->query("UPDATE config SET lastDailyGold=" . ($lastDailyGold));
        }
        if ($dailyGold && (time() - $lastDailyGold) >= 86400) {
            $count = floor((time() - $lastDailyGold) / 86400);
            for ($i = 1; $i <= $count; ++$i) {
                $db->query("UPDATE config SET lastDailyGold=" . time());
                $m = new MessageModel();
                $db->query("UPDATE users SET gift_gold=gift_gold+$dailyGold WHERE id>2 AND access<>2");
                $users = $db->query("SELECT id FROM users WHERE id > 2 AND access<>2");
                while ($row = $users->fetch_assoc()) {
                    $m->sendMessage(0, $row['id'], null, $dailyGold, 4);
                }
            }
            Log::addLog(0, "DailyGold Reset", "Daily gold has been gifted to all players.");
        }
    }

    public function checkGameFinish()
    {
        $db = DB::getInstance();
        $configDB = $db->query("SELECT serverFinished, finishStatusSet FROM config LIMIT 1");
        if (!$configDB->num_rows) return;
        $configDB = $configDB->fetch_assoc();
        if (!$configDB['serverFinished'] || $configDB['finishStatusSet']) return;
        $db->query("UPDATE config SET finishStatusSet=1");
        $resultCode = $configDB['serverFinished'];
        $config = Config::getInstance();
        $worldId = Config::getProperty("settings", "worldUniqueId");
        $globalDB = GlobalDB::getInstance();
        $globalDB->query("DELETE FROM preregistration_keys WHERE worldId='{$worldId}'");
        $globalDB->query("DELETE FROM activation WHERE worldId='{$worldId}' AND used=1");
        $globalDB->query("UPDATE gameServers SET finished=1, registerClosed=1 WHERE id='{$worldId}'");
        $automationModel = new AutomationModel();
        $gameWorldDetails = $globalDB->query("SELECT * FROM gameServers WHERE id=$worldId")->fetch_assoc();
        if (Config::getAdvancedProperty("voucherEnabled")) {
            $users = $db->query("SELECT id, name, email, bought_gold FROM users WHERE email_verified=1 AND id>2 AND bought_gold>0 AND access=1 AND hidden=0");
            while ($row = $users->fetch_assoc()) {
                if ($row['bought_gold'] <= 0) continue;
                $automationModel->addVoucher($row['email'], floor($row['bought_gold'] * (100 - Config::getProperty("gold", "voucherTaxPercent")) / 100), "remaining", sprintf('%s-%s', $row['id'], $row['name']));
            }
            $db->query("UPDATE users SET bought_gold=0");
        }
        if (($config->bonus->bonusGoldWinner || $config->bonus->bonusGoldTopAlliance) && $resultCode == 1) {
            //has winner
            $kid = $db->fetchScalar("SELECT kid FROM fdata WHERE f99=100");
            $wData = $db->query("SELECT name, owner FROM vdata WHERE kid=$kid")->fetch_assoc();
            $uData = $db->query("SELECT id, name, access, email, aid, email_verified FROM users WHERE id={$wData['owner']}")->fetch_assoc();
            if ($config->bonus->bonusGoldWinner && $uData['access'] == 1 && $uData['email_verified'] == 1) {
                $automationModel->addVoucher($uData['email'], $config->bonus->bonusGoldWinner, 'winner', sprintf('[%s] %s', $uData['id'], $uData['name']));
            }
            if ($uData['aid'] && $config->bonus->bonusGoldTopAlliance) {
                $count = $config->bonus->bonusGoldTopAllianceCount;
                $minPop = $config->bonus->bonusGoldTopAllianceMinPop;
                $result = $db->query("SELECT id, name, email, email_verified FROM users WHERE aid={$uData['aid']} AND id!={$uData['id']} AND total_pop >= $minPop AND access=1 ORDER BY total_pop DESC LIMIT $count");
                while ($row = $result->fetch_assoc()) {
                    if ($row['email_verified'] == 1) {
                        $automationModel->addVoucher($row['email'],
                            $config->bonus->bonusGoldTopAlliance,
                            'winnerAlliance',
                            sprintf('%s-%s', $row['id'], $row['name']));
                    }
                }
            }
        }
        if ($config->bonus->bonusGoldSecondWinner || $config->bonus->bonusGoldThirdWinner) {
            $stmt = $db->query("SELECT kid FROM fdata WHERE f99 > 50 && f99 < 100 ORDER BY f99 DESC, lastWWUpgrade ASC");
            $rank = 2;
            while ($a = $stmt->fetch_assoc()) {
                $wData = $db->query("SELECT name, owner FROM vdata WHERE kid={$a['kid']}");
                if ($wData->num_rows) {
                    $wData = $wData->fetch_assoc();
                    $uData = $db->query("SELECT id, name, email, aid, email_verified FROM users WHERE id={$wData['owner']} AND access=1");
                    if ($uData->num_rows) {
                        $uData = $uData->fetch_assoc();
                        if ($uData['email_verified'] == 1) {
                            if ($rank == 2 && $config->bonus->bonusGoldSecondWinner) {
                                $automationModel->addVoucher($uData['email'],
                                    $config->bonus->bonusGoldSecondWinner,
                                    '2ndWinner',
                                    sprintf('[%s] %s', $uData['id'], $uData['name']));
                            } else if ($rank == 3 && $config->bonus->bonusGoldThirdWinner) {
                                $automationModel->addVoucher($uData['email'],
                                    $config->bonus->bonusGoldThirdWinner,
                                    '3rdWinner',
                                    sprintf('[%s] %s', $uData['id'], $uData['name']));
                            }
                        }
                    }
                }
                $rank++;
            }
        }
        if ($config->bonus->bonusGoldTopOff) {
            $topAttacker = $db->query("SELECT id, name, email, email_verified FROM users WHERE id>2 AND hidden=0 AND access=1 ORDER BY total_attack_points DESC LIMIT 1");
            if ($topAttacker->num_rows) {
                $topAttacker = $topAttacker->fetch_assoc();
                if ($topAttacker['email_verified'] == 1) {
                    $automationModel->addVoucher($topAttacker['email'],
                        $config->bonus->bonusGoldTopOff,
                        'topOff',
                        sprintf('[%s] %s', $topAttacker['id'], $topAttacker['name']));
                }
            }
        }
        if ($config->bonus->bonusGoldTopDef) {
            $topDefender = $db->query("SELECT id, name, email, email_verified FROM users WHERE id>2 AND hidden=0 AND access=1 ORDER BY total_defense_points DESC LIMIT 1");
            if ($topDefender->num_rows) {
                $topDefender = $topDefender->fetch_assoc();
                if ($topDefender['email_verified'] == 1) {
                    $automationModel->addVoucher($topDefender['email'],
                        $config->bonus->bonusGoldTopDef,
                        'topDef',
                        sprintf('[%s] %s', $topDefender['id'], $topDefender['name']));
                }
            }
        }
        if ($config->bonus->bonusGoldTopClimber) {
            $topClimber = $db->query("SELECT id, name, email, email_verified FROM users WHERE id>2 AND hidden=0 AND access=1 ORDER BY total_pop DESC LIMIT 1");
            if ($topClimber->num_rows) {
                $topClimber = $topClimber->fetch_assoc();
                if ($topClimber['email_verified'] == 1) {
                    $automationModel->addVoucher($topClimber['email'],
                        $config->bonus->bonusGoldTopClimber,
                        'topClimber',
                        sprintf('[%s] %s', $topClimber['id'], $topClimber['name']));
                }
            }
        }
        if ($config->bonus->bonusGoldTopOffHammer) {
            $topClimber = $db->query("SELECT id, name, email, email_verified FROM users WHERE id>2 AND hidden=0 AND access=1 ORDER BY max_off_point DESC LIMIT 1");
            if ($topClimber->num_rows) {
                $topClimber = $topClimber->fetch_assoc();
                if ($topClimber['email_verified'] == 1) {
                    $automationModel->addVoucher($topClimber['email'],
                        $config->bonus->bonusGoldTopOffHammer,
                        'topOffHammer',
                        sprintf('[%s] %s', $topClimber['id'], $topClimber['name']));
                }
            }
        }
        if ($config->bonus->bonusGoldTopDefHammer) {
            $topClimber = $db->query("SELECT id, name, email, email_verified FROM users WHERE id>2 AND hidden=0 AND access=1 ORDER BY max_def_point DESC LIMIT 1");
            if ($topClimber->num_rows) {
                $topClimber = $topClimber->fetch_assoc();
                if ($topClimber['email_verified'] == 1) {
                    $automationModel->addVoucher($topClimber['email'],
                        $config->bonus->bonusGoldTopDefHammer,
                        'topDefHammer',
                        sprintf('[%s] %s', $topClimber['id'], $topClimber['name']));
                }

            }
        }
        $hidden = !$gameWorldDetails['promoted'];
        $x = 1;
        if ($resultCode == 1) {
            $result = $db->query("SELECT kid, f99 FROM fdata WHERE f99>0 ORDER BY f99 DESC, lastWWUpgrade ASC LIMIT 3");
            while ($row = $result->fetch_assoc()) {
                $owner = $db->fetchScalar("SELECT owner FROM vdata WHERE kid={$row['kid']}");
                $info = $db->query("SELECT id, aid, name, email, email_verified, race, countryFlag FROM users WHERE id={$owner}")->fetch_assoc();
                if ($info['aid']) {
                    $alliance = $db->query("SELECT name, tag FROM alidata WHERE id={$info['aid']}");
                    if ($alliance->num_rows) {
                        $alliance = $alliance->fetch_assoc();
                        $alliance['name'] = $db->real_escape_string($alliance['name']);
                        $alliance['tag'] = $db->real_escape_string($alliance['tag']);
                    } else {
                        $alliance['tag'] = $alliance['name'] = '';
                    }
                } else {
                    $alliance['tag'] = $alliance['name'] = '';
                }
                if ($info['email_verified'] == 1) {
                    ClubApi::addMedal($info['name'],
                        $info['race'],
                        $info['email'],
                        [$info['countryFlag'], $row['f99'], $alliance['name'], $alliance['tag']],
                        $x,
                        $hidden);
                }
                ++$x;
            }
        }
        $x = 4 - 1;
        $result = $db->query("SELECT id, name, email, email_verified, race, total_attack_points, countryFlag FROM users WHERE id>2 AND hidden=0 AND access=1 ORDER BY total_attack_points DESC LIMIT 3");
        while ($row = $result->fetch_assoc()) {
            if ($row['email_verified'] == 1) {
                ClubApi::addMedal($row['name'],
                    $row['race'],
                    $row['email'],
                    [$row['countryFlag'], $row['total_attack_points']],
                    ++$x,
                    $hidden);
            }
        }
        $x = 8 - 1;
        $result = $db->query("SELECT id, name, email, email_verified, race, total_defense_points, countryFlag FROM users WHERE id>2 AND hidden=0 AND access=1 ORDER BY total_defense_points DESC LIMIT 3");
        while ($row = $result->fetch_assoc()) {
            if ($row['email_verified'] == 1) {

                ClubApi::addMedal($row['name'],
                    $row['race'],
                    $row['email'],
                    [$row['countryFlag'], $row['total_defense_points']],
                    ++$x,
                    $hidden);
            }
        }
        $x = 12 - 1;
        $result = $db->query("SELECT id, name, email, email_verified, race, total_pop, countryFlag FROM users WHERE id>2 AND hidden=0 AND access=1 ORDER BY total_pop DESC LIMIT 3");
        while ($row = $result->fetch_assoc()) {
            if ($row['email_verified'] == 1) {
                ClubApi::addMedal($row['name'],
                    $row['race'],
                    $row['email'],
                    [$row['countryFlag'], $row['total_pop']],
                    ++$x,
                    $hidden);
            }
        }
        //big off hammer 16
        //big def hammer 17
        //winner alliance 18
        $result = $db->query("SELECT id, name, email, email_verified, race, max_off_point, countryFlag FROM users WHERE id>2 AND hidden=0 AND access=1 AND max_off_point > 0 ORDER BY max_off_point DESC LIMIT 1");
        while ($row = $result->fetch_assoc()) {
            if ($row['email_verified'] == 1) {
                ClubApi::addMedal($row['name'],
                    $row['race'],
                    $row['email'],
                    [$row['countryFlag'], $row['max_off_point']],
                    16,
                    $hidden);
            }
        }
        $result = $db->query("SELECT id, name, email, email_verified, race, max_def_point, countryFlag FROM users WHERE id>2 AND hidden=0 AND access=1 AND max_def_point > 0 ORDER BY max_def_point DESC LIMIT 1");
        while ($row = $result->fetch_assoc()) {
            if ($row['email_verified'] == 1) {
                ClubApi::addMedal($row['name'],
                    $row['race'],
                    $row['email'],
                    [$row['countryFlag'], $row['max_def_point']],
                    17,
                    $hidden);
            }
        }
        if ($resultCode == 1) {
            $kid = $db->fetchScalar("SELECT kid FROM fdata WHERE f99=100");
            $wData = $db->query("SELECT name, owner FROM vdata WHERE kid=$kid")->fetch_assoc();
            $uData = $db->query("SELECT id, name, access, email, email_verified, aid FROM users WHERE id={$wData['owner']}");
            if ($uData->num_rows) {
                $uData = $uData->fetch_assoc();
                if ($uData['aid']) {
                    $alliance = $db->query("SELECT name, tag FROM alidata WHERE id={$uData['aid']}");
                    if ($alliance->num_rows) {
                        $alliance = $alliance->fetch_assoc();
                        $alliance['name'] = $db->real_escape_string($alliance['name']);
                        $alliance['tag'] = $db->real_escape_string($alliance['tag']);
                        $result = $db->query("SELECT id, name, email, email_verified, race, total_pop, countryFlag FROM users WHERE aid={$uData['aid']} AND id!={$uData['id']}");
                        while ($row = $result->fetch_assoc()) {
                            if ($row['email_verified'] == 1) {
                                ClubApi::addMedal($row['name'],
                                    $row['race'],
                                    $row['email'],
                                    [$row['countryFlag'], $alliance['name'], $alliance['tag']],
                                    18,
                                    $hidden);
                            }
                        }
                    }
                }
            }
        }
        $db->query("UPDATE config SET serverFinishTime=" . time());
    }

    public function cleanupIndex()
    {
        $config = Config::getInstance();
        $registrationCloseTime = $config->game->start_time + (round($config->game->round_length * 0.75, 1) * 86400);
        $registrationCloseTime = min($registrationCloseTime, $config->timers->wwPlansReleaseTime);
        if (getWorldId() == 'dev') {
            $registrationCloseTime = 0;
        }
        $globalDB = GlobalDB::getInstance();
        /**
         * Payment Status:
         * 0 => Nothing
         * 1 => Success
         * 2 => Success but not given
         * 3 => Cancelled
         * 4 => Loaded provider
         */
        $globalDB->query("DELETE FROM paymentLog WHERE status IN(0, 3, 4) AND time < " . (time() - 2.5 * 86400));
        $globalDB->query("DELETE FROM infobox WHERE showTo < " . time());
        $globalDB->query("DELETE FROM news WHERE expire < " . time());
        $globalDB->query("DELETE FROM banIP WHERE blockTill > 0 AND blockTill < " . time());
        $time = time() - Config::getProperty("gold", "voucherExpireDays") * 86400;
        $globalDB->query("UPDATE paymentVoucher SET used=1, usedWorldId='system', usedPlayer='system', usedEmail='system', usedTime=" . time() . " WHERE used=0 AND time < $time");
        if ($registrationCloseTime > 0 && time() > $registrationCloseTime && Config::getAdvancedProperty("registerAutoClose")) {
            $globalDB->query("UPDATE gameServers SET registerClosed=1 WHERE id=" . getWorldUniqueId());
        }
        $db = DB::getInstance();
        $result = $db->query("SELECT * FROM notificationQueue LIMIT 100");
        while ($row = $result->fetch_assoc()) {
            $db->query("DELETE FROM notificationQueue WHERE id={$row['id']}");
            Notification::notifyReal($row['message']);
        }
        if (time() > $config->game->start_time) {
            $interval = getCustom("activationReminderInterval");
            $startTime = $config->game->start_time;
            if ($interval > 0) {
                $result = $globalDB->query("SELECT * FROM activation WHERE used=0 AND time>0 AND reminded=0 AND " . time() . "-IF(time <= $startTime, $startTime, time) >= $interval AND worldId=" . Config::getProperty("settings",
                        "worldUniqueId") . "  LIMIT 20");
                $view = new PHPBatchView("mail/activationReminder");
                while ($row = $result->fetch_assoc()) {
                    $globalDB->query("UPDATE activation SET reminded=1 WHERE id={$row['id']}");
                    $view->vars['name'] = $row['name'];
                    $view->vars['activationCode'] = $row['activationCode'];
                    Mailer::sendEmail($row['email'], T("Mail", "Email verification reminder"), $view->output());
                }
            }
            $interval = getCustom("activationProgressReminderInterval");
            if ($interval > 0) {
                $result = $db->query("SELECT * FROM activation WHERE time>0 AND reminded=0 AND (" . time() . "-IF(time <= $startTime, $startTime, time) >= $interval) LIMIT 20");
                $view = new PHPBatchView("mail/activationProgressReminder");
                while ($row = $result->fetch_assoc()) {
                    $db->query("UPDATE activation SET reminded=1 WHERE id={$row['id']}");
                    $view->vars['name'] = $row['name'];
                    $view->vars['token'] = $row['token'];
                    Mailer::sendEmail($row['email'], T("Mail", "Activation progress reminder"), $view->output());
                }
            }
        }
    }

    public function postService()
    {
        $config = Config::getInstance();
        if ($config->dynamic->postServiceDone == 1 || $config->dynamic->serverFinishTime <= 0) return;
        $pause = 3 * 86400;
        if ($config->timers->auto_reinstall > 0) {
            $pause = $config->timers->auto_reinstall;
        }
        if ((time() - $config->dynamic->serverFinishTime) < $pause) {
            return;
        }
        $db = DB::getInstance();
        $db->query("UPDATE config SET postServiceDone=1");
        $db->backup_tables();
        if ($config->timers->auto_reinstall > 0) {
            $this->handleAutoReinstall();
            return;
        }
        $db->query("TRUNCATE TABLE a2b");
        $db->query("TRUNCATE TABLE accounting");
        $db->query("TRUNCATE TABLE activation");
        $db->query("TRUNCATE TABLE admin_log");
        $db->query("TRUNCATE TABLE adventure");
        $db->query("TRUNCATE TABLE alistats");
        $db->query("TRUNCATE TABLE ali_invite");
        $db->query("TRUNCATE TABLE ali_log");
        $db->query("TRUNCATE TABLE alliance_notification");
        $db->query("TRUNCATE TABLE allimedal");
        $db->query("TRUNCATE TABLE auction");
        $db->query("TRUNCATE TABLE autoExtend");
        $db->query("TRUNCATE TABLE alliance_bonus_upgrade_queue");
        $db->query("TRUNCATE TABLE banQueue");
        $db->query("TRUNCATE TABLE bids");
        $db->query("TRUNCATE TABLE blocks");
        $db->query("TRUNCATE TABLE building_upgrade");
        $db->query("TRUNCATE TABLE buyGoldMessages");
        $db->query("TRUNCATE TABLE voting_reward_queue");
        $db->query("TRUNCATE TABLE casualties");
        $db->query("TRUNCATE TABLE changeEmail");
        $db->query("TRUNCATE TABLE deleting");
        $db->query("TRUNCATE TABLE demolition");
        $db->query("TRUNCATE TABLE farmlist");
        $db->query("TRUNCATE TABLE forum_edit");
        $db->query("TRUNCATE TABLE forum_forums");
        $db->query("TRUNCATE TABLE forum_open_alliances");
        $db->query("TRUNCATE TABLE forum_open_players");
        $db->query("TRUNCATE TABLE forum_options");
        $db->query("TRUNCATE TABLE forum_post");
        $db->query("TRUNCATE TABLE forum_topic");
        $db->query("TRUNCATE TABLE forum_vote");
        $db->query("TRUNCATE TABLE friendlist");
        $db->query("TRUNCATE TABLE ignoreList");
        $db->query("TRUNCATE TABLE infobox");
        $db->query("TRUNCATE TABLE infobox_delete");
        $db->query("TRUNCATE TABLE infobox_read");
        $db->query("TRUNCATE TABLE links");
        $db->query("TRUNCATE TABLE mapflag");
        $db->query("TRUNCATE TABLE map_block");
        $db->query("TRUNCATE TABLE map_mark");
        $db->query("TRUNCATE TABLE market");
        $db->query("TRUNCATE TABLE marks");
        $db->query("DELETE FROM mdata WHERE uid > 2 AND to_uid > 2");
        $db->query("TRUNCATE TABLE medal");
        $db->query("TRUNCATE TABLE messages_report");
        $db->query("TRUNCATE TABLE movement");
        $db->query("TRUNCATE TABLE multiaccount_log");
        $db->query("TRUNCATE TABLE multiaccount_users");
        $db->query("TRUNCATE TABLE ndata");
        $db->query("TRUNCATE TABLE newproc");
        $db->query("TRUNCATE TABLE notificationQueue");
        $db->query("TRUNCATE TABLE odelete");
        $db->query("TRUNCATE TABLE player_references");
        $db->query("TRUNCATE TABLE raidlist");
        $db->query("TRUNCATE TABLE research");
        $db->query("TRUNCATE TABLE send");
        $db->query("TRUNCATE TABLE surrounding");
        $db->query("TRUNCATE TABLE traderoutes");
        $db->query("TRUNCATE TABLE training");
        $db->query("TRUNCATE TABLE general_log");
        Notification::RealTimeNotify("Server shutdown", "Server has been cleared and shut down.");
    }

    public function handleAutoReinstall()
    {
        $worldId = getWorldId();
        $config = Config::getInstance();
        TaskQueue::addTask(TaskQueue::TASK_UNINSTALL, ['id' => getWorldUniqueId()], "Uninstalling server $worldId");
        $installationTime = $config->dynamic->serverFinishTime + $config->timers->auto_reinstall;
        if ($installationTime < time()) {
            $installationTime = time();
        }
        $newStartTime = strtotime("today " . date("H:i:s", $config->game->start_time), $installationTime);
        $newStartTime += $config->timers->auto_reinstall_start_after;
        $data = [
            'speed' => $config->game->speed,
            'serverName' => $config->settings->serverName,
            'worldId' => $worldId,
            'roundLength' => $config->game->round_length_orig,
            'mapSize' => MAP_SIZE,
            'isPromoted' => false,
            'startGold' => $config->gold->startGold,
            'buyTroops' => $config->extraSettings->buyTroops['enabled'],
            'buyTroopsInterval' => $config->extraSettings->buyTroops['buyInterval'],
            'buyResources' => $config->extraSettings->buyResources['enabled'],
            'buyResourcesInterval' => $config->extraSettings->buyResources['buyInterval'],
            'buyAnimals' => $config->extraSettings->buyAnimal['enabled'],
            'buyAnimalsInterval' => $config->extraSettings->buyAnimal['buyInterval'],
            'protectionHours' => ceil($config->game->protection_time / 3600),
            'needPreregistrationCode' => 0,
            'serverHidden' => false,
            'instantFinishTraining' => $config->extraSettings->generalOptions->finishTraining->enabled,
            'buyAdventure' => $config->extraSettings->generalOptions->buyAdventure->enabled,
            'activation' => true,
            'auto_reinstall' => $config->timers->auto_reinstall,
            'auto_reinstall_start_after' => $config->timers->auto_reinstall_start_after,
            'startTime' => $newStartTime,
        ];
        TaskQueue::addTask(TaskQueue::TASK_INSTALL, $data, "Installing server $worldId");
        Notification::RealTimeNotify("Installation", "Server " . getWorldId() . " was auto reinstalled.");
    }

    public function backup()
    {
        if (getGameElapsedSeconds() <= 1800) return;
        $db = DB::getInstance();
        $lastBackup = $db->fetchScalar("SELECT lastBackup FROM config");
        if ((time() - $lastBackup) > 6 * 3600) {
            $db->backup_tables();
        }
    }
}