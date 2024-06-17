<?php

use Core\Database\GlobalDB;
use Core\Helper\WebService;
use Core\Session;

class PaymentProvidersCtrl
{
    public function __construct()
    {
        if (!isServerFinished() && isset($_REQUEST['method'])) {
            if ($_REQUEST['method'] == 'addProvider') {
                $this->addProvider();
            } else if ($_REQUEST['method'] == 'deleteProvider') {
                $this->deleteProvider();
            } else if ($_REQUEST['method'] == 'editProvider') {
                $this->editProvider();
            }
        } else {
            $this->showProviders();
        }
    }

    private function editProvider()
    {
        $params = [
            'error' => null,
            'method' => $_REQUEST['method'],
            'locations_dropdown' => null,
            'provider_location' => null,
            'provider_type' => null,
            'provider_name' => null,
            'provider_description' => null,
            'provider_delivery' => null,
            'provider_image' => null,
            'provider_connectInfo' => null,
            'provider_hidden' => null,
            'provider_isProviderLoadedByHTML' => null,
        ];
        $db = GlobalDB::getInstance();
        $providerId = (int)$_REQUEST['providerId'];
        $params['providerId'] = $providerId;
        $result = $db->query("SELECT * FROM paymentProviders WHERE providerId=$providerId");
        if (!$result->num_rows) {
            $this->showProviders();
            return;
        }
        $result = $result->fetch_assoc();
        $params['provider_location'] = $result['location'];
        $params['provider_type'] = $result['providerType'];
        $params['provider_name'] = $result['name'];
        $params['provider_description'] = $result['description'];
        $params['provider_image'] = $result['img'];
        $params['provider_connectInfo'] = $result['connectInfo'];
        $params['provider_hidden'] = $result['hidden'];
        $params['provider_isProviderLoadedByHTML'] = $result['isProviderLoadedByHTML'];
        $locations = $db->query("SELECT * FROM locations ORDER BY id");
        while ($row = $locations->fetch_assoc()) {
            $params['locations_dropdown'] .= '<option value="' . $row['id'] . '" ' . ($params['provider_location'] == $row['id'] ? 'selected' : '') . '>' . $row['location'] . '</option>';
        }
        if (WebService::isPost() && Session::validateChecker()) {
            $params['provider_location'] = (int)$_POST['provider_location'];
            $params['provider_type'] = (int)$_POST['provider_type'];
            $params['provider_name'] = filter_var(trim($_POST['provider_name']), FILTER_SANITIZE_STRING);
            $params['provider_description'] = trim($_POST['provider_description']);
            $params['provider_image'] = filter_var($_POST['provider_image'], FILTER_SANITIZE_STRING);
            $params['provider_connectInfo'] = filter_var($_POST['provider_connectInfo'], FILTER_SANITIZE_STRING);
            $params['provider_delivery'] = filter_var($_POST['provider_delivery'], FILTER_SANITIZE_STRING);
            $params['provider_hidden'] = (int)$_POST['provider_hidden'];
            $params['provider_isProviderLoadedByHTML'] = (int)$_POST['provider_isProviderLoadedByHTML'];
            if (empty($params['provider_name']) || empty($params['provider_image']) || empty($params['provider_description'])) {
                $params['error'] = 'Some inputs are empty';
            } else {
                $locationExists = $db->query("SELECT COUNT(id) FROM locations WHERE id=" . $params['provider_location']);
                if (!$locationExists) {
                    $params['error'] = 'Selected location does not exists';
                } else {
                    $db->query("UPDATE paymentProviders SET providerType='".$params['provider_type']."', location='".$params['provider_location']."', name='".$params['provider_name']."', description='".$params['provider_description']."', img='".$params['provider_image']."', delivery='".$params['provider_delivery']."', connectInfo='".$params['provider_connectInfo']."', isProviderLoadedByHTML='".$params['provider_isProviderLoadedByHTML']."', hidden='".$params['provider_hidden']."' WHERE providerId=" . $providerId);
                    $this->showProviders();
                    ;
                    return;
                }
            }
        }
        $dispatcher = Dispatcher::getInstance();
        $dispatcher->appendContent(Template::getInstance()->load($params, 'tpl/paymentAddProvider.tpl')->getAsString());
    }

