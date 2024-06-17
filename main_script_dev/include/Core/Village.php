<?php

namespace Core;

use Core\Database\DB;
use Core\Database\DBI;
use Core\Helper\TimezoneHelper;
use Core\Helper\WebService;
use Game\Buildings\BuildingAction;
use Game\Buildings\BuildingHelper;
use Game\Formulas;
use Game\ResourcesHelper;
use Game\Starvation;
use Model\AccountDeleter;
use Model\MasterBuilder;
use Model\Quest;
use PDO;
use function get_random_string;
use function logError;
use function miliseconds;
use function number_format_x;
use function uniqid;

class Village
{
    private static $_self;
    public $onLoadBuildings = ['normal' => [], 'master' => []];
    public $buildings = [];
    public $village = [];
    public $demolitionTasks = null;
    public $cropLoading = 0;
    public $cropLoadingMaster = 0;
    public $workers = [
        'buildsNum' => 0,
        'fieldsNum' => 0,
        'master' => 0,
        'WW' => 0,
    ];
    public $specialBuildingsLvl = [
        "Barracks" => 0,
        "Stable" => 0,
        "Workshop" => 0,
        "Marketplace" => 0,
        "MainBuilding" => 0,
        "HorseDrinkingPool" => 0,
        "RallyPoint" => 0,
        "GrainMill" => 0,
        "Bakery" => 0,
        "Sawmill" => 0,
        "Brickyard" => 0,
        'Residence' => 0,
        'Palace' => 0,
        'CommandCenter' => 0,
        "IronFoundry" => 0,
        "Trapper" => [],
        "Cranny" => [],
    ];
    public $specialBuildingsName = [
        5 => 'Sawmill',
        6 => 'Brickyard',
        7 => 'IronFoundry',
        8 => 'GrainMill',
        9 => 'Bakery',
        15 => 'MainBuilding',
        17 => 'Marketplace',
        19 => 'Barracks',
        20 => 'Stable',
        21 => 'Workshop',
        23 => 'Cranny',
        36 => 'Trapper',
        41 => 'HorseDrinkingPool',
        25 => 'Residence',
        26 => 'Palace',
        44 => 'CommandCenter',
    ];
    /** @var \Game\Buildings\BuildingHelper */
    private $helper;
    private $isSupport = false;
    private $db;
    private $session;

    public function __construct($session = null)
    {
        $this->session = $session ? $session : Session::getInstance();
        $this->db = DBI::getInstance();
        $this->helper = new BuildingHelper();

        if (!$this->setBasics()) {
            if (!isset($_GET['refreshBasics'])) {
                redirect("dorf1.php?refreshBasics");
            }
            exit();
        }

        $now = miliseconds();
        $elapsedTime = $now - $this->village['lastmupdate'];
        $this->village['wood'] = min($this->village['wood'] + $elapsedTime * $this->village['woodp'] / 3600000, $this->village['maxstore']);
        $this->village['clay'] = min($this->village['clay'] + $elapsedTime * $this->village['clayp'] / 3600000, $this->village['maxstore']);
        $this->village['iron'] = min($this->village['iron'] + $elapsedTime * $this->village['ironp'] / 3600000, $this->village['maxstore']);
        $this->village['crop'] = min($this->village['crop'] + $elapsedTime * ($this->village['cropp'] - $this->village['pop'] - $this->village['upkeep']) / 3600000, $this->village['maxcrop']);
        $this->village['lastmupdate'] = $now;

        $this->populateBuildings();
        $this->populateOnLoadBuildings();
        $this->populateDemolishTasks();
    }

    private function setBasics()
    {
        $this->isSupport = $this->session->getPlayerId() == 0;
        if ($this->isSupport) {
            exit();
        }
        new Starvation($this->session->getKid());
        $this->village = $this->db->fetchSingleRow("SELECT * FROM vdata WHERE kid=?", (int)$this->session->getKid());
        // Apply fix when village does not exists (kid invalid)
        if (!$this->village) {
            $this->session->data['kid'] = $this->db->fetchScalar("SELECT kid FROM vdata WHERE owner=? ORDER BY pop DESC LIMIT 1", (int)$this->session->getPlayerId());
            $_SESSION[$this->session->fixSessionPrefix("kid")] = $this->session->data['kid'];
            $this->db->run("UPDATE users SET kid=? WHERE id=?", [
                $this->session->getKid(),
                $this->session->getPlayerId(),
            ]);
            $this->village = $this->db->fetchSingleRow("SELECT * FROM vdata WHERE kid=?", (int)$this->session->getKid());
        }
        return $this->village !== false;
    }

