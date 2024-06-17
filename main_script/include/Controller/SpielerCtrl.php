<?php

namespace Controller;

use Core\Caching\Caching;
use Core\Caching\ProfileCache;
use Core\Config;
use Core\Database\DB;
use Core\Database\GlobalDB;
use Core\Helper\BBCode;
use Core\Helper\TimezoneHelper;
use Core\Helper\WebService;
use Core\Session;
use Core\Village;
use Game\Formulas;
use Core\Locale;
use function getDisplay;
use Model\AutomationModel;
use Model\ClubApi;
use Model\FarmListModel;
use Model\KarteModel;
use Model\PlayerNote;
use Model\ProfileModel;
use Model\StatisticsModel;
use resources\View\GameView;
use resources\View\PHPBatchView;

class SpielerCtrl extends GameCtrl
{
    private $selectedPlayerID;
    private $isMe               = FALSE;
    private $selectedPlayerData = [];
    private $serverIsPromoted   = false;

    public function __construct()
    {
        parent::__construct();
        $this->view = new GameView();
        $this->view->vars['contentCssClass'] = 'player';
        $this->view->vars['bodyCssClass'] = 'perspectiveResources';
        $this->selectedPlayerID = isset($_REQUEST['uid']) ? (int)$_REQUEST['uid'] : Session::getInstance()->getPlayerId();
        $this->view->newVillagePrefix['uid'] = $this->selectedPlayerID;
        $this->view->vars['titleInHeader'] = T("Profile", "Player Profile");
        $worldId = Config::getProperty("settings", "worldUniqueId");
        $cache = Caching::getInstance();
        if (!($this->serverIsPromoted = $cache->get("serverIsPromoted"))) {
            $this->serverIsPromoted = 1 == GlobalDB::getInstance()->fetchScalar("SELECT promoted FROM gameServers WHERE id={$worldId}");
            $cache->set("serverIsPromoted", $this->serverIsPromoted, 2 * 86400);
        }
        $m = new ProfileModel();
        $this->selectedPlayerData = $m->getPlayer($this->selectedPlayerID,
            "aid, access, email_verified, countryFlag, showMedals, profileCacheVersion, showCountryFlag, email, name, race, desc1, desc2, gender, birthday, location, protection");
        if (!sizeof($this->selectedPlayerData)) {
            return;
        }
        if ($this->selectedPlayerID == Session::getInstance()->getPlayerId()) {
            $this->isMe = TRUE;
        } else {
            $this->view->vars['titleInHeader'] .= ' - ' . $this->selectedPlayerData['name'];
        }
        $selectedTab = isset($_REQUEST['s'])
        && in_array($_REQUEST['s'],
            [
                1,
                2,
            ]) ? $_REQUEST['s'] : 1;
        if ((!$this->isMe || Session::getInstance()->isSitter()) && $selectedTab == 2) {
            $selectedTab = 1;
        }
        if ($this->isMe && !Session::getInstance()->isSitter()) {
            $view = new PHPBatchView("profile/menu");
            $view->vars['selectedTab'] = $selectedTab;
            $view->vars['buttonId1'] = get_button_id();
            $view->vars['buttonId2'] = get_button_id();
            $view->vars['banned'] = Session::getInstance()->banned();
            $this->view->vars['content'] .= $view->output();
        }
        $revalidate = FALSE;
        if ($selectedTab == 1) {
            if (WebService::isPost() && !Session::getInstance()->isSitter() && $this->isMe) {
                if (isset($_POST['ort']) && strlen($_POST['ort']) <= 30) {
                    $birthday = (int)$_POST['jahr'] . '-' . (int)$_POST['monat'] . '-' . (int)$_POST['tag'];
                    $m->updateProfile($this->selectedPlayerID,
                        $_POST['be1'],
                        $_POST['be2'],
                        $birthday,
                        (int)$_POST['mw'] == 1 ? 1 : ((int)$_POST['mw'] == 0 ? 0 : 2),
                        $_POST['ort'],
                        isset($_POST['showCountryFlag']) && (int)$_POST['showCountryFlag'] == 1 && $this->serverIsPromoted ? 1 : 0,
                        isset($_POST['showMedals']) && $_POST['showMedals'] == 1 ? 1 : 0);
                    $this->selectedPlayerData['desc1'] = trim($_POST['be1']);
                    $this->selectedPlayerData['desc2'] = trim($_POST['be2']);
                    $this->selectedPlayerData['birthday'] = $birthday;
                    $this->selectedPlayerData['location'] = $_POST['ort'];
                    $this->selectedPlayerData['promoted'] = $this->serverIsPromoted;
                    $this->selectedPlayerData['gender'] = (int)$_POST['mw'];
                    $this->selectedPlayerData['showMedals'] = isset($_POST['showMedals']) ? (int)$_POST['showMedals'] : 0;
                    $this->selectedPlayerData['showCountryFlag'] = isset($_POST['showCountryFlag']) && (int)$_POST['showCountryFlag'] == 1 && $this->serverIsPromoted ? 1 : 0;
                    foreach ($_POST['dname'] as $kid => $name) {
                        $name = str_replace("'", '`', $name);
                        $name = filter_var($name, FILTER_SANITIZE_STRING);
                        if (empty($name)) {
                            continue;
                        }
                        $m->updateVillageName($kid, $name);
                        $revalidate = TRUE;
                    }
                }
            }
            if ($revalidate) {
                $cache = new ProfileCache($this->selectedPlayerData['profileCacheVersion']);
                $cache->reValidateProfileVillages($this->selectedPlayerID);
            }
            $this->Profile();
        }
        if ($selectedTab == 2) {
            $this->EditProfile();
        }
    }

