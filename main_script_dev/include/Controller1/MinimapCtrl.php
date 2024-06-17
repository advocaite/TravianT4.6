<?php

namespace Controller;

use Core\Caching\Caching;
use Core\Database\DB;
use Game\Formulas;
use Game\Map\ImageMapCache;

class MinimapCtrl extends AnyCtrl
{
    private $colors = [
        'tribes' => [
            1 => 'ea3204',
            2 => 'bc4b0c',
            3 => 'e66204',
            5 => '635c42',
            6 => 'f46c02',
            7 => '6a3716',
        ],
        'grey' => '#665500', //#665500
        'green' => ['#6DAA00'],
    ];

    public function __construct()
    {
        $this->cache();
        ImageMapCache::checkCache('minimap.gif', 'gif', null);
    }

    public function cache()
    {
        $memcache = Caching::getInstance();
        if ($memcache->exists("minimap.gif") && !isset($_GET['noCache'])) return false;
        ini_set("memory_limit", -1);
        $img = imagecreatefrompng(PUBLIC_PATH . "img/map/tile/1x1/basic.png");
        $db = DB::getInstance();
        $rate_x = 185 / (2 * MAP_SIZE + 1);
        $rate_y = 109 / (2 * MAP_SIZE + 1);
        $max = (int)$db->fetchScalar("SELECT MAX(r) FROM available_villages a WHERE occupied=1 AND (SELECT owner FROM vdata WHERE kid=a.kid)>1");
        $map = $db->query("SELECT id, fieldtype, occupied, x, y FROM wdata");
        while ($row = $map->fetch_assoc()) {
            $x = 92.5 + ($row['x'] * $rate_x);
            $y = 54.5 - ($row['y'] * $rate_y);
            if (Formulas::isGrayArea($row['id'])) {
                $rgb = $this->hex2rgb($this->color_blend_by_opacity($this->colors['grey'], mt_rand(70, 100)));
                imagesetpixel($img, $x, $y, imagecolorallocatealpha($img, $rgb['r'], $rgb['g'], $rgb['b'], 0));
            }
            $distance = hypot($row['x'], $row['y']);
            $rnd = mt_rand(50, 80);
            if ($distance >= ($max - 3)) {
                $rnd = 0;
            }
            if ($row['fieldtype'] && $row['occupied']) {
                $race = (int) $db->fetchScalar("SELECT race FROM units WHERE kid={$row['id']}");
                if ($race) {
                    if ($race == 5) {
                        $race = 1;
                    }
                    $rgb = $this->hex2rgb($this->colors['tribes'][$race]);
                    imagesetpixel($img, $x, $y, imagecolorallocatealpha($img, $rgb['r'], $rgb['g'], $rgb['b'], $rnd));
                }
            }
        }
        ob_start();
        imagegif($img);
        $content = ob_get_contents();
        $memcache->set("minimap.gif", ['content' => $content, 'time' => time(), 'length' => strlen($content)], 3600);
        return true;
    }

    private function hex2rgb($hex)
    {
        $hex = str_replace("#", "", $hex);
        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        $rgb = ['r' => $r, 'g' => $g, 'b' => $b];

        //return implode(",", $rgb); // returns the rgb values separated by commas
        return $rgb; // returns an array with the rgb values
    }

    function color_blend_by_opacity($foreground, $opacity, $background = null)
    {
        static $colors_rgb = array(); // stores colour values already passed through the hexdec() functions below.
        $foreground = str_replace('#', '', $foreground);
        if (is_null($background))
            $background = 'FFFFFF'; // default background.

        $pattern = '~^[a-f0-9]{6,6}$~i'; // accept only valid hexadecimal colour values.
        if (!@preg_match($pattern, $foreground) or !@preg_match($pattern, $background)) {
            trigger_error("Invalid hexadecimal colour value(s) found", E_USER_WARNING);
            return false;
        }

        $opacity = (int)$opacity; // validate opacity data/number.
        if ($opacity > 100 || $opacity < 0) {
            trigger_error("Opacity percentage error, valid numbers are between 0 - 100", E_USER_WARNING);
            return false;
        }
        if ($opacity == 100)    // $transparency == 0
            return strtoupper($foreground);
        if ($opacity == 0)    // $transparency == 100
            return strtoupper($background);
        // calculate $transparency value.
        $transparency = 100 - $opacity;

        if (!isset($colors_rgb[$foreground])) { // do this only ONCE per script, for each unique colour.
            $f = array(
                'r' => hexdec($foreground[0] . $foreground[1]),
                'g' => hexdec($foreground[2] . $foreground[3]),
                'b' => hexdec($foreground[4] . $foreground[5])
            );
            $colors_rgb[$foreground] = $f;
        } else { // if this function is used 100 times in a script, this block is run 99 times.  Efficient.
            $f = $colors_rgb[$foreground];
        }

        if (!isset($colors_rgb[$background])) { // do this only ONCE per script, for each unique colour.
            $b = array(
                'r' => hexdec($background[0] . $background[1]),
                'g' => hexdec($background[2] . $background[3]),
                'b' => hexdec($background[4] . $background[5])
            );
            $colors_rgb[$background] = $b;
        } else { // if this FUNCTION is used 100 times in a SCRIPT, this block will run 99 times.  Efficient.
            $b = $colors_rgb[$background];
        }

        $add = array(
            'r' => ($b['r'] - $f['r']) / 100,
            'g' => ($b['g'] - $f['g']) / 100,
            'b' => ($b['b'] - $f['b']) / 100
        );

        $f['r'] += (int)$add['r'] * $transparency;
        $f['g'] += (int)$add['g'] * $transparency;
        $f['b'] += (int)$add['b'] * $transparency;

        return sprintf('%02X%02X%02X', $f['r'], $f['g'], $f['b']);
    }

    function adjustBrightness($hex, $steps)
    {
        // Steps should be between -255 and 255. Negative = darker, positive = lighter
        $steps = max(-255, min(255, $steps));
        // Normalize into a six character long hex string
        $hex = str_replace('#', '', $hex);
        if (strlen($hex) == 3) {
            $hex = str_repeat(substr($hex, 0, 1), 2) . str_repeat(substr($hex, 1, 1), 2) . str_repeat(substr($hex,
                    2,
                    1),
                    2);
        }
        // Split into three parts: R, G and B
        $color_parts = str_split($hex, 2);
        $return = '#';
        foreach ($color_parts as $color) {
            $color = hexdec($color); // Convert to decimal
            $color = max(0, min(255, $color + $steps)); // Adjust color
            $return .= str_pad(dechex($color), 2, '0', STR_PAD_LEFT); // Make two char hex code
        }

        return $return;
    }
}