<?php

namespace Model;

use Core\Config;
use Core\Database\DB;
use Core\Helper\Notification;
use Core\Voucher;

class AutomationModel
{
    public function getUser($uid, $columns)
    {
        $db = DB::getInstance();
        $user = $db->query("SELECT $columns FROM users WHERE id=$uid");
        if ($user->num_rows) {
            return $user->fetch_assoc();
        }
        return false;
    }

    public function getVillage($kid, $columns)
    {
        $db = DB::getInstance();
        $user = $db->query("SELECT $columns FROM vdata WHERE kid=$kid");
        if ($user->num_rows) {
            return $user->fetch_assoc();
        }
        return false;
    }

    public function finishTheGame($resultCode)
    {
        $db = DB::getInstance();
        $db->backup_tables(true);
        if ($resultCode == 1) {
            $kid = $db->fetchScalar("SELECT kid FROM fdata WHERE f99=100");
            $wData = $db->query("SELECT name, owner FROM vdata WHERE kid=$kid")->fetch_assoc();
            $uData = $db->query("SELECT id, name, aid FROM users WHERE id={$wData['owner']}")->fetch_assoc();
            $text = sprintf("The world round in this server is now finished by %s.", $uData['name']);
            Notification::notify("World round finished", $text);
        } else {
            Notification::notify("World round finished", "The world round in this server is now finished by Natars.");
        }
        $config = Config::getInstance();
        $config->dynamic->serverFinished = $resultCode;
        $db->query("UPDATE config SET serverFinished=$resultCode");
        $messageModel = new PublicMsgModel();
        $messageModel->haveNewMessage($resultCode == 1 ? '[ServerFinishWinner]' : '[ServerFinishNoWinner]');
        $db->query("DELETE FROM auction");
        $db->query("DELETE FROM activation");
        $db->query("DELETE FROM ali_invite");
        $db->query("DELETE FROM auction");
        $db->query("DELETE FROM building_upgrade");
        $db->query("DELETE FROM deleting");
        $db->query("DELETE FROM demolition");
        $db->query("DELETE FROM market");
        $db->query("DELETE FROM send");
        $db->query("DELETE FROM movement");
        $db->query("DELETE FROM odelete");
        $db->query("DELETE FROM research");
        $db->query("DELETE FROM training");
        $db->query("DELETE FROM activation_progress");
        $m = new InfoBoxModel();
        $m->deleteInfoByTypeInServer(7);
        $m->deleteInfoByTypeInServer(8);
        $m->deleteInfoByTypeInServer(9);
        $m->deleteInfoByTypeInServer(10);
        $m->deleteInfoByTypeInServer(11);
        $m->deleteInfoByTypeInServer(12);
    }

    public function addVoucher($email, $goldNum, $reason = 'gift', $player = '')
    {
        if ($goldNum <= 0) return;
        Voucher::addVoucher($email, $goldNum, $reason, $player);
    }

    public static function getPlayerName($uid, $NA = TRUE)
    {
        $db = DB::getInstance();
        $name = $db->fetchScalar("SELECT name FROM users WHERE id=$uid");
        if ($name) return $name;
        return $NA ? 'N/A' : NULL;
    }

    public static function getRandomCountryFlag()
    {
        $codes = Config::getInstance()->fakeUsersCountryCodes;
        if (!sizeof($codes)) {
            $codes = array_keys(Config::getInstance()->countryCodes);
        }
        $size = sizeof($codes);
        if ($size == 1) {
            return strtolower($codes[0]);
        }
        return strtolower($codes[mt_rand(0, $size - 1)]);
    }

    public static function getOnlineStatusAsImg($lastOnline)
    {
        if ((time() - 600) < $lastOnline) { // 0 Min - 10 Min
            $login_stat = "<img class='online online1' src=img/x.gif title='" . T("Alliance", "online now") . "' alt='" . T("Alliance", "online now") . "' />";
        } else if ((time() - 86400) < $lastOnline && (time() - 600) > $lastOnline) { // 10 Min - 1 Days
            $login_stat = "<img class='online online2' src=img/x.gif title='" . T("Alliance", "active players") . "' alt='" . T("Alliance", "active players") . "' />";
        } else if ((time() - 259200) < $lastOnline && (time() - 86400) > $lastOnline) { // 1-3 Days
            $login_stat = "<img class='online online3' src=img/x.gif title='" . T("Alliance", "active 3days") . "' alt='" . T("Alliance", "active 3days") . "' />";
        } else if ((time() - 604800) < $lastOnline && (time() - 259200) > $lastOnline) { // 3-7 Days
            $login_stat = "<img class='online online4' src=img/x.gif title='" . T("Alliance", "active 7days") . "' alt='" . T("Alliance", "active 7days") . "' />";
        } else {
            $login_stat = '<img class="online online5" src="img/x.gif" title="' . T("Alliance", "inactive") . '" alt="' . T("Alliance", "inactive") . '" />';
        }
        return $login_stat;
    }
}