<?php

namespace Controller\Ajax;

use Core\Database\GlobalDB;

class news extends AjaxBase
{
    public function dispatch()
    {
        $news = null;
        $id = (int)$_POST['id'];
        $globalDB = GlobalDB::getInstance();
        $this->response['data']['html'] = $globalDB->fetchScalar("SELECT content FROM news WHERE id=$id");
    }
} 