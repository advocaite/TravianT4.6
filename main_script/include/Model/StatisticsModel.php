<?php

namespace Model;

use Core\Caching\Caching;
use Core\Config;
use Core\Database\DB;
use Core\Helper\TimezoneHelper;
use Core\Session;
use Game\Formulas;
use function getCustom;
use function getDisplay;
use function getGameSpeed;
use function miliseconds;

class StatisticsModel
{
    private $db;
    private $countryCodes;
    private $noCache = true;
    const TOP_10_CACHE_TIME = 180;
    const TOP_10_CLIMBERS_CACHE_TIME = 900;
    const TOP_10_PLAYERS_CACHE_TIME = 60;
    const TOP_10_ALLIANCES_CACHE_TIME = 60;
    const TOP_10_VILLAGES_CACHE_TIME = 60;

    public function __construct()
    {
        $this->db = DB::getInstance();
        $this->countryCodes = Config::getInstance()->countryCodes;
    }

    public function getWonderVillages()
    {
        $memcached = Caching::getInstance();
        if (!($wonderVillages = $memcached->get("Statistics:WonderOfTheWorld"))) {
            $config = Config::getInstance();
            if ($config->timers->WWConstructStartTime > 0 && $config->timers->WWConstructStartTime < time()) {
                $wonderVillages = $this->db->query("SELECT kid, owner,
        (SELECT f99 FROM fdata WHERE kid=vdata.kid) AS `wonder_level`,
        (SELECT lastWWUpgrade FROM fdata WHERE kid=vdata.kid) AS `last_WWUpgrade`,
        (SELECT wwname FROM fdata WHERE kid=vdata.kid) AS `wonder_name`
        FROM vdata
        WHERE isWW=1 ORDER BY `wonder_level` DESC, `last_WWUpgrade` ASC, kid ASC
        ")->fetch_all(MYSQLI_ASSOC);
            } else {
                $wonderVillages = $this->db->query("SELECT kid, owner,
        (SELECT f99 FROM fdata WHERE kid=vdata.kid) AS `wonder_level`,
                (SELECT lastWWUpgrade FROM fdata WHERE kid=vdata.kid) AS `last_WWUpgrade`,
        (SELECT wwname FROM fdata WHERE kid=vdata.kid) AS `wonder_name`
        FROM vdata
        WHERE isWW=1 AND IF(owner=1, capital=0, TRUE) ORDER BY `wonder_level` DESC, `last_WWUpgrade` ASC, kid ASC
        ")->fetch_all(MYSQLI_ASSOC);
            }
            $ttl = Config::getInstance()->dynamic->WWPlansReleased ? 0 : 60 * 5;
            if (getGameSpeed() >= 1000) {
                $ttl = 10;
            }
            if ($ttl > 0) {
                $memcached->add("Statistics:WonderOfTheWorld", $wonderVillages, $ttl);
            }
        }
        $wonders = '';
        $rowIndex = 0;
        $mainNatarsVillageID = Formulas::xy2kid(0, 0);
        foreach ($wonderVillages as $row) {
            $player = $this->db->query("SELECT name, aid FROM users WHERE id={$row['owner']}")->fetch_assoc();
            /** @var string as alliance name */
            $allianceName = '-';
            if ($player['aid']) {
                $allianceName = '<a href="allianz.php?aid=' . $player['aid'] . '">' . $this->db->query("SELECT tag FROM alidata WHERE id={$player['aid']}")->fetch_assoc()['tag'] . '</a>';
            }
            $attack = '-';
            $types = implode(",", [MovementsModel::ATTACKTYPE_NORMAL, MovementsModel::ATTACKTYPE_RAID,]);
            $attacksToWonder = $this->db->query("SELECT end_time FROM movement WHERE kid=$mainNatarsVillageID AND to_kid={$row['kid']} AND mode=0 AND attack_type IN($types) ORDER BY end_time LIMIT 1");
            if ($attacksToWonder->num_rows) {
                $attacksToWonder = $attacksToWonder->fetch_assoc();
                $arrivalDateTime = TimezoneHelper::autoDateString($attacksToWonder['end_time'] / 1000, true);
                $title = sprintf(T("Statistics", "WonderOfTheWorld.attackToWonder"), $arrivalDateTime);
                $attack = '<img class="att1" alt="' . $title . '" title="' . $title . '" src="img/x.gif">';
            }
            ++$rowIndex;
            $wonders .= '<tr class="hover"><td class="ra">' . $rowIndex . '.</td><td class="pla"><a href="karte.php?d=' . $row['kid'] . '">' . $player['name'] . '</a></td><td class="nam">' . $row['wonder_name'] . '</td><td class="al">' . $allianceName . '</td><td class="lev">' . $row['wonder_level'] . '</td><td class="at">' . $attack . '</td></tr>';
        }
        return $wonders;
    }

    public function getFarmVillages($page, $pageSize)
    {
        $memcached = Caching::getInstance();
        $startIndex = ($page - 1) * $pageSize;
        if (!($farmVillages = $memcached->get("Statistics:Farms:$page")) || true) {
            $farmVillages = $this->db->query("SELECT * FROM vdata WHERE isFarm=1 ORDER BY name ASC LIMIT $startIndex, $pageSize")->fetch_all(MYSQLI_ASSOC);
            $ttl = 1800;
            $memcached->add("Statistics:Farms:$page", $farmVillages, $ttl);
        }
        $x_style = null;
        $farms = '';
        $rowIndex = 0 + $startIndex;
        $direction = strtolower(getDirection());
        $kkk = 0;
        $farmList = new FarmListModel();
        foreach ($farmVillages as $row) {
            ++$rowIndex;
            $xy = Formulas::kid2xy($row['kid']);
            $farms .= '<tr class="hover">';
            $farms .= '<td>' . $rowIndex . '.</td>';
            $farms .= '<td class="pla"><a href="karte.php?d=' . $row['kid'] . '">' . $row['name'] . '</a></td>';
            $farms .= '<td class="inhabitants" style="text-align: center;">' . $row['pop'] . '</td>';
            $farms .= '<td class="coords" style="text-align: center;"><a class="" href="karte.php?x=' . $xy['x'] . '&amp;y=' . $xy['y'] . '">‎‭<span class="coordinates coordinatesWrapper coordinatesAligned coordinates' . $direction . '"><span class="coordinateX">(‭' . $xy['x'] . '‬‬</span><span class="coordinatePipe">|</span><span class="coordinateY">‭' . $xy['y'] . '‬‬)</span></span>‬‎</a></td>';
            $farms .= '<td class="buttons">';
            if (!Session::getInstance()->hasGoldClub()) {
                $farms .= '<button type="button" id="raidListGoldclub' . (++$kkk) . '" class="icon gold" title="' . T("Reports",
                        "Add to farm list||For this feature you need the Gold club activated") . '"><img class="reportButton" ' . $x_style . ' src="' . get_gpack_cdn_mainPage_url() . 'img_'.$direction.'/report/raidList_small.png"></button>';
                $farms .= <<<HTML
<script type="text/javascript">
                                        jQuery('raidListGoldclub{$kkk}').click(function (event){
                                            jQuery(window).trigger('buttonClicked', [event.target, {
                                                "goldclubDialog": {
                                                    "featureKey": "raidList",
                                                    "infoIcon": "http:\/\/t4.answers.travian.com\/index.php?aid=Travian Answers#go2answer"
                                                }
                                            }]);
                                        })</script>
HTML;

            } else {
                $exists = $farmList->getWhereIsKidInFarmList($row['kid'], Session::getInstance()->getPlayerId());
                if ($exists !== FALSE) {
                    $xy = Formulas::kid2xy($row['kid']);
                    $farms .= '<button type="button" id="raidListGoldclub' . (++$kkk) . '" class="icon" title="' . T("map",
                            "Add to farm list") . '||' . sprintf(T("map",
                            "Edit farm list (Village already in farm list x)"),
                            $exists['name']) . '" onclick="Travian.Game.RaidList.addSlotPopupWrapper(' . $exists['id'] . ', ' . $xy['x'] . ', ' . $xy['y'] . '); return false;"><img class="reportButton" ' . $x_style . ' src="' . get_gpack_cdn_mainPage_url() . 'img_'.$direction.'/report/raidList_small.png"></button>';
                } else {
                    $list = $farmList->getVillageFarmList(Session::getInstance()->getKid(),
                        Session::getInstance()->getPlayerId());
                    if ($list === FALSE) {
                        $farms .= '<button type="button" id="raidListGoldclub' . (++$kkk) . '" class="icon disabled" title="' . T("map",
                                "Add to farm list") . '||' . T("map",
                                "noFarmList") . '"><img class="reportButton" ' . $x_style . ' src="' . get_gpack_cdn_mainPage_url() . 'img_'.$direction.'/report/raidList_small.png"></button>';
                    } else {
                        $xy = Formulas::kid2xy($row['kid']);
                        $farms .= '<button type="button" id="raidListGoldclub' . (++$kkk) . '" class="icon" title="' . T("map",
                                "Add to farm list") . '" onclick="Travian.Game.RaidList.addSlotPopupWrapper(' . $list . ', ' . $xy['x'] . ', ' . $xy['y'] . '); return false;"><img class="reportButton" ' . $x_style . ' src="' . get_gpack_cdn_mainPage_url() . 'img_'.$direction.'/report/raidList_small.png"></button>';
                    }
                }
            }
            $farms .= ' <a href="build.php?id=39&amp;tt=2&amp;z=' . $row['kid'] . '&c=4"><button type="button" title="' . T("map",
                    "sendTroops") . '" class="icon"><img class="reportButton" ' . $x_style . ' src="' . get_gpack_cdn_mainPage_url() . 'img_'.$direction.'/report/simulate_small.png"></button></a>';
            $farms .= '</td>';
            $farms .= '</tr>';
        }
        return $farms;
    }

    public function getPlayersStatus()
    {
        $m = new SummaryModel();

        return $m->getTotalSummary();
    }

    public function getTribesStatus()
    {
        $m = new SummaryModel();
        $summary = $m->getSummary();
        $race1 = $summary['roman_players_count'];
        $race2 = $summary['teuton_players_count'];
        $race3 = $summary['gaul_players_count'];
        $race6 = $summary['egyptians_players_count'];
        $race7 = $summary['huns_players_count'];
        $total = $summary['players_count'];
        return [
            "Registered" => [1 => $race1, 2 => $race2, 3 => $race3, 6 => $race6, 7 => $race7],
            "Percent"    => [
                1 => round($race1 / $total * 100, 1),
                2 => round($race2 / $total * 100, 1),
                3 => round($race3 / $total * 100, 1),
                6 => round($race6 / $total * 100, 1),
                7 => round($race7 / $total * 100, 1),
            ],
        ];
    }

    public function getWorldMisc($onlyData = false)
    {
        $memcached = Caching::getInstance();
        if (true || !($result = $memcached->get("Statistics:General:Miscellaneous"))) {
            $m = new CasualtiesModel();
            $result = $m->getLastDaysCasualties(5)->fetch_all(MYSQLI_ASSOC);
            $memcached->add("Statistics:General:Miscellaneous", $result, 300);
        }
        if($onlyData)
            return $result;
        $misc = '';
        foreach ($result as $row) {
            $misc .= '<tr class="hover"><td>' . number_format_x((int)$row['attacks']) . '</td><td>' . number_format_x((int)$row['casualties']) . '</td><td>' . TimezoneHelper::date("d. M", $row['time']) . '</td></tr>';
        }
        return $misc;
    }

    public function getCountryRanks()
    {
        if (!getDisplay('showCountryFlagsInGeneralStatistics')) return null;
        $memcached = Caching::getInstance();
        if (!($result = $memcached->get("Statistics:General:CountryRanks"))) {
            $db = DB::getInstance();
            $result = $db->query("SELECT countryFlag, (SELECT SUM(total_pop) FROM users WHERE countryFlag=u.countryFlag) `total_country_pop`, (SELECT COUNT(id) FROM users WHERE countryFlag=u.countryFlag) `total_players` FROM users u WHERE (countryFlag IS NOT NULL AND countryFlag != '' AND countryFlag != '-') GROUP BY countryFlag ORDER BY `total_country_pop` DESC LIMIT 10;")->fetch_all(MYSQLI_ASSOC);
            $memcached->set("Statistics:General:CountryRanks", $result, 600);
        }
        $HTML = '';
        $rank = 0;
        foreach ($result as $row) {
            $row['countryFlag'] = strtoupper($row['countryFlag']);
            $countryName = isset($this->countryCodes[$row['countryFlag']]) ? $this->countryCodes[$row['countryFlag']] : 'Unknown country';
            $countryFlag = '<img src="img/x.gif" class="flag_' . strtolower($row['countryFlag']) . '" title="' . $countryName . '" alt="' . $countryName . '">';
            $HTML .= '<tr class="hover"><td>' . (++$rank) . '.</td><td>' . $countryName . '</td><td class="flags">' . $countryFlag . '</td><td>' . $row['total_players'] . '</td><td>' . $row['total_country_pop'] . '</td><td>' . round(($row['total_country_pop'])) . '</td></tr>';
        }
        return $HTML;
    }

    public function getPlayerRankById($playerId, $force = FALSE)
    {
        $memcache = Caching::getInstance();
        if (!$this->noCache && !$force && $cache = $memcache->get("Statistics:Player:Rank:$playerId")) {
            return $cache;
        }
        $row = $this->db->query("SELECT  id, total_pop `score` FROM users WHERE id={$playerId} LIMIT 1");
        if (!$row->num_rows) {
            return 0;
        }
        $row = $row->fetch_assoc();
        $memcache->set("Statistics:Player:Rank:$playerId",
            $result = $this->getPlayerRank($row['id'], $row['score']),
            self::TOP_10_PLAYERS_CACHE_TIME);
        return $result;
    }

    public function getPlayerRankByName($playerName)
    {
        $playerName = $this->db->real_escape_string($playerName);
        $memcache = Caching::getInstance();
        if (!$this->noCache && $cache = $memcache->get("Statistics:Player:RankName:$playerName")) {
            return $cache;
        }
        $row = $this->db->query("SELECT  id, total_pop `score` FROM users WHERE name LIKE '{$playerName}%%' LIMIT 1");
        if (!$row->num_rows) {
            return 0;
        }
        $row = $row->fetch_assoc();
        $memcache->set("Statistics:Player:RankName:$playerName",
            $result = $this->getPlayerRank($row['id'], $row['score']),
            self::TOP_10_PLAYERS_CACHE_TIME);

        return $result;
    }

    private function getPlayerRank($playerId, $score)
    {
        $score = (int)$score;
        $playerId = (int)$playerId;
        $find = $this->db->query("SELECT (((SELECT COUNT(id) FROM users WHERE id>1 AND hidden=0 AND total_pop>{$score}))+(SELECT COUNT(id) FROM users WHERE id>1 AND id<{$playerId} AND (total_pop={$score})) + 1) `rank`");



        if (!$find->num_rows) {
            return 1;
        }
        $find = $find->fetch_assoc();

        return max($find['rank'], 1);
    }

    public function getPlayerListCount()
    {
        return $this->getPlayersStatus()['active'];
    }

    public function getPlayersPointsListCount()
    {
        return $this->getPlayerListCount();
    }

    public function getPlayersPointsById($playerId, $isDefense)
    {
        $memcache = Caching::getInstance();
        $key = "Statistics:Player:" . ($isDefense ? "defense" : "attacker") . ":Rank:$playerId";
        if (!$this->noCache && $cache = $memcache->get($key)) {
            return $cache;
        }
        $field = $isDefense ? "total_defense_points" : "total_attack_points";
        $row = $this->db->query("SELECT  id, {$field} `score`  FROM users WHERE id={$playerId} AND id > 1 AND hidden=0 LIMIT 1");
        if (!$row->num_rows) {
            return 0;
        }
        $row = $row->fetch_assoc();
        $memcache->set($key,
            $result = $this->getPlayersPointsRank($row['id'], $row['score'], $isDefense),
            self::TOP_10_PLAYERS_CACHE_TIME);

        return $result;
    }

    public function getPlayersPointsByName($playerName, $isDefense)
    {
        $memcache = Caching::getInstance();
        $key = "Statistics:Player:" . ($isDefense ? "defense" : "attacker") . ":RankName:$playerName";
        if (!$this->noCache && $cache = $memcache->get($key)) {
            return $cache;
        }
        $playerName = $this->db->real_escape_string($playerName);
        $field = $isDefense ? "total_defense_points" : "total_attack_points";
        $row = $this->db->query("SELECT  id, {$field} `score`  FROM users WHERE  id > 1 AND hidden=0 AND name LIKE '{$playerName}%%' AND id > 1 LIMIT 1");
        if (!$row->num_rows) {
            return 0;
        }
        $row = $row->fetch_assoc();
        $memcache->set($key,
            $result = $this->getPlayersPointsRank($row['id'], $row['score'], $isDefense),
            self::TOP_10_PLAYERS_CACHE_TIME);

        return $result;
    }

    public function getPlayersPointsRank($playerId, $score, $isDefense)
    {
        $score = (int)$score;
        $playerId = (int)$playerId;
        $field = $isDefense ? "total_defense_points" : "total_attack_points";
        $row = $this->db->query($q = "SELECT ( (SELECT  COUNT(id) FROM users WHERE id>1 AND hidden=0 AND {$field}>{$score}) + (SELECT COUNT(id) FROM users WHERE id>1 AND hidden=0 AND id<{$playerId} AND {$field}={$score})) + 1 `rank`");

        return $row->fetch_assoc()['rank'];
    }

    public function getAllianceClimbersPointById($id)
    {
        $memcache = Caching::getInstance();
        if (!$this->noCache && $cache = $memcache->get("Statistics:Alliance:Top10:ClimberRank:$id")) {
            return $cache;
        }
        $result = $this->db->fetchScalar("SELECT week_pop_changes AS `points` FROM alidata WHERE id=$id");
        $memcache->set("Statistics:Alliance:Top10:ClimberRank:$id", $result, self::TOP_10_CLIMBERS_CACHE_TIME);
        return $result;
    }

    public function getAllianceRankByName($allianceName)
    {
        $memcache = Caching::getInstance();
        $key = "Statistics:Alliance:RankName:$allianceName";
        if (!$this->noCache && $cache = $memcache->get($key)) {
            return $cache;
        }
        $allianceName = $this->db->real_escape_string($allianceName);
        $row = $this->db->query("SELECT  id, (SELECT SUM(total_pop) FROM users WHERE alidata.id=users.aid) `score` FROM alidata WHERE tag LIKE '{$allianceName}%%' LIMIT 1");
        if (!$row->num_rows) {
            return FALSE;
        }
        $row = $row->fetch_assoc();
        $memcache->set($key, $result = $this->getAllianceRank((int)$row['id'], (int)$row['score']), self::TOP_10_ALLIANCES_CACHE_TIME);

        return $result;
    }

    public function getAllianceRankById($allianceId)
    {
        $memcache = Caching::getInstance();
        $key = "Statistics:Alliance:Rank:$allianceId";
        if (!$this->noCache && $cache = $memcache->get($key)) {
            return $cache;
        }
        $row = $this->db->query("SELECT  id, (SELECT SUM(total_pop) FROM users
WHERE alidata.id=users.aid) `score` FROM alidata WHERE  id={$allianceId} LIMIT 1");
        if (!$row->num_rows) {
            return FALSE;
        }
        $row = $row->fetch_assoc();
        $memcache->set($key,
            $result = $this->getAllianceRank((int)$row['id'], (int)$row['score']),
            self::TOP_10_ALLIANCES_CACHE_TIME);

        return $result;
    }

    private function getAllianceRank($allianceId, $score)
    {
        return $this->db->query("SELECT ( (SELECT  COUNT(id) FROM alidata WHERE  (SELECT SUM(total_pop) FROM users
WHERE alidata.id=users.aid)>{$score}) + (SELECT   COUNT(id) FROM alidata WHERE  (SELECT SUM(total_pop) FROM users
WHERE alidata.id=users.aid)={$score}  AND id<{$allianceId})    ) + 1 `rank`")->fetch_assoc()['rank'];
    }

