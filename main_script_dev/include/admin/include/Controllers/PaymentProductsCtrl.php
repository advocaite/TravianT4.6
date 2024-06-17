<?php

use Core\Database\GlobalDB;
use Core\Helper\WebService;
use Core\PackageCode;
use Core\Session;

class PaymentProductsCtrl
{
    public function __construct()
    {
        if (!isServerFinished() && isset($_REQUEST['method'])) {
            if ($_REQUEST['method'] == 'addProduct') {
                $this->addProduct();
            } else if ($_REQUEST['method'] == 'deleteProduct') {
                $this->deleteProduct();
            } else if ($_REQUEST['method'] == 'editProduct') {
                $this->editProduct();
            }
        } else {
            $this->showProducts();
        }
    }

    private function addProduct()
    {
        $params = [
            'method' => $_REQUEST['method'],
            'locations_dropdown' => null,
            'error' => null,
            'product_name' => null,
            'product_location' => $_SESSION[WebService::fixSessionPrefix('locationId')],
            'product_gold' => null,
            'product_price' => null,
            'product_moneyUnit' => null,
            'product_image' => null,
            'product_offer' => null,
        ];
        $db = GlobalDB::getInstance();
        $locations = $db->query("SELECT * FROM locations ORDER BY id");
        while ($row = $locations->fetch_assoc()) {
            $params['locations_dropdown'] .= '<option value="' . $row['id'] . '" ' . ($params['product_location'] == $row['id'] ? 'selected' : '') . '>' . $row['location'] . '</option>';
        }
        if (WebService::isPost() && Session::validateChecker()) {
            $params['product_name'] = filter_var($_POST['product_name'], FILTER_SANITIZE_STRING);
            $params['product_location'] = (int)$_POST['product_location'];
            $params['product_gold'] = (int)$_POST['product_gold'];
            $params['product_price'] = trim($_POST['product_price']);
            $params['product_offer'] = (int)$_POST['product_offer'];
            $params['product_moneyUnit'] = filter_var($_POST['product_moneyUnit'], FILTER_SANITIZE_STRING);
            $params['product_image'] = filter_var($_POST['product_image'], FILTER_SANITIZE_STRING);
            if (empty($params['product_name']) || empty($params['product_moneyUnit']) || empty($params['product_image'])) {
                $params['error'] = 'Some inputs are empty';
            } else {
                $locationExists = $db->fetchScalar("SELECT COUNT(id) FROM locations WHERE id=" . $params['product_location']);
                if (!$locationExists) {
                    $params['error'] = 'Selected location does not exists';
                } else {
                    $db->query("INSERT INTO goldProducts (goldProductName, goldProductLocation, goldProductGold, goldProductPrice, goldProductMoneyUnit, goldProductImageName, goldProductHasOffer) VALUES ('".$params['product_name']."', '".$params['product_location']."', '".$params['product_gold']."', '".$params['product_price']."', '".$params['product_moneyUnit']."', '".$params['product_image']."', '".$params['product_offer']."')");
                    $this->showProducts();
                    ;
                    return;
                }
            }
        }
        $dispatcher = Dispatcher::getInstance();
        $dispatcher->appendContent(Template::getInstance()->load($params, 'tpl/paymentAddProduct.tpl')->getAsString());
    }

