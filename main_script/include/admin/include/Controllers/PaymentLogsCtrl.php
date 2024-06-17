<?php

use Core\Config;
use Core\Database\GlobalDB;
use Core\Session;

class PaymentLogsCtrl
{
    public function __construct()
    {
        $params = [];
        $worldUniqueId = Config::getProperty("settings", "worldUniqueId");
        $db = GlobalDB::getInstance();
        $result = $db->query("SELECT * FROM paymentLog WHERE status=1 AND worldUniqueId=$worldUniqueId ORDER BY id DESC");
        $income = [];
        if(isset($_GET['sendIncomeAgain']) && isset($_GET['c']) && $_GET['c'] == Session::getInstance()->getChecker()){
            Session::getInstance()->changeChecker();
            $db->query("UPDATE paymentConfig SET lastIncomeCheck=0");
            $params['sendAgain'] = true;
        }
        while ($row = $result->fetch_assoc()) {
            $productData = $db->query("SELECT * FROM goldProducts WHERE goldProductId={$row['productId']}")->fetch_assoc();
            if(!isset($income[$productData['goldProductMoneyUnit']])){
                $income[$productData['goldProductMoneyUnit']] = 0;
            }
            $income[$productData['goldProductMoneyUnit']] += $productData['goldProductPrice'];
        }
        $params['income'] = $income;
        $params['count'] = $result->num_rows;
        $dispatcher = Dispatcher::getInstance();
        $dispatcher->appendContent(Template::getInstance()->load($params, 'tpl/paymentLogs.tpl')->getAsString());
    }
}