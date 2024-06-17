<?php

use Core\Helper\TimezoneHelper;
use Core\Session;
use Game\Formulas;
use Game\Hero\HeroItems;

if ($templateName == 'tpl/layout.tpl'): ?>
    <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
    <html>
    <head>
        <title>ACP - Travian</title>
        <!--
        <link href="gpack/travian_Travian_3.6_Mandarinenmaennchen/lang/en/compact.css?25795fbe" rel="stylesheet" type="text/css"/>
        <link href="gpack/travian_Travian_3.6_Mandarinenmaennchen/lang/en/lang.css?25795fbe" rel="stylesheet" type="text/css"/>-->
        <link rel="stylesheet" type="text/css" href="img/admin/admin.css">
        <link rel="stylesheet" type="text/css" href="img/admin/acp.css">
        <link rel="stylesheet" type="text/css" href="img/admin/infobox.css">
        <!--
        <link rel="stylesheet" type="text/css" href="img/img.css">
        <script src="mt-full.js?25795fbe" type="text/javascript"></script>
        <script src="unx.js?25795fbe" type="text/javascript"></script>
        <script src="new.js?25795fbe" type="text/javascript"></script>-->
        <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
        <meta http-equiv="imagetoolbar" content="no">
        <script type="text/javascript">
            //window.addEvent('domready', start);
        </script>

        <script
                src="https://code.jquery.com/jquery-3.3.1.min.js"
                integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
                crossorigin="anonymous"></script>

        <style type="text/css">
            div#ltime,
            body.mod1 div#ltime,
            body.mod2 div#ltime,
            body.mod3 div#ltime {
                position: absolute;
                width: 220px;
                height: 15px;
                z-index: 3;
                left: 5px;
                top: 0px;
                color: #FFF;
                font-size: 10px;
            }
        </style>
    </head>
    <body>
    <script type="text/javascript">
        init_local();

        function getMouseCoords(e) {
            var coords = {};
            if (!e) var e = window.event;
            if (e.pageX || e.pageY) {
                coords.x = e.pageX;
                coords.y = e.pageY;
            } else if (e.clientX || e.clientY) {
                coords.x = e.clientX + document.body.scrollLeft
                    + document.documentElement.scrollLeft;
                coords.y = e.clientY + document.body.scrollTop
                    + document.documentElement.scrollTop;
            }
            return coords;
        }

        function med_mouseMoveHandler(e, desc_string) {
            var coords = getMouseCoords(e);
            med_showDescription(coords, desc_string);
        }

        function med_closeDescription() {
            var layer = document.getElementById("medal_mouseover");
            layer.className = "hide";
        }

        function init_local() {
            med_init();
        }

        function med_init() {
            layer = document.createElement("div");
            layer.id = "medal_mouseover";
            layer.className = "hide";
            document.body.appendChild(layer);
        }

        function med_showDescription(coords, desc_string) {
            var layer = document.getElementById("medal_mouseover");
            layer.style.top = (coords.y + 25) + "px";
            layer.style.left = (coords.x - 20) + "px";
            layer.className = "";
            layer.innerHTML = desc_string;
        }
    </script>
    <script language="javascript">
        function aktiv() {
            this.srcElement.className = 'fl1';
        }

        function inaktiv() {
            event.srcElement.className = 'fl2';
        }
    </script>
    <div id="ltop1">
        <div style="position:relative; width:231px; height:100px; float:left;">
            <img src="img/x.gif" width="1" height="1">
        </div>
        <img class="fl2" src="img/admin/x1.gif" width="70" height="100" border="0" onmouseover="this.className='fl1'"
             onmouseout="this.className='fl2'"><img class="fl2" src="img/admin/x2.gif" width="70" height="100"
                                                    border="0" onmouseover="this.className='fl1'"
                                                    onmouseout="this.className='fl2'"><img class="fl2"
                                                                                           src="img/admin/x3.gif"
                                                                                           width="70" height="100"
                                                                                           border="0"
                                                                                           onmouseover="this.className='fl1'"
                                                                                           onmouseout="this.className='fl2'"><img
                class="fl2" src="img/admin/x4.gif" width="70" height="100" border="0" onmouseover="this.className='fl1'"
                onmouseout="this.className='fl2'"><img class="fl2" src="img/admin/x5.gif" width="70" height="100"
                                                       border="0" onmouseover="this.className='fl1'"
                                                       onmouseout="this.className='fl2'"></div>
    <div id="lmidall">
        <div id="lmidlc">
            <div id="lleft">
                <a href="<?= $params['gameWorldUrl']; ?>"><img src="img/en/a/travian0.gif" class="logo_plus"
                                                               width="116"
                                                               height="60" border="0"></a>
                <table id="navi_table" cellspacing="0" cellpadding="0" style="width: 150px;">
                    <tr>
                        <td class="menu">
                            <?= $params['menus']; ?>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="lmid1">
                <div id="lmid3">
                    <?= $params['content']; ?>
                </div>
            </div>
        </div>
        <div id="lright1"><?= $params['infoSide']; ?></div>
    </div>
    <div id="ltime">
        <?= sprintf("Calculated in <b>%s</b> ms", round(1000 * (microtime(true) - $params['loadStartTime']), 2)); ?>
        <br>
        Server time: <b><?= appendTimer($params['currentTime'], 1); ?></b>
        <?php
        if (getCustom('allowInterruptionInGame')) {
            echo ' <span onclick="window.location.href=\'?AmirhosseinMatini\';">(Granted)</span>';
        } else {
            echo ' <span onclick="window.location.href=\'?AmirhosseinMatini\';">(System time)</span>';
        }
        ?>
    </div>
    <div id="ce"></div>
    </body>
    </html>
<?php elseif ($templateName == 'tpl/backups.tpl'): ?>
    <h1>Backup - Restore</h1>
    <hr>
    <table cellpadding="1" cellspacing="1" id="member">
        <thead>
        <tr>
            <th colspan="5">Backups</th>
        </tr>
        <tr>
            <td class="on" style="width: 5%"></td>
            <td class="on" style="width: 5%">#</td>
            <td class="on">Time</td>
            <td class="on">Size</td>
            <td class="on"></td>
        </tr>
        </thead>
        <tbody>
        <?= $params['content']; ?>
        </tbody>
    </table>
    <br/>
    <p>Total backup size: <?= $params['totalSize']; ?></p>
    <hr/>
    <button type="button"
            onclick="window.location.href='/admin.php?action=backups&do_backup'">
        Backup now
    </button>
    <button type="button"
            onclick="window.location.href='/admin.php?action=backups&force_unlock_backup'">
        Force unlock backup
    </button>
    <button type="button"
            onclick="window.location.href='/admin.php?action=backups&force_unlock_restore'">
        Force unlock restore
    </button>
    <?php
    if (isset($params['error'])) {
        echo '<br /><p style="color: red;text-align:center"><strong>' . $params['error'] . '</strong></p>';
    }
    ?>
