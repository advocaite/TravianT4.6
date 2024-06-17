<?php
namespace Controller\Ajax;
use Core\Config;
use Core\Database\DB;
use Core\Session;
class toggleAutoRaid extends AjaxBase
{
    public function dispatch()
    {
        if(!getCustom("autoRaidEnabled")) return;
        $db = DB::getInstance();
        $owner = Session::getInstance()->getPlayerId();
        $lid = (int)$_POST['lid'];
        $result = $db->query("SELECT auto FROM farmlist WHERE id=$lid AND owner=$owner");
        if($result->num_rows) {
            $result = $result->fetch_assoc();
            $result['auto'] = $result['auto'] == 1 ? 0 : 1;
            if($result['auto'] == 1 && getCustom("disallowAutoRaidMoreThanOnePerAccount")){
                $farmListWithAutoRaidCount = $db->fetchScalar("SELECT COUNT(id) FROM farmlist WHERE auto=1 AND owner=$owner");
                if($farmListWithAutoRaidCount > 0){
                    $this->response['error'] = true;
                    $this->response['errorMsg'] = T("FarmList", "You can only have one autoraid per account");
                    return;
                }
            }
            $db->query("UPDATE farmlist SET auto={$result['auto']} WHERE id=$lid");
            $this->response['result'] = $result['auto'];
            return;
        }
        $this->response['error'] = true;
        $this->response['errorMsg'] = 'There is a problem finding farmlist!';
    }
} 