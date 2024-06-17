<?php

use Core\Database\GlobalDB;
use Core\Database\ServerDB;
use Core\Helper\WebService;
use Model\TaskQueue;
use resources\View\PHPBatchView;

class InstallNewServerCtrl
{
    private $vars = [
        'data' => [
            'speeds' => [
                1 => '1x',
                2 => '2x',
                3 => '3x',
                5 => '5x',
                8 => '8x',
                10 => '10x',
                20 => '20x',
                25 => '25x',
                50 => '50x',
                100 => '100x',
                200 => '200x',
                500 => '500x',
                1000 => '1000x',
                2000 => '2000x',
                5000 => '5000x',
                10000 => '10000x',
                20000 => '20000x',
                40000 => '40000x',
                60000 => '60000x',
                80000 => '80000x',
                100000 => '100000x',
                200000 => '200000x',
            ],
            'mapSize' => [
                100 => '100x100',
                200 => '200x200',
                300 => '300x300',
                400 => '400x400',
            ],
            'roundLengths' => [
                1 => '1 day',
                2 => '2 days',
                3 => '3 days',
                4 => '4 days',
                5 => '5 days',
                6 => '6 days',
                7 => '7 days',
                9 => '9 days',
                10 => '10 days',
                14 => '14 days',
                21 => '21 days',
                30 => '1 month',
                90 => '3 months',
                'auto' => 'Auto (speed <= 10x)',
            ],
            'isPromoted' => [
                0 => 'No',
                1 => 'Yes',
            ],
            'serverHidden' => [
                0 => 'No',
                1 => 'Yes',
            ],
            'needPreregistrationCode' => [
                0 => 'No',
                1 => 'Yes',
            ],
            'activation' => [
                0 => 'Off',
                1 => 'On',
            ],
            'buyTroops' => [
                0 => 'Disabled',
                1 => 'Enabled',
            ],
            'buyResources' => [
                0 => 'Disabled',
                1 => 'Enabled',
            ],
            'buyAnimals' => [
                0 => 'Disabled',
                1 => 'Enabled',
            ],
            'instantFinishTraining' => [
                0 => 'Disabled',
                1 => 'Enabled',
            ],
            'buyAdventure' => [
                0 => 'Disabled',
                1 => 'Enabled',
            ],
            'buyResourcesInterval' => [
                0 => 'No limit',
                1800 => 'Every 30 minutes',
                3600 => 'Every 1 hour',
                7200 => 'Every 2 hours',
                21600 => 'Every 6 hours',
                86400 => 'Every day',
            ],
            'buyTroopsInterval' => [
                0 => 'No limit',
                1800 => 'Every 30 minutes',
                3600 => 'Every 1 hour',
                7200 => 'Every 2 hours',
                21600 => 'Every 6 hours',
                86400 => 'Every day',
            ],
            'buyAnimalsInterval' => [
                0 => 'No limit',
                1800 => 'Every 30 minutes',
                3600 => 'Every 1 hour',
                7200 => 'Every 2 hours',
                21600 => 'Every 6 hours',
                86400 => 'Every day',
            ],
            'startDay' => [
                0 => 'today',
                1 => '1 day later',
                2 => '2 days later',
                3 => '3 days later',
                4 => '4 days later',
                5 => '5 days later',
                6 => '6 days later',
                7 => '7 days later',
                10 => '10 days later',
            ],
            'startHour' => [
                '00:00',
                '01:00',
                '02:00',
                '03:00',
                '04:00',
                '05:00',
                '06:00',
                '07:00',
                '08:00',
                '09:00',
                '10:00',
                '11:00',
                '12:00',
                '13:00',
                '14:00',
                '15:00',
                '16:00',
                '17:00',
                '18:00',
                '18:30',
                '19:00',
                '20:00',
                '21:00',
                '22:00',
                '23:00',
            ],
            'auto_reinstall' => [
                0 => 'Never',
                86400 => '1 day later',
                172800 => '2 days later',
                604800 => 'a week later',
            ],
            'auto_reinstall_start_after' => [
                86400 => '1 day later',
                172800 => '2 days later',
                604800 => 'a week later',
            ],
        ],
        'formData' => [
            'speed' => 5000,
            'serverName' => 'Developer',
            'worldId' => 'dev',
            'roundLength' => 1,
            'mapSize' => 200,
            'isPromoted' => 0,
            'startGold' => 0,
            'buyTroops' => 0,
            'buyTroopsInterval' => 0,
            'buyResources' => 0,
            'buyResourcesInterval' => 0,
            'buyAnimals' => 0,
            'buyAnimalsInterval' => 0,
            'protectionHours' => 1,
            'needPreregistrationCode' => 0,
            'startDay' => 0,
            'startHour' => '18:00',
            'startTimezone' => null, // will be defined later
            'serverHidden' => 0,
            'instantFinishTraining' => 0,
            'buyAdventure' => 0,
            'activation' => 0,
            'auto_reinstall' => 0,
            'auto_reinstall_start_after' => 86400,
        ],
        'installQueued' => false,
        'deletionQueued' => false,
        'errors' => [],
    ];

