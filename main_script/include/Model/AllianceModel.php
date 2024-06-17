<?php

namespace Model;

use function array_values;
use Core\Database\DB;
use Game\Formulas;
use Game\Map\Map;

class AllianceModel
{
    const ASSIGN_TO_POSITION = 1;
    const KICK_PLAYER = 2;
    const CHANGE_ALLIANCE_DESC = 4;
    const ALLIANCE_DIPLOMACY = 8;
    const IGM_MESSAGE = 16;
    const INVITE_PLAYER = 32;
    const MANAGE_FORUM = 64;
    const MANAGE_MARKS = 128;

    const LOG_JOINED = 1;
    const LOG_LEFT = 2;
    const LOG_INVITE = 3;
    const LOG_NEW_VILLAGE = 4;
    const LOG_DIPLOMACY_CONF = 5;
    const LOG_DIPLOMACY_CONF_ACCEPTED = 6;
    const LOG_DIPLOMACY_CONF_REFUSE = 7;
    const LOG_DIPLOMACY_NAP = 8;
    const LOG_DIPLOMACY_NAP_ACCEPTED = 9;
    const LOG_DIPLOMACY_NAP_REFUSE = 10;
    const LOG_DIPLOMACY_WAR = 11;
    const LOG_DIPLOMACY_WAR_ACCEPTED = 12;
    const LOG_DIPLOMACY_WAR_REFUSE = 13;
    const LOG_KICK = 14;

