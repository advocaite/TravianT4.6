<?php
/**
 * Created by PhpStorm.
 * User: Amirhossein CH
 * Date: 9/21/14
 * Time: 10:41 PM
 */

namespace Model;

use Core\Config;
use Core\Database\DB;
use Core\Helper\TimezoneHelper;
use Game\Formulas;
use Game\ResourcesHelper;

class MarketModel
{
    public function getOnTheWayMerchantsCount($kid, $merchant_cap)
    {
        $db = DB::getInstance();
        return ceil($db->fetchScalar("SELECT SUM(CEIL((wood+clay+iron+crop) / $merchant_cap)) FROM send WHERE (kid=$kid AND mode=0) OR (to_kid=$kid AND mode=1)"));
    }

    public function deleteOffer($id)
    {
        $db = DB::getInstance();
        $q = $db->query("DELETE FROM market WHERE id=$id");
        return $q && $db->affectedRows();
    }

    public function getOffer($id)
    {
        $db = DB::getInstance();
        $row = $db->query("SELECT * FROM market WHERE id=$id");
        if ($row->num_rows) {
            return $row->fetch_assoc();
        }

        return FALSE;
    }

    public function getOfferingMerchantsCount($kid, $merchant_cap)
    {
        $db = DB::getInstance();
        return ceil($db->fetchScalar("SELECT SUM(CEIL(giveValue / $merchant_cap)) FROM market WHERE kid=$kid"));
    }

    public function getReturningMerchants($kid)
    {
        $db = DB::getInstance();

        return $db->query("SELECT * FROM send WHERE mode=1 AND to_kid=$kid ORDER BY end_time ASC");
    }

    public function getOutGoingMerchants($kid)
    {
        $db = DB::getInstance();

        return $db->query("SELECT * FROM send WHERE mode=0 AND kid=$kid ORDER BY end_time ASC");
    }

    public function getIncomingMerchants($kid)
    {
        $db = DB::getInstance();

        return $db->query("SELECT * FROM send WHERE mode=0 AND to_kid=$kid ORDER BY end_time ASC");
    }

    public function getTradeRoutes($kid, $sortId, $reverse)
    {
        $db = DB::getInstance();
        $sortKey = $sortId == 1 ? 'v.name' : ($sortId == 2 ? 't.start_hour' : 't.enabled');
        $sortBy = $reverse ? 'DESC' : 'ASC';
        return $db->query("SELECT t.*, v.name  FROM traderoutes t, vdata v WHERE t.kid=$kid AND v.kid=t.to_kid ORDER BY $sortKey $sortBy");
    }

    public function getTradeRouteVillage($aid, $owner, $kid, $destination)
    {
        $db = DB::getInstance();
        $al = [-1];
        if ($aid && $destination != "only-mine") {
            $diplos = $db->query("SELECT aid1, aid2 FROM diplomacy WHERE (aid1=$aid OR aid2=$aid) AND accepted<>0");
            $al[] = $aid;
            while ($row = $diplos->fetch_assoc()) {
                $al[] = $row['aid1'];
                $al[] = $row['aid2'];
            }
        }
        $aidArray = implode(",", array_unique($al));
        switch ($destination) {
            case 'all':
                return $db->query("SELECT kid, name FROM vdata v WHERE (owner=$owner OR ((isWW=1 OR (SELECT COUNT(id) FROM artefacts WHERE kid=v.kid) > 0) AND (SELECT aid FROM users WHERE id=v.owner) IN ($aidArray))) AND kid!=$kid");
                break;
            case 'only-mine':
                return $db->query("SELECT kid, name FROM vdata v WHERE owner=$owner AND kid != $kid");
                break;
            case 'others':
                return $db->query("SELECT kid, name FROM vdata v WHERE (owner!=$owner AND ((isWW=1 OR (SELECT COUNT(id) FROM artefacts WHERE kid=v.kid) > 0) AND (SELECT aid FROM users WHERE id=v.owner) IN ($aidArray))) AND kid!=$kid");
                break;
        }
    }

