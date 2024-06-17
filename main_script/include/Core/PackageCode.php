<?php
namespace Core;

use Core\Database\DB;
use Core\Database\GlobalDB;
use Core\Helper\Notification;
use function generate_guid;

class PackageCode
{
    public static function generateCode($packageId, $count, $isGift = false)
    {
        $codes = [];
        for ($i = 1; $i <= $count; ++$i) {
            $codes[] = self::insert($packageId, $isGift);
        }
        return $codes;
    }

    public static function doesCodeExists($code)
    {
        $db = GlobalDB::getInstance();
        $code = $db->real_escape_string($code);
        $stmt = $db->query("SELECT * FROM package_codes WHERE code='$code'");
        return $stmt->num_rows > 0;
    }

    public static function getCodesByPage($packageId, $page, $pageSize, $isGift = false)
    {
        $db = GlobalDB::getInstance();
        if ($isGift) {
            return $db->query("SELECT * FROM package_codes WHERE used=0 AND isGift=1 AND package_id=$packageId ORDER BY id DESC LIMIT " . (($page - 1) * $pageSize) . ", $pageSize");
        }
        return $db->query("SELECT * FROM package_codes WHERE used=0 AND package_id=$packageId ORDER BY id DESC LIMIT " . (($page - 1) * $pageSize) . ", $pageSize");
    }

    public static function deleteCodesForPackage($id)
    {
        $db = GlobalDB::getInstance();
        $db->query("DELETE FROM package_codes WHERE package_id=$id");
    }

    public static function isCodeUsed($code)
    {
        $db = GlobalDB::getInstance();
        $code = $db->real_escape_string($code);
        return 1 == $db->fetchScalar("SELECT used FROM package_codes WHERE code='$code'");
    }

    private static function getCode($code)
    {
        $db = GlobalDB::getInstance();
        $code = $db->real_escape_string($code);
        $stmt = $db->query("SELECT * FROM package_codes WHERE code='$code'");
        if (!$stmt->num_rows) {
            return false;
        }
        return $stmt->fetch_assoc();
    }

    public static function getProduct($id)
    {
        $db = GlobalDB::getInstance();
        $stmt = $db->query("SELECT * FROM `goldProducts` WHERE goldProductId=" . (int)$id);
        return $stmt->num_rows ? $stmt->fetch_assoc() : FALSE;
    }

    public static function useCode($uid, $name, $email, $code)
    {
        $db = GlobalDB::getInstance();
        if (!self::doesCodeExists($code) || self::isCodeUsed($code)) {
            return false;
        }
        $codeRow = self::getCode($code);
        $product = self::getProduct($codeRow['package_id']);
        if ($product === FALSE) return false;
        $config = $db->query("SELECT * FROM paymentConfig")->fetch_assoc();
        $promotion = $config['offer'] > time();
        $package_gold = $product['goldProductGold'];
        $gift_gold = 0;
        if ($product['goldProductHasOffer'] && $promotion) {
            $gift_gold = ceil($package_gold * 20 / 100);
        }
        $total_gold = $package_gold + $gift_gold;
        $db->query("DELETE FROM package_codes WHERE id={$codeRow['id']}");
        if (!$db->affectedRows()) {
            return false;
        }
        if ($codeRow['isGift']) {
            DB::getInstance()->query("UPDATE users SET gift_gold=gift_gold+$total_gold WHERE id=$uid");
            DB::getInstance()->query("INSERT INTO buyGoldMessages (uid, gold, type, trackingCode) VALUES ($uid, $total_gold, 2, '$code')");
            $worldUniqueId = Config::getProperty("settings", "worldUniqueId");
            Notification::notify("Payment Notifier",
                "Type: GiftCode - WID: $worldUniqueId - UID: $uid - Player name: $name - Gold: {$product['goldProductGold']}");
        } else {
            DB::getInstance()->query("UPDATE users SET bought_gold=bought_gold+$package_gold, gift_gold=gift_gold+$gift_gold WHERE id=$uid");
            DB::getInstance()->query("INSERT INTO buyGoldMessages (uid, gold, type, trackingCode) VALUES ($uid, $total_gold, 2, '$code')");
            $worldUniqueId = Config::getProperty("settings", "worldUniqueId");
            $db->query("INSERT INTO paymentLog(worldUniqueId, uid, email, secureId, paymentProvider, productId, payPrice, status, time) VALUES ('$worldUniqueId','$uid','$email','$code','0','{$codeRow['package_id']}', {$product['goldProductPrice']}, 1, '" . time() . "')");
            Notification::notify("Payment Notifier",
                "Type: Code - WID: $worldUniqueId - UID: $uid - Player name: $name - Gold: {$product['goldProductGold']} - Price: {$product['goldProductPrice']} {$product['goldProductMoneyUnit']}");
        }
        return true;
    }

    private static function insert($packageId, $isGift = false)
    {
        $packageId = (int)$packageId;
        $db = GlobalDB::getInstance();
        $isGift = $isGift ? 1 : 0;
        $code = $db->real_escape_string(generate_guid());
        $db->query("INSERT INTO `package_codes`(`package_id`, `code`, `isGift`) VALUES ('$packageId', '$code', '$isGift')");
        return $code;
    }
}