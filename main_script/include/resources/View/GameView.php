<?php

namespace resources\View;

use function array_key_exists;
use function array_keys;
use Core\Caching\Caching;
use Core\Caching\GlobalCaching;
use Core\Caching\ProfileCache;
use Core\Config;
use Core\Database\DB;
use Core\Database\GlobalDB;
use Core\Helper\BBCode;
use Core\Helper\PreferencesHelper;
use Core\Helper\TimezoneHelper;
use Core\Helper\Voting;
use Core\Session;
use Core\Village;
use Game\Formulas;
use Game\GoldHelper;
use Game\Hero\SessionHero;
use Game\TruceDay;
use function logError;
use Model\AdventureModel;
use Model\AllianceModel;
use Model\AutoExtendModel;
use Model\InfoBoxModel;
use Model\LinksModel;
use Model\MovementsModel;
use Model\Quest;
use function getCustom;
use function getDisplay;
use function number_format_x;
use function secondsToString;

class GameView
{
    public $newVillagePrefix = [];
    public $vars             = [];
    public $session;

    public function __construct()
    {
        $this->session = Session::getInstance();
        if (!$this->session->isValid()) return;
        $this->vars['ajaxToken'] = $this->session->getAjaxToken();
        $this->vars['_player_uuid'] = $this->session->getPlayerUUID();
        $this->vars['titleInHeader'] = '';
        $this->vars['bodyCssClass'] = '';
        $this->vars['contentCssClass'] = '';
        $this->vars['colorBlind'] = $this->session->getDisplay()[3] == 1;
        $this->vars['autoReload'] = !getDisplay("allowAutoReloadSettingChange") || $this->session->getDisplay()[4];
        $this->vars['sidebarBeforeContent'] = '';
        $this->vars['sidebarAfterContent'] = '';
        $this->vars['answerId'] = '';
        $this->vars['showNavBar'] = TRUE;
        $this->vars['showHeaderBar'] = TRUE;
        $this->vars['showStockbar'] = TRUE;
        $this->vars['showCloseButton'] = TRUE;
        $this->vars['headerBar'] = TRUE;
        $this->vars['answerId'] = 1;
        $this->vars['content'] = '';
        $this->vars['showTime'] = TRUE;
        $db = DB::getInstance();
        $memcache = Caching::getInstance();
        $uid = (int)$this->session->getPlayerId();
        if (!($newReports = $memcache->get("newReports" . $this->session->getPlayerId()))) {
            $newReports = $db->fetchScalar("SELECT COUNT(id) FROM ndata WHERE uid=$uid AND (viewed=0 AND deleted=0)");
            $memcache->add('newReports' . $this->session->getPlayerId(), $newReports, 30);
        }
        if (!($ignoreList = $memcache->get("ignoreList" . $this->session->getPlayerId()))) {
            $ignoreList = [];
            $find = $db->query("SELECT ignore_id FROM ignoreList WHERE uid=$uid");
            while ($row = $find->fetch_assoc()) {
                $ignoreList[] = $row['ignore_id'];
            }
            $memcache->add('ignoreList' . $this->session->getPlayerId(), $ignoreList, 86400);
        }
        $filter = sizeof($ignoreList) ? "AND uid NOT IN(" . implode(",", $ignoreList) . ")" : '';
        if (!($newMessages = $memcache->get("newMessages" . $this->session->getPlayerId()))) {
            $newMessages = $db->fetchScalar("SELECT COUNT(id) FROM mdata WHERE to_uid={$this->session->get("id")} AND delete_receiver=0 AND (viewed=0) $filter");
            $memcache->add('newMessages' . $this->session->getPlayerId(), $newMessages, 30);
        }
        $this->vars['newReportsCount'] = $newReports;
        $this->vars['newMessagesCount'] = $newMessages;
        $this->vars['isSitter'] = $this->session->isSitter();
    }

    public function output()
    {
        $this->vars['silverCount'] = $this->session->getAvailableSilver();
        $this->vars['goldCount'] = $this->session->getGold();
        if ($this->session->getPlayerId() > 0) {
            $this->renderStockBar();
            //before content
            $this->renderHeroBox();
            $this->renderAllianceBox();
            $this->renderInfoBox();
            $this->renderLinkList();
            //after content
            $this->renderActiveVillageBox();
            if ($this->getTotalVillagesCount() <= 20) {
                $this->renderVillagesList();
                if ($this->session->getPlayerId() > 2) {
                    $this->renderDailyQuest();
                    $this->renderVotingSystem();
                }
            } else {
                if ($this->session->getPlayerId() > 2) {
                    $this->renderDailyQuest();
                    $this->renderVotingSystem();
                }
                $this->renderVillagesList();
            }
            if ($this->session->getPlayerId() > 2) {
                $this->renderQuest();
            }
        }
        $this->vars['dateTime'] = TimezoneHelper::real_strtotime(TimezoneHelper::date(TimezoneHelper::getTimeFormat(),
            NULL,
            FALSE));
        $this->vars['extra'] = TimezoneHelper::getTimeFormat() == 'h:i:s' ? TimezoneHelper::date('a') : '';
        $view = new PHPBatchView('layout/Layout');
        $view->vars = $this->vars;
        $view->display();
    }

