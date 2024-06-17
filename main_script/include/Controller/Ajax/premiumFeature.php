<?php

namespace Controller\Ajax;

use function array_key_exists;
use function array_search;
use function array_sum;
use function array_values;
use Core\Config;
use Core\Database\DB;
use Core\Database\GlobalDB;
use Core\Helper\TimezoneHelper;
use Core\Helper\WebService;
use Core\Session;
use Core\Village;
use Game\Buildings\BuildingAction;
use Game\ExtraModules;
use Game\Formulas;
use Game\GoldHelper;
use Game\ResourcesHelper;
use function miliseconds;
use Model\AutoExtendModel;
use Model\DailyQuestModel;
use Model\InfoBoxModel;
use Model\MovementsModel;
use Model\OptionModel;
use Model\TrainingModel;
use Model\VillageModel;
use Model\BattleSetter;
use resources\View\PHPBatchView;

class premiumFeature extends AjaxBase
{
    public function dispatch()
    {
        $featureKey = $_REQUEST['featureKey'];
        if ($featureKey == 'buyAnimal') {
            return;
        }
        if (!Session::getInstance()->checkSitterPermission(Session::SITTER_CAN_BUY_OR_SPEND_GOLD)) {
            $this->response['error'] = TRUE;
            $this->response['errorMsg'] = T("inGame", 'sitterNoPermForGold');
            return;
        }
        if ((Session::getInstance()->banned() && Session::getInstance()->getPlayerId() > 2) || Config::getInstance()->dynamic->serverFinished) {
            $this->response['error'] = TRUE;
            $this->response['errorMsg'] = T("inGame", 'bannedSmallPage');
            return;
        }
        $methodKey = $featureKey;
        if (substr($featureKey, 0, 14) == 'moreProtection') {
            $methodKey = 'moreProtection';
        } else if (substr($featureKey, 0, 9) == 'buyAnimal') {
            $methodKey = 'buyAnimal';
        } else if (substr($featureKey, 0, 12) == 'buyResources') {
            $methodKey = 'buyResources';
        } else if (substr($featureKey, 0, 9) == 'buyTroops') {
            $methodKey = 'buyTroops';
        }else if (substr($featureKey, 0, 12) == 'buyBuildings') {
            $methodKey = 'buyBuildings';
        }
        if (method_exists($this, $methodKey)) {
            if ($this->checkGold($featureKey)) {
                if ($featureKey != 'finishNow' && $featureKey != 'exchangeSilver') {
                    $this->setContext($featureKey);
                }
                if (substr($featureKey, 0, 14) == 'moreProtection') {
                    $this->moreProtection($featureKey);
                } else if (substr($featureKey, 0, 9) == 'buyAnimal') {
                    $this->buyAnimal($featureKey);
                } else if (substr($featureKey, 0, 12) == 'buyResources') {
                    $this->buyResources($featureKey);
                } else if (substr($featureKey, 0, 9) == 'buyTroops') {
                    $this->buyTroops($featureKey);
                }else if (substr($featureKey, 0, 12) == 'buyBuildings') {
                    $this->buyBuildings($featureKey);
                } else {
                    $this->$featureKey();
                }
            }
        } else if (ExtraModules::actionExists($featureKey)) {
            if ($this->checkGold($featureKey)) {
                $this->setContext($featureKey);
                ExtraModules::runAction($featureKey,
                    $this->response,
                    isset($_POST['additionalData']) ? $_POST['additionalData'] : NULL);
            }
        } else {
            $this->response['error'] = TRUE;
            $this->response['errorMsg'] = 'Invalid featureKey.';
        }
    }

    private function checkGold($featureKey)
    {
        $config = Config::getInstance();
        $paymentGolds = [
            'exchangeSilver'          => 0,
            'transferGold'            => 0,
            'finishNow'               => $config->gold->finishNowGold,
            'goldclub'                => $config->gold->goldClubGold,
            'plus'                    => $config->gold->plusGold,
            'productionboostWood'     => $config->gold->productionBoostGold,
            'productionboostClay'     => $config->gold->productionBoostGold,
            'productionboostIron'     => $config->gold->productionBoostGold,
            'productionboostCrop'     => $config->gold->productionBoostGold,
            'demolishNow'             => $config->gold->completeDemolishGold,
            'ChangeAccountName'       => $config->gold->accountChangeNameGold,
            'constructionMaster'      => $config->gold->masterBuilderGold,
            'marketplace'             => $config->gold->exchangeResourcesGold,
            'VacationModeAbort'       => $config->gold->vacationAbortGold,
            'atkBonus'                => $config->extraSettings->power->atkBonus->coins,
            'defBonus'                => $config->extraSettings->power->defBonus->coins,
            'oneHourOfProduction'     => $config->extraSettings->generalOptions->oneHourOfProduction->coins,
            'fasterTraining'          => $config->extraSettings->generalOptions->fasterTraining->coins,
            'academyResearchAll'      => $config->extraSettings->generalOptions->academyResearchAll->coins,
            'smithyUpgradeAllToMax'   => $config->extraSettings->generalOptions->smithyUpgradeAllToMax->coins,
            'cancelTrainingQueue'     => $config->extraSettings->generalOptions->cancelTrainingQueue->coins,
            'AllianceBonusDonation'   => Config::getProperty("gold", "allianceBonus3xGold"),

            //'upgradeAllResourcesTo20' => Village::getInstance()->isCapital() ? $config->extraSettings->generalOptions->upgradeAllResourcesTo20->coinsCapital : $config->extraSettings->generalOptions->upgradeAllResourcesTo20->coinsNoNCapital,
            //'upgradeAllResourcesTo30' => $config->extraSettings->generalOptions->upgradeAllResourcesTo30->coins,
            //'rallyPointTo20'          => $config->extraSettings->generalOptions->rallyPointTo20->coins,
            
        ];
        foreach ($config->extraSettings->moreProtection->packages as $index => $package) {
            $paymentGolds['moreProtection' . $index] = $package['coins'];
        }
        foreach ($config->extraSettings->buyAnimal['packages'] as $index => $package) {
            $paymentGolds['buyAnimal' . $index] = $package['coins'];
        }
        foreach ($config->extraSettings->buyTroops['packages'] as $tid =>  $troop) {
            foreach ($troop as $index => $package) {
                $paymentGolds['buyTroops' .$tid. $index] = $package['coins'];
            }
        }
        foreach ($config->extraSettings->buyBuildings['packages'] as $index => $package) {
            $paymentGolds['buyBuildings' . $index] = (Village::getInstance()->isCapital() && isset($package->coinsCapital))? $package->coinsCapital : $package->coins;
        }
        foreach ($config->extraSettings->buyResources['packages'] as $index => $package) {
            $paymentGolds['buyResources' . $index] = $package['coins'];
        }
        if (!isset($paymentGolds[$featureKey])) {
            $paymentGolds[$featureKey] = ExtraModules::getCoins($featureKey);
        }
        if ($paymentGolds[$featureKey] === FALSE) {
            return true;
        }
        if (Session::getInstance()->getAvailableGold() >= $paymentGolds[$featureKey]) {
            return TRUE;
        }
        $features = [
            0 => 'plus',
            1 => 'productionboostWood',
            2 => 'productionboostClay',
            3 => 'productionboostIron',
            4 => 'productionboostCrop',
        ];
        if (isset($_REQUEST['toggleAutoprolong']) && in_array($featureKey, array_values($features))) {
            if ($featureKey == 'plus') {
                $end = Session::getInstance()->plusTill();
            } else {
                $end = Session::getInstance()->productionBoostTill(array_search($featureKey, $features));
            }
            if ($end > 0) {
                return true;
            }
        }
        $neededGold = $paymentGolds[$featureKey] - Session::getInstance()->getGold();
        $this->response['data'] = array_merge($this->response['data'],
            self::renderBuyPackageSmallestPackageDialog($neededGold));
        return FALSE;
    }

