<?php
namespace Controller;
use Core\Database\DB;
use Core\Session;
use Game\Hero\HeroFace;
use Game\Hero\SessionHero;
use Core\Locale;
use resources\View\GameView;
use resources\View\PHPBatchView;
class HeroFaceCtrl extends GameCtrl
{
    public function __construct()
    {
        parent::__construct();
        $this->view = new GameView();
        $this->view->vars['titleInHeader'] = '';
        $this->view->vars['bodyCssClass'] = 'perspectiveResources';
        $this->view->vars['contentCssClass'] = 'hero hero_editor';
        $this->view->vars['titleInHeader'] = Session::getInstance()->getName() . ' - ' . T("Buildings", "level") . ' ';
        $this->view->vars['titleInHeader'] .= $this->session->hero->getLevel();
        $view = new PHPBatchView("hero/menus");
        $view->vars['selectedTab'] = 2;
        $view->vars['favorText'] = sprintf(T("Global", "Select tab %s as favourite"), T("HeroGlobal", "Appear"));
        $this->view->vars['content'] .= $view->output();
        $view = new PHPBatchView("hero/heroFace");
        $f = new HeroFace();
        $db = DB::getInstance();
        $heroFace = $db->query("SELECT * FROM face WHERE uid=" . Session::getInstance()->getPlayerId())->fetch_assoc();
        $view->vars['heroFace'] = $heroFace;
        $view->vars['heroFaceData'] = $f->getAllHeroFaceAttributes($heroFace['gender']);
        $view->vars['heroImage'] = $f->getHeroImageAsHTML($heroFace);
        $view->vars['HeroFaceJson'] = ["element" => "heroEditor", "command" => "heroEditor", "urlHeroImage" => "hero_head.php?uid=" . Session::getInstance()->getPlayerId() . "&amp;size=sideinfo&amp;{time}", "attributes" => $f->encodeAttribute($heroFace), "elementHeroImage" => "heroImage",];
        $this->view->vars['content'] .= $view->output();
    }
} 