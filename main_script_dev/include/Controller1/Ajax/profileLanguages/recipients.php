<?php
namespace Controller\Ajax\profileLanguages;
use Controller\Ajax\AjaxBase;

use Core\Session;
use Core\Locale;
use Core\Database\DB;
use Model\MessageModel;
use Model\ProfileModel;
use resources\View\PHPBatchView;

class recipients extends AjaxBase
{
    const AUTO_COMPLETE_LIMIT = 10;
    public function dispatch()
    {
		//{recipients: ["multihunter"], sender: 6109}

        $languages = array();
        $db = DB::getInstance();
		foreach($_POST['recipients'] as $search){
			$search = $db->real_escape_string(filter_var(htmlspecialchars($search, ENT_QUOTES), FILTER_SANITIZE_STRING));
			$players = $db->query("SELECT countryFlag FROM users WHERE name = '{$search}' LIMIT " . self::AUTO_COMPLETE_LIMIT);
			while ($row = $players->fetch_assoc()) {
				$languages[] = '<div class="flags"><img src="img/x.gif" class="flag_'.$row['countryFlag'].'" title="'.$row['countryFlag'].'" alt="'.$row['countryFlag'].'"></div>';
			}
		}

		$this->response = array();
		$this->response['success'] = true;
		$this->response['languages'] = '<div class="flags">'.implode($languages).'</div>';
	}
}
