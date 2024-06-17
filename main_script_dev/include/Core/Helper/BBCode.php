<?php

namespace Core\Helper;

use Controller\BerichteCtrl;
use Core\Database\DB;
use Core\Helper\TimezoneHelper;
use Core\Session;
use Game\Formulas;
use Core\Locale;
use function get_gpack_cdn_base_url;
use function is_numeric;
use Model\AllianceModel;
use Model\ClubApi;
use function preg_match;
use function preg_match_all;
use function preg_replace;

class MedalsBBCode
{
    public  $data      = [];
    private $processed = [];

    public function BBCodeMedals($matches)
    {
        $db = DB::getInstance();
        $key = filter_var($matches[1], FILTER_SANITIZE_STRING);
        if (isset($this->processed[$key])) {
            return $matches[0];
        }
        $this->processed[$key] = TRUE;
        if (strtolower($key) == 'natars') {
            if (!$this->data['isAlliance'] && $this->data['uid'] == 1) {
                $HTML = T("Global", "NatarsName");
                $HTML .= '<br>';
                $HTML .= '=======================';
                $HTML .= '<br>';
                $HTML .= '<img src="/img/ww100.png" style="width:60%" border="0" alt="' . T("Buildings",
                        "40.title") . '">';
                $HTML .= '<br>';
                $HTML .= '=======================';
                return $HTML;
            }
            return $matches[0];
        } else if (!$this->data['isAlliance'] && $key == '0') {
            $row = $db->query("SELECT signupTime, protection FROM users WHERE id={$this->data['uid']}")->fetch_assoc();
            $this->data['signupTime'] = $row['signupTime'];
            $this->data['protection'] = $row['protection'];
            $hasProtection = $this->data['protection'] > time();
            $date = TimezoneHelper::autoDateString($hasProtection ? $this->data['protection'] : $this->data['signupTime'],
                TRUE);
            return '<img class="tn' . ($hasProtection ? '' : 'd') . '" title="' . sprintf(T("BBCode",
                    $hasProtection ? 'this player is under protection to x' : 'this player is registered at x'),
                    $date) . '" alt="" src="img/x.gif">';
        }
        $key = (int)$key;
        if ($this->data['isAlliance']) {
            $find = $db->query("SELECT * FROM allimedal WHERE aid={$this->data['aid']} AND id={$key}");
        } else {
            $find = $db->query("SELECT * FROM medal WHERE uid={$this->data['uid']} AND id={$key}");
        }
        if (!$find->num_rows) {
            return $matches[0];
        }
        $find = $find->fetch_assoc();
        if ($find['category'] <= 4) {
            $title = T("Medals", "Category") . ': ' . T("Medals", 'names.' . $find['category']);
            $title .= '<br />' . T("Medals", "Week") . ': ' . $find['week'];
            $title .= '<br />' . T("Medals", "Rank") . ': ' . $find['rank'];
            $title .= '<br />' . ($find['category'] == 4 ? T("Medals", "Resources") : T("Medals",
                    "Points")) . ': ' . number_format_x($find['points']);
        } else {
            $title = sprintf(T("Medals", "category" . $find['category']), $find['points']);
            $title .= '<br /> <br />' . T("Medals", "Received in week:") . $find['week'];
        }
        return '<img class="medal ' . $find['img'] . '" src="img/x.gif" alt="' . $title . '" title="' . $title . '">';
    }

    public function BBCodeMedals2($matches)
    {
        if ($this->data['isAlliance']) {
            return $matches[0];
        }
        $key = filter_var($matches[1], FILTER_SANITIZE_STRING);
        if (isset($this->processed[$key])) {
            return $matches[0];
        }
        $this->processed[$key] = TRUE;
        $key = (int)$key;
        $email = DB::getInstance()->fetchScalar("SELECT email FROM users WHERE id={$this->data['uid']} LIMIT 1");
        $find = ClubApi::getPlayerEmailMedalById($email, (int)$key);
        if (!$find->num_rows) {
            return $matches[0];
        }
        $find = $find->fetch_assoc();
        $img = [
            1 => 'ww-gold.png',
            2 => 'ww-silber.png',
            3 => 'ww-silber.png',

            4 => 'off1.png',
            5 => 'off2.png',
            8 => 'def1.png',
            7 => 'off4.png',

            8 => 'def1.png',
            9 => 'def2.png',
            10 => 'def3.png',
            11 => 'def4.png',

            12 => 'pop1.png',
            13 => 'pop2.png',
            14 => 'pop3.png',
            15 => 'pop4.png',

            16 => '', //big off hammer
            17 => '', //big def hammer
            18 => '', //winner alliance
        ];
        if (!isset($img[$find['type']]) || empty($img[$find['type']])) {
            return null;
        }
        $find['params'] = explode("|", $find['params']);
        $array = [];
        switch ($find['type']) {
            case 1:
            case 2:
            case 3:
                $array = [
                    $find['params'][0],
                    $find['worldId'],
                    $find['nickname'],
                    T("Global", "races.{$find['tribe']}"),
                    $find['params'][1],
                ];
                break;
            case 4:
            case 5:
            case 6:
            case 7:
            case 8:
            case 9:
            case 10:
            case 11:
            case 12:
            case 13:
            case 14:
            case 15:
            case 16: //big off hammer
            case 17: //big def hammer
                $array = [
                    $find['params'][0],
                    $find['worldId'],
                    $find['nickname'],
                    T("Global", "races.{$find['tribe']}"),
                    number_format_x($find['params'][1]),
                ];
                break;
            case 18: //winner alliance
                $array = [
                    $find['params'][0],
                    $find['worldId'],
                    $find['nickname'],
                    T("Global", "races.{$find['tribe']}"),
                    $find['params'][1],
                ];
        }
        $title = vsprintf(T("Medals", "SpecialMedals.{$find['type']}"), $array);
        $title = htmlspecialchars($title);
        return '<img class="medalGloria" src="' . get_gpack_cdn_base_url() . '/gloria/' . $img[$find['type']] . '" alt="' . $title . '" title="' . $title . '">';
    }
}

class AllianceBBCode
{
    /** types:
     *  1 => conf with
     *  2 => nap with
     *  3 => war with
     */
    public $aid = 0;

