<?php
namespace Controller;
use Core\Database\GlobalDB;
use Core\Helper\TimezoneHelper;
use Core\Helper\WebService;
use resources\View\OutOfGameView;
use resources\View\PHPBatchView;

class SupportCtrl extends OutOfGameCtrl
{
    private $data;
    public function __construct()
    {
        $this->view = new OutOfGameView();
        $this->view->vars['titleInHeader'] = T("Support", "Support");
        $this->view->vars['bodyCssClass'] = 'perspectiveBuildings';
        $this->view->vars['contentCssClass'] = 'support';
        if(isset($_GET['success']) && $_GET['success'] == 1){
            $this->view->vars['content'] .= '<p>'.T("Support", "done").'</p>';
            return;
        }
        {
            $countErrors = 0;
            $this->data['gameWorld']['value'] = 'please_select';
            $this->data['gameWorld']['content'] = '';
            $this->data['gameWorld']['valid_values'] = ['i_do_not_know'];
            $globalDB = GlobalDB::getInstance();
            $servers = $globalDB->query("SELECT name, gameWorldUrl FROM gameServers WHERE hidden=0 ORDER BY startTime DESC");
            while($row = $servers->fetch_assoc()){
                $selected = false;
                $value = $row['name'] . ' - ' . $row['gameWorldUrl'];
                if(isset($_POST['support']['gameworld']) && $_POST['support']['gameworld'] == $value){
                    $selected = true;
                }
                $this->data['gameWorld']['content'] .= '<option value="'.$value.'" '.($selected ? 'selected="yes"' : '').'>'.$value.'</option>';
                $this->data['gameWorld']['valid_values'][] = $value;
            }
            $this->data['gameWorld']['error'] = '';
            if(WebService::isPost()){
                $this->data['gameWorld']['value'] = filter_var(trim($_POST['support']['gameworld']), FILTER_SANITIZE_STRING);
                if(!in_array($this->data['gameWorld']['value'], $this->data['gameWorld']['valid_values'])){
                    $this->data['gameWorld']['error'] = T("Support", "errors.please select");
                    $countErrors++;
                }
            }
            $this->data['username']['value'] = '';
            $this->data['username']['error'] = '';
            if(WebService::isPost()){
                $this->data['username']['value'] = filter_var(trim($_POST['support']['username']), FILTER_SANITIZE_STRING);
                if(empty($this->data['username']['value'])){
                    $this->data['username']['error'] = T("Support", "errors.This field is necessary");
                    $countErrors++;
                }
            }
            $this->data['email']['value'] = '';
            $this->data['email']['error'] = '';
            if(WebService::isPost()){
                $this->data['email']['value'] = filter_var(trim($_POST['support']['email']), FILTER_SANITIZE_EMAIL);
                if(empty($this->data['email']['value'])){
                    $this->data['email']['error'] = T("Support", "errors.This field is necessary");
                    $countErrors++;
                } else if(filter_var($this->data['email']['value'], FILTER_VALIDATE_EMAIL) === FALSE) {
                    $this->data['email']['error'] = T("Support", "errors.Invalid email address");
                    $countErrors++;
                }
            }
            $this->data['supportType']['value'] = 'please_select';
            $this->data['supportType']['error'] = '';
            if(WebService::isPost()){
                $this->data['supportType']['value'] = filter_var(trim($_POST['support']['supportType']), FILTER_SANITIZE_EMAIL);
                if(!in_array($this->data['supportType']['value'], ['general_querstions', 'i_can_not_login', 'i_can_not_register'])){
                    $this->data['supportType']['error'] = T("Support", "errors.please select");
                    $countErrors++;
                }
            }
            $this->data['message']['value'] = '';
            $this->data['message']['error'] = '';
            if(WebService::isPost()){
                $this->data['message']['value'] = filter_var(trim(strip_tags($_POST['support']['message'])), FILTER_SANITIZE_STRING);
                if(empty($this->data['message']['value'])){
                    $this->data['message']['error'] = T("Support", "errors.This field is necessary");
                    $countErrors++;
                } else if(strlen($this->data['message']['value']) <= 20){
                    $this->data['message']['error'] = T("Support", "errors.Entry is too short");
                    $countErrors++;
                }

                if(!recaptcha_check_answer()){
                    $this->data['message']['error'] = T("Support", "errors.Wrong captcha");
                    $countErrors++;
                }
            }
            if(!$countErrors && WebService::isPost()){
                $to = 'chamirhossein@gmail.com';
                $from = "support@".WebService::getJustDomain();
                $reply = $this->data['email']['value'];
                $subject = 'via support form';
                $headers = "From: $from\r\nReply-to: $reply\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=utf8\r\n";
                $message = "Game World: {$this->data['gameWorld']['value']}
                Username: {$this->data['username']['value']}
                Email: {$this->data['email']['value']}
                Support type: {$this->data['supportType']['value']}
                Message: {$this->data['message']['value']}
                This message has been received in ".TimezoneHelper::date("Y-m-d H:i").".";
                mail($to, $subject, nl2br($message), $headers);
                $this->redirect("support.php?success=1");
                return;
            }
        }
        $this->view->vars['content'] .= (new PHPBatchView("support/support"))->output($this->data);
    }
}