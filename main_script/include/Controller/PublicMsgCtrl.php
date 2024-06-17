<?php

namespace Controller;

use function array_values;
use Core\Config;
use Core\Database\GlobalDB;
use Core\Helper\TimezoneHelper;
use Core\Session;
use resources\View\OutOfGameView;
use resources\View\PHPBatchView;

class PublicMsgCtrl extends GameCtrl
{
    public function __construct()
    {
        parent::__construct();
        $this->view = new OutOfGameView();
        $this->view->renderLoginBox = FALSE;
        $this->view->vars['bodyCssClass'] = 'perspectiveBuildings';
        $this->view->vars['contentCssClass'] = 'error_site';
        $view = new PHPBatchView("layout/publicMsg-msg");
        $view->vars['name'] = Session::getInstance()->getName();
        $view->vars['message'] = nl2br(Config::getInstance()->dynamic->message);
        $view->vars['message'] = str_replace("[PLAYER_ID]", Session::getInstance()->getPlayerId(), $view->vars['message']);
        $view->vars['message'] = str_replace("[PLAYER_NAME]", Session::getInstance()->getName(), $view->vars['message']);
        $view->vars['autoType'] = FALSE;
        if ($view->vars['message'] == '[WWPlansReleaseMessage]') {
            $view->vars['autoType'] = TRUE;
            $view->vars['message'] = T("Global", 'WWPlansReleaseMessage');
        } else if ($view->vars['message'] == '[ArtifactsReleaseMessage]') {
            $view->vars['autoType'] = TRUE;
            $view->vars['message'] = T("Global", 'ArtifactsReleaseMessage');
        } else if ($view->vars['message'] == '[WWConstructStart]') {
            $view->vars['autoType'] = TRUE;
            $view->vars['message'] = T("Global", 'WWConstructStart');
        } else if ($view->vars['message'] == '[NatarsAreBuildingWW]') {
            $view->vars['autoType'] = TRUE;
            $config = Config::getInstance();
            if ($config->timers->WWUpLvlInterval >= 86400) {
                $message = sprintf(T("Global", 'NatarsAreBuildingWW'), min(round(86400 / $config->timers->WWUpLvlInterval, 1), 100), T("Global", "Day"));
            } else {
                $message = sprintf(T("Global", 'NatarsAreBuildingWW'), min(round(3600 / $config->timers->WWUpLvlInterval, 1), 100), T("Global", "Hour"));
            }
            $view->vars['message'] = $message;
        } else if ($view->vars['message'] == '[GoldPromotionPublicMsg]') {
            $offer = GlobalDB::getInstance()->query("SELECT offer, offerFrom FROM paymentConfig LIMIT 1")->fetch_assoc();
            $view->vars['autoType'] = FALSE;
            $view->vars['message'] = T("Global", 'GoldPromotionPublicMsg');
            $view->vars['message'] = sprintf($view->vars['message'], TimezoneHelper::autoDateString($offer['offerFrom'], true), TimezoneHelper::autoDateString($offer['offer'], true));
        }
        if ($view->vars['message'] == '[ServerFinishNoWinner]' || $view->vars['message'] == '[ServerFinishWinner]') {
            new WinnerCtrl($this->view->vars['contentCssClass'], $view->vars['message'], TRUE);
            $view->vars['autoType'] = TRUE;
        }
        $view->vars['DearPlayer'] = sprintf(T("Global", "Dear [PlayerName],"), Session::getInstance()->getName());
        $this->view->vars['headerBar'] = TRUE;
        $this->view->vars['showTime'] = TRUE;
        $this->view->vars['content'] .= $view->output();
    }
}