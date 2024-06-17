<?php

namespace Controller\Ajax;

use Core\Config;
use Core\Database\DB;
use Core\Session;
use Core\Village;
use Game\AllianceBonus\AllianceBonus;
use Game\Formulas;
use Core\Locale;
use Model\MarketModel;
use resources\View\PHPBatchView;

class prepareMarketplace extends AjaxBase
{
    public function dispatch()
    {
        $this->response['error'] = FALSE;
        $this->response['errorMsg'] = NULL;
        $this->response['data']['errorMessage'] = "";
        $this->response['data']['notice'] = "";
        $this->response['data']['button'] = "";
        $this->response['data']['formular'] = "";
        if (!isset($_POST['dname'])) {
            $_POST['dname'] = '';
        }
        if (!isset($_POST['x'])) {
            $_POST['x'] = '';
        }
        if (!isset($_POST['y'])) {
            $_POST['y'] = '';
        }
        if ((isset($_POST['a']) && $_POST['a'] == Village::getInstance()->getKid()) && (isset($_POST['c']) && $_POST['c'] == Session::getInstance()->getChecker())) {
            $this->send((int)$_POST['t'],
                (int)$_POST['id'],
                (int)$_POST['sz'],
                (int)$_POST['kid'],
                (int)$_POST['x2'],
                (int)$_POST['r1'],
                (int)$_POST['r2'],
                (int)$_POST['r3'],
                (int)$_POST['r4']);
            Session::getInstance()->changeChecker();
        } else {
            $this->prepare((int)$_POST['r1'],
                (int)$_POST['r2'],
                (int)$_POST['r3'],
                (int)$_POST['r4'],
                filter_var($_POST['dname'], FILTER_SANITIZE_STRING),
                $_POST['x'],
                $_POST['y'],
                (int)$_POST['id'],
                (int)$_POST['t'],
                (int)$_POST['x2']);
        }
    }

    public function send($t, $id, $sz, $kid, $x2, $r1, $r2, $r3, $r4)
    {
        $db = DB::getInstance();
        if (Session::getInstance()->banned()) {
            $this->response['data']['errorMessage'] = T("MarketPlace", "you are banned");
            return;
        }

        if (Session::getInstance()->isInVacationMode()) {
            $this->response['data']['errorMessage'] = T("MarketPlace", "you are in vacationMode");
            return;
        }
        if (!$db->fetchScalar("SELECT COUNT(kid) FROM vdata WHERE kid=$kid")) {
            $this->response['data']['errorMessage'] = T("MarketPlace", "noVillageInCoordinate");
            return;
        }
        $resources = [$r1, $r2, $r3, $r4];
        if (!Village::getInstance()->isResourcesAvailable($resources)) {
            $this->response['data']['errorMessage'] = "Abuse! You have not enough resources.";
            return;
        }
        $x2 = min(Session::getInstance()->hasGoldClub() ? 3 : (Session::getInstance()->hasPlus() ? 2 : 1), $x2);
        //check if the request is from marketplace and village has marketplace!
        if (Village::getInstance()->getField($id)['item_id'] <> 17) {
            $this->response['data']['errorMessage'] = "Abuse! The request is not from marketplace.";
            return;
        }
        //check if the marketplace level is upper than 0
        if (!Village::getInstance()->hasMarketPlace()) {
            $this->response['data']['errorMessage'] = "Abuse! The marketplace level is 0 and is not allowed to send resources.";
            return;
        }
        //check resources are entered or not!
        if (($r1 + $r2 + $r3 + $r4) <= 0) {
            $this->response['data']['errorMessage'] = T("MarketPlace", "noResourcesEntered");
            return;
        }
        if ($kid == Session::getInstance()->getKid()) {
            $this->response['data']['errorMessage'] = T("MarketPlace", "sameVillage");
            return;
        }
        if (!$db->fetchScalar("SELECT COUNT(kid) FROM vdata WHERE kid=$kid")) {
            $this->response['data']['errorMessage'] = T("MarketPlace", "noVillageInCoordinate");
            return;
        }
        $m = new MarketModel();
        $uid = $m->getVillageOwner($kid);
        if ($uid != Session::getInstance()->getPlayerId() && !Session::getInstance()->checkSitterPermission(Session::SITTER_CAN_SEND_RESOURCES)) {
            $this->response['data']['errorMessage'] = T("MarketPlace", "sitterNoPermissions");
            return;
        }
        $session = Session::getInstance();

        if ($uid <> $session->getPlayerId() && Session::getInstance()->hasProtection()) {
            $this->response['data']['errorMessage'] = T("MarketPlace", "You are under protection");
            return;
        }

        $alliance_bonus = 1;
        if ($session->getAllianceId() > 0) {
            $alliance_bonus = AllianceBonus::getTradersBonus($session->getAllianceId(),
                $session->getAllianceJoinTime());
        }
        $merchant_cap = Formulas::merchantCAP(Session::getInstance()->getRace(), max(Village::getInstance()->getTypeLevel(28)), $alliance_bonus);
        $merchantsNeeded = ceil(($r1 + $r2 + $r3 + $r4) / $merchant_cap);
        $merchants_available = Village::getInstance()->hasMarketPlace() - $m->getOnTheWayMerchantsCount(Village::getInstance()->getKid(), $merchant_cap) - $m->getOfferingMerchantsCount(Session::getInstance()->getKid(), $merchant_cap);
        if ($merchantsNeeded > $merchants_available) {
            $this->response['errorMessage'] = T("MarketPlace", "not enough merchants");
            return;
        }
        if (Village::getInstance()->modifyResources($resources)) {
            $m->sendResources(Session::getInstance()->getKid(), $kid, Session::getInstance()->getRace(), $r1, $r2, $r3, $r4, $x2);
            $this->response['data']['notice'] = T("MarketPlace", "resourcesSent");
            $view = new PHPBatchView('build/marketPlaceGoBack');
            $view->vars['dname'] = null;
            $view->vars['x'] = null;
            $view->vars['y'] = null;
            $view->vars['x2'] = null;
            $this->response['data']['formular'] = $view->output();
            $this->response['data']['button'] = PHPBatchView::render('build/prepare_button');
        }
    }

