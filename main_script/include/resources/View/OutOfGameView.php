<?php
namespace resources\View;
use Core\Database\GlobalDB;
use Core\Session;
use const ENT_QUOTES;
use function htmlentities;
use function nl2br;

class OutOfGameView
{
    public $vars = [];
    public $renderLoginBox = TRUE;

    public function __construct()
    {
        $this->vars['ajaxToken'] = Session::getInstance()->getAjaxToken();
        $this->vars['_player_uuid'] = Session::getInstance()->getPlayerUUID();
        $this->vars['titleInHeader'] = '';
        $this->vars['bodyCssClass'] = '';
        $this->vars['autoReload'] = true;
        $this->vars['contentCssClass'] = '';
        $this->vars['colorBlind'] = false;
        $this->vars['sidebarBeforeContent'] = '';
        $this->vars['sidebarAfterContent'] = '';
        $this->vars['answerId'] = '';
        $this->vars['showNavBar'] = FALSE;
        $this->vars['showHeaderBar'] = FALSE;
        $this->vars['showStockbar'] = FALSE;
        $this->vars['showCloseButton'] = FALSE;
        $this->vars['headerBar'] = FALSE;
        $this->vars['content'] = '';
    }

    public function output()
    {
        header("Last-Modified: " . gmdate("D, d M Y H:i:s", time()) . " GMT");
        if ($this->renderLoginBox) {
            $this->renderSidebarBoxMenu();
        }
        $this->renderNewsBox();
        $view = new PHPBatchView('layout/Layout');
        $view->vars = $this->vars;
        $view->display();
    }

    private function renderSidebarBoxMenu()
    {
        $view = new PHPBatchView("layout/sidebarBoxMenu");
        $this->vars['sidebarBeforeContent'] = $view->output();
    }

    private function renderNewsBox()
    {
        $globalDB = GlobalDB::getInstance();
        $news = $globalDB->query("SELECT * FROM news WHERE expire > " . time() . " ORDER BY id DESC LIMIT 4");
        if (!$news->num_rows) {
            return;
        }
        $rank = 0;
        $view = new PHPBatchView("layout/sidebarBoxNews");
        while ($row = $news->fetch_assoc()) {
            $view->vars['count'] = ++$rank;
            $view->vars['id'] = $row['id'];
            $content = strip_tags($row['content']);
            if(!isset($row['shortDesc']) || empty($row['shortDesc'])){
                $view->vars['shortDesc'] = nl2br(mb_substr($content, 0, min(strlen($content), 150))) . '...';
            } else {
                $view->vars['shortDesc'] = $row['shortDesc'];
            }
            $view->vars['moreLink'] = $row['moreLink'];
            $this->vars['sidebarAfterContent'] .= $view->output();
        }
    }
}