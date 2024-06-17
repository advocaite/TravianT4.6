<?php
namespace Controller;
use Core\Session;
use resources\View\GameView;
use resources\View\OutOfGameView;
use resources\View\PHPBatchView;

class CreditsCtrl extends GameCtrl
{
    public function __construct()
    {
        parent::__construct();
        $this->view = $this->session->isValid() ? new GameView() : new OutOfGameView();
        $this->view->vars['bodyCssClass'] = 'perspectiveResources';
        $this->view->vars['contentCssClass'] = 'plus';
        $this->view->vars['titleInHeader'] = 'Credits';
        $this->view->vars['content'] .= PHPBatchView::render("credits/main");
    }
}