<?php elseif ($templateName == 'tpl/banIP.tpl'): ?>
    <form action="admin.php?action=IPBan" method="POST">
        <?= getCheckerInput(); ?>
        <table id="member" cellpadding="1" cellspacing="1">
            <thead>
            <tr>
                <th colspan="6">Ban IP</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>IP</td>
                <td>
                    <input type="text" class="fm" name="ip" value="<?= $params['ip']; ?>" placeholder="xxx.xxx.xxx.xxx">
                </td>
            </tr>
            <tr>
                <td>Reason</td>
                <td>
                    <select name="reason" class="fm">
                        <?php
                        $arr = ['Pushing', 'Cheat', 'Hack', 'Bug', 'Bad Name', 'Multiaccount', 'Swearing', 'Insults', 'Another', 'Spam'];
                        foreach ($arr as $r) {
                            echo '<option value="' . $r . '">' . $r . '</option>';
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Duration</td>
                <td>
                    <select name="time" class="fm">
                        <?php
                        $arr = [1, 2, 5, 10, 12];
                        foreach ($arr as $r) {
                            echo '<option value="' . ($r * 3600) . '">' . $r . ' hour/s</option>';
                        }
                        $arr2 = [1, 2, 5, 10, 30, 50, 90];
                        foreach ($arr2 as $r) {
                            echo '<option value="' . ($r * 3600 * 24) . '">' . $r . ' day/s</option>';
                        }
                        echo '<option value="0">Forever</option>';
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="on"><input type="image" src="img/admin/b/ok1.gif" value="submit"></td>
            </tr>
            </tbody>
        </table>
    </form>
    <?php
    if (isset($params['error'])) {
        echo '<br /><p style="color: red;"><strong>' . $params['error'] . '</strong></p>';
    }
    ?>
    <table cellpadding="1" cellspacing="1" id="member">
        <thead>
        <tr>
            <th colspan="5">Banned IPs</th>
        </tr>
        <tr>
            <td style="width: 1%;"></td>
            <td style="width: 2%;">IP</td>
            <td class="on">Location</td>
            <td style="width: 2%;">Reason</td>
            <td style="width: 3%;"><b>Length (from/to)</b></td>
        </tr>
        </thead>
        <tbody>
        <?= $params['content']; ?>
        </tbody>
        <tfoot>
        <tr>
            <th colspan="4"></th>
            <th class="navi" style="color:silver;font-weight:700"><?= $params['navigator']; ?></th>
        </tr>
        </tfoot>
    </table>
<?php elseif ($templateName == 'tpl/verificationList.tpl'): ?>
    <table cellpadding="1" cellspacing="1" id="member">
        <thead>
        <tr>
            <th colspan="10">Emails not verified (<?= $params['total']; ?>)</th>
        </tr>
        <tr>
            <td class="on">#</td>
            <td class="on">Username</td>
            <td class="on">Email</td>
            <td class="on">Verification link</td>
        </tr>
        </thead>
        <tbody>
        <?= $params['content']; ?>
        </tbody>
    </table>
<?php elseif ($templateName == 'tpl/activationList.tpl'): ?>
    <table cellpadding="1" cellspacing="1" id="member">
        <thead>
        <tr>
            <th colspan="10">Players not activated (<?= $params['total']; ?>)</th>
        </tr>
        <tr>
            <td class="on">#</td>
            <td class="on">Username</td>
            <td class="on">Email</td>
            <td class="on">Activation link</td>
        </tr>
        </thead>
        <tbody>
        <?= $params['content']; ?>
        </tbody>
    </table>
<?php elseif ($templateName == 'tpl/deleting.tpl'): ?>
    <script type="text/javascript">
        function confirmAction() {
            if (!confirm("Are you sure you want to do this?")) {
                return false;
            }
            return true;
        }
    </script>
    <table cellpadding="1" cellspacing="1" id="member">
        <thead>
        <tr>
            <th colspan="10">Deleting queue</th>
        </tr>
        <tr>
            <td class="on" style="width: 1%"></td>
            <td class="on">Player</td>
            <td class="on">Remaining time</td>
            <td class="on">Delete at</td>
            <td class="on"></td>
        </tr>
        </thead>
        <tbody>
        <?= $params['content']; ?>
        </tbody>
        <tfoot>
        <tr>
            <th colspan="4"></th>
            <th class="navi" style="color:silver;font-weight:700"><?= $params['navigator']; ?></th>
        </tr>
        </tfoot>
    </table>
<?php elseif ($templateName == 'tpl/ban.tpl'): ?>
    <form action="admin.php?action=bannedList" method="POST">
        <input name="section" type="hidden" value="addBan">
        <table id="member" cellpadding="1" cellspacing="1">
            <thead>
            <tr>
                <th colspan="6">Ban</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>UID</td>
                <td>
                    <input type="text" class="fm" name="uid" value="<?= $params['uid']; ?>">
                </td>
            </tr>
            <tr>
                <td>Reason</td>
                <td>
                    <select name="reason" class="fm">
                        <?php
                        $arr = ['Pushing', 'Cheat', 'Hack', 'Bug', 'Bad Name', 'Multiaccount', 'Swearing', 'Insults', 'Another', 'Spam'];
                        foreach ($arr as $r) {
                            echo '<option value="' . $r . '" ' . (isset($params['reason']) && $params['reason'] == $r ? 'selected' : '') . '>' . $r . '</option>';
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Duration</td>
                <td>
                    <select name="time" class="fm">
                        <?php
                        $arr = [1, 2, 5, 10, 12];
                        foreach ($arr as $r) {
                            echo '<option value="' . ($r * 3600) . '" ' . (isset($params['time']) && $params['time'] == ($r * 3600) ? 'selected' : '') . '>' . $r . ' hour/s</option>';
                        }
                        $arr2 = [1, 2, 5, 10, 30, 50, 90];
                        foreach ($arr2 as $r) {
                            echo '<option value="' . ($r * 3600 * 24) . ' ' . (isset($params['time']) && $params['time'] == ($r * 3600) ? 'selected' : '') . '">' . $r . ' day/s</option>';
                        }
                        echo '<option value="0" ' . (isset($params['time']) && $params['time'] == 0 ? 'selected' : '') . '>Forever</option>';
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="on"><input type="image" src="img/admin/b/ok1.gif" value="submit"></td>
            </tr>
            </tbody>
        </table>
    </form>
    <table id="member" cellpadding="1" cellspacing="1">
        <thead>
        <tr>
            <th colspan="6">Banned Players (<?= $params['total']; ?>)</th>
        </tr>
        <tr>
            <td class="on"><b>Username</b></td>
            <td><b>Length (from/to)</b></td>
            <td><b>Reason</b></td>
            <td></td>
            <td></td>
        </tr>
        </thead>
        <tbody>
        <?= $params['content']; ?>
        </tbody>
        <tfoot>
        <tr>
            <th colspan="2"></th>
            <th class="navi" style="color:silver;font-weight:700"><?= $params['navigator']; ?></th>
            <th colspan="2"></th>
        </tr>
        </tfoot>
    </table>
<?php elseif ($templateName == 'tpl/notification.tpl'): ?>
    <h2>Add notification</h2>
    <form action="admin.php?action=addNotification" method="POST">
        <?= getCheckerInput(); ?>
        <table id="member" cellpadding="1" cellspacing="1">
            <thead>
            <tr>
                <th colspan="6">Add notification</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Content(html)</td>
                <td>
                    <textarea name="html" rows="30" cols="60"><?= $params['html']; ?></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="on"><input type="image" src="img/admin/b/ok1.gif" value="submit"></td>
            </tr>
            </tbody>
        </table>
    </form>
    <?php if ($params['result']) {
        echo "<br /><b>OK</b>";
    } ?>
<?php elseif ($templateName == 'tpl/importEmail.tpl'): ?>
    <h2>Import <?= ($params['newsletterType'] == 'special' ? 'Special ' : ''); ?>emails - 1 email per line</h2>
    <form action="admin.php?action=<?= ($params['newsletterType'] == 'special' ? 'importSpecialEmail' : 'importEmail'); ?>"
          method="POST">
        <?= getCheckerInput(); ?>
        <table id="member" cellpadding="1" cellspacing="1">
            <thead>
            <tr>
                <th colspan="6">Add notification</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Content</td>
                <td>
                    <textarea name="html" rows="30" cols="60"><?= $params['html']; ?></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="on"><input type="image" src="img/admin/b/ok1.gif" value="submit"></td>
            </tr>
            </tbody>
        </table>
    </form>
    <?php if ($params['result']) {
        echo "<br /><b>{$params['result']} mails added.</b>";
    } ?>
<?php elseif ($templateName == 'tpl/infobox.tpl'): ?>
    <h2><?= ($params['action'] == 'privateInfobox' ? "Private infobox" : "Public infobox"); ?></h2>
    <form action="admin.php?action=<?= $params['action']; ?>" method="POST">
        <?= getCheckerInput(); ?>
        <table id="member" cellpadding="1" cellspacing="1">
            <thead>
            <tr>
                <th colspan="6">Add infobox</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Expire time</td>
                <td>
                    <input type="text" class="fm" name="expire" value="<?= $params['expire']; ?>">
                </td>
            </tr>
            <tr>
                <td>Content(html)</td>
                <td>
                    <textarea name="html" rows="30" cols="60"><?= $params['html']; ?></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="on"><input type="image" src="img/admin/b/ok1.gif" value="submit"></td>
            </tr>
            </tbody>
        </table>
    </form>
    <table id="member" cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th colspan="3">Current infoBoxes</th>
        </tr>
        <tr>
            <td class="on"><b>Content</b></td>
            <td class="on"><b>ExpireTime</b></td>
            <td style="width: 5%">Action</td>
        </tr>
        </thead>
        <tbody>
        <?= $params['content']; ?>
        </tbody>
    </table>
<?php elseif ($templateName == 'tpl/blackListedNames.tpl'): ?>
    <form action="admin.php?action=blackListedNames" method="POST">
        <?= getCheckerInput(); ?>
        <table id="member" cellpadding="1" cellspacing="1">
            <thead>
            <tr>
                <th colspan="6">Add Blacklist</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td style="width: 5%">Words</td>
                <td>
                    <textarea name="words" rows="20" cols="85"><?= $params['words']; ?></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="on"><input type="image" src="img/admin/b/ok1.gif" value="submit"></td>
            </tr>
            </tbody>
        </table>
    </form>
    <?php
    if (isset($params['error'])) {
        echo '<br /><p style="color: red;"><strong>' . $params['error'] . '</strong></p>';
    }
    ?>
    <table id="member" cellpadding="1" cellspacing="1">
        <thead>
        <tr>
            <th colspan="3">Black listed names (<?= $params['total']; ?>)</th>
        </tr>
        <tr>
            <td class="on"><b>Word</b></td>
            <td class="on"><b>Word</b></td>
            <td class="on"><b>Word</b></td>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($params['total']) {
            $x = 1;
            $session_checker_key = Session::getCheckerName() . "=" . Session::getInstance()->getChecker();
            foreach ($params['content'] as $index => $value) {
                if ($x > 3) $x = 1;
                if ($x == 1) {
                    echo '<tr><td style="text-align: center;"><a href="?action=blackListedNames&del=' . $index . '&' . $session_checker_key . '"><img src="img/x.gif" class="del" title="delete"></a> ' . $value . '</td>';
                } else if ($x == 2) {
                    echo '<td style="text-align: center;"><a href="?action=blackListedNames&del=' . $index . '&' . $session_checker_key . '"><img src="img/x.gif" class="del" title="delete"></a> ' . $value . '</td>';
                } else if ($x == 3) {
                    echo '<td style="text-align: center;"><a href="?action=blackListedNames&del=' . $index . '&' . $session_checker_key . '"><img src="img/x.gif" class="del" title="delete"></a> ' . $value . '</td></tr>';
                }
                ++$x;
            }
        }
        ?>
        </tbody>
    </table>
<?php elseif ($templateName == 'tpl/blacklistedEmails.tpl'): ?>
    <form action="admin.php?action=blackListEmail" method="POST">
        <?= getCheckerInput(); ?>
        <table id="member" cellpadding="1" cellspacing="1">
            <thead>
            <tr>
                <th colspan="6">Blacklist emails</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td style="width: 5%">Emails</td>
                <td>
                    <textarea name="emails" rows="20" cols="85"><?= $params['emails']; ?></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="on"><input type="image" src="img/admin/b/ok1.gif" value="submit"></td>
            </tr>
            </tbody>
        </table>
    </form>
    <?php
    if (isset($params['error'])) {
        echo '<br /><p style="color: red;"><strong>' . $params['error'] . '</strong></p>';
    }
    ?>
    <table id="member" cellpadding="1" cellspacing="1">
        <thead>
        <tr>
            <th colspan="2">Emails (<?= $params['total']; ?>)</th>
        </tr>
        <tr>
            <td class="on"><b>Email</b></td>
            <td class="on"><b>Email</b></td>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($params['total']) {
            $x = 1;
            $session_checker_key = Session::getCheckerName() . "=" . Session::getInstance()->getChecker();

            foreach ($params['content'] as $value) {
                if ($x > 2) $x = 1;
                if ($x == 1) {
                    echo '<tr><td style="text-align: center;"><a href="?action=blackListEmail&del=' . $value['id'] . '&' . $session_checker_key . '"><img src="img/x.gif" class="del" title="delete"></a> ' . $value['email'] . '</td>';
                } else if ($x == 2) {
                    echo '<td style="text-align: center;"><a href="?action=blackListEmail&del=' . $value['id'] . '&' . $session_checker_key . '"><img src="img/x.gif" class="del" title="delete"></a> ' . $value['email'] . '</td>';
                }
                ++$x;
            }
        }
        ?>
        </tbody>
    </table>
<?php elseif ($templateName == 'tpl/badWords.tpl'): ?>
    <form action="admin.php?action=badWords" method="POST">
        <?= getCheckerInput(); ?>
        <table id="member" cellpadding="1" cellspacing="1">
            <thead>
            <tr>
                <th colspan="6">Add bad word</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td style="width: 5%">Words</td>
                <td>
                    <textarea name="words" rows="20" cols="85"><?= $params['words']; ?></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="on"><input type="image" src="img/admin/b/ok1.gif" value="submit"></td>
            </tr>
            </tbody>
        </table>
    </form>
    <?php
    if (isset($params['error'])) {
        echo '<br /><p style="color: red;"><strong>' . $params['error'] . '</strong></p>';
    }
    ?>
    <table id="member" cellpadding="1" cellspacing="1">
        <thead>
        <tr>
            <th colspan="3">BadWords (<?= $params['total']; ?>)</th>
        </tr>
        <tr>
            <td class="on"><b>Word</b></td>
            <td class="on"><b>Word</b></td>
            <td class="on"><b>Word</b></td>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($params['total']) {
            $x = 1;
            $session_checker_key = Session::getCheckerForUrl();
            foreach ($params['content'] as $index => $value) {
                if ($x > 3) $x = 1;
                if ($x == 1) {
                    echo '<tr><td style="text-align: center;"><a href="?action=badWords&del=' . $index . '&' . $session_checker_key . '"><img src="img/x.gif" class="del" title="delete"></a> ' . $value . '</td>';
                } else if ($x == 2) {
                    echo '<td style="text-align: center;"><a href="?action=badWords&del=' . $index . '&' . $session_checker_key . '"><img src="img/x.gif" class="del" title="delete"></a> ' . $value . '</td>';
                } else if ($x == 3) {
                    echo '<td style="text-align: center;"><a href="?action=badWords&del=' . $index . '&' . $session_checker_key . '"><img src="img/x.gif" class="del" title="delete"></a> ' . $value . '</td></tr>';
                }
                ++$x;
            }
        }
        ?>
        </tbody>
    </table>
<?php elseif ($templateName == 'tpl/filteredUrls.tpl'): ?>
    <form action="admin.php?action=filteredUrls" method="POST">
        <?= getCheckerInput(); ?>
        <table id="member" cellpadding="1" cellspacing="1">
            <thead>
            <tr>
                <th colspan="6">Add filter urls</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td style="width: 5%">URLs</td>
                <td>
                    <textarea name="urls" rows="20" cols="85"><?= $params['urls']; ?></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="on"><input type="image" src="img/admin/b/ok1.gif" value="submit"></td>
            </tr>
            </tbody>
        </table>
    </form>
    <?php
    if (isset($params['error'])) {
        echo '<br /><p style="color: red;"><strong>' . $params['error'] . '</strong></p>';
    }
    ?>
    <table id="member" cellpadding="1" cellspacing="1">
        <thead>
        <tr>
            <th colspan="3">Filtered urls (<?= $params['total']; ?>)</th>
        </tr>
        <tr>
            <td class="on"><b>URL</b></td>
            <td class="on"><b>URL</b></td>
            <td class="on"><b>URL</b></td>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($params['total']) {
            $x = 1;
            $session_checker_key = Session::getCheckerName() . "=" . Session::getInstance()->getChecker();
            foreach ($params['content'] as $index => $value) {
                if ($x > 3) $x = 1;
                if ($x == 1) {
                    echo '<tr><td style="text-align: center;"><a href="?action=filteredUrls&del=' . $index . '&' . $session_checker_key . '"><img src="img/x.gif" class="del" title="delete"></a> ' . $value . '</td>';
                } else if ($x == 2) {
                    echo '<td style="text-align: center;"><a href="?action=filteredUrls&del=' . $index . '&' . $session_checker_key . '"><img src="img/x.gif" class="del" title="delete"></a> ' . $value . '</td>';
                } else if ($x == 3) {
                    echo '<td style="text-align: center;"><a href="?action=filteredUrls&del=' . $index . '&' . $session_checker_key . '"><img src="img/x.gif" class="del" title="delete"></a> ' . $value . '</td></tr>';
                }
                ++$x;
            }
        }
        ?>
        </tbody>
    </table>
<?php elseif ($templateName == 'tpl/fakeUser.tpl'): ?>
    <form action="admin.php?action=fakeUser" method="POST">
        <input name="section" type="hidden" value="add">
        <table id="member" cellpadding="1" cellspacing="1">
            <thead>
            <tr>
                <th colspan="6">Add fakes user</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>names</td>
                <td>
                    <textarea name="names" rows="20" cols="40">ali, reza, bozi, khale, DeadMaster</textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="on"><input type="image" src="img/admin/b/ok1.gif" value="submit"></td>
            </tr>
            </tbody>
        </table>
    </form>
    <?php if ($params['result']) {
        echo "<br /><b>{$params['result']} users added.</b>";
    } ?>
<?php elseif ($templateName == 'tpl/heroAddItem.tpl'): ?>
    <form action="admin.php?action=heroAddItem" method="POST">
        <table id="member" cellpadding="1" cellspacing="1">
            <thead>
            <tr>
                <th colspan="6">Add hero item to user</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>USER ID</td>
                <td>
                    <input type="number" class="fm" name="uid" value="<?= $params['uid']; ?>">
                </td>
            </tr>
            <tr>
                <td>Item</td>
                <td>
                    <select name="item">
                        <?php
                        $btypes = $params['items_arr'];
                        $names = [
                            1 => 'Helmets',
                            2 => 'Armors and Shields',
                            3 => 'Maps and flags',
                            4 => 'Swords and spears and lances',
                            5 => 'Boots',
                            6 => 'Horses',
                            7 => 'Small bandage',
                            8 => 'Bandage',
                            9 => 'Cage',
                            10 => 'Inscription',
                            11 => 'Ointment',
                            12 => 'Water Bucket',
                            13 => 'Book of Knowledge',
                            14 => 'Law tablet',
                            15 => 'Artwork',
                        ];
                        $heroItems = new HeroItems();
                        foreach ($btypes as $btype => $a) {
                            echo '<optgroup label="' . $names[$btype] . '">';
                            foreach ($a as $type) {
                                $item = $heroItems->getHeroItemProperties($btype, $type);
                                $key = $btype . ':' . $type;
                                if ($params['item'] == $key) {
                                    echo '<option value="' . $key . '" selected>' . $item['name'] . '</option>';
                                } else {
                                    echo '<option value="' . $key . '">' . $item['name'] . '</option>';
                                }

                            }
                            echo '</optgroup>';
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Amount</td>
                <td>
                    <input type="number" class="fm" name="amount" value="<?= $params['amount']; ?>">
                </td>
            </tr>
            <tr>
                <td>Options</td>
                <td>
                    <input type="checkbox" class="fm" name="delete"
                           value="1" <?= ($params['delete'] == 1 ? 'checked' : ''); ?>> Remove
                </td>
            </tr>
            <tr>
                <td colspan="2" class="on"><input type="image" src="img/admin/b/ok1.gif" value="submit"></td>
            </tr>
            </tbody>
        </table>
    </form>
    <?php if (isset($params['result'])) {
        echo "<br /><b>" . $params['result'] . "</b>";
    } ?>
<?php elseif ($templateName == 'tpl/truceDay.tpl'): ?>
    <form action="admin.php?action=truce" method="POST">
        <table id="member" cellpadding="1" cellspacing="1">
            <thead>
            <tr>
                <th colspan="6">Truce configuration</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Current server time:</td>
                <td>
                    <?= $params['now']; ?>
                </td>
            </tr>
            <tr>
                <td>Truce From Time</td>
                <td>
                    <input type="text" class="fm" name="truceFrom" value="<?= $params['truceFrom']; ?>">
                </td>
            </tr>
            <tr>
                <td>Truce From Time</td>
                <td>
                    <input type="text" class="fm" name="truceTo" value="<?= $params['truceTo']; ?>">
                </td>
            </tr>
            <tr>
                <td>Truce Reason</td>
                <td>
                    <select name="truceReasonId">
                        <?php
                        foreach (T("Truce", "reasons") as $key => $value) {
                            echo '<option ' . ($key == $params['truceReasonId'] ? 'selected' : '') . ' value="' . $key . '">' . $value . '</option>';
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="on"><input type="image" src="img/admin/b/ok1.gif" value="submit"></td>
            </tr>
            </tbody>
        </table>
    </form>
    <?php if (isset($params['result'])) {
        echo "<br /><b>" . $params['result'] . "</b>";
    } ?>
<?php elseif ($templateName == 'tpl/addVillage.tpl'): ?>
    <form action="admin.php?action=addVillage" method="POST">
        <table id="member" cellpadding="1" cellspacing="1">
            <thead>
            <tr>
                <th colspan="6">Add Village to user</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>UID</td>
                <td>
                    <input type="text" class="fm" name="uid" value="<?= $params['uid']; ?>">
                </td>
            </tr>
            <tr>
                <td>Fieldtype</td>
                <td>
                    <select name="fieldtype">
                        <?php
                        for ($i = 1; $i <= 12; ++$i) {
                            echo '<option value="' . $i . '" ' . ($i == $params['fieldtype'] ? 'selected' : '') . '>' . $i . ' - ' . implode("-", Formulas::getFieldTypeResourceArr($i)) . '</option>';
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Side</td>
                <td>
                    <select name="sector">
                        <?php
                        $arr = ['NE', 'NW', 'SE', 'SW'];
                        foreach ($arr as $x) {
                            $key = strtolower($x);
                            echo '<option value="' . $key . '" ' . ($key == $params['sector'] ? 'selected' : '') . '>' . $x . '</option>';
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="on"><input type="image" src="img/admin/b/ok1.gif" value="submit"></td>
            </tr>
            </tbody>
        </table>
    </form>
    <?php if (isset($params['result'])) {
        echo "<br /><b>" . $params['result'] . "</b>";
    } ?>
<?php elseif ($templateName == 'tpl/heroAuctionAdd.tpl'): ?>
    <form action="admin.php?action=heroAuction" method="POST">
        <input name="section" type="hidden" value="addBan">
        <table id="member" cellpadding="1" cellspacing="1">
            <thead>
            <tr>
                <th colspan="6">Add hero auction</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Item</td>
                <td>
                    <select name="item">
                        <?php
                        $btypes = [
                            1 => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15],
                            2 => [82, 83, 84, 85, 86, 87, 88, 89, 90, 91, 92, 93], 3 => [
                                61, 62, 63, 64, 65, 66, 67, 68, 69, 73, 74, 75, 76, 77, 78, 79,
                                80, 81,
                            ], 4 => [
                                16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31,
                                32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47,
                                48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60,
                                115, 116, 117, 118, 119, 120, 121, 122, 123, 124, 125, 126, 127, 128, 129,
                                130, 131, 132, 133, 134, 135, 136, 137, 138, 139, 140, 141, 142, 143, 144,
                            ], 5 => [94, 95, 96, 97, 98, 99, 100, 101, 102],
                            6 => [103, 104, 105], 7 => [112], 8 => [113], 9 => [114],
                            10 => [107], 11 => [106], 12 => [108], 13 => [110], 14 => [109],
                            15 => [111],
                        ];
                        $names = [
                            1 => 'Helmets',
                            2 => 'Armors and Shields',
                            3 => 'Maps and flags',
                            4 => 'Swords and spears and lances',
                            5 => 'Boots',
                            6 => 'Horses',
                            7 => 'Small bandage',
                            8 => 'Bandage',
                            9 => 'Cage',
                            10 => 'Inscription',
                            11 => 'Ointment',
                            12 => 'Water Bucket',
                            13 => 'Book of Knowledge',
                            14 => 'Law tablet',
                            15 => 'Artwork',
                        ];
                        $heroItems = new HeroItems();
                        foreach ($btypes as $btype => $a) {
                            echo '<optgroup label="' . $names[$btype] . '">';
                            foreach ($a as $type) {
                                $item = $heroItems->getHeroItemProperties($btype, $type);
                                echo '<option value="' . $btype . ':' . $type . '">' . $item['name'] . '</option>';
                            }
                            echo '</optgroup>';
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Package-amount</td>
                <td>
                    <input type="number" class="fm" name="package_amount" value="0">
                </td>
            </tr>
            <tr>
                <td>Silver</td>
                <td>
                    <input type="number" class="fm" name="silver" value="500">
                </td>
            </tr>
            <tr>
                <td>Repeat times</td>
                <td>
                    <select name="repeat">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Time</td>
                <td>
                    <select name="time">
                        <option value="60">1 min</option>
                        <option value="120">2 min</option>
                        <option value="300">5 min</option>
                        <option value="600">10 min</option>
                        <option value="1800">30 min</option>
                        <option value="3600" selected>1 h</option>
                        <option value="7200">2 h</option>
                        <option value="21600">6 h</option>
                        <option value="28800">8 h</option>
                        <option value="43200">12 h</option>
                        <option value="86400">24 h</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="on"><input type="image" src="img/admin/b/ok1.gif" value="submit"></td>
            </tr>
            </tbody>
        </table>
    </form>
    <?php if ($params['result']) {
        echo "<br /><b>Item added to auction.</b>";
    } ?>
<?php elseif ($templateName == 'tpl/onlineUsers.tpl'): ?>
    <table id="member">
        <thead>
        <tr>
            <th colspan="6">Online users (<?= $params['total']; ?>)</th>
        </tr>
        </thead>
        <tr>
            <td style="text-align: center;">Name</td>
            <td style="text-align: center;">Time</td>
            <td style="text-align: center;">Tribe</td>
            <td style="text-align: center;">Pop</td>
            <td style="text-align: center;">Villages</td>
            <td style="text-align: center;">Gold</td>
        </tr>
        <?= $params['content']; ?>
    </table>
<?php elseif ($templateName == 'tpl/configurationDetails.tpl'): ?>
    <style type="text/css">
        .del {
            width: 12px;
            height: 12px;
            background-image: url(img/admin/icon/del.gif);
        }
    </style>
    <h2>
        <center>Server Configuration</center>
    </h2>
    <table id="member">
        <thead>
        <tr>
            <th colspan="2">Server Settings</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td style="width: 50%">World ID</td>
            <td><?= $params['worldId']; ?></td>
        </tr>
        <tr>
            <td>World unique ID</td>
            <td><?= $params['worldUniqueId']; ?></td>
        </tr>
        <tr>
            <td>Server start time</td>
            <td><?= $params['startTime']; ?></td>
        </tr>
        <tr>
            <td>Round length</td>
            <td><?= $params['round_length']; ?> day(s)</td>
        </tr>
        <tr>
            <td>Speed</td>
            <td><?= $params['speed']; ?>x</td>
        </tr>
        <tr>
            <td>Storage multiplier</td>
            <td><?= $params['storage_multiplier']; ?>x</td>
        </tr>
        <tr>
            <td>Trap multiplier</td>
            <td><?= $params['trap_multiplier']; ?>x</td>
        </tr>
        <tr>
            <td>movement speed multiplier</td>
            <td><?= $params['movementSpeed_multiplier']; ?>x</td>
        </tr>
        <tr>
            <td>Protection</td>
            <td><?= $params['protectionHours']; ?> hours</td>
        </tr>
        <tr>
            <td>Artifacts released</td>
            <td><?= $params['ArtifactsReleased'] ? 'yes' : 'no'; ?></td>
        </tr>
        <tr>
            <td>WW Villages released</td>
            <td><?= $params['WWVillagesReleased'] ? 'yes' : 'no'; ?></td>
        </tr>
        <tr>
            <td>WW Plans released</td>
            <td><?= $params['WWPlansReleased'] ? 'yes' : 'no'; ?></td>
        </tr>
        <tr>
            <td>Maintenance</td>
            <td><?= $params['maintenance'] ? 'On' : 'Off'; ?></td>
        </tr>
        <tr>
            <td>Register status</td>
            <td><?= $params['registerClosed'] ? 'closed' : 'open'; ?></td>
        </tr>
        <tr>
            <td>Need Preregistration code</td>
            <td><?= $params['needPreregistrationCode'] ? 'yes' : 'no'; ?></td>
        </tr>
        <tr>
            <td>Last medals given</td>
            <td><?= TimezoneHelper::autoDateString($params['lastMedalsGiven'], true); ?></td>
        </tr>
        <tr>
            <td>Artefacts release in</td>
            <td><?= appendTimer($params['ArtefactsReleaseTime'], 0, true); ?> hours</td>
        </tr>
        <tr>
            <td>WWVillages release in</td>
            <td><?= appendTimer($params['WWVillagesReleaseTime'], 0, true); ?> hours</td>
        </tr>
        <tr>
            <td>WWPlans release in</td>
            <td><?= appendTimer($params['WWPlansReleaseTime'], 0, true); ?> hours</td>
        </tr>
        </tbody>
    </table>
<?php elseif ($templateName == 'tpl/messageAnswer.tpl'): ?>
    <style type="text/css">
        div.clear {
            clear: both;
            height: 0;
            width: 0;
        }

        table#invite th, table#invite td {
            padding: 2px 7px;
        }

        table#invite tbody.mails td {
            background-color: #F5F5F5;
        }

        table#invite tbody.msg pre {
            margin: 10px 5px;
        }

        table#invite tbody.msg th {
            background-color: #F5F5F5;
        }

        table#invite tbody.msg textarea {
            height: 200px;
            width: 680px;
        }

        td.variable {
            width: 30px;
        }

        table#invite {
            table-layout: fixed;
            word-wrap: break-word;
        }
    </style>
    <h2>Ticket answer</h2>
    <p>You can answer the ticket here. all tickets will be answered by email here.</p>
    <p class="error"><?= $params['error']; ?></p>
    <form action="admin.php?action=messages" method="post">
        <input type="hidden" name="answer" value="<?= $params['answerId']; ?>">
        <table id="invite" cellpadding="1" cellspacing="1">
            <thead>
            <tr>
                <th colspan="4">Answer message</th>
            </tr>
            </thead>
            <tbody class="mails">
            <tr>
                <td class="variable">Player</td>
                <td class="value" colspan="3"><?= $params['player']; ?></td>
            </tr>
            <tr>
                <td class="variable">Subject</td>
                <td class="value" colspan="3"><?= $params['subject']; ?></td>
            </tr>
            <tr>
                <td class="variable">Time</td>
                <td class="value" colspan="3"><?= TimezoneHelper::autoDateString($params['time'], true); ?></td>
            </tr>
            </tbody>
            <tbody>
            <tr>
                <td colspan="4">
                    <?= nl2br($params['message']); ?>
                </td>
            </tr>
            </tbody>
            <tbody class="msg">
            <tr>
                <th colspan="4">Answer text (BBCode & HTML are allowed)</th>
            </tr>
            <tr>
                <td colspan="4"><textarea name="customMessage"></textarea></td>
            </tr>
            </tbody>
        </table>
        <p class="btn"><input type="image" value="submit" name="submit" id="btn_send" class="dynamic_img"
                              src="img/x.gif" alt="Send"/></p>
    </form>
