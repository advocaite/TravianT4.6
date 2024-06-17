<?php

namespace Controller\Build;

use function array_values;
use Controller\AnyCtrl;
use Core\Caching\Caching;
use Core\Config;
use Core\Database\DB;
use Core\Helper\StringChecker;
use Core\Helper\WebService;
use Core\Session;
use Core\Village;
use Game\Formulas;
use Model\AllianceModel;
use Model\MessageModel;
use resources\View\PHPBatchView;
use Controller\BuildCtrl;

class EmbassyCtrl extends AnyCtrl
{
    public function __construct(BuildCtrl $build)
    {
        parent::__construct();
        $this->view = new PHPBatchView("build/embassy");
        $this->view->vars['content'] = null;
        $this->view->vars['showTabs'] = Village::getInstance()->getField($build->selectedBuildingIndex)['level'] > 0;
        if(0 == Village::getInstance()->getField($build->selectedBuildingIndex)['level']){
            return;
        }
        $this->view->vars['buildingIndex'] = $build->selectedBuildingIndex;
        $this->view->vars['hasAlliance'] = Session::getInstance()->getAllianceId();
        $this->view->vars['favorTab'] = $this->view->vars['action'] = Session::getInstance()->getFavoriteTab('embassyBuildingSubTabs');
        if (isset($_REQUEST['action'])) {
            $arr = $this->view->vars['hasAlliance'] ? ['info', 'leave'] : ['find', 'join', 'found'];
            if (in_array($_REQUEST['action'], $arr)) {
                $this->view->vars['action'] = $_REQUEST['action'];
            }
        }
        switch ($this->view->vars['action']) {
            case 'info':
                if (!Session::getInstance()->getAllianceId()) {
                    return;
                }
                $this->info();
                break;
            case 'leave':
                if (!Session::getInstance()->getAllianceId()) {
                    return;
                }
                $this->leave();
                break;
            case 'find':
                if (Session::getInstance()->getAllianceId()) {
                    return;
                }
                $this->find();
                break;
            case 'join':
                if (Session::getInstance()->getAllianceId()) {
                    return;
                }
                $this->join();
                break;
            case 'found':
                if (Session::getInstance()->getAllianceId()) {
                    return;
                }
                $this->found();
                break;
        }
    }

    private function info()
    {
        $view = new PHPBatchView("embassy/info");
        $db = DB::getInstance();
        $alliance = $db->query("SELECT tag, name FROM alidata WHERE id={$this->view->vars['hasAlliance']}")->fetch_assoc();
        $view->vars['tag'] = $alliance['tag'];
        $view->vars['name'] = $alliance['name'];
        $this->view->vars['content'] = $view->output();
    }

    private function leave()
    {
        $view = new PHPBatchView("embassy/leave");
        $view->vars['aid'] = Session::getInstance()->getAllianceId();
        $this->view->vars['content'] = $view->output();
    }

    private function find()
    {
        $view = new PHPBatchView("embassy/find");
        $db = DB::getInstance();
        $cache = Caching::getInstance();

        $cacheKey = 'alliance_nearby_' . Village::getInstance()->getKid();
        $cacheInterval = 1800;

        if($cache->exists($cacheKey)){
            $alliances = $cache->get($cacheKey);
        } else {
            $xy = Formulas::kid2xy(Village::getInstance()->getKid());
            $totalCoordinate = 1 + (2 * MAP_SIZE);
            $totalCoordinate2 = 1 + (3 * MAP_SIZE);
            $distance = "(SQRT(POW(((w.x-{$xy['x']}+{$totalCoordinate2})%{$totalCoordinate} -" . MAP_SIZE . "), 2) + POW(((w.y-{$xy['y']}+{$totalCoordinate2})%{$totalCoordinate} -" . MAP_SIZE . "), 2)))";
            $result = $db->query("SELECT DISTINCT u.aid `aid` FROM wdata w, users u WHERE w.fieldtype>0 AND w.occupied>0 AND $distance <= 50 AND u.id=(SELECT v.owner FROM vdata v WHERE v.kid=w.id) AND u.aid>0");
            $alliances = [];
            while($row = $result->fetch_assoc()){
                $total_villages_within_50_fields = $db->fetchScalar("SELECT COUNT(w.id) FROM users u, wdata w, vdata v WHERE u.aid={$row['aid']} AND v.owner=u.id AND w.id=v.kid AND $distance <= 50");
                $alliances[] = [
                    'aid' => $row['aid'],
                    'name' => $db->fetchScalar("SELECT name FROM alidata WHERE id={$row['aid']}"),
                    'total_pop' => $db->fetchScalar("SELECT SUM(total_pop) FROM users WHERE aid={$row['aid']}"),
                    'villages' => $total_villages_within_50_fields,
                ];
            }
            usort($alliances, function($a, $b){return ($a['villages'] == $b['villages']) ? 0 : $a['villages'] > $b['villages'] ? -1 : 1;});
            $cache->set($cacheKey, $alliances, $cacheInterval);
        }
        $view->vars['content'] = null;
        foreach($alliances as $alliance){
            $view->vars['content'] .= $this->createFindHTML($alliance['aid'], $alliance['name'], $alliance['total_pop'], $alliance['villages']);
        }
        if(empty($view->vars['content'])){
            $view->vars['content'] = '<tr><td colspan="3" class="noData">'.T('Embassy', 'No nearby alliance found').'</td></tr>';
        }
        $this->view->vars['content'] = $view->output();
    }

