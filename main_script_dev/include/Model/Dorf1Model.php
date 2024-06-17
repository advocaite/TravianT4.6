<?php

namespace Model;

use function array_filter_units;
use Core\Database\DBI;
use PDO;
use function var_dump;

class Dorf1Model
{
    /** @var DBI */
    private $db;

    public function __construct()
    {
        $this->db = DBI::getInstance();
    }

    public function getOasesAsString($kid)
    {
        return implode(",", $this->db->fetchPluck("SELECT kid FROM odata WHERE did=?", (int)$kid));
    }

    public function getEnforcements($kid)
    {
        return $this->db->run("SELECT * FROM enforcement WHERE to_kid=?", [(int)$kid]);
    }

    public function getUnits($kid)
    {
        $units = $this->db->fetchSingleRow('SELECT * FROM units WHERE kid=?', $kid);
        if ($units) {
            $units = [
                'race'  => $units['race'],
                'units' => array_filter_units($units),
            ];
        }
        return $units;
    }

    public function getIncomingAttacksToMyOases($oasesString)
    {
        $result = ['end_time' => 0, 'count' => 0];
        if (empty($oasesString)) {
            return $result;
        }
        $sql = "SELECT COUNT(id) FROM movement WHERE to_kid IN($oasesString) AND mode=0 AND attack_type IN(3,4)";
        $result['count'] = $this->db->fetchScalar($sql);

        if ($result['count']) {
            $sql = "SELECT end_time FROM movement WHERE to_kid IN($oasesString) AND mode=0 AND attack_type IN(3,4) ORDER BY end_time ASC LIMIT 1";
            $result['end_time'] = $this->db->fetchScalar($sql);
        }
        return $result;
    }

    public function getIncomingReinforcementToMyOases($oasesString)
    {
        $result = ['end_time' => 0, 'count' => 0];

        if (empty($oasesString)) {
            return $result;
        }
        $sql = "SELECT COUNT(id) FROM movement WHERE to_kid IN($oasesString) AND mode=0 AND attack_type=2";
        $result['count'] = $this->db->fetchScalar($sql);
        if ($result['count']) {
            $sql = "SELECT end_time FROM movement WHERE to_kid IN($oasesString) AND mode=0 AND attack_type=2 ORDER BY end_time ASC LIMIT 1";
            $result['end_time'] = $this->db->fetchScalar($sql);
        }
        return $result;
    }

    public function getIncomingAttacksToMe($kid)
    {
        $result = ['end_time' => 0, 'count' => 0];

        $sql = "SELECT COUNT(id) FROM movement WHERE to_kid=? AND mode=0 AND attack_type IN(3,4) LIMIT 1";
        $result['count'] = $this->db->fetchScalar($sql, (int)$kid);
        if ($result['count']) {
            $sql = "SELECT end_time FROM movement WHERE to_kid=? AND mode=0 AND attack_type IN(3,4) ORDER BY end_time ASC LIMIT 1";
            $result['end_time'] = $this->db->fetchScalar($sql, (int)$kid);
        }
        return $result;
    }

    public function getIncomingReinforcementToMe($kid)
    {
        $result = ['end_time' => 0, 'count' => 0];

        $sql = "SELECT COUNT(id) FROM movement WHERE to_kid=? AND ((mode=0 AND attack_type=2) OR (mode=1)) LIMIT 1";
        $result['count'] = $this->db->fetchScalar($sql, (int)$kid);
        if($result['count']){
            $sql = "SELECT end_time FROM movement WHERE to_kid=? AND ((mode=0 AND attack_type=2) OR (mode=1)) ORDER BY end_time ASC LIMIT 1";
            $result['end_time'] = $this->db->fetchScalar($sql, (int)$kid);
        }
        return $result;
    }

    public function getOutgoingAttacks($kid)
    {
        $result = ['end_time' => 0, 'count' => 0];

        $sql = "SELECT COUNT(id) FROM movement WHERE kid=? AND mode=0 AND attack_type IN(3,4,1) LIMIT 1";
        $result['count'] = $this->db->fetchScalar($sql, (int)$kid);
        if ($result['count']) {
            $sql = "SELECT end_time FROM movement WHERE kid=? AND mode=0 AND attack_type IN(3,4,1) ORDER BY end_time ASC LIMIT 1";
            $result['end_time'] = $this->db->fetchScalar($sql, (int)$kid);
        }
        return $result;
    }

    public function getOutGoingReinforcements($kid)
    {
        $result = ['end_time' => 0, 'count' => 0];

        $sql = "SELECT COUNT(id) FROM movement WHERE kid=? AND mode=0 AND attack_type=2 LIMIT 1";
        $result['count'] = $this->db->fetchScalar($sql, (int)$kid);
        if ($result['count']) {
            $sql = "SELECT end_time FROM movement WHERE kid=? AND mode=0 AND attack_type=2 ORDER BY end_time ASC LIMIT 1";
            $result['end_time'] = $this->db->fetchScalar($sql, (int)$kid);
        }
        return $result;
    }

    public function getOutgoingAdventure($kid)
    {
        $result = ['end_time' => 0, 'count' => 0];

        $sql = "SELECT COUNT(id) FROM movement WHERE kid=? AND mode=0 AND attack_type=7 LIMIT 1";
        $result['count'] = $this->db->fetchScalar($sql, (int)$kid);
        if($result['count']){
            $sql = "SELECT end_time FROM movement WHERE kid=? AND mode=0 AND attack_type=7 ORDER BY end_time ASC LIMIT 1";
            $result['end_time'] = $this->db->fetchScalar($sql, (int)$kid);
        }
        return $result;
    }

    public function getOutgoingEvasion($kid)
    {
        $result = ['end_time' => 0, 'count' => 0];

        $sql = "SELECT COUNT(id) FROM movement WHERE kid=? AND mode=0 AND attack_type=6 LIMIT 1";
        $result['count'] = $this->db->fetchScalar($sql, (int)$kid);
        if ($result['count']) {
            $sql = "SELECT end_time FROM movement WHERE kid=? AND mode=0 AND attack_type=6 ORDER BY end_time ASC LIMIT 1";
            $result['end_time'] = $this->db->fetchScalar($sql, (int)$kid);
        }
        return $result;
    }

    public function getOutgoingSettlers($kid)
    {
        $result = ['end_time' => 0, 'count' => 0];
        $sql = "SELECT COUNT(id) FROM movement WHERE kid=? AND mode=0 AND attack_type=5 LIMIT 1";
        $result['count'] = $this->db->fetchScalar($sql, (int)$kid);
        if ($result['count']) {
            $sql = "SELECT end_time FROM movement WHERE kid=? AND mode=0 AND attack_type=5 ORDER BY end_time ASC LIMIT 1";
            $result['end_time'] = $this->db->fetchScalar($sql, (int)$kid);
        }
        return $result;
    }
}