    public function Diplomacy($matches)
    {
        $HTML = $this->ally();
        $HTML .= $this->nap();
        $HTML .= $this->war();
        return $HTML;
    }

    public function ally()
    {
        $HTML = '<p>' . T("BBCode", "confederacies with") . '</p>';
        $db = DB::getInstance();
        $find = $db->query("SELECT * FROM diplomacy WHERE accepted=1 AND type=1 AND (aid1={$this->aid} OR aid2={$this->aid})");
        while ($row = $find->fetch_assoc()) {
            $aid = $row['aid1'] == $this->aid ? $row['aid2'] : $row['aid1'];
            $tag = $db->fetchScalar("SELECT tag FROM alidata WHERE id={$aid}");
            if (!$tag) {
                continue;
            }
            $HTML .= '<a href="allianz.php?aid=' . $aid . '">' . $tag . '</a><br />';
        }
        return $HTML . '<br />';
    }

    public function nap()
    {
        $HTML = '<p>' . T("BBCode", "non-aggression pact(s) with") . '</p>';
        $db = DB::getInstance();
        $find = $db->query("SELECT * FROM diplomacy WHERE accepted=1 AND type=2 AND (aid1={$this->aid} OR aid2={$this->aid})");
        while ($row = $find->fetch_assoc()) {
            $aid = $row['aid1'] == $this->aid ? $row['aid2'] : $row['aid1'];
            $tag = $db->fetchScalar("SELECT tag FROM alidata WHERE id={$aid}");
            if (!$tag) {
                continue;
            }
            $HTML .= '<a href="allianz.php?aid=' . $aid . '">' . $tag . '</a><br />';
        }
        return $HTML . '<br />';
    }

    public function war()
    {
        $HTML = '<p>' . T("BBCode", "at war(s) with") . '</p>';
        $db = DB::getInstance();
        $find = $db->query("SELECT * FROM diplomacy WHERE accepted=1 AND type=3 AND (aid1={$this->aid} OR aid2={$this->aid})");
        while ($row = $find->fetch_assoc()) {
            $aid = $row['aid1'] == $this->aid ? $row['aid2'] : $row['aid1'];
            $tag = $db->fetchScalar("SELECT tag FROM alidata WHERE id={$aid}");
            if (!$tag) {
                continue;
            }
            $HTML .= '<a href="allianz.php?aid=' . $aid . '">' . $tag . '</a><br />';
        }
        return $HTML . '<br />';
    }

    public function forum($number)
    {
        $number = min(max(1, (int)$number[1]), 99);
        $db = DB::getInstance();
        $HTML = '<div id="allyInfoForum">';
        $HTML .= '<ul><h4 class="chartHeadline">' . T("BBCode", "latest postings on forum") . '</h4>';
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $total = $db->fetchScalar("SELECT COUNT(id) FROM forum_post WHERE aid={$this->aid} AND deleted=0");
        $results = $db->query("SELECT * FROM forum_post WHERE aid={$this->aid} AND deleted=0 ORDER BY time DESC LIMIT " . (($page - 1) * $number) . "," . $number);
        while ($row = $results->fetch_assoc()) {
            $HTML .= '<li><a href="allianz.php?s=2&amp;aid=' . $row['aid'] . '&amp;tid=' . $row['topicId'] . '">sdsds</a></li>';
        }
        $HTML .= '</ul>';
        $HTML .= '<div id="allyInfoForumPaginator" class="paginator">';
        $prefix['s'] = 7;
        $nav = new PageNavigator($page, $total, $number, $prefix, "allianz.php");
        $HTML .= $nav->get(TRUE);
        $HTML .= '</div>';
        $HTML .= '</div><br />';
        return $HTML;
    }

    public function news($number)
    {
        $number = min(max(1, (int)$number[1]), 99);
        $db = DB::getInstance();
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $total = $db->fetchScalar("SELECT COUNT(id) FROM ali_log WHERE aid={$this->aid}");
        $HTML = '<h4 class="chartHeadline">' . T("BBCode", "Alliance Events") . '</h4>';
        $HTML .= '<table cellpadding="1" cellspacing="1" class="events">';
        $HTML .= '<tbody>';
        $results = $db->query("SELECT * FROM ali_log WHERE aid={$this->aid} ORDER BY time DESC LIMIT " . (($page - 1) * $number) . "," . $number);
        while ($row = $results->fetch_assoc()) {
            $HTML .= '<tr>';
            $HTML .= '<td class="event">' . BBCode::renderAliNewsEvent($row['data']) . '</td>';
            $HTML .= '<td class="dat">' . TimezoneHelper::autoDateString($row['time'], TRUE) . '</td>';
            $HTML .= '</tr>';
        }
        $HTML .= '</tbody>';
        $HTML .= '</table>';
        $HTML .= '<div id="allyInfoNewsPaginator" class="paginator">';
        $prefix['s'] = 7;
        $nav = new PageNavigator($page, $total, $number, $prefix, "allianz.php");
        $HTML .= $nav->get(TRUE);
        $HTML .= '</div><br />';
        return $HTML;
    }

