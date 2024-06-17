<?php

namespace Controller\Ajax\paynet;

use Controller\Ajax\paymentWizard;
use Core\Caching\Caching;
use Core\Config;
use Core\Database\GlobalDB;
use Core\Helper\Mailer;
use Core\Helper\TimezoneHelper;
use Core\Helper\WebService;
use Core\Session;
use function getDisplay;
use Model\Quest;
use resources\View\PHPBatchView;

class productsByCountry extends init
{
	public function dispatch()
    {
		$this->response = array();
	    
		$view->vars['selectedLocationId'] = isset($_GET['did']) ? (int)$_GET['did'] : -1;
        $this->response['renderedPackages'] = $this->getLocationProducts($view->vars['selectedLocationId']);
        $this->response['renderedSmsPackages'] = $this->getLocationProducts($view->vars['selectedLocationId'], true);
        $this->response['renderedSpecialOffersPackages'] = $this->getSpecialOffers($view->vars['selectedLocationId']);
	}
}