    public function getIncomingTradeRoute($kid)
    {
        $db = DB::getInstance();
        $find = $db->query("SELECT start_hour, r1, r2, r3, r4, time FROM traderoutes WHERE kid=$kid AND enabled=1 ORDER BY time ASC, (r1+r2+r3+r4) DESC LIMIT 1");
        if ($find->num_rows) {
            return $find->fetch_assoc();
        }
        return FALSE;
    }

    public function addOffer($kid, $aid, $hours, $needType, $needValue, $giveType, $giveValue)
    {
        $rate = round($needValue / $giveValue, 1);
        $xy = Formulas::kid2xy($kid);
        $maxtime = $hours * 3600;
        $db = DB::getInstance();
        $db->query("INSERT INTO market (aid, kid, x, y, rate, needType, needValue, giveType, giveValue, maxtime) VALUES ($aid, $kid, {$xy['x']}, {$xy['y']}, '$rate', $needType, $needValue, $giveType, $giveValue, $maxtime) ");
    }

    public function renderMovement($my_kid, $row)
    {
        //0 => return | 1 => onComing | 2 => OnGoing
        $kid = $row['to_kid'];
        if ($my_kid == $row['kid'] && $row['mode'] == 0) {
            //sending
            $text = T("MarketPlace", "sendToVillage");
        } else if ($my_kid == $row['to_kid'] && $row['mode'] == 1) {
            $kid = $row['kid'];
            //return
            $text = T("MarketPlace", "returnFromVillage");
        } else {
            $kid = $row['kid'];
            $text = T("MarketPlace", "receiveFromVillage");
        }
        $uid = $this->getVillageOwner($kid);
        $playerName = $this->getPlayerRaceAndName($uid)['name'];
        $name = $this->getVillageName($kid);
        $HTML = '<table class="traders" cellpadding="1" cellspacing="1"><thead>';
        $HTML .= '<tr>';
        $HTML .= '<td><a href="spieler.php?uid=' . $uid . '">' . $playerName . '</a></td>';
        $HTML .= '<td class="dorf">' . $text . ' <a href="karte.php?d=' . $kid . '">' . $name . '</a></td>';
        $HTML .= '</tr></thead>';
        $HTML .= '<tbody><tr>';
        $HTML .= '<th>' . T("MarketPlace", "Arrival") . '</th>';
        $HTML .= '<td><div class="in">' . T("MarketPlace",
                "in") . ' ' . appendTimer($row['end_time'] - time()) . ' ' . T("MarketPlace",
                "hour") . '.</div><div class="at">' . ' ' . T("MarketPlace", "at") . ' ' . TimezoneHelper::date("H:i",
                $row['end_time']) . '</div></td>';
        $HTML .= '</tr>';
        $HTML .= '<tr class="res"><th>' . T("inGame", "resources.resources") . '</th><td colspan="1">';
        $HTML .= '<span class="' . ($row['mode'] == 1 ? 'none' : '') . '">
        ' . ($row['x'] > 1 ? '<div class="repeat">‎‭‭' . $row['x'] . '&times;‬‎</div>' : '') . '</span>';

        $HTML .= <<<HTML
<div class="inlineIconList resourceWrapper">
<div class="inlineIcon resources" title=""><i class="r1"></i><span class="value ">{$row['wood']}</span></div>
<div class="inlineIcon resources" title=""><i class="r2"></i><span class="value ">{$row['clay']}</span></div>
<div class="inlineIcon resources" title=""><i class="r3"></i><span class="value ">{$row['iron']}</span></div>
<div class="inlineIcon resources" title=""><i class="r4"></i><span class="value ">{$row['crop']}</span></div>
</div>
HTML;
        $HTML .= '</td></tr></tbody></table>';
        return $HTML;
    }

    public function getVillageOwner($kid)
    {
        $db = DB::getInstance();
        return (int)$db->fetchScalar("SELECT owner FROM vdata WHERE kid=$kid");
    }

    public function getPlayerRaceAndName($uid)
    {
        $db = DB::getInstance();
        $find = $db->query("SELECT name, race FROM users WHERE id=$uid");
        if ($find->num_rows) {
            return $find->fetch_assoc();
        }

        return [];
    }

