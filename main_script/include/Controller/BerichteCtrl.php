<?php

namespace Controller;

use Controller\Build\TreasuryCtrl;
use Core\Database\DB;
use Core\Helper\PageNavigator;
use Core\Helper\TimezoneHelper;
use Core\Helper\WebService;
use Core\Session;
use const FILTER_SANITIZE_STRING;
use function filter_var;
use Game\Formulas;
use Game\Hero\HeroItems;
use Game\NoticeHelper;
use Model\BerichteModel;
use Model\FarmListModel;
use Model\Quest;
use function number_format_x;
use resources\View\GameView;
use resources\View\PHPBatchView;
use Core\Caching\Caching;

class BerichteCtrl extends GameCtrl
{
    private $content;
    private $categories = [
        0 => [],
        1 => [//attacks.navigator
            NoticeHelper::TYPE_WON_AS_ATTACK_WITHOUT_CASUALTIES,
            NoticeHelper::TYPE_WON_AS_ATTACK_WITH_CASUALTIES,
            NoticeHelper::TYPE_LOST_AS_ATTACKER,
        ],
        2 => [
            NoticeHelper::TYPE_WON_DEFENSE_WITHOUT_LOSSES,
            NoticeHelper::TYPE_WON_DEFENSE_WITH_LOSSES,
            NoticeHelper::TYPE_LOST_AS_DEFENDER_WITH_CASUALTIES,
            NoticeHelper::TYPE_LOST_AS_DEFENDER_WITHOUT_CASUALTIES,
            NoticeHelper::TYPE_REINFORCEMENT,
        ],
        3 => [
            NoticeHelper::TYPE_WON_SPY_WITHOUT_CASUALTIES,
            NoticeHelper::TYPE_WON_SPY_WITH_CASUALTIES,
            NoticeHelper::TYPE_LOST_AS_SPY, //spy defend.
            NoticeHelper::TYPE_WON_SPY_AS_DEFENDER_REFUSED_ATTACKER_SPY,
            NoticeHelper::TYPE_WON_SPY_AS_DEFENDER_LETTING_ATTACKER_SPY,
        ],
        4 => [//resources.
            0,
            NoticeHelper::TYPE_RESOURCES_MOST_WOOD,
            NoticeHelper::TYPE_RESOURCES_MOST_CLAY,
            NoticeHelper::TYPE_RESOURCES_MOST_IRON,
            NoticeHelper::TYPE_RESOURCES_MOST_CROP,
            NoticeHelper::TYPE_CAGED_ATTACK, //adventure
            NoticeHelper::TYPE_ADVENTURE,
            NoticeHelper::TYPE_NEW_VILLAGE,
        ],
    ];
    const AUTH_TYPE_OWN = 1;
    const AUTH_TYPE_ALLIANCE = 2;
    const AUTH_TYPE_PRVIVATE_KEY = 3;
    private $customReportTypes = [1 => [], 2 => [], 3 => [], 4 => [],];
    private $authType = 0;
    //enforcement.
    private $reportId;
    private $selectedTabIndex;

    public function __construct()
    {
        parent::__construct();
        $quest = Quest::getInstance();
        if ($quest->getTutorial() == '12-0') {
            $quest->setTutorial('12-1');
        }
        $this->view = new GameView();
        $this->view->vars['titleInHeader'] = T("inGame", "Navigation.Reports");
        $this->view->vars['bodyCssClass'] = "perspectiveBuildings";
        $this->view->vars['contentCssClass'] = "reports";
        $this->content = new PHPBatchView("reports/base");
        $selectedTabIndex = isset($_REQUEST['t']) ? (int)$_REQUEST['t'] : $this->session->getFavoriteTab("reports");
        if ($selectedTabIndex == 5 && !$this->session->hasGoldClub()) {
            $selectedTabIndex = 0;
        }
        $this->selectedTabIndex = $selectedTabIndex;
        if (isset($_REQUEST['toggleState']) && isset($_REQUEST['id'])) {
            $m = new BerichteModel();
            if ($_REQUEST['toggleState'] == 1) {
                $m->setReportAsUnViewed((int)$_REQUEST['id'], $this->session->getPlayerId());
            } else {
                $m->setReportAsViewed((int)$_REQUEST['id'], $this->session->getPlayerId());
            }
        }
        $this->content->vars['favorTabId'] = $this->session->getFavoriteTab("reports");
        $this->content->vars['Tabs']['selectedTab'] = $selectedTabIndex;
        $this->content->vars['Tabs']['Archive'] = get_button_id();
        $this->content->vars['Tabs']['ArchiveGoldClubTitle'] = T("Reports", "Tabs.Archive") . '||' . T("Reports", "needClub");
        $this->content->vars['content'] = '';
        $this->content->vars['goldClub'] = $this->session->hasGoldClub();
        if (!isset($_REQUEST['toggleState']) && isset($_GET['id'])) {
            list($id, $private_key) = $this->filter_reportId($_GET['id']);
            $m = new BerichteModel();
            $notice = $m->getReport($id);
            if (!is_array($notice) || !$this->isReportValid($notice, $private_key)) {
                goto finalize;
            }
            if ($notice['uid'] == $this->session->getPlayerId() && !$notice['viewed'] && !$this->session->isAdminInAnotherAccount()) {
                $m->setReportAsViewed($id, $this->session->getPlayerId());
            }
            $this->renderReport($notice);
        } else if ($selectedTabIndex <= 5) {
            $this->actions();
            $this->showOverview();
        } else {
            if ($selectedTabIndex == 7) {
                $this->management();
            } else if ($selectedTabIndex == 8 && $this->session->isAdmin() && isset($_GET['percent'])) {
                $this->showOverview((int)$_GET['percent']);
            } else {
                $this->showSurrounding();
            }
        }
        finalize:
        Caching::getInstance()->delete("newReports{$this->session->getPlayerId()}");
        $this->view->vars['content'] = $this->content->output();
    }

    private function filter_reportId($id)
    {
        $id = filter_var($id, FILTER_SANITIZE_STRING);
        $split = explode("|", $id);
        if (sizeof($split) === 2) {
            return [filter_var($split[0], FILTER_SANITIZE_NUMBER_INT), $split[1]];
        }
        return [filter_var($id, FILTER_SANITIZE_NUMBER_INT), null];
    }

    private function isReportValid($row, $private_key)
    {
        if ($row['private_key'] === $private_key) {
            $this->authType = self::AUTH_TYPE_PRVIVATE_KEY;
            return true;
        } else if ($row['uid'] == $this->session->getPlayerId()) {
            $this->authType = self::AUTH_TYPE_OWN;
            return true;
        } else if ($row['aid'] > 0 && $row['aid'] == $this->session->getAllianceId()) {
            $this->authType = self::AUTH_TYPE_ALLIANCE;
            return true;
        }// else if($row['aid'] > 0) {
        //     $aid = $this->session->getAllianceId();
        //     $db = DB::GetInstance();
        //     $diplos = $db->query("SELECT aid1, aid2 FROM diplomacy WHERE (aid1={$row['aid']} OR aid2={$row['aid']}) AND accepted<>0");
        //     while ($r = $diplos->fetch_assoc()) {
        //         if($r['aid1'] == $aid || $r['aid2'] == $aid){
        //             $this->authType = self::AUTH_TYPE_ALLIANCE;
        //             return TRUE;
        //         }
        //     }
        // }
        return false;
    }

