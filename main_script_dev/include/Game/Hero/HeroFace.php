<?php
namespace Game\Hero;
use Core\Helper\WebService;

class HeroFace
{
	public $faceData = [
		"male"      => [
			"headProfile"  => [
				"start" => 50, "end" => 54, "none" => -1,
			], "hairColor" => [
				"start" => 1500, "end" => 1504, "none" => -1,
			], "hairStyle" => [
				"start" => 1000, "end" => 1004, "none" => 1499,
			], "ears"      => [
				"start" => 2000, "end" => 2004, "none" => -1,
			], "eyebrow"   => [
				"start" => 7000, "end" => 7003, "none" => -1,
			], "eyes"      => [
				"start" => 4000, "end" => 4004, "none" => -1,
			], "nose"      => [
				"start" => 3000, "end" => 3004, "none" => -1,
			], "mouth"     => [
				"start" => 6000, "end" => 6003, "none" => -1,
			], "beard"     => [
				"start" => 5000, "end" => 5004, "none" => 5999,
			],
		], "female" => [
			"headProfile"  => [
				"start" => 51, "end" => 56, "none" => -1,
			], "hairColor" => ["start" => 1500, "end" => 1504, "none" => -1],
			"hairStyle"    => ["start" => 1000, "end" => 1005, "none" => -1],
			"ears"         => ["start" => 2000, "end" => 2007, "none" => -1],
			"eyebrow"      => ["start" => 7000, "end" => 7009, "none" => -1],
			"eyes"         => ["start" => 4000, "end" => 4009, "none" => -1],
			"nose"         => ["start" => 3000, "end" => 3007, "none" => -1],
			"mouth"        => ["start" => 6000, "end" => 6008, "none" => -1],
			"beard"        => ["start" => 0, "end" => 0, "none" => -1],
		],
	];

	public function getRandomHeroFace($gender = "male")
	{
		$result = [];
		if(is_numeric($gender)) {
			$gender = ['male', 'female'];
			$gender = $gender[mt_rand(0, 1)];
		}
		foreach($this->faceData[$gender] as $key => $value) {
			$result[$key] = mt_rand($value['start'], $value['end']);
			if($value['none'] > 0 && mt_rand(1, 20) == 5) {
				$result[$key] = $value['none'];
			}
		}
		$result['gender'] = $gender;

		return $result;
	}

	public function getAllHeroFaceAttributes($gender)
	{
		$heroFaceData = [
			"headProfile" => "face", "hairColor" => "color",
			"hairStyle"   => "hair", "ears" => "ear", "eyebrow" => "eyebrow",
			"eyes"        => "eye", "nose" => "nose", "mouth" => "mouth",
			"beard"       => "beard",
		];
		$return = [];
		foreach($this->faceData[$gender] as $key => $value) {
			if($gender == "female" && $key == "beard") {
				continue;
			}
			$return[$key] = "";
			for($i = $value['start']; $i <= $value['end']; ++$i) {
				$return[$key] .= '<img id="attribute_button_'.$i.'" class="attribute" src="img/hero/'.$gender.'/thumb/head/'.($key == "hairColor" ? "hair" : $heroFaceData[$key]).'/'.$heroFaceData[$key].($i - $value['start']).'.png" alt=""/>';
			}
			if($value['none'] > 0) {
				$return[$key] .= '<img id="attribute_button_'.$value['none'].'" class="attribute" src="img/hero/'.$gender.'/thumb/head/'.($key == "hairColor" ? "hair" : $heroFaceData[$key]).'/'.$heroFaceData[$key].'None.png" alt=""/>';
			}
		}

		return $return;
	}

	public function encodeAttribute($attributes)
	{
		foreach($attributes as $key => $value) {
			if($key == "gender" || $key == "uid" || $key == "lastupdate") {
				continue;
			}
			$k = $this->faceData[$attributes['gender']][$key];
			$value = $value + $k['start'];
			if($k['none'] > 0) {
				$value = $value == $k['start'] + 5 ? $k['none'] : $value;
			}
			$attributes[$key] = $value;
		}

		return $attributes;
	}

