<?php

namespace Game;

use Controller\GameCtrl;
use Controller\TG_PAY;
use Controller\VoucherCtrl;
use Core\Caching\Caching;
use Core\Database\DB;
use Core\Helper\Mailer;
use Core\Helper\WebService;
use Core\Session;
use resources\View\PHPBatchView;

class EmailVerification
{
    public static function isEmailVerified()
    {
        $session = Session::getInstance();
        return $session->isEmailVerified();
    }
    public static function disallowIfNotVerified(GameCtrl $instance)
    {
        $session = Session::getInstance();
        if ($session->isEmailVerified()) return false;
        $instance_disallow = [
            TG_PAY::class,
            VoucherCtrl::class
        ];
        foreach ($instance_disallow as $i) {
            if ($instance instanceof $i) return true;
        }
        return false;
    }

    public static function resendVerificationEmail($uid)
    {
        $m = new \Model\EmailVerification();
        Session::getInstance()->setValidationStatus(FALSE);
        $row = $m->getActivationProgressByUid($uid);
        $cache = Caching::getInstance();
        $key = self::fixKey("tries" . $row['id']);
        if ($cache->exists($key) && $cache->get($key) >= 2) {
            Session::getInstance()->setValidationStatus(false);
            return false;
        }
        $cache->set($key, $cache->exists($key) ? ($cache->get($key) + 1) : 1, 3600);
        $params = [
            'playerName' => Session::getInstance()->getName(),
            'email' => $row['email'],
            'verification_url' => WebService::get_real_base_url() . 'verify-url.php?code=' . sprintf("%s-%s", $row['id'], $row['activationCode']),
            'verification_code' => sprintf("%s-%s", $row['id'], $row['activationCode']),
        ];
        Mailer::sendEmail($row['email'], T("EVerify", "Email verification"), PHPBatchView::render("verify/email", $params));
        return true;
    }

    private static function fixKey($key)
    {
        return Session::getInstance()->getPlayerId() . ":TEV:" . $key;
    }

    public static function sendVerificationEmail($uid, $email)
    {
        $db = DB::getInstance();
        $code = get_random_string(mt_rand(18, 28));
        $db->query("INSERT INTO `activation_progress` (`uid`, `email`, `activationCode`, `time`) VALUES ($uid, '$email', '$code', '" . time() . "')");
        $id = $db->lastInsertId();
        $params = [
            'playerName' => Session::getInstance()->getName(),
            'email' => $email,
            'verification_url' => WebService::get_real_base_url() . 'verify-url.php?code=' . sprintf("%s-%s", $id, $code),
            'verification_code' => sprintf("%s-%s", $id, $code),
        ];
        Mailer::sendEmail($email, T("EVerify", "Email verification"), PHPBatchView::render("verify/email", $params));
    }
}