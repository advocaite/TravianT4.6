<?php
namespace Model;
use Core\Caching\GlobalCaching;
use Core\Config;
use Core\Database\DB;
use Core\Database\GlobalDB;
use Core\Helper\Mailer;
use function miliseconds;
use function strtolower;

class OptionModel
{
    const NAME_SHORT = 1;
    const NAME_LONG = 2;
    const NAME_EXISTS = 4;
    const NAME_BLACKLISTED = 8;
    public function updateGame($uid, $reportFilter, $allianceSettings, $allianceNotificationEnabled, $autoComplete, $display, $timezone)
    {
        $db = DB::getInstance();
        $db->query($q = "UPDATE users SET reportFilters='$reportFilter', allianceSettings='$allianceSettings', autoComplete='$autoComplete', display='$display', timezone='$timezone', allianceNotificationEnabled=$allianceNotificationEnabled WHERE id=$uid");
    }

    public function abortVacation($uid)
    {
        $db = DB::getInstance();
        $db->query("UPDATE users SET vacationActiveTil=0 WHERE id=$uid");
        $m = new InfoBoxModel();
        $m->deleteInfoByType($uid, 13);
        //TODO: send email
    }

    public function enterVacationMode($uid, $days)
    {
        //TODO: send email
        $till = time() + 86400 * $days;
        $db = DB::getInstance();
        $db->query("UPDATE users SET vacationUsedDays=vacationUsedDays+$days, vacationActiveTil=$till WHERE id=$uid");
        $m = new InfoBoxModel();
        $m->addInfo($uid, FALSE, 13, '', time(), $till);
        $miliseconds = miliseconds();
        $villages = $db->query("SELECT kid FROM vdata WHERE owner=$uid");
        while($row = $villages->fetch_assoc()) {
            $db->query("UPDATE movement SET to_kid=kid, kid={$row['kid']}, mode=1, end_time=(2*$miliseconds-start_time), start_time=$miliseconds WHERE to_kid={$row['kid']} AND mode=0 AND attack_type=" . MovementsModel::ATTACKTYPE_SPY);
        }
    }

    public function getPlayerVillagesAsArray($uid)
    {
        $db = DB::getInstance();
        $result = $db->query("SELECT kid FROM vdata WHERE owner=$uid");
        $arr = [];
        while($row = $result->fetch_assoc()) {
            $arr[] = $row['kid'];
        }
        return $arr;
    }

    public function getOutGoingMovementsNum(array $kids)
    {
        $db = DB::getInstance();
        return $db->fetchScalar("SELECT COUNT(id) FROM movement WHERE kid IN(" . implode(",", $kids) . ") AND mode=0");
    }
    public function doesNameMeetRequirements($currentName, $name){
        $newName = filter_var($name, FILTER_SANITIZE_STRING);
        $error = 0;
        if($this->nameExists($newName) && !(strtolower($currentName) === strtolower($name))) {
            $error |= self::NAME_EXISTS;
        } else if($this->isNameBlackListed($newName)) {
            $error |= self::NAME_BLACKLISTED;
        }
        if(strlen($newName) < 3){
            $error |= self::NAME_SHORT;
        } else if(strlen($newName) > 15){
            $error |= self::NAME_LONG;
        }
        return $error;
    }
    public function getInComingMovementsNum(array $kids)
    {
        $db = DB::getInstance();
        return $db->fetchScalar("SELECT COUNT(id) FROM movement WHERE to_kid IN(" . implode(",", $kids) . ") AND mode=0 AND attack_type!=" . MovementsModel::ATTACKTYPE_SPY) + $db->fetchScalar("SELECT COUNT(id) FROM movement WHERE to_kid IN(" . implode(",", $kids) . ") AND mode=1");
    }

    public function getOutReinforingNum($uid)
    {
        $db = DB::getInstance();
        return $db->fetchScalar("SELECT COUNT(id) FROM enforcement WHERE uid=$uid");
    }

    public function getInReinforingNum($kids)
    {
        $db = DB::getInstance();
        return $db->fetchScalar("SELECT COUNT(id) FROM enforcement WHERE to_kid IN(" . implode(",", $kids) . ") AND race!=4");
    }

    public function hasPlayerWWVillage($uid)
    {
        $db = DB::getInstance();
        return $db->fetchScalar("SELECT COUNT(kid) FROM vdata WHERE isWW=1 AND owner=$uid");
    }

    public function hasPlayerArtifact($uid)
    {
        $db = DB::getInstance();
        return $db->fetchScalar("SELECT COUNT(id) FROM artefacts WHERE uid=$uid");
    }

