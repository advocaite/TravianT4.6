<?php

use Core\Config;
use Core\Database\DB;
use Core\Helper\Notification;
use Core\Helper\TimezoneHelper;
use Core\Helper\WebService;
use Core\Session;
use Game\Formulas;
use Game\Map\Map;
use Game\ResourcesHelper;
use Model\AccountDeleter;
use Model\OptionModel;
use Model\StatisticsModel;
use Model\SummaryModel;
use Model\VillageModel;
use resources\View\PHPBatchView;

class EditPlayerCtrl
{
    private $db, $countryCodes;

    public function __construct()
    {
        $this->db = DB::getInstance();
        $this->countryCodes = Config::getInstance()->countryCodes;
        if (isset($_REQUEST['section']) && isset($_REQUEST['uid'])) {
            if (!isServerFinished() && WebService::isPost() && $_REQUEST['section'] == 'editAll' && Session::validateChecker()) {
                if (
                    TimezoneHelper::strtotime($_POST['protection']) === FALSE
                    || TimezoneHelper::strtotime($_POST['plus']) === FALSE
                    || TimezoneHelper::strtotime($_POST['b1']) === FALSE
                    || TimezoneHelper::strtotime($_POST['b2']) === FALSE
                    || TimezoneHelper::strtotime($_POST['b3']) === FALSE
                    || TimezoneHelper::strtotime($_POST['b4']) === FALSE
                    || TimezoneHelper::strtotime($_POST['protectionLastExtend']) === FALSE
                ) {
                } else {
                    $user = $this->db->query("SELECT * FROM users WHERE id=" . (int)$_REQUEST['uid']);
                    if ($user->num_rows) {
                        $user = $user->fetch_assoc();
                        $gift_gold_change = $bought_gold_change = 0;
                        if (!getCustom('allowInterruptionInGame')) {
                            $_POST['success_adventures_count'] = $user['success_adventures_count'];
                            $_POST['week_attack_points'] = $user['week_attack_points'];
                            $_POST['week_defense_points'] = $user['week_defense_points'];
                            $_POST['week_robber_points'] = $user['week_robber_points'];
                            $_POST['total_attack_points'] = $user['total_attack_points'];
                            $_POST['total_defense_points'] = $user['total_defense_points'];
                            $_POST['protectionHours'] = $user['protectionBoughtHours'];
                            $_POST['protection'] = TimezoneHelper::date("Y-m-d H:i", ($user['protection']));
                            $_POST['silver'] = $user['silver'];
                            $_POST['cp'] = $user['cp'];
                            $_POST['plus'] = TimezoneHelper::date("Y-m-d H:i", ($user['plus']));
                            $_POST['b1'] = TimezoneHelper::date("Y-m-d H:i", ($user['b1']));
                            $_POST['b2'] = TimezoneHelper::date("Y-m-d H:i", ($user['b2']));
                            $_POST['b3'] = TimezoneHelper::date("Y-m-d H:i", ($user['b3']));
                            $_POST['b4'] = TimezoneHelper::date("Y-m-d H:i", ($user['b4']));
                            $_POST['protectionLastExtend'] = TimezoneHelper::date("Y-m-d H:i", $user['protectionLastExtend']);
                        } else {
                            $goldChange = ((int)$_POST['gift_gold'] + (int)$_POST['bought_gold']) - ($user['bought_gold'] + $user['gift_gold']);
                            if ($goldChange != 0) {
                                Notification::RealTimeNotify("Gold change detected",
                                    "$goldChange golds was added/removed to/from player {$user['name']}.");
                            }

                            $gift_gold_change = (int)$_POST['gift_gold'] - (int)$_POST['old_gift_gold'];
                            $bought_gold_change = (int)$_POST['bought_gold'] - (int)$_POST['old_bought_gold'];
                        }


                        $_POST['username'] = trim(filter_var(htmlspecialchars($_POST['username'], ENT_QUOTES)));
                        $m = new OptionModel();
                        if (0 === ($m->doesNameMeetRequirements($user['name'], $_POST['username']) === 0)) {
                            $_POST['username'] = $user['name'];
                        }
                        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                        $email_verified = $_POST['email_verified'] == 1 && !empty($email) || (int)$_REQUEST['uid'] <= 2;
                        $this->db->query("UPDATE users SET
                                                  name='" . $this->db->mysqli->real_escape_string($_POST['username']) . "',
                                                  email='" . $email . "'," . "
                                                  email_verified='" . ($email_verified ? 1 : 0) . "'," . "
                                                  location='" . $this->db->mysqli->real_escape_string(filter_var($_POST['location'])) . "',
                                                  gift_gold=gift_gold+'" . $gift_gold_change . "',
                                                  bought_gold=bought_gold+'" . $bought_gold_change . "',
                                                  silver='" . (int)$_POST['silver'] . "',
                                                  cp='" . (int)$_POST['cp'] . "',
                                                  success_adventures_count='" . (int)$_POST['success_adventures_count'] . "',
                                                  week_attack_points='" . (int)$_POST['week_attack_points'] . "',
                                                  week_defense_points='" . (int)$_POST['week_defense_points'] . "',
                                                  week_robber_points='" . (int)$_POST['week_robber_points'] . "',
                                                  total_attack_points='" . (int)$_POST['total_attack_points'] . "',
                                                  total_defense_points='" . (int)$_POST['total_defense_points'] . "',
                                                  protectionBoughtHours='" . (int)abs($_POST['protectionHours']) . "',
                                                  protectionLastExtend='" . TimezoneHelper::strtotime($_POST['protectionLastExtend']) . "',
                                                  protection='" . TimezoneHelper::strtotime($_POST['protection']) . "',
                                                  plus='" . TimezoneHelper::strtotime($_POST['plus']) . "',
                                                  b1='" . TimezoneHelper::strtotime($_POST['b1']) . "',
                                                  b2='" . TimezoneHelper::strtotime($_POST['b2']) . "',
                                                  b3='" . TimezoneHelper::strtotime($_POST['b3']) . "',
                                                  b4='" . TimezoneHelper::strtotime($_POST['b4']) . "',
                                                  desc1='" . $this->db->mysqli->real_escape_string(filter_var($_POST['desc1'])) . "',
                                                  desc2='" . $this->db->mysqli->real_escape_string(filter_var($_POST['desc2'])) . "'
                                                  WHERE id=" . (int)$_REQUEST['uid']);
                        if (isset($_POST['password']) && !empty($_POST['password'])) {
                            $this->db->query("UPDATE users SET password='" . sha1($_POST['password']) . "' WHERE id=" . (int)$_POST['uid']);
                        }
                        $dispatcher = Dispatcher::getInstance();
                        $dispatcher->appendContent("<hr><p class='error center'>Changes made....</p><hr>");
                        AdminLog::getInstance()->addLog("Edited Player(" . (int)$_REQUEST['uid'] . ")");
                    }
                }
            } else if (!isServerFinished() && $_REQUEST['section'] == 'deletePlayer' && Session::validateChecker()) {
                $uid = (int)$_REQUEST['uid'];
                //$db->query("INSERT INTO deleting (uid, time) VALUES ($uid, 0)");
                $dispatcher = Dispatcher::getInstance();
                $dispatcher->appendContent("<hr><p class='error center'>Player will be deleted in some minutes.</p><hr>");;
                AdminLog::getInstance()->addLog("Deleted a player({$uid}).");
                return;
            } else if (!isServerFinished() && $_REQUEST['section'] == 'punishPlayer') {
                $this->showPunishPlayer((int)$_REQUEST['uid']);
                return;
            } else if (!isServerFinished() && $_REQUEST['section'] == 'fillResources' && !getCustom('allowInterruptionInGame')) {
                $uid = (int)$_REQUEST['uid'];
                $this->db->query("UPDATE vdata SET wood=maxstore, clay=maxstore, iron=maxstore, crop=maxcrop WHERE owner=$uid");
                $dispatcher = Dispatcher::getInstance();
                $dispatcher->appendContent("<hr><p class='error center'>Resources were filled....</p><hr>");
            } else if (!isServerFinished() && $_REQUEST['section'] == 'killHero') {
                $uid = (int)$_REQUEST['uid'];
                $db = DB::getInstance();
                $hero = $db->query("SELECT * FROM hero WHERE uid=$uid");
                if ($hero->num_rows) {
                    $hero = $hero->fetch_assoc();
                    if ($hero['health'] > 0) {
                        $db->query("UPDATE hero SET health=0 WHERE uid=$uid");
                        $villages = $db->query("SELECT kid FROM vdata WHERE owner=$uid");
                        while ($row = $villages->fetch_assoc()) {
                            $db->query("UPDATE units SET u11=0 WHERE kid={$row['kid']}");
                            $db->query("UPDATE enforcement SET u11=0 WHERE kid={$row['kid']}");
                            $db->query("UPDATE trapped SET u11=0 WHERE kid={$row['kid']}");
                            $db->query("UPDATE movement SET u11=0 WHERE kid={$row['kid']}");
                        }
                        ResourcesHelper::updateVillageResources($hero['kid'], false);
                        $dispatcher = Dispatcher::getInstance();
                        $dispatcher->appendContent("<hr><p class='error center'>Hero was killed....</p><hr>");
                    }
                }
            } else if (!isServerFinished() && $_REQUEST['section'] == 'setAsNormalUser') {
                $uid = (int)$_REQUEST['uid'];
                $db = DB::getInstance();
                $db->query("UPDATE users SET access=IF(access=0, 0, 1) WHERE id=$uid");
                $dispatcher = Dispatcher::getInstance();
                $dispatcher->appendContent("<hr><p class='error center'>This user is now normal user....</p><hr>");
            } else if (!isServerFinished() && $_REQUEST['section'] == 'setAsFakeUser') {
                $uid = (int)$_REQUEST['uid'];
                $db = DB::getInstance();
                $db->query("UPDATE users SET access=IF(access=0, 0, 3) WHERE id=$uid");
                $dispatcher = Dispatcher::getInstance();
                $dispatcher->appendContent("<hr><p class='error center'>This user is now fake user....</p><hr>");
            } else if (!isServerFinished() && $_REQUEST['section'] == 'changeTribeToRomans') {
                $uid = (int)$_REQUEST['uid'];
                $this->changeTribe($uid, 1);
            } else if (!isServerFinished() && $_REQUEST['section'] == 'changeTribeToTeutons') {
                $uid = (int)$_REQUEST['uid'];
                $this->changeTribe($uid, 2);
            } else if (!isServerFinished() && $_REQUEST['section'] == 'changeTribeToGuals') {
                $uid = (int)$_REQUEST['uid'];
                $this->changeTribe($uid, 3);
            } else if (!isServerFinished() && $_REQUEST['section'] == 'changeTribeToEgyptians') {
                $uid = (int)$_REQUEST['uid'];
                $this->changeTribe($uid, 6);
            } else if (!isServerFinished() && $_REQUEST['section'] == 'changeTribeToHuns') {
                $uid = (int)$_REQUEST['uid'];
                $this->changeTribe($uid, 7);
            }
        }
        if (isset($_REQUEST['uid'])) {
            $this->showEditUser((int)$_REQUEST['uid']);
        }
    }

    private function changeTribe($uid, $race)
    {
        set_time_limit(0);
        ignore_user_abort(true);
        $db = DB::getInstance();
        $db->mysqli->begin_transaction();
        $oldRace = $this->db->fetchScalar("SELECT race FROM users WHERE id=$uid");
        if (!$oldRace) return;
        $helper = new AccountDeleter();
        $db->query("UPDATE users SET race=$race WHERE id=$uid");
        if ($db->affectedRows()) {
            $user_villages = $db->query("SELECT kid FROM vdata WHERE owner=$uid");
            $villageModel = new VillageModel();
            $kids = [];
            while ($row = $user_villages->fetch_assoc()) {
                $villageModel->removeTribeSpecificBuildings($row['kid']);
                if ($oldRace == 3) {
                    $traps = $db->query("SELECT * FROM trapped WHERE to_kid={$row['kid']}");
                    while ($trapped = $traps->fetch_assoc()) {
                        $helper->returnTrappedOrEnforcementRow($trapped, FALSE);
                    }
                }
                $kids[] = $row['kid'];
                Map::villageDestroyOrCaptureOrNewVillageUpdate($row['kid']);
            }
            if (sizeof($kids)) {
                $implode = implode(",", $kids);
                $db->query("UPDATE enforcement SET race=$race WHERE kid IN($implode)");
                $db->query("UPDATE movement SET race=$race WHERE kid IN($implode) OR (to_kid IN($implode) AND mode=1)");
                $db->query("UPDATE trapped SET race=$race WHERE kid IN($implode)");
                $db->query("UPDATE units SET race=$race, u99=0 WHERE kid IN($implode)");
            }
            (new SummaryModel())->deletePlayerFromSummary($oldRace);
            (new SummaryModel())->addPlayerToSummary($race);
            $db->mysqli->commit();
            $dispatcher = Dispatcher::getInstance();
            $dispatcher->appendContent("<hr><p class='error center'>Tribe was changed.</p><hr>");
        } else {
            $db->mysqli->rollback();
        }
    }

    private function showPunishPlayer($uid)
    {
        $dispatcher = Dispatcher::getInstance();
        if (!getCustom('allowInterruptionInGame')) {
            $dispatcher->appendContent("<hr><p class='error center'>Disabled by admin</p><hr>");
            return;
        }
        $userData = $this->db->query("SELECT name FROM users WHERE id=$uid");
        if (!$userData->num_rows) {
            $dispatcher->appendContent("<hr><p class='error center'>User does not exists!</p><hr>");
            return;
        }
        if (WebService::isPost() && Session::validateChecker()) {
            $m = new VillageModel();
            AdminLog::getInstance()->addLog("Punished a player({$uid}).");
            $m->punishPlayer($uid,
                (int)$_REQUEST['PunishVillage'],
                (int)$_REQUEST['PunishResources'],
                (int)$_REQUEST['PunishTroops'],
                (int)$_REQUEST['PunishResourcesBuildings'],
                (int)$_REQUEST['PunishBuildings']);
            $dispatcher->appendContent("<hr><p class='error center'>Player punished!</p><hr>");;
        }
        $userData = $userData->fetch_assoc();
        $params['banList'] = isset($_REQUEST['ref']) && $_REQUEST['ref'] == 'bannedList';
        $params['PunishVillage'] = isset($_REQUEST['PunishVillage']) ? (int) $_REQUEST['PunishVillage'] : 0;
        if($params['PunishVillage'] > 0){
            $params['v_name'] = $this->db->fetchScalar("SELECT name from vdata where kid={$params['PunishVillage']}");
        }
        $params['playerName'] = $userData['name'];
        $params['playerId'] = $uid;
        $dispatcher->appendContent(PHPBatchView::render('admin/punishPlayer', $params));
    }

    private function showEditUser($uid)
    {
        $dispatcher = Dispatcher::getInstance();
        $userData = $this->db->query("SELECT * FROM users WHERE id=$uid");
        if (!$userData->num_rows) {
            $dispatcher->appendContent("<hr><p class='error center'>User does not exists!</p><hr>");
            return;
        }
        $userData = $userData->fetch_assoc();
        $statistics = new StatisticsModel();
        $params['playerId'] = $userData['id'];
        $params['playerName'] = $userData['name'];
        $params['oldRank'] = $userData['oldRank'];
        $params['playerRank'] = $statistics->getPlayerRankById($userData['id']);
        $params['allianceTag'] = $userData['aid'] ? ($this->db->fetchScalar("SELECT tag FROM alidata WHERE id={$userData['aid']}")) : '-';
        $params['tribeId'] = max($userData['race'], 1); //for support
        $params['total_villages'] = $userData['total_villages'];
        $params['total_pop'] = $userData['total_pop'];
        $params['email_verified'] = $userData['email_verified'];
        $params['success_adventures_count'] = $userData['success_adventures_count'];
        $params['playerLocation'] = $userData['location'];
        $params['gift_gold'] = $userData['gift_gold'];
        $params['bought_gold'] = $userData['bought_gold'];
        $params['silver'] = $userData['silver'];
        $params['email'] = $userData['email'];
        $params['cp'] = $userData['cp'];
        $params['access'] = $userData['access'];
        $params['desc1'] = $userData['desc1'];
        $params['desc2'] = $userData['desc2'];
        $params['total_attack_points'] = $userData['total_attack_points'];
        $params['total_defense_points'] = $userData['total_defense_points'];
        $params['week_attack_points'] = $userData['week_attack_points'];
        $params['week_defense_points'] = $userData['week_defense_points'];
        $params['week_robber_points'] = $userData['week_robber_points'];
        $params['lastLoginTimeDate'] = TimezoneHelper::autoDateString($userData['last_login_time'], true);
        $params['registrationTimeDate'] = TimezoneHelper::autoDateString($userData['signupTime'], true);
        $params['lastIP'] = null;
        $params['lastIPLocation'] = null;
        $result = $this->db->fetchScalar("SELECT ip FROM log_ip WHERE uid=$uid ORDER BY id DESC LIMIT 1");
        if ($result) {
            $params['lastIP'] = long2ip($result);
            $countryFlag = '-';
            if (function_exists("geoip_country_code_by_name")) {
                $countryFlag = strtoupper(geoip_country_code_by_name($params['lastIP']));
            }
            $params['lastIPLocation'] = isset($this->countryCodes[$countryFlag]) ? $this->countryCodes[$countryFlag] : 'Unknown location';
        }


        $params['IPs'] = [];
        $result = $this->db->query("SELECT DISTINCT ip FROM log_ip WHERE uid=$uid ORDER BY id DESC");
        while($r = $result->fetch_assoc()){
            $params['IPs'][] = long2ip($r['ip']);
        }

        $params['banHistory'] = ['total' => '', 'content' => ''];
        $banHistory = $this->db->query("SELECT * FROM banHistory WHERE uid=$uid");
        while ($row = $banHistory->fetch_assoc()) {
            $params['banHistory']['content'] .= '<tr>';
            $params['banHistory']['content'] .= '<td class="hab">' . TimezoneHelper::autoDateString($row['time'],
                    true) . '</td>';
            if (!$row['end']) {
                $params['banHistory']['content'] .= '<td class="hab">Never</td>';
                $params['banHistory']['content'] .= '<td class="hab">Forever</td>';
            } else {
                $params['banHistory']['content'] .= '<td class="hab">' . TimezoneHelper::autoDateString($row['end'],
                        true) . '</td>';
                $params['banHistory']['content'] .= '<td class="hab">' . round((($row['end'] - $row['time']) / 3600),
                        2) . 'h</td>';
            }
            $params['banHistory']['content'] .= '<td class="on">' . $row['reason'] . '</td>';
            $params['banHistory']['content'] .= '</tr>';
        }
        if (!$banHistory->num_rows) {
            $params['banHistory']['content'] = '<tr><td class="hab" colspan="4"><span class="errorMessage">No history!</span></td></tr>';
        }
        $params['banHistory']['total'] = $banHistory->num_rows;
        $params['plusDate'] = TimezoneHelper::date("Y-m-d H:i", $userData['plus']);
        $params['protectionHours'] = $userData['protectionBoughtHours'];
        $params['protectionLastExtend'] = TimezoneHelper::date("Y-m-d H:i", $userData['protectionLastExtend']);
        $params['protectionDate'] = TimezoneHelper::date("Y-m-d H:i", $userData['protection']);
        $params['b1Date'] = TimezoneHelper::date("Y-m-d H:i", $userData['b1']);
        $params['b2Date'] = TimezoneHelper::date("Y-m-d H:i", $userData['b2']);
        $params['b3Date'] = TimezoneHelper::date("Y-m-d H:i", $userData['b3']);
        $params['b4Date'] = TimezoneHelper::date("Y-m-d H:i", $userData['b4']);
        $params['villages'] = null;
        $villages_all = $this->db->query("SELECT * FROM vdata WHERE owner={$uid}");
        while ($row = $villages_all->fetch_assoc()) {
            $xy = Formulas::kid2xy($row['kid']);
            $params['villages'] .= '<tr>';
            $params['villages'] .= '<td><a href="?action=editVillage&kid=' . $row['kid'] . '&r=deleteVillage" onclick="return confirmAction();"><img src="img/x.gif" class="del" title="delete"></a></td>';
            $params['villages'] .= '<td><a href="?action=editVillage&kid=' . $row['kid'] . '">' . $row['name'] . '</a>' . ($row['capital'] ? ' <span class="c">(Capital)</span>' : '') . '</td>';
            $params['villages'] .= '<td>' . $row['pop'] . '</td>';
            $params['villages'] .= '<td>(' . $xy['x'] . '|' . $xy['y'] . ')</td>';
            $params['villages'] .= '</tr>';
        }
        $dispatcher->appendContent(Template::getInstance()->load($params, 'tpl/editUser.tpl')->getAsString());
    }
}