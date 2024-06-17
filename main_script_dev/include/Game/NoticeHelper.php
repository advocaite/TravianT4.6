<?php

namespace Game;

use Core\Database\DB;

define("RIGHT_OPPONENT_HIDE", 1);
define("RIGHT_MYSELF_HIDE", 2);
define("RIGHT_HIDE_OWN_TROOPS", 4);
define("RIGHT_HIDE_OPPONENT_TROOPS", 8);

class NoticeHelper
{
    const TYPE_WON_AS_ATTACK_WITHOUT_CASUALTIES = 1;
    const TYPE_WON_AS_ATTACK_WITH_CASUALTIES = 2;
    const TYPE_LOST_AS_ATTACKER = 3;

    const TYPE_WON_DEFENSE_WITHOUT_LOSSES = 4;
    const TYPE_WON_DEFENSE_WITH_LOSSES = 5;
    const TYPE_LOST_AS_DEFENDER_WITH_CASUALTIES = 6;
    const TYPE_LOST_AS_DEFENDER_WITHOUT_CASUALTIES = 7;

    const TYPE_REINFORCEMENT = 8;

    const TYPE_RESOURCES_MOST_WOOD = 11;
    const TYPE_RESOURCES_MOST_CLAY = 12;
    const TYPE_RESOURCES_MOST_IRON = 13;
    const TYPE_RESOURCES_MOST_CROP = 14;

    const TYPE_WON_SPY_WITHOUT_CASUALTIES = 15;
    const TYPE_WON_SPY_WITH_CASUALTIES = 16;
    const TYPE_LOST_AS_SPY = 17;


    const TYPE_WON_SPY_AS_DEFENDER_REFUSED_ATTACKER_SPY = 18;
    const TYPE_WON_SPY_AS_DEFENDER_LETTING_ATTACKER_SPY = 19;

    const TYPE_CAGED_ATTACK = 20;

    const TYPE_ADVENTURE = 21;

    const TYPE_NEW_VILLAGE = 22;

    const SURROUNDING_FIGHT = 1;
    const SURROUNDING_OASIS_OCCUPY = 2;
    const SURROUNDING_OASIS_RAID = 3; //raid
    const SURROUNDING_VILLAGE_FOUND = 4;
    const SURROUNDING_ALLIANCE = 5;//TODO alliance switch means from alliance x to y We've to save both alliances.
    const SURROUNDING_OASIS_ABANDON = 6;
    const SURROUNDING_VILLAGE_CONQUER = 7;
    const SURROUNDING_VILLAGE_LOST = 8;
    const SURROUNDING_VILLAGE_RENAME = 9;

    //TODO: add new village founding on player registration
    public static function getSurroundingStyle($type)
    {
        return [
                   'fight',
                   'oasisOccupy',
                   'oasisOccupy',
                   'villageFound',
                   'alliance',
                   'oasisAbandon',
                   'villageConquer',
                   'villageLost',
                   'villageRename',
               ][$type - 1];
    }

    public static function addSurrounding($x, $y, $type, $params, $time)
    {
        $db = DB::getInstance();
        if (is_array($params)) {
            $params = implode(":", $params);
        }
        $params = $db->real_escape_string($params);
        $kid = Formulas::xy2kid($x, $y);
        $db->query("INSERT INTO surrounding (`kid`, `x`, `y`, `type`, `params`, `time`) VALUES ($kid, $x, $y, $type, '$params', $time)");
    }

