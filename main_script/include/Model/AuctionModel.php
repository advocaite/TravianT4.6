<?php

namespace Model;

use function array_diff;
use Controller\Ajax\heroAuction;
use Core\Config;
use Core\Database\DB;
use Game\Formulas;
use Game\Hero\HeroItems;
use function get_random_string;
use function getGameSpeed;
use function uniqid;

class AuctionModel
{
    private static $given_user_ids = [];

    public function getMyBookings($uid)
    {
        $db = DB::getInstance();
        return $db->query("SELECT * FROM accounting WHERE uid=$uid AND time >= " . strtotime("-7 days 00:00") . " ORDER BY id");
    }

    function doAuction()
    {
        $m = new AutomationModel();
        $db = DB::getInstance();
        $find = $db->query("SELECT * FROM auction WHERE finish=0 AND time <= " . (time()) . " ORDER BY id ASC LIMIT 100");
        $dailyQuest = new DailyQuestModel();
        $spread_randomly = Config::getInstance()->auction->fakeAuction->SpreadOutRandomlyBetweenPlayers;
        $spread_timeout = Config::getInstance()->auction->fakeAuction->SpreadOutTimeout;
        while ($row = $find->fetch_assoc()) {
            $db->query("UPDATE auction SET finish=1 WHERE id={$row['id']}");
            $silver = $row['silver'];
            if ($spread_randomly) {
                $uid = $this->getRandomUID($spread_timeout);
                if ($uid !== FALSE) {
                    $dailyQuest->setQuestAsCompleted($row['activeUid'], 4);
                    $this->addItemToUser($uid, $row['btype'], $row['type'], $row['num']);
                }
            } else if ($row['activeId'] <> 0) {
                $cur_silver = $m->getUser($row['activeUid'], 'silver');
                if ($cur_silver !== false) {
                    if ($this->updateUserSilver($row['activeUid'], $silver)) {
                        $dailyQuest->setQuestAsCompleted($row['activeUid'], 4);
                        $this->addItemToUser($row['activeUid'], $row['btype'], $row['type'], $row['num']);
                        $cur_silver = $cur_silver['silver'];
                        $this->addBooking($row['activeUid'],
                            [
                                2,
                                $row['btype'],
                                $row['type'],
                                $row['num'],
                            ],
                            -$silver,
                            -$silver + $cur_silver,
                            $row['time']);
                    }
                }
            }
            if ($row['uid'] <> 0) {
                if ($row['activeId'] == 0 && !Config::getProperty("auction", "buyInactiveAuctionBySystem")) {
                    $this->addItemToUser($row['uid'], $row['btype'], $row['type'], $row['num']);
                    $db->query("DELETE FROM auction WHERE id={$row['id']} AND finish=1");
                } else {
                    $cur_silver = $m->getUser($row['uid'], 'silver');
                    if ($cur_silver !== false) {
                        if ($this->updateUserSilver($row['uid'], $silver, 1)) {
                            $cur_silver = $cur_silver['silver'];
                            $this->addBooking($row['uid'],
                                [
                                    1,
                                    $row['btype'],
                                    $row['type'],
                                    $row['num'],
                                ],
                                +$silver,
                                +$silver + $cur_silver,
                                $row['time']);
                        }
                    }
                }
            }
        }
    }

    public function getRandomUID($spread_timeout, $isLoop = false)
    {
        $time = time() - $spread_timeout;
        $db = DB::getInstance();
        if (sizeof(self::$given_user_ids)) {
            $uid = $db->fetchScalar("SELECT id FROM users WHERE id>2 AND access=1 AND last_login_time >= $time AND id NOT IN(" . implode(",",
                    self::$given_user_ids) . ") ORDER BY RAND() LIMIT 1");
        } else {
            $uid = $db->fetchScalar("SELECT id FROM users WHERE id>2 AND access=1 AND last_login_time >= $time ORDER BY RAND() LIMIT 1");
        }
        if ($uid) {
            self::$given_user_ids[] = $uid;
            return $uid;
        } else if (!$isLoop) {
            self::$given_user_ids = [];
            return $this->getRandomUID($spread_timeout, true);
        }
        return FALSE;
    }