    private function populateBuildings()
    {
        if ($this->isSupport) {
            return;
        }
        $quest = Quest::getInstance();
        $buildings = $this->db->fetchSingleRow("SELECT * FROM fdata WHERE kid=?", (int)$this->getKid());
        if (!$buildings) {
            logError('Field data not found for village %s, Fixing...', [$this->getKid()]);
            (new AccountDeleter())->deleteVillage($this->getKid());
            WebService::redirect("dorf1.php");
            exit();
        }
        $specialKeys = array_keys($this->specialBuildingsName);
        $resources_levels = [];
        $resource_levels = [1 => [], 2 => [], 3 => [], 4 => []];
        for ($i = 1; $i <= 41; ++$i) {
            if ($i == 41) {
                $i = 99;
            }
            $this->buildings[$i] = [
                "item_id" => (int)$buildings['f' . $i . 't'],
                "level" => (int)$buildings['f' . $i],
                "upgrade_state" => 0,
                "demolition_state" => 0,
            ];
            if (in_array($this->buildings[$i]['item_id'], $specialKeys)) {
                $this->setSpecialBuildingLevel($this->specialBuildingsName[$this->buildings[$i]['item_id']],
                    $this->buildings[$i]['level']);
            }
            if (($quest->getTutorial() == '8-1' || $quest->getTutorial() == '8-0') &&
                $this->buildings[$i]['item_id'] == 10 && $this->buildings[$i]['level'] >= 0) {
                $quest->setTutorial("8-2");
            }
            if (($quest->getTutorial() == '9-1' || $quest->getTutorial() == '9-0') &&
                $this->buildings[$i]['item_id'] == 16 && $this->buildings[$i]['level'] >= 0) {
                $quest->setTutorial("9-2");
            }
            if (($quest->getTutorial() == '3-1' || $quest->getTutorial() == '3-0') &&
                $this->buildings[$i]['item_id'] == 1 && $this->buildings[$i]['level'] >= 1) {
                $quest->setTutorial("3-2");
            }
            if (($quest->getTutorial() == '4-1' || $quest->getTutorial() == '4-0') &&
                $this->buildings[$i]['item_id'] == 1 && $this->buildings[$i]['level'] >= 2) {
                $quest->setTutorial("4-2");
            }
            if (($quest->getTutorial() == '5-1' || $quest->getTutorial() == '5-0') &&
                $this->buildings[$i]['item_id'] == 4 && $this->buildings[$i]['level'] >= 1) {
                $quest->setTutorial("5-2");
            }
            if ($this->buildings[$i]['item_id'] == 3 && $this->buildings[$i]['level'] >= 1) {
                $quest->setQuestBitwise('economy', 1, 1);
            }
            if ($this->buildings[$i]['item_id'] == 23 && $this->buildings[$i]['level'] >= 1) {
                $quest->setQuestBitwise('battle', 2, 1);
            }
            if ($this->buildings[$i]['item_id'] == 19 && $this->buildings[$i]['level'] >= 3) {
                $quest->setQuestBitwise('battle', 10, 1);
            }
            if ($this->buildings[$i]['item_id'] == 22 && $this->buildings[$i]['level'] >= 1) {
                $quest->setQuestBitwise('battle', 11, 1);
            }
            if ($this->buildings[$i]['item_id'] == 13 && $this->buildings[$i]['level'] >= 0) {
                $quest->setQuestBitwise('battle', 13, 1);
            }
            if (in_array($this->buildings[$i]['item_id'], [31, 32, 33, 42, 43]) && $this->buildings[$i]['level'] == 1) {
                $quest->setQuestBitwise('battle', 6, 1);
            }
            if ($this->buildings[$i]['item_id'] == 11 && $this->buildings[$i]['level'] >= 1) {
                $quest->setQuestBitwise('economy', 3, 1);
            }
            if ($this->buildings[$i]['item_id'] == 17 && $this->buildings[$i]['level'] >= 1) {
                $quest->setQuestBitwise('economy', 6, 1);
            }
            if ($this->buildings[$i]['item_id'] == 8 && $this->buildings[$i]['level'] >= 1) {
                $quest->setQuestBitwise('economy', 11, 1);
            }
            if ($this->buildings[$i]['item_id'] == 18 && $this->buildings[$i]['level'] >= 1) {
                $quest->setQuestBitwise('world', 4, 1);
            }
            if (in_array($this->buildings[$i]['item_id'], [25, 26, 44]) && $this->buildings[$i]['level'] >= 1) {
                $quest->setQuestBitwise('world', 10, 1);
            }
            if ($this->buildings[$i]['item_id'] == 10 && $this->buildings[$i]['level'] >= 3) {
                $quest->setQuestBitwise('economy', 9, 1);
            }
            if ($this->buildings[$i]['item_id'] == 11 && $this->buildings[$i]['level'] >= 3) {
                $quest->setQuestBitwise('economy', 10, 1);
            }
            if ($this->buildings[$i]['item_id'] == 15 && $this->buildings[$i]['level'] >= 3) {
                $quest->setQuestBitwise('world', 3, 1);
            }
            if ($this->buildings[$i]['item_id'] == 15 && $this->buildings[$i]['level'] >= 5) {
                $quest->setQuestBitwise('world', 9, 1);
            }
            if ($this->buildings[$i]['item_id'] == 10 && $this->buildings[$i]['level'] >= 7) {
                $quest->setQuestBitwise('world', 12, 1);
            }
            if ($this->buildings[$i]['level'] >= 10 && in_array($this->buildings[$i]['item_id'], [25, 26, 44])) {
                $quest->setQuestBitwise('world', 14, 1);
            }
            if ($this->buildings[$i]['level'] > 0 && $this->buildings[$i]['item_id'] == 12) {
                $quest->setQuestBitwise('economy', 3, Quest::QUEST_FINISHED);
            }
            if ($this->buildings[$i]['level'] > 0 && $this->buildings[$i]['item_id'] == 23) {
                $quest->setQuestBitwise('battle', 2, Quest::QUEST_FINISHED);
            }
            if ($this->buildings[$i]['level'] > 0 && $this->buildings[$i]['item_id'] == 13) {
                $quest->setQuestBitwise('battle', 13, Quest::QUEST_FINISHED);
            }
            if ($this->buildings[$i]['level'] > 0 && $this->buildings[$i]['item_id'] == 19) {
                $quest->setQuestBitwise('battle', 3, Quest::QUEST_FINISHED);
            }
            if ($this->buildings[$i]['level'] > 0 && $this->buildings[$i]['item_id'] >= 31 && $this->buildings[$i]['item_id'] <= 33) {
                $quest->setQuestBitwise('battle', 5, Quest::QUEST_FINISHED);
            }
            if ($i <= 18) {
                $resources_levels[$i] = $this->buildings[$i]['level'];
                $resource_levels[$this->buildings[$i]['item_id']][] = $this->buildings[$i]['level'];
            }
        }
        if ($quest->getQuest("economy", 2) == 0) {
            //One of each to level 1
            $count1 = [
                sizeof(array_filter($resource_levels[1],
                    function ($x) {
                        return $x >= 1;
                    })),
                sizeof(array_filter($resource_levels[2],
                    function ($x) {
                        return $x >= 1;
                    })),
                sizeof(array_filter($resource_levels[3],
                    function ($x) {
                        return $x >= 1;
                    })),
                sizeof(array_filter($resource_levels[4],
                    function ($x) {
                        return $x >= 1;
                    })),
            ];
            if (array_sum($count1) >= 4) {
                $quest->setQuestBitwise("economy", 2, 1);
            }
        }
        if ($quest->getQuest("economy", 5) == 0) {
            //One of each to level 2
            $count2 = [
                sizeof(array_filter($resource_levels[1],
                    function ($x) {
                        return $x >= 2;
                    })),
                sizeof(array_filter($resource_levels[2],
                    function ($x) {
                        return $x >= 2;
                    })),
                sizeof(array_filter($resource_levels[3],
                    function ($x) {
                        return $x >= 2;
                    })),
                sizeof(array_filter($resource_levels[4],
                    function ($x) {
                        return $x >= 2;
                    })),
            ];
            if (array_sum($count2) >= 4) {
                $quest->setQuestBitwise("economy", 5, 1);
            }
        }
        $minResourceLevel = min($resources_levels);
        if ($quest->getQuest("economy", 4) == 0 && $minResourceLevel == 1) {
            $quest->setQuestBitwise("economy", 4, 1);
        }
        if ($quest->getQuest("economy", 8) == 0 && $minResourceLevel == 2) {
            $quest->setQuestBitwise("economy", 8, 1);
        }
        if ($quest->getQuest("economy", 12) == 0 && $minResourceLevel == 5) {
            $quest->setQuestBitwise("economy", 12, 1);
        }
    }

    public function getKid()
    {
        return $this->get("kid") == '' ? 0 : $this->get("kid");
    }

    public function get($name)
    {
        if (!array_key_exists($name, $this->village)) {
            return null;
        }

        return $this->village[$name];
    }

    private function setSpecialBuildingLevel($name, $level)
    {
        if ($name == 'Cranny' || $name == 'Trapper') {
            $this->specialBuildingsLvl[$name][] = $level;
        } else {
            $this->specialBuildingsLvl[$name] = $level;
        }
    }

