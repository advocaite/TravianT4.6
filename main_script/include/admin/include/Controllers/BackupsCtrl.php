<?php

use Core\Caching\Caching;
use Core\Config;
use Core\Database\DB;
use Core\Helper\TimezoneHelper;
use Core\Helper\WebService;
use Model\InfoBoxModel;
use Model\TaskQueue;

class BackupsCtrl
{
    public function __construct()
    {
        $params['content'] = false;
        $cache = Caching::getInstance();
        ignore_user_abort(true);
        set_time_limit(0);
        ini_set("memory_limit", -1);
        if (!isServerFinished()) {
            if (isset($_GET['do_backup'])) {
                if ($cache->lock("backup_database")) {
                    DB::getInstance()->backup_tables();
                    $cache->unlock("backup_database");
                    $this->showError(1);
                } else {
                    $this->showError(2);
                }
            } else if (isset($_GET['force_unlock_backup'])) {
                $cache->unlock("backup_database");
                $this->showError(3);
            } else if (isset($_GET['force_unlock_restore'])) {
                $cache->unlock("restore_database");
                $this->showError(6);
            } else if (isset($_GET['restore_backup'])) {
                if ($cache->lock("restore_database")) {
                    $file = BACKUP_PATH . "/" . trim(basename($_GET['restore_backup'])) . '.sql';
                    if (is_file($file)) {
                        $time = floor(explode("-", $file)[1] / 1000);
                        $delayTime = (time() - $time);
                        $conf = Config::getInstance();
                        DB::getInstance()->query("UPDATE config SET needsRestart=1, isRestore=1");
                        TaskQueue::addTask(TaskQueue::TASK_ENGINE_STOP,
                            ['service' => Config::getProperty("settings", "engine_filename")],
                            sprintf('Stopping (backup restore) engine %s', getWorldId()));
                        sleep(15);
                        $sql = gzdecode(file_get_contents($file));
                        if ($sql !== FALSE) {
                            DB::getInstance()->multi_query($sql);
                            DB::getInstance()->query("UPDATE config SET delayTime=" . $delayTime);

                            $infoBoxModel = new InfoBoxModel();
                            $infoBoxModel->deleteInfoByTypeInServer(8);
                            $infoBoxModel->deleteInfoByTypeInServer(9);
                            $infoBoxModel->deleteInfoByTypeInServer(15);

                            $infoBoxModel->addInfo(0, 1, 8, '', $conf->timers->ArtifactsReleaseTime + $delayTime - 3 * 86400, $conf->timers->ArtifactsReleaseTime + $delayTime);
                            $infoBoxModel->addInfo(0, 1, 9, '', $conf->timers->wwPlansReleaseTime + $delayTime - 3 * 86400, $conf->timers->wwPlansReleaseTime + $delayTime);

                            if ($conf->game->catapultAvailableTime > $conf->game->start_time) {
                                $infoBoxModel->addInfo(0, 1, 15, '', $conf->game->start_time, $conf->game->catapultAvailableTime);
                            }

                            InfoBoxModel::invalidatePublicInfoBox();
                            InfoBoxModel::invalidateAllUsersPrivateInfoBox();
                            sleep(1);
                            require(INCLUDE_PATH . "/update.php");
                        }

                        DB::getInstance()->query("UPDATE config SET isRestore=0");

                        TaskQueue::addTask(TaskQueue::TASK_ENGINE_START,
                            ['service' => Config::getProperty("settings", "engine_filename")],
                            sprintf('Starting (backup restore) engine %s', getWorldId()));

                        $cache->unlock("restore_database");
                        $this->showError(4);
                    } else {
                        $cache->unlock("restore_database");
                        $this->showError(8);
                    }
                } else {
                    $this->showError(5);
                }
            } else if (isset($_GET['del_backup'])) {
                $file = BACKUP_PATH . "/" . trim(basename($_GET['del_backup'])) . '.sql';
                if (is_file($file)) {
                    unlink($file);
                    $this->showError(7);
                } else {
                    $this->showError(8);
                }
            }
        }
        $backups = glob(BACKUP_PATH . "/*.sql");
        $i = 0;
        $total_size = 0;
        foreach ($backups as $filename) {
            $real_file = $filename;
            $filename = basename($filename, '.sql');
            $x = explode("-", $filename);
            $params['content'] .= '<tr>';
            $params['content'] .= '<td style="width: 5%; text-align: center"><a href="?action=backups&del_backup=' . $filename . '"><img class="del" src="img/x.gif"></a></td>';
            $params['content'] .= '<td style="width: 5%; text-align: center">' . ++$i . '</td>';
            $params['content'] .= '<td style="text-align: center">' . TimezoneHelper::autoDateString($x[1] / 1000, true) . '</td>';
            $params['content'] .= '<td style="text-align: center">' . human_filesize(filesize($real_file)) . '</td>';
            $params['content'] .= '<td style="text-align: center"><a href="?action=backups&restore_backup=' . $filename . '">Restore backup</a></td>';
            $params['content'] .= '</tr>';
            $total_size += filesize($real_file);
        }
        if (!sizeof($backups)) {
            $params['content'] .= '<tr>';
            $params['content'] .= '<td colspan="5" class="noData" style="text-align: center">No backups up to now.</td>';
            $params['content'] .= '</tr>';
        }


        $params['totalSize'] = human_filesize($total_size);
        $errors = [
            1 => 'Backup complete.',
            2 => 'A backup is already in progress.',
            3 => 'Backup lock unlocked.',
            4 => 'Restore complete. You need to restart the game engine to continue. (All processes will be stopped.)',
            5 => 'A restore is already in progress.',
            6 => 'Restore lock unlocked.',
            7 => 'Backup removed.',
            8 => 'Backup not found.',
        ];
        if (isset($_GET['e']) && isset($errors[$_GET['e']])) {
            $params['error'] = $errors[$_GET['e']];
        }
        $dispatcher = Dispatcher::getInstance();
        $dispatcher->appendContent(Template::getInstance()->load($params, 'tpl/backups.tpl')->getAsString());
    }

    private function showError($num)
    {
        WebService::redirect("?action=backups&e=$num");
    }
}