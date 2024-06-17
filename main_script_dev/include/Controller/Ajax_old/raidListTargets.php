<?php
namespace Controller\Ajax;
use Core\Session;
use Game\Formulas;
use Core\Locale;
use Model\FarmListModel;
class raidListTargets extends AjaxBase
{
    public function dispatch()
    {
        $m = new FarmListModel();
        $list = $m->getMyFarmListById((int)$_POST['lid'], Session::getInstance()->getPlayerId());
        if($list === FALSE) {
            return;
        }
        $this->response['data']['lid'] = (int)$_POST['lid'];
        $this->response['data']['targets'] = [];
        $lastTargets = $m->getLastTargets(Session::getInstance()->getPlayerId());
        while($row = $lastTargets->fetch_assoc()) {
            if(!$m->isThereAnyThing($row['to_kid'])) {
                continue;
            }
            $xy = Formulas::kid2xy($row['to_kid']);
            $target = &$this->response['data']['targets'][];
            if($m->isOasis($row['to_kid'])) {
                $name = T("FarmList", $m->isOasisConqured($row['to_kid']) ? "occupiedOasis" : "unoccupiedOasis");
                $name .= ' &#x202d;<span class="coordinates coordinatesWrapper"><span class="coordinateX">(' . $xy['x'] . '&#x202c;&#x202c;</span><span class="coordinatePipe">|</span><span class="coordinateY">&#x202d;&#x202d;' . $xy['y'] . '&#x202c;&#x202c;)</span></span>&#x202c;‎</a';
            } else {
                $name = $m->getVillage($row['to_kid'], 'name')['name'];
            }
            $target['aid'] = 0;//alliance ID not used there(not needed)
            $target['name'] = $name;
            $target['did'] = $row['to_kid'];
            $target['kid'] = $row['to_kid'];
            $target['x'] = $xy['x'];
            $target['y'] = $xy['y'];
            $target['typ'] = 0;
        }
        $this->response['data']['list']['id'] = $list['id'];
        $this->response['data']['list']['uid'] = $list['owner'];
        $this->response['data']['list']['did'] = $list['kid'];
        $this->response['data']['list']['name'] = $list['name'];
    }
} 