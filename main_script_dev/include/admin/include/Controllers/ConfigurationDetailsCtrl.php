<?php

use Core\Caching\Caching;
use Core\Config;
use Core\Database\DB;
use Core\Database\GlobalDB;
use Core\Helper\TimezoneHelper;
use Game\Formulas;
use Model\ArtefactsModel;
use Model\SummaryModel;
use Model\WonderOfTheWorldModel;

class ConfigurationDetailsCtrl
{
    public function __construct()
    {

        $config = Config::getInstance();
        $this->processActions();
        $dispatcher = Dispatcher::getInstance();
        $dispatcher->appendContent('<br />');
        $dispatcher->appendContent('<div style="float: left; width: 49%">');
        $params['content'] = null;
        $db = DB::getInstance();
        $params['title'] = 'Game Information';
        $this->addInfo($params['content'], 'World ID', getWorldId());
        $this->addInfo($params['content'], 'World Unique ID', getWorldUniqueId());
        $this->addInfo($params['content'], 'Speed', getGameSpeed());
        $this->addInfo($params['content'], 'Movement speed', getGame("movement_speed_increase"));
        $this->addInfo($params['content'], 'Map size', MAP_SIZE . 'x' . MAP_SIZE);
        $this->addInfo($params['content'], 'Min distance', round(Formulas::getMapMinDistanceFromCenter(), 1));
        $this->addInfo($params['content'], 'Storage multiplier', getGame("storage_multiplier"));
        $this->addInfo($params['content'],
            'Start time',
            TimezoneHelper::autoDateString($config->game->start_time, true));
        $this->addInfo($params['content'],
            'Round age/length',
            round(getGameElapsedSeconds() / 86400,
                1) . '/' . round(($config->timers->wwPlansReleaseTime - $config->game->start_time) / 86400,
                1) . ' day(s)');
        $this->addInfo($params['content'], 'Round length (by natars)', round(getGame("round_length"), 2) . ' day(s)');
        $this->addInfo($params['content'],
            'Start/Daily gold',
            $config->gold->startGold . '/' . $config->gold->dailyGold);

        $this->addInfo($params['content'],
            'Last medals',
            TimezoneHelper::autoDateString($config->dynamic->lastMedalsGiven, true));
        $this->addInfo($params['content'],
            'Next medals',
            TimezoneHelper::autoDateString(getGame('medals_interval') + $config->dynamic->lastMedalsGiven, true));

        $this->addInfo($params['content'],
            'Last dailyQuest',
            TimezoneHelper::autoDateString($config->dynamic->lastDailyQuestReset, true));
        $this->addInfo($params['content'],
            'Next dailyQuest',
            TimezoneHelper::autoDateString($config->dynamic->lastDailyQuestReset + getGame('dailyQuestInterval'),
                true));

        $this->addInfo($params['content'], 'Daily quest interval', $config->game->dailyQuestInterval);

        $this->addInfo($params['content'], 'Protection hours', getGame("protection_time") / 3600);
        if (!ArtefactsModel::artifactsReleased()) {
            $this->addInfo($params['content'],
                'Artifacts Release',
                appendTimer($config->timers->ArtifactsReleaseTime - time(), 0, true));
        }
        if (!ArtefactsModel::wwPlansReleased()) {
            $this->addInfo($params['content'],
                'WWPlans Release',
                appendTimer($config->timers->wwPlansReleaseTime - time(), 0, true));
        }
        if ($config->timers->auto_reinstall > 0) {
            if ($config->dynamic->serverFinishTime > 0) {
                $auto_reinstall_text = appendTimer(($config->dynamic->serverFinishTime + $config->timers->auto_reinstall) - time(),
                    0,
                    true);
                $this->addInfo($params['content'], 'Auto reinstall', $auto_reinstall_text);
            } else {
                $this->addInfo($params['content'],
                    'Auto reinstall after',
                    appendTimer((int)$config->timers->auto_reinstall, 0, true));
            }
            $this->addInfo($params['content'],
                'Auto reinstall start after',
                appendTimer((int)$config->timers->auto_reinstall_start_after, 0, true));

        } else {
            $this->addInfo($params['content'], 'Auto reinstall', '<b>Disabled</b>');
        }
        $dispatcher->appendContent(Template::getInstance()->load($params, 'tpl/ServerInfo.tpl')->getAsString());
        $dispatcher->appendContent('<br />');
        $params['content'] = null;
        $params['title'] = 'Settings';
        $gameServer = GlobalDB::getInstance()->query("SELECT * FROM gameServers WHERE id=" . getWorldUniqueId())->fetch_assoc();
        $this->addInfo($params['content'],
            'Register',
            '
                                            <select id="registerClosed">
                                                <option value="on" ' . ($gameServer['registerClosed'] == 0 ? 'selected' : '') . '>Open</option>
                                                <option value="off" ' . ($gameServer['registerClosed'] == 1 ? 'selected' : '') . '>Closed</option>
                                            </select>');
        $this->addInfo($params['content'],
            'Activation',
            '
                                            <select id="activation">
                                                <option value="on" ' . ($gameServer['activation'] == 1 ? 'selected' : '') . '>Enabled</option>
                                                <option value="off" ' . ($gameServer['activation'] == 0 ? 'selected' : '') . '>Disabled</option>
                                            </select>');
        $this->addInfo($params['content'],
            'Need preregistration code',
            '
                                            <select id="needPreregistrationCode">
                                                <option value="on" ' . ($gameServer['preregistration_key_only'] == 1 ? 'selected' : '') . '>Yes</option>
                                                <option value="off" ' . ($gameServer['preregistration_key_only'] == 0 ? 'selected' : '') . '>No</option>
                                            </select>');
        $this->addInfo($params['content'],
            'Maintenance',
            '
                                            <select id="maintenance">
                                                <option value="on" ' . ($config->dynamic->maintenance == 1 ? 'selected' : '') . '>On</option>
                                                <option value="off" ' . ($config->dynamic->maintenance == 0 ? 'selected' : '') . '>Off</option>
                                            </select>');
        $this->addInfo($params['content'],
            'Fake accounts progress:',
            '
                                            <select id="fakeAccountProcess">
                                                <option value="on" ' . ($config->dynamic->fakeAccountProcess == 1 ? 'selected' : '') . '>On</option>
                                                <option value="off" ' . ($config->dynamic->fakeAccountProcess == 0 ? 'selected' : '') . '>Off</option>
                                            </select>');
        $dispatcher->appendContent(Template::getInstance()->load($params, 'tpl/ServerInfo.tpl')->getAsString());
        $dispatcher->appendContent('</div>');
        $dispatcher->appendContent('<div style="float: right; width: 49%">');
        $params['content'] = null;
        $params['title'] = 'Player Information';
        $summary = new SummaryModel();
        $summary = $summary->getTotalSummary();
        {
            $percent = round($summary['active'] / ($summary['registered']) * 100, 1);
            $color = $percent <= 50 ? 'red' : ($percent <= 80 ? 'orange' : 'green');
            $percent = ' <span style="font-size: 11px; color: ' . $color . '; font-weight: bold">(' . $percent . '%)</span>';
            $this->addInfo($params['content'],
                'Active/Registered',
                $summary['active'] . '/' . $summary['registered'] . $percent);
        }
        {
            $percent = round($summary['fakeCount'] / ($summary['active']) * 100, 1);
            $color = $percent <= 20 ? 'green' : ($percent <= 40 ? 'orange' : 'red');
            $percent = ' <span style="font-size: 11px; color: ' . $color . '; font-weight: bold">(' . $percent . '%)</span>';
            $this->addInfo($params['content'],
                'Fake players',
                $summary['fakeCount'] . '/' . $summary['active'] . $percent);
        }
        $this->addInfo($params['content'],
            'Activating index/server',
            $summary['not_activated'] . '/' . $summary['activating']);
        {
            $percent = round($summary['verified'] / ($summary['real_players']) * 100, 1);
            $color = $percent <= 30 ? 'red' : ($percent <= 50 ? 'orange' : 'green');
            $percent = ' <span style="font-size: 11px; color: ' . $color . '; font-weight: bold">(' . $percent . '%)</span>';
            $this->addInfo($params['content'],
                'Verified players',
                $summary['verified'] . '/' . ($summary['active'] - $summary['fakeCount']) . $percent);
        }
        {
            $percent = round($summary['real_online'] / ($summary['real_players']) * 100, 1);
            $color = $percent <= 20 ? 'red' : ($percent <= 50 ? 'orange' : 'green');
            $percent = ' <span style="font-size: 11px; color: ' . $color . '; font-weight: bold">(' . $percent . '%)</span>';
            $this->addInfo($params['content'],
                'Players online',
                $summary['real_online'] . '/' . ($summary['real_players']) . $percent);
        }

        {
            $queueCount = $db->fetchScalar("SELECT 
        (
            (SELECT COUNT(id) FROM movement)+
            (SELECT COUNT(id) FROM building_upgrade)+
            (SELECT COUNT(id) FROM demolition)+
            (SELECT COUNT(uid) FROM deleting)+
            (SELECT COUNT(id) FROM auction WHERE finish=0 AND cancel=0)+
            (SELECT COUNT(id) FROM traderoutes WHERE enabled=1)+
            (SELECT COUNT(id) FROM buyGoldMessages)+
            (SELECT COUNT(id) FROM banQueue)+
            (SELECT COUNT(id) FROM alliance_notification)+
            (SELECT COUNT(id) FROM odelete)+
            (SELECT COUNT(id) FROM research)+
            (SELECT COUNT(id) FROM send)+
            (SELECT COUNT(id) FROM training WHERE commence >= " . (miliseconds() - 1 * 1000) . ")+
            (SELECT COUNT(id) FROM notificationQueue)+
            (SELECT COUNT(id) FROM player_references WHERE rewardGiven=0)
        )");
            $color = $queueCount <= 800 ? 'green' : ($queueCount <= 2000 ? 'orange' : 'red');
            $queueCount = ' <span style="color: ' . $color . '; font-weight: bold">' . $queueCount . '</span>';
            $this->addInfo($params['content'], 'Queued Tasks', $queueCount);
        }

        $this->addInfo($params['content'],
            'Reports/Messages',
            $db->fetchScalar("SELECT CONCAT((SELECT COUNT(id) FROM ndata), \"/\", (SELECT COUNT(id) FROM mdata))"));
        {
            $villages = $db->fetchScalar("SELECT CONCAT((SELECT COUNT(kid) FROM available_villages WHERE occupied=1), \"/\", (SELECT COUNT(kid) FROM available_villages))");
            $p = explode("/", $villages);
            $percent = round($p[0] / $p[1] * 100, 1);
            $color = $percent <= 10 ? 'red' : ($percent <= 25 ? 'orange' : 'green');
            $percent = ' <span style="font-size: 11px; color: ' . $color . '; font-weight: bold">(' . $percent . '%)</span>';
            $this->addInfo($params['content'], 'Occupied/Free Villages', $villages . $percent);
        }
        {
            $oases = $db->fetchScalar("SELECT CONCAT((SELECT COUNT(kid) FROM odata WHERE owner>0), \"/\", (SELECT COUNT(kid) FROM odata))");
            $p = explode("/", $oases);
            $percent = round($p[0] / $p[1] * 100, 1);
            $color = $percent <= 10 ? 'red' : ($percent <= 25 ? 'orange' : 'green');
            $percent = ' <span style="font-size: 11px; color: ' . $color . '; font-weight: bold">(' . $percent . '%)</span>';
            $this->addInfo($params['content'], 'Occupied/Free Oases', $oases . $percent);
        }
        $this->addInfo($params['content'],
            'Gift/Bought gold',
            $db->fetchScalar('SELECT CONCAT((SELECT COALESCE(SUM(gift_gold), 0) FROM users WHERE access!=3 AND id>2), "/", (SELECT COALESCE(SUM(bought_gold), 0) FROM users WHERE access!=3 AND id>2))'));

        $cmd = sprintf("systemctl is-active %s", Config::getProperty("settings", "engine_filename"));
        $status = trim(shell_exec($cmd));
        if ($status == 'active') {
            $status = 'Running';
        } else {
            $status = 'Not running';
        }
        $this->addInfo($params['content'], 'Engine status', $status);
        $dispatcher->appendContent(Template::getInstance()->load($params, 'tpl/ServerInfo.tpl')->getAsString());
        $dispatcher->appendContent('</div>');
        $dispatcher->appendContent('</div>');
        $this->getTroopsSummary();
        $dispatcher->appendContent('<script src="/admin/configuration.js?' . time() . '" type="text/javascript"></script>');
    }

    private function processActions()
    {
        if (isServerFinished() || \Core\Session::getInstance()->getAdminUid() > 2) return;
        $config = Config::getInstance();
        $db = DB::getInstance();
        $globalDB = GlobalDB::getInstance();
        if (isset($_GET['registerClosed'])) {
            AdminLog::getInstance()->addLog("Changed Registration status Settings.");
            $state = $_GET['registerClosed'] == 'on' ? 0 : 1;
            $gameServer['registerClosed'] = $state;
            $globalDB->query("UPDATE gameServers SET registerClosed=$state WHERE id=" . getWorldUniqueId());
        } else if (isset($_GET['activation'])) {
            AdminLog::getInstance()->addLog("Changed activation status Settings.");
            $state = $_GET['activation'] == 'on' ? 1 : 0;
            $gameServer['activation'] = $state;
            $globalDB->query("UPDATE gameServers SET activation=$state WHERE id=" . getWorldUniqueId());
        } else if (isset($_GET['maintenance'])) {
            AdminLog::getInstance()->addLog("Changed maintenance Settings.");
            $state = $_GET['maintenance'] == 'on' ? 1 : 0;
            $config->dynamic->maintenance = $state;
            $db->query("UPDATE config SET maintenance=$state");
        } else if (isset($_GET['needPreregistrationCode'])) {
            AdminLog::getInstance()->addLog("Changed PreregistrationCode Settings.");
            $state = $_GET['needPreregistrationCode'] == 'on' ? 1 : 0;
            $globalDB->query("UPDATE gameServers SET preregistration_key_only=$state WHERE id=" . getWorldUniqueId());
        } else if (isset($_GET['fakeAccountProcess'])) {
            AdminLog::getInstance()->addLog("Changed fakeAccountProcess Settings.");
            $state = $_GET['fakeAccountProcess'] == 'on' ? 1 : 0;
            $config->dynamic->fakeAccountProcess = $state;
            $db->query("UPDATE config SET fakeAccountProcess=$state");
        }
    }

    private function addInfo(&$content, $name, $value)
    {
        $content .= '<tr>
            <td>' . $name . '</td>
            <td>
                ' . $value . '
            </td>
        </tr>';
    }

    private function getTroopsSummary()
    {
        $maxRace = getGame("allowNewTribes") ? 7 : 5;
        //Note: because this uses lot's of memory and it will cause damage to servers removed!
        $cache = Caching::getInstance();
        if (($_cache = $cache->get("TroopsSummary"))) {
            $Troops = $_cache;
        } else {
            $db = DB::getInstance();
            $result = $db->query($this->getTroopsStatisticsQuery())->fetch_assoc();
            $Troops = [];
            for ($race = 1; $race <= $maxRace; ++$race) {
                for ($nr = 1; $nr <= 11; ++$nr) {
                    $Troops[$race][$nr] = $result["u{$race}_{$nr}"];
                }
            }
            $cache->set("TroopsSummary", $Troops, 6 * 3600);
        }
        $dispatcher = Dispatcher::getInstance();
        $dispatcher->appendContent('<br/><br/><center><div id="content" class="village3" style="width: 90%;">');
        $dispatcher->appendContent('<table cellpadding="1" cellspacing="1" class="vil_troops">');
        $dispatcher->appendContent('<thead><tr><th colspan="11">Total Troops in Game</th></tr></thead>');
        for ($race = 1; $race <= $maxRace; ++$race) {
            $dispatcher->appendContent(Template::getInstance()->load(['race' => $race, 'units' => $Troops[$race]],
                'tpl/troop_tbody.tpl')->getAsString());
        }
        $dispatcher->appendContent('</table>');
        $dispatcher->appendContent('</div></center>');
    }

    function getTroopsStatisticsQuery()
    {
        $query = 'SELECT ';
        $maxRace = getGame("allowNewTribes") ? 7 : 5;
        $maxNr = 11;
        for ($race = 1; $race <= $maxRace; ++$race) {
            for ($nr = 1; $nr <= $maxNr; ++$nr) {
                $query .= $this->getQueryForNr($nr, $race);
                if (!($race == $maxRace && $nr == $maxNr)) {
                    $query .= ',';
                }
            }
        }
        return $query;
    }

    function getQueryForNr($nr, $race)
    {
        $units = "(SELECT COALESCE(SUM(u{$nr}), 0) FROM units WHERE race={$race})";
        $trapped = "(SELECT COALESCE(SUM(u{$nr}), 0) FROM trapped WHERE race={$race})";
        $enforcement = "(SELECT COALESCE(SUM(u{$nr}), 0) FROM enforcement WHERE race={$race})";
        $movement = "(SELECT COALESCE(SUM(u{$nr}), 0) FROM movement WHERE race={$race})";
        return "($units+$trapped+$enforcement+$movement) as u{$race}_{$nr}";
    }
}