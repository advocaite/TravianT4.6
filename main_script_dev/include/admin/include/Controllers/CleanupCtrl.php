<?php

use Core\Database\DB;
use Game\NoticeHelper;
use resources\View\PHPBatchView;

class CleanupCtrl
{
    private $vars = [];

    public function __construct()
    {
        $db = DB::getInstance();
        if (isset($_REQUEST['do'])) {
            switch ($_REQUEST['do']) {
                case 'deleteReportsXDays':
                    if (isset($_REQUEST['days']) && is_numeric($_REQUEST['days']) && $_REQUEST['days'] >= 1) {
                        $time = time() - (int)$_REQUEST['days'] * 86400;
                        $rows = 0;
                        do {
                            $db->query("DELETE FROM ndata WHERE time < $time AND archive=0 AND non_deletable=0 LIMIT 50000");
                            $affected = $db->affectedRows();
                            $rows += $affected;
                            if ($affected < 1000) {
                                break;
                            }
                        } while (true);
                        $this->vars['success'] = sprintf('%s reports where removed.', $rows);
                    } else {
                        $this->vars['error'] = 'Nothing to do.';
                    }
                    break;
                case 'deleteGreenReportsXDays':
                    $types = [
                        NoticeHelper::TYPE_WON_AS_ATTACK_WITHOUT_CASUALTIES,
                        NoticeHelper::TYPE_WON_DEFENSE_WITHOUT_LOSSES,
                        NoticeHelper::TYPE_LOST_AS_DEFENDER_WITHOUT_CASUALTIES,
                    ];

                    if (isset($_REQUEST['days']) && is_numeric($_REQUEST['days']) && $_REQUEST['days'] >= 1) {
                        $rows = 0;
                        $time = time() - (int)$_REQUEST['days'] * 86400;
                        $types = implode(",", $types);
                        do {
                            $db->query("DELETE FROM ndata WHERE type IN ($types) AND time < $time AND archive=0 AND non_deletable=0  LIMIT 50000");
                            $affected = $db->affectedRows();
                            $rows += $affected;
                            if ($affected < 1000) {
                                break;
                            }
                        } while (true);
                        $this->vars['success'] = sprintf('%s reports where removed.', $rows);
                    } else {
                        $this->vars['error'] = 'Nothing to do.';
                    }
                    break;
            }
        }
        $template = PHPBatchView::render('admin/cleanup', $this->vars);
        Dispatcher::getInstance()->appendContent($template);
    }

}