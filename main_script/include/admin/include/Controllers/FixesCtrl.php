<?php

use Core\Database\DB;

class FixesCtrl
{
    public function __construct()
    {
        $dispatcher = Dispatcher::getInstance();
        $content = null;
        if (isset($_GET['fixKid']) && is_numeric($_GET['fixKid'])) {
            $db = DB::getInstance();
            $stmt = $db->query("SELECT * FROM fdata WHERE kid={$_GET['fixKid']}");
            if ($stmt->num_rows) {
                $rw = $stmt->fetch_assoc();
                for($i = 19; $i <= 40; ++$i){
                    if($rw['f' . $i . 't'] > 0 && $rw['f' . $i] == 0){
                        $tasks = $db->query("SELECT COUNT(id) FROM building_upgrade WHERE kid={$rw['kid']} AND building_field={$i}")->fetch_row()[0];
                        if($tasks == 0){
                            $db->query("UPDATE fdata SET f{$i}t=0 WHERE kid={$rw['kid']}");
                        }
                    }
                }
                $content .= '<br /><p style="color: red; font-size: 16px">Village fixed.</p>';
            }
        }

        if (isset($_REQUEST['fix'])) {
            switch ($_REQUEST['fix']) {
                case 'storages':
                    require_once INCLUDE_PATH . "fixes/fixStorages.php";
                    $content .= '<br /><h2 style="color:red">Storages were updated...</h2><br ><br />';
                    break;
                case 'cpPop':
                    require_once INCLUDE_PATH . "fixes/fixPopCp.php";
                    $content .= '<br /><h2 style="color:red">POP and CP is now correct were updated...</h2><br ><br />';
                    break;
                case 'heroItemHealth':
                    require_once INCLUDE_PATH . "fixes/fixHeroItemHealth.php";
                    $content .= '<br /><h2 style="color:red">Hero item health is now accurate.</h2><br ><br />';
                    break;
                case 'heroPoints':
                    require_once INCLUDE_PATH . "fixes/fixHeroPoints.php";
                    $content .= '<br /><h2 style="color:red">Hero points is now accurate.</h2><br ><br />';
                    break;
                case 'resources':
                    require_once INCLUDE_PATH . "fixes/fixAllResources.php";
                    $content .= '<br /><h2 style="color:red">All resources updated.</h2><br ><br />';
                    break;
                case 'crop_percents':
                    require_once INCLUDE_PATH . "fixes/fixCropPercents.php";
                    $content .= '<br /><h2 style="color:red">Crop percents updated.</h2><br ><br />';
                    break;
                case 'fix_upkeeps':
                    require_once INCLUDE_PATH . "fixes/fixUpkeeps.php";
                    $content .= '<br /><h2 style="color:red">Upkeeps were updated.</h2><br ><br />';
                    break;
                case 'fix_buildings':
                    require_once INCLUDE_PATH . "fixes/fixBuildings.php";
                    $content .= '<br /><h2 style="color:red">Buildings fixed.</h2><br ><br />';
                    break;
                case 'inventory_places':
                    require_once INCLUDE_PATH . "fixes/fixInventoryPlaceIds.php";
                    $content .= '<br /><h2 style="color:red">Fix inventory place ids.</h2><br ><br />';
                    break;
            }
        }
        $content .= '<h3>Here is some fixes you can use in case of issues:</h3><br />';
        $content .= '<a href="?action=fixes&fix=storages">« Fix storages</a><br />';
        $content .= '<a href="?action=fixes&fix=fix_upkeeps">« Fix upkeeps</a><br />';
        $content .= '<a href="?action=fixes&fix=cpPop">« Fix culture points and pops</a><br />';
        $content .= '<a href="?action=fixes&fix=heroItemHealth">« Fix hero item health</a><br />';
        $content .= '<a href="?action=fixes&fix=heroPoints">« Fix hero points (negative)</a><br />';
        $content .= '<a href="?action=fixes&fix=inventory_places">« Fix inventory places</a><br />';
        $content .= '<a href="?action=fixes&fix=resources">« Fix productions</a><br />';
        $content .= '<a href="?action=fixes&fix=crop_percents">« Fix crop percents</a><br />';
        $content .= '<a href="?action=fixes&fix=fix_buildings">« Fix level 0 buildings</a><br />';
//        $content .= '<a href="?action=fixes&fix=reset_opcache" style="color: darkred">« Invalidate Opcache(s) - (Use with caution)</a><br />';
        $dispatcher->appendContent($content);
    }
}