<?php
namespace Controller\Ajax;
use Core\Config;
use Core\Database\DB;
use Core\Session;
class toggleEvasionState extends AjaxBase
{
    public function dispatch()
    {
        if(!Config::getProperty("custom", "allowEvasionForAllVillages")){
            return;
        }
        $db = DB::getInstance();
        $owner = Session::getInstance()->getPlayerId();
        $kid = (int)$_POST['kid'];
        $result = $db->query("SELECT evasion FROM vdata WHERE kid=$kid AND owner=$owner");
        if($result->num_rows) {
            $result = $result->fetch_assoc();
            $result['evasion'] = $result['evasion'] == 1 ? 0 : 1;
            $db->query("UPDATE vdata SET evasion={$result['evasion']} WHERE kid=$kid");
            $this->response['result'] = $result['evasion'];
            return;
        }
        $this->response['error'] = true;
        $this->response['errorMsg'] = 'There is a problem finding village!';
    }
} 