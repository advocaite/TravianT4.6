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
use resources\View\PHPBatchView;

class playerNote extends AjaxBase
{
    public function dispatch()
    {
        if (!Session::getInstance()->isValid()) {
            return;
        }
        if (isset($_REQUEST['affectedPlayerID'])) {
            $uid = (int)$_REQUEST['affectedPlayerID'];
            if ($uid == Session::getInstance()->getPlayerId()) return;
            $db = DB::getInstance();
            if ($db->fetchScalar("SELECT COUNT(id) FROM users WHERE id=$uid") > 0) {
                if (isset($_REQUEST['action'])) {
                    if ($_REQUEST['action'] == 'edit') {
                        $view = new PHPBatchView("ajax/playerNote");
                        $view->vars['note'] = \Model\PlayerNote::getPlayerNote(Session::getInstance()->getPlayerId(), $uid);
                        $view->vars['playerID'] = $uid;
                        $this->response['data']['html'] = $view->output();
                    } else if($_REQUEST['action'] == 'save'){
                        if(isset($_REQUEST['noteText'])){
                            $noteText = trim($_REQUEST['noteText']);
                            if(strlen($noteText) > 500){
                                $noteText = substr($noteText, 0, 500);
                            }
                            \Model\PlayerNote::setPlayerNote(Session::getInstance()->getPlayerId(), $uid, $noteText);
                            $this->response['reload'] = true;
                        }
                    }
                }
            }
        }
    }
} 