    public function getAlliancePointsRankByName($allianceName, $isDefense)
    {
        $allianceName = $this->db->real_escape_string($allianceName);
        $memcache = Caching::getInstance();
        $key = "Statistics:Alliance:" . ($isDefense ? "d" : "a") . ":RankName:$allianceName";
        if (!$this->noCache && $cache = $memcache->get($key)) {
            return $cache;
        }
        $field = $isDefense ? "total_defense_points" : "total_attack_points";
        $row = $this->db->query("SELECT  id, {$field} `score`    FROM alidata    WHERE tag LIKE '{$allianceName}%%' LIMIT 1");
        if (!$row->num_rows) {
            return FALSE;
        }
        $row = $row->fetch_assoc();
        $memcache->set($key,
            $result = $this->getAlliancePointsRank((int)$row['id'], (int)$row['score'], $isDefense),
            self::TOP_10_ALLIANCES_CACHE_TIME);

        return $result;
    }

    public function getAlliancePointsRankById($allianceId, $isDefense)
    {
        $memcache = Caching::getInstance();
        $key = "Statistics:Alliance:" . ($isDefense ? "d" : "a") . ":Rank:$allianceId";
        if (!$this->noCache && $cache = $memcache->get($key)) {
            return $cache;
        }
        $field = $isDefense ? "total_defense_points" : "total_attack_points";
        $row = $this->db->query("SELECT  id, {$field} `score`    FROM alidata    WHERE  id={$allianceId}   LIMIT 1");
        if (!$row->num_rows) {
            return FALSE;
        }
        $row = $row->fetch_assoc();
        $memcache->set($key,
            $result = $this->getAlliancePointsRank((int)$row['id'], (int)$row['score'], $isDefense),
            self::TOP_10_ALLIANCES_CACHE_TIME);

        return $result;
    }