    public function StrengthOfOwnAlliance()
    {
        //The strength of the own alliance will show you the sum of the attack points as well as sum of the defense points of your alliance over the last 7 days (if you go with the mouse over the different bars, you will see the concrete numbers). Basically, this graph shows you the military strength of your alliance.
        $db = DB::getInstance();
        $stats = $db->query("SELECT * FROM alistats WHERE aid={$this->aid} ORDER BY time DESC LIMIT 7");
        $HTML = '<h4 class="chartHeadline">' . T("BBCode", "Strength of own alliance") . '</h4>';
        $dates = $bars = '';
        $maxAttackPoint = $db->fetchScalar("SELECT MAX(total_off_point) FROM alistats WHERE aid={$this->aid} ORDER BY time DESC LIMIT 7");
        $maxDefensePoint = $db->fetchScalar("SELECT MAX(total_def_point) FROM alistats WHERE aid={$this->aid} ORDER BY time DESC LIMIT 7");
        $results = [];
        while ($row = $stats->fetch_assoc()) {
            $results[] = $row;
        }
        for ($i = 6; $i >= 0; --$i) {
            if (isset($results[$i])) {
                $percent1 = $results[$i]['total_off_point'] / ($maxAttackPoint > 0 ? $maxAttackPoint : 1) * 100;
                $percent2 = $results[$i]['total_def_point'] / ($maxDefensePoint > 0 ? $maxDefensePoint : 1) * 100;
                $dates .= '<td>' . TimezoneHelper::date("d.m", $results[$i]['time']) . '. </td>';
                $bars .= '<td class="bar positive"><div class="wrapper"><div class="bar left red" title="' . $results[$i]['total_off_point'] . '" style="height: ' . $percent1 . '%;"></div><div class="bar right blue" title="' . $results[$i]['total_def_point'] . '" style="height: ' . $percent2 . '%;"></div><div class="clear"></div></div></td>';
            } else {
                $dates .= '<td>' . TimezoneHelper::date("d.m",
                        (isset($results[0]['time']) ? $results[0]['time'] : time()) - $i * 86400) . '. </td>';
                $bars .= '<td class="bar positive"><div class="wrapper"><div class="bar left red" title="0" style="height: 0%;"></div><div class="bar right blue" title="0" style="height: 0%;"></div><div class="clear"></div></div></td>';
            }
        }
        $HTML .= '<table class="barChart oneDir" cellpadding="1" cellspacing="1">';
        $HTML .= '<tbody>';
        $HTML .= '<tr>' . $dates . '</tr>';
        $HTML .= '<tr>' . $bars . '</tr>';
        $HTML .= '<tr><td colspan="7" class="legend"><div class="legend red"></div>&nbsp;' . T("BBCode",
                "attack") . '<br/><div class="legend blue"></div>&nbsp;' . T("BBCode",
                "defense") . '<br/><div class="clear"></div></td></tr>';
        $HTML .= '</body></table><br />';
        return $HTML;
    }

    public function FightingPoints()
    {
        //The fighting points will show you the sum of the attack points as well as sum of the defense points made by your alliance over the last 7 days (if you go with the mouse over the different bars you will see the concrete number). So this graph shows you the military activity of your alliance.
        $db = DB::getInstance();
        $stats = $db->query("SELECT * FROM alistats WHERE aid={$this->aid} ORDER BY time DESC LIMIT 7");
        $HTML = '<h4 class="chartHeadline">' . T("BBCode", "Fighting points (difference to yesterday)") . '</h4>';
        $dates = $bars = $bars2 = '';
        $maxAttackPoint = $db->fetchScalar("SELECT MAX(total_off_point) FROM alistats WHERE aid={$this->aid} ORDER BY time DESC LIMIT 7");
        $maxDefensePoint = $db->fetchScalar("SELECT MAX(total_def_point) FROM alistats WHERE aid={$this->aid} ORDER BY time DESC LIMIT 7");
        $results = [];
        while ($row = $stats->fetch_assoc()) {
            $results[] = $row;
        }
        for ($i = 6; $i >= 0; --$i) {
            if (!isset($results[$i])) {
                $dates .= '<td>' . TimezoneHelper::date("d.m",
                        (isset($results[0]['time']) ? $results[0]['time'] : time()) - $i * 86400) . '. </td>';
                $bars .= '<td class="bar positive"><div class="wrapper"><div class="bar left red" title="0" style="height: 0%;"></div><div class="bar right blue" title="0" style="height: 0%;"></div><div class="clear"></div></div></td>';
                $bars2 .= '<td class="bar positive"><div class="wrapper"><div class="bar left red" title="0" style="height: 0%;"></div><div class="bar right blue" title="0" style="height: 0%;"></div><div class="clear"></div></div></td>';
                continue;
            }
            $percent1 = $maxAttackPoint == 0 ? 0 : $results[$i]['total_off_point'] / $maxAttackPoint * 100;
            $percent2 = $maxDefensePoint == 0 ? 0 : $results[$i]['total_def_point'] / $maxDefensePoint * 100;
            $dates .= '<td>' . TimezoneHelper::date("d.m", $results[$i]['time']) . '. </td>';
            $bars .= '<td class="bar positive"><div class="wrapper"><div class="bar left red" title="' . $results[$i]['total_off_point'] . '" style="height: ' . $percent1 . '%;"></div><div class="bar right blue" title="' . $results[$i]['total_def_point'] . '" style="height: ' . $percent2 . '%;"></div><div class="clear"></div></div></td>';
            if (!isset($results[$i + 1])) {
                $bars2 .= '<td class="bar positive"><div class="wrapper"><div class="bar left red" title="0" style="height: 0%;"></div><div class="bar right blue" title="0" style="height: 0%;"></div><div class="clear"></div></div></td>';
                continue;
            }
            $percent1 = $results[$i + 1]['total_off_point'] / ($maxAttackPoint > 0 ? $maxAttackPoint : 1) * 100;
            $percent2 = $results[$i + 1]['total_def_point'] / ($maxDefensePoint > 0 ? $maxDefensePoint : 1) * 100;
            $bars2 .= '<td class="bar positive"><div class="wrapper"><div class="bar left red" title="' . $results[$i]['total_off_point'] . '" style="height: ' . $percent1 . '%;"></div><div class="bar right blue" title="' . $results[$i]['total_def_point'] . '" style="height: ' . $percent2 . '%;"></div><div class="clear"></div></div></td>';
        }
        $HTML .= '<table class="barChart twoDirs" cellpadding="1" cellspacing="1">';
        $HTML .= '<tbody>';
        $HTML .= '<tr>' . $dates . '</tr>';
        $HTML .= '<tr>' . $bars . '</tr>';
        $HTML .= '<tr>' . $bars2 . '</tr>';
        $HTML .= '<tr><td colspan="7" class="legend"><div class="legend red"></div>&nbsp;' . T("BBCode",
                "attack") . '<br/><div class="legend blue"></div>&nbsp;' . T("BBCode",
                "defense") . '<br/><div class="clear"></div></td></tr>';
        $HTML .= '</body></table><br />';
        return $HTML;
    }