    public function getVillageName($kid, $HTML = TRUE)
    {
        $db = DB::getInstance();
        $find = $db->fetchScalar("SELECT name FROM vdata WHERE kid=$kid");
        if ($find) {
            if (!$HTML) {
                return $find;
            }
            return '<a href="karte.php?d=' . $kid . '">' . $find . '</a>';
        }
        if (!$HTML) {
            return '';
        }
        return '<span class="errorMessage">[?]</span>';
    }

    public function cancelAllOffers($kid)
    {
        $db = DB::getInstance();
        $res = array_fill(0, 4, 0);
        $offer = $db->query("SELECT giveType, giveValue FROM market WHERE kid=$kid");
        while ($row = $offer->fetch_assoc()) {
            $res[$row['giveType'] - 1] += $row['giveValue'];
        }
        $db->query("DELETE FROM market WHERE kid=$kid");
        $db->query("UPDATE vdata SET wood=wood+{$res[0]}, clay=clay+{$res[1]}, iron=iron+{$res[2]}, crop=crop+{$res[3]} WHERE kid=$kid");
    }

    public function cancelAllOffersForAlliance($uid)
    {
        $db = DB::getInstance();
        $offer = $db->query("SELECT m.id, m.kid, m.giveType, m.giveValue FROM market m, vdata v WHERE v.owner=$uid AND v.kid=m.kid AND m.aid>0");
        while ($row = $offer->fetch_assoc()) {
            $res = array_fill(0, 4, 0);
            $res[$row['giveType'] - 1] += $row['giveValue'];
            $db->query("DELETE FROM market WHERE id={$row['id']}");
            $db->query("UPDATE vdata SET wood=wood+{$res[0]}, clay=clay+{$res[1]}, iron=iron+{$res[2]}, crop=crop+{$res[3]} WHERE kid={$row['kid']}");
        }
    }

    public function cancelOffer($kid, $id)
    {
        $db = DB::getInstance();
        $offer = $db->query("SELECT giveType, giveValue FROM market WHERE kid=$kid AND id=$id");
        if ($offer->num_rows) {
            $offer = $offer->fetch_assoc();
            $res = array_fill(0, 4, 0);
            $query = $db->query("DELETE FROM market WHERE id=$id");
            if ($query && $db->affectedRows()) {
                $res[$offer['giveType'] - 1] += $offer['giveValue'];
                return $res;
            }
        }

        return array_fill(0, 4, 0);
    }

    public function getOwnOffers($kid)
    {
        $db = DB::getInstance();

        return $db->query("SELECT * FROM market WHERE kid=$kid");
    }

    public function getVillageResources($kid)
    {
        ResourcesHelper::updateVillageResources($kid);
        $db = DB::getInstance();
        $find = $db->query("SELECT wood, clay, iron, crop FROM vdata WHERE kid=$kid");
        if ($find->num_rows) {
            $row = $find->fetch_assoc();

            return [
                1 => $row['wood'],
                2 => $row['clay'],
                3 => $row['iron'],
                4 => max($row['crop'], 0),
            ];
        }

        return [];
    }

    public function toggleTradeRoute($kid, $trid, $enabled)
    {
        $db = DB::getInstance();
        $enabled = $enabled == 1 ? 1 : 0;

        $stmt = $db->query("SELECT * FROM traderoutes WHERE kid=$kid AND id=$trid");

        if (!$stmt->num_rows) {
            return;
        }
        $result = $stmt->fetch_assoc();

        $usePeriodicTradeRoutes = Config::getInstance()->game->usePeriodicTradeRoutes;
        if ($usePeriodicTradeRoutes) {
            $time = time() + $result['start_hour'];
        } else {
            if (date("H") < $result['start_hour']) {
                $time = strtotime("today {$result['start_hour']}:00");
            } else {
                $time = strtotime("tomorrow {$result['start_hour']}:00");
            }
        }
        $db->query("UPDATE traderoutes SET enabled=$enabled, time=$time WHERE kid=$kid AND id=$trid");
    }

