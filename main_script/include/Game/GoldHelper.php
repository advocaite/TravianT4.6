<?php

namespace Game;

use Core\Config;
use Core\Database\DB;
use Core\Helper\TimezoneHelper;
use Core\Session;
use Core\Village;
use Game\Buildings\BuildingAction;
use Model\AutoExtendModel;
use Model\DailyQuestModel;
use Model\InfoBoxModel;
use Model\OptionModel;
use Model\Quest;
use Model\VillageModel;
use function preg_replace;

class GoldHelper
{
    public function __construct()
    {
    }

    public function buyPlus()
    {
        $config = Config::getInstance();
        if (self::decreaseGold(Session::getInstance()->getPlayerId(), $config->gold->plusGold)) {
            $this->addPlus($config->gold->plusAccountDurationSeconds);
        }
        InfoBoxModel::invalidateUserInfoBoxCache(Session::getInstance()->getPlayerId());
    }

    private function addPlus($till)
    {
        $session = Session::getInstance();
        $db = DB::getInstance();
        $showTo = $session->hasPlus() ? $session->plusTill() + $till : time() + $till;
        $db->query("UPDATE users SET plus=" . $showTo . " WHERE id=" . $session->getPlayerId());
        $session->setPlusTill($showTo);
        $autoExtend = new AutoExtendModel();
        $autoExtend->setAutoExtendState($session->getPlayerId(),
            1,
            $autoExtend->hasAutoExtend($session->getPlayerId(), 1),
            $showTo);
    }

    private function addProductionBoost($resourceId, $till)
    {
        $session = Session::getInstance();
        $db = DB::getInstance();
        $villageModel = new VillageModel();
        $update = !$session->hasProductionBoost($resourceId);
        $showTo = $session->hasProductionBoost($resourceId) ? $session->productionBoostTill($resourceId) + $till : time() + $till;
        $db->query("UPDATE users SET b" . ($resourceId) . "=" . $showTo . " WHERE id=" . $session->getPlayerId());
        $session->setProductionBoostTill($resourceId, $showTo);
        $autoExtend = new AutoExtendModel();
        $autoExtend->setAutoExtendState($session->getPlayerId(),
            1 + $resourceId,
            $autoExtend->hasAutoExtend($session->getPlayerId(), $resourceId + 1),
            $showTo);
        if ($update) {
            $villageModel->updateUserVillageResources($session->getPlayerId(), false);
        }
    }

    public static function decreaseGold($uid, $num)
    {
        $num = (int)$num;
        if (!getCustom("serverIsFreeGold")) {
            if (!$num) return false;
            $db = DB::getInstance();
            $user = $db->query("SELECT bought_gold, gift_gold FROM users WHERE id=$uid");
            if (!$user->num_rows) return false;
            $user = $user->fetch_assoc();
            $bought_gold = $user['bought_gold'];
            $gift_gold = $user['gift_gold'];
            while ($num > 0 && (($bought_gold + $gift_gold) > 0)) {
                if ($gift_gold > 0) {
                    $count = min($gift_gold, $num);
                    $gift_gold -= $count;
                    $num -= $count;
                }
                if ($num > 0 && $bought_gold > 0) {
                    $count = min($bought_gold, $num);
                    $bought_gold -= $count;
                    $num -= $count;
                }
            }
            $db->query("UPDATE users SET bought_gold=$bought_gold, gift_gold=$gift_gold WHERE id=$uid");
        } else {
            $num = 0;
        }
        $dailyQuest = new DailyQuestModel();
        $dailyQuest->setQuestAsCompleted($uid, 5);
        return $num === 0;
    }

    public function giftPlus($till)
    {
        $this->addPlus($till);
    }

    public function buyProductionBoost($resourcesId)
    {
        $config = Config::getInstance();
        if (self::decreaseGold(Session::getInstance()->getPlayerId(), $config->gold->productionBoostGold)) {
            $this->addProductionBoost($resourcesId, $config->gold->productionBoostDurationSeconds);
        }
        InfoBoxModel::invalidateUserInfoBoxCache(Session::getInstance()->getPlayerId());
    }

    public function giftProductionBoost($resourcesId, $till)
    {
        $this->addProductionBoost($resourcesId, $till);
    }

    public function buyGoldClub($free = FALSE)
    {
        if (!Session::getInstance()->hasGoldClub()) {
            $gold = $free ? 0 : Config::getInstance()->gold->goldClubGold;
            $db = DB::getInstance();
            if (self::decreaseGold(Session::getInstance()->getPlayerId(), $gold)) {
                $db->query("UPDATE users SET goldclub=1 WHERE id=" . Session::getInstance()->getPlayerId());
            }
            Session::getInstance()->setGoldClub(1);
        }
    }