    private function renderReport($notice)
    {
        $view = new PHPBatchView("reports/report_layout");
        $view->vars = [
            'subject' => $this->getNoticeSubject($notice, true),
            "reportId" => $notice['id'],
            "showImage" => $this->session->showImagesInReports() && (!isset($_COOKIE['lowRes']) || $_COOKIE['lowRes'] == 0),
            "imgType" => ($notice['type'] == 0 || $notice['type'] == 22) ? 30 : $notice['type'],
            "sendTime" => $this->getTimeByTimezone($notice['time']),
            "showForward" => false,
            "hasGoldClub" => $this->session->hasGoldClub(),
            "isMine" => $notice['uid'] == $this->session->getPlayerId(),
            "content" => null,
            "showArchiveButton" => $this->session->getPlayerId() == $notice['uid'],
            "archived" => $notice['archive'] == 1,
            "showAddToFarmList" => $this->session->getPlayerId() == $notice['uid'],
            "showDeleteButton" => !$notice['deleted'] && $this->session->getPlayerId() == $notice['uid'],
            "showPermissionsButton" => $this->session->getPlayerId() == $notice['uid'],
            "showSimulateButton" => $this->session->getPlayerId() == $notice['uid'],
            "showRepeatButton" => $this->session->getPlayerId() == $notice['uid'],
            'selectedTabIndex' => $this->selectedTabIndex,
        ];
        if (isset($_GET['id'])) {
            $this->view->newVillagePrefix['id'] = filter_var($_GET['id'], FILTER_SANITIZE_STRING);
        }
        $isAttackOrSpy = false;
        switch ($notice['type']) {
            case NoticeHelper::TYPE_WON_AS_ATTACK_WITHOUT_CASUALTIES:
            case NoticeHelper::TYPE_WON_AS_ATTACK_WITH_CASUALTIES:
            case NoticeHelper::TYPE_LOST_AS_ATTACKER:
            case NoticeHelper::TYPE_WON_DEFENSE_WITHOUT_LOSSES:
            case NoticeHelper::TYPE_WON_DEFENSE_WITH_LOSSES:
            case NoticeHelper::TYPE_LOST_AS_DEFENDER_WITH_CASUALTIES:
            case NoticeHelper::TYPE_LOST_AS_DEFENDER_WITHOUT_CASUALTIES:
            case NoticeHelper::TYPE_WON_SPY_WITHOUT_CASUALTIES:
            case NoticeHelper::TYPE_WON_SPY_WITH_CASUALTIES:
            case NoticeHelper::TYPE_LOST_AS_SPY:
            case NoticeHelper::TYPE_WON_SPY_AS_DEFENDER_REFUSED_ATTACKER_SPY:
            case NoticeHelper::TYPE_WON_SPY_AS_DEFENDER_LETTING_ATTACKER_SPY:
                $isAttackOrSpy = true;
                break;
        }
        $this->reportId = $view->vars['reportId'];
        if ($view->vars['showAddToFarmList'] && $this->session->hasGoldClub()) {
            $m = new FarmListModel();
            $exists = $m->getWhereIsKidInFarmList($notice['to_kid'], $this->session->getPlayerId());
            if ($exists !== false) {
                $xy = Formulas::kid2xy($notice['to_kid']);
                $view->vars['addToFarmListHTML'] = '<button type="button" id="raidListGoldclub" class="icon" title="' . T("map", "Add to farm list") . '||' . sprintf(T("map", "Edit farm list (Village already in farm list x)"), $exists['name']) . '" onclick="var tWindows = Travian.WindowManager.getWindows(); if (tWindows.length > 0 &amp;&amp; !!tWindows.getLast()) { tWindows.getLast().close(); } Travian.Game.RaidList.addSlot(' . $exists['id'] . ', ' . $xy['x'] . ', ' . $xy['y'] . '); return false;"><i class="reportButton raidList"></i></button>';
            } else {
                $farmList = $m->getVillageFarmList($this->session->getKid(),
                    $this->session->getPlayerId());
                if ($farmList === false) {
                    $view->vars['addToFarmListHTML'] = '<button type="button" id="raidListGoldclub" class="icon disabled" title="' . T("map", "Add to farm list") . '||' . T("map", "noFarmList") . '"><i class="reportButton raidList"></i></button>';
                } else {
                    $xy = Formulas::kid2xy($notice['to_kid']);
                    $view->vars['addToFarmListHTML'] = '<button type="button" id="raidListGoldclub" class="icon" title="' . T("map", "Add to farm list") . '" onclick="var tWindows = Travian.WindowManager.getWindows(); if (tWindows.length > 0 &amp;&amp; !!tWindows.getLast()) { tWindows.getLast().close(); } Travian.Game.RaidList.addSlot(' . $farmList . ', ' . $xy['x'] . ', ' . $xy['y'] . '); return false;"><i class="reportButton raidList"></i></button>';
                }
            }
        }
        if ($notice['uid'] == $this->session->getPlayerId()) {
            if (!$isAttackOrSpy) {
                $view->vars['showAddToFarmList'] = false;
                $view->vars['showPermissionsButton'] = false;
                $view->vars['showSimulateButton'] = false;
                $view->vars['showRepeatButton'] = false;
            } else {
                if (!in_array($notice['type'],
                    [
                        NoticeHelper::TYPE_WON_AS_ATTACK_WITHOUT_CASUALTIES,
                        NoticeHelper::TYPE_WON_AS_ATTACK_WITH_CASUALTIES,
                        NoticeHelper::TYPE_LOST_AS_ATTACKER,
                    ])) {
                    $view->vars['showRepeatButton'] = false;
                    $view->vars['showAddToFarmList'] = false;
                }
            }
            $view->vars['showForward'] = true;
            $view->vars['old'] = $this->getNextReport($notice['id']);
            $view->vars['next'] = $this->getBeforeReport($notice['id']);
        }
        $view->vars['showSimulateButton'] = $view->vars['showSimulateButton'] && $this->session->hasPlus();
        $view->vars['showRepeatButton'] = $view->vars['showRepeatButton'] && $this->session->hasPlus();
        $data = NoticeHelper::parseReport($notice['type'], $notice['data']);
        if (!isset($data['permissions'])) {
            $data['permissions'] = ["prem" => 0, "desc" => ''];
        }
        $data['notice'] = $notice;
        if (isset($notice['isEnforcement']) && $notice['isEnforcement']) {
            $view->vars['showPermissionsButton'] = false;
        }
        switch ($notice['type']) {
            case NoticeHelper::TYPE_CAGED_ATTACK:
                $xy = Formulas::kid2xy($notice['to_kid']);
                $view->vars['includeFile'] = 'reports/caged_report';
                $view->vars['cagedReport'] = [];
                $view->vars['cagedReport']['units'] = array_map([$this, 'number_format'], $data['caged']);
                $view->vars['cagedReport']['notice'] = sprintf(T("Reports", "you used x cages"), $this->number_format(array_sum($data['caged'])));
                $view->vars['cagedReport']['participants'] = T("Reports", "from oasis") . ' <a class="" href="karte.php?x=' . $xy['x'] . '&amp;y=' . $xy['y'] . '">‎&#x202d;<span class="coordinates coordinatesWrapper"><span class="coordinateX">(' . $xy['x'] . '</span><span class="coordinatePipe">|</span><span class="coordinateY">' . $xy['y'] . ')</span></span>&#x202c;‎</a>';
                $view->vars['cagedReport']['tdStyle'] = $this->getStyle();
                break;
            case NoticeHelper::TYPE_NEW_VILLAGE:
                $xy = Formulas::kid2xy($notice['to_kid']);
                $karte = '<a class="" href="karte.php?x=' . $xy['x'] . '&amp;y=' . $xy['y'] . '">&rlm;&#8238;<span class="coordinates coordinatesWrapper"><span class="coordinateX">(&#8238;&#8237;' . $xy['x'] . '&#8236;&#8236;</span><span class="coordinatePipe">|</span><span class="coordinateY">&#8238;&#8237;' . $xy['y'] . '&#8236;&#8236;)</span></span>&#8236;&rlm;</a>';
                $view->vars['content'] .= PHPBatchView::render('reports/newVillage', [
                    'karte' => $karte,
                ]);
                break;
            case NoticeHelper::TYPE_RESOURCES_MOST_WOOD:
            case NoticeHelper::TYPE_RESOURCES_MOST_CLAY:
            case NoticeHelper::TYPE_RESOURCES_MOST_IRON:
            case NoticeHelper::TYPE_RESOURCES_MOST_CROP:
                $this->checkPlayerName($data['sender']['uid'], $data['sender']['uname']);
                $this->checkPlayerName($data['receiver']['uid'], $data['receiver']['uname']);
                $view->vars['includeFile'] = 'reports/trade';
                $view->vars['trade'] = [
                    'tdStyle' => $this->getStyle(),
                    'participants' => [
                        'from' => $this->getPlayerHeadline($data['sender']['uid'], $data['sender']['kid'], $data['sender']['uname']),
                        'to' => $this->getPlayerHeadline($data['receiver']['uid'], $notice['to_kid'], $data['receiver']['uname']),
                    ],
                    'duration' => secondsToString($data['timeTaken']),
                    'res' => array_map([$this, 'number_format'], $data['resources']),
                ];
                break;
            case NoticeHelper::TYPE_REINFORCEMENT:
                $view->vars['includeFile'] = 'reports/reinforcement';
                $view->vars['reinforcement'] = [
                    'duration' => secondsToString($data['timeTaken']),
                    'from' => [
                        'kid' => $data['sender']['kid'],
                        'vname' => $this->getVillageName($data['sender']['kid']),
                    ],
                    'to' => [
                        'kid' => $notice['to_kid'],
                        'vname' => $this->getVillageName($notice['to_kid']),
                    ],
                ];
                $view->vars['reinforcement']['from']['headLine'] = $this->getPlayerHeadline($data['sender']['uid'], $data['sender']['kid'], $data['sender']['uname']);
                $view->vars['reinforcement']['to']['headLine'] = $this->getPlayerHeadline($data['receiver']['uid'], $notice['to_kid'], $data['receiver']['uname']);
                $view->vars['reinforcement']['tdStyle'] = $this->getStyle();
                $view->vars['reinforcement']['race'] = $data['units']['race'];
                $view->vars['reinforcement']['duration'] = secondsToString($data['timeTaken']);
                $view->vars['reinforcement']['units'] = array_map([$this, 'number_format'], $data['units']['num']);
                $view->vars['reinforcement']['consumption'] = $this->number_format($data['consumption']);
                break;
            case NoticeHelper::TYPE_ADVENTURE:
                $quest = Quest::getInstance();
                if ($quest->getTutorial() == '12-1') {
                    $quest->setTutorial('12-2');
                }
                $content = '';
                $units = array_fill(1, 11, 0);
                $units[11] = 1;
                $adventure = new PHPBatchView("reports/adventure");
                $adventure->vars['race'] = $data['race'];
                $adventure->vars['failed'] = $notice['bounty'] == '0';
                $adventure->vars['lose'] = !($notice['bounty'] !== '-1');
                if ($notice['bounty'] !== '-1') {
                    $adventure->vars['exp'] = floor($data['exp']);
                    $adventure->vars['injury'] = floor($data['damage']);
                }
                $adventure->vars['style'] = null;
                $adventure->vars['Bounty'] = '';
                if (!$adventure->vars['failed']) {
                    $bounty = explode(",", $notice['bounty']);
                    switch ($bounty[0]) {
                        case 1:
                            $HeroItems = new HeroItems();
                            //item bonus.
                            $typeArray = [
                                '',
                                'helmet',
                                'body',
                                'leftHand',
                                'rightHand',
                                'shoes',
                                'horse',
                                'bandage25',
                                'bandage33',
                                'cage',
                                'scroll',
                                'ointment',
                                'bucketOfWater',
                                'bookOfWisdom',
                                'lawTables',
                                'artWork',
                            ];
                            $class = $typeArray[$bounty[1]];
                            $item = $HeroItems->getHeroItemProperties($bounty[1], $bounty[2]);
                            $adventure->vars['Bounty'] = '<img title="' . $item['name'] . ' (' . $this->number_format($bounty[3]) . 'x)" alt="" class="reportInfo itemCategory itemCategory_' . $class . '" src="img/x.gif">';
                            $adventure->vars['Bounty'] .= ' ' . $item['name'] . ' (' . $this->number_format($bounty[3]) . 'x)';
                            break;
                        case 2:
                            $adventure->vars['style'] = $this->getStyle();
                            $adventure->vars['Bounty'] = '<div class="inlineIconList resourceWrapper">';
                            for ($i = 1; $i <= 4; ++$i) {
                                $adventure->vars['Bounty'] .= '<div class="inlineIcon resources"><i class="r'.$i.'"></i><span class="value ">'.$this->number_format($bounty[$i]).'</span></div>';
                            }
                            $adventure->vars['Bounty'] .= '</div>';
                            break;
                        case 3:
                            $adventure->vars['Bounty'] = '<img title="' . $bounty[1] . ' ' . T("Reports", "Silver") . '" class="silver" src="img/x.gif">';
                            $adventure->vars['Bounty'] .= ' ' . T("Reports", "Silver") . ' (' . $bounty[1] . 'x)';
                            break;
                        case 4:
                            $unitId = nrToUnitId($bounty[2], $bounty[1]);
                            $adventure->vars['Bounty'] = '<img title="' . (T("Troops", "{$unitId}.title")) . ' (' . $bounty[3] . 'x)" alt="" class="unit u' . $unitId . '" src="img/x.gif">';
                            $adventure->vars['Bounty'] .= ' ' . T("Troops", "{$unitId}.title") . ' (' . $this->number_format($bounty[3]) . 'x)';
                            break;
                    }
                }
                $content .= $adventure->output();
                $view->vars['content'] .= $content;
                break;

            case NoticeHelper::TYPE_WON_SPY_WITHOUT_CASUALTIES:
            case NoticeHelper::TYPE_WON_SPY_WITH_CASUALTIES:
            case NoticeHelper::TYPE_LOST_AS_SPY:
            case NoticeHelper::TYPE_WON_SPY_AS_DEFENDER_REFUSED_ATTACKER_SPY:
            case NoticeHelper::TYPE_WON_SPY_AS_DEFENDER_LETTING_ATTACKER_SPY:
                $view->vars['bodyImage'] = '<div class="victory">';
                $attackerWon = in_array($notice['type'], [
                    NoticeHelper::TYPE_WON_AS_ATTACK_WITHOUT_CASUALTIES,
                    NoticeHelper::TYPE_WON_AS_ATTACK_WITH_CASUALTIES,
                ]);
                $view->vars['bodyImage'] .= '<img src="img/x.gif" class="reportImage outcome wonLost" alt="">';
                $view->vars['bodyImage'] .= '<img src="img/x.gif" class="tribe tribe' . $data['attacker']['race'] . ' attacker ' . ($attackerWon ? 'won' : 'lost') . '" alt="">';
                $view->vars['bodyImage'] .= '<img src="img/x.gif" class="tribe tribe' . $data['defender'][0]['race'] . ' defender ' . ($attackerWon ? 'lost' : 'won') . '" alt="">';
                $view->vars['bodyImage'] .= '</div>';
                $prm = $data['permissions']['prem'];
                if ($this->isNotMine($notice) && ((($prm & RIGHT_OPPONENT_HIDE) && $data['attacker']['uid'] != $notice['uid']) || (($prm & RIGHT_MYSELF_HIDE) && $data['attacker']['uid'] == $notice['uid']))) {
                    $headline = T("Reports", "unknown");
                } else {
                    $this->checkPlayerName($data['attacker']['uid'], $data['attacker']['uname']);
                    $headline = $this->getPlayerHeadline($data['attacker']['uid'], $notice['kid'], $data['attacker']['uname'], true);
                }
                $view->vars['content'] .= $this->renderTroopsTable($notice, $data, $data['attacker']['uid'], false, T("Reports", "Attacker"), $headline, $data['attacker']['race'], $data['attacker']['num'], $data['attacker']['dead'], isset($data['attacker']['trapped']) ? $data['attacker']['trapped'] : null, $this->renderAttackerInfos($notice, $data, true), $view->vars);
                $size = sizeof($data['defender']);
                $hideUnits = false;
                if (isset($data['info']['none_return']) && $this->authType == self::AUTH_TYPE_ALLIANCE) {
                    $size = 1;
                    $hideUnits = true;
                }
                foreach ($data['defender'] as $row) {
                    --$size;
                    if ($hideUnits) {
                        $row['dead'] = $row['num'] = array_fill(1, $row['race'] == 4 ? 10 : 11, '?');
                    }
                    $uid = isset($row['uid']) ? $row['uid'] : 0;
                    if (isset($row['kid'])) {
                        if ($this->isNotMine($notice) && isset($row['uid']) && ((($prm & RIGHT_OPPONENT_HIDE) && $data['defender'][0]['uid'] != $notice['uid']) || (($prm & RIGHT_MYSELF_HIDE) && $data['defender'][0]['uid'] == $notice['uid']))) {
                            $headline = T("Reports", "unknown");
                        } else {
                            if (!isset($row['uid'])) {
                                $row['uid'] = $row['uname'] = 0;
                            }
                            $this->checkPlayerName($row['uid'], $row['uname']);
                            $headline = $this->getPlayerHeadline($row['uid'], $row['kid'], $row['uname'], true);
                        }
                    } else {
                        $headline = T("Reports", "Reinforcement");
                    }
                    $colspan = $row['race'] == 4 ? 10 : 11;
                    $content = '';
                    if (!$size) {
                        //show escape result only when we are defender!
                        //last one so description and escape result here.
                        if ($this->session->getPlayerId() != $notice['uid'] && isset($data['permissions']['desc']) && !empty($data['permissions']['desc'])) {
                            $content .= '<tbody><tr><th>' . T("Reports", "Description:") . '</th><td colspan="' . $colspan . '">' . $data['permissions']['desc'] . '</td></tr></tbody>';
                        }
                    }
                    $view->vars['content'] .= $this->renderTroopsTable($notice, $data, $uid, true, T("Reports", "Defender"), $headline, $row['race'], $row['num'], null, null, $content, $view->vars);
                    if (!$size) break;
                }
                break;
            case 0:
            case NoticeHelper::TYPE_WON_AS_ATTACK_WITHOUT_CASUALTIES:
            case NoticeHelper::TYPE_WON_AS_ATTACK_WITH_CASUALTIES:
            case NoticeHelper::TYPE_LOST_AS_ATTACKER:
            case NoticeHelper::TYPE_WON_DEFENSE_WITHOUT_LOSSES:
            case NoticeHelper::TYPE_WON_DEFENSE_WITH_LOSSES:
            case NoticeHelper::TYPE_LOST_AS_DEFENDER_WITH_CASUALTIES:
            case NoticeHelper::TYPE_LOST_AS_DEFENDER_WITHOUT_CASUALTIES:
                $view->vars['bodyImage'] = '<div class="victory">';
                $attackerWon = in_array($notice['type'], [
                    NoticeHelper::TYPE_WON_AS_ATTACK_WITHOUT_CASUALTIES,
                    NoticeHelper::TYPE_WON_AS_ATTACK_WITH_CASUALTIES,
                ]);
                $view->vars['bodyImage'] .= '<img src="img/x.gif" class="reportImage outcome wonLost" alt="">';
                $view->vars['bodyImage'] .= '<img src="img/x.gif" class="tribe tribe' . $data['attacker']['race'] . ' attacker ' . ($attackerWon ? 'won' : 'lost') . '" alt="">';
                $view->vars['bodyImage'] .= '<img src="img/x.gif" class="tribe tribe' . $data['defender'][0]['race'] . ' defender ' . ($attackerWon ? 'lost' : 'won') . '" alt="">';
                $view->vars['bodyImage'] .= '</div>';
                $prm = $data['permissions']['prem'];
                if ($this->isNotMine($notice) && ((($prm & RIGHT_OPPONENT_HIDE) && $data['attacker']['uid'] != $notice['uid']) || (($prm & RIGHT_MYSELF_HIDE) && $data['attacker']['uid'] == $notice['uid']))) {
                    $headline = T("Reports", "unknown");
                } else {
                    $this->checkPlayerName($data['attacker']['uid'], $data['attacker']['uname']);
                    $headline = $this->getPlayerHeadline($data['attacker']['uid'], $notice['kid'], $data['attacker']['uname'], true);
                }
                $view->vars['content'] .= $this->renderTroopsTable($notice, $data, $data['attacker']['uid'], false, T("Reports", "Attacker"), $headline, $data['attacker']['race'], $data['attacker']['num'], $data['attacker']['dead'], isset($data['attacker']['trapped']) ? $data['attacker']['trapped'] : null, $this->renderAttackerInfos($notice, $data), $view->vars);
                if (isset($data['defender'])) {
                    $size = sizeof($data['defender']);
                    $hideUnits = false;
                    if (array_key_exists('losses', $data)) {
                        if ($this->authType == self::AUTH_TYPE_ALLIANCE && $data['losses'][1] < 0.25) {
                            $size = 1;
                            $hideUnits = true;
                        }
                    }
                    if (!$hideUnits) {
                        foreach ($data['defender'] as $row) {
                            $params = $data['permissions']['prem'];
                            if ($params & RIGHT_HIDE_OPPONENT_TROOPS) {
                                if ($row['uid'] != $notice['uid']) {
                                    $size = 1;
                                    break;
                                }
                            }
                            if ($params & RIGHT_HIDE_OWN_TROOPS) {
                                if ($row['uid'] == $notice['uid']) {
                                    $size = 1;
                                    break;
                                }
                            }
                        }
                    }
                    $escape = '';
                    switch ($notice['type']) {
                        case NoticeHelper::TYPE_WON_DEFENSE_WITHOUT_LOSSES:
                        case NoticeHelper::TYPE_WON_DEFENSE_WITH_LOSSES:
                        case NoticeHelper::TYPE_LOST_AS_DEFENDER_WITH_CASUALTIES:
                        case NoticeHelper::TYPE_LOST_AS_DEFENDER_WITHOUT_CASUALTIES:
                            if (isset($data['info']['escape'])) {
                                switch ($data['info']['escape']) {
                                    case -1: //no escape happend.
                                        break;
                                    case 0://success
                                        break;
                                    case 1://just capital
                                        $escape = T("Reports", "escapeNonCapitalErr");
                                        break;
                                    case 2://troops coming within 10seconds
                                        $escape = T("Reports", "escapeTroopsComingErr");
                                        break;
                                    case 3:
                                        $escape = T("Reports", "evasionNotEnabled");
                                        break;
                                    case 4:
                                        $escape = T("Reports", "escapeDisabledBecauseYourPopulationIsTooLow");
                                        break;
                                }
                            }
                            break;
                    }
                    foreach ($data['defender'] as $row) {
                        if ($hideUnits) {
                            $row['dead'] = $row['num'] = array_fill(1, $row['race'] == 4 ? 10 : 11, '?');
                            if (array_key_exists('trapped', $row)) {
                                $row['trapped'] = $row['num'];
                            }
                        }
                        --$size;
                        $uid = isset($row['uid']) ? $row['uid'] : 0;
                        if (isset($row['kid'])) {
                            if ($this->isNotMine($notice) && isset($row['uid']) && ((($prm & RIGHT_OPPONENT_HIDE) && $data['defender'][0]['uid'] != $notice['uid']) || (($prm & RIGHT_MYSELF_HIDE) && $data['defender'][0]['uid'] == $notice['uid']))) {
                                $headline = T("Reports", "unknown");
                            } else {
                                if (!isset($row['uid'])) {
                                    $row['uid'] = $row['uname'] = 0;
                                }
                                $this->checkPlayerName($row['uid'], $row['uname']);
                                $headline = $this->getPlayerHeadline($row['uid'], $row['kid'], $row['uname'], true);
                            }
                        } else {
                            $headline = T("Reports", "Reinforcement");
                        }
                        $colspan = $row['race'] == 4 ? 10 : 11;
                        $content = '';
                        if (!$size) {
                            //show escape result only when we are defender!
                            //last one so description and escape result here.
                            if (!empty($escape)) {
                                $content .= '<tbody><tr><th>' . T("Reports", "Description:") . '</th><td colspan="' . $colspan . '">' . $escape . '</td></tr></tbody>';
                            }
                            if ($this->isNotMine($notice) && isset($data['permissions']['desc']) && !empty($data['permissions']['desc'])) {
                                $content .= '<tbody><tr><th>' . T("Reports", "Description:") . '</th><td colspan="' . $colspan . '">' . $data['permissions']['desc'] . '</td></tr></tbody>';
                            }
                        }
                        $view->vars['content'] .= $this->renderTroopsTable($notice, $data, $uid, true, T("Reports", "Defender"), $headline, $row['race'], $row['num'], isset($row['dead']) ? $row['dead'] : null, null, $content, $view->vars);
                        if (!$size) {
                            break;
                        }
                    }
                }
                break;
        }
        finalize:
        $this->content->vars['content'] .= $view->output();
    }

