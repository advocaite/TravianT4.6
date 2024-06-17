<?php
namespace Controller\Ajax\player;
use Controller\Ajax\AjaxBase;

use Core\Session;
use Core\Locale;
use Model\MessageModel;
use resources\View\PHPBatchView;

class ignore extends AjaxBase
{
    public function dispatch()
    {
        switch($_POST['method']) {
            case 'render_profile_action_buttons':
                $this->renderPlayerMessageIgnoreButtons();
                break;
            case 'render_ignore_list':
                $this->renderIgnoreList();
                break;
            case 'ignore_target_player':
                $params = (array)$_POST['params'];
                $m = new MessageModel();
                $m->ignorePlayer(Session::getInstance()->getPlayerId(), (int)$params['targetPlayer']);
                break;
            case 'stop_ignore_target_player':
                $params = (array)$_POST['params'];
                $m = new MessageModel();
                $m->unIgnorePlayer(Session::getInstance()->getPlayerId(), (int)$params['targetPlayer']);
                break;
        }
        if(isset($_POST['renderPlayerMessageIgnoreButtons']) && $_POST['renderPlayerMessageIgnoreButtons']) {
            $this->renderPlayerMessageIgnoreButtons();
        }
        if(isset($_POST['renderIgnoreList']) && $_POST['renderIgnoreList']) {
            $this->renderIgnoreList();
        }
    }

    private function renderPlayerMessageIgnoreButtons()
    {
        $this->response['result'] = '';
        $params = $_POST['params'];
        if($params['targetPlayer'] == Session::getInstance()->getPlayerId()) {
            if(Session::getInstance()->isSitter() || Session::getInstance()->banned()) {
                $this->response['result'] = '<a class="arrow disabled">' . T("Profile", "Edit Profile") . '</a>';
            } else {
                $this->response['result'] = '<a class="arrow" href="spieler.php?s=2">' . T("Profile", "Edit Profile") . '</a>';
            }
        } else {
            if($params['targetPlayer'] > 1) {
				$this->response['result'] = '<div class="actionButtons">';
                $m = new MessageModel();
                if(!$m->isPlayerIgnored(Session::getInstance()->getPlayerId(), $params['targetPlayer'])) {
                    $this->response['result'] .= '<a class="message messageStatus messageStatusUnread" href="messages.php?t=1&amp;id=' . $params['targetPlayer'] . '">' . T("Profile", "Write Message") . '</a>';
                    $this->response['result'] .= '<br />';
                    if($params['targetPlayer'] > 2) {
                        if(!$m->checkIgnoreListLimit(Session::getInstance()->getPlayerId())) {
                            $this->response['result'] .= '<span class="warning">' . T("Profile", "Ignore list is full") . '</span> <a href="messages.php?t=5">' . T("Profile", "Edit list") . '</a>';
                        } else {
                            $this->response['result'] .= '<br />';
                            $this->response['result'] .= '<a href="" id="ignore-player-button" data-player-ignored="false" data-uid="' . $params['targetPlayer'] . '" title="' . T("Profile", "Ignore Player") . '">' . T("Profile", "Ignore Player") . '.</a>';
                        }
                    }
                } else if($params['targetPlayer'] > 2) {
                    $this->response['result'] = '<span class="notice">' . T("Profile", "Player will be ignored") . '</span>';
                    $this->response['result'] .= '<br />';
                    $this->response['result'] .= '<a href="" id="ignore-player-button" data-player-ignored="true" data-uid="' . $params['targetPlayer'] . '" title="' . T("Profile", "Accept messages from this player") . '">' . T("Profile", "Stop ignoring this player") . '.</a>';
                }
				$this->response['result'] .= '</div>';
            }
            if(Session::getInstance()->isAdmin()) {
                $this->response['result'] .= '<br />';
                $this->response['result'] .= '<a href="spieler.php?adminLogin=' . $params['targetPlayer'] . '" title="' . T("Profile", "Login to player account") . '">' . T("Profile", "Login to player account") . '.</a>';
            }
        }
    }

    private function renderIgnoreList()
    {
        $this->response['result'] = '<div id=\'ignore-list-columns\'>';
        $m = new MessageModel();
        $ignoreList = $m->getIgnoreList(Session::getInstance()->getPlayerId());
        if($ignoreList->num_rows) {
            $view = new PHPBatchView("ajax/ignoreListColumns");
            $view->vars['ignoreList'] = [];
            for($i = 1; $i <= 20; ++$i) {
                $view->vars['ignoreList'][$i] = '<td class="end">&nbsp;</td><td>&nbsp;</td><td class="end">&nbsp;</td>';
            }
            $i = 0;
            while($row = $ignoreList->fetch_assoc()) {
                ++$i;
                $view->vars['ignoreList'][$i] = '';
                $view->vars['ignoreList'][$i] .= '<td class="end"><button type="submit" class="icon " onclick="unignoreUser(' . $row['ignore_id'] . ');"><img src="img/x.gif" class="del unignore-user" alt="del unignore-user"></button></td>';
                $view->vars['ignoreList'][$i] .= '<td><a href="/spieler.php?uid=' . $row['ignore_id'] . '">' . $m->getPlayerName($row['ignore_id']) . '</a></td>';
                $view->vars['ignoreList'][$i] .= '<td class="end">&nbsp;</td>';
            }
            $this->response['result'] .= $view->output();
        }
        $this->response['result'] .= '</div><div class="clear"></div>';
        $this->response['result'] .= '<div><table><tfoot><tr><td colspan="6">' . $ignoreList->num_rows . '/20</td></tr><tr><td colspan="6">' . T("Profile", 'To ignore messages from a specific player, go to its profile and click on "Ignore"!') . '</td></tr></tfoot></table></div>';
    }
} 