    private function renderStockBar()
    {
        $this->vars['stockBar'] = [
            "maxstore"        => $this->session->village->get("maxstore"),
            "maxcrop"         => $this->session->village->get("maxcrop"),
            "production"      => $this->session->village->getProduction(-1),
            "productionBoost" => [
                $this->session->hasProductionBoost(1),
                $this->session->hasProductionBoost(2),
                $this->session->hasProductionBoost(3),
                $this->session->hasProductionBoost(4),
            ],
            "storage"         => array_map('round', $this->session->village->getCurrentResources(-1, FALSE)),
            "titles"          => [
                0 => sprintf(T("inGame", "stockBar.production.r1"),
                    number_format_x($this->session->village->getProduction(0)),
                    $this->getProductionFullTime(0)),
                1 => sprintf(T("inGame", "stockBar.production.r2"),
                    number_format_x($this->session->village->getProduction(1)),
                    $this->getProductionFullTime(1)),
                2 => sprintf(T("inGame", "stockBar.production.r3"),
                    number_format_x($this->session->village->getProduction(2)),
                    $this->getProductionFullTime(2)),
                3 => sprintf(T("inGame", "stockBar.production.r4" . ($this->session->village->getProduction(3) < 0 ? 'Empty' : '')),
                    number_format_x($this->session->village->getProduction(4)),
                    ($this->session->village->getProduction(3) < 0 ? $this->getCropEmptyTime() : $this->getProductionFullTime(3))),
                4 => sprintf(T("inGame", "stockBar.production.r5"), number_format_x($this->session->village->getProduction(3)))
            ],
            'storageString'   => [null, null, null, null],
            'storageClass'    => [null, null, null, null],
            'percents'        => [0, 0, 0, 0],
        ];
        $this->vars['stockBar']['percents'][0] = round($this->vars['stockBar']['storage'][0] / $this->vars['stockBar']['maxstore'] * 100);
        $this->vars['stockBar']['percents'][1] = round($this->vars['stockBar']['storage'][1] / $this->vars['stockBar']['maxstore'] * 100);
        $this->vars['stockBar']['percents'][2] = round($this->vars['stockBar']['storage'][2] / $this->vars['stockBar']['maxstore'] * 100);
        $this->vars['stockBar']['percents'][3] = round($this->vars['stockBar']['storage'][3] / $this->vars['stockBar']['maxcrop'] * 100);


        foreach ($this->vars['stockBar']['storage'] as $k => $v) {
            $maxStore = $this->vars['stockBar']['maxstore'];
            if ($k == 3)
                $maxStore = $this->vars['stockBar']['maxcrop'];

            $this->vars['stockBar']['storageClass'][$k] = $v - $maxStore == 0 ? 'Full' : '';
            $this->vars['stockBar']['storageString'][$k] = number_format_x($v);
        }
    }

    private
    function getProductionFullTime($n)
    {
        $maxStore = $this->session->village->get($n == 3 ? 'maxcrop' : 'maxstore');
        $production = $this->session->village->getProduction($n);
        $current = $this->session->village->getCurrentResources($n);
        if ($production == 0) {
            return secondsToString(0);
        }
        return secondsToString(round(($maxStore - $current) / $production * 3600));
    }

    private function getCropEmptyTime()
    {
        $cpProd = $this->session->village->getProduction(3);
        return secondsToString(round($this->session->village->village['crop'] / abs($cpProd == 0 ? 0.01 : $cpProd) * 3600));
    }

    private function renderHeroBox()
    {
        $session = $this->session;
        $db = DB::getInstance();
        $view = new PHPBatchView("layout/sidebarBoxHero");
        $m = new AdventureModel();
        $memcached = Caching::getInstance();
        if (($vars = $memcached->get("hero_sidebar_" . $this->session->getPlayerId()))) {
            $view->vars = $vars;
        } else {
            if (!($heroImageHash = $memcached->get("heroImageHash" . $this->session->getPlayerId()))) {
                $heroImageHash = sha1($db->fetchScalar("SELECT lastupdate FROM face WHERE uid={$this->session->getPlayerId()} LIMIT 1"));
                $memcached->add("heroImageHash", $heroImageHash, 86400);
            }
            $result = $m->getAdventureCountAndFirstExpire($this->session->getPlayerId());
            $view->vars = [
                "uid"                  => $this->session->getPlayerId(),
                "heroImageHash"        => $heroImageHash,
                "playerName"           => $this->session->getName(),
                "hasNewPoints"         => $this->session->hero->hasNewPoints(),
                "race"                 => $this->session->getRace(),
                "longStatus"           => $this->session->hero->getLongStatus(),
                "shortStatus"          => $this->session->hero->getShortStatus(),
                "status"               => $this->session->hero->getHeroStatus(),
                "health"               => $this->session->hero->getHeroHealth(),
                "exp"                  => $this->session->hero->getHeroExp(),
                "expPercent"           => $this->session->hero->getHeroExpPercent(),
                "dead"                 => $this->session->hero->getHeroStatus() === SessionHero::STATUS_DEAD,
                "regenerating"         => $this->session->hero->getHeroStatus() === SessionHero::STATUS_REVIVING,
                "regeneratedHealth"    => $this->session->hero->getRegeneratedHealth(),
                "lvlUp"                => $this->session->hero->getAvailablePoints() > 0 && ($this->session->hero->getAvailablePoints() % 4 == 0),
                "toggle"               => PreferencesHelper::getPreference("travian_toggle_hero"),
                "adventureWhiteButton" => ["adventureCount" => $result['count'],],
            ];
            //$memcached->set("hero_sidebar_{$this->session->getPlayerId()}", $view->vars, 20);
        }
        $view->vars['adventureWhiteButton']['id'] = get_button_id();
        $view->vars['auctionWhiteButton']['id'] = get_button_id();
        $this->vars['sidebarBeforeContent'] .= $view->output();
    }

