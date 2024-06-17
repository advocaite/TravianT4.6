<?php

namespace Controller\Ajax;

use Core\Caching\Caching;
use Core\Config;
use Core\Database\DB;
use Core\Helper\TimezoneHelper;
use Core\Session;
use Core\Village;
use Game\Helpers\CulturePointsHelper;
use Game\Helpers\HeroHealthHelper;
use Game\Helpers\LoyaltyHelper;
use Game\Hero\HeroHelper;
use Game\Hero\HeroItems;
use Game\Hero\SessionHero;
use Game\ResourcesHelper;
use Model\AuctionModel;
use Model\Quest;
use Model\VillageModel;
use function in_array;

class heroInventory extends AjaxBase
{
    public function dispatch()
    {
        if (!Session::getInstance()->isValid()) {
            return;
        }
        if ($_POST['a'] != $this->session->hero->hero['kid']) {
            return;
        }
        if ($_POST['c'] != Session::getInstance()->getChecker()) {
            return;
        }
        $db = DB::getInstance();
        $selectedItem = $db->query("SELECT * FROM items WHERE uid=" . Session::getInstance()->getPlayerId() . " AND id=" . (int)$_POST['id']);
        if (!$selectedItem->num_rows) {
            return;
        }
        $selectedItem = $selectedItem->fetch_assoc();
        $this->response['data']['itemTypeId'] = (int)$selectedItem['type'];
        $this->response['data']['experienceBefore'] = (int)$this->session->hero->hero['exp'];
        $this->response['data']['culturePointsBefore'] = (int)Session::getInstance()->getCP();
        $amount = abs((int)$_REQUEST['amount']);
        if ($selectedItem['num'] < $amount || $amount <= 0) {
            $amount = $selectedItem['num'];
        }
        $this->response['data']['amountUsed'] = $amount;
        $inventory = $db->query("SELECT * FROM inventory WHERE uid=" . Session::getInstance()->getPlayerId())->fetch_assoc();
        $nextExperience = (int)$this->session->hero->hero['exp'];
        $nextCulturePoints = (int)Session::getInstance()->getCP();
        $heroItems = new HeroItems();
        $itemProperties = $heroItems->getHeroItemProperties($selectedItem['btype'], $selectedItem['type']);
        if (!$itemProperties['isUsableIfDead'] && ($this->session->hero->getHeroStatus() == SessionHero::STATUS_DEAD || $this->session->hero->getHeroStatus() == SessionHero::STATUS_REVIVING)) {
            goto after;
        }
        if (substr($_REQUEST['drid'], 0, strlen("inventory")) == "inventory") {
            if (!$selectedItem['proc'] || $inventory[$itemProperties['slot']] != $selectedItem['id']) {
                $this->handleChangePlace($selectedItem);
                goto after;
            }
            $inventory = $this->handleMoveSlotToInventory($itemProperties, $selectedItem, $inventory);
        } else {
            $this->handleUseItem($itemProperties,
                $inventory,
                $selectedItem,
                $amount,
                $nextExperience,
                $nextCulturePoints);
        }
        after:
        $this->response['data']['items'] = $this->session->hero->getHeroItems();
        $m = new AuctionModel();
        $this->response['data']['inventorySize'] = max($m->getMaxPlaceId(Session::getInstance()->getPlayerId()), 12);
        $helper = new HeroHelper();
        $this->response['data']['heroData']['percent'] = $this->session->hero->hero['power'];
        $this->response['data']['heroData']['power'] = [
            "current" => $helper->calcTotalPower(Session::getInstance()->getRace(),
                $this->session->hero->hero['power'],
                $inventory['rightHand'],
                $inventory['leftHand'],
                $inventory['body']),
            "percent" => $this->session->hero->hero['power'],
            "points"  => $this->session->hero->hero['power'],
            "tooltip" => $this->session->hero->getHeroFightingStrengthTitle($inventory),
        ];
        $this->response['data']['heroData']['offBonus'] = [
            "current" => ($this->session->hero->hero['offBonus'] * 0.2 * 10) / 10,
            "percent" => $this->session->hero->hero['offBonus'],
            "points"  => $this->session->hero->hero['offBonus'],
            "tooltip" => $this->session->hero->getHeroOffBonusTitle(),
        ];
        $this->response['data']['heroData']['defBonus'] = [
            "current" => ($this->session->hero->hero['defBonus'] * 0.2 * 10) / 10,
            "percent" => $this->session->hero->hero['defBonus'],
            "points"  => $this->session->hero->hero['defBonus'],
            "tooltip" => $this->session->hero->getHeroDefBonusTitle(),
        ];
        $this->response['data']['heroData']['productionPoints'] = [
            "current" => $this->session->hero->hero['production'],
            "percent" => $this->session->hero->hero['production'],
            "points"  => $this->session->hero->hero['production'],
            "tooltip" => $this->session->hero->getHeroProductionTitle(TRUE),
        ];
        $this->response['data']['heroData']['experience'] = [
            "current" => $this->session->hero->hero['exp'],
            "percent" => $this->session->hero->getHeroExpPercent(),
            "tooltip" => $this->session->hero->getExperienceTitle($inventory),
        ];
        $this->response['data']['heroData']['health'] = [
            "backgroundColor" => "#006900",
            "percent"         => floor($this->session->hero->hero['health']),
            "tooltip"         => $this->session->hero->getHealthTitle($inventory),
        ];
        $this->response['data']['heroData']['level'] = [
            "current" => $this->session->hero->getLevel(),
            "percent" => min(100, $this->session->hero->getLevel()),
            "tooltip" => $this->session->hero->getHeroLevelTitle(),
        ];
        $this->response['data']['heroData']['speed'] = [
            "current" => $helper->calcTotalSpeed(Session::getInstance()->getRace(),
                $inventory['horse'],
                $inventory['shoes']),
            "tooltip" => $this->session->hero->getSpeedTitle($inventory),
        ];
        $this->response['data']['heroData']['freePoints'] = $this->session->hero->getAvailablePoints();

        $rate = Config::getInstance()->heroConfig->resourcesMultiplier;
        $this->response['data']['heroData']['res'] = [
            "resourceHero0" => $this->session->hero->hero['production'] * 6 * $rate,
            "resourceHero1" => $this->session->hero->hero['production'] * 20 * $rate,
            "resourceHero2" => $this->session->hero->hero['production'] * 20 * $rate,
            "resourceHero3" => $this->session->hero->hero['production'] * 20 * $rate,
            "resourceHero4" => $this->session->hero->hero['production'] * 20 * $rate
        ];
        $inventory['lastupdate'] = time();
        $db->query("UPDATE inventory SET lastupdate={$inventory['lastupdate']} WHERE uid=" . Session::getInstance()->getPlayerId());
        $this->response['data']['heroBodyHash'] = sha1($inventory['lastupdate']);
        $this->response['data']['heroState'] = [
            "experience" => $nextExperience,
            "culturePoints" => $nextCulturePoints,
        ];
        Session::getInstance()->changeChecker();
        $this->response['data']['checkSum'] = Session::getInstance()->getChecker();
    }

