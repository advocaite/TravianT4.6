<?php

namespace Game;

use Core\Config;
use Core\Database\DB;
use Core\Helper\TimezoneHelper;
use Core\Session;
use Core\Village;
use Game\Buildings\BuildingAction;
use Model\AdventureModel;
use Model\FarmListModel;
use Model\TrainingModel;
use function getCustom;
use function getGameElapsedSeconds;
use function property_exists;
use function sprintf;

class ExtraModules
{
    public static function showButton($action, $params = NULL)
    {
        if (!self::actionExists($action)) {
            return NULL;
        }
        if (!self::isEnabled($action)) {
            return NULL;
        }
        if (!self::hasPermission()) {
            return self::disabledButton($action);
        }
        $action = $action . 'Button';
        return self::$action($params);
    }

    public static function actionExists($action)
    {
        if (in_array($action,
            [
                'showButton',
                'runAction',
                'getActionsWithCoins',
                'hasPermission',
                'getCoins',
                'isEnabled',
                'translate',
                'enabledButton',
                'disabledButton',
            ])) {
            return FALSE;
        }
        return method_exists(get_class(), $action);
    }

    public static function isEnabled($name)
    {
        $config = Config::getInstance();
        $base = $config->extraSettings;
        if (in_array($name,
            ['finishTraining', 'buyAdventure', 'increaseStorage', 'smithyUpgradeAllToMax', 'academyResearchAll'])) {
            $base = $config->extraSettings->generalOptions;
        }
        return $base->$name->enabled;
    }

    private static function hasPermission()
    {
        return Session::getInstance()->checkSitterPermission(Session::SITTER_CAN_BUY_OR_SPEND_GOLD);
    }

    private static function disabledButton($name, $title = NULL, $auto = TRUE, $warning = FALSE)
    {
        $extra = null;
        if (!$auto && $warning) {
            $title = '<span class="warning">' . $title . '</span>';
        }
        return getButton([
            "type"    => "button",
            "class"   => "gold disabled",
            "onClick" => "if(jQuery(this).hasClass('disabled')){event.stopPropagation(); return false;} else {}",
            "onFocus" => "jQuery('button', 'input[type!=hidden]', 'select').focus(); event.stopPropagation(); return false;",
            "title"   => htmlspecialchars($auto ? ('<span class="warning">' . ($title == NULL ? (T("inGame",
                    "sitterNoPermForGold")) : (T("ExtraModules",
                    'Errors.' . $title))) . '</span>') : $title),
            "coins"   => self::getCoins($name),
        ],
            ["data" => ['title' => htmlspecialchars($title), "type" => "button",],],
            self::translate($name) . $extra);
    }

    public static function getCoins($name)
    {
        $config = Config::getInstance();
        if ($name == 'finishTraining') {
            $coins = ((new TrainingModel())->calculatePriceForInstantTraining(Session::getInstance()->getSelectedVillageID()));
            return $coins;
        }
        $base = $config->extraSettings;
        if (in_array($name, ['buyAdventure', 'increaseStorage', 'smithyUpgradeAllToMax', 'academyResearchAll'])) {
            $base = $config->extraSettings->generalOptions;
        }
        if (!property_exists($base, $name) || !property_exists($base->$name, 'coins')) {
            return FALSE;
        }
        return $base->$name->coins;
    }

    private static function translate($name)
    {
        return T("ExtraModules", $name);
    }

    public static function runAction($action, &$response, $params)
    {
        if (!self::actionExists($action)) {
            return;
        }
        if (!self::isEnabled($action)) {
            return;
        }
        if (!self::hasPermission()) {
            return;
        }
        self::$action($response, $params);
    }

    public static function buyAdventureButton()
    {
        return self::enabledButton('buyAdventure');
    }

    private static function enabledButton($name, $extraData = [], $onclick = '')
    {
        $wayOfPayment = ['featureKey' => $name, 'context' => 'ExtraModules'];
        $wayOfPayment = array_merge($wayOfPayment, $extraData);
        $extra = null;
        $value = self::translate($name);
        $title = htmlspecialchars(self::translate($name));
        return getButton([
            "type"  => "button",
            "class" => "gold $name",
            'title' => $title,
            'coins' => self::getCoins($name),
        ],
            [
                "data" => [
                    "type"         => "button",
                    'value'        => $value,
                    'confirm'      => '',
                    'onclick'      => '',
                    'wayOfPayment' => $wayOfPayment,
                    'onClick'      => $onclick,
                ],
            ],
            self::translate($name) . $extra);
    }

