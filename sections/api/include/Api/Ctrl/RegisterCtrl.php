<?php

namespace Api\Ctrl;

use Api\ApiAbstractCtrl;
use Core\ActivateHandler;
use Core\EmailService;
use Core\Newsletter;
use Core\Server;
use Core\WebService;
use Database\DB;
use Database\ServerDB;
use Exceptions\MissingParameterException;
use PDO;

class RegisterCtrl extends ApiAbstractCtrl
{
    public function resendActivationMail()
    {
        $needs = ['gameWorld', 'email'];
        foreach ($needs as $k) {
            if (!isset($this->payload[$k])) {
                throw new MissingParameterException($k);
            }
        }
        $this->response['success'] = false;
        $server = Server::getServerById((int)$this->payload['gameWorld']);
        if (!$server) {
            $this->response['fields']['email'] = 'unknownGameWorld';
            return;
        }
        $email = filter_var($this->payload['email'], FILTER_SANITIZE_EMAIL);
        $activation = $this->getActivationByEmail($server['id'], $email);
        if ($activation) {
            $this->response['success'] = true;
            EmailService::sendActivationMail($email, $activation['worldId'], $server['worldId'], $activation['name'], $activation['activationCode']);
            return;
        }
        $this->response['fields']['email'] = 'emailUnknown';
    }