    public function losses($match)
    {
        $db = DB::getInstance();
        $tag = $db->real_escape_string(filter_var($match[1], FILTER_SANITIZE_STRING));
        $find = $db->query("SELECT id FROM alidata WHERE tag='$tag'");
        if (!$find->num_rows) {
            return T("BBCode", "This alliance cannot be found");
        }
        $aid = $find->fetch_assoc()['id'];
        $stats = $db->query("SELECT * FROM alistats WHERE aid=$aid ORDER BY time DESC LIMIT 7");
        $HTML = '<h4 class="chartHeadline">' . sprintf(T("BBCode", "Losses compared to alliance"), $name) . '</h4>';
        $dates = $bars = '';
        $results = [];
        $size = $stats->num_rows;
        $max_killed_by = 0;
        $max_stolen_by = 0;
        $max_killed_of = 0;
        $max_stolen_of = 0;
        while ($row = $stats->fetch_assoc()) {
            if ($row['stolen_of'] > $max_stolen_of) {
                $max_stolen_of = $row['stolen_of'];
            }
            if ($row['stolen_by'] > $max_stolen_by) {
                $max_stolen_by = $row['stolen_by'];
            }
            if ($row['killed_of'] > $max_killed_of) {
                $max_killed_of = $row['killed_of'];
            }
            if ($row['killed_by'] > $max_killed_by) {
                $max_killed_by = $row['killed_by'];
            }
            $results[] = $row;
        }
        for ($i = 6; $i >= 0; --$i) {
            if (!isset($results[$i])) {
                $dates .= '<td>' . TimezoneHelper::date("d.m", $results[0]['time'] - $i * 86400) . '. </td>';
                $bars .= '<td class="bar positive">
							<div class="wrapper">
								<div class="stackedWrapper left" style="height: 0%;">
									<div class="bar top tomato" title="0" style="height: 0%;">
									</div>
									<div class="bar red" title="0" style="height: 0%;">
									</div>
								</div>
								<div class="stackedWrapper right" style="height: 0%;">
									<div class="bar top cornflowerblue" title="0" style="height: 0%;">
									</div>
									<div class="bar blue" title="0" style="height: 0%;">
									</div>
								</div>
								<div class="clear"></div>
							</div>
						</td>';
            } else {
                $dates .= '<td>' . TimezoneHelper::date("d.m", $results[$i]['time']) . '. </td>';
                $compare_alliance_gain_troops_percent = $max_killed_by == 0 ? 0 : ($results[$i]['killed_by'] / $max_killed_by * 100);
                $compare_alliance_gain_resource_percent = $max_stolen_by == 0 ? 0 : ($results[$i]['stolen_by'] / $max_stolen_by * 100);
                $total_percent = min($compare_alliance_gain_troops_percent + $compare_alliance_gain_resource_percent,
                    100);
                $compare_alliance_killed_of = $max_killed_of == 0 ? 0 : ($results[$i]['killed_of'] / $max_killed_of * 100);
                $compare_alliance_stolen_of = $max_stolen_of == 0 ? 0 : ($results[$i]['stolen_ofs'] / $max_stolen_of * 100);
                $total_percent2 = min($compare_alliance_killed_of + $compare_alliance_stolen_of, 100);
                $bars .= '<td class="bar positive">
							<div class="wrapper">
								<div class="stackedWrapper left" style="height: ' . $total_percent . '%;">
									<div class="bar top tomato" title="' . $results[$i]['killed_by'] . '" style="height: ' . $compare_alliance_gain_troops_percent . '%;">
									</div>
									<div class="bar red" title="' . $results[$i]['stolen_by'] . '" style="height: ' . $compare_alliance_gain_resource_percent . '%;">
									</div>
								</div>
								<div class="stackedWrapper right" style="height: ' . $total_percent2 . '%;">
									<div class="bar top cornflowerblue" title="' . $results[$i]['killed_of'] . '" style="height: ' . $compare_alliance_killed_of . '%;">
									</div>
									<div class="bar blue" title="' . $results[$i]['stolen_of'] . '" style="height: ' . $compare_alliance_stolen_of . '%;">
									</div>
								</div>
								<div class="clear"></div>
							</div>
						</td>';
            }
        }
        $HTML .= '<table class="barChart oneDir" cellpadding="1" cellspacing="1">';
        $HTML .= '<tbody>';
        $HTML .= '<tr>' . $dates . '</tr>';
        $HTML .= '<tr>' . $bars . '</tr>';
        $HTML .= '<tr><td colspan="7" class="legend"><div class="legend tomato"></div>&nbsp;' . sprintf(T("BBCode",
                "troops destroyed by alliance Ally"),
                $name) . '<br><div class="legend red"></div>&nbsp;' . sprintf(T("BBCode",
                "resources stolen by alliance Ally"),
                $name) . '<br><div class="legend cornflowerblue"></div>&nbsp;' . sprintf(T("BBCode",
                "troops destroyed of alliance Ally"),
                $name) . '<br><div class="legend blue"></div>&nbsp;' . sprintf(T("BBCode",
                "resources stolen of alliance Ally"),
                $name) . '<br><div class="clear"></div></td></tr>';
        $HTML .= '</body></table><br />';
        return $HTML;
    }
}

class BBCode
{
    private static $from_uid = null;
    private static $to_uid   = null;

    public static function setFromPlayer($from_uid)
    {
        self::$from_uid = $from_uid;
    }

    public static function setToPlayer($to_uid)
    {
        self::$to_uid = $to_uid;
    }

