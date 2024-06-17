<?php

use Core\Database\GlobalDB;
use Core\Helper\WebService;
use Core\PackageCode;
use Core\Session;

class PaymentLocationsCtrl
{
    public function __construct()
    {
        if (!isServerFinished() && isset($_REQUEST['method'])) {
            if ($_REQUEST['method'] == 'addLocation') {
                $this->addLocation();
            } else if ($_REQUEST['method'] == 'deleteLocation') {
                $this->deleteLocation();
            } else if ($_REQUEST['method'] == 'editLocation') {
                $this->editLocation();
            }
        } else {
            $this->showLocations();
        }
    }

    private function deleteLocation()
    {
        $_REQUEST['locationId'] = (int)$_REQUEST['locationId'];
        $db = GlobalDB::getInstance();
        $locationExists = $db->fetchScalar("SELECT COUNT(id) FROM locations WHERE id={$_REQUEST['locationId']}");
        if (!$locationExists > 0) {
            $this->showLocations();
            return;
        }
        $db->query("DELETE FROM locations WHERE id={$_REQUEST['locationId']}");
        $db->query("DELETE FROM paymentProviders WHERE location={$_REQUEST['locationId']}");
        $stmt = $db->query("SELECT * FROM goldProducts");
        while($row = $stmt->fetch_assoc()){
            PackageCode::deleteCodesForPackage($row['goldProductId']);
        }
        $db->query("DELETE FROM goldProducts WHERE goldProductLocation={$_REQUEST['locationId']}");
        $this->showLocations();
    }

    private function editLocation()
    {
        $params = [
            'error' => '',
            'content' => '',
            'location_name' => '',
            'content_language' => '',
            'method' => $_REQUEST['method'],
        ];
        $locationId = (int)$_REQUEST['locationId'];
        $params['locationId'] = $locationId;
        $db = GlobalDB::getInstance();
        $result = $db->query("SELECT * FROM locations WHERE id={$locationId}");
        if (!$result->num_rows) {
            $this->showLocations();
            return;
        }
        $result = $result->fetch_assoc();
        $params['location_name'] = $result['location'];
        $params['content_language'] = $result['content_language'];
        if (WebService::isPost() && Session::validateChecker()) {
            $params['location_name'] = filter_var($_POST['location_name'], FILTER_SANITIZE_STRING);
            $params['content_language'] = filter_var($_POST['content_language'], FILTER_SANITIZE_STRING);
            if (empty($params['location_name']) || empty($params['content_language'])) {
                $params['error'] = 'fill all inputs';
            } else {
                $db = GlobalDB::getInstance();
                $params['location_name'] = $db->real_escape_string($params['location_name']);
                $params['content_language'] = $db->real_escape_string($params['content_language']);
                $db->query("UPDATE locations SET location='".$params['location_name']."', content_language='".$params['content_language']."' WHERE id=$locationId");
                $this->showLocations();
                ;
                return;
            }
        }
        $dispatcher = Dispatcher::getInstance();
        $dispatcher->appendContent(Template::getInstance()->load($params, 'tpl/paymentAddLocation.tpl')->getAsString());
    }

    private function addLocation()
    {
        $params = [
            'error' => '',
            'content' => '',
            'location_name' => '',
            'content_language' => '',
            'method' => $_REQUEST['method'],
        ];
        if (WebService::isPost() && Session::validateChecker()) {
            $params['location_name'] = filter_var($_POST['location_name'], FILTER_SANITIZE_STRING);
            $params['content_language'] = filter_var($_POST['content_language'], FILTER_SANITIZE_STRING);
            if (empty($params['location_name']) || empty($params['content_language'])) {
                $params['error'] = 'fill all inputs';
            } else {
                $db = GlobalDB::getInstance();
                $params['location_name'] = $db->real_escape_string($params['location_name']);
                $params['content_language'] = $db->real_escape_string($params['content_language']);
                $db->query("INSERT INTO locations (`location`, `content_language`) VALUES ('".$params['location_name']."', '".$params['content_language']."')");
                $this->showLocations();
                ;
                return;
            }
        }
        $dispatcher = Dispatcher::getInstance();
        $dispatcher->appendContent(Template::getInstance()->load($params, 'tpl/paymentAddLocation.tpl')->getAsString());
    }

    private function showLocations()
    {
        $params = [
            'content' => '',
        ];
        $db = GlobalDB::getInstance();
        $locations = $db->query("SELECT * FROM locations ORDER BY id ASC");
        while ($row = $locations->fetch_assoc()) {
            $params['content'] .= '<tr>';
            $params['content'] .= '<td>' . $row['id'] . '</td>';
            $params['content'] .= '<td>' . $row['location'] . '</td>';
            $params['content'] .= '<td>' . $row['content_language'] . '</td>';
            $params['content'] .= '<td style="text-align: center"><a href="?action=paymentLocations&method=editLocation&locationId=' . $row['id'] . '"><img src="img/x.gif" class="edit"></a>&nbsp;<a href="?action=paymentLocations&method=deleteLocation&locationId=' . $row['id'] . '"><img src="img/x.gif" class="del"></a></td>';
            $params['content'] .= '</tr>';
        }
        if (!$locations->num_rows) {
            $params['content'] = '<tr><td colspan="4"><span class="errorMessage">No locations!</span></td></tr>';
        }
        $dispatcher = Dispatcher::getInstance();
        $dispatcher->appendContent(Template::getInstance()->load($params, 'tpl/paymentLocations.tpl')->getAsString());
    }
}