    public static function addNotice($aid, $uid, $kid, $to_kid, $type, $bounty, $data, $happenTime, $isEnforcement = FALSE, $losses = 0, $non_deletable = false)
    {
        $now = microtime(true);
        if (empty($data) || is_null($data)) {
            $data = [];
        }
        if (is_array($bounty)) {
            $bounty = implode(",", $bounty);
        }
        $db = DB::getInstance();
        $private_key = substr(sha1(get_random_string(16)), 0, 8);
        $bounty = $db->real_escape_string($bounty);
        $data = $db->real_escape_string(self::convertReport($type, $data));
        $private_key = $db->real_escape_string($private_key);
        $query = vsprintf("INSERT INTO ndata (`aid`, `uid`, `isEnforcement`, `kid`, `to_kid`, `type`, `bounty`, `data`, `time`, `private_key`, `viewed`, `archive`, `deleted`, `losses`, `non_deletable`) VALUES ('%s', '%s', '%s','%s', '%s','%s','%s','%s','%s','%s','%s','%s','%s', '%s', '%s')", [
            $aid,
            $uid,
            $isEnforcement ? 1 : 0,
            $kid,
            $to_kid,
            $type,
            $bounty,
            $data,
            $happenTime,
            $private_key,
            0,
            0,
            0,
            $losses,
            $non_deletable ? 1 : 0
        ]);
        $db->query($query);
        $reportId = $db->lastInsertId();
        if($type <= 7){
            if(($recordId = $db->fetchScalar("SELECT id FROM farmlist_last_reports WHERE uid=$uid AND kid=$to_kid"))){
                $db->query("UPDATE farmlist_last_reports SET report_id=$reportId WHERE id=$recordId");
            } else {
                $db->query("INSERT INTO farmlist_last_reports (uid, kid, report_id) VALUES ($uid, $to_kid, $reportId)");
            }
        }
        $time = microtime(true) - $now;
        if($time > 50){
            logError(sprintf('Inserting took almost %s ms report ID: %s', $time, $reportId));
        }
        return $reportId;
    }

    public static function convertReport($report_type, array $reportArray)
    {
        return serialize($reportArray);
    }

    public static function parseReport($report_type, $reportString)
    {
        return unserialize($reportString);
    }

