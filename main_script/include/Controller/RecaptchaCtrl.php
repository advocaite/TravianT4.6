<?php
namespace Controller;
use Core\Helper\WebService;
use Core\Locale;
use Core\Session;
use resources\View\OutOfGameView;
class RecaptchaCtrl extends GameCtrl
{
    public function __construct()
    {
        global $globalConfig;
        parent::__construct();
        $this->view = new OutOfGameView();
        $this->view->renderLoginBox = FALSE;
        $this->view->vars['headerBar'] = TRUE;
        $this->view->vars['showTime'] = TRUE;
        $this->view->vars['titleInHeader'] = T("reCaptcha", "title");
        $this->view->vars['bodyCssClass'] = 'perspectiveBuildings';
        $this->view->vars['contentCssClass'] = 'error_site';
        if(WebService::isPost()){
            //if(recaptcha_check_answer()){
                Session::getInstance()->setValidationStatus(true);
                WebService::redirect("dorf1.php");
            //} else {
            //    $this->view->vars['content'] .= T("reCaptcha", "Sorry you submitted wrong answer");
            //}
        }
        $this->view->vars['content'] .= <<<HTML
<script type="text/javascript">
    function submitForm(){
        document.getElementById("verifyForm").submit();
    }
</script>
HTML;
        $this->view->vars['content'] .= '<form id="verifyForm" action="?verify" method="POST">';
        $this->view->vars['content'] .= '<input type="hidden" name="reCaptchaVerify" value="1">';
        $this->view->vars['content'] .= T("reCaptcha", "desc") . '<br /><br />';
        $this->view->vars['content'] .= '<center>';
        $this->view->vars['content'] .= recaptcha_get_html('submitForm');
        $this->view->vars['content'] .= '</center>';
        $this->view->vars['content'] .= '</form>';
    }
}