    public static function renderAliNewsEvent($data)
    {
        $db = DB::getInstance();
        $params = explode(":", $data);
        $event = '';
        switch ($params[0]) {
            case AllianceModel::LOG_DIPLOMACY_CONF:
                $tag1 = $db->fetchScalar("SELECT tag FROM alidata WHERE id={$params[1]}");
                if (!$tag1) {
                    $tag1 = '<span class="none2">[?]</span>';
                }
                $tag2 = $db->fetchScalar("SELECT tag FROM alidata WHERE id={$params[2]}");
                if (!$tag2) {
                    $tag2 = '<span class="none2">[?]</span>';
                }
                $event = sprintf(T("BBCode", "x has offered a confederacy to y"),
                    '<a href="allianz.php?aid=' . $params[1] . '">' . $tag1 . '</a>',
                    '<a href="allianz.php?aid=' . $params[2] . '">' . $tag2 . '</a>');
                break;
            case AllianceModel::LOG_DIPLOMACY_CONF_ACCEPTED:
                $tag1 = $db->fetchScalar("SELECT tag FROM alidata WHERE id={$params[1]}");
                if (!$tag1) {
                    $tag1 = '<span class="none2">[?]</span>';
                }
                $event = sprintf(T("BBCode", "x has accepted a confederacy to y"),
                    '<a href="allianz.php?aid=' . $params[1] . '">' . $tag1 . '</a>');
                break;
            case AllianceModel::LOG_DIPLOMACY_CONF_REFUSE:
                $tag1 = $db->fetchScalar("SELECT tag FROM alidata WHERE id={$params[1]}");
                if (!$tag1) {
                    $tag1 = '<span class="none2">[?]</span>';
                }
                $tag2 = $db->fetchScalar("SELECT tag FROM alidata WHERE id={$params[2]}");
                if (!$tag2) {
                    $tag2 = '<span class="none2">[?]</span>';
                }
                $event = sprintf(T("BBCode", "x has refused a confederacy to y"),
                    '<a href="allianz.php?aid=' . $params[1] . '">' . $tag1 . '</a>',
                    '<a href="allianz.php?aid=' . $params[2] . '">' . $tag2 . '</a>');
                break;
            case AllianceModel::LOG_DIPLOMACY_NAP_ACCEPTED:
                $tag1 = $db->fetchScalar("SELECT tag FROM alidata WHERE id={$params[1]}");
                if (!$tag1->num_rows) {
                    $tag1 = '<span class="none2">[?]</span>';
                }
                $event = sprintf(T("BBCode", "x has accepted nap to y"),
                    '<a href="allianz.php?aid=' . $params[1] . '">' . $tag1 . '</a>');
                break;
            case AllianceModel::LOG_DIPLOMACY_NAP_REFUSE:
                $tag1 = $db->fetchScalar("SELECT tag FROM alidata WHERE id={$params[1]}");
                if (!$tag1) {
                    $tag1 = '<span class="none2">[?]</span>';
                }
                $event = sprintf(T("BBCode", "x has refused nap to y"),
                    '<a href="allianz.php?aid=' . $params[1] . '">' . $tag1 . '</a>');
                break;
            case AllianceModel::LOG_DIPLOMACY_WAR_ACCEPTED:
                $tag1 = $db->fetchScalar("SELECT tag FROM alidata WHERE id={$params[1]}");
                if (!$tag1) {
                    $tag1 = '<span class="none2">[?]</span>';
                }
                $event = sprintf(T("BBCode", "x has accepted war to y"),
                    '<a href="allianz.php?aid=' . $params[1] . '">' . $tag1 . '</a>');
                break;
            case AllianceModel::LOG_DIPLOMACY_WAR_REFUSE:
                $tag1 = $db->fetchScalar("SELECT tag FROM alidata WHERE id={$params[1]}");
                if (!$tag1) {
                    $tag1 = '<span class="none2">[?]</span>';
                }
                $tag2 = $db->fetchScalar("SELECT tag FROM alidata WHERE id={$params[2]}");
                if (!$tag2) {
                    $tag2 = '<span class="none2">[?]</span>';
                }
                $event = sprintf(T("BBCode", "x has refused war to y"),
                    '<a href="allianz.php?aid=' . $params[1] . '">' . $tag1 . '</a>',
                    '<a href="allianz.php?aid=' . $params[2] . '">' . $tag2 . '</a>');
                break;
            case AllianceModel::LOG_DIPLOMACY_WAR:
                $tag1 = $db->fetchScalar("SELECT tag FROM alidata WHERE id={$params[1]}");
                if (!$tag1) {
                    $tag1 = '<span class="none2">[?]</span>';
                }
                $tag2 = $db->fetchScalar("SELECT tag FROM alidata WHERE id={$params[2]}");
                if (!$tag2) {
                    $tag2 = '<span class="none2">[?]</span>';
                }
                $event = sprintf(T("BBCode", "x has offered war to y"),
                    '<a href="allianz.php?aid=' . $params[1] . '">' . $tag1 . '</a>',
                    '<a href="allianz.php?aid=' . $params[2] . '">' . $tag2 . '</a>');
                break;
            case AllianceModel::LOG_DIPLOMACY_NAP:
                $tag1 = $db->fetchScalar("SELECT tag FROM alidata WHERE id={$params[1]}");
                if (!$tag1) {
                    $tag1 = '<span class="none2">[?]</span>';
                }
                $tag2 = $db->fetchScalar("SELECT tag FROM alidata WHERE id={$params[2]}");
                if (!$tag2) {
                    $tag2 = '<span class="none2">[?]</span>';
                }
                $event = sprintf(T("BBCode", "x has offered nap to y"),
                    '<a href="allianz.php?aid=' . $params[1] . '">' . $tag1 . '</a>',
                    '<a href="allianz.php?aid=' . $params[2] . '">' . $tag2 . '</a>');
                break;
            case AllianceModel::LOG_JOINED:
                $event = sprintf(T("BBCode", "X joined Alliance"),
                    '<a href="spieler.php?uid=' . $params[1] . '">' . $params[2] . '</a>');
                break;
            case AllianceModel::LOG_LEFT:
                $name = $db->fetchScalar("SELECT name FROM users WHERE id={$params[1]}");
                if(empty($name)){
                    $name = '[?]';
                }
                $event = sprintf(T("BBCode", "X left Alliance"), '<a href="spieler.php?uid=' . $params[1] . '">' . $name . '</a>');
                break;
            case AllianceModel::LOG_KICK:
                $event = sprintf(T("BBCode", "X kicked Y from Alliance"),
                    '<a href="spieler.php?uid=' . $params[1] . '">' . $params[2] . '</a>',
                    '<a href="spieler.php?uid=' . $params[3] . '">' . $params[4] . '</a>');
                break;
            case AllianceModel::LOG_NEW_VILLAGE:
                $event = sprintf(T("BBCode", "X created new village"),
                    '<a href="spieler.php?uid=' . $params[1] . '">' . $params[2] . '</a>');
                break;
            case AllianceModel::LOG_INVITE:
                $event = sprintf(T("BBCode", "X invited Y"),
                    '<a href="spieler.php?uid=' . $params[1] . '">' . $params[2] . '</a>',
                    '<a href="spieler.php?uid=' . $params[3] . '">' . $params[4] . '</a>');
                break;
        }
        return $event;
    }

