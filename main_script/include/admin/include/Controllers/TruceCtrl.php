<?php

use Core\Config;
use Core\Helper\TimezoneHelper;
use Core\Helper\WebService;
use Game\TruceDay;

class TruceCtrl
{
    public function __construct()
    {
        $config = Config::getInstance();
        $params = [];
        if (!isServerFinished() && WebService::isPost()) {
            if(in_array($_POST['truceReasonId'], array_keys(T("Truce", "reasons")))){
                $config->dynamic->truceFrom = TimezoneHelper::strtotime($_POST['truceFrom']);
                $config->dynamic->truceTo = TimezoneHelper::strtotime($_POST['truceTo']);
                $config->dynamic->truceReasonId = (int) $_POST['truceReasonId'];
                TruceDay::saveTruce($config->dynamic->truceFrom, $config->dynamic->truceTo, $config->dynamic->truceReasonId);
                $params['result'] = 'Truce settings saved.';
            } else {
                $params['result'] = 'Invalid truce settings.';
            }
        }
        $params = array_merge($params, [
            'now' => TimezoneHelper::date("Y-m-d H:i", time()),
            'truceFrom' => TimezoneHelper::date("Y-m-d H:i", $config->dynamic->truceFrom),
            'truceTo' => TimezoneHelper::date("Y-m-d H:i", $config->dynamic->truceTo),
            'truceReasonId' => $config->dynamic->truceReasonId,
        ]);
        Dispatcher::getInstance()->appendContent(Template::getInstance()->load($params, 'tpl/truceDay.tpl')->getAsString());
    }
}