    public function __construct()
    {
        global $globalConfig;
        $db = GlobalDB::getInstance();
        $timezones = [
            0 => 'Asia/Tehran',
            1 => $globalConfig['staticParameters']['default_timezone'],
        ];
        $timezones = array_unique($timezones);
        $this->vars['data']['startTimezone'] = $timezones;
        $this->vars['maximumServersReached'] = $db->fetchScalar("SELECT COUNT(id) FROM gameServers") >= 5;
        if (isset($_GET['deletionQueued'])) {
            $this->vars['deletionQueued'] = true;
        }
        if (!WebService::isPost()) {
            $this->vars['formData']['startTimezone'] = 1;
        }

        $this->vars['configurations'] = [];
        $stmt = $db->query("SELECT * FROM configurations");
        while ($row = $stmt->fetch_assoc()) {
            $row['data'] = json_decode($row['data'], true);
            $this->vars['configurations'][$row['id']] = $row;
        }

        if (isset($_GET['do']) && $_GET['do'] == 'flushTokens') {
            TaskQueue::addTask(TaskQueue::TASK_FLUSH_TOKENS, [], 'Flush tokens (manual)');
            $this->vars['flushTokensQueued'] = true;
        } else if (isset($_GET['worldUniqueId'], $_GET['do']) && in_array($_GET['do'], ['loginMH', 'loginSP'])) {
            $worldUniqueId = (int)$_GET['worldUniqueId'];
            $stmt = $db->query("SELECT gameWorldUrl, configFileLocation FROM gameServers WHERE id=$worldUniqueId");
            if ($stmt->num_rows) {
                $server = $stmt->fetch_assoc();
                try {
                    $serverDB = ServerDB::getInstance($server['configFileLocation']);
                    $api_token = $db->fetchScalar("SELECT loginToken FROM paymentConfig");
                    if ($_GET['do'] == 'loginMH') {
                        $password = $serverDB->fetchScalar('SELECT password FROM users WHERE id=2');
                        $link = sprintf(
                            '%slogin.php?action=multiLogin&hash=%s&token=%s',
                            $server['gameWorldUrl'],
                            sha1($password),
                            $api_token
                        );
                    } else {
                        $password = $serverDB->fetchScalar('SELECT password FROM users WHERE id=0');
                        $link = sprintf(
                            '%slogin.php?action=adminLogin&hash=%s&token=%s',
                            $server['gameWorldUrl'],
                            sha1($password),
                            $api_token
                        );
                    }
                    WebService::redirect($link);
                } catch (Exception $e) {
                }
            } else {
                $this->vars['errors'][] = 'Game world not found.';
            }
        } else if (isset($_GET['worldId'], $_GET['do']) && in_array($_GET['do'],
                ['stopGameEngine', 'startGameEngine', 'restartGameEngine'])) {
            $user = basename(dirname(GLOBAL_CONFIG_FILE));
            $engine = trim(sprintf('%s_%s.service', $user, $_GET['worldId']));
            switch ($_GET['do']) {
                case 'stopGameEngine':
                    TaskQueue::addTask(
                        TaskQueue::TASK_ENGINE_STOP,
                        ['service' => $engine],
                        sprintf('Stopping (manual) engine %s', trim($_GET['worldId'])));
                    $this->vars['stopEngineQueued'] = true;
                    break;
                case 'startGameEngine':
                    TaskQueue::addTask(
                        TaskQueue::TASK_ENGINE_START,
                        ['service' => $engine],
                        sprintf('Starting (manual) engine %s', trim($_GET['worldId'])));
                    $this->vars['startEngineQueued'] = true;
                    break;
                case 'restartGameEngine':
                    TaskQueue::addTask(
                        TaskQueue::TASK_ENGINE_RESTART,
                        ['service' => $engine],
                        sprintf('Restarting (manual) engine %s', trim($_GET['worldId'])));
                    $this->vars['restartEngineQueued'] = true;
                    break;
            }
        } else if (isset($_GET['del']) && isset($_GET['worldId']) && is_numeric($_GET['del'])) {
            $data = json_encode([
                'id' => (int)$_GET['del'],
            ]);
            $gameWorld = $db->query("SELECT * FROM gameServers WHERE id={$_GET['del']}");
            if ($gameWorld->num_rows) {
                $gameWorld = $gameWorld->fetch_assoc();
                if (in_array($gameWorld['worldId'], ['dev', 'test']) || $gameWorld['finished'] == 1 || $gameWorld['startTime'] > time()) {
                    $count = (int)$db->fetchScalar("SELECT COUNT(id) FROM taskQueue where data='" . $db->real_escape_string($data) . "' AND status='pending'");
                    if ($count === 0) {
                        TaskQueue::addTask(TaskQueue::TASK_UNINSTALL, $data, "Uninstalling server {$_GET['worldId']}");
                        WebService::redirect('admin.php?action=installNewServer&deletionQueued=1');
                    } else {
                        $this->vars['errors'][] = 'Deletion already queued';
                    }
                } else {
                    $this->vars['errors'][] = 'Game world is not finished.';
                }
            } else {
                $this->vars['errors'][] = 'Game world not found.';
            }
        } else if (!$this->vars['maximumServersReached'] && WebService::isPost()) {
            if ($this->post() === 0) {
                if ($this->vars['formData']['startDay'] > 0) {
                    $startTime = "+{$this->vars['formData']['startDay']} days {$this->vars['formData']['startHour']}:00";
                } else {
                    $startTime = "today {$this->vars['formData']['startHour']}:00";
                }
                $startTime = new \DateTime($startTime,
                    new \DateTimeZone($timezones[$this->vars['formData']['startTimezone']]));
                $startTime = $startTime->getTimestamp();
                if ($startTime < time() && !in_array($this->vars['formData']['worldId'], ['dev'])) {
                    $this->vars['errors'][] = 'Start time is already passed.';
                } else {


                    $data = $this->vars['formData'];
                    $data['startTime'] = $startTime;
                    unset(
                        $data['startTimezone'],
                        $data['startDay'],
                        $data['startHour']
                    );
                    TaskQueue::addTask(TaskQueue::TASK_INSTALL,
                        $data,
                        "Installing server {$this->vars['formData']['serverName']}");
                    $this->vars['installQueued'] = true;
                }
            }
        }
        $this->vars['tasks'] = $db->query("SELECT * FROM taskQueue ORDER BY id DESC LIMIT 10")->fetch_all(MYSQLI_ASSOC);
        $this->vars['gameWorlds'] = $db->query("SELECT * FROM gameServers ORDER BY finished=1 DESC, startTime ASC")->fetch_all(MYSQLI_ASSOC);
        $user = basename(dirname(GLOBAL_CONFIG_FILE));
        foreach ($this->vars['gameWorlds'] as &$gameWorld) {
            $cmd = sprintf("systemctl is-active %s", $user . '_' . $gameWorld['worldId']);
            $gameWorld['engine_status'] = trim(shell_exec($cmd)) == 'active';
        }
        $dispatcher = Dispatcher::getInstance();
        $dispatcher->appendContent(PHPBatchView::render('admin/installation', $this->vars));
    }

