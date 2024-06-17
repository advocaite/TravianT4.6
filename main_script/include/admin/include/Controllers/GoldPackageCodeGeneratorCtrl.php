<?php

use Core\Database\GlobalDB;
use Core\Helper\WebService;
use Core\PackageCode;
use Core\Session;

class GoldPackageCodeGeneratorCtrl
{
    private $pageSize = 50;
    const NEXT_SHAPE = '»';
    const PREVIOUS_SHAPE = '«';

    public function __construct($isGift = false)
    {
        if(!getCustom('allowInterruptionInGame')){
            $dispatcher = Dispatcher::getInstance();
            $dispatcher->appendContent("<hr><p class='error center'>Disabled by admin.</p><hr>");
            return;
        }
        $db = GlobalDB::getInstance();
        if (isset($_GET['section']) && isset($_GET['id']) && $_GET['section'] == 'del' && Session::validateChecker()) {
            $db->query("DELETE FROM package_codes WHERE id=" . (int)$_GET['id']);
        }
        $params = [];
        $params['isGift'] = $isGift;
        $params['count'] = 0;
        $params['selectedGoldProductId'] = null;
        $params['packages'] = [];
        $products = $db->query("SELECT * FROM `goldProducts` WHERE goldProductPrice>0 ORDER BY goldProductLocation ASC, goldProductId ASC");
        $valid_product_ids = [];
        while ($prod = $products->fetch_assoc()) {
            $valid_product_ids[] = $prod['goldProductId'];
            $prod['location'] = $db->query("SELECT * FROM locations WHERE id={$prod['goldProductLocation']}")->fetch_assoc();
            $params['packages'][] = $prod;
        }
        $params['selectedGoldProductId'] = isset($_REQUEST['package']) && in_array($_REQUEST['package'], $valid_product_ids) ? (int)$_REQUEST['package'] : null;
        if (WebService::isPost() && isset($_REQUEST['package']) && isset($_REQUEST['count']) && Session::validateChecker()) {
            $params['count'] = abs((int)$_REQUEST['count']);
            if ($params['count'] && $params['selectedGoldProductId']) {
                $codes = PackageCode::generateCode($params['selectedGoldProductId'], $params['count'], $params['isGift']);
                $params['error'] = '<h1>Generated codes:</h1><br />' . '<textarea disabled rows="20" style="width: 100%" readonly>' . join("\n", $codes) . '</textarea>';
            }
        }
        $packageId = $params['selectedGoldProductId'];
        $page = isset($_REQUEST['p']) ? abs((int)$_REQUEST['p']) : 1;
        $params['content'] = null;
        if ($packageId !== NULL) {
            $result = PackageCode::getCodesByPage($packageId, $page, $this->pageSize, $params['isGift']);
            while ($row = $result->fetch_assoc()) {
                $row['product'] = PackageCode::getProduct($row['package_id']);
                $row['location'] = $db->query("SELECT * FROM locations WHERE id={$row['product']['goldProductLocation']}")->fetch_assoc();
                $params['content'] .= '<tr>';
                $params['content'] .= '<td style="text-align: center; "><a href="admin.php?package=' . $packageId . '&'.Session::getCheckerName().'=' . Session::getInstance()->getChecker() . '&action=goldPackageCodeGenerator&id=' . $row['id'] . '&section=del"><img src="img/x.gif" class="del"></a></td>';
                $params['content'] .= '<td style="text-align: center; font-size: 10px;">' . $row['id'] . '</td>';
                $params['content'] .= '<td style="text-align: center; font-size: 10px;">' . $row['code'] . '</td>';
                $params['content'] .= '<td style="text-align: center; font-size: 10px;">' . ($row['location']['location']) . '</td>';
                $params['content'] .= '<td style="text-align: center; font-size: 10px;">' . ($row['product']['goldProductName']) . ' - ' . ($row['product']['goldProductGold']) . ' Golds</td>';
                $params['content'] .= '<td style="text-align: center; font-size: 10px;">' . ($row['product']['goldProductPrice']) . ' ' . ($row['product']['goldProductMoneyUnit']) . '</td>';
                $params['content'] .= '</tr>';
            }
            if (!$result->num_rows) {
                $params['content'] .= '<tr><td colspan="6" class="hab"><span class="errorMessage">No code exists.</span></td></tr>';
            }
            if($params['isGift']){
                $params['navigator'] = $this->getNavigator($page, $db->fetchScalar("SELECT COUNT(id) FROM package_codes WHERE used=0 AND isGift=1"), ['action' => 'goldPackageCodeGenerator', 'packageId' => $packageId]);
            } else {
                $params['navigator'] = $this->getNavigator($page, $db->fetchScalar("SELECT COUNT(id) FROM package_codes WHERE used=0"), ['action' => 'goldPackageCodeGenerator', 'packageId' => $packageId]);
            }
        }
        Dispatcher::getInstance()->appendContent(Template::getInstance()->load($params, 'tpl/addPaymentCodeBatch.tpl')->getAsString());
    }

    private function previousPageNavigator($page, $num_rows, $prefix = [])
    {
        $text = self::PREVIOUS_SHAPE;
        $total_pages = ceil($num_rows / $this->pageSize);
        if (($page - 1) >= 1 && ($page - 1) <= $total_pages) {
            $prefix['p'] = --$page;
            $query = http_build_query($prefix);
            return '<a href="?' . $query . '">' . $text . '</a>';
        }
        return $text;
    }

    private function nextPageNavigator($page, $num_rows, $prefix = [])
    {
        $text = self::NEXT_SHAPE;
        $total_pages = ceil($num_rows / $this->pageSize);
        if ((1 + $page) <= $total_pages) {
            $prefix['p'] = ++$page;
            $query = http_build_query($prefix);
            return '<a href="?' . $query . '">' . $text . '</a>';
        }
        return $text;
    }

    private function getNavigator($page, $num_rows, $prefix = [])
    {
        return $this->previousPageNavigator($page, $num_rows, $prefix) . ' | ' . $this->nextPageNavigator($page, $num_rows, $prefix);
    }
}