    public static function renderBuyPackageSmallestPackageDialog($neededGold)
    {
        global $globalConfig;
        $data = [];
        $def = $globalConfig['staticParameters']['default_payment_location'];
        //package here.
        $data['functionToCall'] = 'renderDialog';
        $data['options']['dialogOptions']['infoIcon'] = 'http://t4.answers.travian.com/index.php?aid=368#go2answer';
        $data['options']['dialogOptions']['saveOnUnload'] = FALSE;
        $data['options']['dialogOptions']['draggable'] = FALSE;
        $data['options']['dialogOptions']['buttonOk'] = FALSE;
        $data['options']['dialogOptions']['context'] = 'smallestPackage';
        $result = GlobalDB::getInstance()->query("SELECT * FROM locations");
        $locations = [];
        while ($row = $result->fetch_assoc()) {
            $locations[$row['id']] = $row;
        }
        $selectedLocation = isset($_REQUEST['goldProductLocation']) && !empty($_REQUEST['goldProductLocation']) ? (int)$_REQUEST['goldProductLocation'] : isset($_SESSION[Session::getInstance()->fixSessionPrefix('default_payment_location')]) ? $_SESSION[Session::getInstance()->fixSessionPrefix('default_payment_location')] : $def;
        $Found = FALSE;
        foreach ($locations as $location) {
            if ($location['id'] == $selectedLocation) {
                $Found = TRUE;
            }
        }
        if (!$Found) {
            $selectedLocation = $def;
        }
        $_SESSION[WebService::fixSessionPrefix('default_payment_location')] = $selectedLocation;
        $view = new PHPBatchView("payment/showLowGold");
        $products = self::getLocationProducts($selectedLocation);
        $product = $products[0];
        foreach ($products as $pro) {
            if ($pro['goldProductGold'] >= $neededGold) {
                $product = $pro;
                break;
            }
        }
        $view->vars['goldNum'] = $product['goldProductGold'];
        $view->vars['goldProductId'] = $product['goldProductId'];
        $view->vars['goldProductName'] = $product['goldProductName'];
        $view->vars['goldProductMoneyUnit'] = $product['goldProductMoneyUnit'];
        $view->vars['goldProductImageName'] = $product['goldProductImageName'];
        $ex = explode(".", $product['goldProductPrice']);
        $decimals = sizeof($ex) == 1 ? 0 : strlen($ex[1]);
        $price = number_format($product['goldProductPrice'], $decimals, '.', ',');
        $view->vars['Price'] = $price;
        $data['options']['html'] = $view->output();
        return $data;
    }

    private static function getLocationProducts($locationId)
    {
        $result = GlobalDB::getInstance()->query("SELECT * FROM goldProducts WHERE goldProductLocation=$locationId ORDER BY goldProductId ASC");
        $locations = [];
        $offer = GlobalDB::getInstance()->fetchScalar("SELECT offer FROM paymentConfig") >= time();
        while ($row = $result->fetch_assoc()) {
            if ($offer && $row['goldProductHasOffer'] && !in_array($row['goldProductImageName'],
                    ['Travian_Facelift_voucher.png', 'Travian_Facelift_SMS.png', 'Travian_Facelift_Festnetz.png'])) {
                $row['goldProductGold'] = ceil($row['goldProductGold'] * 1.2);
                $split = explode(".", $row['goldProductImageName']);
                $row['goldProductImageName'] = $split[0] . '-20.' . $split[1];
            }
            $locations[] = $row;
        }
        return $locations;
    }

    private function setContext()
    {
        if (!isset($_REQUEST['context'])) {
            return;
        }
        $context = ['productionBoost', 'paymentWizard', 'infobox', 'plus', 'goldclub',];
        $contextFound = in_array($_REQUEST['context'], $context);
        if ($_REQUEST['context'] == 'infobox' || !$contextFound) {
            $this->response['data']['functionToCall'] = 'reloadUrl';
        } else {
            $this->response['data']['functionToCall'] = 'reloadDialog';
        }
        if ($contextFound) {
            $this->response['data']['context'] = $_REQUEST['context'];
        }
    }