    public function addItemToUser($uid, $btype, $type, $num)
    {
        $stackAble = FALSE;
        if ($btype >= 7 && $btype != 12 && $btype != 13) {
            $stackAble = TRUE;
        }
        $db = DB::getInstance();
        if ($stackAble) {
            $itemId = $db->fetchScalar("SELECT id FROM items WHERE uid=$uid AND btype=$btype AND type=$type AND proc=0");
            if ($itemId) {
                $db->query("UPDATE items SET num=num+$num WHERE id=$itemId");
            } else {
                $placeId = $this->getNewPlaceId($uid);
                $db->query("INSERT INTO items(uid, btype, type, num, proc, placeId) VALUES ($uid, $btype, $type, $num, 0, $placeId)");
            }
        } else {
            $placeId = $this->getNewPlaceId($uid);
            $db->query("INSERT INTO items(uid, btype, type, num, proc, placeId) VALUES ($uid, $btype, $type, $num, 0, $placeId)");
//            if($num > 1){
//                $this->addItemToUser($uid, $btype, $type, $num);
//            }
        }
    }

    public function removeItemFromUser($uid, $btype, $type, $num)
    {
        $db = DB::getInstance();
        $stmt = $db->query("SELECT id, num FROM items WHERE uid=$uid AND btype=$btype AND type=$type AND proc=0");
        while($row = $stmt->fetch_assoc()){

            if($num <= 0) break;

            if ($row['num'] <= $num || $num > $row['num']) {
                $db->query("DELETE FROM items WHERE id={$row['id']}");
            } else {
                $db->query("UPDATE items SET num=num-$num WHERE id={$row['id']}");
            }
            $num -= $row['num'];
        }
        return true;
    }

    public function getNewPlaceId($uid)

    {
        $uid = (int)$uid;
        $db = DB::getInstance();
        $max = $this->getInventorySize($uid);
        $available_range = range(1, $max);
        $occupied_places = $db->fetchScalar("SELECT GROUP_CONCAT(placeId) FROM (SELECT placeId FROM `items` WHERE uid=$uid) as x");
        $occupied_places = explode(",", rtrim($occupied_places, ','));
        $available_range = array_diff($available_range, $occupied_places);
        sort($available_range, SORT_ASC);
        $placeId = $available_range[0];
        return $placeId;
    }

    public function getInventorySize($uid, $includeOnHeroItems = true)
    {
        //$numItems = $this->getItemsNum($uid, $includeOnHeroItems);
        $db = DB::getInstance();
        $numItems = $db->query("SELECT COUNT(id) FROM items WHERE uid=$uid")->fetch_row()[0];
        if ($numItems <= 10) {
            $numItems = 12;
        } else {
            $numItems = 12 + ($numItems - 9);
        }
        return $numItems;
    }

    public function getMaxPlaceId($uid)
    {
        $db = DB::getInstance();
        return $db->fetchScalar("SELECT MAX(placeId) FROM items WHERE uid=$uid");
    }

    public function getItemsNum($uid, $includeOnHeroItems = true)
    {
        $db = DB::getInstance();
        if ($includeOnHeroItems) {
            return $db->fetchScalar("SELECT COUNT(id) FROM items WHERE uid=$uid");
        }
        return $db->fetchScalar("SELECT COUNT(id) FROM items WHERE proc=0 AND uid=$uid");
    }

    private function updateUserSilver($uid, $silver, $mode = 0)
    {
        $db = DB::getInstance();
        return $db->query("UPDATE users SET silver=silver" . ($mode == 0 ? '-' : '+') . "$silver WHERE id=$uid");
    }

    public function addBooking($uid, $cause, $reserve, $balance, $time)
    {
        $db = DB::getInstance();
        if (is_array($cause)) {
            $cause = implode(",", $cause);
        }
        $db->query("INSERT INTO accounting (uid, cause, reserve, balance, time) VALUES ($uid, '$cause', $reserve, $balance, $time)");
    }

