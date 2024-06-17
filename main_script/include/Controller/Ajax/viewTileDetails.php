<?php

namespace Controller\Ajax;

use function array_key_exists;
use Core\Caching\Caching;
use Core\Config;
use Core\Database\DB;
use Core\Helper\TimezoneHelper;
use Core\Session;
use Core\Village;
use Game\Formulas;
use Game\Hero\HeroHelper;
use Game\Hero\SessionHero;
use Core\Locale;
use Game\NoticeHelper;
use Model\AccountDeleter;
use Model\AdventureModel;
use Model\BerichteModel;
use Model\FarmListModel;
use Model\KarteModel;
use Model\OasesModel;
use function redirect;
use resources\View\PHPBatchView;

class viewTileDetails extends AjaxBase
{
    public function __construct(&$response)
    {
        parent::__construct($response);
    }

    public function dispatch()
    {
        if (!Session::getInstance()->isValid()) {
            return;
        }
        $x = Formulas::coordinateFixer($_POST['x']);
        $y = Formulas::coordinateFixer($_POST['y']);
        $m = new KarteModel();
        $tile = $m->getMapTileByCoordinates($x, $y);
        if ($tile['landscape']) {
            $this->response['data']['html'] = $this->dispatchLandscape($tile, FALSE);
        } else if ($tile['oasistype']) {
            $this->response['data']['html'] = $this->dispatchOasis($tile, FALSE);
        } else {
            $this->response['data']['html'] = $this->dispatchField($tile, FALSE);
        }
    }

    public function render($x, $y)
    {
        $m = new KarteModel();
        $x = Formulas::coordinateFixer($x);
        $y = Formulas::coordinateFixer($y);
        $tile = $m->getMapTileByCoordinates($x, $y);
        if ($tile['landscape']) {
            $HTML = $this->dispatchLandscape($tile, TRUE);
        } else if ($tile['oasistype']) {
            $HTML = $this->dispatchOasis($tile, TRUE);
        } else {
            $HTML = $this->dispatchField($tile, TRUE);
        }
        return $HTML;
    }

