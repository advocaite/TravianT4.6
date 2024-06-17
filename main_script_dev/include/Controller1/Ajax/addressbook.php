<?php

namespace Controller\Ajax;

use Controller\Ajax\AjaxBase;
use Core\Session;
use Model\MessageModel;
use resources\View\PHPBatchView;

class addressbook extends AjaxBase
{
	public function dispatch()
    { 
		$this->response = array();
		$view = new PHPBatchView("ajax/addressbook");
		$view->vars['addressBook'] = $this->renderAddressBook();
		$this->response['title'] = T("Messages", "Addressbook");
		$this->response['html'] = $view->output();
	}
	
	function renderAddressBook()
    {
        $m = new MessageModel();
        $addressbook = [];
        for ($i = 0; $i <= 19; ++$i) {
            $addressbook[] = <<<HTML
<td class="end"></td>
                <td class="pla">
                    <input class="text friend" type="text" name="friend[{$i}]" value="" maxlength="15" />
                </td>
                <td class="accept"></td>
HTML;
        }
        $friendlist = $m->getFriendList(Session::getInstance()->getPlayerId());
        $i = 0;
        while ($row = $friendlist->fetch_assoc()) {
            $addressbook[$i] = '';
            $addressbook[$i] .= '<td class="end"><button type="button" class="icon " onclick="return Travian.Game.AddressBook.remove(' . $row['id'] . ');" ><img src="img/x.gif" class="del" alt="del"></button></td>';
            $addressbook[$i] .= '<td class="pla">';
            if (!$row['accepted']) {
                $addressbook[$i] .= '<img class="clock" src="img/x.gif" title="' . T("Messages",
                        "waiting for confirmation") . '" alt="' . T("Messages", "waiting for confirmation") . '">';
            } else {
                $row['last_login_time'] = $m->getPlayerLastLoginTime($row['uid'] == Session::getInstance()->getPlayerId() ? $row['to_uid'] : $row['uid']);
                if ((time() - 600) < $row['last_login_time']) { // 0 Min - 10 Min
                    $addressbook[$i] .= "<img class='online online1' src=img/x.gif title='" . T("Messages",
                            "online now") . "' alt='" . T("Messages", "online now") . "' />";
                } else if ((time() - 86400) < $row['last_login_time'] && (time() - 600) > $row['last_login_time']) { // 10 Min - 1 Days
                    $addressbook[$i] .= "<img class='online online2' src=img/x.gif title='" . T("Messages",
                            "active players") . "' alt='" . T("Messages", "active players") . "' />";
                } else if ((time() - 259200) < $row['last_login_time'] && (time() - 86400) > $row['last_login_time']) { // 1-3 Days
                    $addressbook[$i] .= "<img class='online online3' src=img/x.gif title='" . T("Messages",
                            "active 3days") . "' alt='" . T("Messages", "active 3days") . "' />";
                } else if ((time() - 604800) < $row['last_login_time'] && (time() - 259200) > $row['last_login_time']) { // 3-7 Days
                    $addressbook[$i] .= "<img class='online online4' src=img/x.gif title='" . T("Messages",
                            "active 7days") . "' alt='" . T("Messages", "active 7days") . "' />";
                } else {
                    $addressbook[$i] .= '<img class="online online5" src="img/x.gif" title="' . T("Messages",
                            "inactive") . '" alt="' . T("Messages", "inactive") . '" />';
                }
            }
			$friendName = $m->getPlayerName($row['to_uid'] == Session::getInstance()->getPlayerId() ? $row['uid'] : $row['to_uid']);
            $addressbook[$i] .= '<a href="#" onclick="Travian.Game.Messages.addRecipient(\''.$friendName.'\'); Travian.Game.AddressBook.hide(); return false;">' . $friendName . '</a>';
            $addressbook[$i] .= '</td>';
            $addressbook[$i] .= '<td class="accept">';
            if (!$row['accepted'] && $row['to_uid'] == Session::getInstance()->getPlayerId()) {
                $addressbook[$i] .= '<button type="button" class="icon hover" onclick="return Travian.Game.AddressBook.accept(' . $row['id'] . ');"><img src="img/x.gif" class="accept" alt="accept"></button>';
            }
            $addressbook[$i] .= '</td>';
            ++$i;
        }
        return $addressbook;
    }
}
?>