    public function getAlliancePointsRank($allianceId, $score, $isDefense)
    {
        $field = $isDefense ? "total_defense_points" : "total_attack_points";

        return $this->db->query("SELECT ( (SELECT  COUNT(id) FROM alidata WHERE   {$field}>{$score}) + (SELECT   COUNT(id) FROM alidata WHERE   {$field}={$score}  AND id<{$allianceId})    ) + 1 `rank`")->fetch_assoc()['rank'];
    }

    public function getVillageRankByName($villageName)
    {
        $villageName = $this->db->real_escape_string($villageName);
        $memcache = Caching::getInstance();
        $key = "Statistics:Village:RankName:$villageName";
        if (!$this->noCache && $cache = $memcache->get($key)) {
            return $cache;
        }
        $row = $this->db->query("SELECT  kid, pop AS `score` FROM vdata WHERE owner>1 AND hidden=0 AND name LIKE '{$villageName}%%' LIMIT 1");
        if (!$row->num_rows) {
            return FALSE;
        }
        $row = $row->fetch_assoc();
        $memcache->set($key,
            $result = $this->getVillageRank($row['kid'], $row['score']),
            self::TOP_10_VILLAGES_CACHE_TIME);

        return $result;
    }

    public function getVillageRankById($villageId)
    {
        $memcache = Caching::getInstance();
        $key = "Statistics:Village:Rank:$villageId";
        if (!$this->noCache && $cache = $memcache->get($key)) {
            return $cache;
        }
        $row = $this->db->query("SELECT kid, pop `score` FROM vdata WHERE kid={$villageId} AND owner>1 AND hidden=0 LIMIT 1");
        if (!$row->num_rows) {
            return FALSE;
        }
        $row = $row->fetch_assoc();
        $memcache->set($key,
            $result = $this->getVillageRank($row['kid'], $row['score']),
            self::TOP_10_VILLAGES_CACHE_TIME);

        return $result;
    }

