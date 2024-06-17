<?php
namespace Controller\Ajax;

use Core\Caching\Caching;
use Core\Caching\ProfileCache;
use Core\Database\DB;
use Core\Helper\StringChecker;
use Core\Session;
use Core\Village;
use Game\Formulas;
use Game\NoticeHelper;
use Model\Quest;

class changeVillageName extends AjaxBase
{
    public function dispatch()
    {
        if(!Session::getInstance()->isValid()) {
            return;
        }
        if(Session::getInstance()->isSitter()) {
            $this->response['error'] = TRUE;
            $this->response['errorMsg'] = 'As a sitter you don`t have access to this part.';
            return;
        }
        $name = clean_string_from_white(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
        $did = (int)$_POST['did'];
        if($did <> Village::getInstance()->getKid()) {
            $this->response['error'] = TRUE;
            $this->response['errorMsg'] = 'You tried to change other village name from another village!';
            return;
        }
        if($name == Village::getInstance()->getName() || empty($name)) {
            $this->response['data']['name'] = Village::getInstance()->getName();
            return;
        }
        if(!StringChecker::isValidName($name)) {
            $this->response['error'] = TRUE;
            $this->response['errorMsg'] = T("inGame", "Inadmissible name/message");
            return;
        }
        if(strlen($name) > 45) {
            $this->response['error'] = TRUE;
            $this->response['errorMsg'] = T("inGame", "Error: very long input");
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
        $this->response['data']['name'] = $name;
        $this->response['data']['did'] = $did;
        $this->response['reload'] = TRUE;
    }
} 