<?php
/**
 * Created by PhpStorm.
 * User: Amirhossein CH
 * Date: 10/12/14
 * Time: 3:50 PM
 */

namespace Controller;

use resources\View\GameView;

class InGameWinnerPage extends GameCtrl
{
    public function __construct()
    {
        parent::__construct();
        $this->view = new GameView();
        $this->view->vars['contentCssClass'] = 'sysmsg';
        $this->view->vars['bodyCssClass'] = 'perspectiveBuildings';
        new WinnerCtrl($this->view->vars['contentCssClass'], $this->view->vars['content']);
    }
} 