<?php

use Core\Helper\TimezoneHelper;

class AdminLogCtrl
{
    public function __construct()
    {
        $dispatcher = Dispatcher::getInstance();
        $logs = AdminLog::getInstance()->getLastLogs(500);
        while ($row = $logs->fetch_assoc()) {
            $time = TimezoneHelper::autoDateString($row['time'], true);
            $HTML = "------------------------------------<br>
		<b>Log ID:</b> {$row['id']}<br />
		<b>Log:</b> {$row['log']} (IP: <b>{$row['ip']}</b>)<br />
		<b>Date:</b> $time<br />";
            $dispatcher->appendContent($HTML);
        }
    }
}