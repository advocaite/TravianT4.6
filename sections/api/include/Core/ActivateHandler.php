<?php
namespace Core;
use PDO;
class ActivateHandler
{
    public static function addActivation($name, $password, $email, $refUid, PDO $serverDB)
    {
        $token = md5(microtime() . get_random_string(32));
        $stmt = $serverDB->prepare("INSERT INTO activation (name, password, email, token, refUid, time) VALUES (:name, :password, :email, :token, :refUid, :time)");
        $stmt->bindValue('name', $name, PDO::PARAM_STR);
        $stmt->bindValue('password', sha1($password), PDO::PARAM_STR);
        $stmt->bindValue('email', $email, PDO::PARAM_STR);
        $stmt->bindValue('token', $token, PDO::PARAM_STR);
        $stmt->bindValue('refUid', $refUid, PDO::PARAM_INT);
        $stmt->bindValue('time', time(), PDO::PARAM_INT);
        $stmt->execute();
        return $token;
    }
}