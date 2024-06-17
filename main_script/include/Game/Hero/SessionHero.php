<?php

namespace Game\Hero;

use Core\Caching\Caching;
use Core\Config;
use Core\Database\DB;
use Core\Helper\TimezoneHelper;
use Core\Session;
use Core\Village;
use Game\Formulas;
use Game\Helpers\HeroHealthHelper;
use function getGameSpeed;
use Model\MovementsModel;
use Model\TrainingModel;
use function getDirection;
use function getGame;
use function htmlspecialchars;
use function nanoseconds;
use function number_format_x;

class SessionHero extends HeroHelper
{
    const STATUS_HOME = 100;
    const STATUS_DEAD = 101;
    const STATUS_REVIVING = '101Regenerate';
    const STATUS_ON_ADVENTURE = 50;
    const STATUS_ESCAPING = 40; //101Regenerate
    const STATUS_ON_ATTACK = 4; // on the way
    const STATUS_ON_REINFORCE = 5; // on the way //Hero is escaping.
    const STATUS_IN_RETURN = 9; //on the way
    const STATUS_TRAPPED = 102; //on the way
    const STATUS_IN_ENFORCEMENT = 103; //on the way (from attack)
    private static $_self;
    public $hero = [];
    public $status;
    private $heroTrain = null;
    private $statusShortMessage = '';
    private $statusLongMessage = '';
    private $statusInventoryMessage = '';

    public function __construct()
    {
        $db = DB::getInstance();
        $session = Session::getInstance();
        if (!$session->isValid()) {
            return;
        }
        $this->hero = $db->query("SELECT uid, kid, exp, health, power, offBonus, itemHealth, lastupdate, defBonus, production, productionType, hide FROM hero WHERE uid=" . $session->getPlayerId())->fetch_assoc();
        if ($this->hero['health'] == 0) {
            $this->hero['kid'] = (int)$this->hero['kid'];
            $this->heroTrain = $db->query("SELECT kid, end_time, training_time FROM training WHERE item_id=98 AND kid={$this->hero['kid']}");
            if ($this->heroTrain->num_rows) {
                $this->heroTrain = $this->heroTrain->fetch_assoc();
            } else {
                $this->heroTrain = null;
            }
        } else {
            $healthRate = $this->calcHealth() + $this->hero['itemHealth'];
            $generatedHealth = $healthRate / 86400 * (time() - $this->hero['lastupdate']);
            $this->hero['health'] = min($this->hero['health'] + $generatedHealth, 100);
        }
        $this->findHero();
    }

