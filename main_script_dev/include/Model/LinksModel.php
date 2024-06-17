<?php
namespace Model;
use Core\Database\DB;

class LinksModel
{
	public function getPlayerLinks($uid)
	{
		$db = DB::getInstance();

		return $db->query("SELECT * FROM links WHERE uid=$uid ORDER BY pos");
	}
    public function getPlayerLinksCount($uid)
    {
        $db = DB::getInstance();

        return (int) $db->fetchScalar("SELECT COUNT(id) FROM links WHERE uid=$uid");
    }

	public function deleteLink($uid, $id)
	{
		$id = (int)$id;
		$db = DB::getInstance();
		$db->query("DELETE FROM links WHERE id=$id AND uid=$uid");
		return $db->affectedRows();
	}

	public function addLink($uid, $name, $url, $pos)
	{
		$name = filter_var($name, FILTER_SANITIZE_STRING);
		$url = filter_var($url, FILTER_SANITIZE_URL);
		if(strlen($name) > 30) {
			return false;
		}
		if(strlen($uid) > 255) {
			return false;
		}
		$pos = (int)$pos;
		$db = DB::getInstance();
		$name = $db->real_escape_string($name);
		$uid = $db->real_escape_string($uid);
		$db->query("INSERT INTO links (uid, name, url, pos) VALUES ($uid,'$name','$url',$pos)");
		return true;
	}

	public function modifyLink($uid, $id, $name, $url, $pos)
	{
		$name = filter_var($name, FILTER_SANITIZE_STRING);
		$url = filter_var($url, FILTER_SANITIZE_URL);
		if(strlen($name) > 30) {
			return false;
		}
		if(strlen($uid) > 255) {
			return false;
		}
		$id = (int)$id;
		$pos = (int)$pos;
		$db = DB::getInstance();
		$db->query("UPDATE links set name='$name', url='$url', pos=$pos WHERE id=$id AND uid=$uid");
		return $db->affectedRows();
	}
}