    private function renderAllianceBox()
    {
        $cache = Caching::getInstance();
        $key = sprintf('%s:AllianceBox', $this->session->getPlayerId());
        if ($cachedContent = $cache->get($key)) {
            $this->vars['sidebarBeforeContent'] .= $cachedContent;
            return;
        }
        $m = new AllianceModel();
        $embassy = $m->getMaxPlayerEmbassyLvl($this->session->getPlayerId());
        $view = new PHPBatchView("layout/sidebarBoxAlliance");
        $view->vars['aid'] = $this->session->getAllianceId();
        $view->vars['link'] = $this->session->getAllianceId();
        $view->vars['noEmbassy'] = $embassy['embassy'] == 0;
        if (!$view->vars['noEmbassy']) {
            $view->vars['link'] = 'build.php?gid=18';
            if ($embassy['kid'] <> Village::getInstance()->getKid()) {
                $view->vars['link'] .= '&newdid=' . $embassy['kid'];
            }
        }
        if ($view->vars['aid']) {
            $view->vars['allianceName'] = $m->getAllianceField($view->vars['aid'], "name");
        }
        $newsSettings = $this->session->getAllianceSettings();
        $in = [];
        if ($newsSettings[0]) {
            $in[] = AllianceModel::LOG_NEW_VILLAGE;
        }
        if ($newsSettings[1]) {
            $in[] = AllianceModel::LOG_JOINED;
        }
        if ($newsSettings[2]) {
            $in[] = AllianceModel::LOG_INVITE;
        }
        if ($newsSettings[3]) {
            $in[] = AllianceModel::LOG_LEFT;
        }
        if ($newsSettings[4]) {
            $in[] = AllianceModel::LOG_KICK;
        }
        $db = DB::getInstance();
        $HTML = '';
        $view->vars['hasNews'] = FALSE;
        if ($view->vars['aid'] && array_sum($newsSettings)) {
            $results = $db->query("SELECT * FROM ali_log WHERE aid={$view->vars['aid']} AND type IN(" . implode(",",
                    $in) . ") ORDER BY id DESC LIMIT 3");
            while ($row = $results->fetch_assoc()) {
                $HTML .= '<ul><li>' . TimezoneHelper::autoDateString($row['time'],
                        TRUE) . ' ' . BBCode::renderAliNewsEvent($row['data']) . '</li></ul>';
            }
            $view->vars['hasNews'] = $results->num_rows >= 1;
        }
        $view->vars['toggle'] = PreferencesHelper::getPreference("travian_toggle_alliance");
        $view->vars['news'] = $HTML;
        $output = $view->output();
        //$cache->set($key, $output, 300);
        $this->vars['sidebarBeforeContent'] .= $output;
    }

    private function renderInfoBox()
    {
        $m = new InfoBoxModel();
        $publicInfobox = $m->getPublicInfoBox();
        $infoBox = $m->getMyInfoBox($this->session->getPlayerId());
        if (!sizeof($infoBox) && !sizeof($publicInfobox)) {
            return;
        }
        $infoBox_count = 0;
        $view = new PHPBatchView("layout/sidebarBoxInfoBox");
        $view->vars['total'] = sizeof($infoBox) + sizeof($publicInfobox);
        $view->vars['title'] = T("inGame", "total_messages") . ': ' . $view->vars['total'];
        $unread = $m->getUnreadInfoBoxCount($this->session->getPlayerId());
        if ($unread) {
            $view->vars['title'] .= '<br />' . T("inGame", "unReadMessages") . ': ' . $unread;
        }
        $view->vars['unreadCount'] = $unread;
        $view->vars['unread'] = $unread ? " unreaded" : '';
        $view->vars['content'] = '';
        $view->vars['toggle'] = PreferencesHelper::getPreference("travian_toggle_infobox");
        $i = 0;
        foreach ($publicInfobox as $row) {
            if (($row['showTo'] > 0 && $row['showTo'] < time()) || ($row['showFrom'] > 0 && $row['showFrom'] > time())) continue;
            ++$i;
            $class = [];
            if ($i == 1) {
                $class[] = 'firstElement';
                $class[] = 'active';
            }
            $view->vars['content'] .= '<li id="infoID_p' . $row['id'] . '" class="' . implode(" ", $class) . '">';
            if ($row['autoType'] == 1) {
                $cache = GlobalCaching::getInstance();
                if (!($offer = $cache->get("paymentOffer"))) {
                    $offer = GlobalDB::getInstance()->query("SELECT offer, offerFrom FROM paymentConfig LIMIT 1")->fetch_assoc();
                    $cache->add("paymentOffer", $offer, max($offer['offer'] - time(), 1));
                }
                $view->vars['content'] .= sprintf(T("inGame", "infoBox.AutoType_GoldPromotion"),
                    TimezoneHelper::autoDateString($offer['offerFrom'], true),
                    TimezoneHelper::autoDateString($offer['offer'], true));
            } else if ($row['autoType'] == 2) {
                //TODO: Public Peace day.
            } else {
                $view->vars['content'] .= $row['params'];
            }
            $view->vars['content'] .= '</li>';
            $infoBox_count++;
        }
        $conf = Config::getInstance();
        $infoBoxSize = sizeof($infoBox);
        $session = $this->session;

        foreach ($infoBox as $row) {
            if ($row['type'] == 8 || $row['type'] == 9) {
                $release = $row['type'] == 8 ? $conf->timers->ArtifactsReleaseTime : $conf->timers->wwPlansReleaseTime;
                $row['showFrom'] = $release - 5 * 86400;
                $row['showTo'] = $release;
            }
            if ($row['type'] == 6) {
                $row['showTo'] = $this->session->protectionTill();
            }
            if ($row['type'] == 15) {
                $row['showTo'] = $conf->game->catapultAvailableTime;
            }
            if ($row['type'] == 17) {
                if (!TruceDay::isActive()) continue;
                $row['showFrom'] = $conf->dynamic->truceFrom;
                $row['showTo'] = $conf->dynamic->truceTo;
            }

            if (in_array($row['type'], [2, 3, 4, 5])) {
                if ($this->session->productionBoostTill($row['type'] - 1) - time() > 86400) {
                    --$infoBoxSize;
                    continue;
                }
            }
            if ($row['type'] == 1) {
                if ($this->session->plusTill() - time() > 86400) {
                    --$infoBoxSize;
                    continue;
                }
            }

            if (($row['showTo'] > 0 && $row['showTo'] < time()) || ($row['showFrom'] > 0 && $row['showFrom'] > time())) continue;
            ++$i;
            $class = [];
            if ($i == 1) {
                $class[] = 'firstElement';
                $class[] = 'active';
            }
            if ($row['forAll'] == 1) {
                $row['readStatus'] = $m->haveIReadPublicOne($this->session->getPlayerId(), $row['id']);
                $row['del'] = $m->haveIDeletedPublicOne($this->session->getPlayerId(), $row['id']);
            }
            if (!$row['readStatus']) {
                $class[] = 'unreaded';
            }
            $view->vars['content'] .= '<li id="infoID_' . $row['id'] . '" class="' . implode(" ", $class) . '">';
            if ($row['type'] <> 0) {
                $view->vars['content'] .= $this->renderInGameInfoBox($row);
            } else {
                if (!$row['forAll'] && !$row['del']) {
                    $view->vars['content'] .= '<a class="infoboxDeleteButton" href="#" data-id="' . $row['id'] . '">';
                    $view->vars['content'] .= '<img src="img/x.gif" class="del" alt="del">';
                    $view->vars['content'] .= '</a>';
                }
                $view->vars['content'] .= $row['params'];
            }
            $view->vars['content'] .= '</li>';
            if ($infoBoxSize == 1 && $unread) {
                $m->setInfoboxItemsRead($this->session->getPlayerId(), [$row['id']]);
            }
            $infoBox_count++;
        }
        $output = $view->output();

        if ($infoBox_count == 0) return;

        $this->vars['sidebarBeforeContent'] .= $output;
    }

