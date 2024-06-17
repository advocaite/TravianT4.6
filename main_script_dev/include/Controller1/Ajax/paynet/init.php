<?php

namespace Controller\Ajax\paynet;

use Controller\Ajax\AjaxBase;
use Core\Config;
use Core\Database\GlobalDB;
use Core\Session;
use resources\View\PHPBatchView;

class init extends AjaxBase
{
	
	public function dispatch()
    {
        if ((Session::getInstance()->banned() && Session::getInstance()->getPlayerId() > 2)/* || Config::getInstance()->dynamic->serverFinished*/) {
            $this->response['error'] = TRUE;
            $this->response['message'] = T("inGame", 'bannedSmallPage');
            return;
        }

		$this->view = new \stdClass();
		$this->view->vars = array();
        $this->view->vars['content'] = NULL;
		$isActive = GlobalDB::getInstance()->fetchScalar("SELECT active FROM paymentConfig") && !Config::getInstance()->dynamic->serverFinished;
        $isActive = $isActive && getCustom("paymentWizardBuyGoldEnabled");
        if (!Session::getInstance()->checkSitterPermission(Session::SITTER_CAN_BUY_OR_SPEND_GOLD) || (!$isActive && $_POST['activeTab'] == 'buyGold')) {
            $this->response['error'] = true;
			$this->response['message'] = T("PaymentWizard", "paymentUnAvailable");

            return;
        }
        $this->renderBuyGold();
        $this->response['html'] = $this->view->vars['content'];
    }

    private function renderBuyGold()
    {
        $this->renderPackages();
    }

    private function renderPackages()
    {
        $view = new PHPBatchView("payment/buyGold");
		$view = $this->getCountrySelector($view);
		
        $view->vars['goldProductId'] = isset($_POST['goldProductId']) ? (int)$_POST['goldProductId'] : -1;
        $view->vars['packages'] = $this->getLocationProducts($view->vars['selectedLocationId']);
        $view->vars['sms_packages'] = $this->getLocationProducts($view->vars['selectedLocationId'], true);
        $view->vars['offer_packages'] = $this->getSpecialOffers($view->vars['selectedLocationId']);
        $view->vars['paymentMethods'] = $this->getLocationProviders($view->vars['selectedLocationId']);
		
        $this->view->vars['content'] .= $view->output();
    }
	
	public function getCountrySelector($view){
		$view->vars['locations'] = '';
		$view->vars['selectedLocation'] = '';
		$result = GlobalDB::getInstance()->query("SELECT * FROM locations");
		$locations = [];
		$selectedLocation = isset($_POST['goldProductLocation']) && !empty($_POST['goldProductLocation']) ? (int)$_POST['goldProductLocation'] : $_SESSION[Session::getInstance()->fixSessionPrefix('default_payment_location')];
        $_SESSION[Session::getInstance()->fixSessionPrefix('default_payment_location')] = $selectedLocation;
		while ($row = $result->fetch_assoc()) {
			$view->vars['locations'] .= '<label class="countryListItem" data-country-native="'.$row['location'].'" data-country-english="'.$row['location'].'">';
			$view->vars['locations'] .= '<input type="radio" class="radio" name="country" value="'.$row['id'].'" '.($def == $row['id'] ? 'selected' : '').'/>';
			$view->vars['locations'] .= '<div class="languageFlag flags"><img src="img/x.gif" class="flag_'.$row['content_language'].'" title="'.$row['content_language'].'" alt="'.$row['content_language'].'"></div>';
			$view->vars['locations'] .= '<div class="country">'.$row['location'].'</div>';
			$view->vars['locations'] .= '</label>';
			if($selectedLocation == $row['id']){
				$view->vars['selectedLocation'] = $row;
				$view->vars['selectedLocationId'] = $row['id'];
				$view->vars['locationName'] = $row['location'];
			}
		}
		return $view;
	}

    public function getLocationProducts($locationId, $is_sms=false)
    {
        if(empty($locationId)){
            return '';
        }
        $result = GlobalDB::getInstance()->query("SELECT * FROM goldProducts WHERE goldProductLocation=$locationId AND isActive=1 AND isSMS=".($is_sms?'1':'0')." ORDER BY goldProductGold ASC");
        if($result){
			$locations = [];
			while ($row = $result->fetch_assoc()) {
				$locations[] = $row;
			}
			$view = new PHPBatchView("payment/packages");
			$view->vars['packages'] = $locations;
			return $view->output();
        }
        return '';
    }

    function getLocationProviders($locationId, $is_sms=false, $isSelected=true)
    {
        $result = GlobalDB::getInstance()->query("SELECT * FROM paymentProviders WHERE location=$locationId AND isActive=1 AND isSMS=".($is_sms?'1':'0')." ORDER by posId");
        if($result){$providers = [];
			while ($row = $result->fetch_assoc()) {
				$providers[$row['providerId']] = $row;
			}
			$view = new PHPBatchView("payment/paymentOptions");
			$view->vars['providers'] = $providers;
			$view->vars['enabled'] = $isSelected;
			return $view->output();
		}
        return '';
    }
	
	public function getSpecialOffers($locationId){
		$result = GlobalDB::getInstance()->query("SELECT * FROM goldProducts WHERE goldProductLocation=$locationId AND isActive=1 AND goldProductHasOffer=1 ORDER BY goldProductGold ASC");
        $locations = [];
		if($result){
			$offer = GlobalDB::getInstance()->fetchScalar("SELECT offer FROM paymentConfig") >= time();
			while ($row = $result->fetch_assoc()) {
				if ($offer && $row['goldProductHasOffer'] && !in_array($row['goldProductImageName'],
						['Travian_Facelift_voucher.png', 'Travian_Facelift_SMS.png', 'Travian_Facelift_Festnetz.png'])) {
					$row['goldProductGold'] = ceil($row['goldProductGold'] * 1.2);
					$split = explode(".", $row['goldProductImageName']);
					$row['goldProductImageName'] = $split[0] . '-20.' . $split[1];
					$locations[] = $row;
				}
			}
		}
		if(empty($locations)){
			return '';
		}else{
			$view = new PHPBatchView("payment/packages");
			$view->vars['packages'] = $locations;
			return $view->output();
		}
	}
}