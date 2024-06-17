<?php
use Core\DB;
use Core\Mailer;
require("include/bootstrap.php");
$db = DB::getInstance();
$lockTime = intval($db->query("SELECT mailerLock FROM paymentConfig")->fetchColumn());
if ($lockTime > 0 && (time() - $lockTime) > 60) {
    $lockTime = 0;
}
if ($lockTime == 0) {
    $db->query("UPDATE paymentConfig SET mailerLock=" . time());
    $result = $db->query("SELECT * FROM mailServer ORDER BY priority ASC LIMIT 100");
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $db->query("DELETE FROM mailServer WHERE id={$row['id']}");
        if (empty($row['toEmail'])) continue;
        Mailer::sendMail($row['toEmail'], $row['subject'], $row['html']);
    }
    $db->query("UPDATE paymentConfig SET mailerLock=0");
}