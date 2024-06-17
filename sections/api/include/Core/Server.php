<?php
namespace Core;
use Database\DB;
use function file_get_contents;
use function json_encode;
use PDO;
class Server
{
    public static function getServerById($id)
    {
        $db = DB::getInstance();
        $stmt = $db->prepare("SELECT * FROM gameServers WHERE id=:id");
        $stmt->bindValue('id', $id, PDO::PARAM_INT);
        $stmt->execute();
        if (!$stmt->rowCount()) {
            return FALSE;
        }
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getServerByWId($wid)
    {
        $db = DB::getInstance();
        $stmt = $db->prepare("SELECT * FROM gameServers WHERE worldId=:wid");
        $stmt->bindValue('wid', $wid, PDO::PARAM_STR);
        $stmt->execute();
        if (!$stmt->rowCount()) {
            return FALSE;
        }
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getGameWorldsList($includeDev = false)
    {
        $result = [];
        $db = DB::getInstance();
        $stmt = $db->query("SELECT * FROM gameServers");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if (!$includeDev && $row['hidden'] == 1) continue;
            $server = [
                "id" => $row['id'],
                "uuid" => sha1($row['id']),
                "title" => $row['name'],
                "name" => $row['worldId'],
                "url" => $row['gameWorldUrl'],
                "status" => $row['registerClosed'] == 1 || $row['finished'] == 1 ? 0 : 1,
                "registrationKeyRequired" => $row['preregistration_key_only'] == 1,
                "start" => $row['startTime'],
            ];
            if (substr($row['worldId'], -2) == 'tt') {
                $server['fireAndSand'] = 'yes';
            }
            $result[] = $server;
        }

        return $result;
    }

    public static function getGameWorldsListForRegistration($includeDev = false)
    {
        $result = [];
        $db = DB::getInstance();
        $stmt = $db->query("SELECT * FROM gameServers WHERE finished=0 AND registerClosed=0");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if (!$includeDev && $row['hidden'] == 1) continue;
            $server = [
                "id" => $row['id'],
                "uuid" => sha1($row['id']),
                "title" => $row['name'],
                "name" => $row['worldId'],
                "url" => $row['gameWorldUrl'],
                "status" => 1,
                "registrationKeyRequired" => $row['preregistration_key_only'] == 1,
                "start" => $row['startTime']
            ];
            if (substr($row['worldId'], -2) == 'tt') {
                $server['fireAndSand'] = 'yes';
            }
            $result[] = $server;
        }
        return $result;
    }
}