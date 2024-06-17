<?php

namespace Controller;

use Core\Config;
use Core\Database\DB;
use Core\Database\GlobalDB;
use Core\Helper\IPTracker;
use Core\Helper\Mailer;
use Core\Helper\WebService;
use Game\Formulas;
use Model\InfoBoxModel;
use Model\MessageModel;
use Model\RegisterModel;
use resources\View\OutOfGameView;
use resources\View\PHPBatchView;
use function getWorldUniqueId;
use function session_regenerate_id;

class ActivateCtrl extends OutOfGameCtrl
{
    private $availableTribes  = [1, 2, 3, 6, 7];
    private $useNewActivation = false;
    private $token;
    private $activationRow    = [];

    public function __construct()
    {
        parent::__construct();
        if (!getGame("allowNewTribes")) {
            $this->availableTribes = [1, 2, 3];
        }
        $this->useNewActivation = is_new_gpack();
        $config = Config::getInstance();
        if ($config->dynamic->maintenance == TRUE) {
            $this->redirect("login.php");
        }
        $this->token = $token = filter_var(isset($_GET['token']) ? $_GET['token'] : (isset($_SESSION[WebService::fixSessionPrefix('token')]) ? $_SESSION[WebService::fixSessionPrefix('token')] : -1),FILTER_SANITIZE_STRING);
        if ($token == -1) {
            $this->redirect("login.php");
        }
        $db = DB::getInstance();

        $stmt = $db->query("SELECT * FROM activation WHERE token='$token'");
        $this->activationRow = false;
        if($stmt->num_rows){
            $this->activationRow = $stmt->fetch_assoc();
        }
        if ($this->activationRow === FALSE) {
            $this->redirect("login.php");
        }
        if ($config->game->start_time > time()) {
            $this->redirect("login.php?registered=true");
        }
        $_SESSION[WebService::fixSessionPrefix('token')] = $token;
        $this->view = new OutOfGameView();
        $this->view->vars['bodyCssClass'] = 'perspectiveBuildings';
        $this->view->vars['contentCssClass'] = 'activate';
        $page = isset($_REQUEST['page']) && in_array($_REQUEST['page'],
            ['vid', 'sector', 'confirmation', 'dorf']) ? $_REQUEST['page'] : 'vid';
        if ($page == 'vid') {
            if (WebService::isPost() && isset($_POST['vid']) && in_array($_POST['vid'], $this->availableTribes)) {
                if ($this->setTribe((int)$_POST['vid'])) {
                    $this->redirect("activate.php?page=sector");
                }
            } else {
                $this->race();
            }
        } else if ($page == 'sector') {
            if (WebService::isPost() && isset($_POST['sector']) && in_array($_POST['sector'], ["nw", "sw", "no", "so", "ne", "se"])) {
                $this->setSector($_POST['sector']);
                $this->redirect("activate.php?page=dorf");
            }
            $this->sector();
        } else if ($page == 'confirmation') {
            if (WebService::isPost() && isset($_POST['sector']) && in_array($_POST['sector'],
                    ["nw", "sw", "no", "so", "ne", "se"])) {
                $this->setSector($_POST['sector']);
            }
            $this->confirmation();
        } else if ($page == 'dorf') {
            $this->completeRegistration();
        }
    }

    private function setTribe($race)
    {
        if (!in_array($race, $this->availableTribes)) {
            return false;
        }
        $this->setSessionVar('race', $race);
        return true;
    }

    private function setSessionVar($name, $value)
    {
        $_SESSION[WebService::fixSessionPrefix(sprintf("%s_%s", $this->token, $name))] = $value;
    }

    public function race()
    {
        if ($this->useNewActivation) {
            $this->view->vars['titleInHeader'] = T("ActivationNew", "Select your tribe");
            $this->view->vars['content'] = PHPBatchView::render('activationNew/race', ['tribes' => $this->availableTribes]);
        } else {
            $this->view->vars['titleInHeader'] = T("activation", "selectARace");
            $this->view->vars['content'] = PHPBatchView::render('activation/race', ['tribes' => $this->availableTribes]);
        }
    }

    private function setSector($sector)
    {
        if (!in_array($sector, ["nw", "sw", "no", "so", "ne", "se"])) {
            return false;
        }
        $this->setSessionVar('sector', $sector);
        return true;
    }

    public function sector()
    {
        if ($this->useNewActivation) {
            $this->view->vars['titleInHeader'] = T("ActivationNew", "Select your starting position");
            $view = new PHPBatchView("activationNew/sector");
            $this->view->vars['content'] = $view->output();
        } else {
            $this->view->vars['titleInHeader'] = T("activation", "selectASector");
            $view = new PHPBatchView("activation/sector");
            $view->vars = [
                "vid"         => $this->getTribe(),
                "vidSelected" => sprintf(T("activation", "selectedRace"),
                    T("Global", "races." . $this->getTribe()),
                    T("activation", "race_helpers." . $this->getTribe()))
            ];
            $this->view->vars['content'] = $view->output();
        }
    }

