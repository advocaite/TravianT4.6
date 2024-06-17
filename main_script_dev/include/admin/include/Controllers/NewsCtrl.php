<?php

use Core\Helper\TimezoneHelper;
use Core\Helper\WebService;
use Core\Session;
use Model\NewsModel;

class NewsCtrl
{
    //Edited/deleted news will take effect after an hour on other servers
    public function __construct()
    {
        $section = isset($_REQUEST['section']) ? $_REQUEST['section'] : null;
        if ($section == 'addNews') {
            $this->addNews();
            return;
        } else if ($section == 'editNews') {
            $this->editNews();
            return;
        } else if ($section == 'delNews') {
            AdminLog::getInstance()->addLog("Deleted a news!");
            $m = new NewsModel();
            $m->deleteNews((int)$_GET['id']);
        }
        $this->showNews();
    }

    private function editNews()
    {
        $dispatcher = Dispatcher::getInstance();
        $m = new NewsModel();
        $params['isEdit'] = true;
        $news = $m->getNews((int)$_REQUEST['id']);
        if (!$news->num_rows) {
            return;
        }
        $news = $news->fetch_assoc();
        $params['error'] = null;
        $params['content'] = $news['content'];
        $params['shortDesc'] = $news['shortDesc'];
        $params['moreLink'] = $news['moreLink'];
        $params['title'] = $news['title'];
        $params['id'] = (int)$_REQUEST['id'];
        $params['time'] = TimezoneHelper::date("Y-m-d H:i", $news['expire']);
        if (WebService::isPost()) {
            $params['content'] = $_POST['content'];
            $params['shortDesc'] = $_POST['shortDesc'];
            $params['title'] = $_POST['title'];
            $params['moreLink'] = $_POST['moreLink'];
            $time = TimezoneHelper::strtotime($_POST['time']);
            if (empty($params['time']) || empty($params['content'])) {
                $params['error'] = 'Fill all inputs';
            } else if (Session::validateChecker()) {
                $m = new NewsModel();
                $m->deleteNews($params['id']);
                $m->addNews($params['title'], $params['shortDesc'], $params['content'], $time, $params['moreLink']);
                AdminLog::getInstance()->addLog("Edited a news!");
                $this->showNews();
                return;
            }
        }
        $dispatcher->appendContent(Template::getInstance()->load($params, 'tpl/addNews.tpl')->getAsString());
    }

    private function addNews()
    {
        $dispatcher = Dispatcher::getInstance();
        $params['isEdit'] = false;
        $params['error'] = null;
        $params['moreLink'] =null;
        $params['content'] = null;
        $params['title'] = null;
        $params['shortDesc'] = null;
        $params['time'] = TimezoneHelper::date("Y-m-d H:i");
        if (WebService::isPost()) {
            $params['shortDesc'] = $_POST['shortDesc'];
            $params['content'] = $_POST['content'];
            $params['moreLink'] = $_POST['moreLink'];
            $params['title'] = $_POST['title'];
            $time = TimezoneHelper::strtotime($_POST['time']);
            if (empty($params['time']) || empty($params['content'])) {
                $params['error'] = 'Fill all inputs';
            } else if (Session::validateChecker()) {
                $m = new NewsModel();
                $m->addNews($params['title'], $params['shortDesc'], $params['content'], $time, $params['moreLink']);
                AdminLog::getInstance()->addLog("Added a news!");
                $this->showNews();
                return;
            }
        }
        $dispatcher->appendContent(Template::getInstance()->load($params, 'tpl/addNews.tpl')->getAsString());
    }

    private function showNews()
    {
        $dispatcher = Dispatcher::getInstance();
        $news = new NewsModel();
        $allNews = $news->getAllNews();
        $params['news'] = null;
        while ($row = $allNews->fetch_assoc()){
            $params['news'] .= '<tr>';
            $params['news'] .= '<td style="text-align: center;">' . $row['title'] . '</td>';
            $params['news'] .= '<td style="text-align: center;">' . TimezoneHelper::autoDateString($row['expire'], true) . '</td>';
            $params['news'] .= '<td style="text-align: center;">';
            $params['news'] .= '<a href="admin.php?action=news&section=editNews&id=' . $row['id'] . '"><img src="img/x.gif" class="edit"></a>&nbsp;';
            $params['news'] .= '<a href="admin.php?action=news&section=delNews&id=' . $row['id'] . '"><img src="img/x.gif" class="del"></a>';
            $params['news'] .= '</td>';
            $params['news'] .= '</tr>';
        }
        $dispatcher->appendContent(Template::getInstance()->load($params, 'tpl/showNews.tpl')->getAsString());
    }
}