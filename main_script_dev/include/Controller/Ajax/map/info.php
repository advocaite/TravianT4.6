<?php
namespace Controller\Ajax\map;

use Controller\Ajax\AjaxBase;
use Controller\KarteCtrl;
use Model\MapModel;

class info extends AjaxBase
{
    public function dispatch()
    {
        $mapModel = new MapModel();
        $this->response['elements' => [], 'blocks' => []];
        $zoomLevel = isset($_POST['zoomLevel']) ? (int)$_POST['zoomLevel'] : 1;
        KarteCtrl::getAttackReinforceOtherElements($this->response['data']);
        foreach ($_POST['data'] as $block) {
            if (!isset($block['position']['x0'])) continue;
            $tx0 = $block['position']['x0'];
            $tx1 = $block['position']['x1'];
            $ty0 = $block['position']['y0'];
            $ty1 = $block['position']['y1'];
            $block = $mapModel->getMapBlock($tx0, $ty0, $tx1, $ty1, $zoomLevel, FALSE);
            if ($block === FALSE) {
                $version = 0;
            } else {
                $version = $block[1];
            }
            $this->response['blocks'][$tx0][$ty0][$tx1][$ty1]['version'] = (int)$version;
        }
    }
}