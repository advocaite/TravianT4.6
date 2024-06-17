<?php

use Core\Caching\Caching;
use Core\Config;
use Core\ErrorHandler;
use Core\Helper\ReCaptcha;
use Core\Helper\TimezoneHelper;
use Core\Helper\WebService;
use Core\Locale;
use Core\Session;
use Model\DailyQuestModel;
use Model\Quest;

function imagecreatetransparent($width, $height)
{
    $block = imagecreatetruecolor($width, $height);
    imagealphablending($block, FALSE);
    imagecolortransparent($block, imagecolorallocate($block, 0, 0, 0));
    $background = imagecolorallocatealpha($block, 255, 255, 255, 127);
    imagefilledrectangle($block, 0, 0, $width, $height, $background);
    imagealphablending($block, TRUE);
    return $block;
}

function getDisplay($name)
{
    $config = Config::getInstance();
    return (property_exists($config->display, $name)) ? $config->display->$name : false;
}

function getCustom($name)
{
    $config = Config::getInstance();
    return (property_exists($config->custom, $name)) ? $config->custom->$name : false;
}

function getGame($name)
{
    $config = Config::getInstance();
    return (property_exists($config->game, $name)) ? $config->game->$name : false;
}

function logError($error, $parameters = [])
{
    $text = vsprintf($error, $parameters);
    ErrorHandler::getInstance()->log($text);
    return $text;
}

function shuffle_assoc($list)
{
    if (!is_array($list)) return $list;

    $keys = array_keys($list);
    shuffle($keys);
    $random = array();
    foreach ($keys as $key) {
        $random[$key] = $list[$key];
    }
    return $random;
}

function getGameElapsedSeconds()
{
    $config = Config::getInstance();
    return time() - $config->game->start_time;
}

function getGameElapsedMiliSeconds()
{
    $config = Config::getInstance();
    return miliseconds() - $config->game->start_time * 1000;
}

function ConvertToUTF8($text)
{

    $encoding = mb_detect_encoding($text, mb_detect_order(), false);
    if ($encoding == "UTF-8") {
        $text = mb_convert_encoding($text, 'UTF-8', 'UTF-8');
    }
    $out = iconv(mb_detect_encoding($text, mb_detect_order(), false), "UTF-8//IGNORE", $text);
    return $out;
}

function recaptcha_check_answer()
{
    global $globalConfig;
    if (isset($_POST["g-recaptcha-response"])) {
        $reCaptcha = new ReCaptcha($globalConfig['staticParameters']['recaptcha_private_key']);
        $resp = $reCaptcha->verifyResponse(
            WebService::ipAddress(),
            $_POST["g-recaptcha-response"]
        );
        return $resp != null && $resp->success;
    }
    return false;
}

function recaptcha_get_html($callback = null)
{
    global $globalConfig;
    $HTML = '<script src=\'https://www.google.com/recaptcha/api.js?hl=en\'></script>';
    $HTML .= '<div class="g-recaptcha" ' . (empty($callback) ? '' : 'data-callback="' . $callback . '" ') . 'data-lang="en" data-theme="custom" data-sitekey="' . $globalConfig['staticParameters']['recaptcha_public_key'] . '"></div>';
    return $HTML;
}

function getCheckerInput()
{
    return Session::getCheckerInput();
}

function clean_string_from_white($string)
{
    $s = trim($string);
    $s = ConvertToUTF8($s); // drop all non utf-8 characters
    // this is some bad utf-8 byte sequence that makes mysql complain - control and formatting i think
    $s = preg_replace('/(?>[\x00-\x1F]|\xC2[\x80-\x9F]|\xE2[\x80-\x8F]{2}|\xE2\x80[\xA4-\xA8]|\xE2\x81[\x9F-\xAF])/',
        ' ',
        $s);
    $s = preg_replace('/\s+/', ' ', $s); // reduce all multiple whitespace to a single space
    return $s;
}

function make_seed()
{
    list($usec, $sec) = explode(' ', microtime());

    return (float)$sec + ((float)$usec * 100000);
}

function calculate_dailyquest_bonus($x, $type)
{
    return DailyQuestModel::calcEffect($x, $type, true);
}

function delete_session_cookie()
{
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }
}