    public function hasTrappedUnits($kids)
    {
        $db = DB::getInstance();
        return $db->fetchScalar("SELECT COUNT(id) FROM trapped WHERE to_kid IN(" . implode(",", $kids) . ")");
    }

    public function addDeleting($uid)
    {
        $db = DB::getInstance();
        $timestamp = time() + getGame("deletionTime");
        $db->query("INSERT INTO deleting (uid, time) VALUES ($uid, $timestamp)");
        $m = new InfoBoxModel();
        $m->addInfo($uid, 0, 11, '', time(), $timestamp);
    }

    public function isInNewsLetter($email)
    {
        //return (new IndexApi())->callOnce("isInNewsLetter", $email);
        return FALSE;
    }

    public function unSubscribeNewsLetter($email)
    {
        $globalDB = GlobalDB::getInstance();
        $globalDB->query("DELETE FROM newsletter WHERE email='$email'");
    }

    public function subscribeNewsletter($email)
    {
        $globalDB = GlobalDB::getInstance();
        $exists = $globalDB->fetchScalar("SELECT COUNT(id) FROM newsletter WHERE email='$email'");
        if(!$exists) {
            $key = substr(sha1(time() . $email), 0, 11);
            $globalDB->query("INSERT INTO newsletter (email, private_key) VALUES ('$email', '$key')");
        }
    }

    public function getPlayerName($uid)
    {
        if(!$uid) {
            return '';
        }
        $db = DB::getInstance();
        return $db->fetchScalar("SELECT name FROM users WHERE id=$uid");
    }

    public function getSitters($uid)
    {
        $db = DB::getInstance();
        $assoc = [1 => ['uid' => 0, 'name' => '', 'perm' => 0, 'num' => 0], 2 => ['uid' => 0, 'name' => '', 'perm' => 0, 'num' => 0],];
        $sitters = $db->query("SELECT id, name, sit1Uid, sit2Uid, sit1Permissions, sit2Permissions FROM users WHERE sit1Uid=$uid OR sit2Uid=$uid");
        $rank = 0;
        while($row = $sitters->fetch_assoc()) {
            $rank++;
            $num = $row['sit1Uid'] == $uid ? 1 : 2;
            $assoc[$rank] = ['uid' => $row['id'], 'name' => $row['name'], 'perm' => $row['sit' . $num . "Permissions"], 'num' => $num,];
        }
        return $assoc;
    }

    public function getUserByName($name)
    {
        $db = DB::getInstance();
        $name = $db->real_escape_string($name);
        $name = $db->query("SELECT id FROM users WHERE name='$name'");
        if($name->num_rows) {
            return $name->fetch_assoc()['id'];
        }
        return FALSE;
    }

    public function getMySitters($sit1Uid, $sit1Permissions, $sit2Uid, $sit2Permissions)
    {
        return [1 => ['uid' => $sit1Uid, 'name' => $this->getPlayerName($sit1Uid), 'perm' => $sit1Permissions, 'num' => 1,], 2 => ['uid' => $sit2Uid, 'name' => $this->getPlayerName($sit2Uid), 'perm' => $sit2Permissions, 'num' => 2,],];
    }

    public function getDeletionTimestamp($uid)
    {
        $db = DB::getInstance();
        return $db->fetchScalar("SELECT time FROM deleting WHERE uid=$uid");
    }

    public function cancelDeletion($uid)
    {
        $m = new InfoBoxModel();
        $m->deleteInfoByType($uid, 11);
        $db = DB::getInstance();
        return $db->query("DELETE FROM deleting WHERE uid=$uid");
    }

    public function isEmailChangeExists($uid)
    {
        $db = DB::getInstance();
        return $db->fetchScalar("SELECT COUNT(uid) FROM changeEmail WHERE uid=$uid") > 0;
    }

    public function changePassword($uid, $newPass)
    {
        $db = DB::getInstance();
        $newPass = sha1($newPass);
        $uid = (int) $uid;
        $db->query("UPDATE users SET password='$newPass' WHERE id=$uid");
    }

    public function isDeletion($uid)
    {
        $db = DB::getInstance();
        return $db->fetchScalar("SELECT COUNT(uid) FROM deleting WHERE uid=$uid") > 0;
    }

