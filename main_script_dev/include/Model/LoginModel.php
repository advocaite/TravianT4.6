<?php
namespace Model;
use Core\Config;
use Core\Database\DB;
use Core\Database\GlobalDB;
use Core\Helper\Mailer;
use Core\Helper\WebService;

class LoginModel
{
	public function findLogin($name)
	{
        $db = DB::getInstance();
        $name = $db->real_escape_string(htmlspecialchars($name, ENT_QUOTES));
		$LoginType = 0;
		$userRow = [];
		do {
			$find = $db->query("SELECT id, name, email, sit1Uid, sit2Uid, password, last_owner_login_time FROM users WHERE (name='$name' OR email='$name') LIMIT 1");
			if($find->num_rows) {
				$LoginType = 1;
				$userRow = $find->fetch_assoc();
				$find->free();
				break;
			}
			$find->free();
			$find = $db->query("SELECT id, token, password FROM activation WHERE (name='$name' OR email='$name') LIMIT 1");
			if($find->num_rows) {
				$LoginType = 2;
				$userRow = $find->fetch_assoc();
				$find->free();
				break;
			}
			$find->free();
			$activation = $this->getActivation(Config::getProperty("settings", "worldUniqueId"), $name);
			if($activation !== FALSE) {
				$LoginType = 3;
				$userRow = $activation;
				$userRow['password'] = sha1($userRow['password']);
				break;
			}
			//index api
		} while(FALSE);
		return ["type" => $LoginType, "row" => $userRow];
	}
	private function getActivation($worldId, $name){
		$globalDB = GlobalDB::getInstance();
        $worldId = $globalDB->real_escape_string($worldId);
		$name = $globalDB->real_escape_string($name);


		$find = $globalDB->query("SELECT id, name, password FROM activation WHERE worldId='$worldId' AND used=0 AND (name='$name' OR email='$name')");
		if($find->num_rows){
			return $find->fetch_assoc();
		}
		return false;
	}
	public function addNewPassword($row)
	{
		$new_pass = substr(sha1(sha1(time() + mt_rand() + mt_rand())), 0, 7);
		$db = DB::getInstance();
		$db->query("DELETE FROM newproc WHERE uid={$row['id']}");
		$time = time();
		$cpw = get_random_string(7);
		$db->query("INSERT INTO newproc (uid, cpw, npw, time) VALUES ({$row['id']}, '$cpw', '$new_pass', $time)");
		$link = WebService::get_base_url().'/password.php?cpw='.$cpw.'&npw='.$db->lastInsertId();
		$html = vsprintf(T("Login", "pw_forgot_email"), [
			$row['name'], $row['name'], $row['email'], $new_pass,
			Config::getInstance()->settings->worldId, $link, $link,
		]);
		Mailer::sendEmail($row['email'], T("Login", "PasswordForgotten?"), $html);
	}

	public function findUserLoginById($uid)
	{
		$db = DB::getInstance();
		$uid = (int)$uid;

		return $db->query("SELECT id, sit1Uid, sit2Uid, password FROM users WHERE id=$uid LIMIT 1");
	}

	public function checkUserOrSitterLogin($uid, $password)
	{
		$user = $this->findUserLoginById($uid);
		if(!$user->num_rows) {
			$user->free();

			return 1;
		}
		$row = $user->fetch_assoc();
		$user->free();
		if($row['password'] == $password) {
			return 0;
		}
		if($row['sit1Uid'] && $this->getSitterPassword($row['sit1Uid']) == $password) {
			return 2;
		}
		if($row['sit2Uid'] && $this->getSitterPassword($row['sit2Uid']) == $password) {
			return 3;
		}

		return 1;
	}

	private function getSitterPassword($uid)
	{
		if(!$uid) {
			return FALSE;
		}
		$db = DB::getInstance();
		$row = $db->query("SELECT password FROM users WHERE id=$uid LIMIT 1");
		if($row->num_rows) {
			$result = $row->fetch_assoc();
			$row->free();

			return $result['password'];
		}
		$row->free();

		return FALSE;
	}

	/**
	 * @param $password
	 * @param $result
	 *
	 * @return int
	 * 0: success login
	 * 1: password wrong.
	 *
	 */
	public function checkLogin($password, $result)
	{
		if($result['row']['password'] == $password) {
			return 0;
		}
		if($result['type'] == 1) {
			if($result['row']['sit1Uid'] && $this->getSitterPassword($result['row']['sit1Uid']) == $password) {
				return 1;
			}
			if($result['row']['sit2Uid'] && $this->getSitterPassword($result['row']['sit2Uid']) == $password) {
				return 2;
			}
		}

		return 3;
	}
} 