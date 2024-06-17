<?php
namespace Controller\Build;
use Controller\AnyCtrl;
use Core\Database\DB;
use Core\Helper\TimezoneHelper;
use Core\Session;
use Core\Village;
use Game\Formulas;
use Game\GoldHelper;
use function isServerFinished;
use resources\View\PHPBatchView;
class BreweryCtrl extends AnyCtrl
{
    public function __construct($index)
    {
        parent::__construct();

        $this->view = new PHPBatchView("build/brewery");
        $this->view->vars['buildingIndex'] = $index;
        $this->view->vars['festivalDuration'] = Formulas::getFestivalDuration();
        $this->view->vars['festivalResources'] = Formulas::getFestivalResources();
        if(!$this->isFestivalRunning() && isset($_GET['z']) && $_GET['z'] == Session::getInstance()->getChecker()) {
            if(Session::getInstance()->banned()) {
                $this->innerRedirect("InGameBannedPage");
            } else if(isServerFinished()) {
                $this->innerRedirect("InGameWinnerPage");
            } else if(Session::getInstance()->isInVacationMode()) {
                $this->redirect('options.php?s=4');
            } else {
                Session::getInstance()->changeChecker();
                $cost = $this->view->vars['festivalResources'];
                if(Village::getInstance()->isResourcesAvailable($cost)) {
                    $db = DB::getInstance();
                    if(Village::getInstance()->modifyResources($cost)){
                        $festival = time() + $this->view->vars['festivalDuration'];
                        $db->query("UPDATE vdata SET festival=$festival WHERE kid=" . Village::getInstance()->getKid());
                        Village::getInstance()->setFestival($festival);
                    }
                }
            }
        }
        $this->view->vars['isFestival'] = $this->isFestivalRunning();
        $this->view->vars['npcButton'] = (new GoldHelper())->getExchangeResourcesButtonByCost($this->view->vars['festivalResources']);
        $this->view->vars['contractLinkButton'] = $this->getButton($index);
        if($this->isFestivalRunning()) {
            $this->view->vars['timeLeft'] = appendTimer(Village::getInstance()->getFestival() - time());
            $this->view->vars['endat'] = TimezoneHelper::date("H:i", Village::getInstance()->getFestival());
        }
    }

    private function getButton($id)
    {
        if($this->isFestivalRunning()) {
            return '<span class="errorMessage">' . T("inGame", "one celebration is running") . '</span>';
        }
        $cost = Formulas::getFestivalResources();
        if(Village::getInstance()->isResourcesAvailable($cost)) {
            return getButton(["type" => "button", "class" => "green", "onclick" => "window.location.href = 'build.php?id=$id&z=" . Session::getInstance()->getChecker() . "'; return false;", 'value' => T("inGame", "run celebration"),], ["data" => ["type" => "button",]], T("inGame", "run celebration"));
        }
        $contract = Village::getInstance()->contractResourcesLink($cost);
        return $contract['text'];
    }

    private function isFestivalRunning()
    {
        return Village::getInstance()->getFestival() > time();
    }
}