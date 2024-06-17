<?php

namespace Controller\Ajax;

use function array_key_exists;
use Core\Caching\Caching;
use Core\Database\DB;
use Core\Session;
use Game\Hero\SessionHero;
use Game\ResourcesHelper;
use Model\Quest;
use Model\VillageModel;

class heroSetAttributes extends AjaxBase
{
    private $attackBehaviours = ["hide", "fight"];

    public function dispatch()
    {
        if (!isset($_POST['resource'], $_POST['attackBehaviour'])) return;
        $attackBehaviour = filter_var($_POST['attackBehaviour'], FILTER_SANITIZE_STRING);
        $resource = abs((int)$_POST['resource']);
        $villageModel = new VillageModel();
        if (isset($_POST['attributes']) && is_array($_POST['attributes']) && sizeof($_POST['attributes'])) {
            $attributes = (array)$_POST['attributes'];

            if (
                !array_key_exists('power', $attributes) ||
                !array_key_exists('offBonus', $attributes) ||
                !array_key_exists('defBonus', $attributes) ||
                !array_key_exists('productionPoints', $attributes)

            ) {
                $this->error('Incomplete data.');
                return;
            }
            if(!isset($this->session->hero->hero)){
                return;
            }
            $hero = $this->session->hero->hero;
            
            $totalPointSend = ($attributes['power'] + $attributes['offBonus'] + $attributes['defBonus'] + $attributes['productionPoints']);
            if ($totalPointSend <= $this->session->hero->getAvailablePoints() && $totalPointSend > 0) {
                Quest::getInstance()->setQuestBitwise('battle', 4, 1);

                $attributes['power'] = (int)$attributes['power'];
                $attributes['offBonus'] = (int)$attributes['offBonus'];
                $attributes['defBonus'] = (int)$attributes['defBonus'];
                $attributes['productionPoints'] = (int)$attributes['productionPoints'];

                if ($attributes['power'] + $hero['power'] > 100) {
                    $attributes['power'] = 100 - $hero['power'];
                }
                if ($attributes['offBonus'] + $hero['offBonus'] > 100) {
                    $attributes['offBonus'] = 100 - $hero['offBonus'];
                }
                if ($attributes['defBonus'] + $hero['defBonus'] > 100) {
                    $attributes['defBonus'] = 100 - $hero['defBonus'];
                }
                if ($attributes['productionPoints'] + $hero['production'] > 100) {
                    $attributes['productionPoints'] = 100 - $hero['production'];
                }

                $db = DB::getInstance();
                $db->query("UPDATE hero SET
                power=power+{$attributes['power']},
                offBonus=offBonus+{$attributes['offBonus']},
                defBonus=defBonus+{$attributes['defBonus']},
                production=production+{$attributes['productionPoints']}
                  WHERE uid=" . Session::getInstance()->getPlayerId());
                if ($attributes['productionPoints']) {
                    ResourcesHelper::updateVillageResources($hero['kid'], FALSE);
                }
                $this->removeCache();
            }
        }
        if (!empty($attackBehaviour) && $resource >= 0 AND $resource <= 4) {
            if ($resource == 2) {
                $quest = Quest::getInstance();
                if ($quest->getTutorial() == '6-1') {
                    $quest->setTutorial("6-2");
                }
            }
            if (!in_array($attackBehaviour, $this->attackBehaviours)) {
                $this->error('attackBehaviour is not valid.');
                return;
            }
            if ($resource < 0 || $resource > 4) {
                $this->error('resource is not valid');
                return;
            }
            $this->response['data']['tooltip'] = $this->session->hero->getHeroProductionTitle(TRUE);
            $db = DB::getInstance();
            $db->query("UPDATE hero SET productionType=$resource, hide=" . ($attackBehaviour == "hide" ? 1 : 0) . " WHERE uid=" . Session::getInstance()->getPlayerId());
            ResourcesHelper::updateVillageResources($this->session->hero->hero['kid'], FALSE);
            $this->removeCache();
        }
        $this->response['reload'] = TRUE;
    }

    private function removeCache()
    {
        $session = Session::getInstance();
        $cache = Caching::getInstance();
        $cache->delete("hero_sidebar_{$session->getPlayerId()}");
    }
} 