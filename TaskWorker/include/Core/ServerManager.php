<?php
namespace Core;
use const FILE_APPEND;
use function file_get_contents;
use function file_put_contents;
use function generate_guid;
use function is_numeric;
use function shell_exec;
use const INCLUDE_PATH;
use const PHP_BINARY_LOC;
use ClouDNS_SDK;

class ServerManager
{
    private $user;
    private $userData;
    private $globalDB;
    private $script_locations = [
        'dev' => '/travian/main_script_dev/',
        'prod' => '/travian/main_script/',
    ];

    public function __construct(DB $globalDB, $user, array $userData)
    {
        $this->user = $user;
        $this->userData = $userData;
        $this->globalDB = $globalDB;
    }

    public function install(Task $task)
    {
        $installationData = $task->getData();
        if ($this->doesSubDomainExists($installationData['worldId'])) {
            $task->setAsFailed('Subdomain already exists.');
            return;
        }
        $dbPassword = generateStrongPassword(36);
        $gameWorldUrl = 'http://' . sprintf("%s.%s", $installationData['worldId'], $this->userData['main_domain']) . '/';
        $basePath = $this->script_locations[$installationData['worldId'] == 'dev' ? 'dev' : 'prod'];
        $script_path = $this->getGameWorldBaseLocation($installationData['worldId']);
        $connectionFile = "{$script_path}include/connection.php";
        $installerFile = "{$script_path}include/install.php";
        $updateFile = "{$script_path}include/update.php";
        $envFile = "{$script_path}include/env.php";

        $nginxConf = file_get_contents(INCLUDE_PATH . "nginx.conf");
        $nginxConf = str_replace(
            [
                '[USER]',
                '[PUBLIC_PATH]',
                '[SERVER_NAME]',
            ],
            [
                $this->user,
                "/home/travian/{$this->user}/servers/{$installationData['worldId']}/public",
                "{$installationData['worldId']}.{$this->userData['main_domain']}",
            ],
            $nginxConf
        );
        file_put_contents("/etc/nginx/conf.d/{$this->user}_{$installationData['worldId']}.conf", $nginxConf);
        $this->addDnsRecord($installationData['worldId']);
        shell_exec('systemctl reload nginx');
        $from_location = $this->script_locations[$installationData['worldId'] == 'dev' ? 'dev' : 'prod'] . '/copyable/';
        $to_location = $this->getGameWorldBaseLocation($installationData['worldId']);
        shell_exec("rsync --chown=travian:travian -a --delete \"$from_location\" \"$to_location\"");
        $databaseName = sprintf("%s_%s", substr($this->user, 0, 8), $installationData['worldId']);
        // Create database with $databaseName $dbPassword
        echo shell_exec("mysql -u root -e \"CREATE DATABASE $databaseName\"");
        echo shell_exec("mysql -u root -e \"CREATE USER {$databaseName} IDENTIFIED BY '{$dbPassword}'\"");
        echo shell_exec("mysql -u root -e \"GRANT ALL PRIVILEGES ON {$databaseName}.* TO {$databaseName}\"");
        file_put_contents($envFile, str_replace('\'%[IS_DEV]%\'', $installationData['worldId'] == 'dev' ? 'true' : 'false', file_get_contents($envFile)));
        $order = [
            '[PAYMENT_FEATURES_TOTALLY_DISABLED]',
            '[TITLE]',
            '[GAME_WORLD_URL]',
            '[GAME_SERVER_NAME]',
            '[DATABASE_HOST]',
            '[DATABASE_DATABASE]',
            '[DATABASE_USERNAME]',
            '[DATABASE_PASSWORD]'
        ];
        $order_values = [
            'false',
            $installationData['worldId'],
            $gameWorldUrl,
            $installationData['serverName'],
            'localhost',
            $databaseName,
            $databaseName,
            $dbPassword,
        ];
        $connection_content = file_get_contents($connectionFile);
        $connection_content = str_replace($order, $order_values, $connection_content);
        $order = [
            '[SETTINGS_WORLD_ID]',
            '[SETTINGS_WORLD_UNIQUE_ID]',
            '[GAME_SPEED]',
            '[GAME_START_TIME]',
            '[GAME_ROUND_LENGTH]',
            '[SECURE_HASH_CODE]',
            '[AUTO_REINSTALL]',
            '[AUTO_REINSTALL_START_AFTER]',
            '[ENGINE_FILENAME]',
        ];
        $installationData['isPromoted'] = $installationData['isPromoted'] ? 1 : 0;
        $installationData['serverHidden'] = $installationData['worldId'] == 'dev' || $installationData['serverHidden'] ? 1 : 0;
        $installationData['needPreregistrationCode'] = $installationData['needPreregistrationCode'] ? 1 : 0;
        $this->globalDB->query("INSERT INTO `gameServers`(`worldId`, `speed`, `name`, `version`, `gameWorldUrl`, `startTime`, `roundLength`, `preregistration_key_only`, `promoted`, `hidden`, `configFileLocation`, `activation`) VALUES ('{$installationData['worldId']}', '{$installationData['speed']}', '{$installationData['serverName']}','4','$gameWorldUrl','{$installationData['startTime']}','{$installationData['roundLength']}','{$installationData['needPreregistrationCode']}','{$installationData['isPromoted']}', '{$installationData['serverHidden']}', '{$connectionFile}', {$installationData['activation']})");
        $worldUniqueId = $this->globalDB->lastInsertId();
        $processName = $this->getBashName($installationData['worldId']);
        $multihunterPassword = md5(sha1(generate_password(11)));
        $order_values = [
            $installationData['worldId'],
            $worldUniqueId,
            $installationData['speed'],
            $installationData['startTime'],
            $installationData['roundLength'],
            md5(sha1(microtime())),
            isset($installationData['auto_reinstall']) ? $installationData['auto_reinstall'] : 0,
            isset($installationData['auto_reinstall_after']) ? $installationData['auto_reinstall_after'] : 86400,
            $processName
        ];
        $connection_content = str_replace($order, $order_values, $connection_content);
        file_put_contents($connectionFile, $connection_content);
        $db = ServerDB::newConnection($connectionFile);
        //import database
        $db->multi_query(file_get_contents($basePath . 'include/schema/T4.4.sql'));
        //add config row
        $db->query("INSERT INTO `config`(`startTime`, `map_size`, `worldUniqueId`, `installed`, `loginInfoTitle`, `loginInfoHTML`, `message`) VALUES ({$installationData['startTime']}, {$installationData['mapSize']}, $worldUniqueId, 0, '', '', '')");
        $db->close();
        {
            $automationDestination = "{$script_path}include/{$processName}.php";
            shell_exec("chown travian:travian $automationDestination");
            file_put_contents($automationDestination, file_get_contents($script_path . "/include/Automation.php"));
        }
        $shell_content = str_replace(
            [
                '[SERVER_WORLD_ID]',
                '[SERVER_BASH_LOCATION]',
                '[SERVER_PID_LOCATION]',
                '[SERVER_USER]',
            ], [
            $installationData['worldId'],
            "{$script_path}include/$processName.php",
            "{$script_path}include/$processName.pid",
            'travian',
        ],
            file_get_contents($script_path . "include/Automation.service")
        );
        $cmd = sprintf('%s -dmemory_limit=2048M "%s" "%s" "%s"', PHP_BINARY_LOC, $installerFile, $installationData['worldId'], $multihunterPassword);
        $this->createBashService($installationData['worldId'], $shell_content);
        shell_exec("systemctl stop $processName");
        shell_exec("chmod a+x {$script_path}include/{$processName}.php");
        shell_exec("chmod +x $installerFile");
        shell_exec("sudo -u travian " . PHP_BINARY_LOC . ' "' . $updateFile . '" "' . $installationData['worldId'] . '" --new-installation');
        shell_exec("rm -rf \"{$script_path}include/Automation.service\" \"{$script_path}include/Automation.php\"");
        shell_exec($cmd);
        $configCustom = [
            '<?php',
            'global $globalConfig, $config;'
        ];
        if (isset($installationData['startGold']) && is_numeric($installationData['startGold'])) {
            $configCustom[] = sprintf('$config->gold->startGold = %s;', (int)$installationData['startGold']);
        }
        if (isset($installationData['buyTroops'])) {
            $configCustom[] = sprintf(
                '$config->extraSettings->buyTroops[\'enabled\'] = %s;',
                $installationData['buyTroops'] == 1 ? 'true' : 'false'
            );
        }
        if (isset($installationData['buyAnimals'])) {
            $configCustom[] = sprintf(
                '$config->extraSettings->buyAnimal[\'enabled\'] = %s;',
                $installationData['buyAnimals'] == 1 ? 'true' : 'false'
            );
        }
        if (isset($installationData['buyResources'])) {
            $configCustom[] = sprintf(
                '$config->extraSettings->buyResources[\'enabled\'] = %s;',
                $installationData['buyResources'] == 1 ? 'true' : 'false'
            );
        }
        if (isset($installationData['buyTroopsInterval']) && is_numeric($installationData['buyTroopsInterval'])) {
            $configCustom[] = sprintf(
                '$config->extraSettings->buyTroops[\'buyInterval\'] = %s;',
                (int)$installationData['buyTroopsInterval']
            );
        }
        if (isset($installationData['buyResourcesInterval']) && is_numeric($installationData['buyResourcesInterval'])) {
            $configCustom[] = sprintf(
                '$config->extraSettings->buyResources[\'buyInterval\'] = %s;',
                (int)$installationData['buyResourcesInterval']
            );
        }
        if (isset($installationData['buyAnimalsInterval']) && is_numeric($installationData['buyAnimalsInterval'])) {
            $configCustom[] = sprintf(
                '$config->extraSettings->buyAnimal[\'buyInterval\'] = %s;',
                (int)$installationData['buyAnimalsInterval']
            );
        }
        if (isset($installationData['protectionHours']) &&
            is_numeric($installationData['protectionHours']) && $installationData['protectionHours'] >= 0) {
            $configCustom[] = sprintf(
                '$config->game->protection_time = %s * 3600;',
                (int)$installationData['protectionHours']
            );
        }
        if (isset($installationData['instantFinishTraining'])) {
            $configCustom[] = sprintf(
                '$config->extraSettings->generalOptions->finishTraining->enabled = %s;',
                $installationData['instantFinishTraining'] == 1 ? 'true' : 'false'
            );
        }
        if (isset($installationData['buyAdventure'])) {
            $configCustom[] = sprintf(
                '$config->extraSettings->generalOptions->buyAdventure->enabled = %s;',
                $installationData['buyAdventure'] == 1 ? 'true' : 'false'
            );
        }
        $configCustom = implode("\n", $configCustom);
        $fp = fopen("{$script_path}include/config.custom.php", 'w');
        fwrite($fp, $configCustom);
        fclose($fp);
        shell_exec("systemctl start $processName");
        shell_exec("systemctl enable $processName");
        $this->flushToken();
        $task->setAsCompleted();
    }