    public function getVillageRank($villageId, $score)
    {
        $score = (int)$score;
        $villageId = (int)$villageId;

        return $this->db->query("SELECT ( (SELECT  COUNT(kid) FROM vdata WHERE owner>1 AND hidden=0 AND pop>{$score}) + (SELECT   COUNT(kid) FROM vdata WHERE owner>1 AND hidden=0  AND pop={$score}  AND kid>{$villageId})    ) + 1 `rank`")->fetch_assoc()['rank'];
    }

    public function getHeroListCount()
    {
        return $this->getPlayerListCount();
    }

    public function getHeroRankById($playerId)
    {
        $memcache = Caching::getInstance();
        $key = "Statistics:Hero:Rank:$playerId";
        if (!$this->noCache && $cache = $memcache->get($key)) {
            return $cache;
        }
        $row = $this->db->query("SELECT uid, exp AS `score` FROM hero WHERE  uid={$playerId} AND uid>1 LIMIT 1");
        if (!$row->num_rows) {
            return FALSE;
        }
        $row = $row->fetch_assoc();
        $memcache->set($key, $result = $this->getHeroRank($row['uid'], $row['score']), self::TOP_10_PLAYERS_CACHE_TIME);

        return $result;
    }

    public function getHeroRankByName($playerName)
    {
        $playerName = $this->db->real_escape_string($playerName);
        $memcache = Caching::getInstance();
        $key = "Statistics:Hero:RankName:$playerName";
        if (!$this->noCache && $cache = $memcache->get($key)) {
            return $cache;
        }
        $playerId = $this->db->query("SELECT id FROM users WHERE id>1 AND name LIKE '{$playerName}%%'");
        if (!$playerId->num_rows) {
            return FALSE;
        }
        $playerId = $playerId->fetch_assoc()['id'];
        $memcache->set($key, $result = $this->getHeroRankById($playerId), self::TOP_10_PLAYERS_CACHE_TIME);

        return $result;
    }

