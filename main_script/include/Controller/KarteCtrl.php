<?php

namespace Controller;

use Core\Config;
use Core\Database\DB;
use Core\Helper\TimezoneHelper;
use Core\Session;
use Core\Village;
use Game\Formulas;
use Core\Locale;
use function htmlspecialchars;
use function logError;
use Model\AllianceModel;
use Model\KarteModel;
use Model\MapModel;
use Model\MovementsModel;
use Model\Quest;
use resources\View\GameView;
use resources\View\PHPBatchView;

class KarteCtrl extends GameCtrl
{
    public function __construct()
    {
        parent::__construct();
        Quest::getInstance()->setQuestBitwise("world", 5, 1);
        $this->view = new GameView();
        $this->view->vars['bodyCssClass'] = 'perspectiveResources';
        $this->view->vars['contentCssClass'] = 'map';
        if (isset($_GET['d']) && is_numeric($_GET['d'])) {
            $xy = Formulas::kid2xy($_GET['d']);
            $this->redirect("position_details.php?x={$xy['x']}&y={$xy['y']}");
        }
        if (isset($_GET['x']) && isset($_GET['y'])) {
            $kid = Formulas::xy2kid($_GET['x'], $_GET['y']);
        } else {
            $kid = Village::getInstance()->getKid();
        }
        $this->view->vars['titleInHeader'] = T("map", "map");
        $zoomLevel = isset($_GET['zoom']) && $_GET['zoom'] >= 1 && $_GET['zoom'] <= 3 ? (int)$_GET['zoom'] : 1;
        $fullView = FALSE;
        if (isset($_GET['fullscreen']) && $_GET['fullscreen'] == 1 && Session::getInstance()->hasPlus()) {
            $fullView = TRUE;
        }
        $view = new PHPBatchView("map/normal");
        $adventures = $this->getMapAdventureElements();
        $elements = [];
        $m = new KarteModel();
        $playerMarks = $allianceMarks = $flags = [];
        $find = $m->getWholeMapMarks(Session::getInstance()->getPlayerId(), Session::getInstance()->getAllianceId());
        while ($row = $find->fetch_assoc()) {
            $this->procMapFlags($row, $flags, $playerMarks, $allianceMarks);
        }
        $elements = array_merge($elements, $flags, $adventures['elements']);
        $mapMarkSettings = explode(",", Session::getInstance()->getMapSettings());
        $mapMarkSettings = [
            "ownMarks" => $mapMarkSettings[0] == 1,
            "allianceMarks" => $mapMarkSettings[1] == 1 && Session::getInstance()->getAllianceId(),
        ];
        $mapModel = new MapModel();
        $xy = Formulas::kid2xy($kid);
        $blocks = [];
        $blocksArray = $mapModel->getNearMapBlocksWithVersion($xy['x'], $xy['y'], $zoomLevel);
        while ($row = $blocksArray->fetch_assoc()) {
            $blocks[$row['tx0']][$row['ty0']][$row['tx1']][$row['ty1']]['version'] = $row['version'];
        }
        ksort($blocks, SORT_NUMERIC);
        $view->vars = [
            "hasPermission" => Session::getInstance()->hasAlliancePermission(AllianceModel::MANAGE_MARKS),
            "hasAlliance" => Session::getInstance()->getAllianceId(),
            "fullscreen" => $fullView,
            "coordinateSubmitButton" => getButton([
                "type" => "submit",
                "value" => "OK",
                "class" => "green small",
            ],
                ["data" => ["value" => "OK", "class" => "green small",],],
                T("Global", "General.ok")),
            "smallMapEnabled" => Config::getProperty("settings", "smallMapEnabled"),
            "hasPlus" => Session::getInstance()->hasPlus(),
            "hasClub" => Session::getInstance()->hasGoldClub(),
            "Map" => [
                'adventures' => $adventures['javascript'],
                "data" => json_encode([
                    "elements" => $elements,
                    "blocks" => $blocks,
                ]),
                "mapInitialPosition" => Formulas::kid2xy($kid),
                "zoomLevel" => $zoomLevel,
                "Marks" => [
                    "player" => [
                        "data" => json_encode($playerMarks),
                        "enabled" => $mapMarkSettings['ownMarks'],
                    ],
                    "alliance" => [
                        "data" => json_encode($allianceMarks),
                        "enabled" => $mapMarkSettings['allianceMarks'],
                    ],
                ],
            ],
        ];
        $this->view->vars['content'] = $view->output();
    }

