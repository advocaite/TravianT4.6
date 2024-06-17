<?php

namespace Controller\Ajax\addressbook;

use Controller\Ajax\addressbook;
use Core\Session;
use Core\Helper\WebService;
use Model\MessageModel;
use resources\View\PHPBatchView;

class accept extends addressbook
{
	public function dispatch()
    { 
		if (WebService::isPost()) {
			$m = new MessageModel();
			if (!empty($_POST['friend'])) {
				$id = filter_var($_POST['friend'], FILTER_SANITIZE_NUMBER_INT);
				$m->acceptFriend($id, Session::getInstance()->getPlayerId());
			}
            Session::getInstance()->changeChecker();
		
			$this->response = array();
			$view = new PHPBatchView("ajax/addressbook");
			$view->vars['addressBook'] = $this->renderAddressBook();
			$this->response['title'] = T("Messages", "Addressbook");
			$this->response['html'] = $view->output();
        } else if(!WebService::isPost()){
			$this->response['error'] = true;
		}
	}
}