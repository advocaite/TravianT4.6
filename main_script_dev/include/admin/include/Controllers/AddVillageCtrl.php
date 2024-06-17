<?php

use Core\Database\DB;
use Core\Helper\WebService;
use Model\RegisterModel;

class AddVillageCtrl
{
    public function __construct()
    {
        $params = [
            'uid' => isset($_REQUEST['uid']) ? (int)$_REQUEST['uid'] : null,
            'fieldtype' => isset($_REQUEST['fieldtype']) && in_array($_REQUEST['fieldtype'], range(1, 12)) ? (int)$_REQUEST['fieldtype'] : 3,
            'sector' => isset($_REQUEST['sector']) && in_array(isset($_REQUEST['sector']), ['ne', 'se', 'nw', 'sw']) ? isset($_REQUEST['sector']) : 'se',
        ];
        if (!isServerFinished() && WebService::isPost()) {
            $m = new RegisterModel();
            $db = DB::getInstance();
            $result = $db->query("SELECT id, race FROM users WHERE id={$params['uid']}");
            if($result->num_rows){
                $user = $result->fetch_assoc();
                $generate = $m->generateBase($params['sector'], $params['fieldtype']);
                if($generate){
                    $m->createNewVillage($params['uid'], $user['race'], $generate);
                    $params['result'] = 'Village created successfully.';
                } else {
                    $params['result'] = 'Failed to generate base.';
                }
            } else {
                $params['result'] = 'User not found.';
            }
        }
        Dispatcher::getInstance()->appendContent(Template::getInstance()->load($params, 'tpl/addVillage.tpl')->getAsString());
    }
}