    private function moreProtection($featureKey)
    {
        $config = Config::getInstance();
        $number = preg_replace('/[^0-9]/', '', $featureKey);
        if (!isset($config->extraSettings->moreProtection->packages[$number])) {
            return;
        }
        $feature = $config->extraSettings->moreProtection->packages[$number];
        $allowWithArtifact = $config->extraSettings->moreProtection->allowWithArtifact;
        $maxDuration = $config->extraSettings->moreProtection->maxPerDay;
        if (!$feature['enabled']) return;
        $db = DB::getInstance();
        $session = Session::getInstance();
        if ((time() - $session->get("protectionLastExtend")) > 86400) {
            $session->set("protectionLastExtend", 0);
            $session->set("protectionBoughtHours", 0);
            $db->query("UPDATE users SET protectionLastExtend=0, protectionBoughtHours=0 WHERE id={$session->getPlayerId()}");
        }
        if ((time() - $session->get("protectionLastExtend")) < 86400 && ($feature['duration'] + $session->get("protectionBoughtHours")) > $maxDuration) {
            $this->response['data']['functionToCall'] = 'reloadDialog';
            $this->response['data']['context'] = 'paymentWizard';
            $this->response['data']['e'] = 'Protection limit exceeded.';
            return;
        }
        $m = new OptionModel();
        if ($m->hasPlayerWWVillage(Session::getInstance()->getPlayerId()) <> 0 || (!$allowWithArtifact && $m->hasPlayerArtifact(Session::getInstance()->getPlayerId()) <> 0)) {
            $this->response['data']['functionToCall'] = 'reloadDialog';
            $this->response['data']['context'] = 'paymentWizard';
            $this->response['data']['e'] = 'Has artifact or WW.';
            return;
        }
        $this->response['data']['functionToCall'] = 'reloadUrl';
        $this->response['data']['context'] = 'paymentWizard';
        $duration = $feature['duration'] * 3600;
        if ($session->get("protection") > time()) {
            $duration = $session->get("protection") + $duration;
        } else {
            $duration += time();
        }
        $baseProtection = Formulas::getProtectionBasicTime($session->get("signupTime"));
        $usedProtection = ($session->protectionTill() - $session->get("signupTime"));
        $protectionExtendingUsed = $usedProtection > $baseProtection;
        if (!$protectionExtendingUsed && $session->protectionTill() == ($session->get("signupTime") + $baseProtection)) {
            $duration += Formulas::getProtectionExtendTime($session->get("signupTime"));
        }
        $infoBox = new InfoBoxModel();
        if ($infoBox->hasInfoByType($session->getPlayerId(), 6)) {
            $db->query("UPDATE infobox SET showTo=" . $duration . " WHERE uid={$session->getPlayerId()} AND type=6");
        } else {
            $infoBox->addInfo($session->getPlayerId(), FALSE, 6, '', time() - 1, $duration);
        }
        InfoBoxModel::invalidateUserInfoBoxCache($session->getPlayerId());
        $coins = $feature['coins'];
        if (GoldHelper::decreaseGold(Session::getInstance()->getPlayerId(), $coins)) {
            $protectionExtend = time();
            $db->query("UPDATE users SET protection=$duration, protectionBoughtHours=protectionBoughtHours+{$feature['duration']}, protectionLastExtend=" . $protectionExtend . " WHERE id=" . $session->getPlayerId());
            InfoBoxModel::invalidateUserInfoBoxCache($session->getPlayerId());
            $myVillageId = $session->getSelectedVillageID();
            $miliseconds = miliseconds();
            /*$db->query("UPDATE movement SET kid=to_kid, to_kid=$myVillageId, mode=1, end_time=(" . (2*$miliseconds) . "-start_time), start_time=" . $miliseconds . " WHERE mode=0 AND kid=$myVillageId");
            $db->query("UPDATE movement SET to_kid=kid, kid=$myVillageId, mode=1, end_time=(" . (2*$miliseconds) . "-start_time), start_time=" . $miliseconds . " WHERE mode=0 AND to_kid=$myVillageId");*/
        }
    }

    private function buyAnimal($featureKey)
    {
        $packageId = preg_replace('/[^0-9]/', '', $featureKey);
        $config = Config::getInstance();
        if (Village::getInstance()->isWW() || !$config->extraSettings->buyAnimal['enabled']) {
            return;
        }
        if (!isset($config->extraSettings->buyAnimal['packages'][$packageId])) {
            return;
        }
        $buyInterval = $config->extraSettings->buyAnimal['buyInterval'];
        if ($buyInterval > 0 && (time() - Session::getInstance()->get("lastBuyAnimals")) < $buyInterval) {
            $timeUnit = TimezoneHelper::getIntervalUnit($buyInterval - (time() - Session::getInstance()->get("lastBuyAnimals")));
            $this->response['error'] = TRUE;
            $this->response['errorMsg'] = sprintf(T("PaymentWizard",
                'You need to wait %s %s before buying this package'),
                $timeUnit['time'],
                $timeUnit['unit']);
            return;
        }
        $this->response['data'] = [];
        $this->response['data']['functionToCall'] = 'productPurchased';
        $db = DB::getInstance();
        $db->query("UPDATE users SET lastBuyAnimals=" . time() . " WHERE id=" . Session::getInstance()->getPlayerId());
        $kid = $db->fetchScalar("SELECT kid FROM odata WHERE did=0 LIMIT 1");
        if (!$kid) {
            return;//!!!!!!1
        }

        $modifier = $config->extraSettings->buyAnimal['packages'][$packageId]['modifier'];
        $rate = Config::getProperty("game", "useNanoseconds") ? 1e9 : (Config::getProperty("game", "useMilSeconds") ? 1e3 : 1);
        $model = new BattleSetter();
        $units = [];

        $legionaire = Formulas::$data['units'][0][0];
        $legionaire_id = nrToUnitId(1, 1);  
        $legionaire_train =  round(($modifier * 3600 * $rate) / Formulas::uTrainingTime($legionaire_id, 20));
        $legionaire_def = $model->stat_with_upg($legionaire['def_i'], $legionaire['cu'], 1) + $model->stat_with_upg($legionaire['def_c'], $legionaire['cu'], 1);  
        $baseLineDef = ($legionaire_train * $legionaire_def) / 10;

        for ($k = 0; $k<=9; $k++){
            $unit = Formulas::$data['units'][3][$k];
            $def = $model->stat_with_upg($unit['def_i'], $unit['cu'], 1) + $model->stat_with_upg($unit['def_c'], $unit['cu'], 1);  
            $units[$k+1] = floor($baseLineDef / $def);
        }

        $move = new MovementsModel();
        $delivery = $config->extraSettings->buyAnimal['packages'][$packageId]['delivery'];
        $db->begin_transaction();
        $move->addMovement($kid,
            Village::getInstance()->getKid(),
            4,
            $units,
            0,
            0,
            0,
            0,
            0,
            MovementsModel::ATTACKTYPE_REINFORCEMENT,
            miliseconds(),
            miliseconds() + $delivery * 60 * 1000);
        $coins = $config->extraSettings->buyAnimal['packages'][$packageId]['coins'];
        if (GoldHelper::decreaseGold(Session::getInstance()->getPlayerId(), $coins)) {
            $db->commit();
        } else {
            $db->rollback();
        }
        $this->response['data']['options']['type'] = 'animal';
        $this->response['data']['options']['newGold'] = Session::getInstance()->getGold() - $coins;
    }