    public function getPlayerHeadline($uid, $kid = null, $username = null, $linear = false){
        $HTML = null;
        if($uid > 1){
            $HTML .= $this->getAllianceHTMLLinkByUid($uid);
            if(!$linear){
                $HTML .= '&nbsp;';
            }
        }
        $HTML .= '<a class="player" href="spieler.php?uid='.$uid.'">'.($username ? $username : $this->getPlayerName($uid)).'</a>';
        if($kid > 0){
            if(!$linear){
                $HTML .= '<br />';
            }
            if($linear){
                $HTML .= '&nbsp;' . T("Reports", "From") . '&nbsp;';
            } else {
                $HTML .= '<span>'.T("Reports", "From").'</span>';
            }
            if(!$linear){
                $HTML .= '<br />';
            }
            $HTML .= '<a class="village" href="karte.php?d='.$kid.'">'.$this->getVillageName($kid).'</a>';
        }
        return $HTML;
    }

    public function getNoticeSubject($notice, $usePermissions = false, $isAlliance = false)
    {
        if ($notice['isEnforcement'] == 1) {
            //permissions doesn't work in this situation
            return sprintf(T("Reports", "you troops in village x were attacked"), $this->getVillageName($notice['to_kid']));
        }
        switch ($notice['type']) {
            case NoticeHelper::TYPE_ADVENTURE:
                $xy = Formulas::kid2xy($notice['to_kid']);
                $dname = ' <span class="coordinates coordinatesWrapper"><span class="coordinateX">(‭' . $xy['x'] . '‬‬</span><span class="coordinatePipe">|</span><span class="coordinateY">‭‭' . $xy['y'] . '‬‬)</span></span>';
                return sprintf(T("Reports", "x is on adventure"), $this->getVillageName($notice['kid']), $dname);
                break;
            case NoticeHelper::TYPE_CAGED_ATTACK:
                return T("Reports", "AnimalsCaught");
                break;
            case NoticeHelper::TYPE_REINFORCEMENT:
                return sprintf(T("Reports", "x reinforced y"), $this->getVillageName($notice['kid']), $this->getVillageName($notice['to_kid']));
                break;
            case NoticeHelper::TYPE_WON_SPY_WITHOUT_CASUALTIES:
            case NoticeHelper::TYPE_WON_SPY_WITH_CASUALTIES:
            case NoticeHelper::TYPE_LOST_AS_SPY:
            case NoticeHelper::TYPE_WON_SPY_AS_DEFENDER_REFUSED_ATTACKER_SPY:
            case NoticeHelper::TYPE_WON_SPY_AS_DEFENDER_LETTING_ATTACKER_SPY:
                if ($isAlliance) {
                    return sprintf(T("Reports", "x spies y"), $this->getPlayerNameByKid($notice['kid']), $this->getPlayerNameByKid($notice['to_kid']));
                }
                return sprintf(T("Reports", "x spies y"), $this->getVillageName($notice['kid']), $this->getVillageName($notice['to_kid']));
                break;
            case NoticeHelper::TYPE_NEW_VILLAGE:
                return sprintf(T("Reports", "x founds a new village"), $this->getVillageName($notice['to_kid']));
                break;
            case NoticeHelper::TYPE_RESOURCES_MOST_WOOD:
            case NoticeHelper::TYPE_RESOURCES_MOST_CLAY:
            case NoticeHelper::TYPE_RESOURCES_MOST_IRON:
            case NoticeHelper::TYPE_RESOURCES_MOST_CROP:
                return sprintf(T("Reports", "x send resources to y"), $this->getVillageName($notice['kid']), $this->getVillageName($notice['to_kid']));
                break;
            case 0:
            case NoticeHelper::TYPE_WON_AS_ATTACK_WITHOUT_CASUALTIES:
            case NoticeHelper::TYPE_WON_AS_ATTACK_WITH_CASUALTIES:
            case NoticeHelper::TYPE_LOST_AS_ATTACKER:
            case NoticeHelper::TYPE_WON_DEFENSE_WITHOUT_LOSSES:
            case NoticeHelper::TYPE_WON_DEFENSE_WITH_LOSSES:
            case NoticeHelper::TYPE_LOST_AS_DEFENDER_WITH_CASUALTIES:
            case NoticeHelper::TYPE_LOST_AS_DEFENDER_WITHOUT_CASUALTIES:
                if ($isAlliance) {
                    return sprintf(T("Reports", "x attacks y"), $this->getPlayerNameByKid($notice['kid']), $this->getPlayerNameByKid($notice['to_kid']));
                }
                $fromVillageName = $this->getVillageName($notice['kid']);
                $toVillageName = $this->getVillageName($notice['to_kid']);
                if ($usePermissions && $this->isNotMine($notice)) {
                    $data = NoticeHelper::parseReport($notice['type'], $notice['data']);
                    if (isset($data['permissions'])) {
                        $params = $data['permissions']['prem'];
                        if ($params & RIGHT_MYSELF_HIDE) {
                            if ($data['attacker']['uid'] == $notice['uid']) {
                                $fromVillageName = '<span class="none2">[?]</span>';
                            }
                            if (isset($data['defender'][0]['uid']) && $data['defender'][0]['uid'] == $notice['uid']) {
                                $toVillageName = '<span class="none2">[?]</span>';
                            }
                        }
                        if ($params & RIGHT_OPPONENT_HIDE) {
                            if ($data['attacker']['uid'] != $notice['uid']) {
                                $fromVillageName = '<span class="none2">[?]</span>';
                            }
                            if (isset($data['defender'][0]['uid']) && $data['defender'][0]['uid'] != $notice['uid']) {
                                $toVillageName = '<span class="none2">[?]</span>';
                            }
                        }
                    }
                }
                return sprintf(T("Reports", "x attacks y"), $fromVillageName, $toVillageName);
                break;
        }
    }

