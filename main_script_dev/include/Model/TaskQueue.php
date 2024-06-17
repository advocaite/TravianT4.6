<?php

namespace Model;

use Core\Database\GlobalDB;

class TaskQueue
{
    const TASK_INSTALL = 'install';
    const TASK_UNINSTALL = 'uninstall';
    const TASK_ENGINE_RESTART = 'restart-engine';
    const TASK_ENGINE_START = 'start-engine';
    const TASK_ENGINE_STOP = 'stop-engine';
    const TASK_FLUSH_TOKENS = 'flushTokens';

    public static function addTask($type, $data = [], $description = '')
    {
        if (is_array($data)) {
            $data = json_encode($data);
        }
        $db = GlobalDB::getInstance();
        $db->query("INSERT INTO taskQueue (type, data, description, time) VALUES ('$type', '" . $db->real_escape_string($data) . "', '$description', " . time() . ")");
    }

}