    private function buyResources($featureKey)
    {
        //TODO: check if resources are full or not
        $config = Config::getInstance();
        $packageId = preg_replace('/[^0-9]/', '', $featureKey);
        $packages = $config->extraSettings->buyResources['packages']; 
        //$realPackageId = array_search($packageId, array_column($packages, 'id')); 
        $realPackage = $packages[$packageId]; 
		
        if (Village::getInstance()->isWW() || !$config->extraSettings->buyResources['enabled']) {
            return;
        }
        if (!isset($realPackage)) {
            return;
        }
        $buyInterval = $config->extraSettings->buyResources['buyInterval'];
        if ($buyInterval > 0 && (time() - Session::getInstance()->get("lastBuyResources")) < $buyInterval) {
            $timeUnit = TimezoneHelper::getIntervalUnit($buyInterval - (time() - Session::getInstance()->get("lastBuyResources")));
            $this->response['error'] = TRUE;
            $this->response['errorMsg'] = sprintf(T("PaymentWizard",
                'You need to wait %s %s before buying this package'),
                $timeUnit['time'],
                $timeUnit['unit']);
            return;
        }
        $this->response['data'] = [];
        $this->response['data']['functionToCall'] = 'productPurchased';
        $db = DB::getInstance();
        $db->query("UPDATE users SET lastBuyResources=" . time() . " WHERE id=" . Session::getInstance()->getPlayerId());
        
        $resources = array(0,0,0,0);
        $productionAvg = (Formulas::fieldProduction(20) * 4);
        for($i=0; $i < 4;  $i++){      
            $resources[$i] = 0;          
            if(!$realPackage['is_single'] || ($realPackage['is_single'] && $realPackage['resource'] == $i+1)){
                $resources[$i] = ($realPackage['hours']) *  $productionAvg;
            }
        }
        
        $db->begin_transaction();        
        $db->query($q = "UPDATE vdata SET wood=wood+{$resources[0]}, clay=clay+{$resources[1]}, iron=iron+{$resources[2]}, crop=crop+{$resources[3]} WHERE kid=" . Session::getInstance()->getSelectedVillageID());
        ResourcesHelper::updateVillageResources(Village::getInstance()->getKid(), TRUE);
        $coins = $realPackage['coins'];
        if (GoldHelper::decreaseGold(Session::getInstance()->getPlayerId(), $coins)) {
            $db->commit();
        } else {
            $db->rollback();
        }
        $this->response['data']['options']['type'] = 'resources';
        $this->response['data']['options']['newGold'] = Session::getInstance()->getGold() - $coins;
    }

    private function buyTroops($featureKey)
    {
        $config = Config::getInstance();
        $race = Session::getInstance()->getRace();
        $rate = Config::getProperty("game", "useNanoseconds") ? 1e9 : (Config::getProperty("game", "useMilSeconds") ? 1e3 : 1);

        $featureId = preg_replace('/[^0-9]/', '', $featureKey);
        $troopId = $featureId[0];
        $packageId = $featureId[1];
        $unitId = nrToUnitId($troopId, $race);  
        
        $packages = $config->extraSettings->buyTroops['packages'][$troopId]; 
        //$realPackageId = array_search($packageId, array_column($packages, 'id')); 
        $realPackage = $packages[$packageId]; 

        if (Village::getInstance()->isWW() || !$config->extraSettings->buyTroops['enabled']) {
            return;
        }
        if (!isset($realPackage)) {
            return;
        }
        $buyInterval = $config->extraSettings->buyTroops['buyInterval'];
        if ($buyInterval > 0 && (time() - Session::getInstance()->get("lastBuyTroops")) < $buyInterval) {
            $timeUnit = TimezoneHelper::getIntervalUnit($buyInterval - (time() - Session::getInstance()->get("lastBuyTroops")));
            $this->response['error'] = TRUE;
            $this->response['errorMsg'] = sprintf(T("PaymentWizard",
                'You need to wait %s %s before buying this package'),
                $timeUnit['time'],
                $timeUnit['unit']);
            return;
        }
        $this->response['data'] = [];
        $this->response['data']['functionToCall'] = 'productPurchased';
        $db = DB::getInstance();

        $unitAmt =  round(($realPackage['hours'] * 3600 * $rate) / Formulas::uTrainingTime($unitId, 20));
        $coins = $realPackage['coins'];

        if (GoldHelper::decreaseGold(Session::getInstance()->getPlayerId(), $coins)) {
            $db->query("UPDATE users SET lastBuyTroops=" . time() . " WHERE id=" . Session::getInstance()->getPlayerId());
            //$db->query("UPDATE units SET u1=u1+{$units[0]}, u2=u2+{$units[1]}, u3=u3+{$units[2]}, u4=u4+{$units[3]}, u5=u5+{$units[4]}, u6=u6+{$units[5]}, u7=u7+{$units[6]}, u8=u8+{$units[7]} WHERE kid=" . Session::getInstance()->getKid());
            $db->query("UPDATE units SET u{$troopId}=u{$troopId}+{$unitAmt} WHERE kid=" . Session::getInstance()->getKid());
            ResourcesHelper::updateVillageResources(Village::getInstance()->getKid(), FALSE);
        }
        $this->response['data']['options']['type'] = 'troops';
        $this->response['data']['options']['newGold'] = Session::getInstance()->getGold() - $coins;
    }