    private function getVillageName($kid)
    {
        $db = DB::getInstance();
        $kid = (int)$kid;
        $status = $db->query("SELECT oasistype, occupied FROM wdata WHERE id=$kid");
        if (!$status->num_rows) {
            return '<span class="none2">[?]</span>';
        }
        $status = $status->fetch_assoc();
        if ($status['oasistype']) {
            $xy = Formulas::kid2xy($kid);
            return ($status['occupied'] ? T("Reports", "occupiedOasis") : T("Reports", "unoccupiedOasis")) . ' <span class="coordinates coordinatesWrapper"><span class="coordinateX">(‭' . $xy['x'] . '‬‬</span><span class="coordinatePipe">|</span><span class="coordinateY">‭‭' . $xy['y'] . '‬‬)</span></span>';
        }
        $name = $db->fetchScalar("SELECT name FROM vdata WHERE kid=$kid");
        if (empty($name)) {
            return '<span class="none2">[?]</span>';
        }
        return $name;
    }

    private function getPlayerNameByKid($kid)
    {
        $db = DB::getInstance();
        $uid = $db->fetchScalar("SELECT owner FROM vdata WHERE kid=$kid");
        if ($uid === false) {
            $isOasis = $db->fetchScalar("SELECT COUNT(kid) FROM odata WHERE kid=$kid") >= 1;
            if ($isOasis) {
                return T("Global", "NatureName");
            }
            return '<span class="none2">[?]</span>';
        }
        return $this->getPlayerName($uid);
    }

    private function getPlayerName($uid)
    {
        if ($uid == $this->session->getPlayerId()) {
            return '&nbsp;' . $this->session->getName();
        }
        if ($uid == -1) {
            return '<span class="none2">' . T("Reports", "unknown") . '</span>';
        }
        if ($uid == 0) {
            return '<span class="none2">' . T("Global", "NatureName") . '</span>';
        }
        if ($uid == 1) {
            return '<span>' . T("Global", "NatarsName") . '</span>';
        }
        $db = DB::getInstance();
        $name = $db->fetchScalar("SELECT name FROM users WHERE id=$uid");
        if ($name === false) {
            return '<span class="none2">[?]</span>';
        }
        return $name;
    }

    private function isNotMine($notice)
    {
        if (($notice['aid'] > 0 && $notice['aid'] == $this->session->getAllianceId()) || $this->session->getPlayerId() == $notice['uid']) {
            return false;
        }
        return true;
    }

    public function getTimeByTimezone($time, $relative = false)
    {
        return TimezoneHelper::autoDateString($time, true, !$relative, $relative);
    }

