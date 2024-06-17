<?php
namespace Controller\Ajax;

use Core\Database\GlobalDB;
use Core\Helper\WebService;

class paymentProviders extends AjaxBase
{
    public function dispatch()
    {
        if(!isset($_POST['selectedPackage'])) {
            return;
        }
        $selectedPackage = (int)$_POST['selectedPackage'];
        $this->response['data']['html'] = '<div class="methodsPage visible">';
        $db = GlobalDB::getInstance();
        $stmt = $db->query("SELECT * FROM goldProducts WHERE goldProductId=$selectedPackage");
        if($stmt->num_rows) {
            $stmt = $stmt->fetch_assoc();
            $location = $stmt['goldProductLocation'];
            $providers = $this->getLocationProviders($location);
            foreach($providers as $provider) {
                $this->response['data']['html'] .= $this->addMethod($provider);
            }
        }
        $this->response['data']['html'] .= '</div>';
    }

    private function addMethod($providerRow)
    {
        $title = $providerRow['name'];
        $providerId = $providerRow['providerId'];
        $img = $providerRow['img'];
        $HTML = '<div class="methodItem" title="' . $title . '"><input type="hidden" class="providerId" value="' . $providerId . '"/><img src="' . WebService::getPaymentUrl() . 'img/provider/' . $img . '" alt="' . $title . '"/></div>';
        return $HTML;
    }

    private function getLocationProviders($locationId)
    {
        $result = GlobalDB::getInstance()->query("SELECT * FROM paymentProviders WHERE location=$locationId AND hidden=0 ORDER by posId");
        $locations = [];
        while($row = $result->fetch_assoc()) {
            $locations[$row['providerId']] = $row;
        }
        return $locations;
    }
}