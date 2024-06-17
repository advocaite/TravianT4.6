<?php

use Core\Database\DB;
use Core\Helper\TimezoneHelper;

class DeletingCtrl
{
    public function __construct()
    {
        $db = DB::getInstance();
        if(!isServerFinished() && isset($_REQUEST['section']) && $_REQUEST['section'] == 'del' && isset($_REQUEST['uid'])){
            $db->query("DELETE FROM deleting WHERE uid=" . (int)$_REQUEST['uid']);
        } else if(!isServerFinished() && isset($_REQUEST['section']) && $_REQUEST['section'] == 'deleteNow' && isset($_REQUEST['uid'])){
            $db->query("UPDATE deleting SET time=0 WHERE uid=" . (int)$_REQUEST['uid']);
        }
        $page = isset($_GET['p']) ? abs((int)$_GET['p']) : 1;
        $result = $db->query("SELECT u.id, d.time, u.name FROM deleting d, users u WHERE d.uid=u.id ORDER BY id DESC LIMIT " . (($page - 1) * $this->pageSize) . ", {$this->pageSize}");
        $params['content'] = null;
        while($row = $result->fetch_assoc()){
            $remaining = $row['time'] - time();
            $params['content'] .= '<tr>';
            $params['content'] .= '<td style="text-align: center;"><a onclick="return confirmAction();" href="admin.php?action=deleting&uid='.$row['id'].'&section=del"><img src="img/x.gif" class="del"></a></td>';
            $params['content'] .= '<td style="text-align: center;"><a href="admin.php?action=editPlayer&uid='.$row['id'].'">'.$row['name'].'</a></td>';
            $params['content'] .= '<td style="text-align: center;">'.secondsToString($remaining).'</td>';
            $params['content'] .= '<td style="text-align: center;">'.TimezoneHelper::autoDateString($row['time'], true).'</td>';
            $params['content'] .= '<td style="text-align: center;"><a onclick="return confirmAction();" href="admin.php?action=deleting&uid='.$row['id'].'&section=deleteNow">» Delete now</a></td>';
            $params['content'] .= '</tr>';
        }
        if(!$result->num_rows){
            $params['content'] .= '<tr><td colspan="6" class="hab"><span class="errorMessage">No deleting users.</span></td></tr>';
        }
        $params['navigator'] = $this->getNavigator($page, $db->fetchScalar("SELECT COUNT(uid) FROM deleting"), ['action' => 'activationList']);
        \Dispatcher::getInstance()->appendContent(\Template::getInstance()->load($params, 'tpl/deleting.tpl')->getAsString());
    }
    const NEXT_SHAPE = '»';
    const PREVIOUS_SHAPE = '«';
    private $pageSize = 50;
    private function previousPageNavigator($page, $num_rows, $prefix = [])
    {
        $text = self::PREVIOUS_SHAPE;
        $total_pages = ceil($num_rows / $this->pageSize);
        if (($page - 1) >= 1 && ($page - 1) <= $total_pages) {
            $prefix['p'] = --$page;
            $query = http_build_query($prefix);
            return '<a href="?' . $query . '">' . $text . '</a>';
        }
        return $text;
    }

    private function nextPageNavigator($page, $num_rows, $prefix = [])
    {
        $text = self::NEXT_SHAPE;
        $total_pages = ceil($num_rows / $this->pageSize);
        if ((1 + $page) <= $total_pages) {
            $prefix['p'] = ++$page;
            $query = http_build_query($prefix);
            return '<a href="?' . $query . '">' . $text . '</a>';
        }
        return $text;
    }

    private function getNavigator($page, $num_rows, $prefix = [])
    {
        return $this->previousPageNavigator($page, $num_rows, $prefix) . ' | ' . $this->nextPageNavigator($page, $num_rows, $prefix);
    }
}