    private function populateOnLoadBuildings()
    {
        if ($this->isSupport) {
            return;
        }
        $onLoadBuildings = $this->db->run("SELECT * FROM building_upgrade WHERE kid=? ORDER BY commence ASC", [(int)$this->getKid()]);
        $tmp = [];
        while ($building = $onLoadBuildings->fetch(PDO::FETCH_ASSOC)) {
            $this->onLoadBuildings[$building['isMaster'] ? 'master' : 'normal'][$building['id']] = $building;
            $row =& $this->onLoadBuildings[$building['isMaster'] ? 'master' : 'normal'][$building['id']];
            if (!isset($tmp[$row['building_field']])) {
                $tmp[$row['building_field']] = 0;
            }
            ++$tmp[$row['building_field']];
            $lvl = $this->getField($row['building_field'])['level'] + $tmp[$row['building_field']];
            if ($row['isMaster']) {
                ++$this->workers['master'];
                $this->cropLoadingMaster += Formulas::buildingCropConsumption($this->getField($row['building_field'])['item_id'],
                    $lvl);
                continue;
            } else {
                $this->cropLoading += Formulas::buildingCropConsumption($this->getField($row['building_field'])['item_id'],
                    $lvl);
            }
            if ($this->getField($row['building_field'])['item_id'] == 40) {
                ++$this->workers['WW'];
            }
            ++$this->workers[$this->getField($row['building_field'])['item_id'] <= 4 ? 'fieldsNum' : 'buildsNum'];
            ++$this->buildings[$row['building_field']]['upgrade_state'];
        }
    }

    public function getField($field)
    {
        return !isset($this->buildings[$field]) ? false : $this->buildings[$field];
    }

    private function populateDemolishTasks()
    {
        if ($this->isSupport) {
            return;
        }
        $this->demolitionTasks = $this->db->fetchSingleRow("SELECT * FROM demolition WHERE kid={$this->getKid()}");
        if (!$this->demolitionTasks) {
            $this->demolitionTasks = null;
            return;
        }
        ++$this->buildings[$this->demolitionTasks['building_field']]['demolition_state'];
    }

    public static function getInstance()
    {
        if (!(self::$_self instanceof self)) {
            self::$_self = new self();
        }
        return self::$_self;
    }

    public function getCP()
    {
        return $this->get("cp");
    }

    public function getFieldType()
    {
        return $this->get("fieldtype");
    }

    public function calculateResourcesTotalBonusProduction($k)
    {
        if ($this->isSupport) {
            return;
        }
        $percent = 0;
        $oases = [];
        switch ($k) {
            case 1:
                $percent += ($this->specialBuildingsLvl['Sawmill']) * 5;
                $oases = [1, 2, 3];
                break;
            case 2:
                $percent += ($this->specialBuildingsLvl['Brickyard']) * 5;
                $oases = [4, 5, 6];
                break;
            case 3:
                $percent += ($this->specialBuildingsLvl['IronFoundry']) * 5;
                $oases = [7, 8, 9];
                break;
            case 4:
                $percent += ($this->specialBuildingsLvl['GrainMill']) * 5;
                $percent += ($this->specialBuildingsLvl['Bakery']) * 5;
                $oases = [3, 6, 9, 10, 11];
                break;
        }
        if (sizeof($oases)) {
            $oasesString = implode(",", $oases);
            $types = $this->db->fetchPluck("SELECT type FROM odata WHERE did=? AND type IN($oasesString) LIMIT 3",
                [$this->getKid()]);
            foreach ($types as $type) {
                $effect = Formulas::getOasisEffect($type);
                if (isset($effect[$k])) $percent += $effect[$k] * 25;
            }
        }
        return $percent;
    }

    public function getCrannyLvls()
    {
        return $this->specialBuildingsLvl['Cranny'];
    }

    public function getTrapperLvls()
    {
        return $this->specialBuildingsLvl['Trapper'];
    }

    public function hasMarketPlace()
    {
        return $this->specialBuildingsLvl['Marketplace'];
    }

    public function hasWorkshop()
    {
        return $this->specialBuildingsLvl['Workshop'];
    }

    public function hasStable()
    {
        return $this->specialBuildingsLvl['Stable'];
    }

    public function hasBarracks()
    {
        return $this->specialBuildingsLvl['Barracks'];
    }

    public function getPop()
    {
        return $this->get("pop");
    }

    public function getHorseDrinkingPoolLvl()
    {
        return $this->specialBuildingsLvl['HorseDrinkingPool'];
    }

    public function getCelebration()
    {
        return $this->village['celebration'];
    }

    public function getFestival()
    {
        return $this->village['festival'];
    }

    public function setCelebration($value)
    {
        $this->village['celebration'] = $value;
    }

    public function setFestival($value)
    {
        $this->village['festival'] = $value;
    }

    public function getCelebrationType()
    {
        return $this->village['type'];
    }

    public function setCelebrationType($type)
    {
        $this->village['type'] = $type;
    }

    public function getChecker()
    {
        if (getCustom("useSessionCheckerInsteadOfDB")) {
            if (isset($_SESSION[WebService::fixSessionPrefix("VSESS_KEY")]) && !empty($_SESSION[WebService::fixSessionPrefix("VSESS_KEY")])) {
                return $_SESSION[WebService::fixSessionPrefix("VSESS_KEY")];
            } else {
                $this->changeChecker();
            }
            return $_SESSION[WebService::fixSessionPrefix("VSESS_KEY")];
        }
        if (empty($this->village['checker'])) {
            $this->changeChecker();
        }
        //village session key
        return $this->village['checker'];
    }

    public function changeChecker()
    {
        if (getCustom("useSessionCheckerInsteadOfDB")) {
            $_SESSION[WebService::fixSessionPrefix("VSESS_KEY")] = substr(sha1(uniqid() . miliseconds() . get_random_string(10)),
                0,
                mt_rand(6, 9));
            return;
        }
        //village session key
        $this->village['checker'] = substr(sha1(uniqid() . miliseconds() . get_random_string(10)), 0, mt_rand(6, 9));
        $this->db->run("UPDATE vdata SET checker=? WHERE kid=?", [$this->getChecker(), $this->getKid()]);
    }

    public function getDemolishTask()
    {
        return $this->demolitionTasks;
    }

    public function setDemolishTask($value)
    {
        $this->demolitionTasks = $value;
    }

    public function setCapital($value)
    {
        $this->village['capital'] = $value;
    }

    public function getTypeLevel($gid)
    {
        if ($this->isSupport) {
            return;
        }
        if ($gid == 16) {
            return [$this->buildings[39]['level']];
        }
        $lvl = [];
        if ($gid <= 4) {
            for ($i = 1; $i <= 18; ++$i) {
                if ($this->getField($i)['item_id'] == $gid) {
                    $lvl[] = $this->getField($i)['level'];
                }
            }
            if (!sizeof($lvl)) {
                $lvl[] = 0;
            }

            return $lvl;
        }
        $multi = false;
        if (isset(Formulas::$data['buildings'][$gid - 1]['req']) && isset(Formulas::$data['buildings'][$gid - 1]['req']['multi'])) {
            $multi = Formulas::$data['buildings'][$gid - 1]['req']['multi'] == 'true';
        }
        for ($i = 19; $i <= 40; ++$i) {
            if ($this->getField($i)['item_id'] == $gid) {
                $lvl[] = $this->getField($i)['level'];
                if (!$multi) {
                    break;
                }
            }
        }
        if (!sizeof($lvl)) {
            $lvl[] = 0;
        }

        return $lvl;
    }

    public function isCapital()
    {
        if ($this->isSupport) {
            return null;
        }

        return $this->village['capital'] == 1;
    }

