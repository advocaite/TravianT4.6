<?php
namespace Controller;
use Core\Locale;
use resources\View\GameView;
use resources\View\PHPBatchView;
class HelpCtrl extends GameCtrl
{
    public function __construct()
    {
        parent::__construct();
        $this->view = new GameView();
        $this->view->vars['titleInHeader'] = T("Help", "Help system");
        $this->view->vars['bodyCssClass'] = 'perspectiveResources';
        $this->view->vars['contentCssClass'] = 'universal';
        if(isset($_GET['page']) && $_GET['page'] == 'support') {
            $this->renderSupport();
        } else {
            $this->renderHelp();
        }
    }

    private function renderHelp()
    {
        $this->view->vars['content'] .= PHPBatchView::render('layout/help');
    }

    private function renderSupport()
{
        $this->view->vars['content'] .= '<div class="helpDescription">' . T("Help", "inGameSupport.description") . '</div>';
        $this->view->vars['content'] .= '<div class="helpInfoBlock"><a href="' . getAnswersUrl() . '" class="helpHeadLine" target="_blank">' . T("Help", "inGameSupport.FAQ - go to Answers") . '</a></div>';
        $this->view->vars['content'] .= '<div class="helpInfoBlock"><a href="support_form.php?t=support"><span class="helpText">' . T("Help", "inGameSupport.I tried Answers but I want to contact the support") . '</span><br><br><span class="helpHeadLine">' . T("Help", "inGameSupport.Contact ingame support") . '</span></a></div>';
    }
} 