    private function getHeroRank($playerId, $score)
    {
        $score = (int)$score;
        $playerId = (int)$playerId;

        return $this->db->fetchScalar("SELECT ((SELECT  COUNT(uid) FROM hero WHERE exp>{$score} AND uid>1) + (SELECT COUNT(uid) FROM hero WHERE  exp={$score}  AND uid<{$playerId} AND uid>1)) + 1 `rank`");
    }

    public function getTop10Climbers($isPlayer)
    {
        $totalPlayers = $this->db->fetchScalar("SELECT COUNT(id) FROM users WHERE users.id > 1");
        if ($isPlayer) {
            if (getCustom("usePopulationAsClimbersRank")) {
                $rank = "cast(total_pop as SIGNED)-oldRank";
                $result = $this->db->query("SELECT b.id, b.name, b.total_villages, b.total_pop, ($rank) `points` FROM users b WHERE b.id>1 AND hidden=0 AND ($rank)>0 ORDER BY ($rank) DESC, id ASC LIMIT 10");
            } else {
                $lastMedalsGiven = Config::getProperty('dynamic', 'lastMedalsGiven');
                $cond1 = '(SELECT COUNT(id) FROM users WHERE users.id > 1 AND users.total_pop > b.total_pop)';
                $cond2 = '(SELECT COUNT(id) FROM users WHERE users.id > 1 AND users.id < b.id AND users.total_pop=b.total_pop)';
                $rank = "IF(b.signupTime > $lastMedalsGiven, $totalPlayers, oldRank)-(SELECT $cond1+$cond2)";
                $result = $this->db->query($q = "SELECT b.id, b.name, b.total_villages, b.total_pop, ($rank) as `points` FROM users b WHERE b.id>1 AND hidden=0 AND ($rank)>0 ORDER BY points DESC, id ASC LIMIT 10");
            }
        } else {
            $result = $this->db->query("SELECT id, tag, week_pop_changes AS `points` FROM alidata WHERE week_pop_changes>0 ORDER BY `points` DESC, id ASC LIMIT 10");
        }
        return $result;
    }

