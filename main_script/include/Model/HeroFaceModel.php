<?php
namespace Model;
use Core\Caching\Caching;
use Core\Database\DB;

class HeroFaceModel
{
	public function modifyWholeHeroFace($uid, $attributes)
	{
		$this->invalidateCache($uid);
		$db = DB::getInstance();
		$db->query("UPDATE inventory SET lastupdate=".time()." WHERE uid=$uid");

		return $db->query("UPDATE face SET `headProfile`={$attributes['headProfile']},`hairColor`={$attributes['hairColor']},`hairStyle`={$attributes['hairStyle']},`ears`={$attributes['ears']},`eyebrow`={$attributes['eyebrow']},`eyes`={$attributes['eyes']},`nose`={$attributes['nose']},`mouth`={$attributes['mouth']},`beard`={$attributes['beard']},`gender`='{$attributes['gender']}',`lastupdate`=".time()." WHERE uid=".$uid);
	}

	private function invalidateCache($uid)
	{
		$memcache = Caching::getInstance();
		$memcache->delete("hero_image_{$uid}_79x91");
		$memcache->delete("hero_image_{$uid}_81x81");
		$memcache->delete("hero_body_{$uid}_330x422");
		$memcache->delete("hero_body_{$uid}_160x205");
		$memcache->delete("heroImageHash{$uid}");
		$memcache->delete("hero_sidebar_{$uid}");
	}
}