    public function restartEngine(Task $task)
    {
        $service = str_replace('.service', null, $task->getData()['service']);
        $action = 'restart';
        list($username, $worldId) = explode("_", $service);
        $file = sprintf('/travian/services/%s/%s.service', $this->user, $service);
        if (is_file($file)) {
            shell_exec("chmod +x $file");
            if (in_array($action, ['start', 'stop', 'restart', 'status'])) {
                shell_exec("systemctl $action $service");
                Notification::markdown($this->globalDB, "Engine restarted for server $worldId.");
                $task->setAsCompleted();
            } else {
                $task->setAsFailed('Invalid action');
            }
        } else {
            $task->setAsFailed('Action not allowed');
        }
    }

    public function startEngine(Task $task)
    {
        $service = str_replace('.service', null, $task->getData()['service']);
        $action = 'start';
        list($username, $worldId) = explode("_", $service);
        $file = sprintf('/travian/services/%s/%s.service', $this->user, $service);
        if (is_file($file)) {
            shell_exec("chmod +x $file");
            if (in_array($action, ['start', 'stop', 'restart', 'status'])) {
                shell_exec("systemctl $action $service");
                Notification::markdown($this->globalDB, "Engine started for server $worldId.");
                $task->setAsCompleted();
            } else {
                $task->setAsFailed('Invalid action');
            }
        } else {
            $task->setAsFailed('Action not allowed');
        }
    }