    private function buyBuildings($featureKey)
    {
        $config = Config::getInstance();
        $village = Village::getInstance();
        $packageId = preg_replace('/buyBuildings/', '', $featureKey);
       
        $packages = $config->extraSettings->buyBuildings['packages']; 
        $realPackage = $packages[$packageId]; 
        $coins = ($village->isCapital() && isset($realPackage->coinsCapital))?$realPackage->coinsCapital:$realPackage->coins;
        $bid = $realPackage->bid;

        if (!$realPackage->enabled) {
            return;
        }

        //if (Session::getInstance()->isReallyAdmin()) return;
                
        if(substr($bid, 0, 3) == 'res'){
            //$this->response['data'] = [];
            //$this->response['redirectTo'] = 'dorf1.php';

            $resourceLevel = preg_replace('/[^0-9]/', '', $bid);
            if ($resourceLevel>=25 && !$village->isCapital()) return;
            $done = true;
            $max = $resourceLevel;
            for ($i = 1; $i <= 18; ++$i) {
                if ($village->getField($i)['level'] >= $max){
                    $done &=true;
                }else{
                    $done &=false;
                }
            }
            if ($done) {
                return;
            }
            
            if (GoldHelper::decreaseGold(Session::getInstance()->getPlayerId(), $coins)) {
                for ($i = 1; $i <= 18; ++$i) {
                    $up = max($resourceLevel - $village->getField($i)['level'], 0);
                    if ($up) {
                        $village->buildings[$i]['level'] += $up;
                        (new BuildingAction())->upgrade($village->getKid(), $i, $up, true);
                    }
                }
            }
        }else{           
            $db = DB::getInstance();
            //$this->response['data'] = [];
            //$this->response['redirectTo'] = 'dorf2.php';

            if(in_array($bid, array(10,11,38,39))){
                $alreadyBuilt = $village->findBuildingsByGid($bid);
                $fieldId = 0;
                foreach($alreadyBuilt as $index => $building){
                    if($building['level']!=20){
                        $fieldId = $index;
                        continue;
                    }
                }

            }
            else{
                $fieldId = $village->findBuildingByGid($bid);        
                if ($fieldId != 0 && $village->getField($fieldId)['level'] == 20) return;            
            }
            if ($fieldId == 0 && empty($village->getEmptyFields())) return;


            if (GoldHelper::decreaseGold(Session::getInstance()->getPlayerId(), $coins)) {
                if ($fieldId == 0) {    
                    if($bid == 16){        
                        $fieldId = 39;
                    }else{
                        $fieldId = $village->getEmptyFields()[0];
                    }
                    $db->query("UPDATE fdata SET f".$fieldId."t=".$bid." WHERE kid=" . $village->getKid());
                    BuildingAction::upgrade($village->getKid(), $fieldId, 20);
                } else {                    
                    $db->query("DELETE FROM building_upgrade WHERE kid={$village->getKid()} AND building_field=".$fieldId);
                    $db->query("DELETE FROM demolition WHERE kid={$village->getKid()} AND building_field=".$fieldId);
                    BuildingAction::upgrade($village->getKid(), $fieldId, 20 - $village->getField($fieldId)['level']);
                }
            }     
        }
		$this->response['data']['options']['type'] = 'building';
		$this->response['data']['options']['newGold'] = Session::getInstance()->getGold() - $coins;   
    }

    public function VacationModeAbort()
    {
        if (Session::getInstance()->isInVacationMode()) {
            $db = DB::getInstance();
            $remainingSeconds = Session::getInstance()->getVacationTil() - time();
            $remainingDays = floor((Session::getInstance()->getVacationTil() - time()) / 86400);
            if ($remainingSeconds > 0 && GoldHelper::decreaseGold(Session::getInstance()->getPlayerId(),
                    Config::getInstance()->gold->vacationAbortGold)) {
                (new OptionModel())->abortVacation(Session::getInstance()->getPlayerId());
                if ($remainingDays >= 1) {
                    $db->query("UPDATE users SET vacationUsedDays=vacationUsedDays-$remainingDays WHERE id=" . Session::getInstance()->getPlayerId());
                }
            }
            $this->response['data']['functionToCall'] = 'reloadUrl';
            $this->response['data']['options']['html'] = '';
            $this->response['data']['context'] = 13;
        }
    }

    private function marketplace()
    {
        if (Session::getInstance()->getTotalPopulation() < 40) {
            return;
        }
        $_POST['desired'] = array_map("abs", array_map("intval", $_POST['desired']));
        $resObj = &$_POST['desired'];
        $current_resources = Village::getInstance()->getCurrentResources();
        $response = [];
        $e = new exchangeResources($response);
        $e->portionResourcesOut($resObj, $current_resources);
        if (array_sum($resObj) != array_sum($current_resources)) {
            return;
        }
        if (array_sum($resObj) < 50) {
            return;
        }
        if (!Village::getInstance()->hasMarketPlace()) {
            return;
        }
        if (Village::getInstance()->isWW()) {
            return;
        }
        if (!Village::getInstance()->isResourcesAvailable($current_resources)) {
            return;
        }
        if (GoldHelper::decreaseGold(Session::getInstance()->getPlayerId(),
            Config::getInstance()->gold->exchangeResourcesGold)) {
            if (Village::getInstance()->modifyResources($current_resources)) {
                Village::getInstance()->modifyResources($resObj, 1);
            }
        }
        $this->response['data']['functionToCall'] = 'reloadUrl';
        $this->response['data']['options']['html'] = "";
        $this->response['data']['context'] = 8;
    }

    private function constructionMaster()
    {
    }

    private function productionboostWood()
    {
        $session = Session::getInstance();
        $resourceId = 1;
        if (isset($_POST['toggleAutoprolong']) && $session->hasProductionBoost($resourceId)) {
            $m = new AutoExtendModel();
            $m->setAutoExtendState(
                $session->getPlayerId(),
                $resourceId + 1,
                $m->hasAutoExtend($session->getPlayerId(), $resourceId + 1) ? 0 : 1,
                $session->productionBoostTill($resourceId)
            );
            InfoBoxModel::invalidateUserInfoBoxCache(Session::getInstance()->getPlayerId());
            $this->response['data']['functionToCall'] = 'reloadDialog';
            $this->response['data']['options']['html'] = NULL;
            $this->response['data']['context'] = NULL;
            return;
        }
        $m = new GoldHelper();
        $m->buyProductionBoost(1);
    }

