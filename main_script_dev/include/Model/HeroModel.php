<?php
namespace Model;
use Core\Database\DB;

class HeroModel
{
	public function getHero($heroId)
	{
        $db = DB::getInstance();
		return $db->query("SELECT uid, kid, exp, health, power, offBonus, itemHealth, lastupdate, defBonus, production, productionType, hide FROM hero WHERE uid=" . $heroId)->fetch_assoc();
	}  
	public function updateHeroFace()
	{
	}
} 