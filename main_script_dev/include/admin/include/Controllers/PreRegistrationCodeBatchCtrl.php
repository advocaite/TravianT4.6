<?php

use Core\Config;
use Core\Database\GlobalDB;
use Core\Helper\WebService;
use Core\Session;

class PreRegistrationCodeBatchCtrl
{
    public function __construct()
    {
        $dispatcher = Dispatcher::getInstance();
        $params['error'] = null;
        $params['count'] = isset($_REQUEST['count']) ? (int)$_REQUEST['count'] : null;
        if (WebService::isPost() && Session::validateChecker()) {
            if ($params['count'] > 0) {
                $codes = [];
                for ($i = 1; $i <= $params['count']; ++$i) {
                    $codes[] = $this->insertPreregistrationCode();
                }
                $params['error'] = implode(",\n", $codes);
                AdminLog::getInstance()->addLog("Added {$params['count']} preRegistration codes.");
            }
        }
        $dispatcher->appendContent(Template::getInstance()->load($params, 'tpl/addPreRegistrationCodeBatch.tpl')->getAsString());
    }

    private function insertPreregistrationCode()
    {
        $db = GlobalDB::getInstance();
        $worldId = Config::getProperty("settings", "worldUniqueId");
        $pre_key = substr(sha1(time() . get_random_string(6)), 0, mt_rand(12, 16));
        $db->query("INSERT INTO preregistration_keys (worldId, pre_key) VALUES ('$worldId', '$pre_key')");
        if (!$db->affectedRows()) {
            return $this->insertPreregistrationCode();
        }
        return $pre_key;
    }
}