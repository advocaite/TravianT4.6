<?php
namespace Controller;

use Core\Helper\TimezoneHelper;
use resources\View\OutOfGameView;

class InGameMaintenanceCtrl extends OutOfGameCtrl
{
	public function __construct()
	{
		parent::__construct();
		$this->view = new OutOfGameView();
		$this->view->vars['titleInHeader'] = T("inGame", "MaintenanceWork");
		$this->view->vars['bodyCssClass'] = 'perspectiveResources';
		$this->view->vars['contentCssClass'] = 'error_site';
		$this->view->vars['headerBar'] = TRUE;
		$this->view->vars['showTime'] = TRUE;
		$this->view->vars['serverTime'] = TimezoneHelper::date("H:i:s");
		$this->view->vars['content'] = T("inGame", "MaintenanceWork");
	}
}