    private function join()
    {
        $view = new PHPBatchView("embassy/join");
        $buildingIndex = $this->view->vars['buildingIndex'];
        $view->vars['buildingIndex'] = $buildingIndex;
        $view->vars['tbody'] = null;
        $m = new AllianceModel();
        if (isset($_REQUEST['a']) && isset($_REQUEST['d'])) {
            if ($_REQUEST['a'] == 2) {
                //refuse invite
                $m = new AllianceModel();
                $m->deleteInviteForPlayer(Session::getInstance()->getPlayerId(), (int)$_REQUEST['d']);
            } else if ($_REQUEST['a'] == 3) {
                if (Session::getInstance()->isInVacationMode()) {
                    redirect("options.php?s=4");
                } else {
                    $m = new AllianceModel();
                    $error = $m->acceptInvite(Session::getInstance()->getPlayerId(), (int)$_REQUEST['d']);
                    if ($error === -1) {
                        $view->vars['error'] = T("Buildings", "allianceFull");
                        //alliance is full.
                    } else if ($error === FALSE) {
                        //no invite found!
                    } else {
                        Session::getInstance()->setAllianceId($error);
                        $this->view->vars['hasAlliance'] = $error;
                        $this->view->vars['action'] = 'info';
                        $this->view->vars['favorTab'] = $this->view->vars['action'] = Session::getInstance()->getFavoriteTab('embassyBuildingSubTabs');
                        $this->info();
                        return;
                    }
                }
            }
        }
        $invites = $m->getInvitesForUser(Session::getInstance()->getPlayerId());
        if (!$invites->num_rows) {
            $view->vars['tbody'] = '<tr><td colspan="3" class="noData">' . T("Buildings", "There are no invitations available") . '</td></tr>';
        } else {
            $db = DB::getInstance();
            while ($row = $invites->fetch_assoc()) {
                $view->vars['tbody'] .= '<tr>';
                $view->vars['tbody'] .= '<td>';
                $view->vars['tbody'] .= '<button type="button" class="icon " title="' . T("Buildings", "refuse") . '" onclick="window.location.href = \'build.php?id=' . $buildingIndex . '&action=join&amp;a=2&amp;d=' . $row['id'] . '\'; return false;">';
                $view->vars['tbody'] .= '<img src="img/x.gif" class="del" alt="del" /></button>';
                $view->vars['tbody'] .= '<button type="button" class="icon " title="' . T("Buildings", "accept") . '" onclick="window.location.href = \'build.php?id=' . $buildingIndex . '&action=join&amp;a=3&amp;d=' . $row['id'] . '\'; return false;">';
                $view->vars['tbody'] .= '<img src="img/x.gif" class="accept" alt="accept" /></button>';
                //tag
                $alliance = $db->query("SELECT name, tag FROM alidata WHERE id={$row['aid']}");
                if ($alliance->num_rows) {
                    $alliance = $alliance->fetch_assoc();
                    $tag = $alliance['tag'];
                    $name = $alliance['name'];
                } else {
                    $name = $tag = '?';
                }
                $allianceName = '<a href="allianz.php?aid=' . $row['aid'] . '">' . $name . '</a>';
                $allianceTag = '<a href="allianz.php?aid=' . $row['aid'] . '">' . $tag . '</a>';
                $invitedBy = '<a href="spieler.php?uid=' . $row['from_uid'] . '">' . ((new MessageModel())->getPlayerName($row['from_uid'])) . '</a>';
                $view->vars['tbody'] .= sprintf(T("Embassy", "Alliance %s (%s), invited by %s"), $allianceName, $allianceTag, $invitedBy);
                $view->vars['tbody'] .= '</td>';
                $view->vars['tbody'] .= '</tr>';
            }
        }
        $this->view->vars['content'] = $view->output();
    }

