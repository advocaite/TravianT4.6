<?php
namespace Controller;
use Core\Helper\TimezoneHelper;
use Core\Locale;
use resources\View\OutOfGameView;

class PageNotFoundCtrl extends OutOfGameCtrl
{
	public function __construct()
	{
		parent::__construct();
		$this->view = new OutOfGameView();
		$this->view->vars['titleInHeader'] = T("notFound", "title");
		$this->view->vars['bodyCssClass'] = 'perspectiveBuildings';
		$this->view->vars['contentCssClass'] = 'error_site';
		$this->view->vars['content'] = T("notFound", "desc");
		$this->view->vars['headerBar'] = TRUE;
		$this->view->vars['showTime'] = TRUE;
		$this->view->vars['serverTime'] = TimezoneHelper::date("H:i:s");
		$this->view->renderLoginBox = FALSE;
	}
}