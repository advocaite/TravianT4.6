<?php
namespace Model;
use Core\Database\DB;

class PlayerModel
{
	public function setPlayerPoints($uid, $attack, $defense, $rob)
	{
		$db = DB::getInstance();
		//TODO: add to plus statistics.
		$db->query("UPDATE users SET
        total_attack_points=total_attack_points+$attack,
        week_attack_points=week_attack_points+$attack,
        total_defense_points=total_defense_points+$defense,
        week_defense_points=week_defense_points+$defense,
        week_robber_points=week_robber_points+$rob
        WHERE id=$uid
        ");
	}
}