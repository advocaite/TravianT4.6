<?php

namespace Controller;

use Core\Session;
use const DIRECTORY_SEPARATOR;

function response($response)
{
    header("Content-Type: application/json; charset=UTF-8;");
	if(!$response["error"]){
		header("HTTP/1.1 200 OK");
	}
	else{
		header("HTTP/1.1 400 OK");
	}
    $response = json_encode($response); //, JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_QUOT);
    echo $response;
    exit(0);
}



class AjaxCtrl extends AnyCtrl
{
    public function __construct()
    {
        parent::__construct();
        $response = ["reload" => false, "error" => false, "success" => true, "message" => "","reloadOnClose" => false];
        if (isset($_GET['cmd'])) {
			$cmd = filter_var($_GET['cmd'], FILTER_SANITIZE_STRING);
			$section = filter_has_var(INPUT_GET, 'section')?filter_var($_GET['section'], FILTER_SANITIZE_STRING):'';
			$cmd = str_replace(' ', '', ucwords(str_replace('-', ' ', $cmd)));
			$cmd[0] = strtolower($cmd[0]);
			$section = str_replace(' ', '', ucwords(str_replace('-', ' ', $section)));
			$section[0] = strtolower($section[0]);
	
            if (!in_array($cmd, ['news', 'configuration'])) {
                $this->checkAjaxToken($response);
            }
			
            if (!file_exists(__DIR__ . DIRECTORY_SEPARATOR . "Ajax" . DIRECTORY_SEPARATOR .(!empty($section)?$section . DIRECTORY_SEPARATOR:''). $cmd . ".php") ) {
                $response['message'] = "Parameter \"$cmd\" (ajax.php) is not valid in \"cmd\".";
                response($response);
            }
            $cmd = '\\Controller\\Ajax\\'.(!empty($section)?$section.'\\':''). $cmd;
            $dispatcher = new $cmd($response);
            if (method_exists($dispatcher, "dispatch")) {
				$tmpPOST = json_decode(file_get_contents('php://input'), true);
				foreach($tmpPOST as $index=>$post){
					if(is_array($post)){
						foreach($post as $level_index=>$level_post){
							$_POST[$index][$level_index] = filter_var($level_post, FILTER_SANITIZE_STRING);
						}
					}else {
						$_POST[$index] = filter_var($post, FILTER_SANITIZE_STRING);
					}
				}				
				
                $dispatcher->dispatch();
            }
            response($response);
        } else {
            $response['message'] = "Parameter \"cmd\" can not be empty or null.";
            response($response);
        }
    }
    function checkAjaxToken(&$response)
    {
        if ($this->getBearerToken() != $this->session->getAjaxToken()) {
            $response['message'] = 'Invalid token.';
            response($response);
        }
        return TRUE;
    }
	
	function getAuthorizationHeader(){
        $headers = null;
        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        }
        else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        return $headers;
    }
	/**
	 * get access token from header
	 * */
	function getBearerToken() {
		$headers = $this->getAuthorizationHeader();
		// HEADER: Get the access token from the header
		if (!empty($headers)) {
			if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
				return $matches[1];
			}
		}
		return null;
	}
}