    public function changePlace($uid, $itemId, $placeId, $newPlaceId)
    {
        $db = DB::getInstance();
        $uid = (int)$uid;
        $itemId = (int)$itemId;
        $newPlaceId = (int)$newPlaceId;
        $inventorySize = max($this->getMaxPlaceId($uid), 12);
        if ($newPlaceId > $inventorySize) {
            return;
        }
        $db->query("UPDATE items SET placeId=$placeId WHERE uid=$uid AND placeId=$newPlaceId");
        $db->query("UPDATE items SET placeId=$newPlaceId WHERE uid=$uid AND id=$itemId");
    }

    public function getPlayerOutBidCount($uid)
    {
        $db = DB::getInstance();
        return $db->fetchScalar("SELECT COUNT(bids.id) FROM bids, auction WHERE auction.id=bids.auctionId AND auction.finish=0 AND bids.outbid=1 AND bids.uid=$uid");
    }

    public function getPlayerMaximumBidCount($uid)
    {
        $db = DB::getInstance();
        return $db->fetchScalar("SELECT COUNT(bids.id) FROM bids, auction WHERE auction.id=bids.auctionId AND auction.finish=0 AND bids.outbid=0 AND bids.uid=$uid");
    }

    public function getAvailableItemsToSell($uid)
    {
        $db = DB::getInstance();

        return $db->query("SELECT * FROM items WHERE uid=$uid AND proc=0");
    }

    public function getMyRunningAuctions($uid)
    {
        $db = DB::getInstance();

        return $db->query("SELECT * FROM auction WHERE uid=$uid AND finish=0 ORDER BY id ASC");
    }

    public function getMyRunningAuctionsCount($uid)
    {
        $db = DB::getInstance();

        return $db->fetchScalar("SELECT COUNT(id) FROM auction WHERE uid=$uid AND finish=0");
    }

    public function getMyFinishedAuctionsCount($uid)
    {
        $db = DB::getInstance();

        return $db->fetchScalar("SELECT COUNT(id) FROM auction WHERE uid=$uid AND finish=1");
    }

    public function getMyFinishedAuctions($uid, $page, $pageSize)
    {
        $db = DB::getInstance();

        return $db->query("SELECT * FROM auction WHERE uid=$uid AND finish=1 ORDER BY id DESC LIMIT " . (($page - 1) * $pageSize) . ", " . $pageSize);
    }

    public function hasBidInAuction($id, $uid)
    {
        $db = DB::getInstance();

        return $db->fetchScalar("SELECT COUNT(id) FROM bids WHERE auctionId=$id AND outbid=0 AND uid=$uid") > 0;
    }

    public function getMyRunningBids($uid, $filter)
    {
        $db = DB::getInstance();
        if ($filter > 0) {
            $filter = ' AND btype=' . $filter . " ";
        } else {
            $filter = '';
        }

        return $db->query("SELECT bids.*, auction.btype, auction.type, auction.activeUid, auction.maxSilver, auction.num, auction.secure_id, auction.activeId, auction.silver, auction.bids, auction.time FROM bids, auction WHERE bids.uid=$uid {$filter} AND bids.auctionId=auction.id AND auction.finish=0 ORDER BY auction.time ASC, bids.id DESC");
    }

    public function deleteBid($uid, $id)
    {
        $db = DB::getInstance();
        $db->query("UPDATE bids SET del=1 WHERE id=$id AND uid=$uid");
    }

    public function getMyFinishedBids($uid, $filter, $page, $pageSize)
    {
        $db = DB::getInstance();
        if ($filter > 0) {
            $filter = ' AND btype=' . $filter . " ";
        } else {
            $filter = '';
        }

        return $db->query("SELECT bids.*, auction.btype, auction.type, auction.activeId, auction.activeUid, auction.secure_id, auction.num, auction.silver, auction.maxSilver, auction.bids, auction.time FROM bids, auction WHERE bids.uid=$uid {$filter} AND auction.id=bids.auctionId AND auction.finish=1 AND del=0 ORDER BY bids.id DESC LIMIT  " . (($page - 1) * $pageSize) . ", " . $pageSize . "");
    }

    public function getMyFinishedBidsCount($uid, $filter)
    {
        $db = DB::getInstance();
        if ($filter > 0) {
            $filter = ' AND btype=' . $filter . " ";
        } else {
            $filter = '';
        }

        return $db->fetchScalar("SELECT COUNT(bids.id) FROM bids, auction WHERE bids.uid=$uid {$filter} AND auction.activeId=bids.id AND auction.finish=1 AND del=0");
    }