    private function editProduct()
    {
        $params = [
            'method' => $_REQUEST['method'],
            'locations_dropdown' => null,
            'error' => null,
            'product_name' => null,
            'product_location' => null,
            'product_gold' => null,
            'product_price' => null,
            'product_moneyUnit' => null,
            'product_image' => null,
            'product_offer' => null,
        ];
        $db = GlobalDB::getInstance();
        $productId = (int)$_REQUEST['productId'];
        $result = $db->query("SELECT * FROM goldProducts WHERE goldProductId=$productId");
        if (!$result->num_rows) {
            $this->showProducts();
            return;
        }
        $result = $result->fetch_assoc();
        $params['productId'] = $productId;
        $params['product_name'] = $result['goldProductName'];
        $params['product_location'] = $result['goldProductLocation'];
        $params['product_gold'] = $result['goldProductGold'];
        $params['product_price'] = $result['goldProductPrice'];
        $params['product_moneyUnit'] = $result['goldProductMoneyUnit'];
        $params['product_image'] = $result['goldProductImageName'];
        $params['product_offer'] = $result['goldProductHasOffer'];
        $locations = $db->query("SELECT * FROM locations ORDER BY id");
        while ($row = $locations->fetch_assoc()) {
            $params['locations_dropdown'] .= '<option value="' . $row['id'] . '" ' . ($params['product_location'] == $row['id'] ? 'selected' : '') . '>' . $row['location'] . '</option>';
        }
        if (WebService::isPost() && Session::validateChecker()) {
            $params['product_name'] = filter_var($_POST['product_name'], FILTER_SANITIZE_STRING);
            $params['product_location'] = (int)$_POST['product_location'];
            $params['product_gold'] = (int)$_POST['product_gold'];
            $params['product_price'] = trim($_POST['product_price']);
            $params['product_offer'] = (int)$_POST['product_offer'];
            $params['product_moneyUnit'] = filter_var($_POST['product_moneyUnit'], FILTER_SANITIZE_STRING);
            $params['product_image'] = filter_var($_POST['product_image'], FILTER_SANITIZE_STRING);
            if (empty($params['product_name']) || empty($params['product_moneyUnit']) || empty($params['product_image'])) {
                $params['error'] = 'Some inputs are empty';
            } else {
                $locationExists = $db->query("SELECT COUNT(id) FROM locations WHERE id=" . $params['product_location']);
                if (!$locationExists) {
                    $params['error'] = 'Selected location does not exists';
                } else {
                    $db->query("UPDATE goldProducts SET goldProductName='".$params['product_name']."', goldProductLocation='".$params['product_location']."', goldProductGold='".$params['product_gold']."', goldProductPrice='".$params['product_price']."', goldProductMoneyUnit='".$params['product_moneyUnit']."', goldProductImageName='".$params['product_image']."', goldProductHasOffer='".$params['product_offer']."' WHERE goldProductId=" . $productId);
                    $this->showProducts();
                    ;
                    return;
                }
            }
        }
        $dispatcher = Dispatcher::getInstance();
        $dispatcher->appendContent(Template::getInstance()->load($params, 'tpl/paymentAddProduct.tpl')->getAsString());
    }

    private function deleteProduct()
    {
        $_REQUEST['productId'] = (int)$_REQUEST['productId'];
        $db = GlobalDB::getInstance();
        $db->query("DELETE FROM goldProducts WHERE goldProductId={$_REQUEST['productId']}");
        PackageCode::deleteCodesForPackage($_REQUEST['productId']);
        $this->showProducts();
    }

    private function showProducts()
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
        $locations = $db->query("SELECT * FROM goldProducts WHERE goldProductLocation={$_SESSION[WebService::fixSessionPrefix('locationId')]} ORDER BY goldProductId ASC");
        while ($row = $locations->fetch_assoc()) {
            $params['content'] .= '<tr>';
            $params['content'] .= '<td>' . $row['goldProductId'] . '</td>';
            $params['content'] .= '<td>' . $row['goldProductName'] . '</td>';
            $params['content'] .= '<td>' . $row['goldProductLocation'] . '</td>';
            if ($row['goldProductPrice'] == 0) {
                $params['content'] .= '<td>-</td>';
            } else {
                $params['content'] .= '<td>' . $row['goldProductGold'] . '</td>';
            }
            if ($row['goldProductPrice'] == 0) {
                $params['content'] .= '<td>-</td>';
            } else {
                $params['content'] .= '<td>' . $row['goldProductPrice'] . ' ' . $row['goldProductMoneyUnit'] . '</td>';
            }
            $params['content'] .= '<td><a href="?action=paymentProducts&method=editProduct&productId=' . $row['goldProductId'] . '"><img src="img/x.gif" class="edit"></a>&nbsp;<a href="?action=paymentProducts&method=deleteProduct&productId=' . $row['goldProductId'] . '"><img src="img/x.gif" class="del"></a></td>';
            $params['content'] .= '</tr>';
        }
        if (!$locations->num_rows) {
            $params['content'] = '<tr><td colspan="4"><span class="errorMessage">No products!</span></td></tr>';
        }
        $dispatcher = Dispatcher::getInstance();
        $dispatcher->appendContent(Template::getInstance()->load($params, 'tpl/paymentProducts.tpl')->getAsString());
    }
}