<?php

namespace Controller;

use Core\Config;
use Core\Database\DB;

class WinnerCtrl
{
    public function __construct(&$contentCssClass, &$content, $sysMsg = FALSE)
    {
        $content = '';
        if (!$sysMsg) {
            $content .= '<div class="sysmsg">';
        }
        if ($sysMsg) {
            $contentCssClass = 'error_site';
        } else {
            $contentCssClass = 'sysmsg';
        }
        if (Config::getInstance()->dynamic->serverFinished == 1) {
            $replace = T("Global", "ServerFinishWinner");
            $db = DB::getInstance();
            $kid = $db->fetchScalar("SELECT kid FROM fdata WHERE f99=100");
            $wData = $db->query("SELECT name, owner FROM vdata WHERE kid=$kid")->fetch_assoc();
            $uData = $db->query("SELECT id, name, aid FROM users WHERE id={$wData['owner']}")->fetch_assoc();
            $allianceName = $uData['aid'] == 0 ? '-' : ($db->fetchScalar("SELECT tag FROM alidata WHERE id={$uData['aid']}"));
            $order = [];
            $order[] = $this->getVillageLink($kid, $wData['name']);
            $order[] = $this->getPlayerLink($uData['id'], $uData['name']);
            $order[] = $this->getAllianceLink($uData['aid'], $allianceName);
            $order[] = $this->getPlayerLink($uData['id'], $uData['name']);
            $pop = $db->query("SELECT id, name FROM users WHERE id>1 AND hidden=0 ORDER BY total_pop DESC LIMIT 3");
            for ($i = 1; $i <= 3; ++$i) {
                if (!($row = $pop->fetch_assoc())) {
                    $order[] = '-';
                    continue;
                }
                $order[] = $this->getPlayerLink($row['id'], $row['name']);
            }
            $attacker = $db->query("SELECT id, name FROM users WHERE id>1 AND hidden=0 ORDER BY total_attack_points DESC LIMIT 1");
            if ($attacker->num_rows) {
                $attacker = $attacker->fetch_assoc();
                $order[] = $this->getPlayerLink($attacker['id'], $attacker['name']);
            } else {
                $order[] = '-';
            }
            $defender = $db->query("SELECT id, name FROM users WHERE id>1 AND hidden=0 ORDER BY total_defense_points DESC LIMIT 1");
            if ($defender->num_rows) {
                $defender = $defender->fetch_assoc();
                $order[] = $this->getPlayerLink($defender['id'], $defender['name']);
            } else {
                $order[] = '-';
            }
            $replace = str_replace("[DEFENDER]", $order[sizeof($order) - 1], $replace);
            $content .= vsprintf($replace, $order);
        } else {
            $replace = T("Global", "ServerFinishNoWinner");
            $db = DB::getInstance();
            $pop = $db->query("SELECT id, name FROM users WHERE id>1 AND hidden=0 ORDER BY total_pop DESC LIMIT 3");
            for ($i = 1; $i <= 3; ++$i) {
                if (!($row = $pop->fetch_assoc())) {
                    $order[] = '-';
                    continue;
                }
                $order[] = $this->getPlayerLink($row['id'], $row['name']);
            }
            $attacker = $db->query("SELECT id, name FROM users WHERE id>1 AND hidden=0 ORDER BY total_attack_points DESC LIMIT 1");
            if ($attacker->num_rows) {
                $attacker = $attacker->fetch_assoc();
                $order[] = $this->getPlayerLink($attacker['id'], $attacker['name']);
            } else {
                $order[] = '-';
            }
            $defender = $db->query("SELECT id, name FROM users WHERE id>1 AND hidden=0 ORDER BY total_defense_points DESC LIMIT 1");
            if ($defender->num_rows) {
                $defender = $defender->fetch_assoc();
                $order[] = $this->getPlayerLink($defender['id'], $defender['name']);
            } else {
                $order[] = '-';
            }
            $replace = str_replace("[DEFENDER]", $order[sizeof($order) - 1], $replace);
            $order = array_map("trim", $order);
            $content .= vsprintf($replace, $order);
        }
        if (!$sysMsg) {
            $content .= '<p class="f16" align="center"><a href="dorf1.php?ok=1">» ' . T("inGame", "continue") . '</a></p>';
            $content .= '</div>';
        }
    }

    private function getVillageLink($kid, $name)
    {
        return '<a href="karte.php?d=' . $kid . '">' . $name . '</a>';
    }

    private function getPlayerLink($uid, $name)
    {
        return '<a href="spieler.php?uid=' . $uid . '">' . $name . '</a>';
    }

    private function getAllianceLink($aid, $name)
    {
        if ($aid == 0) return '-';
        return '<a href="allianz.php?aid=' . $aid . '">' . $name . '</a>';
    }
} 