<?php
namespace Controller;
use Core\Session;

class HeroDivider extends GameCtrl
{
    public function render(){

        $t = isset($_GET['t']) && $_GET['t'] >= 1 && $_GET['t'] <= 4 ? (int)$_GET['t'] : Session::getInstance()->getFavoriteTab("hero"); //(favourite);
        $pages = [
            1 => 'Controller\\HeroInventoryCtrl',
            2 => 'Controller\\HeroFaceCtrl',
            3 => 'Controller\\HeroAdventureCtrl',
            4 => 'Controller\\HeroAuctionCtrl',
        ];
        if(!isset($pages[$t])){
            $t = 1;
        }
        $controller = new $pages[$t]();
        echo $controller->render();
    }
}