    public function findHero()
    {
        $needTimer = defined('LOADED_PAGE') && in_array(LOADED_PAGE, ['hero.php', 'start_adventure.php']);
        $village = Village::getInstance();
        $db = DB::getInstance();
        if ($this->heroTrain !== null) {
            $this->status = self::STATUS_REVIVING;
            $this->statusShortMessage = T("HeroGlobal", "shortStatus.reviving");
            $villageName = $this->hero['kid'] == $village->getKid() ? $village->getName() : $db->fetchScalar("SELECT name FROM vdata WHERE kid={$this->hero['kid']} LIMIT 1");
            $this->statusLongMessage = sprintf(T("HeroGlobal", "longStatus.reviving"), $villageName);
            if ($needTimer) {
                $endTime = $this->heroTrain['end_time'];
                if (getGame("useNanoseconds")) {
                    $endTime = ceil($endTime / 1e9);
                } else if (getGame("useMilSeconds")) {
                    $endTime = ceil($endTime / 1e3);
                }
                $this->statusInventoryMessage = sprintf(T("HeroGlobal", "inventoryStatus.reviving"),
                        $this->hero['kid'],
                        $villageName) . ' ' . appendTimer($endTime - time());
            }
            return true;
        } else if ($this->hero['health'] == 0) {
            $this->status = self::STATUS_DEAD;
            $this->statusShortMessage = T("HeroGlobal", "shortStatus.dead");
            $villageName = $this->hero['kid'] == $village->getKid() ? $village->getName() : $db->fetchScalar("SELECT name FROM vdata WHERE kid={$this->hero['kid']} LIMIT 1");
            $this->statusLongMessage = T("HeroGlobal", "longStatus.dead");
            if ($needTimer) {
                $this->statusInventoryMessage = sprintf(T("HeroGlobal", "inventoryStatus.dead"),
                    $this->hero['kid'],
                    $villageName);
            }
            return true;
        } else if ($this->hero['kid'] == $village->getKid()) {
            $find = $db->query("SELECT u11 FROM units WHERE kid={$this->hero['kid']} AND u11>0 LIMIT 1");
            if ($find->num_rows) {
                $this->status = self::STATUS_HOME;
                $this->statusShortMessage = T("HeroGlobal", "shortStatus.Home");
                $this->statusLongMessage = sprintf(T("HeroGlobal", "longStatus.Home"), $village->getName());
                if ($needTimer) {
                    $this->statusInventoryMessage = sprintf(T("HeroGlobal", "inventoryStatus.Home"),
                        $this->hero['kid'],
                        $village->getName());
                }
                return true;
            }
        } else {
            $find = $db->query("SELECT u11 FROM units WHERE kid={$this->hero['kid']} AND u11>0 LIMIT 1");
            if ($find->num_rows) {
                $this->status = self::STATUS_HOME;
                $this->statusShortMessage = T("HeroGlobal", "shortStatus.Home");
                $villageName = $db->fetchScalar("SELECT name FROM vdata WHERE kid={$this->hero['kid']} LIMIT 1");
                $this->statusLongMessage = sprintf(T("HeroGlobal", "longStatus.Home"), $villageName);
                if ($needTimer) {
                    $this->statusInventoryMessage = sprintf(T("HeroGlobal", "inventoryStatus.Home"),
                        $this->hero['kid'],
                        $villageName);
                }
                return true;
            }
        }
        $find = $db->query("SELECT to_kid FROM enforcement WHERE u11>0 AND kid=" . $this->hero['kid']);
        if ($find->num_rows) {
            $find = $find->fetch_assoc();
            $this->status = self::STATUS_IN_ENFORCEMENT;
            $this->statusShortMessage = T("HeroGlobal", "shortStatus.defending");
            $villageName = $find['to_kid'] == $village->getKid() ? $village->getName() : $db->fetchScalar("SELECT name FROM vdata WHERE kid={$find['to_kid']} LIMIT 1");
            $this->statusLongMessage = sprintf(T("HeroGlobal", "longStatus.defending"), $villageName);
            if ($needTimer) {
                $this->statusInventoryMessage = sprintf(T("HeroGlobal", "inventoryStatus.Home"),
                    $find['to_kid'],
                    $villageName);
            }
            return true;
        }
        $find = $db->query("SELECT to_kid FROM trapped WHERE u11>0 AND kid=" . $this->hero['kid']);
        if ($find->num_rows) {
            $find = $find->fetch_assoc();
            $this->status = self::STATUS_TRAPPED;
            $this->statusShortMessage = T("HeroGlobal", "shortStatus.trapped");
            $villageName = $find['to_kid'] == $village->getKid() ? $village->getName() : $db->fetchScalar("SELECT name FROM vdata WHERE kid={$find['to_kid']} LIMIT 1");
            $this->statusLongMessage = sprintf(T("HeroGlobal", "longStatus.trapped"), $villageName);
            if ($needTimer) {
                $this->statusInventoryMessage = sprintf(T("HeroGlobal", "inventoryStatus.trapped"),
                    $find['to_kid'],
                    $villageName);
            }

            return true;
        }
        //not trapped not enforcement not in village :| so in movement!
        $find = $db->query("SELECT kid, to_kid, mode, attack_type, start_time, end_time FROM movement WHERE u11>0 AND ((mode=1 AND to_kid={$this->hero['kid']}) OR (mode=0 AND kid={$this->hero['kid']})) LIMIT 1");
        if ($find->num_rows) {
            $find = $find->fetch_assoc();
            $find['start_time_seconds'] = ceil($find['start_time'] / 1000);
            $find['end_time_seconds'] = ceil($find['end_time'] / 1000);
            if ($find['mode'] == 0) {
                //on the way :|
                switch ($find['attack_type']) {
                    case MovementsModel::ATTACKTYPE_ADVENTURE:
                        $this->status = self::STATUS_ON_ADVENTURE;
                        $this->statusShortMessage = T("HeroGlobal", "shortStatus.adventure");
                        $xy = Formulas::kid2xy($find['to_kid']);
                        $text = ' (' . $xy['x'] . '|' . $xy['y'] . ')';
                        $text2 = '<a class="" href="karte.php?x=' . $xy['x'] . '&amp;y=' . $xy['y'] . '">‎‭<span class="coordinates coordinatesWrapper"><span class="coordinateX">(' . $xy['x'] . '‬‬</span><span class="coordinatePipe">|</span><span class="coordinateY">‭' . $xy['y'] . '‬‬)</span></span>‬‎</a>';
                        $this->statusLongMessage = sprintf(T("HeroGlobal", "longStatus.adventure"),
                            $text,
                            secondsToString($find['end_time_seconds'] - time()),
                            TimezoneHelper::date('H:i', $find['end_time_seconds']));
                        if ($needTimer) {
                            $this->statusInventoryMessage = sprintf(T("HeroGlobal", "inventoryStatus.adventure"),
                                $text2,
                                appendTimer($find['end_time_seconds'] - time()),
                                TimezoneHelper::date('H:i', $find['end_time_seconds']),
                                $this->hero['kid']);
                        }
                        $this->hero['toKidAdventure'] = $find['to_kid'];
                        break;
                    case MovementsModel::ATTACKTYPE_REINFORCEMENT:
                        $this->status = self::STATUS_ON_REINFORCE;
                        $villageName = $this->hero['kid'] == $village->getKid() ? $village->getName() : $db->fetchScalar("SELECT name FROM vdata WHERE kid={$this->hero['kid']} LIMIT 1");
                        $this->statusShortMessage = T("HeroGlobal", "shortStatus.attack");
                        $this->statusLongMessage = sprintf(T("HeroGlobal", "longStatus.attack"),
                            $villageName,
                            secondsToString($find['end_time_seconds'] - time()),
                            TimezoneHelper::date('H:i', $find['end_time_seconds']));
                        if ($needTimer) {
                            $this->statusInventoryMessage = sprintf(T("HeroGlobal", "inventoryStatus.attack"),
                                $this->hero['kid'],
                                $villageName,
                                appendTimer($find['end_time_seconds'] - time()),
                                TimezoneHelper::date('H:i', $find['end_time_seconds']));
                        }
                        break;
                    case MovementsModel::ATTACKTYPE_EVASION:
                        $this->status = self::STATUS_ESCAPING;
                        $this->statusShortMessage = T("HeroGlobal", "shortStatus.escape");
                        $this->statusLongMessage = sprintf(T("HeroGlobal", "longStatus.escape"),
                            secondsToString($find['end_time_seconds'] - time()),
                            TimezoneHelper::date('H:i', $find['end_time_seconds']));
                        if ($needTimer) {
                            $this->statusInventoryMessage = sprintf(T("HeroGlobal", "longStatus.escape"),
                                appendTimer($find['end_time_seconds'] - time()),
                                TimezoneHelper::date('H:i', $find['end_time_seconds']));
                        }
                        break;
                    case MovementsModel::ATTACKTYPE_RAID:
                    case MovementsModel::ATTACKTYPE_NORMAL:
                        $villageName = $this->hero['kid'] == $village->getKid() ? $village->getName() : $db->fetchScalar("SELECT name FROM vdata WHERE kid={$this->hero['kid']} LIMIT 1");
                        $this->status = self::STATUS_ON_ATTACK;
                        $this->statusShortMessage = T("HeroGlobal", "shortStatus.attack");
                        $this->statusLongMessage = sprintf(T("HeroGlobal", "longStatus.attack"),
                            $villageName,
                            secondsToString($find['end_time_seconds'] - time()),
                            TimezoneHelper::date('H:i', $find['end_time_seconds']));
                        if ($needTimer) {
                            $this->statusInventoryMessage = sprintf(T("HeroGlobal", "inventoryStatus.attack"),
                                $this->hero['kid'],
                                $villageName,
                                appendTimer($find['end_time_seconds'] - time()),
                                TimezoneHelper::date('H:i', $find['end_time_seconds']));
                        }
                        break;
                    default:
                        //i don't know where u sent hero to! find it ur self :|
                        break;
                }
            } else {
                $this->status = self::STATUS_IN_RETURN;
                $this->statusShortMessage = T("HeroGlobal", "shortStatus.return");
                $villageName = $find['to_kid'] == $village->getKid() ? $village->getName() : $db->fetchScalar("SELECT name FROM vdata WHERE kid={$find['to_kid']} LIMIT 1");
                $this->statusLongMessage = sprintf(T("HeroGlobal", "longStatus.return"),
                    $villageName,
                    secondsToString($find['end_time_seconds'] - time()),
                    TimezoneHelper::date('H:i', $find['end_time_seconds']));
                if ($needTimer) {
                    $this->statusInventoryMessage = sprintf(T("HeroGlobal", "inventoryStatus.return"),
                        $find['to_kid'],
                        $villageName,
                        appendTimer($find['end_time_seconds'] - time()),
                        TimezoneHelper::date('H:i', $find['end_time_seconds']));
                }
            }
        }/* else {
            //hero not found! fix the bug :>
            $db->query("UPDATE hero SET health=0 WHERE uid={$this->hero['uid']}");
            $this->hero['health'] = 0;
            $this->findHero();
            return FALSE;
        }*/
    }