    public function getLatestPayment($uid)
    {
        return false;
        /*$key = "doesPlayerHaveAnyPayIn7Days" . Session::getInstance()->getPlayerId();
        $memcache = Caching::getInstance();
        if((!$is = $memcache->get($key))){
            $time = time() - 86400 * 7;
            $is['result'] = GlobalDB::getInstance()->fetchScalar("SELECT COUNT(id) FROM paymentLog WHERE worldUniqueId={Config::getProperty("settings", "worldUniqueId")} AND uid=$uid AND status IN(1, 2) AND time >= $time");
            $memcache->add($key, $is, 7200);
        }
        return $is['result'];*/
    }

    public function getEmailChange($uid)
    {
        $db = DB::getInstance();
        return $db->query("SELECT email, code1, code2 FROM changeEmail WHERE uid=$uid")->fetch_assoc();
    }

    public function cancelEmailChange($uid)
    {
        $db = DB::getInstance();
        $db->query("DELETE FROM changeEmail WHERE uid=$uid");
    }

    public function nameExists($name)
    {
        $email = $name;
        $db = DB::getInstance();
        $total = $db->fetchScalar("SELECT COUNT(id) FROM users WHERE name='$email'") + $db->fetchScalar("SELECT COUNT(id) FROM activation WHERE name='$email'");
        if($total) {
            return TRUE;
        }
        $globalDB = GlobalDB::getInstance();
        $wId = Config::getProperty("settings", "worldUniqueId");
        return $globalDB->fetchScalar("SELECT COUNT(id) FROM activation WHERE worldId='{$wId}' AND name='$name' AND used=0");
    }

    public function emailExists($name)
    {
        $email = $name;
        $db = DB::getInstance();
        $total = $db->fetchScalar("SELECT COUNT(id) FROM users WHERE email='$email'") + $db->fetchScalar("SELECT COUNT(id) FROM activation WHERE email='$email'") + $db->fetchScalar("SELECT COUNT(uid) FROM changeEmail WHERE email='$email'");
        if($total) {
            return TRUE;
        }
        $globalDB = GlobalDB::getInstance();
        $wId = Config::getProperty("settings", "worldUniqueId");
        return $globalDB->fetchScalar("SELECT COUNT(id) FROM activation WHERE worldId='{$wId}' AND email='$name' AND used=0");
    }

    public function changeName($uid, $name)
    {
        $db = DB::getInstance();
        $name = $db->real_escape_string(htmlspecialchars($name, ENT_QUOTES));
        $db->query("UPDATE users SET name='$name', total_name_changes=total_name_changes+1 WHERE id=$uid");
    }

    function isNameBlackListed($name)
    {
        $cache = GlobalCaching::getInstance();
        if(!($invalidNames = $cache->get("blackListedNames"))) {
            $invalidNames = explode(",", file_get_contents(FILTERING_PATH . "blackListedNames.txt"));
            $cache->set("blackListedNames", $invalidNames, 2 * 86400);
        }
        foreach($invalidNames as $blackListed) {
            similar_text($name, $blackListed, $percent);
            if($percent > 80.5) {
                return TRUE;
            }
        }
        return FALSE;
    }

    public function changeEmail($uid, $email)
    {
        $db = DB::getInstance();
        $email = $db->real_escape_string($email);
        $email = $db->real_escape_string(htmlspecialchars($email, ENT_QUOTES));
        $db->query("UPDATE users SET email='$email' WHERE id=$uid");
    }

    public function addChangeEmail($uid, $name, $oldEmail, $newEmail)
    {
        $code1 = substr(sha1(time() . $oldEmail . $newEmail), mt_rand(0, 32 - 5), 5);
        $code2 = substr(sha1($code1 . $newEmail), mt_rand(0, 32 - 5), 5);
        $db = DB::getInstance();
        $oldEmail = $db->real_escape_string(htmlspecialchars($oldEmail, ENT_QUOTES));
        $newEmail = $db->real_escape_string(htmlspecialchars($newEmail, ENT_QUOTES));
        $db->query("INSERT INTO changeEmail (`uid`, `email`, `code1`, `code2`) VALUES ($uid,'$newEmail','$code1','$code2')");
        $this->sendMail(T("Options", "EmailChange_old_subject"), $oldEmail, nl2br(sprintf(T("Options", "EmailChange_old"), $name, getWorldId(), $code1)));
        $this->sendMail(T("Options", "EmailChange_new_subject"), $newEmail, nl2br(sprintf(T("Options", "EmailChange_new"), $name, getWorldId(), $code2)));
    }

    public function sendMail($Subject, $to, $html)
    {
        Mailer::sendEmail($to, $Subject, $html);
    }
}