    public function finishImmediatelyBuildings()
    {
        $db = DB::getInstance();
        $session = Session::getInstance();
        $village = Village::getInstance();
        if ($village->isWW()) {
            return;
        }
        $kid = $village->getKid();
        $total = (int)$db->fetchScalar("SELECT ((SELECT COUNT(id) FROM research WHERE kid=$kid)+(SELECT COUNT(id) FROM demolition WHERE kid=$kid))");
        foreach ($village->onLoadBuildings['normal'] as $onload) {
            //ignore residence and palace here.
            $item_id = $village->getField($onload['building_field'])['item_id'];
            if ($item_id == 25 || $item_id == 26) {
                continue;
            }
            $total++;
        }
        if ($total) {
            $config = Config::getInstance();
            if (self::decreaseGold(Session::getInstance()->getPlayerId(), $config->gold->finishNowGold)) {
                $db->query("UPDATE research SET end_time=0 WHERE kid=$kid");
                $db->query("UPDATE demolition SET end_time=0 WHERE kid=$kid");
                $finish = 0;
                foreach ($village->onLoadBuildings['normal'] as $onload) {
                    //ignore residence and palace here.
                    $item_id = $village->getField($onload['building_field'])['item_id'];
                    if ($item_id == 25 || $item_id == 26) {
                        continue;
                    }
                    $db->query("DELETE FROM building_upgrade WHERE id={$onload['id']}");
                    BuildingAction::upgrade($village->getKid(), $onload['building_field']);
                    unset($village->onLoadBuildings['normal'][$onload['id']]);
                }
                $village->recalculateBuildingTimes();
                $quest = Quest::getInstance();
                if ($quest->getTutorial() == '10-0') {
                    $quest->setTutorial("10-1");
                }
            }
        }
    }

    public function demolishComplete($field)
    {
        if (Village::getInstance()->demolishBuilding($field, true, true)) {
            $config = Config::getInstance();
            if (self::decreaseGold(Session::getInstance()->getPlayerId(), $config->gold->completeDemolishGold)) {
                Village::getInstance()->demolishBuilding($field, true);
            }
        }
    }

    public function finishNowButton()
    {
        $village = Village::getInstance();
        $session = Session::getInstance();
        $hasPerm = $session->checkSitterPermission(Session::SITTER_CAN_BUY_OR_SPEND_GOLD);
        if (!$hasPerm) {
            return '<div class="finishNow">' . getButton([
                    "type"    => "button",
                    "class"   => "gold disabled",
                    "onClick" => "if(jQuery(this).hasClass('disabled')){event.stopPropagation(); return false;} else {}",
                    "onFocus" => "jQuery('button', 'input[type!=hidden]', 'select').focus(); event.stopPropagation(); return false;",
                    "title"   => htmlspecialchars('<span class="warning">' . T("inGame",
                            "sitterNoPermForGold") . '</span>'),
                ],
                    ["data" => ["type" => "button"]],
                    T("Buildings", "finishNow.finishNow")) . '</div>';
        }
        if ($village->isWW()) {
            return '<div class="finishNow">' . getButton([
                    "type"    => "button",
                    "class"   => "gold disabled",
                    "onClick" => "if(jQuery(this).hasClass('disabled')){event.stopPropagation(); return false;} else {}",
                    "onFocus" => "jQuery('button', 'input[type!=hidden]', 'select').focus(); event.stopPropagation(); return false;",
                    "title"   => htmlspecialchars('<span class="warning">' . T("inGame",
                            "finishNowWWDisabled") . '</span>'),
                ],
                    ["data" => ["type" => "button"]],
                    T("Buildings", "finishNow.finishNow")) . '</div>';
        }

        return '<div class="finishNow">' . getButton([
                "type"  => "button",
                "class" => "gold ",
                "value" => T("Buildings", "finishNow.finishNow"),
            ],
                [
                    "data" => [
                        "type"   => "button",
                        "dialog" => [
                            "saveOnUnload"      => FALSE,
                            "cssClass"          => 'white',
                            'draggable'         => FALSE,
                            'overlayCancel'     => TRUE,
                            'buttonOk'          => FALSE,
                            'data'              => [
                                'cmd'      => 'finishNowPopup',
                                'context'  => 'finishNow',
                                'infoIcon' => 'http://t4.answers.travian.com/index.php?aid=372#go2answer',
                            ],
                            'preventFormSubmit' => true,
                        ],
                    ],
                ],
                T("Buildings", "finishNow.finishNow")) . '</div>';
    }