    public function getTop10($isPlayer, $columnName)
    {
        $table = $isPlayer ? "users" : "alidata";
        if ($columnName == 'max_off_point' || $columnName == 'max_def_point') {
            if ($columnName == 'max_off_point') {
                $result = $this->db->query("SELECT id, max_off_time, max_off_nid, " . ($isPlayer ? "name" : "tag") . ", {$columnName} `points` FROM {$table} WHERE {$columnName}>0" . ($isPlayer ? " AND id>1 AND hidden=0" : "") . " AND $columnName > 0 ORDER BY {$columnName} DESC, id ASC LIMIT 5");
            } else {
                $result = $this->db->query("SELECT id, max_def_time, max_def_nid, " . ($isPlayer ? "name" : "tag") . ", {$columnName} `points` FROM {$table} WHERE {$columnName}>0" . ($isPlayer ? " AND id>1 AND hidden=0" : "") . " AND $columnName > 0 ORDER BY {$columnName} DESC, id ASC LIMIT 5");
            }
        } else {
            $result = $this->db->query("SELECT id, " . ($isPlayer ? "name" : "tag") . ", {$columnName} `points` FROM {$table} WHERE {$columnName}>0" . ($isPlayer ? " AND id>1 AND hidden=0" : "") . " ORDER BY {$columnName} DESC, id ASC LIMIT 10");
        }
        return $result;
    }

