<?php

namespace Core\Helper;

use Core\Database\DB;
use Core\Database\GlobalDB;

class IPTracker
{
    public static function addCurrentIP($uid)
    {
        $db = DB::getInstance();
        $ip = WebService::ipAddress();
        $ip = ip2long($ip);
        if (empty($ip)) return;
        $id = $db->fetchScalar("SELECT id FROM log_ip WHERE uid=$uid AND ip='$ip'");
        if ($id) {
            $db->query("UPDATE log_ip SET time=" . time() . " WHERE id=$id");
        } else {
            $db->query("INSERT INTO `log_ip`(`uid`, `ip`, `time`) VALUES ($uid, '$ip', '" . time() . "')");
        }
    }

    public static function blockIP($ip, $reason, $till = 0)
    {
        $db = GlobalDB::getInstance();
        $exists = $db->query("SELECT id FROM banIP WHERE ip=$ip");
        $reason = $db->real_escape_string($reason);
        if ($exists->num_rows) {
            $db->query("UPDATE banIP SET time=" . time() . ", reason='$reason', blockTill=" . ($till == 0 ? 0 : time() + $till));
        } else {
            $db->query("INSERT INTO `banIP`(`ip`, `reason`, `time`, `blockTill`) VALUES ($ip, '$reason', " . time() . ", " . ($till == 0 ? 0 : time() + $till) . ")");
        }
    }

    public static function unblockIP($ip)
    {
        $db = GlobalDB::getInstance();
        $db->query("DELETE FROM banIP WHERE ip=$ip");
    }

    //checks if the ip is used within 14 days.
    public static function checkForSameIP($uid1, $uid2)
    {
        $db = DB::getInstance();
        $result = $db->query("SELECT ip FROM log_ip WHERE uid=$uid1 ORDER BY id DESC");
        $ips_uid_1 = [];
        while (($row = $result->fetch_assoc())) {
            $ips_uid_1[] = $row['ip'];
        }
        $result = $db->query("SELECT ip FROM log_ip WHERE uid=$uid2 ORDER BY id DESC");
        $ips_uid_2 = [];
        while (($row = $result->fetch_assoc())) {
            $ips_uid_2[] = $row['ip'];
        }
        foreach ($ips_uid_1 as $ip) {
            foreach ($ips_uid_2 as $ip2) {
                if ($ip == $ip2) {
                    return true;
                }
            }
        }
        return false;
    }
}