    public function getGoldClubButton()
    {
        $session = Session::getInstance();
        $config = Config::getInstance();
        if ($session->hasGoldClub()) {
            return getButton([
                "type"    => "button",
                "class"   => "gold disabled",
                "onClick" => "if(jQuery(this).hasClass('disabled')){event.stopPropagation(); return false;} else {}",
                "onFocus" => "jQuery('button', 'input[type!=hidden]', 'select').focus(); event.stopPropagation(); return false;",
                'coins'   => $config->gold->goldClubGold,
            ],
                ["data" => ["type" => "button"]],
                T("inGame", "plus." . ('activate')));
        }
        if (!$session->checkSitterPermission(Session::SITTER_CAN_BUY_OR_SPEND_GOLD)) {
            return getButton([
                "type"    => "button",
                "class"   => "gold disabled",
                "onClick" => "if(jQuery(this).hasClass('disabled')){event.stopPropagation(); return false;} else {}",
                "onFocus" => "jQuery('button', 'input[type!=hidden]', 'select').focus(); event.stopPropagation(); return false;",
                "title"   => htmlspecialchars('<span class="warning">' . T("inGame",
                        "sitterNoPermForGold") . '</span>'),
            ],
                ["data" => ["type" => "button"]],
                T("inGame", "plus." . ('activate')));
        }

        return getButton([
            "type"  => "button",
            "class" => "gold prosButton goldclub",
            'title' => '',
            'coins' => $config->gold->goldClubGold,
        ],
            [
                "data" => [
                    "type"    => "button",
                    'value'   => T("inGame", "plus." . ('activate')),
                    'confirm' => '',
                    'onclick' => '',
                ],
            ],
            T("inGame", "plus." . ('activate')));
    }

    public function getPlusButton($infoBox = FALSE, $paymentWizard = FALSE)
    {
        $session = Session::getInstance();
        $config = Config::getInstance();
        $hasPlus = $session->hasPlus();
        $autoExtend = new AutoExtendModel();
        if ($infoBox && $session->getAvailableGold() < $config->gold->plusGold && $autoExtend->hasAutoExtend($session->getPlayerId(), 1)) {
            return $this->renderBuyGoldButton();
        }
        $hasPerm = $session->checkSitterPermission(Session::SITTER_CAN_BUY_OR_SPEND_GOLD);
        $extra = $paymentWizard ? 'prosButton plus' : '';
        if (!$hasPerm) {
            return getButton([
                "type"    => "button",
                "class"   => "gold {$extra} disabled",
                "onClick" => "if(jQuery(this).hasClass('disabled')){event.stopPropagation(); return false;} else {}",
                "onFocus" => "jQuery('button', 'input[type!=hidden]', 'select').focus(); event.stopPropagation(); return false;",
                "title"   => htmlspecialchars('<span class="warning">' . T("inGame",
                        "sitterNoPermForGold") . '</span>'),
                'coins'   => $config->gold->plusGold,
            ],
                [
                    "data" => [
                        "type"    => "button",
                        'value'   => T("inGame", "plus." . ($hasPlus ? 'extend' : 'activate')),
                        'confirm' => '',
                        'onclick' => '',
                    ],
                ],
                T("inGame", "plus." . ($hasPlus ? 'extend' : 'activate')));
        }
        $data = [];
        if ($infoBox) {
            $data['wayOfPayment'] = [
                "featureKey" => "plus",
                "context"    => "infobox",
            ];
        }

        return getButton([
            "type"  => "button",
            "class" => "gold {$extra}",
            'title' => htmlspecialchars(sprintf(T("inGame", "plus." . ($hasPlus ? 'extend now' : 'activate now')), $this->getTime($config->gold->plusAccountDurationSeconds))),
            'coins' => $config->gold->plusGold,
        ],
            [
                "data" => array_merge([
                    "type"    => "button",
                    'value'   => T("inGame", "plus." . ($hasPlus ? 'extend' : 'activate')),
                    'confirm' => '',
                    'onclick' => '',
                ],
                    $data),
            ],
            T("inGame", "plus." . ($hasPlus ? 'extend' : 'activate')));
    }

    public function renderBuyGoldButton()
    {
        $session = Session::getInstance();
        $hasPerm = $session->checkSitterPermission(Session::SITTER_CAN_BUY_OR_SPEND_GOLD);
        $text = T("inGame", "Navigation.Buy gold");
        if (!$hasPerm) {
            return getButton([
                "type"  => "button",
                "class" => "green disabled",
            ],
                [
                    "data" => [
                        "type"    => "button",
                        'value'   => $text,
                        'confirm' => '',
                        'onclick' => '',
                    ],
                ],
                $text);
        }
        return getButton([
            "type"  => "button",
            "class" => "green",
        ],
            [
                "data" => [
                    'onclick' => 'jQuery(window).trigger(\'startPaymentWizard\', {}); return false;',
                    "type"    => "button",
                    'value'   => $text,
                    'confirm' => '',
                ],
            ],
            $text);
    }

    function getTime($time)
    {
        if ($time >= 86400) {
            return '<span class="bold">' . round($time / 86400, 1) . '</span> ' . T("PaymentWizard", "Days");
        }
        return '<span class="bold">' . round($time / 3600, 1) . '</span> ' . T("PaymentWizard", "hour");
    }