    public function getHeroGender($uid)
    {
        $db = DB::getInstance();

        return $db->fetchScalar("SELECT gender FROM face WHERE uid=$uid");
    }

    public function getInBidSilver($uid)
    {
        $db = DB::getInstance();

        return $db->fetchScalar("SELECT SUM(maxSilver) FROM auction WHERE finish=0 AND activeUid=$uid");
    }

    public function getBidsCount($auctionId)
    {
        $db = DB::getInstance();

        return $db->fetchScalar("SELECT COUNT(id) FROM bids WHERE auctionId=$auctionId");
    }

    public function cancelAuction($id)
    {
        $db = DB::getInstance();
        $query = $db->query("UPDATE auction SET finish=1, cancel=1 WHERE id=$id");
        return $query && $db->affectedRows();
    }

    public function getAuction($id)
    {
        $db = DB::getInstance();
        $find = $db->query("SELECT * FROM auction WHERE id=$id");
        if (!$find->num_rows) {
            return FALSE;
        }

        return $find->fetch_assoc();
    }

    public function decreaseCageOrientItem($uid, $itemId, $total_num, $num)
    {
        $this->getItemFromUser($itemId, $total_num, $num);
        if ($total_num == $num) {
            $db = DB::getInstance();
            $db->query("UPDATE inventory SET bag=0 WHERE uid=$uid");
        }
    }

    public function getItemFromUser($itemId, $total_num, $num)
    {
        $db = DB::getInstance();
        if ($total_num == $num) {
            $query = $db->query("DELETE FROM items WHERE id=$itemId AND num >= $num");
            return $query && $db->affectedRows();
        }
        $query = $db->query("UPDATE items SET num=num-$num WHERE id=$itemId AND num >= $num");
        return $query && $db->affectedRows();
    }

    public function getAuctionBySecureId($secure_id)
    {
        $db = DB::getInstance();
        $find = $db->query("SELECT * FROM auction WHERE secure_id='$secure_id'");
        if (!$find->num_rows) {
            return FALSE;
        }

        return $find->fetch_assoc();
    }

    public function getTotalBuyAuction($uid, $filter)
    {
        //TODO: ip tables!
        $db = DB::getInstance();
        if ($filter == 0) {
            return $db->fetchScalar("SELECT COUNT(id) FROM auction WHERE finish=0 AND uid!=$uid");
        }
        return $db->fetchScalar("SELECT COUNT(id) FROM auction WHERE finish=0 AND uid!=$uid AND btype=$filter");
    }

    public function getBuyAuction($uid, $page, $pageSize, $filter)
    {
        //TODO: ip tables!
        $db = DB::getInstance();
        if ($filter == 0) {
            return $db->query("SELECT * FROM auction WHERE finish=0 AND uid!=$uid ORDER BY time ASC LIMIT " . (($page - 1) * $pageSize) . ", " . $pageSize);
        }
        return $db->query("SELECT * FROM auction WHERE finish=0 AND uid!=$uid AND btype=$filter ORDER BY time LIMIT " . (($page - 1) * $pageSize) . ", " . $pageSize);
    }

    public function modifyAuction($id, $activeId, $activeUid, $silver, $maxSilver, $time, $add = TRUE)
    {
        $db = DB::getInstance();
        $qurey = $db->query("UPDATE auction SET activeId=$activeId, activeUid=$activeUid, silver = $silver, maxSilver=$maxSilver" . ($add ? ', bids = bids + 1' : '') . ", time = $time where id = $id");
        return $qurey && $db->affectedRows();
    }

    public function addBid($uid, $auctionId)
    {
        $db = DB::getInstance();
        $db->query("UPDATE bids SET outbid=0 WHERE uid=$uid AND auctionId=$auctionId");
        if (!$db->affectedRows()) {
            $db->query("INSERT INTO bids (uid, auctionId) VALUES ($uid, $auctionId)");
            return $db->lastInsertId();
        }
        return $db->fetchScalar("SELECT id FROM bids WHERE uid=$uid AND auctionId=$auctionId AND outbid=0");
    }

