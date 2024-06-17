<?php
namespace Controller;

use Controller\Ajax\viewTileDetails;
use resources\View\GameView;

class PositionDetailsCtrl extends GameCtrl
{
	public function __construct()
	{
		parent::__construct();
		$this->view = new GameView();
		$this->view->vars['titleInHeader'] = '';
		$this->view->vars['bodyCssClass'] = 'perspectiveResources';
		$this->view->vars['contentCssClass'] = 'positionDetails';
		$fake = [];
		if(!isset($_GET['x']) || !isset($_GET['y'])) {
			$this->redirect("karte.php");
		}
        $this->view->newVillagePrefix['x'] = $_GET['x'];
        $this->view->newVillagePrefix['y'] = $_GET['y'];
		$c = new viewTileDetails($fake);
		$this->view->vars['content'] .= $c->render($_GET['x'], $_GET['y']);
	}
}