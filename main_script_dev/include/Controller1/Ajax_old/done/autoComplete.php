<?php

namespace Controller\Ajax;

use Core\Database\DB;
use Core\Session;
use Core\Village;
use Game\Formulas;
use function array_values;

class autoComplete extends AjaxBase
{
    const AUTO_COMPLETE_LIMIT = 10;

    public function dispatch()
    {
        $db = DB::getInstance();
        if (is_array($_POST['search'])) {
            foreach ($_POST['search'] as $str) {
                $str = $db->real_escape_string(filter_var(htmlspecialchars($str, ENT_QUOTES), FILTER_SANITIZE_STRING));
                $this->search($str);
            }
        } else {
            $str = $_POST['search'];
            $str = $db->real_escape_string(filter_var(htmlspecialchars($str, ENT_QUOTES), FILTER_SANITIZE_STRING));
            $this->search($str);
        }
        $this->response['data'] = array_values(array_unique($this->response['data']));
    }

    public function search($search)
    {
        $this->response['data'] = [];
        $db = DB::getInstance();
        switch ($_POST['type']) {
            case 'villagename':
                $kid = Village::getInstance()->getKid();
                $autoComplete = Session::getInstance()->getAutoComplete();
                $owner = Session::getInstance()->getPlayerId();
                if ($autoComplete[0]) {
                    $villages = $db->query("SELECT kid, name, owner FROM vdata WHERE owner={$owner} AND kid!=$kid AND name LIKE '%{$search}%' LIMIT " . self::AUTO_COMPLETE_LIMIT);
                    while ($row = $villages->fetch_assoc()) {
                        $this->response['data'][] = $row['name'];
                    }
                }
                if ($autoComplete[1]) {
                    {
                        $mapSize = MAP_SIZE;
                        $totalCoordinate = 1 + (2 * $mapSize);
                        $totalCoordinate2 = 1 + (3 * $mapSize);
                        $xy = Formulas::kid2xy(Session::getInstance()->getKid());
                        $distance = "SQRT(POW(((w.x-{$xy['x']}+$totalCoordinate2)%{$totalCoordinate} -$mapSize), 2) + POW(((w.y-{$xy['y']}+$totalCoordinate2)%{$totalCoordinate} -$mapSize), 2))";
                    }
                    $villages = $db->query("SELECT kid, name, owner FROM vdata v, wdata w WHERE v.kid=w.id AND owner != $owner AND kid!=$kid AND $distance <= 20 AND name LIKE '%{$search}%' LIMIT " . self::AUTO_COMPLETE_LIMIT);
                    while ($row = $villages->fetch_assoc()) {
                        $this->response['data'][] = $row['name'];
                    }
                }
                if ($autoComplete[2]) {
                    $aid = Session::getInstance()->getAllianceId();
                    if ($aid) {
                        $villages = $db->query("SELECT kid, name, owner FROM vdata v WHERE (SELECT aid FROM users WHERE id=v.owner)=$aid AND owner != $owner AND kid!=$kid AND name LIKE '%{$search}%' LIMIT " . self::AUTO_COMPLETE_LIMIT);
                        while ($row = $villages->fetch_assoc()) {
                            $this->response['data'][] = $row['name'];
                        }
                    }
                }
                break;
            case 'username':
                $users = $db->query("SELECT name FROM users WHERE name LIKE '%{$search}%' LIMIT " . self::AUTO_COMPLETE_LIMIT);
                while ($row = $users->fetch_assoc()) {
                    $this->response['data'][] = $row['name'];
                }
                break;
        }
    }
} 