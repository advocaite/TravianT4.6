<?php
namespace Controller;
use Core\Helper\TimezoneHelper;
use Core\Locale;
use resources\View\OutOfGameView;

class PermissionDeniedCtrl extends OutOfGameCtrl
{
	public function __construct()
	{
		parent::__construct();
		$this->view = new OutOfGameView();
		$this->view->vars['titleInHeader'] = T('403Error', "You cannot pass!");
		$this->view->vars['bodyCssClass'] = 'perspectiveBuildings';
		$this->view->vars['contentCssClass'] = 'error_site';
		$this->view->vars['content'] = T('403Error', "I am a servant of the Secret Order, wielder of the flame of 403, You cannot pass");
		$this->view->vars['headerBar'] = TRUE;
		$this->view->vars['showTime'] = TRUE;
		$this->view->vars['serverTime'] = TimezoneHelper::date("H:i:s");
		$this->view->renderLoginBox = FALSE;
	}
} 