<?php

namespace Model;

use Core\Config;
use Core\Database\DB;
use Core\Database\GlobalDB;
use Game\Map\Map;
use function logError;

class inactiveModel
{
    private function deleteInactive()
    {
        return null;
        $db = DB::getInstance();
        $configs = [
            ['popLessThan' => 10, 'inactiveTime' => 7 * 86400],
            ['popLessThan' => 100, 'inactiveTime' => 10 * 86400],
            ['popLessThan' => 250, 'inactiveTime' => 14 * 86400],
            ['popLessThan' => 500, 'inactiveTime' => 15 * 86400],
            ['popLessThan' => 1000, 'inactiveTime' => 3 * 7 * 86400],
            ['popLessThan' => -1, 'inactiveTime' => 5 * 7 * 86400],
        ];
        foreach ($configs as $config) {
            $time = time() - $config['inactiveTime'];
            if ($config['popLessThan'] < 0) {
                $result = $db->query("SELECT id FROM users WHERE id>2 AND IF(vacationActiveTil=0, last_login_time < $time, IF(last_login_time>vacationActiveTil, last_login_time < $time, vacationActiveTil < $time)) AND last_login_time!=0 LIMIT 10");
            } else {
                $result = $db->query("SELECT id FROM users WHERE id>2 AND total_pop <= {$config['popLessThan']} AND IF(vacationActiveTil=0, last_login_time < $time, IF(last_login_time>vacationActiveTil, last_login_time < $time, vacationActiveTil < $time)) AND last_login_time!=0 LIMIT 10");
            }
            while ($row = $result->fetch_assoc()) {
                $count = $db->fetchScalar("SELECT * FROM deleting WHERE uid={$row['id']}");
                if ($count) {
                    continue;
                } else {
                    $db->query("INSERT INTO deleting(uid, time) VALUES ({$row['id']}, 0)");
                }
            }
        }
    }

    private function clearDeletion()
    {
        $db = DB::getInstance();
        $find = $db->query("SELECT * FROM deleting WHERE uid > 2 AND time <=" . (time()) . " ORDER BY time ASC LIMIT 100");
        $del = new AccountDeleter();
        $summary = new SummaryModel();
        $alliance = new AllianceModel();
        $mm = new AutomationModel();
        while ($row = $find->fetch_assoc()) {
            $db->query("DELETE FROM deleting WHERE uid={$row['uid']}");
            $user = $db->query("SELECT id, name, email, email_verified, race, aid, gift_gold, bought_gold FROM users WHERE id={$row['uid']}")->fetch_assoc();
            if ($user['email_verified'] == 1) {
                $gold = floor($user['bought_gold'] * (100 - Config::getProperty("gold", "voucherTaxPercent")) / 100);
                if ($gold > 0) {
                    $mm->addVoucher($user['email'], $gold, "remaining", sprintf('%s-%s', $user['id'], $user['name']));
                }
            }
            $villages = $db->query("SELECT kid FROM vdata WHERE owner={$row['uid']}");
            while ($village = $villages->fetch_assoc()) {
                $del->deleteVillage($village['kid'], true);
            }
            $db->query("DELETE FROM player_references WHERE ref_uid={$row['uid']}");
            $db->query("UPDATE auction SET maxSilver=silver, activeId=0, activeUid=0 WHERE activeUid={$row['uid']}");
            $db->query("DELETE FROM auction WHERE uid={$row['uid']}");
            $db->query("DELETE FROM bids WHERE uid={$row['uid']}");
            $db->query("DELETE FROM notes WHERE (uid={$row['uid']} OR to_uid={$row['uid']})");
            $db->query("DELETE FROM accounting WHERE uid={$row['uid']}");
            $db->query("DELETE FROM ndata WHERE uid={$row['uid']}");
            $db->query("DELETE FROM mdata WHERE uid={$row['uid']}");
            $db->query("DELETE FROM users WHERE id={$row['uid']}");
            $db->query("DELETE FROM hero WHERE uid={$row['uid']}");
            $db->query("DELETE FROM inventory WHERE uid={$row['uid']}");
            $db->query("DELETE FROM autoExtend WHERE uid={$row['uid']}");
            $db->query("DELETE FROM face WHERE uid={$row['uid']}");
            $db->query("DELETE FROM items WHERE uid={$row['uid']}");
            $db->query("DELETE FROM adventure WHERE uid={$row['uid']}");
            $db->query("DELETE FROM ali_invite WHERE uid={$row['uid']}");
            $db->query("DELETE FROM banQueue WHERE uid={$row['uid']}");
            $db->query("DELETE FROM banHistory WHERE uid={$row['uid']}");
            $db->query("DELETE FROM forum_open_players WHERE uid={$row['uid']}");
            $db->query("DELETE FROM activation_progress WHERE uid={$row['uid']}");
            $db->query("DELETE FROM links WHERE uid={$row['uid']}");
            $db->query("DELETE FROM ignoreList WHERE uid={$row['uid']} OR ignore_id={$row['uid']}");
            $db->query("DELETE FROM friendlist WHERE uid={$row['uid']} OR to_uid={$row['uid']}");
            if ($user['aid']) {
                $flags = $db->query("SELECT * FROM mapflag WHERE (targetId={$user['aid']} AND type=1) OR (targetId={$user['id']} AND type=0)");
            } else {
                $flags = $db->query("SELECT * FROM mapflag WHERE (targetId={$user['id']} AND type=0)");
            }
            while ($flag = $flags->fetch_assoc()) {
                if ($flag['aid']) {
                    Map::removeMapCacheForAlliance($flag['aid'],
                        $flag['type'] == 0 ? 'player' : 'alliance',
                        $flag['targetId']);
                } else {
                    Map::removeMapCacheForPlayer($flag['uid'],
                        $flag['type'] == 0 ? 'player' : 'alliance',
                        $flag['targetId']);
                }
            }
            $db->query("DELETE FROM mapflag WHERE uid={$row['uid']}");
            $db->query("DELETE FROM medal WHERE uid={$row['uid']}");
            $db->query("DELETE FROM newproc WHERE uid={$row['uid']}");
            $db->query("UPDATE users SET sit1Uid=0, sit1Permissions=55 WHERE sit1Uid={$row['uid']}");
            $db->query("UPDATE users SET sit2Uid=0, sit2Permissions=55 WHERE sit2Uid={$row['uid']}");
            if ($user['aid']) {
                $alliance->leaveAlliance($user['id'], $user['aid'], true);
            }
            $summary->deletePlayerFromSummary($user['race']);
        }
        $find->free();
    }

    public function startWorker()
    {
        $this->deleteInactive();
        $this->clearDeletion();
    }
}