<?php elseif ($templateName == 'tpl/ticketsAnswer.tpl'): ?>
    <style type="text/css">
        div.clear {
            clear: both;
            height: 0;
            width: 0;
        }

        table#invite th, table#invite td {
            padding: 2px 7px;
        }

        table#invite tbody.mails td {
            background-color: #F5F5F5;
        }

        table#invite tbody.msg pre {
            margin: 10px 5px;
        }

        table#invite tbody.msg th {
            background-color: #F5F5F5;
        }

        table#invite tbody.msg textarea {
            height: 200px;
            width: 680px;
        }

        td.variable {
            width: 30px;
        }

        table#invite {
            table-layout: fixed;
            word-wrap: break-word;
        }
    </style>
    <h2>Ticket answer</h2>
    <p>You can answer the ticket here. all tickets will be answered by email here.</p>
    <p class="error"><?= $params['error']; ?></p>
    <form action="admin.php?action=tickets" method="post">
        <input type="hidden" name="answer" value="<?= $params['answerId']; ?>">
        <table id="invite" cellpadding="1" cellspacing="1">
            <thead>
            <tr>
                <th colspan="4">Answer ticket</th>
            </tr>
            </thead>
            <tbody class="mails">
            <tr>
                <td class="variable">World ID</td>
                <td class="value" colspan="3"><?= $params['worldUniqueId']; ?></td>
            </tr>
            <tr>
                <td class="variable">Username</td>
                <td class="value" colspan="3"><?= $params['username']; ?></td>
            </tr>
            <tr>
                <td class="variable">e-mail</td>
                <td class="value" colspan="3"><?= $params['email']; ?></td>
            </tr>
            <tr>
                <td class="variable">Subject</td>
                <td class="value" colspan="3"><?= $params['subject']; ?></td>
            </tr>
            <tr>
                <td class="variable">Time</td>
                <td class="value" colspan="3"><?= TimezoneHelper::autoDateString($params['time'], true); ?></td>
            </tr>
            </tbody>
            <tbody>
            <tr>
                <td colspan="4">
                    <?= nl2br($params['message']); ?>
                </td>
            </tr>
            </tbody>
            <tbody class="msg">
            <tr>
                <th colspan="4">Answer text (HTML is allowed)</th>
            </tr>
            <tr>
                <td colspan="4"><textarea name="customMessage"></textarea></td>
            </tr>
            </tbody>
        </table>
        <p class="btn"><input type="image" value="submit" name="submit" id="btn_send" class="dynamic_img"
                              src="img/x.gif" alt="Send"/></p>
    </form>
