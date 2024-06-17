<?php
namespace Model;
use Core\Database\DB;
use const FILTER_SANITIZE_STRING;
use function filter_var;

class PlayerNote
{
    public static function getPlayerNote($my_uid, $uid){
        $db = DB::getInstance();
        return $db->fetchScalar("SELECT note_text FROM notes WHERE uid=$my_uid AND to_uid=$uid");
    }
    public static function setPlayerNote($my_uid, $uid, $text){
        $db = DB::getInstance();
        $text = filter_var($db->real_escape_string($text), FILTER_SANITIZE_STRING);
        $id = $db->fetchScalar("SELECT id FROM notes WHERE uid=$my_uid AND to_uid=$uid");
        if($id !== false){
            $db->query("UPDATE notes SET note_text='$text' WHERE id={$id}");
        } else {
            $db->query("INSERT INTO notes (uid, to_uid, note_text) VALUES ($my_uid, $uid, '$text')");
        }
    }
}