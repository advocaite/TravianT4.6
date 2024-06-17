<?php

namespace Controller;

use Core\Config;
use Core\Database\DB;
use Core\Database\GlobalDB;
use Core\Helper\TimezoneHelper;
use Core\Helper\WebService;
use Core\Session;
use Game\Formulas;
use Core\Locale;
use function get_gpack_version;
use Model\InfoBoxModel;
use Model\OptionModel;
use resources\View\GameView;
use resources\View\PHPBatchView;
use function var_dump;

class OptionCtrl extends GameCtrl
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->isSitter() && (!isset($_GET['s']) || (int)$_GET['s'] != 4) && $this->session->isInVacationMode()) {
            $this->redirect("dorf1.php");
        }
        if (isset($_GET['cmd']) && trim($_GET['cmd']) == "extendBeginnersProtection" && !$this->session->isSitter()) {
            $baseProtection = Formulas::getProtectionBasicTime($this->session->get("signupTime"));
            $usedProtection = ($this->session->protectionTill() - $this->session->get("signupTime"));
            $protectionExtendingUsed = $usedProtection > $baseProtection;
            $protectionLeft = $this->session->protectionTill() - time();
            $isProtectionExtendTime = $protectionLeft <= Formulas::getProtectionShowExtendTime($this->session->get("signupTime"));
            if (!$protectionExtendingUsed && $isProtectionExtendTime) {
                $db = DB::getInstance();
                $db->query("UPDATE users SET protection=protection+" . Formulas::getProtectionExtendTime($this->session->get("signupTime")) . " WHERE id=" . $this->session->getPlayerId());
                $this->session->setProtection($this->session->protectionTill() + Formulas::getProtectionExtendTime($this->session->get("signupTime")));
                $db->query("UPDATE infobox SET showTo=" . ($this->session->protectionTill() + Formulas::getProtectionExtendTime($this->session->get("signupTime"))) . " WHERE uid={$this->session->getPlayerId()} AND type=6");
                InfoBoxModel::invalidateUserInfoBoxCache($this->session->getPlayerId());
            }
            $this->redirect("dorf1.php");
        }
        $this->view = new GameView();
        $this->view->vars['titleInHeader'] = '';
        $this->view->vars['bodyCssClass'] = 'perspectiveResources';
        $this->view->vars['contentCssClass'] = 'options';
        $this->view->vars['titleInHeader'] = T("Options", "Preferences");
        $selectedTab = isset($_REQUEST['s']) && $_REQUEST['s'] >= 1 && $_REQUEST['s'] <= 4 ? (int)$_REQUEST['s'] : 1;
        if (!$this->session->isSitter()) {
            $view = new PHPBatchView("options/menu");
            $view->vars['selectedTab'] = $selectedTab;
            $this->view->vars['content'] .= $view->output();
        }
        if ($selectedTab == 1) {
            $this->Game();
        } else if ($selectedTab == 2) {
            $this->Account();
            if (isset($_POST['gpackNew'])) {
                if (trim($_POST['gpackNew']) != get_gpack_version()) {
                    set_gpack_version(trim($_POST['gpackNew']));
                    $this->redirect("options.php?s=2");
                }
            }
        } else if ($selectedTab == 3) {
            $this->Sitter();
        } else if ($selectedTab == 4 && Config::getProperty("game", "vacationDays") > 0) {
            $this->Vacation();
        }
    }

    private function Game()
    {
        $view = new PHPBatchView("options/Game");
        if (WebService::isPost()) {
            $rptFilters = Session::getInstance()->getReportFilters();
            $reportFilters = [
                isset($_POST['v4']) && (int)$_POST['v4'] == 1 ? 1 : 0,
                isset($_POST['v5']) && (int)$_POST['v5'] == 1 ? 1 : 0,
                isset($_POST['v6']) && (int)$_POST['v6'] == 1 ? 1 : 0,
                $rptFilters[3],
                $rptFilters[4],
                $rptFilters[5],
                $rptFilters[6],
            ];
            $autoComplete = [
                isset($_POST['v1']) && (int)$_POST['v1'] == 1 ? 1 : 0,
                isset($_POST['v2']) && (int)$_POST['v2'] == 1 ? 1 : 0,
                isset($_POST['v3']) && (int)$_POST['v3'] == 1 ? 1 : 0,
            ];
            $allianceSettings = [
                isset($_POST['v7']) && (int)$_POST['v7'] == 1 ? 1 : 0,
                isset($_POST['v8']) && (int)$_POST['v8'] == 1 ? 1 : 0,
                isset($_POST['v9']) && (int)$_POST['v9'] == 1 ? 1 : 0,
                isset($_POST['v10']) && (int)$_POST['v10'] == 1 ? 1 : 0,
                isset($_POST['v11']) && (int)$_POST['v11'] == 1 ? 1 : 0,
            ];
            $notificationEnabled = isset($_POST['v12']) && (int)$_POST['v12'] == 1 ? 1 : 0;
            $display = [
                isset($_POST['flag_hiden_report_image']) && (int)$_POST['flag_hiden_report_image'] == 1 ? 1 : 0,
                max(min((int)$_POST['epp'], 99), 10),
                max(min((int)$_POST['troopMovementsPerPage'], 99), 10),
                Session::getInstance()->getDisplay()[3],
                Session::getInstance()->getDisplay()[4],
                isset($_POST['fast_upgrade']) && (int)$_POST['fast_upgrade'] == 1 ? 1 : 0,
            ];
            $timezone = [
                array_key_exists($_POST['timezone'],
                    Config::getInstance()->timezones['general']) || array_key_exists($_POST['timezone'],
                    Config::getInstance()->timezones['local']) ? $_POST['timezone'] : 0,
                in_array($_POST['tformat'],
                    [
                        0,
                        1,
                        2,
                        3,
                    ]) ? $_POST['tformat'] : 0,
            ];
            Session::getInstance()->setReportFilters($reportFilters);
            Session::getInstance()->setTimezone($timezone);
            Session::getInstance()->setDisplay($display);
            Session::getInstance()->setAllianceSettings($allianceSettings);
            Session::getInstance()->setAllianceNotification($notificationEnabled);
            Session::getInstance()->setAutoComplete($autoComplete);
            $m = new OptionModel();
            $m->updateGame(Session::getInstance()->getPlayerId(),
                implode(',', $reportFilters),
                implode('|', $allianceSettings),
                (int)$notificationEnabled,
                implode(',', $autoComplete),
                implode(',', $display),
                implode(',', $timezone));
            $view->vars['error'] = 0;
        }
        $this->view->vars['content'] .= $view->output();
    }

    private function Account()
    {
        $view = new PHPBatchView("options/Account");
        $m = new OptionModel();
        $config = Config::getInstance();
        $view->vars['colorBlind'] = Session::getInstance()->getDisplay()[3];
        $view->vars['autoReload'] = !getDisplay("allowAutoReloadSettingChange") || Session::getInstance()->getDisplay()[4];
        if (WebService::isPost()) {
            if (isset($_POST['colorblind']) && $_POST['colorblind'] == 1) {
                $display = Session::getInstance()->getDisplay();
                $display[3] = $view->vars['colorBlind'] = 1;
                $db = DB::getInstance();
                $db->query("UPDATE users SET display='" . implode(",",
                        $display) . "' WHERE id=" . Session::getInstance()->getPlayerId());
                Session::getInstance()->setDisplay($display);
                $this->view->vars['colorBlind'] = true;
            } else {
                $display = Session::getInstance()->getDisplay();
                $display[3] = $view->vars['colorBlind'] = 0;
                $db = DB::getInstance();
                $db->query("UPDATE users SET display='" . implode(",",
                        $display) . "' WHERE id=" . Session::getInstance()->getPlayerId());
                Session::getInstance()->setDisplay($display);
                $this->view->vars['colorBlind'] = false;
            }
            if (isset($_POST['autoReload']) && $_POST['autoReload'] == 1 && getDisplay("allowAutoReloadSettingChange")) {
                $display = Session::getInstance()->getDisplay();
                $display[4] = $view->vars['autoReload'] = 1;
                $db = DB::getInstance();
                $db->query("UPDATE users SET display='" . implode(",",
                        $display) . "' WHERE id=" . Session::getInstance()->getPlayerId());
                Session::getInstance()->setDisplay($display);
                $this->view->vars['autoReload'] = true;
            } else {
                $display = Session::getInstance()->getDisplay();
                $display[4] = $view->vars['autoReload'] = 0;
                $db = DB::getInstance();
                $db->query("UPDATE users SET display='" . implode(",", $display) . "' WHERE id=" . Session::getInstance()->getPlayerId());
                Session::getInstance()->setDisplay($display);
                $this->view->vars['autoReload'] = false;
            }
            if (isset($_POST['e']) && $_POST['e'] == 2 && isset($_POST['formType']) && $_POST['formType'] == 'account') {
                $total_pop = Session::getInstance()->get("total_pop");
                if ($total_pop < $config->gold->changeName->freeTillPopulation && Session::getInstance()->getTotalNameChanges() < $config->gold->changeName->freeTimes) {
                    $newName = filter_var($_POST['acount_rename_new_name'], FILTER_SANITIZE_STRING);
                    if (empty($newName) || empty($_POST['account_rename_password_confirmation'])) {
                        $view->vars['error'] = T("Options",
                            "Please enter a new account name and confirmation password");
                    } else if (sha1($_POST['account_rename_password_confirmation']) != $_SESSION[WebService::fixSessionPrefix('pw')]) {
                        $view->vars['error'] = T("Options", "Confirmation password does not match");
                    } else {
                        $error = $m->doesNameMeetRequirements(Session::getInstance()->getName(), $newName);
                        if ($error === 0) {
                            $_SESSION[WebService::fixSessionPrefix('user')] = $newName;
                            $m->changeName(Session::getInstance()->getPlayerId(), $newName);
                            Session::getInstance()->setName($newName);
                            Session::getInstance()->setTotalNameChanges(Session::getInstance()->getTotalNameChanges() + 1);
                        } else if ($error & OptionModel::NAME_BLACKLISTED) {
                            $view->vars['error'] = T("Options", "Name black listed");
                        } else if ($error & OptionModel::NAME_EXISTS) {
                            $view->vars['error'] = T("Options", "Name exists");
                        } else if ($error & OptionModel::NAME_SHORT) {
                            $view->vars['error'] = T("Options", "Name too short");
                        } else if ($error & OptionModel::NAME_LONG) {
                            $view->vars['error'] = T("Options", "Name too long");
                        }
                    }
                }
            }
            if (isset($_POST['email_alt']) && isset($_POST['email_neu']) && !empty($_POST['email_alt']) && !empty($_POST['email_neu'])) {
                if (!Session::getInstance()->isEmailVerified()) {
                    $this->redirect('verify.php');
                } else {
                    $oldEmail = filter_var($_POST['email_alt'], FILTER_SANITIZE_EMAIL);
                    $newEmail = filter_var($_POST['email_neu'], FILTER_SANITIZE_EMAIL);
                    if ($oldEmail != Session::getInstance()->getEmail()) {
                        $view->vars['error'] = T("Options", "invalid old email");
                    } else if (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
                        $view->vars['error'] = T("Options", "invalid new email");
                    } else if ($m->emailExists($newEmail)) {
                        $view->vars['error'] = T("Options", "new email exists");
                    } else if (strlen($newEmail) > 99) {
                        $view->vars['error'] = T("inGame", "Error: very long input");
                    } else if (!$m->isEmailChangeExists(Session::getInstance()->getPlayerId())) {
                        $m->addChangeEmail(Session::getInstance()->getPlayerId(),
                            Session::getInstance()->getName(),
                            $oldEmail,
                            $newEmail);
                    }
                }
            }
            if (isset($_POST['code_email_alt']) && isset($_POST['code_email_neu']) && !empty($_POST['code_email_alt']) && !empty($_POST['code_email_neu']) && $m->isEmailChangeExists(Session::getInstance()->getPlayerId())) {
                $code1 = filter_var($_POST['code_email_alt'], FILTER_SANITIZE_EMAIL);
                $code2 = filter_var($_POST['code_email_neu'], FILTER_SANITIZE_EMAIL);
                $row = $m->getEmailChange(Session::getInstance()->getPlayerId());
                if ($row['code1'] == $code1 && $row['code2'] == $code2) {
                    $m->cancelEmailChange(Session::getInstance()->getPlayerId());
                    $m->changeEmail(Session::getInstance()->getPlayerId(), $row['email']);
                    Session::getInstance()->setEmail($row['email']);
                    $view->vars['error'] = T("Options", "email_changed");
                } else {
                    $view->vars['error'] = T("Options", "codes are not correct");
                }
            }
            if (isset($_POST['pw1']) && isset($_POST['pw2']) && isset($_POST['pw3']) && !empty($_POST['pw1']) && !empty($_POST['pw2']) && !empty($_POST['pw3'])) {
                if (sha1($_POST['pw1']) != $_SESSION[WebService::fixSessionPrefix('pw')]) {
                    $view->vars['error'] = T("Options", "password wrong");
                } else if ($_POST['pw2'] != $_POST['pw3']) {
                    $view->vars['error'] = T("Options", "Confirmation password does not match");
                } else {
                    $m->changePassword(Session::getInstance()->getPlayerId(), $_POST['pw2']);
                }
            }
            if (isset($_POST['del_pw']) && isset($_POST['del']) && !empty($_POST['del_pw']) && $_POST['del'] == 1) {
                if (!$m->getLatestPayment(Session::getInstance()->getPlayerId())) {
                    if (sha1($_POST['del_pw']) != $_SESSION[WebService::fixSessionPrefix('pw')]) {
                        $view->vars['error'] = T("Options", "password wrong");
                    } else if (!$m->isDeletion(Session::getInstance()->getPlayerId())) {
                        if (Session::getInstance()->isInVacationMode()) {
                            $this->redirect('options.php?s=4');
                        } else {
                            $m->addDeleting(Session::getInstance()->getPlayerId());
                            InfoBoxModel::invalidateUserInfoBoxCache(Session::getInstance()->getPlayerId());
                        }
                    }
                }
            }
            if (isset($_POST['newsletter_posted']) && $_POST['newsletter_posted'] == 1) {
                if (isset($_POST['newsletter_4']) && $_POST['newsletter_4'] == 1) {
                    $m->subscribeNewsletter(Session::getInstance()->getEmail());
                } else {
                    $m->unSubscribeNewsLetter(Session::getInstance()->getEmail());
                }
            }
            Session::getInstance()->changeChecker();
        } else if (isset($_GET['email_abbrechen']) && $_GET['a'] == Session::getInstance()->getChecker()) {
            $m->cancelEmailChange(Session::getInstance()->getPlayerId());
        } else if (isset($_GET['a']) && $_GET['a'] == 1) {
            if (Config::getInstance()->dynamic->serverFinished) {
                $this->innerRedirect("InGameWinnerPage");
            }
            $m->cancelDeletion(Session::getInstance()->getPlayerId());
            InfoBoxModel::invalidateUserInfoBoxCache(Session::getInstance()->getPlayerId());
        }
        $this->view->vars['content'] .= $view->output();
    }

    private function Sitter()
    {
        $view = new PHPBatchView("options/Sitters");
        $m = new OptionModel();
        $db = DB::getInstance();
        if (WebService::isPost() && $_REQUEST['a'] == Session::getInstance()->getChecker()) {
            $sitter1 = $this->mergeSitter(1);
            $sitter2 = $this->mergeSitter(0);
            if (!empty($sitter1['name'])) {
                $uid = $m->getUserByName($sitter1['name']);
                if ($uid && ($uid != $this->session->getPlayerId()) && ($uid != $this->session->getSittersId(2) || $this->session->getSittersId(2) == 0)) {
                    if ($this->getTotalSitterCount($uid, $this->session->getPlayerId()) < 2) {
                        $db->query("UPDATE users SET sit1Uid=$uid, sit1Permissions='{$sitter1['perm']}' WHERE id=" . $this->session->getPlayerId());
                        $this->session->setSittersId(1, $uid);
                        $this->session->setSittersPermissions(1, $sitter1['perm']);
                    } else {
                        $view->vars['error'] = T("Options", "This player is sitter for 2 players");
                    }
                }
            }
            if (!empty($sitter2['name'])) {
                $uid = $m->getUserByName($sitter2['name']);
                if ($uid && ($uid != $this->session->getPlayerId()) && ($uid != $this->session->getSittersId(1) || $this->session->getSittersId(1) == 0)) {
                    if ($this->getTotalSitterCount($uid, $this->session->getPlayerId()) < 2) {
                        $db->query("UPDATE users SET sit2Uid=$uid, sit2Permissions='{$sitter2['perm']}' WHERE id=" . $this->session->getPlayerId());
                        $this->session->setSittersId(2, $uid);
                        $this->session->setSittersPermissions(2, $sitter2['perm']);
                    } else {
                        $view->vars['error'] = T("Options", "This player is sitter for 2 players");
                    }
                }
            }
            $this->session->changeChecker();
        } else if (isset($_GET['id']) && isset($_GET['type']) && $_GET['a'] == $this->session->getChecker()) {
            $this->session->changeChecker();
            $id = abs((int)$_GET['id']);
            if ($_GET['type'] == 1) {
                if ($this->session->getSittersId(1) == $id) {
                    $db->query("UPDATE users SET sit1Uid=0, sit1Permissions=87 WHERE id=" . $this->session->getPlayerId());
                    $this->session->setSittersId(1, 0);
                    $this->session->setSittersPermissions(1, 87);
                } else if ($this->session->getSittersId(2) == $id) {
                    $db->query("UPDATE users SET sit2Uid=0, sit2Permissions=87 WHERE id=" . $this->session->getPlayerId());
                    $this->session->setSittersId(2, 0);
                    $this->session->setSittersPermissions(2, 87);
                }
            } else if ($_GET['type'] == 2) {
                $uid = $this->session->getPlayerId();
                $db->query("UPDATE users SET
                sit1Uid=IF(sit1Uid=$uid, 0, sit1Uid),
                sit2Uid=IF(sit2Uid=$uid, 0, sit2Uid),
                sit1Permissions=IF(sit1Uid=$uid, 87, sit1Permissions),
                sit2Permissions=IF(sit2Uid=$uid, 87, sit2Permissions)
                WHERE id=$id");
            }
        }
        $this->view->vars['content'] .= $view->output();
    }

    private function mergeSitter($id)
    {
        $m = new OptionModel();
        $id--;
        $name =
            isset($_POST['sitter'][$id]) ?
                $_POST['sitter'][$id] :
                $m->getPlayerName(Session::getInstance()->getSittersId($id == 0 ? 1 : 2));
        $perm = 0;
        $flags = [1, 2, 4, 8, 16, 32, 64];
        if (!isset($_POST['sitter_flag'][$id])) {
            $_POST['sitter_flag'][$id] = [];
        }
        foreach ($_POST['sitter_flag'][$id] as $flag) {
            if (in_array($flag, $flags)) {
                $perm |= $flag;
            }
        }
        return ['name' => $name, 'perm' => $perm];
    }

    private function getTotalSitterCount($uid, $myUID)
    {
        $db = DB::getInstance();
        return (int) $db->fetchScalar("SELECT COUNT(id) FROM users WHERE (sit1Uid=$uid AND sit1Uid!=$myUID) OR (sit2Uid=$uid AND sit2Uid!=$myUID)");
    }

    private function Vacation()
    {
        if (Session::getInstance()->isInVacationMode()) {
            $this->showVacationActive();
            return;
        }
        $view = new PHPBatchView("options/Vacation");
        $m = new OptionModel();
        $kids = $m->getPlayerVillagesAsArray(Session::getInstance()->getPlayerId());
        $view->vars['conditions'] = $conditions = [
            1 => $m->getOutGoingMovementsNum($kids) == 0,
            2 => $m->getInComingMovementsNum($kids) == 0,
            3 => $m->getOutReinforingNum(Session::getInstance()->getPlayerId()) == 0,
            4 => $m->getInReinforingNum($kids) == 0,
            5 => $m->hasPlayerWWVillage(Session::getInstance()->getPlayerId()) == 0,
            6 => $m->hasPlayerArtifact(Session::getInstance()->getPlayerId()) == 0,
            7 => Session::getInstance()->hasProtection() == FALSE,
            8 => $m->hasTrappedUnits($kids) == 0,
            9 => $m->isDeletion(Session::getInstance()->getPlayerId()) == 0,
        ];
        $remainingVacationDays = Formulas::maxVacationDays() - Session::getInstance()->getUsedVacationDays();
        if (WebService::isPost() && !Session::getInstance()->isInVacationMode()) {
            $days = max(max((int)$_POST['days'], $remainingVacationDays), 1);
            if (array_sum($view->vars['conditions']) == 9 && $remainingVacationDays >= $days) {
                $m->enterVacationMode(Session::getInstance()->getPlayerId(), $days);
                Session::getInstance()->setVacationTill($days * 86400 + time());
                Session::getInstance()->setVacationUsedDays(Session::getInstance()->getUsedVacationDays() + $days);
                $this->showVacationActive();

                return;
            }
        }
        $this->view->vars['content'] .= $view->output();
    }

    private function showVacationActive()
    {
        $view = new PHPBatchView("options/VacationActive");
        $view->vars['vacationTil'] = TimezoneHelper::autoDate(Session::getInstance()->getVacationTil(), TRUE);
        $view->vars['vacationDays'] = max(1, ceil((Session::getInstance()->getVacationTil() - time()) / 86400));
        $this->view->vars['content'] .= $view->output();
    }
} 