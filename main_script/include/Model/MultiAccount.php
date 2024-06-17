<?php
namespace Model;
use Core\Database\DB;

class MultiAccount
{
    public function runProgress()
    {
        $db = DB::getInstance();
        $time = time() - 1 * 3600;
        $db->query("DELETE FROM `multiaccount_users` WHERE time <= $time");
        $result = $db->query("SELECT id FROM users WHERE access=1 AND lastMultiAccountCheck < $time ORDER BY lastMultiAccountCheck ASC LIMIT 100");
        $batchQueries = [];
        $bannedIDs = [];
        $batchUIDs = [];
        while ($row = $result->fetch_assoc()) {
            $batchUIDs[] = $row['id'];
            if(in_array($row['id'], $bannedIDs)) continue;
            $multiAccountResult = $this->checkForSameUIDs($row['id']);
            if ($multiAccountResult['total'] && $multiAccountResult['totalActions'] >= 0) {
                $bannedIDs[] = $row['id'];
                $data = [];
                $priority = 0;
                foreach ($multiAccountResult['results'] as $r) {
                    if($r['attacks'] <= 10 && $r['reinforcements'] <= 5 && $r['trades'] <= 10){
                        //continue;
                    }
                    $bannedIDs[] = $r['uid'];
                    $priority += $r['attacks'] + $r['reinforcements'] + $r['trades'];
                    $data[] = implode(",", [$r['uid'], $r['attacks'], $r['reinforcements'], $r['trades']]);
                }
                //if($priority <= 100) continue;
                $batchQueries[] = sprintf("(%s, '%s', %s, %s)", $row['id'], implode("|", $data), $priority, time());
            }
            //}
            if(isset($batchQueries[0])){
                $db->query("INSERT IGNORE INTO `multiaccount_users`(`uid`, `data`, `priority`, `time`) VALUES " . implode(",", $batchQueries));
            }
            if(isset($batchUIDs[0])){
                $db->query("UPDATE users SET lastMultiAccountCheck=" . time() . " WHERE id IN(".implode(",", $batchUIDs).")");
            }
        }
    }
    public function getMultiAccountUsers($page, $pageSize){
        $db = DB::getInstance();
        return $db->query("SELECT * FROM multiaccount_users ORDER BY priority DESC LIMIT " . (($page - 1) * $pageSize) . ", $pageSize");
    }
    public function getMultiAccountUsersTotal(){
        $db = DB::getInstance();
        return $db->fetchScalar("SELECT COUNT(id) FROM multiaccount_users");
    }
    public function getMultiAccountById($id){
        $db = DB::getInstance();
        return $db->query("SELECT * FROM multiaccount_users WHERE id=$id");
    }
    public function checkForSameUIDs($uid)
    {
        $db = DB::getInstance();
        $user_ips = $db->query("SELECT DISTINCT ip FROM log_ip WHERE uid=$uid ORDER BY id DESC");
        $sameUIDs = [];
        $done = [];
        $totalActions = 0;
        while ($row = $user_ips->fetch_assoc()) {
            $other_ips = $db->query("SELECT DISTINCT uid FROM log_ip WHERE uid!=$uid AND ip='{$row['ip']}'");
            while ($r = $other_ips->fetch_assoc()) {
                if(in_array($r['uid'], $done)){
                    continue;
                }
                $done[] = $r['uid'];
                $array = [
                    'trades' => $this->checkForMultiLog($uid, $r['uid'], 1),
                    'reinforcements' => $this->checkForMultiLog($uid, $r['uid'], 2),
                    'attacks' => $this->checkForMultiLog($uid, $r['uid'], 3),
                ];
                $totalActions += array_sum($array);
                if (!array_sum($array)) {
                    continue;
                }
                $array['uid'] = $r['uid'];
                array_push($sameUIDs, $array);
            }
        }
        $tmp = $sameUIDs;
        $sameUIDs = [];
        $sameUIDs['results'] = $tmp;
        $sameUIDs['total'] = sizeof($tmp);
        $sameUIDs['totalActions'] = $totalActions;
        return $sameUIDs;
    }

    /**
     * @param $uid
     * @param $to_uid
     * @param $type | type1 => Trades | type2 => Reinforcements | type3 => attacks
     * @return string
     */
    public function checkForMultiLog($uid, $to_uid, $type = -1)
    {
        $db = DB::getInstance();
        if ($type == -1) {
            return $db->fetchScalar("SELECT COUNT(id) FROM multiaccount_log WHERE ((uid=$uid AND to_uid=$to_uid) OR (to_uid=$uid AND uid=$to_uid)) AND time >= " . strtotime("now -14 days"));
        }
        return $db->fetchScalar("SELECT COUNT(id) FROM multiaccount_log WHERE ((uid=$uid AND to_uid=$to_uid) OR (to_uid=$uid AND uid=$to_uid)) AND type=$type AND time >= " . strtotime("now -14 days"));
    }

    public static function addMultiAccountLog($uid, $to_uid, $type)
    {
        if($uid <= 2 || $to_uid <= 2) return;
        $db = DB::getInstance();
        $db->query("INSERT INTO `multiaccount_log`(`uid`, `to_uid`, `type`, `time`) VALUES ($uid, $to_uid, $type, " . time() . ")");
    }
}