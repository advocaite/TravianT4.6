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
use Model\Quest;
use Controller\Ajax\AjaxBase;

class changeName extends AjaxBase
{
	/*"success: {
    "reload": true,
    "name": "Test1"
}
fail:
{
    "reload": false,
    "name": "Test1"
}*/
    public function dispatch()
    {
		if(!isset($_POST['did']) or !isset($_POST['name'])){
            $this->response['error'] = TRUE;
			$this->response['message'] = 'Not all of the necessary data has been submitted. Please resend this request with all the necessary data.';
            return;
		}
		
        if(!Session::getInstance()->isValid()) {
            $this->response['error'] = TRUE;
            return;
        }
		
        if(Session::getInstance()->isSitter()) {
            $this->response['error'] = TRUE;
            $this->response['message'] = 'As a sitter you don`t have access to this part.';
            return;
        }
        $name = clean_string_from_white(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
        $did = filter_var($_POST['did'], FILTER_SANITIZE_NUMBER_INT);
        if($did <> Village::getInstance()->getKid()) {
            $this->response['error'] = TRUE;
            $this->response['message'] = 'You tried to change other village name from another village!';
            return;
        }
        if($name == Village::getInstance()->getName() || empty($name)) {
            $this->response['name'] = Village::getInstance()->getName();
            return;
        }
        if(!StringChecker::isValidName($name)) {
            $this->response['error'] = TRUE;
            $this->response['message'] = T("inGame", "Inadmissible name/message");
            return;
        }
        if(strlen($name) > 45) {
            $this->response['error'] = TRUE;
            $this->response['message'] = T("inGame", "Error: very long input");
            return;
        }
        Quest::getInstance()->setQuestBitwise('world', 2, Quest::QUEST_FINISHED);
        $xy = Formulas::kid2xy(Village::getInstance()->getKid());
        NoticeHelper::addSurrounding($xy['x'], $xy['y'], NoticeHelper::SURROUNDING_VILLAGE_RENAME, [Session::getInstance()->getPlayerId(), Session::getInstance()->getName(), Village::getInstance()->getKid(), Village::getInstance()->getName(), $name,], time());
        $cache = new ProfileCache(Session::getInstance()->get("profileCacheVersion"));
        $cache->reValidateProfileVillages(Session::getInstance()->getPlayerId());
        $db = DB::getInstance();
        $name = str_replace("'", '`', $name);
        $name = $db->real_escape_string(htmlspecialchars($name, ENT_QUOTES));
        $db->query("UPDATE vdata SET name='$name' WHERE kid=$did");
        $this->response['name'] = $name;
        $this->response['did'] = $did;
        $this->response['reload'] = TRUE;
    }
} 