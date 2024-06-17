<?php
namespace Controller;
use Core\Database\DB;
use Game\Map\ImageMapCache;
class Hero_imageCtrl extends AnyCtrl
{
    public function __construct()
    {
        $uid = isset($_GET['uid']) && is_numeric($_GET['uid']) ? (int)$_GET['uid'] : -1;
        if($uid < 0) {
            header("Content-Type: image/gif");
            imagegif(imagecreate(1, 1));
            goto finished;
        }
        if(isset($_GET['size']) && $_GET['size'] == 'forum') {
            $size = '79x91';
        } else {
            $size = '81x81';
        }
        $filename = "hero_image_{$uid}_$size";
        ImageMapCache::checkCache($filename, 'gif', null);
        $db = DB::getInstance();
        $heroFace = $db->query("SELECT * FROM face WHERE uid={$uid}");
        if(!$heroFace->num_rows) {
            header("Content-Type: image/gif");
            imagegif(imagecreate(1, 1));
            goto finished;
        }
        $heroFace = $heroFace->fetch_assoc();
        $imgPath = PUBLIC_PATH . '/img/hero/' . $heroFace['gender'] . '/head/' . $size . '/%s';
        $color = ["black", "brown", "darkbrown", "yellow", "red",][$heroFace['hairColor']];
        /** add face */
        list($width, $height) = explode("x", $size);
        $face = imagecreatetransparent($width, $height);
        $face0 = imagecreatefrompng(sprintf($imgPath, 'face0.png'));
        imagecopy($face, $face0, 0, 0, 0, 0, imagesx($face0), imagesy($face0));
        /** add hair */
        if($heroFace['gender'] == "male" && $heroFace['hairStyle'] == 5) {
            $hair = imagecreatefrompng(sprintf($imgPath, 'hair/hairNone.png'));
        } else {
            $hair = imagecreatefrompng(sprintf($imgPath, sprintf('hair/hair%s-%s.png', $heroFace['hairStyle'], $color)));
        }
        imagecopy($face, $hair, 0, 0, 0, 0, imagesx($hair), imagesy($hair));
        /** add eyes */
        $eyes = imagecreatefrompng(sprintf($imgPath, sprintf('eye/eye%s.png', $heroFace['eyes'])));
        imagecopy($face, $eyes, 0, 0, 0, 0, imagesx($eyes), imagesy($eyes));
        /** add eyebrows */
        if($heroFace['gender'] == "male") {
            $eyebrow = imagecreatefrompng(sprintf($imgPath, sprintf("eyebrow/eyebrow%s%s", $heroFace['eyebrow'], ($heroFace['gender'] == "male" ? '-' . $color : '') . '.png')));
        } else {
            $eyebrow = imagecreatefrompng(sprintf($imgPath, sprintf("eyebrow/eyebrow%s", $heroFace['eyebrow'] . '.png')));
        }
        imagecopy($face, $eyebrow, 0, 0, 0, 0, imagesx($eyebrow), imagesy($eyebrow));
        /** add face */
        $headProfile = imagecreatefrompng(sprintf($imgPath, sprintf('face/face%s.png', $heroFace['headProfile'])));
        imagecopy($face, $headProfile, 0, 0, 0, 0, imagesx($headProfile), imagesy($headProfile));
        /** add ears */
        $ears = imagecreatefrompng(sprintf($imgPath, sprintf('ear/ear%s.png', $heroFace['ears'])));
        imagecopy($face, $ears, 0, 0, 0, 0, imagesx($ears), imagesy($ears));
        /** add mouth */
        $mouth = imagecreatefrompng(sprintf($imgPath, sprintf('mouth/mouth%s.png', $heroFace['mouth'])));
        imagecopy($face, $mouth, 0, 0, 0, 0, imagesx($mouth), imagesy($mouth));
        /** add nose */
        $nose = imagecreatefrompng(sprintf($imgPath, sprintf('nose/nose%s.png', $heroFace['nose'])));
        imagecopy($face, $nose, 0, 0, 0, 0, imagesx($nose), imagesy($nose));
        /** add beard if male and Id <> 5 */
        if($heroFace['gender'] == "male" && $heroFace['beard'] <> 5) {
            $beard = imagecreatefrompng(sprintf($imgPath, sprintf('beard/beard%s-%s.png', $heroFace['beard'], $color)));
            imagecopy($face, $beard, 0, 0, 0, 0, imagesx($beard), imagesy($beard));
        }
        //Transparent gif image by removing black color.
        imagecolortransparent($face, imagecolorallocatealpha($face, 255, 255, 255, 127));
        finalize:
        ob_start();
        imagesavealpha($face, TRUE);
        imagegif($face);
        ImageMapCache::checkCache($filename, 'gif', ob_get_contents());
        finished:
        return false;
    }
} 