    public static function convertReportX($report_type, array $reportArray)
    {
        $filterString = function ($t) {
            return str_replace(['|', ','], null, $t);
        };
        $stringArr = [];
        if ($report_type >= 11 && $report_type <= 14) {
            // send resources
            $stringArr[] = implode(",", [
                $reportArray['sender']['uid'],
                $reportArray['sender']['kid'],
                $filterString($reportArray['sender']['uname']),
            ]);
            $stringArr[] = implode(",", [
                $reportArray['receiver']['uid'],
                $reportArray['receiver']['kid'],
                $filterString($reportArray['receiver']['uname']),
            ]);
            $stringArr[] = implode(",", $reportArray['resources']);
            $stringArr[] = $reportArray['timeTaken'];
            return implode("|-|", $stringArr);
        }
        if ($report_type == self::TYPE_REINFORCEMENT) {
            // send enforcement
            $stringArr[] = implode(",", [
                $reportArray['sender']['uid'],
                $reportArray['sender']['kid'],
                $filterString($reportArray['sender']['uname']),
            ]);
            $stringArr[] = implode(",", [
                $reportArray['receiver']['uid'],
                $reportArray['receiver']['kid'],
                $filterString($reportArray['receiver']['uname']),
            ]);
            $stringArr[] = $reportArray['units']['race'];
            $stringArr[] = implode(",", $reportArray['units']['num']);
            $stringArr[] = $reportArray['consumption'];
            $stringArr[] = $reportArray['timeTaken'];
            return implode("|-|", $stringArr);
        } else if ($report_type == self::TYPE_ADVENTURE) {
            return implode("|-|", [
                $reportArray['uid'],
                $reportArray['kid'],
                $filterString($reportArray['uname']),
                $reportArray['race'],
                isset($reportArray['damage']) ? $reportArray['damage'] : null,
                isset($reportArray['exp']) ? $reportArray['exp'] : null,
                isset($reportArray['dead']) ? 1 : null,
            ]);
        } else if ($report_type == self::TYPE_NEW_VILLAGE) {
            return $reportArray['kid'];
        } else if ($report_type == self::TYPE_CAGED_ATTACK) {
            $stringArr[] = implode(",", [
                $reportArray['uid'],
                $reportArray['kid'],
                $filterString($reportArray['uname']),
            ]);
            $stringArr[] = implode(",", $reportArray['caged']);
            return implode("|-|", $stringArr);
        }
        $stringArr[] = $reportArray['losses'][0] . ',' . $reportArray['losses'][1];
        {
            $sectionArr = [];
            $sectionArr[] = implode(",", [
                $reportArray['attacker']['uid'],
                $reportArray['attacker']['kid'],
                $filterString($reportArray['attacker']['uname']),
                $reportArray['attacker']['race'],
            ]);
            $sectionArr[] = implode(",", $reportArray['attacker']['num']);
            $sectionArr[] = implode(",", $reportArray['attacker']['dead']);
            $sectionArr[] = implode(",", $reportArray['attacker']['smithy']);
            if (isset($reportArray['attacker']['trapped'])) {
                $sectionArr[] = implode(",", $reportArray['attacker']['trapped']);
            } else {
                $sectionArr[] = null;
            }
            $stringArr[] = implode("|", $sectionArr);
        }
        {
            $defArr = [];
            foreach ($reportArray['defender'] as $defender) {
                $r = &$defArr[];
                $r[] = implode(",", [
                    isset($defender['uid']) ? $defender['uid'] : null,
                    isset($defender['kid']) ? $defender['kid'] : null,
                    $filterString(isset($defender['uname']) ? $defender['uname'] : null),
                    $defender['race'],
                ]);
                $r[] = implode(",", $defender['num']);
                $r[] = isset($defender['dead']) ? implode(",", $defender['dead']) : null;
                $r[] = !isset($defender['smithy']) ? null : implode(",", $defender['smithy']);
                $r = implode("|", $r);
            }
            $stringArr[] = implode("|+|", $defArr);
        }
        {
            $sectionArr = [];
            $sectionArr[] = isset($reportArray['info']['cata'][0]) ? implode(",", $reportArray['info']['cata'][0]) : null;
            $sectionArr[] = isset($reportArray['info']['cata'][1]) ? implode(",", $reportArray['info']['cata'][1]) : null;
            $sectionArr[] = isset($reportArray['info']['rams']) ? implode(",", $reportArray['info']['rams']) : null;
            if (isset($reportArray['info']['protectedByArtifact']) && sizeof($reportArray['info']['protectedByArtifact'])) {
                $sectionArr[] = implode("/", array_map(function ($x) {
                    return implode(",", array_values($x));
                }, $reportArray['info']['protectedByArtifact']));
            } else {
                $sectionArr[] = null;
            }
            $sectionArr[] = isset($reportArray['info']['cata_is_disabled']) ? 1 : null;
            $sectionArr[] = isset($reportArray['info']['escape']) ? $reportArray['info']['escape'] : null;
            $sectionArr[] = isset($reportArray['info']['totally_destroyed']) ? 1 : null;
            $sectionArr[] = isset($reportArray['info']['none_return']) ? 1 : null;
            if (isset($reportArray['info']['oasisCapture'])) {
                $sectionArr[] = is_array($reportArray['info']['oasisCapture']) ? implode(",", $reportArray['info']['oasisCapture']) : $reportArray['info']['oasisCapture'];
            } else {
                $sectionArr[] = null;
            }
            $sectionArr[] = isset($reportArray['info']['heroPlanCapture']) ? 1 : null;
            $sectionArr[] = isset($reportArray['info']['heroArtifactCapture']) ? 1 : null;
            $sectionArr[] = isset($reportArray['info']['captureError']) ? 1 : null;
            if (isset($reportArray['info']['captureResult'])) {
                $sectionArr[] = is_array($reportArray['info']['captureResult']) ? implode(",", $reportArray['info']['captureResult']) : $reportArray['info']['captureResult'];
            } else {
                $sectionArr[] = null;
            }
            $sectionArr[] = isset($reportArray['info']['free']) ? implode(',', $reportArray['info']['free']) : null;
            $sectionArr[] = isset($reportArray['info']['res']) ? implode(',', $reportArray['info']['res']) : null;
            $sectionArr[] = isset($reportArray['info']['cranny']) ? $reportArray['info']['cranny'] : null;

            $stringArr[] = implode("|", $sectionArr);
        }

        {
            $stringArr[] = isset($reportArray['permissions']) ? implode(",", $reportArray['permissions']) : null;
        }

        return implode("|-|", $stringArr);
    }