    private function productionboostClay()
    {
        $session = Session::getInstance();
        $resourceId = 2;
        if (isset($_POST['toggleAutoprolong']) && $session->hasProductionBoost($resourceId)) {
            $m = new AutoExtendModel();
            $m->setAutoExtendState(
                $session->getPlayerId(),
                $resourceId + 1,
                $m->hasAutoExtend($session->getPlayerId(), $resourceId + 1) ? 0 : 1,
                $session->productionBoostTill($resourceId)
            );
            InfoBoxModel::invalidateUserInfoBoxCache(Session::getInstance()->getPlayerId());
            $this->response['data']['functionToCall'] = 'reloadDialog';
            $this->response['data']['options']['html'] = NULL;
            $this->response['data']['context'] = NULL;
            return;
        }
        $m = new GoldHelper();
        $m->buyProductionBoost(2);
    }

    private function productionboostIron()
    {
        $session = Session::getInstance();
        $resourceId = 3;
        if (isset($_POST['toggleAutoprolong']) && $session->hasProductionBoost($resourceId)) {
            $m = new AutoExtendModel();
            $m->setAutoExtendState(
                $session->getPlayerId(),
                $resourceId + 1,
                $m->hasAutoExtend($session->getPlayerId(), $resourceId + 1) ? 0 : 1,
                $session->productionBoostTill($resourceId)
            );
            InfoBoxModel::invalidateUserInfoBoxCache(Session::getInstance()->getPlayerId());
            $this->response['data']['functionToCall'] = 'reloadDialog';
            $this->response['data']['options']['html'] = NULL;
            $this->response['data']['context'] = NULL;

            return;
        }
        $m = new GoldHelper();
        $m->buyProductionBoost(3);
    }

    private function productionboostCrop()
    {
        $session = Session::getInstance();
        $resourceId = 4;
        if (isset($_POST['toggleAutoprolong']) && $session->hasProductionBoost($resourceId)) {
            $m = new AutoExtendModel();
            $m->setAutoExtendState(
                $session->getPlayerId(),
                $resourceId + 1,
                $m->hasAutoExtend($session->getPlayerId(), $resourceId + 1) ? 0 : 1,
                $session->productionBoostTill($resourceId)
            );
            InfoBoxModel::invalidateUserInfoBoxCache(Session::getInstance()->getPlayerId());

            $this->response['data']['functionToCall'] = 'reloadDialog';
            $this->response['data']['options']['html'] = NULL;
            $this->response['data']['context'] = NULL;
            return;
        }
        $m = new GoldHelper();
        $m->buyProductionBoost(4);
    }

    private function plus()
    {
        $session = Session::getInstance();
        if (isset($_POST['toggleAutoprolong']) && $session->plusTill() > time()) {
            $m = new AutoExtendModel();
            $m->setAutoExtendState(
                $session->getPlayerId(),
                1,
                $m->hasAutoExtend($session->getPlayerId(), 1) ? 0 : 1,
                $session->plusTill()
            );
            InfoBoxModel::invalidateUserInfoBoxCache(Session::getInstance()->getPlayerId());
            $this->response['data']['functionToCall'] = 'reloadDialog';
            $this->response['data']['options']['html'] = NULL;
            $this->response['data']['context'] = NULL;
            return;
        }
        $m = new GoldHelper();
        $m->buyPlus();
    }

    private function demolishNow()
    {
        if (Village::getInstance()->isWW() && !getGame("allowDemolishNowInWW")) {
            return;
        }
        if (Village::getInstance()->demolishBuilding((int)$_POST['additionalData']['gid'], TRUE, TRUE)) {
            $this->response['data']['functionToCall'] = 'reloadUrl';
            $this->response['data']['options']['html'] = '';
            $this->response['data']['context'] = 7;
            if (GoldHelper::decreaseGold(Session::getInstance()->getPlayerId(),
                Config::getInstance()->gold->completeDemolishGold)) {
                Village::getInstance()->demolishBuilding((int)$_POST['additionalData']['gid'], TRUE);
            }
        }
    }

    private function ChangeAccountName()
    {
        $m = new OptionModel();
        $config = Config::getInstance();
        if (Session::getInstance()->getTotalPopulation() >= $config->gold->changeName->impossibleAfterPopulation) {
            return;
        }
        $newName = filter_var($_POST['accountNewName'], FILTER_SANITIZE_STRING);
        $password = sha1(filter_var($_POST['accountPassword'], FILTER_SANITIZE_STRING));
        if (empty($newName) || empty($password)) {
            $this->response['error'] = TRUE;
            $this->response['errorMsg'] = T("Options", "Please enter a new account name and confirmation password");
        } else if ($password != $_SESSION[Session::getInstance()->fixSessionPrefix('pw')]) {
            $this->response['error'] = TRUE;
            $this->response['errorMsg'] = T("Options", "Confirmation password does not match");
        } else {
            $error = $m->doesNameMeetRequirements(Session::getInstance()->getName(), $newName);
            if ($error === 0) {
                if (GoldHelper::decreaseGold(Session::getInstance()->getPlayerId(),
                    Config::getInstance()->gold->accountChangeNameGold)) {
                    $_SESSION[Session::getInstance()->fixSessionPrefix('user')] = $newName;
                    $m->changeName(Session::getInstance()->getPlayerId(), $newName);
                    Session::getInstance()->setName($newName);
                    Session::getInstance()->setTotalNameChanges(Session::getInstance()->getTotalNameChanges() + 1);
                }
                $this->response['data']['functionToCall'] = 'reloadUrl';
                $this->response['data']['options']['html'] = '';
                $this->response['data']['context'] = 7;
            } else if ($error & OptionModel::NAME_BLACKLISTED) {
                $this->response['error'] = TRUE;
                $this->response['errorMsg'] = T("Options", "Name black listed");
            } else if ($error & OptionModel::NAME_EXISTS) {
                $this->response['error'] = TRUE;
                $this->response['errorMsg'] = T("Options", "Name exists");
            } else if ($error & OptionModel::NAME_SHORT) {
                $this->response['error'] = TRUE;
                $this->response['errorMsg'] = T("Options", "Name too short");
            } else if ($error & OptionModel::NAME_LONG) {
                $this->response['error'] = TRUE;
                $this->response['errorMsg'] = T("Options", "Name too long");
            }
        }
    }

