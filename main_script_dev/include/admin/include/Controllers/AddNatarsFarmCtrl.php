<?php

use Core\Database\DB;
use Core\Helper\WebService;
use Game\Buildings\BuildingAction;
use Game\Formulas;
use Model\RegisterModel;
use resources\View\PHPBatchView;

class AddNatarsFarmCtrl
{
    public function __construct()
    {
        $vars = [
            'resources_level' => isset($_REQUEST['resources_level']) ? (int)$_REQUEST['resources_level'] : 5,
            'village_count' => isset($_REQUEST['village_count']) ? (int)$_REQUEST['village_count'] : 2,
            'extra_storage' => isset($_REQUEST['extra_storage']) ? (int)$_REQUEST['extra_storage'] : 0,
            'deploy_se' => isset($_REQUEST['deploy_se']) && $_REQUEST['deploy_se'] == 1,
            'deploy_sw' => isset($_REQUEST['deploy_sw']) && $_REQUEST['deploy_sw'] == 1,
            'deploy_ne' => isset($_REQUEST['deploy_ne']) && $_REQUEST['deploy_ne'] == 1,
            'deploy_nw' => isset($_REQUEST['deploy_nw']) && $_REQUEST['deploy_nw'] == 1,
        ];

        if (WebService::isPost()) {
            $sides = [
                'ne' => [0, 90],
                'nw' => [90, 180],
                'se' => [270, 360],
                'sw' => [180, 270],
            ];

            if (!$vars['deploy_se'])
                unset($sides['se']);

            if (!$vars['deploy_sw'])
                unset($sides['sw']);

            if (!$vars['deploy_ne'])
                unset($sides['ne']);

            if (!$vars['deploy_nw'])
                unset($sides['nw']);

            $db = DB::getInstance();
            $register = new RegisterModel();

            $villagesCount = 0;

            set_time_limit(0);
            ignore_user_abort(true);


            foreach ($sides as $side => $angle) {
                for ($i = 1; $i <= $vars['village_count']; ++$i) {
                    $r[0] = 10 + mt_rand(4, 25) * (MAP_SIZE / 400);
                    $r[1] = $r[0] + 5 + mt_rand(15, 200) * (MAP_SIZE / 400);

                    $conditions = [];
                    $conditions[] = 'occupied=0';
                    $conditions[] = "(angle >= {$angle[0]} AND angle <= {$angle[1]})";
                    $conditions[] = "(r >= {$r[0]} AND r <= {$r[1]})";

                    $nearbyNatars = '(SELECT COUNT(av2.kid) FROM available_villages av2, vdata v2 WHERE av2.occupied=1 AND ABS(av2.r-av.r) <= 10 AND ABS(av2.angle-av.angle) <= 8 AND v2.kid=av2.kid AND v2.owner=1 AND v2.isWW=0 AND (SELECT COUNT(id) FROM artefacts WHERE kid=v2.kid)=0)';

                    $conditions[] = "$nearbyNatars < 3";

                    $village = $db->query("SELECT kid FROM available_villages av WHERE " . implode(" AND ", $conditions) . " ORDER BY rand LIMIT 1");

                    if ($village->num_rows) {
                        $kid = $village->fetch_row()[0];
                        $register->createNewNatarVillage($kid);
                        for ($j = 1; $j <= 18; ++$j) {
                            BuildingAction::upgrade($kid, $j, $vars['resources_level']);
                        }
                        if($vars['extra_storage'] > 0){
                            $times = $vars['extra_storage'];
                            $storage = $times * Formulas::storeCAP(20);
                            $db->query("UPDATE vdata SET extraMaxstore=extraMaxstore+$times, maxstore=maxstore+$storage WHERE kid=$kid");
                            $db->query("UPDATE vdata SET extraMaxcrop=extraMaxcrop+$times, maxcrop=maxcrop+$storage WHERE kid=$kid");
                        }
                        $villagesCount++;
                    } else {
                        $vars['error'] = 'No village found.';
                    }
                }
            }
            if ($villagesCount > 0) {
                $vars['success'] = sprintf('%s villages were added.', $villagesCount);
            }
        }
        Dispatcher::getInstance()->appendContent(PHPBatchView::render('admin/addNatarsFarm', $vars));
    }
}