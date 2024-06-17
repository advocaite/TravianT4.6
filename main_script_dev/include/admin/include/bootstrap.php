<?php
define("ADMIN_PANEL", true);
require("Core" . DIRECTORY_SEPARATOR . "Dispatcher.php");
require("Core" . DIRECTORY_SEPARATOR . "AdminLog.php");
Template::getInstance()->load(Dispatcher::getInstance()->data, 'tpl/layout.tpl')->display();