    private function goldclub()
    {
        if (!Session::getInstance()->hasGoldClub()) {
            $dailyQuest = new DailyQuestModel();
            $dailyQuest->setQuestAsCompleted(Session::getInstance()->getPlayerId(), 5);
            $session = Session::getInstance();
            $db = DB::getInstance();
            if (GoldHelper::decreaseGold(Session::getInstance()->getPlayerId(),
                Config::getInstance()->gold->goldClubGold)) {
                $db->query("UPDATE users SET goldclub=1 WHERE id=" . $session->getPlayerId());
            }
        }
    }

    private function finishNow()
    {
        $m = new GoldHelper();
        $m->finishImmediatelyBuildings();
        $this->response['data']['functionToCall'] = 'reloadUrl';
        $this->response['data']['options']['html'] = '';
        $this->response['data']['context'] = 7;
    }

    private function exchangeSilver()
    {
        $session = Session::getInstance();
        if (Config::getInstance()->auction->fakeAuction->SpreadOutRandomlyBetweenPlayers) {
            $this->response['error'] = true;
            $this->response['errorMsg'] = T("PaymentWizard", "This feature is disabled");
            return;
        }
        if (!isseT($_POST['coins'])) {
            return;
        }
        $gold = (int)$_POST['coins'];
        if ($gold > 0 && $gold <= $session->getAvailableGold()) {
            $this->response['data']['functionToCall'] = 'showFinishedExchangeGoldToSilver';
            $this->response['data']['options']['oldGold'] = $session->getAvailableGold();
            $this->response['data']['options']['oldSilver'] = $session->getAvailableSilver();
            if (GoldHelper::decreaseGold(Session::getInstance()->getPlayerId(), $gold)) {
                $db = DB::getInstance();
                $db->query("UPDATE users SET silver=silver+" . ($gold * 100) . " WHERE id=" . $session->getPlayerId());
                $session->setSilver($session->getAvailableSilver() + $gold * 100);
            }
            $this->response['data']['options']['newGold'] = $session->getAvailableGold() - $gold;
            $this->response['data']['options']['newSilver'] = $session->getAvailableSilver();
            $this->response['data']['options']['result'] = TRUE;
            $this->response['data']['options']['message']['info'] = 'info';
            $this->response['data']['options']['message']['message'] = '<img src="img/x.gif" class="gold" alt="' . T("Global", "gold") . '" title="' . T("Global", "gold") . '" /> ' . $gold . ' ' . T("Global", "convertedTo") . ' <img src="img/x.gif" class="silver" alt="' . T("Global","silver") . '" title="' . T("Global", "silver") . '" /> ' . ($gold * 100);
            $this->response['data']['context'] = 17;
        }
    }

    private function cancelTrainingQueue()
    {
        $config = Config::getInstance();
        if (!$config->extraSettings->generalOptions->cancelTrainingQueue->enabled) return false;
        $this->response['data']['functionToCall'] = 'reloadUrl';
        $this->response['data']['context'] = 'paymentWizard';
        $session = Session::getInstance();
        $db = DB::getInstance();
        $db->begin_transaction();
        $db->query("DELETE FROM training WHERE kid={$session->getSelectedVillageID()}");
        if ($db->affectedRows()) {
            $config = Config::getInstance();
            $coins = $config->extraSettings->generalOptions->cancelTrainingQueue->coins;
            if (GoldHelper::decreaseGold(Session::getInstance()->getPlayerId(), $coins)) {
                $db->commit();
            } else {
                $db->rollback();
            }
            return true;
        }
        return false;
    }

    private function increaseStorage()
    {
        $config = Config::getInstance();
        if (!$config->extraSettings->generalOptions->increaseStorage->enabled) return;
        ExtraModules::runAction('increaseStorage',
            $this->response,
            array_key_exists('additionalData', $_REQUEST) ? $_REQUEST['additionalData'] : []
        );
        $this->response['data']['functionToCall'] = 'reloadUrl';
        $this->response['data']['context'] = 'paymentWizard';
    }

    private function fasterTraining()
    {
        $config = Config::getInstance();
        if (!$config->extraSettings->generalOptions->fasterTraining->enabled) return false;
        $this->response['data']['functionToCall'] = 'reloadDialog';
        $this->response['data']['context'] = 'paymentWizard';
        $db = DB::getInstance();
        $session = Session::getInstance();
        $duration = $config->extraSettings->generalOptions->fasterTraining->duration * 3600;
        if ($session->get("fasterTraining") > time()) {
            $duration = $session->get("fasterTraining") + $duration;
        } else {
            $duration += time();
        }
        $coins = $config->extraSettings->generalOptions->fasterTraining->coins;
        if (GoldHelper::decreaseGold(Session::getInstance()->getPlayerId(), $coins)) {
            $db->query("UPDATE users SET fasterTraining=$duration WHERE id=" . $session->getPlayerId());
        }
        return TRUE;
    }

    private function atkBonus()
    {
        $db = DB::getInstance();
        $session = Session::getInstance();
        $config = Config::getInstance();
        if (!$config->extraSettings->power->atkBonus->enabled) return;
        $this->response['data']['functionToCall'] = 'reloadUrl';
        $this->response['data']['context'] = 'paymentWizard';
        $this->response['data']['options'] = ['id' => 'power'];
        $duration = $config->extraSettings->power->atkBonus->duration * 3600;
        if ($session->get("atkBonusExpireTime") > time()) {
            $duration = $session->get("atkBonusExpireTime") + $duration;
        } else {
            $duration += time();
        }
        $coins = $config->extraSettings->power->atkBonus->coins;
        if (GoldHelper::decreaseGold(Session::getInstance()->getPlayerId(), $coins)) {
            $db->query("UPDATE users SET atkBonusExpireTime=$duration WHERE id=" . $session->getPlayerId());
        }
    }

