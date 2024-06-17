<?php

namespace Model;

use Core\Database\DB;
use Core\Session;
use Game\Formulas;

class BerichteModel
{
    public function deleteReport($reportId, $uid)
    {
        $db = DB::getInstance();
        $db->query("UPDATE ndata SET deleted=1, viewed=1 WHERE id=$reportId AND uid=$uid AND deleted=0");
        return FALSE;
    }

    public function setReportAsViewed($reportId, $uid)
    {
        $db = DB::getInstance();
        $db->query("UPDATE ndata SET viewed=1 WHERE id=$reportId AND uid=$uid AND deleted=0");
    }

    public function setReportAsUnViewed($reportId, $uid)
    {
        $db = DB::getInstance();
        $db->query("UPDATE ndata SET viewed=0 WHERE id=$reportId AND uid=$uid AND deleted=0");
    }

    public function archiveReport($reportId, $uid)
    {
        $db = DB::getInstance();
        $db->query("UPDATE ndata SET archive=1, viewed=1 WHERE id=$reportId AND uid=$uid AND deleted=0");
    }

    public function recoverReport($reportId, $uid)
    {
        $db = DB::getInstance();
        $db->query("UPDATE ndata SET archive=0 WHERE id=$reportId AND uid=$uid AND deleted=0 AND archive=1");
    }

    public function getReport($id)
    {
        $db = DB::getInstance();
        $id = (int)$id;
        $find = $db->query("SELECT * FROM ndata WHERE id=$id");
        if (!$find->num_rows) {
            return FALSE;
        }

        return $find->fetch_assoc();
    }

    public function getReportLinkWithKey($id)
    {
        $db = DB::getInstance();
        $id = (int)$id;
        $find = $db->query("SELECT id, private_key FROM ndata WHERE id=$id");
        if (!$find->num_rows) {
            return FALSE;
        }
        $report = $find->fetch_assoc();
        return 'reports.php?id=' . $report['id'] . '|' . $report['private_key'];
    }

    public function getJustOnReportForPositionData($kid, $uid)
    {
        $db = DB::getInstance();
        $find = $db->query("SELECT * FROM ndata WHERE uid=$uid AND to_kid=$kid AND type <= 3 ORDER BY id DESC LIMIT 1");
        if ($find->num_rows) {
            return $find->fetch_assoc();
        }

        return NULL;
    }

    public function getLast5Reports($aid, $uid, $kid)
    {
        $db = DB::getInstance();

        return $db->query("SELECT * FROM ndata WHERE (uid=$uid OR (aid>0 AND aid=$aid)) AND to_kid=$kid AND ((type <= 7) OR (type>=15 AND type<=19)) ORDER BY id DESC LIMIT 5");
    }

    public function getAllReports($uid, $page, $recursive, $tab, $customReports, $kid)
    {
        $db = DB::getInstance();
        $cond = '';
        if ($tab == 1 || $tab == 2 || $tab == 3 || $tab == 4) {
            if (sizeof($customReports) == 0) {
                $customReports = [0];
            }
            $cond = ' AND type IN(' . implode(",", $customReports[$tab]) . ')';
        }
        $archive = $tab == 5 ? 1 : 0;
        $stmt = $db->query($q = "SELECT * FROM ndata WHERE " . ($kid ? "to_kid=$kid AND " : "") . " uid={$uid} AND archive=$archive AND deleted=0 $cond ORDER BY id " . ($recursive ? "ASC" : "DESC") . " LIMIT " . (($page - 1) * Session::getInstance()->getReportsRecordsPerPage()) . ", " . Session::getInstance()->getReportsRecordsPerPage());
        return $stmt;
    }

    public function getAllReportsCount($uid, $tab, $customReports)
    {
        $db = DB::getInstance();
        $cond = '';
        if ($tab == 1) {
            $cond = ' AND type IN(' . implode(",", $customReports[1]) . ')';
        } else if ($tab == 2) {
            $cond = ' AND type IN(' . implode(",", $customReports[2]) . ')';
        } else if ($tab == 3) {
            $cond = ' AND type IN(' . implode(",", $customReports[3]) . ')';
        } else if ($tab == 4) {
            $cond = ' AND type IN(' . implode(",", $customReports[4]) . ')';
        }
        $archive = $tab == 5 ? 1 : 0;
        return $db->fetchScalar("SELECT COUNT(id) FROM ndata WHERE uid=$uid AND archive=$archive AND deleted=0 $cond");
    }

    public function getSurroundingCount($kid)
    {
        $xy = Formulas::kid2xy($kid);
        $db = DB::getInstance();
        $distance = "SQRT(POW(x-{$xy['x']}, 2)+POW(y-{$xy['y']}, 2))";
        return $db->fetchScalar("SELECT COUNT(id) FROM surrounding WHERE ($distance BETWEEN 1 AND 20)");
    }

    public function getSurrounding($kid, $page)
    {
        $xy = Formulas::kid2xy($kid);
        $db = DB::getInstance();
        $pageSize = Session::getInstance()->getReportsRecordsPerPage();
        $offset = ($page - 1) * $pageSize;
        $distance = "SQRT(POW(x-{$xy['x']}, 2)+POW(y-{$xy['y']}, 2))";
        return $db->query("SELECT *, $distance AS `distance` FROM surrounding WHERE ($distance BETWEEN 1 AND 20) ORDER BY id DESC LIMIT $offset, $pageSize");
    }
} 