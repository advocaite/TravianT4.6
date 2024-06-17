<?php

namespace Controller\Build;

use Controller\AnyCtrl;
use Core\Config;
use Core\Database\DB;
use Core\Helper\TimezoneHelper;
use Core\Session;
use Core\Village;
use Game\GoldHelper;
use resources\View\PHPBatchView;

class MainBuildingCntrl extends AnyCtrl
{
    private function demolitionAction()
    {
        $village = Village::getInstance();
        if (isset($_GET['del']) && $village->getOnDemolishBuildingFieldId() > 0) {
            $demolish = $village->getDemolishTask();
            if ((int)$demolish['id'] === (int)$_GET['del']) {
                $db = DB::getInstance();
                $db->query("DELETE FROM demolition WHERE id=" . (int)$_GET['del']);
                $village->setDemolishTask(NULL);
            }
        } else if ($village->getOnDemolishBuildingFieldId() === 0) {
            if (strtolower($_SERVER['REQUEST_METHOD']) != 'post') {
                return;
            }
            if (Session::getInstance()->banned()) {
                $this->innerRedirect("InGameBannedPage");
            } else if (Config::getInstance()->dynamic->serverFinished) {
                $this->innerRedirect("InGameWinnerPage");
            } else if (isset($_REQUEST['c']) && $_REQUEST['c'] == Session::getInstance()->getChecker() && isset($_POST['abriss'])) {
                $village->demolishBuilding((int)$_POST['abriss']);
                Session::getInstance()->changeChecker();
            }
        }
    }

    public function __construct()
    {
        parent::__construct();

        $village = Village::getInstance();
        $session = Session::getInstance();
        $helper = new GoldHelper();
        $this->view = new PHPBatchView("build/mainBuilding");
        $this->demolitionAction();
        if ($village->getOnDemolishBuildingFieldId() > 0) {
            $this->view->vars['isDemolishing'] = TRUE;
            $this->view->vars['finishNow'] = $helper->finishNowButton();
            $demolish = $village->getDemolishTask();
            $this->view->vars['demolish']['taskId'] = $demolish['id'];
            $this->view->vars['demolish']['itemId'] = $village->getField($demolish['building_field'])['item_id'];
            $this->view->vars['demolish']['level'] = $demolish['complete'] ? 0 : $village->getField($demolish['building_field'])['level'] - 1;
            $this->view->vars['demolish']['timer'] = appendTimer($demolish['end_time'] - time());
            $this->view->vars['demolish']['endat'] = TimezoneHelper::date("H:i", $demolish['end_time']);
        } else {
            $this->view->vars['isDemolishing'] = FALSE;
            $this->view->vars['checker'] = $session->getChecker();
            $this->view->vars['options'] = [];
            for ($i = 19; $i <= 40; ++$i) {
                if (!$village->getField($i)['item_id'] || !$village->getField($i)['level']) {
                    continue;
                }
                $this->view->vars['options'][$i] = [
                    "itemId" => $village->getField($i)['item_id'],
                    "level"  => $village->getField($i)['level'],
                ];
            }
            $this->view->vars['demolishNow'] = $helper->getCompleteDemolishButton();
        }
    }
} 