    public function renderBuyButton($featureKey, $coins, $wwInAvailable, $disabled = false)
    {
        $title = '';
        $text = T("PaymentWizard", "Buy");
        $isMoreProtection = substr($featureKey, 0, 14) == 'moreProtection';
        $isBuyResources = substr($featureKey, 0, 12) == 'buyResources';
        $isBuyAnimal = substr($featureKey, 0, 9) == 'buyAnimal';
        $isBuyTroops = substr($featureKey, 0, 9) == 'buyTroops';
        $config = Config::getInstance();
        $m = new OptionModel();
        if ($isMoreProtection) {
            $allowWithArtifact = $config->extraSettings->moreProtection->allowWithArtifact;
            if (($m->hasPlayerWWVillage(Session::getInstance()->getPlayerId()) <> 0 || (!$allowWithArtifact && $m->hasPlayerArtifact(Session::getInstance()->getPlayerId()) <> 0))) {
                $disabled = true;
                $title = T("PaymentWizard", "You have a WW village or Artifact So you cannot use this feature");
            } else {
                $number = preg_replace('/[^0-9]/', '', $featureKey);
                $db = DB::getInstance();
                $session = Session::getInstance();
                if ((time() - $session->get("protectionLastExtend")) > 86400) {
                    $session->set("protectionLastExtend", 0);
                    $session->set("protectionBoughtHours", 0);
                    $db->query("UPDATE users SET protectionLastExtend=0, protectionBoughtHours=0 WHERE id={$session->getPlayerId()}");
                }
                if (!isset($config->extraSettings->moreProtection->packages[$number])) {
                    $disabled = true;
                    $title = 'Package not found';
                } else {
                    $feature = $config->extraSettings->moreProtection->packages[$number];
                    $maxDuration = $config->extraSettings->moreProtection->maxPerDay;
                    if ((time() - $session->get("protectionLastExtend")) < 86400 && ($feature['duration'] + $session->get("protectionBoughtHours")) > $maxDuration) {
                        $disabled = true;
                        $title = T("PaymentWizard", "Protection daily limit reached");
                    }
                }
            }
        } else if ($isBuyResources || $isBuyTroops || $isBuyAnimal) {
            $waitTime = $buyInterval = 0;
            if ($isBuyTroops) {
                $buyInterval = $config->extraSettings->buyTroops['buyInterval'];
                $waitTime = $buyInterval - (time() - Session::getInstance()->get("lastBuyTroops"));
            } else if ($isBuyAnimal) {
                $buyInterval = $config->extraSettings->buyAnimal['buyInterval'];
                $waitTime = $buyInterval - (time() - Session::getInstance()->get("lastBuyAnimals"));
            } else if ($isBuyResources) {
                $buyInterval = $config->extraSettings->buyResources['buyInterval'];
                $waitTime = $buyInterval - (time() - Session::getInstance()->get("lastBuyResources"));
            }
            if ($buyInterval > 0 && $waitTime > 0) {
                $timeUnit = TimezoneHelper::getIntervalUnit($waitTime);
                $title = sprintf(T("PaymentWizard", 'You need to wait %s %s before buying this package'),
                    $timeUnit['time'],
                    $timeUnit['unit']);
                $disabled = true;
            }
        }
        if ($disabled) {
            return getButton([
                "type"    => "button",
                "class"   => "gold prosButton " . $featureKey . " disabled",
                "onClick" => "if(jQuery(this).hasClass('disabled')){event.stopPropagation(); return false;} else {}",
                "onFocus" => "jQuery('button', 'input[type!=hidden]', 'select').focus(); event.stopPropagation(); return false;",
                "title"   => $title,
                'coins'   => $coins,
            ],
                [
                    "data" => [
                        "type"    => "button",
                        'value'   => $text,
                        'confirm' => '',
                        'onclick' => '',
                    ],
                ],
                $text);
        }
        $session = Session::getInstance();
        $hasPerm = $session->checkSitterPermission(Session::SITTER_CAN_BUY_OR_SPEND_GOLD);
        if (!$hasPerm) {
            return getButton([
                "type"    => "button",
                "class"   => "gold prosButton " . $featureKey . " disabled",
                "onClick" => "if(jQuery(this).hasClass('disabled')){event.stopPropagation(); return false;} else {}",
                "onFocus" => "jQuery('button', 'input[type!=hidden]', 'select').focus(); event.stopPropagation(); return false;",
                "title"   => htmlspecialchars('<span class="warning">' . T("inGame",
                        "sitterNoPermForGold") . '</span>'),
                'coins'   => $coins,
            ],
                [
                    "data" => [
                        "type"    => "button",
                        'value'   => $text,
                        'confirm' => '',
                        'onclick' => '',
                    ],
                ],
                $text);
        }
        if ($wwInAvailable && Village::getInstance()->isWW()) {
            return getButton([
                "type"    => "button",
                "class"   => "gold prosButton " . $featureKey . " disabled",
                "onClick" => "if(jQuery(this).hasClass('disabled')){event.stopPropagation(); return false;} else {}",
                "onFocus" => "jQuery('button', 'input[type!=hidden]', 'select').focus(); event.stopPropagation(); return false;",
                "title"   => htmlspecialchars('<span class="warning">' . T("PaymentWizard", "WWDisabled") . '</span>'),
                'coins'   => $coins,
            ],
                [
                    "data" => [
                        "type"    => "button",
                        'value'   => $text,
                        'confirm' => '',
                        'onclick' => '',
                    ],
                ],
                $text);
        }
        //supress ww here.
        $data = [
            'wayOfPayment' => [
                "featureKey" => $featureKey,
                "context"    => "paymentWizard",
            ],
        ];

        return getButton([
            "type"  => "button",
            "class" => "gold prosButton " . $featureKey,
            'title' => $text,
            'coins' => $coins,
        ],
            [
                "data" => array_merge([
                    "type"    => "button",
                    'value'   => $text,
                    'confirm' => '',
                    'onclick' => '',
                ],
                    $data),
            ],
            $text);
    }

