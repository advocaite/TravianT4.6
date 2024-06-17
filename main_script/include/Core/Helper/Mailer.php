<?php

namespace Core\Helper;

use Core\Database\GlobalDB;

class Mailer
{
    public static function sendAdminReport($subject, $html)
    {
        return self::sendEmail('chamirhossein@gmail.com', $subject, $html);
    }

    public static function sendBatch($to, $subject, $html)
    {
        $db = GlobalDB::getInstance();
        $html = $db->real_escape_string($html);
        $string = [];
        $basic = "('%s', '%s', '%s')";
        foreach ($to as $v) {
            $string[] = sprintf($basic, $v, $subject, $html, 99999);
        }
        $db->query("INSERT INTO mailServer (toEmail, subject, html) VALUES " . implode(",", $string));
        return $db->affectedRows();
    }

    public static function sendEmail($to, $subject, $html, $priority = 0)
    {
        $db = GlobalDB::getInstance();
        $db->query(sprintf("INSERT INTO mailServer (toEmail, subject, html, priority) VALUES ('%s', '%s', '%s', $priority)",
            $to,
            $db->real_escape_string($subject),
            $db->real_escape_string($html)));
        return $db->affectedRows();
    }
}