    private function handleChangePlace(array $selectedItem)
    {
        $m = new AuctionModel();
        $session = Session::getInstance();
        $newPlaceId = $this->getSlotSortId();
        if ($newPlaceId>0) {
            $m->changePlace($session->getPlayerId(), $selectedItem['id'], $selectedItem['placeId'], $newPlaceId);
        }
    }

    private function getSlotSortId()
    {
        if (!isset($_REQUEST['drid'])) return false;
        preg_match('/inventory_([0-9]+)/', $_REQUEST['drid'], $matches);
        if (sizeof($matches) == 2) {
            return $matches[1];
        }
        return false;
    }

    private function handleMoveSlotToInventory(&$itemProperties, &$selectedItem, & $inventory)
    {
        $db = DB::getInstance();
        if ($itemProperties['slot'] == 'bag') {
            $otherBagSlots = $db->fetchScalar("SELECT id FROM items WHERE proc=0 AND type=" . $selectedItem['type'] . " AND btype=" . $selectedItem['btype'] . " AND uid=" . Session::getInstance()->getPlayerId() . " AND id!=" . $selectedItem['id']);
            if ($otherBagSlots) {//merge items
                $db->query("UPDATE items SET num=num+{$selectedItem['num']} WHERE id=" . $otherBagSlots);
                $db->query("DELETE FROM items WHERE id={$inventory[$itemProperties['slot']]}");
            } else {
                $placeId = (new AuctionModel())->getNewPlaceId(Session::getInstance()->getPlayerId());
                $db->query("UPDATE items SET proc=0, placeId=$placeId WHERE id={$inventory[$itemProperties['slot']]}");
            }
        } else {
            $this->invalidateCache();
            //remove item
            $this->freeItemFromHero($inventory[$itemProperties['slot']]);
        }

        $inventory[$itemProperties['slot']] = 0;
        $db->query("UPDATE inventory SET {$itemProperties['slot']}=0 WHERE uid=" . Session::getInstance()->getPlayerId());
        return $inventory;
    }