    public function stopEngine(Task $task)
    {
        $service = str_replace('.service', null, $task->getData()['service']);
        $action = 'stop';
        list($username, $worldId) = explode("_", $service);
        $file = sprintf('/travian/services/%s/%s.service', $this->user, $service);
        if (is_file($file)) {
            shell_exec("chmod +x $file");
            if (in_array($action, ['start', 'stop', 'restart', 'status'])) {
                shell_exec("systemctl $action $service");
                Notification::markdown($this->globalDB, "Engine stopped for server $worldId.");
                $task->setAsCompleted();
            } else {
                $task->setAsFailed('Invalid action');
            }
        } else {
            $task->setAsFailed('Action not allowed');
        }
    }

    public function flushToken(Task $task = null)
    {
        $token = generate_guid();
        $this->globalDB->query("UPDATE paymentConfig SET loginToken='$token'");
        $loginLinks = [];
        $find = $this->globalDB->query("SELECT * FROM gameServers");
        while ($row = $find->fetch_assoc()) {
            $worldId = $row['worldId'];
            $gameWorldUrl = $row['gameWorldUrl'];
            $serverDB = ServerDB::newConnection($row['configFileLocation']);
            {
                //Updating multihunter and support and Natars passwords
                $passwordSupport = sha1(generate_guid());
                $serverDB->query("UPDATE users SET password='$passwordSupport' WHERE id=0 OR id=1");
                $passwordMultihunter = sha1(generate_guid());
                $serverDB->query("UPDATE users SET password='$passwordMultihunter' WHERE id=2");
            }
            $loginLinks[$worldId] = [
                'admin' => $gameWorldUrl . '/login.php?action=adminLogin&hash=' . sha1($passwordSupport) . '&token=' . $token,
                'multihunter' => $gameWorldUrl . '/login.php?action=multiLogin&hash=' . sha1($passwordMultihunter) . '&token=' . $token,
            ];
            $serverDB->close();
        }
        $text = '';
        $c = '------------';
        foreach ($loginLinks as $worldId => $link) {
            $link['multihunter'] = '[' . "{$c}{$worldId}{$c}" . '](' . $link['multihunter'] . ')';
            $text .= sprintf("%s\n", $link['multihunter']);
        }
        Notification::markdown($this->globalDB, "*Tokens:*\n" . $text, true);
        if ($task) {
            $task->setAsCompleted();
        }
    }