    private function defBonus()
    {
        $db = DB::getInstance();
        $session = Session::getInstance();
        $config = Config::getInstance();
        if (!$config->extraSettings->power->defBonus->enabled) return false;
        $this->response['data']['functionToCall'] = 'reloadUrl';
        $this->response['data']['context'] = 'paymentWizard';
        $duration = $config->extraSettings->power->defBonus->duration * 3600;
        if ($session->get("defBonusExpireTime") > time()) {
            $duration = $session->get("defBonusExpireTime") + $duration;
        } else {
            $duration += time();
        }
        $coins = $config->extraSettings->power->defBonus->coins;
        if (GoldHelper::decreaseGold(Session::getInstance()->getPlayerId(), $coins)) {
            $db->query("UPDATE users SET defBonusExpireTime=$duration WHERE id=" . $session->getPlayerId());
        }
        return TRUE;
    }

    private function academyResearchAll()
    {
        ExtraModules::runAction('academyResearchAll', $this->response, null);
        $this->response['data']['functionToCall'] = 'reloadUrl';
        $this->response['data']['context'] = 'paymentWizard';
    }

    private function smithyUpgradeAllToMax()
    {
        ExtraModules::runAction('smithyUpgradeAllToMax', $this->response, null);
        $this->response['data']['functionToCall'] = 'reloadUrl';
        $this->response['data']['context'] = 'paymentWizard';
    }

    /*private function rallyPointTo20()
    {
        $config = Config::getInstance();
        if (!$config->extraSettings->generalOptions->rallyPointTo20->enabled) {
            return;
        }
        if (Session::getInstance()->isReallyAdmin()) return;
        $this->response['data'] = [];
        $this->response['redirectTo'] = 'dorf2.php';
        $village = Village::getInstance();
        $db = DB::getInstance();
        if (!($village->getField(39)['item_id'] == 0 || $village->getField(39)['level'] < 20)) return;
        $coins = $config->extraSettings->generalOptions->rallyPointTo20->coins;
        if (GoldHelper::decreaseGold(Session::getInstance()->getPlayerId(), $coins)) {
            if ($village->getField(39)['item_id'] == 0) {
                $db->query("UPDATE fdata SET f39t=16 WHERE kid=" . $village->getKid());
                BuildingAction::upgrade($village->getKid(), 39, 20);
            } else if ($village->getField(39)['level'] < 20) {
                $db->query("DELETE FROM building_upgrade WHERE kid={$village->getKid()} AND building_field=39");
                $db->query("DELETE FROM demolition WHERE kid={$village->getKid()} AND building_field=39");
                BuildingAction::upgrade($village->getKid(), 39, 20 - $village->getField(39)['level']);
            }
        }
    }

    private function upgradeAllResourcesTo20()
    {
        $config = Config::getInstance();
        if (!$config->extraSettings->generalOptions->upgradeAllResourcesTo20->enabled) {
            return;
        }
        if (Session::getInstance()->isReallyAdmin()) return;
        $this->response['data'] = [];
        $this->response['redirectTo'] = 'dorf1.php';
        $village = Village::getInstance();
        $done = FALSE;
        $max = Formulas::buildingMaxLvl(1, $village->isCapital(), false);
        for ($i = 1; $i <= 18; ++$i) {
            $up = max($max - $village->getField($i)['level'], 0);
            if ($up) {
                $done = TRUE;
            }
        }
        if (!$done) {
            return;
        }
        $coins = $village->isCapital() ? $config->extraSettings->generalOptions->upgradeAllResourcesTo20->coinsCapital : $config->extraSettings->generalOptions->upgradeAllResourcesTo20->coinsNoNCapital;
        if (GoldHelper::decreaseGold(Session::getInstance()->getPlayerId(), $coins)) {
            for ($i = 1; $i <= 18; ++$i) {
                $up = max($max - $village->getField($i)['level'], 0);
                if ($up) {
                    $village->buildings[$i]['level'] += $up;
                    (new BuildingAction())->upgrade($village->getKid(), $i, $up);
                }
            }
        }
    }

    private function upgradeAllResourcesTo30()
    {
        $config = Config::getInstance();
        if (!$config->extraSettings->generalOptions->upgradeAllResourcesTo30->enabled) {
            return;
        }
        if (Session::getInstance()->isReallyAdmin()) return;
        $this->response['data'] = [];
        $this->response['redirectTo'] = 'dorf1.php';
        $village = Village::getInstance();
        if (!$village->isCapital()) return;
        $done = FALSE;
        $max = 30;
        for ($i = 1; $i <= 18; ++$i) {
            $up = max($max - $village->getField($i)['level'], 0);
            if ($up) {
                $done = TRUE;
            }
        }
        if (!$done) {
            return;
        }
        $coins = $config->extraSettings->generalOptions->upgradeAllResourcesTo30->coins;
        if (GoldHelper::decreaseGold(Session::getInstance()->getPlayerId(), $coins)) {
            for ($i = 1; $i <= 18; ++$i) {
                $up = max($max - $village->getField($i)['level'], 0);
                if ($up) {
                    $village->buildings[$i]['level'] += $up;
                    (new BuildingAction())->upgrade($village->getKid(), $i, $up, true);
                }
            }
        }
    }*/

    private function oneHourOfProduction()
    {
        $config = Config::getInstance();
        if (Village::getInstance()->isWW() || !$config->extraSettings->generalOptions->oneHourOfProduction->enabled) {
            return;
        }
        $this->response['data'] = [];
        $this->response['redirectTo'] = 'dorf1.php';
        $village = Village::getInstance();
        $resources = $village->getCurrentResources();
        $prod = $village->getProduction();
        unset($prod[4]);
        $prod[3] = max($prod[3], 0); //- crop
        for ($i = 0; $i <= 3; ++$i) {
            if ($i <= 2) {
                $prod[$i] = $resources[$i] + $prod[$i] > $village->get("maxstore") ? $village->get("maxstore") - $resources[$i] : $prod[$i];
            } else {
                $prod[$i] = $resources[$i] + $prod[$i] > $village->get("maxcrop") ? $village->get("maxcrop") - $resources[$i] : $prod[$i];
            }
        }
        $coins = $config->extraSettings->generalOptions->oneHourOfProduction->coins;
        if (array_sum($prod) && GoldHelper::decreaseGold(Session::getInstance()->getPlayerId(), $coins)) {
            $village->modifyResources($prod, 1);
        }
    }
}