    private function getNextReport($id)
    {
        $db = DB::getInstance();
        $return = ["disabled" => true, "link" => null];
        $condition = $this->sqlTabCondition();
        if (!is_null($condition)) {
            $condition = 'AND ' . $condition;
        }
        $find = $db->query("SELECT id, private_key FROM ndata WHERE uid=" . $this->session->getPlayerId() . " AND deleted=0 AND id>$id $condition ORDER BY id ASC LIMIT 1");
        if ($find->num_rows) {
            $find = $find->fetch_assoc();
            $return['disabled'] = false;
            $return['link'] = 'reports.php?id=' . $find['id'] . '|' . $find['private_key'] . '&t=' . $this->content->vars['Tabs']['selectedTab'];
        }
        return $return;
    }

    private function sqlTabCondition()
    {
        if ($this->content->vars['Tabs']['selectedTab'] == 0) {
            return null;
        }
        if (in_array($this->content->vars['Tabs']['selectedTab'], [1, 2, 3])) {
            return 'type IN(' . implode(',',
                    $this->categories[$this->content->vars['Tabs']['selectedTab']]) . ') AND deleted=0 AND archive=0';
        } else if ($this->content->vars['Tabs']['selectedTab'] == 4) {
            return 'archive=1 AND deleted=0';
        }
        return null;
    }

    private function getBeforeReport($id)
    {
        $db = DB::getInstance();
        $return = ["disabled" => true, "link" => null];
        $condition = $this->sqlTabCondition();
        if (!is_null($condition)) {
            $condition = 'AND ' . $condition;
        }
        $find = $db->query("SELECT id, private_key FROM ndata WHERE uid=" . $this->session->getPlayerId() . " AND deleted=0 AND id<$id $condition ORDER BY id DESC LIMIT 1");
        if ($find->num_rows) {
            $find = $find->fetch_assoc();
            $return['disabled'] = false;
            $return['link'] = 'reports.php?id=' . $find['id'] . '|' . $find['private_key'] . '&t=' . $this->content->vars['Tabs']['selectedTab'];
        }
        return $return;
    }

    private function renderTroopsTable($notice, $data, $uid, $isDefender, $role, $troopHeadline, $race, $units, $killed = null, $trapped = null, $other = null, $params = [])
    {
        $params['won'] = (!is_array($killed) || !array_sum($killed)) && (!is_array($trapped) || !array_sum($trapped));
        $params['skull'] = array_sum($units) > 0 && array_sum($units) == ((is_array($killed) ? array_sum($killed) : 0) + (is_array($trapped) ? array_sum($trapped) : 0));

        //hide opponents units.
        if ($this->isNotMine($data['notice'])) {
            $permissionMask = $data['permissions']['prem'];
            if ($permissionMask & RIGHT_HIDE_OPPONENT_TROOPS) {
                if ($uid != $data['notice']['uid']) {
                    $units = array_fill(1, $race == 4 ? 10 : 11, '?');
                    $killed = null;
                    $trapped = null;
                }
            }
            if ($permissionMask & RIGHT_HIDE_OWN_TROOPS) {
                if ($uid == $data['notice']['uid']) {
                    $units = array_fill(1, $race == 4 ? 10 : 11, '?');
                    $killed = null;
                    $trapped = null;
                }
            }
        }


        $style = $this->getStyle();
        $params['race'] = $race;

        if(!$isDefender){
            $params['lootClass'] = 'lootEmpty';
            if(!empty($notice['bounty'])){
                $bounty = explode(",", $notice['bounty']);
                if (isset($bounty[4])) {
                    $total_bounty = array_sum($bounty) - $bounty[4];
                    $total_carry = $bounty[4];
                    if($total_bounty == $total_carry){
                        $params['lootClass'] = 'lootFull';
                    } else if($total_bounty > 0){
                        $params['lootClass'] = 'lootHalf';
                    }
                }
            }
        }
        $params['isDefender'] = $isDefender;
        $params['role'] = $role;
        $params['troopHeadline'] = $troopHeadline;
        $end = ($race == 4 ? 10 : 11);
        $params['size'] = $end;
        $content = '<tbody class="units "><tr><th class="coords"></th>';
        $pos = 0;
        $size = 1 + (!is_null($killed) ? 1 : 0) + (!is_null($trapped) ? 1 : 0);
        for ($i = 1; $i <= $end; ++$i) {
            $unitId = nrToUnitId($i, $race);
            if ($i == 11) {
                $unitId = 'hero';
            }
            $title = T("Troops", $unitId . ".title");
            $content .= '<td class="uniticon ' . ($i == $end ? 'last' : '') . '"><img src="img/x.gif" class="unit u' . $unitId . '" title="' . $title . '" alt="' . $title . '" /></td>';
        }
        $content .= '</tr></tbody>';
        ++$pos;
        $content .= '<tbody class="units ' . ($pos == $size ? 'last' : '') . '"><tr><th><i class="troopCount" title="'.($race == 4 ? T("Reports", "units") : T("Reports", "Troops")).'"> </i></th>';
        ++$pos;
        for ($i = 1; $i <= $end; ++$i) {
            $num = $units[$i];
            $none = !$num || $num == '?' ? 'none' : '';
            if ($i == $end) {
                $none .= ' last';
            }
            $content .= '<td class="unit ' . $none . '" ' . $style . '>' . $this->number_format($num) . '</td>';
        }
        $content .= '</tr></tbody>';
        if (!is_null($killed)) {
            //if(array_sum($killed) > 0){
            $content .= '<tbody class="units ' . ($pos == $size ? 'last' : '') . '"><tr><th><i class="troopDead" title="'.T("Reports", "casualties").'"></i></th>';
            ++$pos;
            for ($i = 1; $i <= $end; ++$i) {
                $num = $killed[$i];
                $none = !$num || $num == '?' ? 'none' : '';
                if ($i == $end) {
                    $none .= ' last';
                }
                $content .= '<td class="unit ' . $none . '" ' . $style . '>' . $this->number_format($num) . '</td>';
            }
            $content .= '</tr></tbody>';
            //}
        }
        if (!is_null($trapped)) {
            $content .= '<tbody class="units ' . ($pos == $size ? 'last' : '') . '"><tr><th>' . T("Reports",
                    "Trapped") . '</th>';
            ++$pos;
            for ($i = 1; $i <= $end; ++$i) {
                $num = $trapped[$i];
                $none = !$num || $num == '?' ? 'none' : '';
                if ($i == $end) {
                    $none .= ' last';
                }
                $content .= '<td class="unit ' . $none . '" ' . $style . '>' . $this->number_format($num) . '</td>';
            }
            $content .= '</tr></tbody>';
        }

        if (!empty($other)) {
            $content .= '<tbody><tr><td class="empty" colspan="12"></td></tr></tbody>';
        }
        $content .= $other;
        $params['tbody'] = $content;
        $params['reportId'] = $this->reportId;
        $view = new PHPBatchView("reports/TroopsTable");
        $view->vars = $params;
        return $view->output();
    }

    private function getStyle()
    {
        if (!getDisplay("smallTroopsNumFontSize")) return null;
        return 'style="font-size: 11px;"';
    }

    private function number_format($x, $dec = 0)
    {
        return number_format_x($x, $dec);
    }

    private function checkPlayerName($uid, &$name)
    {
        if ($uid == 0) {
            $name = '<span class="none2">' . T("Global", "NatureName") . '</span>';
        } else if ($uid == 1) {
            $name = T("Global", "NatarsName");
        }
    }

    private function getAllianceLink($aid)
    {
        if ($aid == 0 || $aid == -1) {
            return 'N/A';
        }
        $db = DB::getInstance();
        $find = $db->query("SELECT tag FROM alidata WHERE id=$aid LIMIT 1");
        if ($find->num_rows) {
            $find = $find->fetch_assoc();
            return ' <a href="allianz.php?aid=' . $aid . '">' . $find['tag'] . '</a>';
        }
        return 'N/A';
    }

    private function getPlayerAllianceId($uid)
    {
        $db = DB::getInstance();
        $aid = $db->fetchScalar("SELECT aid FROM users WHERE id=$uid");
        if (!$aid) {
            return -1;
        }
        return $aid;
    }

    private function getAllianceHTMLLinkByUid($uid)
    {
        if ($uid == 0) {
            return null;
        }
        $db = DB::getInstance();
        $aid = $db->fetchScalar("SELECT aid FROM users WHERE id=$uid");
        if (!$aid) {
            return null;
        }
        $alliance = $db->fetchScalar("SELECT tag FROM alidata WHERE id=$aid");
        return '<span class="inline-block">[<a href="allianz.php?aid=' . $aid . '">' . $alliance . '</a>]</span>';
    }

