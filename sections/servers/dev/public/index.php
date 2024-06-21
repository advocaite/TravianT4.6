<?php
require dirname(__DIR__) . "/include/env.php";
if(IS_DEV){
    require "/travian/main_script_dev/include/mainInclude.php";
} else {
    require "/travian/main_script/include/mainInclude.php";
}