    private function invalidateCache()
    {
        $uid = Session::getInstance()->getPlayerId();
        $memcache = Caching::getInstance();
        $memcache->delete("hero_body_{$uid}_330x422");
        $memcache->delete("hero_body_{$uid}_160x205");
    }

    private function freeItemFromHero($id)
    {
        $this->getSlotSortId();
        $id = (int)$id;
        $db = DB::getInstance();
        $heroItems = new HeroItems();
        $oldItem = $db->query("SELECT * FROM items WHERE id=$id");
        if ($oldItem->num_rows) {
            $oldItem = $oldItem->fetch_assoc();
            $props = $heroItems->getHeroItemProperties($oldItem['btype'], $oldItem['type']);
            if ($oldItem['btype'] == 1 && $oldItem['type'] >= 7 && $oldItem['type'] <= 9) {
                CulturePointsHelper::updateUserCP(Session::getInstance()->getPlayerId());
                $db->query("UPDATE users SET cp_prod=cp_prod-{$props['cp']} WHERE id=" . Session::getInstance()->getPlayerId());
            }
            if (in_array($props['slot'], ['body', 'helmet', 'shoes'])) {
                $update = $props['slot'] == 'body' && in_array($oldItem['type'], [82, 83, 84, 85, 86, 87]);
                $update = $update || $props['slot'] == 'helmet' && in_array($oldItem['type'], [4, 5, 6]);
                $update = $update || $props['slot'] == 'shoes' && in_array($oldItem['type'], [94, 95, 96]);
                if ($update) {
                    HeroHealthHelper::updateUserHeroHealth(Session::getInstance()->getPlayerId());
                    $db->query("UPDATE hero SET itemHealth=itemHealth-{$props['reg']} WHERE uid=" . Session::getInstance()->getPlayerId());
                }
            }
        }
        $placeId = (new AuctionModel())->getNewPlaceId(Session::getInstance()->getPlayerId());
        $db->query("UPDATE items SET proc=0, placeId=$placeId WHERE id=$id");
    }