    private function post()
    {
        $db = GlobalDB::getInstance();
        $errors = 0;
        if (isset($_POST['worldId'])) {
            $this->vars['formData']['worldId'] = preg_replace('/([^a-z0-9]+)/',
                null,
                strtolower(trim($_POST['worldId'])));
            if (is_numeric($_POST['worldId'])) {
                $this->vars['errors'][] = 'World id must not be numeric.';
                $errors++;
            } else if (strlen($_POST['worldId']) > 6) {
                $this->vars['errors'][] = 'World id must be less than 7 letters.';
                $errors++;
            } else if (strlen($_POST['worldId']) < 1) {
                $this->vars['errors'][] = 'World id must be at least 1 letter.';
                $errors++;
            } else {
                $count = (int)$db->fetchScalar("SELECT COUNT(id) FROM gameServers WHERE worldId='{$this->vars['formData']['worldId']}'");
                if ($count > 0) {
                    $this->vars['errors'][] = 'World id already exists.';
                    $errors++;
                }
            }
        }
        if (isset($_POST['serverName'])) {
            $this->vars['formData']['serverName'] = trim($_POST['serverName']);
            if (is_numeric($_POST['serverName'])) {
                $this->vars['errors'][] = 'Server name must not be numeric.';
                $errors++;
            } else if (strlen($_POST['serverName']) <= 1) {
                $this->vars['errors'][] = 'Server name must be 2 or more letters.';
                $errors++;
            }
        }
        if (isset($_POST['speed'])) {
            $this->vars['formData']['speed'] = (int)trim($_POST['speed']);
            if (!is_numeric($_POST['speed'])) {
                $this->vars['errors'][] = 'Game speed is not numeric.';
                $errors++;
            }
        }
        if (isset($_POST['mapSize'])) {
            $this->vars['formData']['mapSize'] = (int)trim($_POST['mapSize']);
            if (!in_array($_POST['mapSize'], array_keys($this->vars['data']['mapSize']))) {
                $this->vars['errors'][] = 'Map size is invalid.';
                $errors++;
            }
        }
        if (isset($_POST['startGold'])) {
            $this->vars['formData']['startGold'] = (int)trim($_POST['startGold']);
            if (!is_numeric($_POST['startGold'])) {
                $this->vars['errors'][] = 'Start gold is invalid.';
                $errors++;
            }
        }
        if (isset($_POST['protectionHours'])) {
            $this->vars['formData']['protectionHours'] = (int)trim($_POST['protectionHours']);
            if (!is_numeric($_POST['protectionHours'])) {
                $this->vars['errors'][] = 'Protection time is invalid.';
                $errors++;
            }
        }
        if (isset($_POST['roundLength'])) {
            $this->vars['formData']['roundLength'] = (int)trim($_POST['roundLength']);
            if (!in_array($_POST['roundLength'], array_keys($this->vars['data']['roundLengths']))) {
                $this->vars['errors'][] = 'Round length is invalid.';
                $errors++;
            }
        }
        $this->vars['formData']['buyTroops'] = isset($_POST['buyTroops']) && $_POST['buyTroops'] == 1;
        if (isset($_POST['buyTroopsInterval'])) {
            $this->vars['formData']['buyTroopsInterval'] = (int)trim($_POST['buyTroopsInterval']);
            if (!in_array($_POST['buyTroopsInterval'], array_keys($this->vars['data']['buyTroopsInterval']))) {
                $this->vars['errors'][] = 'Buy troops interval is invalid.';
                $errors++;
            }
        }
        $this->vars['formData']['buyAnimals'] = isset($_POST['buyAnimals']) && $_POST['buyAnimals'] == 1;
        if (isset($_POST['buyAnimalsInterval'])) {
            $this->vars['formData']['buyAnimalsInterval'] = (int)trim($_POST['buyAnimalsInterval']);
            if (!in_array($_POST['buyAnimalsInterval'], array_keys($this->vars['data']['buyAnimalsInterval']))) {
                $this->vars['errors'][] = 'Buy animals interval is invalid.';
                $errors++;
            }
        }
        $this->vars['formData']['buyResources'] = isset($_POST['buyResources']) && $_POST['buyResources'] == 1;
        if (isset($_POST['buyResourcesInterval'])) {
            $this->vars['formData']['buyResourcesInterval'] = (int)trim($_POST['buyResourcesInterval']);
            if (!in_array($_POST['buyResourcesInterval'], array_keys($this->vars['data']['buyResourcesInterval']))) {
                $this->vars['errors'][] = 'Buy resources interval is invalid.';
                $errors++;
            }
        }
        if (isset($_POST['startTimezone'])) {
            $this->vars['formData']['startTimezone'] = (int)trim($_POST['startTimezone']);
            if (!in_array($_POST['startTimezone'], array_keys($this->vars['data']['startTimezone']))) {
                $this->vars['errors'][] = 'Timezone is invalid.';
                $errors++;
            }
        }
        if (isset($_POST['startDay'])) {
            $this->vars['formData']['startDay'] = (int)trim($_POST['startDay']);
            if (!in_array($_POST['startDay'], array_keys($this->vars['data']['startDay']))) {
                $this->vars['errors'][] = 'Start day is invalid.';
                $errors++;
            }
        }
        if (isset($_POST['startHour'])) {
            $this->vars['formData']['startHour'] = trim($_POST['startHour']);
            if (!in_array($_POST['startHour'], $this->vars['data']['startHour'])) {
                $this->vars['errors'][] = 'Start hour is invalid.';
                $errors++;
            }
        }

        if (isset($_POST['auto_reinstall'])) {
            $this->vars['formData']['auto_reinstall'] = (int)trim($_POST['auto_reinstall']);
            if (!in_array($_POST['auto_reinstall'], array_keys($this->vars['data']['auto_reinstall']))) {
                $this->vars['errors'][] = 'Auto reinstall value is invalid.';
                $errors++;
            }
        }

        if (isset($_POST['auto_reinstall_start_after'])) {
            $this->vars['formData']['auto_reinstall_start_after'] = (int)trim($_POST['auto_reinstall_start_after']);
            if (!in_array($_POST['auto_reinstall_start_after'], array_keys($this->vars['data']['auto_reinstall_start_after']))) {
                $this->vars['errors'][] = 'Auto reinstall start after value is invalid.';
                $errors++;
            }
        }

        $this->vars['formData']['isPromoted'] = isset($_POST['isPromoted']) && $_POST['isPromoted'] == 1 ? 1 : 0;
        $this->vars['formData']['serverHidden'] = isset($_POST['serverHidden']) && $_POST['serverHidden'] == 1 ? 1 : 0;
        $this->vars['formData']['activation'] = isset($_POST['activation']) && $_POST['activation'] == 1 ? 1 : 0;
        $this->vars['formData']['buyAdventure'] = isset($_POST['buyAdventure']) && $_POST['buyAdventure'] == 1 ? 1 : 0;
        $this->vars['formData']['instantFinishTraining'] = isset($_POST['instantFinishTraining']) && $_POST['instantFinishTraining'] == 1 ? 1 : 0;
        $this->vars['formData']['needPreregistrationCode'] = isset($_POST['needPreregistrationCode']) && $_POST['needPreregistrationCode'] == 1 ? 1 : 0;
        return $errors;
    }
}