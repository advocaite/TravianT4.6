<?php
use Core\Database\DB;
use Core\Helper\WebService;
use Core\Session;
use Model\InfoBoxModel;
if (!Session::getInstance()->isAdmin()) {
    WebService::redirect("/admin.php");
    return;
}

class PlayerHelper
{
    function banPlayer($uid, $reason, $time = 0)
    {
        $db = DB::getInstance();
        $uid = (int)$uid;
        $time = (int)$time;
        $reason = $db->real_escape_string($reason);
        $exists = 0 < $db->fetchScalar("SELECT COUNT(id) FROM banQueue WHERE uid=$uid");
        if (!$exists) {
            $db->query("UPDATE users SET access=0 WHERE id=$uid");
            if ($db->affectedRows()) {
                $db->query("INSERT INTO `banQueue`(`uid`, `reason`, `time`, `end`) VALUES ($uid, '$reason', " . time() . ", " . ($time == 0 ? $time : $time + time()) . ")");
                $db->query("INSERT INTO `banHistory`(`uid`, `reason`, `time`, `end`) VALUES ($uid, '$reason', " . time() . ", " . ($time == 0 ? $time : $time + time()) . ")");
                $db->query("DELETE FROM multiaccount_users WHERE uid=$uid");
                (new InfoBoxModel())->addInfo($uid, 0, 14, '', time(), time() + 365 * 86400);
            }
        }
    }
    function releaseBannedPlayer($uid)
    {
        $uid = (int)$uid;
        $db = DB::getInstance();
        $db->query("UPDATE users SET access=1 WHERE id=$uid");
        if ($db->affectedRows()) {
            (new InfoBoxModel())->deleteInfoByType($uid, 14);
        }
        $db->query("DELETE FROM banQueue WHERE uid=$uid");
    }
    function isDeleting($uid)
    {
        $db = DB::getInstance();
        $uid = (int)$uid;
        return 0 < $db->fetchScalar("SELECT COUNT(uid) FROM deleting WHERE uid=$uid");
    }
    function clearDeletion($uid)
    {
        $db = DB::getInstance();
        $db->query("DELETE FROM deleting WHERE uid=$uid");
    }
    function deletePlayer($uid)
    {
        $db = DB::getInstance();
        $uid = (int)$uid;
        $db->query("INSERT IGNORE INTO deleting (uid, time) VALUES ($uid, " . (time() + 600) . ")");
    }
    function getBannedStartTime($uid){
        $db = DB::getInstance();
        $uid = (int)$uid;
        $stmt = $db->query("SELECT * FROM banQueue WHERE uid=$uid");
        if(!$stmt->num_rows) return 'Unknown';
        $row = $stmt->fetch_assoc();
        return $this->getDiffTimeString(time() - $row['time']);
    }
    function getBannedEndTime($uid){
        $db = DB::getInstance();
        $uid = (int)$uid;
        $stmt = $db->query("SELECT * FROM banQueue WHERE uid=$uid");
        if(!$stmt->num_rows) return 'n/a';
        $row = $stmt->fetch_assoc();
        if($row['end'] == 0){
            return 'Never';
        }
        return $this->getDiffTimeString($row['end'] - $row['time']);
    }
    function getDiffTimeString($diff, $end = -1){
        if($end == 0){
            return 'Never';
        }
        if($diff > 86400){
            return round($diff/86400,1).'d';
        } else if($diff > 3600){
            return round($diff/3600,1).'h';
        }
        return round($diff/60,1).'m';
    }
}