    private function renderAttackerInfos(array $notice, array $data, $spy = false)
    {
        $information = $goods = [];
        if (isset($data['truceActive'])) {
            $information[] = sprintf(T("Truce", "report_descriptions.{$data['truceReason']}"),
                $data['attacker']['uname']);
        }
        if (isset($data['no_village'])) {
            $information[] = T("Reports", "There was no village at target destination");
        }
        if (isset($data['info']['rams'])) {
            if ($data['info']['rams'][1] == $data['info']['rams'][2]) {
                //no damage.
                $text = sprintf(T("Reports", "x didnt damaged"), T("Buildings", "{$data['info']['rams'][0]}.title"));
            } else if ($data['info']['rams'][2] == 0) {
                $text = sprintf(T("Reports", "x destroyed"), T("Buildings", "{$data['info']['rams'][0]}.title"));
            } else {
                $text = sprintf(T("Reports", "reduced lvl from x to y"),
                    T("Buildings", "{$data['info']['rams'][0]}.title"),
                    $data['info']['rams'][1],
                    $data['info']['rams'][2]);
            }
            $unitTitle = T("Buildings", "{$data['info']['rams'][0]}.title");
            $information[] = '<img class="gebIcon g' . $data['info']['rams'][0] . 'Icon" src="img/x.gif" alt="' . $unitTitle . '" title="' . $unitTitle . '" /> ' . $text;
        }

        if (isset($data['info']['cata'])) {
            for ($i = 1; $i >= 0; --$i) {
                if (!isset($data['info']['cata'][$i])) {
                    continue;
                }
                $cur_cata = $data['info']['cata'][$i];
                if ($cur_cata[1] == $cur_cata[2]) {
                    //no damage.
                    $text = sprintf(T("Reports", "x didnt damaged"), T("Buildings", "{$cur_cata[0]}.title"));
                } else if ($cur_cata[2] == 0) {
                    $text = sprintf(T("Reports", "x destroyed"), T("Buildings", "{$cur_cata[0]}.title"));
                } else {
                    $text = sprintf(T("Reports", "reduced lvl from x to y"),
                        T("Buildings", "{$cur_cata[0]}.title"),
                        $cur_cata[1],
                        $cur_cata[2]);
                }
                if (isset($cur_cata[3]) && $cur_cata[3] == 1) {
                    $text .= '<br>' . T("Reports", "randomTargetsWereChosen");
                }
                $unitTitle = T("Buildings", "{$cur_cata[0]}.title");
                $information[] = '<img class="gebIcon g' . $cur_cata[0] . 'Icon" src="img/x.gif" alt="' . $unitTitle . '" title="' . $unitTitle . '" /> ' . $text;
            }
        }
        if (isset($data['info']['totally_destroyed'])) {
            $information[] = '<img src="img/x.gif" class="gebIcon g0Icon" alt="Village"> ' . T("Reports", "village totally destroyed");
        }
        if (isset($data['info']['not_destroyed_reason'])) {
            $info = T("Reports", 'not_destroyed_reason.' . $data['info']['not_destroyed_reason']);
            $information[] = '<img src="img/x.gif" class="gebIcon g0Icon" alt="Village"> ' . $info;
        }
        if (isset($data['info']['ram_not_working_on_insider']) && $data['info']['ram_not_working_on_insider']) {
            $information[] = T("Reports", "Ram does not work on alliance members");
        }
        if (isset($data['info']['cata_is_disabled']) && $data['info']['cata_is_disabled']) {
            $information[] = T("Reports", "Cata is disabled");
        }
        if (isset($data['info']['cata_not_working_on_insider']) && $data['info']['cata_not_working_on_insider']) {
            $information[] = T("Reports", "Cata does not work on alliance members");
        }
        if (isset($data['info']['none_return'])) {
            if ($spy) {
                $information[] = T("Reports", "None of your spies returned");
            } else {
                $information[] = T("Reports", "None of your soldiers returned");
            }
        }
        if (isset($data['info']['oasisCapture'])) {
            $text = '<img src="img/x.gif" class="unit uhero" title="' . T("Troops",
                    "hero.title") . '" alt="' . T("Troops", "hero.title") . '">';
            $result = $data['info']['oasisCapture'];
            if ($result == -1) {
                $text .= T("Reports", "NoFreeSlotsToCaptureOasis");
            } else if ($result == 0) {
                $text .= T("Reports", "OasisCaptured");
            } else {
                $text .= sprintf(T("Reports", "LoyaltyLowered"), round($result[0]), round($result[1]));
            }
            $information[] = $text;
        }
        if (isset($data['info']['free'])) {
            $free = $data['info']['free'];
            if ($free[0] && $free[1]) {
                $text = sprintf(T("Reports", "TrapFreeAllianceAndMe"), $free[0], $free[1]);
            } else if ($free[0] && !$free[1]) {
                $text = sprintf(T("Reports", "TrapFreeMe"), $free[0]);
            } else if ($free[1]) {
                $text = sprintf(T("Reports", "TrapFreeAlliance"), $free[1]);
            }
            $information[] = $text;
        }
        if (isset($data['info']['captureResult'])) {
            $unitId = nrToUnitId(9, $data['attacker']['race']);
            $text = '<img src="img/x.gif" class="unit u' . $unitId . '" title="' . T("Troops",
                    "$unitId.title") . '" alt="' . T("Troops", "$unitId.title") . '"> ';
            $result = $data['info']['captureResult'];
            if ($result == 0) {
                $text .= sprintf(T("Reports", "VillageCaptured"), $this->getVillageName($notice['to_kid']));
            } else if ($result == -1) {
                $text .= T("Reports", "CantCaptureCapital");
            } else if ($result == -2) {
                $text .= T("Reports", "culturePointsErr");
            } else if ($result == -3) {
                $text .= T("Reports", "rpExists");
            } else if ($result == -4) {
                $text .= T("Reports", "You can only have 1 ww village at a time");
            } else if ($result == -5) {
                $text .= T("Reports", "You cannot capture your alliance members village");
            } else {
                $text .= sprintf(T("Reports", "LoyaltyLowered"), round($result[0]), round($result[1]));
            }
            $information[] = $text;
        }
        if (isset($data['info']['protectedByArtifact'])) {
            $treasuryTitle = T("Buildings", "27.title");
            foreach ($data['info']['protectedByArtifact'] as $artifact) {
                $artifactName = '<strong>' . TreasuryCtrl::getArtifactName($artifact['type'], $artifact['size'], $artifact['num']) . '</strong>';
                $text = sprintf(T("Reports", "defenderIsSupportedByTheFollowingArtifact"), $artifactName);
                $information[] = '<img src="img/x.gif" class="gebIcon g27Icon" alt="' . $treasuryTitle . '" title="' . $treasuryTitle . '"> ' . $text;
            }
        }

        if (isset($data['info']['heroPlanCapture'])) {
            $information[] = '<img src="img/x.gif" class="unit uhero" title="' . T("Troops", "hero.title") . '" alt="' . T("Troops", "hero.title") . '">' . T("Reports", "WWPlanCaptured");
        }
        if (isset($data['info']['heroArtifactCapture'])) {
            $information[] = '<img src="img/x.gif" class="unit uhero" title="' . T("Troops", "hero.title") . '" alt="' . T("Troops", "hero.title") . '">' . T("Reports", "heroArtifactCapture");
        }
        if (isset($data['info']['captureError'])) {
            $text = '<img src="img/x.gif" class="unit uhero" title="' . T("Troops", "hero.title") . '" alt="' . T("Troops", "hero.title") . '"> ';
            switch ($data['info']['captureError']) {
                case -1:
                    $text .= T("Reports", "NoFreeAttackerTreasurySpace");
                    break;
                case -2:
                    $text .= T("Reports", "maxArtifactReached");
                    break;
                case -3:
                    $text .= T("Reports", "TreasuryExists");
                    break;
            }
            $information[] = $text;
        }

        if (isset($data['info']['rp'])) {
            $information[] = '<img src="img/x.gif" class="gebIcon g' . $data['info']['rp'][0] . 'Icon" title="' . T("Buildings", $data['info']['rp'][0] . ".title") . '" alt="' . T("Buildings", $data['info']['rp'][0] . ".title") . '"><b>' . T("Buildings", $data['info']['rp'][0] . ".title") . ' ' . T("Buildings", "level") . ' ' . $data['info']['rp'][1] . '</b>';
        }
        if (isset($data['info']['wall'])) {
            $information[] = '<img src="img/x.gif" class="gebIcon g' . $data['info']['wall'][0] . 'Icon" title="' . T("Buildings", $data['info']['wall'][0] . ".title") . '" alt="' . T("Buildings", $data['info']['wall'][0] . ".title") . '"><b>' . T("Buildings", $data['info']['wall'][0] . ".title") . ' ' . T("Buildings", "level") . ' ' . $data['info']['wall'][1];
        }

        if (isset($data['info']['res'])) {
            $res = '<div class="inlineIconList resourceWrapper">';
            for ($i = 1; $i <= 4; ++$i) {
                $res .= '<div class="inlineIcon resources"><i class="r'.$i.'"></i><span class="value ">'.$this->number_format($data['info']['res'][$i]).'</span></div>';
            }
            $res .= '</div>';
            $goods[] = [
                'title' => T("Reports", "Resources"),
                'content' => '<div class="res">' . $res . '</div>',
            ];
        }
        if (isset($data['info']['cranny'])) {
            $res = '<div class="rArea"><img class="gebIcon g23Icon" src="img/x.gif" title="' . T("Buildings", "23.title") . '" alt="' . T("Buildings", "23.title") . '">&nbsp;' . number_format_x($data['info']['cranny']) . '</div>';
            $goods[] = [
                'title' => null,
                'content' => '<div class="res">' . $res . '</div>',
            ];
        }

        if (!empty($notice['bounty'])) {
            $bounty = explode(",", $notice['bounty']);
            if ($bounty[4]) {
                $res = '<div class="inlineIconList resourceWrapper">';
                for ($i = 1; $i <= 4; ++$i) {
                    $res .= '<div class="inlineIcon resources"><i class="r'.$i.'"></i><span class="value ">'.$this->number_format($bounty[$i - 1]).'</span></div>';
                }
                $res .= '</div>';
                $total_bounty = array_sum($bounty) - $bounty[4];
                $total_carry = $bounty[4];
                $carry = sprintf('<img class="carry %s" src="img/x.gif" alt="carry">%s/%s',
                    $total_bounty == 0 ? 'empty' : ($total_bounty == $total_carry ? 'full' : 'half'),
                    $this->number_format($total_bounty),
                    $this->number_format($total_carry));
                $goods[] = [
                    'title' => T("Reports", "Bounty"),
                    'content' => '<div class="res">' . $res . '</div><div class="clear"></div><div class="carry">' . $carry . '</div>',
                ];
            }
        }
        $content = '<table class="additionalInformation">';
        if (sizeof($information)) {
            $content .= '<tbody class="infos">';
            $index = 0;
            foreach ($information as $info) {
                $content .= '<tr><th>' . ($index == 0 ? T("Reports",
                        "Information") : null) . '</th><td colspan="11">' . $info . '</td></tr>';
                ++$index;
            }
            $content .= '</tbody>';
        }
        if (sizeof($goods)) {
            $index = 0;
            foreach ($goods as $good) {
                $content .= '<tbody class="goods">';
                $content .= '<tr><th>' . ($good['title']) . '</th><td colspan="11" ' . $this->getStyle() . '>' . $good['content'] . '</td></tr>';
                $content .= '</tbody>';
                ++$index;
            }
        }
        return $content . '</table>';
    }


    private function actions()
    {
        $hasPermission = $this->session->checkSitterPermission(Session::SITTER_CAN_REMOVE_ARCHIVE_MESSAGES_OR_REPORTS);
        if (!$hasPermission) {
            return false;
        }
        $i = 1;
        $m = new BerichteModel();
        $deletes = 0;
        foreach ($_REQUEST as $key => $value) {
            if (substr($key, 0, 1) != 'n') {
                continue;
            }
            $reportId = (int)$value;
            $action = isset($_REQUEST['archive']) ? 'archive' : (isset($_REQUEST['del']) ? 'del' : (isset($_REQUEST['mark_as_read']) ? 'mark_as_read' : 'recover'));
            switch ($action) {
                case 'del':
                    if ($m->deleteReport($reportId, $this->session->getPlayerId())) {
                        $deletes++;
                    }
                    break;
                case 'archive':
                    if (!$this->session->hasGoldClub()) {
                        break;
                    }
                    $m->archiveReport($reportId, $this->session->getPlayerId());
                    break;
                case 'recover':
                    if (!$this->session->hasGoldClub()) {
                        break;
                    }
                    $m->recoverReport($reportId, $this->session->getPlayerId());
                    break;
                case 'mark_as_read':
                    $m->setReportAsViewed($reportId, $this->session->getPlayerId());
                    break;
            }
            ++$i;
        }
    }

