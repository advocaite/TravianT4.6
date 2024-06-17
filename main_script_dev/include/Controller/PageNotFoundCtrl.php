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
		$this->view->vars['bodyCssClass'] = 'perspectiveBuildings logout error_site';
		$this->view->vars['contentCssClass'] = 'logout';
        $this->view->vars['containerCssClass'] = 'contentPage';
		$this->view->vars['content'] = '<h4>'. T("notFound", "desc") . '</h4>';
		$this->view->vars['showHeaderBar'] = TRUE;
		$this->view->vars['showTime'] = TRUE;
		$this->view->vars['serverTime'] = TimezoneHelper::date("H:i:s");
        $this->view->vars['answerId'] = 22;
		$this->view->renderLoginBox = FALSE;
	}
}