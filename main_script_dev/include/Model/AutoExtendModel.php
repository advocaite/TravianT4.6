<?php

namespace Model;

use Core\Config;
use Core\Database\DB;
use Core\ErrorHandler;
use Game\GoldHelper;

class AutoExtendModel
{
    public function processAutoExtend()
    {
        $config = Config::getInstance();
        $db = DB::getInstance();
        $timeMinimum = ceil(Config::getInstance()->gold->plusAccountDurationSeconds / 7);
        $m = new InfoBoxModel();
        $time = time() - 3600;
        $village = new VillageModel();
        $now = time();
        $result = $db->query("SELECT * FROM autoExtend WHERE finished=0 AND lastChecked < " . $time . " AND commence <= " . (time() + $timeMinimum) . " AND IF(enabled=0, commence < $now, true) ORDER BY lastChecked ASC LIMIT 100");
        while ($row = $result->fetch_assoc()) {
            if ($row['commence'] < $now) {
                $db->query("DELETE FROM autoExtend WHERE id={$row['id']}");
                if ($row['type'] > 1) {
                    $village->updateUserVillageResources($row['uid'], true);
                }
                continue;
            }
            $db->query("UPDATE autoExtend SET lastChecked=" . time() . " WHERE id={$row['id']}");
            $user = $db->query("SELECT (gift_gold+bought_gold) as `gold` FROM users WHERE id={$row['uid']}")->fetch_assoc();
            if ($row['type'] == 1) {
                if ($user['gold'] >= $config->gold->plusGold) {
                    $this->extendPlus($row['uid'], $row['commence']);
                } else {
                    if (!$m->hasInfoByType($row['uid'], $row['type'])) {
                        $m->addInfo($row['uid'], 0, $row['type'], '', $row['commence'] - 86400, $row['commence'] + 86400);
                    }
                }
            } else if ($row['type'] <= 5) {
                if ($user['gold'] >= $config->gold->productionBoostGold) {
                    $this->extendProductionBoost($row['uid'], $row['type'] - 1, $row['commence']);
                } else {
                    if (!$m->hasInfoByType($row['uid'], $row['type'])) {
                        $m->addInfo($row['uid'], 0, $row['type'], '', $row['commence'] - 86400, $row['commence'] + 86400);
                    }
                }
            }
        }
    }

    private function set($uid, $type, $commence, $enabled)
    {
        $enabled = $enabled ? 1 : 0;
        $db = DB::getInstance();
        $id = $db->fetchScalar("SELECT id FROM autoExtend WHERE type=$type AND uid=$uid");
        $finished = $commence < time() ? 1 : 0;
        if ($id) {
            $db->query("UPDATE autoExtend SET lastChecked=0, finished=$finished, commence=$commence, enabled=$enabled WHERE id=$id");
        } else {
            $db->query("INSERT INTO autoExtend (uid, type, commence, enabled, finished) VALUES ($uid, $type, $commence, $enabled, $finished)");
        }
    }

    private function extendPlus($uid, $now, $till = NULL)
    {
        $config = Config::getInstance();
        if (is_null($till)) {
            $till = $config->gold->plusAccountDurationSeconds;
        }
        $db = DB::getInstance();
        if (GoldHelper::decreaseGold($uid, $config->gold->plusGold)) {
            $showTo = $now + $till;
            $db->query("UPDATE users SET plus={$showTo} WHERE id={$uid}");
            $m = new InfoBoxModel();
            $m->deleteInfoByType($uid, 1);
            $this->set($uid, 1, $showTo, 1);
        }
    }

    private function extendProductionBoost($uid, $resourceId, $now, $till = NULL)
    {
        $config = Config::getInstance();
        if (is_null($till)) {
            $till = $config->gold->productionBoostDurationSeconds;
        }
        $db = DB::getInstance();
        if (GoldHelper::decreaseGold($uid, $config->gold->productionBoostGold)) {
            $showTo = $now + $till;
            $db->query("UPDATE users SET b" . ($resourceId) . "=" . $showTo . " WHERE id=$uid");
            $m = new InfoBoxModel();
            $m->deleteInfoByType($uid, 1 + $resourceId);
            $this->set($uid, 1 + $resourceId, $showTo, 1);
        }
    }

    public function setAutoExtendState($uid, $type, $result, $endTime)
    {
        $uid = (int)$uid;
        $type = (int)$type;
        $m = new InfoBoxModel();
        $m->deleteInfoByType($uid, $type);
        if (!$result) {
            $m->addInfo($uid, 0, $type, '', $endTime - 86400, $endTime + 86400);
        }
        $this->set($uid, $type, $endTime, $result);
    }

    public function hasAutoExtend($uid, $type)
    {
        $db = DB::getInstance();
        $uid = (int)$uid;
        $type = (int)$type;
        return (int)$db->fetchScalar("SELECT COUNT(id) FROM autoExtend WHERE uid=$uid AND type=$type AND enabled=1") >= 1;
    }
}