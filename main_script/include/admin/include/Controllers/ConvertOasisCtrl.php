<?php

use Core\Database\DB;
use Core\Helper\WebService;
use Game\Formulas;
use Game\Map\Map;
use Game\ResourcesHelper;
use Model\OasesModel;
use Model\VillageModel;
use resources\View\PHPBatchView;

class ConvertOasisCtrl
{
    private $vars        = [
        'errors'  => [],
        'kid'     => null,
        'type'    => null,
        'success' => false,
    ];
    private $convertible = [
        2 => [3, 4],
        3 => [2, 4],
        4 => [2, 3],

        6 => [7, 8],
        7 => [6, 8],
        8 => [6, 7],

        10 => [11, 12],
        11 => [10, 12],
        12 => [10, 11],

        14 => [15],
        15 => [14],
    ];

    public function __construct()
    {
        $db = DB::getInstance();
        $this->vars['kid'] = isset($_POST['kid']) && is_numeric($_POST['kid']) ? (int)$_POST['kid'] : null;
        $this->vars['type'] = isset($_POST['type']) && is_numeric($_POST['type']) ? (int)$_POST['type'] : null;

        if (WebService::isPost()) {
            if (!empty($this->vars['kid']) && !empty($this->vars['type'])) {
                $oasis = $db->query("SELECT kid, type, owner, did FROM odata WHERe kid={$this->vars['kid']}");
                if (!$oasis->num_rows) {
                    $this->vars['errors'][] = 'Oasis not found.';
                    goto finalize;
                }
                $oasis = $oasis->fetch_assoc();
                if (!in_array($this->vars['type'], $this->convertible[$oasis['type']])) {
                    $this->vars['errors'][] = 'You cannot convert oasis to this type.';
                    goto finalize;
                }
                $db->query("UPDATE wdata SET oasistype={$this->vars['type']} WHERE id={$oasis['kid']}");
                $db->query("UPDATE odata SET type={$this->vars['type']} WHERE kid={$oasis['kid']}");
                if (in_array($oasis['type'], [14, 15])) {
                    //update nearby crops
                    $arenaAround = implode(",", $this->getNearbyFields($oasis['kid'], 7));
                    $fields = $db->query("SELECT id FROM wdata WHERE id IN($arenaAround) AND (fieldtype=1 OR fieldtype=6)");
                    while ($row = $fields->fetch_assoc()) {
                        $percent = OasesModel::getNearByFieldCropPercent($row['id'], 4.9497474683058326708059105347339);
                        $db->query("UPDATE wdata SET crop_percent=$percent WHERE id={$row['id']}");
                    }
                }
                Map::clearCacheForKid($oasis['kid'], false);
                if ($oasis['did']) {
                    ResourcesHelper::updateVillageResources($oasis['did'], false);
                }
                $this->vars['success'] = true;
            }
        }
        finalize:
        $content = PHPBatchView::render('admin/convertOasis', $this->vars);
        Dispatcher::getInstance()->appendContent($content);
    }

    function getNearbyFields($kid, $distance)
    {
        $xy = Formulas::kid2xy($kid);
        $ruler_x = $ruler_y = 7;
        $fields = [];
        $i = $xy['y'] + floor($ruler_y / 2);
        while ($i >= $xy['y'] - floor($ruler_y / 2)) {
            $current_y = Formulas::coordinateFixer($i);
            $j = $xy['x'] - floor($ruler_x / 2);
            while ($j <= $xy['x'] + floor($ruler_x / 2)) {
                $current_x = Formulas::coordinateFixer($j);
                if (Formulas::getDistance(['x' => $current_x, 'y' => $current_y], $xy) <= $distance) {
                    $fields[] = Formulas::xy2kid($current_x, $current_y);
                }
                $j++;
            }
            --$i;
        }
        return $fields;
    }
}