    private function getOasisId($oasisType)
    {
        $list = [
            2 => 1,
            3 => 2,
            4 => 3,

            6 => 4,
            7 => 5,
            8 => 6,

            10 => 7,
            11 => 8,
            12 => 9,

            14 => 10,
            15 => 11,
        ];
        return $list[$oasisType];
    }

    private function EditProfile()
    {
        if (Session::getInstance()->banned()) return;
        $cache = new ProfileCache($this->selectedPlayerData['profileCacheVersion']);
        $view = new PHPBatchView("profile/EditProfile");
        $view->vars['uid'] = $this->selectedPlayerID;
        $view->vars['kid'] = Village::getInstance()->getKid();
        $view->vars['gender'] = $this->selectedPlayerData['gender'];
        $view->vars['desc1'] = trim($this->selectedPlayerData['desc1']);
        $view->vars['desc2'] = trim($this->selectedPlayerData['desc2']);
        $view->vars['showCountryFlag'] = $this->selectedPlayerData['showCountryFlag'];
        $view->vars['showMedals'] = $this->selectedPlayerData['showMedals'];
        $view->vars['promoted'] = $this->serverIsPromoted;
        $view->vars['medals'] = '';
        $view->vars['medals2'] = '';
        $db = DB::getInstance();
        if ($_cache = $cache->getProfileMedals($this->selectedPlayerID)) {
            $view->vars['medals'] = $_cache;
            goto afterMedals;
        }
        $medals = $db->query("SELECT * FROM medal WHERE uid={$this->selectedPlayerID} ORDER BY week, category");
        $view->vars['medals'] .= '<tr>';
        $view->vars['medals'] .= '<td class="typ">' . T("Profile", "DoveOfPeace") . '</td>';
        $view->vars['medals'] .= '<td class="ra"></td>';
        $view->vars['medals'] .= '<td class="we"></td>';
        $view->vars['medals'] .= '<td class="bb">[#0]</td>';
        $view->vars['medals'] .= '</tr>';
        while ($row = $medals->fetch_assoc()) {
            $view->vars['medals'] .= '<tr>';
            $view->vars['medals'] .= '<td class="typ">' . BBCode::getMedalCategory($row['category']) . '</td>';
            $view->vars['medals'] .= '<td class="ra">' . $row['rank'] . '</td>';
            $view->vars['medals'] .= '<td class="we">' . $row['week'] . '</td>';
            $view->vars['medals'] .= '<td class="bb">[#' . $row['id'] . ']</td>';
            $view->vars['medals'] .= '</tr>';
        }
        $cache->setProfileMedals($this->selectedPlayerID, $view->vars['medals']);
        afterMedals:
        $view->vars['medals2'] = null;
        if ($this->selectedPlayerData['email_verified']) {
            $medals = ClubApi::getPlayerEmailMedals(Session::getInstance()->getEmail(), FALSE);
            while ($row = $medals->fetch_assoc()) {
                if($row['type'] >= 16) continue;
                $view->vars['medals2'] .= '<tr>';
                $view->vars['medals2'] .= '<td class="typ">' . BBCode::getMedal2Category($row) . '</td>';
                $view->vars['medals2'] .= '<td class="bb" style="text-align: center;">[c' . $row['id'] . ']</td>';
                $view->vars['medals2'] .= '</tr>';
            }
        }
        $view->vars['villages'] = '';
        $m = new ProfileModel();
        $count = 0;
        $direction = strtolower(getDirection());
        $villages = $cache->getProfileEditVillages($this->selectedPlayerID);
        foreach ($villages as $row) {
            ++$count;
            $view->vars['villages'] .= '<tr>';
            $view->vars['villages'] .= '<td class="name"> <input tabindex="8" type="text" name="dname[' . $row['kid'] . ']=" value="' . $row['name'] . '" maxlength="20" class="text" />';
            if ($row['isWW']) {
                $view->vars['villages'] .= ' <span class="mainVillage">(' . T("Profile", "WoW") . ')</span>';
            }
            if ($m->isThereAnArtifact($row['kid'])) {
                $view->vars['villages'] .= ' <span class="mainVillage">(' . T("Profile", "Artifact") . ')</span>';
            }
            if ($row['capital']) {
                $view->vars['villages'] .= ' <span class="mainVillage">(' . T("Profile", "capital") . ')</span>';
            }
            $xy = Formulas::kid2xy($row['kid']);
            $view->vars['villages'] .= '</td>';
            $view->vars['villages'] .= '<td class="oases merged">';
            $oases = $m->getVillageOases($row['kid']);
            while ($o = $oases->fetch_assoc()) {
                $eff = Formulas::getOasisEffect($o['type']);
                $title = [];
                foreach ($eff as $r => $n) {
                    $title[] = T("inGame", "resources.r" . $r);
                }
                $title = implode(" ", $title);
                $view->vars['villages'] .= '<i class="r' . $this->getOasisId($o['type']) . '"></i>';
            }
            $view->vars['villages'] .= '</td>';
            $view->vars['villages'] .= '<td class="inhabitants">' . $row['pop'] . '</td>';
            $view->vars['villages'] .= '<td class="coords"><a class="" href="karte.php?x=' . $xy['x'] . '&amp;y=' . $xy['y'] . '">‎‭<span class="coordinates coordinatesWrapper coordinatesAligned coordinates' . $direction . '"><span class="coordinateX">(‭' . $xy['x'] . '‬‬</span><span class="coordinatePipe">|</span><span class="coordinateY">‭' . $xy['y'] . '‬‬)</span></span>‬‎</a></td>';
            $view->vars['villages'] .= '</tr>';
        }
        afterVillages:
        $mons = explode(" ", "Jan Feb Mar Apr May Jun Jul Aug Sep Oct Nov Dec");
        $birthday = explode("-", $this->selectedPlayerData['birthday']);
        $month = isset($birthday[1]) && $birthday[1] ? $birthday[1] : '';
        $view->vars['day'] = !isset($birthday[2]) || $birthday[2] == 0 ? '' : $birthday[2];
        $view->vars['year'] = !isset($birthday[0]) || $birthday[0] == 0 ? '' : $birthday[0];
        $view->vars['location'] = $this->selectedPlayerData['location'];
        $view->vars['month'] = NULL;
        foreach ($mons as $k => $v) {
            $view->vars['month'] .= '<option value="' . ($k + 1) . '" ' . (($k + 1) == $month ? 'selected="selected"' : '') . '>' . $v . '</option>';
        }
        $this->view->vars['content'] .= $view->output();
    }

