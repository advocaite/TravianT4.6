<?php

namespace Controller;

use function class_exists;
use Core\Config;
use Core\Session;
use Game\EmailVerification;
use function is_my_ip;

class GameCtrl extends AbstractCtrl
{
    public $isAdminReal = FALSE;
    public $isAdmin = FALSE;
    public $isAdminInAccount = FALSE;
    protected $newVillagePrefix;

    public function __construct()
    {
        parent::__construct();
        if (!Session::getInstance()->isValid()) {
            $this->innerRedirect("LoginCtrl");
        }
        if (!($this instanceof InGameBannedClickPage) && Session::getInstance()->isBannedClick()) {
            $this->innerRedirect('InGameBannedClickPage');
        }
        if(class_exists('\\Game\\EmailVerification')){
            if (EmailVerification::disallowIfNotVerified($this)) {
                $this->innerRedirect('EmailVerificationCtrl');
            }
        }
        $this->isAdmin = Session::getInstance()->isAdmin();
        $config = Config::getInstance();
        if (!$this->isAdmin && time() < $config->game->start_time) {
            $this->innerRedirect("LoginCtrl");
        }
        if ($config->dynamic->maintenance == TRUE && !$this->isAdmin && Session::getInstance()->getPlayerId() > 2) {
            $this->innerRedirect("InGameMaintenanceCtrl");
        }
        if (!$this->isAdmin && Session::getInstance()->hasPublicMsg() && !($this instanceof Dorf1Ctrl) && !($this instanceof PublicMsgCtrl)) {
            $this->innerRedirect("PublicMsgCtrl");
        }
        if (!$this->isAdmin && Session::getInstance()->needValidation() && !($this instanceof RecaptchaCtrl)) {
            $this->innerRedirect("RecaptchaCtrl");
        }
    }

    public function render()
    {
        $output = '';
        $this->beforeRender();
        if ($this->view) {
            $output = $this->view->output();
        }
        $this->afterRender();
        return $output;
    }

    protected function beforeRender()
    {
    }

    protected function afterRender()
    {
    }
}