    public static function finishTrainingButton()
    {
        $config = Config::getInstance();
        if (!$config->extraSettings->generalOptions->finishTraining->enabled) {
            return null;
        }
        return self::enabledButton('finishTraining');
    }

    public static function smithyMaxLevelButton($i)
    {
        return self::enabledButton('smithyMaxLevel', ['dataCallback' => 'getNr' . $i]);
    }

    public static function smithyUpgradeAllToMaxButton()
    {
        return self::enabledButton('smithyUpgradeAllToMax');
    }

    public static function addFarmsButton()
    {
        $enableAfter = Config::getProperty("extraSettings", "addFarms", "enableAfter");
        if (Session::getInstance()->hasGoldClub() && getGameElapsedSeconds() > $enableAfter) {
            return self::enabledButton('addFarms');
        }
        $title = sprintf(T("ExtraModules", "addFarmsIsDisabledTill"),
            TimezoneHelper::autoDateString(time() + $enableAfter, TRUE));
        return self::disabledButton('addFarms', $title, false, true);
    }

    public static function academyResearchAllButton()
    {
        return self::enabledButton('academyResearchAll');
    }

    public static function increaseStorageButton($callback)
    {
        return self::enabledButton('increaseStorage', ['dataCallback' => $callback]);
    }

    public static function upgradeStorageToMaxLevelButton($building_field)
    {
        return self::upgradeToMaxLevelButton($building_field, 'upgradeStorageToMaxLevel');
    }

    public static function upgradeToMaxLevelButton($building_field, $name = 'upgradeToMaxLevel')
    {
        if ($building_field <= 18 && !getCustom("allowUpgradeResourcesToMaxLevel")) {
            return false;
        }
        $village = Village::getInstance();
        $config = Config::getInstance();
        if (in_array($village->getField($building_field)['item_id'], [10, 11, 38, 39])) {
            if (!$config->extraSettings->upgradeStorageToMaxLevel->enabled) {
                return false;
            }
        }
        if ($village->isWW() && !getGame("allowUpgradeToMaxLevelInWW")) {
            return '<br /><br />' . self::disabledButton($name, 'WWDisabled');
        }
        if ($village->getField($building_field)['item_id'] == 40) {
            return '<br /><br />' . self::disabledButton($name, 'WWDisabled');
        }
        if ($village->getField($building_field)['item_id'] == 0 || ($village->getField($building_field)['item_id'] > 4 && $village->getField($building_field)['level'] == 0)) {
            return NULL;
        }
        $needUpgradeType = $village->checkArtifactDependencies($village->getField($building_field)['item_id']);
        if ($needUpgradeType == 1) {
            return '<br /><br />' . self::disabledButton($name,
                    '<span class="warning">' . T("Buildings", "errors.noGreatArtefact") . '</span>',
                    FALSE);
        }
        $lvl = $village->getField($building_field)['level'] + $village->getField($building_field)['upgrade_state'];
        foreach ($village->onLoadBuildings['master'] as $k => $v) {
            if ($building_field == $v['building_field']) {
                $lvl++;
            }
        }
        $max_lvl = Formulas::buildingMaxLvl($village->getField($building_field)['item_id'], $village->isCapital());
        if ($building_field <= 18 && $village->isCapital()) {
            $max_lvl = 20;
        }
        if ($lvl >= $max_lvl) {
            return FALSE;
        }
        if ($village->getOnDemolishBuildingFieldId() == $village->getField($building_field)['item_id']) {
            return FALSE;
        }
        return '<br /><br />' . self::enabledButton($name, ['dataCallback' => 'getGidX']);
    }

    public static function addFarms(&$response)
    {
        $enableAfter = Config::getProperty("extraSettings", "addFarms", "enableAfter");
        if (Session::getInstance()->hasGoldClub() && getGameElapsedSeconds() > $enableAfter) {
            $db = DB::getInstance();
            $db->begin_transaction();
            $f = new FarmListModel();
            $count = $f->addUniqueFarms(Session::getInstance()->getPlayerId(),
                Session::getInstance()->getSelectedVillageID(),
                100);
            if ($count) {
                if (self::reduceGold(__FUNCTION__)) {
                    $db->commit();
                } else {
                    $db->rollback();
                }
            } else {
                $db->rollback();
            }
        }
    }