$db = DB::getInstance();
?>
<head>
    <title>Helper</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
    <style type="text/css">
        table {
            table-layout: fixed;
            width: 100%;
        }

        @media only screen and (min-width: 900px) {
            .section {
                width: 900px;
            }
        }

        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        table thead tr {
            background-color: #cfcfcf;
        }

        table tbody tr:nth-child(even) {
            background-color: #eee;
        }

        table tbody tr:nth-child(odd) {
            background-color: #fff;
        }

        th, td {
            width: auto;
            padding: 5px;
            text-align: left;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .table-responsive table {
            margin: 0 auto;
        }

        .section {
            margin: 0 auto;
            padding-bottom: 15px;
            border-bottom: 1px solid black;
        }

        .section:last-child {
            border-bottom: none;
        }

        .section h3 {
            text-align: center;
        }

        table tbody td.noData {
            padding: 10px;
            text-align: center;
            color: #777;
        }

        .centered {
            text-align: center;
        }

        .btn {
            border: none;
            color: white;
            padding: 7px 10px;
            margin-bottom: 2px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
        }

        @media only screen and (max-width: 767px) {
            th, td .btn:last-child {
                margin-bottom: 0;
            }

            .btn {
                width: 100%;
            }
        }

        .btn.danger {
            background-color: #ff0000;
        }

        .btn.success {
            background-color: #4CAF50;
        }
        .btn.warning {
            background-color: #ff9800;
        }

        .clickable {
            cursor: pointer;
        }

        a {
            text-decoration: none;
        }

        .alert {
            padding: 20px;
            background-color: #f44336;
            color: white;
            font-weight: bold;
            margin-bottom: 15px;
            opacity: 1;
            transition: opacity 0.6s; /* 600ms to fade out */
        }

        .alert.alert-success {
            background-color: #4CAF50;
        }

        .alert.alert-info {
            background-color: #2196F3;
        }

        .alert.alert-warning {
            background-color: #ff9800;
        }

        .alert .closeBtn:after {
            content: '\274c';
        }

        .alert .closeBtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 14px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        .alert .closeBtn:hover {
            color: black;
        }

        .section.no-border-bottom {
            border-bottom: none;
            padding-bottom: 0;
        }

        .pull-right {
            float: right;
        }

        .pull-left {
            float: left;
        }

        .text-right {
            text-align: right;
        }
    </style>
</head>
<body>
<div class="content">
    <div class="section no-border-bottom">
        <?php
        function createAlert($message, $type = 'success')
        {
            return '<div class="alert alert-' . $type . '"><span class="closeBtn"></span>' . $message . '</div>';
        }

        $ban = new PlayerHelper();
        if (isset($_GET['banPlayer'])) {
            $ban = new PlayerHelper();
            $reason = 'Other';
            $time = isset($_GET['time']) && $_GET['time'] > 0 ? (int)$_GET['time'] : 0;
            if (isset($_GET['reason']) && in_array($_GET['reason'], ['Multiaccount'])) {
                $reason = trim($_GET['reason']);
            }
            $ban->banPlayer((int)$_GET['banPlayer'], $reason, $time);
            echo createAlert("Player with uid \"" . ((int)$_GET['banPlayer']) . "\" has been banned.");
        }
        if (isset($_GET['releaseBannedPlayer'])) {
            $ban->releaseBannedPlayer((int)$_GET['releaseBannedPlayer']);
            echo createAlert("Player with uid \"" . ((int)$_GET['releaseBannedPlayer']) . "\" has been released.");
        }
        if (isset($_GET['deletePlayer'])) {
            $ban->deletePlayer((int)$_GET['deletePlayer']);
            echo createAlert("Player with uid \"" . ((int)$_GET['deletePlayer']) . "\" has been set to be deleted in 10 minutes.");
        }
        if (isset($_GET['clearDeletion'])) {
            $ban->clearDeletion((int)$_GET['clearDeletion']);
            echo createAlert("Player with uid \"" . ((int)$_GET['clearDeletion']) . "\" is no longer being deleted.");
        }
        ?>
    </div>
    <div class="section no-border-bottom text-right">
        <button class="btn warning pull-left" onclick="window.location = 'admin.php';"><- Back to admin panel</button>
        <button class="btn success" onclick="window.location = window.location.pathname;">Refresh</button>
    </div>
    <div class="section">
        <h3>Silver moved</h3>
        <div class="table-responsive">
            <table>
                <thead>
                <tr>
                    <td class="centered">Player</td>
                    <td class="centered">Pop</td>
                    <td class="centered">Gold</td>
                    <td class="centered">Silver</td>
                    <td class="centered">Silver</td>
                    <td class="centered"></td>
                </tr>
                </thead>
                <tbody>
                <?php
                $auctions = $db->query("SELECT DISTINCT uid FROM auction a WHERE a.bids > 0 AND a.uid > 2 AND (SELECT access FROM users WHERE id=a.uid)=1 ORDER BY (SELECT SUM(silver) FROM auction WHERE uid=a.uid) DESC, a.uid ASC");
                $count = 0;
                while ($auc = $auctions->fetch_assoc()):
                    $user = $db->query("SELECT * FROM users WHERE id={$auc['uid']}")->fetch_assoc();
                    $totalMovedSilver = (int)$db->fetchScalar("SELECT SUM(silver) FROM auction WHERE bids > 0 AND uid={$auc['uid']}");
                    $totalBoughtSilver = (int)$db->fetchScalar("SELECT SUM(silver) FROM auction WHERE uid!=0 AND activeUid={$auc['uid']}");
                    if ($totalMovedSilver < 10000 && $totalBoughtSilver < 10000) continue;
                    $count++;
                    ?>
                    <tr>
                        <td>
                            <a href="spieler.php?uid=<?= ($auc['uid']); ?>">
                                [<?= ($auc['uid']); ?>] <?= ($user['name']); ?></a>
                        </td>
                        <td class="centered"><?= ($user['total_pop']); ?></td>
                        <td class="centered"><?= ($user['gift_gold']); ?> - <?= ($user['bought_gold']); ?></td>
                        <td class="centered"><?= ($user['silver']); ?></td>
                        <td class="centered">Sold: <?= $totalMovedSilver; ?> Bought: <?=$totalBoughtSilver;?></td>
                        <td class="centered">
                            <button class="btn clickable danger"
                                    onclick="window.location.href='?banPlayer=<?= $user['id']; ?>&reason=multiaccount'">
                                Ban Player
                            </button>
                        </td>
                    </tr>
                    <?php
                endwhile;
                if (!$count) {
                    echo '<tr><td colspan="6" class="noData">Nothing, Good!</td></tr>';
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="section">
        <h3>Multi accounts by Pop</h3>
        <div class="table-responsive">
            <table>
                <thead>
                <tr>
                    <td class="centered">Player</td>
                    <td class="centered">Pop</td>
                    <td class="centered">Gold</td>
                    <td class="centered"></td>
                </tr>
                </thead>
                <tbody>
                <?php
                $users = $db->query("SELECT DISTINCT a.* FROM users a JOIN users b ON a.total_pop = b.total_pop AND a.id != b.id AND a.id > 2 AND a.access=1 AND a.total_pop > 100");
                $count = 0;
                while ($row = $users->fetch_assoc()):
                    $count++;
                    ?>
                    <tr>
                        <td>
                            <a href="spieler.php?uid=<?= ($row['id']); ?>">
                                [<?= ($row['id']); ?>] <?= ($row['name']); ?>
                            </a>
                        </td>
                        <td class="centered"><?= ($row['total_pop']); ?></td>
                        <td class="centered"><?= ($row['gift_gold']); ?> - <?= ($row['bought_gold']); ?></td>
                        <td class="centered">
                            <button class="btn clickable danger"
                                    onclick="window.location.href='?banPlayer=<?= $row['id']; ?>&reason=Multiaccount'">
                                Ban Player
                            </button>
                        </td>
                    </tr>
                    <?php
                endwhile;
                if (!$count) {
                    echo '<tr><td colspan="4" class="noData">Nothing, Good!</td></tr>';
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="section">
        <h3>Banned players</h3>
        <div class="table-responsive">
            <table>
                <thead>
                <tr>
                    <td class="centered">Player</td>
                    <td class="centered">Pop</td>
                    <td class="centered">Banned</td>
                    <td class="centered"></td>
                </tr>
                </thead>
                <tbody>
                <?php
                $banned = $db->query("SELECT a.* FROM banQueue a ORDER BY time ASC, id ASC");
                $count = 0;
                while ($row = $banned->fetch_assoc()):
                    $user = $db->query("SELECT * FROM users WHERE id={$row['uid']}")->fetch_assoc();
                    $count++;
                    ?>
                    <tr>
                        <td>
                            <a href="spieler.php?uid=<?= ($user['id']); ?>">
                                [<?= ($user['id']); ?>] <?= ($user['name']); ?>
                            </a>
                        </td>
                        <td class="centered"><?= ($user['total_pop']); ?></td>
                        <td class="centered">
                            Start: <?= $ban->getDiffTimeString(time() - $row['time']);?>
                            <br />
                            Ends: <?= $ban->getDiffTimeString($row['end'] - $row['time'], $row['end']);?>
                        <td class="centered">
                            <button class="btn clickable success"
                                    onclick="window.location.href='?releaseBannedPlayer=<?= $user['id']; ?>'">
                                Unban Player
                            </button>
                            <?php if (!$ban->isDeleting($user['id'])): ?>
                                <button class="btn clickable danger"
                                        onclick="deletePlayer(<?= $user['id']; ?>, '<?= $user['name']; ?>')">
                                    Delete player
                                </button>
                            <?php else: ?>
                                <button class="btn clickable danger"
                                        onclick="window.location.href='?clearDeletion=<?= ($user['id']); ?>'">
                                    Deleting (-> Cancel)
                                </button>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php
                endwhile;
                if (!$count) {
                    echo '<tr><td colspan="4" class="noData">Nothing, Good!</td></tr>';
                }
                ?>
                </tbody>
            </table>
        </div>
        <script type="text/javascript">
            function deletePlayer(uid, name) {
                if (!confirm("Are you sure to delete player \"" + name + "\"?")) {
                    return;
                }
                window.location.href = '?deletePlayer=' + uid;
            }
            var close = document.getElementsByClassName("closeBtn");
            var i;
            for (i = 0; i < close.length; i++) {
                close[i].onclick = function () {
                    var div = this.parentElement;
                    div.style.opacity = "0";
                    setTimeout(function () {
                        div.style.display = "none";
                    }, 600);
                }
            }
        </script>
    </div>
</div>
</body>