    public function getProductionBoostButton($resourcesId, $infoBox = FALSE, $paymentWizard = FALSE, $production = FALSE)
    {
        $session = Session::getInstance();
        $config = Config::getInstance();
        $m = new AutoExtendModel();
        $resClass = ['wood', 'clay', 'iron', 'crop'][$resourcesId - 1];
        if ($infoBox && $session->getAvailableGold() < $config->gold->productionBoostGold) {
            if ($m->hasAutoExtend($session->getPlayerId(), $resourcesId + 1)) {
                return $this->renderBuyGoldButton();
            }
        }
        $hasBoost = $session->hasProductionBoost($resourcesId);
        $hasPerm = $session->checkSitterPermission(Session::SITTER_CAN_BUY_OR_SPEND_GOLD);
        $extra = $paymentWizard ? 'prosButton' : '';
        if ($paymentWizard) {
            $resClass = ucfirst($resClass);
        }
        if (!$hasPerm) {
            return getButton([
                "type"    => "button",
                "class"   => "gold {$extra} " . ($paymentWizard ? 'productionboost' : 'productionBoostButton ') . "{$resClass} disabled",
                "onClick" => "if(jQuery(this).hasClass('disabled')){event.stopPropagation(); return false;} else {}",
                "onFocus" => "jQuery('button', 'input[type!=hidden]', 'select').focus(); event.stopPropagation(); return false;",
                "title"   => htmlspecialchars('<span class="warning">' . T("inGame",
                        "sitterNoPermForGold") . '</span>'),
                'coins'   => $config->gold->productionBoostGold
            ],
                [
                    "data" => [
                        "type"    => "button",
                        'value'   => T("inGame", "productionBoost." . ($hasBoost ? 'extend' : 'activate')),
                        'confirm' => '',
                        'onclick' => '',
                    ],
                ],
                T("inGame", "productionBoost." . ($hasBoost ? 'extend' : 'activate')));
        }
        //supress ww here.
        $data = [];
        if ($infoBox) {
            $data['wayOfPayment'] = [
                "featureKey" => "productionboost" . ucfirst($resClass),
                "context"    => "infobox",
            ];
        }
        if ($production) {
            $data['wayOfPayment'] = [
                "featureKey" => "productionboost" . ucfirst($resClass),
                "context"    => "production",
            ];
        }

        return getButton([
            "type"  => "button",
            "class" => "gold {$extra} " . ($paymentWizard ? 'productionboost' : 'productionBoostButton ') . "{$resClass}",
            'title' => htmlspecialchars(sprintf(T("inGame",
                "productionBoost." . ($hasBoost ? 'extend now' : 'activate now')),
                $this->getTime($config->gold->productionBoostDurationSeconds))),
            'coins' => $config->gold->productionBoostGold,
        ],
            [
                "data" => array_merge([
                    "type"    => "button",
                    'value'   => T("inGame", "productionBoost." . ($hasBoost ? 'extend' : 'activate')),
                    'confirm' => '',
                    'onclick' => '',
                ],
                    $data),
            ],
            T("inGame", "productionBoost." . ($hasBoost ? 'extend' : 'activate')));
    }