    private function addProvider()
    {
        $params = [
            'method' => $_REQUEST['method'],
            'error' => null,
            'locations_dropdown' => null,
            'provider_location' => isset($_SESSION[WebService::fixSessionPrefix('locationId')]) ? $_SESSION[WebService::fixSessionPrefix('locationId')] : -1,
            'provider_type' => null,
            'provider_name' => null,
            'provider_description' => null,
            'provider_delivery' => null,
            'provider_image' => null,
            'provider_connectInfo' => null,
            'provider_hidden' => null,
            'provider_isProviderLoadedByHTML' => null,
        ];
        $db = GlobalDB::getInstance();
        $locations = $db->query("SELECT * FROM locations ORDER BY id");
        while ($row = $locations->fetch_assoc()) {
            $params['locations_dropdown'] .= '<option value="' . $row['id'] . '" ' . ($params['provider_location'] == $row['id'] ? 'selected' : '') . '>' . $row['location'] . '</option>';
        }
        if (WebService::isPost() && Session::validateChecker()) {
            $params['provider_location'] = (int)$_POST['provider_location'];
            $params['provider_type'] = (int)$_POST['provider_type'];
            $params['provider_name'] = filter_var(trim($_POST['provider_name']), FILTER_SANITIZE_STRING);
            $params['provider_description'] = trim($_POST['provider_description']);
            $params['provider_image'] = filter_var(trim($_POST['provider_image']), FILTER_SANITIZE_STRING);
            $params['provider_connectInfo'] = filter_var($_POST['provider_connectInfo'], FILTER_SANITIZE_STRING);
            $params['provider_delivery'] = filter_var($_POST['provider_delivery'], FILTER_SANITIZE_STRING);
            $params['provider_hidden'] = (int)$_POST['provider_hidden'];
            $params['provider_isProviderLoadedByHTML'] = (int)$_POST['provider_isProviderLoadedByHTML'];
            if (empty($params['provider_name']) || empty($params['provider_image']) || empty($params['provider_description'])) {
                $params['error'] = 'Some inputs are empty';
            } else {
                $locationExists = $db->fetchScalar("SELECT COUNT(id) FROM locations WHERE id=" . $params['provider_location']);
                if (!$locationExists) {
                    $params['error'] = 'Selected location does not exists';
                } else {
                    $pos = ((int)$db->fetchScalar("SELECT MAX(posId) FROM paymentProviders WHERE location={$params['provider_location']}")) + 1;
                    $db->query("INSERT INTO paymentProviders (providerType, location, posId, name, description, img, delivery, connectInfo, isProviderLoadedByHTML, hidden) VALUES 
('".$params['provider_type']."', '".$params['provider_location']."', '".$pos."', '".$params['provider_name']."', '".$params['provider_description']."', '".$params['provider_image']."', '".$params['provider_delivery']."', '".$params['provider_connectInfo']."', '".$params['provider_isProviderLoadedByHTML']."', '".$params['provider_hidden']."')");
                    $this->showProviders();
                    ;
                    return;
                }
            }
        }
        $dispatcher = Dispatcher::getInstance();
        $dispatcher->appendContent(Template::getInstance()->load($params, 'tpl/paymentAddProvider.tpl')->getAsString());
    }

    private function deleteProvider()
    {
        $_REQUEST['providerId'] = (int)$_REQUEST['providerId'];
        $db = GlobalDB::getInstance();
        $db->query("DELETE FROM paymentProviders WHERE providerId={$_REQUEST['providerId']}");
        $this->showProviders();
    }

    private function showProviders()
    {
        $dispatcher = Dispatcher::getInstance();
        if (WebService::isPost() && isset($_POST['locationId'])) {
            $_SESSION[WebService::fixSessionPrefix('locationId')] = (int)$_POST['locationId'];
        }
        {
            $db = GlobalDB::getInstance();
            $params['locations_dropdown'] = null;
            $locations = $db->query("SELECT * FROM locations ORDER BY id");
            while ($row = $locations->fetch_assoc()) {
                if (!isset($_SESSION[WebService::fixSessionPrefix('locationId')])) {
                    $_SESSION[WebService::fixSessionPrefix('locationId')] = $row['id'];
                }
                $params['locations_dropdown'] .= '<option value="' . $row['id'] . '" ' . ($row['id'] == $_SESSION[WebService::fixSessionPrefix('locationId')] ? 'selected' : '') . '>' . $row['location'] . '</option>';
            }
            $params['error'] = null;
            $params['action'] = $_REQUEST['action'];
            $dispatcher->appendContent(Template::getInstance()->load($params, 'tpl/paymentLocationsSelect.tpl')->getAsString());
        }
        $params = [
            'content' => '',
        ];
        $db = GlobalDB::getInstance();

        $providers = [
            1 => 'Zarinpal',
            2 => 'PayPal',
            4 => 'PayGol',
            //5 => 'Perfect Money',
            //6 => 'CashU',
            //7 => 'Skrill',
            //8 => 'PaySafeCard',
            9 => 'Arianpal',
        ];
        $locations = $db->query("SELECT * FROM paymentProviders WHERE location={$_SESSION[WebService::fixSessionPrefix('locationId')]} ORDER BY posId ASC");
        while ($row = $locations->fetch_assoc()) {
            $params['content'] .= '<tr>';
            $params['content'] .= '<td>' . $row['providerId'] . '</td>';
            $params['content'] .= '<td>' . $providers[$row['providerType']] . '</td>';
            $params['content'] .= '<td>' . $row['posId'] . '</td>';
            $params['content'] .= '<td>' . $row['name'] . '</td>';
            $params['content'] .= '<td>' . $row['delivery'] . '</td>';
            $params['content'] .= '<td>' . ($row['hidden'] == 1 ? 'yes' : 'no') . '</td>';
            $params['content'] .= '<td><a href="?action=paymentProviders&method=editProvider&providerId=' . $row['providerId'] . '"><img src="img/x.gif" class="edit"></a>&nbsp;<a href="?action=paymentProviders&method=deleteProvider&providerId=' . $row['providerId'] . '"><img src="img/x.gif" class="del"></a></td>';
            $params['content'] .= '</tr>';
        }
        if (!$locations->num_rows) {
            $params['content'] = '<tr><td colspan="7"><span class="errorMessage">No Provider!</span></td></tr>';
        }
        $dispatcher->appendContent(Template::getInstance()->load($params, 'tpl/paymentProviders.tpl')->getAsString());
    }
}