    private function handleUseItem(&$itemProperties, &$inventory, &$selectedItem, &$amount, &$nextExperience, &$nextCulturePoints)
    {
        $session = Session::getInstance();
        if ($selectedItem['proc'] || $amount <= 0) {
            return;
        }
        $config = Config::getInstance();
        $db = DB::getInstance();
        if ($itemProperties['slot'] != 'bag' && $inventory[$itemProperties['slot']]) {
            $this->freeItemFromHero($inventory[$itemProperties['slot']]);
            $inventory[$itemProperties['slot']] = 0;
            $db->query("UPDATE inventory SET {$itemProperties['slot']}=0 WHERE uid=" . $session->getPlayerId());
        }
        if ($itemProperties['slot'] == 'bag') {
            //process bag items here.
            switch ($selectedItem['btype']) {
                case 7:
                case 8:
                case 9:
                    //cage
                    $this->addToBag($inventory, $itemProperties, $selectedItem, $amount);
                    break;
                case 10:
                    //artifact
                    $points = $this->session->hero->getAvailablePoints();
                    $moreEXP = $this->session->hero->calcMoreExp($inventory['helmet']);
                    $valuePerItem = ceil($itemProperties['exp'] * (1 + ($moreEXP / 100)));
                    $value = $valuePerItem * $amount;
                    $nextExperience += $value;
                    $this->session->hero->hero['exp'] += $value;
                    $db->query("UPDATE hero SET exp=exp+$value WHERE uid=" . $session->getPlayerId());
                    if ($amount == $selectedItem['num']) {
                        $db->query("DELETE FROM items WHERE id={$selectedItem['id']}");
                    } else {
                        $db->query("UPDATE items SET num=num-{$amount} WHERE id=" . $selectedItem['id']);
                    }
                    if ($this->session->hero->getAvailablePoints() > $points) {
                        $this->response['reload'] = TRUE;
                    }
                    break;
                case 11:
                    $quest = Quest::getInstance();
                    if ($quest->getTutorial() == '13-1') {
                        $quest->setTutorial("13-2");
                        $this->response['reload'] = TRUE;
                    }
                    //orient.
                    $add_amount = $amount;
                    $this->response['data']['amount'] = $add_amount;
                    if ($this->session->hero->hero['health'] < 100) {
                        HeroHealthHelper::updateUserHeroHealth($this->session->hero->hero['uid']);
                        $health = floor($this->session->hero->hero['health']);
                        if (($health + $amount) > 100) {
                            $amount = (int)100 - $health;
                            $health = 100;
                        } else {
                            $health += $amount;
                        }
                        if ($amount == $selectedItem['num']) {
                            $db->query("DELETE FROM items WHERE id={$selectedItem['id']}");
                        } else {
                            $selectedItem['num'] -= $amount;
                            $db->query("UPDATE items SET num=num-{$amount} WHERE id=" . $selectedItem['id']);
                        }
                        $health = min($health, 100);
                        $this->session->hero->hero['health'] = $health;
                        $db->query("UPDATE hero SET health=$health WHERE uid=" . $session->getPlayerId());
                        $add_amount -= $amount;
                    }
                    if ($add_amount) {
                        $this->addToBag($inventory, $itemProperties, $selectedItem, $add_amount);
                    }
                    break;
                case 12:
                    if ($this->session->hero->getHeroStatus() === SessionHero::STATUS_REVIVING ||
                        $this->session->hero->getHeroStatus() === SessionHero::STATUS_DEAD) {
                        $interval = 86400 / $config->heroConfig->waterBucketsPerDay;
                        if (time() < ($inventory['lastWaterBucketUse'] + $interval)) {
                            $this->response['error'] = TRUE;
                            $this->response['errorMsg'] = sprintf(T("HeroInventory", "waterBucketsUsed"),
                                TimezoneHelper::autoDate($inventory['lastWaterBucketUse'] + $interval, true));
                        } else {
                            $db->query("DELETE FROM items WHERE id={$selectedItem['id']}");
                            $db->query("UPDATE inventory SET lastWaterBucketUse=" . time() . " WHERE uid=" . $session->getPlayerId());;
                            $this->session->hero->trainHero(TRUE);
                            $this->response['reload'] = TRUE;
                        }
                    }
                    break;
                case 13:
                    $this->response['reload'] = TRUE;
                    $db->query("UPDATE hero SET power=0, offBonus=0, defBonus=0, production=0 WHERE uid=" . $session->getPlayerId());
                    ResourcesHelper::updateVillageResources($this->session->hero->hero['kid'], FALSE);
                    $db->query("DELETE FROM items WHERE id={$selectedItem['id']}");
                    $this->session->hero->hero['power'] = $this->session->hero->hero['offBonus'] = $this->session->hero->hero['defBonus'] = $this->session->hero->hero['production'] = 0;
                    $this->response['reload'] = TRUE;
                    break;
                case 14:
                    LoyaltyHelper::updateVillageLoyalty($this->session->hero->hero['kid']);
                    $loyalty = $db->fetchScalar("SELECT loyalty FROM vdata WHERE kid=" . $this->session->hero->hero['kid']);
                    if ($loyalty < 125) {
                        if (($loyalty + $amount) > 125) {
                            $amount = (int)125 - $loyalty;
                            if (!$amount) {
                                return;
                            }
                            $this->response['data']['amountUsed'] = $amount;
                        }
                        $this->response['reload'] = TRUE;
                        $db->query("UPDATE vdata SET loyalty=loyalty+$amount WHERE kid=" . $this->session->hero->hero['kid']);
                        if ($amount == $selectedItem['num']) {
                            $db->query("DELETE FROM items WHERE id={$selectedItem['id']}");
                        } else {
                            $selectedItem['num'] -= $amount;
                            $db->query("UPDATE items SET num=num-{$amount} WHERE id=" . $selectedItem['id']);
                        }
                    }
                    break;
                case 15://artwork
                    $this->response['reload'] = TRUE;
                    $cur_cp = $db->fetchScalar("SELECT SUM(cp) FROM vdata WHERE isWW=0 AND owner=" . $session->getPlayerId());

                    $cpPerArtwork = min(2000, $cur_cp);
                    if (getGameSpeed() == 2) {
                        $cpPerArtwork = round($cpPerArtwork * 2 / 3);
                    } else if (getGameSpeed() > 2) {
                        $cpPerArtwork = round($cpPerArtwork / 2);
                    }
                    $value = $amount * $cpPerArtwork;

                    $nextCulturePoints += $value;
                    if ($amount == $selectedItem['num']) {
                        $db->query("DELETE FROM items WHERE id={$selectedItem['id']}");
                    } else {
                        $selectedItem['num'] -= $amount;
                        $db->query("UPDATE items SET num=num-{$amount} WHERE id=" . $selectedItem['id']);
                    }
                    $db->query("UPDATE users SET cp=cp+$value WHERE id=" . $session->getPlayerId());
                    break;
            }
        }
        if ($itemProperties['slot'] != 'bag') {
            if ($selectedItem['btype'] == 1 && $selectedItem['type'] >= 7 && $selectedItem['type'] <= 9) {
                CulturePointsHelper::updateUserCP($session->getPlayerId());
            }
            if (in_array($itemProperties['slot'], ['body', 'helmet', 'shoes'])) {
                $update = $itemProperties['slot'] == 'body' && in_array($selectedItem['type'], [82, 83, 84, 85, 86, 87]);
                $update = $update || $itemProperties['slot'] == 'helmet' && in_array($selectedItem['type'], [4, 5, 6]);
                $update = $update || $itemProperties['slot'] == 'shoes' && in_array($selectedItem['type'], [94, 95, 96]);
                if ($update) {
                    HeroHealthHelper::updateUserHeroHealth($session->getPlayerId());
                    $db->query("UPDATE hero SET itemHealth=itemHealth+{$itemProperties['reg']} WHERE uid=" . $session->getPlayerId());
                }
            }
            $inventory[$itemProperties['slot']] = $selectedItem['id'];
            $db->query("UPDATE items SET proc=1, placeId=0 WHERE id=" . $selectedItem['id']);
            $db->query("UPDATE inventory SET {$itemProperties['slot']}={$inventory[$itemProperties['slot']]} WHERE uid=" . $session->getPlayerId());
            if ($selectedItem['btype'] == 1 && $selectedItem['type'] >= 7 && $selectedItem['type'] <= 9) {
                $db->query("UPDATE users SET cp_prod=cp_prod+{$itemProperties['cp']} WHERE id=" . $session->getPlayerId());
            }
            $this->invalidateCache();
        }
    }

