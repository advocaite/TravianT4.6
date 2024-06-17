<?php

namespace Controller;

use Core\Config;
use Core\Database\DB;
use Core\Helper\BBCode;
use Core\Helper\StringChecker;
use Core\Helper\TimezoneHelper;
use Core\Helper\WebService;
use Game\Formulas;
use Game\Map\Map;
use Game\NoticeHelper;
use Model\AllianceBonusModel;
use Model\AllianceModel;
use Model\ArtefactsModel;
use Model\AutomationModel;
use Model\ForumModel;
use Model\MessageModel;
use Model\StatisticsModel;
use resources\View\GameView;
use resources\View\PHPBatchView;

class AllianceCtrl extends GameCtrl
{
    private $selectedAllianceID = 0;
    private $selectedAllianceData = [];

    public function __construct()
    {
        parent::__construct();
        $this->view = new GameView();
        if (!isset($_REQUEST['aid']) && $this->session->getAllianceId() == 0) {
            $this->noAlliance();
        } else {
            $this->view->vars['bodyCssClass'] = 'perspectiveResources';
            $this->view->vars['contentCssClass'] = 'alliance';
            $this->selectedAllianceID = isset($_REQUEST['aid']) ? (int)$_REQUEST['aid'] : $this->session->getAllianceId();
            $db = DB::getInstance();
            $this->selectedAllianceData = /** mysqli_result */
                $db->query("SELECT * FROM alidata WHERE id={$this->selectedAllianceID}");
            if (!$this->selectedAllianceData->num_rows) {
                $this->view->vars['titleInHeader'] = '-';
                return FALSE;
            }
            $isMyAlliance = $this->session->getAllianceId() == $this->selectedAllianceID;
            $this->selectedAllianceData = $this->selectedAllianceData->fetch_assoc();
            $this->view->vars['titleInHeader'] = T("Alliance", "Alliance") . ' - ' . $this->selectedAllianceData['tag'];
            $selectedTabIndex = isset($_REQUEST['s']) ? (int)$_REQUEST['s'] : 1;
            $selectedTabIndex = in_array($selectedTabIndex, [7, 8, 1, 3, 2, 5,]) ? $selectedTabIndex : 1;
            if ($isMyAlliance && !isset($_REQUEST['s'])) {
                $selectedTabIndex = $this->session->getFavoriteTab("alliance");
            }
            if ($isMyAlliance) {
                //append tabs.
                $this->appendTabs($selectedTabIndex);
            }
            if ($selectedTabIndex == 1) {
                $this->showAllianceProfile();
            } else if ($selectedTabIndex == 2) {
                $this->showAllianceForum();
            } else if (!$isMyAlliance) {
                $this->showAllianceProfile();
            }
            if (!$isMyAlliance) {
                return FALSE;
            }
            if ($selectedTabIndex == 7) {
                $this->showAllianceInternalPage();
            } else if ($selectedTabIndex == 3) {
                $this->showAllianceAttacks();
            } else if ($selectedTabIndex == 5) {
                $this->showAllianceOptions();
            } else if ($selectedTabIndex == 8) {
                $this->handleBonuses();
            }
        }
    }

    private function noAlliance()
    {
        $this->view->vars['titleInHeader'] = T("Alliance", "no Alliance");
        $this->view->vars['bodyCssClass'] = 'perspectiveResources';
        $this->view->vars['contentCssClass'] = 'alliance';
        $this->view->vars['content'] .= T("Alliance", "You are currently not in an alliance In order to join an alliance, you need a level 1 Embassy and an invitation");
    }

    private function appendTabs($selectedTabIndex)
    {
        $view = new PHPBatchView("alliance/menu");
        $view->vars['favorTabId'] = $this->session->getFavoriteTab("alliance");
        $view->vars['selectedTabId'] = $selectedTabIndex;
        $view->vars['aid'] = $this->selectedAllianceID;
        $view->vars['isMyAlliance'] = $this->session->getAllianceId() == $this->selectedAllianceID;
        $tab = T("Alliance", [7 => 'Overview', 1 => 'Profile', 3 => 'Attacks', 2 => 'Forum', 5 => 'Options', 8 => 'Bonuses'][$selectedTabIndex]);
        $view->vars['favorText'] = sprintf(T("Alliance", "set x as favor tab"), $tab);
        $view->vars['ForumLink'] = empty($this->selectedAllianceData['forumLink']) ? 'allianz.php?s=2' : $this->selectedAllianceData['forumLink'];
        $this->view->vars['content'] .= $view->output();
    }