    private function renderInGameInfoBox($row)
    {
        $return = '<p>';
        //$nonDeletableTypes = [6, 13, 11];
        $nonDeletableTypes = [6, 13, 11, 14, 16];
        if (!$row['del'] && !in_array($row['type'], $nonDeletableTypes)) {
            $return .= '<a class="infoboxDeleteButton" href="#" data-id="' . $row['id'] . '">';
            $return .= '<img src="img/x.gif" class="del" alt="del">';
            $return .= '</a>';
        }
        $config = Config::getInstance();
        $session = $this->session;
        $autoExtend = new AutoExtendModel();
        if ($row['type'] <= 5) {
            $gold = $row['type'] == 1 ? $config->gold->plusGold : $config->gold->productionBoostGold;
            if ($this->session->getAvailableGold() < $gold) {
                if ($autoExtend->hasAutoExtend($this->session->getPlayerId(), $row['type'])) {
                    $return .= T("inGame", "infoBox.Not enough gold to extend this feature") . '<br />';
                }
            }
        }
        switch ($row['type']) {
            case 1:
                if ($this->session->plusTill() > time()) {
                    $return .= sprintf(T("inGame", "infoBox.PlusWillBeFinished"),
                        appendTimer($this->session->plusTill() - time()));
                } else {
                    $return .= T("inGame", "infoBox.plusAccountExpired");
                }
                break;
            case 2:
            case 3:
            case 4:
            case 5:
                if ($this->session->hasProductionBoost($row['type'] - 1)) {
                    $return .= sprintf(T("inGame", "infoBox.Boost" . ($row['type'] - 1) . "WillBeFinished"),
                        appendTimer($this->session->productionBoostTill($row['type'] - 1) - time()));
                } else {
                    $return .= T("inGame", "infoBox.productionBoost" . ($row['type'] - 1) . "Expired");
                }
                break;
            case 6:
                $baseProtection = Formulas::getProtectionBasicTime($this->session->get("signupTime"));
                $usedProtection = ($this->session->protectionTill() - $this->session->get("signupTime"));
                $protectionExtendingUsed = $usedProtection > $baseProtection;
                $protectionLeft = $this->session->protectionTill() - time();
                $isProtectionExtendTime = $protectionLeft <= Formulas::getProtectionShowExtendTime($this->session->get("signupTime"));
                $showExtendButton = FALSE;
                if (!$protectionExtendingUsed && $isProtectionExtendTime) {
                    $extendTime = Formulas::getProtectionExtendTime($this->session->get("signupTime"));
                    if ($extendTime >= 86400) {
                        $unit = round($extendTime / 86400, 1);
                        $unitName = T("inGame", "Days");
                    } else if ($extendTime >= 3600) {
                        $unit = round($extendTime / 3600, 1);
                        $unitName = T("inGame", "Hours");
                    } else if ($extendTime > 60) {
                        $unit = round($extendTime / 60, 1);
                        $unitName = T("inGame", "Minutes");
                    } else {
                        $unit = $extendTime;
                        $unitName = T("inGame", "Seconds");
                    }
                    $return .= sprintf(T("inGame", "Click here to extend your beginners protection by 3 days"),
                            $unit,
                            $unitName) . ' ';
                    $showExtendButton = TRUE;
                }
                if ($this->session->protectionTill() < time()) {
                    $return .= 'Pending.';
                    break;
                }
                $return .= sprintf(T("inGame", "infoBox.protection"), appendTimer($this->session->protectionTill() - time()));
                if ($showExtendButton) {
                    $view = new PHPBatchView("layout/extendProtection");
                    $return .= $view->output();
                }
                break;
            case 7:
                if ($config->timers->lastMedalsGiven < time()) {
                    $return .= 'Pending.';
                    break;
                }
                $return .= sprintf(T("inGame", "infoBox.MedalsWillBeGivenIn"),
                    appendTimer((($config->dynamic->lastMedalsGiven + $config->game->medals_interval)) - time()));
                break;
            case 8:
                if ($config->timers->ArtifactsReleaseTime < time()) {
                    $return .= 'Pending.';
                    break;
                }
                $return .= sprintf(T("inGame", "infoBox.ArtifactsWillBeReleasedIn"),
                    appendTimer($config->timers->ArtifactsReleaseTime - time()));
                break;
            case 9:
                if ($config->timers->wwPlansReleaseTime < time()) {
                    $return .= 'Pending.';
                    break;
                }
                $return .= sprintf(T("inGame",
                    getCustom("wwPlansEnabled") ? "infoBox.wwPlansWillBeReleasedIn" : "infoBox.youCanBuildWWIn"),
                    appendTimer($config->timers->wwPlansReleaseTime - time()));
                break;
            case 10:
                if ($config->timers->AutoFinishTime < time()) {
                    $return .= 'Pending.';
                    break;
                }
                $return .= sprintf(T("inGame", "infoBox.AutoFinishTime"),
                    appendTimer($config->timers->AutoFinishTime - time()));
                break;
            case 11:
                if ($row['showTo'] < time()) {
                    $return .= 'Pending.';
                    break;
                }
                $return .= sprintf(T("inGame", "The account will be deleted in"), appendTimer($row['showTo'] - time()));
                break;
            case 12://report overflow
                $day = FALSE;
                $unit = 7;
                if ($unit % 24 == 0) {
                    $unit /= 24;
                    $day = TRUE;
                }
                $return .= sprintf(T("inGame", "infoBox.overFlowMessage"),
                    $unit,
                    $day ? T("inGame", "infoBox.day(s)") : T("inGame", "infoBox.hour(s)"));
                break;
            case 13://vacation
                $return .= sprintf(T("inGame", "infoBox.Your account is in vacation until [time]"),
                    TimezoneHelper::autoDate($row['showTo'], TRUE));
                $return .= '<br /><a href="options.php?s=4" title="">' . T("inGame", "More Information") . '</a>';
                break;
            case 14://banned
                $uid = $this->session->getPlayerId();
                $db = DB::getInstance();
                $result = $db->query("SELECT * FROM banQueue WHERE uid=$uid ORDER BY id DESC LIMIT 1");
                if ($result->num_rows) {
                    $result = $result->fetch_assoc();
                    if (!empty($result['reason'])) {
                        $reason = T("inGame", "infoBox.Reasons.{$result['reason']}");
                        $return .= '<span class="warning">' . T("inGame",
                                "infoBox.Your account was banned!") . '</span><br />';
                        $return .= T("inGame", "infoBox.Reason") . ': ' . $reason;
                    }
                }
                break;
            case 15://catapult
                $return .= sprintf(T("inGame", "infoBox.CatapultAvailableIn"),
                    appendTimer(Config::getProperty("game", "catapultAvailableTime") - time()));
                break;
            case 16: //email not verified
                $return .= T("EVerify", "YOUR_EMAIL_ADDRESS_IS_NOT_VERIFIED_TO_VERIFY_CLICK_HERE");
                break;
            case 17: //truce day
                $reason = TruceDay::getReasonId();
                $return .= sprintf(
                    T("Truce", "infobox_reasons.{$reason}"),
                    TimezoneHelper::autoDate(TruceDay::getFrom(), true),
                    TimezoneHelper::autoDate(TruceDay::getTo(), true)
                );
                break;
        }
        $return .= '</p>';
        if ($row['type'] == 1) {
            $helper = new GoldHelper();
            $return .= $helper->getPlusButton(TRUE);
        } else if ($row['type'] <= 5) {
            $helper = new GoldHelper();
            $return .= $helper->getProductionBoostButton($row['type'] - 1, TRUE);
        }
        return $return;
    }