    public static function getInstance()
    {
        if (!(self::$_self instanceof self)) {
            self::$_self = new self();
        }
        return self::$_self;
    }

    public function evasionStatus()
    {
        return $this->hero['hide'];
    }

    public function hasNewPoints()
    {
        return $this->getAvailablePoints() > 0;
    }

    public function getAvailablePoints()
    {
        $points = (Formulas::heroLevel($this->hero['exp']) >= 100 ? 100 : Formulas::heroLevel($this->hero['exp'])) * 4;
        if (Formulas::heroLevel($this->hero['exp']) < 100) {
            $points += 4;
        }
        return $points - ($this->hero['power'] + $this->hero['offBonus'] + $this->hero['defBonus'] + $this->hero['production']);
    }

    public function getHeroExp()
    {
        return $this->hero['exp'];
    }

    public function getHeroExpPercent()
    {
        $lvl = Formulas::heroLevel($this->hero['exp']);
        return 100 * ($this->hero['exp'] - Formulas::heroExperience($lvl)) / (Formulas::heroExperience($lvl + 1) - Formulas::heroExperience($lvl));
    }

    public function getRegeneratedHealth()
    {
        if ($this->heroTrain == null) {
            return $this->getHeroHealth();
        }
        $milSecond = getGame("useMilSeconds");
        $nanoseconds = getGame("useNanoseconds");
        $now = ($nanoseconds ? nanoseconds() : ($milSecond ? miliseconds() : time()));
        $health = min(100, (($this->heroTrain['training_time'] - ($this->heroTrain['end_time'] - $now)) / $this->heroTrain['training_time']) * 100);
        return floor($health);
    }