function buildResourcesReward($resources)
{
    $resources = Quest::getInstance()->multiply($resources);
    $stockStatus = [
        1 =>
            sprintf('[STOCK_CSS_%s_%s]', 1, $resources[0]),
        sprintf('[STOCK_CSS_%s_%s]', 2, $resources[1]),
        sprintf('[STOCK_CSS_%s_%s]', 3, $resources[2]),
        sprintf('[STOCK_CSS_%s_%s]', 4, $resources[3]),
    ];

    $HTML = null;
    $HTML .= '<div class="inlineIconList resourceWrapper">';
    for($i = 1; $i <= 4; ++$i){
        $HTML .= '<div class="inlineIcon resources" title="">';
        $HTML .= '<i class="r'.$i.' questRewardTypeResource questRewardType'.([1 => 'Wood', 'Clay', 'Iron', 'Crop'][$i]).'"></i>';
        $HTML .= '<span class="value questRewardValue ' . $stockStatus[$i] . '">'.number_format_x($resources[$i-1]).'</span>';
        $HTML .= '</div>';
    }
    $HTML .= '</div>';
    return $HTML;
}

function number_format_x($x, $after = 1e15)
{
//    if (abs($x) > $after) {
//        return number_to_string($x);
//    }
    if (!getDisplay("separateNumbers3By3") || !is_numeric($x) || $x == '?') return $x;
    return number_format($x, 0, ',', ',');
}

function isInstantFinishEnabled()
{
    return Config::getInstance()->extraSettings->generalOptions->finishTraining->enabled;
}

function appendTimer($seconds, $type = 0, $noTimerOnTimeout = false, $critical = false)
{
    if ($noTimerOnTimeout && $seconds <= 0) {
        return 'N/A';
    }
    if ($type == 0) {
        return '<span class="timer ' . ($critical ? 'crit' : '') . '" counting="down" value="' . $seconds . '">' . secondsToString($seconds) . '</span>';
    }
    return '<span class="timer ' . ($critical ? 'crit' : '') . '" counting="up" value="' . $seconds . '">' . secondsToString($seconds) . '</span>';
}

function getDirection()
{
    return get_language_properties('direction');
}

function getAnswersUrl()
{
    global $globalConfig;
    $url = $globalConfig['staticParameters']['answersUrl'] . "?lang=" . Session::getInstance()->getLanguage() . '&';
    return $url;
}

function getForumUrl()
{
    $config = Config::getInstance();
    $url = ($config->settings->availableLanguages->{$config->settings->selectedLang}->ForumUrl);
    return $url;
}

function getGameSpeed()
{
    return getGame("speed");
}

function getWorldUniqueId()
{
    return Config::getInstance()->settings->worldUniqueId;
}

function getWorldId()
{
    return Config::getInstance()->settings->worldId;
}

function isServerFinished()
{
    return Config::getInstance()->dynamic->serverFinished;
}

function generate_guid($trim = true)
{
    // Windows
    if (function_exists('com_create_guid') === true) {
        if ($trim === true)
            return trim(com_create_guid(), '{}');
        else
            return com_create_guid();
    }

    // OSX/Linux
    if (function_exists('openssl_random_pseudo_bytes') === true) {
        $data = openssl_random_pseudo_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);    // set version to 0100
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);    // set bits 6-7 to 10
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    // Fallback (PHP 4.2+)
    mt_srand((double)microtime() * 10000);
    $charid = strtolower(md5(uniqid(rand(), true)));
    $hyphen = chr(45);                  // "-"
    $lbrace = $trim ? "" : chr(123);    // "{"
    $rbrace = $trim ? "" : chr(125);    // "}"
    $guidv4 = $lbrace .
        substr($charid, 0, 8) . $hyphen .
        substr($charid, 8, 4) . $hyphen .
        substr($charid, 12, 4) . $hyphen .
        substr($charid, 16, 4) . $hyphen .
        substr($charid, 20, 12) .
        $rbrace;
    return $guidv4;
}

function T($base, $Code, $Default = FALSE)
{
    $Locale = Locale::getInstance();
    if ($Locale) {
        return $Locale->Translate($base, $Code, $Default);
    } else {
        return $Default;
    }
}

