<?php
namespace Core;
use PDO;

class Notification
{
    public static function notify($text)
    {
        $breaks = array("<br />", "<br>", "<br/>");
        $text = str_ireplace($breaks, "\r\n", $text);
        $db = DB::getInstance();
        $stmt = $db->prepare("INSERT INTO `notifications`(`message`, `time`) VALUES (:message, :time)");
        $stmt->bindValue('message', $text, PDO::PARAM_STR);
        $stmt->bindValue('time', time(), PDO::PARAM_INT);
        $stmt->execute();
    }
    public static function dispatchNotifications()
    {
        $db = DB::getInstance();
        $config = $db->query("SELECT notificationLock, notificationGroupId FROM paymentConfig")->fetch(PDO::FETCH_ASSOC);
        $lockTime = intval($config['notificationLock']);
        if ($lockTime > 0 && (time() - $lockTime) > 60) {
            $lockTime = 0;
        }
        if ($lockTime == 0) {
            self::sendIncomeSummary();
            $db->query("UPDATE paymentConfig SET notificationLock=" . time());
            $result = $db->query("SELECT * FROM notifications ORDER BY time ASC LIMIT 100");
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $db->query("DELETE FROM notifications WHERE id={$row['id']}");
                $message_id = self::sendMessage($row['message'], $config['notificationGroupId']);
                if ($row['pin'] == 1 && $message_id) {
                    self::pinMessage($message_id, $config['notificationGroupId']);
                }
            }
            $db->query("UPDATE paymentConfig SET notificationLock=0");
        }
    }

    private static function sendIncomeSummary()
    {
        $db = DB::getInstance();
        $lockTime = intval($db->query("SELECT lastIncomeCheck FROM paymentConfig")->fetchColumn());
        $hash = $db->query("SELECT lastIncomeHash FROM paymentConfig")->fetchColumn();
        if ((time() - $lockTime) > 12 * 3600) {
            $db->query("UPDATE paymentConfig SET lastIncomeCheck=" . time());
            $db->query("DELETE FROM paymentLog WHERE (status!=1 AND status!=2) AND time < " . (time() - (6 * 3600)));
            set_time_limit(0);
            ini_set("memory_limit", -1);
            $text = 'Income summary: <br />';
            $income = [];
            $result = $db->query("SELECT * FROM paymentLog WHERE (status=1 OR status=2) ORDER BY worldUniqueId DESC");
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $wid = $row['worldUniqueId'];
                $productData = $db->query("SELECT * FROM goldProducts WHERE goldProductId={$row['productId']}")->fetch(PDO::FETCH_ASSOC);
                if (!isset($income[$wid]['income'][$productData['goldProductMoneyUnit']])) {
                    $income[$wid]['wid'] = $wid;
                    $income[$wid]['income'][$productData['goldProductMoneyUnit']] = 0;
                }
                $income[$wid]['income'][$productData['goldProductMoneyUnit']] += $productData['goldProductPrice'];
            }
            $countServers = 0;
            foreach ($income as $wid => $in) {
                $text_income = [];
                foreach ($in['income'] as $moneyUnit => $price) {
                    if ($price == 0) continue;
                    $text_income[] = "$price $moneyUnit";
                }
                if (!sizeof($text_income)) $text_income[] = 'none!';
                $gameServer = $db->query("SELECT name FROM gameServers WHERE id=$wid");
                if ($gameServer->rowCount()) {
                    $wid = $gameServer->fetchColumn();
                } else {
                    $wid = 'Deleted server';
                }
                $text .= $wid . ': ';
                $text .= implode(" | ", $text_income) . '<br />';
                if ((++$countServers) >= 7) break;
            }
            if ($hash == md5($text)) {
                return;
            }
            $db->query("UPDATE paymentConfig SET lastIncomeHash='" . md5($text) . "'");
            if (!sizeof($income)) {
                return;
            }
            self::notify($text);
        }
    }

    private static function sendMessage($message, $group_to_send)
    {
        $message_id = FALSE;
        $response = file_get_contents('https://api.telegram.org/bot' . BOT_TOKEN . '/sendMessage?text=' . urlencode($message) . '&disable_web_page_preview=1&parse_mode=HTML&chat_id=' . $group_to_send);
        if (!empty($response)) {
            $response = json_decode($response, true);
            $message_id = $response['result']['message_id'];
        }
        return $message_id;
    }

    private static function pinMessage($message_id, $group_to_send)
    {
        file_get_contents('https://api.telegram.org/bot' . BOT_TOKEN . '/pinChatMessage?chat_id=' . $group_to_send . '&message_id=' . $message_id);
    }
}