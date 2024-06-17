<?php

namespace Controller;

use Core\Database\DB;
use Core\Locale;
use resources\View\OutOfGameView;

class PasswordCtrl extends OutOfGameCtrl
{
    public function __construct()
    {
        $this->view = new OutOfGameView();
        $this->view->vars['titleInHeader'] = T("Login", "Login");
        $this->view->vars['bodyCssClass'] = 'perspectiveBuildings';
        $this->view->vars['contentCssClass'] = 'login';
        $npw = isset($_GET['npw']) ? filter_var($_GET['npw'], FILTER_SANITIZE_STRING) : NULL;
        $cpw = isset($_GET['cpw']) ? filter_var($_GET['cpw'], FILTER_SANITIZE_STRING) : NULL;
        $this->view->vars['content'] .= '<div id="passwordForgotten"><h4>' . T("Login", "PasswordForgotten?") . '</h4>';
        if ($npw === NULL || $cpw === NULL) {
            goto finalize;
        }
        $db = DB::getInstance();

        $cpw = $db->real_escape_string($cpw);
        $npw = $db->real_escape_string($npw);

        $find = $db->query("SELECT * FROM newproc WHERE cpw='$cpw' AND uid='$npw'");
        if ($find->num_rows) {
            $row = $find->fetch_assoc();
            $password = sha1($row['npw']);
            $query = $db->query("DELETE FROM newproc WHERE uid={$row['uid']}");
            if ($query && $db->affectedRows()) {
                $db->query("UPDATE users SET password='$password' WHERE id={$row['uid']}");
            }
            $this->view->vars['content'] .= T("Login", "PasswordChangedSuccessfully");
        } else {
            $this->view->vars['content'] .= T("Login", "PasswordFail");
        }
        finalize:
        $this->view->vars['content'] .= '</div>';
    }
} 