    public function sendResources($kid, $to_kid, $race, $r1, $r2, $r3, $r4, $repeat, $time = -1)
    {
        if ($time == -1) {
            $time = time();
        }
        $speed = Formulas::merchantSpeed($race);
        $time = $time + round(Formulas::getDistance($kid, $to_kid) / $speed * 3600);
        $db = DB::getInstance();
        $db->query("INSERT INTO send (kid, to_kid, wood, clay, iron, crop, x, mode, end_time) VALUES ($kid, $to_kid,$r1, $r2, $r3, $r4, $repeat,0,$time)");
    }

    public function getPlayerRace($uid)
    {
        $db = DB::getInstance();
        return (int)$db->fetchScalar("SELECT race FROM users WHERE id=$uid");
    }

    public function isPlayerBanned($uid)
    {
        $db = DB::getInstance();
        $access = $db->fetchScalar("SELECT access FROM users WHERE kid=$uid");
        if ($access !== false) {
            return $access == 0;
        }
        return TRUE;
    }

    public function getPlayerRow($uid, $col = '*')
    {
        $db = DB::getInstance();
        $find = $db->query("SELECT $col FROM users WHERE id=$uid");
        if ($find->num_rows) {
            return $find->fetch_assoc();
        }

        return [];
    }

    public function isThereAnArtifact($kid)
    {
        if (!Config::getInstance()->dynamic->ArtifactsReleased) {
            return FALSE;
        }
        $db = DB::getInstance();
        return $db->fetchScalar("SELECT COUNT(id) FROM artefacts WHERE kid=$kid") > 0;
    }

    public function isVillageMine($kid, $aid, $uid, $destination)
    {
        $db = DB::getInstance();
        $al = [-1];
        if ($aid && $destination != "only-mine") {
            $diplos = $db->query("SELECT aid1, aid2 FROM diplomacy WHERE (aid1=$aid OR aid2=$aid) AND accepted<>0");
            $al[] = $aid;
            while ($row = $diplos->fetch_assoc()) {
                $al[] = $row['aid1'];
                $al[] = $row['aid2'];
            }
        }
        $al = array_unique($al);
        $details = $db->query("SELECT owner, isWW, (SELECT aid FROM users WHERE id=v.owner) as aid FROM vdata v WHERE kid=$kid");
        if ($details->num_rows) {
            $details = $details->fetch_assoc();
            if ($details['owner'] == $uid)
                return true;
            return in_array($details['aid'], $al) && ($details['isWW'] || $this->isThereAnArtifact($kid));
        }
        return FALSE;
    }

    public function addTradeRoute($kid, $to_kid, $r1, $r2, $r3, $r4, $hour, $repeat, $useTimezoneHelper = FALSE)
    {
        $usePeriodicTradeRoutes = Config::getInstance()->game->usePeriodicTradeRoutes;
        $db = DB::getInstance();
        if ($usePeriodicTradeRoutes) {
            $time = time() + $hour;
        } else {
            if ($useTimezoneHelper) {
                if (TimezoneHelper::date("H") < $hour) {
                    $time = TimezoneHelper::real_strtotime("today $hour:00");
                } else {
                    $time = TimezoneHelper::real_strtotime("tomorrow $hour:00");
                }
            } else {
                if (date("H") < $hour) {
                    $time = strtotime("today $hour:00");
                } else {
                    $time = strtotime("tomorrow $hour:00");
                }
            }
        }
        $db->query("INSERT INTO traderoutes (kid, to_kid, r1, r2, r3, r4, enabled, start_hour, times, time) VALUES ($kid, $to_kid, $r1, $r2, $r3, $r4, 1, $hour, $repeat, $time)");
    }

    public function getMarketAndTradeOfficeLevel($kid)
    {
        $db = DB::getInstance();
        $return = [17 => 0, 28 => 0];
        $buildings = $db->query("SELECT * FROM fdata WHERE kid=$kid");
        if ($buildings->num_rows) {
            $buildings = $buildings->fetch_assoc();
            for ($i = 19; $i <= 38; ++$i) {
                if ($buildings['f' . $i . 't'] == 17 || $buildings['f' . $i . 't'] == 28) {
                    $return[$buildings['f' . $i . 't']] = $buildings['f' . $i];
                }
            }
        }

        return $return;
    }