    private function showOverview($percent = false)
    {
        $view = new PHPBatchView("reports/All");
        $this->populateFilters();
        if ($this->content->vars['Tabs']['selectedTab'] > 0 && $this->content->vars['Tabs']['selectedTab'] < 5 && isset($_GET['opt'])) {
            $opt = (int)base64_decode(base64_decode($_GET['opt']));
            $valid = [
                1 => [1, 2, 4],
                2 => [1, 2, 4, 8, 16],
                3 => [1, 2, 4, 8, 16],
                4 => [1, 2, 4, 8, 16, 32, 64, 128],
            ];
            if (in_array($opt, $valid[$this->content->vars['Tabs']['selectedTab']])) {
                $reportFilters = $this->session->getReportFilters();
                $hex = &$reportFilters[$this->content->vars['Tabs']['selectedTab'] + 2];
                if ($hex & $opt) {
                    $hex ^= $opt;
                } else {
                    $hex |= $opt;
                }
                if ($hex != 0) {
                    $this->session->setReportFilters($reportFilters);
                }
            }
        }
        $this->populateFilters();
        $recursive = isset($_GET['o']) && (int)$_GET['o'] === 1;
        $view->vars['selectedTabIndex'] = $this->selectedTabIndex;
        $view->vars['recursive'] = $recursive;
        $view->vars['selectedTabId'] = $this->content->vars['Tabs']['selectedTab'];
        $view->vars['navigator'] = $view->vars['reports'] = '';
        $view->vars['goldClub'] = $this->session->hasGoldClub();
        $view->vars['hasPermission'] = $this->session->checkSitterPermission(Session::SITTER_CAN_REMOVE_ARCHIVE_MESSAGES_OR_REPORTS);
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $view->vars['page'] = $page;
        $view->vars['allCategories'] = $this->categories;
        $view->vars['customCategories'] = $this->customReportTypes;
        $m = new BerichteModel();
        $db = DB::getInstance();
        if ($percent !== false) {
            $losses = (int)$_GET['percent'];
            $result = $db->query("SELECT * FROM ndata WHERE uid=" . $this->session->getPlayerId() . " AND losses >= $losses ORDER BY id " . ($recursive ? "ASC" : "DESC") . ", id " . ($recursive ? "ASC" : "DESC") . " LIMIT " . (($page - 1) * $this->session->getReportsRecordsPerPage()) . ", " . $this->session->getReportsRecordsPerPage());
        } else {
            $result = $m->getAllReports($this->session->getPlayerId(), $page, $recursive, $view->vars['selectedTabId'], $this->customReportTypes, isset($_GET['kid']) ? $_GET['kid'] : null);
        }
        if (!$result->num_rows) {
            $view->vars['reports'] = '<tr><td colspan="3" class="noData">' . T("Reports", "noData") . '</td></tr>';
            goto finalize;
        }
        $i = 0;
        while ($row = $result->fetch_assoc()) {
            $view->vars['reports'] .= $this->reportOverviewLayout($row, ++$i);
        }
        $prefix['t'] = $view->vars['selectedTabId'];
        if ($recursive) {
            $prefix['o'] = 1;
        }
        if ($percent !== false) {
            $losses = (int)$_GET['percent'];
            $prefix['percent'] = $losses;
            $allCount = (int)$db->fetchScalar("SELECT COUNT(id) FROM ndata WHERE uid=" . $this->session->getPlayerId() . " AND losses >= $losses");
        } else {
            $allCount = $m->getAllReportsCount($this->session->getPlayerId(), $view->vars['selectedTabId'], $this->customReportTypes);
        }
        $p = new PageNavigator($page, $allCount, $this->session->getReportsRecordsPerPage(), $prefix, "reports.php");
        $view->vars['navigator'] = $p->get();
        finalize:
        $view->vars['inboxSize'] = '';
//        if ($view->vars['selectedTabId'] == 0) {
//            $k = new PHPBatchView('reports/reportOverflow');
//            $k->vars['count'] = $this->getTotalReportsCount();
//            $view->vars['inboxSize'] = $k->output();
//        }
        $this->content->vars['content'] .= $view->output();
    }

    private function populateFilters()
    {
        $this->customReportTypes = [1 => [], 2 => [], 3 => [], 4 => [],];
        $reportFilters = $this->session->getReportFilters();
        $selectedTabIndex = $this->content->vars['Tabs']['selectedTab'];
        if ($selectedTabIndex == 1) {
            $reportTypes = &$this->customReportTypes[$selectedTabIndex];
            $hex = $reportFilters[2 + $selectedTabIndex];
            if ($hex & 1) {
                $reportTypes[] = $this->categories[$selectedTabIndex][0];
            }
            if ($hex & 2) {
                $reportTypes[] = $this->categories[$selectedTabIndex][1];
            }
            if ($hex & 4) {
                $reportTypes[] = $this->categories[$selectedTabIndex][2];
            }
        } else if ($selectedTabIndex == 2) {
            $reportTypes = &$this->customReportTypes[$selectedTabIndex];
            $hex = $reportFilters[2 + $selectedTabIndex];
            if ($hex & 1) {
                $reportTypes[] = $this->categories[$selectedTabIndex][0];
            }
            if ($hex & 2) {
                $reportTypes[] = $this->categories[$selectedTabIndex][1];
            }
            if ($hex & 4) {
                $reportTypes[] = $this->categories[$selectedTabIndex][2];
            }
            if ($hex & 8) {
                $reportTypes[] = $this->categories[$selectedTabIndex][3];
            }
            if ($hex & 16) {
                $reportTypes[] = $this->categories[$selectedTabIndex][4];
            }
        } else if ($selectedTabIndex == 3) {
            $reportTypes = &$this->customReportTypes[$selectedTabIndex];
            $hex = $reportFilters[2 + $selectedTabIndex];
            if ($hex & 1) {
                $reportTypes[] = $this->categories[$selectedTabIndex][0];
            }
            if ($hex & 2) {
                $reportTypes[] = $this->categories[$selectedTabIndex][1];
            }
            if ($hex & 4) {
                $reportTypes[] = $this->categories[$selectedTabIndex][2];
            }
            if ($hex & 8) {
                $reportTypes[] = $this->categories[$selectedTabIndex][3];
            }
            if ($hex & 16) {
                $reportTypes[] = $this->categories[$selectedTabIndex][4];
            }
        } else if ($selectedTabIndex == 4) {
            $reportTypes = &$this->customReportTypes[$selectedTabIndex];
            $hex = $reportFilters[2 + $selectedTabIndex];
            if ($hex & 1) {
                $reportTypes[] = $this->categories[$selectedTabIndex][0];
            }
            if ($hex & 2) {
                $reportTypes[] = $this->categories[$selectedTabIndex][1];
            }
            if ($hex & 4) {
                $reportTypes[] = $this->categories[$selectedTabIndex][2];
            }
            if ($hex & 8) {
                $reportTypes[] = $this->categories[$selectedTabIndex][3];
            }
            if ($hex & 16) {
                $reportTypes[] = $this->categories[$selectedTabIndex][4];
            }
            if ($hex & 32) {
                $reportTypes[] = $this->categories[$selectedTabIndex][5];
            }
            if ($hex & 64) {
                $reportTypes[] = $this->categories[$selectedTabIndex][6];
            }
            if ($hex & 128) {
                $reportTypes[] = $this->categories[$selectedTabIndex][7];
            }
        }
    }