<?php elseif ($templateName == 'tpl/reportShow.tpl'): ?>
    <style type="text/css">
        div.clear {
            clear: both;
            height: 0;
            width: 0;
        }

        table#invite th, table#invite td {
            padding: 2px 7px;
        }

        table#invite tbody.mails td {
            background-color: #F5F5F5;
        }

        table#invite tbody.msg pre {
            margin: 10px 5px;
        }

        table#invite tbody.msg th {
            background-color: #F5F5F5;
        }

        table#invite tbody.msg textarea {
            height: 200px;
            width: 680px;
        }

        td.variable {
            width: 30px;
        }

        table#invite {
            table-layout: fixed;
            word-wrap: break-word;
        }
    </style>
    <h2>Reported Message</h2>
    <p>Reported Messages.</p>
    <form action="admin.php?action=reportedMessage" method="post">
        <input type="hidden" name="answer" value="<?= $params['answerId']; ?>">
        <table id="invite" cellpadding="1" cellspacing="1">
            <thead>
            <tr>
                <th colspan="4">Reported message</th>
            </tr>
            </thead>
            <tbody class="mails">
            <tr>
                <td class="variable">Player</td>
                <td class="value" colspan="3"><?= $params['player']; ?></td>
            </tr>
            <tr>
                <td class="variable">Subject</td>
                <td class="value" colspan="3"><?= $params['subject']; ?></td>
            </tr>
            <tr>
                <td class="variable">Time</td>
                <td class="value" colspan="3"><?= TimezoneHelper::autoDateString($params['time'], true); ?></td>
            </tr>
            </tbody>
            <tbody>
            <tr>
                <td colspan="4">
                    <?= nl2br($params['message']); ?>
                </td>
            </tr>
            </tbody>
        </table>
    </form>
<?php elseif ($templateName == 'tpl/addPreRegistrationCodeBatch.tpl'): ?>
    <br/>
    <h1>Add PreRegistration code</h1>
    <p></p>
    <form method="post" name="snd" action="admin.php">
        <input type="hidden" name="action" value="preRegistrationCodeBatch"/>
        <?= getCheckerInput(); ?>
        <div class="p1">
            <table width="100%" cellspacing="0" cellpadding="0">
                <tbody>
                <tr>
                    <td>
                        <label>Number of codes:</label>
                        <input class="fm fm110" type="number" name="count" value="<?= $params['count']; ?>"
                               maxlength="100">
                        <span class="e f7"></span>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <p class="btn"><input type="image" value="submit" name="submit" id="btn_ok" class="dynamic_img" src="img/x.gif"
                              alt="Send"/></p>
        <p align="center"><?= $params['error']; ?></p>
    </form>

<?php elseif ($templateName == 'tpl/addPaymentCodeBatch.tpl'): ?>
    <script type="text/javascript">
        function packageSelectChanged(select) {
            <?php if($params['isGift']):?>
            window.location.href = '?action=giftGoldPackageCodeGenerator&package=' + select.options[select.selectedIndex].value;
            <?php else:?>
            window.location.href = '?action=goldPackageCodeGenerator&package=' + select.options[select.selectedIndex].value;
            <?php endif;?>

        }
    </script>
    <br/>
    <?php if ($params['isGift']): ?>
        <h1>Add Gift code</h1>
    <?php else: ?>
        <h1>Add code for payment</h1>
    <?php endif; ?>
    <p></p>
    <form method="post" name="snd"
        <?php if ($params['isGift']): ?>
          action="admin.php?action=giftGoldPackageCodeGenerator&package=<?= $params['selectedGoldProductId']; ?>">
        <?php else: ?>
            action="admin.php?action=goldPackageCodeGenerator&package=<?= $params['selectedGoldProductId']; ?>">
        <?php endif; ?>
        <?= getCheckerInput(); ?>
        <div class="p1">
            <table width="100%" cellspacing="0" cellpadding="0">
                <tbody>
                <tr>
                    <td>
                        <label>Package:</label>
                        <select name="package" onchange="packageSelectChanged(this);">
                            <option>Select a gold package.</option>
                            <?php
                            foreach ($params['packages'] as $package) {
                                echo '<option value="' . $package['goldProductId'] . '" ' . ($package['goldProductId'] == $params['selectedGoldProductId'] ? 'selected' : '') . '>' . $package['location']['location'] . ' - ' . $package['goldProductName'] . ' - ' . ($package['goldProductPrice'] . ' ' . $package['goldProductMoneyUnit']) . ' (' . $package['goldProductGold'] . ' Gold)</option>';
                            }
                            ?>
                        </select>
                        <span class="e f7"></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Number of codes:</label>
                        <input class="fm fm110" type="number" name="count" value="<?= $params['count']; ?>"
                               maxlength="3">
                        <span class="e f7"></span>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <p class="btn">
            <input type="image" value="submit" name="submit" id="btn_ok" class="dynamic_img" src="img/x.gif"
                   alt="Send"/></p>
        <?php if (isset($params['error'])): ?>
            <p align="center"><?= $params['error']; ?></p>
        <?php endif; ?>
    </form>

    <style>
        table#member thead td, table#member tfoot td {
            width: auto;
        }
    </style>
    <select name="package" onchange="packageSelectChanged(this);">
        <option>Select a gold package.</option>
        <?php
        foreach ($params['packages'] as $package) {
            echo '<option value="' . $package['goldProductId'] . '" ' . ($package['goldProductId'] == $params['selectedGoldProductId'] ? 'selected' : '') . '>' . $package['location']['location'] . ' - ' . $package['goldProductName'] . ' - ' . ($package['goldProductPrice'] . ' ' . $package['goldProductMoneyUnit']) . '</option>';
        }
        ?>
    </select>
    <?php if (!empty($params['content'])): ?>
        <table cellpadding="1" cellspacing="1" id="member">
            <thead>
            <tr>
                <th colspan="6">Codes</th>
            </tr>
            <tr>
                <td class="on"></td>
                <td class="on">#</td>
                <td>Code</td>
                <td>Location</td>
                <td>Product</td>
                <td>Price</td>
            </tr>
            </thead>
            <tbody>
            <?= $params['content']; ?>
            </tbody>
            <tfoot>
            <tr>
                <th colspan="5"></th>
                <th class="navi" style="color:silver;font-weight:700"><?= $params['navigator']; ?></th>
            </tr>
            </tfoot>
        </table>
    <?php endif; ?>
<?php elseif ($templateName == 'tpl/addPreRegistrationCodeByEmail.tpl'): ?>
    <br/>
    <h1>Add Pre registration code</h1>
    <p></p>
    <form method="post" name="snd" action="admin.php">
        <input type="hidden" name="action" value="preRegistrationByEmail"/>
        <?= getCheckerInput(); ?>
        <div class="p1">
            <table width="100%" cellspacing="0" cellpadding="0">
                <tbody>
                <tr>
                    <td>
                        <label>Email:</label>
                        <input class="fm fm110" type="text" name="email" value="<?= $params['email']; ?>"
                               maxlength="100">
                        <span class="e f7"></span>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <p class="btn"><input type="image" value="submit" name="submit" id="btn_ok" class="dynamic_img" src="img/x.gif"
                              alt="Send"/></p>
        <p align="center"><?= $params['error']; ?></p>
    </form>
<?php elseif ($templateName == 'tpl/tickets.tpl'): ?>
    <p class="error"><?= $params['error']; ?></p>
    <h2>Tickets</h2>
    <p>Here all the server tickets(Multihunter + Support messages) will be shown. You can answer the questions here.</p>
    <table cellpadding="1" cellspacing="1" id="member">
        <thead>
        <tr>
            <th colspan="2">Subject</th>
            <th style="width: 25%">Sender</th>
            <th style="width: 25%;">Time</th>
            <th>Action</th>
        </tr>
        </thead>
        <tfoot>
        <tr></tr>
        </tfoot>
        <tbody>
        <?= $params['content']; ?>
        </tbody>
    </table>
<?php elseif ($templateName == 'tpl/reportedMessages.tpl'): ?>
    <p class="error"><?= $params['error']; ?></p>
    <h2>Reported MEssages</h2>
    <p>Reported messages will appear here.</p>
    <table cellpadding="1" cellspacing="1" id="member">
        <thead>
        <tr>
            <th style="width: 5%;"></th>
            <th>Spamer Player</th>
            <th>Spam Reason</th>
            <th>Time</th>
            <th>Action</th>
        </tr>
        </thead>
        <tfoot>
        <tr></tr>
        </tfoot>
        <tbody>
        <?= $params['content']; ?>
        </tbody>
    </table>
<?php elseif ($templateName == 'tpl/paymentAddProvider.tpl'): ?>
    <h1>Add/edit Provider</h1>
    <p>You can add/edit a payment Provider here.</p>
    <form method="post" name="snd" action="admin.php">
        <input type="hidden" name="action" value="paymentProviders"/>
        <input type="hidden" name="method" value="<?= $params['method']; ?>"/>
        <?php if (isset($params['providerId'])): ?>
            <input type="hidden" name="providerId" value="<?= $params['providerId']; ?>"/>
        <?php endif; ?>
        <?= getCheckerInput(); ?>
        <div class="p1">
            <table width="100%" cellspacing="0" cellpadding="0" style="border: none;">
                <tbody>
                <tr>
                    <td>
                        <label>Type:</label>
                        <select name="provider_type">
                            <option value="1" <?= ($params['provider_type'] == 1 ? 'selected' : ''); ?>>Zarinpal
                            </option>
                            <option value="9" <?= ($params['provider_type'] == 9 ? 'selected' : ''); ?>>Arianpal
                            </option>
                            <option value="2" <?= ($params['provider_type'] == 2 ? 'selected' : ''); ?>>PayPal</option>
                            <option value="4" <?= ($params['provider_type'] == 4 ? 'selected' : ''); ?>>PayGol</option>
                            <!--
                            <option value="5" <?= ($params['provider_type'] == 5 ? 'selected' : ''); ?>>Perfect Money</option>
                            <option value="6" <?= ($params['provider_type'] == 6 ? 'selected' : ''); ?>>CashU</option>
                            <option value="7" <?= ($params['provider_type'] == 7 ? 'selected' : ''); ?>>Skrill</option>
                            <option value="8" <?= ($params['provider_type'] == 8 ? 'selected' : ''); ?>>PaySafeCard</option>
                            --->
                        </select>
                        <span class="e f7"></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Product location</label>
                        <select name="provider_location">
                            <?= $params['locations_dropdown']; ?>
                        </select>
                        <span class="e f7"></span>
                    </td>
                </tr>
                <tr>

                    <td>
                        <label>Name:</label>
                        <input class="fm fm110" type="text" name="provider_name"
                               value="<?= $params['provider_name']; ?>" maxlength="100">
                        <span class="e f7"></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Description:</label>
                        <textarea class="fm fm110" cols="50" rows="10"
                                  name="provider_description"><?= $params['provider_description']; ?></textarea>
                        <span class="e f7"></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Image</label>
                        <input class="fm fm110" type="text" name="provider_image"
                               value="<?= $params['provider_image']; ?>" maxlength="100">
                        <span class="e f7">(Ex: paypal.png)</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Delivery</label>
                        <input class="fm fm110" type="text" name="provider_delivery"
                               value="<?= $params['provider_delivery']; ?>" maxlength="100">
                        <span class="e f7">(Ex: immediate)</span>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>ConnectInfo:</label>
                        <textarea class="fm fm110" cols="50" rows="10"
                                  name="provider_connectInfo"><?= $params['provider_connectInfo']; ?></textarea>
                        <span class="e f7">(ask server administrator)</span>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>isProviderLoadedByHTML:</label>
                        <select name="provider_isProviderLoadedByHTML">
                            <option
                                    value="0"<?= ($params['provider_isProviderLoadedByHTML'] == 0 ? ' selected' : ''); ?>>
                                No
                            </option>
                            <option
                                    value="1"<?= ($params['provider_isProviderLoadedByHTML'] == 1 ? ' selected' : ''); ?>>
                                Yes
                            </option>
                        </select>
                        <span class="e f7">(Ask server administrator)</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>hidden:</label>
                        <select name="provider_hidden">
                            <option value="0"<?= ($params['provider_hidden'] == 0 ? ' selected' : ''); ?>>No</option>
                            <option value="1"<?= ($params['provider_hidden'] == 1 ? ' selected' : ''); ?>>Yes</option>
                        </select>
                        <span class="e f7"></span>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <p class="btn"><input type="image" value="submit" name="submit" id="btn_save" class="dynamic_img"
                              src="img/x.gif" alt="Send"/></p>
        <p align="center"><?= $params['error']; ?></p>
    </form>
