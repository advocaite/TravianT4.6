<?php

namespace Controller;

use Core\Caching\Caching;
use Core\Helper\WebService;
use Core\Session;
use Core\Locale;
use Model\LinksModel;
use resources\View\GameView;
use resources\View\PHPBatchView;

class LinkListCtrl extends GameCtrl
{
    private $content = null;
    const MAX_LINKS = 25;
    private function action()
    {
        $m = new LinksModel();
        //editing...
        $reCache = FALSE;
        foreach ($_POST as $key => $pos) {
            if (substr($key, 0, 2) == 'nr') {
                $id = substr($key, 2);
                $name = $_POST['linkname' . $id];
                $url = $_POST['linkziel' . $id];
                if (empty($name) || empty($url)) {
                    if ($m->deleteLink(Session::getInstance()->getPlayerId(), $id)) {
                        $reCache = true;
                    }
                } else {
                    if ($m->modifyLink(Session::getInstance()->getPlayerId(), $id, $name, $url, $pos)) {
                        $reCache = true;
                    }
                }
            }
        }
        //new links.
        $total = $m->getPlayerLinksCount(Session::getInstance()->getPlayerId());
        foreach ($_POST['nrNew'] as $key => $pos) {
            if (!empty($_POST['linknameNew'][$key]) && !empty($_POST['linkzielNew'][$key])) {
                if ($total < self::MAX_LINKS && $m->addLink(Session::getInstance()->getPlayerId(), $_POST['linknameNew'][$key], $_POST['linkzielNew'][$key], $pos)) {
                    $reCache = true;
                    $total++;
                }
            }
        }
        if ($reCache) {
            $memcache = Caching::getInstance();
            $memcache->delete("links_" . Session::getInstance()->getPlayerId());
        }
    }

    public function __construct()
    {
        parent::__construct();
        if (!Session::getInstance()->hasPlus()) {
            $this->redirect("dorf1.php");
        }
        $this->view = new GameView();
        $this->view->vars['titleInHeader'] = T("links", "Link list");
        $this->view->vars['bodyCssClass'] = 'perspectiveBuildings';
        $this->view->vars['contentCssClass'] = 'linklist';
        if (WebService::isPost()) {
            $this->action();
        }
        $m = new LinksModel();
        $links = $m->getPlayerLinks(Session::getInstance()->getPlayerId());
        $this->content = new PHPBatchView("linklist/main");
        $this->content->vars['lastNumber'] = $links->num_rows;
        $this->content->vars['links'] = [];
        $i = 0;
        while ($row = $links->fetch_assoc()) {
            $this->content->vars['links'][] = $row;
            ++$i;
        }
        $this->content->vars['recommend_html'] = '';
        foreach ((array)T("links", 'recommenced_links') as $key => $row) {
            $this->content->vars['recommend_html'] .= '<tr id="recommendedLinksRow' . $key . '">
                    <td class="nr">
                        <input class="text" type="text" name="nr" value="' . $i . '" size="1" maxlength="3" disabled="disabled">
                    </td>
                    <td class="nam">
                        <input class="text" type="text" name="linkname" value="' . $row['name'] . '" maxlength="30" disabled="disabled">
                    </td>
                    <td class="link">
                        <input class="text" type="text" name="linkziel" value="' . $row['url'] . '" maxlength="255" disabled="disabled">
                    </td>
                    <td class="add">
                        <button type="button" class="addElement " onclick="takeOverRecommendedLink(\'' . $key . '\')"></button>
                    </td>
                </tr>';
        }
        $this->view->vars['content'] .= $this->content->output();
    }
} 