    public function getCompleteDemolishButton()
    {
        if (Village::getInstance()->isWW() && !getGame("allowDemolishNowInWW")) {
            return null;
        }
        $session = Session::getInstance();
        $hasPerm = $session->checkSitterPermission(Session::SITTER_CAN_BUY_OR_SPEND_GOLD);
        $config = Config::getInstance();
        if (!$hasPerm) {
            return getButton([
                "type"    => "button",
                "class"   => "gold disabled",
                "onClick" => "if(jQuery(this).hasClass('disabled')){event.stopPropagation(); return false;} else {}",
                "onFocus" => "jQuery('button', 'input[type!=hidden]', 'select').focus(); event.stopPropagation(); return false;",
                "title"   => htmlspecialchars('<span class="warning">' . T("inGame",
                        "sitterNoPermForGold") . '</span>'),
                "coins"   => $config->gold->completeDemolishGold,
            ],
                ["data" => ["type" => "button",]],
                T("Buildings", "mainBuilding.Demolish completely"));
        }

        return getButton([
            "type"  => "button",
            "class" => "gold ",
            "title" => T("Buildings", "mainBuilding.complete_demolish_title"),
            "coins" => $config->gold->completeDemolishGold,
        ],
            [
                "data" => [
                    "type"   => "button",
                    "dialog" => [
                        "saveOnUnload"      => FALSE,
                        "cssClass"          => 'white',
                        'draggable'         => FALSE,
                        'overlayCancel'     => TRUE,
                        'buttonOk'          => FALSE,
                        'data'              => [
                            'cmd'        => 'demolishNowPopup',
                            'additional' => ['gidCallback' => 'getGid'],
                            'context'    => 'demolishNow',
                            'infoIcon'   => 'http:\/\/t4.answers.travian.com\/index.php?aid=%%answers.demolishNow (en)%%#go2answer',
                        ],
                        'preventFormSubmit' => true,
                    ],
                ],
            ],
            T("Buildings", "mainBuilding.Demolish completely"));
    }

    public function getMasterBuilderButton($fieldId, $item_id, $lvl, $link)
    {
        $village = Village::getInstance();
        $session = Session::getInstance();
        $config = Config::getInstance();
        $gold = $village->isWW() ? 0 : $config->gold->masterBuilderGold;
        $hasPerm = $session->checkSitterPermission(Session::SITTER_CAN_BUY_OR_SPEND_GOLD);
        $class = $item_id == 40 ? 'green' : 'gold';
        if (!$hasPerm) {
            return getButton([
                "type"    => "button",
                "class"   => "$class builder disabled",
                "onClick" => "if(jQuery(this).hasClass('disabled')){event.stopPropagation(); return false;} else {}",
                "onFocus" => "jQuery('button', 'input[type!=hidden]', 'select').focus(); event.stopPropagation(); return false;",
                "title"   => htmlspecialchars('<span class="warning">' . T("inGame",
                        "sitterNoPermForGold") . '</span>'),
                "coins"   => $gold,
            ],
                ["data" => ["type" => "button"]],
                T("Buildings", "construct_with_master_builder"));
        }
        if (!$village->isWW() && $session->getAvailableGold() < $gold) {
            return getButton([
                "type"  => "button",
                "class" => "$class builder",
                "coins" => $gold,
            ],
                [
                    "data" => [
                        "type"         => "button",
                        "value"        => T("Buildings", "construct_with_master_builder"),
                        "wayOfPayment" => [
                            "featureKey" => 'constructionMaster',
                            'context'    => '',
                        ],
                        "title"        => '',
                        "confirm"      => '',
                    ],
                ],
                T("Buildings", "construct_with_master_builder"));
        }
        if (($village->isWW() && sizeof($village->onLoadBuildings['master']) >= $config->masterBuilder->maxTasksInWonder) || sizeof($village->onLoadBuildings['master']) >= $config->masterBuilder->maxTasksInNoneWonder) {
            return getButton([
                "type"    => "button",
                "class"   => "$class builder disabled",
                "onClick" => "if(jQuery(this).hasClass('disabled')){event.stopPropagation(); return false;} else {}",
                "coins"   => $gold,
                "onfocus" => "jQuery('button', 'input[type!=hidden]', 'select').focus(); event.stopPropagation(); return false;",
                "title"   => htmlspecialchars('<span class="warning">' . sprintf(T("Buildings",
                        "maxMasterBuilderReached"),
                        $village->isWW() ? $config->masterBuilder->maxTasksInWonder : $config->masterBuilder->maxTasksInNoneWonder) . '</span>'),
            ],
                ["data" => ["type" => "button"]],
                T("Buildings", "construct_with_master_builder"));
        }
        $needUpgradeType = $village->checkArtifactDependencies($item_id);
        if ($needUpgradeType <> 0) {
            switch ($needUpgradeType) {
                case 1:
                    $text = '<span class="warning">' . T("Buildings", "errors.noGreatArtefact") . '</span>';
                    break;
                case 2:
                case 3:
                    $text = '<span class="warning">' . T("Buildings", "errors.wwPlans") . '</span>';
                    break;
                default:
                    $text = '';
                    break;
            }

            return getButton([
                "type"    => "button",
                "class"   => "$class builder disabled",
                "onClick" => "if(jQuery(this).hasClass('disabled')){event.stopPropagation(); return false;} else {}",
                "coins"   => $gold,
                "title"   => htmlspecialchars($text),
            ],
                ["data" => ["type" => "button"]],
                T("Buildings", "construct_with_master_builder"));
        }
        foreach ($village->onLoadBuildings['master'] as $k => $v) {
            if ($fieldId == $v['building_field']) {
                $lvl++;
            }
        }
        $needUpgradeType = $village->checkDependencies($item_id, $lvl);
        if ($needUpgradeType <> 0) {
            switch ($needUpgradeType) {
                case 1:
                    $text = "<span class=\"warning\">" . T("Buildings", "errors.foodShortage") . "</span>";
                    break;
                case 2:
                    $text = "<span class=\"warning\">" . T("Buildings", "errors.upgradeWareHouse") . "</span>";
                    break;
                case 22:
                    $text = "<span class=\"warning\">" . T("Buildings", "errors.constructWarehouse") . "</span>";
                    break;
                case 3:
                    $text = "<span class=\"warning\">" . T("Buildings", "errors.upgradeGranny") . "</span>";
                    break;
                case 33:
                    $text = "<span class=\"warning\">" . T("Buildings", "errors.constructGranny") . "</span>";
                    break;
                default:
                    $text = 'error';
                    break;
            }

            return getButton([
                "type"    => "button",
                "class"   => "$class builder disabled",
                "onClick" => "if(jQuery(this).hasClass('disabled')){event.stopPropagation(); return false;} else {}",
                "coins"   => $gold,
                "title"   => htmlspecialchars($text),
            ],
                ["data" => ["type" => "button"]],
                T("Buildings", "construct_with_master_builder"));
        }
        if ($lvl >= Formulas::buildingMaxLvl($item_id, $village->isCapital())) {
            $text = "<span class=\"warning\">" . T("Buildings", $item_id . ".title") . " " . T("Buildings",
                    "upgradeNotices.reachedMaxLvL") . "</span>";

            return getButton([
                "type"    => "button",
                "class"   => "$class builder disabled",
                "onClick" => "if(jQuery(this).hasClass('disabled')){event.stopPropagation(); return false;} else {}",
                "coins"   => $gold,
                "title"   => htmlspecialchars($text),
            ],
                ["data" => ["type" => "button"]],
                T("Buildings", "construct_with_master_builder"));
        } else if ($lvl >= Formulas::buildingMaxLvl($item_id, $village->isCapital())) {
            $text = "<span class=\"warning\">" . sprintf(T("Buildings", "upgradeNotices.currentlyReachingMaxLevel"),
                    T("Buildings", $item_id . ".title")) . "</span>";

            return getButton([
                "type"    => "button ",
                "class"   => "$class builder disabled",
                "onClick" => "if(jQuery(this).hasClass('disabled')){event.stopPropagation(); return false;} else {}",
                "coins"   => $gold,
                "title"   => htmlspecialchars($text),
            ],
                ["data" => ["type" => "button"]],
                T("Buildings", "construct_with_master_builder"));
        } else if ($village->getOnDemolishBuildingFieldId() == $fieldId) {
            $text = "<span class=\"warning\">" . T("Buildings", "upgradeNotices.buildingIsOnDemolition") . "</span>";

            return getButton([
                "type"    => "button",
                "class"   => "$class builder disabled",
                "onClick" => "if(jQuery(this).hasClass('disabled')){event.stopPropagation(); return false;} else {}",
                "coins"   => $gold,
                "title"   => htmlspecialchars($text),
            ],
                ["data" => ["type" => "button"]],
                T("Buildings", "construct_with_master_builder"));
        }

        return getButton([
            "type"    => "button",
            "class"   => "$class builder",
            "onClick" => 'window.location.href = \'' . $link . '&b=1\'; return false;',
            "coins"   => $gold,
        ],
            ["data" => ["type" => "button"]],
            T("Buildings", "construct_with_master_builder"));
    }