    private
    function renderLinkList()
    {
        if (Quest::getInstance()->isTutorial() && getDisplay("dontShowLinkListBeforeTutorial") && !$this->session->isAdmin()) {
            return;
        }
        $view = new PHPBatchView("layout/sidebarBoxLinklist");
        $view->vars['links'] = null;
        $view->vars['plus'] = $this->session->hasPlus() || $this->session->isAdmin();
        $view->vars['editBlack'] = get_button_id();
        if (getDisplay("showPinnedLinkList")) {
            if(Config::getAdvancedProperty('voucherEnabled')){
                $view->vars['links'] .= '<li class="" title="' . T("LinkList", "Vouchers (GoldBank)") . '<"><a href="/voucher.php">&#9658; ' . T("LinkList", "Vouchers (GoldBank)") . '</a></li>';
            } else {
                $view->vars['links'] .= '<li class="" title="' . T("TransferGold", "title") . '<"><a href="/voucher.php?t=3">&#9658; ' . T("TransferGold", "title") . '</a></li>';
            }
            $view->vars['links'] .= '<li class="" title="' . T("LinkList", "Farmlist") . '"><a href="/build.php?tt=99&id=39">&#9658; ' . T("LinkList", "Farmlist") . '</a></li>';
            if (!$this->session->isAdmin()) {
                $view->vars['links'] .= '<li class="newTab" title="' . htmlspecialchars(T("LinkList", "Contact Support") . '<br /><span class="notice">' . T("links", "linkWillOpenInNewTab") . '</span>') . '"><a target="_blank" style="color: red; font-weight: bold" href="/messages.php?t=1&id=2"><img src="img/x.gif" alt="" /> &#9658; ' . T("LinkList", "Contact Support") . '</a></li>';
            }
        }
        if ($this->session->isAdmin()) {
            $view->vars['links'] .= '<li class="newTab" title="' . htmlspecialchars(T("LinkList",
                        "Go to admin panel") . '<br /><span class="notice">' . T("links",
                        "linkWillOpenInNewTab") . '</span>') . '"><a target="_blank" style="color: red; font-weight: bold" href="/admin.php"><img src="img/x.gif" alt="" /> &#9658; ' . T("LinkList",
                    "Go to admin panel") . '</a></li>';
        }
        if ($view->vars['plus']) {
            $memcache = Caching::getInstance();
            if (!$this->session->isAdminInAnotherAccount() && $links = $memcache->get("links_" . $this->session->getPlayerId())) {
                $view->vars['noLinks'] = $links['noLinks'];
                $view->vars['links'] = $links['links'];
            } else {
                $m = new LinksModel();
                $links = $m->getPlayerLinks($this->session->getPlayerId());
                $view->vars['noLinks'] = !$links->num_rows;
                if (!$view->vars['noLinks']) {
                    while ($row = $links->fetch_assoc()) {
                        $class = '';
                        if (substr($row['url'], -1) == '*') {
                            $class = 'newTab';
                            $row['url'] = substr($row['url'], 0, strlen($row['url']) - 1);
                        }
                        $url = $row['url'];
                        if (strpos($url, "http://") === FALSE && strpos($url, "https://") === FALSE) {
                            $url = '/' . $url;
                        }
                        $title = $url;
                        if ($class == 'newTab') {
                            $title .= '<br /><span class="notice">' . T("links", "linkWillOpenInNewTab") . "</span>";
                            $title = htmlspecialchars($title);
                        }
                        $view->vars['links'] .= '<li class="' . $class . '" title="' . $title . '"><a href="' . $url . '"' . ($class == 'newTab' ? ' target="_blank"' : '') . '>' . ($class == 'newTab' ? '<img src="img/x.gif" alt="" />' : '') . ' ' . $row['name'] . '</a></li>';
                    }
                }
                if (!$this->session->isAdmin()) {
                    $memcache->set("links_" . $this->session->getPlayerId(),
                        ['noLinks' => $view->vars['noLinks'], 'links' => $view->vars['links']],
                        86400);
                }
            }
        }
        $this->vars['sidebarBeforeContent'] .= $view->output();
    }

