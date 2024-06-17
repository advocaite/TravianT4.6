<?php

use Core\Database\GlobalDB;
use Core\Helper\TimezoneHelper;
use Core\Helper\WebService;
use Core\Session;

class AdvertisementCtrl
{
    public function __construct()
    {
        if(isset($_REQUEST['method'])){
            if(!isServerFinished() && $_REQUEST['method'] == 'add'){
                $this->addAdvertisement();
            } else if(!isServerFinished() && $_REQUEST['method'] == 'del'){
                $this->deleteAdvertisement();
            } else if(!isServerFinished() && $_REQUEST['method'] == 'edit'){
                $this->editAdvertisement();
            }
        } else {
            $this->showAdvertisements();
        }
    }
    private function editAdvertisement(){
        $db = GlobalDB::getInstance();
        $bannerId = (int)$_REQUEST['id'];
        $data = $db->query("SELECT * FROM bannerShop WHERE id={$bannerId}");
        if(!$data->num_rows) return;
        $data = $data->fetch_assoc();
        $params['id'] = $bannerId;
        $params['error'] = null;
        $params['content'] = $data['content'];;
        $params['method'] = $_REQUEST['method'];
        $params['time'] = TimezoneHelper::date("Y-m-d H:i", $data['expire']);
        if(WebService::isPost() && Session::validateChecker()){
            $params['time'] = filter_var($_POST['time'], FILTER_SANITIZE_STRING);
            $params['content'] = $_POST['content'];
            if(TimezoneHelper::strtotime($params['time']) && !empty($params['content'])){
                $time = TimezoneHelper::strtotime($params['time']);
                $db = GlobalDB::getInstance();
                $now = time();
                $db->query("UPDATE `bannerShop` SET content='".$params['content']."', expire='".$time."', time='".$now."' WHERE id=" . $bannerId);
                $this->showAdvertisements();
                return;
            } else {
                $params['error'] = 'invalid values!';
            }
        }
        Dispatcher::getInstance()->appendContent(Template::getInstance()->load($params, 'tpl/addAdv.tpl')->getAsString());
    }
    private function deleteAdvertisement(){
        $bannerID = (int)$_REQUEST['id'];
        $db = GlobalDB::getInstance();
        $db->query("DELETE FROM bannerShop WHERE id=$bannerID");
        $this->showAdvertisements();
    }
    private function addAdvertisement(){
        $params['error'] = null;
        $params['content'] = null;
        $params['method'] = $_REQUEST['method'];
        $params['time'] = TimezoneHelper::date("Y-m-d H:i");
        if(WebService::isPost() && Session::validateChecker()){
            $params['time'] = filter_var($_POST['time'], FILTER_SANITIZE_STRING);
            $params['content'] = $_POST['content'];
            if(TimezoneHelper::strtotime($params['time']) && !empty($params['content'])){
                $time = TimezoneHelper::strtotime($params['time']);
                $db = GlobalDB::getInstance();
                $now = time();
                $db->query("INSERT INTO `bannerShop`(`content`, `expire`, `time`) VALUES ('".$params['content']."', '".$time."', '".$now."')");
                $this->showAdvertisements();
                return;
            } else {
                $params['error'] = 'invalid values!';
            }
        }
        Dispatcher::getInstance()->appendContent(Template::getInstance()->load($params, 'tpl/addAdv.tpl')->getAsString());
    }
    private function showAdvertisements(){
        $db = GlobalDB::getInstance();
        $result = $db->query("SELECT * FROM bannerShop WHERE expire > " . time());
        $params['content'] = null;
        while($row = $result->fetch_assoc()){
            $params['content'] .= '<tr>';
            $params['content'] .= '<td>'.$row['id'].'</td>';
            $params['content'] .= '<td style="word-break: break-word;">'.$row['content'].'</td>';
            $params['content'] .= '<td>'.TimezoneHelper::autoDateString($row['time'], true).'</td>';
            $params['content'] .= '<td>'.TimezoneHelper::autoDateString($row['expire'], true).'</td>';
            $params['content'] .= '<td><a href="?action=advertisement&method=edit&id=' . $row['id'] . '"><img src="img/x.gif" class="edit"></a>&nbsp;<a href="?action=advertisement&method=del&id=' . $row['id'] . '"><img src="img/x.gif" class="del"></a></td>';
            $params['content'] .= '</tr>';
        }
        if(!$result->num_rows){
            $params['content'] .= '<tr><td colspan="5" class="hab"><span class="errorMessage">No advertisement.</span></td></tr>';
        }
        Dispatcher::getInstance()->appendContent(Template::getInstance()->load($params, 'tpl/adv.tpl')->getAsString());
    }
}