    private function getActivationByEmail($worldId, $email)
    {
        $db = DB::getInstance();
        $stmt = $db->prepare("SELECT * FROM activation WHERE worldId=:wid AND email=:email AND used=0");
        $stmt->bindValue('wid', $worldId, PDO::PARAM_INT);
        $stmt->bindValue('email', $email, PDO::PARAM_STR);
        $stmt->execute();
        if (!$stmt->rowCount()) {
            return false;
        }
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function activate()
    {
        global $globalConfig;
        $needs = ['gameWorld', 'activationCode', 'password', 'captcha'];
        foreach ($needs as $k) {
            if (!isset($this->payload[$k])) {
                throw new MissingParameterException($k);
            }
        }
        $this->response['success'] = false;
        $recaptcha = new \ReCaptcha\ReCaptcha($globalConfig['staticParameters']['recaptcha_private_key']);
        $resp = $recaptcha->verify($this->payload['captcha'], WebService::ipAddress());
        if (!$resp->isSuccess()) {
            $this->response['fields']['captcha'] = 'invalidCaptcha';
            return;
        }
        $activation = $this->getActivationByActivationCode((int)$this->payload['gameWorld'], $this->payload['activationCode']);
        if ($activation) {
            $password = $this->payload['password'];
            if (strlen($password) < 4) {
                return;
            }
            if (empty($password)) {
                return;
            }
            if (!empty($password) && $password == $activation['name']) {
                $this->response['fields']['password'] = 'passwordLikeName';
                return;
            }
            //passwordInsecure
            $db = DB::getInstance();
            $db->query("UPDATE activation SET used=1 WHERE id=" . $activation['id']);
            if ($activation['newsletter'] || TRUE) {
                Newsletter::addEmail($activation['email']);
            }
            $server = Server::getServerById($activation['worldId']);
            $serverDB = ServerDB::getInstance($server['configFileLocation']);
            $token = ActivateHandler::addActivation($activation['name'], $password, $activation['email'], $activation['refUid'], $serverDB);
            $this->response['success'] = true;
            $this->response['redirect'] = $server['gameWorldUrl'] . 'activate.php?token=' . $token;
        } else {
            $this->response['fields']['activationCode'] = 'activationNotFound';
        }
    }

    private function getActivationByActivationCode($worldId, $activationCode)
    {
        $db = DB::getInstance();
        $stmt = $db->prepare("SELECT * FROM activation WHERE worldId=:wid AND activationCode=:activationCode AND used=0");
        $stmt->bindValue('wid', $worldId, PDO::PARAM_INT);
        $stmt->bindValue('activationCode', $activationCode, PDO::PARAM_STR);
        $stmt->execute();
        if (!$stmt->rowCount()) {
            return false;
        }
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function register()
    {
        $needs = ['gameWorld', 'username', 'email', 'termsAndConditions'];
        foreach ($needs as $k) {
            if (!isset($this->payload[$k])) {
                throw new MissingParameterException($k);
            }
        }
        $this->response['success'] = false;
        $server = Server::getServerById((int)$this->payload['gameWorld']);
        if (!$server) {
            $this->response['fields']['username'] = 'unknownGameWorld';
            return;
        }
        if ($server['registerClosed'] == 1 || $server['finished'] == 1) {
            $this->response['fields']['username'] = 'registrationClosed';
            return;
        }
        $inviter = isset($this->payload['inviter']) ? $this->payload['inviter'] : [];
        $username = trim($this->payload['username']);
        $password = isset($this->payload['password']) ? $this->payload['password'] : null;
        $email = trim($this->payload['email']);
        $registrationKey = isset($this->payload['registrationKey']) ? trim($this->payload['registrationKey']) : null;
        $subscribeNewsletter = isset($this->payload['subscribeNewsletter']) && $this->payload['subscribeNewsletter'];
        $termsAndConditions = isset($this->payload['termsAndConditions']) && $this->payload['termsAndConditions'];
        $errors = 0;
        {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                ++$errors;
            }
            if (empty($email)) {
                ++$errors;
            }
            if (strlen($email) < 5) { //5 letters.
                ++$errors;
            }
            if (strlen($email) > 90) { //5 letters.
                ++$errors;
            }
        }
        {
            if (!empty($username) && $this->isNameBlackListed($username)) {
                if (!isset($this->response['username']['password'])) {
                    $this->response['fields']['username'] = 'usernameBlacklisted';
                }
                ++$errors;
            }
        }
        {
            if (empty($username)
                || !filter_var($username, FILTER_SANITIZE_STRING)
                || strpos($username, '@') !== FALSE
            ) {
                if (!isset($this->response['fields']['username'])) {
                    $this->response['fields']['username'] = 'invalidChars';
                }
                ++$errors;
            }
            if (strlen($username) < 3) {
                ++$errors;
            }
            if (strlen($username) > 15) {
                ++$errors;
            }
        }
        if ($server['activation'] == 0) {
            if (empty($password)) {
                $errors++;
            }
            if (!empty($password) && !empty($username) && $password == $username) {
                if (!isset($this->response['fields']['password'])) {
                    $this->response['fields']['password'] = 'passwordLikeName';
                }
                ++$errors;
            }
        }
        if (!$termsAndConditions) {
            ++$errors;
        }
        $preRegister = FALSE;
        if ($server['preregistration_key_only']) {
            if (empty($registrationKey)) {
                ++$errors;
            } else if (!$this->checkPreRegistrationKey($server['id'], $registrationKey, null)) {
                $this->response['fields']['registrationKey'] = 'registrationCodeInvalid';
                ++$errors;
            } else {
                $preRegister = TRUE;
            }
        }
        $serverDB = ServerDB::getInstance($server['configFileLocation']);
        if (!isset($this->response['fields']['username'])) {
            if ($this->doesNameExists($server['id'], $serverDB, $username)) {
                $this->response['fields']['username'] = 'nameAlreadyExists';
                $errors++;
            }
        }
        if (!isset($this->response['fields']['email'])) {
            if ($this->doesEmailExists($server['id'], $serverDB, $email)) {
                $this->response['fields']['email'] = 'emailAlreadyRegistered';
                $errors++;
            } else if ($this->isEmailBlackListed($email)) {
                $this->response['fields']['email'] = 'emailInvalid';
                $errors++;
            }
        }
        if ($errors) {
            return;
        }
        if ($preRegister) {
            $this->useRegistrationKey($server['id'], $registrationKey);
        }
        $activationCode = substr(sha1(microtime() . $username . $email), 0, mt_rand(10, 13));
        $refUid = 0;
        if (isset($inviter['gameWorldName']) && isset($inviter['uid'])) {
            $refUid = $inviter['uid'];
        }
        $this->response['success'] = true;
        if ($server['activation'] == 0) {
            $token = ActivateHandler::addActivation($username, $password, $email, $refUid, $serverDB);
            EmailService::sendYouRegisteredOn($email, $server['worldId'], $username, $password, $server['gameWorldUrl']);
            $this->response['redirect'] = $server['gameWorldUrl'] . 'activate.php?token=' . $token;
        } else {
            $db = DB::getInstance();
            $stmt = $db->prepare("INSERT INTO activation (`worldId`, `name`, `password`, `email`, `activationCode`, `newsletter`, `refUid`, `time`) VALUES (:wid, :username, :password, :email, :activationCode, :newsletter, :refUid, :time)");
            $stmt->bindValue('wid', $server['id'], PDO::PARAM_INT);
            $stmt->bindValue('username', $username, PDO::PARAM_STR);
            $stmt->bindValue('password', empty($password) ? sha1(microtime() . time()) : '', PDO::PARAM_STR);
            $stmt->bindValue('email', $email, PDO::PARAM_STR);
            $stmt->bindValue('activationCode', $activationCode, PDO::PARAM_STR);
            $stmt->bindValue('newsletter', $subscribeNewsletter ? 1 : 0, PDO::PARAM_INT);
            $stmt->bindValue('refUid', $refUid, PDO::PARAM_INT);
            $stmt->bindValue('time', time(), PDO::PARAM_INT);
            $stmt->execute();
            EmailService::sendActivationMail($email, $server['id'], $server['worldId'], $username, $activationCode);
        }
    }

    private function isNameBlackListed($name)
    {
        $invalidNames = explode(",", file_get_contents(FILTERING_PATH . "blackListedNames.txt"));
        //names like natars | multihuneter | support
        foreach ($invalidNames as $blackListed) {
            $percent = 0;
            similar_text($name, $blackListed, $percent);
            if ($percent > 78.5) {
                return true; //:|
            }
        }
        return false;
    }

    private function checkPreRegistrationKey($worldId, $key, $name)
    {
        $db = DB::getInstance();
        $stmt = $db->prepare("SELECT COUNT(id) FROM preregistration_keys WHERE worldId=:worldId AND pre_key=:preRegKey AND used=0");
        $stmt->bindValue('worldId', $worldId, PDO::PARAM_STR);
        $stmt->bindValue('preRegKey', $key, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    private function doesNameExists($activeServerId, PDO $serverDB, $playerName)
    {
        {
            $stmt = DB::getInstance()->prepare("SELECT COUNT(id) FROM activation WHERE name=:name AND worldId=:worldId AND used=0");
            $stmt->bindValue("name", $playerName, PDO::PARAM_STR);
            $stmt->bindValue("worldId", $activeServerId, PDO::PARAM_INT);
            $stmt->execute();
            if ((int)$stmt->fetchColumn() > 0) return true;
        }
        {
            $stmt = $serverDB->prepare("SELECT COUNT(id) FROM users WHERE name=:name");
            $stmt->bindValue("name", $playerName);
            $stmt->execute();
            if ($stmt->fetchColumn() > 0) return true;
        }
        {
            $stmt = $serverDB->prepare("SELECT COUNT(id) FROM activation WHERE name=:name");
            $stmt->bindValue("name", $playerName);
            $stmt->execute();
            if ($stmt->fetchColumn() > 0) return true;
        }
        return false;
    }

    private function doesEmailExists($activeServerId, PDO $serverDB, $email)
    {
        $stmt = DB::getInstance()->prepare("SELECT COUNT(id) FROM activation WHERE email=:email AND worldId=:worldId AND used=0");
        $stmt->bindValue("email", $email, PDO::PARAM_STR);
        $stmt->bindValue("worldId", $activeServerId, PDO::PARAM_INT);
        $stmt->execute();
        if ((int)$stmt->fetchColumn() > 0) return true;
        {
            $stmt = $serverDB->prepare("SELECT COUNT(id) FROM activation WHERE email=:email");
            $stmt->bindValue("email", $email, PDO::PARAM_STR);
            $stmt->execute();
            if ((int)$stmt->fetchColumn() > 0) return true;
        }
        $stmt = $serverDB->prepare("SELECT COUNT(uid) FROM changeEmail WHERE email=:email");
        $stmt->bindValue("email", $email, PDO::PARAM_STR);
        $stmt->execute();
        if ((int)$stmt->fetchColumn() > 0) return true;

        $stmt = $serverDB->prepare("SELECT COUNT(id) FROM users WHERE email=:email AND email_verified=1");
        $stmt->bindValue("email", $email, PDO::PARAM_STR);
        $stmt->execute();
        if ((int)$stmt->fetchColumn() > 0) return true;

        return false;
    }

    private function isEmailBlackListed($email)
    {
        $email = strtolower($email);
        $db = DB::getInstance();
        $stmt = $db->prepare("SELECT COUNT(id) FROM email_blacklist WHERE email=:email");
        $stmt->bindValue('email', $email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    private function useRegistrationKey($worldId, $key)
    {
        $db = DB::getInstance();
        $stmt = $db->prepare("UPDATE preregistration_keys SET used=1 WHERE worldId=:worldId AND pre_key=:preRegKey");
        $stmt->bindValue('worldId', $worldId, PDO::PARAM_STR);
        $stmt->bindValue('preRegKey', $key, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
}