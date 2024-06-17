<?php
namespace Core;
use PHPMailer\PHPMailer\PHPMailer;
class Mailer
{
    public static function sendMail($to, $subject, $html)
    {
        global $indexConfig;
        if(empty($to)){
            return true;
        }
        $mail = new PHPMailer(TRUE);
        if(isset($indexConfig['mail']['type']) && $indexConfig['mail']['type'] == 'smtp'){
            $mail->isSMTP();
            $mail->SMTPDebug = 2;
            $mail->Host = $indexConfig['mail']['host'];
            $mail->Port = $indexConfig['mail']['port'];
            $mail->SMTPAuth = true;
            $mail->Username = $indexConfig['mail']['username'];
            $mail->Password = $indexConfig['mail']['password'];
        }
        $mail->CharSet = 'UTF-8';
        $mail->SetFrom('noreply@' . WebService::getJustDomain());
        $mail->AddReplyTo('noreply@' . WebService::getJustDomain());
        if(is_array($to)) {
            foreach($to as $email) {
                $mail->AddAddress($email);
            }
        } else {
            $mail->AddAddress($to);
        }
        $mail->Subject = $subject;
        $mail->MsgHTML($html);
        $result = $mail->Send();
        return $result;
    }
}