    public function setAsOutBid($activeId)
    {
        $db = DB::getInstance();
        $db->query("UPDATE bids SET outbid=1 WHERE id=$activeId");
    }

    public function fakeAuction()
    {
        $config = Config::getInstance();
        $auctionConfig = $config->auction;
        if (!$auctionConfig->fakeAuction->enabled) {
            return;
        }
        if (getGameElapsedSeconds() < 0) return;
        if (getCustom("delayAuctions") && getGameElapsedSeconds() < ($config->game->protection_time * 2 / 3)) return;
        $db = DB::getInstance();
        $lastFakeAuction = $db->fetchScalar("SELECT lastFakeAuction FROM config");
        if ($lastFakeAuction != 0 && (time() - $lastFakeAuction) < $auctionConfig->fakeAuction->interval) {
            return;
        }
        $db->query("UPDATE config SET lastFakeAuction=" . time());
        $m = new AuctionModel();
        $items = new HeroItems();
        $rate = $config->auction->auctionTime;
        $auctionTime = time() + $rate;

        $highSpeedTrainingHelmets = getGameSpeed() > 20;

        $tierNum = Formulas::getCurrentHeroItemsTier();
        for ($i = 1; $i <= 35; ++$i) {
            $rand = $items->getRandomItem();
            if ($rand['btype'] == 15 && Formulas::getArtworkReleaseTime() > time()) {
                continue;
            }
            if ($rand['btype'] == 15 && getGameSpeed() <= 100) continue;
            $amounts = heroAuction::getPackagesFakeAuctionForItemTypeId($rand['type']);
            if ($highSpeedTrainingHelmets && $rand['btype'] == 1 && ($rand['type'] >= 10 && $rand['type'] <= 15)) continue;
            if ($rand['btype'] <= 6) {
                //this has tire
                $tier = ($rand['type'] % 3) == 0 ? 3 : ($rand['type'] % 3 == 1 ? 1 : 2);
                if (!($tierNum == $tier)) {
                    continue;
                }
            }
            $size = sizeof($amounts);
            $num = 1;
            if ($size > 1) {
                $num = $amounts[mt_rand(0, max($size - 2, 1))];
            }
            $m->addAuction(true, 0, $rand['btype'], $rand['type'], $num, $auctionTime);
        }
        if ($highSpeedTrainingHelmets) {
            for ($i = 10; $i <= 15; ++$i) {
                $m->addAuction(true, 0, 1, $i, 1, $auctionTime, 2000);
            }
        }
    }

    public function addAuction($isSystem, $uid, $btype, $type, $num, $time, $silver = null)
    {
        $db = DB::getInstance();
        $stackAble = FALSE;
        if ($btype >= 7 && $btype != 12 && $btype != 13) {
            $stackAble = TRUE;
        }
        if (!$stackAble) {
            $num = 1;
        }
        if ($silver == null) {
            if (getCustom("decreaseItemsPriceInAuction")) {
                $silver = $stackAble ? 0.05 : 100;
                if ($btype == 14) {
                    $silver = 1;
                } else if ($btype == 15) {
                    $silver = 10;
                } else if ($btype == 11) {
                    $silver = 1;
                } else if ($btype == 10) {
                    $silver = 1;
                } else if ($btype == 8) {
                    $silver = 0.05;
                }
            } else {
                $silver = ($stackAble && $btype != 15) ? 1 : 100;
                if ($btype == 6 || $btype == 13) {
                    $silver = 1;
                }
            }
            if ($silver < 1 && !$isSystem && getCustom("makeAuctionsCheaperInSell")) {
                $silver /= 10;
            }
            $silver = ceil($num * $silver);
            if ($silver == 0) {
                $silver = $num;
            }
        }
        $secure_id = sha1(microtime());
        $db->query("INSERT INTO auction (uid, btype, type, num, silver, maxSilver, secure_id, time) VALUES ($uid, $btype, $type, $num, $silver, 0, '$secure_id', $time)");
    }

    public function getRandomAmountPackage($typeId)
    {
        $amounts = heroAuction::getPackagesFakeAuctionForItemTypeId($typeId);
        shuffle($amounts);
        return $amounts[mt_rand(0, sizeof($amounts) - 1)];
    }
}