    public function reportOverviewLayout($row, $i)
    {
        $rpt = new PHPBatchView("reports/overviewLayout");
        $rpt->vars['subject'] = $this->getNoticeSubject($row, false);
        $rpt->vars['selectedTabIndex'] = $this->selectedTabIndex;
        $rpt->vars['i'] = $i;
        $rpt->vars['noticeId'] = $row['id'];
        $rpt->vars['private_key'] = $row['private_key'];
        $rpt->vars['tabId'] = $this->content->vars['Tabs']['selectedTab'];
        $rpt->vars['type'] = $row['type'];
        $rpt->vars['viewed'] = $row['viewed'];
        $rpt->vars['reportIcon'] = '';
        $rpt->vars['date'] = $this->getTimeByTimezone($row['time'], true);
        $rpt->vars['hasPermission'] = $this->session->checkSitterPermission(Session::SITTER_CAN_REMOVE_ARCHIVE_MESSAGES_OR_REPORTS);
        switch ($row['type']) {
            case NoticeHelper::TYPE_WON_AS_ATTACK_WITHOUT_CASUALTIES:
            case NoticeHelper::TYPE_WON_AS_ATTACK_WITH_CASUALTIES:
            case NoticeHelper::TYPE_LOST_AS_ATTACKER:
            case NoticeHelper::TYPE_WON_DEFENSE_WITHOUT_LOSSES:
            case NoticeHelper::TYPE_WON_DEFENSE_WITH_LOSSES:
            case NoticeHelper::TYPE_LOST_AS_DEFENDER_WITH_CASUALTIES:
            case NoticeHelper::TYPE_LOST_AS_DEFENDER_WITHOUT_CASUALTIES:
                $bounty = explode(",", $row['bounty']);
                if (!isset($bounty[4]) || !$bounty[4]) {
                    break;
                }
                $resources = array_sum($bounty) - $bounty[4];
                $style = $resources == $bounty[4] ? 'full' : ($resources == 0 ? 'empty' : 'half');
                if ($this->session->hasPlus()) {
                    $rpt->vars['reportIcon'] = '<a class="reportInfoIcon" href="build.php?id=39&amp;tt=2&amp;bid=' . $row['id'] . '"><img title="' . $this->number_format($resources) . '/' . $this->number_format($bounty[4]) . '" alt="' . $this->number_format($resources) . '/' . $this->number_format($bounty[4]) . '" src="img/x.gif" class="reportInfo carry ' . $style . '" /></a>';
                } else {
                    $rpt->vars['reportIcon'] = '<a class="reportInfoIcon" href="#"><img title="' . $this->number_format($resources) . '/' . $this->number_format($bounty[4]) . '" alt="' . $this->number_format($resources) . '/' . $this->number_format($bounty[4]) . '" src="img/x.gif" class="reportInfo carry ' . $style . '" /></a>';
                }
                break;
            case NoticeHelper::TYPE_ADVENTURE:
                if ($row['bounty'] == '-1') {
                    //dead //
                    $rpt->vars['reportIcon'] = '<span class="reportInfoIcon"><img title="' . T("Reports",
                            "adventureFailed") . '" alt="' . T("Reports",
                            "adventureFailed") . '" class="adventureDifficulty0" src="img/x.gif"></span>';
                } else if ($row['bounty'] == '0') {
                } else {
                    $bounty = explode(",", $row['bounty']);
                    switch ($bounty[0]) {
                        case 1:
                            $HeroItems = new HeroItems();
                            //item bonus.
                            $typeArray = [
                                '',
                                'helmet',
                                'body',
                                'leftHand',
                                'rightHand',
                                'shoes',
                                'horse',
                                'bandage25',
                                'bandage33',
                                'cage',
                                'scroll',
                                'ointment',
                                'bucketOfWater',
                                'bookOfWisdom',
                                'lawTables',
                                'artWork',
                            ];
                            $class = $typeArray[$bounty[1]];
                            $item = $HeroItems->getHeroItemProperties($bounty[1], $bounty[2]);
                            $rpt->vars['reportIcon'] = '<span class="reportInfoIcon"><img title="' . $item['name'] . ' (' . $bounty[3] . 'x)" alt="" class="reportInfo itemCategory itemCategory_' . $class . '" src="img/x.gif"></span>';
                            break;
                        case 2:
                            $rpt->vars['reportIcon'] = '<span class="reportInfoIcon"><img title="' . $this->number_format((array_sum($bounty) - 2)) . '" alt="' . $this->number_format((array_sum($bounty) - 2)) . '" src="img/x.gif" class="reportInfo carry full" /></span>';
                            break;
                        case 3:
                            $rpt->vars['reportIcon'] = '<span class="reportInfoIcon"><img title="' . $bounty[1] . ' ' . T("Reports", "Silver") . '" class="silver" src="img/x.gif"></span>';
                            break;
                        case 4:
                            $unitId = nrToUnitId($bounty[2], $bounty[1]);
                            $rpt->vars['reportIcon'] = '<span class="reportInfoIcon"><img title="' . (T("Troops", "{$unitId}.title")) . ' (' . $this->number_format($bounty[3]) . 'x)" alt="" class="unit u' . $unitId . '" src="img/x.gif"></span>';
                            break;
                    }
                }
                break;
        }
        return $rpt->output();
    }

    private function management()
    {
        $view = new PHPBatchView("reports/management");
        $uid = $this->session->getPlayerId();
        $view->vars['selectedReportType'] = isset($_POST['reportType']) ? (int)$_POST['reportType'] : 1;
        $view->vars['selectedTime'] = isset($_POST['startTime']) ? (int)$_POST['startTime'] : 0;
        $db = DB::getInstance();
        $types = [
            1 => [1],
            2 => [2],
            3 => [3],
            4 => [4],
            5 => [5],
            6 => [6],
            7 => [7],
            8 => [8],
            9 => [11, 12, 13, 14],
            10 => [15, 16, 17, 18, 19],
            11 => [20, 21],
            12 => [1, 2, 3, 4, 5, 6, 7, 8, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21],
        ];
        if (WebService::isPost()) {
            if ($view->vars['selectedTime'] == 0) {
                $db->query("UPDATE ndata SET deleted=1 WHERE uid=$uid AND archive=0 AND type IN(" . implode(",", $types[$view->vars['selectedReportType']]) . ") LIMIT 5000");
            } else {
                $db->query("UPDATE ndata SET deleted=1 WHERE uid=$uid AND archive=0 AND type IN(" . implode(",", $types[$view->vars['selectedReportType']]) . ") AND time <= " . (time() - $view->vars['selectedTime']) . "  LIMIT 5000");
            }
            $view->vars['removed_count'] = $db->affectedRows();
        }
        $view->vars['AllReportsCount'] = $db->fetchScalar("SELECT COUNT(id) FROM ndata WHERE uid={$uid} AND archive=0 AND deleted=0");
        $view->vars['ReportsWithoutCasualties'] = $db->fetchScalar("SELECT COUNT(id) FROM ndata WHERE uid={$uid} AND deleted=0 AND archive=0 AND type=1");
        $view->vars['ReportsDefWithoutCasualties'] = $db->fetchScalar("SELECT COUNT(id) FROM ndata WHERE uid={$uid} AND deleted=0 AND archive=0 AND type=4");
        $view->vars['ReportsWithCasualties'] = $db->fetchScalar("SELECT COUNT(id) FROM ndata WHERE uid={$uid} AND archive=0 AND deleted=0 AND type IN(2, 3)");
        $view->vars['ReportsDefWithCasualties'] = $db->fetchScalar("SELECT COUNT(id) FROM ndata WHERE uid={$uid} AND archive=0 AND deleted=0 AND type IN(5, 6, 7)");
        $view->vars['ReportsOtherReports'] = $view->vars['AllReportsCount'] - ($view->vars['ReportsWithoutCasualties'] + $view->vars['ReportsDefWithoutCasualties'] + $view->vars['ReportsWithCasualties'] + $view->vars['ReportsDefWithCasualties']);
        $this->content->vars['content'] .= $view->output();
    }

    private function showSurrounding()
    {
        Quest::getInstance()->setQuestBitwise('world', 13, 1);
        $view = new PHPBatchView("reports/Surrounding");
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $view->vars['tbody'] = $view->vars['navigator'] = '';
        $m = new BerichteModel();
        $result = $m->getSurrounding($this->session->getKid(), $page);
        if (!$result->num_rows) {
            $view->vars['tbody'] = '<tr><td colspan="4" class="noData">' . T("Reports", "noData") . '</td></tr>';
            goto finalize;
        }
        while ($row = $result->fetch_assoc()) {
            $view->vars['tbody'] .= $this->getSurrounding($row);
        }
        $prefix['t'] = 6;
        $p = new PageNavigator($page, $m->getSurroundingCount($this->session->getKid()), $this->session->getReportsRecordsPerPage(), $prefix, "reports.php");
        $view->vars['navigator'] = $p->get();
        finalize:
        $this->content->vars['content'] .= $view->output();
    }

    private function getSurrounding($row)
    {
        $view = new PHPBatchView("reports/SurroundingLayout");
        $view->vars['reportIcon'] = NoticeHelper::getSurroundingStyle($row['type']);
        $view->vars['x'] = $row['x'];
        $view->vars['y'] = $row['y'];
        $view->vars['distance'] = round($row['distance'], 1);
        switch ($row['type']) {
            case NoticeHelper::SURROUNDING_OASIS_RAID:
                $view->vars['reportText'] = T("Reports", "An Oasis was plundered");
                break;
            case NoticeHelper::SURROUNDING_OASIS_OCCUPY:
                $data = explode(":", $row['params']);
                $view->vars['reportText'] = sprintf(T("Reports", "x has conquered an oasis"),
                    '<a href="spieler.php?uid=' . $data[0] . '">' . $data[1] . '</a>');
                break;
            case NoticeHelper::SURROUNDING_OASIS_ABANDON:
                $view->vars['reportText'] = T("Reports", "An Oasis was abandoned");
                break;
            case NoticeHelper::SURROUNDING_FIGHT:
                $data = explode(":", $row['params']);
                $view->vars['reportText'] = sprintf(T("Reports", "A fight took at village name of player name"),
                    '<a href="spieler.php?uid=' . $data[0] . '">' . $data[1] . '</a>',
                    '<a href="karte.php?d=' . $data[2] . '">' . $this->getVillageName($data[2]) . '</a>');
                break;
            case NoticeHelper::SURROUNDING_VILLAGE_FOUND:
                $data = explode(":", $row['params']);
                $view->vars['reportText'] = sprintf(T("Reports", "x has founded y"),
                    '<a href="spieler.php?uid=' . $data[0] . '">' . $data[1] . '</a>',
                    '<a href="karte.php?d=' . $data[2] . '">' . $this->getVillageName($data[2]) . '</a>');
                break;
            case NoticeHelper::SURROUNDING_VILLAGE_CONQUER:
                $data = explode(":", $row['params']);
                $view->vars['reportText'] = sprintf(T("Reports", "x has conquered y"),
                    '<a href="spieler.php?uid=' . $data[0] . '">' . $data[1] . '</a>',
                    '<a href="karte.php?d=' . $data[2] . '">' . $this->getVillageName($data[2]) . '</a>');
                break;
            case NoticeHelper::SURROUNDING_VILLAGE_LOST:
                $data = explode(":", $row['params']);
                $view->vars['reportText'] = sprintf(T("Reports", "x has lost y"),
                    '<a href="spieler.php?uid=' . $data[0] . '">' . $data[1] . '</a>',
                    '<a href="karte.php?d=' . $data[2] . '">' . $data[3] . '</a>');
                break;
            case NoticeHelper::SURROUNDING_VILLAGE_RENAME:
                $data = explode(":", $row['params']);
                $view->vars['reportText'] = sprintf(T("Reports", "x renamed y to z"),
                    '<a href="spieler.php?uid=' . $data[0] . '">' . $data[1] . '</a>',
                    '<a href="karte.php?d=' . $data[2] . '">' . $data[3] . '</a>',
                    '<a href="karte.php?d=' . $data[2] . '">' . $data[4] . '</a>');
                break;
            case NoticeHelper::SURROUNDING_ALLIANCE:
                $data = explode(":", $row['params']);
                $view->vars['reportText'] = sprintf(T("Reports", "x switched from y to z"),
                    '<a href="spieler.php?uid=' . $data[0] . '">' . $data[1] . '</a>',
                    $this->getAllianceLink($data[2]),
                    $this->getAllianceLink($data[3]));
                break;
        }
        $view->vars['date'] = $this->getTimeByTimezone($row['time'], true);
        return $view->output();
    }
}