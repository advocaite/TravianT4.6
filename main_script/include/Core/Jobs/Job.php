<?php

namespace Core\Jobs;

use Core\Config;
use Core\Database\DB;
use Core\ErrorHandler;
use function gc_enable;
use function logError;

class Job
{
    private $lastReload = 0;
    private $interval;
    private $callback;
    private $name;

    /**
     * @param            $name
     * @param            $interval
     * @param callable $callBack
     * @param bool|FALSE $daemon
     * #return Job
     */
    public function __construct($name, $interval, $callBack, $daemon = FALSE)
    {
        global $prgName;
        $this->lastReload = time();
        $prgName = $name;
        $this->name = $name;
        $this->callback = $callBack;
        if ($daemon) {
            global $PIDs, $loop;
            $PIDs[$name] = pcntl_fork();
            $loop = TRUE;
            pcntl_signal(SIGTERM,
                function ($signal) {
                    global $prgName, $loop;
                    $loop = FALSE;
                });
            if ($PIDs[$name] === 0) {
                $this->setInterval($interval);
                $db = DB::getInstance()->forceNewDatabase();
                $config = Config::getInstance();
                ini_set("memory_limit", -1);
                $db->query("UPDATE config SET needsRestart=0");
                gc_enable();

                $nextLoop = miliseconds();

                while ($loop) {
                    mt_srand(make_seed());
                    $config->dynamic = (object)$db->query("SELECT * FROM config LIMIT 1")->fetch_assoc();
                    if ($config->dynamic->needsRestart == 1) {
                        $loop = false;
                        pcntl_signal_dispatch();
                        continue;
                    }
                    $exclude = $name == 'postService' && $config->dynamic->postServiceDone == 0;
                    if ($config->dynamic->finishStatusSet && !$exclude) $loop = false;
                    try {
                        if ($config->dynamic->automationState || $exclude) $this->runJob($callBack, TRUE);
                    } catch (\Exception $e) {
                        ErrorHandler::getInstance()->handleExceptions($e);
                        sleep(2);
                    } catch (\Error $e) {
                        ErrorHandler::getInstance()->handleExceptions($e);
                        sleep(2);
                    }
                    if ($config->game->start_time > time()) sleep(5);
                    usleep(max($this->interval * 1000 * 1000, 500));
                    pcntl_signal_dispatch();
                    if (rand(5, 100) % 5 == 0) {
                        gc_collect_cycles(); //Forces collection of any existing garbage cycles
                    }
                }
                exit();
            }
        } else {
            $this->setInterval($interval);
            return $this;
        }
        return null;
    }

    private function setInterval($sec)
    {
        $this->interval = $sec;
    }

    public function runJob($callBack, $daemon = false)
    {
        if (!$this->checkInterval($daemon)) {
            return;
        }
        $db = DB::getInstance();
        if (!$db->checkConnection()) {
            return;
        }
        $this->updateLastReload();
        if (is_callable($callBack)) {
            $callBack();
        } else {
            foreach ($callBack as $cb) {
                try {
                    if (method_exists($cb, "runAction")) {
                        $cb->runAction();
                    } else {
                        logError(print_r($this, TRUE));
                    }
                } catch (\Exception $e) {
                    ErrorHandler::getInstance()->handleExceptions($e);
                    sleep(2);
                }
            }
        }
    }

    private function checkInterval($daemon)
    {
        if ($daemon) return true;
        if (time() - $this->lastReload >= $this->interval) {
            return TRUE;
        }
        return FALSE;
    }

    private function updateLastReload()
    {
        $this->lastReload = time();
    }

    public function runAction()
    {
        try {
            $this->runJob($this->callback);
        } catch (\Exception $e) {
            ErrorHandler::getInstance()->handleExceptions($e);
        }
    }
}