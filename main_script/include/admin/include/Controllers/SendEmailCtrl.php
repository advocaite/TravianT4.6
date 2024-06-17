<?php

use Core\Database\GlobalDB;
use Core\Helper\Mailer;
use Core\Helper\WebService;
use Core\Session;

class SendEmailCtrl
{
    public function __construct()
    {
        if(!getCustom('allowInterruptionInGame')){
            $dispatcher = Dispatcher::getInstance();
            $dispatcher->appendContent("<hr><p class='error center'>Disabled by admin.</p><hr>");
            return;
        }
        $params['newsletterType'] = 'normal';
        $dispatcher = Dispatcher::getInstance();
        $params['message'] = isset($_POST['message']) ? $_POST['message'] : null;
        $params['subject'] = isset($_POST['subject']) ? $_POST['subject'] : null;
        $params['error'] = null;
        if (!isServerFinished() && WebService::isPost() && !empty($params['message']) && !empty($params['subject'])) {
            if (Session::validateChecker()) {
                $db = GlobalDB::getInstance();
                $result = $db->query("SELECT * FROM newsletter");
                $to = [];
                $x = 0;
                while ($row = $result->fetch_assoc()) {
                    $x++;
                    $to[] = $row['email'];
                    if ($x % 801) {
                        Mailer::sendBatch($to, $params['subject'], $params['message']);
                        $x = 0;
                        $to = [];
                    }
                }
                if (sizeof($to)) {
                    Mailer::sendBatch($to, $params['subject'], $params['message']);
                }
                unset($to);
                \Core\Helper\Notification::notify("News letter", "Newsletter has been sent to {$result->num_rows} emails.");
                $params['error'] = "Newsletter has been sent to {$result->num_rows} emails.";
            }
        } else if (WebService::isPost()) {
            $params['error'] = 'Please fill all inputs.';
        }
        $dispatcher->appendContent(Template::getInstance()->load($params, 'tpl/sendEmail.tpl')->getAsString());
    }
}