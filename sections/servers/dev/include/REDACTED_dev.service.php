#!/usr/bin/php -q
<?php
require __DIR__ . "/env.php";
if(IS_DEV){
    require("/travian/main_script_dev/include/AutomationEngine.php");
} else {
    require("/travian/main_script/include/AutomationEngine.php");
}