    private
    function renderActiveVillageBox()
    {
        $cache = Caching::getInstance();
        $kid = $this->session->getSelectedVillageID();
        if (true || !($data = $cache->get("ActiveVillageBox:{$kid}"))) {
            $data = [];
            $allowed = $this->session->hasPlus() || $this->session->isAdmin();
            $plusTitle = $allowed ? '' : T("inGame", "needPlusDesc");
            $buildingTitle = T("Buildings", "21.title");
            $existsTitle = Village::getInstance()->hasWorkshop() ? '' : '<span class="warning">' . T("inGame",
                    "noWorkShop") . '</span>';
            if (!empty($plusTitle)) {
                $existsTitle = '<br />' . $existsTitle;
            }
            $title = ($allowed ? $buildingTitle : T("inGame", "DirectLinks")) . "||" . $plusTitle . ($existsTitle);
            $data['showWorkshopToolTip'] = $allowed && Village::getInstance()->hasWorkshop();
            if ($data['showWorkshopToolTip']) {
                $title .= T("HeroGlobal", "Tooltip loading");
            }
            $data['workshopBuildingFieldId'] = Village::getInstance()->findBuildingByGid(21);
            $d = [
                "class"        => "",
                "type"         => $allowed ? 'green' : "gold",
                "loadTitle"    => FALSE,
                "boxId"        => "activeVillage",
                "disabled"     => !Village::getInstance()->hasWorkshop(),
                "speechBubble" => "",
                "plusDialog"   => $allowed ? [] : [
                    "featureKey" => "directLinks",
                    "infoIcon"   => "http://t4.answers.travian.com/index.php?aid=Travian Answers#go2answer",
                ],
                "redirectUrl"  => Village::getInstance()->hasWorkshop() ? 'build.php?id=' . $data['workshopBuildingFieldId'] : '',
            ];
            if ($allowed) {
                unset($d['plusDialog']);
            }
            $data['workshop'] = getButton([
                'id'      => $data['workshopButtonId'] = get_button_id(),
                "type"    => "button",
                "class"   => "layoutButton workshop" . ($allowed ? "White" : "Black") . " " . ($allowed ? 'green' : "gold") . (Village::getInstance()->hasWorkshop() ? '' : ' disabled'),
                "title"   => htmlspecialchars($title),
                "onclick" => "return false;",
            ],
                ["data" => $d]);
            $buildingTitle = T("Buildings", "20.title");
            $existsTitle = Village::getInstance()->hasStable() ? '' : '<span class="warning">' . T("inGame",
                    "noStable") . '</span>';
            if (!empty($plusTitle)) {
                $existsTitle = '<br />' . $existsTitle;
            }
            $title = ($allowed ? $buildingTitle : T("inGame", "DirectLinks")) . "||" . $plusTitle . ($existsTitle);
            $data['showStableToolTip'] = $allowed && Village::getInstance()->hasStable();
            if ($data['showStableToolTip']) {
                $title .= T("HeroGlobal", "Tooltip loading");
            }
            $data['stableBuildingFieldId'] = Village::getInstance()->findBuildingByGid(20);
            $d = [
                "class"        => "",
                "type"         => $allowed ? 'green' : "gold",
                "loadTitle"    => FALSE,
                "boxId"        => "activeVillage",
                "disabled"     => !Village::getInstance()->hasStable(),
                "speechBubble" => "",
                "plusDialog"   => $allowed ? [] : [
                    "featureKey" => "directLinks",
                    "infoIcon"   => "http://t4.answers.travian.com/index.php?aid=Travian Answers#go2answer",
                ],
                "redirectUrl"  => Village::getInstance()->hasStable() ? 'build.php?id=' . $data['stableBuildingFieldId'] : '',
            ];
            if ($allowed) {
                unset($d['plusDialog']);
            }
            $data['stable'] = getButton([
                'id'      => $data['stableButtonId'] = get_button_id(),
                "type"    => "button",
                "class"   => "layoutButton stable" . ($allowed ? "White" : "Black") . " " . ($allowed ? 'green' : "gold") . (Village::getInstance()->hasStable() ? '' : ' disabled'),
                "title"   => htmlspecialchars($title),
                "onclick" => "return false;",
            ],
                ["data" => $d]);
            $buildingTitle = T("Buildings", "19.title");
            $existsTitle = Village::getInstance()->hasBarracks() ? '' : '<span class="warning">' . T("inGame",
                    "noBarracks") . '</span>';
            if (!empty($plusTitle)) {
                $existsTitle = '<br />' . $existsTitle;
            }
            $title = ($allowed ? $buildingTitle : T("inGame", "DirectLinks")) . "||" . $plusTitle . ($existsTitle);
            $data['showBarracksToolTip'] = $allowed && Village::getInstance()->hasBarracks();
            if ($data['showBarracksToolTip']) {
                $title .= T("HeroGlobal", "Tooltip loading");
            }
            $data['barracksBuildingFieldId'] = Village::getInstance()->findBuildingByGid(19);
            $d = [
                "class"        => "",
                "type"         => $allowed ? 'green' : "gold",
                "loadTitle"    => FALSE,
                "boxId"        => "activeVillage",
                "disabled"     => !Village::getInstance()->hasBarracks(),
                "speechBubble" => "",
                "plusDialog"   => $allowed ? [] : [
                    "featureKey" => "directLinks",
                    "infoIcon"   => "http://t4.answers.travian.com/index.php?aid=Travian Answers#go2answer",
                ],
                "redirectUrl"  => Village::getInstance()->hasBarracks() ? 'build.php?id=' . $data['barracksBuildingFieldId'] : '',
            ];
            if ($allowed) {
                unset($d['plusDialog']);
            }
            $data['barracks'] = getButton([
                'id'      => $data['barracksButtonId'] = get_button_id(),
                "type"    => "button",
                "class"   => "layoutButton barracks" . ($allowed ? "White" : "Black") . " " . ($allowed ? 'green' : "gold") . (Village::getInstance()->hasBarracks() ? '' : ' disabled'),
                "title"   => htmlspecialchars($title),
                "onclick" => "return false;",
            ],
                ["data" => $d]);
            $buildingTitle = T("Buildings", "17.title");
            $existsTitle = Village::getInstance()->hasMarketPlace() ? '' : '<span class="warning">' . T("inGame",
                    "noMarketplace") . '</span>';
            if (!empty($plusTitle)) {
                $existsTitle = '<br />' . $existsTitle;
            }
            $title = ($allowed ? $buildingTitle : T("inGame", "DirectLinks")) . "||" . $plusTitle . ($existsTitle);
            $data['showMarketplaceToolTip'] = $allowed && Village::getInstance()->hasMarketPlace();
            if ($data['showMarketplaceToolTip']) {
                $title .= T("HeroGlobal", "Tooltip loading");
            }
            $data['marketplaceBuildingFieldId'] = Village::getInstance()->findBuildingByGid(17);
            $d = [
                "class"        => "",
                "type"         => $allowed ? 'green' : "gold",
                "loadTitle"    => FALSE,
                "boxId"        => "activeVillage",
                "disabled"     => !Village::getInstance()->hasMarketPlace(),
                "speechBubble" => "",
                "plusDialog"   => $allowed ? [] : [
                    "featureKey" => "directLinks",
                    "infoIcon"   => "http://t4.answers.travian.com/index.php?aid=Travian Answers#go2answer",
                ],
                "redirectUrl"  => Village::getInstance()->hasMarketPlace() ? 'build.php?id=' . $data['marketplaceBuildingFieldId'] : '',
            ];
            if ($allowed) {
                unset($d['plusDialog']);
            }
            $data['marketplace'] = getButton([
                'id'      => $data['marketplaceButtonId'] = get_button_id(),
                "type"    => "button",
                "class"   => "layoutButton market" . ($allowed ? "White" : "Black") . " " . ($allowed ? 'green' : "gold") . (Village::getInstance()->hasMarketPlace() ? '' : ' disabled'),
                "title"   => htmlspecialchars($title),
                "onclick" => "return false;",
            ],
                ["data" => $d]);
            $cache->add("ActiveVillageBox:{$kid}", $data, 60);
        }
        $data['villageName'] = Village::getInstance()->getName();
        $data['loyalty'] = Village::getInstance()->getLoyalty();
        $title = T("inGame", "changeVillageName");
        if ($this->session->isSitter()) {
            $title .= '<span class="warning">' . T("inGame", "sitterChangeNameDesc") . '</span>';
        }
        $merge = [];
        if (!$this->session->isSitter()) {
            $merge['villageDialog'] = [
                "title"       => $title,
                "description" => T("inGame", "newVillageName") . ":",
                "saveText"    => T("Global", "General.save"),
                "villageId"   => Village::getInstance()->getKid(),
            ];
        }
        $data['edit'] = getButton([
            "type"    => "button",
            "class"   => 'layoutButton editWhite green ' . ($this->session->isSitter() ? "disabled" : ""),
            "title"   => htmlspecialchars($title),
            "onclick" => "return false;",
        ],
            [
                "data" => array_merge([
                    "type"         => 'green',
                    "title"        => T("inGame", "DoubleClickToChangeVillageName"),
                    "loadTitle"    => FALSE,
                    "boxId"        => "activeVillage",
                    "disabled"     => TRUE,
                    "speechBubble" => "",
                ],
                    $merge),
            ]);
        $view = new PHPBatchView("layout/sidebarBoxActiveVillages");
        $this->vars['sidebarAfterContent'] .= $view->output($data);
    }

