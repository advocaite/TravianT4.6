<?php

namespace Model;

use Core\Database\DB;
use Game\Formulas;
use Game\NoticeHelper;
use Game\ResourcesHelper;

class MarketPlaceProcessor
{
    public function processRow($row)
    {
        $this->deleteProcess($row['id']);
        if ($row['mode'] == 1) {
            $this->processReturn($row);
            return;
        }
        $this->processGo($row);
    }

    private function processGo($row)
    {
        $m = new AutomationModel();
        $sender = $m->getVillage($row['kid'], 'owner');
        if ($sender === false) {
            return;
        }
        $sender = $m->getUser($sender['owner'], 'id, reportFilters, name, race');
        $receiver = $m->getVillage($row['to_kid'], 'owner');
        if ($receiver === false) {
            return;
        }
        $receiver = $m->getUser($receiver['owner'], 'id, reportFilters, name, race');
        $resources = [
            1 => $row['wood'],
            $row['clay'],
            $row['iron'],
            $row['crop'],
        ];
        $report = [
            'sender' => [
                'uid' => $sender['id'],
                'uname' => $sender['name'],
                'kid' => $row['kid'],
            ],
            'receiver' => [
                'uid' => $receiver['id'],
                'uname' => $receiver['name'],
                'kid' => $row['kid'],
            ],
            'resources' => $resources,
            'timeTaken' => round(Formulas::getDistance($row['kid'], $row['to_kid']) / Formulas::merchantSpeed($sender['race']) * 3600),
        ];
        $reportType = [
            1 => NoticeHelper::TYPE_RESOURCES_MOST_WOOD,
            NoticeHelper::TYPE_RESOURCES_MOST_CLAY,
            NoticeHelper::TYPE_RESOURCES_MOST_IRON,
            NoticeHelper::TYPE_RESOURCES_MOST_CROP,
        ][array_search(max($resources), $resources)];
        $sender_reportFilters = explode(",", $sender['reportFilters']);
        if ($sender['id'] == $receiver['id']) {
            if ($sender_reportFilters[0] == 0) {
                NoticeHelper::addNotice(0, $sender['id'], $row['kid'], $row['to_kid'], $reportType, '', $report, $row['end_time']);
            }
        } else if ($sender_reportFilters[1] == 0) {
            NoticeHelper::addNotice(0, $sender['id'], $row['kid'], $row['to_kid'], $reportType, '', $report, $row['end_time']);
        }
        if ($sender['id'] != $receiver['id']) {
            MultiAccount::addMultiAccountLog($sender['id'], $receiver['id'], 1);
            $receiver_reportFilters = explode(",", $receiver['reportFilters']);
            if ($receiver_reportFilters[2] == 0) {
                NoticeHelper::addNotice(0, $receiver['id'], $row['kid'], $row['to_kid'], $reportType, '', $report, $row['end_time']);
            }
        }
        $db = DB::getInstance();
        $db->query("UPDATE vdata SET wood=wood+{$resources[1]}, clay=clay+{$resources[2]}, iron=iron+{$resources[3]}, crop=crop+{$resources[4]} WHERE kid={$row['to_kid']}");
        ResourcesHelper::updateVillageResources($row['to_kid']);
        $this->returnMerchants($row, $report['timeTaken']);
        $master = new MasterBuilder();
        $master->updateCommence($row['to_kid'], false);
    }

    private function returnMerchants($row, $timeTaken)
    {
        $this->insert($row['to_kid'], $row['kid'], $row['wood'], $row['clay'], $row['iron'], $row['crop'], $row['x'] - 1, 1, $row['end_time'] + $timeTaken);
    }

    private function insert($kid, $to_kid, $r1, $r2, $r3, $r4, $x2, $mode, $end_time)
    {
        $db = DB::getInstance();
        $db->query("INSERT INTO send (`kid`, `to_kid`, `wood`, `clay`, `iron`, `crop`, `x`, `mode`, `end_time`) VALUES ($kid, $to_kid, $r1, $r2, $r3, $r4,$x2, $mode, $end_time)");
    }

    private function deleteProcess($id)
    {
        $db = DB::getInstance();
        $db->query("DELETE FROM send WHERE id=$id");
    }

    private function processReturn($row)
    {
        if (!$row['x']) {
            return;
        }
        $m = new AutomationModel();
        ResourcesHelper::updateVillageResources($row['to_kid']);
        $res = $m->getVillage($row['to_kid'], 'owner, wood, clay, iron, crop');
        if ($res === false) {
            return;
        }
        $resources = array_map(function ($x) {
            return floor(max(0, $x));
        }, [
            1 => min($res['wood'], $row['wood']),
            min($res['clay'], $row['clay']),
            min($res['iron'], $row['iron']),
            max(min($res['crop'], $row['crop']), 0),
        ]);
        $speed = Formulas::merchantSpeed($m->getUser($res['owner'], 'race')['race']);
        $end_time = $row['end_time'] + round(Formulas::getDistance($row['kid'], $row['to_kid']) / $speed * 3600);
        DB::getInstance()->query("UPDATE vdata SET wood=wood-{$resources[1]}, clay=clay-{$resources[2]}, iron=iron-{$resources[3]}, crop=crop-{$resources[4]} WHERE kid={$row['to_kid']}");
        $this->insert($row['to_kid'], $row['kid'], $resources[1], $resources[2], $resources[3], $resources[4], $row['x'], 0, $end_time);
        $master = new MasterBuilder();
        $master->updateCommence($row['to_kid'], false, false);
    }
}