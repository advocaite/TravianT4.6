<?php

use Core\Config;
use Core\Database\DB;
use Core\Database\GlobalDB;
use Core\Database\ServerDB;
use Core\Helper\WebService;
use Model\InfoBoxModel;

class PaymentSettingsCtrl
{
    private $offer_times = [
        0,
        30 * 60,
        1 * 3600,
        2 * 3600,
        3 * 3600,
        6 * 3600,
        12 * 3600,
        1 * 86400,
        2 * 86400,
        3 * 86400,
        4 * 86400,
        7 * 86400,
    ];
    public function __construct()
    {
        $db = GlobalDB::getInstance();
        $config = $db->query("SELECT * FROM paymentConfig")->fetch_assoc();
        $params = [
            'error' => '',
            'active' => $config['active'],
            'offer' => $this->getOfferIndex($config['offer'] - time()),
        ];
        if (!isServerFinished() && WebService::isPost()) {
            $paymentStatus = in_array($_POST['paymentStatus'], [0, 1]) ? (int)$_POST['paymentStatus'] : $config['active'];
            $paymentOffer = in_array($_POST['paymentOffer'], array_keys($this->offer_times)) ? (int)$_POST['paymentOffer'] : $params['offer'];
            if ($paymentOffer == $params['offer']) {
                $db->query("UPDATE paymentConfig SET active={$paymentStatus}");
            } else {
                $paymentOffer = time() + $this->getOfferIndexValue($paymentOffer);
                $db->query("UPDATE paymentConfig SET active={$paymentStatus}, offer={$paymentOffer}, offerFrom=" . time());
                $params['offer'] = $this->getOfferIndex($paymentOffer - time());
                if($paymentOffer > time()){
                    $this->addPublicInfo('', 1, time(), $paymentOffer);
                    if(isset($_POST['sendMessage']) && $_POST['sendMessage'] == 1){
                        $this->sendPublicMsg('[GoldPromotionPublicMsg]');
                    }
                } else {
                    GlobalDB::getInstance()->query("DELETE FROM infobox WHERE autoType=1");
                }
            }
            $params['active'] = $paymentStatus;
        }
        $params['offer_times'] = $this->offer_times;
        $dispatcher = Dispatcher::getInstance();
        $dispatcher->appendContent(Template::getInstance()->load($params, 'tpl/paymentSettings.tpl')->getAsString());
    }
    public function addPublicInfo($params, $autoType, $showFrom, $showTo){
        $autoType = (int)$autoType;
        $db = GlobalDB::getInstance();
        $params = $db->real_escape_string($params);
        $db->query("DELETE FROM infobox WHERE autoType=1");
        $db->query("INSERT INTO infobox (params, autoType, showFrom, showTo) VALUES ('$params', $autoType, $showFrom, $showTo)");
        InfoBoxModel::invalidatePublicInfoBox();
    }
    private function sendPublicMsg($msg){
        $globalDB = GlobalDB::getInstance();
        $servers = $globalDB->query("SELECT id, configFileLocation FROM gameServers WHERE finished=0");
        while ($server = $servers->fetch_assoc()) {
            try {
                if ($server['id'] == Config::getProperty("settings", "worldUniqueId")) {
                    $db = DB::getInstance();
                } else {
                    $db = ServerDB::getInstance($server['configFileLocation']);
                }
                $db->query("UPDATE config SET message='".$db->real_escape_string($msg)."'");
                $db->query("UPDATE users SET ok=1");
            } catch (\Exception $e) {
                continue;
            }
        }
    }
    private function getOfferIndex($offer)
    {
        if($offer <= 0) return 0;
        foreach($this->offer_times as $index => $time){
            if($offer <= $time){
                return $index;
            }
        }
        return 0;
    }

    private function getOfferIndexValue($offer)
    {
        return $this->offer_times[$offer];
    }
}