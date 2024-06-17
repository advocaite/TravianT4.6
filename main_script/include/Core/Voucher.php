<?php

namespace Core;

use Core\Database\DB;
use Core\Database\GlobalDB;
use Core\Helper\Notification;
use function strtolower;

class Voucher
{
    public static function addVoucher($email, $goldNum, $reason = 'gift', $player = '')
    {
        if (empty($email)) return false;
        $player = GlobalDB::getInstance()->real_escape_string($player);
        $wid = sprintf('%s-%s', Config::getProperty("settings", "worldUniqueId"), Config::getProperty("settings", "worldId"));
        $voucherCode = generate_guid();
        $time = time();
        GlobalDB::getInstance()->query("INSERT INTO paymentVoucher (gold, email, worldId, reason, player, voucherCode, time) VALUES ($goldNum, '$email', '$wid', '$reason', '$player', '$voucherCode', $time)");
        $id = GlobalDB::getInstance()->lastInsertId();
        if (!$id) {
            Notification::notify("Voucher add failed", "Failed to add voucher. Email: $email, Gold: $goldNum, reason: $reason.");
        }
        return $id;
    }

    public static function getVoucherWithId($id, $used = false)
    {
        $db = GlobalDB::getInstance();
        return $db->query("SELECT * FROM paymentVoucher WHERE id=$id AND used=" . ($used ? 1 : 0));
    }

    public static function getVoucherWithCode($code, $email, $used = false)
    {
        $db = GlobalDB::getInstance();
        if (getCustom("allowVouchersOnlyOnSameEmail")) {
            $email = $db->real_escape_string($email);
            return $db->query("SELECT * FROM paymentVoucher WHERE voucherCode='$code' AND email='$email' AND used=" . ($used ? 1 : 0));
        }
        return $db->query("SELECT * FROM paymentVoucher WHERE voucherCode='$code' AND used=" . ($used ? 1 : 0));
    }

    public static function getTotalGoldInVoucher($email)
    {
        $globalDB = GlobalDB::getInstance();
        $email = $globalDB->real_escape_string($email);
        return (int)$globalDB->fetchScalar("SELECT SUM(gold) FROM paymentVoucher WHERE used=0 AND email='$email'");
    }

    public static function useSomeGold($goldNum, $email, $uid, $username)
    {
        $realGold = $goldNum;
        $wid = sprintf('%s-%s', Config::getProperty("settings", "worldUniqueId"), Config::getProperty("settings", "worldId"));
        $globalDB = GlobalDB::getInstance();
        $player = sprintf('[%s] %s', $uid, $username);
        $player = $globalDB->real_escape_string($player);
        $email = $globalDB->real_escape_string($email);
        $globalDB->mysqli->begin_transaction();
        $result = $globalDB->query("SELECT * FROM paymentVoucher WHERE used=0 AND email='$email' ORDER BY time ASC FOR UPDATE");
        while ($row = $result->fetch_assoc()) {
            if ($goldNum <= 0) break;
            $count = min($row['gold'], $goldNum);
            $goldNum -= $count;
            $row['gold'] = $row['gold'] - $count;
            if ($row['gold'] <= 0) {
                $query = $globalDB->query("UPDATE paymentVoucher SET used=1, usedTime=" . time() . ", usedWorldId='$wid', usedEmail='$email', usedPlayer='$player' WHERE id={$row['id']}");
                if (!$query || !$globalDB->affectedRows()) {
                    $globalDB->mysqli->rollback();
                    return FALSE;
                }
            } else {
                $query = $globalDB->query("UPDATE paymentVoucher SET gold={$row['gold']} WHERE id={$row['id']}");
                if (!$query || !$globalDB->affectedRows()) {
                    $globalDB->mysqli->rollback();
                    return FALSE;
                }
                $voucherId = self::addVoucher($row['email'], $count, $row['reason'], $row['player']);
                if (!$voucherId) {
                    $globalDB->mysqli->rollback();
                    return FALSE;
                } else {
                    $query = $globalDB->query("UPDATE paymentVoucher SET worldId='{$row['worldId']}', used=1, usedTime=" . time() . ", usedWorldId='$wid', usedEmail='$email', usedPlayer='$player' WHERE id=$voucherId");
                    if (!$query || !$globalDB->affectedRows()) {
                        $globalDB->mysqli->rollback();
                        return FALSE;
                    }
                }
            }
        }
        if ($goldNum == 0) {
            $globalDB->mysqli->commit();
            $secureId = 'NULL';
            DB::getInstance()->query("UPDATE users SET bought_gold=bought_gold+$realGold WHERE id=$uid");
            DB::getInstance()->query("INSERT INTO buyGoldMessages (uid, gold, type, trackingCode) VALUES ($uid, $realGold, 2, '{$secureId}')");
        } else {
            $globalDB->mysqli->rollback();
        }
        return $goldNum == 0 ? $realGold : FALSE;
    }

    public static function useVoucher($id, $voucherCode, $email, $uid, $username)
    {
        $globalDB = GlobalDB::getInstance();
        $result = $globalDB->query("SELECT * FROM paymentVoucher WHERE id=$id AND used=0 AND voucherCode='$voucherCode'");
        $wid = sprintf('%s-%s', Config::getProperty("settings", "worldUniqueId"), Config::getProperty("settings", "worldId"));
        $db = DB::getInstance();
        if ($result->num_rows) {
            $result = $result->fetch_assoc();
            if (getCustom("allowVouchersOnlyOnSameEmail") && !(strcmp(strtolower($email), strtolower($result['email'])) === 0)) {
                return false;
            }
            $player = sprintf('[%s] %s', $uid, $username);
            $player = $globalDB->real_escape_string($player);
            $globalDB->query("UPDATE paymentVoucher SET used=1, usedTime=" . time() . " ,usedWorldId='$wid', usedEmail='$email', usedPlayer='$player' WHERE id=$id");
            if ($globalDB->affectedRows()) {
                $db->query("UPDATE users SET bought_gold=bought_gold+{$result['gold']} WHERE id=$uid");
                $secureId = sprintf('[%s]-%s', $id, $voucherCode);
                DB::getInstance()->query("INSERT INTO buyGoldMessages (uid, gold, type, trackingCode) VALUES (" . Session::getInstance()->getPlayerId() . ", {$result['gold']}, 2, '{$secureId}')");
                return $result['gold'];
            }
        }
        return false;
    }
}