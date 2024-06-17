<?php
namespace Controller\Ajax\village;

use Core\Caching\Caching;
use Core\Caching\ProfileCache;
use Core\Database\DB;
use Core\Helper\StringChecker;
use Core\Session;
use Core\Village;
use Game\Formulas;
use Game\NoticeHelper;
use Model\KarteModel;
use Controller\Ajax\AjaxBase;

class updateSortIndex extends AjaxBase
{
	public function dispatch()
    {
		if(!isset($_REQUEST['did']) or !isset($_POST['to'])){
            $this->response['success'] = false;
			$this->response['message'] = 'Not all of the necessary data has been submitted. Please resend this request with all the necessary data.';
            return;
		}
		
        if(!Session::getInstance()->isValid()) {
            $this->response['success'] = false;
            return;
        }
		
        if(Session::getInstance()->isSitter()) {
            $this->response['success'] = false;
            $this->response['message'] = 'As a sitter you don`t have access to this part.';
            return;
        }
		
		$did = filter_var($_REQUEST['did'], FILTER_SANITIZE_NUMBER_INT);
        $km = new KarteModel();
		if($km->getVillageOwner($did) <> Session::getInstance()->getPlayerId()) {
            $this->response['success'] = false;
            $this->response['message'] = 'You tried to change some other village!';
            return;
        }
		$to = filter_var($_POST['to'], FILTER_SANITIZE_NUMBER_INT);
        if($to < 0 || $to >100) {
            $this->response['success'] = false;
            $this->response['message'] = 'Something is wrong with the number!'.$did;
            return;
        }
		
		$cache = new ProfileCache(Session::getInstance()->get("profileCacheVersion"));
        $cache->reValidateProfileVillages(Session::getInstance()->getPlayerId());
        $db = DB::getInstance();
        $name = str_replace("'", '`', $name);
        $name = $db->real_escape_string(htmlspecialchars($name, ENT_QUOTES));
        $db->query("UPDATE vdata SET seq='$to' WHERE kid=$did");
        $this->response['success'] = TRUE;
	}
}