    public function findBuildingByGid($gid)
    {
        if (!is_numeric($gid)) {
            return false;
        }

        if (!isset($this->buildings[20]['item_id'])) {
            logError('Incomplete buildings for village %s', [$this->getKid()]);
            return 0;
        }

        if ($gid <= 4) {
            for ($i = 1; $i <= 18; ++$i) {
                if ($this->buildings[$i]['item_id'] == $gid) {
                    return $i;
                }
            }

            return 0;
        }
        for ($i = 19; $i <= 40; ++$i) {
            if ($this->buildings[$i]['item_id'] == $gid) {
                return $i;
            }
        }

        return 0;
    }

    public function getFieldTitleAsString($field)
    {
        $title = $this->getFieldTitle($field);
        return $title['newTitle'] . '||' . $title['newText'];
    }

    public function getFieldTitle($field)
    {
        $field = (int)$field;
        $building = $this->getField($field);
        if (!$building || ($field == 21 && $this->isWW())) {
            return ['newTitle' => null, 'newText' => null];
        }
        if ((int)$building['item_id'] == 0) {
            if ($field == 39) {
                return ['newTitle' => null, 'newText' => T("Buildings", "buildingSites.rallyPoint")];
            }
            if ($field == 99 && $this->isWW()) {
                return ['newTitle' => null, 'newText' => T("Buildings", "buildingSites.WorldWonder")];
            } else {
                return ['newTitle' => null, 'newText' => T("Buildings", "buildingSites.building")];
            }
            //free site of rally point or wall or ww
        }
        $data = ['newTitle' => null, 'newText' => null];
        $data['newTitle'] = T("Buildings", "{$building['item_id']}.title") . '&nbsp;<span class="level">' . T("Buildings", "level") . ' ' . $building['level'] . '</span>';
        $HTML = &$data['newText'];
        $maxLevel = Formulas::buildingMaxLvl($building['item_id'], $this->isCapital());
        if ($building['upgrade_state'] == 0) {
            if ($building['level'] >= $maxLevel) { //building has reached max
                $HTML .= '<span class="notice">' . T("Buildings", "{$building['item_id']}.title") . ' ' . T("Buildings", "upgradeNotices.reachedMaxLvL") . '</span>';
            } else { //show up level
                $cost = Formulas::buildingUpgradeCosts($building['item_id'], $building['level'] + 1);
                $lang = T("Buildings", "upgradeNotices.upCostsToLevel") . ' ' . ($building['level'] + 1) . ':';
                foreach ($cost as &$r) {
                    $r = number_format_x($r);
                }
                $HTML .= <<<HTML
                {$lang}
                <br />
	            <div class="inlineIconList resourceWrapper">
                    <div class="inlineIcon resources" title="">
                        <i class="r1"></i><span class="value ">{$cost[0]}</span>
                    </div>
                    <div class="inlineIcon resources" title="">
                        <i class="r2"></i>
                        <span class="value ">{$cost[1]}</span>
                    </div>
                    <div class="inlineIcon resources" title="">
                        <i class="r3"></i>
                        <span class="value ">{$cost[2]}</span>
                    </div>
	                <div class="inlineIcon resources" title="">
	                    <i class="r4"></i>
	                    <span class="value ">{$cost[3]}</span>
	                </div>
	            </div>
HTML;
            }

            return $data;
        }
        $k = 1;
        do {
            if ($building['level'] + $k < $maxLevel) {
                $HTML .= '<span class="notice">' . sprintf(T("Buildings", "upgradeNotices.currentlyUpgradingToLevel"), $building['level'] + $k) . '</span>';
            } else {
                $HTML .= '<span class="notice">' . sprintf(T("Buildings", "upgradeNotices.currentlyReachingMaxLevel"), T("Buildings", "{$building['item_id']}.title")) . '</span>';
            }
            if ($k <= $building['upgrade_state']) {
                $HTML .= "<br />";
            }
            ++$k;
        } while ($k <= $building['upgrade_state']);
        if ($building['level'] + $building['upgrade_state'] < $maxLevel) {
            $cost = Formulas::buildingUpgradeCosts($building['item_id'],
                $building['level'] + $building['upgrade_state'] + 1);
            $lang = T("Buildings",
                    "upgradeNotices.upCostsToLevel") . ' ' . ($building['level'] + $building['upgrade_state'] + 1) . ':';
            foreach ($cost as &$r) {
                $r = number_format_x($r);
            }
            $HTML .= <<<HTML
                {$lang}
                <br />
	            <div class="inlineIconList resourceWrapper">
                    <div class="inlineIcon resources" title="">
                        <i class="r1"></i><span class="value ">{$cost[0]}</span>
                    </div>
                    <div class="inlineIcon resources" title="">
                        <i class="r2"></i>
                        <span class="value ">{$cost[1]}</span>
                    </div>
                    <div class="inlineIcon resources" title="">
                        <i class="r3"></i>
                        <span class="value ">{$cost[2]}</span>
                    </div>
	                <div class="inlineIcon resources" title="">
	                    <i class="r4"></i>
	                    <span class="value ">{$cost[3]}</span>
	                </div>
	            </div>
HTML;
        }
        return $data;
    }

    public function isWW()
    {
        if ($this->isSupport) {
            return null;
        }

        return $this->village['isWW'] == 1;
    }