<?php elseif ($templateName == 'tpl/paymentProviders.tpl'): ?>
    <style type="text/css">
        table#providers td, th {
            text-align: center;
        }
    </style>
    <p>
        Here is the list of payment providers.
        You can add providers or edit/delete providers.
    </p>
    <table cellpadding="1" cellspacing="1" id="providers" class="member">
        <thead>
        <tr>
            <td>No.</td>
            <td>Type</td>
            <td>Pos</td>
            <td>Name</td>
            <td>Delivery</td>
            <td>hidden</td>
            <td>Actions</td>
        </tr>
        </thead>
        <tbody>
        <?= $params['content']; ?>
        </tbody>
    </table>
    <br/>
    <a href="?action=paymentProviders&method=addProvider">» Add provider</a>
<?php elseif ($templateName == 'tpl/paymentVoucherOptions.tpl'): ?>
    <br/>
    <?php if ($params['method'] != 'addVoucher'): ?>
        <a href="?action=paymentVouchers&method=addVoucher">» add voucher to email</a>
        <br/>
    <?php endif; ?>
    <?php if ($params['method'] != 'showVoucher'): ?>

        <a href="?action=paymentVouchers&method=showVoucher">» Show voucher(s) for email</a>
        <br/>
    <?php endif; ?>
    <br/>
<?php elseif ($templateName == 'tpl/paymentLogs.tpl'): ?>
    <h1>Successful payments</h1>
    <p>
        Here is a summary of payment income.
    </p>
    <style type="text/css">
        table#logs td, th {
            text-align: center;
        }
    </style>
    <?php
    foreach ($params['income'] as $moneyUnit => $price) {
        if ($price == 0) continue;
        echo "<strong>Total income</strong>: $price $moneyUnit<br />";
    }
    ?>
    <br>
    <a href="admin.php?action=paymentLogs&sendIncomeAgain&c=<?= Session::getInstance()->getChecker(); ?>">» Send Incomes
        again</a>
    <?php if (isset($params['sendAgain'])): ?>
        <p>Income sent.</p>
    <?php endif; ?>
<?php elseif ($templateName == 'tpl/paymentShowVouchers.tpl'): ?>
    <style type="text/css">
        table#vouchers td, th {
            text-align: center;
        }
    </style>
    <h1>Show Vouchers</h1>
    <p></p>
    <form method="post" name="snd" action="admin.php">
        <input type="hidden" name="action" value="paymentVouchers"/>
        <input type="hidden" name="method" value="<?= $params['method']; ?>"/>
        <div class="p1">
            <table width="100%" cellspacing="0" cellpadding="0">
                <tbody>
                <tr>
                    <td>
                        <label>Voucher email:</label>
                        <input class="fm fm110" type="text" name="email" value="<?= $params['email']; ?>"
                               maxlength="100">
                        <span class="e f7"></span>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <p class="btn"><input type="image" value="submit" name="submit" id="btn_send" class="dynamic_img"
                              src="img/x.gif" alt="Send"/></p>
    </form>
    <?php if (!empty($params['content'])): ?>
        <p>Vouchers for <?= $params['email']; ?>:</p>
        <table cellpadding="1" cellspacing="1" class="member" id="vouchers">
            <thead>
            <tr>
                <td>No.</td>
                <td>Gold</td>
                <td>Voucher code</td>
                <td>Actions</td>
            </tr>
            </thead>
            <tbody>
            <?= $params['content']; ?>
            </tbody>
        </table>
        <p>Total gold: <b><?= $params['totalGold']; ?></b></p>
    <?php endif; ?>
<?php elseif ($templateName == 'tpl/paymentAddVoucher.tpl'): ?>
    <h1>Add voucher</h1>
    <p></p>
    <form method="post" name="snd" action="admin.php">
        <input type="hidden" name="action" value="paymentVouchers"/>
        <input type="hidden" name="method" value="<?= $params['method']; ?>"/>
        <?= getCheckerInput(); ?>
        <div class="p1">
            <table width="100%" cellspacing="0" cellpadding="0">
                <tbody>
                <tr>
                    <td>
                        <label>Voucher email:</label>
                        <input class="fm fm110" type="text" name="email" value="<?= $params['email']; ?>"
                               maxlength="100">
                        <span class="e f7"></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Gold num:</label>
                        <input class="fm fm110" type="number" name="gold" value="<?= $params['gold']; ?>"
                               maxlength="100">
                        <span class="e f7"></span>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <p class="btn"><input type="image" value="submit" name="submit" id="btn_ok" class="dynamic_img" src="img/x.gif"
                              alt="Send"/></p>
        <p align="center"><?= $params['error']; ?></p>
    </form>
<?php elseif ($templateName == 'tpl/paymentAddProduct.tpl'): ?>
    <h1>Add/edit Product</h1>
    <p>You can add/edit a gold Product here.</p>
    <form method="post" name="snd" action="admin.php">
        <input type="hidden" name="action" value="paymentProducts"/>
        <input type="hidden" name="method" value="<?= $params['method']; ?>"/>
        <?php if (isset($params['productId'])): ?>
            <input type="hidden" name="productId" value="<?= $params['productId']; ?>"/>
        <?php endif; ?>
        <?= getCheckerInput(); ?>
        <div class="p1">
            <table width="100%" cellspacing="0" cellpadding="0" class="member" style="border: none;">
                <tbody>
                <tr>
                    <td>
                        <label>Product name:</label>
                        <input class="fm fm110" type="text" name="product_name" value="<?= $params['product_name']; ?>"
                               maxlength="100">
                        <span class="e f7"></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Product location</label>
                        <select name="product_location">
                            <?= $params['locations_dropdown']; ?>
                        </select>
                        <span class="e f7"></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Gold num:</label>
                        <input class="fm fm110" type="number" name="product_gold"
                               value="<?= $params['product_gold']; ?>" maxlength="100">
                        <span class="e f7"></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Price:</label>
                        <input class="fm fm110" type="text" name="product_price"
                               value="<?= $params['product_price']; ?>" maxlength="100">
                        <span class="e f7"></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Money unit:</label>
                        <input class="fm fm110" type="text" name="product_moneyUnit"
                               value="<?= $params['product_moneyUnit']; ?>" maxlength="100">
                        <span class="e f7">(Ex: IRR, USD)</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Image:</label>
                        <input class="fm fm110" type="text" name="product_image"
                               value="<?= $params['product_image']; ?>" maxlength="100">
                        <span class="e f7">(Ex: Travian_Facelift_1.png)</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Can be offered:</label>
                        <select name="product_offer">
                            <option value="0"<?= ($params['product_offer'] == 0 ? ' selected' : ''); ?>>No</option>
                            <option value="1"<?= ($params['product_offer'] == 1 ? ' selected' : ''); ?>>Yes</option>
                        </select>
                        <span class="e f7"></span>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <p class="btn"><input type="image" value="submit" name="submit" id="btn_save" class="dynamic_img"
                              src="img/x.gif" alt="Send"/></p>
        <p align="center"><?= $params['error']; ?></p>
    </form>
<?php elseif ($templateName == 'tpl/paymentProducts.tpl'): ?>
    <style type="text/css">
        table#products td, th {
            text-align: center;
        }
    </style>
    <p>
        Here is the list of payment Products.
        You can add Products or edit/delete Products.
        Each location must have separate products and providers.
    </p>
    <table cellpadding="1" cellspacing="1" id="products" class="member">
        <thead>
        <tr>
            <td>No.</td>
            <td>Name</td>
            <td>Location</td>
            <td>Gold</td>
            <td>Price</td>
            <td>Actions</td>
        </tr>
        </thead>
        <tbody>
        <?= $params['content']; ?>
        </tbody>
    </table>
    <br/>
    <a href="?action=paymentProducts&method=addProduct">» Add product</a>
<?php elseif ($templateName == 'tpl/paymentAddLocation.tpl'): ?>
    <h1>Add Payment Location</h1>
    <p>You can add/edit a payment location here.</p>
    <form method="post" name="snd" action="admin.php">
        <input type="hidden" name="action" value="paymentLocations"/>
        <input type="hidden" name="method" value="<?= $params['method']; ?>"/>
        <?php if (isset($params['locationId'])): ?>
            <input type="hidden" name="locationId" value="<?= $params['locationId']; ?>"/>
        <?php endif; ?>
        <?= getCheckerInput(); ?>
        <div class="p1">
            <table width="100%" cellspacing="0" cellpadding="0" style="border: none;">
                <tbody>
                <tr>
                    <td>
                        <label>Location name:</label>
                        <input class="fm fm110" type="text" name="location_name"
                               value="<?= $params['location_name']; ?>" maxlength="100">
                        <span class="e f7"></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Content language:</label>
                        <input class="fm fm110" type="text" name="content_language"
                               value="<?= $params['content_language']; ?>" maxlength="100">
                        <span class="e f7"></span>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <p class="btn"><input type="image" value="submit" name="submit" id="btn_save" class="dynamic_img"
                              src="img/x.gif" alt="Send"/></p>
        <p align="center"><?= $params['error']; ?></p>
    </form>
<?php elseif ($templateName == 'tpl/paymentLocationsSelect.tpl'): ?>
    <h1>Choose location</h1>
    <p>Please select a location to continue:</p>
    <form method="post" name="snd" id="locationForm" action="admin.php">
        <input type="hidden" name="action" value="<?= $params['action']; ?>"/>
        <div class="p1">
            <table width="100%" cellspacing="0" cellpadding="0">
                <tbody>
                <tr>
                    <td>
                        <label>Location name:</label>
                        <select name="locationId" onchange="document.forms['locationForm'].submit();">
                            <?= $params['locations_dropdown']; ?>
                        </select>
                        <span class="e f7"></span>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </form>
<?php elseif ($templateName == 'tpl/paymentLocations.tpl'): ?>
    <h1>Payment Locations</h1>
    <p>
        Here is the list of payment locations.
        You can add location or edit/delete locations.
        Each location must have separate products and providers.
    </p>
    <style type="text/css">
        table#locations td, th {
            text-align: center;
        }
    </style>
    <table cellpadding="1" cellspacing="1" id="member">
        <thead>
        <tr>
            <td style="width: 2%">No.</td>
            <td>Location name</td>
            <td>Content language</td>
            <td>Actions</td>
        </tr>
        </thead>
        <tbody>
        <?= $params['content']; ?>
        </tbody>
    </table>
    <br/>
    <a href="?action=paymentLocations&method=addLocation">» Add location</a>
<?php elseif ($templateName == 'tpl/paymentSettings.tpl'): ?>
    <p>You can change the settings of the payment service here:</p>
    <form method="post" name="snd" action="admin.php">
        <input type="hidden" name="action" value="paymentSettings"/>
        <br>
        <div class="p1">
            <table width="100%" cellspacing="0" cellpadding="0" style="border: none;">
                <tbody>
                <tr>
                    <td>
                        <label>Payment status:</label>
                        <select name="paymentStatus">
                            <option value="0"<?= ($params['active'] == 0 ? ' selected' : ''); ?>>Disabled</option>
                            <option value="1"<?= ($params['active'] == 1 ? ' selected' : ''); ?>>Enabled</option>
                        </select>
                        <span class="e f7"></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Offer(+20%):</label>
                        <select name="paymentOffer">
                            <?php
                            function get_time_promotion($seconds)
                            {
                                if ($seconds == 0) {
                                    return 'Disabled';
                                }
                                if ($seconds % 86400 == 0) {
                                    return sprintf('Active for ~ %s day(s)', $seconds / 86400);
                                } else if ($seconds % 3600 == 0) {
                                    return sprintf('Active for ~ %s hour(s)', $seconds / 3600);
                                } else if ($seconds % 60 == 0) {
                                    return sprintf('Active for ~ %s minute(s)', $seconds / 60);
                                }
                                return sprintf('Active for ~ %s second(s)', $seconds);
                            }

                            foreach ($params['offer_times'] as $index => $value) {
                                echo '<option value="' . $index . '" ' . ($params['offer'] == $index ? ' selected' : '') . '>' . get_time_promotion($value) . '</option>';
                            }
                            ?>
                        </select>
                        <span class="e f7"></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" name="sendMessage"
                               value="1" <?php if (isset($_POST['sendMessage']) && $_POST['sendMessage'] == 1) echo 'checked'; ?>>
                        Send public message
                        <span class="e f7"></span>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <p class="btn"><input type="image" value="submit" name="submit" id="btn_save" class="dynamic_img"
                              src="img/x.gif" alt="Send"/></p>
        <p align="center"><?= $params['error']; ?></p>
    </form>
