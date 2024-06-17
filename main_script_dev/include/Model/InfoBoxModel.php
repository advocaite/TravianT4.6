<?php

namespace Model;

use Core\Caching\Caching;
use Core\Caching\GlobalCaching;
use Core\Database\DB;
use Core\Database\GlobalDB;
use Exception;

/**
 * types =>
 * 1 => plus
 * 2 => boost 1
 * 3 => boost 2
 * 4 => boost 3
 * 5 => boost 4
 * 6 => Protection
 * 7 => Medals interval
 * 8 => Artifact
 * 9 => WW Plans Release
 * 10 => Game Auto finish Time.
 * 11 => Deleting...
 * 12 => Report Overflow
 * 13 => Vacation
 * 14 => Banned
 * 15 => Catapult
 * 16 => Email not verified
 * 17 => Truce Day
 */
class InfoBoxModel
{
    public function addInfo($uid, $forAll, $type, $params, $showFrom, $showTo)
    {
        $db = DB::getInstance();
        $params = $db->real_escape_string($params);
        $forAll = (int)$forAll;
        $db->query("INSERT INTO infobox (uid, forAll, type, params, showFrom, showTo) VALUES ($uid, $forAll, $type, '$params', $showFrom, $showTo)");
    }

    public function deleteInfoByTypeInServer($type)
    {
        $db = DB::getInstance();
        $db->query("DELETE FROM infobox WHERE type=$type");
    }

    public function deletePublicInfoBoxById($infoId)
    {
        $db = DB::getInstance();
        $db->query("DELETE FROM infobox WHERE forAll=1 AND id=$infoId AND (type < 7 OR type > 10)");

        return $db->affectedRows();
    }

    public function deleteInfoByType($uid, $type)
    {
        $db = DB::getInstance();
        $db->query("DELETE FROM infobox WHERE uid=$uid AND type=$type");
    }

    public function hasInfoByType($uid, $type)
    {
        $db = DB::getInstance();

        return $db->fetchScalar("SELECT COUNT(id) FROM infobox WHERE uid=$uid AND type=$type") > 0;
    }

    public function getMyInfoBox($uid)
    {
        $cache = Caching::getInstance();
        if ($_cache = $cache->get("InfoBox:Private:$uid")) {
            return $_cache;
        }
        $db = DB::getInstance();
        $time = time();
        $ignore_ids = $this->getDeletedIds($uid);
        $data = $db->query("SELECT * FROM infobox WHERE (uid=$uid OR forAll=1) AND del=0 AND showFrom <= $time AND (showTo >= $time OR showTo=0) " . (isset($ignore_ids[0]) ? "AND id NOT IN($ignore_ids)" : '') . " ORDER BY type=14 DESC, type=16 DESC, showTo ASC, showFrom DESC")->fetch_all(MYSQLI_ASSOC);
        $cache->add("InfoBox:Private:$uid", $data, 60);
        return $data;
    }

    private function getDeletedIds($uid, $reCache = FALSE)
    {
        $memcache = Caching::getInstance();
        if (!$reCache && $_cache = $memcache->get("infoBox:deleted:$uid")) {
            return $_cache;
        }
        $db = DB::getInstance();
        $result = $db->query("SELECT infoId FROM infobox_delete WHERE uid=$uid");
        $return = '';
        while ($row = $result->fetch_assoc()) {
            if (!empty($return)) {
                $return .= ',';
            }
            $return .= $row['infoId'];
        }
        $memcache->set("infoBox:deleted:$uid", $return, 86400);
        return $return;
    }

    public function getUnreadInfoBoxCount($uid)
    {
        $db = DB::getInstance();
        $time = time();
        $ignore_ids = $this->getDeletedIds($uid);
        if (empty($ignore_ids)) {
            $ignore_ids = $this->getReadIds($uid);
        } else {
            $ignore_ids .= ',' . $this->getReadIds($uid);
        }
        $total = $db->fetchScalar("SELECT COUNT(id) FROM infobox WHERE uid=$uid AND readStatus=0 AND del=0 AND showFrom <= $time AND (showTo >= $time OR showTo=0)" . (isset($ignore_id[0]) ? ' AND id NOT IN(' . $ignore_ids . ')' : ''));

        return $total;
    }

