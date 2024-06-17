<?php

use Core\Database\DB;
use Core\Helper\WebService;
use Core\Session;
use Game\Formulas;
use Model\FarmListModel;

class CopyFarmlistCtrl
{
    public function __construct()
    {
        $params['kid'] = isset($_POST['kid']) ? (int)$_POST['kid'] : null;
        $params['result'] = false;
        if(!isServerFinished() && WebService::isPost() && Session::validateChecker()){
            $db = DB::getInstance();
            $farms = $db->fetchScalar("SELECT GROUP_CONCAT(kid) FROM (SELECT kid FROM farmlist) as x");
            $farms = rtrim($farms,',');
            $farms = array_unique(explode(",", $farms));
            $m = new FarmListModel();
            if(sizeof($farms)){
                $uid = $db->fetchScalar("SELECT owner FROM vdata WHERE kid={$params['kid']}");
                if($uid > 0){
                    $lid = $m->addFarmList($uid, $params['kid'], "Copied farmlist");
                    $batch = [];
                    foreach($farms as $kid){
                        $distance = Formulas::getDistance($kid, $params['kid']);
                        $batch[] = '('.$lid.', '.$kid.', '.$distance.', 0,0,0,0,0,0,0,0,0,0)';
                    }
                    $query = 'INSERT INTO raidlist(lid, kid, distance, u1, u2, u3, u4, u5, u6, u7, u8, u9, u10) VALUES ' . implode(",", $batch);
                    $db->query($query);
                    $params['result'] = true;
                }
            }
        }
        $dispatcher = Dispatcher::getInstance();
        $dispatcher->appendContent(Template::getInstance()->load($params, 'tpl/copyFarmlist.tpl')->getAsString());
    }
}