function multiply_packages($rate, $type = 7)
{
    global $config;
    $config->settings->multiplyCalled = true;
    if ($type & 1 && $config->extraSettings->buyResources['enabled']) {
        $config->extraSettings->buyResources['packages'] = array_map(function ($x) use ($rate) {
            $x['resources'] = array_map(function ($x) use ($rate) {
                return ceil($x * $rate / 1000) * 1000;
            },
                $x['resources']);
            return $x;
        },
            $config->extraSettings->buyResources['packages']);
    }
    if ($type & 2 && $config->extraSettings->buyAnimal['enabled']) {
        $config->extraSettings->buyAnimal['packages'] = array_map(function ($x) use ($rate) {
            $x['units'] = array_map(function ($x) use ($rate) {
                return ceil($x * $rate / 100) * 100;
            },
                $x['units']);
            return $x;
        },
            $config->extraSettings->buyAnimal['packages']);
    }
    if ($type & 4 && $config->extraSettings->buyTroops['enabled']) {
        $buyTroops = &$config->extraSettings->buyTroops['packages'];
        foreach ($buyTroops as $race => $racePackageArray) {
            foreach ($racePackageArray as $index => $package) {
                $buyTroops[$race][$index]['units'] = array_map(function ($x) use ($rate) {
                    return ceil($x * $rate / 100) * 100;
                },
                    $package['units']);
            }
        }
    }
}

/**
 * @return int
 */
function miliseconds($fixed = false)
{
    if ($fixed) {
        return time() * 1000;
    }
    $microtime = microtime();
    $comps = explode(' ', $microtime);

    return sprintf('%d%03d', $comps[1] + $comps[0], $comps[0] * 1e3);
}

function getDifMilisecondsToSeconds($miliseconds)
{
    return ceil(($miliseconds - miliseconds()) / 1000);
}

function nanoseconds()
{
    /*if (function_exists('exec')) {
        exec('date +%s%N', $nano);
        return trim($nano[0]);
    }*/
    $microtime = microtime();
    $comps = explode(' ', $microtime);
    return sprintf('%d%09d', $comps[1] + $comps[0], $comps[0] * 1e9);
}

