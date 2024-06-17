<?php
namespace Model;

use Core\Database\GlobalDB;

class NewsModel
{
    public function addNews($title, $shortDesc, $content, $expire, $moreLink)
    {
        $db = GlobalDB::getInstance();
        $shortDesc = $db->real_escape_string($shortDesc);
        $content = $db->real_escape_string($content);
        $moreLink = $db->real_escape_string($moreLink);
        $db->query("INSERT INTO news (title, shortDesc, content, moreLink, expire, time) VALUES ('".$title."', '".$shortDesc."', '".$content."', '".$moreLink."', '".$expire."', '".time()."')");
    }

    public function getNews($id)
    {
        $db = GlobalDB::getInstance();
        return $db->query("SELECT * FROM news WHERE id=$id");
    }

    public function deleteNews($id)
    {
        $db = GlobalDB::getInstance();
        $db->query("DELETE FROM news WHERE id=$id");
    }

    public function getAllNews()
    {
        $db = GlobalDB::getInstance();
        return $db->query("SELECT * FROM news WHERE expire >= " . time() . " ORDER BY id DESC");
    }
}