    private function found()
    {
        if (Village::getInstance()->getField($this->view->vars['buildingIndex'])['level'] >= 3) {
            $view = new PHPBatchView("embassy/found");
            $view->vars['errorTag'] = $view->vars['errorName'] = '';
            $view->vars['tbody'] = $view->vars['tag'] = $view->vars['name'] = '';
            $view->vars['buildingIndex'] = $this->view->vars['buildingIndex'];
            if (WebService::isPost()) {
                if (Session::getInstance()->banned()) {
                    $this->innerRedirect("InGameBannedPage");
                } else if (Config::getInstance()->dynamic->serverFinished) {
                    $this->innerRedirect("InGameWinnerPage");
                } else if (Session::getInstance()->isInVacationMode()) {
                    $this->redirect('options.php?s=4');
                }
                if (isset($_POST['ally1'])) {
                    $view->vars['tag'] = filter_var($_POST['ally1'], FILTER_SANITIZE_STRING);
                }
                if (isset($_POST['ally2'])) {
                    $view->vars['name'] = filter_var($_POST['ally2'], FILTER_SANITIZE_STRING);
                }
                if (empty($view->vars['tag']) || empty($view->vars['name'])) {
                    if (empty($view->vars['tag'])) {
                        $view->vars['errorTag'] = T("Buildings", "Enter Tag");
                    }
                    if (empty($view->vars['name'])) {
                        $view->vars['errorName'] = T("Buildings", "Enter Name");
                    }
                    goto finalize;
                }
                if (!empty($view->vars['tag'])) {
                    $db = DB::getInstance();
                    $tag = $db->real_escape_string($view->vars['tag']);
                    $e = $db->fetchScalar("SELECT COUNT(id) FROM alidata WHERE tag='$tag'");
                    if ($e) {
                        $view->vars['errorTag'] = T("Buildings", "Tag exists");
                        goto finalize;
                    }
                }
                if (!StringChecker::isValidName($view->vars['name'])) {
                    $view->vars['errorName'] = T("inGame", "Inadmissible name/message");
                } else if (!StringChecker::isValidName($view->vars['tag'])) {
                    $view->vars['errorTag'] = T("inGame", "Inadmissible name/message");
                } else if (strlen($view->vars['tag']) > 8) {
                    $view->vars['errorTag'] = T("Alliance", "Tag too long");
                } else if (strlen($view->vars['name']) > 25) {
                    $view->vars['errorTag'] = T("Alliance", "Name too long");
                } else if (strlen($view->vars['tag']) <= 8 && strlen($view->vars['name']) <= 25) {
                    $m = new AllianceModel();
                    $aid = $m->createAlliance(Session::getInstance()->getPlayerId(), $view->vars['name'], $view->vars['tag']);
                    Session::getInstance()->setAllianceId($aid);
                    $this->view->vars['hasAlliance'] = $aid;
                    $this->view->vars['action'] = 'info';
                    $this->view->vars['favorTab'] = $this->view->vars['action'] = Session::getInstance()->getFavoriteTab('embassyBuildingSubTabs');
                    $this->info();
                    return;
                }
            }
            finalize:
            $this->view->vars['content'] = $view->output();
        } else {
            $view = new PHPBatchView("embassy/found_embassy_level_low");
            $this->view->vars['content'] = $view->output();
        }
    }

    private function createFindHTML($aid, $name, $pop, $villages_within_50_fields)
    {
        return '<tr><td><a href="allianz.php?aid=' . $aid . '" title="">' . $name . '</a></td><td>' . $pop . '</td><td>' . $villages_within_50_fields . '</td></tr>';
    }
} 