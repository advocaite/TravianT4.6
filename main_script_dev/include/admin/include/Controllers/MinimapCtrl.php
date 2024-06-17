<?php

use Core\Database\DB;
use Game\Formulas;

class MinimapCtrl
{
    public function __construct()
    {
        $params = ['content' => null];
        $params['content'] = $this->renderMinimap();
        $dispatcher = Dispatcher::getInstance();
        $dispatcher->appendContent(Template::getInstance()->load($params, 'tpl/map.tpl')->getAsString());
    }

    private function renderMinimap()
    {
        $content = null;
        $db = DB::getInstance();
        $array_tribe = [1 => 'Romans', 'Teutons', 'Gauls', 'Nature', 'Natars', 'Egyptians', 'Huns'];
        $villages = $db->query("SELECT v.kid, v.isWW, v.isFarm, v.owner, v.name villageName, v.capital, v.pop, u.name, u.race, u.access, w.x, w.y FROM vdata AS v LEFT JOIN users AS u ON v.owner=u.id LEFT JOIN wdata AS w ON v.kid=w.id");
        $cap_kid = Formulas::xy2kid(0, 0);
        while ($row = $villages->fetch_assoc()) {
            if(isset($_GET['onlyArtifacts'])){
                if(!($db->fetchScalar("SELECT COUNT(id) FROM artefacts WHERE kid={$row['kid']}"))){
                    continue;
                }
                if(isset($_GET['type'])){
                    $type = $db->fetchScalar("SELECT type FROM artefacts WHERE kid={$row['kid']}");
                    if($type != $_GET['type'])
                        continue;
                }
            }
            $p_name = $row['name'];
            $p_village = htmlspecialchars($row['villageName']);
            $p_coor = "(" . $row['x'] . "|" . $row['y'] . ")";
            $p_pop = $row['pop'];
            $p_tribe = $array_tribe[$row['race']];
            $HTML = <<<HTML_ENTITIES
<ul class=\'p_info\'><li>Player name: <b>{$p_name}</b></li><li>Village name: <b>{$p_village}</b></li><li>Coordinate: <b>{$p_coor}</b></li><li>Population: <b>{$p_pop}</b></li><li>Tribe : <b>{$p_tribe}</b></li></ul>
HTML_ENTITIES;
            $p_info = '<a href="admin.php?action=editVillage&kid=' . $row['kid'] . '" target="_blank"><img src="img/admin/map_' . ($row['kid'] == $cap_kid ? 0 : $row['race']) . '.gif" border="0" onmouseout="med_closeDescription()" onmousemove="med_mouseMoveHandler(arguments[0], \'' . $HTML . '\')"></a>';
            //250px=0
            $xdiv = 250 / MAP_SIZE;
            if ($row['x'] < 0) { //-
                $p_x = 250 - (int)abs($row['x'] * $xdiv);
            }
            if ($row['x'] > 0) { //+
                $p_x = 250 + (int)abs($row['x'] * $xdiv);
            }
            if ($row['y'] < 0) { //-
                $p_y = 250 + (int)abs($row['y'] * $xdiv);
            }
            if ($row['y'] > 0) { //+
                $p_y = 250 - (int)abs($row['y'] * $xdiv);
            }
            if($row['x'] == 0){
                $p_x = 250;
            }
            if($row['y'] == 0){
                $p_y = 250;
            }
            $content .= '<div style="left:' . $p_x . 'px; top:' . $p_y . 'px; position:absolute">' . $p_info . '</div>';
        }
        return $content;
    }
}