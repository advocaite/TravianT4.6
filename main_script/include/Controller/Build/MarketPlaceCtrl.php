<?php

namespace Controller\Build;

use Controller\AnyCtrl;
use Controller\BuildCtrl;
use Core\Config;
use Core\Database\DB;
use Core\Helper\PageNavigator;
use Core\Helper\PreferencesHelper;
use Core\Helper\TimezoneHelper;
use Core\Helper\WebService;
use Core\Session;
use Core\Village;
use Game\AllianceBonus\AllianceBonus;
use Game\Formulas;
use Game\GoldHelper;
use Core\Locale;
use Model\MarketModel;
use Model\Quest;
use function number_format_x;
use resources\View\PHPBatchView;
class MarketPlaceCtrl extends AnyCtrl
{
    private $building_level;
    private $build;

    public function __construct(BuildCtrl $build)
    {
        parent::__construct();

        $this->build = $build;
        $this->building_level = Village::getInstance()->getField($build->selectedBuildingIndex)['level'];
        $this->view = new PHPBatchView("build/marketplace");
        $tabs = [0 => 'Management', 5 => 'SendResources', 1 => 'Buy', 2 => 'Offer',];
        foreach ($tabs as $tab) {
            $this->view->vars[$tab] = get_button_id();
        }
        $this->view->vars['index'] = $build->selectedBuildingIndex;
        $this->view->vars['level'] = $this->building_level;
        $this->view->vars['content'] = '';
        $this->view->vars['selectedTab'] = isset($_REQUEST['t']) && in_array($_REQUEST['t'], [
            0,
            5,
            1,
            2,
        ]) ? (int)$_REQUEST['t'] : Session::getInstance()->getFavoriteTab('buildingMarket');
        $this->view->vars['favor'] = Session::getInstance()->getFavoriteTab('buildingMarket');
        $this->view->vars['favorText'] = sprintf(T("MarketPlace", "Select x as favor tab"), T("MarketPlace", $tabs[$this->view->vars['selectedTab']]));
        switch ($this->view->vars['selectedTab']) {
            case 0:
                $this->view->vars['content'] .= $build->getBuildingContract();
                $this->Management();
                break;
            case 5:
                if ($this->building_level > 0) {
                    $this->sendResources();
                }
                break;
            case 1:
                if ($this->building_level > 0) {
                    $this->Buy();
                }
                break;
            case 2:
                if ($this->building_level > 0) {
                    $this->Offer();
                }
                break;
        }
    }

