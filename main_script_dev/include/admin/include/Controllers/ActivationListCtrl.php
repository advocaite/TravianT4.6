<?php

use Core\Database\DBI;

class ActivationListCtrl
{
    private $db;
    public function __construct()
    {
        $this->db = DBI::getInstance();
        if (!isServerFinished() && isset($_REQUEST['section']) && $_REQUEST['section'] == 'del' && isset($_REQUEST['id'])) {
            $this->db->run("DELETE FROM activation WHERE id=?", (int)$_REQUEST['id']);
        }
        $page = isset($_GET['p']) ? abs((int)$_GET['p']) : 1;
        $result = $this->db->run("SELECT * FROM activation ORDER BY id DESC");
        $params['total'] = $this->db->fetchScalar("SELECT COUNT(id) FROM activation");
        $params['content'] = null;
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $params['content'] .= '<tr>';
            $params['content'] .= '<td style="text-align: center;"><a href="admin.php?action=activationList&id=' . $row['id'] . '&section=del"><img src="img/x.gif" class="del"></a></td>';
            $params['content'] .= '<td style="text-align: center;">' . $row['name'] . '</td>';
            $params['content'] .= '<td style="text-align: center;">' . $row['email'] . '</td>';
            $link = '/activate.php?token=' . $row['token'];
            $params['content'] .= '<td style="text-align: center;"><a href="' . $link . '">Activation</a></td>';
            $params['content'] .= '</tr>';
        }
        if (!$result->rowCount()) {
            $params['content'] .= '<tr><td colspan="6" class="hab"><span class="errorMessage">No activation.</span></td></tr>';
        }
        \Dispatcher::getInstance()->appendContent(\Template::getInstance()->load($params, 'tpl/activationList.tpl')->getAsString());
    }
}