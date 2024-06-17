<?php
namespace Core;
use Database\DB;
use PDO;

class LoginOperator
{
    /**
     * @var PDO
     */
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function findLogin($worldUniqueId, $name)
    {
        /** @var $db PDO */
        $LoginType = 0;
        $userRow = [];
        do {
            $stmt = $this->db->prepare("SELECT id, name, email, sit1Uid, sit2Uid, password, last_owner_login_time FROM users WHERE (name=:name OR email=:email) LIMIT 1");
            $stmt->bindValue("name", $name, PDO::PARAM_STR);
            $stmt->bindValue("email", $name, PDO::PARAM_STR);
            $stmt->execute();
            if ($stmt->rowCount()) {
                $LoginType = 1;
                $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
                break;
            }
            $stmt = $this->db->prepare("SELECT id, token, password FROM activation WHERE (name=:name OR email=:email) LIMIT 1");
            $stmt->bindValue("name", $name, PDO::PARAM_STR);
            $stmt->bindValue("email", $name, PDO::PARAM_STR);
            $stmt->execute();
            if ($stmt->rowCount()) {
                $LoginType = 2;
                $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
                break;
            }
            $activation = $this->getActivation($worldUniqueId, $name);
            if ($activation !== FALSE) {
                $LoginType = 3;
                $userRow = $activation;
                $userRow['password'] = sha1($userRow['password']);
                break;
            }
        } while (0);
        return ["type" => $LoginType, "row" => $userRow];
    }

    private function getActivation($worldId, $name)
    {
        $db = DB::getInstance();
        $stmt = $db->prepare("SELECT id, name, password FROM activation WHERE worldId=:worldId AND used=0 AND (name=:name OR email=:email)");
        $stmt->bindValue("worldId", $worldId, PDO::PARAM_STR);
        $stmt->bindValue("name", $name, PDO::PARAM_STR);
        $stmt->bindValue("email", $name, PDO::PARAM_STR);
        $stmt->execute();
        if ($stmt->rowCount()) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return false;
    }

    public function insertHandshake($uid, $isSitter = false)
    {
        $handshake = sha1(generate_guid());
        $stmt = $this->db->prepare("INSERT INTO login_handshake (uid, token, time, isSitter) VALUES (:uid, :token, :time, :isSitter)");
        $stmt->bindValue('uid', $uid, PDO::PARAM_INT);
        $stmt->bindValue('token', sha1($handshake), PDO::PARAM_STR);
        $stmt->bindValue('time', time(), PDO::PARAM_INT);
        $stmt->bindValue('isSitter', $isSitter, PDO::PARAM_BOOL);
        $stmt->execute();
        return $handshake;
    }

    /**
     * @param $password
     * @param $result
     *
     * @return int
     * 0: success login
     * 1: password wrong.
     *
     */
    public function checkLogin($password, $result)
    {
        if ($result['row']['password'] == $password) {
            return 0;
        }
        if ($result['type'] == 1) {
            if ($result['row']['sit1Uid'] && $this->getSitterPassword($result['row']['sit1Uid']) == $password) {
                return 1;
            }
            if ($result['row']['sit2Uid'] && $this->getSitterPassword($result['row']['sit2Uid']) == $password) {
                return 2;
            }
        }
        return 3;
    }

    private function getSitterPassword($uid)
    {
        /** @var $db PDO */
        if (!$uid) {
            return FALSE;
        }
        $stmt = $this->db->prepare("SELECT password FROM users WHERE id=:uid LIMIT 1");
        $stmt->bindValue("uid", $uid, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount()) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['password'];
        }
        return FALSE;
    }
}