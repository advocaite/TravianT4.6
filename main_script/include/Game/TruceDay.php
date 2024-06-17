<?php
namespace Game;
use Core\Config;
use Core\Database\DB;
use Model\InfoBoxModel;

class TruceDay
{
    public static function isActive(){
        $config = Config::getInstance();
        if($config->dynamic->truceFrom == 0 || $config->dynamic->truceTo == 0) return false;
        return time() > $config->dynamic->truceFrom && time() < $config->dynamic->truceTo;
    }
    public static function getReasonId(){
        $config = Config::getInstance();
        return $config->dynamic->truceReasonId;
    }
    public static function getFrom(){
        $config = Config::getInstance();
        return $config->dynamic->truceFrom;
    }
    public static function getTo(){
        $config = Config::getInstance();
        return $config->dynamic->truceTo;
    }
    public static function saveTruce($from, $to, $reasonId){
        $config = Config::getInstance();
        $config->dynamic->truceFrom = $from;
        $config->dynamic->truceTo = $to < time() ? 0 : $to;
        $config->dynamic->truceReasonId = $reasonId;
        $infoBox = new InfoBoxModel();
        $infoBox->deleteInfoByTypeInServer(17); //remove all info box
        if(self::isActive()){
            $infoBox->addInfo(0, 1, 17, null, 0, 0);
        }
        $db = DB::getInstance();
        $db->query("UPDATE config SET truceFrom={$config->dynamic->truceFrom}, truceTo={$config->dynamic->truceTo}, truceReasonId=$reasonId");
    }
}