    public function upgradeBuilding($field, $isMaster)
    {
        if ($this->session->isInVacationMode()) {
            redirect('options.php?s=4');
            return false;
        }
        if ($isMaster && !$this->isWW()) {
            if (!$this->session->checkSitterPermission(Session::SITTER_CAN_BUY_OR_SPEND_GOLD)) {
                return false;
            }
            if (!$this->isWW() && $this->session->getAvailableGold() < Config::getInstance()->gold->masterBuilderGold) {
                return false;
            }
        }
        if ($this->session->banned() || Config::getInstance()->dynamic->serverFinished) {
            return false;
        }
        if (!isset($this->buildings[$field])) {
            return false;
        }
        if (!$this->getField($field)['item_id']) {
            return false;
        }
        $nextLevel = $this->getField($field)['level'] + $this->getField($field)['upgrade_state'] + 1;
        $item_id = (int)$this->getField($field)['item_id'];
        if ($item_id == 16) {
            $field = 39;
        }
        if (in_array($item_id, [31, 32, 33, 42, 43])) {
            $field = 40;
        }
        if ($item_id == 40) {
            $field = 99;
        }
        if ($isMaster) {
            foreach ($this->onLoadBuildings['master'] as $task) {
                if ($task['building_field'] == $field) {
                    $nextLevel++;
                }
            }
        }
        /* if this is in demolish cancel :| */
        if ($this->getOnDemolishBuildingFieldId() == $field) {
            return false;
        }
        $workers = $this->isWorkersBusy($field <= 18, $item_id == 40);
        if (!$isMaster && $workers['isBusy']) {
            return false;
        } else if ($nextLevel > Formulas::buildingMaxLvl($item_id, $this->isCapital())) { //reached max lvl
            return false;
        } else if (($isMaster && $this->isWW() && $item_id <> 40) || ($isMaster && $workers['isMasterBusy'])) { //can just use masterBuilder for WW :|
            return false;
        } else if ($this->checkArtifactDependencies($item_id) <> 0) {
            return false;
        } else if ($this->checkDependencies($item_id, $nextLevel) <> 0) {
            return false;
        }
        $costs = Formulas::buildingUpgradeCosts($item_id, $nextLevel);
        if (!$this->isResourcesAvailable($costs) && (!$isMaster || ($isMaster && $item_id == 40))) {
            return false;
        } else if ($isMaster && $this->isResourcesAvailable($costs) && !$workers['isBusy']) {
            return false;
        }
        $quest = Quest::getInstance();
        if ($quest->getTutorial() == '3-1' && $item_id == 1 && $this->getField($field)['level'] == 0) {
            $quest->setTutorial("3-2");
        } else if ($quest->getTutorial() == '4-1' && $item_id == 1 && $this->getField($field)['level'] == 1) {
            $quest->setTutorial("4-2");
        } else if ($quest->getTutorial() == '5-1' && $item_id == 4 && $this->getField($field)['level'] == 0) {
            $quest->setTutorial("5-2");
        }
        $this->db->run("UPDATE fdata SET f{$field}t=? WHERE kid=?", [$item_id, $this->getKid()]);
        $this->buildings[$field]['item_id'] = $item_id;
        if (!$isMaster) {
            //finalized
            $commence = time();
            if ($this->session->getRace() == 1) {
                if ($field > 18 && $this->workers['buildsNum'] > 0) {
                    $commence = $this->getLastCommence($field <= 18);
                } else if ($field <= 18 && $this->workers['fieldsNum'] > 0) {
                    $commence = $this->getLastCommence($field <= 18);
                }
            } else {
                $commence = $this->getLastCommence($field <= 18);
            }
            $commence += Formulas::buildingUpgradeTime($item_id, $nextLevel, $this->getMainBuildingLvl(), $this->isWW());
            $isMaster = $isMaster ? 1 : 0;
            $stmt = $this->db->run(
                "INSERT INTO building_upgrade (kid, building_field, isMaster, start_time, commence) VALUES (?, ?, ?, ?, ?)",
                [$this->getKid(), $field, $isMaster, time(), $commence]
            );
            $taskId = $this->db->lastInsertId();
            $this->buildings[$field]['upgrade_state']++;
            $this->onLoadBuildings['normal'][$taskId] = [
                "id" => (int)$taskId,
                "kid" => $this->getKid(),
                "building_field" => (int)$field,
                "commence" => (int)$commence,
                'isMaster' => $isMaster,
            ];
            if ($stmt->rowCount()) {
                $this->modifyResources($costs);
            }
            ++$this->workers[$field <= 18 ? 'fieldsNum' : 'buildsNum'];
            if (sizeof($this->onLoadBuildings['master'])) {
                $Builder = new MasterBuilder();
                $Builder->updateCommence($this->getKid(), false);
                $this->fetchMasterBuildsAll();
            } else {
                $this->repopCropLoadings();
            }
        } else {
            $commence = time() + $this->calcWhenResourcesAreAvailable($costs);
            if (sizeof($this->onLoadBuildings['master'])) {
                $end = end($this->onLoadBuildings['master']);
                $commence += $end['commence'] - time();
            }
            $isMaster = $isMaster ? 1 : 0;
            $this->db->run("INSERT INTO building_upgrade (kid, building_field, isMaster, start_time, commence) VALUES (?,?,?,?,?)",
                [
                    $this->getKid(),
                    $field,
                    $isMaster,
                    time(),
                    $commence,
                ]);
            $taskId = $this->db->lastInsertId();
            $this->onLoadBuildings['master'][$taskId] = [
                "id" => (int)$taskId,
                "kid" => $this->getKid(),
                "building_field" => (int)$field,
                "commence" => (int)$commence,
                'isMaster' => $isMaster,
            ];
            if (sizeof($this->onLoadBuildings['master'])) {
                $Builder = new MasterBuilder();
                $Builder->updateCommence($this->getKid(), false);
                $this->fetchMasterBuildsAll();
            } else {
                $this->repopCropLoadings();
            }
            $this->onLoadBuildings['master'][$taskId]['commence'] = $this->db->fetchScalar("SELECT commence FROM building_upgrade WHERE id=?",
                $taskId);
        }
        $i = $field;
        if (isset($this->specialBuildingsName[$item_id])) {
            $this->setSpecialBuildingLevel($this->specialBuildingsName[$item_id], $this->buildings[$i]['level']);
        }
    }

    public function getOnDemolishBuildingFieldId()
    {
        if ($this->demolitionTasks == null) {
            return 0;
        }

        return (int)$this->demolitionTasks['building_field'];
    }


    public function isWorkersBusy($isField, $isWWQueue = false)
    {
        $config = Config::getInstance();
        $hasPlus = $this->session->hasPlus();
        $maxTasks = $hasPlus ? 2 : 1; //its with wonder
        $fieldsNum = $this->workers['fieldsNum'];
        $buildsNum = $this->workers['buildsNum'];
        $master = $this->workers['master'];
        if ($isWWQueue) {
            $maxTasks = 2;
        }
        if ($this->session->getRace() == 1) {
            return [
                'isMasterBusy' => $master >= ($this->isWW() ? $config->masterBuilder->maxTasksInWonder : $config->masterBuilder->maxTasksInNoneWonder),
                'isBusy' => (($isField) ? ($fieldsNum >= $maxTasks) : ($buildsNum >= $maxTasks)) || ($fieldsNum + $buildsNum) >= 3,
                'isPlusUsed' => ($hasPlus ? ($isField ? ($fieldsNum > 0) : ($buildsNum > 0)) : false),
            ];
        }
        return [
            'isMasterBusy' => $master >= ($this->isWW() ? $config->masterBuilder->maxTasksInWonder : $config->masterBuilder->maxTasksInNoneWonder),
            'isBusy' => ($buildsNum + $fieldsNum) >= $maxTasks,
            'isPlusUsed' => ($hasPlus ? (($buildsNum + $fieldsNum) > 0) : false),
        ];
    }

    public function checkArtifactDependencies($item_id)
    {
        if (!in_array($item_id, [38, 39, 40])) {
            return 0;
        }

        return $this->helper->checkArtifactDependencies($this->session->getAllianceId(),
            $this->session->getPlayerId(),
            $this->session->getKid(),
            $item_id,
            $this->isWW(),
            $this->buildings[99]['level']);
    }

    public function checkDependencies($item_id, $level)
    {
        $dep = $this->helper->checkDependencies($item_id,
            $level,
            $this->isWW(),
            $this->village['cropp'] - $this->village['pop'] - $this->cropLoading - $this->cropLoadingMaster,
            $this->get("maxstore"),
            $this->get("maxcrop"));

        return $dep;
    }

    public function getProduction($type = -1)
    {
        $production = [
            round($this->village['woodp']),
            round($this->village['clayp']),
            round($this->village['ironp']),
            round($this->village['cropp'] - $this->village['pop'] - $this->village['upkeep']),
        ];
        // We need bare production - village pop only
        $production[4] = $this->village['cropp'] - $this->village['pop'] - $this->cropLoading - $this->cropLoadingMaster;
        if ($type > -1) {
            return $production[$type];
        }
        return $production;
    }

    public function getCropLoading()
    {
        return $this->cropLoading + $this->cropLoadingMaster;
    }

    public function isResourcesAvailable($costs)
    {
        $cur_res = $this->getCurrentResources(-1, true);
        for ($i = 0; $i < 4; ++$i) {
            if (floor($cur_res[$i]) < $costs[$i]) {
                return false;
            }
        }
        return true;
    }

