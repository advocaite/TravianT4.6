<?php
namespace Controller\Ajax;
use Core\Config;
use Core\Database\DB;
use Core\Session;
use Model\OptionModel;
use Model\DailyQuestModel;

class silverExchange extends AjaxBase
{
    public function dispatch()
    {
        $m = new OptionModel();
        if (!Config::getInstance()->dynamic->serverFinished && !Session::getInstance()->banned() && !$m->isDeletion(Session::getInstance()->getPlayerId())) {
            $silver = abs((int)$_POST['s']);
            $session = Session::getInstance();
            if ($_POST['exTyp'] == 'SilverToGold') {
                $availableSilver = $session->getAvailableSilver();
                if ($silver >= 200 && $silver <= $availableSilver) {
                    $db = DB::getInstance();
                    $this->response['data']['oldSilver'] = $availableSilver;
                    $goldCount = floor($silver / 200);
                    $silverCount = (int)$goldCount * 200;
                    $db->query("UPDATE users SET gift_gold=gift_gold+$goldCount, silver=silver-$silverCount WHERE id=" . $session->getPlayerId());
                    $session->setSilver($availableSilver - $silverCount);

                    $dailyQuest = new DailyQuestModel();
                    $dailyQuest->setQuestAsCompleted($session->getPlayerId(), 5);

                    $this->response['data']['result'] = TRUE;
                    $this->response['data']['type'] = 'SilverToGold';
                    $this->response['data']['silver'] = (int)$_POST['s'];
                    $this->response['data']['gold'] = (int)$_POST['g'];
                    $this->response['data']['newSilver'] = $session->getAvailableSilver();
                    $this->response['data']['newGold'] = $session->getGold() + $goldCount;
                    $this->response['data']['message']['type'] = 'info';
                    $this->response['data']['message']['message'] = '<img src="img/x.gif" class="silver" alt="' . T("Global", "silver") . '" title="' . T("Global", "silver") . '" /> ' . $silverCount . ' ' . T("Global","convertedTo") . ' <img src="img/x.gif" class="gold" alt="' . T("Global","gold") . '" title="' . T("Global", "gold") . '" /> ' . $goldCount . '';
                }
            }
        }
    }
} 