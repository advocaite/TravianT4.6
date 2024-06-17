<?php

namespace Model;

use Core\Caching\Caching;
use Core\Config;
use Core\Database\DB;
use Core\Helper\StringChecker;
use Core\Session;
use Game\Formulas;
use Game\NoticeHelper;

class ProfileModel
{
    public function getPlayer($uid, $cols = '*')
    {
        $db = DB::getInstance();
        $find = $db->query("SELECT $cols FROM users WHERE id=$uid");
        if ($find->num_rows) {
            return $find->fetch_assoc();
        }
        return [];
    }

    public function getPlayerTotalVillagesAndPop($uid)
    {
        $db = DB::getInstance();
        return $db->query("SELECT total_pop, total_villages village_count FROM users WHERE id=$uid")->fetch_assoc();
    }

    public function getHeroHash($uid)
    {
        $db = DB::getInstance();
        return sha1($db->fetchScalar("SELECT lastupdate FROM inventory WHERE uid=$uid"));
    }

    public function getPlayerVillages($uid, $byName = FALSE)
    {
        $db = DB::getInstance();
        if ($byName) {
            return $db->query("SELECT kid, name, owner, isWW, pop, capital FROM vdata WHERE owner=$uid ORDER BY name");
        }
        return $db->query("SELECT kid, name, owner, isWW, pop, capital FROM vdata WHERE owner=$uid ORDER BY pop DESC");
    }

    public function updateProfile($uid, $desc1, $desc2, $birthday, $gender, $location, $showCountryFlag, $showMedals)
    {
        $desc1 = filter_var($desc1, FILTER_SANITIZE_STRING);
        $desc2 = filter_var($desc2, FILTER_SANITIZE_STRING);
        $birthday = filter_var($birthday, FILTER_SANITIZE_STRING);
        $location = filter_var($location, FILTER_SANITIZE_STRING);
        if (!StringChecker::isValidMessage($desc1) || !StringChecker::isValidMessage($desc2) || !StringChecker::isValidName($location)) {
            return;
        }
        $showCountryFlag = $showCountryFlag == 1 ? 1 : 0;
        $showMedals = $showMedals == 1 ? 1 : 0;
        if (strlen($location) >= 30) {
            return;
        }
        $gender = filter_var((int)$gender, FILTER_SANITIZE_NUMBER_INT);
        $db = DB::getInstance();
        $desc1 = $db->real_escape_string(htmlspecialchars($desc1, ENT_QUOTES));
        $desc2 = $db->real_escape_string(htmlspecialchars($desc2, ENT_QUOTES));
        $location = $db->real_escape_string(htmlspecialchars($location, ENT_QUOTES));
        $db->query($q = "UPDATE users SET desc1='$desc1', desc2='$desc2', birthday='$birthday', gender=$gender, location='$location', showMedals=$showMedals, showCountryFlag=$showCountryFlag WHERE id=$uid");
    }

    public function updateVillageName($kid, $name)
    {
        $name = clean_string_from_white(filter_var($name, FILTER_SANITIZE_STRING));
        if (!StringChecker::isValidName($name)) {
            return;
        } else if (strlen($name) > 45) {
            return;
        }
        $db = DB::getInstance();
        $kid = (int)$kid;
        $find = $db->query("SELECT name, owner FROM vdata WHERE kid=$kid");
        if ($find->num_rows) {
            $row = $find->fetch_assoc();
            if ($row['owner'] == Session::getInstance()->getPlayerId() && $row['name'] != $name) {
                $quest = Quest::getInstance();
                $quest->setQuestBitwise("world", 2, 1);
                $name = $db->real_escape_string(htmlspecialchars($name, ENT_QUOTES));
                $db->query("UPDATE vdata SET name='$name' WHERE kid=$kid");
                $xy = Formulas::kid2xy($kid);
                NoticeHelper::addSurrounding($xy['x'],
                    $xy['y'],
                    NoticeHelper::SURROUNDING_VILLAGE_RENAME,
                    [
                        Session::getInstance()->getPlayerId(),
                        Session::getInstance()->getName(),
                        $kid,
                        $row['name'],
                        $name,
                    ],
                    time());
                Quest::getInstance()->setQuestBitwise('world', 2, \Model\Quest::QUEST_FINISHED);
                Caching::getInstance()->delete("ActiveVillageBox:{$kid}");
            }
        }
    }

    public function getVillageOases($kid)
    {
        $db = DB::getInstance();
        return $db->query("SELECT type FROM odata WHERE did=$kid");
    }

    public function isThereAnArtifact($kid)
    {
        if (!Config::getInstance()->dynamic->ArtifactsReleased) {
            return FALSE;
        }
        $db = DB::getInstance();
        return $db->fetchScalar("SELECT COUNT(id) FROM artefacts WHERE kid=$kid") > 0;
    }
}