    public function setAlliancePointsByUid($uid, $attack, $defense, $rob = 0)
    {
        $db = DB::getInstance();
        $db->query("UPDATE alidata a, users u SET
        a.total_attack_points=a.total_attack_points+$attack,
        a.week_attack_points=a.week_attack_points+$attack,
        a.total_defense_points=a.total_defense_points+$defense,
        a.week_defense_points=a.week_defense_points+$defense,
        a.week_robber_points=a.week_robber_points+$rob
        WHERE u.id={$uid} AND a.id=u.aid
        ");
    }

    public function setAlliancePoints($aid, $attack, $defense, $rob = 0)
    {
        $db = DB::getInstance();
        $db->query("UPDATE alidata SET
        total_attack_points=total_attack_points+$attack,
        week_attack_points=week_attack_points+$attack,
        total_defense_points=total_defense_points+$defense,
        week_defense_points=week_defense_points+$defense,
        week_robber_points=week_robber_points+$rob
        WHERE id=$aid
        ");
    }

    public function getAllianceField($id, $column)
    {
        $db = DB::getInstance();
        return $db->fetchScalar("SELECT $column FROM alidata WHERE id=" . (int)$id . " LIMIT 1");
    }

    public function setOverviewPoints($aid, $killed_by, $stolen_by, $killed_of, $stolen_of, $total_off_point, $total_def_point)
    {
        return; //disabled for now!!
        $aid = abs($aid);
        $killed_by = abs($killed_by);
        $stolen_by = abs($stolen_by);
        $killed_of = abs($killed_of);
        $stolen_of = abs($stolen_of);
        $total_off_point = abs($total_off_point);
        $total_def_point = abs($total_def_point);
        $db = DB::getInstance();
        $db->query("UPDATE alistats SET
            killed_by=killed_by+$killed_by,
            stolen_by=stolen_by+$stolen_by,
            killed_of=killed_of+$killed_of,
            stolen_of=stolen_of+$stolen_of,
            total_off_point=total_off_point+$total_off_point,
            total_def_point=total_def_point+$total_def_point
            WHERE aid=$aid AND time=" . strtotime("today 00:00"));
        if (!$db->mysqli->affected_rows) {
            $db->query("INSERT INTO alistats (aid, time) VALUES ($aid, " . strtotime("today 00:00") . ")");
            $db->query("UPDATE alistats SET
            killed_by=killed_by+$killed_by,
            stolen_by=stolen_by+$stolen_by,
            killed_of=killed_of+$killed_of,
            stolen_of=stolen_of+$stolen_of,
            total_off_point=total_off_point+$total_off_point,
            total_def_point=total_def_point+$total_def_point
            WHERE aid=$aid AND time=" . strtotime("today 00:00"));
        }
    }

    public function getInvitesCount($uid)
    {
        $db = DB::getInstance();

        return $db->fetchScalar("SELECT COUNT(id) FROM ali_invite WHERE uid=$uid");
    }

    public function getInvitesForUser($uid)
    {
        $db = DB::getInstance();

        return $db->query("SELECT * FROM ali_invite WHERE uid=$uid");
    }

    public function getMaxPlayerEmbassyLvl($uid)
    {
        $db = DB::getInstance();
        $find = $db->query("SELECT fdata.kid, fdata.embassy FROM fdata, vdata WHERE fdata.kid=vdata.kid AND vdata.owner=$uid ORDER BY fdata.embassy DESC LIMIT 1");

        return $find->fetch_assoc();
    }

    public function sendInvite($invite_uid, $aid, $uid)
    {
        $db = DB::getInstance();
        $count = $db->fetchScalar("SELECT COUNT(id) FROM ali_invite WHERE aid=$aid AND uid=$uid");
        if ($count) {
            return 1;
        }
        $count = $db->fetchScalar("SELECT COUNT(id) FROM users WHERE id=$uid");
        if (!$count) {
            return -1;
        }
        $db->query("INSERT INTO ali_invite (from_uid, aid, uid) VALUES ($invite_uid, $aid, $uid)");
        $FromPlayerName = $db->fetchScalar("SELECT name FROM users WHERE id=$invite_uid");
        $ToPlayerName = $db->fetchScalar("SELECT name FROM users WHERE id=$uid");
        $ToAllianceName = $db->fetchScalar("SELECT name FROM alidata WHERE id=$aid");
        $now = time();
        $allianceNotificationEnabled = $db->fetchScalar("SELECT allianceNotificationEnabled FROM users WHERE id=$uid");
        if ($allianceNotificationEnabled) {
            $sentBefore = $db->fetchScalar("SELECT COUNT(id) FROM alliance_notification WHERE aid=$aid AND to_uid=$uid AND type=1 AND $now-time <= 86400*2");
            if (!$sentBefore) {
                $data = [$ToPlayerName, $FromPlayerName, $ToAllianceName];
                (new MessageModel())->sendMessage(1, $uid, '', serialize($data), 1);
                $db->query("INSERT INTO alliance_notification (aid, to_uid, type, time) VALUES ($aid, $uid, 1, $now)");
            }
        }
        $this->addLog($aid,
            [
                self::LOG_INVITE,
                $invite_uid,
                $FromPlayerName,
                $uid,
                $ToPlayerName,
            ],
            time());

        return 22222;
    }

    public function addLog($aid, $params, $time)
    {
        if (is_array($params)) {
            $type = $params[0];
            $params = implode(":", $params);
        } else {
            $type = explode(':', $params)[0];
        }
        $db = DB::getInstance();
        $db->query("INSERT INTO ali_log (aid, type, data, time) VALUES ($aid, '$type', '$params', $time)");
    }

    public function kickPlayer($kicker_uid, $uid, $aid)
    {
        $db = DB::getInstance();
        //kick log
        $this->nullifyPlayerAllianceInfo($aid, $uid);
        if ($db->affectedRows()) {
            $this->addLog($aid,
                [
                    self::LOG_KICK,
                    $kicker_uid,
                    $db->fetchScalar("SELECT name FROM users WHERE id=$kicker_uid"),
                    $uid,
                    $db->fetchScalar("SELECT name FROM users WHERE id=$uid"),
                ],
                time());
            Map::allianceJoinOrLeaveCacheUpdate($uid, $aid);
            $this->recalculateMaxUsers($aid);
        }
    }

    public function updatePoints($aid, $uid, $leave = true)
    {
        $db = DB::getInstance();
        if ($leave) {
            $db->query("UPDATE alidata a, users u SET a.week_attack_points=a.week_attack_points-u.week_attack_points, a.week_defense_points=a.week_defense_points-u.week_defense_points, a.week_robber_points=a.week_robber_points-u.week_robber_points WHERE a.id={$aid} AND u.id={$uid}");
        } else {
            $db->query("UPDATE alidata a, users u SET a.week_attack_points=a.week_attack_points+u.week_attack_points, a.week_defense_points=a.week_defense_points+u.week_defense_points, a.week_robber_points=a.week_robber_points+u.week_robber_points WHERE a.id={$aid} AND u.id={$uid}");
        }
    }

    public function recalculateMaxUsers($aid)
    {
        $db = DB::getInstance();
        $max = $db->fetchScalar("SELECT max(fdata.embassy) FROM fdata, vdata, users WHERE
        users.aid=$aid
        AND users.id=vdata.owner
        AND fdata.kid=vdata.kid");
        $max = Formulas::getEmbassyMembersCount((int)$max);
        $db->query("UPDATE alidata SET max=$max WHERE id=$aid");
    }


    private function nullifyPlayerAllianceInfo($aid, $uid)
    {
        $db = DB::getInstance();
        $params = array_merge(
            AllianceBonusModel::USER_TOTAL_CONTRIBUTION_PARAMS,
            AllianceBonusModel::USER_WEEK_CONTRIBUTION_PARAMS,
            AllianceBonusModel::USER_UNLOCK_PENDING_ANIMATION
        );
        $query = '';
        foreach ($params as $column) {
            $query .= "$column=0,";
        }
        $db->query("UPDATE users SET $query aid=0, alliance_role=0, alliance_role_name='' WHERE aid=$aid AND id=$uid");
    }

    public function leaveAlliance($uid, $aid, $clearDeletion = false)
    {
        $db = DB::getInstance();
        $now_members = (int)$db->fetchScalar("SELECT COUNT(id) FROM users WHERE aid=$aid") + ($clearDeletion ? 1 : 0);
        if ($now_members <= 1) {
            //it's me alone.
            $db->query("UPDATE users SET aid=0, alliance_role=0, alliance_role_name='' WHERE aid=$aid");
            $db->query("DELETE FROM allimedal WHERE id=$aid");
            $db->query("DELETE FROM alidata WHERE id=$aid");
            $db->query("DELETE FROM alistats WHERE aid=$aid");
            $db->query("DELETE FROM mapflag WHERE aid=$aid");
            $db->query("DELETE FROM ali_invite WHERE aid=$aid");
            Map::allianceDeleteDiplomacyUpdate($aid);
            $db->query("DELETE FROM diplomacy WHERE aid1=$aid OR aid2=$aid");
            (new MarketModel())->cancelAllOffersForAlliance($uid);
            return;
        }
        $this->nullifyPlayerAllianceInfo($aid, $uid);

        (new MarketModel())->cancelAllOffersForAlliance($uid);
        $this->recalculateMaxUsers($aid);
        $this->addLog($aid,
            [
                self::LOG_LEFT,
                $uid,
                $db->fetchScalar("SELECT name FROM users WHERE aid=$aid AND id=$uid"),
            ],
            time());
        Map::allianceJoinOrLeaveCacheUpdate($uid, $aid);
        if (!$this->hasAllianceAnyRightMembers($aid)) {
            $this->giveAllianceRightsTo1Person($aid);
        }
    }

    public function hasAllianceAnyRightMembers($aid)
    {
        $x = 0;
        $x |= AllianceModel::ASSIGN_TO_POSITION;
        $x |= AllianceModel::KICK_PLAYER;
        $x |= AllianceModel::CHANGE_ALLIANCE_DESC;
        $x |= AllianceModel::ALLIANCE_DIPLOMACY;
        $x |= AllianceModel::IGM_MESSAGE;
        $x |= AllianceModel::INVITE_PLAYER;
        $x |= AllianceModel::MANAGE_FORUM;
        $x |= AllianceModel::MANAGE_MARKS;
        $db = DB::getInstance();

        return $db->fetchScalar("SELECT COUNT(id) FROM users WHERE alliance_role=$x AND aid=$aid") >= 1;
    }

    public function giveAllianceRightsTo1Person($aid)
    {
        $db = DB::getInstance();
        $x = 0;
        $x |= AllianceModel::ASSIGN_TO_POSITION;
        $x |= AllianceModel::KICK_PLAYER;
        $x |= AllianceModel::CHANGE_ALLIANCE_DESC;
        $x |= AllianceModel::ALLIANCE_DIPLOMACY;
        $x |= AllianceModel::IGM_MESSAGE;
        $x |= AllianceModel::INVITE_PLAYER;
        $x |= AllianceModel::MANAGE_FORUM;
        $x |= AllianceModel::MANAGE_MARKS;
        $uid = $db->fetchScalar("SELECT id FROM users WHERE aid=$aid LIMIT 1");
        if ($uid) {
            $db->query("UPDATE users SET alliance_role=$x WHERE id=$uid");
        }
    }

    public function deleteInviteForPlayer($uid, $id)
    {
        $db = DB::getInstance();
        $db->query("DELETE FROM ali_invite WHERE uid=$uid AND id=$id");
    }

    public function createAlliance($uid, $name, $tag)
    {
        $db = DB::getInstance();
        $name = $db->real_escape_string($name);
        $tag = $db->real_escape_string($tag);
        $db->query("INSERT INTO alidata (name, tag) VALUES ('$name', '$tag')");
        $aid = $db->lastInsertId();
        $info1 = <<<BBCODE
[stats]fightingpower[/stats]

[stats]fightingpoints[/stats]
BBCODE;
        $info2 = <<<BBCODE
[news]10[/news]
BBCODE;
        $db->query("UPDATE alidata SET info1='$info1', info2='$info2' WHERE id=$aid");
        $x = 0;
        $x |= AllianceModel::ASSIGN_TO_POSITION;
        $x |= AllianceModel::KICK_PLAYER;
        $x |= AllianceModel::CHANGE_ALLIANCE_DESC;
        $x |= AllianceModel::ALLIANCE_DIPLOMACY;
        $x |= AllianceModel::IGM_MESSAGE;
        $x |= AllianceModel::INVITE_PLAYER;
        $x |= AllianceModel::MANAGE_FORUM;
        $x |= AllianceModel::MANAGE_MARKS;
        $db->query("UPDATE users SET aid=$aid, alliance_role=$x, alliance_join_time=" . time() . ", alliance_role_name='" . T("Buildings",
                "Alliance Founder") . "' WHERE id=$uid");
        $pop = $db->fetchScalar("SELECT SUM(pop) FROM vdata WHERE owner=$uid");
        $db->query("UPDATE alidata SET oldPop=$pop WHERE id=$aid");
        $this->recalculateMaxUsers($aid);
        $name = $db->fetchScalar("SELECT name FROM users WHERE id=$uid");
        $this->addLog($aid, [AllianceModel::LOG_JOINED, $uid, $name], time());
        return $aid;
    }

    public function acceptInvite($uid, $id)
    {
        $db = DB::getInstance();
        $aid = $db->fetchScalar("SELECT aid FROM ali_invite WHERE id=$id AND uid=$uid");
        if (!$aid) {
            return FALSE;
        }
        $max = $db->fetchScalar("SELECT max FROM alidata WHERE id=$aid");
        $max = min(getCustom("allianceMembersLimit"), $max);
        $total = $db->fetchScalar("SELECT COUNT(id) FROM users WHERE aid=$aid");
        if ($total >= $max) {
            return -1;//no empty slots.
        }
        $db->query("UPDATE users SET aid=$aid, alliance_join_time=" . time() . " WHERE id=$uid");
        $this->recalculateMaxUsers($aid);
        $db->query("DELETE FROM ali_invite WHERE id=$id");
        $name = $db->fetchScalar("SELECT name FROM users WHERE id=$uid");
        $this->addLog($aid, [AllianceModel::LOG_JOINED, $uid, $name], time());
        if (!$this->hasAllianceAnyRightMembers($aid)) {
            $this->giveAllianceRightsTo1Person($aid);
        }
        Map::allianceJoinOrLeaveCacheUpdate($uid, $aid);
        return $aid;
    }
}