    public function createBashService($name, $content)
    {
        $processes = [
            "rm -rf /etc/systemd/system/{$this->getBashName($name)}",
            "rm -rf /travian/services/{$this->user}/{$this->getBashName($name)}",
            "touch /travian/services/{$this->user}/{$this->getBashName($name)}",
        ];
        foreach ($processes as $cmd) {
            shell_exec($cmd);
        }
        file_put_contents("/travian/services/{$this->user}/{$this->getBashName($name)}", $content);
        shell_exec(sprintf('chown travian:travian %s', "/travian/services/{$this->user}/{$this->getBashName($name)}"));
        shell_exec("ln /travian/services/{$this->user}/{$this->getBashName($name)} /etc/systemd/system/{$this->getBashName($name)}");
        shell_exec('systemctl daemon-reload');
    }

    private function doesSubDomainExists($name)
    {
        if (is_file("/etc/nginx/conf.d/{$this->user}_{$name}.conf")) {
            return true;
        }
        return false;
    }

    public function getDnsManager()
    {
        global $config;
        if($this->userData['type'] == 'cloudflare'){
            $key = new \Cloudflare\API\Auth\APIKey($this->userData['email'], $this->userData['api_key']);
            return new \Cloudflare\API\Adapter\Guzzle($key);
        }
        return new ClouDNS_SDK($this->userData['auth_id'], $this->userData['auth_password']);
    }