    private function showAllianceProfile()
    {
        $action = isset($_GET['action']) && in_array($_GET['action'], ['description', 'members']) ? $_GET['action'] : ($this->session->getFavoriteTab("allyPageProfile") == 0 ? 'description' : 'members');
        if (isset($_POST['a']) && $_POST['a'] == 3 && $this->session->hasAlliancePermission(AllianceModel::CHANGE_ALLIANCE_DESC)) {
            $db = DB::getInstance();
            $_POST['be1'] = $db->real_escape_string(filter_var($_POST['be1'], FILTER_SANITIZE_STRING));
            $_POST['be2'] = $db->real_escape_string(filter_var($_POST['be2'], FILTER_SANITIZE_STRING));
            if (StringChecker::isValidMessage($_POST['be1']) && StringChecker::isValidMessage($_POST['be2'])) {
                $db->query("UPDATE alidata SET desc1='{$_POST['be1']}', desc2='{$_POST['be2']}' WHERE id={$this->selectedAllianceID}");
                $this->selectedAllianceData['desc1'] = $_POST['be1'];
                $this->selectedAllianceData['desc2'] = $_POST['be2'];
            }
        }
        $view = new PHPBatchView("alliance/Profile");
        $view->vars['action'] = $action;
        $view->vars['favorActionId'] = $this->session->getFavoriteTab("allyPageProfile") == 0 ? 'description' : 'members';
        list($view->vars['desc1'], $view->vars['desc2']) = BBCode::BBCodeProfile($this->selectedAllianceData['desc1'], $this->selectedAllianceData['desc2'], TRUE, $this->selectedAllianceID);
        $view->vars['hasPosition'] = FALSE;
        $view->vars['tag'] = $this->selectedAllianceData['tag'];
        $view->vars['name'] = $this->selectedAllianceData['name'];
        $statistics = new StatisticsModel();
        $view->vars['rank'] = $statistics->getAllianceRankById($this->selectedAllianceID);
        $view->vars['aid'] = $this->selectedAllianceID;
        $view->vars['hasForum'] = FALSE;
        if ($this->session->getAllianceId() != $this->selectedAllianceID) {
            $m = new ForumModel();
            $view->vars['hasForum'] = $m->AllianceHasAnyForums($this->selectedAllianceID, $this->session->getPlayerId());
        }
        $view->vars['points'] = 0;
        $view->vars['Members'] = 0;
        $view->vars['MembersHTML'] = '';
        $view->vars['position'] = '';
        $db = DB::getInstance();
        $members = $db->query("SELECT users.id, users.name, users.race, users.vacationActiveTil, users.last_login_time, users.alliance_role, users.alliance_role_name,
        users.total_villages,
        users.total_pop
        FROM users WHERE users.aid={$this->selectedAllianceID} ORDER BY total_pop DESC");
        $rank = 0;
        $isMyAlliance = $this->selectedAllianceID == $this->session->getAllianceId();
        $view->vars['isMyAlliance'] = $isMyAlliance;
        while ($row = $members->fetch_assoc()) {
            ++$rank;
            $view->vars['points'] += $row['total_pop'];
            if ($row['alliance_role_name'] != '') {
                $view->vars['hasPosition'] = TRUE;
                $view->vars['position'] .= '<tr><th>' . $row['alliance_role_name'] . '</th><td><a href="spieler.php?uid=' . $row['id'] . '">' . $row['name'] . '</a></td></tr>';
                //has role!
            }
            $login_stat = '';
            if ($isMyAlliance) {
                $login_stat = AutomationModel::getOnlineStatusAsImg($row['last_login_time']);
            }
            $view->vars['MembersHTML'] .= '<tr>';
            $view->vars['MembersHTML'] .= '<td class="counter">' . $rank . '.</td>';
            $view->vars['MembersHTML'] .= '<td class="tribe"><i class="tribe' . $row['race'] . '_medium"></i></td>';
            $view->vars['MembersHTML'] .= '<td class="player">' . $login_stat . PHP_EOL . '<a href="spieler.php?uid=' . $row['id'] . '">' . $row['name'] . '</a>';
            if ($row['vacationActiveTil'] >= time()) {
                $view->vars['MembersHTML'] .= '<span class="greyInfo">(' . T("Alliance", "in vacation") . ')</span>';
            }
            $view->vars['MembersHTML'] .= '</td>';
            $msg = '<button type="button" value="' . $row['id'] . '" class="icon note editNote" title="' . T('Profile', 'Note') . '" data-spec="0" data-note="1"><img src="img/x.gif" class="" alt="" /></button><button type="button" class="icon sendMessage hover" title="' . T("inGame", "sendMessage") . '" onclick="window.location.href = \'/messages.php?t=1&amp;id=' . $row['id'] . '\'; return false;"><img src="img/x.gif" class="" alt=""></button>';
            if ($row['id'] == $this->session->getPlayerId()) $msg = null;
            $view->vars['MembersHTML'] .= '<td class="population">' . $row['total_pop'] . '</td><td class="villages">' . $row['total_villages'] . '</td><td class="buttons">' . $msg . '</td></tr>';
        }
        $view->vars['Members'] = $rank;
        $this->view->vars['content'] .= $view->output();
    }

    private function showAllianceForum()
    {
        if (!empty($this->selectedAllianceData['forumLink'])) {
            $this->redirect($this->selectedAllianceData['forumLink']);
        }
        $this->view->vars['contentCssClass'] = 'forum';
        $dispatcher = new AllianceForum($this->selectedAllianceID);
        $this->view->vars['content'] .= $dispatcher->render();
    }

    private function showAllianceInternalPage()
    {
        if ($this->selectedAllianceID == $this->session->getAllianceId() && isset($_POST['a']) && $_POST['a'] == 7 && $this->session->hasAlliancePermission(AllianceModel::CHANGE_ALLIANCE_DESC)) {
            $db = DB::getInstance();
            $_POST['info1'] = $db->real_escape_string(filter_var($_POST['info1'], FILTER_SANITIZE_STRING));
            $_POST['info2'] = $db->real_escape_string(filter_var($_POST['info2'], FILTER_SANITIZE_STRING));
            $db->query("UPDATE alidata SET info1='{$_POST['info1']}', info2='{$_POST['info2']}' WHERE id={$this->selectedAllianceID}");
            $_REQUEST['s'] = 7;
            $this->selectedAllianceData['info1'] = $_POST['info1'];
            $this->selectedAllianceData['info2'] = $_POST['info2'];
        }
        $view = new PHPBatchView("alliance/internal");
        $view->vars['internInfo1'] = BBCode::BBCodeInternalPage($this->selectedAllianceData['info1'], $this->selectedAllianceID);
        $view->vars['internInfo2'] = BBCode::BBCodeInternalPage($this->selectedAllianceData['info2'], $this->selectedAllianceID);
        $this->view->vars['content'] .= $view->output();
    }

    private function showAllianceAttacks()
    {
        $view = new PHPBatchView("alliance/attacks");
        $view->vars['fn'] = isset($_GET['fn']) && $_GET['fn'] == 1;
        $valid_report_types = [
            NoticeHelper::TYPE_WON_AS_ATTACK_WITHOUT_CASUALTIES,
            NoticeHelper::TYPE_WON_AS_ATTACK_WITH_CASUALTIES,
            NoticeHelper::TYPE_LOST_AS_ATTACKER,
            NoticeHelper::TYPE_WON_SPY_WITHOUT_CASUALTIES,
            NoticeHelper::TYPE_WON_SPY_WITH_CASUALTIES,
            NoticeHelper::TYPE_LOST_AS_SPY,
            NoticeHelper::TYPE_WON_DEFENSE_WITHOUT_LOSSES,
            NoticeHelper::TYPE_WON_DEFENSE_WITH_LOSSES,
            NoticeHelper::TYPE_LOST_AS_DEFENDER_WITH_CASUALTIES,
            NoticeHelper::TYPE_LOST_AS_DEFENDER_WITHOUT_CASUALTIES,
            NoticeHelper::TYPE_WON_SPY_AS_DEFENDER_REFUSED_ATTACKER_SPY,
            NoticeHelper::TYPE_WON_SPY_AS_DEFENDER_LETTING_ATTACKER_SPY,
        ];
        $filter = isset($_GET['f']) && ($_GET['f'] == 31 || $_GET['f'] == 32 || in_array($_GET['f'], $valid_report_types)) ? (int)$_GET['f'] : -1;
        $view->vars['filter'] = $filter;
        $attack_types_31 = [
            NoticeHelper::TYPE_WON_AS_ATTACK_WITHOUT_CASUALTIES,
            NoticeHelper::TYPE_WON_AS_ATTACK_WITH_CASUALTIES,
            NoticeHelper::TYPE_LOST_AS_ATTACKER,
            NoticeHelper::TYPE_WON_SPY_WITHOUT_CASUALTIES,
            NoticeHelper::TYPE_WON_SPY_WITH_CASUALTIES,
            NoticeHelper::TYPE_LOST_AS_SPY,
        ];
        $attack_types_32 = [
            NoticeHelper::TYPE_WON_DEFENSE_WITHOUT_LOSSES,
            NoticeHelper::TYPE_WON_DEFENSE_WITH_LOSSES,
            NoticeHelper::TYPE_LOST_AS_DEFENDER_WITH_CASUALTIES,
            NoticeHelper::TYPE_LOST_AS_DEFENDER_WITHOUT_CASUALTIES,
            NoticeHelper::TYPE_WON_SPY_AS_DEFENDER_REFUSED_ATTACKER_SPY,
            NoticeHelper::TYPE_WON_SPY_AS_DEFENDER_LETTING_ATTACKER_SPY,
        ];
        if ($filter == 31) {
            $attack_types = $attack_types_31;
        } else if ($filter == 32) {
            $attack_types = $attack_types_32;
        } else if ($filter == -1) {
            $attack_types = $valid_report_types;
        } else {
            $attack_types = [(int)$_GET['f']];
        }
        $view->vars['attacks'] = '';
        $db = DB::getInstance();
        $alliances = [$this->selectedAllianceID];
        if ($view->vars['fn']) {
            $reports = $db->query("SELECT * FROM ndata WHERE aid IN (" . implode(",", $alliances) . ") AND losses>0 AND type IN(" . implode(",", $attack_types) . ") ORDER BY id DESC LIMIT 20");
        } else {
            $reports = $db->query("SELECT * FROM ndata WHERE aid IN (" . implode(",", $alliances) . ") AND type IN(" . implode(",", $attack_types) . ") ORDER BY id DESC LIMIT 20");
        }
        $ctrl = new BerichteCtrl();
        $total = 0;
        while ($row = $reports->fetch_assoc()) {
            $data = NoticeHelper::parseReport($row['type'], $row['data']);
            if (in_array($attack_types, $attack_types_32)) {
                $uid = isset($data['defender'][0]['uid']) ? $data['defender'][0]['uid'] : 0;
                //we are defender
            } else {
                $uid = isset($data['attacker']['uid']) ? $data['attacker']['uid'] : 0;
                //we are the attacker.
                if ($view->vars['fn'] && (array_sum($data['attacker']['num']) < 100 || !array_sum($data['attacker']['dead']))) {
                    continue;
                }
            }
            $view->vars['attacks'] .= '<tr>';
            $aid = (int)$db->fetchScalar("SELECT aid FROM users WHERE id=$uid");
            $title = $ctrl->getNoticeSubject($row, FALSE, TRUE);
            $view->vars['attacks'] .= '<td class="sub"><a href="allianz.php?s=3&amp;f=' . $row['type'] . '&amp;fn=' . $view->vars['fn'] . '"><img src="img/x.gif" class="iReport iReport' . $row['type'] . '" alt="' . T("Reports",
                    "reportTypes." . $row['type']) . '"></a><div><a href="reports.php?id=' . $row['id'] . ($row['uid'] == $this->session->getPlayerId() ? '|b4d1c687' : '') . '">' . $title . '</a></div></td>';
            $view->vars['attacks'] .= '<td class="al">';
            if (!$aid) {
                $view->vars['attacks'] .= '-';
            } else {
                $tag = $db->fetchScalar("SELECT tag FROM alidata WHERE id=$aid");
                if ($tag) {
                    $view->vars['attacks'] .= '<a href="allianz.php?aid="' . $aid . '">' . $tag . '</a>';
                } else {
                    $view->vars['attacks'] .= '-';
                }
            }
            $view->vars['attacks'] .= '</td><td class="dat">' . TimezoneHelper::autoDateString($row['time'],
                    TRUE) . '</td>';
            $view->vars['attacks'] .= '</td></tr>';
            ++$total;
        }
        if (!$total) {
            $view->vars['attacks'] = '<tr><td colspan="3" class="noData">' . T("Alliance", "noReports") . '</td></tr>';
        }
        $this->view->vars['content'] .= $view->output();
    }

    private function showAllianceOptions()
    {
        if ($this->session->isSitter()) {
            return null;
        }
        if (!isset($_REQUEST['o'])) {
            $this->showAllianceOptionMenus();
            return null;
        }
        $session = $this->session;
        $option = (int)$_REQUEST['o'];
        if ($option == 100 && $session->hasAlliancePermission(AllianceModel::CHANGE_ALLIANCE_DESC)) {
            $this->processAllianceChangeName();
        }
        if ($option == 3 && $session->hasAlliancePermission(AllianceModel::CHANGE_ALLIANCE_DESC)) {
            $this->processAllianceChangeDesc();
        }
        if ($option == 7 && $session->hasAlliancePermission(AllianceModel::CHANGE_ALLIANCE_DESC)) {
            $this->processChangeAllianceInfo();
        }
        if ($option == 1 && $session->hasAlliancePermission(AllianceModel::ASSIGN_TO_POSITION)) {
            $this->processAssignPosition();
        }
        if ($option == 4 && $session->hasAlliancePermission(AllianceModel::INVITE_PLAYER) && !Config::getInstance()->dynamic->serverFinished) {
            $this->showAllianceInviting();
        }
        if ($option == 5 && $session->hasAlliancePermission(AllianceModel::MANAGE_FORUM)) {
            $this->processForumLink();
        }
        ///  kick.
        if ($option == 6 && $session->hasAlliancePermission(AllianceModel::ALLIANCE_DIPLOMACY)) {
            $this->processAllianceDiplomacy();
        }
        if ($option == 2 && $session->hasAlliancePermission(AllianceModel::KICK_PLAYER) && !Config::getInstance()->dynamic->serverFinished) {
            $this->showAllianceKick();
        }
        if ($option == 11) {
            $this->quitAlliance();
        }
        return null;
    }

    private function showAllianceOptionMenus()
    {
        $view = new PHPBatchView("alliance/options");
        $m = new AllianceModel();
        $embassy = $m->getMaxPlayerEmbassyLvl($this->session->getPlayerId());
        $view->vars['hasEmbassy'] = $embassy > 0;
        $view->vars['finish'] = Config::getInstance()->dynamic->serverFinished;
        $view->vars['options']['perm'] = [
            $this->session->hasAlliancePermission(AllianceModel::CHANGE_ALLIANCE_DESC),
            $this->session->hasAlliancePermission(AllianceModel::ASSIGN_TO_POSITION),
            $this->session->hasAlliancePermission(AllianceModel::MANAGE_FORUM),
            $this->session->hasAlliancePermission(AllianceModel::INVITE_PLAYER),
            $this->session->hasAlliancePermission(AllianceModel::ALLIANCE_DIPLOMACY),
            $this->session->hasAlliancePermission(AllianceModel::KICK_PLAYER),
        ];
        $view->vars['options']['total'] = +($this->session->hasAlliancePermission(AllianceModel::CHANGE_ALLIANCE_DESC) ? 1 : 0) + ($this->session->hasAlliancePermission(AllianceModel::ASSIGN_TO_POSITION) ? 1 : 0) + ($this->session->hasAlliancePermission(AllianceModel::MANAGE_FORUM) ? 1 : 0);
        $this->view->vars['content'] .= $view->output();
    }

    private function processAllianceChangeName()
    {
        //change name.
        $db = DB::getInstance();
        $view = new PHPBatchView("alliance/optionChangeName");
        $view->vars['tag'] = $this->selectedAllianceData['tag'];
        $view->vars['name'] = $this->selectedAllianceData['name'];
        if (isset($_POST['a']) && $_POST['a'] == 100) {
            $view->vars['tag'] = $_POST['ally1'] = $db->real_escape_string(filter_var($_POST['ally1'], FILTER_SANITIZE_STRING));
            $view->vars['name'] = $_POST['ally2'] = $db->real_escape_string(filter_var($_POST['ally2'], FILTER_SANITIZE_STRING));
            if (StringChecker::isValidName($view->vars['tag']) && StringChecker::isValidName($view->vars['name'])) {
                //do what!
                if (empty($view->vars['tag'])) {
                    $view->vars['tagError'] = T("Alliance", "Enter tag");
                } else {
                    $tag = $db->real_escape_string($view->vars['tag']);
                    $tag = 0 < $db->fetchScalar("SELECT COUNT(id) FROM alidata WHERE tag='$tag' AND id!={$this->selectedAllianceID}");
                    if ($tag) {
                        $view->vars['tagError'] = T("Alliance", "Tag exists");
                    }
                    if (strlen($view->vars['tag']) > 8) {
                        $view->vars['tagError'] = T("Alliance", "Tag too long");
                    }
                }
                if (empty($view->vars['name'])) {
                    $view->vars['nameError'] = T("Alliance", "Enter name");
                } else if (strlen($view->vars['name']) > 25) {
                    $view->vars['nameError'] = T("Alliance", "Name too long");
                }
                if (!isset($view->vars['nameError']) && !isset($view->vars['tagError']) && strlen($view->vars['tag']) <= 8 && strlen($view->vars['name']) <= 25) {
                    $tag = $db->real_escape_string($view->vars['tag']);
                    $db->query("UPDATE alidata SET name='{$view->vars['name']}', tag='$tag' WHERE id={$this->selectedAllianceID}");
                    $view->vars['note'] = T("Alliance", "Changes saved");
                }
            }
        }
        $this->view->vars['content'] .= $view->output();
    }

    private function processAllianceChangeDesc()
    {
        $view = new PHPBatchView("alliance/optionChangeDesc");
        $db = DB::getInstance();
        $view->vars['desc1'] = $this->selectedAllianceData['desc1'];
        $view->vars['desc2'] = $this->selectedAllianceData['desc2'];
        $medals = $db->query("SELECT * FROM allimedal WHERE aid={$this->selectedAllianceID} ORDER BY week, category");
        $view->vars['hasMedal'] = $medals->num_rows > 0;
        $view->vars['medals'] = '';
        while ($row = $medals->fetch_assoc()) {
            $view->vars['medals'] .= '<tr>';
            $view->vars['medals'] .= '<td class="typ">' . BBCode::getMedalCategory($row['category']) . '</td>';
            $view->vars['medals'] .= '<td class="ra">' . $row['rank'] . '</td>';
            $view->vars['medals'] .= '<td class="we">' . $row['week'] . '</td>';
            $view->vars['medals'] .= '<td class="bb">[#' . $row['id'] . ']</td>';
            $view->vars['medals'] .= '</tr>';
        }
        $this->view->vars['content'] .= $view->output();
    }

    private function processChangeAllianceInfo()
    {
        $view = new PHPBatchView("alliance/changeInternalPage");
        $view->vars['info1'] = $this->selectedAllianceData['info1'];
        $view->vars['info2'] = $this->selectedAllianceData['info2'];
        $view->vars['buttonId'] = get_button_id();
        $this->view->vars['content'] .= $view->output();
    }

    private function processAssignPosition()
    {
        $db = DB::getInstance();
        $view = new PHPBatchView("alliance/optionAssignPosition");
        if (WebService::isPost()) {
            $rights = $_POST['rights'];
            if (is_array($rights)) {
                foreach ($rights as $uid => $right) {
                    $permission = 0;
                    if (isset($right['e1']) && $right['e1']) {
                        $permission |= AllianceModel::ASSIGN_TO_POSITION;
                    }
                    if (isset($right['e2']) && $right['e2']) {
                        $permission |= AllianceModel::KICK_PLAYER;
                    }
                    if (isset($right['e3']) && $right['e3']) {
                        $permission |= AllianceModel::CHANGE_ALLIANCE_DESC;
                    }
                    if (isset($right['e6']) && $right['e6']) {
                        $permission |= AllianceModel::ALLIANCE_DIPLOMACY;
                    }
                    if (isset($right['e7']) && $right['e7']) {
                        $permission |= AllianceModel::IGM_MESSAGE;
                    }
                    if (isset($right['e4']) && $right['e4']) {
                        $permission |= AllianceModel::INVITE_PLAYER;
                    }
                    if (isset($right['e5']) && $right['e5']) {
                        $permission |= AllianceModel::MANAGE_FORUM;
                    }
                    if (isset($right['e9']) && $right['e9']) {
                        $permission |= AllianceModel::MANAGE_MARKS;
                    }
                    $rang = $db->real_escape_string(filter_var($right['rang'], FILTER_SANITIZE_STRING));
                    if (strlen($rang) > 20) {
                        continue;
                    }
                    $db->query("UPDATE users SET alliance_role={$permission}, alliance_role_name='{$rang}' WHERE aid={$this->selectedAllianceID} AND id=$uid");
                }
                $view->vars['note'] = T("Alliance", "Changes saved");
            }
        }
        $view->vars['newRights'] = '';
        $membersWithPermission = $db->query("SELECT id, name, alliance_role, alliance_role_name FROM users WHERE aid={$this->selectedAllianceID}");
        $view->vars['membersWithPermission'] = '';
        while ($row = $membersWithPermission->fetch_assoc()) {
            $view->vars['membersWithPermission'] .= '<tr>';
            $view->vars['membersWithPermission'] .= '<td class="name">' . $row['name'] . '</td>';
            $hasPermission = ($row['alliance_role'] & AllianceModel::ASSIGN_TO_POSITION);
            $view->vars['membersWithPermission'] .= '<td class="right"><input class="check" type="checkbox" name="rights[' . $row['id'] . '][e1]" value="1" ' . ($hasPermission ? 'checked="checked"' : '') . ' /></td>';
            $hasPermission = ($row['alliance_role'] & AllianceModel::KICK_PLAYER);
            $view->vars['membersWithPermission'] .= '<td class="right"><input class="check" type="checkbox" name="rights[' . $row['id'] . '][e2]" value="1" ' . ($hasPermission ? 'checked="checked"' : '') . ' /></td>';
            $hasPermission = ($row['alliance_role'] & AllianceModel::CHANGE_ALLIANCE_DESC);
            $view->vars['membersWithPermission'] .= '<td class="right"><input class="check" type="checkbox" name="rights[' . $row['id'] . '][e3]" value="1" ' . ($hasPermission ? 'checked="checked"' : '') . ' /></td>';
            $hasPermission = ($row['alliance_role'] & AllianceModel::ALLIANCE_DIPLOMACY);
            $view->vars['membersWithPermission'] .= '<td class="right"><input class="check" type="checkbox" name="rights[' . $row['id'] . '][e6]" value="1" ' . ($hasPermission ? 'checked="checked"' : '') . ' /></td>';
            $hasPermission = ($row['alliance_role'] & AllianceModel::IGM_MESSAGE);
            $view->vars['membersWithPermission'] .= '<td class="right"><input class="check" type="checkbox" name="rights[' . $row['id'] . '][e7]" value="1" ' . ($hasPermission ? 'checked="checked"' : '') . ' /></td>';
            $hasPermission = ($row['alliance_role'] & AllianceModel::INVITE_PLAYER);
            $view->vars['membersWithPermission'] .= '<td class="right"><input class="check" type="checkbox" name="rights[' . $row['id'] . '][e4]" value="1" ' . ($hasPermission ? 'checked="checked"' : '') . ' /></td>';
            $hasPermission = ($row['alliance_role'] & AllianceModel::MANAGE_FORUM);
            $view->vars['membersWithPermission'] .= '<td class="right"><input class="check" type="checkbox" name="rights[' . $row['id'] . '][e5]" value="1" ' . ($hasPermission ? 'checked="checked"' : '') . ' /></td>';
            $hasPermission = ($row['alliance_role'] & AllianceModel::MANAGE_MARKS);
            $view->vars['membersWithPermission'] .= '<td class="right"><input class="check" type="checkbox" name="rights[' . $row['id'] . '][e9]" value="1" ' . ($hasPermission ? 'checked="checked"' : '') . ' /></td>';
            $view->vars['membersWithPermission'] .= '<td class="title"><input class="text" type="text" name="rights[' . $row['id'] . '][rang]" value="' . $row['alliance_role_name'] . '" maxlength="20" /></td>';
            $view->vars['membersWithPermission'] .= '</tr>';

        }
        $this->view->vars['content'] .= $view->output();
    }

    private function showAllianceInviting()
    {
        $disAllowInvite = getGame("disallowAllianceInviteAfterWWRelease") && ArtefactsModel::wwPlansReleased();
        $view = new PHPBatchView("alliance/optionInvite");
        $view->vars['disallowInvite'] = $disAllowInvite;
        $db = DB::getInstance();
        if (WebService::isPost() && !$disAllowInvite) {
            $a_name = filter_var($_POST['a_name'], FILTER_SANITIZE_STRING);
            $m = new AllianceModel();
            $uid = $db->fetchScalar("SELECT id FROM users WHERE name='{$a_name}'");
            if (!$uid || $uid == $this->session->getPlayerId()) {
                $view->vars['error'] = sprintf(T("Alliance", 'The player x does`t exists'), $a_name);
            } else {
                $aid = $db->fetchScalar("SELECT aid FROM users WHERE id=$uid");
                if (!($aid == $this->selectedAllianceID)) {
                    $result = $m->sendInvite($this->session->getPlayerId(), $this->selectedAllianceID, $uid);
                    if ($result == 1) {
                        $view->vars['error'] = sprintf(T("Alliance", "test has already received an invitation"), $a_name);
                    } else {
                        $view->vars['note'] = sprintf(T("Alliance", 'invite sent to x'), $a_name);
                    }
                }

            }
        }
        if (isset($_GET['d'])) {
            $result = $db->query("SELECT * FROM ali_invite WHERE id=" . (int)$_GET['d']);
            if ($result->num_rows) {
                $row = $result->fetch_assoc();
                $name = $db->fetchScalar("SELECT name FROM users WHERE id={$row['uid']}");
                if ($name) {
                    $allianceNotificationEnabled = $db->fetchScalar("SELECT allianceNotificationEnabled FROM users WHERE id={$row['uid']}");
                    if ($allianceNotificationEnabled) {
                        $now = time();
                        $sentBefore = $db->fetchScalar("SELECT COUNT(id) FROM alliance_notification WHERE aid={$this->selectedAllianceID} AND to_uid={$row['uid']} AND type=2 AND $now-time <= 86400*2");
                        if (!$sentBefore) {
                            $data = [
                                $name,
                                $this->selectedAllianceData['name'],
                                $this->session->getName(),
                            ];
                            (new MessageModel())->sendMessage(1, $row['uid'], '', serialize($data), 2);
                            $db->query("INSERT INTO alliance_notification (aid, to_uid, type, time) VALUES ({$this->selectedAllianceID}, {$row['uid']}, 2, $now)");
                        }
                    }
                }
                if ($row['aid'] == $this->selectedAllianceID) {
                    $db->query("DELETE FROM ali_invite WHERE id=" . (int)$_GET['d']);
                }
            }
        }
        $view->vars['invitations'] = '';
        $invitations = $db->query("SELECT * FROM ali_invite WHERE aid={$this->selectedAllianceID}");
        while ($row = $invitations->fetch_assoc()) {
            $name = $db->fetchScalar("SELECT name FROM users WHERE id='{$row['uid']}'");
            $view->vars['invitations'] .= '<tr>
				<td class="abo">
					<button type="button" class="icon " title="' . T("Alliance",
                    "draw back") . '" onclick="window.location.href = \'allianz.php?o=4&amp;s=5&amp;d=' . $row['id'] . '\'; return false;">
					<img src="img/x.gif" class="del" alt="del" /></button>				</td>
				<td>
					<a href="spieler.php?uid=' . $row['uid'] . '">' . sprintf(T("Alliance", "invitation for x"),
                    $name) . '</a>
				</td>
			</tr>';
        }
        if (!$invitations->num_rows) {
            $view->vars['invitations'] = '<tr><td class="noData">' . T("Alliance", "none") . '</td></tr>';
        }
        $this->view->vars['content'] .= $view->output();
    }

    private function processForumLink()
    {
        $view = new PHPBatchView("alliance/optionLinkToForum");
        if (WebService::isPost()) {
            $view->vars['f_link'] = $this->selectedAllianceData['forumLink'] = $_POST['f_link'] = filter_var($_POST['f_link'],
                FILTER_SANITIZE_URL);
            if (strlen($view->vars['f_link']) <= 200) {
                $db = DB::getInstance();
                $view->vars['f_link'] = $db->real_escape_string($view->vars['f_link']);
                $db->query("UPDATE alidata SET forumLink='{$view->vars['f_link']}' WHERE id={$this->selectedAllianceID}");
            }
        }
        $view->vars['f_link'] = $this->selectedAllianceData['forumLink'];
        $this->view->vars['content'] .= $view->output();
    }

    private function processAllianceDiplomacy()
    {
        $view = new PHPBatchView("alliance/diplomacy");
        $db = DB::getInstance();
        if (WebService::isPost() && isset($_POST['dipl']) && $_POST['dipl'] >= 1 && $_POST['dipl'] <= 3) {
            $aTag = $db->real_escape_string(filter_var($_POST['a_name'], FILTER_SANITIZE_STRING));
            $aid = (int)$db->fetchScalar("SELECT id FROM alidata WHERE tag='{$aTag}'");
            $dipl = (int)$_POST['dipl'];
            if (!$aid) {
                $view->vars['error'] = sprintf(T("Alliance", "Alliance x does not exists"), $aTag);
            } else {
                $count = (int)$db->fetchScalar("SELECT COUNT(id) FROM diplomacy WHERE
                (aid1={$this->selectedAllianceID} AND aid2=$aid)
                OR (aid2={$this->selectedAllianceID} AND aid1=$aid)
                ");
                if ($count > 0) {
                    $view->vars['error'] = sprintf(T("Alliance", "There is already an offer"), $aTag);
                } else {
                    $db->query("INSERT INTO diplomacy (aid1, aid2, type, accepted) VALUES ({$this->selectedAllianceID}, {$aid}, $dipl, 0)");
                    $type = $dipl == 1 ? AllianceModel::LOG_DIPLOMACY_CONF : ($dipl == 2 ? AllianceModel::LOG_DIPLOMACY_NAP : AllianceModel::LOG_DIPLOMACY_WAR);
                    $m = new AllianceModel();
                    $m->addLog($this->selectedAllianceID, [$type, $this->selectedAllianceID, $aid], time());
                    $m->addLog($aid, [$type, $this->selectedAllianceID, $aid], time());
                }
            }
        }
        if (isset($_GET['a'])) {
            //accept
            $find = $db->query("SELECT * FROM diplomacy WHERE accepted=0 AND aid2={$this->selectedAllianceID} AND id=" . (int)$_GET['a']);
            if ($find->num_rows) {
                //yes! accept it
                $row = $find->fetch_assoc();
                $db->query("UPDATE diplomacy SET accepted=1 WHERE id=" . (int)$_GET['a']);
                $m = new AllianceModel();
                $dipl = $row['type'];
                $type = $dipl == 1 ? AllianceModel::LOG_DIPLOMACY_CONF_ACCEPTED : ($dipl == 2 ? AllianceModel::LOG_DIPLOMACY_NAP_ACCEPTED : AllianceModel::LOG_DIPLOMACY_WAR_ACCEPTED);
                $m->addLog($row['aid1'], [$type, $row['aid1'], $row['aid2'],], time());
                $m->addLog($row['aid2'], [$type, $row['aid1'], $row['aid2'],], time());
                Map::allianceDiplomacyCacheUpdate($row['aid1'], $row['aid2']);
            }
        }
        if (isset($_GET['d'])) {
            //accept
            $find = $db->query("SELECT * FROM diplomacy WHERE accepted=0 AND aid1={$this->selectedAllianceID} AND id=" . (int)$_GET['d']);
            if ($find->num_rows) {
                //yes! accept it
                $row = $find->fetch_assoc();
                $db->query("DELETE FROM diplomacy WHERE id=" . (int)$_GET['d']);
                $m = new AllianceModel();
                $dipl = $row['type'];
                $type = $dipl == 1 ? AllianceModel::LOG_DIPLOMACY_CONF_REFUSE : ($dipl == 2 ? AllianceModel::LOG_DIPLOMACY_NAP_REFUSE : AllianceModel::LOG_DIPLOMACY_WAR_REFUSE);
                $m->addLog($row['aid1'], [$type, $row['aid1'], $row['aid2'],], time());
                $m->addLog($row['aid2'], [$type, $row['aid1'], $row['aid2'],], time());
                Map::allianceDiplomacyCacheUpdate($row['aid1'], $row['aid2']);
            }
        }
        if (isset($_GET['c'])) {
            //accept
            $find = $db->query("SELECT * FROM diplomacy WHERE accepted=1 AND (aid1={$this->selectedAllianceID} OR aid2={$this->selectedAllianceID}) AND id=" . (int)$_GET['c']);
            if ($find->num_rows) {
                //yes! accept it
                $row = $find->fetch_assoc();
                $db->query("DELETE FROM diplomacy WHERE id=" . (int)$_GET['c']);
                Map::allianceDiplomacyCacheUpdate($row['aid1'], $row['aid2']);
            }
        }
        $view->vars['ownOffers'] = '';
        $ownOffers = $db->query("SELECT * FROM diplomacy WHERE accepted=0 AND aid1={$this->selectedAllianceID}");
        while ($row = $ownOffers->fetch_assoc()) {
            if ($row['type'] == 1) {
                $text = T("Alliance", "confederacy with x");
            } else if ($row['type'] == 2) {
                $text = T("Alliance", "NAP with x");
            } else {
                $text = T("Alliance", "war with x");
            }
            $tag = $db->fetchScalar("SELECT tag FROM alidata WHERE id='{$row['aid2']}'");
            $view->vars['ownOffers'] .= '<tr>
        <td class="abo">
            <button type="button" class="icon " title="' . T("Alliance",
                    "draw back") . '" onclick="window.location.href = \'allianz.php?o=6&amp;s=5&amp;d=' . $row['id'] . '\'; return false;"><img src="img/x.gif" class="del" alt="del" /></button>
        </td>
        <td>
            <a href="allianz.php?aid=' . $row['aid2'] . '">' . sprintf($text, $tag) . '</a>
        </td>
    </tr>';
        }
        if (empty($view->vars['ownOffers'])) {
            $view->vars['ownOffers'] = '<tr><td class="noData">' . T("Alliance", "none") . '</td></tr>';
        }
        $view->vars['foreign'] = '';
        $ownOffers = $db->query("SELECT * FROM diplomacy WHERE accepted=0 AND aid2={$this->selectedAllianceID}");
        while ($row = $ownOffers->fetch_assoc()) {
            if ($row['type'] == 1) {
                $text = T("Alliance", "confederacy with x");
            } else if ($row['type'] == 2) {
                $text = T("Alliance", "NAP with x");
            } else {
                $text = T("Alliance", "war with x");
            }
            $tag = $db->fetchScalar("SELECT tag FROM alidata WHERE id='{$row['aid1']}'");
            $view->vars['foreign'] .= '<tr>
        <td class="abo">
            <button type="button" class="icon " title="' . T("Alliance",
                    "draw back") . '" onclick="window.location.href = \'allianz.php?o=6&amp;s=5&amp;d=' . $row['id'] . '\'; return false;"><img src="img/x.gif" class="del" alt="del" /></button>
                    &nbsp;
                    <button type="button" class="icon " title="' . T("Alliance",
                    "accept") . '" onclick="window.location.href = \'allianz.php?o=6&amp;s=5&amp;a=' . $row['id'] . '\'; return false;"><img src="img/x.gif" class="accept" alt="accept" /></button>

        </td>
        <td>
            <a href="allianz.php?aid=' . $row['aid1'] . '">' . sprintf($text, $tag) . '</a>
        </td>
    </tr>';
        }
        if (empty($view->vars['foreign'])) {
            $view->vars['foreign'] = '<tr><td class="noData">' . T("Alliance", "none") . '</td></tr>';
        }
        $view->vars['exiting'] = '';
        $ownOffers = $db->query("SELECT * FROM diplomacy WHERE accepted=1 AND (aid1={$this->selectedAllianceID} OR aid2={$this->selectedAllianceID})");
        while ($row = $ownOffers->fetch_assoc()) {
            if ($row['type'] == 1) {
                $text = T("Alliance", "confederacy with x");
            } else if ($row['type'] == 2) {
                $text = T("Alliance", "NAP with x");
            } else {
                $text = T("Alliance", "war with x");
            }
            $tag = $db->fetchScalar("SELECT tag FROM alidata WHERE id='{$row['aid1']}'");
            $view->vars['exiting'] .= '<tr>
        <td class="abo">
            <button type="button" class="icon " title="' . T("Alliance",
                    "draw back") . '" onclick="window.location.href = \'allianz.php?o=6&amp;s=5&amp;c=' . $row['id'] . '\'; return false;"><img src="img/x.gif" class="del" alt="del" /></button>

        </td>
        <td>
            <a href="allianz.php?aid=' . $row['aid1'] . '">' . sprintf($text, $tag) . '</a>
        </td>
    </tr>';
        }
        if (empty($view->vars['exiting'])) {
            $view->vars['exiting'] = '<tr><td class="noData">' . T("Alliance", "none") . '</td></tr>';
        }
        $this->view->vars['content'] .= $view->output();
    }

    private function showAllianceKick()
    {
        $disAllowKick = getGame("disallowAllianceKickAfterWWRelease") && ArtefactsModel::wwPlansReleased();
        $db = DB::getInstance();
        if (WebService::isPost() && isset($_POST['a_user']) && !$disAllowKick) {
            $view = new PHPBatchView("alliance/optionKickConfirm");
            $view->vars['error'] = '';
            $view->vars['a_user'] = (int)$_POST['a_user'];
            $view->vars['confirmed'] = FALSE;
            if (isset($_POST['pw']) && sha1($_POST['pw']) != $_SESSION[WebService::fixSessionPrefix('pw')]) {
                $view->vars['error'] = T("Alliance", "wrongPassword");
            } else if (isset($_POST['pw']) && sha1($_POST['pw']) == $_SESSION[WebService::fixSessionPrefix('pw')]) {
                //kick it!
                if ($this->session->getPlayerId() != (int)$_POST['a_user']) {
                    $name = $db->fetchScalar("SELECT name FROM users WHERE aid={$this->selectedAllianceID} AND id=" . (int)$_POST['a_user']);
                    if ($name) {
                        $m = new AllianceModel();
                        $m->kickPlayer($this->session->getPlayerId(),
                            (int)$_POST['a_user'],
                            $this->selectedAllianceID);
                        $view->vars['confirmed'] = TRUE;
                        $view->vars['error'] = sprintf(T("Alliance", 'x has been kicked from the alliance'), $name);
                    } else {
                        $this->redirect("allianz.php?!!1");
                    }
                }
            }
            $this->view->vars['content'] .= $view->output();
            return;
        }
        $view = new PHPBatchView("alliance/optionKick");
        $view->vars['disallowKick'] = $disAllowKick;
        $members = $db->query("SELECT id, name FROM users WHERE aid={$this->selectedAllianceID}");
        $view->vars['members'] = '';
        $view->vars['hasMembers'] = FALSE;
        while ($row = $members->fetch_assoc()) {
            if ($row['id'] <> $this->session->getPlayerId()) {
                $view->vars['hasMembers'] = TRUE;
                $view->vars['members'] .= '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
            }
        }
        $this->view->vars['content'] .= $view->output();
    }

    private function quitAlliance()
    {
        $m = new AllianceModel();
        $embassy = $m->getMaxPlayerEmbassyLvl($this->session->getPlayerId());
        if ($embassy == 0) return;
        $link = 'build.php?gid=18';
        if ($embassy['kid'] <> $this->session->village->getKid()) {
            $link .= '&newdid=' . $embassy['kid'];
        }
        $link .= '&action=leave';
        $this->redirect($link);
    }

    private function handleBonuses()
    {
        $view = new PHPBatchView("alliance/bonuses/main");
        $m = new AllianceBonusModel();
        $bonuses = $m->getAllianceBonusesLevel($this->selectedAllianceID);
        $available_times = [];
        foreach ($bonuses as $bonus) {
            $available_times[] = Formulas::getAllianceBonusCoolDownForNewPlayers($bonus);
        }
        $max = max($available_times);
        $view->vars['newlyJoined'] = time() - $this->session->getAllianceJoinTime() <= $max;
        $this->view->vars['content'] .= $view->output();
    }
} 