    private function addToBag(&$inventory, $itemProperties, $selectedItem, $amount)
    {
        $this->getSlotSortId();
        //freeing slot.
        $db = DB::getInstance();
        if ($inventory[$itemProperties['slot']]) {
            $item = $db->query("SELECT * FROM items WHERE uid=" . Session::getInstance()->getPlayerId() . " AND id=" . $inventory[$itemProperties['slot']])->fetch_assoc();
            if ($item['btype'] != $selectedItem['btype'] || $item['type'] != $selectedItem['type']) {
                $otherBagSlots = $db->fetchScalar("SELECT id FROM items WHERE proc=0  AND type=" . $item['type'] . " AND btype=" . $item['btype'] . " AND uid=" . Session::getInstance()->getPlayerId() . " AND id!=" . $item['id']);
                if ($otherBagSlots) {//merge items
                    $db->query("UPDATE items SET num=num+{$item['num']} WHERE id=" . $otherBagSlots);
                    $db->query("DELETE FROM items WHERE id={$item['id']}");
                } else {
                    $placeId = (new AuctionModel())->getNewPlaceId(Session::getInstance()->getPlayerId());
                    $db->query("UPDATE items SET proc=0, placeId=$placeId WHERE id={$item['id']}");
                }
                $inventory[$itemProperties['slot']] = 0;
            }
        }
        $otherBagSlots = $db->fetchScalar("SELECT id FROM items WHERE proc=1 AND type=" . $selectedItem['type'] . " AND btype=" . $selectedItem['btype'] . " AND uid=" . Session::getInstance()->getPlayerId() . " AND id!=" . $selectedItem['id']);
        if ($otherBagSlots) {//merge items
            $db->query("UPDATE items SET num=num+{$selectedItem['num']} WHERE id=" . $otherBagSlots);
            if ($amount - $selectedItem['num'] <= 0) {
                $db->query("DELETE FROM items WHERE id={$selectedItem['id']}");
            }
            $inventory['bag'] = $otherBagSlots;
        } else {
            if ($amount == $selectedItem['num']) {
                $db->query("UPDATE items SET proc=1, placeId=0 WHERE id={$selectedItem['id']}");
                $inventory['bag'] = $selectedItem['id'];
            } else {
                $db->query("UPDATE items SET num=num-$amount WHERE id={$selectedItem['id']}");
                $db->query("INSERT INTO items (uid, btype, type, num, proc, placeId) VALUES (" . Session::getInstance()->getPlayerId() . "," . $selectedItem['btype'] . "," . $selectedItem['type'] . ", $amount, 1, 0)");
                $inventory['bag'] = $db->lastInsertId();
            }
        }
        $db->query("UPDATE inventory SET bag={$inventory['bag']} WHERE uid=" . Session::getInstance()->getPlayerId());
    }
} 