    private function dispatchField($tile, $noCoordinateText)
    {
        $view = new PHPBatchView("map/viewTileDetails_field" . ($tile['occupied'] ? "Occupied" : "Free"));
        $view->vars['ajaxRequest'] = !$noCoordinateText;
        $view->vars['fieldType'] = $tile['fieldtype'];
        $view->vars['x'] = $tile['x'];
        $view->vars['y'] = $tile['y'];
        $view->vars['options'] = '<div class="option"><a href="karte.php?x=' . $tile['x'] . '&y=' . $tile['y'] . '" class="a arrow" title="' . T("map",
                "centerMap") . '.">' . T("map", "centerMap") . '.</a></div>';
        $view->vars['distribution'] = '';
        $distribution = [
            1 => ('3-3-3-9'),
            2 => ('3-4-5-6'),
            3 => ('4-4-4-6'),
            4 => ('4-5-3-6'),
            5 => ('5-3-4-6'),
            6 => ('1-1-1-15'),
            7 => ('4-4-3-7'),
            8 => ('3-4-4-7'),
            9 => ('4-3-4-7'),
            10 => ('3-5-4-6'),
            11 => ('4-3-5-6'),
            12 => ('5-4-3-6'),
        ];
        $distribution = explode("-", $distribution[$tile['fieldtype']]);
        if(!$tile['occupied']){
            $view->vars['distribution'] .= '<tr>';
        }
        foreach ($distribution as $k => $v) {
            ++$k;
            if(!$tile['occupied']){
                $view->vars['distribution'] .= '<tr>';
                $view->vars['distribution'] .= '<td class="ico"><i class="r' . $k . '"></i></td>';
                $view->vars['distribution'] .= '<td class="val">' . $v . ' </td>';
                $view->vars['distribution'] .= '<td class="desc">' . T("Buildings", "{$k}.title") . ' </td>';
                $view->vars['distribution'] .= '</tr>';
            } else {
                $view->vars['distribution'] .= '<td><i class="r' . $k . '"></i> ' . $v . '</td>';
            }
        }
        if(!$tile['occupied']){
            $view->vars['distribution'] .= '</tr>';
        }
        $view->vars['distance'] = round(Formulas::getDistance($tile['id'],
            Session::getInstance()->getSelectedVillageID()),
            1);
        if ($tile['occupied']) {
            $m = new KarteModel();
            $village = $m->getVillageInfo($tile['id'], "owner, name, pop, capital, isWW");
            if (!array_key_exists('isWW', $village)) {
                (new AccountDeleter())->deleteVillage($tile['id']);
                redirect('dorf1.php');
            }
            $view->vars['Tribe'] = $m->getPlayerTribe($village['owner']);
            $view->vars['aid'] = $m->getPlayerAllianceId($village['owner']);
            if ($view->vars['aid']) {
                $view->vars['allianceTag'] = $m->getAllianceTag($view->vars['aid']);
            }
            $view->vars['coordText'] = $village['name'];
            $view->vars['uid'] = $village['owner'];
            $view->vars['playerName'] = $m->getPlayerName($village['owner']);
            $view->vars['pop'] = $village['pop'];
            $view->vars['mainVillage'] = $village['capital'] ? '(' . T("map", "capital") . ')' : '';
            if ($tile['id'] == Village::getInstance()->getKid()) {
                goto finalize;
            }
            $access = $m->getPlayerAccesses($village['owner']);
            if ($village['isWW'] && !Config::getInstance()->dynamic->WWPlansReleased && !Config::getProperty("custom",
                    "wwPlansEnabled")) $access = 0;
            //banned
            //vacation
            //beginner protection
            if (Session::getInstance()->banned()) {
                $view->vars['options'] .= '<div class="option"><span class="a arrow disabled" title="' . T("map",
                        "YouAreBanned") . '">' . T("map", "sendTroops") . '</span></div>';
            } else if (Session::getInstance()->isInVacationMode()) {
                $view->vars['options'] .= '<div class="option"><span class="a arrow disabled" title="' . T("map",
                        "YouAreInVacationMode") . '">' . T("map", "sendTroops") . '</span></div>';
            } else if (!Config::getProperty("custom",
                    "skipProtectionOnAttack") && Session::getInstance()->hasProtection() && !($village['owner'] == 1) && Session::getInstance()->getPlayerId() != $village['owner']) {
                $view->vars['options'] .= '<div class="option"><span class="a arrow disabled" title="' . T("map",
                        "YouAreProtected") . '">' . T("map", "sendTroops") . '</span></div>';
            } else if ($village['owner'] != Session::getInstance()->getPlayerId() && ($protect = $m->hasBeginnerProtection($tile['id']))) {
                $view->vars['options'] .= '<div class="option"><span class="a arrow disabled" title="' . sprintf(T("map",
                        "x is under protection to y"),
                        TimezoneHelper::autoDateString($protect, TRUE)) . '">' . T("map",
                        "sendTroops") . '</span></div>';
            } else if ($access == 0) {
                $view->vars['options'] .= '<div class="option"><span class="a arrow disabled" title="' . T("map",
                        "banned") . '">' . T("map", "sendTroops") . '</span></div>';
            } else if ($m->isInVacation($tile['id'])) {
                $view->vars['options'] .= '<div class="option"><span class="a arrow disabled" title="' . T("map",
                        "vacationModeActive") . '">' . T("map", "sendTroops") . '</span></div>';
            } else if (max(Village::getInstance()->getTypeLevel(16))) {
                $view->vars['options'] .= '<div class="option"><a href="build.php?id=39&tt=2&z=' . $tile['id'] . '" class="a arrow" title="' . T("map",
                        "sendTroops") . '">' . T("map", "sendTroops") . '</a></div>';
            } else {
                $view->vars['options'] .= '<div class="option"><span class="a arrow disabled" title="' . T("map",
                        "constructRallyPoint") . '">' . T("map", "sendTroops") . '</span></div>';
            }
            if (Session::getInstance()->banned()) {
                $view->vars['options'] .= '<div class="option"><span class="a arrow disabled" title="' . T("map",
                        "YouAreBanned") . '">' . T("map", "sendMerchants") . '</span></div>';
            } else if (Session::getInstance()->isInVacationMode()) {
                $view->vars['options'] .= '<div class="option"><span class="a arrow disabled" title="' . T("map",
                        "YouAreInVacationMode") . '">' . T("map", "sendMerchants") . '</span></div>';
            } else if ($access == 0) {
                $view->vars['options'] .= '<div class="option"><span class="a arrow disabled" title="' . T("map",
                        "banned") . '">' . T("map", "sendMerchants") . '</span></div>';
            } else if (Village::getInstance()->hasMarketPlace()) {
                $view->vars['options'] .= '<div class="option"><a href="build.php?z=' . $tile['id'] . '&amp;gid=17&amp;t=5" class="a arrow" title="' . T("map",
                        "sendMerchants") . '">' . T("map", "sendMerchants") . '</a></div>';
            } else {
                $view->vars['options'] .= '<div class="option"><span class="a arrow disabled" title="' . T("map",
                        "constructMarketplace") . '">' . T("map", "sendMerchants") . '</span></div>';
            }
            if ($m->checkForAdventure(Session::getInstance()->getPlayerId(), $tile['id'])) {
                $m = new AdventureModel();
                if ($m->getHeroVillageRallyPoint($this->session->hero->hero['kid'])) {
                    $view->vars['options'] .= '<div class="option"><a href="start_adventure.php?from=tile&kid=' . $tile['id'] . '" class="a arrow" title="' . T("map",
                            "startAdventure") . '.">' . T("map", "startAdventure") . '.</a></div>';
                } else {
                    $view->vars['options'] .= '<div class="option"><span class="a arrow disabled" title="' . T("map",
                            "constructRallyPoint") . '">' . T("map", "startAdventure") . '.</span></div>';
                }
            }
            finalize:
            $view->vars['top5Attacks'] = $this->getReports($tile['id']);
            $view->vars['top5Surrounding'] = $this->getTop5Surrounding($tile['id']);
            if (Session::getInstance()->hasGoldClub()) {
                $m = new FarmListModel();
                $farmList = $m->getVillageFarmList(Session::getInstance()->getKid(), Session::getInstance()->getPlayerId());
                if ($farmList == false) {
                    $view->vars['options'] .= '<br><div class="option"><span class="a arrow disabled" title="' . T("map", "noFarmList") . '">' . T("map", "Add to farm list") . '</span></div>';
                } else {
                    $view->vars['options'] .= '<br><div class="option"><a href="#" onclick="Travian.Game.RaidList.addSlotPopupWrapper(\'' . $farmList . '\', \'' . $tile['x'] . '\', \'' . $tile['y'] . '\'); return false;" id="crud-raidlist-button" class="a arrow" title="' . T("map", "Add to farm list") . '">' . T("map", "Add to farm list") . '</a></div>';
                }
                $exists = $m->getWhereIsKidInFarmList($tile['id'], Session::getInstance()->getPlayerId());
                if ($exists !== FALSE) {
                    $view->vars['options'] .= '<div class="option"><a href="#" onclick="Travian.Game.RaidList.editSlotPopupWrapper(\'' . $exists['id'] . '\', \'' . $exists['slotId'] . '\'); return false;" id="crud-raidlist-button" class="a arrow" title="' . sprintf(T("map", "Edit farm list (Village already in farm list x)"), $exists['name']) . '">' . sprintf(T("map", "Edit farm list (Village already in farm list x)"), $exists['name']) . '</a></div>';
                }
            } else {
                $view->vars['options'] .= '<br><div class="option"><span class="a arrow needGoldClub" id="raidListButtonNoGoldClub" title="' . T("map", "for this feature you need the goldclub actived") . '">' . T("map", "Add to farm list") . '</span></div>';
                $view->vars['options'] .= <<<JSON
<script type="text/javascript">jQuery(function() { jQuery('#raidListButtonNoGoldClub').click(function () {jQuery(window).trigger('buttonClicked', [event.target, {"goldclubDialog":{"featureKey":"raidList","infoIcon":"http:\/\/t4.answers.travian.com\/index.php?aid=Travian Answers#go2answer"}}]);})});</script>
JSON;
            }
        } else {
            $db = DB::getInstance();
            $kid = Village::getInstance()->getKid();
            $settlers = $db->fetchScalar("SELECT u10 FROM units WHERE kid={$kid}");
            if ($settlers < 3) {
                $view->vars['options'] .= '<div class="option"><span class="a arrow disabled" title="' . T("map",
                        "readySettlers") . ' ' . $settlers . '/3' . '">‌' . T("map",
                        "foundNewVillage") . '</span></div>';
            } else {
                $cp = Session::getInstance()->getCP();
                $total = $db->fetchScalar("SELECT COUNT(kid) FROM vdata WHERE owner=" . Session::getInstance()->getPlayerId());
                if ($cp < Formulas::newVillageCP($total + 1)) {
                    $view->vars['options'] .= '<div class="option"><span class="a arrow disabled" title="' . T("map",
                            "culturePointsForNewVillage") . ' ' . $cp . '/' . Formulas::newVillageCP($total + 1) . '">‌' . T("map",
                            "foundNewVillage") . '</span></div>';
                } else {
                    if (Village::getInstance()->isResourcesAvailable([750, 750, 750, 750,])) {
                        $view->vars['options'] .= '<div class="option"><a href="build.php?id=39&tt=2&kid=' . $tile['id'] . '&a=6" class="a arrow" title="' . T("map",
                                "foundNewVillage") . '">' . T("map", "foundNewVillage") . '</a></div>';
                    } else {
                        $view->vars['options'] .= '<div class="option"><span class="a arrow disabled" title="' . T("map",
                                "noResourcesForNewVillage") . ' ' . $cp . '/' . Formulas::newVillageCP($total + 1) . '">‌' . T("map",
                                "foundNewVillage") . '</span></div>';
                    }
                }
            }
            $m = new KarteModel();
            if ($m->checkForAdventure(Session::getInstance()->getPlayerId(), $tile['id'])) {
                $m = new AdventureModel();
                if ($m->getHeroVillageRallyPoint($this->session->hero->hero['kid'])) {
                    $view->vars['options'] .= '<div class="option"><a href="start_adventure.php?from=tile&kid=' . $tile['id'] . '" class="a arrow" title="' . T("map",
                            "startAdventure") . '.">' . T("map", "startAdventure") . '.</a></div>';
                } else {
                    $view->vars['options'] .= '<div class="option"><span class="a arrow disabled" title="' . T("map",
                            "constructRallyPoint") . '">' . T("map", "startAdventure") . '.</span></div>';
                }
            }
        }
        $other = '';
        if ($noCoordinateText) {
            $config = Config::getInstance();
            $direction = getDirection();
            if (!$tile['occupied']) {
                $other = '<h1 class="titleInHeader">' . T("map",
                        "landscape") . ' ‎‭<span class="coordinates coordinatesWrapper coordinates' . $direction . '"><span class="coordinateX">(' . $tile['x'] . '</span><span class="coordinatePipe">|</span><span class="coordinateY">' . $tile['y'] . '‬)</span></span>‬‎ <span class="clear">&nbsp;</span></h1>';
            } else {
                $other = '<h1 class="titleInHeader">' . $view->vars['coordText'] . ' ‎‭<span class="coordinates coordinatesWrapper coordinates' . $direction . '"><span class="coordinateX">(' . $tile['x'] . '</span><span class="coordinatePipe">|</span><span class="coordinateY">' . $tile['y'] . '‬)</span></span>‬‎ <span class="mainVillage">' . $view->vars['mainVillage'] . '</span><span class="clear">&nbsp;</span></h1>';
            }
        }
        return $other . $view->output();
    }

