<?php

namespace Model;

use Core\Database\DB;
use Core\Database\GlobalDB;

class EmailVerification
{
    public function isVerificationInProgress($uid)
    {
        $db = DB::getInstance();
        return $db->fetchScalar("SELECT COUNT(id) FROM activation_progress WHERE uid=$uid") > 0;
    }

    public function getActivationProgressEmail($uid)
    {
        $db = DB::getInstance();
        return $db->fetchScalar("SELECT email FROM activation_progress WHERE uid=$uid");
    }

    public function getActivationProgressByUid($uid)
    {
        $db = DB::getInstance();
        return $db->query("SELECT * FROM activation_progress WHERE uid=$uid")->fetch_assoc();
    }

    public function emailExists($email)
    {
        $db = DB::getInstance();
        $email = $db->real_escape_string($email);
        $emailExists = (int)$db->fetchScalar("SELECT COUNT(id) FROM users WHERE email='$email' AND email_verified=1") > 0;
        return $emailExists;
    }

    public function emailBlackListed($email)
    {
        $db = GlobalDB::getInstance();
        $email = $db->real_escape_string($email);
        $blackListed = $db->fetchScalar("SELECT COUNT(id) FROM email_blacklist WHERE email='$email'") > 0;
        return $blackListed;
    }

    public function getVerificationById($id)
    {
        $db = DB::getInstance();
        return $db->query("SELECT * FROM activation_progress WHERE id=$id");
    }

    public function removeVerificationById($id)
    {
        $db = DB::getInstance();
        return $db->query("DELETE FROM activation_progress WHERE id=$id");
    }

    public function setEmailAsVerified($uid, $email)
    {
        $db = DB::getInstance();
        $email = $db->real_escape_string($email);
        $db->query("UPDATE users SET email='$email', email_verified=1 WHERE id=$uid");
        (new InfoBoxModel())->deleteInfoByType($uid, 16);
        InfoBoxModel::invalidateUserInfoBoxCache($uid);
        (new OptionModel())->subscribeNewsletter($email);
    }
}