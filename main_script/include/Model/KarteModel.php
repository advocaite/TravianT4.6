<?php

namespace Model;

use Core\Database\DB;
use Game\Formulas;

class KarteModel
{
    public function getAdventures($uid)
    {
        $db = DB::getInstance();

        return $db->query("SELECT * FROM adventure WHERE uid=$uid AND end=0 AND time>=" . time());
    }

    public function getMapTileByCoordinates($x, $y)
    {
        $kid = Formulas::xy2kid($x, $y);
        $db = DB::getInstance();

        return $db->query("SELECT * FROM wdata WHERE id=$kid LIMIT 1")->fetch_assoc();
    }

    public function getVillageOasesIds($kid)
    {
        $db = DB::getInstance();
        $result = $db->query("SELECT kid FROM odata WHERE did=$kid");
        $return = [];
        while ($row = $result->fetch_assoc()) {
            $return[] = $row['kid'];
        }

        return $return;
    }

    public function getPlayerAccesses($uid)
    {
        $db = DB::getInstance();
        return $db->fetchScalar("SELECT access FROM users WHERE id=$uid");
    }

    public function hasBeginnerProtection($kid)
    {
        $db = DB::getInstance();
        $protectionUntil = (int)$db->fetchScalar("SELECT users.protection FROM users, vdata WHERE users.id=vdata.owner AND vdata.kid=$kid LIMIT 1");
        if ($protectionUntil < time()) {
            return 0;
        }
        return $protectionUntil;
    }

    public function isInVacation($kid)
    {
        $db = DB::getInstance();
        $protect = $db->query("SELECT users.vacationActiveTil FROM users, vdata WHERE users.id=vdata.owner AND vdata.kid=$kid LIMIT 1")->fetch_assoc()['vacationActiveTil'];
        if ($protect >= time()) {
            return $protect;
        }

        return FALSE;
    }

    public function checkForAdventure($uid, $kid)
    {
        $db = DB::getInstance();

        return $db->fetchScalar("SELECT COUNT(id) FROM adventure WHERE end=0 AND time >= " . time() . " AND uid=$uid AND kid=$kid");
    }

    public function getOasisInfo($kid, $columns = '*')
    {
        $db = DB::getInstance();
        $find = $db->query("SELECT $columns FROM odata WHERE kid=$kid");
        if (!$find->num_rows) {
            return [];
        }

        return $find->fetch_assoc();
    }

    public function getVillageInfo($kid, $columns = '*')
    {
        $db = DB::getInstance();
        $find = $db->query("SELECT $columns FROM vdata WHERE kid=$kid");
        if (!$find->num_rows) {
            return [];
        }

        return $find->fetch_assoc();
    }

    public function getDoneAdventuresCount($uid)
    {
        $db = DB::getInstance();

        return $db->fetchScalar("SELECT COUNT(id) FROM adventure WHERE uid=$uid AND end=1");
    }

    public function getWholeMapMarks($uid, $aid, $mode = -1, $noFlag = FALSE)
    {
        $db = DB::getInstance();
        if ($mode == 0) {
            return $db->query("SELECT * FROM mapflag WHERE uid=$uid " . ($noFlag ? 'AND type!=2' : ''));
        } else if ($mode == 1) {
            return $db->query("SELECT * FROM mapflag WHERE uid=0 AND aid=$aid " . ($noFlag ? 'AND type!=2' : ''));
        }

        return $db->query("SELECT * FROM mapflag WHERE (uid=$uid OR (aid=$aid AND $aid>0)) " . ($noFlag ? 'AND type!=2' : ''));
    }

    public function getWholeMapMarksForKid($kid, $uid, $aid, $mode = -1, $noFlag = FALSE)
    {
        $db = DB::getInstance();
        if ($mode == 0) {
            return $db->query("SELECT * FROM mapflag WHERE kid=$kid AND uid=$uid " . ($noFlag ? 'AND type!=2' : ''));
        } else if ($mode == 1) {
            return $db->query("SELECT * FROM mapflag WHERE kid=$kid AND uid=0 AND aid=$aid AND aid>0 " . ($noFlag ? 'AND type!=2' : ''));
        }

        return $db->query("SELECT * FROM mapflag WHERE kid=$kid AND (uid=$uid OR (uid=0 AND aid=$aid AND aid>0)) " . ($noFlag ? 'AND type!=2' : ''));
    }

    public function getPlayerName($uid)
    {
        $db = DB::getInstance();
        return $db->fetchScalar("SELECT name FROM users WHERE id=" . (int)$uid);
    }

    public function getAllianceTag($aid)
    {
        $db = DB::getInstance();
        return $db->fetchScalar("SELECT tag FROM alidata WHERE id=" . (int)$aid);
    }

    public function getVillageName($kid)
    {
        $db = DB::getInstance();
        return $db->fetchScalar("SELECT name FROM vdata WHERE kid=$kid");
    }

    public function getVillagePop($kid)
    {
        $db = DB::getInstance();
        return $db->fetchScalar("SELECT pop FROM vdata WHERE kid=$kid");
    }

    public function getPlayerTribe($uid)
    {
        $db = DB::getInstance();
        return $db->fetchScalar("SELECT race FROM users WHERE id=" . (int)$uid);
    }

    public function getPlayerAllianceId($uid)
    {
        $db = DB::getInstance();
        return $db->fetchScalar("SELECT aid FROM users WHERE id=" . (int)$uid);
    }

    public function getVillageOwner($kid)
    {
        $db = DB::getInstance();
        return $db->fetchScalar("SELECT owner FROM vdata WHERE kid=$kid");
    }

    public function getOasisOwner($kid)
    {
        $db = DB::getInstance();
        return $db->fetchScalar("SELECT owner FROM odata WHERE kid=$kid");
    }
}