    public static function BBCodeProfile($desc1, $desc2, $isAlliance, $id)
    {
        $MedalsBBCode = new MedalsBBCode();
        $data = [];
        $data['isAlliance'] = $isAlliance;
        if ($isAlliance) {
            $data['aid'] = $id;
        } else {
            $data['uid'] = $id;
        }
        $MedalsBBCode->data = $data;
        $desc1 = preg_replace_callback("/\[\#(.*?)\]/", [$MedalsBBCode, "BBCodeMedals",], $desc1);
        $desc2 = preg_replace_callback("/\[\#(.*?)\]/", [$MedalsBBCode, "BBCodeMedals",], $desc2);
        $desc1 = preg_replace_callback("/\[c(.*?)\]/", [$MedalsBBCode, "BBCodeMedals2",], $desc1);
        $desc2 = preg_replace_callback("/\[c(.*?)\]/", [$MedalsBBCode, "BBCodeMedals2",], $desc2);
        if ($data['isAlliance']) {
            $allianceBBCode = new AllianceBBCode();
            $allianceBBCode->aid = $data['aid'];
            $desc1 = preg_replace_callback("/\[diplomatie\]/", [$allianceBBCode, "Diplomacy",], $desc1);
            $desc2 = preg_replace_callback("/\[diplomatie\]/", [$allianceBBCode, "Diplomacy",], $desc2);
            $desc1 = preg_replace_callback("/\[nap\]/", [$allianceBBCode, "nap",], $desc1);
            $desc2 = preg_replace_callback("/\[nap\]/", [$allianceBBCode, "nap",], $desc2);
            $desc1 = preg_replace_callback("/\[war\]/", [$allianceBBCode, "war",], $desc1);
            $desc2 = preg_replace_callback("/\[war\]/", [$allianceBBCode, "war",], $desc2);
        }
        return [nl2br(trim($desc1)), nl2br(trim($desc2))];
    }

    public static function BBCodeInternalPage($input, $aid)
    {
        $input = self::translateMessagesBBCode($input);
        $allianceBBCode = new AllianceBBCode();
        $allianceBBCode->aid = $aid;
        $input = preg_replace_callback("#\[forum\](.*?)\[/forum\]#is", [$allianceBBCode, "forum",], $input);
        $input = preg_replace_callback("#\[news\](.*?)\[/news\]#is", [$allianceBBCode, "news",], $input);
        $input = preg_replace_callback("#\[stats\]strength\[/stats\]#is",
            [$allianceBBCode, "StrengthOfOwnAlliance",],
            $input);
        $input = preg_replace_callback("#\[stats\]fightingpoints\[/stats\]#is",
            [$allianceBBCode, "FightingPoints",],
            $input);
        $input = preg_replace_callback("#\[stats\]fighting points\[/stats\]#is",
            [$allianceBBCode, "FightingPoints",],
            $input);
        $input = preg_replace_callback("#\[stats\]fightingpower\[/stats\]#is",
            [$allianceBBCode, "StrengthOfOwnAlliance",],
            $input);
        $input = preg_replace_callback("#\[losses\](.*?)\[/losses\]#is", [$allianceBBCode, "losses",], $input);
        return $input;
    }

