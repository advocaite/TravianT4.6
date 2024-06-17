<?php
if(!(php_sapi_name() == 'cli')){
    exit("CLI Only!");
}
require __DIR__ . "/env.php";
if(IS_DEV){
    require "/travian/main_script_dev/include/bootstrap.php";
} else {
    require "/travian/main_script/include/bootstrap.php";
}
use Core\Config;
use Core\Database\DB;
use Model\InstallerModel;
mt_srand(make_seed());
class shell_installer
{
    public function __construct($password)
    {
        if (empty($password)) {
            $password = sha1(time());
        }
        echo 'before install.';
        if (Config::getInstance()->dynamic->installed) {
            echo 'Installation is completed.' . PHP_EOL;
        } else {
            echo 'Begin installation...';
            ini_set('memory_limit', -1);
            set_time_limit(0);
            //fclose(fopen("installation.log", "w"));
            $installer = new InstallerModel();
            $installer->mapToArray();
            $installer->createRestOfTheMap();
            $installer->pushMapToDB();
            $installer->finalize($password);
            $db = DB::getInstance();
            $db->query("UPDATE odata SET lasttrain=" . Config::getProperty('game', 'start_time'));
            exit();
        }
    }
}
new shell_installer(trim($argv[2]));