<?php
namespace Model\Movements;

use Core\Config;
use Model\MovementsModel;

class EvasionProcessor
{
	public function __construct($row)
	{
		$m = new MovementsModel();
		$seconds = Config::getInstance()->game->evasion_time * 1000;
		$m->addMovement($row['to_kid'], $row['kid'], $row['race'], array_filter_units($row), 0, 0, 0, 0, 1, MovementsModel::ATTACKTYPE_EVASION, $row['end_time'], $row['end_time'] + $seconds);
	}
}