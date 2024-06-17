<?php

use Core\Database\DB;
use Model\InfoBoxModel;
use Model\MultiAccount;

class MultiAccountCtrl
{
    public function __construct()
    {
        $multiAccount = new MultiAccount();
        if(isset($_GET['id'])){
            $id = (int)$_GET['id'];
            $result = $multiAccount->getMultiAccountById($id);
            if($result->num_rows){
                $result = $result->fetch_assoc();
                $this->banPlayer($result['uid']);
                if(!isset($_GET['main']) || $_GET['main'] != 'true'){
                    $players = explode("|", $result['data']);
                    foreach($players as $data){
                        $rData = explode(",", $data);
                        $this->banPlayer($rData[0]);
                    }
                }
            }
        }
        $page = isset($_GET['p']) ? abs((int)$_GET['p']) : 1;
        $params['content'] = null;
        $result = $multiAccount->getMultiAccountUsers($page, $this->pageSize);
        while ($row = $result->fetch_assoc()) {
            $params['content'] .= '<tr>';
            $params['content'] .= '<td class="on">' . $row['id'] . '</td>';
            $params['content'] .= '<td class="on"><a href="admin.php?action=editPlayer&uid=' . $row['uid'] . '">' . $this->getPlayerName($row['uid']) . '</a></td>';
            $params['content'] .= '<td>';
            $params['content'] .= '<table cellpadding="0" cellspacing="0" id="profile"><thead><tr><td class="on">Name</td><td class="on">Attacks</td><td class="on">Reinforcements</td><td class="on">Trades</td></tr></thead><tbody>';
            $players = explode("|", $row['data']);
            foreach($players as $data){
                $rData = explode(",", $data);
                $name = $this->getPlayerName($rData[0]);
                if($name == FALSE) continue;
                $params['content'] .= '<tr>';
                $params['content'] .= '<td class="on"><a href="admin.php?action=editPlayer&uid='.$rData[0].'">'.$name.'</a></td>';
                $params['content'] .= '<td class="on">'.$rData[1].'</td>';
                $params['content'] .= '<td class="on">'.$rData[2].'</td>';
                $params['content'] .= '<td class="on">'.$rData[3].'</td>';
                $params['content'] .= '</tr>';
            }
            $params['content'] .= '</tbody></table>';
            $params['content'] .= '</td>';
            $params['content'] .= '<td class="on">' . $row['priority'] . '</td>';
            $params['content'] .= '<td>';
            $params['content'] .= '<a href="admin.php?action=multiAccount&id='.$row['id'].'">Ban all players</a>';
            $params['content'] .= '<br /><a href="admin.php?action=multiAccount&id='.$row['id'].'&main=true">Ban main user</a>';
            $params['content'] .= '</td>';
            $params['content'] .= '</tr>';
        }
        if (!$result->num_rows) {
            $params['content'] .= '<tr><td colspan="5" class="hab"><span class="errorMessage">No multiaccount users detected.</span></td></tr>';
        }
        $params['navigator'] = $this->getNavigator($page, $multiAccount->getMultiAccountUsersTotal(), ['action' => 'multiAccount']);
        Dispatcher::getInstance()->appendContent(Template::getInstance()->load($params, 'tpl/multiAccountUsers.tpl')->getAsString());
    }
    private function banPlayer($uid, $reason = 'Multiaccount', $time = 0){
        $db = DB::getInstance();
        $exists = 0 < $db->fetchScalar("SELECT COUNT(id) FROM banQueue WHERE uid=$uid");
        if(!$exists){
            $db->query("UPDATE users SET access=0 WHERE id=$uid");
            if($db->affectedRows()){
                $db->query("INSERT INTO `banQueue`(`uid`, `reason`, `time`, `end`) VALUES ($uid, '$reason', ".time().", ".($time == 0 ? $time : $time+time()).")");
                $db->query("INSERT INTO `banHistory`(`uid`, `reason`, `time`, `end`) VALUES ($uid, '$reason', ".time().", ".($time == 0 ? $time : $time+time()).")");
                $db->query("DELETE FROM multiaccount_users WHERE uid=$uid");
                (new InfoBoxModel())->addInfo($uid, 0, 14, '', time(), time() + 365 * 86400);
                AdminLog::getInstance()->addLog("Banned ".$this->getPlayerName($uid).".");
            }
        }
    }
    private function getPlayerName($uid)
    {
        $db = DB::getInstance();
        $find = $db->fetchScalar("SELECT name FROM users WHERE id=$uid");
        if($find)
            return $find;
        return FALSE;
    }
    const NEXT_SHAPE = '»';
    const PREVIOUS_SHAPE = '«';
    private $pageSize = 5;
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