    private function getTribe()
    {
        $tribe = $this->getSessionVar('race');
        if (in_array($tribe, $this->availableTribes)) {
            return $tribe;
        }
        return 3;
    }

    private function getSessionVar($name, $default = null)
    {
        if (isset($_SESSION[WebService::fixSessionPrefix(sprintf("%s_%s", $this->token, $name))])) {
            return $_SESSION[WebService::fixSessionPrefix(sprintf("%s_%s", $this->token, $name))];
        }
        return $default;
    }

    private function confirmation()
    {
        $this->view->vars['titleInHeader'] = T("ActivationNew", "Ready to rule the world?");
        $view = new PHPBatchView("activationNew/confirmation");
        $view->vars = ["sector" => $this->getSector(), 'race' => $this->getTribe()];
        $this->view->vars['content'] = $view->output();
    }

    private function getSector()
    {
        $tribe = $this->getSessionVar('sector');
        if (in_array($tribe, ["nw", "sw", "no", "so", "ne", "se"])) {
            return $tribe;
        }
        return 'sw';
    }

    private function completeRegistration()
    {
        $register = new RegisterModel();
        $kid = $register->generateBase($this->getSector());
        if (!$kid) {
            $this->view->vars['content'] .= '<h3 style="font-weight: bold">' . T("ActivationNew", "unableToGenerateBase") . '</h3>';
            return;
        }
        $globalDB = GlobalDB::getInstance();
        $activationEnabled = false;
        $server = $globalDB->query("SELECT activation FROM gameServers WHERE id=" . getWorldUniqueId());
        if ($server->num_rows) {
            $server = $server->fetch_assoc();
            $activationEnabled = $server['activation'] == 1;
        }
        $db = DB::getInstance();
        $db->begin_transaction();
        $db->query("DELETE FROM activation WHERE id={$this->activationRow['id']}");
        $uid = $register->addUser($this->activationRow['name'],
            $this->activationRow['password'],
            $this->activationRow['email'],
            $this->getTribe(),
            $kid);
        $result = $register->createBaseVillage($uid, $this->activationRow['name'], $this->getTribe(), $kid);
        if (!$result) {
            $db->rollback();
            return;
        }
        if ($activationEnabled) {
            $db->query("UPDATE users SET email_verified=1 WHERE id=$uid");
        } else {
            $this->sendVerificationEmail($this->activationRow['name'], $uid, $this->activationRow['email']);
            (new InfoBoxModel())->addInfo($uid, false, 16, null, 0, time() + Formulas::getTotalProtectionTime(time()));
        }
        $register->populateUserRank($uid);
        session_regenerate_id(true);
        $_SESSION[WebService::fixSessionPrefix('uid')] = $uid;
        $_SESSION[WebService::fixSessionPrefix('pw')] = $this->activationRow['password'];
        $_SESSION[WebService::fixSessionPrefix('user')] = $this->activationRow['name'];
        $_SESSION[WebService::fixSessionPrefix('ip')] = WebService::ipAddress();
        IPTracker::addCurrentIP($uid);
        $db->query("UPDATE users SET last_login_time=" . time() . ", last_owner_login_time=" . time() . " WHERE id=$uid");
        if (!empty($this->activationRow['refUid'])) {
            $this->processReferences($this->activationRow['refUid'], $uid);
        }
        $level = Config::getProperty("game", "firstVillageCreationFieldsLevel");
        if ($level > 0) {
            $_SESSION[WebService::fixSessionPrefix('needQuestCheck')] = true;
        }
        $db->commit();
        $m = new MessageModel();
        $text = T("Global", "registration_startgame_message_message");
        if (!empty($text)) {
            $text = str_replace(['[name]'], [$this->activationRow['name']], $text);
            $m->sendMessage(0, $uid, T("Global", "registration_startgame_message_subject"), $text);
        }
        $this->redirect("dorf1.php?finished=1");
    }

    private function sendVerificationEmail($playerName, $uid, $email)
    {
        $db = DB::getInstance();
        $code = get_random_string(mt_rand(18, 28));
        $db->query("INSERT INTO `activation_progress` (`uid`, `email`, `activationCode`, `time`) VALUES ($uid, '$email', '$code', '" . time() . "')");
        $id = $db->lastInsertId();
        $params = [
            'playerName'        => $playerName,
            'email'             => $email,
            'verification_url'  => WebService::get_real_base_url() . 'verify-url.php?code=' . sprintf("%s-%s",
                    $id,
                    $code),
            'verification_code' => $code,
        ];
        Mailer::sendEmail($email, T("EVerify", "Email verification"), PHPBatchView::render("verify/email", $params));
    }

    public function processReferences($refUid, $uid)
    {
        if (empty($refUid)) return;
        $referrerPlayerId = (int)filter_var($refUid, FILTER_SANITIZE_NUMBER_INT);
        /** SERVER ID | REF_UID | UID */
        DB::getInstance()->query("INSERT INTO player_references (ref_uid, uid) VALUES ($referrerPlayerId, {$uid})");
    }
}