    public function getExchangeResourcesButtonByCost($cost)
    {
        $village = Village::getInstance();
        if ($cost !== -1) {
            if ($village->isResourcesAvailable($cost)) {
                return NULL;
            }
        }
        $err = $village->contractResourcesLink($cost);
        if ($err['code'] > 0) {
            return NULL;
        }
        if ($error = $this->ExchangeResourcesError()) {
            return $error;
        }
        $disabled = false;
        if ($cost !== -1) {
            $disabled = array_sum($village->getCurrentResources()) < array_sum($cost);
        }
        return getButton([
            "type"  => "button",
            "class" => "gold exchange " . ($disabled ? 'disabled' : ''),
        ],
            [
                "data" => [
                    "dialog" => [
                        "cssClass"          => 'white',
                        'draggable'         => FALSE,
                        'overlayCancel'     => TRUE,
                        'buttonOk'          => FALSE,
                        'saveOnUnload'      => FALSE,
                        "data"              => [
                            'cmd'           => 'exchangeResources',
                            'defaultValues' => $cost !== -1 ? [
                                'r1'   => $cost[0],
                                'r2'   => $cost[1],
                                'r3'   => $cost[2],
                                'r4'   => $cost[3],
                                'npc'  => TRUE,
                                'time' => ['max' => $village->calcWhenResourcesAreAvailable($cost)],
                            ] : [],
                        ],
                        'preventFormSubmit' => true,
                    ],
                ],
            ],
            T("GoldHelper", "exchangeResources.exchangeResources"));
    }

