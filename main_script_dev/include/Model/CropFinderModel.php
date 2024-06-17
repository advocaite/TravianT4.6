<?php

namespace Model;


use Core\Database\DB;

class CropFinderModel
{
    public function getCroplandOccupiedBy($row)
    {
        if (!$row['occupied']) {
            return '----';
        }
        $db = DB::getInstance();
        $owner = $this->getOwner($row['id']);
        if(!$owner){
            return '----';
        }
        return $db->fetchScalar("SELECT name FROM users WHERE id={$owner}");
    }

    private function getOwner($kid)
    {
        $db = DB::getInstance();
        return $db->fetchScalar("SELECT owner FROM vdata WHERE kid=$kid");
    }

    public function getAllianceTag($row)
    {
        if (!$row['occupied']) {
            return 'N/A';
        }
        $db = DB::getInstance();
        $aid = $db->fetchScalar("SELECT aid FROM users WHERE id={$this->getOwner($row['id'])}");
        if (!$aid) {
            return 'N/A';
        }
        $tag = $db->fetchScalar("SELECT tag FROM alidata WHERE id=$aid");
        if (!$tag) {
            return 'N/A';
        }
        return '<a href="allianz.php?aid=' . $aid . '">' . $tag . '</a>';
    }

    public function getTotalSize($typ, $bonus_getreide, $only_free)
    {
        $cond = [];
        $db = DB::getInstance();
        if ($typ != "all") {
            if ($typ == '9') {
                $cond[] = 'fieldtype=1';
            } else {
                $cond[] = 'fieldtype=6';
            }
        } else {
            $cond[] = '(fieldtype=1 OR fieldtype=6)';
        }
        if ($bonus_getreide != 'all') {
            $cond[] = 'crop_percent>=' . $bonus_getreide;
        }
        if ($only_free) {
            $cond[] = 'occupied=0';
        }
        if (sizeof($cond)) {
            $cond = "WHERE " . implode(" AND ", $cond);
        } else {
            $cond = '';
        }
        return $db->fetchScalar("SELECT COUNT(id) FROM wdata w  " . $cond);
    }

    public function getCroppers($page, $x, $y, $typ, $bonus_getreide, $only_free)
    {
        $cond = [];
        $db = DB::getInstance();
        if ($typ != "all") {
            if ($typ == '9') {
                $cond[] = 'fieldtype=1';
            } else {
                $cond[] = 'fieldtype=6';
            }
        } else {
            $cond[] = '(fieldtype=1 OR fieldtype=6)';
        }
        if ($bonus_getreide != 'all') {
            $cond[] = 'crop_percent>=' . $bonus_getreide;
        }
        if ($only_free) {
            $cond[] = 'occupied=0';
        }
        $pageSize = 50;
        $from = ($page - 1) * $pageSize;
        if (sizeof($cond)) {
            $cond = "WHERE " . implode(" AND ", $cond);
        } else {
            $cond = '';
        }
        $stmt = $db->query("SELECT *, SQRT(POW(w.x-$x, 2)+POW(w.y-$y, 2)) as `distance` FROM wdata w  " . $cond . " ORDER BY distance ASC LIMIT $from, $pageSize");
        return $stmt;
    }
} 