    private static function reduceGold($action, $times = 1)
    {
        $coins = self::getCoins($action) * $times;
        if ($coins === FALSE) {
            return FALSE;
        }
        return GoldHelper::decreaseGold(Session::getInstance()->getPlayerId(), $coins);
    }

    public static function finishTraining(&$response)
    {
        $response['reload'] = TRUE;
        $config = Config::getInstance();
        if (!$config->extraSettings->generalOptions->finishTraining->enabled) {
            return;
        }
        $db = DB::getInstance();
        $db->begin_transaction();
        $db->query("UPDATE training SET end_time=0, commence=0 WHERE kid=" . Session::getInstance()->getKid());
        if (!$db->affectedRows()) {
            $db->rollback();
            return;
        }
        if (self::reduceGold(__FUNCTION__)) {
            $db->commit();
        } else {
            $db->rollback();
        }
    }

    public static function academyResearchAll(&$response)
    {
        $kid = Session::getInstance()->getSelectedVillageID();
        $db = DB::getInstance();
        $db->begin_transaction();
        $db->query("DELETE FROM research WHERE mode=1 AND kid={$kid}");
        $db->query("UPDATE tdata SET u2=1, u3=1, u4=1, u5=1, u6=1, u7=1, u8=1, u9=1 WHERE kid=" . Session::getInstance()->getSelectedVillageID());
        if ($db->affectedRows()) {
            if (self::reduceGold(__FUNCTION__)) {
                $db->commit();
            } else {
                $db->rollback();
            }
        } else {
            $db->rollback();
        }
        $response['reload'] = TRUE;
    }

    public static function smithyUpgradeAllToMax(&$response)
    {
        $db = DB::getInstance();
        $kid = Session::getInstance()->getSelectedVillageID();
        $db->begin_transaction();
        $db->query("DELETE FROM research WHERE mode=0 AND kid={$kid}");
        $db->query("UPDATE smithy SET u1=20, u2=20, u3=20, u4=20, u5=20, u6=20, u7=20, u8=20 WHERE kid=" . Session::getInstance()->getSelectedVillageID());
        if ($db->affectedRows()) {
            if (self::reduceGold(__FUNCTION__)) {
                $db->commit();
            } else {
                $db->rollback();
            }
        } else {
            $db->rollback();
        }
        $response['reload'] = TRUE;
    }

    public static function smithyMaxLevel(&$response, $additionalData)
    {
        $kid = Session::getInstance()->getSelectedVillageID();
        $nr = (int)$additionalData['nr'];
        if ($nr > 8 || $nr < 1) return;
        $db = DB::getInstance();
        $level = $db->fetchScalar("SELECT u{$nr} FROM smithy WHERE kid=" . Session::getInstance()->getSelectedVillageID());
        if ($level < 20) {
            $db->begin_transaction();
            $db->query("DELETE FROM research WHERE mode=0 AND kid={$kid} AND nr=$nr");
            $db->query("UPDATE smithy SET u{$nr}=20 WHERE kid=" . Session::getInstance()->getSelectedVillageID());
            if ($db->affectedRows()) {
                if (self::reduceGold(__FUNCTION__)) {
                    $db->commit();
                } else {
                    $db->rollback();
                }
            } else {
                $db->rollback();
            }
            $response['reload'] = TRUE;
        }
    }

    public static function buyAdventure(&$response)
    {
        if (self::reduceGold(__FUNCTION__)) {
            $total_adventures = Session::getInstance()->get('total_adventures');
            $adventure = new AdventureModel();
            $adventure->addAdventure(
                Session::getInstance()->getPlayerId(),
                $total_adventures,
                time() + $adventure->getAdventureExpireTime(),
                true
            );
        }
        $response['reload'] = TRUE;
    }