    public function getHeroHealth()
    {
        $health = floor($this->hero['health']);
        if ($health == 0 && $this->hero['health'] > 0) {
            return 1;
        }
        return $health;
    }

    public function trainHero($waterBucket = false)
    {
        $db = DB::getInstance();
        if ($this->heroTrain !== null) {
            if ($waterBucket) {
                $db->query("DELETE FROM training WHERE nr=11 AND kid={$this->heroTrain['kid']}");
                $this->heroTrain = null;
            } else {
                return;
            }
        }
        $this->hero['kid'] = Village::getInstance()->getKid();
        if ($waterBucket) {
            (new TrainingModel())->regenerateHero($this->hero['uid'], $this->hero['kid']);
            $this->hero['health'] = 100;
        } else {
            $milSecond = getGame("useMilSeconds");
            $nanoseconds = getGame("useNanoseconds");
            $neededTime = Formulas::heroRegenerationTime($this->getLevel());
            $end_time = $neededTime + ($nanoseconds ? nanoseconds() : ($milSecond ? miliseconds() : time()));
            $db->query("INSERT INTO training (kid, nr, num, item_id, training_time, commence, end_time) VALUES ({$this->hero['kid']}, 11, 1, 98, {$neededTime}," . $end_time . "," . $end_time . ")");
            $db->query("UPDATE hero SET kid={$this->hero['kid']} WHERE uid=" . $this->hero['uid']);
            $this->heroTrain = [
                "kid" => $this->hero['kid'],
                "end_time" => $end_time,
                "training_time" => $neededTime,
            ];
        }
        $this->findHero();
        $session = Session::getInstance();
        Caching::getInstance()->delete("hero_sidebar_{$session->getPlayerId()}");
    }

    public function getLevel()
    {
        return Formulas::heroLevel($this->hero['exp']);
    }

    public function getShortStatus()
    {
        return $this->statusShortMessage;
    }

