<?php
namespace Core;
use Database\DB;
use PDO;
class Newsletter
{
    public static function addEmail($email){
        $db = DB::getInstance();
        $stmt = $db->prepare("SELECT COUNT(id) FROM newsletter WHERE email=:email");
        $stmt->bindValue('email', $email, PDO::PARAM_STR);
        $stmt->execute();
        if (!$stmt->rowCount()) {
            $key = substr(md5(time() . $email), 0, 11);
            $stmt = $db->prepare("INSERT INTO newsletter (email, private_key) VALUES (:email, :key)");
            $stmt->bindValue('email', $email, PDO::PARAM_STR);
            $stmt->bindValue('key', $key, PDO::PARAM_STR);
            $stmt->execute();
        }
    }
}