    public function prepare($r1, $r2, $r3, $r4, $dname, $x, $y, $id, $t, $x2)
    {
        $dname = DB::getInstance()->real_escape_string($dname);
        if (Config::getInstance()->dynamic->serverFinished) {
            $this->response['data']['errorMessage'] = T("MarketPlace", "serverFinished");
            return;
        }
        if (Session::getInstance()->banned()) {
            $this->response['data']['errorMessage'] = T("MarketPlace", "you are banned");
            return;
        }
        if (Session::getInstance()->isInVacationMode()) {
            $this->response['data']['errorMessage'] = T("MarketPlace", "you are in vacationMode");
            return;
        }
        $resources = [$r1, $r2, $r3, $r4];
        if (!Village::getInstance()->isResourcesAvailable($resources)) {
            $this->response['data']['errorMessage'] = "Abuse! You have not enough resources.";
            return;
        }
        $x2 = min(Session::getInstance()->hasGoldClub() ? 3 : (Session::getInstance()->hasPlus() ? 2 : 1), $x2);
        //check if the request is from marketplace and village has marketplace!
        if (Village::getInstance()->getField($id)['item_id'] <> 17) {
            $this->response['data']['errorMessage'] = "Abuse! The request is not from marketplace.";
            return;
        }
        //check if the marketplace level is upper than 0
        if (!Village::getInstance()->hasMarketPlace()) {
            $this->response['data']['errorMessage'] = "Abuse! The marketplace level is 0 and is not allowed to send resources.";
            return;
        }
        //check resources are entered or not!
        if (($r1 + $r2 + $r3 + $r4) <= 0) {
            $this->response['data']['errorMessage'] = T("MarketPlace", "noResourcesEntered");
            return;
        }
        $m = new MarketModel();
        $session = Session::getInstance();
        $alliance_bonus = 1;
        if ($session->getAllianceId() > 0) {
            $alliance_bonus = AllianceBonus::getTradersBonus($session->getAllianceId(),
                $session->getAllianceJoinTime());
        }
        $merchant_cap = Formulas::merchantCAP(Session::getInstance()->getRace(), max(Village::getInstance()->getTypeLevel(28)), $alliance_bonus);
        $merchantsNeeded = ceil(($r1 + $r2 + $r3 + $r4) / $merchant_cap);
        $merchants_available = Village::getInstance()->hasMarketPlace() - $m->getOnTheWayMerchantsCount(Village::getInstance()->getKid(), $merchant_cap) - $m->getOfferingMerchantsCount(Session::getInstance()->getKid(), $merchant_cap);
        if ($merchantsNeeded > $merchants_available) {
            $this->response['errorMessage'] = T("MarketPlace", "not enough merchants");
            return;
        }
        $myUID = $session->getPlayerId();
        $myKID = $session->getKid();
        $db = DB::getInstance();
        if (empty($dname) && (!is_numeric($x) || !is_numeric($y))) {
            $this->response['data']['errorMessage'] = T("MarketPlace", "enterVillageNameOrCoordinate");
            return;
        } else if (!empty($dname) && (!is_numeric($x) || !is_numeric($y))) {
            $kid = $db->fetchScalar("SELECT kid FROM vdata WHERE kid!=$myKID AND name='$dname' ORDER BY (owner=$myUID) DESC");
            if (!$kid) {
                $this->response['data']['errorMessage'] = T("MarketPlace", "noVillageWithName");
                return;
            }
        } else {
            $kid = Formulas::xy2kid($x, $y);
            if (!$db->fetchScalar("SELECT COUNT(kid) FROM vdata WHERE kid=" . $kid)) {
                $this->response['data']['errorMessage'] = T("MarketPlace", "noVillageInCoordinate");
                return;
            }
        }
        if ($kid == Session::getInstance()->getKid()) {
            $this->response['data']['errorMessage'] = T("MarketPlace", "sameVillage");
            return;
        }
        $uid = $m->getVillageOwner($kid);
        $player = $m->getPlayerRow($uid, 'name, aid, access');
        if ($player['access'] == 0) {
            $this->response['data']['errorMessage'] = T("MarketPlace", "PlayerBanned");
            return;
        }
        if ($uid != Session::getInstance()->getPlayerId() && !Session::getInstance()->checkSitterPermission(Session::SITTER_CAN_SEND_RESOURCES)) {
            $this->response['data']['errorMessage'] = T("MarketPlace", "sitterNoPermissions");
            return;
        }

        if ($uid <> $session->getPlayerId() && Session::getInstance()->hasProtection()) {
            $this->response['data']['errorMessage'] = T("MarketPlace", "You are under protection");
            return;
        }

        $allianceName = $db->fetchScalar("SELECT tag FROM alidata WHERE id=" . $player['aid']);
        $speed = Formulas::merchantSpeed(Session::getInstance()->getRace());
        $durationInSeconds = secondsToString(round(Formulas::getDistance(Session::getInstance()->getKid(),
                $kid) / $speed * 3600));
        $view = new PHPBatchView("build/send_resources");
        $xy = Formulas::kid2xy($kid);
        $view->vars['index'] = $id;
        $view->vars['x'] = $xy['x'];
        $view->vars['y'] = $xy['y'];
        $view->vars['uid'] = $uid;
        $view->vars['playerName'] = $player['name'];
        $view->vars['allianceName'] = $allianceName;
        $view->vars['durationInSeconds'] = $durationInSeconds;
        $view->vars['dname'] = $m->getVillageName($kid, FALSE);
        $view->vars['my_kid'] = Session::getInstance()->getKid();
        $view->vars['kid'] = $kid;
        $view->vars['checker'] = Session::getInstance()->getChecker();
        $view->vars['merchantsNeeded'] = $merchantsNeeded;
        $view->vars['x2'] = $x2;
        $this->response['data']['formular'] = $view->output();
        $this->response['data']['button'] .= getButton([
            "type"    => "button",
            "class"   => "green goBack",
            "value"   => T("MarketPlace", "goBack"),
            "onclick" => "marketPlace.goBack()",
        ],
            [],
            T("MarketPlace", "goBack"));
        $this->response['data']['button'] .= getButton([
            "type"    => "button",
            "id"      => "enabledButton",
            "class"   => "green sendRessources prepare",
            "value"   => T("MarketPlace", "SendResources"),
            "onclick" => "marketPlace.sendRessources()",
        ],
            [],
            T("MarketPlace", "SendResources"));
    }
}