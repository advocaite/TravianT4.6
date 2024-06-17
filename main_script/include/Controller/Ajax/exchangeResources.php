<?php

namespace Controller\Ajax;

use Core\Config;
use Core\Session;
use Core\Village;
use resources\View\PHPBatchView;
use function array_sum;
use function is_numeric;

class exchangeResources extends AjaxBase
{
    public function dispatch()
    {
        if (isset($_POST['did']) && isset($_POST['desired']) && is_array($_POST['desired']) && sizeof($_POST['desired']) == 4) {
            $resObj = (array)$_POST['desired'];
            $current_resources = Village::getInstance()->getCurrentResources();
            if (!is_array($resObj) || !isset($resObj[0])) {
                $resObj = [0, 0, 0, 0];
            }
            $this->portionResourcesOut($resObj, $current_resources);
            $this->response['data']['distributed'] = $resObj;
            $this->response['data']['resources'] = $current_resources;
            return;
        }
        $values = isset($_POST['defaultValues']) ? $_POST['defaultValues'] : [];
        $defaultValues = [
            'tid'    => -1, //troop Id
            'nr'     => 0, //what???
            'btyp'   => 0, //building type
            'r1'     => 0, //wood
            'r2'     => 0, //c;ay
            'r3'     => 0, //iron
            'r4'     => 0, //crop
            'supply' => 0, //what???
            'pzeit'  => 0, //troop training time
            'max1'   => 3, //max length
            'max2'   => 5, //max length
            'max3'   => 2, //max length
            'max4'   => 21, //max length
            'max'    => 2, //max troops can be trained
            'npc'    => FALSE,
            'time'   => [
                'max' => '',//time needed ;)
            ],
        ];
        foreach ($values as $key => $value) {
            if (in_array($key,
                [
                    'r1',
                    'r2',
                    'r3',
                    'r4',
                    'supply',
                    'pzeit',
                    'max1',
                    'max2',
                    'max3',
                    'max4',
                    'max',
                    'btyp',
                    'nr',
                    'tid',
                ])) {
                $value = abs((int)$value);
            }
            $defaultValues[$key] = $value;
        }
        $currentResources = Village::getInstance()->getCurrentResources();
        $currentResourcesSum = array_sum($currentResources);
        $newSum = abs((int)($defaultValues['r1'] + $defaultValues['r2'] + $defaultValues['r3'] + $defaultValues['r4']));
        if ($newSum) {
            $remain = $currentResourcesSum - $newSum;
        } else {
            $remain = 0;
        }
        $view = new PHPBatchView("ajax/exchangeResources");
        $view->vars = [
            "defaultValues"       => $defaultValues,
            "currentResources"    => $currentResources,
            "kid"                 => Village::getInstance()->getKid(),
            "sessionChecker"      => Session::getInstance()->getChecker(),
            "currentResourcesSum" => $currentResourcesSum,
            "remainResources"     => $remain,
            "maxstore"            => Village::getInstance()->get("maxstore"),
            "maxcrop"             => Village::getInstance()->get("maxcrop"),
            "newSum"              => $newSum,
            "distributeButton"    => getButton([
                "type"    => 'button',
                "class"   => "gold",
                'value'   => T("npc", "distribute_remaining_resources"),
                'title'   => T("npc", "distribute_remaining_resources"),
                'onclick' => 'exchangeResources.distribute(' . Village::getInstance()->getKid() . ');',
            ],
                ['data' => ["type" => 'button'],],
                T("npc", "distribute_remaining_resources")),
            "redeemButton"        => getButton([
                "type"  => 'submit',
                "id"    => 'npc_market_button',
                "class" => "gold",
                'title' => T("npc", "redeem_now"),
                'value' => T("npc", "redeem_now"),
                "coins" => Config::getInstance()->gold->exchangeResourcesGold,
            ],
                [
                    "data" => [
                        "type"         => 'submit',
                        'wayOfPayment' => [
                            "featureKey"   => "marketplace",
                            "context"      => "",
                            "dataCallback" => "returnInputValues",
                        ],
                    ],
                ],
                T("npc", "redeem_now")),
        ];
        $this->response['data']['html'] = $view->output();
    }

    public function portionResourcesOut(&$resObj, &$current_resources)
    {
        $max_warehouse = Village::getInstance()->get("maxstore");
        $max_granny = Village::getInstance()->get("maxcrop");
        // Fixing overflow or underflow
        for ($i = 0; $i < 4; ++$i) {
            if (!isset($resObj[$i]) || !is_numeric($resObj[$i]))
                $resObj[$i] = 0;
            $max = $i == 3 ? $max_granny : $max_warehouse;
            if ($resObj[$i] < 0)
                $resObj[$i] = 0;
            else if ($resObj[$i] > $max)
                $resObj[$i] = $max;
        }
        $diff = array_sum($current_resources) - array_sum($resObj);
        for ($try = 0; $try <= 3 && $diff <> 0; ++$try) {
            $equal = floor(abs($diff) / 4);
            for ($i = 0; $i < 4; ++$i) {
                $max = $i == 3 ? $max_granny : $max_warehouse;
                if ($diff > 0) {
                    $free = min($max - $resObj[$i], $equal);
                    $resObj[$i] += $free;
                } else {
                    $free = min($resObj[$i], $equal);
                    $resObj[$i] -= $free;
                }
            }
            $diff = array_sum($current_resources) - array_sum($resObj);
        }
        // final check
        for ($i = 0; $i < 4 && $diff <> 0; ++$i) {
            $max = $i == 3 ? $max_granny : $max_warehouse;
            if ($diff > 0) {
                $free = min($max - $resObj[$i], abs($diff));
                $resObj[$i] += $free;
                $diff -= $free;
            } else {
                $free = min($resObj[$i], abs($diff));
                $resObj[$i] -= $free;
                $diff += $free;
            }
        }
    }
}