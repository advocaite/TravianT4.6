<?php

namespace Controller\Ajax;

use Core\Database\DB;
use Core\Session;
use Game\Map\Map;

class mapSetting extends AjaxBase
{
    public function dispatch()
    {
        if (!Session::getInstance()->isValid()) {
            return;
        }
        $mapMarkSettings = explode(",", Session::getInstance()->getMapSettings());
        $mapMarkSettings = [
            "ownMarks" => $mapMarkSettings[0] == 1,
            "allianceMarks" => $mapMarkSettings[1] == 1
                && Session::getInstance()->getAllianceId(),
        ];
        $data = $_POST['data'];
        if ($data['type'] === 'outline' && $data['outline'] == 'user') {
            $mapMarkSettings['ownMarks'] = $mapMarkSettings['ownMarks'] == 1 ? 0 : 1;
            $this->response['data']['result'] = (bool)$mapMarkSettings['ownMarks'];
            Map::switchOnOffMarks(Session::getInstance()->getPlayerId(), Session::getInstance()->getAllianceId(), 0);
            $db = DB::getInstance();
            $db->query("UPDATE users SET mapMarkSettings='" . implode(",",
                    $mapMarkSettings) . "' WHERE id=" . Session::getInstance()->getPlayerId());
        } else if ($data['type'] === 'outline' && $data['outline'] == 'alliance') {
            $mapMarkSettings['allianceMarks'] = $mapMarkSettings['allianceMarks'] == 1 ? 0 : 1;
            $mapMarkSettings['allianceMarks'] = $mapMarkSettings['allianceMarks']
            && Session::getInstance()->getAllianceId() ? 1 : 0;
            $this->response['data']['result'] = (bool)$mapMarkSettings['allianceMarks'];
            Map::switchOnOffMarks(Session::getInstance()->getPlayerId(), Session::getInstance()->getAllianceId(), 1);
            $db = DB::getInstance();
            $db->query("UPDATE users SET mapMarkSettings='" . implode(",",
                    $mapMarkSettings) . "' WHERE id=" . Session::getInstance()->getPlayerId());
        } else {
            $this->response['data']['result'] = FALSE;
        }
    }
} 