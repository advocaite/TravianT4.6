<?php
namespace Controller\Ajax\tooltip;
use Controller\Ajax\AjaxBase;

use Core\Config;
use Core\Session;
use Core\Village;
use Game\AllianceBonus\AllianceBonus;
use Game\Formulas;
use Model\AdventureModel;
use Model\AllianceModel;
use Model\AuctionModel;
use Model\MarketModel;
use Model\TrainingModel;
use Model\Dorf1Model;

class layoutButton extends AjaxBase
{
    public function dispatch()
    {
		if (!Session::getInstance()->isValid()) {
            return;
        }
        $boxId = filter_var($_POST['boxId'], FILTER_SANITIZE_STRING);
        $buttonId = filter_var($_POST['buttonId'], FILTER_SANITIZE_STRING);
        if ($boxId === 'hero') {
            if ($buttonId === 'adventure') {
                $this->response['result'] = FALSE;
                $this->response['title'] = T("HeroGlobal", "Adventure");
                $m = new AdventureModel();
                $result = $m->getAdventureCountAndFirstExpire(Session::getInstance()->getPlayerId());
                $this->response['text'] = T("HeroGlobal", "available_adventures:") . " " . $result['count'];
                if ($result['count']) {
                    $this->response['text'] .= '<br />' . sprintf(T("HeroGlobal", "next adventure will expire in:"), secondsToString($result['time'] - time()));
                }
                $this->response['success'] = TRUE;
            } else if ($buttonId === 'auction') {
                $this->response['result'] = FALSE;
                $this->response['title'] = T("HeroGlobal", "Auctions");
                $m = new AuctionModel();
                $max = $m->getPlayerMaximumBidCount(Session::getInstance()->getPlayerId());
                $outbid = $m->getPlayerOutBidCount(Session::getInstance()->getPlayerId());
                $this->response['text'] = T("HeroGlobal", "Auctions with maximum bid:") . ' ' . $max;
                $this->response['text'] .= '<br />' . T("HeroGlobal", "Auctions which you got outbid:") . ' ' . $outbid;
                $this->response['success'] = TRUE;
            }
        } else if ($boxId === 'alliance') {
            if ($buttonId === 'embassy') {
                $this->response['result'] = FALSE;
                $this->response['title'] = T("embassy", "embassy");
                $this->response['text'] = '';
                $m = new AllianceModel();
                if (!Session::getInstance()->getAllianceId()) {
                    $this->response['text'] = T("embassy", "invites to you:") . ' ' . $m->getInvitesCount(Session::getInstance()->getPlayerId()) . '<br />';
                }
                $maxLvl = $m->getMaxPlayerEmbassyLvl(Session::getInstance()->getPlayerId())['embassy'];
                if ($maxLvl) {
                    $this->response['text'] .= T("embassy", "max embassy level:") . $maxLvl;
                } else {
                    $this->response['text'] .= '<span class="warning">' . T("embassy", "construct an embassy") . '</span>';
                }
                $this->response['success'] = TRUE;
            }
        } else if ($boxId == 'activeVillage') {
            if (in_array($buttonId, ['workshop', 'stable', 'barracks', 'market',])) {
                $this->response['result'] = FALSE;
                $this->response['title'] = T("Buildings", ($buttonId == 'workshop' ? 21 : ($buttonId == 'stable' ? 20 : ($buttonId == 'barracks' ? 19 : 17))) . ".title");
                $this->response['text'] = '';
                if ($buttonId == 'market') {
                    $m = new MarketModel();
                    $session = Session::getInstance();
                    $alliance_bonus = 1;
                    if ($session->getAllianceId() > 0) {
                        $alliance_bonus = AllianceBonus::getTradersBonus($session->getAllianceId(), $session->getAllianceJoinTime());
                    }
                    $merchant_cap = Formulas::merchantCAP(Session::getInstance()->getRace(), max(Village::getInstance()->getTypeLevel(28)), $alliance_bonus);
                    $totalMerchants = max(Village::getInstance()->getTypeLevel(17));
                    $this->response['text'] = sprintf(T("inGame", "FreeMerchants"), $totalMerchants - $m->getOnTheWayMerchantsCount(Village::getInstance()->getKid(), $merchant_cap) - $m->getOfferingMerchantsCount(Village::getInstance()->getKid(), $merchant_cap), $totalMerchants);
                } else {
                    $TrainingModel = new TrainingModel();
                    if ($buttonId == 'stable') {
                        $trainingTime = $TrainingModel->getTotalTrainingTime(Session::getInstance()->getKid(), 20);
                        if (!Village::getInstance()->isCapital()) {
                            $trainingTime += $TrainingModel->getTotalTrainingTime(Session::getInstance()->getKid(), 30);
                        }
                    } else if ($buttonId == 'workshop') {
                        $trainingTime = $TrainingModel->getTotalTrainingTime(Session::getInstance()->getKid(), 21);
                    } else {
                        $trainingTime = $TrainingModel->getTotalTrainingTime(Session::getInstance()->getKid(), 19);
                        if (!Village::getInstance()->isCapital()) {
                            $trainingTime += $TrainingModel->getTotalTrainingTime(Session::getInstance()->getKid(), 29);
                        }
                    }
                    if (Config::getProperty("game", "useNanoseconds")) {
                        $trainingTime /= 1e9;
                    } else if (Config::getProperty("game", "useMilSeconds")) {
                        $trainingTime /= 1000;
                    }
                    if ($trainingTime == 0) {
                        $this->response['text'] = T("inGame", "noTroopInBeingTrained");
                    } else {
                        $this->response['text'] = sprintf(T("inGame", "TrainingTime"), secondsToString((int)$trainingTime));
                    }
                }
                $this->response['success'] = TRUE;
            }
        } else if(isset($_POST['villageId'])){
			$m = new Dorf1Model();
			$result = $m->getIncomingAttacksToMe(filter_var($_POST['villageId'], FILTER_SANITIZE_INT));
			
			$this->response['title'] = T("Dorf1", "movements.incomingAttacksToMe").':'.$result['count'];
			$this->response['text'] = '';
		}
	}
}