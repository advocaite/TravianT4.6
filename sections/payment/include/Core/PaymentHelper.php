<?php

namespace Core;

use Core\Database\DB;
use Core\Database\GlobalDB;
use Core\Database\ServerDB;
use Core\Enums\ProviderEnum;
use function is_object;
use function json_encode;
use function var_dump;

class PaymentHelper
{
    public static function getProviderLocationLanguage($id)
    {
        $db = GlobalDB::getInstance();
        return $db->query("SELECT content_language FROM locations WHERE id=$id")->fetch_row()[0];
    }

    public static function setPaymentStatus($id, $status)
    {
        $db = GlobalDB::getInstance();
        $db->query("UPDATE paymentLog SET status=$status WHERE id=$id");
    }

    public static function getProviderData($id)
    {
        $db = GlobalDB::getInstance();
        $result = $db->query("SELECT * FROM paymentProviders WHERE providerId=$id")->fetch_assoc();

        return $result;
    }

    public static function getPackageInfo($id, $worldUniqueId, $goldProductName, $uid)
    {
        global $globalConfig;
        $package = 'SV: [SV] - ID: [ID] - World: [WorldName] ([WID]) - Player: [[UID]] [NAME] - Package: [PRODUCT_NAME]';
        $sv = $globalConfig['staticParameters']['global_css_class'];
        $values = [$sv, $id, $worldUniqueId, null, $uid, '?', $goldProductName];
        $server = GlobalDB::getGameServer($worldUniqueId);
        if ($server !== false) {
            $values[3] = $server['worldId'];
            $serverDB = ServerDB::getInstance($server['configFileLocation']);
            $find = $serverDB->query("SELECT name FROM users WHERE id=$uid");
            if ($find->num_rows) {
                $values[5] = $find->fetch_row()[0];
            }
        }
        output:
        return str_replace([
            '[SV]',
            '[ID]',
            '[WID]',
            '[WorldName]',
            '[UID]',
            '[NAME]',
            '[PRODUCT_NAME]'
        ], $values, $package);
    }

    public static function getProductData($id)
    {
        $db = GlobalDB::getInstance();
        $result = $db->query("SELECT * FROM goldProducts WHERE goldProductId=$id")->fetch_assoc();
        $result['realGold'] = $result['goldProductGold'];
        if ($result['goldProductHasOffer'] && C("Offer")) {
            $result['goldProductGold'] *= 1.2;
            $result['promotion'] = true;
        }
        return $result;
    }

    /**
     * @param $id
     * @param $secureId
     * @return array|bool
     */
    public static function getOrder($id, $secureId)
    {
        $db = GlobalDB::getInstance();
        $result = $db->query("SELECT * FROM paymentLog WHERE id=$id AND secureId='$secureId' LIMIT 1");
        if ($result->num_rows) return $result->fetch_assoc();
        return FALSE;
    }

    public static function getPlayerName(DB $db, $uid)
    {
        $find = $db->query("SELECT name FROM users WHERE id=$uid");
        if ($find->num_rows) {
            return $find->fetch_row()[0];
        }
        return NULL;
    }

    public static function notifyPayment($playerName, array $providerData, array $productData, array $paymentLog)
    {
        $text = "Type: %s - WID: %s - UID: %s - Player name: %s - Gold: %s - Price: %s";
        $text = vsprintf($text, [
            ProviderEnum::toString($providerData['providerType']),
            $paymentLog['worldUniqueId'],
            $paymentLog['uid'],
            $playerName,
            $productData['goldProductGold'],
            "{$productData['goldProductPrice']} {$productData['goldProductMoneyUnit']}",
        ]);
        self::notify("Payment Notifier", $text);
    }

    public static function notify($subject, $mainText)
    {
        $mainText = nl2br($mainText);
        $text = '<b>' . $subject . ':</b>';
        $text .= "<br />";
        $text .= $mainText;
        $breaks = array("<br />", "<br>", "<br/>");
        $text = str_ireplace($breaks, "\r\n", $text);
        $db = GlobalDB::getInstance();
        $db->query("INSERT INTO `notifications`(`message`, `time`) VALUES ('" . $db->real_escape_string($text) . "', '" . time() . "')");
    }

    public static function updateLogData($id, $data = null)
    {
        $id = (int)$id;
        if (is_array($data) || is_object($data)) {
            $data = json_encode($data);
        }
        $db = GlobalDB::getInstance();
        $data = $db->real_escape_string($data);
        $db->query("UPDATE paymentLog SET data='$data' WHERE id=$id");
    }
}