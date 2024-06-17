<?php

namespace Controller\Ajax\autocomplete;

use Controller\Ajax\AjaxBase;
use Core\Database\DB;
use Core\Session;
use Core\Village;
use Game\Formulas;
use function array_values;

class playername extends AjaxBase
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
        $this->response = array_values(array_unique($this->response));
    }

    public function search($search)
    {
        $this->response = [];
        $db = DB::getInstance();
        switch ($_POST['context']) {
            case 'villagename':
                $kid = Village::getInstance()->getKid();
                $autoComplete = Session::getInstance()->getAutoComplete();
                $owner = Session::getInstance()->getPlayerId();
                if ($autoComplete[0]) {
                    $villages = $db->query("SELECT kid, name, owner FROM vdata WHERE owner={$owner} AND kid!=$kid AND name LIKE '%{$search}%' LIMIT " . self::AUTO_COMPLETE_LIMIT);
                    while ($row = $villages->fetch_assoc()) {
                        $this->response[] = $row['name'];
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
                        $this->response[] = $row['name'];
                    }
                }
                if ($autoComplete[2]) {
                    $aid = Session::getInstance()->getAllianceId();
                    if ($aid) {
                        $villages = $db->query("SELECT kid, name, owner FROM vdata v WHERE (SELECT aid FROM users WHERE id=v.owner)=$aid AND owner != $owner AND kid!=$kid AND name LIKE '%{$search}%' LIMIT " . self::AUTO_COMPLETE_LIMIT);
                        while ($row = $villages->fetch_assoc()) {
                            $this->response[] = $row['name'];
                        }
                    }
                }
                break;
			case 'messageRecipient':
            case 'username':
                $users = $db->query("SELECT name FROM users WHERE name LIKE '%{$search}%' LIMIT " . self::AUTO_COMPLETE_LIMIT);
                while ($row = $users->fetch_assoc()) {
                    $this->response[] = $row['name'];
                }
                break;
        }
    }
} 