    private function getSecondMedals()
    {
        $HTML = null;
        if (!getDisplay("includeHiddenMedals") || !$this->selectedPlayerData['showMedals']) {
            return $HTML;
        }
        if (!$this->selectedPlayerData['email_verified']) {
            return $HTML;
        }
        $HTML .= '<style type="text/css">img.medalGloria{max-width: 58px;}</style>';
        $HTML .= '<h4 class="round">' . T("Profile", "Player special medals") . '</h4>';
        $HTML .= '<div style="text-align: center">';
        $medals = ClubApi::getPlayerEmailMedals($this->selectedPlayerData['email'], true);
        if (!$medals->num_rows) {
            return null;
        }
        $medalsToShow = [];
        while ($row = $medals->fetch_assoc()) {
            $row['params'] = explode('|', $row['params']);
            $medalsToShow[$row['type']][] = [
                'params'   => $row['params'],
                'worldId'  => $row['worldId'],
                'nickname' => $row['nickname'],
                'tribe'    => $row['tribe'],
                'points'   => $row['params'][1]
            ];
        }
        ksort($medalsToShow);
        $img_travian = [
            1 => 'ww-gold.png',
            2 => 'ww-silber.png',
            3 => 'ww-silber.png',

            4 => 'off1.png',
            5 => 'off2.png',
            6 => 'off3.png',
            7 => 'off4.png',

            8  => 'def1.png',
            9  => 'def2.png',
            10 => 'def3.png',
            11 => 'def4.png',

            12 => 'pop1.png',
            13 => 'pop2.png',
            14 => 'pop3.png',
            15 => 'pop4.png',

            16 => '', //big off hammer
            17 => '', //big def hammer
            18 => '', //winner alliance

        ];

        $img_yooresh = [
            1  => 'yooresh/ww-gold.png',
            2  => 'yooresh/ww-silber.png',
            3  => 'yooresh/ww-bronze.png',
            4  => 'yooresh/off1.png',
            8  => 'yooresh/def1.png',
            16 => 'yooresh/bigOff.png', //big off hammer
            17 => 'yooresh/bigDef.png', //big def hammer
            18 => 'yooresh/ww-alliance.png', //winner alliance
        ];
        $img = $img_travian;
        if (getDisplay("useYooreshMedals")) {
            $img = $img_yooresh;
        }
        $count = 0;
        foreach ($medalsToShow as $type => $values) {
            if (!isset($img[$type]) || empty($img[$type])) continue;
            $title = '';
            foreach ($values as $val) {
                ++$count;
                switch ($type) {
                    case 1:
                    case 2:
                    case 3:
                        $array = [
                            $val['worldId'],
                            $val['nickname'],
                            T("Global", "races.{$val['tribe']}"),
                            $val['points'],
                        ];
                        break;
                    case 4:
                    case 5:
                    case 6:
                    case 7:
                    case 8:
                    case 9:
                    case 10:
                    case 11:
                    case 12:
                    case 13:
                    case 14:
                    case 15:
                    case 16: //big off hammer
                    case 17: //big def hammer
                        $array = [
                            $val['worldId'],
                            $val['nickname'],
                            T("Global", "races.{$val['tribe']}"),
                            number_format_x($val['points']),
                        ];
                        break;
                    case 18: //winner alliance
                        $array = [
                            $val['worldId'],
                            $val['nickname'],
                            T("Global", "races.{$val['tribe']}"),
                            $val['params'][1],
                        ];
                        break;
                }
                if (!empty($title)) $title .= '<br />';
                $title .= vsprintf(T("Profile", "mySpeicalM.{$type}"), $array);
            }
            $title = htmlspecialchars('<span class="gloriatitle">' . T("Profile",
                    "mySpeicalMTitle.$type") . '</span><div class="gloriacontent">' . $title . '</div>');
            $HTML .= '<img class="' . (getDisplay("useYooreshMedals") ? '' : 'medalGloria') . '" src="//gpack.' . WebService::getJustDomain() . '/gloria/' . $img[$type] . '" alt="' . $title . '" title="' . $title . '">&nbsp;&nbsp;';
            $title = null;
        }
        if ($count <= 0) {
            return null;
        }
        $HTML .= '</div>';
        return $HTML;
    }