    private function dispatchOasis($tile, $noCoordinateText)
    {
        $m = new KarteModel();
        $view = new PHPBatchView("map/viewTileDetails_oasis" . ($tile['occupied'] ? "Occupied" : "Free"));
        $view->vars['ajaxRequest'] = !$noCoordinateText;
        $view->vars['oasisType'] = $tile['oasistype'];
        $view->vars['x'] = $tile['x'];
        $view->vars['y'] = $tile['y'];
        $view->vars['distribution'] = '';
        $eff = Formulas::getOasisEffect($tile['oasistype']);
        foreach ($eff as $k => $v) {
            if (!$v) {
                continue;
            }
            if (!empty($oasisEffect)) {
                $view->vars['distribution'] .= '<br>';
            }
            $view->vars['distribution'] .= '<tr><td class="ico"><i class="r' . $k . '"></td><td class="val">' . ($v * 25) . '%</td><td class="desc">' . T("inGame",
                    "resources.r" . $k) . '</td></tr>';
        }
        //options
        $view->vars['options'] = '<div class="option"><a href="karte.php?x=' . $tile['x'] . '&y=' . $tile['y'] . '" class="a arrow" title="' . T("map",
                "centerMap") . '.">' . T("map", "centerMap") . '.</a></div>';
        if ($m->checkForAdventure(Session::getInstance()->getPlayerId(), $tile['id'])) {
            if (max(Village::getInstance()->getTypeLevel(16))) {
                $view->vars['options'] .= '<div class="option"><a href="start_adventure.php?from=tile&kid=' . $tile['id'] . '" class="a arrow" title="' . T("map",
                        "startAdventure") . '.">' . T("map", "startAdventure") . '.</a></div>';
            } else {
                $view->vars['options'] .= '<div class="option"><span class="a arrow disabled" title="' . T("map",
                        "constructRallyPoint") . '">' . T("map", "startAdventure") . '.</span></div>';
            }
        }
        if ($tile['occupied']) {
            $odata = $m->getOasisInfo($tile['id'], 'owner, did');
            $access = $m->getPlayerAccesses($odata['owner']);
            if (Session::getInstance()->banned()) {
                $view->vars['options'] .= '<div class="option"><span class="a arrow disabled" title="' . T("map",
                        "YouAreBanned") . '">' . T("map", "sendTroops") . '</span></div>';
            } else if (Session::getInstance()->isInVacationMode()) {
                $view->vars['options'] .= '<div class="option"><span class="a arrow disabled" title="' . T("map",
                        "YouAreInVacationMode") . '">' . T("map", "sendTroops") . '</span></div>';
            } else if (($protect = $m->hasBeginnerProtection($tile['id']))) {
                $view->vars['options'] .= '<div class="option"><span class="a arrow disabled" title="' . sprintf(T("map",
                        "x is under protection to y"),
                        TimezoneHelper::autoDateString($protect, TRUE)) . '">' . T("map",
                        "sendTroops") . '</span></div>';
            } else if ($access == 0) {
                $view->vars['options'] .= '<div class="option"><span class="a arrow disabled" title="' . T("map",
                        "banned") . '">' . T("map", "sendTroops") . '</span></div>';
            } else if ($m->isInVacation($tile['id'])) {
                $view->vars['options'] .= '<div class="option"><span class="a arrow disabled" title="' . T("map",
                        "vacationModeActive") . '">' . T("map", "sendTroops") . '</span></div>';
            } else if (max(Village::getInstance()->getTypeLevel(16))) {
                $view->vars['options'] .= '<div class="option"><a href="build.php?id=39&tt=2&z=' . $tile['id'] . '" class="a arrow" title="' . T("map",
                        "sendTroops") . '">' . T("map", "sendTroops") . '</a></div>';
            } else if ($odata['owner'] != Session::getInstance()->getPlayerId() && ($protect = $m->hasBeginnerProtection($odata['did']))) {
                $view->vars['options'] .= '<div class="option"><span class="a arrow disabled" title="' . sprintf(T("map",
                        "x is under protection to y"),
                        TimezoneHelper::autoDateString($protect, TRUE)) . '">' . T("map",
                        "sendTroops") . '</span></div>';
            } else {
                $view->vars['options'] .= '<div class="option"><span class="a arrow disabled" title="' . T("map",
                        "constructRallyPoint") . '">' . T("map", "sendTroops") . '</span></div>';
            }
        } else {
            if (Session::getInstance()->banned()) {
                $view->vars['options'] .= '<div class="option"><span class="a arrow disabled" title="' . T("map",
                        "YouAreBanned") . '">' . T("map", "sendTroops") . '</span></div>';
            } else if (Session::getInstance()->isInVacationMode()) {
                $view->vars['options'] .= '<div class="option"><span class="a arrow disabled" title="' . T("map",
                        "YouAreInVacationMode") . '">' . T("map", "sendTroops") . '</span></div>';
            } else if (max(Village::getInstance()->getTypeLevel(16))) {
                $view->vars['options'] .= '<div class="option"><a href="build.php?id=39&tt=2&z=' . $tile['id'] . '" class="a arrow" title="' . T("map",
                        "sendTroops") . '">' . T("map", "sendTroops") . '</a></div>';
            } else {
                $view->vars['options'] .= '<div class="option"><span class="a arrow disabled" title="' . T("map",
                        "constructRallyPoint") . '">' . T("map", "sendTroops") . '</span></div>';
            }
        }
        $db = DB::getInstance();
        $view->vars['coordText'] = $tile['occupied'] ? T("map", "occupiedOasis") : T("map", "freeOasis");
        if (!$tile['occupied']) {
            OasesModel::oasesTrain($tile['id']);
            $units_simulate_string = '';
            $view->vars['troops_info'] = '';
            $units = $db->query("SELECT * FROM units WHERE kid={$tile['id']}")->fetch_assoc();
            for ($i = 1; $i <= 10; ++$i) {
                if (!$units['u' . $i]) {
                    continue;
                }
                $units_simulate_string .= '<input type="hidden" name="a2_3' . $i . '" value="' . $units['u' . $i] . '">' . PHP_EOL;
                $view->vars['troops_info'] .= '<tr><td class="ico"><img class="unit u' . nrToUnitId($i,
                        4) . '" src="img/x.gif" alt="' . T("Troops",
                        nrToUnitId($i, 4) . ".title") . '" title="' . T("Troops",
                        nrToUnitId($i,
                            4) . ".title") . '"></td><td class="val">' . $units['u' . $i] . '</td><td class="desc">' . T("Troops",
                        nrToUnitId($i, 4) . ".title") . '</td></tr>';
            }
            if (!empty($view->vars['troops_info'])) {
                $helper = new HeroHelper();
                $hero = $this->session->hero;
                $inventory = $db->query("SELECT * FROM inventory WHERE uid=" . Session::getInstance()->getPlayerId())->fetch_assoc();
                $total_power = $helper->calcTotalPower(Session::getInstance()->getRace(),
                    $hero->hero['power'],
                    $inventory['rightHand'],
                    $inventory['leftHand'],
                    $inventory['body']);
                $view->vars['troops_info'] .= '<tr><td colspan="3">
					<form id="simulateRaid" method="POST" action="/build.php?tt=3&amp;id=39">
						<input type="hidden" name="a1_v" value="' . Session::getInstance()->getRace() . '">
						<input type="hidden" name="a2_v4" value="4">
						<input type="hidden" name="ew1" value="' . Session::getInstance()->get("total_pop") . '">
						<input type="hidden" name="ew2" value="500">
						<input type="hidden" name="h_power" value="' . $total_power . '">
						<input type="hidden" name="h_off_bonus" value="' . $hero->calcOffBonus($hero->hero['offBonus']) . '">
                        ' . $units_simulate_string . '
						<a href="/build.php?tt=3&amp;id=39" class="a arrow" onclick="document.forms[\'simulateRaid\'].submit();return false;">' . T("map",
                        "Simulate raid") . '</a>
					</form>
				</td></tr>';
            }
            if (empty($view->vars['troops_info'])) {
                $view->vars['troops_info'] = '<tr><td>' . T("map", "noUnits") . '</td></tr>';
            }
            $level = max(Village::getInstance()->getTypeLevel(37));
            $slots = $level == 0 ? 0 : floor(($level - 5) / 5);
            if ($slots) {
                $slots -= $db->fetchScalar("SELECT COUNT(kid) FROM odata WHERE did=" . Village::getInstance()->getKid());
            }
            if ($slots) {
                $view->vars['options'] .= '<div class="option"><a href="build.php?id=39&tt=2&z=' . $tile['id'] . '" class="a arrow" title="' . T("map",
                        "Annex Oasis") . '">' . T("map", "Annex Oasis") . '</a></div>';
            } else {
                $view->vars['options'] .= '<div class="option"><span class="a arrow disabled" title="' . T("map",
                        "no free slots") . '">' . T("map", "Annex Oasis") . '</span></div>';
            }
        } else {
            $oasis = $m->getOasisInfo($tile['id'], "kid, did, type, owner");
            $village = $m->getVillageInfo($oasis['did'], "kid, owner, name");
            $xy = Formulas::kid2xy($village['kid']);
            $view->vars['village'] = ["x" => $xy['x'], 'y' => $xy['y'], 'name' => $village['name'],];
            $view->vars['Tribe'] = $m->getPlayerTribe($village['owner']);
            $view->vars['uid'] = $village['owner'];
            $view->vars['playerName'] = $m->getPlayerName($village['owner']);
            $view->vars['aid'] = $m->getPlayerAllianceId($village['owner']);
            if ($view->vars['aid']) {
                $view->vars['allianceTag'] = $m->getAllianceTag($view->vars['aid']);
            }
            if ($oasis['did'] <> Village::getInstance()->getKid()) {
                $level = max(Village::getInstance()->getTypeLevel(37));
                $slots = $level == 0 ? 0 : floor(($level - 5) / 5);
                if ($slots) {
                    $slots -= $db->fetchScalar("SELECT COUNT(kid) FROM odata WHERE did=" . Village::getInstance()->getKid());
                }
                if ($slots) {
                    $view->vars['options'] .= '<div class="option"><a href="build.php?id=39&tt=2&z=' . $tile['id'] . '" class="a arrow" title="' . T("map",
                            "Annex Oasis") . '">' . T("map", "Annex Oasis") . '</a></div>';
                } else {
                    $view->vars['options'] .= '<div class="option"><span class="a arrow disabled" title="' . T("map",
                            "no free slots") . '">' . T("map", "Annex Oasis") . '</span></div>';
                }
            }
        }
        $view->vars['top5Attacks'] = $this->getReports($tile['id']);
        $view->vars['top5Surrounding'] = $this->getTop5Surrounding($tile['id']);
        $other = '';
        if ($noCoordinateText) {
            $direction = getDirection();
            $other = '<h1 class="titleInHeader">' . $view->vars['coordText'] . ' ‎‭<span class="coordinates coordinatesWrapper coordinates' . $direction . '"><span class="coordinateX">(' . $tile['x'] . '</span><span class="coordinatePipe">|</span><span class="coordinateY">' . $tile['y'] . '‬)</span></span>‬‎ <span class="clear">&nbsp;</span></h1>';
        }
        if (Session::getInstance()->hasGoldClub()) {
            $m = new FarmListModel();
            $farmList = $m->getVillageFarmList(Session::getInstance()->getKid(), Session::getInstance()->getPlayerId());
            if ($farmList == false) {
                $view->vars['options'] .= '<br><div class="option"><span class="a arrow disabled" title="' . T("map", "noFarmList") . '">' . T("map", "Add to farm list") . '</span></div>';
            } else {
                $view->vars['options'] .= '<br><div class="option"><a href="#" onclick="Travian.Game.RaidList.addSlotPopupWrapper(\'' . $farmList . '\', \'' . $tile['x'] . '\', \'' . $tile['y'] . '\'); return false;" id="crud-raidlist-button" class="a arrow" title="' . T("map", "Add to farm list") . '">' . T("map", "Add to farm list") . '</a></div>';
            }
            $exists = $m->getWhereIsKidInFarmList($tile['id'], Session::getInstance()->getPlayerId());
            if ($exists !== FALSE) {
                $view->vars['options'] .= '<div class="option"><a href="#" onclick="Travian.Game.RaidList.editSlotPopupWrapper(\'' . $exists['id'] . '\', \'' . $exists['slotId'] . '\'); return false;" id="crud-raidlist-button" class="a arrow" title="' . sprintf(T("map", "Edit farm list (Village already in farm list x)"), $exists['name']) . '">' . sprintf(T("map", "Edit farm list (Village already in farm list x)"), $exists['name']) . '</a></div>';
            }
        } else {
            $view->vars['options'] .= '<br><div class="option"><span class="a arrow needGoldClub" id="raidListButtonNoGoldClub" title="' . T("map", "for this feature you need the goldclub actived") . '">' . T("map", "Add to farm list") . '</span></div>';
            $view->vars['options'] .= <<<JSON
<script type="text/javascript">jQuery(function() { jQuery('#raidListButtonNoGoldClub').addEvent('click',function () {jQuery(window).trigger('buttonClicked', [event.target, {"goldclubDialog":{"featureKey":"raidList","infoIcon":"http:\/\/t4.answers.travian.com\/index.php?aid=Travian Answers#go2answer"}}]);})});</script>
JSON;
        }
        return $other . $view->output();
    }

    private function getReports($kid)
    {
        $uid = Session::getInstance()->getPlayerId();
        $key = "reports:$uid:$kid";
        $cache = Caching::getInstance();
        if ($cache->exists($key)) {
            return $cache->get($key);
        }
        $m = new BerichteModel();
        $results = $m->getLast5Reports(Session::getInstance()->getAllianceId(),
            Session::getInstance()->getPlayerId(),
            $kid);
        $reports = '';
        while ($row = $results->fetch_assoc()) {
            $reports .= '<tr><td><img src="img/x.gif" class="iReport iReport' . $row['type'] . '" alt="' . T("Reports",
                    "reportTypes." . $row['type']) . '" title="' . T("Reports",
                    "reportTypes." . $row['type']) . '"> <a href="reports.php?id=' . $row['id'] . '">' . TimezoneHelper::autoDateString($row['time'],
                    TRUE) . '</a>';

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
                    if (Session::getInstance()->hasPlus()) {
                        $reports .= '<a class="reportInfoIcon" href="build.php?id=39&amp;tt=2&amp;bid=' . $row['id'] . '"><img title="' . $this->number_format($resources) . '/' . $this->number_format($bounty[4]) . '" alt="' . $this->number_format($resources) . '/' . $this->number_format($bounty[4]) . '" src="img/x.gif" class="reportInfo carry ' . $style . '" /></a>';
                    } else {
                        $reports .= '<a class="reportInfoIcon" href="#"><img title="' . $this->number_format($resources) . '/' . $this->number_format($bounty[4]) . '" alt="' . $this->number_format($resources) . '/' . $this->number_format($bounty[4]) . '" src="img/x.gif" class="reportInfo carry ' . $style . '" /></a>';
                    }
                    break;
            }

            $reports .= '</td></tr>';
        }
        if (empty($reports)) {
            $reports = '<tr><td>' . T("map", "No information<br>available!") . '</td></tr>';
        }
        $cache->add($key, $reports, 10);
        return $reports;
    }

    private function number_format($x, $dec = 0)
    {
        return number_format_x($x, $dec);
    }

    private function getTop5Surrounding($kid)
    {
        $key = "surrounding:$kid";
        $cache = Caching::getInstance();
        if ($cache->exists($key)) {
            return $cache->get($key);
        }
        $db = DB::getInstance();
        $reports = '';
        $results = $db->query("SELECT * FROM surrounding WHERE kid=$kid ORDER BY id DESC LIMIT 5");
        while ($notice = $results->fetch_assoc()) {
            $reports .= $this->getSurrounding($notice);
        }
        if (empty($reports)) {
            $reports = '<tr><td>' . T("map", "No information<br>available!") . '</td></tr>';
        }
        $cache->add($key, $reports, 1800);
        return $reports;
    }

    private function getSurrounding($row)
    {
        $HTML = '<tr>';
        switch ($row['type']) {
            case NoticeHelper::SURROUNDING_OASIS_RAID:
                $icon = 'oasisOccupy';
                $title = T("Reports", "An Oasis was plundered");
                break;
            case NoticeHelper::SURROUNDING_OASIS_OCCUPY:
                $icon = 'oasisOccupy';
                $data = explode(":", $row['params']);
                $title = sprintf(T("Reports", "x has conquered an oasis"),
                    '<a href="spieler.php?uid=' . $data[0] . '">' . $data[1] . '</a>');
                break;
            case NoticeHelper::SURROUNDING_OASIS_ABANDON:
                $icon = 'oasisAbandon';
                $title = T("Reports", "An Oasis was abandoned");
                break;
            case NoticeHelper::SURROUNDING_FIGHT:
                $icon = 'fight';
                $data = explode(":", $row['params']);
                $title = sprintf(T("Reports", "A fight took at village name of player name"),
                    '<a href="spieler.php?uid=' . $data[0] . '">' . $data[1] . '</a>',
                    '<a href="karte.php?d=' . $data[2] . '">' . $this->getVillageName($data[2]) . '</a>');
                break;
            case NoticeHelper::SURROUNDING_VILLAGE_FOUND:
                $icon = 'villageFound';
                $data = explode(":", $row['params']);
                $title = sprintf(T("Reports", "x has founded y"),
                    '<a href="spieler.php?uid=' . $data[0] . '">' . $data[1] . '</a>',
                    '<a href="karte.php?d=' . $data[2] . '">' . $this->getVillageName($data[2]) . '</a>');
                break;
            case NoticeHelper::SURROUNDING_VILLAGE_CONQUER:
                $icon = 'villageConquer';
                $data = explode(":", $row['params']);
                $title = sprintf(T("Reports", "x has conquered y"),
                    '<a href="spieler.php?uid=' . $data[0] . '">' . $data[1] . '</a>',
                    '<a href="karte.php?d=' . $data[2] . '">' . $this->getVillageName($data[2]) . '</a>');
                break;
            case NoticeHelper::SURROUNDING_VILLAGE_LOST:
                $icon = 'villageLost';
                $data = explode(":", $row['params']);
                $title = sprintf(T("Reports", "x has lost y"),
                    '<a href="spieler.php?uid=' . $data[0] . '">' . $data[1] . '</a>',
                    '<a href="karte.php?d=' . $data[2] . '">' . $data[3] . '</a>');
                break;
            case NoticeHelper::SURROUNDING_VILLAGE_RENAME:
                $icon = 'villageRename';
                $data = explode(":", $row['params']);
                $title = sprintf(T("Reports", "x renamed y to z"),
                    '<a href="spieler.php?uid=' . $data[0] . '">' . $data[1] . '</a>',
                    '<a href="karte.php?d=' . $data[2] . '">' . $data[3] . '</a>',
                    '<a href="karte.php?d=' . $data[2] . '">' . $data[4] . '</a>');
                break;
            case NoticeHelper::SURROUNDING_ALLIANCE:
                $icon = 'alliance';
                $data = explode(":", $row['params']);
                $title = sprintf(T("Reports", "x switched from y to z"),
                    '<a href="spieler.php?uid=' . $data[0] . '">' . $data[1] . '</a>',
                    $this->getAllianceLink($data[2]),
                    $this->getAllianceLink($data[3]));
                break;
        }
        $HTML .= '<td title="' . htmlspecialchars($title) . '"><div class="reportIcon ' . $icon . '"></div> ' . TimezoneHelper::autoDateString($row['time']) . '</td>';
        $HTML .= '<tr>';
        return $HTML;
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
            return ($status['occupied'] ? T("Reports", "occupiedOasis") : T("Reports",
                    "unoccupiedOasis")) . ' <span class="coordinates coordinatesWrapper"><span class="coordinateX">(‭' . $xy['x'] . '‬‬</span><span class="coordinatePipe">|</span><span class="coordinateY">‭‭' . $xy['y'] . '‬‬)</span></span>';
        }
        $name = $db->fetchScalar("SELECT name FROM vdata WHERE kid=$kid");
        if (empty($name)) {
            return '<span class="none2">[?]</span>';
        }
        return $name;
    }

    private function dispatchLandscape($tile, $noCoordinateText)
    {
        $m = new KarteModel();
        $view = new PHPBatchView("map/viewTileDetails_landscape");
        $view->vars['ajaxRequest'] = !$noCoordinateText;
        $view->vars['options'] = '<div class="option"><a href="karte.php?x=' . $tile['x'] . '&y=' . $tile['y'] . '" class="a arrow" title="' . T("map",
                "centerMap") . '.">' . T("map", "centerMap") . '.</a></div>';
        if ($m->checkForAdventure(Session::getInstance()->getPlayerId(), $tile['id'])) {
            $m = new AdventureModel();
            if ($m->getHeroVillageRallyPoint($this->session->hero->hero['kid'])) {
                $view->vars['options'] .= '<div class="option"><a href="start_adventure.php?from=tile&kid=' . $tile['id'] . '" class="a arrow" title="' . T("map",
                        "startAdventure") . '.">' . T("map", "startAdventure") . '.</a></div>';
            } else {
                $view->vars['options'] .= '<div class="option"><span class="a arrow disabled" title="' . T("map",
                        "constructRallyPoint") . '">' . T("map", "startAdventure") . '.</span></div>';
            }
        }
        $view->vars['x'] = $tile['x'];
        $view->vars['y'] = $tile['y'];
        $view->vars['landscapeType'] = ['forest', 'clay', 'hill', 'lake', 'vulcano',][$tile['landscape'] - 1];
        $other = '';
        if ($noCoordinateText) {
            $direction = getDirection();
            $other = '<h1 class="titleInHeader"> ' . T("map",
                    "landscape_desc") . '‎‭<span class="coordinates coordinatesWrapper coordinates' . $direction . '"><span class="coordinateX">(' . $tile['x'] . '</span><span class="coordinatePipe">|</span><span class="coordinateY">' . $tile['y'] . '‬)</span></span>‬‎ <span class="clear">&nbsp;</span></h1>';
        }
        return $other . $view->output();
    }
} 