    public function getLongStatus()
    {
        return $this->statusLongMessage;
    }

    public function getInventoryStatus()
    {
        return $this->statusInventoryMessage;
    }

    public function getHeroFightingStrengthTitle($inventory)
    {
        $HTML = T("HeroInventory", "fightingStrength") . '||';
        $HTML .= T("HeroInventory", "fightingStrengthDesc") . '<br />';
        $HTML .= '<span class="heroAttributeInformation">' . T("HeroInventory", "fightingStrength") . ': ';
        $HTML .= $this->calcPower(Session::getInstance()->getRace(), $this->hero['power']) . ' ' . T("HeroInventory",
                "fromHero");
        $item = $this->calcItemPower($inventory['rightHand'], $inventory['leftHand'], $inventory['body']);
        if ($item) {
            $HTML .= ' +' . $item . ' ' . T("HeroInventory", "fromItem");
        }
        $HTML .= '</span>';

        return $HTML;
    }

    public function getHeroItems()
    {
        $items = [];
        $db = DB::getInstance();
        $data = $db->query("SELECT * FROM items WHERE uid=" . Session::getInstance()->getPlayerId());
        if (!$data->num_rows) {
            return $items;
        }
        $array = 0;
        $heroItems = new HeroItems();
        $n = 0;
        while ($row = $data->fetch_assoc()) {
            $itemData = $heroItems->getHeroItemProperties($row['btype'], $row['type']);
            $items[$array]['id'] = (int)$row['id'];
            $items[$array]['typeId'] = (int)$row['type'];
            $items[$array]['placeId'] = $row['proc'] == 1 ? (--$n) : (int)$row['placeId'];
            $items[$array]['name'] = htmlspecialchars("{$itemData['name']}");
            $items[$array]['place'] = $row['proc'] ? $itemData['slot'] : "inventory";
            $items[$array]['slot'] = $itemData['slot'];
            $items[$array]['amount'] = (int)$row['num'];
            $items[$array]['instant'] = $itemData['instant'];
            $items[$array]['isUsableIfDead'] = $itemData['isUsableIfDead'];
            $items[$array]['attributes'] = $itemData['attributes'];
            $array++;
        }
        return $items;
    }


