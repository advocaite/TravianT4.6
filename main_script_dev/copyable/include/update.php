<?php
require __DIR__ . "/env.php";
if(IS_DEV){
    require "/travian/main_script_dev/include/update.php";
} else {
    require "/travian/main_script/include/update.php";
}