	public function decodeAttribute($attributes)
	{
		foreach($attributes as $key => $value) {
			if($key == "gender" || $key == "uid" || $key == "lastupdate") {
				continue;
			}
			$k = $this->faceData[$attributes['gender']][$key];
			$value = $value - $k['start'];
			if($k['none'] > 0) {
				$value = $value == ($k['none'] - $k['start']) ? 5 : $value;
			}
			$attributes[$key] = $value;
		}

		return $attributes;
	}
	public function isValid($id, $gender, $type)
	{
		if(!isset($this->faceData[$gender][$type])) {
			return FALSE;
		}
		$k = $this->faceData[$gender][$type];
		if(($id >= $k['start'] && $id <= $k['end']) || ($id == $k['none'] && $k['none'] > 0)) {
			return TRUE;
		}
		return FALSE;
	}
	public function getHeroImageAsHTML($heroFace)
	{
		$colorName = [
			             "black", "brown", "darkbrown", "yellow", "red",
		             ][$heroFace['hairColor']];
		$GAME_BASE_URL = WebService::get_base_url();
		$hair = $heroFace['hairStyle'] == 5 && $heroFace['gender'] == "male" ? "None" : $heroFace['hairStyle']."-".$colorName;
		$beard = $heroFace['beard'] == 5 && $heroFace['gender'] == "male" ? "None" : $heroFace['beard']."-".$colorName;
		$beard2 = $heroFace['beard'] == 5 && $heroFace['gender'] == "male" ? "gif" : "png";
		$eyebrow = $heroFace['gender'] == "male" ? $heroFace['eyebrow']."-".$colorName : $heroFace['eyebrow'];
		$heroImage = <<<HTML
<img style="width:254px; height:330px; position:absolute;left:0;top:0;" src="{$GAME_BASE_URL}/img/hero/{$heroFace['gender']}/head/254x330/face0.png" alt="" />
            <img style="width:254px; height:330px; position:absolute;left:0;top:0;" src="{$GAME_BASE_URL}/img/hero/{$heroFace['gender']}/head/254x330/eye/eye{$heroFace['eyes']}.png" alt="" />
            <img style="width:254px; height:330px; position:absolute;left:0;top:0;" src="{$GAME_BASE_URL}/img/hero/{$heroFace['gender']}/head/254x330/eyebrow/eyebrow{$eyebrow}.png" alt="" />
            <img style="width:254px; height:330px; position:absolute;left:0;top:0;" src="{$GAME_BASE_URL}/img/hero/{$heroFace['gender']}/head/254x330/hair/hair{$hair}.png" alt="" />
            <img style="width:254px; height:330px; position:absolute;left:0;top:0;" src="{$GAME_BASE_URL}/img/hero/{$heroFace['gender']}/head/254x330/face/face{$heroFace['headProfile']}.png" alt="" />
            <img style="width:254px; height:330px; position:absolute;left:0;top:0;" src="{$GAME_BASE_URL}/img/hero/{$heroFace['gender']}/head/254x330/mouth/mouth{$heroFace['mouth']}.png" alt="" />
            <img style="width:254px; height:330px; position:absolute;left:0;top:0;" src="{$GAME_BASE_URL}/img/hero/{$heroFace['gender']}/head/254x330/nose/nose{$heroFace['nose']}.png" alt="" />
            <img style="width:254px; height:330px; position:absolute;left:0;top:0;" src="{$GAME_BASE_URL}/img/hero/{$heroFace['gender']}/head/254x330/ear/ear{$heroFace['ears']}.png" alt="" />
HTML;
		if($heroFace['gender'] == "male") {
			$heroImage .= <<<HTML
            <img style="width:254px; height:330px; position:absolute;left:0;top:0;" src="{$GAME_BASE_URL}/img/hero/{$heroFace['gender']}/head/254x330/beard/beard{$beard}.{$beard2}" alt="" />
HTML;
		}
		return $heroImage;
	}
}