    public function useOneDialogTitleCallbacks($inventory)
    {
        $db = DB::getInstance();
        $items = $db->query("SELECT * FROM items WHERE btype IN(10, 12, 14, 15) AND proc=0 AND uid=" . Session::getInstance()->getPlayerId());
        if (!$items->num_rows) {
            return null;
        }
        $return = ',';
        $itemProperties = [];
        $heroAlive = $this->getHeroStatus() == self::STATUS_DEAD;
        $HeroItems = new HeroItems();

        while ($item = $items->fetch_assoc()) {
            $btype = $item['btype'];
            $type = $item['type'];
            if (!isset($itemProperties[$btype][$type])) {
                $itemProperties[$btype][$type] = $HeroItems->getHeroItemProperties($btype, $type);
            } else {
                continue;
            }
            switch ($item['btype']) {
                case 10://katibe
                    $currentHeroExperience = T("HeroInventory", "currentHeroExperience");
                    $heroExperienceGainFromItems = T("HeroInventory", "heroExperienceGainFromItems");
                    $heroExperienceBonus = T("HeroInventory", "heroExperienceBonus");
                    $heroExperienceAfterUse = T("HeroInventory", "heroExperienceAfterUse");
                    $moreEXP = $this->calcMoreExp($inventory['helmet']);
                    $current = <<<JS
                        {$item['type']}: function(item, options, dialogOptions)
                        {
                            dialogOptions.text = options.text.useDialogDescription;
                            dialogOptions.text += '<table id="heroInventoryDataDialog" class="transparent" cellspacing="0" cellpadding="0">';
                            dialogOptions.text += '<tr class="rowBeforeUse"><th>{$currentHeroExperience}:</th><td>' + options.heroState.experience + '</td></tr>';
                            if($moreEXP > 0){
                                dialogOptions.text += '<tr class="rowUseValue"><th>{$heroExperienceBonus} ({$moreEXP}%):</th><td class="displayUseBonus">0</td></tr>';
                            }
                            dialogOptions.text += '<tr class="rowUseValue"><th>{$heroExperienceGainFromItems}:</th><td class="displayUseValue">0</td></tr>';
                            dialogOptions.text += '<tr class="rowAfterUse"><th>{$heroExperienceAfterUse}:</th><td class="displayAfterUse">' + options.heroState.experience + '</td></tr>';
                            dialogOptions.text += '</table>';

                            dialogOptions.calculate = {
                                valuePerItem: {$itemProperties[$btype][$type]['exp']},
                                currentValue: options.heroState.experience,
                                bonusPercent: {$moreEXP}
                            };

                            return dialogOptions;
                        }
JS;
                    break;
                case 12://satl //check per day
                    $executeAfterOkay = "true";
                    if ($this->getHeroStatus() != self::STATUS_DEAD && !($this->getHeroStatus() == self::STATUS_REVIVING)) {
                        $heroAlive = "dialogOptions.text = '" . T("HeroInventory",
                                "HeroAliveAndCannotUseBucket") . "';";
                        $heroAlive .= "dialogOptions.text += '<br /><span class=\"itemNotMoveable\">" . T("HeroInventory",
                                "YouCannotUseThisItemCurrently") . "</span>';";
                        $executeAfterOkay = "false";
                    } else {
                        $interval = 86400 / Config::getInstance()->heroConfig->waterBucketsPerDay;
                        if (time() < ($inventory['lastWaterBucketUse'] + $interval)) {
                            $heroAlive = "dialogOptions.text = '" . sprintf(T("HeroInventory", "waterBucketsUsed"),
                                    TimezoneHelper::autoDate($inventory['lastWaterBucketUse'] + $interval,
                                        true)) . "';";
                            $heroAlive .= "dialogOptions.text += '<br /><span class=\"itemNotMoveable\">" . T("HeroInventory",
                                    "YouCannotUseThisItemCurrently") . "</span>';";
                            $executeAfterOkay = "false";
                        } else if ($this->getHeroStatus() == self::STATUS_REVIVING) {
                            $heroAlive = "dialogOptions.text = '" . T("HeroInventory",
                                    "YourHeroWillBeAliveImmediatelyAndOneWaterBucketWillBeUsedAndNoResourcesWillBeRefunded") . "';";
                        }
                    }
                    $current = <<<JS
                     {$item['type']}: function(item, options, dialogOptions)
				    {
				        {$heroAlive}
						dialogOptions.executeAfterOkay = {$executeAfterOkay};
						if (dialogOptions.executeAfterOkay)
					    {
						    dialogOptions.text += (dialogOptions.text != '' ? '<br />' : '') + options.text.useOneDialogTitle;
					    }

					return dialogOptions;
				}
JS;
                    break;
                case 14:
                    $currentLoyalty = Village::getInstance()->getLoyalty();
                    if ($currentLoyalty >= 125) {
                        $loyaltyIsMaxYourCannotIncreaseItMore = T("HeroInventory",
                            "loyaltyIsMaxYourCannotIncreaseItMore");
                        $YouCannotUseThisItemCurrently = T("HeroInventory", "YouCannotUseThisItemCurrently");
                        $current = <<<JS
{$item['type']}: function(item, options, dialogOptions)
				{
					dialogOptions.text = '{$loyaltyIsMaxYourCannotIncreaseItMore}';
					dialogOptions.text += '<br /><span class="itemNotMoveable">{$YouCannotUseThisItemCurrently}</span>';
					dialogOptions.executeAfterOkay = false;

					return dialogOptions;
				}
JS;
                    }
                    break;
                case 15://artwork
                    $itemProperties = (new HeroItems())->getHeroItemProperties(15, 111);
                    $cp = min($itemProperties['cp'], $db->fetchScalar("SELECT SUM(cp) FROM vdata WHERE owner=" . Session::getInstance()->getPlayerId()));

                    $currentCulturePoints = T("HeroInventory", "currentCulturePoints");
                    $culturePointsGainFromItems = T("HeroInventory", "culturePointsGainFromItems");
                    $culturePointsAfterUsage = T("HeroInventory", "culturePointsAfterUsage");
                    $current = <<<JS
                        {$item['type']}: function(item, options, dialogOptions)
                        {
                            dialogOptions.text = options.text.useDialogDescription;
                            dialogOptions.text += '<table id="heroInventoryDataDialog" class="transparent" cellspacing="0" cellpadding="0">';
                            dialogOptions.text += '<tr class="rowBeforeUse"><th>{$currentCulturePoints}:</th><td>' + options.heroState.culturePoints + '</td></tr>';
                            dialogOptions.text += '<tr class="rowUseValue"><th>{$culturePointsGainFromItems}:</th><td class="displayUseValue">0</td></tr>';
                            dialogOptions.text += '<tr class="rowAfterUse"><th>{$culturePointsAfterUsage}:</th><td class="displayAfterUse">0</td></tr>';
                            dialogOptions.text += '</table>';

                            dialogOptions.calculate = {
                                valuePerItem: {$cp},
                                currentValue: options.heroState.culturePoints,
                                bonusPercent: 0
                            };

                            return dialogOptions;
                        }
JS;
                    break;
            }
            if (!empty($current)) {
                $return .= $current;
                if (!empty($return)) {
                    $return .= ',';
                }
            }
        }
        return $return;
    }

