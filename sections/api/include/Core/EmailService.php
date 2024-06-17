<?php

namespace Core;

use Database\DB;

class EmailService
{
    public static function sendYouRegisteredOn($email, $worldId, $username, $password, $gameWorldUrl)
    {
        global $twig;
        $params = [
            'DIRECTION' => Translator::getDirection(),
            'PLAYER_NAME' => $username,
            'PASSWORD' => $password,
            'GAME_WORLD_URL' => $gameWorldUrl,
            'WORLD_ID' => $worldId,
        ];
        $subject = sprintf(T("Thank you for registering on %s"), $worldId);
        $content = $twig->render('mail/registrationComplete.twig', $params);
        return self::sendMail($email, $subject, $content);
    }

    public static function sendActivationMail($email, $serverId, $worldId, $username, $activationCode)
    {
        global $twig;
        $params = [
            'DIRECTION' => Translator::getDirection(),
            'PLAYER_NAME' => $username,
            'ACTIVATE_URL' => WebService::getIndexUrl() . Translator::getHrefLang() . '?activationCode=' . $activationCode . '&server=' . $worldId . '#activation',
            'ACTIVATION_CODE' => $activationCode,
            'WORLD_ID' => $worldId,
        ];
        $subject = sprintf(T("Thank you for registering on %s"), $worldId);
        $content = $twig->render('mail/activation.twig', $params);
        return self::sendMail($email, $subject, $content);
    }

    public static function sendMail($to, $subject, $html, $priority = 0)
    {
        $db = DB::getInstance();
        $stmt = $db->prepare("INSERT INTO mailServer (toEmail, subject, html, priority) VALUES (?,?,?,?)");
        $stmt->execute([$to, $subject, $html, $priority]);
        return $stmt->rowCount();
    }

    public static function sendForgottenAccounts($email, $gameWorlds)
    {
        global $twig;
        $params = [
            'DIRECTION' => Translator::getDirection(),
            'gameWorlds' => $gameWorlds,
        ];
        $subject = T("You have requested a search for your game world");
        $content = $twig->render('mail/forgottenWorlds.twig', $params);
        return self::sendMail($email, $subject, $content);
    }

    public static function sendPasswordForgotten($email, $worldUniqueId, $worldId, $uid, $recoveryCode)
    {
        global $twig;
        $params = [
            'DIRECTION' => Translator::getDirection(),
            'WORLD_ID' => $worldId,
            'CHANGE_PASSWORD_URL' => WebService::getIndexUrl() . Translator::getHrefLang() . '?recoveryCode=' . $recoveryCode . '&uid=' . $uid . '&server=' . $worldId . '&serverId=' . $worldUniqueId . '#recovery',
        ];
        $subject = sprintf(T("You have requested a new password for %s"), $worldId);
        $content = $twig->render('mail/requestNewPassword.twig', $params);
        return self::sendMail($email, $subject, $content);
    }
}