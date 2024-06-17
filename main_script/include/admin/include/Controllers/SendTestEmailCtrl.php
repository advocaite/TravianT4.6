<?php

use Core\Helper\Mailer;
use Core\Helper\WebService;
use Core\Session;

class SendTestEmailCtrl
{
    public function __construct()
    {
        $dispatcher = Dispatcher::getInstance();
        $params['email'] = isset($_POST['email']) ? $_POST['email'] : 'chamirhossein@gmail.com';
        $params['message'] = isset($_POST['message']) ? $_POST['message'] : null;
        $params['subject'] = isset($_POST['subject']) ? $_POST['subject'] : null;
        $params['error'] = null;
        if (!isServerFinished() && WebService::isPost() && !empty($params['email']) && !empty($params['message']) && !empty($params['subject'])) {
            if(Session::validateChecker()){
                if(filter_var($params['email'], FILTER_VALIDATE_EMAIL) !== FALSE){
                    Mailer::sendEmail($params['email'], $params['subject'], $params['message']);
                    $params['error'] = 'Newsletter has been sent to "'.$params['email'].'".';
                } else {
                    $params['error'] = 'Invalid email address "'.$params['email'].'".';
                }
            }
        } else if(WebService::isPost()) {
            $params['error'] = 'Please fill all inputs.';
        }
        $dispatcher->appendContent(Template::getInstance()->load($params, 'tpl/sendTestEmail.tpl')->getAsString());
    }
}