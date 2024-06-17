<?php

use Core\Database\DB;
use Core\Helper\TimezoneHelper;
use Core\Helper\WebService;
use Core\Session;
use Model\InfoBoxModel;

class PrivateInfoboxCtrl
{
    public function __construct()
    {
        $params['action'] = $_GET['action'];
        $params['expire'] = isset($_POST['expire']) && TimezoneHelper::strtotime($_POST['expire']) ? $_POST['expire'] : TimezoneHelper::date("Y-m-d H:i", time() + 86400);
        $params['html'] = isset($_POST['html']) ? $_POST['html'] : null;
        $db = DB::getInstance();
        if(isset($_REQUEST['section']) && $_REQUEST['section'] == 'delete'){
            $iId = (int)$_REQUEST['iid'];
            $db->query("DELETE FROM infobox WHERE id=$iId AND forAll=1 AND (type < 7 OR type > 10)");
            InfoBoxModel::invalidateAllUsersPrivateInfoBox();
            AdminLog::getInstance()->addLog("deleted {$params['action']}");
        }
        if(WebService::isPost() && Session::validateChecker() && TimezoneHelper::strtotime($params['expire'])){
            $this->addInfo($db, 0, 1, 0, nl2br($params['html']), time(), TimezoneHelper::strtotime($params['expire']));
            InfoBoxModel::invalidateAllUsersPrivateInfoBox();
            AdminLog::getInstance()->addLog("added {$params['action']}");
        }
        $result = $db->query("SELECT * FROM infobox WHERE forAll=1 AND (type < 7 OR type > 10) AND showTo>=" . time());
        $params['content'] = null;
        while($row = $result->fetch_assoc()){
            $params['content'] .= '<tr>';
            $params['content'] .= '<td style="text-align: center;" class="on">'.$row['params'].'</td>';
            $params['content'] .= '<td style="text-align: center;" class="on">'.\Core\Helper\TimezoneHelper::autoDateString($row['showTo']).'</td>';
            $params['content'] .= '<td style="text-align: center;" ><a href="?action='.$params['action'].'&section=delete&iid='.$row['id'].'"><img src="img/x.gif" class="del" title="delete" alt="delete"></a></td>';
            $params['content'] .= '</tr>';
        }
        if(!$result->num_rows){
            $params['content'] .= '<tr><td colspan="6" class="hab"><span class="errorMessage">Nothing found!</span></td></tr>';
        }
        Dispatcher::getInstance()->appendContent(Template::getInstance()->load($params, 'tpl/infobox.tpl')->getAsString());
    }
    public function addInfo(DB $db, $uid, $forAll, $type, $params, $showFrom, $showTo)
    {
        $params = $db->real_escape_string($params);
        $forAll = (int)$forAll;
        $db->query("INSERT INTO infobox (uid, forAll, type, params, showFrom, showTo) VALUES ($uid, $forAll, $type, '$params', $showFrom, $showTo)");
    }
}