    public function getCurrentResources($type = -1, $round = true)
    {
        $resources = [
            $this->village['wood'],
            $this->village['clay'],
            $this->village['iron'],
            max($this->village['crop'], 0),
        ];
        if ($round) {
            foreach ($resources as &$v) {
                $v = floor($v);
            }
        }

        return $type <> -1 ? $resources[$type] : $resources;
    }

    private function getLastCommence($isField, $id = null, $false = false)
    {
        $kid = $this->session->getSelectedVillageID();
        if ($this->session->getRace() == 1) {
            $minField = $isField ? 1 : 19;
            $maxField = $isField ? 18 : 100;
        } else {
            $minField = 0;
            $maxField = 100;
        }
        if($id){
            $commence = $this->db->fetchScalar("SELECT commence FROM building_upgrade WHERE kid=$kid AND building_field > ? AND building_field < ? AND isMaster=0 AND id!=$id ORDER BY id DESC LIMIT 1", [$minField, $maxField]);
        } else {
            $commence = $this->db->fetchScalar("SELECT commence FROM building_upgrade WHERE kid=$kid AND building_field > ? AND building_field < ? AND isMaster=0 ORDER BY id DESC LIMIT 1", [$minField, $maxField]);
        }
        if (!$commence) {
            if($false){
                return false;
            }
            return time();
        }
        return (int)$commence;
    }

    public function getMainBuildingLvl()
    {
        return $this->specialBuildingsLvl['MainBuilding'];
    }

    public function modifyResources($costs, $mode = 0)
    {
        if ($mode == 0) {
            $this->village['wood'] -= $costs[0];
            $this->village['clay'] -= $costs[1];
            $this->village['iron'] -= $costs[2];
            $this->village['crop'] -= $costs[3];
        } else {
            $this->village['wood'] += $costs[0];
            $this->village['clay'] += $costs[1];
            $this->village['iron'] += $costs[2];
            $this->village['crop'] += $costs[3];
        }

        $stmt = $this->db->run('UPDATE vdata SET wood=?, clay=?, iron=?, crop=?, lastmupdate=? WHERE kid=?', [
            $this->village['wood'],
            $this->village['clay'],
            $this->village['iron'],
            $this->village['crop'],
            $this->village['lastmupdate'],
            $this->village['kid'],
        ]);

        return $stmt && $stmt->rowCount() > 0;
    }

    private function fetchMasterBuildsAll()
    {
        $this->onLoadBuildings['master'] = [];
        $masterBuilders = $this->db->run("SELECT * FROM building_upgrade WHERE isMaster=1 AND kid=? ORDER BY id",
            $this->getKid());
        while ($row = $masterBuilders->fetch(PDO::FETCH_ASSOC)) {
            $this->onLoadBuildings['master'][$row['id']] = $row;
        }
        $this->repopCropLoadings();
    }

    public function repopCropLoadings()
    {
        $tmp = [];
        $this->cropLoading = $this->cropLoadingMaster = 0;
        $find = $this->onLoadBuildings['normal'];
        foreach ($find as $row) {
            if (!isset($tmp[$row['building_field']])) {
                $tmp[$row['building_field']] = 0;
            }
            ++$tmp[$row['building_field']];
            $lvl = $this->getField($row['building_field'])['level'] + $tmp[$row['building_field']];
            if ($row['isMaster']) {
                ++$this->workers['master'];
                $this->cropLoadingMaster += Formulas::buildingCropConsumption($this->getField($row['building_field'])['item_id'],
                    $lvl);
            } else {
                $this->cropLoading += Formulas::buildingCropConsumption($this->getField($row['building_field'])['item_id'],
                    $lvl);
            }
        }
        $this->workers['master'] = 0;
        $find = $this->onLoadBuildings['master'];
        foreach ($find as $row) {
            if (!isset($tmp[$row['building_field']])) {
                $tmp[$row['building_field']] = 0;
            }
            ++$tmp[$row['building_field']];
            $lvl = $this->getField($row['building_field'])['level'] + $tmp[$row['building_field']];
            if ($row['isMaster']) {
                ++$this->workers['master'];
                $this->cropLoadingMaster += Formulas::buildingCropConsumption($this->getField($row['building_field'])['item_id'],
                    $lvl);
            } else {
                $this->cropLoading += Formulas::buildingCropConsumption($this->getField($row['building_field'])['item_id'],
                    $lvl);
            }
        }
    }

    public function calcWhenResourcesAreAvailable($cost, $asString = false)
    {
        $code = 0;
        do {
            if ($cost[0] > $this->village['maxstore'] || $cost[1] > $this->village['maxstore'] || $cost[2] > $this->village['maxstore']) {
                if ($this->village['maxstore'] <= Formulas::storeCAP(0)) {
                    $code = 22;
                    break;
                }
                $code = 2;
                break;
            }
            if ($cost[3] > $this->village['maxcrop']) {
                if ($this->village['maxcrop'] <= Formulas::storeCAP(0)) {
                    $code = 33;
                    break;
                }
                $code = 3;
                break;
            }
        } while(false);

        if($code > 0){
            if($asString){
                switch ($code) {
                    case 1:
                        return "<div class=\"errorMessage\">" . T("Buildings", "errors.foodShortage") . "</div>";
                    case 2:
                        return "<div class=\"errorMessage\">" . T("Buildings", "errors.upgradeWareHouse") . "</div>";
                    case 22:
                        return "<div class=\"errorMessage\">" . T("Buildings", "errors.constructWarehouse") . "</div>";
                    case 3:
                        return "<div class=\"errorMessage\">" . T("Buildings", "errors.upgradeGranny") . "</div>";
                    case 33:
                        return "<div class=\"errorMessage\">" . T("Buildings", "errors.constructGranny") . "</div>";
                }
            }
            return -1;
        }

        $timeNeeded = 0;
        $cur_res = $this->getCurrentResources(-1, true);
        $cur_prod = $this->getProduction();
        $minus = false;
        for ($i = 0; $i < 4; ++$i) {
            if (floor($cur_res[$i]) < $cost[$i]) {
                if ($i == 3 && $cur_prod[$i] <= 0) {
                    $minus = true;
                    break;
                } else {
                    $neededTime = ($cost[$i] - floor($cur_res[$i])) / $cur_prod[$i] * 3600000;
                }
                if ($neededTime > $timeNeeded) {
                    $timeNeeded = $neededTime;
                }
            }
        }
        $timeNeeded /= 1000;
        if ($asString) {
            if ($minus) {
                return '<div class="errorMessage">' . T("Buildings", "enoughResourcesAtNever") . '</div>';
            }
            return '<div class="errorMessage">' . sprintf(T("Buildings", "enoughResourcesAt"), TimezoneHelper::autoDateString(time() + floor($timeNeeded), true)) . '</div>';
        }
        if ($minus) {
            $timeNeeded = -1;
        }
        return floor($timeNeeded);
    }

    public function getName()
    {
        return $this->get("name");
    }