    private
    function getTotalVillagesCount()
    {
        return $this->session->get("total_villages");
    }

    private
    function renderVillagesList()
    {
        $data = [];
        $data['toggle'] = PreferencesHelper::getPreference("travian_toggle_villagelist");
        $data['buttonToggleId'] = get_button_id();
        $data['buttonDorf3Id'] = get_button_id();
        $data['villages'] = '';
        $prefix = http_build_query($this->newVillagePrefix);
        $db = DB::getInstance();
        $count = $this->session->get("total_villages");
        $currentCP = $this->session->getCP();
        $memcache = Caching::getInstance();
        $i = Formulas::countCPVillages($currentCP);
        $newVillageCP = Formulas::newVillageCP($i + 1);
        $currentMaxVillageCP = Formulas::newVillageCP($i);
        $dif = $newVillageCP - $currentMaxVillageCP;
        $reached = ($currentCP - $currentMaxVillageCP) / $dif;
        $data['percent'] = 100 * $reached;
        $data['vcount'] = $count;
        $data['total_vcount'] = $i;
        $data['currentCP'] = $currentCP - $currentMaxVillageCP;
        $data['nextCP'] = $dif;
        $session = $this->session;
        $villages = (new ProfileCache($this->session->get("profileCacheVersion")))->getProfileVillagesSortedByName($this->session->getPlayerId());
        $attacksList = [];
        if (!($attacksList = $memcache->get("attacksList:{$this->session->getPlayerId()}"))) {
            if ($this->session->getPlayerId() > 2 && ($this->session->hasPlus() || $this->session->isAdmin())) {
                $attacks = $db->query("SELECT v.kid, (SELECT COUNT(m.id) FROM movement m WHERE m.mode=0 AND m.to_kid=v.kid AND m.attack_type IN(3,4)) as `attack_count` FROM vdata v WHERE v.owner={$this->session->getPlayerId()}");
                while ($row = $attacks->fetch_assoc()) {
                    $attacksList[$row['kid']] = $row['attack_count'];
                }
                $attacks = $db->query("SELECT o.did, (SELECT COUNT(m.id) FROM movement m WHERE m.mode=0 AND m.to_kid=o.kid AND m.attack_type IN(3,4)) as `attack_count` FROM odata o WHERE o.owner={$this->session->getPlayerId()}");
                while ($row = $attacks->fetch_assoc()) {
                    if (!isset($attacksList[$row['did']]))
                        $attacksList[$row['did']] = 0;
                    $attacksList[$row['did']] += $row['attack_count'];
                }
                $memcache->add("attacksList:{$this->session->getPlayerId()}", $attacksList, 5);
            }
        }
        foreach ($villages as $row) {
            $name = $row['name'];
            $attacks = array_key_exists($row['kid'], (array)$attacksList) ? $attacksList[$row['kid']] : 0;
            $x = $y = 0;
            extract(Formulas::kid2xy($row['kid']), EXTR_IF_EXISTS);
            $title = sprintf('%s ‎<span class="coordinates coordinatesWrapper"><span class="coordinateX">(%s</span><span class="coordinatePipe">|</span><span class="coordinateY">%s)</span></span>',
                $name,
                $x,
                $y);
            $value = sprintf('‎<span class="coordinates coordinatesWrapper coordinatesAligned coordinates%s"><span class="coordinateX">(%s</span><span class="coordinatePipe">|</span><span class="coordinateY">%s)</span></span>;',
                strtolower(getDirection()),
                $x,
                $y);
            $active = $row['kid'] == $this->session->getKid() ? 'active' : '';
            $data['villages'] .= '<li class="' . $active . ($attacks ? ' attack' : '') . '" title="' . htmlspecialchars($title) . '">';
            $data['villages'] .= '<a  href="?newdid=' . $row['kid'] . (!empty($prefix) ? '&' . $prefix : '') . '" accesskey="b" class="' . $active . '">';
            $data['villages'] .= '<img src="img/x.gif" alt="" />';
            $data['villages'] .= '<div class="name">' . $name . '</div>' . $value;
            $data['villages'] .= '</a>';
            $data['villages'] .= ' </li>';
        }
        $this->vars['sidebarAfterContent'] .= PHPBatchView::render('layout/sidebarBoxVillageList', $data);
    }