    public function getMapAdventureElements()
    {
        $result = ["elements" => [], "javascript" => ''];
        $m = new KarteModel();
        $i = $m->getDoneAdventuresCount(Session::getInstance()->getPlayerId());
        $adventures = $m->getAdventures(Session::getInstance()->getPlayerId());
        while ($adventure = $adventures->fetch_assoc()) {
            ++$i;
            $coordinates = Formulas::kid2xy($adventure['kid']);
            $title = T("map", "Adventure") . ' ' . $i;
            $result['javascript'] .= "\t\t'a.atm{$i}': '{$title}',\n";
            $difficulty = T("map", $adventure['dif'] == 0 ? "normal" : "hard");
            $result['javascript'] .= "\t\t\t\t'a.ad{$i}': '{$difficulty}',\n";
            $result['elements'][] = [
                'position' => ["x" => $coordinates['x'], "y" => $coordinates['y']],
                "symbols" => [
                    [
                        "dataId" => "adventure" . $adventure['id'],
                        "x" => $coordinates['x'],
                        "y" => $coordinates['y'],
                        "type" => "adventure",
                        "parameters" => ["difficulty" => $adventure['dif'] + 1],
                        "title" => T("map", "Adventure"),
                        "text" => "{a.atm{$i}} <br /> {a.ad} {a.ad{$i}}",
                    ],
                ],
            ];
        }
        self::getAttackReinforceOtherElements($result);
        return $result;
    }

    public static function getAttackReinforceOtherElements(&$result)
    {
        $db = DB::getInstance();
        $kid = Session::getInstance()->getKid();
        if (!$kid) {
            logError("kid not found!? UID: %s", [Session::getInstance()->getPlayerId()]);
            return;
        }
        if (Session::getInstance()->hasPlus()) {
            $m = new KarteModel();
            $AllKids = $m->getVillageOasesIds($kid);
            $AllKids[] = $kid;
            $outGoing = $db->query("SELECT * FROM movement WHERE kid=$kid AND mode=0 AND attack_type NOT IN(5,6,7)");
            while ($row = $outGoing->fetch_assoc()) {
                $row['start_time_seconds'] = ceil($row['start_time'] / 1000);
                $row['end_time_seconds'] = ceil($row['end_time'] / 1000);
                self::addElement($result, $row);
            }
            $inComingGoing = $db->query("SELECT * FROM movement WHERE to_kid IN(" . implode(",",
                    $AllKids) . ") AND attack_type NOT IN(1,5,6,7)");
            while ($row = $inComingGoing->fetch_assoc()) {
                $row['start_time_seconds'] = ceil($row['start_time'] / 1000);
                $row['end_time_seconds'] = ceil($row['end_time'] / 1000);
                self::addElement($result, $row);
            }
        }
        $uid = Session::getInstance()->getPlayerId();
        $enforcements = $db->query("SELECT * FROM enforcement WHERE uid=$uid AND kid=$kid");
        while ($row = $enforcements->fetch_assoc()) {
            self::addReinforcementElement($result, $row);
        }
    }

