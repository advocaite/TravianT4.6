<?php
/**
 * Created by PhpStorm.
 * User: Amirhossein CH
 * Date: 10/4/14
 * Time: 6:03 PM
 */

namespace Controller;

use Core\Config;
use Core\Database\DB;
use Core\Session;
use Core\Village;
use Game\Formulas;
use Game\Hero\SessionHero;
use Core\Locale;
use resources\View\GameView;
use resources\View\PHPBatchView;

class ProductionCtrl extends GameCtrl
{
    private $tabIndex;
    public  $productionFields = [];
    public  $bonusBuildings   = [5 => 0, 6 => 0, 7 => 0, 8 => 0, 9 => 0];
    public  $bonusPlus        = [0, 0, 0, 0];
    public  $oasesBonus       = ["count" => [0, 0, 0, 0], "bonus" => [0, 0, 0, 0]];
    public  $heroProd         = [0, 0, 0, 0];
    public  $boost            = [1 => [5], 2 => [6], 3 => [7], 4 => [8, 9],];

    public function __construct()
    {
        parent::__construct();
        if (Session::getInstance()->getRace() == 6) {
            $this->bonusBuildings[45] = 0;
            $this->boost = [1 => [5, 45], 2 => [6, 45], 3 => [7, 45], 4 => [8, 9, 45]];
        }
        $this->tabIndex = isset($_GET['t']) && is_numeric($_GET['t']) && $_GET['t'] > 0 && $_GET['t'] < 6 ? (int)$_GET['t'] : 1;
        $this->view = new GameView();
        $this->view->vars['titleInHeader'] = T("productionOverview", "productionOverview");
        $this->view->vars['bodyCssClass'] = 'perspectiveBuildings';
        $this->view->vars['contentCssClass'] = 'production';
        $view = new PHPBatchView("production/menu");
        $view->vars['tabIndex'] = $this->tabIndex;
        $this->view->vars['content'] .= $view->output();
        if ($this->tabIndex < 5) {
            $this->production();
            $view = new PHPBatchView("production/res");
            $view->vars['tabIndex'] = $this->tabIndex;
            $view->vars['boost'] = $this->boost;
            $view->vars['bonusBuilding'] = $this->bonusBuildings;
            $view->vars['oasesBonus'] = $this->oasesBonus;
            $view->vars['productionFields'] = $this->productionFields;
            $view->vars['bonusPlus'] = $this->bonusPlus;
            $view->vars['heroProd'] = $this->heroProd;
            $this->view->vars['content'] .= $view->output();
        } else {
            $this->tabIndex = 4;
            $this->production();
            $this->balance();
        }
    }

    private function balance()
    {
        $view = new PHPBatchView("production/balance");
        $view->vars['tabIndex'] = 4;
        $view->vars['boost'] = $this->boost;
        $view->vars['bonusBuilding'] = $this->bonusBuildings;
        $view->vars['oasesBonus'] = $this->oasesBonus;
        $view->vars['productionFields'] = $this->productionFields;
        $view->vars['bonusPlus'] = $this->bonusPlus;
        $view->vars['heroProd'] = $this->heroProd;
        $this->view->vars['content'] .= $view->output();
    }

    private function production()
    {
        $db = DB::getInstance();
        $village = Village::getInstance();
        for ($i = 1; $i <= 38; ++$i) {

            $field = $village->getField($i);

            if (!$field['level'] && $i > 18) {
                continue;
            }
            if ($i <= 18 && $field['item_id'] == $this->tabIndex) {
                $this->productionFields[] = [
                    "item_id" => $field['item_id'],
                    "level" => $field['level'],
                    "value" => Formulas::fieldProduction($field['level']),
                ];
            } else if (($field['item_id'] <= 9 || $field['item_id'] == 45) && in_array($field['item_id'], $this->boost[$this->tabIndex])) {
                $this->bonusBuildings[$field['item_id']] = $field['level'];
            }
        }
        if (Session::getInstance()->hasProductionBoost(1)) {
            $this->bonusPlus[0] += 25;
        }
        if (Session::getInstance()->hasProductionBoost(2)) {
            $this->bonusPlus[1] += 25;
        }
        if (Session::getInstance()->hasProductionBoost(3)) {
            $this->bonusPlus[2] += 25;
        }
        if (Session::getInstance()->hasProductionBoost(4)) {
            $this->bonusPlus[3] += 25;
        }
        $oases = $db->query("SELECT type FROM odata WHERE did=" . $village->getKid());
        while ($oasis = $oases->fetch_assoc()) {
            foreach (Formulas::getOasisEffect($oasis['type']) as $k => $v) {
                $this->oasesBonus['count'][$k - 1]++;
                $this->oasesBonus['bonus'][$k - 1] += $v * 25;
            }
        }
        $hero = $this->session->hero;
        if ($hero->hero['kid'] == Village::getInstance()->getKid() && $hero->getHeroHealth() > 0) {
            switch ($hero->hero['productionType']) {
                case 0:
                    for ($i = 0; $i <= 3; ++$i) {
                        $this->heroProd[$i] += (6 * $hero->hero['production'] * Config::getInstance()->heroConfig->resourcesMultiplier * (Session::getInstance()->getRace() == 6 ? 2 : 1));
                    }
                    $this->heroProd[3] += 6;
                    break;
                default:
                    $this->heroProd[$hero->hero['productionType'] - 1] += 20 * $hero->hero['production'] * Config::getInstance()->heroConfig->resourcesMultiplier * (Session::getInstance()->getRace() == 6 ? 2 : 1);
                    $this->heroProd[3] += 6;
                    break;
            }
        }
    }
} 