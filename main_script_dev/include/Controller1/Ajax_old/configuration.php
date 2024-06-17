<?php

namespace Controller\Ajax;

use Core\Database\GlobalDB;
use Core\Session;

class configuration extends AjaxBase
{
    public function dispatch()
    {
        //check if the user is valid or not
        $session = Session::getInstance();
        if (!$session->isValid()) {
            return $this->error('You are not logged in.');
        }
        if (!$session->isAdmin()) {
            return $this->error('You are not allowed to access this method.');
        }
        if (!isset($_GET['action'])) {
            return $this->error('Incomplete data.');
        }
        if ($_GET['action'] == 'save') $this->save();
        else if ($_GET['action'] == 'delete') $this->delete();

        return null;
    }


    private function delete()
    {
        if (!isset($_POST['id'])) {
            return $this->error('Incomplete data.');
        }

        $id = (int)$_POST['id'];

        $db = GlobalDB::getInstance();
        $db->query("DELETE FROM configurations WHERE id={$id}");

        return null;
    }

    private function save()
    {
        if (!isset($_POST['name'], $_POST['data']) || empty($_POST['name']) || empty($_POST['data'])) {
            return $this->error('Incomplete data.');
        }
        $ob = json_decode($_POST['data']);
        if ($ob === null) {
            return $this->error('Invalid data.');
        }
        $db = GlobalDB::getInstance();

        $name = $db->real_escape_string($_POST['name']);
        $data = $db->real_escape_string($_POST['data']);

        $db->query(sprintf("INSERT INTO configurations (name, data) VALUES ('%s', '%s')", $name, $data));
        return null;
    }
}