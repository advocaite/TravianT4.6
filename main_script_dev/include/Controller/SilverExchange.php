<?php
namespace Controller;
use Core\Session;
use Core\Database\DB;

class silverExchange extends GameCtrl
{   public function __construct()
    {
     
       
        $session = Session::getInstance();
        if ($_POST['exTyp'] == 'SilverToGold') {
            $silver = abs((int)$_POST['s']);
            $availableSilver = $session->getAvailableSilver();
            if ($silver >= 200 && $silver <= $availableSilver) {
                $db = DB::getInstance();
                $goldCount = floor($silver / 200);
                $silverCount = (int)$goldCount * 200;
                $db->query("UPDATE users SET gift_gold=gift_gold+$goldCount, silver=silver-$silverCount WHERE id=" . $session->getPlayerId());
            }
        }
        if ($_POST['exTyp'] == 'GoldToSilver') {
          
            $gold = abs((int)$_POST['s']);
            
            $availableGold = $session->getGold();
            if ($gold >= 1 && $silver <= $availableGold) {
                $db = DB::getInstance();
                
                $silverCount = (int)$gold * 100;
                $db->query("UPDATE users SET gift_gold=gift_gold-$gold, silver=silver+$silverCount WHERE id=" . $session->getPlayerId());
              
            }
        }
    }





   
} 