    public function getHeroStatus()
    {
        return $this->status;
    }

    public function getHeroDefBonusTitle()
    {
        $HTML = T("HeroInventory", "defBonus") . '||';
        $HTML .= T("HeroInventory", "defBonusDesc") . ' ';
        $HTML .= '<br /><span class="heroAttributeInformation">' . T("HeroInventory", "defBonus") . ': ';
        $HTML .= $this->calcDefBonus($this->hero['defBonus']) . '%';
        $HTML .= '</span>';
        return $HTML;
    }

    public function getHeroOffBonusTitle()
    {
        $HTML = T("HeroInventory", "offBonus") . '||';
        $HTML .= T("HeroInventory", "offBonusDesc") . ' ';
        $HTML .= '<br /><span class="heroAttributeInformation">' . T("HeroInventory", "offBonus") . ': ';
        $HTML .= $this->calcOffBonus($this->hero['offBonus']) . '%';
        $HTML .= '</span>';

        return $HTML;
    }

    public function getHeroProductBonusTitle()
    {
        $HTML = T("HeroInventory", "productBonus") . '||';
        $HTML .= T("HeroInventory", "productBonusDesc") . ' ';
        $HTML .= '<br /><span class="heroAttributeInformation">' . T("HeroInventory", "increaseOfProduction") . ': ';
        $img = $title = '';
        if ($this->hero['productionType'] == 0) {
            $title = T("inGame", "resources.r0");
            $img = 'r0';
        } else if ($this->hero['productionType'] == 1) {
            $title = T("inGame", "resources.r1");
            $img = 'r1';
        } else if ($this->hero['productionType'] == 2) {
            $title = T("inGame", "resources.r2");
            $img = 'r2';
        } else if ($this->hero['productionType'] == 3) {
            $title = T("inGame", "resources.r3");
            $img = 'r3';
        } else if ($this->hero['productionType'] == 4) {
            $img = 'r4';
            $title = T("inGame", "resources.r4");
        }
        $production = ($img == 'r0' ? 6 : 20) * $this->hero['production'] * Config::getInstance()->heroConfig->resourcesMultiplier;
        if ($img == 'r4') {
            $production += 6;
        }
        $HTML .= '<img title="' . $title . '" alt="' . $title . '" class="' . $img . '" src="img/x.gif"/> <span class="value">' . $production . '</span>';
        $HTML .= '</span>';

        return $HTML;
    }

    public function getSpeedTitle($inventory)
    {
        $HTML = T("HeroInventory", "speed") . '||' . T("HeroInventory", "speedOfYourHero");
        $HTML .= '<br /><span class="heroAttributeInformation">';
        $effect = 0;
        $itemSpeed = $this->calcItemSpeed($inventory['horse'], $inventory['shoes']);
        if ($itemSpeed) {
            $HTML .= T("HeroInventory", "speed") . ": $itemSpeed " . T("HeroInventory",
                    "fieldPerHour") . ' ' . T("HeroInventory", "fromHorse");
        } else {
            $HTML .= T("HeroInventory", "speed") . ": " . $this->calcSpeed(Session::getInstance()->getRace(),
                    $inventory['horse']) . " " . T("HeroInventory", "fieldPerHour") . ' ' . T("HeroInventory",
                    "fromHero");
        }
        if ($itemSpeed - $effect) {
            $HTML .= ' +' . ($itemSpeed - $effect) . " " . T("HeroInventory", "fieldPerHour") . ' ' . T("HeroInventory",
                    "fromItem");
        }
        return $HTML;
    }