    private function addDnsRecord($subdomain){
        if($this->userData['type'] == 'cloudns'){
            $dns = $this->getDnsManager();
            $result = $dns->dnsAddRecord($this->userData['main_domain'], 'A', $subdomain, $this->userData['ip'], 3600);
            $dns->dnsChangeRecordStatus($this->userData['main_domain'], $result['data']['id'], true);
        } else {
            $dns = new \Cloudflare\API\Endpoints\DNS($this->getDnsManager());
            $dns->addRecord($this->userData['zone_id'], 'A', sprintf('%s.%s', $subdomain, $this->userData['main_domain']), $this->userData['ip'], '3600', true);
        }
    }

    private function deleteDnsRecord($subdomain){
        $dns = $this->getDnsManager();
        if($this->userData['type'] == 'cloudns'){
            foreach($dns->dnsListRecords($this->userData['main_domain'], $subdomain) as $record){
                $dns->dnsDeleteRecord($this->userData['main_domain'], $record['id']);
            }
        } else {
            $dns = new \Cloudflare\API\Endpoints\DNS($this->getDnsManager());
            foreach($dns->listRecords($this->userData['zone_id'], 'A', sprintf('%s.%s', $subdomain, $this->userData['main_domain']))->result as $record){
                $dns->deleteRecord($this->userData['zone_id'], $record->id);
            }
        }
    }

    private function getBashName($name)
    {
        return $this->user . '_' . $name . '.service';
    }

    private function getGameWorldBaseLocation($worldId = null)
    {
        return '/home/travian/' . $this->user . '/servers/' . (!is_null($worldId) ? $worldId . '/' : '');
    }

    public function uninstall(Task $task)
    {
        $gameWorld = $this->globalDB->query("SELECT * FROM gameServers WHERE id={$task->getData()['id']}");
        if (!$gameWorld->num_rows) {
            $task->setAsFailed('Game world not found.');
            return;
        }
        $gameWorld = $gameWorld->fetch_assoc();
        if (!$this->doesSubDomainExists($gameWorld['worldId'])) {
            $task->setAsFailed('Subdomain not found.');
            return;
        }
        shell_exec(sprintf("systemctl disable %s", $this->getBashName($gameWorld['worldId'])));
        shell_exec(sprintf("systemctl stop %s", $this->getBashName($gameWorld['worldId'])));
        shell_exec(sprintf("rm -rf /etc/systemd/system/%s", $this->getBashName($gameWorld['worldId'])));
        shell_exec(sprintf("rm -rf /travian/services/{$this->user}/%s", $this->getBashName($gameWorld['worldId'])));

        shell_exec("rm -rf /etc/nginx/conf.d/{$this->user}_{$gameWorld['worldId']}.conf");

        $this->deleteDnsRecord($gameWorld['worldId']);

        shell_exec('systemctl reload nginx');

        $this->globalDB->query("DELETE FROM preregistration_keys WHERE worldId={$gameWorld['id']}");
        $this->globalDB->query("DELETE FROM activation WHERE worldId={$gameWorld['id']}");
        $this->globalDB->query("DELETE FROM gameServers WHERE id={$gameWorld['id']}");
        $databaseName = sprintf("%s_%s", substr($this->user, 0, 8), $gameWorld['worldId']);

        shell_exec("mysql -u root -e \"DROP DATABASE $databaseName\"");
        shell_exec("mysql -u root -e \"DROP USER {$databaseName}\"");

        shell_exec(sprintf("rm -rf %s", $this->getGameWorldBaseLocation($gameWorld['worldId'])));
        $this->flushToken();
        $task->setAsCompleted();
    }
}