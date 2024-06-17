<?php
namespace Core;
define("BOT_TOKEN", trim(file_get_contents("/travian/telegram_bot.token")));
class Notification
{
    public static function markdown(DB $db, $text, $pin = false)
    {
        $groupId = $db->query("SELECT notificationGroupId FROM paymentConfig")->fetch_row()[0];
        $static = 'https://api.telegram.org/bot' . BOT_TOKEN . '/sendMessage?chat_id=' . $groupId . '&text=' . urlencode($text) . '&parse_mode=markdown';
        $message_id = null;
        $response = @file_get_contents($static);
        if (!empty($response)) {
            $response = json_decode($response, true);
            $message_id = $response['result']['message_id'];
        }
        if ($message_id == null || !$pin) return;
        file_get_contents('https://api.telegram.org/bot' . BOT_TOKEN . '/pinChatMessage?chat_id=' . $groupId . '&message_id=' . $message_id);
    }
}