<?php

namespace Controller\Ajax;

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

class getLayoutButtonTitle extends AjaxBase
{
    public function dispatch()
    {
        if (!Session::getInstance()->isValid()) {
            return;
        }
        $boxId = filter_var($_POST['boxId'], FILTER_SANITIZE_STRING);
        $buttonId = filter_var($_POST['buttonId'], FILTER_SANITIZE_STRING);
        if ($boxId === 'hero') {
            if ($buttonId === 'adventureWhite') {
                $this->response['data']['result'] = FALSE;
                $this->response['data']['newTitle'] = T("HeroGlobal", "Adventure");
                $m = new AdventureModel();
                $result = $m->getAdventureCountAndFirstExpire(Session::getInstance()->getPlayerId());
                $this->response['data']['newText'] = T("HeroGlobal", "available_adventures:") . " " . $result['count'];
                if ($result['count']) {
                    $this->response['data']['newText'] .= '<br />' . sprintf(T("HeroGlobal", "next adventure will expire in:"), secondsToString($result['time'] - time()));
                }
                $this->response['data']['success'] = TRUE;
            } else if ($buttonId === 'auctionWhite') {
                $this->response['data']['result'] = FALSE;
                $this->response['data']['newTitle'] = T("HeroGlobal", "Auctions");
                $m = new AuctionModel();
                $max = $m->getPlayerMaximumBidCount(Session::getInstance()->getPlayerId());
                $outbid = $m->getPlayerOutBidCount(Session::getInstance()->getPlayerId());
                $this->response['data']['newText'] = T("HeroGlobal", "Auctions with maximum bid:") . ' ' . $max;
                $this->response['data']['newText'] .= '<br />' . T("HeroGlobal", "Auctions which you got outbid:") . ' ' . $outbid;
                $this->response['data']['success'] = TRUE;
            }
        } else if ($boxId === 'alliance') {
            if ($buttonId === 'embassyWhite') {
                $this->response['data']['result'] = FALSE;
                $this->response['data']['newTitle'] = T("embassyWhite", "embassy");
                $this->response['data']['newText'] = '';
                $m = new AllianceModel();
                if (!Session::getInstance()->getAllianceId()) {
                    $this->response['data']['newText'] = T("embassyWhite", "invites to you:") . ' ' . $m->getInvitesCount(Session::getInstance()->getPlayerId()) . '<br />';
                }
                $maxLvl = $m->getMaxPlayerEmbassyLvl(Session::getInstance()->getPlayerId())['embassy'];
                if ($maxLvl) {
                    $this->response['data']['newText'] .= T("embassyWhite", "max embassy level:") . $maxLvl;
                } else {
                    $this->response['data']['newText'] .= '<span class="warning">' . T("embassyWhite", "construct an embassy") . '</span>';
                }
                $this->response['data']['success'] = TRUE;
            }
        } else if ($boxId == 'activeVillage') {
            if (in_array($buttonId, ['workshopWhite', 'stableWhite', 'barracksWhite', 'marketWhite',])) {
                $this->response['data']['result'] = FALSE;
                $this->response['data']['newTitle'] = T("Buildings", ($buttonId == 'workshopWhite' ? 21 : ($buttonId == 'stableWhite' ? 20 : ($buttonId == 'barracksWhite' ? 19 : 17))) . ".title");
                $this->response['data']['newText'] = '';
                if ($buttonId == 'marketWhite') {
                    $m = new MarketModel();
                    $session = Session::getInstance();
                    $alliance_bonus = 1;
                    if ($session->getAllianceId() > 0) {
                        $alliance_bonus = AllianceBonus::getTradersBonus($session->getAllianceId(), $session->getAllianceJoinTime());
                    }
                    $merchant_cap = Formulas::merchantCAP(Session::getInstance()->getRace(), max(Village::getInstance()->getTypeLevel(28)), $alliance_bonus);
                    $totalMerchants = max(Village::getInstance()->getTypeLevel(17));
                    $this->response['data']['newText'] = sprintf(T("inGame", "FreeMerchants"), $totalMerchants - $m->getOnTheWayMerchantsCount(Village::getInstance()->getKid(), $merchant_cap) - $m->getOfferingMerchantsCount(Village::getInstance()->getKid(), $merchant_cap), $totalMerchants);
                } else {
                    $TrainingModel = new TrainingModel();
                    if ($buttonId == 'stableWhite') {
                        $trainingTime = $TrainingModel->getTotalTrainingTime(Session::getInstance()->getKid(), 20);
                        if (!Village::getInstance()->isCapital()) {
                            $trainingTime += $TrainingModel->getTotalTrainingTime(Session::getInstance()->getKid(), 30);
                        }
                    } else if ($buttonId == 'workshopWhite') {
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
                        $this->response['data']['newText'] = T("inGame", "noTroopInBeingTrained");
                    } else {
                        $this->response['data']['newText'] = sprintf(T("inGame", "TrainingTime"), secondsToString((int)$trainingTime));
                    }
                }
                $this->response['data']['success'] = TRUE;
            }
        }
    }
}