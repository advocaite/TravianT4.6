<?php
namespace Controller;
use Core\Database\GlobalDB;
use Core\Helper\TimezoneHelper;
use Core\Helper\WebService;
use resources\View\GameView;
use resources\View\OutOfGameView;
use resources\View\PHPBatchView;

class SupportFormCtrl extends GameCtrl
{
    private $data;
    public function __construct()
    {
        parent::__construct();
        $this->view = new GameView();
        $this->view->vars['titleInHeader'] = T("inGameSupport", "Support");
        $this->view->vars['bodyCssClass'] = 'perspectiveBuildings';
        $this->view->vars['contentCssClass'] = 'support';
        if(isset($_GET['success']) && $_GET['success'] == 1){
            $this->view->vars['content'] .= '<p>'.T("inGameSupport", "done").'</p>';
            $this->view->vars['content'] .= '<p><a href="/dorf1.php">'.T("inGameSupport", "Back to the village").'</a></p>';
            return;
        }
        //hoselam nakeshid benevisam :|
        $this->redirect("messages.php?t=1&id=2");
        {
            $countErrors = 0;

            $this->data['category']['value'] = 'please_select';
            $this->data['category']['error'] = '';
            if(WebService::isPost()){
                $this->data['category']['value'] = filter_var(trim($_POST['support']['category']), FILTER_SANITIZE_EMAIL);
                if(!in_array($this->data['category']['value'], ['game_support', 'rule_violation', 'plus_support'])){
                    $this->data['category']['error'] = T("Support", "errors.please select");
                    $countErrors++;
                }
            }
            $this->data['supportType']['value'] = 'please_select';
            $this->data['supportType']['error'] = '';
            $this->data['supportType']['content'] = '';
            $this->data['supportType']['valid_values'] = [];

            if($this->data['category']['value'] == 'please_select' || $this->data['category']['value'] == 'game_support' || empty($this->data['category']['value'])){
                $this->data['supportType']['valid_values'] = [
                    'general_questions' => 'general questions',
                    'report_error' => 'report an error',
                ];
            } else if($this->data['category']['value'] == 'rule_violation'){
                $this->data['supportType']['valid_values'] = [
                    'report_playername' => 'report player name',
                    'report_profiletext' => 'report profile content',
                    'report_offence' => 'report insult',
                    'report_multi' => 'report multiaccount',
                    'other_violation' => 'other rule violation',
                    'question_about_accountlock' => 'question about my ban',
                ];
            } else if($this->data['category']['value'] == 'plus_support'){
                $this->data['supportType']['valid_values'] = [
                    'report_playername' => 'report player name',
                    'report_profiletext' => 'report profile content',
                    'report_offence' => 'report insult',
                    'report_multi' => 'report multiaccount',
                    'other_violation' => 'other rule violation',
                    'question_about_accountlock' => 'question about my ban',
                ];
            }


            if(WebService::isPost()){
                $this->data['supportType']['value'] = filter_var(trim($_POST['support']['supportType']), FILTER_SANITIZE_EMAIL);
                if(!in_array($this->data['supportType']['value'], ['general_questions', 'report_error'])){
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
        $this->view->vars['content'] .= (new PHPBatchView("support"))->output($this->data);
    }
}