function human_filesize($bytes, $decimals = 2)
{
    $size = ['B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
    $factor = floor((strlen($bytes) - 1) / 3);
    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . $size[(int)$factor];
}

function round5($value)
{
    return round($value / 5) * 5;
}

function roundUpToAny($n, $x = 5)
{
    return (ceil($n) % $x === 0) ? ceil($n) : round(($n + $x / 2) / $x) * $x;
}

function round10($value)
{
    return round($value / 10) * 10;
}

function nrToUnitId($nr, $tribe)
{
    // Exeption for the hero: Every time id 98
    if ($nr == 11) {
        return 98;
    }
    if ($nr == 99) {
        return 99;
    }

    return ($tribe - 1) * 10 + ($nr * 1);
}

function unitIdToTribe($unitId)
{
    if ($unitId <= 10) {
        return 1;
    }
    if ($unitId <= 20) {
        return 2;
    }
    if ($unitId <= 30) {
        return 3;
    }
    if ($unitId <= 40) {
        return 4;
    }
    if ($unitId <= 50) {
        return 5;
    }
    if ($unitId <= 60) {
        return 6;
    }
    if ($unitId <= 70) {
        return 7;
    }
    return 0;
}

function unitIdToNr($a)
{
    if ($a == 99) {
        return 99;
    }
    if ($a == 98 || $a == "hero") {
        return 11;
    }

    return 1 + (($a - 1) % 10);
}

function getSpyId($tribe)
{
    if ($tribe == 3) {
        return 3;
    } else {
        return 4;
    }
}

function getAButton($button, $js, $content = NULL)
{
	require SVG_COMMON_TEMPLATES;
	if (!isset($button['id'])) {
        $button['id'] = get_button_id();
    }
    $output = NULL;
    if (!isset($js['data'])) {
        $js['data'] = [];
    }
    if (isset($js['data']['onclick'])) {
        $button['onclick'] = $js['onclick'] = $js['data']['onclick'];
    }
    if (isset($js['data']['onfocus'])) {
        $button['onfocus'] = $js['onfocus'] = $js['data']['onfocus'];
    }
    if (strpos($button['class'], 'disabled') !== FALSE) {
        if (!isset($js['onclick']) && !isset($button['onclick']) && !isset($js['data']['onclick'])) {
            $button['onclick'] = $js['onclick'] = "if(jQuery(this).hasClass('disabled')){event.stopPropagation(); return false;} else {}";
        }
        if (!isset($js['onfocus']) && !isset($button['onfocus']) && !isset($js['data']['onfocus'])) {
            $button['onfocus'] = $js['onfocus'] = "jQuery('button', 'input[type!=hidden]', 'select').focus(); event.stopPropagation(); return false;";
        }
    }
	
    $output = '<a';
	if (isset($button['href']) && $button['href'] != '#') {
		$output .= ' href="' . $button['href'] . '"';
	}else{
		$output .= ' href="#"';
		$button["onclick"] = "event.preventDefault();";
	}
    foreach ($button as $k => $v) {
        if ($k == 'value' || is_array($v)) {
            continue;
        }
        if ($k == 'title') {
            $js['data'][$k] = $v;
        }
        if ($k == "coins" && $v <= 0) {
            continue;
        }
        if (strtoupper(substr($k, 0, 2)) == "ON") {
            $k = strtolower($k);
            $js['data'][$k] = $v;
        }
        $output .= ' ' . $k . '="' . $v . '"';
    }
    $output .= '>';
	
	if(isset($button['svg']) && isset($svg[$button['svg']])){
		$output .= $svg[$button['svg']];
	}
	else if(isset($button['svg'])){
		$output .= '---missing svg '.$button['svg'].' definition---';
	}
	
    $output .= '</a>
    <script type="text/javascript" id="' . $button['id'] . '_script">';
    $js['data']['id'] = $button['id'];
    $output .= "
    jQuery(function()
        {
          jQuery('#{$button['id']}').click(function (event)
          {
            jQuery(window).trigger('buttonClicked', [event.delegateTarget, " . json_encode($js['data']) . "]);
          });
        });
    ";
	if(strpos($button['class'],'layoutButton')!==FALSE && (isset($js['data']['boxId']) && $js['data']['buttonId'])){
		$output .= "
			jQuery('#{$button['id']}').one('mouseover', function(event) {
				Travian.Tip.load(event.delegateTarget, 'layoutButton', {boxId: '{$js['data']['boxId']}', buttonId: '{$js['data']['buttonId']}'});
			});
		";
	}else if(isset($js['title'])){
		$output .= "
			jQuery('#{$button['id']}').one('mouseover', function(event) {
				Travian.Tip.load(event.delegateTarget, 'layoutButton', {boxId: '{$js['title_section']}', buttonId: '{$js['title_action']}'});
			});
		";
	}
    $output .= '</script>';
	
    return $output;
}

function getButton($button, $js, $content = NULL)
{
	require SVG_COMMON_TEMPLATES;
	
	if (!isset($button['id'])) {
        $button['id'] = get_button_id();
    }
    $output = NULL;
    if (!isset($js['data'])) {
        $js['data'] = [];
    }
    if (isset($js['data']['onclick'])) {
        $button['onclick'] = $js['onclick'] = $js['data']['onclick'];
    }
    if (isset($js['data']['onfocus'])) {
        $button['onfocus'] = $js['onfocus'] = $js['data']['onfocus'];
    }
    if (strpos($button['class'], 'disabled') !== FALSE) {
        if (!isset($js['onclick']) && !isset($button['onclick']) && !isset($js['data']['onclick'])) {
            $button['onclick'] = $js['onclick'] = "if(jQuery(this).hasClass('disabled')){event.stopPropagation(); return false;} else {}";
        }
        if (!isset($js['onfocus']) && !isset($button['onfocus']) && !isset($js['data']['onfocus'])) {
            $button['onfocus'] = $js['onfocus'] = "jQuery('button', 'input[type!=hidden]', 'select').focus(); event.stopPropagation(); return false;";
        }
    }
    
    $output = '<button';
    foreach ($button as $k => $v) {
        if ($k == 'value' || is_array($v)) {
            continue;
        }
        if ($k == 'title') {
            $js['data'][$k] = $v;
        }
        if ($k == "coins" && $v <= 0) {
            continue;
        }
        if (strtoupper(substr($k, 0, 2)) == "ON") {
            $k = strtolower($k);
            $js['data'][$k] = $v;
        }
        $output .= ' ' . $k . '="' . $v . '"';
    }
    $output .= '>';
    if (strpos($button['class'], "layoutButton") !== FALSE) {
        $output .= <<<HTML
<div class="button-container addHoverClick">
		<i></i>
	</div>
HTML;
    } else {
        if (isset($button['coins']) && $button['coins'] > 0) {
			if(strpos($button['class'],'textButtonV1')!==FALSE) $content .= '<img src="img/x.gif" class="goldIcon" alt="" /><span class="goldValue">' . $button['coins'] . '</span>';
            if(strpos($button['class'],'textButtonV2')!==FALSE) $content .= $svg['gold_button_small'].'<span class="goldValue">' . $button['coins'] . '</span>';
            $js['data']['coins'] = $button['coins'];
        }
        $output .= <<<HTML
<div class="button-container addHoverClick">
		<div class="button-background">
			<div class="buttonStart">
				<div class="buttonEnd">
					<div class="buttonMiddle"></div>
				</div>
			</div>
		</div>
		<div class="button-content">{$content}</div>
HTML;
    }
    if (isset($js['speechBubble']) && $js['speechBubble'] > 0) {
        $output .= '<div class="speechBubbleContainer ">
              <div class="speechBubbleBackground"><div class="start"><div class="end"><div class="middle"></div></div></div></div>
              <div class="speechBubbleContent">' . $js['speechBubble'] . '</div>
            </div><div class="clear"></div>';
    }
    $output .= '</button>
    <script type="text/javascript" id="' . $button['id'] . '_script">';
    if (isset($js['title'])) {
        $output .= "
        jQuery(function()
        {
          var button = jQuery('#{$button['id']}');
          if (button)
          {
            var titleFunction = function()
            {
              button.removeEvent('" . $js['title_act'] . "', titleFunction);
              Travian.Game.Layout.loadLayoutButtonTitle(button, '" . $js['title_section'] . "', '" . $js['title_action'] . "');
            };
            button.addEvent('" . $js['title_act'] . "', titleFunction);
          }
        });
      ";
    }
    $js['data']['id'] = $button['id'];
    $output .= "
    jQuery(function()
        {
          jQuery('#{$button['id']}').click(function (event)
          {
            jQuery(window).trigger('buttonClicked', [this, " . json_encode($js['data']) . "]);
          });
        });
    ";
    $output .= '</script>';

    return $output;
}

function get_button_id()
{
    //$encode = get_random_string(13);
    static $id = 0;
    static $alpha = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    ++$id;
    return 'button' . $alpha[mt_rand(0, 51)] . $id;
}

function get_random_string($length)
{
    // Character List to Pick from
    $chrList = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    // Minimum/Maximum times to repeat character List to seed from
    $chrRepeatMin = 1; // Minimum times to repeat the seed string
    $chrRepeatMax = 10; // Maximum times to repeat the seed string
    // Length of Random String returned
    $chrRandomLength = $length;

    // The ONE LINE random command with the above variables.
    return substr(str_shuffle(str_repeat($chrList, mt_rand($chrRepeatMin, $chrRepeatMax))), 1, $chrRandomLength);
}

function secondsToString($seconds, $isTrainingTime = false)
{
    if (is_string($seconds)) return $seconds;
    if ($isTrainingTime) {
        if (Config::getInstance()->game->useNanoseconds) {
            return nanosecondsToString($seconds);
        } else if (Config::getInstance()->game->useMilSeconds) {
            return milisecondsToString($seconds);
        }
    }
    if ($seconds == time()) {
        return TimezoneHelper::date("H:i:s");
    }
    $h = (int)floor($seconds / 3600);
    $m = (int)floor($seconds % 3600 / 60);
    $s = (int)floor($seconds % 60);
    return $h . ":" . ($m < 10 ? "0" : "") . $m . ":" . ($s < 10 ? "0" : "") . $s;
}

function milisecondsToString($ms)
{
    if ($ms % 1000 == 0) {
        return secondsToString($ms / 1000);
    }
    $sec = (int)floor($ms / 1000);
    $ms = $ms % 1000;
    $min = (int)floor($sec / 60);
    $sec = $sec % 60;
    $hr = (int)floor($min / 60);
    $min = $min % 60;
    $res = sprintf("%02d:%02d:%02d (+%d " . T("Global", 'ms') . ")", $hr, $min, $sec, $ms);
    return $res;
}

function nanosecondsToString($ns)
{
    if ($ns % 1e9 == 0) {
        return secondsToString($ns / 1e9);
    }
    $sec = (int)floor($ns / 1e9);
    $ns = $ns % 1e9;
    $min = (int)floor($sec / 60);
    $sec = $sec % 60;
    $hr = (int)floor($min / 60);
    $min = $min % 60;
    $res = sprintf("%02d:%02d:%02d (+%s " . T("Global", 'ms') . ")", $hr, $min, $sec, round($ns / 1e6, 3));
    return $res;
}

function is_lowres()
{
    return isset($_COOKIE['lowRes']) && $_COOKIE['lowRes'] == 1;
}

function get_gpack_cdn_base_url()
{
    return '//gpack' . '.' . WebService::getRealDomain();
}

function get_gpack_cdn_base_url_with_protocol()
{
    return 'http://gpack' . '.' . WebService::getRealDomain();
}

function get_gpack_version($default = false)
{
    global $globalConfig;
    $gpack_version = $globalConfig['staticParameters']['gpacks']['default'];

    return $gpack_version;
    if (!$default) {
        $gpackList = $globalConfig['staticParameters']['gpacks']['list'];
        if (isset($_COOKIE['travian_gpack_hash'])) {
            if (isset($gpackList[$_COOKIE['travian_gpack_hash']])) {
                $gpack_version = $_COOKIE['travian_gpack_hash'];
            }
        }
    }
    return $gpack_version;
}

function set_gpack_version($gpack_version)
{
    global $globalConfig;
    $gpackList = $globalConfig['staticParameters']['gpacks']['list'];
    if ($gpackList[$gpack_version]) {
        setcookie('travian_gpack_hash', $gpack_version, time() + 365 * 86400);
    }
}

function get_gpack_cdn_url($default = false)
{
    return get_gpack_cdn_base_url() . get_gpack_version($default) . '/';
}

function get_gpack_cdn_mainPage_url($default = false)
{
    return get_gpack_cdn_base_url() . get_gpack_version($default) . '/mainPage/';
}

function redirect($url, $code = 302)
{
    if (!$url) {
        return;
    }
    if (!in_array($code, [301, 302])) {
        $code = 302;
    }
    header("Location: " . $url, TRUE, $code);
    exit();
}

function getCoordinatesHTML($x, $y)
{
    $HTML = null;
    $HTML .= '<span class="coordinates coordinatesWrapper">';
    $HTML .= '<span class="coordinateX">(&#8237;' . $x . '&#8236;</span>';
    $HTML .= '<span class="coordinatePipe">|</span>';
    $HTML .= '<span class="coordinateY">&#8237;' . $y . '&#8236;)</span>';
    $HTML .= '</span>';
    return $HTML;
}

function createBoxTitleHTML($title, $html, $centered = false)
{
    return '<div class="roundedCornersBox big">
            <h4><div class="statusMessage">' . $title . '</div></h4>
            <div id="contractSpacer"></div>
            <div id="contract" class="contractWrapper">
                <div class="contractLink ' . ($centered ? 'centeredText' : '') . '">
                    <div>' . $html . '</div>
                    <br />
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>';
}

function get_crypt_js_link()
{
    $time = Config::getInstance()->dynamic->lastMedalsGiven;
    $fileName = 'crypt.js?v=4'.$time;
    if (is_lowres()) {
        $fileName = 'crypt-lowres.js?v='.$time;
    }
    return $fileName;
}


function getTimeZone()
{
    $seconds = date("O");
    if (strstr($seconds, "-")) {
        $type = 2;
    } else {
        $type = 1;
    }
    $seconds = preg_replace("/[^0-9]/", '', $seconds);
    $h = substr($seconds, 0, 2);
    $m = substr($seconds, 2, 2);
    return ($type == 1 ? "+" : "-") . "$h:$m";
}

function filemtime_remote_key($uri, $cacheKey)
{
    $cacheKey = 'fmt:' . $cacheKey;
    $cache = Caching::getInstance();
    if ($_cache = $cache->get($cacheKey)) {
        return $_cache;
    }
    $uri = parse_url($uri);
    $handle = @fsockopen($uri['host'], 80);
    if (!$handle) {
        return 0;
    }
    fputs($handle, "GET {$uri['path']} HTTP/1.1\r\nHost: {$uri['host']}\r\n\r\n");
    $result = 0;
    while (!feof($handle)) {
        $line = fgets($handle, 1024);
        if (!trim($line)) {
            break;
        }
        $col = strpos($line, ':');
        if ($col !== FALSE) {
            $header = trim(substr($line, 0, $col));
            $value = trim(substr($line, $col + 1));
            if (strtolower($header) == 'last-modified') {
                $result = strtotime($value);
                break;
            }
        }
    }
    fclose($handle);
    $result = substr(sha1($result), -5);
    $cache->add($cacheKey, $result, 7200);
    return $result;
}

function get_language_properties($key = null)
{
    $config = Config::getInstance();
    $lang = Session::getInstance()->getLanguage();
    $langProperties = $config->settings->availableLanguages->$lang;
    if (!is_null($key)) {
        return $langProperties->$key;
    }
    return $langProperties;
}

function get_locale()
{
    return get_language_properties('locale');
}

function get_gpack_link_and_hash($fileName, $useLang = false)
{
    $time = Config::getInstance()->dynamic->lastMedalsGiven;
    if ($useLang) {
        $fileName = get_gpack_cdn_mainPage_url() . 'lang/' . get_language_properties('locale') . '/' . $fileName;
    } else {
        $fileName = get_gpack_cdn_mainPage_url() . 'css/' . $fileName;
    }
    return $fileName. '?v='.$time;
}

function getTradeRouteTimeText($value)
{
    if ($value < 3600) {
        $text = sprintf(T("MarketPlace", "every %s minutes"), floor($value / 60));
    } else if ($value < 86400) {
        $text = sprintf(T("MarketPlace", "every %s hours"), floor($value / 3600));
    } else {
        $text = sprintf(T("MarketPlace", "every %s days"), floor($value / 86400));
    }
    return $text;
}

function array_filter_units($row)
{
    $units = [];
    for ($i = 1; $i <= 11; ++$i) {
        if (!isset($row['u' . $i])) {
            continue;
        }
        $units[$i] = $row['u' . $i];
    }

    return $units;
}

function is_new_gpack()
{
    global $globalConfig;
    return $globalConfig['staticParameters']['gpacks']['list'][get_gpack_version()]['isNew'];
}

function game_progress()
{
    $rate = getGameElapsedSeconds() / (getGame("round_length") * 86400);
    if ($rate < 0) {
        $rate = 0;
    } else if ($rate > 1) {
        $rate = 1;
    }
    return $rate;
}

function getGameLengthDays($speed)
{
    return ((250 / $speed) + ((1 / $speed) * 100));
}

function detect_season()
{
    if (getDisplay('disableSeasons')) return null;
    //get current month
    $currentMonth = date("m");
    //retrieve season
    if ($currentMonth >= "03" && $currentMonth <= "05")
        $season = "spring";
    elseif ($currentMonth >= "06" && $currentMonth <= "08")
        $season = "summer";
    elseif ($currentMonth >= "09" && $currentMonth <= "11")
        $season = "fall";
    else
        $season = "winter";
    return $season;
}

function number_to_string($number, $after = 0)
{
    $abs = abs($number);
    if ($abs > $after) {
        if ($abs < 1e3) {
            return $number;
        } else if ($abs < 1e3) {
            return round($number / 1e3, 3) . 'K'; //Kilo
        } else if ($abs < 1e9) {
            return round($number / 1e6, 3) . 'M'; //Million
        } else if ($abs < 1e12) {
            return round($number / 1e9, 3) . 'B'; //Billion
        } else if ($abs < 1e15) {
            return round($number / 1e12, 3) . 'T'; //Trillion
        } else if ($abs < 1e18) {
            return round($number / 1e15, 3) . 'Q'; //Quadrillion
        } else if ($abs < 1e24) {
            return round($number / 1e21, 3) . 'S'; //Sextillion
        }
    }
    return number_format_x($number);
}

function is_my_ip()
{
    return WebService::ipAddress() == '188.99.108.8';
}
