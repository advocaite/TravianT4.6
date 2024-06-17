<?php

use Core\Database\GlobalDB;
use Core\Helper\WebService;

class DeleteEmailNewsletterCtrl
{
    public function __construct()
    {
        $params['newsletterType'] = 'normal';
        $dispatcher = Dispatcher::getInstance();
        $params['email'] = isset($_POST['email']) ? $_POST['email'] : null;
        $params['error'] = null;
        if (!isServerFinished() && WebService::isPost() && !empty($params['email'])) {
            if (filter_var($params['email'], FILTER_VALIDATE_EMAIL) !== FALSE) {
                $params['email'] = filter_var($params['email'], FILTER_SANITIZE_EMAIL);
                $db = GlobalDB::getInstance();
                $find = $db->query("SELECT * FROM newsletter WHERE email='{$params['email']}'");
                if ($find->num_rows) {
                    $db->query("DELETE FROM newsletter WHERE email='{$params['email']}'");
                    $params['error'] = 'Email "' . $params['email'] . '" was unsubscribed.';
                } else {
                    $params['error'] = 'Email not found in newsletter "' . $params['email'] . '".';
                }
            } else {
                $params['error'] = 'Invalid email address "' . $params['email'] . '".';
            }
        } else if (WebService::isPost()) {
            $params['error'] = 'Please fill all inputs.';
        }
        $dispatcher->appendContent(Template::getInstance()->load($params, 'tpl/deleteEmailNewsletter.tpl')->getAsString());
    }
}