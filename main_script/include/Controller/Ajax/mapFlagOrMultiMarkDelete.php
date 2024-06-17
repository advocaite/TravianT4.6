<?php

namespace Controller\Ajax;

use Core\Database\DB;
use Core\Session;
use Game\Map\Map;
use Model\AllianceModel;

class mapFlagOrMultiMarkDelete extends AjaxBase
{
    public function dispatch()
    {
        $owner = filter_var($_POST['data']['owner'], FILTER_SANITIZE_STRING);
        $dataId = (int)$_POST['data']['dataId'];
        $db = DB::getInstance();
        if ($owner == 'alliance' && !Session::getInstance()->hasAlliancePermission(AllianceModel::MANAGE_MARKS)) {
            return;
        }
        $find = $db->query("SELECT targetId, type FROM mapflag WHERE id=$dataId");
        if ($find->num_rows) {
            $row = $find->fetch_assoc();
            $searchType = $row['type'] == 0 ? 'player' : ($row['type'] == 1 ? 'alliance' : 'flag');
            if ($owner == 'alliance') {
                $db->query("DELETE FROM mapflag WHERE aid=" . Session::getInstance()->getAllianceId() . " AND id=$dataId");
            } else {
                $db->query("DELETE FROM mapflag WHERE uid=" . Session::getInstance()->getPlayerId() . " AND id=$dataId");
            }
            if ($db->affectedRows()) {
                if ($searchType != 'flag') {
                    if ($owner == 'player') {
                        Map::removeMapCacheForPlayer(Session::getInstance()->getPlayerId(),
                            $searchType,
                            $row['targetId']);
                    } else {
                        Map::removeMapCacheForAlliance(Session::getInstance()->getAllianceId(),
                            $searchType,
                            $row['targetId']);
                    }
                }
                $this->response['data']['result'] = TRUE;
            }
        }
    }
} 