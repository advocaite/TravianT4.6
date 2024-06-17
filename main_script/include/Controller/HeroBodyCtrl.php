<?php

namespace Controller;

use Core\Database\DB;
use Game\Map\ImageMapCache;

class HeroBodyCtrl extends AnyCtrl
{
    public function __construct()
    {
        $uid = isset($_GET['uid']) && is_numeric($_GET['uid']) ? (int)$_GET['uid'] : -1;
        if ($uid < 0) {
            header("Content-Type: image/jpeg"); //show headers
            imagejpeg(imagecreate(1, 1));
            goto finished;
        }
        if (!isset($_GET['size'])) {
            $_GET['size'] = '320x422';
        }
        $size = $_GET['size'] == 'profile' ? '160x205' : ($_GET['size'] == 'inventory' ? '330x422' : "330x422");
        $faceSize = $_GET['size'] == 'profile' ? '31x40' : ($_GET['size'] == 'inventory' ? '64x82' : "64x82");
        $filename = "hero_body_{$uid}_{$size}";
        ImageMapCache::checkCache($filename, 'png');
        $db = DB::getInstance();
        $heroFace = $db->query("SELECT * FROM face WHERE uid=$uid");
        if (!$heroFace->num_rows) {
            header("Content-Type: image/jpeg"); //show headers
            imagejpeg(imagecreatetransparent(1, 1));
            goto finished;
        }
        $heroFace = $heroFace->fetch_assoc();
        $color = ["black", "brown", "darkbrown", "yellow", "red",][$heroFace['hairColor']];
        $heroInventory = $db->query("SELECT * FROM inventory WHERE uid=$uid")->fetch_assoc();
        $w = $h = 0;
        switch ($heroFace['gender']) {
            case "male":
                //if was male...
                if (isset($_GET['size']) && $_GET['size'] == "profile") {
                    $w = 79;
                    $h = 18;
                } else {
                    $w = 162;
                    $h = 37;
                }
                break;
            case "female":
                //if was female...
                if (isset($_GET['size']) && $_GET['size'] == "profile") {
                    $w = 81;
                    $h = 25;
                } else {
                    $w = 166;
                    $h = 51;
                }
                break;
        }
        $imgPath = PUBLIC_PATH . 'img/hero/' . $heroFace['gender'] . '/body/' . $size . '/%s';
        $facePath = PUBLIC_PATH . 'img/hero/' . $heroFace['gender'] . '/head/' . $faceSize . '/%s';
        list($width, $height) = explode("x", $size);
        $body = imagecreatetransparent($width, $height);
        if ($heroInventory['horse']) {
            $horse = imagecreatefrompng(sprintf($imgPath, "horse0.png"));
            imagecopy($body, $horse, 0, 0, 0, 0, imagesx($horse), imagesy($horse));
        }
        $base0 = imagecreatefrompng(sprintf($imgPath, "base0.png"));
        imagecopy($body, $base0, 0, 0, 0, 0, imagesx($base0), imagesy($base0));

        $headProfile = imagecreatefrompng(sprintf($facePath, sprintf('face/face%s.png', $heroFace['headProfile'])));
        imagecopy($body, $headProfile, $w, $h, 0, 0, imagesx($headProfile), imagesy($headProfile));
        //add ears
        $ears = imagecreatefrompng(sprintf($facePath, sprintf('ear/ear%s.png', $heroFace['ears'])));
        imagecopy($body, $ears, $w, $h, 0, 0, imagesx($ears), imagesy($ears));
        //add eyes
        $eyes = imagecreatefrompng(sprintf($facePath, sprintf('eye/eye%s.png', $heroFace['eyes'])));
        imagecopy($body, $eyes, $w, $h, 0, 0, imagesx($eyes), imagesy($eyes));
        //add eyebrows
        if ($heroFace['gender'] == "male") {
            $eyebrow = imagecreatefrompng(sprintf($facePath,
                sprintf("eyebrow/eyebrow%s%s",
                    $heroFace['eyebrow'],
                    ($heroFace['gender'] == "male" ? '-' . $color : '') . '.png')));
        } else {
            $eyebrow = imagecreatefrompng(sprintf($facePath,
                sprintf("eyebrow/eyebrow%s", $heroFace['eyebrow'] . '.png')));
        }
        imagecopy($body, $eyebrow, $w, $h, 0, 0, imagesx($eyebrow), imagesy($eyebrow));
        //add hairs if no helmets exists
        if (!$heroInventory['helmet']) {
            if ($heroFace['gender'] == "male" && $heroFace['hairStyle'] == 5) {
                $hair = imagecreatefrompng(sprintf($facePath, 'hair/hairNone.png'));
            } else {
                $hair = imagecreatefrompng(sprintf($facePath, sprintf('hair/hair%s-%s.png', $heroFace['hairStyle'], $color)));
            }
            imagecopy($body, $hair, $w, $h, 0, 0, imagesx($hair), imagesy($hair));
        }
        //add mouth
        $mouth = imagecreatefrompng(sprintf($facePath, sprintf('mouth/mouth%s.png', $heroFace['mouth'])));
        imagecopy($body, $mouth, $w, $h, 0, 0, imagesx($mouth), imagesy($mouth));
        //add nose
        $nose = imagecreatefrompng(sprintf($facePath, sprintf('nose/nose%s.png', $heroFace['nose'])));
        imagecopy($body, $nose, $w, $h, 0, 0, imagesx($nose), imagesy($nose));
        //add beard if male and not none
        if ($heroFace['gender'] == "male" && $heroFace['beard'] <> 5) {
            $beard = imagecreatefrompng(sprintf($facePath, sprintf('beard/beard%s-%s.png', $heroFace['beard'], $color)));
            imagecopy($body, $beard, $w, $h, 0, 0, imagesx($beard), imagesy($beard));
        }
        //add shoes
        if ($heroInventory['shoes']) {
            $shoes = $db->fetchScalar("SELECT type FROM items WHERE id={$heroInventory['shoes']}");
            if ($shoes >= 94 && $shoes <= 96) {
                $shoes = '0_' . ($shoes - 94);
            } else if ($shoes >= 97 && $shoes <= 99) {
                $shoes = '1_' . ($shoes - 97);
            } else if ($shoes >= 100 && $shoes <= 102) {
                $shoes = '2_' . ($shoes - 100);
            }
            $shoes = imagecreatefrompng(sprintf($imgPath, "shoes{$shoes}.png"));
            imagecopy($body, $shoes, 0, 0, 0, 0, imagesx($shoes), imagesy($shoes));
        }
        //add body
        if ($heroInventory['body']) {
            $armor = $db->fetchScalar("SELECT type FROM items WHERE id={$heroInventory['body']}");
            if ($armor >= 82 && $armor <= 84) {
                $armor = '0_' . ($armor - 82);
            } else if ($armor >= 85 && $armor <= 87) {
                $armor = '1_' . ($armor - 85);
            } else if ($armor >= 88 && $armor <= 90) {
                $armor = '2_' . ($armor - 88);
            } else if ($armor >= 91 && $armor <= 93) {
                $armor = '3_' . ($armor - 91);
            }
            $armor = imagecreatefrompng(sprintf($imgPath, "shirt{$armor}.png"));
            imagecopy($body, $armor, 0, 0, 0, 0, imagesx($armor), imagesy($armor));
        }
        //add right hand
        $rightHand = 'arm_right';
        if ($heroInventory['rightHand']) {
            $rightHand = $db->fetchScalar("SELECT type FROM items WHERE id={$heroInventory['rightHand']}");
            if ($rightHand >= 16 && $rightHand <= 18) {
                $rightHand = 'sword0';
            } else if ($rightHand >= 19 && $rightHand <= 21) {
                $rightHand = 'sword1';
            } else if ($rightHand >= 22 && $rightHand <= 24) {
                $rightHand = 'sword2';
            } else if ($rightHand >= 25 && $rightHand <= 27) {
                $rightHand = 'sword3';
            } else if ($rightHand >= 28 && $rightHand <= 30) {
                $rightHand = 'lance0';
            } else if ($rightHand >= 31 && $rightHand <= 33) {
                $rightHand = 'spear0';
            } else if ($rightHand >= 34 && $rightHand <= 36) {
                $rightHand = 'sword4';
            } else if ($rightHand >= 37 && $rightHand <= 39) {
                $rightHand = 'bow0';
            } else if ($rightHand >= 40 && $rightHand <= 42) {
                $rightHand = 'staff0';
            } else if ($rightHand >= 43 && $rightHand <= 45) {
                $rightHand = 'spear1';
            } else if ($rightHand >= 46 && $rightHand <= 48) {
                $rightHand = 'club0';
            } else if ($rightHand >= 49 && $rightHand <= 51) {
                $rightHand = 'spear2';
            } else if ($rightHand >= 52 && $rightHand <= 54) {
                $rightHand = 'axe0';
            } else if ($rightHand >= 55 && $rightHand <= 57) {
                $rightHand = 'hammer0';
            } else if ($rightHand >= 58 && $rightHand <= 60) {
                $rightHand = 'sword5';
            } else if ($rightHand >= 115 && $rightHand <= 117) {
                $rightHand = 'club1';
            } else if ($rightHand >= 118 && $rightHand <= 120) {
                $rightHand = 'axe1';
            } else if ($rightHand >= 121 && $rightHand <= 123) {
                $rightHand = 'sword6';
            } else if ($rightHand >= 124 && $rightHand <= 126) {
                $rightHand = 'spear3';
            } else if ($rightHand >= 127 && $rightHand <= 129) {
                $rightHand = 'bow1';
            } else if ($rightHand >= 130 && $rightHand <= 132) {
                $rightHand = 'axe2';
            } else if ($rightHand >= 133 && $rightHand <= 135) {
                $rightHand = 'bow2';
            } else if ($rightHand >= 136 && $rightHand <= 138) {
                $rightHand = 'sword7';
            } else if ($rightHand >= 139 && $rightHand <= 141) {
                $rightHand = 'bow3';
            } else if ($rightHand >= 142 && $rightHand <= 144) {
                $rightHand = 'sword8';
            }
        }
        $rightHand = imagecreatefrompng(sprintf($imgPath, "{$rightHand}.png"));
        imagecopy($body, $rightHand, 0, 0, 0, 0, imagesx($rightHand), imagesy($rightHand));
        $leftHand = 'arm_left';
        if ($heroInventory['leftHand']) {
            $leftHand = $db->fetchScalar("SELECT type FROM items WHERE id={$heroInventory['leftHand']}");
            if ($leftHand >= 61 && $leftHand <= 63) {
                $leftHand = 'map0';
            } else if ($leftHand >= 64 && $leftHand <= 66) {
                $leftHand = 'flag0';
            } else if ($leftHand >= 67 && $leftHand <= 69) {
                $leftHand = 'flag1';
            } else if ($leftHand >= 73 && $leftHand <= 75) {
                $leftHand = 'sack0';
            } else if ($leftHand >= 76 && $leftHand <= 78) {
                $leftHand = 'shield0';
            } else if ($leftHand >= 79 && $leftHand <= 81) {
                $leftHand = 'horn0';
            }
        }
        $leftHand = imagecreatefrompng(sprintf($imgPath, "{$leftHand}.png"));
        imagecopy($body, $leftHand, 0, 0, 0, 0, imagesx($leftHand), imagesy($leftHand));
        //add helmet
        if ($heroInventory['helmet']) {
            $helmet = $db->fetchScalar("SELECT type FROM items WHERE id={$heroInventory['helmet']}");
            if ($helmet >= 1 && $helmet <= 3) {
                $helmet = '0_' . ($helmet - 1);
            } else if ($helmet >= 4 && $helmet <= 6) {
                $helmet = '1_' . ($helmet - 4);
            } else if ($helmet >= 7 && $helmet <= 9) {
                $helmet = '2_' . ($helmet - 7);
            } else if ($helmet >= 10 && $helmet <= 12) {
                $helmet = '3_' . ($helmet - 10);
            } else if ($helmet >= 13 && $helmet <= 15) {
                $helmet = '4_' . ($helmet - 13);
            }
            $helmet = imagecreatefrompng(sprintf($imgPath, "helmet{$helmet}.png"));
            imagecopy($body, $helmet, 0, 0, 0, 0, imagesx($helmet), imagesy($helmet));
        }
        ob_start();
        imagealphablending($body, true);
        imagesavealpha($body, true);
        imagepng($body); //generate image
        ImageMapCache::checkCache($filename, 'png', ob_get_contents());
        finished:
        return false;
    }
}