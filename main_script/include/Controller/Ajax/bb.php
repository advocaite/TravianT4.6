<?php
namespace Controller\Ajax;

use Core\Helper\BBCode;
use Core\Session;

class bb extends AjaxBase
{
    public function dispatch()
    {
        $text = '';
        BBCode::setFromPlayer(Session::getInstance()->getPlayerId());
        switch ($_POST['target']) {
            case 'text':
                $text = BBCode::translateMessagesBBCode($_POST['text']);
                break;
            case 'message':
            case 'notepad':
                $text = BBCode::translateMessagesBBCode($_POST['text']);
                break;
        }
        if ($_POST['nl2br']) {
            $text = nl2br($text);
        }
        $this->response['data']['text'] = $text;
    }
} 