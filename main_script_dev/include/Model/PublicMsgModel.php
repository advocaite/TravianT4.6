<?php
/**
 * Created by PhpStorm.
 * User: Amirhossein CH
 * Date: 9/17/2014
 * Time: 12:32 AM
 */

namespace Model;

use Core\Database\DB;

class PublicMsgModel
{
    public function haveNewMessage($message)
    {
        $db = DB::getInstance();
        $message = $db->real_escape_string($message);
        $db->query("UPDATE config SET message='$message'");
        $db->query("UPDATE users SET ok=1 WHERE id>=2");
    }
}