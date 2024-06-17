<?php
require __DIR__ . "/bootstrap.php";
use Core\Types;
$link = sprintf('http://www.gtop100.com/home/report1?siteid=%s&pass=%s', $argv[1], $argv[2]);
$xml = simplexml_load_file($link);
if ($xml->errorcode == 0)
{
    $cnt = count($xml->entries->entry);
    for ($i = 0; $i < $cnt; $i++)
    {
        $entry = $xml->entries->entry[$i];
        error_log('GTop100 Cron Received: ' . print_r($entry, true));
        list($worldUniqueId, $playerId) = explode("_", $entry->pingusername);
        add_gold(Types::G_TOP_100, $entry->ip, (int) $worldUniqueId, (int) $playerId, 'GTop100');
    }
}