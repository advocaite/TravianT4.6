<?php

namespace Controller\Ajax\paynet;

use Core\Database\GlobalDB;
use Core\Helper\WebService;
use Core\Helper\PreferencesHelper;

class cart extends init
{
	public function dispatch()
    {
		$this->response = array();
		
	    if(!WebService::isPut() || !isset($_POST['productID'])){
			$this->response['error'] = TRUE;
			return;
		}
		$productData = GlobalDB::getInstance()->query("SELECT * FROM goldProducts WHERE goldProductId={$_POST['productID']}")->fetch_assoc();
		PreferencesHelper::setPreference('lastProductID',$_POST['productID']);
		$this->response['html'] = $this->getLocationProviders($productData['goldProductLocation'],(bool)$productData['isSMS'],false);
	}
}