    private
    function renderDailyQuest()
    {
        if (Quest::getInstance()->isTutorial() && getDisplay("hideDailyQuestWhenOnTutorial")) {
            return;
        }
        $view = new PHPBatchView("layout/sidebarBoxQuestachievements");
        $this->vars['sidebarAfterContent'] .= $view->output();
    }

    private
    function renderVotingSystem()
    {
        $voting = Config::getProperty("Voting");
        if (empty($voting->TopG->link) && empty($voting->ArenaTop100->link) && empty($voting->GTop100->link)) {
            return;
        }

        $view = new PHPBatchView("layout/Vote");
        $view->vars['maxVotesReached'] = false;
        $view->vars['totalVotes'] = Voting::getTotalVotes();
        $view->vars['maxVotesReached'] = $view->vars['totalVotes'] >= Voting::MAX_VOTES;
        $userUnique = Config::getProperty("settings", "worldUniqueId") . "_" . $this->session->getPlayerId();
        $voting_services = [];
        if (!empty($voting->TopG->link)) {
            //type 1
            $voting_services['TopG'] = [
                'link'         => $voting->TopG->link . '-' . $userUnique,
                'gold'         => $voting->TopG->gold,
                'votingLog'    => null,
                'voteInterval' => $voting->TopG->interval
            ];
        }
        if (!empty($voting->ArenaTop100->link)) {
            //type 2
            $voting_services['ArenaTop100'] = [
                'link'         => $voting->ArenaTop100->link . '&id=' . $userUnique,
                'gold'         => $voting->ArenaTop100->gold,
                'votingLog'    => null,
                'voteInterval' => $voting->ArenaTop100->interval
            ];
        }
        if (!empty($voting->GTop100->link)) {
            //type 3
            $voting_services['GTop100'] = [
                'link'         => $voting->GTop100->link . '&pingUsername=' . $userUnique,
                'gold'         => $voting->GTop100->gold,
                'votingLog'    => null,
                'voteInterval' => $voting->GTop100->interval
            ];
        }
        $votes = Voting::getVotes();
        while ($row = $votes->fetch_assoc()) {
            $type = [1 => 'TopG', 2 => 'ArenaTop100', 3 => 'GTop100'][$row['type']];
            $voting_services[$type]['votingLog'] = $row;
        }
        $view->vars['voting_services'] = $voting_services;
        $this->vars['sidebarAfterContent'] .= $view->output();
    }

    private
    function renderQuest()
    {
        $quest = Quest::getInstance();
        if ($quest->isFullyCompleted()) {
            return;
        }
        $view = new PHPBatchView("layout/sidebarBoxQuestmaster");
        $view->vars['data'] = $quest->getQuestData();
        $view->vars['isTutorial'] = $quest->isTutorial();
        $view->vars['hasNewReward'] = $quest->hasNewReward();
        if ($quest->isTutorial()) {
            $view->vars['tutorialSection'] = $view->vars['data']['tutorialData']['id'];
        } else {
            if ($view->vars['data']['battle']['questsCompleted'] == $view->vars['data']['battle']['questsTotal'] && $view->vars['data']['economy']['questsCompleted'] == $view->vars['data']['economy']['questsTotal'] && $view->vars['data']['world']['questsCompleted'] == $view->vars['data']['world']['questsTotal']) {
                $quest->setTutorial('-1');
                return;
            }
        }
        $this->vars['sidebarAfterContent'] .= $view->output();
    }
}