#!/usr/bin/php -q
<?php
declare(ticks=1);
ini_set("display_errors", 1);
error_reporting(E_ALL);
set_time_limit(0);
ini_set("error_log", __DIR__ . '/error_log.log');
use Core\DB;
use Core\ServerManager;
use Core\Task;
require __DIR__ . "/include/bootstrap.php";
class TaskRunner
{
    //edit
    private $users = [
        'USERNAME_HERE' => [
            'main_domain' => 'YOUR_DOMAIN',
            'type' => 'cloudflare',
            'zone_id' => 'ZONEID',
            'email' => 'Email@email.com',
            'api_key' => 'API_KEY',
        ],
    ];

    private function runTasks($user, $userData)
    {
        $globalConfigFileLocation = sprintf('/home/travian/%s/globalConfig.php', $user);
        //$globalConfigFileLocation = sprintf('/travian/sections/globalConfig.php', $user);
        if (!is_file($globalConfigFileLocation)) {
            return; //Not able to run
        }
        require $globalConfigFileLocation;
        global $globalConfig;
        $db = new DB();
        $databaseDetails = $globalConfig['dataSources']['globalDB'];
        $db->doConnectManual(
            $databaseDetails['hostname'],
            $databaseDetails['username'],
            $databaseDetails['password'],
            $databaseDetails['database'],
            $databaseDetails['charset']
        );
        $serverManager = new ServerManager($db, $user, $userData);
        $tasks = $db->query("SELECT * FROM taskQueue WHERE status='pending' ORDER BY id ASC");
        while ($task = $tasks->fetch_assoc()) {
            $task = new Task($db, $task);
            switch ($task->getType()) {
                case 'uninstall':
                    $serverManager->uninstall($task);
                    break;
                case 'install':
                    $serverManager->install($task);
                    break;
                case 'flushTokens':
                    /** @noinspection PhpMethodParametersCountMismatchInspection */
                    $serverManager->flushToken($task);
                    break;
                case 'restart-engine':
                    $serverManager->restartEngine($task);
                    break;
                case 'start-engine':
                    $serverManager->startEngine($task);
                    break;
                case 'stop-engine':
                    $serverManager->stopEngine($task);
                    break;
            }
        }
        $db->close();
    }

    private $loop = true;

    public function __construct()
    {
        pcntl_signal(SIGTERM, function () {
            $this->loop = false;
        });
        $ip = trim(file_get_contents('https://ipv4.icanhazip.com'));
        if(filter_var($ip, FILTER_VALIDATE_IP) !== false){
            foreach($this->users as $user => $userData){
                $this->users[$user]['ip'] = $ip;
            }
        } else {
            die("Could not get valid IP.");
        }
    }

    public function run()
    {
        while ($this->loop) {
            foreach ($this->users as $user => $userData) {
                try {
                    $this->runTasks($user, $userData);
                } catch (\Throwable $e) {
                    logError($e->getMessage());
                }
            }
            sleep(5);
            pcntl_signal_dispatch();
        }
    }
}
$m = new TaskRunner();
$m->run();
