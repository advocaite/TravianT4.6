<?php
namespace Controller;
use Core\Config;
use Game\Formulas;
use Core\Locale;
use resources\View\PHPBatchView;
use const TEMPLATES_PATH;

$config = Config::getInstance();
class ManualCtrl extends AnyCtrl
{

}
?>
<?php require TEMPLATES_PATH . "layout/head.php";?>
<body class="manual <?=get_locale();?>">
<?php
$typ = isset($_GET['typ']) && ($_GET['typ'] == 1 || $_GET['typ'] == 4) ? (int)$_GET['typ'] : -1;
$s = isset($_GET['s']) && ($_GET['s'] > 0 && $_GET['s'] <= 70) ? (int)$_GET['s'] : -1;
if($typ == 1 && $s == -1){
    $s = isset($_GET['gid']) && ($_GET['gid'] > 0 && $_GET['gid'] <= 70) ? (int)$_GET['gid'] : -1;
}
$gid = isset($_GET['gid']) && ($_GET['gid'] > 0 && $_GET['gid'] <= 45 && $_GET['gid'] != 12) ? (int)$_GET['gid'] : -1;
$settings = [
	"type"     => $typ, "u" => $typ == 1 && $s == -1 ? $gid : $s, "gid" => $gid,
	"showMenu" => $typ == -1,
];
if($typ == 1 && $settings['u'] < 0) {
	$settings['showMenu'] = TRUE;
}
if($typ == 4 && $gid < 0) {
	$settings['showMenu'] = TRUE;
}
if($settings['showMenu']) {
	echo PHPBatchView::render('manual/menu');

	return;
}
if($settings['type'] == 1) {
	$_template = new PHPBatchView("manual/unit");
	$u = $settings['u'];
	$race = unitIdToTribe($u);
	$meta = Formulas::$data['units'][$race - 1][unitIdToNr($u) - 1];
	$preRequests = T("Manual", "None");
	if(isset($meta['breq'])) {
		$preRequests = '';
		foreach($meta['breq'] as $gid => $level) {
			if(!empty($preRequests)) {
				$preRequests .= ',';
			}
			$preRequests .= '<a href="manual.php?typ=4&gid='.$gid.'"> '.T("Buildings", $gid.".title").'</a> '.T("Buildings", "level").' '.$level;
		}
	}
	$answerId = 0;
	switch($race) {
		case 1:
			$answerId = 150 + unitIdToNr($u) - 1;
			break;
		case 2:
			$answerId = 162 + unitIdToNr($u) - 1;
			break;
		case 3;
			$answerId = 139 + unitIdToNr($u) - 1;
			break;
        case 6; //TODO: need update
            $answerId = 139 + unitIdToNr($u) - 1;
            break;
        case 7; //TODO: need update
            $answerId = 139 + unitIdToNr($u) - 1;
            break;
	}
	$_template->display([
		"unit"                  => [
			"race"         => $race, "id" => $u, "attack_power" => $meta['off'],
			"def_inf"      => $meta['def_i'], "def_cav" => $meta['def_c'],
			"carry"        => $meta['cap'],
			"trainingTime" => Formulas::uTrainingTime($u, 1, 0),
			"cost"         => $meta['cost'],
			"cu"         => $meta['cu'],
			"speed"        => Formulas::uSpeed($u),
			"answerId"     => $answerId,
		], "preRequests"        => $preRequests,
		"TravianAnswersBaseUrl" => $config->settings->availableLanguages->{$config->settings->selectedLang}->AnswersUrl,
	]);
} else if($settings['type'] == 4) {
	$_template = new PHPBatchView("manual/building");
	$preRequests = '';
	$meta = Formulas::$data['buildings'][$settings['gid'] - 1];
	if(isset($meta['breq'])) {
		$preRequests = '';
		foreach($meta['breq'] as $gid => $level) {
			if(!empty($preRequests)) {
				$preRequests .= ',';
			}
			if($level < 0) {
				$name = '<strike>'.T("Buildings", $gid.".title").'</strike>';
			} else {
				$name = T("Buildings", $gid.".title");
			}
			if($level < 0) {
				$desc = '';
			} else {
				$desc = T("Buildings", "level").' '.$level;
			}
			$preRequests .= '<a href="manual.php?typ=4&gid='.$gid.'"> '.$name.'</a> '.$desc;
		}
	}
	if(isset($meta['req'])) {
		if($settings['gid'] == 40) {
			$meta['req']['race'] = 4;
		}
		if(isset($meta['req']['capital']) && $meta['req']['capital'] == 1) {
			if(!empty($preRequests)) {
				$preRequests .= ', ';
			}
			$preRequests .= T("Manual", "Capital");
		}
		if(isset($meta['req']['race'])) {
			if(!empty($preRequests)) {
				$preRequests .= ', ';
			}
			$preRequests .= T("Manual", "onlyForTribe").' '.T("Global", "races.".($meta['req']['race']));
		}
		if($settings['gid'] == 40) {//building plan
			if(!empty($preRequests)) {
				$preRequests .= ', ';
			}
			$preRequests .= T("Manual", "BuildingPlan");
		}
	}
	if(empty($preRequests)) {
		$preRequests = T("Manual", "None");
	}
	$answerId = 0;
	if($settings['gid'] <= 9) {//resources
		$answerId = 195 - ($settings['gid'] - 1);
	} else {
		$answerIDs = [
			10 => 51, 11 => 5, 15 => 15, 17 => 16, 18 => 4, 23 => 11, 24 => 46,
			25 => 18, 26 => 17, 27 => 50, 28 => 48, 34 => 19, 35 => 9, 38 => 13,
			39 => 12, 40 => 73, 41 => 14, 13 => 76, 14 => 184, 16 => 182,
			19 => 77, 20 => 183, 21 => 186, 22 => 75, 29 => 178, 30 => 179,
			31 => 85, 32 => 86, 33 => 87, 36 => 185, 37 => 180,
		];
		$answerId = $answerId[$settings['gid']];
	}
	$_template->display([
		"building"              => [
			"gid"      => $settings['gid'],
			"upTime"   => Formulas::buildingUpgradeTime($settings['gid'], 1, 1, FALSE),
			"cost"     => Formulas::buildingUpgradeCosts($settings['gid'], 1),
			"cu"       => Formulas::buildingCropConsumption($settings['gid'], 1),
			"answerId" => $answerId,
		], "preRequests"        => $preRequests,
		"TravianAnswersBaseUrl" => $config->settings->availableLanguages->{$config->settings->selectedLang}->AnswersUrl,
	]);
}
?>
<div id="anwersQuestionMark">
	<a href="<?=$config->settings->availableLanguages->{$config->settings->selectedLang}->AnswersUrl; ?>/copyable/public/index.php?aid=268#go2answer"
	   target="_blank"
	   title="<?=T("Manual", "moreInTravianAnswers"); ?>">&nbsp;</a>
</div>
</body>
</html>