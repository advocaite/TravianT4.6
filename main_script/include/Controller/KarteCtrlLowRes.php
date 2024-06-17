<?php

namespace Controller;

use Core\Session;
use Core\Village;
use Game\Formulas;
use Game\Map\MapLowRes;
use Core\Locale;
use Model\Quest;
use resources\View\GameView;
use resources\View\PHPBatchView;

class KarteCtrlLowRes extends GameCtrl
{
    public function __construct()
    {
        parent::__construct();
        Quest::getInstance()->setQuestBitwise("world", 5, 1);
        $this->view = new GameView();
        $this->view->vars['bodyCssClass'] = 'perspectiveResources';
        $this->view->vars['contentCssClass'] = 'map';
        $this->view->vars['titleInHeader'] = T("map", "map");
        if (isset($_GET['d']) && is_numeric($_GET['d'])) {
            $xy = Formulas::kid2xy($_GET['d']);
            $this->redirect("position_details.php?x={$xy['x']}&y={$xy['y']}");
        }
        if (isset($_GET['x']) && isset($_GET['y'])) {
            $kid = Formulas::xy2kid($_GET['x'], $_GET['y']);
        } else {
            $kid = Village::getInstance()->getKid();
        }
        $view = new PHPBatchView("map/lowRes");
        $xy = Formulas::kid2xy($kid);
        $view->vars = array_merge($view->vars, $xy);
        $view->vars['fullscreen'] = Session::getInstance()->hasPlus() && isset($_GET['fullscreen']) && $_GET['fullscreen'] == 1;
        $view->vars['mapContainerData'] = MapLowRes::render($xy['x'], $xy['y'], 8, 7)['HTML'];
        $view->vars['hasPlus'] = Session::getInstance()->hasPlus();
        $view->vars['hasClub'] = Session::getInstance()->hasGoldClub();
        $this->view->vars['content'] .= $view->output();
    }
}