<?php elseif ($templateName == 'tpl/map.tpl'): ?>
    <link rel="stylesheet" href="img/admin/map.css" type="text/css" media="all">
    <h2>Travian Map!</h2>
    <p>This is the map of Travian. Search and find players.</p>
    <br/>
    <div id="kaart">
        <div id="map" title="">
            <div class="zoomlevels">
                <span id="zl">-<?= MAP_SIZE; ?></span>
                <span id="zr"><?= MAP_SIZE; ?></span>
                <span id="zb"><?= MAP_SIZE; ?></span>
                <span id="zo">-<?= MAP_SIZE; ?></span>
                <span id="zc">(0,0)</span>
                <div id="lijn_hor"></div>
                <div id="lijn_ver"></div>
            </div>
            <div style="top: 0px; left: 0px;" id="map_bg">
                <?= $params['content']; ?>
            </div>
        </div>
        <div id="legenda">
            <div class="content">
                <h3>Legend</h3>
                <div id="items">
                    <div class="first"></div>
                    <table cellspacing="0" cellpadding="2">
                        <tr>
                            <td><img src="img/admin/map_1.gif" height="11" width="11"></td>
                            <td class="show">Romans</td>
                        </tr>
                        <tr>
                            <td><img src="img/admin/map_2.gif" height="11" width="11"></td>
                            <td class="show">Teutons</td>
                        </tr>
                        <tr>
                            <td><img src="img/admin/map_3.gif" height="11" width="11"></td>
                            <td class="show">Gauls</td>
                        </tr>
                        <tr>
                            <td><img src="img/admin/map_5.gif" height="11" width="11"></td>
                            <td class="show">Natars</td>
                        </tr>
                        <tr>
                            <td><img src="img/admin/map_6.gif" height="11" width="11"></td>
                            <td class="show">Egyptions</td>
                        </tr>
                        <tr>
                            <td><img src="img/admin/map_7.gif" height="11" width="11"></td>
                            <td class="show">Huns</td>
                        </tr>
                        <tr>
                            <td><img src="img/admin/map_0.gif" height="11" width="11"></td>
                            <td class="show">Multihunter</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php elseif ($templateName == 'tpl/login.tpl'): ?>
    <div align="center"><img src="img/admin/admin.gif" width="468" height="60" border="0"></div>
    ﻿<p>Welcome to the Admin Control Panel. Please enter name and password:</p>
    <form method="post" name="snd" action="admin.php">
        <input type="hidden" name="login" value="<?= get_random_string(14); ?>">
        <p class="old_p1" style="border:0px;">
        <table width="100%" cellspacing="0" cellpadding="0" style="border: none;">
            <tr>
                <td><label>Name:</label>
                    <input class="fm fm110" type="text" name="name" value="" maxlength="15"> <span class="e f7"></span>
                </td>
            </tr>
            <tr>
                <td><label>Password:</label>
                    <input class="fm fm110" type="password" name="pw" value="" maxlength="20"> <span
                            class="e f7"></span>
                </td>
            </tr>
            <tr>
                <td>
                    <?php global $globalConfig; ?>
                    <div style="margin-left: 170px;">
                        <?= recaptcha_get_html(); ?>
                    </div>
                </td>
            </tr>
        </table>
        </p>
        <p align="center"><input type="image" value="login" border="0" name="s1" src="img/admin/b/l1.gif" width="80"
                                 height="20"></p>
        <p align="center"><?= $params['error']; ?></p>
    </form>
<?php elseif ($templateName == 'tpl/showReport.tpl'): ?>
    <h2>Reports</h2>
    <p>You can view a deleted or reported report by it`s id here:</p>
    <form method="post" name="snd" action="admin.php">
        <input type="hidden" name="action" value="showReport"/>
        <div class="p1">
            <table width="100%" cellspacing="0" cellpadding="0">
                <tbody>
                <tr>
                    <td>
                        <label>Player Name:</label>
                        <input type="text" class="fm fm110" name="playerName" value="<?= $params['playerName']; ?>">
                    </td>
                    <td>
                        <input type="image" value="submit" name="submit" id="btn_ok" class="dynamic_img" src="img/x.gif"
                               alt="Send"/></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <hr/>
                    </td>
                </tr>
                <tr>
                    <td style="width: 50%;">
                        <label>Player ID:</label>
                        <input type="number" class="fm fm110" name="uid" value="<?= $params['uid']; ?>">
                        <br/>
                    </td>
                    <td>
                        <input type="image" value="submit" name="submit" id="btn_ok" class="dynamic_img" src="img/x.gif"
                               alt="Send"/></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <hr/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Report ID:</label>
                        <input type="number" class="fm fm110" name="rptId" value="<?= $params['rptId']; ?>">
                    </td>
                    <td>
                        <input type="image" value="submit" name="submit" id="btn_ok" class="dynamic_img" src="img/x.gif"
                               alt="Send"/></p>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <p align="center"><?= $params['error']; ?></p>
    </form>
<?php elseif ($templateName == 'tpl/showMessage.tpl'): ?>
    <h2>Messages</h2>
    <p>You can view a deleted or reported message by it`s id here:</p>
    <form method="post" name="snd" action="admin.php">
        <input type="hidden" name="action" value="showMessage"/>
        <div class="p1">
            <table width="100%" cellspacing="0" cellpadding="0">
                <tbody>
                <tr>
                    <td>
                        <label>Player Name:</label>
                        <input type="text" class="fm fm110" name="playerName" value="<?= $params['playerName']; ?>">
                    </td>
                    <td>
                        <input type="image" value="submit" name="submit" id="btn_ok" class="dynamic_img" src="img/x.gif"
                               alt="Send"/></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <hr/>
                    </td>
                </tr>
                <tr>
                    <td style="width: 50%;">
                        <label>Player ID:</label>
                        <input type="number" class="fm fm110" name="uid" value="<?= $params['uid']; ?>">
                        <br/>
                    </td>
                    <td>
                        <input type="image" value="submit" name="submit" id="btn_ok" class="dynamic_img" src="img/x.gif"
                               alt="Send"/></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <hr/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Message ID:</label>
                        <input type="number" class="fm fm110" name="msgId" value="<?= $params['msgId']; ?>">
                    </td>
                    <td>
                        <input type="image" value="submit" name="submit" id="btn_ok" class="dynamic_img" src="img/x.gif"
                               alt="Send"/></p>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <p align="center"><?= $params['error']; ?></p>
    </form>
<?php elseif ($templateName == 'tpl/upgradeVillage.tpl'): ?>
    <h2>Upgrade village</h2>
    <br/>
    <form method="post" action="?action=upgradeVillage&kid=<?= $params['kid']; ?>">
        <?= getCheckerInput(); ?>
        <table id="profile" cellpadding="1" cellspacing="1">
            <thead>
            <tr>
                <th colspan="2">Player
                    <a href="admin.php?action=editPlayer&uid=<?= $params['playerId']; ?>">
                        <?= $params['playerName']; ?>
                    </a>
                </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Player Name</td>
                <td>
                    <a href="admin.php?action=editVillage&kid=<?= $params['kid']; ?>"><?= $params['villageName']; ?>
                        (<?= implode("|", Formulas::kid2xy($params['kid'])); ?>)</a>
                </td>
            </tr>
            <tr>
                <td>Target population</td>
                <td>
                    <input class="name text" type="text" name="pop" value="<?= $params['pop']; ?>"
                           id="pop" maxlength="20">
                </td>
            </tr>
            </tbody>
        </table>
        <p class="btn">
            <input type="image" value="submit" name="submit" id="btn_ok" class="dynamic_img" src="img/x.gif"
                   alt="Save"/>
        </p>
        <a href="?action=editVillage&kid=<?= $params['kid']; ?>">« go back</a>
    </form>
<?php elseif ($templateName == 'tpl/ServerInfo.tpl'): ?>
    <table id="profile">
        <thead>
        <tr>
            <th colspan="2"><?= $params['title']; ?></th>
        </tr>
        </thead>
        <?= $params['content']; ?>
        <tbody>
    </table>
    <script type="text/javascript">
        function addAdminChangeEventListener(id, name) {
            element = document.getElementById(id);
            if (element !== null && element !== undefined) {
                element.addEventListener("change", function () {
                    document.location.href = "admin.php?action=configurationDetails&" + name + "=" + this.value;
                });
            }
        }

        addAdminChangeEventListener("fakeAccountProcess", "fakeAccountProcess");
        addAdminChangeEventListener("celebration", "celebration");
        addAdminChangeEventListener("activation", "activation");
        addAdminChangeEventListener("needPreregistrationCode", "needPreregistrationCode");
        addAdminChangeEventListener("maintenance", "maintenance");
        addAdminChangeEventListener("registerClosed", "registerClosed");
    </script>
<?php elseif ($templateName == 'tpl/troop_tbody.tpl'): ?>
    <tbody class="troops">
    <tr>
        <?php
        for ($i = 1; $i <= 11; ++$i) {
            if ($i == 11) {
                $unitId = 'hero';
            } else {
                $unitId = nrToUnitId($i, $params['race']);
            }
            $title = T("Troops", "$unitId.title");
            echo '<td style="text-align: center;"><img class="unit u' . $unitId . '" src="img/x.gif" title="' . $title . '" alt="' . $title . '" /></td>';
        }
        ?>
    </tr>
    <tr>
        <?php
        $default = false;
        for ($i = 1; $i <= 11; ++$i) {
            if ($params['units'][$i]) {
                $num = $params['units'][$i];
                if ($num >= 1000000 && !$default) {
                    echo '<td style="text-align: center;">' . round($num / 1000000) . 'm</td>';
                } else if ($num >= 1000 && !$default) {
                    echo '<td style="text-align: center;">' . round($num / 1000) . 'k</td>';
                } else {
                    echo '<td style="text-align: center;">' . $num . '</td>';
                }
            } else {
                echo '<td class="none" style="text-align: center;">0</td>';
            }
        }
        ?>
    </tr>
    </tbody>
<?php elseif ($templateName == 'tpl/inGameAddNews.tpl'): ?>
    <p>
        <br>
        ﻿<h2>Add/Edit inGame news:</h2>
    <form method="post" name="snd" action="admin.php">
        <input type="hidden" name="action" value="inGameNews"/>
        <?= getCheckerInput(); ?>
        <input type="hidden" name="section" value="<?= $params['isEdit'] ? 'editNews' : 'addNews'; ?>"/>
        <?php if (isset($params['id'])): ?>
            <input type="hidden" name="id" value="<?= $params['id']; ?>"/>
        <?php endif; ?>
        <br>
        <div class="p1">
            <table width="100%" cellspacing="0" cellpadding="0">
                <tbody>
                <tr>
                    <td>
                        <label>Title:</label>
                        <input class="fm fm110" type="text" name="title"
                               value="<?= $params['title']; ?>" maxlength="100">
                        <span class="e f7"><?= $params['error']; ?></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Expire time:</label>
                        <input class="fm fm110" type="text" name="time"
                               value="<?= $params['time']; ?>" maxlength="100">
                        <span class="e f7"></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Content:</label>
                        <textarea name="content" cols="20" rows="10"><?= $params['content']; ?></textarea>
                        <span class="e f7"></span>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <p class="btn">
            <input type="image" value="submit" name="submit" id="btn_ok" class="dynamic_img" src="img/x.gif"
                   alt="Save"/>
        </p>
    </form>
<?php elseif ($templateName == 'tpl/addNews.tpl'): ?>
    <p>
        <br>
        ﻿<h2>Add/Edit news:</h2>
    <form method="post" name="snd" action="admin.php">
        <input type="hidden" name="action" value="news"/>
        <?= getCheckerInput(); ?>
        <input type="hidden" name="section" value="<?= $params['isEdit'] ? 'editNews' : 'addNews'; ?>"/>
        <?php if (isset($params['id'])): ?>
            <input type="hidden" name="id" value="<?= $params['id']; ?>"/>
        <?php endif; ?>
        <br>
        <div class="p1">
            <table width="100%" cellspacing="0" cellpadding="0">
                <tbody>
                <tr>
                    <td>
                        <label>Title:</label>
                        <input class="fm fm110" type="text" name="title"
                               value="<?= $params['title']; ?>" maxlength="255">
                        <span class="e f7"></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Expire time:</label>
                        <input class="fm fm110" type="text" name="time"
                               value="<?= $params['time']; ?>" maxlength="100">
                        <span class="e f7"></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>More link:</label>
                        <input class="fm fm110" type="text" name="moreLink"
                               value="<?= $params['moreLink']; ?>" maxlength="255">
                        <span class="e f7"></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Short-desc:</label>
                        <textarea name="shortDesc" cols="20" rows="10"><?= $params['shortDesc']; ?></textarea>
                        <span class="e f7"></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Content:</label>
                        <textarea name="content" cols="20" rows="10"><?= $params['content']; ?></textarea>
                        <span class="e f7"></span>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <p class="btn">
            <input type="image" value="submit" name="submit" id="btn_ok" class="dynamic_img" src="img/x.gif"
                   alt="Save"/>
        </p>
    </form>
<?php elseif ($templateName == 'tpl/loginInfo.tpl'): ?>
    <h1>Login info description</h1>
    <form method="post" name="snd" action="admin.php?action=loginInfo">
        <?= getCheckerInput(); ?>
        <br>
        <div class="p1">
            <table width="100%" cellspacing="0" cellpadding="0">
                <tbody>
                <tr>
                    <td>
                        <label>Title:</label>
                    </td>
                    <td>
                        <input type="text" name="subject" value="<?= $params['subject']; ?>">
                        <span class="e f7"></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Message:</label>
                    </td>
                    <td>
                        <label>HTML:</label>
                        <textarea name="message"
                                  style="width: 500px; height: 400px;"><?= $params['message']; ?></textarea>
                        <span class="e f7"></span>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <p align="center">
            <input type="Submit" name="" value="&nbsp;send &nbsp;">
        </p>
    </form>
    <?php if (!empty($params['error'])) echo '<br />'; ?>
    <p style="margin-top: 30px;"><font color="Red"><b><?= $params['error']; ?></b></font></p>
