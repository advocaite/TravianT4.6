<?php
namespace Controller\Ajax;
use Core\Session;
use Controller\Ajax\AjaxBase;

class favouriteTab extends AjaxBase
{
    public function dispatch()
    {
		if(!isset($_POST['name'])){
            $this->response['error'] = TRUE;
			$this->response['message'] = 'Not all of the necessary data has been submitted. Please resend this request with all the necessary data.';
            return;
		}
		
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $numberStr = ($_POST['number']);
        $number = (int)$numberStr;
        $session = Session::getInstance();
        $x =& $this->response;
        if($session->getFavoriteTab($name) === FALSE) {
            $x['error'] = TRUE;
            $x['message'] = "Tab name is not valid!";
            return FALSE;
        }
        switch($name) {
            case "buildingRallyPoint":
                if(in_array($number, [0, 1, 2, 3, 99])) {
                    if(!$session->hasGoldClub() && $number == 99) {
                        $x['error'] = TRUE;
                        $x['message'] = "Tab number is not valid!";
                        return FALSE;
                    }
                    $x['result'] = FALSE;
                    $x['success'] = TRUE;
                    $session->setFavoriteTab($name, $number);
                    return TRUE;
                } else {
                    $x['error'] = TRUE;
                    $x['message'] = "Tab number is not valid!";
                    return FALSE;
                }
                break;
            case 'allyPageProfile':
                $number = $_POST['number'] == 'description' ? 0 : 1;
                $x['result'] = FALSE;
                $x['success'] = TRUE;
                $session->setFavoriteTab($name, $number);
                break;
            case 'reports':
                if(in_array($number, [0, 1, 2, 3, 4, 5, 6, 7])) {
                    $x['result'] = FALSE;
                    $x['success'] = TRUE;
                    $session->setFavoriteTab($name, $number);
                    return TRUE;
                } else {
                    $x['error'] = TRUE;
                    $x['message'] = "Tab number is not valid!";
                    return FALSE;
                }
                break;
            case 'messages':
                if(in_array($number, [0, 1, 2, 3, 4, 5])) {
                    $x['result'] = FALSE;
                    $x['success'] = TRUE;
                    $session->setFavoriteTab($name, $number);
                    return TRUE;
                } else {
                    $x['error'] = TRUE;
                    $x['message'] = "Tab number is not valid!";
                    return FALSE;
                }
                break;
            case 'alliance':
                if(in_array($number, [7, 8, 1, 3, 2, 5])) {
                    $x['result'] = FALSE;
                    $x['success'] = TRUE;
                    $session->setFavoriteTab($name, $number);
                    return TRUE;
                } else {
                    $x['error'] = TRUE;
                    $x['message'] = "Tab number is not valid!";
                    return FALSE;
                }
                break;
            case 'buildingTreasury':
                if(in_array($number, [0, 5, 1, 2])) {
                    $x['result'] = FALSE;
                    $x['success'] = TRUE;
                    $session->setFavoriteTab($name, $number);
                    return TRUE;
                } else {
                    $x['error'] = TRUE;
                    $x['message'] = "Tab number is not valid!";
                    return FALSE;
                }
                break;
            case "buildingExpansion":
                if(in_array($number, [0, 1, 2, 3, 4])) {
                    $x['result'] = FALSE;
                    $x['success'] = TRUE;
                    $session->setFavoriteTab($name, $number);
                    return TRUE;
                } else {
                    $x['error'] = TRUE;
                    $x['message'] = "Tab number is not valid!";
                    return FALSE;
                }
                break;
            case 'villageOverview':
                if(in_array($number, [0, 2, 3, 4, 5])) {
                    $x['result'] = FALSE;
                    $x['success'] = TRUE;
                    $session->setFavoriteTab($name, $number);
                    return TRUE;
                } else {
                    $x['error'] = TRUE;
                    $x['message'] = "Tab number is not valid!";
                    return FALSE;
                }
                break;
            case "buildingMarket":
                if(in_array($number, [0, 5, 1, 2])) {
                    $x['result'] = FALSE;
                    $x['success'] = TRUE;
                    $session->setFavoriteTab($name, $number);
                    return TRUE;
                } else {
                    $x['error'] = TRUE;
                    $x['message'] = "Tab number is not valid!";
                    return FALSE;
                }
                break;
            case 'hero':
                if(in_array($number, [1, 2, 3, 4])) {
                    $x['result'] = FALSE;
                    $x['success'] = TRUE;
                    $session->setFavoriteTab($name, $number);
                    return TRUE;
                } else {
                    $x['error'] = TRUE;
                    $x['message'] = "Tab number is not valid!";
                    return FALSE;
                }
                break;
            case 'statistics':
                if(in_array($number, [0, 1, 2, 3, 5, 6, 7, 8])) {
                    $x['result'] = FALSE;
                    $x['success'] = TRUE;
                    $session->setFavoriteTab($name, $number);
                    return TRUE;
                } else {
                    $x['error'] = TRUE;
                    $x['message'] = "Tab number is not valid!";
                    return FALSE;
                }
                break;
            case 'statisticsTablePlayer':
            case 'statisticsTableAlly':
                if(in_array($number, [0, 1, 2, 3])) {
                    $x['result'] = FALSE;
                    $x['success'] = TRUE;
                    $session->setFavoriteTab($name, $number);
                    return TRUE;
                } else {
                    $x['error'] = TRUE;
                    $x['message'] = "Tab number is not valid!";
                    return FALSE;
                }
                break;
            case 'embassyBuildingSubTabs':
                $ref = ['find' => 0, 'join' => 1, 'found' => 2, 'info' => 3, 'leave' => 4];
                if(isset($ref[$numberStr])){
                    $x['result'] = FALSE;
                    $x['success'] = TRUE;
                    $session->setFavoriteTab($name, $ref[$numberStr]);
                    return TRUE;
                } else {
                    $x['error'] = TRUE;
                    $x['message'] = "Tab number is not valid!";
                    return FALSE;
                }
                break;
        }
        return false;
    }
} 