<?php

namespace Controller;
use Core\Database\DB;
use Game\Map\ImageMapCache;

class Hero_imageCtrl extends AnyCtrl
{
    public function __construct()
    {
        // echo '<script>console.log("Your stuff here")</script>';
        // print "In BaseClass constructor\n";
        // codecept_debug("fefefe");
       
      
        $uid = isset($_GET['uuu']) && is_numeric($_GET['uuu']) ? (int)$_GET['uuu'] : -1;
        if($uid < 0) {
         

            header("Content-Type: image/gif");
            imagegif(imagecreate(1, 1));
            goto finished;
        }else{
         
        }

       

        if(isset($_GET['size']) && $_GET['size'] == 'forum') {
            $size = '79x91';
        } else if($_GET['size'] == 'medium'){
            $size = '81x81';
            $bottom=-10;
        }
        else if($_GET['size'] == 'large'){
            $size = '254x330';
            $bottom=0;
        }
        else{
            $size = '81x81';
            $bottom=0;
            
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
        $imgPath = PUBLIC_PATH . '/img/hero/' . $_GET['gender'] . '/head/' . $size . '/%s';
        // echo $imgPath;
        
          switch($_GET['hairColor'])
          {
            case 0:
                $color = 'yellow';    
                break;
            case 1:
                $color = 'brown';    
                break;
            case 2:
                $color = 'darkbrown';    
                break;
            case 3:
                $color = 'black';    
                break;
          }
      
        /** add face */
        list($width, $height) = explode("x", $size);
        $face = imagecreatetransparent($width, $height);
        $face0 = imagecreatefrompng(sprintf($imgPath, 'face0.png'));
  
        imagecopy($face, $face0, 0, 0, 0, 0, imagesx($face0), imagesy($face0));
        
        
        /** add hair */
        if($heroFace['gender'] == "male" &&  $_GET['hairStyle'] == 5) {
            $hair = imagecreatefrompng(sprintf($imgPath, 'hair/hairNone.png'));
        } else {
            $hair = imagecreatefrompng(sprintf($imgPath, sprintf('hair/hair%s-%s.png',  $_GET['hairStyle'], $color)));
            // $hair = imagecreatefrompng(sprintf($imgPath, sprintf('hair/hair%s-%s.png', $_GET['hair'], $color)));
        }
        imagecopy($face, $hair, 0, 0, 0, 0, imagesx($hair), imagesy($hair));
        /** add eyes */
        $eyes = imagecreatefrompng(sprintf($imgPath, sprintf('eye/eye%s.png', $_GET['eyes'])));
        imagecopy($face, $eyes, 0, 0, 0, 0, imagesx($eyes), imagesy($eyes));
        /** add eyebrows */
        if($_GET['gender'] == "male") {
            $eyebrow = imagecreatefrompng(sprintf($imgPath, sprintf("eyebrow/eyebrow%s%s", $_GET['brows'], ($heroFace['gender'] == "male" ? '-' . $color : '') . '.png')));
        } else {
            $eyebrow = imagecreatefrompng(sprintf($imgPath, sprintf("eyebrow/eyebrow%s", $_GET['brows'] . '.png')));
        }
        imagecopy($face, $eyebrow, 0, 0, 0, 0, imagesx($eyebrow), imagesy($eyebrow));
        /** add face */
        $headProfile = imagecreatefrompng(sprintf($imgPath, sprintf('face/face%s.png',  $_GET['jaw'])));
        imagecopy($face, $headProfile, 0, 0, 0, 0, imagesx($headProfile), imagesy($headProfile));
        /** add ears */
        $ears = imagecreatefrompng(sprintf($imgPath, sprintf('ear/ear%s.png', $_GET['ears'])));
        imagecopy($face, $ears, 0, 0, 0, 0, imagesx($ears), imagesy($ears));
        /** add mouth */
        $mouth = imagecreatefrompng(sprintf($imgPath, sprintf('mouth/mouth%s.png', $_GET['mouth'])));
        imagecopy($face, $mouth, 0, 0, 0, 0, imagesx($mouth), imagesy($mouth));
        /** add nose */
        $nose = imagecreatefrompng(sprintf($imgPath, sprintf('nose/nose%s.png', $_GET['nose'])));
        imagecopy($face, $nose, 0, 0, 0, 0, imagesx($nose), imagesy($nose));
         
        /** add beard if male and Id <> 5 */
        // if( $heroFace['hair'] <> 5) {
        //     $beard = imagecreatefrompng(sprintf($imgPath, sprintf('hair/hair%s-%s.png',  $_GET['hair'], $color)));
        //     imagecopy($face, $beard, 0, 0, 0, 0, imagesx($beard), imagesy($beard));
        // }

        if($_GET['gender'] == "male" &&$heroFace['beard'] <> 5) {
            $beard = imagecreatefrompng(sprintf($imgPath, sprintf('beard/beard%s-%s.png',  $_GET['beard'], $color)));
            imagecopy($face, $beard, 0, 0, 0, 0, imagesx($beard), imagesy($beard));
        }

     
        // $imgPath = PUBLIC_PATH . '/img/hero/' . $heroFace['gender'] . '/body/' . '160x205' . '/%s';
       
        // $body0 = imagecreatefrompng(sprintf($imgPath, 'base0.png'));
  
        // imagecopy($face, $body0, -50, 20,0, 0, imagesx($body0), imagesy($body0));
        
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


