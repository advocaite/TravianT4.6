<?php

namespace Api\Ctrl;

use Api\ApiAbstractCtrl;
use Core\Server;
use Database\DB;
use Database\ServerDB;
use Exceptions\MissingParameterException;
use PDO;

class ServersCtrl extends ApiAbstractCtrl
{
    public function usernameById()
    {
        if (!isset($this->payload['worldId'])) {
            throw new MissingParameterException('gameWorldId');
        }
        if (!isset($this->payload['uid'])) {
            throw new MissingParameterException('uid');
        }
        $this->response = ['gameWorldName' => null, 'uid' => null, 'playerName' => null];
        $server = Server::getServerByWId($this->payload['worldId']);
        if ($server !== false) {
            $serverDB = ServerDB::getInstance($server['configFileLocation']);
            $stmt = $serverDB->prepare("SELECT name FROM users WHERE id=:id");
            $stmt->bindValue('id', intval($this->payload['uid']), PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount()) {
                $this->response['gameWorldName'] = $server['worldId'];
                $this->response['uid'] = (int)$this->payload['uid'];
                $this->response['playerName'] = $stmt->fetchColumn();
            }
        }
    }

    public function validateActivationCode()
    {
        $server = Server::getServerById($this->payload['gameWorld']);
        $this->response['success'] = false;
        if (!$server) {
            return;
        }
        $activation = $this->getActivationByActivationCode($server['id'], $this->payload['activationCode']);
        if ($activation) {
            $this->response['success'] = true;
        }
    }

    private function getActivationByActivationCode($worldId, $activationCode)
    {
        $db = DB::getInstance();
        $stmt = $db->prepare("SELECT * FROM activation WHERE worldId=:wid AND activationCode=:activationCode AND used=0");
        $stmt->bindValue('wid', $worldId, PDO::PARAM_INT);
        $stmt->bindValue('activationCode', $activationCode, PDO::PARAM_STR);
        $stmt->execute();
        if (!$stmt->rowCount()) {
            return false;
        }
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function loadServerByID()
    {
        $this->response['success'] = false;
        $db = DB::getInstance();
        $stmt = $db->prepare("SELECT * FROM gameServers WHERE id=:id");
        $stmt->bindValue('id', $this->payload['gameWorld'], PDO::PARAM_INT);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->response['success'] = true;
            $this->response['gameWorld'] = $this->serverRowToData($row);
        }
    }

    private function serverRowToData($row)
    {
        //$info = json_decode(file_get_contents($row['gameWorldUrl'] . 'info'), true);
        $server = [
            "id" => (int)$row['id'],
            "speed" => (int)$row['speed'],
            "title" => $row['name'],
            "name" => $row['worldId'],
            "url" => $row['gameWorldUrl'],
            "registrationKeyRequired" => $row['preregistration_key_only'] == 1,
            "start" => (int)$row['startTime'],
            'secondsPast' => time() - $row['startTime'],
            'fireAndSand' => substr($row['worldId'], -2) == 'fs',
            'tournament' => substr($row['worldId'], -2) == 'tt',
            'activationRequired' => $row['activation'] == 1,
            'hidden' => $row['hidden'] == 1,
            'registerClosed' => $row['registerClosed'] == 1,
            'finished' => $row['finished'] == 1,
            'finishTrainingEnabled' => false, //$info['finishTrainingEnabled']
        ];
        return $server;
    }

    public function loadServerByWID()
    {
        $db = DB::getInstance();
        $stmt = $db->prepare("SELECT * FROM gameServers WHERE worldId=:worldId");
        $this->response['success'] = false;
        $stmt->bindValue('worldId', $this->payload['worldId'], PDO::PARAM_STR);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->response['success'] = true;
            $this->response['gameWorld'] = $this->serverRowToData($row);
        }
    }

    public function loadServers()
    {
        $this->response = ['serverTime' => time(), 'gameWorlds' => []];
        $db = DB::getInstance();
        $stmt = $db->query("SELECT * FROM gameServers");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->response['gameWorlds'][] = $this->serverRowToData($row);
        }
    }
}