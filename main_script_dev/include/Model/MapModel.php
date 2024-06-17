<?php

namespace Model;

use Core\Database\DB;

class MapModel
{
    public function addTileBlocks(array $kidBatchAdd)
    {
        if (!sizeof($kidBatchAdd)) {
            return;
        }
        $db = DB::getInstance();
        $db->query("INSERT IGNORE INTO blocks (kid, map_id) VALUES " . implode(",", $kidBatchAdd));
    }

    public function addTileMarks(array $kidBatchAdd)
    {
        if (!sizeof($kidBatchAdd)) {
            return;
        }
        $db = DB::getInstance();
        $db->query("INSERT IGNORE INTO marks (kid, map_id) VALUES " . implode(",", $kidBatchAdd));
    }

    public function getMapMark($tx0, $ty0, $tx1, $ty1, $uid, $zoomLevel = 1, $insert = TRUE)
    {
        $db = DB::getInstance();
        $result = $db->query("SELECT id, version FROM map_mark WHERE uid=$uid AND tx0=$tx0 AND ty0=$ty0 AND tx1=$tx1 AND ty1=$ty1");
        if ($result->num_rows) {
            $result = $result->fetch_row();
            $result = [$result[0], $result[1], FALSE];

            return $result;
        }
        if ($insert) {
            $db->query("INSERT INTO map_mark (uid, tx0, ty0, tx1, ty1, zoomLevel) VALUES ($uid, $tx0, $ty0, $tx1, $ty1, $zoomLevel)");

            return [$db->lastInsertId(), 0, TRUE];
        }

        return FALSE;
    }

    public function getMapBlock($tx0, $ty0, $tx1, $ty1, $zoomLevel = 1, $insert = TRUE)
    {
        $tx0 = (int)$tx0;
        $ty0 = (int)$ty0;
        $tx1 = (int)$tx1;
        $ty1 = (int)$ty1;
        $db = DB::getInstance();
        $result = $db->query("SELECT id, version FROM map_block WHERE tx0=$tx0 AND ty0=$ty0 AND tx1=$tx1 AND ty1=$ty1");
        if ($result->num_rows) {
            $result = $result->fetch_row();
            $result = [$result[0], $result[1], FALSE];

            return $result;
        }
        if ($insert) {
            $db->query("INSERT INTO map_block (tx0, ty0, tx1, ty1, zoomLevel) VALUES ($tx0, $ty0, $tx1, $ty1, $zoomLevel)");
            return [$db->lastInsertId(), 0, TRUE];
        }
        return FALSE;
    }

    public function getNearMapBlocksWithVersion($x, $y, $zoomLevel = 1)
    {
        $db = DB::getInstance();
        $rate = $zoomLevel == 1 ? 9 : ($zoomLevel == 2 ? 19 : 119);

        return $db->query("SELECT * FROM map_block WHERE zoomLevel=$zoomLevel AND tx0 >= $x-(3*$rate) AND ty0 >= $y - (3*$rate) AND tx1 <= $x + (3*$rate) AND ty1 <= $y + (3*$rate)");
    }

    public function updateMapBlockVersionWhereKidIsIn($kid, $zoomLevel = 0)
    {
        $db = DB::getInstance();
        $find = $db->query("SELECT map_id FROM blocks WHERE kid=$kid ORDER BY map_id DESC");
        while ($map_id = $find->fetch_assoc()) {
            $map_id = $map_id['map_id'];
            if ($zoomLevel == 0) {
                $db->query("UPDATE map_block SET version=version+1 WHERE id=$map_id");
            } else {
                $db->query("UPDATE map_block SET version=version+1 WHERE id=$map_id AND zoomLevel<=$zoomLevel");
            }
        }
    }

    public function updateMapMarkVersionWhereKidIsIn($kid, $zoomLevel = 0)
    {
        $db = DB::getInstance();
        $find = $db->query("SELECT map_id FROM marks WHERE kid=$kid");
        while ($map_id = $find->fetch_assoc()) {
            $map_id = $map_id['map_id'];
            if ($zoomLevel == 0) {
                $db->query("UPDATE map_mark SET version=version+1 WHERE id=$map_id");
            } else {
                $db->query("UPDATE map_mark SET version=version+1 WHERE id=$map_id AND zoomLevel<=$zoomLevel");
            }
        }
    }

    public function updateBatchAllianceMarks($kid, $allianceMembers)
    {
        $db = DB::getInstance();
        $find = $db->query("SELECT map_id FROM marks WHERE kid=$kid");
        while ($map_id = $find->fetch_assoc()) {
            $map_id = $map_id['map_id'];
            $db->query("UPDATE map_mark SET version=version+1 WHERE uid IN($allianceMembers) AND id=$map_id");
        }
    }

    public function updateMapMarkVersionWhereKidAndUidIsIn($uid, $kid, $zoomLevel = 0)
    {
        $db = DB::getInstance();
        $find = $db->query("SELECT map_id FROM marks WHERE kid=$kid");
        while ($map_id = $find->fetch_assoc()) {
            $map_id = $map_id['map_id'];
            if ($zoomLevel == 0) {
                $db->query("UPDATE map_mark SET version=version+1 WHERE id=$map_id AND uid=$uid");
            } else {
                $db->query("UPDATE map_mark SET version=version+1 WHERE id=$map_id AND uid=$uid AND zoomLevel<=$zoomLevel");
            }
        }
    }
}