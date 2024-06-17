<?php

namespace Controller;

use Core\Config;
use Core\Database\DB;
use Core\Session;
use Game\Formulas;
use Game\Map\ImageMapCache;
use Model\MapModel;

class Map_markCtrl extends AnyCtrl
{
    private $block;
    private $image_size;

    public function __construct()
    {
        $tx0 = isset($_REQUEST['tx0']) && is_numeric($_REQUEST['tx0']) ? (int)$_REQUEST['tx0'] : null; //x
        $tx1 = isset($_REQUEST['tx1']) && is_numeric($_REQUEST['tx1']) ? (int)$_REQUEST['tx1'] : null; //right
        $ty0 = isset($_REQUEST['ty0']) && is_numeric($_REQUEST['ty0']) ? (int)$_REQUEST['ty0'] : null; //y
        $ty1 = isset($_REQUEST['ty1']) && is_numeric($_REQUEST['ty1']) ? (int)$_REQUEST['ty1'] : null; //bottom
        if (!is_numeric($tx0) || !is_numeric($tx1) || !is_numeric($ty0) || !is_numeric($ty1)) {
            return;
        }
        if (!Session::getInstance()->isValid()) {
            return;
        }
        $this->renderImage($tx0, $ty0, $tx1, $ty1);
    }