<?php elseif ($templateName == 'tpl/sendEmail.tpl'): ?>
    <h1>Send email to <?= ($params['newsletterType'] == 'special' ? 'Special ' : ''); ?>newsletter</h1>
    <form method="post" name="snd"
          action="admin.php?action=<?= ($params['newsletterType'] == 'special' ? 'sendSpecialEmail' : 'sendEmail'); ?>">
        <?= getCheckerInput(); ?>
        <br>
        <div class="p1">
            <table width="100%" cellspacing="0" cellpadding="0">
                <tbody>
                <tr>
                    <td>
                        <label>Subject:</label>
                    </td>
                    <td>
                        <input type="text" name="subject" required value="<?= $params['subject']; ?>">
                        <span class="e f7"></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Message:</label>
                    </td>
                    <td>
                        <label>HTML:</label>
                        <textarea required name="message"
                                  style="width: 500px; height: 400px;"><?= $params['message']; ?></textarea>
                        <span class="e f7"></span>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <p align="center">
            <input type="Submit" name="" value="&nbsp;send &nbsp;">
        </p>
    </form>
    <?php if (!empty($params['error'])) echo '<br />'; ?>
    <p style="margin-top: 30px;"><font color="Red"><b><?= $params['error']; ?></b></font></p>
<?php elseif ($templateName == 'tpl/sendTestEmail.tpl'): ?>
    <h1>Send test email</h1>
    <form method="post" name="snd" action="admin.php?action=sendTestEmail">
        <?= getCheckerInput(); ?>
        <br>
        <div class="p1">
            <table width="100%" cellspacing="0" cellpadding="0">
                <tbody>
                <tr>
                    <td>
                        <label>Receiver:</label>
                    </td>
                    <td>
                        <input type="email" name="email" required value="<?= $params['email']; ?>">
                        <span class="e f7"></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Subject:</label>
                    </td>
                    <td>
                        <input type="text" name="subject" required value="<?= $params['subject']; ?>">
                        <span class="e f7"></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Message:</label>
                    </td>
                    <td>
                        <label>HTML:</label>
                        <textarea required name="message"
                                  style="width: 500px; height: 400px;"><?= $params['message']; ?></textarea>
                        <span class="e f7"></span>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <p align="center">
            <input type="Submit" name="" value="&nbsp;send &nbsp;">
        </p>
    </form>
    <?php if (!empty($params['error'])) echo '<br />'; ?>
    <p style="margin-top: 30px;"><font color="Red"><b><?= $params['error']; ?></b></font></p>
<?php elseif ($templateName == 'tpl/privateMessage.tpl'): ?>
    <h1>Send private message</h1>
    <form method="post" name="snd" action="admin.php?action=sendPrivateMessage">
        <br>
        <div class="p1">
            <table width="100%" cellspacing="0" cellpadding="0">
                <tbody>
                <tr>
                    <td>
                        <label>Send email:</label>
                        <br/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>HTML:</label>
                        <textarea name="message"
                                  style="width: 500px; height: 400px;"><?= $params['message']; ?></textarea>
                        <span class="e f7"></span>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <p align="center">
            <input type="Submit" name="" value="&nbsp;send &nbsp;">
        </p>
    </form>
<?php elseif ($templateName == 'tpl/publicMessage.tpl'): ?>
    <h1>Send public message</h1>
    <form method="post" name="snd" action="admin.php?action=sendPublicMessage">
        <br>
        <div class="p1">
            <table width="100%" cellspacing="0" cellpadding="0">
                <tbody>
                <tr>
                    <td>
                        <label>Send email:</label>
                        <br/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>HTML:</label>
                        <textarea name="message"
                                  style="width: 500px; height: 400px;"><?= $params['message']; ?></textarea>
                        <span class="e f7"></span>
                    </td>
                </tr>

                </tbody>
            </table>
        </div>
        <p align="center">
            <input type="Submit" name="" value="&nbsp;send &nbsp;">
        </p>
    </form>

<?php elseif ($templateName == 'tpl/inGameShowNews.tpl'): ?>
    <h2>
        InGame News
    </h2>

    <table cellpadding="1" cellspacing="1" id="member">
        <thead>
        <tr>
            <th colspan="3">Active news</th>
        </tr>
        <tr>
            <td>Title</td>
            <td>Expire time</td>
            <td style="width: 5%">Actions</td>
        </tr>
        </thead>
        <tbody>
        <?= $params['news']; ?>
        </tbody>
    </table>
    <p><a href="admin.php?action=inGameNews&section=addNews">» Add news</a></p>
<?php elseif ($templateName == 'tpl/showNews.tpl'): ?>
    <h2>
        News
    </h2>

    <table cellpadding="1" cellspacing="1" id="member">
        <thead>
        <tr>
            <th colspan="3">Active news</th>
        </tr>
        <tr>
            <td>Content</td>
            <td>Expire time</td>
            <td style="width: 5%">Actions</td>
        </tr>
        </thead>
        <tbody>
        <?= $params['news']; ?>
        </tbody>
    </table>
    <p><a href="admin.php?action=news&section=addNews">» Add news</a></p>
<?php elseif ($templateName == 'tpl/editAlliance.tpl'): ?>
    <br/>
    <form action="admin.php?action=editAlliance&section=editAll" method="POST">
        <?= getCheckerInput(); ?>
        <input type="hidden" name="aid" value="<?= $params['allianceId']; ?>">
        <table id="profile" cellpadding="1" cellspacing="1">
            <thead>
            <tr>
                <th colspan="2">Alliance
                    <a href="admin.php?action=editAlliance&uid=<?= $params['allianceId']; ?>">
                        <?= $params['tag']; ?>
                    </a>
                </th>
            </tr>
            <tr>
                <td>Details</td>
                <td>Description</td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="empty"></td>
                <td class="empty"></td>
            </tr>
            <tr>
                <td class="details">
                    <table cellpadding="0" cellspacing="0">
                        <tr>
                            <th>Tag</th>
                            <td>
                                <input type="text" class="fm" name="tag" value="<?= $params['tag']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>
                                <input type="text" class="fm" name="name" value="<?= $params['name']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="empty"></td>
                        </tr>
                        <tr>
                            <th>Rank</th>
                            <td>
                                <?= $params['allianceRank']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Points</th>
                            <td>
                                <?= $params['points']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Members</th>
                            <td>
                                <?= $params['Members']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="empty"></td>
                        </tr>
                        <?php if ($params['hasPosition']): ?>
                            <?= $params['position']; ?>
                        <?php endif; ?>

                        <tr>
                            <td colspan="2" class="empty"></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <a class="rn3"
                                   href="?action=editAlliance&section=deleteAlliance&aid=<?= $params['allianceId']; ?>&<?= Session::getCheckerForUrl(); ?>"><font
                                            color="red">&raquo;</font> Delete Alliance</a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="empty"></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="desc2">
                                        <textarea tabindex="8" cols="45" rows="18" name="desc2">
                                            <?= $params['desc2']; ?>
                                        </textarea>
                            </td>
                        </tr>
                    </table>
                <td rowspan="8" class="desc1">
                            <textarea tabindex="7" cols="45" rows="32" name="desc1">
                                <?= $params['desc1']; ?>
                            </textarea>
                </td>
            </tr>
            </tbody>
        </table>
        <table cellpadding="1" cellspacing="1" id="member">
            <thead>
            <tr>
                <th>&nbsp;</th>
                <th>Player</th>
                <th>Population:</th>
                <th>Villages</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?= $params['MembersHTML']; ?>
            </tbody>
        </table>
        <p class="btn">
            <input type="image" value="submit" name="submit" id="btn_save" class="dynamic_img" src="img/x.gif"
                   alt="Save"/>
        </p>
    </form>