    private function Profile()
    {
        if ($this->selectedPlayerID == 0) {
            $view = new PHPBatchView("profile/Support");
            $this->view->vars['content'] .= $view->output();
            return;
        }
        $m = new ProfileModel();
        $view = new PHPBatchView("profile/Profile");
        $statistics = new StatisticsModel();
        $view->vars['race'] = $this->selectedPlayerData['race'];
        $view->vars['uid'] = $this->selectedPlayerID;
        $status = $m->getPlayerTotalVillagesAndPop($this->selectedPlayerID);
        $view->vars['total_villages'] = $status['village_count'];
        $view->vars['total_pop'] = $status['total_pop'];
        $view->vars['rank'] = $statistics->getPlayerRankById($this->selectedPlayerID);
        $view->vars['heroHash'] = $m->getHeroHash($this->selectedPlayerID);
        $view->vars['location'] = $this->selectedPlayerData['location'];
        $view->vars['language'] = $this->selectedPlayerData['showCountryFlag'] == 1 ? $this->selectedPlayerData['countryFlag'] : null;
        $view->vars['gender'] = $this->selectedPlayerData['gender'];
        $view->vars['alliance'] = '-';
        $view->vars['specialMedals'] = $this->getSecondMedals();
        $view->vars['medals2'] = '';
        $view->vars['showNote'] = !$this->isMe;
        if ($view->vars['showNote']) {
            $view->vars['note'] = PlayerNote::getPlayerNote(Session::getInstance()->getPlayerId(),
                $this->selectedPlayerID);
        }
        $view->vars['isAdmin'] = Session::getInstance()->isAdmin();
        if ($this->selectedPlayerData['aid'] != 0) {
            $db = DB::getInstance();
            $tag = $db->fetchScalar("SELECT tag FROM alidata WHERE id=" . $this->selectedPlayerData['aid']);
            if ($tag) {
                $view->vars['alliance'] = '<a href="allianz.php?aid=' . $this->selectedPlayerData['aid'] . '">' . $tag . '</a>';
            }
        }
        if ($this->selectedPlayerData['birthday'] != 0) {
            $currentYear = TimezoneHelper::date('Y', null, true);
            $currentMonth = TimezoneHelper::date('m', null, true);
            $currentDay = TimezoneHelper::date('d', null, true);
            $age = $currentYear - (int)substr($this->selectedPlayerData['birthday'], 0, 4);
            if (($currentMonth - (int)substr($this->selectedPlayerData['birthday'], 5, 2)) < 0) {
                $age--;
            } else if (($currentMonth - (int)substr($this->selectedPlayerData['birthday'], 5, 2)) == 0) {
                if ($currentDay < (int)substr($this->selectedPlayerData['birthday'], 8, 2)) {
                    $age--;
                }
            }
            if ($age > 0) {
                $view->vars['age'] = $age;
            }
        }
        $view->vars['villages'] = '';
        list($view->vars['desc1'], $view->vars['desc2']) = BBCode::BBCodeProfile($this->selectedPlayerData['desc1'],
            $this->selectedPlayerData['desc2'],
            FALSE,
            $this->selectedPlayerID);
        if ($this->selectedPlayerData['access'] == 0 && $this->selectedPlayerID > 2) {
            $view->vars['desc1'] = $view->vars['desc2'] = T("Profile", "This player messages are banned");
        }
        $cache = new ProfileCache($this->selectedPlayerData['profileCacheVersion']);
        $farmList = new FarmListModel();
        $count = 0;
        $villages = $cache->getProfileVillages($this->selectedPlayerID);
        $direction = strtolower(getDirection());
        $kkk = 0;
        foreach ($villages as $row) {
            $isThereArtifact = $m->isThereAnArtifact($row['kid']);
            $count++;
            if(isset($_GET['artifactOnly']) && !$isThereArtifact) continue;
            $view->vars['villages'] .= '<tr>';
            $view->vars['villages'] .= '<td class="name"><a href="karte.php?d=' . $row['kid'] . '">' . $row['name'] . '</a>';
            if ($row['isWW']) {
                $view->vars['villages'] .= ' <span class="mainVillage">(' . T("Profile", "WoW") . ')</span>';
            }
            if ($isThereArtifact) {
                $view->vars['villages'] .= ' <span class="mainVillage">(' . T("Profile", "Artifact") . ')</span>';
            }
            if ($row['capital']) {
                $view->vars['villages'] .= ' <span class="mainVillage">(' . T("Profile", "capital") . ')</span>';
            }
            $xy = Formulas::kid2xy($row['kid']);
            $view->vars['villages'] .= '</td>';

            $view->vars['villages'] .= '<td class="oases merged">';
            $oases = $m->getVillageOases($row['kid']);
            while ($o = $oases->fetch_assoc()) {
                $eff = Formulas::getOasisEffect($o['type']);
                $title = [];
                foreach ($eff as $r => $n) {
                    $title[] = T("inGame", "resources.r" . $r);
                }
                $view->vars['villages'] .= '<i class="r' . $this->getOasisId($o['type']) . '"></i>';
            }
            $view->vars['villages'] .= '</td>';
            $view->vars['villages'] .= '<td class="inhabitants">' . $row['pop'] . '</td>';
            $view->vars['villages'] .= '<td class="coords"><a class="" href="karte.php?x=' . $xy['x'] . '&amp;y=' . $xy['y'] . '">‎‭<span class="coordinates coordinatesWrapper coordinatesAligned coordinates' . $direction . '"><span class="coordinateX">(‭' . $xy['x'] . '‬‬</span><span class="coordinatePipe">|</span><span class="coordinateY">‭' . $xy['y'] . '‬‬)</span></span>‬‎</a></td>';
            if (getDisplay("profileHelperButtons")) {
                $x_style = 'style="margin-' . (getDirection() == 'LTR' ? 'left' : 'right') . ': 3px;"';
                $x_style2 = 'style="margin-' . (getDirection() == 'LTR' ? 'left' : 'right') . ': 3px; background-image: none;"';
                $view->vars['villages'] .= '<td class="buttons">';
                if ($row['kid'] != Session::getInstance()->getSelectedVillageID()) {
                    if (!Session::getInstance()->hasGoldClub()) {
                        $view->vars['villages'] .= '<button type="button" id="raidListGoldclub' . (++$kkk) . '" class="icon gold" title="' . T("Reports","Add to farm list||For this feature you need the Gold club activated") . '"><img class="reportButton" ' . $x_style . ' src="' . get_gpack_cdn_mainPage_url() . 'img_'.$direction.'/report/raidList_small.png"></button>';
                        $view->vars['villages'] .= <<<HTML
<script type="text/javascript">
jQuery(function() { jQuery('#raidListGoldclub{$kkk}').click(function () {jQuery(window).trigger('buttonClicked', [event.target, {"goldclubDialog":{"featureKey":"raidList","infoIcon":"http:\/\/t4.answers.travian.com\/index.php?aid=Travian Answers#go2answer"}}]);})});</script>
HTML;

                    } else {
                        $exists = $farmList->getWhereIsKidInFarmList($row['kid'],
                            Session::getInstance()->getPlayerId());
                        if ($exists !== FALSE) {
                            $xy = Formulas::kid2xy($row['kid']);
                            $view->vars['villages'] .= '<button type="button" id="raidListGoldclub' . (++$kkk) . '" class="icon" title="' . T("map", "Add to farm list") . '||' . sprintf(T("map","Edit farm list (Village already in farm list x)"),$exists['name']) . '" onclick="Travian.Game.RaidList.addSlotPopupWrapper(' . $exists['id'] . ', ' . $xy['x'] . ', ' . $xy['y'] . '); return false;"><img class="reportButton" ' . $x_style . ' src="' . get_gpack_cdn_mainPage_url() . 'img_'.$direction.'/report/raidList_small.png"></button>';
                        } else {
                            $list = $farmList->getVillageFarmList(Session::getInstance()->getKid(),
                                Session::getInstance()->getPlayerId());
                            if ($list === FALSE) {
                                $view->vars['villages'] .= '<button type="button" id="raidListGoldclub' . (++$kkk) . '" class="icon disabled" title="' . T("map", "Add to farm list") . '||' . T("map", "noFarmList") . '"><img class="reportButton" ' . $x_style . ' src="' . get_gpack_cdn_mainPage_url() . 'img_'.$direction.'/report/raidList_small.png"></button>';
                            } else {
                                $xy = Formulas::kid2xy($row['kid']);
                                $view->vars['villages'] .= '<button type="button" id="raidListGoldclub' . (++$kkk) . '" class="icon" title="' . T("map","Add to farm list") . '" onclick="Travian.Game.RaidList.addSlotPopupWrapper(' . $list . ', ' . $xy['x'] . ', ' . $xy['y'] . '); return false;"><img class="reportButton" ' . $x_style . ' src="' . get_gpack_cdn_mainPage_url() . 'img_'.$direction.'/report/raidList_small.png"></button>';
                            }
                        }
                    }
                    if (Session::getInstance()->getPlayerId() != $row['owner'] && $this->selectedPlayerData['protection'] >= time()) {
                        $view->vars['villages'] .= ' <button type="button" title="' . sprintf(T("map","x is under protection to y"),TimezoneHelper::autoDateString($this->selectedPlayerData['protection'],TRUE)) . '" class="icon"><img class="reportButton" ' . $x_style . ' src="' . get_gpack_cdn_mainPage_url() . 'img_'.$direction.'/report/simulate_small.png"></button>';
                    } else {
                        $view->vars['villages'] .= ' <a href="build.php?id=39&amp;tt=2&amp;z=' . $row['kid'] . '&c=4"><button type="button" title="' . T("map","sendTroops") . '" class="icon"><img class="reportButton" ' . $x_style . ' src="' . get_gpack_cdn_mainPage_url() . 'img_'.$direction.'/report/simulate_small.png"></button></a>';
                    }
                    $view->vars['villages'] .= ' <a href="build.php?z=' . $row['kid'] . '&gid=17&t=5"><button type="button" class="icon" title="' . T("map","sendMerchants") . '"><img src="img/x.gif" ' . $x_style . ' class="reportButton iReport iReport11"></button></a>';
                }
                if ($view->vars['isAdmin']) {
                    $view->vars['villages'] .= ' <a href="admin.php?action=editVillage&kid=' . $row['kid'] . '"><button type="button" class="icon"><img class="reportButton" ' . $x_style2 . ' src="' . get_gpack_cdn_mainPage_url() . 'img_'.$direction.'/f/edit.gif"></button></a>';
                }
                $view->vars['villages'] .= '<div class="clear"></div></td>';
            }
            $view->vars['villages'] .= '</tr>';
        }
        afterVillages:
        $this->view->vars['content'] .= $view->output();
    }
}