    public function getLoyalty()
    {
        $points = 0;
        if ($this->village['loyalty'] < 100) {
            $points = max($this->specialBuildingsLvl['Palace'] + $this->specialBuildingsLvl['Residence'], 0);
            $points /= 3600;
            $elapsedSeconds = time() - $this->village['last_loyalty_update'];
            $points *= $elapsedSeconds;
            $loyalty = min(100, $this->village['loyalty'] + $points);
        } else {
            $loyalty = min(125, $this->village['loyalty'] + $points);
        }
        return $loyalty;
    }

    public function demolishBuilding($fieldId, $complete = false, $checkOnly = false)
    {
        if ($this->session->isInVacationMode()) {
            redirect('options.php?s=4');
        }
        if (!isset($this->buildings[$fieldId])) {
            return false;
        }
        if (!$this->getField($fieldId)['item_id']) {
            return false;
        }
        if ($this->getOnDemolishBuildingFieldId()) {
            return false;
        }
        if (Config::getInstance()->dynamic->serverFinished || $this->session->banned()) {
            return false;
        }
        if ($checkOnly) return true;
        //delete all upgrade tasks.
        foreach ($this->onLoadBuildings['normal'] as $key => $build) {
            if ($build['building_field'] == $fieldId) {
                $this->removeBuilding($key);
            }
        }
        foreach ($this->onLoadBuildings['master'] as $key => $build) {
            if ($build['building_field'] == $fieldId) {
                $this->removeBuilding($key);
            }
        }
        if ($complete) {
            BuildingAction::downgrade($this->getKid(), $fieldId, 1, true);
            return true;
        }
        //insert query to database;
        if ($complete) {
            $demolishTime = 0;
        } else {
            $up_time = Formulas::buildingUpgradeTime(
                $this->getField($fieldId)['item_id'],
                max($this->getField($fieldId)['level'] - 1, 1),
                $this->getMainBuildingLvl(),
                $this->isWW()
            );
            $demolishTime = time() + round($up_time / 4);
        }
        $complete = $complete ? 1 : 0;
        $this->db->run("INSERT INTO demolition (kid, building_field, end_time, complete) VALUES (?,?,?,?)",
            [$this->getKid(), $fieldId, $demolishTime, $complete]);
        if (!$complete) {
            $this->demolitionTasks = [
                'id' => $this->db->lastInsertId(),
                "kid" => $this->getKid(),
                "building_field" => $fieldId,
                "end_time" => $demolishTime,
                "complete" => $complete ? 1 : 0,
            ];
        }
        return true;
    }

    public function removeBuilding($id)
    {
        $updateMaster = sizeof($this->onLoadBuildings['master']);
        if (!isset($this->onLoadBuildings['normal'][$id]) && !isset($this->onLoadBuildings['master'][$id])) {
            return false;
        }
        if ($this->session->banned() || Config::getInstance()->dynamic->serverFinished) {
            return false;
        }
        $row = $this->onLoadBuildings[isset($this->onLoadBuildings['normal'][$id]) ? 'normal' : 'master'][$id];
        $item_id = $this->buildings[$row['building_field']]['item_id'];
        if ($row['building_field'] > 18 && $row['building_field'] < 99 && $this->getField($row['building_field'])['level'] == 0) {
            $x = $this->getField($row['building_field'])['upgrade_state'];
            foreach ($this->onLoadBuildings['master'] as $k => $v) {
                if ($v['building_field'] == $row['building_field']) {
                    $x++;
                }
            }
            if ($x == 1) {
                $this->db->run("UPDATE fdata SET f{$row['building_field']}t=0 WHERE kid=?", $this->getKid());
                $this->buildings[$row['building_field']]['item_id'] = 0;
            }
        }
        unset($this->onLoadBuildings[isset($this->onLoadBuildings['normal'][$id]) ? 'normal' : 'master'][$id]);
        if (!$row['isMaster']) {
            //give back resources.
            $up_level = $this->buildings[$row['building_field']]['level'];
            foreach ($this->onLoadBuildings['normal'] as $k => $v) {
                if ($v['building_field'] == $row['building_field']) {
                    $up_level++;
                }
                if ($v['id'] == $row['id']) {
                    break;
                }
            }
            $this->modifyResources(Formulas::buildingUpgradeCosts($item_id, max(1, $up_level - 1)), 1);
        }
        $this->db->run("DELETE FROM building_upgrade WHERE id=?", (int)$id);
        if ($this->getField($row['building_field'])['item_id'] == 40) {
            --$this->workers['WW'];
        }
        if ($row['isMaster']) {
            --$this->workers['master'];
        } else {
            --$this->workers[$this->getField($row['building_field'])['item_id'] <= 4 ? 'fieldsNum' : 'buildsNum'];
            --$this->buildings[$row['building_field']]['upgrade_state'];
        }

        if (!$row['isMaster']) {
            $this->recalculateBuildingTimes();
        }
        //update master builder here
        unset($row);
        if ($updateMaster) {
            $master = new MasterBuilder();
            $master->updateCommence($this->getKid(), false);
            $this->fetchMasterBuildsAll();
        } else {
            $this->repopCropLoadings();
        }
    }

    public function recalculateBuildingTimes(){
        usort($this->onLoadBuildings['normal'], function($a, $b){
            return $a['id'] == $b['id'] ? 0 : $a['id'] > $b['id'] ? 1 : -1;
        });
        $tmp = [];
        $lastCommence = [
            'field' => [0],
            'building' => [0],
        ];
        foreach ($this->onLoadBuildings['normal'] as $k => &$v) {
            $building = $this->getField($v['building_field']);
            if (!isset($tmp[$v['building_field']])) {
                $tmp[$v['building_field']] = $building['level'];
            }
            ++$tmp[$v['building_field']];
            $previousCommence = &$lastCommence[$v['building_field'] <= 18 ? 'field' : 'building'];
            $maxTime = $v['start_time'];
            if(!($this->session->getRace() == 1 && sizeof($previousCommence) <= 2)){
                $max = max($previousCommence);
                if($max > 0){
                    $maxTime += max($previousCommence) - $v['start_time'];
                }
            }
            $commence = $maxTime + Formulas::buildingUpgradeTime($building['item_id'], $tmp[$v['building_field']], $this->getMainBuildingLvl(), $this->isWW());
            $previousCommence[] = $v['commence'] = $commence;
            $this->db->run("UPDATE building_upgrade SET commence=? WHERE id=?", [$commence, $v['id']]);
        }
    }