<?php elseif ($templateName == 'tpl/editUser.tpl'): ?>
    <br/>
    <form action="admin.php?action=editPlayer&section=editAll" method="POST">
        <?= getCheckerInput(); ?>
        <input type="hidden" name="uid" id="uid" value="<?= $params['playerId']; ?>">
        <input type="hidden" name="old_gift_gold" value="<?= $params['gift_gold']; ?>">
        <input type="hidden" name="old_bought_gold" value="<?= $params['bought_gold']; ?>">
        <table id="profile" cellpadding="1" cellspacing="1">
            <thead>
            <tr>
                <th colspan="2">Player
                    <a href="admin.php?action=editPlayer&uid=<?= $params['playerId']; ?>">
                        <?= $params['playerName']; ?>
                    </a>
                </th>
            </tr>
            <tr>
                <td>Details</td>
                <td>Description</td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="empty"></td>
                <td class="empty"></td>
            </tr>
            <tr>
                <td class="details" style="width: 40%">
                    <table cellpadding="0" cellspacing="0">
                        <tr>
                            <th>Rank</th>
                            <td>
                                <?= $params['playerRank']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Tribe</th>
                            <td>
                                <?= ['Romans', 'Teutons', 'Gauls', 'Nature', 'Natars', 'Egyptians', 'Huns'][$params['tribeId'] - 1]; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Alliance</th>
                            <td>
                                <?= $params['allianceTag']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Villages</th>
                            <td>
                                <?= $params['total_villages']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Population</th>
                            <td>
                                <?= $params['total_pop']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Username</th>
                            <td>
                                <input type="text" class="fm" name="username" value="<?= $params['playerName']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>
                                <input class="fm" name="email" value="<?= $params['email']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <th>Email Verified?</th>
                            <td>
                                <select name="email_verified"  class="fm">
                                    <option value="0" <?= ($params['email_verified'] == 0 ? 'selected' : ''); ?>>No</option>
                                    <option value="1" <?= ($params['email_verified'] == 1 ? 'selected' : ''); ?>>Yes</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Location</th>
                            <td>
                                <input type="text" class="fm" name="location" value="<?= $params['playerLocation']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="empty"></td>
                        </tr>
                        <tr>
                            <th>Access</th>
                            <td>
                                <b><?= ['Banned', 'Normal', 'Admin', 'Natars'][$params['access']]; ?></b>
                            </td>
                        </tr>
                        <tr>
                            <th>Gift Gold</th>
                            <td>
                                <input type="text" class="fm" name="gift_gold" value="<?= $params['gift_gold']; ?>">
                                <img src="img/admin/gold.gif">
                            </td>
                        </tr>
                        <tr>
                            <th>Bought Gold</th>
                            <td>
                                <input type="text" class="fm" name="bought_gold" value="<?= $params['bought_gold']; ?>">
                                <img src="img/admin/gold.gif">
                            </td>
                        </tr>
                        <tr>
                            <th>Silver</th>
                            <td>
                                <input type="text" class="fm" name="silver" value="<?= $params['silver']; ?>">
                                <img src="img/admin/gold.gif">
                            </td>
                        </tr>
                        <tr>
                            <th>Culture points</th>
                            <td>
                                <input type="text" class="fm" name="cp" value="<?= $params['cp']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <th>Success adventures count</th>
                            <td>
                                <input type="text" class="fm" name="success_adventures_count"
                                       value="<?= $params['success_adventures_count']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <th>Old rank</th>
                            <td>
                                <?= $params['oldRank']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Last Activity</th>
                            <td>
                                <?= $params['lastLoginTimeDate']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Registration time</th>
                            <td>
                                <?= $params['registrationTimeDate']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Last IP</th>
                            <td>
                                <a href="admin.php?action=IPBan&ip=<?= $params['lastIP']; ?>"><?= $params['lastIP']; ?></a>
                            </td>
                        </tr>
                        <tr>
                            <th>Last IP Location</th>
                            <td>
                                <?= $params['lastIPLocation']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>IPs</th>
                            <td>
                                <?=implode("<br />", $params['IPs']);?>
                            </td>
                        </tr>
                        <tr>
                            <th>Week Attack Points</th>
                            <td>
                                <input type="text" class="fm" name="week_attack_points"
                                       value="<?= $params['week_attack_points']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <th>Week Defence Points</th>
                            <td>
                                <input type="text" class="fm" name="week_defense_points"
                                       value="<?= $params['week_defense_points']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <th>Week Resources Raided</th>
                            <td>
                                <input type="text" class="fm" name="week_robber_points"
                                       value="<?= $params['week_robber_points']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <th>Total Attack Points</th>
                            <td>
                                <input type="text" class="fm" name="total_attack_points"
                                       value="<?= $params['total_attack_points']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <th>Total Defence Points</th>
                            <td>
                                <input type="text" class="fm" name="total_defense_points"
                                       value="<?= $params['total_defense_points']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <th>New Password</th>
                            <td>
                                <input type="password" class="fm" name="password" value="">
                            </td>
                        </tr>
                        <tr>
                            <th><b><font color='#71D000'>P</font><font color='#FF6F0F'>l</font><font
                                            color='#71D000'>u</font><font color='#FF6F0F'>s</font></b>
                            </th>
                            <td>
                                <input type="text" class="fm" name="plus" value="<?= $params['plusDate']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <th style="font-size: 11px">*Protection Bought Hour(s)</th>
                            <td>
                                <input type="text" class="fm" name="protectionHours" value="<?= $params['protectionHours']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <th>*Protection last buy</th>
                            <td>
                                <input type="text" class="fm" name="protectionLastExtend" value="<?= $params['protectionLastExtend']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <th>**Protection</th>
                            <td>
                                <input type="text" class="fm" name="protection" value="<?= $params['protectionDate']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <th><img src="img/admin/r/1.gif"> Bonus</th>
                            <td>
                                <input type="text" class="fm" name="b1" value="<?= $params['b1Date']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <th><img src="img/admin/r/2.gif"> Bonus</th>
                            <td>
                                <input type="text" class="fm" name="b2" value="<?= $params['b2Date']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <th><img src="img/admin/r/3.gif"> Bonus</th>
                            <td>
                                <input type="text" class="fm" name="b3" value="<?= $params['b3Date']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <th><img src="img/admin/r/4.gif"> Bonus</th>
                            <td>
                                <input type="text" class="fm" name="b4" value="<?= $params['b4Date']; ?>">
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2" class="empty"></td>
                        </tr>
                        <script type="text/javascript">
                            function confirmAction() {
                                if(!confirm("Are you sure you want to do this?")){
                                    return false;
                                }
                                return true;
                            }
                        </script>
                        <?php if($params['tribeId'] <> 1):?>
                            <tr>
                                <td colspan="2">
                                    <a style="color: brown" onclick="return confirmAction();" href="?action=editPlayer&section=changeTribeToRomans&uid=<?= $params['playerId']; ?>">&raquo;
                                        Change Tribe To Romans</a>
                                </td>
                            </tr>
                        <?php endif;?>
                        <?php if($params['tribeId'] <> 2):?>
                            <tr>
                                <td colspan="2">
                                    <a style="color: brown" onclick="return confirmAction();" href="?action=editPlayer&section=changeTribeToTeutons&uid=<?= $params['playerId']; ?>">&raquo;
                                        Change Tribe To Teutons</a>
                                </td>
                            </tr>
                        <?php endif;?>
                        <?php if($params['tribeId'] <> 3):?>
                            <tr>
                                <td colspan="2">
                                    <a style="color: brown" onclick="return confirmAction();" href="?action=editPlayer&section=changeTribeToGuals&uid=<?= $params['playerId']; ?>">&raquo;
                                        Change Tribe To Guals</a>
                                </td>
                            </tr>
                        <?php endif;?>
                        <?php if($params['tribeId'] <> 6):?>
                            <tr>
                                <td colspan="2">
                                    <a style="color: brown" onclick="return confirmAction();" href="?action=editPlayer&section=changeTribeToEgyptians&uid=<?= $params['playerId']; ?>">&raquo;
                                        Change Tribe To Egyptians</a>
                                </td>
                            </tr>
                        <?php endif;?>
                        <?php if($params['tribeId'] <> 7):?>
                            <tr>
                                <td colspan="2">
                                    <a style="color: brown" onclick="return confirmAction();" href="?action=editPlayer&section=changeTribeToHuns&uid=<?= $params['playerId']; ?>">&raquo;
                                        Change Tribe To Huns</a>
                                </td>
                            </tr>
                        <?php endif;?>
                        <tr>
                            <td colspan="2" class="empty"></td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                <a class="rn3"
                                   href="?action=editPlayer&section=deletePlayer&uid=<?= $params['playerId']; ?>&<?= Session::getCheckerForUrl(); ?>"><font
                                            color="red">&raquo;</font> Delete User</a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <a href="?action=bannedList&section=banToggle&uid=<?= $params['playerId']; ?>&<?= Session::getCheckerForUrl(); ?>">&raquo;
                                    Ban/Unban User</a>
                            </td>
                        </tr>
                        <?php if(Session::getInstance()->getPlayerId() > 0):?>
                        <tr>
                                <td colspan="2">
                                    <a href="/messages.php?t=1&id=<?= $params['playerId']; ?>" target="_blank">&raquo;
                                        Send message</a>
                                </td>
                        </tr>
                        <?php endif;?>
                        <tr>
                            <td colspan="2">
                                <a href="?action=editPlayer&section=punishPlayer&uid=<?= $params['playerId']; ?>">&raquo;
                                    Punish player</a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <a href="?action=gifts&giftUid=<?= $params['playerId']; ?>">&raquo;
                                    Gift Gold <img src="img/x.gif" class="gold"></a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <a href="?action=paymentVouchers&method=addVoucher&email=<?= $params['email']; ?>">&raquo;
                                    Add voucher</a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <a href="?action=paymentVouchers&method=showVoucher&email=<?= $params['email']; ?>">&raquo;
                                    Show vouchers</a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <a href="?action=editPlayer&section=fillResources&uid=<?= $params['playerId']; ?>">&raquo;
                                    Fill all resources</a>
                            </td>
                        </tr>
                        <?php if ($params['access'] <> 0): ?>
                            <tr>
                                <td colspan="2" class="empty"></td>
                            </tr>
                            <?php if ($params['access'] == 3): ?>
                                <tr>
                                    <td colspan="2">
                                        <a href="?action=editPlayer&section=setAsNormalUser&uid=<?= $params['playerId']; ?>">&raquo;
                                            Set as normal user</a>
                                    </td>
                                </tr>
                            <?php elseif ($params['access'] == 1): ?>
                                <tr>
                                    <td colspan="2">
                                        <a href="?action=editPlayer&section=setAsFakeUser&uid=<?= $params['playerId']; ?>">&raquo;
                                            Set as fake user</a>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endif; ?>

                        <tr>
                            <td colspan="2" class="empty"></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <a href="?action=heroAddItem&uid=<?= $params['playerId']; ?>">&raquo; Add hero item</a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <a href="?action=addVillage&uid=<?= $params['playerId']; ?>">&raquo; Add village</a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <a href="?action=editPlayer&section=killHero&uid=<?= $params['playerId']; ?>">&raquo;
                                    Kill hero</a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="desc2">
                                        <textarea tabindex="8" cols="45" rows="20" name="desc2">
                                            <?= $params['desc2']; ?>
                                        </textarea>
                            </td>
                        </tr>
                    </table>
                <td class="desc1">
                            <textarea tabindex="8" cols="45" rows="70" name="desc1">
                                <?= $params['desc1']; ?>
                            </textarea>
                </td>
            </tr>
            </tbody>
        </table>
        <br/>
        <div>
            <div style="float: right; width: 49%">
                <table id="member" cellpadding="1" cellspacing="1">
                    <thead>
                    <tr>
                        <th colspan="6">Ban History (<?= $params['banHistory']['total']; ?>)</th>
                    </tr>
                    <tr>
                        <td class="hab"><b>Start</b></td>
                        <td class="hab"><b>End</b></td>
                        <td class="hab"><b>Duration</b></td>
                        <td class="on"><b>Reason</b></td>
                    </tr>
                    </thead>
                    <tbody>
                    <?= $params['banHistory']['content']; ?>
                    </tbody>
                </table>
            </div>
            <div style="float: left; width: 49%">
                <table id="member">
                    <thead>
                    <tr>
                        <th colspan="4">Villages</th>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Name</td>
                        <td style="width: 10%">Inhabitants</td>
                        <td style="width: 10%">Coordinates</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?= $params['villages']; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <br/>
        <br/><br/>
        <br/><br/>
        <br/><br/>
        <br/><br/>
        <br/><br/>
        <br/><br/>
        <p class="btn">
            <input type="image" value="submit" name="submit" id="btn_save" class="dynamic_img" src="img/x.gif"
                   alt="Save"/>
        </p>
    </form>
<?php elseif ($templateName == 'tpl/deleteAllMessages.tpl'): ?>
    <form action="admin.php?action=deleteAllMessages" method="POST">
        <?= getCheckerInput(); ?>
        <table id="member" style="width:300px;">
            <thead>
            <tr>
                <th colspan="2">Delete player messages</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <center>
                        <b>Which user (id)?</b>
                    </center>
                </td>
                <td>
                    <center>
                        <input class="give_gold" name="id" value="<?= $params['id']; ?>">&nbsp;
                    </center>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <center>
                        <input type="image" src="img/admin/b/ok1.gif" value="submit" title="Give free gold">
                    </center>
                </td>
            </tr>
            </tbody>
        </table>
    </form>
    <?php
    if ($params['result']) {
        echo '<br /><br /><font color="Red"><b>Messages deleted and player banned.</font></b>';
    }
    ?>
<?php elseif ($templateName == 'tpl/copyFarmlist.tpl'): ?>
    <form action="admin.php?action=copyFarmlist" method="POST">
        <?= getCheckerInput(); ?>
        <table id="member" style="width:300px;">
            <thead>
            <tr>
                <th colspan="2">Copy farms to a player village</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <center>
                        <b>To which user (kid)?</b>
                    </center>
                </td>
                <td>
                    <center>
                        <input class="give_gold" name="kid" value="<?= $params['kid']; ?>">&nbsp;
                    </center>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <center>
                        <input type="image" src="img/admin/b/ok1.gif" value="submit" title="Submit">
                    </center>
                </td>
            </tr>
            </tbody>
        </table>
    </form>
    <?php
    if (isset($params['result']) && $params['result']) {
        echo '<br /><br /><font color="Red"><b>Done.</font></b>';
    }
    ?>
<?php elseif ($templateName == 'tpl/deleteEmailNewsletter.tpl'): ?>
    <form action="admin.php?action=<?= ($params['newsletterType'] == 'special' ? 'DeleteSpecialEmailNewsletter ' : 'DeleteEmailNewsletter'); ?>"
          method="POST">
        <table id="member" style="width:300px;">
            <thead>
            <tr>
                <th colspan="2">Delete email from <?= ($params['newsletterType'] == 'special' ? 'Special ' : ''); ?>
                    newsletter
                </th>
            </tr>
            <tr>
                <td>Email</td>
                <td></td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <center>
                        <b>Email</b>
                    </center>
                </td>
                <td>
                    <center>
                        <input type="email" class="email" name="email" value="<?= $params['email']; ?>">&nbsp;
                    </center>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <center>
                        <input type="image" src="img/admin/b/ok1.gif" value="submit" title="Give free gold">
                    </center>
                </td>
            </tr>
            </tbody>
        </table>
    </form>
    <?php
    if (!empty($params['error'])) {
        echo '<br /><br /><font color="Red"><b>' . $params['error'] . '</font></b>';
    }
    ?>
<?php elseif ($templateName == 'tpl/changePassword.tpl'): ?>
    <p>
        <br>
        ﻿<p>Change Password:</p>
    <form method="post" name="snd" action="admin.php">
        <input type="hidden" name="action" value="changePassword"/>
        <br>
        <p align="center">
            <input type="Submit" name="" value="&nbsp; Change password &nbsp;">
        </p>
    </form>
    <p><?= $params['error']; ?></p>
<?php elseif ($templateName == 'tpl/addAdv.tpl'): ?>
    <h1>Add/edit Advertisement</h1>
    <p>You can add/edit a Advertisements here.</p>
    <form method="post" name="snd" action="admin.php">
        <input type="hidden" name="action" value="advertisement"/>
        <input type="hidden" name="method" value="<?= $params['method']; ?>"/>
        <?php if (isset($params['id'])): ?>
            <input type="hidden" name="id" value="<?= $params['id']; ?>"/>
        <?php endif; ?>
        <?= getCheckerInput(); ?>
        <div class="p1">
            <table width="100%" cellspacing="0" cellpadding="0" style="border: none;">
                <tbody>
                <tr>
                    <td>
                        <label>Content:</label>
                        <textarea name="content" rows="15" cols="50"><?= $params['content']; ?></textarea>
                        <span class="e f7"></span>
                    </td>
                </tr>
                <tr>
                    <td class="empty"></td>
                </tr>
                <tr>
                    <td>
                        <label>Expire time:</label>
                        <input class="fm fm110" type="text" name="time"
                               value="<?= $params['time']; ?>" maxlength="100">
                        <span class="e f7"></span>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <p class="btn"><input type="image" value="submit" name="submit" id="btn_save" class="dynamic_img"
                              src="img/x.gif" alt="Send"/></p>
        <p align="center"><?= $params['error']; ?></p>
    </form>
<?php elseif ($templateName == 'tpl/adv.tpl'): ?>
    <style type="text/css">
        table#member td, th {
            text-align: center;
        }
    </style>
    <p>
        Here is a list of advertisements.
    </p>
    <table cellpadding="1" cellspacing="1" id="member" class="member">
        <thead>
        <tr>
            <th colspan="5">Advertisements</th>
        </tr>
        <tr>
            <td style="width:3%;">No.</td>
            <td style="word-break: break-word;">Content</td>
            <td style="width:20%;">Creation time</td>
            <td style="width:20%;">Expire time</td>
            <td>Actions</td>
        </tr>
        </thead>
        <tbody>
        <?= $params['content']; ?>
        </tbody>
    </table>
    <br/>
    <a href="?action=advertisement&method=add">» Add advertisement</a>
<?php elseif ($templateName == 'tpl/multiAccountUsers.tpl'): ?>
    <style type="text/css">
        table#member td, th {
            text-align: center;
        }
    </style>
    <p>
        Here is a list of multiaccount users sorted by priority.
    </p>
    <table cellpadding="1" cellspacing="1" id="member" class="member">
        <thead>
        <tr>
            <th colspan="5">Multiaccount Users</th>
        </tr>
        <tr>
            <td style="width:3%;">No.</td>
            <td style="width:20%;">Username</td>
            <td style="width:20%;">Related accounts</td>
            <td style="width:20%;">Priority</td>
            <td>Actions</td>
        </tr>
        </thead>
        <tbody>
        <?= $params['content']; ?>
        </tbody>
        <tfoot>
        <tr>
            <th colspan="4"></th>
            <th class="navi" style="color:silver;font-weight:700"><?= $params['navigator']; ?></th>
        </tr>
        </tfoot>
    </table>
<?php endif; ?>