    private static function addElement(&$result, $row)
    {
        if ($row['kid'] != Session::getInstance()->getKid() && $row['mode'] == 0 && ($row['attack_type'] == 3 || $row['attack_type'] == 4)) {
            return;
        }
        if ($row['mode'] == 1) {
            $attackType = 'return';
        } else if ($row['attack_type'] == MovementsModel::ATTACKTYPE_REINFORCEMENT) {
            $attackType = 'reinforcement';
        } else {
            $attackType = [
                              MovementsModel::ATTACKTYPE_SPY => 'spy',
                              MovementsModel::ATTACKTYPE_REINFORCEMENT => 'support',
                              MovementsModel::ATTACKTYPE_NORMAL => 'attack',
                              MovementsModel::ATTACKTYPE_RAID => 'raid',
                          ][$row['attack_type']];
        }
        $taskType = $row['attack_type'] == MovementsModel::ATTACKTYPE_REINFORCEMENT ? 'reinforcement' : 'attack';
        if ($attackType == 'attack') {
            $title = '{k.sattack}';
        } else if ($attackType == 'raid') {
            $title = '{k.sraid}';
        } else if ($attackType == 'spy') {
            $title = '{k.sspy}';
        } else if ($attackType == 'return') {
            $title = '{k.sreturn}';
        } else {
            $title = '{k.ssupport}';
        }

        $xy = Formulas::kid2xy($row['mode'] == 0 ? $row['to_kid'] : $row['kid']);
        $result['elements'][] = [
            'position' => [
                "x" => $xy['x'],
                "y" => $xy['y'],
            ],
            "symbols" => [
                [
                    "dataId" => "$taskType{$row['id']}",
                    "x" => $xy['x'],
                    "y" => $xy['y'],
                    "type" => $taskType,
                    "parameters" => ["attackType" => $attackType, 'attackTime' => $row['start_time_seconds']],
                    "title" => $title,
                    "text" => "{k.arrival} " . TimezoneHelper::autoDate($row['start_time_seconds'], TRUE)
                ]
            ]
        ];
    }

    private static function addReinforcementElement(&$result, $row)
    {
        $units = null;
        for ($i = 1; $i <= 11; ++$i) {
            if (!$row['u' . $i]) continue;
            if ($i == 11) {
                $unitId = 'hero';
            } else {
                $unitId = nrToUnitId($i, $row['race']);
            }
            $title = T("Troops", "$unitId.title");

            $numStr = number_format_x($row['u' . $i], 0);

            $units .= '<img class="unit u' . $unitId . '" src="img/x.gif" title="' . $title . '" alt="' . $title . '" /> ' . $numStr;
            if ($i <= 10 && $row['u' . ($i + 1)]) {
                $units .= '<br />';
            }
        }
        $xy = Formulas::kid2xy($row['to_kid']);
        $result['elements'][] = [
            'position' => [
                "x" => $xy['x'],
                "y" => $xy['y'],
            ],
            "symbols" => [
                [
                    'type' => 'reinforcement',
                    'dataId' => 'reinforcement' . $row['id'],
                    'text' => $units,
                    "x" => $xy['x'],
                    "y" => $xy['y'],
                ]
            ]
        ];
    }

    private function procMapFlags($row, &$flags, &$playerMarks, &$allianceMarks)
    {
        $m = new KarteModel();
        $result = [];
        $result[$row['type'] == 2 ? 'index' : 'color'] = $row['color'];
        $result['text'] = $row['type'] == 0 ? $m->getPlayerName($row['targetId']) : ($row['type'] == 1 ? $m->getAllianceTag($row['targetId']) : $row['text']);
        $result['layer'] = $row['type'] == 0 ? 'player' : ($row['type'] == 1 ? 'alliance' : 'flag');
        $result['dataId'] = $row['id'];
        if ($row['type'] == 2) {
            $result['plus'] = 0;
            $coordinates = Formulas::kid2xy($row['targetId']);
            $flags[] = [
                'position' => ["x" => $coordinates['x'], "y" => $coordinates['y']],
                "symbols" => [
                    array_merge($result, [
                        "type" => "flag",
                        "kid" => $row['targetId']
                    ], ["x" => $coordinates['x'], "y" => $coordinates['y']])
                ],
            ];
            $result = array_merge($result, $coordinates);
        } else {
            $result['markId'] = $row['targetId'];
        }
        if (!$row['uid'] && $row['aid']) {
            $row['layer'] = 'alliance';
            $allianceMarks[] = $result;
        } else {
            $row['layer'] = 'player';
            $playerMarks[] = $result;
        }
    }
}