    public static function parseReportX($report_type, $reportString)
    {
        $report = explode("|-|", $reportString);
        $reportArray = [];
        if ($report_type == self::TYPE_REINFORCEMENT) {
            {
                $section = explode(",", $report[0]);
                $reportArray['sender']['uid'] = $section[0];
                $reportArray['sender']['kid'] = $section[1];
                $reportArray['sender']['uname'] = $section[2];
            }
            {
                $section = explode(",", $report[1]);
                $reportArray['receiver']['uid'] = $section[0];
                $reportArray['receiver']['kid'] = $section[1];
                $reportArray['receiver']['uname'] = $section[2];
            }
            {
                $reportArray['units']['race'] = $report[2];
                $reportArray['units']['num'] = self::reindexFrom1(explode(",", $report[3]));
                $reportArray['consumption'] = $report[4];
                $reportArray['timeTaken'] = $report[5];
            }
            return $reportArray;
        } else if ($report_type == self::TYPE_ADVENTURE) {
            {
                $reportArray['uid'] = $report[0];
                $reportArray['kid'] = $report[1];
                $reportArray['uname'] = $report[2];
                $reportArray['race'] = $report[3];
                if ($report[4] != "") {
                    $reportArray['damage'] = $report[4];
                }
                if ($report[5] != "") {
                    $reportArray['exp'] = $report[5];
                }
                if (!empty($report[6])) {
                    $reportArray['dead'] = true;
                }

            }
            return $reportArray;
        } else if ($report_type == self::TYPE_NEW_VILLAGE) {
            $reportArray['kid'] = $report[0];
            return $reportArray;
        } else if ($report_type >= 11 && $report_type <= 14) {
            {
                $section = explode(",", $report[0]);
                $reportArray['sender']['uid'] = $section[0];
                $reportArray['sender']['kid'] = $section[1];
                $reportArray['sender']['uname'] = $section[2];
            }
            {
                $section = explode(",", $report[1]);
                $reportArray['receiver']['uid'] = $section[0];
                $reportArray['receiver']['kid'] = $section[1];
                $reportArray['receiver']['uname'] = $section[2];
            }
            $reportArray['resources'] = self::reindexFrom1(explode(",", $report[2]));
            $reportArray['timeTaken'] = $report[3];
            return $reportArray;
        } else if ($report_type == self::TYPE_CAGED_ATTACK) {
            {
                $section = explode(",", $report[0]);
                $reportArray['uid'] = $section[0];
                $reportArray['kid'] = $section[1];
                $reportArray['uname'] = $section[2];
            }
            $reportArray['caged'] = self::reindexFrom1(explode(",", $report[1]));
            return $reportArray;
        }
        $reportArray['losses'] = explode(",", $report[0]);
        {
            $section = explode("|", $report[1]);
            {
                $arr = explode(",", $section[0]);
                $reportArray['attacker']['uid'] = $arr[0];
                $reportArray['attacker']['kid'] = $arr[1];
                $reportArray['attacker']['uname'] = $arr[2];
                $reportArray['attacker']['race'] = $arr[3];
            }
            $reportArray['attacker']['num'] = self::reindexFrom1(explode(",", $section[1]));
            $reportArray['attacker']['dead'] = self::reindexFrom1(explode(",", $section[2]));
            $reportArray['attacker']['smithy'] = self::reindexFrom1(explode(",", $section[3]));
            if (!empty($section[4])) {
                $reportArray['attacker']['trapped'] = self::reindexFrom1(explode(",", $section[4]));
            }
        }
        {
            $section = explode("|+|", $report[2]);
            $reportArray['defender'] = [];
            foreach ($section as $defStr) {
                $defender = explode("|", $defStr);
                $row = &$reportArray['defender'][];
                {
                    $arr = explode(",", $defender[0]);
                    if ($arr[0] != "") $row['uid'] = $arr[0];
                    if ($arr[1] != "") $row['kid'] = $arr[1];
                    if ($arr[2] != "") $row['uname'] = $arr[2];
                    if ($arr[3] != "") $row['race'] = $arr[3];
                }
                $row['num'] = self::reindexFrom1(explode(",", $defender[1]));
                if (!empty($defender[2])) {
                    $row['dead'] = self::reindexFrom1(explode(",", $defender[2]));
                }
                if (!empty($defender[3])) {
                    $row['smithy'] = self::reindexFrom1(explode(",", $defender[3]));
                }
            }
        }
        {
            $section = explode("|", $report[3]);
            $reportArray['info'] = [];
            if (!empty($section[0])) {
                $reportArray['info']['cata'][0] = explode(",", $section[0]);
            }
            if (!empty($section[1])) {
                $reportArray['info']['cata'][1] = explode(",", $section[1]);
            }
            if (!empty($section[2])) {
                $reportArray['info']['rams'] = explode(",", $section[2]);
            }
            if (!empty($section[3])) {
                $arr = explode("/", $section[3]);
                foreach ($arr as $a) {
                    $a = explode(",", $a);
                    $reportArray['info']['protectedByArtifact'][] = [
                        'type' => $a[0],
                        'size' => $a[1],
                        'num' => $a[2],
                    ];
                }
            }
            if (!empty($section[4])) {
                $reportArray['info']['cata_is_disabled'] = 1;
            }
            if ($section[5] != "") {
                $reportArray['info']['escape'] = $section[5];
            }
            if (!empty($section[6])) {
                $reportArray['info']['totally_destroyed'] = true;
            }
            if (!empty($section[7])) {
                $reportArray['info']['none_return'] = true;
            }
            if ($section[8] != "") {
                $reportArray['info']['oasisCapture'] = explode(',', $section[8]);
                if (sizeof($reportArray['info']['oasisCapture']) == 1) {
                    $reportArray['info']['oasisCapture'] = $reportArray['info']['oasisCapture'][0];
                }
            }
            if (!empty($section[9])) {
                $reportArray['info']['heroPlanCapture'] = true;
            }
            if (!empty($section[10])) {
                $reportArray['info']['heroArtifactCapture'] = true;
            }
            if (!empty($section[11])) {
                $reportArray['info']['captureError'] = true;
            }
            if ($section[12] != "") {
                $reportArray['info']['captureResult'] = explode(",", $section[12]);
                if (sizeof($reportArray['info']['captureResult']) == 1) {
                    $reportArray['info']['captureResult'] = $reportArray['info']['captureResult'][0];
                }
            }
            if (!empty($section[13])) {
                $reportArray['info']['free'] = explode(",", $section[13]);
            }
            if (!empty($section[14])) {
                $reportArray['info']['res'] = self::reindexFrom1(explode(",", $section[14]));
            }
            if ($section[15] != "") {
                $reportArray['info']['cranny'] = $section[15];
            }
        }
        {
            if (!empty($report[4])) {
                $section = explode(",", $report[4]);
                $reportArray['permissions']['prem'] = $section[0];
                $reportArray['permissions']['desc'] = $section[1];
            }

        }
        return $reportArray;
    }

    private static function reindexFrom1(array $arr)
    {
        return array_combine(range(1, count($arr)), array_values($arr));
    }
}