    public static function translateMessagesBBCode($input)
    {
        $input = preg_replace('/ ?(?:.*)spieler\.php\?uid=([0-9]+)/', '[player]$1[/player]', $input);
        $input = preg_replace('/ ?(?:.*)allianz\.php\?aid=([0-9]+)/', '[alliance]$1[/alliance]', $input);
        $input = preg_replace('/ ?(?:.*)karte\.php\?x=([\-0-9]+)&y=([\-0-9]+)/', '[x|y]$1|$2[/x|y]', $input);
        $input = preg_replace('/ ?(?:.*)position_details\.php\?x=([\-0-9]+)&y=([\-0-9]+)/', '[x|y]$1|$2[/x|y]', $input);
        $input = preg_replace('/ ?(?:.*)karte\.php\?kid=([\-0-9]+)/', '[x|y]$1[/x|y]', $input);
//        preg_match_all('/\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i', $input, $result, PREG_PATTERN_ORDER);
//        foreach($result[0] as $link){
//            $parsed_url = parse_url($link);
//            if(strpos($parsed_url['path'], 'reports.php')){
//                if($parsed_url['host'] == WebService::getJustSubDomain()){
//                    $input = str_replace($link, '[report]'.$link.'[/report]', $input);
//                }
//            }
//        }
        $pattern = [];
        $replace = [];
        $replace[] = "<b>$1</b>";
        $replace[] = "<i>$1</i>";
        $replace[] = "<u>$1</u>";
        $pattern[] = "/\[b\](.*?)\[\/b\]/is";
        $pattern[] = "/\[i\](.*?)\[\/i\]/is";
        $pattern[] = "/\[u\](.*?)\[\/u\]/is";
        $pattern[] = "/\[hero\]/";
        $replace[] = "<img class='unit uhero' src='img/x.gif' title='" . T("Troops",
                "hero.title") . "' alt='" . T("Troops", "hero.title") . "'>";
        $pattern[] = "/\[l\]/";
        $pattern[] = "/\[cl\]/";
        $pattern[] = "/\[ir\]/";
        $pattern[] = "/\[c\]/";
        $pattern[] = "/\*aha\*/";
        $pattern[] = "/\*angry\*/";
        $pattern[] = "/\*cool\*/";
        $pattern[] = "/\*cry\*/";
        $pattern[] = "/\*cute\*/";
        $pattern[] = "/\*depressed\*/";
        $pattern[] = "/\*eek\*/";
        $pattern[] = "/\*ehem\*/";
        $pattern[] = "/\*emotional\*/";
        $pattern[] = "/\:D/";
        $pattern[] = "/\:\)/";
        $pattern[] = "/\*hit\*/";
        $pattern[] = "/\*hmm\*/";
        $pattern[] = "/\*hmpf\*/";
        $pattern[] = "/\*hrhr\*/";
        $pattern[] = "/\*huh\*/";
        $pattern[] = "/\*lazy\*/";
        $pattern[] = "/\*love\*/";
        $pattern[] = "/\*nocomment\*/";
        $pattern[] = "/\*noemotion\*/";
        $pattern[] = "/\*notamused\*/";
        $pattern[] = "/\*pout\*/";
        $pattern[] = "/\*redface\*/";
        $pattern[] = "/\*rolleyes\*/";
        $pattern[] = "/\:\(/";
        $pattern[] = "/\*shy\*/";
        $pattern[] = "/\*smile\*/";
        $pattern[] = "/\*tongue\*/";
        $pattern[] = "/\*veryangry\*/";
        $pattern[] = "/\*veryhappy\*/";
        $pattern[] = "/\;\)/";
        $pattern[] = "/\[játékos\](.*?)\[\/játékos\]/is";
        $replace[] = "<img src='img/x.gif' class='r1' title='Lumber' alt='Lumber'>";
        $replace[] = "<img src='img/x.gif' class='r2' title='Clay' alt='Clay'>";
        $replace[] = "<img src='img/x.gif' class='r3' title='Iron' alt='Iron'>";
        $replace[] = "<img src='img/x.gif' class='r4' title='Crop' alt='Crop'>";
        $replace[] = "<img class='smiley aha' src='img/x.gif' alt='*aha*' title='*aha*'>";
        $replace[] = "<img class='smiley angry' src='img/x.gif' alt='*angry*' title='*angry*'>";
        $replace[] = "<img class='smiley cool' src='img/x.gif' alt='*cool*' title='*cool*'>";
        $replace[] = "<img class='smiley cry' src='img/x.gif' alt='*cry*' title='*cry*'>";
        $replace[] = "<img class='smiley cute' src='img/x.gif' alt='*cute*' title='*cute*'>";
        $replace[] = "<img class='smiley depressed' src='img/x.gif' alt='*depressed*' title='*depressed*'>";
        $replace[] = "<img class='smiley eek' src='img/x.gif' alt='*eek*' title='*eek*'>";
        $replace[] = "<img class='smiley ehem' src='img/x.gif' alt='*ehem*' title='*ehem*'>";
        $replace[] = "<img class='smiley emotional' src='img/x.gif' alt='*emotional*' title='*emotional*'>";
        $replace[] = "<img class='smiley grin' src='img/x.gif' alt=':D' title=':D'>";
        $replace[] = "<img class='smiley happy' src='img/x.gif' alt=':)' title=':)'>";
        $replace[] = "<img class='smiley hit' src='img/x.gif' alt='*hit*' title='*hit*'>";
        $replace[] = "<img class='smiley hmm' src='img/x.gif' alt='*hmm*' title='*hmm*'>";
        $replace[] = "<img class='smiley hmpf' src='img/x.gif' alt='*hmpf*' title='*hmpf*'>";
        $replace[] = "<img class='smiley hrhr' src='img/x.gif' alt='*hrhr*' title='*hrhr*'>";
        $replace[] = "<img class='smiley huh' src='img/x.gif' alt='*huh*' title='*huh*'>";
        $replace[] = "<img class='smiley lazy' src='img/x.gif' alt='*lazy*' title='*lazy*'>";
        $replace[] = "<img class='smiley love' src='img/x.gif' alt='*love*' title='*love*'>";
        $replace[] = "<img class='smiley nocomment' src='img/x.gif' alt='*nocomment*' title='*nocomment*'>";
        $replace[] = "<img class='smiley noemotion' src='img/x.gif' alt='*noemotion*' title='*noemotion*'>";
        $replace[] = "<img class='smiley notamused' src='img/x.gif' alt='*notamused*' title='*notamused*'>";
        $replace[] = "<img class='smiley pout' src='img/x.gif' alt='*pout*' title='*pout*'>";
        $replace[] = "<img class='smiley redface' src='img/x.gif' alt='*redface*' title='*redface*'>";
        $replace[] = "<img class='smiley rolleyes' src='img/x.gif' alt='*rolleyes*' title='*rolleyes*'>";
        $replace[] = "<img class='smiley sad' src='img/x.gif' alt=':(' title=':('>";
        $replace[] = "<img class='smiley shy' src='img/x.gif' alt='*shy*' title='*shy*'>";
        $replace[] = "<img class='smiley smile' src='img/x.gif' alt='*smile*' title='*smile*'>";
        $replace[] = "<img class='smiley tongue' src='img/x.gif' alt='*tongue*' title='*tongue*'>";
        $replace[] = "<img class='smiley veryangry' src='img/x.gif' alt='*veryangry*' title='*veryangry*'>";
        $replace[] = "<img class='smiley veryhappy' src='img/x.gif' alt='*veryhappy*' title='*veryhappy*'>";
        $replace[] = "<img class='smiley wink' src='img/x.gif' alt=';)' title=';)'>";
        $replace[] = "<a href='#'>$1</a>";
        $replace[] = "<a href='#'>$1</a>";
        if ((!is_null(self::$from_uid) && self::$from_uid <= 2) || (!is_null(self::$to_uid) && self::$to_uid <= 2)) {
            $input = preg_replace_callback('#(?<!href\=[\'"])(https?|ftp|file)://[-A-Za-z0-9+&@\#/%()?=~_|$!:,.;]*[-A-Za-z0-9+&@\#/%()=~_|$]#',
                'self::regexp_url_search',
                $input);
        }
        $input = preg_replace($pattern, $replace, $input);
        $input = preg_replace_callback("/\[tid(.*?)\]/", "self::BBCodeUnits", $input);
        $input = preg_replace_callback("#\[x\|y\](.*?)\[/x\|y\]#is", "self::BBCodeCoordinates", $input);
        $input = preg_replace_callback("#\[player\](.*?)\[/player\]#is", "self::BBCodePlayer", $input);
        $input = preg_replace_callback("#\[alliance\](.*?)\[/alliance\]#is", "self::BBCodeAlliance", $input);
        $input = preg_replace_callback("#\[report\](.*?)\[/report\]#is", "self::BBCodeReport", $input);
        $input = preg_replace_callback("#\[url=(.*?)\](.*?)\[/url\]#is", "self::BBCodeUrl", $input);
        $input = preg_replace_callback("#\[url\](.*?)\[/url\]#is", "self::BBCodeUrl", $input);
        $input = preg_replace_callback("#\[color=(.*?)\](.*?)\[/color\]#is", "self::BBCodeColor", $input);
        return $input;
    }

    public static function getMedalCategory($type)
    {
        return T("Medals", "names." . $type);
    }

