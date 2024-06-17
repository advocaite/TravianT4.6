<?php
namespace Controller;
use resources\View\GameView;
class InGameBannedClickPage extends GameCtrl
{
    public function __construct()
    {
        parent::__construct();
        $this->view = new GameView();
        $this->view->vars['contentCssClass'] = 'sysmsg';
        $this->view->vars['bodyCssClass'] = 'perspectiveBuildings';
        new BannedCtrl($this->view->vars['contentCssClass'], $this->view->vars['content'], true);
    }
} 