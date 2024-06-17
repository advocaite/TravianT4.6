<?php
namespace Controller\Ajax;

use Core\Config;
use Core\Session;
use function getDisplay;
use Model\AllianceModel;
use Model\MessageModel;

class checkRecipient extends AjaxBase
{
    public function dispatch()
    {
        if(is_array($_REQUEST['recipients'])){
            if(sizeof($_REQUEST['recipients']) > getDisplay("maximumMultiMessageSendNum")){
                $this->response['error'] = true;
                $this->response['errorMsg'] = sprintf(T("Messages", "You cannot send a message to more than %s users"), getDisplay("maximumMultiMessageSendNum"));
                return;
            }
            $this->response['success'] = 'success';
            foreach($_REQUEST['recipients'] as $recipient){
                $recipient = filter_var($recipient, FILTER_SANITIZE_STRING);
                $this->checkRecipient($recipient);
                if($this->response['error']){
                    unset($this->response['success']);
                    break;
                }
            }
        }
    }
    private function checkRecipient($recipient){
        if($recipient == '[ally]') {
            if(!Session::getInstance()->getAllianceId()) {
                $this->response['error'] = TRUE;
                $this->response['errorMsg'] = T("Messages", "You are currently not part of any alliance");
            } else if(Session::getInstance()->hasAlliancePermission(AllianceModel::IGM_MESSAGE)) {
                $this->response['success'] = TRUE;
            } else {
                $this->response['error'] = TRUE;
                $this->response['errorMsg'] = T("Messages", "You dont have permission here");
            }
            return;
        } else if($recipient == '[all]') {
            if(Session::getInstance()->isAdmin() && !Session::getInstance()->isAdminInAnotherAccount()){
            } else {
                $this->response['error'] = true;
                $this->response['errorMsg'] = sprintf(T("Messages", "player x does not exists"), $recipient);
            }
            return;
        } else {
            $m = new MessageModel();
            $result = $m->getPlayerIdByName($recipient);
            if($result === FALSE) {
                $this->response['error'] = TRUE;
                $this->response['errorMsg'] = sprintf(T("Messages", "player x does not exists"), $recipient);
                return;
            }
            if(Session::getInstance()->getPlayerId() > 2 && Session::getInstance()->data['access'] == 0 && $result > 2) {
                $this->response['error'] = TRUE;
                $this->response['errorMsg'] = T("Messages", "You dont have permission here");
                return;
            }
        }
    }
} 