    public static function getMedal2Category($row)
    {
        return sprintf(T("Profile", "SpecialMedalsTitle." . $row['type']), $row['worldId']);
    }

    private static function regexp_url_search($matches)
    {
        return '[url]' . $matches[0] . '[/url]';
    }

    private static function BBCodeUnits($matches)
    {
        if ($matches[1] < 1 || $matches[1] > 50) {
            return $matches[0];
        }
        return '<img class="unit u' . $matches[1] . '" src="img/x.gif" title="' . T("Troops",
                $matches[1] . ".title") . '" alt="' . T("Troops", $matches[1] . ".title") . '">';
    }

    private static function BBCodeCoordinates($matches)
    {
        if (is_numeric($matches[1])) {
            $coordinate = array_values(Formulas::kid2xy($matches[1]));
        } else {
            $coordinate = explode("|", $matches[1]);
        }
        if (sizeof($coordinate) < 2) {
            return '';
        }
        $kid = Formulas::xy2kid($coordinate[0], $coordinate[1]);
        $db = DB::getInstance();
        $coordinate = ' <span class="coordinates coordinatesWrapper"><span class="coordinateX">(‭' . $coordinate[0] . '‬‬</span><span class="coordinatePipe">|</span><span class="coordinateY">‭' . $coordinate[1] . '‬‬)</span></span>';
        $find = $db->query("SELECT fieldtype, oasistype, landscape, occupied FROM wdata WHERE id=$kid")->fetch_assoc();
        if ($find['landscape']) {
            return '<a href="karte.php?d=' . $kid . '">' . T("Global", "Wilderness") . $coordinate . '</a>';
        } else if ($find['oasistype']) {
            return '<a href="karte.php?d=' . $kid . '">' . T("Global",
                    $find['occupied'] ? 'OccupiedOasis' : 'unOccupiedOasis') . $coordinate . '</a>';
        } else {
            if (!$find['occupied']) {
                return '<a href="karte.php?d=' . $kid . '">' . T("Global", 'Abandoned valley') . $coordinate . '</a>';
            }
            $villageName = $db->fetchScalar("SELECT name FROM vdata WHERE kid=$kid");
            return '<a href="karte.php?d=' . $kid . '">' . $villageName . $coordinate . '</a>';
        }
    }

    private static function BBCodePlayer($matches)
    {
        $db = DB::getInstance();
        $name = filter_var($matches[1], FILTER_SANITIZE_STRING);
        if(is_numeric($name)){
            $name = (int) $name;
            $find = $db->query("SELECT id, name FROM users WHERE id=$name");
        } else {
            $name = $db->real_escape_string($name);
            $find = $db->query("SELECT id, name FROM users WHERE name='$name'");
        }
        if (!$find->num_rows) {
            return '<span style="font-style:italic;">' . T("Global", "Player not found") . '</span>';
        }
        $find = $find->fetch_assoc();
        return '<a href="spieler.php?uid=' . $find['id'] . '">' . $find['name'] . '</a>';
    }

    private static function BBCodeAlliance($matches)
    {
        $name = filter_var($matches[1], FILTER_SANITIZE_STRING);
        $db = DB::getInstance();
        if(is_numeric($name)){
            $name = (int) $name;
            $find = $db->query("SELECT id, name FROM alidata WHERE id=$name");
        } else {
            $name = $db->real_escape_string($name);
            $find = $db->query("SELECT id, name FROM alidata WHERE name='$name'");
        }
        if (!$find->num_rows) {
            return '<span style="font-style:italic;">' . T("Global", "Alliance not found") . '</span>';
        }
        $find = $find->fetch_assoc();
        return '<a href="allianz.php?aid=' . $find['id'] . '">' . $find['name'] . '</a>';
    }

    private static function BBCodeReport($matches)
    {
        $url = filter_var($matches[1], FILTER_SANITIZE_STRING);
        $reportMatch = [];
        $url = parse_url($url);
        if (!isset($url['query'])) {
            return '<span style="font-style:italic;">' . T("Global", "Invalid Report ID") . '</span>';
        }
        $query = $url['query'];
        parse_str($query, $reportMatch);
        $data = @explode("|", $reportMatch['id']);
        if (sizeof($reportMatch) == 1) {
            return '<span style="font-style:italic;">' . T("Global", "Invalid Report ID") . '</span>';
        }
        $id = filter_var($data[0], FILTER_SANITIZE_NUMBER_INT);
        if (!$id) {
            return $matches[0];
        }
        $private_key = filter_var($data[1], FILTER_SANITIZE_STRING);
        $db = DB::getInstance();
        $report = $db->query("SELECT * FROM ndata WHERE id=" . (int)$id);
        if (!$report->num_rows) {
            return '<span style="font-style:italic;">' . T("Global", "Invalid Report ID") . '</span>';
        }
        $report = $report->fetch_assoc();
        if ($private_key != $report['private_key']) {
            return '<span style="font-style:italic;">' . T("Global", "Invalid private key") . '</span>';
        }
        $m = new BerichteCtrl();
        return '<a href="reports.php?id=' . $id . '|' . $private_key . '">' . $m->getNoticeSubject($report,
                TRUE) . '</a>';
    }

    private static function BBCodeUrl($matches)
    {
        $title = null;
        if (sizeof($matches) == 3) {
            $title = str_replace("'", '', $matches[1]);
            $title = filter_var($title, FILTER_SANITIZE_STRING);
            $url = trim($matches[2]);
        } else {
            $url = $matches[1];
        }
        $parsed = parse_url($url);
        if (empty($parsed['scheme'])) {
            $url = 'http://' . ltrim($url, '/');
        }
        if ((!is_null(self::$from_uid) && self::$from_uid <= 2) || (!is_null(self::$to_uid) && self::$to_uid <= 2)) {
            return '<a href="' . $url . '" target="_blank">' . (is_null($title) ? $url : $title) . '</a>';
        }
        return $matches[1];
    }

    private static function BBCodeColor($matches)
    {
        $color = str_replace("'", '', $matches[1]);
        $color = filter_var($color, FILTER_SANITIZE_STRING);
        $text = $matches[2];
        if (strtolower($color) == 'white' || strtoupper($color) == '#FFFFFF') {
            return $text;
        }
        return '<span style="color: ' . $color . '">' . $text . '</span>';
    }
} 