    private function Buy()
    {
        $view = new PHPBatchView("build/MarketPlaceBuy");
        $m = new MarketModel();
        $view->vars['total_merchants'] = $this->building_level;
        $view->vars['s'] = isset($_GET['s']) ? (int)$_GET['s'] : 0;
        $view->vars['r'] = !isset($_GET['v']) || $_GET['v'] == '1:x' ? '1:x' : '1:1';
        $view->vars['b'] = isset($_GET['b']) ? (int)$_GET['b'] : 0;
        $view->vars['index'] = $this->view->vars['index'];
        $view->vars['content'] = '';
        $view->vars['offerAccepted'] = FALSE;
        $session = Session::getInstance();
        $alliance_bonus = 1;
        if ($session->getAllianceId() > 0) {
            $alliance_bonus = AllianceBonus::getTradersBonus($session->getAllianceId(), $session->getAllianceJoinTime());
        }
        $merchant_cap = Formulas::merchantCAP(
            Session::getInstance()->getRace(),
            max(Village::getInstance()->getTypeLevel(28)), $alliance_bonus);
        $view->vars['merchantsAvailable'] = $this->building_level - $m->getOfferingMerchantsCount(Village::getInstance()->getKid(), $merchant_cap) - $m->getOnTheWayMerchantsCount(Village::getInstance()->getKid(), $merchant_cap);
        $speed = Formulas::merchantSpeed(Session::getInstance()->getRace());
        if (isset($_GET['g'])) {
            $offer = $m->getOffer((int)$_GET['g']);
            if ($offer !== FALSE) {
                if ($offer['kid'] <> Village::getInstance()->getKid()) {
                    if ($offer['aid'] == 0 || $offer['aid'] == Session::getInstance()->getAllianceId()) {
                        $duration = (round(Formulas::getDistance($offer['kid'], Village::getInstance()->getKid()) / $speed * 3600));
                        $ratio = round($offer['needValue'] / $offer['giveValue'], 1);
                        if ($offer['maxtime'] == 0 || $offer['maxtime'] <= $duration) {
                            $res = array_fill(0, 4, 0);
                            $res[$offer['needType'] - 1] += $offer['needValue'];
                            if (Village::getInstance()->isResourcesAvailable($res)) {
                                if (ceil($offer['needValue'] / $merchant_cap) <= $view->vars['merchantsAvailable']) {
                                    if (Session::getInstance()->banned()) {
                                        $this->innerRedirect("InGameBannedPage");
                                    } else if (Config::getInstance()->dynamic->serverFinished) {
                                        $this->innerRedirect("InGameWinnerPage");
                                    }
                                    if (Village::getInstance()->modifyResources($res)) {
                                        if ($m->deleteOffer($offer['id'])) {
                                            //accept offer here.
                                            $playerId = $m->getVillageOwner($offer['kid']);
                                            $race = $m->getPlayerRace($playerId);
                                            $m->sendResources($offer['kid'], Village::getInstance()->getKid(), $race, $offer['giveType'] == 1 ? $offer['giveValue'] : 0, $offer['giveType'] == 2 ? $offer['giveValue'] : 0, $offer['giveType'] == 3 ? $offer['giveValue'] : 0, $offer['giveType'] == 4 ? $offer['giveValue'] : 0, 1);
                                            $type = [1 => 'wood', 'clay', 'iron', 'crop',][$offer['giveType']];
                                            $db = DB::getInstance();
                                            $m->sendResources(Village::getInstance()->getKid(), $offer['kid'], Session::getInstance()->getRace(), $offer['needType'] == 1 ? $offer['needValue'] : 0, $offer['needType'] == 2 ? $offer['needValue'] : 0, $offer['needType'] == 3 ? $offer['needValue'] : 0, $offer['needType'] == 4 ? $offer['needValue'] : 0, 1);
                                            $quest = Quest::getInstance();
                                            $quest->setQuestBitwise('economy', 7, 1);
                                            $playerName = $db->fetchScalar("SELECT name FROM users WHERE id=$playerId");
                                            $view->vars['offerAccepted'] = TRUE;
                                            $view->vars['offerAcceptTitle'] = sprintf(T("MarketPlace", 'x\'s offering has been accepted'), '<a href="spieler.php?uid=' . $playerId . '">' . $playerName . '</a>');
                                            $view->vars['giveType'] = $offer['giveType'];
                                            $view->vars['giveValue'] = $offer['giveValue'];
                                            $view->vars['needType'] = $offer['needType'];
                                            $view->vars['needValue'] = $offer['needValue'];
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        $offersCount = $m->getOffersCount(Session::getInstance()->getAllianceId(), Village::getInstance()->getKid(), Session::getInstance()->getRace(), $view->vars['r'] == '1:1' ? 1 : 0, $view->vars['s'], $view->vars['b']);
        $page = isset($_REQUEST['page']) ? abs((int)$_REQUEST['page']) : 1;
        $offers = $m->getOffers($page, 20, Session::getInstance()->getAllianceId(), Village::getInstance()->getKid(), Session::getInstance()->getRace(), $view->vars['r'] == '1:1' ? 1 : 0, $view->vars['s'], $view->vars['b']);
        while ($row = $offers->fetch_assoc()) {
            $ratio = round($row['needValue'] / $row['giveValue'], 1);
            if ($ratio <= 1) {
                $class = 'green';
            } elseif ($ratio > 1 && $ratio < 2) {
                $class = 'orange';
            } else {
                $class = 'red';
            }
            $view->vars['content'] .= '<tr>';
            $view->vars['content'] .= '<td class="val"><div class="inlineIconList resourceWrapper"><div class="inlineIcon resources"><i class="r' . $row['giveType'] . '"></i><span class="value ">' . $row['giveValue'] . '</span></div></div></td>';
            $view->vars['content'] .= '<td class="ratio">

				<div class="boxes boxesColor ' . $class . '">
	<div class="boxes-tl"></div>
	<div class="boxes-tr"></div>
	<div class="boxes-tc"></div>
	<div class="boxes-ml"></div>
	<div class="boxes-mr"></div>
	<div class="boxes-mc"></div>
	<div class="boxes-bl"></div>
	<div class="boxes-br"></div>
	<div class="boxes-bc"></div>
	<div class="boxes-contents cf">
				' . $ratio . '
					</div>
</div>
				</td>';
            $view->vars['content'] .= '<td class="val"><div class="inlineIconList resourceWrapper"><div class="inlineIcon resources"><i class="r' . $row['needType'] . '"></i><span class="value ">' . $row['needValue'] . '</span></div></div></td>';
            $owner = $m->getVillageOwner($row['kid']);
            $player = $m->getPlayerRaceAndName($owner);
            $view->vars['content'] .= '<td class="pla">
					<img src="img/x.gif" class="nation nation' . $player['race'] . '">
					<a href="karte.php?d=' . $row['kid'] . '">' . $player['name'] . '</a>
				</td>';
            $duration = secondsToString(round(Formulas::getDistance($row['kid'], Village::getInstance()->getKid()) / $speed * 3600));
            $view->vars['content'] .= '<td class="dur">' . $duration . '</td>';
            $view->vars['content'] .= $this->OfferAction($row, $page, $view->vars['s'], $view->vars['b'], $view->vars['r'], $view->vars['merchantsAvailable'], $merchant_cap);
            $view->vars['content'] .= '</tr>';
        }
        if (!$offers->num_rows) {
            $view->vars['content'] .= '<tr class="none">
        <td colspan="7">' . T("MarketPlace", "noOffers") . '</td>
      </tr>';
        }
        $prefix['id'] = $this->view->vars['index'];
        $prefix['s'] = $view->vars['s'];
        $prefix['b'] = $view->vars['b'];
        $prefix['v'] = $view->vars['r'];
        $prefix['t'] = 1;
        $p = new PageNavigator($page, $offersCount, 20, $prefix, "build.php");
        $view->vars['nav'] = $p->get();
        $this->view->vars['content'] .= $view->output();
    }

    private function OfferAction($row, $page, $s, $b, $v, $available_merchants, $merchant_cap)
    {
        $res = array_fill(0, 4, 0);
        $res[$row['needType'] - 1] += $row['needValue'];
        if (!Village::getInstance()->isResourcesAvailable($res)) {
            return '<td class="act none">' . T("MarketPlace", "not enough resources") . '</td>';
        }
        if (ceil($row['needValue'] / $merchant_cap) > $available_merchants) {
            return '<td class="act none">' . T("MarketPlace", "not enough merchants") . '</td>';
        }
        $ratio = round($row['needValue'] / $row['giveValue'], 1);
        return '<td class="act">' . getButton(["class" => "green",'onclick' => "window.location.href = 'build.php?id=" . $this->view->vars['index'] . "&t=1&v={$v}&a=" . Village::getInstance()->getKid() . "&g={$row['id']}&b={$b}&s={$s}&page={$page}'; return false;",], [], T("MarketPlace", "accept offer")) . '</td>';
    }

    private function Offer()
    {
        $view = new PHPBatchView("build/MarketOffer");
        $view->vars['m1'] = isset($_POST['m1']) ? abs((int)$_POST['m1']) : '';
        $view->vars['m2'] = isset($_POST['m2']) ? abs((int)$_POST['m2']) : '';
        $view->vars['error'] = '';
        $view->vars['success'] = '';
        $m = new MarketModel();
        $village = Village::getInstance();
        if (isset($_GET['del'])) {
            $village->modifyResources($m->cancelOffer(Village::getInstance()->getKid(), (int)$_GET['del']), 1);
        }
        $view->vars['hasAlliance'] = Session::getInstance()->getAllianceId() > 0;
        $view->vars['total_merchants'] = $this->building_level;

        $session = Session::getInstance();
        $alliance_bonus = 1;
        if ($session->getAllianceId() > 0) {
            $alliance_bonus = AllianceBonus::getTradersBonus($session->getAllianceId(), $session->getAllianceJoinTime());
        }

        $merchant_cap = Formulas::merchantCAP(Session::getInstance()->getRace(), max(Village::getInstance()->getTypeLevel(28)), $alliance_bonus);
        $view->vars['merchantsAvailable'] = $this->building_level - $m->getOfferingMerchantsCount(Village::getInstance()->getKid(), $merchant_cap) - $m->getOnTheWayMerchantsCount(Village::getInstance()->getKid(), $merchant_cap);
        if (isset($_POST['m1']) && $_POST['m1'] > 0 && isset($_POST['m2']) && $_POST['m2'] > 0 && $_POST['c'] == Session::getInstance()->getChecker()) {
            Session::getInstance()->changeChecker();
            $_POST['rid1'] = max(min($_POST['rid1'], 4), 1);
            $_POST['rid2'] = max(min($_POST['rid2'], 4), 1);
            $res = array_fill(0, 4, 0);
            $res[max((int)$_POST['rid1'] - 1, 0)] = (int)$_POST['m1'];
            if (!$village->isResourcesAvailable($res)) {
                $view->vars['error'] = T("MarketPlace", "not enough resources");
            } else if ($_POST['m2'] / $_POST['m1'] > 2 || $_POST['m1'] / $_POST['m2'] > 2) {
                $view->vars['error'] = T("MarketPlace", "Unable to create offer; maximum ratio allowed is 2:1");
            } else if ($view->vars['merchantsAvailable'] < ceil($_POST['m1'] / $merchant_cap)) {
                $view->vars['error'] = T("MarketPlace", "not enough merchants");
            } else {
                if (Session::getInstance()->banned()) {
                    $this->innerRedirect("InGameBannedPage");
                } else if (Config::getInstance()->dynamic->serverFinished) {
                    $this->innerRedirect("InGameWinnerPage");
                }
                if ($village->modifyResources($res)) {
                    $m->addOffer(Village::getInstance()->getKid(), isset($_POST['ally']) ? Session::getInstance()->getAllianceId() : 0, isset($_POST['d1']) ? (int)$_POST['d2'] : 0, $_POST['rid2'], (int)$_POST['m2'], $_POST['rid1'], (int)$_POST['m1']);
                    $view->vars['success'] = T("MarketPlace", 'offer added successfully');
                    $view->vars['merchantsAvailable'] -= ceil($_POST['m1'] / $merchant_cap);
                    $quest = Quest::getInstance();
                    $quest->setQuestBitwise('economy', 7, 1);
                }
            }
        }
        $view->vars['buttonId'] = get_button_id();
        $view->vars['checker'] = Session::getInstance()->getChecker();
        $offers = $m->getOwnOffers(Village::getInstance()->getKid());
        $view->vars['hasOffers'] = $offers->num_rows > 0;
        $view->vars['content'] = '';
        while ($row = $offers->fetch_assoc()) {
            $ratio = round($row['needValue'] / $row['giveValue'], 1);
            if ($ratio <= 1) {
                $class = 'green';
            } elseif ($ratio > 1 && $ratio < 2) {
                $class = 'orange';
            } else {
                $class = 'red';
            }
            $view->vars['content'] .= '<tr>';
            $view->vars['content'] .= '<td class="abo"><a href="build.php?gid=17&amp;t=2&amp;a=5&amp;del=' . $row['id'] . '"><img class="del" src="img/x.gif" alt="Delete"></a></td>';
            $view->vars['content'] .= '<td class="val"><div class="inlineIconList resourceWrapper"><div class="inlineIcon resources"><i class="r' . $row['giveType'] . '"></i><span class="value ">' . $row['giveValue'] . '</span></div></div></td>';
            $view->vars['content'] .= '<td class="ratio">

				<div class="boxes boxesColor ' . $class . '">
	<div class="boxes-tl"></div>
	<div class="boxes-tr"></div>
	<div class="boxes-tc"></div>
	<div class="boxes-ml"></div>
	<div class="boxes-mr"></div>
	<div class="boxes-mc"></div>
	<div class="boxes-bl"></div>
	<div class="boxes-br"></div>
	<div class="boxes-bc"></div>
	<div class="boxes-contents cf">
				' . $ratio . '
					</div>
</div>
				</td>';
            $view->vars['content'] .= '<td class="val"><div class="inlineIconList resourceWrapper"><div class="inlineIcon resources"><i class="r' . $row['needType'] . '"></i><span class="value ">' . $row['needValue'] . '</span></div></div></td>';
            $view->vars['content'] .= '<td class="tra">' . ceil($row['giveValue'] / $merchant_cap) . '</td>';
            $view->vars['content'] .= '<td class="al">' . (T("MarketPlace", $row['aid'] > 0 ? 'yes' : 'no')) . '</td>';
            $view->vars['content'] .= '<td class="dur">' . ($row['maxtime'] > 0 ? ($row['maxtime'] / 3600) . ' ' . T("MarketPlace", "hours") : '-') . '</td>';
            $view->vars['content'] .= '</tr>';
        }
        $this->view->vars['content'] .= $view->output();
    }

    private function sendResources()
    {
        $view = new PHPBatchView("build/MarketSendResources");
        $m = new MarketModel();
        $view->vars['x'] = '';
        $view->vars['y'] = '';
        $view->vars['dname'] = '';
        $this->build->view->newVillagePrefix['t'] = 5;
        if (isset($_GET['z'])) {
            $xy = Formulas::kid2xy((int)$_GET['z']);
            $view->vars['x'] = $xy['x'];
            $view->vars['y'] = $xy['y'];
            $this->build->view->newVillagePrefix['z'] = (int)$_GET['z'];
        }
        if (isset($_GET['dname'])) {
            $view->vars['dname'] = $_GET['dname'];
        }
        if (isset($_GET['x']) && $_GET['x'] != "") {
            $view->vars['x'] = Formulas::coordinateFixer($_GET['x']);
            $view->vars['y'] = Formulas::coordinateFixer($_GET['y']);
        }
        $session = Session::getInstance();
        $alliance_bonus = 1;
        if ($session->getAllianceId() > 0) {
            $alliance_bonus = AllianceBonus::getTradersBonus($session->getAllianceId(), $session->getAllianceJoinTime());
        }

        $merchant_cap = Formulas::merchantCAP(Session::getInstance()->getRace(), max(Village::getInstance()->getTypeLevel(28)), $alliance_bonus);
        $view->vars['total_merchants'] = $this->building_level;
        $view->vars['merchantsAvailable'] = $this->building_level - $m->getOfferingMerchantsCount(Village::getInstance()->getKid(), $merchant_cap) - $m->getOnTheWayMerchantsCount(Village::getInstance()->getKid(), $merchant_cap);
        $view->vars['merchantCapacityValue'] = $merchant_cap;
        $view->vars['hasGoldClub'] = Session::getInstance()->hasGoldClub();
        $view->vars['hasPlus'] = Session::getInstance()->hasPlus();
        $view->vars['index'] = $this->view->vars['index'];
        $view->vars['merchantsOnTheWay'] = '';
        $return = $m->getReturningMerchants(Village::getInstance()->getKid());
        if ($return->num_rows) {
            $view->vars['merchantsOnTheWay'] .= '<h4 class="spacer">' . T("MarketPlace", "onReturnMerchants") . ':</h4>';
            while ($row = $return->fetch_assoc()) {
                $view->vars['merchantsOnTheWay'] .= $m->renderMovement(Village::getInstance()->getKid(), $row);
            }
        }
        $return = $m->getIncomingMerchants(Village::getInstance()->getKid());
        if ($return->num_rows) {
            $view->vars['merchantsOnTheWay'] .= '<h4 class="spacer">' . T("MarketPlace", "onComingMerchants") . ':</h4>';
            while ($row = $return->fetch_assoc()) {
                $view->vars['merchantsOnTheWay'] .= $m->renderMovement(Village::getInstance()->getKid(), $row);
            }
        }
        $return = $m->getOutGoingMerchants(Village::getInstance()->getKid());
        if ($return->num_rows) {
            $view->vars['merchantsOnTheWay'] .= '<h4 class="spacer">' . T("MarketPlace", "onGoingMerchants") . ':</h4>';
            while ($row = $return->fetch_assoc()) {
                $view->vars['merchantsOnTheWay'] .= $m->renderMovement(Village::getInstance()->getKid(), $row);
            }
        }
        $this->view->vars['content'] .= $view->output();
    }

    private function Management()
    {
        $usePeriodicTradeRoutes = Config::getInstance()->game->usePeriodicTradeRoutes;
        $session = Session::getInstance();
        $alliance_bonus = 1;
        if ($session->getAllianceId() > 0) {
            $alliance_bonus = AllianceBonus::getTradersBonus($session->getAllianceId(), $session->getAllianceJoinTime());
        }

        $merchant_cap = Formulas::merchantCAP(Session::getInstance()->getRace(), max(Village::getInstance()->getTypeLevel(28)), $alliance_bonus);
        $m = new MarketModel();
        $view = new PHPBatchView("build/MarketPlaceManagement");
        $helper = new GoldHelper();
        $view->vars['exchangeButton'] = $helper->getExchangeResourcesButtonByCost(-1);
        $view->vars['kid'] = Village::getInstance()->getKid();
        $view->vars['total_on_the_way'] = $m->getOnTheWayMerchantsCount(Village::getInstance()->getKid(), $merchant_cap);
        $view->vars['total_offering'] = $m->getOfferingMerchantsCount(Village::getInstance()->getKid(), $merchant_cap);
        $view->vars['total'] = $this->building_level;
        $view->vars['total_available'] = $this->building_level - $view->vars['total_offering'] - $view->vars['total_on_the_way'];
        $this->view->vars['content'] .= $view->output();
        if (!Session::getInstance()->hasGoldClub()) {
            $view = new PHPBatchView("build/TradeRouteNoClub");
            $view->vars['goldClubButtonId'] = get_button_id();
            $this->view->vars['content'] .= $view->output();
            return;
        }
        if (Session::getInstance()->isInVacationMode() && WebService::isPost()) {
            $this->redirect("options.php?s=4");
        }
        $this->view->vars['content'] .= '<h4 class="spacer round">' . T("MarketPlace", "Trade routes") . '</h4>';
        $total_merchants = $view->vars['total'];
        $total_available_merchants = $view->vars['total_available'];
        //next trade route
        $next = $m->getIncomingTradeRoute(Village::getInstance()->getKid());
        if ($next !== FALSE) {
            $total = $next['r1'] + $next['r2'] + $next['r3'] + $next['r4'];
            if ($usePeriodicTradeRoutes) {
                $this->view->vars['content'] .= '<p>' . sprintf(T("MarketPlace", "nextTradeRoute"), TimezoneHelper::date("H:i", $next['time']), ceil($total / $merchant_cap)) . '</p>';
            } else {

                $this->view->vars['content'] .= '<p>' . sprintf(T("MarketPlace", "nextTradeRoute"), $next['start_hour'], ceil($total / $merchant_cap)) . '</p>';
            }
        }
        if (!isset($_REQUEST['option'])) {
            $this->showTradeRoutes($merchant_cap);
        } else if ($_REQUEST['option'] == 1) {
            $destination = isset($_REQUEST['show-destination']) && in_array($_REQUEST['show-destination'], ['all', 'only-mine', 'others']) ? $_REQUEST['show-destination'] : 'all';
            if (WebService::isPost() && $_POST['c'] == Session::getInstance()->getChecker() && isset($_POST['did_dest'])) {
                $repeat = max(min((int)$_POST['repeat'], 3), 1);
                if ($usePeriodicTradeRoutes) {
                    $hour = max(min((int)$_POST['hour'], 30 * 86400), 600);
                } else {
                    $hour = max(min((int)$_POST['hour'], 23), 0);
                }
                $r1 = abs((int)$_POST['r1']);
                $r2 = abs((int)$_POST['r2']);
                $r3 = abs((int)$_POST['r3']);
                $r4 = abs((int)$_POST['r4']);
                $did_dest = abs((int)$_POST['did_dest']);
                if (($r1 + $r2 + $r3 + $r4) &&
                    $m->isVillageMine($did_dest, Session::getInstance()->getAllianceId(), Session::getInstance()->getPlayerId(), $destination) &&
                    ceil(($r1 + $r2 + $r3 + $r4) / $merchant_cap) <= $total_merchants) {
                    $m->addTradeRoute(Village::getInstance()->getKid(), $did_dest, $r1, $r2, $r3, $r4, $hour, $repeat, true);
                }
                Session::getInstance()->changeChecker();
                $this->showTradeRoutes($merchant_cap);
                return;
            }
            $view = new PHPBatchView("build/tradeRouteAdd");
            $view->vars['total_merchant'] = $total_merchants;
            $view->vars['available_merchants'] = $total_available_merchants;
            $view->vars['cap'] = $merchant_cap;
            $view->vars['destination'] = $destination;
            $view->vars['checker'] = Session::getInstance()->getChecker();
            $view->vars['did_dest'] = '';
            $villages = $m->getTradeRouteVillage(Session::getInstance()->getAllianceId(), Session::getInstance()->getPlayerId(), Village::getInstance()->getKid(), $view->vars['destination']);
            while ($row = $villages->fetch_assoc()) {
                $xy = Formulas::kid2xy($row['kid']);
                $view->vars['did_dest'] .= '<option value="' . $row['kid'] . '">' . sprintf('%s (%s | %s)', $row['name'], $xy['x'], $xy['y']) . '</option>';
            }
            $view->vars['edit'] = FALSE;
            $view->vars['r1'] = $view->vars['r2'] = $view->vars['r3'] = $view->vars['r4'] = $view->vars['hour'] = $view->vars['times'] = 0;
            $this->view->vars['content'] .= $view->output();
        } else if ($_REQUEST['option'] == 2) {
            $destination = isset($_REQUEST['show-destination']) && in_array($_REQUEST['show-destination'], ['all', 'only-mine', 'others',]) ? $_REQUEST['show-destination'] : 'all';
            $find = $m->getTradeRoute(Village::getInstance()->getKid(), (int)$_REQUEST['trid']);
            if (WebService::isPost() && $_POST['c'] == Session::getInstance()->getChecker()) {
                $repeat = max(min((int)$_POST['repeat'], 3), 1);
                if ($usePeriodicTradeRoutes) {
                    $hour = max(min((int)$_POST['hour'], 86400), 600);
                } else {
                    $hour = max(min((int)$_POST['hour'], 23), 0);
                }
                $r1 = abs((int)$_POST['r1']);
                $r2 = abs((int)$_POST['r2']);
                $r3 = abs((int)$_POST['r3']);
                $r4 = abs((int)$_POST['r4']);
                $did_dest = abs((int)$_POST['did_dest']);
                if (($r1 + $r2 + $r3 + $r4) && $m->isVillageMine($did_dest, Session::getInstance()->getAllianceId(), Session::getInstance()->getPlayerId(), $destination) && ceil(($r1 + $r2 + $r3 + $r4) / $merchant_cap) <= $total_merchants) {
                    $m->updateTradeRoute((int)$_REQUEST['trid'], $did_dest, $r1, $r2, $r3, $r4, $hour, $repeat, true);
                }
                Session::getInstance()->changeChecker();
                $this->showTradeRoutes($merchant_cap);
                return;
            }
            $view = new PHPBatchView("build/tradeRouteAdd");
            $view->vars['total_merchant'] = $total_merchants;
            $view->vars['available_merchants'] = $total_available_merchants;
            $view->vars['cap'] = $merchant_cap;
            $view->vars['destination'] = $destination;
            $view->vars['checker'] = Session::getInstance()->getChecker();
            $view->vars['did_dest'] = '';
            $villages = $m->getTradeRouteVillage(Session::getInstance()->getAllianceId(), Session::getInstance()->getPlayerId(), Village::getInstance()->getKid(), $view->vars['destination']);
            while ($row = $villages->fetch_assoc()) {
                $xy = Formulas::kid2xy($row['kid']);
                $view->vars['did_dest'] .= '<option value="' . $row['kid'] . '" ' . ($row['kid'] == $find['to_kid'] ? 'selected="selected"' : '') . '>' . sprintf('%s (%s | %s)', $row['name'], $xy['x'], $xy['y']) . '</option>';
            }
            $view->vars['trid'] = $find['id'];
            $view->vars['edit'] = TRUE;
            $view->vars['r1'] = $find['r1'];
            $view->vars['r2'] = $find['r2'];
            $view->vars['r3'] = $find['r3'];
            $view->vars['r4'] = $find['r4'];
            $view->vars['hour'] = $find['start_hour'];
            $view->vars['times'] = $find['times'];
            $this->view->vars['content'] .= $view->output();
        } else if ($_REQUEST['option'] == 4 && $_REQUEST['c'] == Session::getInstance()->getChecker()) {
            Session::getInstance()->changeChecker();
            $m->deleteTradeRoute(Village::getInstance()->getKid(), (int)$_REQUEST['trid']);
            $this->showTradeRoutes($merchant_cap);
        } else {
            $this->showTradeRoutes($merchant_cap);
        }
    }

    private function showTradeRoutes($merchant_cap)
    {
        $usePeriodicTradeRoutes = Config::getInstance()->game->usePeriodicTradeRoutes;
        $view = new PHPBatchView("build/tradeRouteShow");
        $view->vars['content'] = '';
        $view->vars['sortId'] = substr(PreferencesHelper::getPreference('tradeRoutesOrder'), 0, 1);
        $view->vars['sortBy'] = substr(PreferencesHelper::getPreference('tradeRoutesOrder'), 1, 1);
        $view->vars['sortBy'] = $view->vars['sortBy'] == 'a' ? 'asc' : 'desc';
        $m = new MarketModel();
        $tradeRoutes = $m->getTradeRoutes(Village::getInstance()->getKid(), $view->vars['sortId'], $view->vars['sortBy'] == 'desc');
        while ($row = $tradeRoutes->fetch_assoc()) {
            if ($usePeriodicTradeRoutes) {
                $start = getTradeRouteTimeText($row['start_hour']);
            } else {
                $start = ($row['start_hour'] < 10 ? '0' . $row['start_hour'] : $row['start_hour']) . ':00';
            }
            $view->vars['content'] .= '<tr>';
            $view->vars['content'] .= '<td class="sel">
            <a href="build.php?gid=17&amp;t=0&amp;a=1&amp;c=' . Session::getInstance()->getChecker() . '&amp;option=4&amp;trid=' . $row['id'] . '" title="' . T("MarketPlace", "Delete") . '">
                <img alt="' . T("MarketPlace", "Delete") . '" src="img/x.gif" class="del" />
            </a>
        </td>';
            $style = '';
            if (getDisplay("smallResourcesFontSize")) {
                $style = 'font-size: 11px;';
            }
            $view->vars['content'] .= '<td class="desc">
            ' . sprintf(T("MarketPlace", "Trade route to x"), $m->getVillageName($row['to_kid'])) . '
                <div class="res">
                    <div><i class="r1"></i><span style="' . $style . '">' . number_format_x($row['r1']) . '</span></div>
                    <div><i class="r2"></i><span style="' . $style . '">' . number_format_x($row['r2']) . '</span></div>
                    <div><i class="r3"></i><span style="' . $style . '">' . number_format_x($row['r3']) . '</span></div>
                    <div><i class="r4"></i><span style="' . $style . '">' . number_format_x($row['r4']) . '</span></div>
                </div>
            </div>
        </td>
        <td class="start">
            ' . $start . '
        </td>
        <td class="trad">
            ' . $row['times'] . 'x' . ceil(($row['r1'] + $row['r2'] + $row['r3'] + $row['r4']) / $merchant_cap) . '
        </td>
        <td>
            <a class="a arrow"
               href="build.php?gid=17&amp;t=0&amp;a=1&amp;c=' . Session::getInstance()->getChecker() . '&amp;option=2&amp;trid=' . $row['id'] . '&amp;show-destination=all"
               title="' . T("MarketPlace", "edit") . '"
                >' . T("MarketPlace", "edit") . '</a>
        </td>
 <td>
            <input type="checkbox"
                   ' . ($row['enabled'] ? 'checked="checked"' : '') . '
                   onclick="Travian.Game.Marketplace.toggleTradeRoutes(\'' . $row['id'] . '\', this);"
                />
        </td>
        ';
            $view->vars['content'] .= '</tr>';
        }
        if (!$tradeRoutes->num_rows) {
            $view->vars['content'] = '<tr><td colspan="6" class="noData">' . T("MarketPlace", "noRoute") . '</td></tr>';
        }
        $this->view->vars['content'] .= $view->output();
    }
} 