    public function constructBuilding($field, $gid, $isMaster)
    {
        if ($this->session->isInVacationMode()) {
            redirect('options.php?s=4');
        }
        if ($isMaster && !$this->isWW()) {
            if (!$this->session->checkSitterPermission(Session::SITTER_CAN_BUY_OR_SPEND_GOLD)) {
                return false;
            }
            if (!$this->isWW() && $this->session->getAvailableGold() < Config::getInstance()->gold->masterBuilderGold) {
                return false;
            }
        }
        if ($this->session->banned()) {
            return false;
        }
        if (Config::getInstance()->dynamic->serverFinished) {
            return false;
        }
        if ($this->isWW() && in_array($field, [21, 26, 30, 31, 32, 99])) {
            $field = 99;
        }
        if (!isset($this->buildings[$field])) {
            return false;
        }
        $nextLevel = 1;
        $item_id = (int)$gid;
        if ($item_id == 16) {
            $field = 39;
        }
        if (in_array($item_id, [31, 32, 33, 42, 43])) {
            $field = 40;
        }
        if ($item_id == 40) {
            $field = 99;
        }
        //fuck u users.
        if ($field == 40 && !in_array($item_id, [31, 32, 33, 42, 43])) {
            return false;
        } else if ($field == 99 && $item_id <> 40) {
            return false;
        } else if ($field == 39 && $item_id <> 16) {
            return false;
        }
        if ($this->getField($field)['item_id'] > 0) {
            return false;
        }
        $workers = $this->isWorkersBusy($field <= 18);
        if ($this->canCreateNewBuild($item_id) <> 1) {
            return false;
        } else if (!$isMaster && $workers['isBusy']) {
            return false;
        } else if ($nextLevel > Formulas::buildingMaxLvl($item_id, $this->isCapital())) { //reached max lvl
            return false;
        } else if ($isMaster && $workers['isMasterBusy']) {
            return false;
        } else if ($this->checkArtifactDependencies($item_id) <> 0) {
            return false;
        } else if ($this->checkDependencies($item_id, $nextLevel) <> 0) {
            return false;
        }
        $costs = Formulas::buildingUpgradeCosts($item_id, $nextLevel);
        if (!$this->isResourcesAvailable($costs) && (!$isMaster || ($isMaster && $item_id == 40))) {
            return false;
        } else if ($isMaster && $this->isResourcesAvailable($costs) && !$workers['isBusy']) {
            return false;
        }
        $quest = Quest::getInstance();
        if ($quest->getTutorial() == '8-1' && $item_id == 10 && $this->getField($field)['level'] >= 0) {
            $quest->setTutorial("8-2");
        }
        $this->db->run("UPDATE fdata SET f{$field}t=? WHERE kid=?", [$item_id, $this->getKid()]);
        $this->buildings[$field]['item_id'] = $item_id;
        if (!$isMaster) {
            $commence = time();
            if ($this->session->getRace() == 1) {
                if ($field > 18 && $this->workers['buildsNum'] > 0) {
                    $commence = $this->getLastCommence($field <= 18);
                } else if ($field <= 18 && $this->workers['fieldsNum'] > 0) {
                    $commence = $this->getLastCommence($field <= 18);
                }
            } else {
                $commence = $this->getLastCommence($field <= 18);
            }
            $commence += Formulas::buildingUpgradeTime($item_id,
                $nextLevel,
                $this->getMainBuildingLvl(),
                $this->isWW());
            $isMaster = $isMaster ? 1 : 0;
            $stmt = $this->db->run("INSERT INTO building_upgrade (kid, building_field, isMaster, start_time, commence) VALUES (?,?,?,?,?)",
                [
                    $this->getKid(),
                    $field,
                    $isMaster,
                    time(),
                    $commence,
                ]);
            $taskId = $this->db->lastInsertId();
            $this->buildings[$field]['upgrade_state']++;
            $this->onLoadBuildings['normal'][$taskId] = [
                "id" => $taskId,
                "kid" => $this->getKid(),
                "building_field" => $field,
                "commence" => $commence,
                'isMaster' => $isMaster,
            ];
            if ($stmt->rowCount()) {
                $this->modifyResources($costs);
            }
            if (sizeof($this->onLoadBuildings['master'])) {
                (new MasterBuilder())->updateCommence($this->getKid(), false);
            }
            if ($this->getField($field)['item_id'] == 40) {
                ++$this->workers['WW'];
            }
            ++$this->workers[$field <= 18 ? 'fieldsNum' : 'buildsNum'];
        } else {
            $commence = time() + $this->calcWhenResourcesAreAvailable($costs);
            if (sizeof($this->onLoadBuildings['master'])) {
                $end = end($this->onLoadBuildings['master']);
                $commence += $end['commence'] - time();
            }
            $isMaster = $isMaster ? 1 : 0;

            $this->db->run("INSERT INTO building_upgrade (kid, building_field, isMaster, start_time, commence) VALUES (?,?,?,?,?)",
                [
                    $this->getKid(),
                    $field,
                    $isMaster,
                    time(),
                    $commence,
                ]);

            $taskId = $this->db->lastInsertId();
            $this->onLoadBuildings['master'][$taskId] = [
                "id" => $taskId,
                "kid" => $this->getKid(),
                "building_field" => $field,
                "commence" => $commence,
                'isMaster' => $isMaster,
            ];
            if (sizeof($this->onLoadBuildings['master'])) {
                $Builder = new MasterBuilder();
                $Builder->updateCommence($this->getKid(), false);
            }
            $this->onLoadBuildings['master'][$taskId]['commence'] = $this->db->fetchScalar("SELECT commence FROM building_upgrade WHERE id=?",
                $taskId);
        }
        $i = $field;
        if (isset($this->specialBuildingsName[$item_id])) {
            $this->setSpecialBuildingLevel($this->specialBuildingsName[$item_id], $this->buildings[$i]['level']);
        }
        $this->repopCropLoadings();
    }

    public function canCreateNewBuild($item_id)
    {
        if ($item_id == 40 && !$this->isWW()) return -1;
        $dep = $this->helper->canCreateNewBuild($this->isCapital(),
            $this->session->getRace(),
            $item_id,
            $this->buildings);
        if ($item_id == 26) {
            if ($this->helper->hasPalaceAnywhere($this->get('owner'))) {
                $dep = -1;
            }
        }
        return $dep;
    }

    public function contractResourcesLink($cost)
    {
        if ($this->isResourcesAvailable($cost)) {
            return ["code" => 0, "text" => null];
        }
        $needUpgradeType = $this->helper->checkWarehouseDependencies(
            $this->village['maxstore'],
            $this->village['maxcrop'],
            $cost
        );
        switch ($needUpgradeType) {
            case 1:
                return [
                    "code" => $needUpgradeType,
                    "text" => "<span class=\"errorMessage\">" . T("Buildings", "errors.foodShortage") . "</span>",
                ];
            case 2:
                return [
                    "code" => $needUpgradeType,
                    "text" => "<span class=\"errorMessage\">" . T("Buildings", "errors.upgradeWareHouse") . "</span>",
                ];
            case 22:
                return [
                    "code" => $needUpgradeType,
                    "text" => "<span class=\"errorMessage\">" . T("Buildings", "errors.constructWarehouse") . "</span>",
                ];
            case 3:
                return [
                    "code" => $needUpgradeType,
                    "text" => "<span class=\"errorMessage\">" . T("Buildings", "errors.upgradeGranny") . "</span>",
                ];
            case 33:
                return [
                    "code" => $needUpgradeType,
                    "text" => "<span class=\"errorMessage\">" . T("Buildings", "errors.constructGranny") . "</span>",
                ];
        }

        return [
            "code" => -1,
            "text" => $this->calcWhenResourcesAreAvailable($cost, true),
        ];
    }

    public function getEmptyFields()
    {
       return array_keys(
            array_filter($this->buildings, function($elem, $index){
               return $elem['item_id'] === 0 && $index >18 && $index < 39;
            },ARRAY_FILTER_USE_BOTH));
    }

    public function findBuildingsByGid($gid)
    {
        return array_filter($this->buildings, function($elem) use($gid){
            return $elem['item_id'] == $gid;
         });
    }
}