    public function getPlayerList($pageIndex, $pageSize)
    {
        $from = $pageIndex * $pageSize;
        $to = $pageSize;
        $result = $this->db->query("SELECT id, access, name, countryFlag, last_login_time, aid, IF(aid>0, (SELECT tag FROM alidata WHERE id=users.aid LIMIT 1), 0) `alliance_name`, total_pop `total_population`, total_villages `total_villages_count` FROM users WHERE id > 1 AND hidden=0 ORDER BY total_pop DESC, id ASC LIMIT {$from}, {$to}");
        return $result;
    }

    public function getPlayersPointsList($pageIndex, $pageSize, $isDefense)
    {
        $field = $isDefense ? "total_defense_points" : "total_attack_points";
        $from = $pageIndex * $pageSize;
        $to = $pageSize;
        $result = $this->db->query("SELECT id, name, total_pop `total_population`, total_villages `total_villages_count`, $field `points` FROM users WHERE  id>1 AND hidden=0 ORDER BY $field DESC, id ASC   LIMIT $from,$to");
        return $result;
    }

    public function getHerosList($pageIndex, $pageSize)
    {
        $from = $pageIndex * $pageSize;
        $to = $pageSize;
        $result = $this->db->query("SELECT  uid,
        (SELECT name FROM users WHERE id=hero.uid) AS `player_name`,
        exp FROM hero WHERE uid>1 ORDER BY exp DESC, uid ASC    LIMIT $from,$to");
        return $result;
    }

    public function getAllianceListCount()
    {
        return $this->db->fetchScalar("SELECT COUNT(id) FROM alidata");
    }

    public function getAlliancesList($pageIndex, $pageSize)
    {
        $from = $pageIndex * $pageSize;
        $to = $pageSize;
        $result = $this->db->query("SELECT
    id,
    tag,
    (SELECT SUM(total_pop) FROM users
WHERE alidata.id=users.aid) AS `points`,
(SELECT COUNT(id) FROM users WHERE users.aid=alidata.id) AS `memcount`

FROM alidata
ORDER BY points DESC
LIMIT $from,$to");
        return $result;
    }

    public function getAlliancePointsList($pageIndex, $pageSize, $isDefense)
    {
        $from = $pageIndex * $pageSize;
        $to = $pageSize;
        $field = $isDefense ? "total_defense_points" : "total_attack_points";
        $result = $this->db->query("SELECT id, tag, (SELECT COUNT(id) FROM users WHERE users.aid=alidata.id) AS `memcount`, (SELECT SUM(total_pop) FROM users
WHERE alidata.id=users.aid) as `totalPop`, {$field} points  FROM alidata ORDER BY {$field} DESC LIMIT $from, $to");
        return $result;
    }

    public function getVillagesList($pageIndex, $pageSize)
    {
        $from = $pageSize * $pageIndex;
        $to = $pageSize;
        $result = $this->db->query("SELECT  (SELECT name FROM users WHERE id=vdata.owner LIMIT 1) AS `player_name`, kid, owner, name, pop FROM vdata WHERE owner>1 AND hidden=0  ORDER BY pop DESC, kid DESC LIMIT $from, $to");
        return $result;
    }

    public function getTotalVillagesCount()
    {
        return $this->db->fetchScalar("SELECT COUNT(kid) FROM vdata WHERE owner>1 AND hidden=0");
    }

    public function getTotalFarmVillagesCount()
    {
        return $this->db->fetchScalar("SELECT COUNT(kid) FROM vdata WHERE isFarm=1");
    }
}