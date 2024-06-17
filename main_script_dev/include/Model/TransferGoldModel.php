<?php
/**
 * Created by PhpStorm.
 * User: Amirhossein
 * Date: 12/4/2018
 * Time: 01:14
 */

namespace Model;

use Core\Database\DB;

class TransferGoldModel
{

    public function getPlayerName($uid)
    {
        $db = DB::getInstance();
        $name = $db->fetchScalar("SELECT name FROM users WHERE id=$uid");
        if ($name === false) {
            return '&nbsp;<span class="none2">[?]</span>';
        }
        return $name;
    }

    public function getPlayerIdByName($name)
    {
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $db = DB::getInstance();
        $name = $db->real_escape_string($name);
        return $db->fetchScalar("SELECT id FROM users WHERE name='$name'");
    }

    public function addGold($uid, $gold)
    {
        $db = DB::getInstance();
        $db->query("UPDATE users SET bought_gold=bought_gold+$gold WHERE id=$uid");
    }

    public function addLog($uid, $toUid, $goldAmount)
    {
        $db = DB::getInstance();
        $db->query("INSERT INTO `transfer_gold_log`(`uid`, `to_uid`, `amount`, `time`) VALUES ($uid, $toUid, $goldAmount, " . time() . ")");
        return $db->lastInsertId();
    }

    public function getLog($id)
    {
        $db = DB::getInstance();
        $stmt = $db->query("SELECT * from transfer_gold_log WHERE id=$id");
        if ($stmt->num_rows) {
            return $stmt->fetch_assoc();
        }
        return false;
    }

    public function getLogsCount($uid)
    {
        $db = DB::getInstance();
        return (int)$db->fetchScalar("SELECT COUNT(id) from transfer_gold_log WHERE uid=$uid");
    }

    public function getLogs($uid, $page, $page_size)
    {
        $db = DB::getInstance();
        $start = ($page - 1) * $page_size;
        return $db->query("SELECT * from transfer_gold_log WHERE uid=$uid ORDER BY id DESC LIMIT $start, $page_size");
    }
}