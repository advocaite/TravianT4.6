<?php
use Core\Config;
use Core\Database\GlobalDB;
class VerificationListCtrl
{
    const NEXT_SHAPE = '»';
    const PREVIOUS_SHAPE = '«';
    private $pageSize = 50;
    public function __construct()
    {
        $db = GlobalDB::getInstance();
        if (!isServerFinished() && isset($_REQUEST['section']) && $_REQUEST['section'] == 'del' && isset($_REQUEST['id'])) {
            $db->query("DELETE FROM activation WHERE id=" . (int)$_REQUEST['id']);
        }
        $result = $db->query("SELECT * FROM activation WHERE used=0 AND worldId=" . getWorldUniqueId() . " ORDER BY id");
        $params['content'] = null;
        $params['total'] = $db->fetchScalar("SELECT COUNT(id) FROM activation WHERE used=0");
        while ($row = $result->fetch_assoc()) {
            $params['content'] .= '<tr>';
            $params['content'] .= '<td style="text-align: center;"><a href="admin.php?action=verificationList&id=' . $row['id'] . '&section=del"><img src="img/x.gif" class="del"></a></td>';
            $link = Config::getProperty("settings", "indexUrl") . '?server=' . getWorldId() . '&activationCode=' . $row['activationCode'] . '#activation';
            $params['content'] .= '<td style="text-align: center;">' . $row['name'] . '</td>';
            $params['content'] .= '<td style="text-align: center;">' . $row['email'] . '</td>';
            $params['content'] .= '<td style="text-align: center;"><a href="' . $link . '">' . $row['activationCode'] . '</a></td>';
            $params['content'] .= '</tr>';
        }
        if (!$result->num_rows) {
            $params['content'] .= '<tr><td colspan="6" class="hab"><span class="errorMessage">No verification.</span></td></tr>';
        }
        \Dispatcher::getInstance()->appendContent(\Template::getInstance()->load($params, 'tpl/verificationList.tpl')->getAsString());
    }
}