    public function getHeroLevelTitle()
    {
        $HTML = T("HeroInventory", "heroLevel") . '||';
        $HTML .= '<br /><span class="heroAttributeInformation">';
        switch (Session::getInstance()->getRace()) {
            case 1:
                $HTML .= sprintf(T("HeroInventory", "RomanSpecialHeroAttribute"), 100);
                break;
            case 2://percent mark :((
                $HTML .= sprintf(T("HeroInventory", "TeutonSpecialHeroAttribute"), 30 . "%");
                break;
            case 3:
                $HTML .= sprintf(T("HeroInventory", "GualSpecialHeroAttribute"), 5);
                break;
        }
        $HTML .= '</span>';

        return $HTML;
    }

    public function getHealthTitle($inventory)
    {
        $item = $this->calcItemHealth($inventory['helmet'], $inventory['body'], $inventory['shoes']);
        $basic = $this->calcHealth();
        $HTML = T("HeroInventory", "health") . '||';
        $HTML .= T("HeroInventory", "heroRegenerationRate") . ': ' . (($basic) + ($item)) . '% ' . T("HeroInventory", "perDay");
        $HTML .= '<br />';
        $HTML .= '<span class="heroAttributeInformation">' . T("HeroInventory",
                "health") . ': ' . $basic . '% ' . T("HeroInventory", "perDay") . ' ' . T("HeroInventory", "fromHero");
        if ($item) {
            $HTML .= ' +' . $item . '% ' . T("HeroInventory", "perDay") . ' ' . T("HeroInventory", "fromItem") . ' </span>';
        }

        return $HTML;
    }

    public function getExperienceTitle($inventory)
    {
        $HTML = T("HeroInventory", "experience") . '||';
        $level = $this->getLevel();
        $expNeeded = Formulas::heroExperience($level + 1) - $this->hero['exp'];
        if (getDirection() == 'RTL') {
            $HTML .= sprintf(T("HeroInventory", "experienceNeededToNextLevel"),
                $level + 1,
                number_format_x($expNeeded));
        } else {
            $HTML .= sprintf(T("HeroInventory", "experienceNeededToNextLevel"),
                number_format_x($expNeeded),
                $level + 1);
        }
        $item = $this->calcMoreExp($inventory['helmet']);
        if ($item) {
            $HTML .= '<br />';
            $HTML .= '<span class="heroAttributeInformation">' . T("HeroInventory",
                    "Bonus") . ': +' . $item . '%</span>';
        }
        return $HTML;
    }

    public function getHeroProductionTitle($title = true)
    {
        $HTML = T("HeroInventory", "HeroProduction") . ' ';
        if ($title) {
            $HTML .= '||';
            $HTML .= T("HeroInventory", "currentHeroProduction") . ':<br />';
            $HTML .= '<span class="heroAttributeInformation">';
            $HTML .= T("HeroInventory", "HeroProduction");
        }
        $img = '';
        if ($this->hero['productionType'] == 0) {
            $title = T("inGame", "resources.r0");
            $img = 'r0';
        } else if ($this->hero['productionType'] == 1) {
            $title = T("inGame", "resources.r1");
            $img = 'r1';
        } else if ($this->hero['productionType'] == 2) {
            $title = T("inGame", "resources.r2");
            $img = 'r2';
        } else if ($this->hero['productionType'] == 3) {
            $title = T("inGame", "resources.r3");
            $img = 'r3';
        } else if ($this->hero['productionType'] == 4) {
            $img = 'r4';
            $title = T("inGame", "resources.r4");
        }
        $production = ($img == 'r0' ? 6 : 20) * $this->hero['production'] * Config::getInstance()->heroConfig->resourcesMultiplier;
        if ($img == 'r4') {
            $production += 6;
        }
        $HTML .= '<i class="'.$img.'"></i> <span class="value" ' . (getDisplay("smallResourcesFontSize") ? 'style="font-size: 11px;"' : '') . '>' . number_format_x($production) . '</span>';
        if ($img != 'r4') {
            $HTML .= ' + <i class="r4"></i> <span class="current" ' . (getDisplay("smallResourcesFontSize") ? 'style="font-size: 11px;"' : '') . '>6</span>';
        }
        if ($title) {
            $HTML .= '</span>';
        }
        return $HTML;
    }
}