    private function ExchangeResourcesError()
    {
        $village = Village::getInstance();
        $session = Session::getInstance();
        $hasPerm = $session->checkSitterPermission(Session::SITTER_CAN_BUY_OR_SPEND_GOLD);
        if (!$hasPerm) {
            return getButton([
                "type"    => "button",
                "class"   => "gold exchange disabled",
                "onClick" => "if(jQuery(this).hasClass('disabled')){event.stopPropagation(); return false;} else {}",
                "onFocus" => "jQuery('button', 'input[type!=hidden]', 'select').focus(); event.stopPropagation(); return false;",
                "title"   => htmlspecialchars('<span class="warning">' . T("inGame",
                        "sitterNoPermForGold") . '</span>'),
            ],
                [],
                T("GoldHelper", "exchangeResources.exchangeResources"));
        }
        if ($village->isWW()) {
            return getButton([
                "type"    => "button",
                "class"   => "gold exchange disabled",
                "onClick" => "if(jQuery(this).hasClass('disabled')){event.stopPropagation(); return false;} else {}",
                "onFocus" => "jQuery('button', 'input[type!=hidden]', 'select').focus(); event.stopPropagation(); return false;",
                "title"   => T("GoldHelper", "exchangeResources.error_in_ww"),
            ],
                [],
                T("GoldHelper", "exchangeResources.exchangeResources"));
        }
        if (!$village->hasMarketPlace()) {
            return getButton([
                "type"    => "button",
                "class"   => "gold exchange disabled",
                "onClick" => "if(jQuery(this).hasClass('disabled')){event.stopPropagation(); return false;} else {}",
                "onFocus" => "jQuery('button', 'input[type!=hidden]', 'select').focus(); event.stopPropagation(); return false;",
                "title"   => T("GoldHelper", "exchangeResources.error_no_marketplace"),
            ],
                [],
                T("GoldHelper", "exchangeResources.exchangeResources"));
        }
        if ($session->getTotalPopulation() < 40) {
            return getButton([
                "type"    => "button",
                "class"   => "gold exchange disabled",
                "onClick" => "if(jQuery(this).hasClass('disabled')){event.stopPropagation(); return false;} else {}",
                "onFocus" => "jQuery('button', 'input[type!=hidden]', 'select').focus(); event.stopPropagation(); return false;",
                "title"   => T("GoldHelper", "exchangeResources.error_low_pop"),
            ],
                [],
                T("GoldHelper", "exchangeResources.exchangeResources"));
        }
        if (array_sum($village->getCurrentResources(-1, TRUE)) < 50) {
            return getButton([
                "type"    => "button",
                "class"   => "gold exchange disabled",
                "onClick" => "if(jQuery(this).hasClass('disabled')){event.stopPropagation(); return false;} else {}",
                "onFocus" => "jQuery('button', 'input[type!=hidden]', 'select').focus(); event.stopPropagation(); return false;",
                "title"   => T("GoldHelper", "exchangeResources.error_low_resources"),
            ],
                [],
                T("GoldHelper", "exchangeResources.exchangeResources"));
        }

        return FALSE;
    }

    public function getExchangeResourcesButtonByNr($nr, $great)
    {
        if ($error = $this->ExchangeResourcesError()) {
            return $error;
        }
        $village = Village::getInstance();
        $helper = new TrainingHelper();
        $max = $helper->getMaxUnitByNr2($nr, $great);
        $cost = Formulas::uTrainingCost(nrToUnitId($nr, Session::getInstance()->getRace()), $great);
        $cur_res = $village->getCurrentResources();
        $disabled = array_sum($cur_res) < array_sum($cost);
        return getButton([
            "type"  => "button",
            "class" => "gold exchange " . ($disabled ? 'disabled' : ''),
        ],
            [
                "data" => [
                    "dialog" => [
                        "cssClass"          => 'white',
                        'draggable'         => FALSE,
                        'overlayCancel'     => TRUE,
                        'buttonOk'          => FALSE,
                        'saveOnUnload'      => FALSE,
                        "data"              => [
                            'cmd'           => 'exchangeResources',
                            'defaultValues' => [
                                'tid'    => Session::getInstance()->getRace(),
                                'nr'     => $nr,
                                "btyp"   => 1,
                                'r1'     => $max * $cost[0],
                                'r2'     => $max * $cost[1],
                                'r3'     => $max * $cost[2],
                                'r4'     => $max * $cost[3],
                                "supply" => 1,
                                "pzeit"  => 1,
                                "max1"   => floor($cur_res[0] / $cost[0]),
                                "max2"   => floor($cur_res[1] / $cost[1]),
                                "max3"   => floor($cur_res[2] / $cost[2]),
                                "max4"   => floor($cur_res[3] / $cost[3]),
                                "max"    => $max,
                            ],
                        ],
                        'preventFormSubmit' => true,
                    ],
                ],
            ],
            T("GoldHelper", "exchangeResources.exchangeResources"));
    }
}