    public static function increaseStorage(&$response, $additionalData = null)
    {
        $storage = Formulas::storeCAP(20);
        $db = DB::getInstance();
        //$gid = Village::getInstance()->getField($additionalData['gid'])['item_id'];
        /*
        $storage = Formulas::storeCAP(20);
        if ($gid == 10 || $gid == 38) {
            //warehouse
            $db->query("UPDATE vdata SET extraMaxstore=extraMaxstore+1, maxstore=maxstore+$storage WHERE kid=" . Session::getInstance()->getSelectedVillageID());
        } else {
            //granny
            $db->query("UPDATE vdata SET extraMaxcrop=extraMaxcrop+1, maxcrop=maxcrop+$storage WHERE kid=" . Session::getInstance()->getSelectedVillageID());
        }*/

        $times = abs(isset($additionalData['times']) ? (int)$additionalData['times'] : 1);
        $coins = self::getCoins(__FUNCTION__);

        $times = min(floor(Session::getInstance()->getGold() / $coins), $times);

        $storage *= $times;
        $db->begin_transaction();
        $db->query("UPDATE vdata SET extraMaxstore=extraMaxstore+$times, maxstore=maxstore+$storage WHERE kid=" . Session::getInstance()->getSelectedVillageID());
        $db->query("UPDATE vdata SET extraMaxcrop=extraMaxcrop+$times, maxcrop=maxcrop+$storage WHERE kid=" . Session::getInstance()->getSelectedVillageID());
        if ($db->affectedRows()) {
            if (self::reduceGold(__FUNCTION__, $times)) {
                $db->commit();
            } else {
                $db->rollback();
            }
        } else {
            $db->rollback();
        }
        $response['reload'] = TRUE;
    }

    public static function upgradeStorageToMaxLevel(&$response, $additionalData)
    {
        self::upgradeToMaxLevel($response, $additionalData, true);
    }

    public static function upgradeToMaxLevel(&$response, $additionalData, $isStorage = false)
    {
        if (!isset($additionalData['gid'])) {
            return FALSE;
        }
        if (Session::getInstance()->isReallyAdmin()) return FALSE;
        $config = Config::getInstance();
        $building_field = (int)$additionalData['gid'];
        if ($building_field <= 18 && !getCustom("allowUpgradeResourcesToMaxLevel")) {
            return false;
        }
        if ($building_field > 40 || $building_field < 1) {
            return FALSE;
        }
        $village = Village::getInstance();
        if ($village->isWW() && !getGame("allowUpgradeToMaxLevelInWW")) {
            return FALSE;
        }
        if ($village->getField($building_field)['item_id'] == 40) {
            return FALSE;
        }
        if ($village->getField($building_field)['item_id'] == 0 || ($village->getField($building_field)['item_id'] > 4 && $village->getField($building_field)['level'] == 0)) {
            return FALSE;
        }
        if (in_array($village->getField($building_field)['item_id'], [10, 11, 38, 39])) {
            if (!$config->extraSettings->upgradeStorageToMaxLevel->enabled) {
                return false;
            }
        }
        if (!$isStorage && in_array($village->getField($building_field)['item_id'], [10, 11, 38, 39])) {
            return false;
        }
        $needUpgradeType = $village->checkArtifactDependencies($village->getField($building_field)['item_id']);
        if ($needUpgradeType == 1) {
            return FALSE;
        }
        $lvl = $village->getField($building_field)['level'] + $village->getField($building_field)['upgrade_state'];
        foreach ($village->onLoadBuildings['master'] as $k => $v) {
            if ($building_field == $v['building_field']) {
                $lvl++;
            }
        }
        $max_lvl = Formulas::buildingMaxLvl($village->getField($building_field)['item_id'], $village->isCapital());
        if ($building_field <= 18 && $village->isCapital()) {
            $max_lvl = 20;
        }
        if ($lvl >= $max_lvl) {
            return FALSE;
        }
        if ($village->getOnDemolishBuildingFieldId() == $village->getField($building_field)['item_id']) {
            return FALSE;
        }
        if (!self::reduceGold($isStorage ? 'upgradeStorageToMaxLevel' : __FUNCTION__)) {
            return false;
        }
        BuildingAction::upgrade($village->getKid(), $building_field, $max_lvl - $village->getField($building_field)['level']);
        DB::getInstance()->query("DELETE FROM building_upgrade WHERE kid={$village->getKid()} AND building_field={$building_field}");
        DB::getInstance()->query("DELETE FROM demolition WHERE kid={$village->getKid()} AND building_field={$building_field}");
        $response['data'] = [];
        $response['redirectTo'] = 'dorf' . ($building_field <= 18 ? 1 : 2) . '.php';
        return TRUE;
    }
} 