    private function getReadIds($uid, $reCache = FALSE)
    {
        $memcache = Caching::getInstance();
        if (!$reCache && $_cache = $memcache->get("infoBox:read:$uid")) {
            return $_cache;
        }
        $db = DB::getInstance();
        $return = trim($db->fetchScalar("SELECT GROUP_CONCAT(infoId) FROM infobox_read WHERE uid=$uid"));
        $memcache->set("infoBox:read:$uid", $return, 86400);
        return $return;
    }

    public function setInfoBoxItemAsDeleted($uid, $id)
    {
        $db = DB::getInstance();
        $infoBox = $db->query("SELECT * FROM infobox WHERE id=$id");
        if (!$infoBox->num_rows) {
            return FALSE;
        }
        $infoBox = $infoBox->fetch_assoc();
        if ($infoBox['forAll']) {
            $this->setInfoboxItemsRead($uid, [$id]);
            if (!$this->haveIDeletedPublicOne($uid, $id)) {
                $db->query("INSERT INTO infobox_delete (infoId, uid) VALUES ($id, $uid)");
                $this->getDeletedIds($uid, TRUE);
            }
        } else {
            if ($infoBox['uid'] != $uid) {
                return FALSE;
            }
            $db->query("UPDATE infobox SET del=1, readStatus=1 WHERE id=$id AND type not IN(6, 11, 13, 16) AND forAll=0");
        }

        return $db->affectedRows();
    }

    public function setInfoboxItemsRead($uid, $ids)
    {
        $db = DB::getInstance();
        $totalModifyAll = 0;
        foreach ($ids as $id) {
            $find = $db->query("SELECT uid, forAll FROM infobox WHERE id=$id");
            if ($find->num_rows) {
                $row = $find->fetch_assoc();
                if ($row['forAll'] && !$this->haveIReadPublicOne($uid, $id)) {
                    ++$totalModifyAll;
                    $db->query("INSERT INTO infobox_read (infoId, uid) VALUES ($id, $uid)");
                } else if (!$row['forAll'] && $row['uid'] == $uid) {
                    $db->query("UPDATE infobox SET readStatus=1 WHERE uid=$uid AND id=$id");
                }
            }
        }
        if ($totalModifyAll) {
            $this->getReadIds($uid, TRUE);
            self::invalidateUserInfoBoxCache($uid);
        }
    }

    public function haveIReadPublicOne($uid, $activeId)
    {
        $db = DB::getInstance();

        return $db->fetchScalar("SELECT COUNT(id) FROM infobox_read WHERE infoId=$activeId AND uid=$uid") > 0;
    }

    public static function invalidateUserInfoBoxCache($uid)
    {
        Caching::getInstance()->delete("InfoBox:Private:$uid");
    }

    public static function invalidatePublicInfoBox()
    {
        $cache = GlobalCaching::getInstance();
        $cache->delete("paymentOffer");
        $cache->delete("InfoBox:Public");
    }

    public static function invalidateAllUsersPrivateInfoBox()
    {
        try{
            $cache = Caching::getInstance();
            $cache->deleteByPattern("InfoBox:Private:*");
        } catch (Exception $e){

        }
    }

    public function getPublicInfoBox()
    {
        $cache = GlobalCaching::getInstance();
        if ($_cache = $cache->get("InfoBox:Public")) {
            return $_cache;
        }
        $globalDB = GlobalDB::getInstance();
        $data = $globalDB->query("SELECT * FROM infobox WHERE showTo>" . time() . " ORDER BY showTo DESC")->fetch_all(MYSQLI_ASSOC);
        $cache->add("InfoBox:Public", $data, 1800);
        return $data;
    }

    public function haveIDeletedPublicOne($uid, $activeId)
    {
        $db = DB::getInstance();

        return $db->fetchScalar("SELECT COUNT(id) FROM infobox_delete WHERE infoId=$activeId AND uid=$uid") > 0;
    }
} 