    public function updateTradeRoute($id, $to_kid, $r1, $r2, $r3, $r4, $hour, $repeat, $useTimezoneHelper = false)
    {
        $db = DB::getInstance();
        $usePeriodicTradeRoutes = Config::getInstance()->game->usePeriodicTradeRoutes;
        if ($usePeriodicTradeRoutes) {
            $time = time() + $hour;
        } else {
            if ($useTimezoneHelper) {
                if (TimezoneHelper::date("H") < $hour) {
                    $time = TimezoneHelper::real_strtotime("today $hour:00");
                } else {
                    $time = TimezoneHelper::real_strtotime("tomorrow $hour:00");
                }
            } else {
                if (date("H") < $hour) {
                    $time = strtotime("today $hour:00");
                } else {
                    $time = strtotime("tomorrow $hour:00");
                }
            }

        }
        $db->query("UPDATE traderoutes SET to_kid=$to_kid, r1=$r1, r2=$r2, r3=$r3, r4=$r4, start_hour=$hour, times=$repeat, time=$time WHERE id=$id");
    }

    public function getTradeRoute($kid, $trid)
    {
        $db = DB::getInstance();
        $find = $db->query("SELECT * FROM traderoutes WHERE kid=$kid AND id=$trid");
        if (!$find->num_rows) {
            return FALSE;
        }

        return $find->fetch_assoc();
    }

    public function deleteTradeRoute($kid, $trid)
    {
        $db = DB::getInstance();
        $db->query("DELETE FROM traderoutes WHERE kid=$kid AND id=$trid");
    }

    public function getOffersCount($aid, $kid, $race, $rate, $needType, $wantType)
    {
        $speed = Formulas::merchantSpeed($race);
        $xy = Formulas::kid2xy($kid);
        $db = DB::getInstance();
        $dist = "SQRT(POW(x-{$xy['x']}, 2) + POW(y-{$xy['y']}, 2))";
        $cond = [];
        if ($needType > 0) {
            $cond[] = 'giveType=' . $needType;
        }
        if ($wantType > 0) {
            $cond[] = 'needType=' . $wantType;
        }
        if ($rate) {
            $cond[] = 'rate=1';
        }

        return $db->fetchScalar("SELECT COUNT(id) FROM market WHERE kid!=$kid
        AND IF(maxtime>0, IF(ROUND({$dist}/{$speed}) <= maxtime, TRUE, FALSE), TRUE)
        AND IF(aid>0, IF(aid=$aid, TRUE, FALSE), TRUE) " . (sizeof($cond) ? 'AND ' . implode(" AND ", $cond) : ''));
    }

    public function getOffers($page, $pageSize, $aid, $kid, $race, $rate, $needType, $wantType)
    {
        $speed = Formulas::merchantSpeed($race);
        $xy = Formulas::kid2xy($kid);
        $LIMIT = ($page - 1) * $pageSize . ", " . $pageSize;
        $db = DB::getInstance();
        $dist = "SQRT(POW(x-{$xy['x']}, 2) + POW(y-{$xy['y']}, 2))";
        $cond = [];
        if ($needType > 0) {
            $cond[] = 'giveType=' . $needType;
        }
        if ($wantType > 0) {
            $cond[] = 'needType=' . $wantType;
        }
        if ($rate) {
            $cond[] = 'rate=1';
        }

        return $db->query("SELECT * FROM market WHERE
        kid!=$kid AND IF(maxtime>0, IF(ROUND({$dist}/{$speed}) <= maxtime, TRUE, FALSE), TRUE) AND IF(aid>0, IF(aid=$aid, TRUE, FALSE), TRUE)
        " . (sizeof($cond) ? 'AND ' . implode(" AND ", $cond) : '') . " ORDER BY $dist LIMIT $LIMIT");
    }

}