    public function renderImage($tx0, $ty0, $tx1, $ty1)
    {
        $width = $height = 600;
        $this->block = imagecreatetransparent($width, $height);
        $count = $this->blockCount($tx0, $tx1) * $this->blockCount($ty0, $ty1);
        switch ($count) {
            case 100:
                $this->image_size = 60;
                $zoomLevel = 1;
                break;
            case 400:
                $this->image_size = 30;
                $zoomLevel = 2;
                break;
            case 14400:
                $this->image_size = 5;
                $zoomLevel = 3;
                break;
            default:
                exit(-1);
        }
        if ($zoomLevel == 3 && !Config::getProperty("settings", "smallMapEnabled")) die;
        if ($zoomLevel == 3) {
            ini_set("memory_limit", -1);
        }
        $mapModel = new MapModel();
        $block = $mapModel->getMapMark($tx0, $ty0, $tx1, $ty1, Session::getInstance()->getPlayerId(), $zoomLevel, true);
        $version = 0;
        if ($block !== false) {
            $version = $block[1];
        }
        $uid = Session::getInstance()->getPlayerId();
        $aid = Session::getInstance()->getAllianceId();
        $filename = "map_mark_{$tx0}_{$ty0}_{$tx1}_{$ty1}_{$zoomLevel}_{$version}_{$uid}{$aid}";
        ImageMapCache::checkCache($filename, 'png');
        set_time_limit($zoomLevel == 1 ? 2 : ($zoomLevel == 3 ? 8 : 10));
        $dst_x = 0;
        $dst_y = 0;
        $db = DB::getInstance();
        $size_per_row = ceil($width / $this->image_size);
        $x = $tx0;
        $y = $ty1;
        $own_aid = Session::getInstance()->getAllianceId();
        $own_uid = Session::getInstance()->getPlayerId();
        $mapMarkSettings = explode(",", Session::getInstance()->getMapSettings());
        $mapMarkSettings = [
            "ownMarks" => $mapMarkSettings[0] == 1,
            "allianceMarks" => $mapMarkSettings[1] == 1,
        ];
        $kidInfo = [];
        $proceed_count = 1;
        $kidBatchArray = $kidBatchAdd = [];
        while ($proceed_count <= $count) {
            $x = Formulas::coordinateFixer($x);
            $y = Formulas::coordinateFixer($y);
            $kid = Formulas::xy2kid($x, $y);
            $kidInfo[$kid] = ['dst_x' => $dst_x, 'dst_y' => $dst_y];
            $kidBatchArray[] = $kid;
            if ($block[2]) {
                $kidBatchAdd[] = "({$kid}, " . ($block[0]) . ")";
            }
            ++$x;
            ++$dst_x;
            if ($proceed_count % $size_per_row == 0) {
                $x = $tx0;
                --$y;
                $dst_x = 0;
                ++$dst_y;
            }
            ++$proceed_count;
        }
        $result = $db->query("SELECT id, x, y, fieldtype, oasistype, landscape, occupied FROM wdata WHERE id IN(" . implode(',',
                $kidBatchArray) . ")");
        while ($row = $result->fetch_assoc()) {
            $dst_x = $kidInfo[$row['id']]['dst_x'];
            $dst_y = $kidInfo[$row['id']]['dst_y'];
            if ($row['x'] == $row['y'] && $row['x'] == 0) {
                $row['occupied'] = 0;
            }
            if ($zoomLevel <= 2) {
                if ($row['x'] == MAP_SIZE) {
                    imagecopy($this->block,
                        imagecreatefrompng("img/map/grid/{$this->image_size}x{$this->image_size}/rulers/east.png"),
                        $dst_x * $this->image_size,
                        $dst_y * $this->image_size,
                        0,
                        0,
                        $this->image_size,
                        $this->image_size);
                } else if ($row['x'] == -MAP_SIZE) {
                    imagecopy($this->block,
                        imagecreatefrompng("img/map/grid/{$this->image_size}x{$this->image_size}/rulers/west.png"),
                        $dst_x * $this->image_size,
                        $dst_y * $this->image_size,
                        0,
                        0,
                        $this->image_size,
                        $this->image_size);
                }
                if ($row['y'] == MAP_SIZE) {
                    imagecopy($this->block,
                        imagecreatefrompng("img/map/grid/{$this->image_size}x{$this->image_size}/rulers/north.png"),
                        $dst_x * $this->image_size,
                        $dst_y * $this->image_size,
                        0,
                        0,
                        $this->image_size,
                        $this->image_size);
                } else if ($row['y'] == -MAP_SIZE) {
                    imagecopy($this->block,
                        imagecreatefrompng("img/map/grid/{$this->image_size}x{$this->image_size}/rulers/south.png"),
                        $dst_x * $this->image_size,
                        $dst_y * $this->image_size,
                        0,
                        0,
                        $this->image_size,
                        $this->image_size);
                }
            }
            if ($row['occupied']) {
                if ($row['oasistype']) {
                    $uid = $db->fetchScalar("SELECT owner FROM odata WHERE kid={$row['id']}");
                } else {
                    $uid = $db->fetchScalar("SELECT owner FROM vdata WHERE kid={$row['id']}");
                }
                if ($uid) {
                    if ($uid == Session::getInstance()->getPlayerId()) {
                        imagecopy($this->block,
                            imagecreatefrompng("img/map/grid/{$this->image_size}x{$this->image_size}/marks/own.png"),
                            $dst_x * $this->image_size,
                            $dst_y * $this->image_size,
                            0,
                            0,
                            $this->image_size,
                            $this->image_size);
                    }
                    $aid = Session::getInstance()->getAllianceId() ? $db->fetchScalar("SELECT aid FROM users WHERE id=$uid") : false;
                    if ($aid !== false && $aid > 0 && $uid <> Session::getInstance()->getPlayerId()) {
                        if ($aid == Session::getInstance()->getAllianceId()) {
                            imagecopy($this->block,
                                imagecreatefrompng("img/map/grid/{$this->image_size}x{$this->image_size}/marks/member.png"),
                                $dst_x * $this->image_size,
                                $dst_y * $this->image_size,
                                0,
                                0,
                                $this->image_size,
                                $this->image_size);
                        } else {
                            $type = $db->fetchScalar("SELECT type FROM diplomacy WHERE accepted=1 AND ((aid1=$aid AND aid2=$own_aid) OR (aid2=$aid AND aid1=$own_aid)) LIMIT 1");
                            if ($type > 0) {
                                if ($type == 1) {
                                    imagecopy($this->block,
                                        imagecreatefrompng("img/map/grid/{$this->image_size}x{$this->image_size}/marks/conf.png"),
                                        $dst_x * $this->image_size,
                                        $dst_y * $this->image_size,
                                        0,
                                        0,
                                        $this->image_size,
                                        $this->image_size);
                                } else if ($type == 2) {
                                    imagecopy($this->block,
                                        imagecreatefrompng("img/map/grid/{$this->image_size}x{$this->image_size}/marks/nap.png"),
                                        $dst_x * $this->image_size,
                                        $dst_y * $this->image_size,
                                        0,
                                        0,
                                        $this->image_size,
                                        $this->image_size);
                                } else {
                                    imagecopy($this->block,
                                        imagecreatefrompng("img/map/grid/{$this->image_size}x{$this->image_size}/marks/war.png"),
                                        $dst_x * $this->image_size,
                                        $dst_y * $this->image_size,
                                        0,
                                        0,
                                        $this->image_size,
                                        $this->image_size);
                                }
                            }
                        }
                    }
                    if ($mapMarkSettings['ownMarks'] || $mapMarkSettings['allianceMarks']) {
                        $cond = [];
                        if ($mapMarkSettings['ownMarks']) {
                            $cond[] = 'uid=' . $own_uid;
                        }
                        if ($mapMarkSettings['allianceMarks']) {
                            $cond[] = 'aid=' . $own_aid;
                        }
                        if (empty($uid)) $uid = 0;
                        if (empty($aid)) $aid = 0;
                        $color = $db->fetchScalar("SELECT color FROM mapflag WHERE ((targetId=$uid AND type=0) OR (targetId=$aid AND type=1)) AND (" . implode(" OR ", $cond) . ")");
                        if ($color) {
                            imagecopy($this->block,
                                imagecreatefrompng("img/map/grid/{$this->image_size}x{$this->image_size}/border/border{$color}.png"),
                                $dst_x * $this->image_size,
                                $dst_y * $this->image_size,
                                0,
                                0,
                                $this->image_size,
                                $this->image_size);
                        }
                    }
                }
            }
        }
        if ($block[2]) {
            $mapModel->addTileMarks($kidBatchAdd);
        }
        ob_start();
        imagesavealpha($this->block, true);
        imagepng($this->block);//one output
        ImageMapCache::checkCache($filename, 'png', ob_get_contents());
    }

    public function blockCount($x0, $x1)
    {
        $_c = 1;
        while ($x0 <> $x1) {
            $x0 = Formulas::coordinateFixer($x0 + 1);
            $_c++;
        }

        return $_c;
    }
}