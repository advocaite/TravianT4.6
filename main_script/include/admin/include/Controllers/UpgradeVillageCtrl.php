<?php

use Core\Database\DB;
use Core\Helper\Notification;
use Core\Helper\WebService;
use Core\Session;
use Model\NatarsModel;

class UpgradeVillageCtrl
{
    private $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
        if (isset($_REQUEST['kid'])) {
            $this->show();
        }
    }

    private function show()
    {
        $dispatcher = Dispatcher::getInstance();
        if(!getCustom('allowInterruptionInGame')){
            $dispatcher->appendContent("<hr><p class='error center'>Disabled by admin.</p><hr>");
            return;
        }
        $params = [];
        $params['kid'] = (int)$_REQUEST['kid'];
        $villageData = $this->db->query("SELECT * FROM vdata WHERE kid={$params['kid']}");
        if (!$villageData->num_rows) {
            $dispatcher->appendContent("<hr><p class='error center'>Village does not exists!</p><hr>");
            return;
        }
        $villageData = $villageData->fetch_assoc();
        if ($villageData['isWW']) {
            $dispatcher->appendContent("<hr><p class='error center'>WW Villages cannot be upgraded!</p><hr>");
            return;
        }
        $player = $this->db->query("SELECT name FROM users WHERE id={$villageData['owner']}")->fetch_assoc();
        $params['playerId'] = $villageData['owner'];
        $params['playerName'] = $player['name'];
        $params['villageName'] = $villageData['name'];
        $params['pop'] = $villageData['pop'];
        if (!isServerFinished() && WebService::isPost() && Session::validateChecker()) {
            $targetPop = (int)abs($_POST['pop']);
            if ($targetPop > $params['pop']) {
                (new NatarsModel())->VillageToPOP($params['kid'], $targetPop);
                WebService::redirect("admin.php?action=editVillage&kid={$params['kid']}");
                Notification::RealTimeNotify("Admin upgrade", "Village {$params['kid']} was upgraded.");
            }
        }
        $dispatcher->appendContent(Template::getInstance()->load($params, 'tpl/upgradeVillage.tpl')->getAsString());
    }
}