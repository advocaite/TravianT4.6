<?php

namespace Controller;

use Core\Database\DB;
use Core\Helper\SessionVar;
use Core\Helper\TimezoneHelper;
use Core\Helper\WebService;
use Core\Locale;
use Core\Session;

class BannedCtrl
{
    public function __construct(&$contentCssClass, &$content, $click = FALSE)
    {
        Session::getInstance()->decreaseClicks();
        $contentCssClass = 'sysmsg';
        $content = '<div class="sysmsg">';
        $order = [];
        $order[] = Session::getInstance()->getName();
        $db = DB::getInstance();
        if ($click) {
            if (WebService::isPost()) {
                if (recaptcha_check_answer()) {
                    SessionVar::timeoutNow("sessionClicks");
                    SessionVar::timeoutNow("clickBlocked");
                    WebService::redirect("dorf1.php");
                } else {
                    $content .= T("reCaptcha", "Sorry you submitted wrong answer");
                }
            }
            $content .= <<<HTML
<script type="text/javascript">
    function submitForm(){
        document.getElementById("verifyForm").submit();
    }
</script>
HTML;
            $content .= vsprintf(T("inGame", 'bannedClickPage'), $order);
            $content .= '<hr /><form id="verifyForm" action="?verify" method="POST">';
            $content .= '<input type="hidden" name="reCaptchaVerify" value="1">';
            $content .= T("reCaptcha", "desc") . '<br /><br />';
            $content .= '<center>';
            $content .= recaptcha_get_html('submitForm');
            $content .= '</center>';
            $content .= '</form>';
        } else {
            $result = $db->query("SELECT * FROM banQueue WHERE uid=" . Session::getInstance()->getPlayerId() . " ORDER BY id DESC LIMIT 1");
            if ($result->num_rows) {
                $result = $result->fetch_assoc();
                if (!$result['time']) {
                    $content .= vsprintf(T("inGame", $click ? 'bannedClickPage' : "bannedPage"), $order);
                } else {
                    if (!empty($result['reason'])) {
                        $order[] = T("inGame", "infoBox.Reasons.{$result['reason']}");
                        $order[] = TimezoneHelper::autoDateString($result['end'], true);
                        $content .= vsprintf(T("inGame", 'bannedPageWithTime'), $order);
                    }
                }
            } else {
                $content .= vsprintf(T("inGame", 'bannedClickPage'), $order);
            }
        }
        if (!$click) {
            $content .= '<p class="f16" align="center"><a href="dorf1.php?ok=1">» ' . T("inGame", "continue") . '</a></p>';
        } else {
            $content .= '<p class="f16" align="center"><a href="' . addslashes(filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_STRING)) . '">» ' . T("inGame", "continue") . '</a></p>';
        }
        $content .= '</div>';
    }
} 