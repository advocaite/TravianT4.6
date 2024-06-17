<?php

namespace Controller;

use Controller\Ajax\heroAuction;
use Core\Config;
use Core\Database\DB;
use Core\Helper\PageNavigator;
use Core\Helper\TimezoneHelper;
use Core\Helper\WebService;
use Core\Session;
use Game\Hero\HeroItems;
use Game\Hero\SessionHero;
use function getDisplay;
use Model\AllianceModel;
use Model\AuctionModel;
use Model\AutomationModel;
use Model\OptionModel;
use Model\Quest;
use function number_format_x;
use resources\View\GameView;
use resources\View\PHPBatchView;

class HeroAuctionCtrl extends GameCtrl
{
    private $justContent        = false;
    private $filterOnlyForAdmin = false;
    private $lastChecker        = null;
    private $spreadRandom       = false;

    public function __construct($justContent = false)
    {
        parent::__construct();
        $this->spreadRandom = Config::getInstance()->auction->fakeAuction->SpreadOutRandomlyBetweenPlayers;
        $this->lastChecker = Session::getInstance()->getChecker();
        $this->justContent = $justContent;
        $this->view = new GameView();
        $this->view->vars['titleInHeader'] = '';
        $this->view->vars['bodyCssClass'] = 'perspectiveBuildings';
        $this->view->vars['contentCssClass'] = 'hero hero_auction';
        $session = Session::getInstance();
        $m = new OptionModel();
        if ($session->isSitter()) {
            $this->view->vars['content'] .= T("Auction", "sitterError");
            return;
        } else if ($m->isDeletion($session->getPlayerId())) {
            $this->view->vars['content'] .= T("Auction", "deletionError");
            return;
        } else if ($session->banned() && $session->getPlayerId() > 2 && !$session->isAdminInAnotherAccount()) {
            $this->innerRedirect("InGameBannedPage");
        }
        $this->view->vars['titleInHeader'] = Session::getInstance()->getName() . ' - ' . T("Buildings", "level") . ' ';
        $this->view->vars['titleInHeader'] .= $this->session->hero->getLevel();
        $canTakePlaceInAuction = Session::getInstance()->getSuccessAdventuresCount() >= 10;
        if (!$this->justContent) {
            $view = new PHPBatchView("hero/menus");
            $view->vars['selectedTab'] = 4;
            $view->vars['favorText'] = sprintf(T("Global", "Select tab %s as favourite"), T("HeroGlobal", "Auctions"));
            $this->view->vars['content'] = $view->output();
            if ($canTakePlaceInAuction) {
                $view = new PHPBatchView("hero/silverExchange");
                $view->vars['gold'] = $session->getAvailableGold();
                $view->vars['silver'] = $session->getAvailableSilver();
                $view->vars['SilverToGold'] = get_button_id();
                $view->vars['GoldToSilver'] = get_button_id();
                $view->vars['GoldToSilver2'] = get_button_id();
                $this->view->vars['content'] .= $view->output();
                //exchange here.
            }
        }
        $action = !isset($_REQUEST['action']) || !in_array($_REQUEST['action'],
            ['buy', 'sell', 'bids', 'accounting',]) ? 'buy' : filter_var($_REQUEST['action'], FILTER_SANITIZE_STRING);
        //adding menus.
        $view = new PHPBatchView("hero/AuctionMenu");
        $view->vars['action'] = $action;
        if (!$this->justContent) {
            $this->view->vars['content'] .= $view->output();
            $this->view->vars['content'] .= '<div id="auction">';
        }
        if ($action == 'buy') {
            $this->buy($canTakePlaceInAuction);
        } else if ($action == 'sell') {
            $this->sell($canTakePlaceInAuction);
        } else if ($action == 'bids') {
            $this->bids($canTakePlaceInAuction);
        } else if ($action == 'accounting') {
            $this->accounting();
        }
        if (!$this->justContent) {
            $this->view->vars['content'] .= '</div>';
        }
    }

    private function buy($canTakePlaceInAuction)
    {
        $session = Session::getInstance();
        $m = new AuctionModel();
        $view = new PHPBatchView("hero/AuctionBuy");
        $view->vars['isAdmin'] = $session->isAdmin();
        $this->processBuy($canTakePlaceInAuction);
        $filter = $this->showFilters($canTakePlaceInAuction, 'buy');
        $view->vars['results'] = '';
        $page = isset($_REQUEST['page']) ? abs((int)$_REQUEST['page']) : 1;
        if ($page < 0) {
            $page = 1;
        }
        $total = $m->getTotalBuyAuction($session->isAdmin() && $this->filterOnlyForAdmin ? 0 : $session->getPlayerId(),
            $filter);
        $result = $m->getBuyAuction($session->isAdmin() && $this->filterOnlyForAdmin ? 0 : $session->getPlayerId(),
            $page,
            20,
            $filter);
        $current_silver = $session->getAvailableSilver();
        while ($row = $result->fetch_assoc()) {
            $view->vars['results'] .= $this->renderAuction($canTakePlaceInAuction,
                $row,
                $current_silver,
                $page,
                $filter,
                FALSE);
        }
        $result->free();
        $p = new PageNavigator($page, $total, 20, ['t' => 4, 'filter' => $filter], "hero.php");
        $view->vars['nav'] = $p->get();
        if (!$total) {
            $view->vars['results'] = '<tr><td colspan="' . ($this->isAdmin ? 8 : 6) . '" class="noData">' . T("Auction",
                    "noAuction") . '</td></tr>';
        }
        $this->view->vars['content'] .= $view->output();
    }

    private function processBuy($canTakePlaceInAuction)
    {
        if ($this->spreadRandom) {
            return;
        }
        $session = Session::getInstance();
        $current_silver = $session->getAvailableSilver();
        $m = new AuctionModel();
        $db = DB::getInstance();
        if ($canTakePlaceInAuction && WebService::isPost() && isset($_REQUEST['a']) && isset($_REQUEST['z']) && $_REQUEST['z'] == $session->getChecker()) {
            $session->changeChecker();
            if (Config::getInstance()->dynamic->serverFinished) {
                $this->innerRedirect("InGameWinnerPage");
            } elseif ($session->banned() && $session->getPlayerId() > 2) {
                $this->innerRedirect("InGameBannedPage");
            } else if ($session->isInVacationMode()) {
                $this->redirect("options.php?s=4");
            }
            $auction = $_REQUEST['action'] == 'bids' ? $m->getAuction($_REQUEST['a']) : $m->getAuctionBySecureId($_REQUEST['a']);
            if ($auction === FALSE || $auction['uid'] == $session->getPlayerId()) {
                $this->view->vars['content'] .= '<div class="error">' . T("Auction", "AuctionNotFound") . '</div>';
            } else if ($auction['finish'] || $auction['time'] < time()) {
                $this->view->vars['content'] .= '<div class="error">' . T("Auction", "AuctionFinished") . '</div>';
            } else {
                $quest = Quest::getInstance();
                $quest->setQuestBitwise("battle", 9, 1);
                if ($auction['activeUid'] == 0 || $auction['activeUid'] == $session->getPlayerId()) {
                    $min = $auction['silver'];
                } else {
                    $min = $auction['silver'] + 1;
                }
                $max = $auction['activeUid'] == $session->getPlayerId() ? $auction['silver'] : max($auction['maxSilver'], $auction['silver']);
                $bidSilver = abs((int)$_REQUEST['maxBid']);
                if ($current_silver < $bidSilver && $auction['activeUid'] != $session->getPlayerId()) {
                    $this->view->vars['content'] .= '<div class="error">' . T("Auction", "notEnoughSilver") . '</div>';
                } else if (($current_silver + $auction['silver']) < $bidSilver) {
                    $this->view->vars['content'] .= '<div class="error">' . T("Auction", "notEnoughSilver") . '</div>';
                } else if ($bidSilver < $min) {
                    $this->view->vars['content'] .= '<div class="error">' . sprintf(T("Auction", "notEnoughSilverAuctionError"), $min) . '</div>';
                } else if ($bidSilver < $max && $auction['activeUid'] != $session->getPlayerId()) {
                    if ($m->modifyAuction($auction['id'], $auction['activeId'], $auction['activeUid'], $bidSilver, $max, $auction['time'])) {
                        $m->setAsOutBid($m->addBid($session->getPlayerId(), $auction['id']));
                    }
                } else {
                    $activeId = $auction['activeId'];
                    if ($auction['activeUid'] <> $session->getPlayerId()) {
                        $auction['activeId'] = $m->addBid($session->getPlayerId(), $auction['id']);
                    }
                    $auctionLeft = $auction['time'] - time();
                    if ($auction['activeId'] == 0) {
                        $m->modifyAuction($auction['id'], $auction['activeId'], $session->getPlayerId(), $auction['silver'], $bidSilver, ($auctionLeft < 300 ? time() + 300 : $auction['time']));
                    } else {
                        $bidder = $db->query("SELECT * FROM bids WHERE id=$activeId")->fetch_assoc();
                        if ($bidder['uid'] == $session->getPlayerId()) {
                            $m->modifyAuction($auction['id'], $auction['activeId'], $session->getPlayerId(), $auction['silver'], $bidSilver, $auction['time'], FALSE);
                        } else {
                            if ($m->modifyAuction($auction['id'], $auction['activeId'], $session->getPlayerId(), $max, $bidSilver, ($auctionLeft < 300 ? time() + 300 : $auction['time']))) {
                                $m->setAsOutBid($activeId);
                            }
                        }
                    }
                }
            }
        }
    }

    private function showFilters($canTakePlaceInAuction, $action)
    {
        $session = Session::getInstance();
        if (!$canTakePlaceInAuction) {
            $this->view->vars['content'] .= '<div class="auctionAdventureBarText">' . T("Auction",
                    "Finish 10 adventures to unlock the auctions!") . '</div>';
            $this->view->vars['content'] .= '<div class="auctionAdventureBarNumbers">(' . $session->getSuccessAdventuresCount() . '/10)</div>';
            $this->view->vars['content'] .= '<div class="clear"></div>';
            $this->view->vars['content'] .= '<div class="auctionAdventureBar"><div class="bar" style="width:' . ($session->getSuccessAdventuresCount() * 10) . '%;"></div></div>';
        }
        $filter = 0;
        if (isset($_REQUEST['filter']) && $_REQUEST['filter'] >= 1 && $_REQUEST['filter'] <= 15) {
            $filter = (int)$_REQUEST['filter'];
        }
        $view = new PHPBatchView("hero/AuctionFilter");
        $view->vars['action'] = $action;
        $view->vars['filter'] = $filter - 1;
        $view->vars['currentSilver'] = $session->getSilver();
        $view->vars['availableSilver'] = $session->getAvailableSilver();
        $this->view->vars['content'] .= $view->output();
        return $filter;
    }

    private function renderAuction($canTakePlaceInAuction, $row, $current_silver, $page, $filter, $isEdit = FALSE)
    {
        $template = '';
        $typeArray = [
            1 => 'helmet',
            'body',
            'leftHand',
            'rightHand',
            'shoes',
            'horse',
            'bandage25',
            'bandage33',
            'cage',
            'scroll',
            'ointment',
            'bucketOfWater',
            'bookOfWisdom',
            'lawTables',
            'artWork',
        ];
        $session = Session::getInstance();
        $db = DB::getInstance();
        $heroItems = new HeroItems();
        $item = $heroItems->getHeroItemProperties($row['btype'], $row['type']);
        $bids = $row['bids'];
        $silver = $row['silver'];
        $isActive = !$this->spreadRandom && $canTakePlaceInAuction &&
            isset($_REQUEST['a']) &&
            $_REQUEST['a'] == (
            $isEdit ||
            (isset($_REQUEST['action']) && $_REQUEST['action'] == 'bids')
                ? $row['auctionId'] : $row['secure_id']) &&
            isset($_REQUEST['z']) && $_REQUEST['z'] == $this->lastChecker
            &&
            ($current_silver >= $silver || $row['activeUid'] == $session->getPlayerId());
        $template .= '<tr>';
        if ($isEdit) {
            $template .= '<td class="delete">';
            if ($row['outbid']) {
                $template .= '<a href="hero.php?t=4&action=bids&amp;deleteRunning=' . $row['auctionId'] . '"><img alt="delete" src="img/x.gif" class="del"></a>';
            }
            $template .= '</td>';
        }
        $hasActiveBid = FALSE;
        if (!$isEdit) {
            $hasActiveBid = (new AuctionModel())->hasBidInAuction($row['id'], $session->getPlayerId());
        }
        $template .= '<td class="icon' . ($isActive ? ' selected' : '') . '" title="' . ($item['name'] . '||' . $item['title']) . '"><img class="itemCategory itemCategory_' . $typeArray[$row['btype']] . '" src="img/x.gif"></td>';
        $template .= '<td class="name' . ($isActive ? ' selected' : '') . '">' . number_format_x($row['num']) . 'x ' . ($item['name']) . '</td>';
        if ($this->isAdmin) {
            $template .= '<td class="silver ' . ($isActive ? ' selected' : '') . '"><a href="spieler.php?uid=' . $row['uid'] . '">' . ($db->fetchScalar("SELECT name FROM users WHERE id=" . ($row['uid']))) . '</a></td>';
            if ($row['activeUid']) {
                $template .= '<td class="silver ' . ($isActive ? ' selected' : '') . '"><a href="spieler.php?uid=' . $row['activeUid'] . '">' . ($db->fetchScalar("SELECT name FROM users WHERE id=" . ($row['activeUid']))) . '</a></td>';
            } else {
                $template .= '<td class="silver ' . ($isActive ? ' selected' : '') . '">-</td>';
            }
        }
        $template .= '<td class="bids' . ($isActive ? ' selected ' : ' ') . ($bids == 0 ? ' zero' : '') . 'Bids">' . $bids . '</td>';
        $template .= '<td class="silver' . ($isActive ? ' selected' : '') . '" title="' . (sprintf(T("Auction",
                "x unit perItem"),
                round($silver / $row['num'],
                    getDisplay("auctionPricePerItemFloatingPoints")))) . '">' . number_format_x($silver) . '</td>';
        $template .= '<td class="time' . ($isActive ? ' selected' : '') . '">' . appendTimer($row['time'] - time()) . '</td>';
        $template .= '<td class="' . ($current_silver < $silver && ($row['activeUid']) <> $session->getPlayerId() ? 'notEnoughSilver' : 'bid' . ($isActive ? ' selected' : '') . '') . '">';
        if ($this->spreadRandom) {
            $template .= '<a class="bidButton openedClosedSwitch switchDisabled"><span class="errorMessage">' . ($isEdit ? T("Auction",
                    "doBid") : T("Auction", "Change")) . '</span></a>';
        } else if ($current_silver >= $silver || $row['activeUid'] == $session->getPlayerId()) {
            if (!$canTakePlaceInAuction) {
                $template .= '<a class="bidButton openedClosedSwitch switchDisabled" title="' . T("Auction",
                        "10AdventuresError") . '"><span class="errorMessage">' . ($isEdit ? T("Auction", "doBid") : T("Auction",
                        "Change")) . '</span></a>';
            } else {
                if (!$isActive) {
                    $template .= '<a class="bidButton openedClosedSwitch switch' . ($isActive ? 'Opened' : 'Closed') . '" href="hero.php?t=4&action=' . ($isEdit ? 'bids' : 'buy') . '&a=' . ($isEdit ? $row['auctionId'] : $row['secure_id']) . '&z=' . $session->getChecker() . '&page=' . $page . '&filter=' . $filter . '">' . (($isEdit && !$row['outbid']) || $hasActiveBid ? T("Auction",
                            "Change") : T("Auction", "doBid")) . '</a>';
                } else {
                    $template .= '<a class="bidButton openedClosedSwitch switch' . ($isActive ? 'Opened' : 'Closed') . '" href="hero.php?t=4&action=' . ($isEdit ? 'bids' : 'buy') . '&page=' . $page . '&filter=' . $filter . '">' . (($isEdit && !$row['outbid']) || $hasActiveBid ? T("Auction",
                            "Change") : T("Auction", "doBid")) . '</a>';
                }
            }
        } else {
            $template .= T("Auction", "notEnoughSilver");
        }
        $template .= '</td>';
        $template .= '</tr>';
        if ($isActive) {
            $template .= '<tr><td class="icon selected"></td><td colspan="' . (($isEdit ? 6 : 5) + ($this->isAdmin ? 2 : 0)) . '" class="name selected detail">';
            if ($bids == 0 || ($row['activeId']) == 0) {
                $max = $row['silver'];
            } else {
                $max = $db->query("SELECT * FROM bids WHERE id=" . ($row['activeId']))->fetch_assoc();
            }
            $template .= '<form class="auctionDetails" id="auctionDetails' . ($row['secure_id']) . '" action="hero.php?t=4" method="POST">';
            $template .= '<input type="hidden" name="page" value="' . $page . '">';
            if ($filter > 0) {
                $template .= '<input type="hidden" name="filter" value="' . $filter . '">';
            }
            $template .= '<input type="hidden" name="action" value="' . ($isEdit ? 'bids' : 'buy') . '">';
            $template .= '<input type="hidden" name="z" value="' . $session->getChecker() . '">';
            $template .= '<input type="hidden" name="silver" value="' . $silver . '">';
            $template .= '<input type="hidden" name="a" value="' . ($isEdit ? $row['auctionId'] : $row['secure_id']) . '">';
            $template .= T("Auction", "currentBid") . ': <span><img title="' . T("Auction",
                    "silver") . '" class="silver" src="img/x.gif"> ' . $silver . '</span>';
            $template .= '<br />' . T("Auction", "currentBidder") . ': ';
            if (is_array($max)) {
                $player = $db->query("SELECT aid, name FROM users WHERE id=" . ($row['activeUid']))->fetch_assoc();
                $template .= '<a href="spieler.php?uid=' . $row['activeUid'] . '">' . $player['name'] . '</a>';
                if ($player['aid']) {
                    $template .= '<a href="allianz.php?aid=' . $player['aid'] . '">' . sprintf('(%s)',
                            (new AllianceModel())->getAllianceField($player['aid'], 'tag')) . '</a>';
                }
            }
            if (is_array($max) && $max['uid'] == $session->getPlayerId()) {
                $bidvalue = $row['maxSilver'];
            } else {
                $bidvalue = '';
            }
            $template .= "<span></span><br>" . (($isEdit && !$row['outbid']) ? T("Auction", "Change") : T("Auction",
                    "doBid")) . ":<input class=\"maxBid text\" type=\"text\" name=\"maxBid\" value=\"" . $bidvalue . "\">";
            $template .= "<span> (" . T("Auction", "min") . ": <img title=\"" . T("Auction",
                    "silver") . "\" class=\"silver\" src=\"img/x.gif\"> ";
            if ($bids == 0 || ($row['activeId']) == 0 || is_array($max) && $max['uid'] == $session->getPlayerId()) {
                $template .= number_format_x($silver);
            } else {
                $template .= number_format_x($silver + 1);
            }
            $template .= ')</span>';
            $template .= '<div class="submitBid"><button type="submit" value="' . (($isEdit && !$row['outbid']) ? T("Auction",
                    "Change") : T("Auction",
                    "doBid")) . '" class="green "><div class="button-container addHoverClick "><div class="button-background"><div class="buttonStart"><div class="buttonEnd"><div class="buttonMiddle"></div></div></div></div><div class="button-content">' . ($isEdit ? T("Auction",
                    "Change") : T("Auction", "doBid")) . '</div></div></button></div></div>';
            $template .= '</form>';
        }
        $template .= '</td></tr>';
        return $template;
    }

    private function sell($canTakePlaceInAuction)
    {
        //TODO: sellHorse.
        $session = Session::getInstance();
        if (!$canTakePlaceInAuction) {
            $this->view->vars['content'] .= '<div class="auctionAdventureBarText">' . T("Auction",
                    "Finish 10 adventures to unlock the auctions!") . '</div>';
            $this->view->vars['content'] .= '<div class="auctionAdventureBarNumbers">(' . $session->getSuccessAdventuresCount() . '/10)</div>';
            $this->view->vars['content'] .= '<div class="clear"></div>';
            $this->view->vars['content'] .= '<div class="auctionAdventureBar"><div class="bar" style="width:' . ($session->getSuccessAdventuresCount() * 10) . '%;"></div></div>';
        }
        $maxAuctions = 5;
        $m = new AuctionModel();
        $db = DB::getInstance();
        if ($canTakePlaceInAuction && isset($_GET['abort'])) {
            if (Config::getInstance()->dynamic->serverFinished) {
                $this->innerRedirect("InGameWinnerPage");
            } elseif ($session->banned()) {
                $this->innerRedirect("InGameBannedPage");
            } else if ($session->isInVacationMode()) {
                $this->redirect("options.php?s=4");
            }
            $abort = (int)$_GET['abort'];
            $auction = $m->getAuction($abort);
            if ($auction !== FALSE && $auction['uid'] == $session->getPlayerId() && $auction['bids'] == 0 && $auction['finish'] == 0 && $auction['time'] >= time()) {
                if ($m->cancelAuction($abort)) {
                    $m->addItemToUser($session->getPlayerId(), $auction['btype'], $auction['type'], $auction['num']);
                }
            }
        } else if ($canTakePlaceInAuction && isset($_REQUEST['id']) && isset($_REQUEST['a']) && $_REQUEST['a'] == $session->getChecker() && isset($_REQUEST['amount']) && $_REQUEST['amount'] > 0) {
            if (Config::getInstance()->dynamic->serverFinished) {
                $this->innerRedirect("InGameWinnerPage");
            } elseif ($session->banned()) {
                $this->innerRedirect("InGameBannedPage");
            } else if ($session->isInVacationMode()) {
                $this->redirect("options.php?s=4");
            }
            if ($m->getMyRunningAuctionsCount($session->getPlayerId()) < $maxAuctions) {
                $item = $db->query("SELECT * FROM items WHERE id=" . (int)$_REQUEST['id']);
                if ($item->num_rows) {
                    $item = $item->fetch_assoc();
                    $amount = abs((int)$_REQUEST['amount']);
                    if ($amount > $item['num']) {
                        $amount = $item['num'];
                    }
                    $amounts = heroAuction::getPackagesForItemTypeId($item['type']);
                    $find = FALSE;
                    for ($i = 0; $i <= sizeof($amounts) - 1; ++$i) {
                        if ($amounts[$i] == $amount) {
                            $find = $amounts[$i];
                            break;
                        }
                    }
                    if ($find !== FALSE) {
                        $quest = Quest::getInstance();
                        $quest->setQuestBitwise("battle", 9, 1);
                        if ($m->getItemFromUser($item['id'], $item['num'], $find)) {
                            $m->addAuction(false,
                                $session->getPlayerId(),
                                $item['btype'],
                                $item['type'],
                                $find,
                                time() + Config::getInstance()->auction->auctionTime);
                        }
                    }
                }
            }
        }
        $typeArray = [
            1 => 'helmet',
            'body',
            'leftHand',
            'rightHand',
            'shoes',
            'horse',
            'bandage25',
            'bandage33',
            'cage',
            'scroll',
            'ointment',
            'bucketOfWater',
            'bookOfWisdom',
            'lawTables',
            'artWork',
        ];
        $view = new PHPBatchView("hero/AuctionSell");
        $view->vars['currentSilver'] = $session->getSilver();
        $view->vars['availableSilver'] = $session->getAvailableSilver();
        $view->vars['spacer'] = sprintf(T("Auction", "Choose an item to sell An auction can last up to x hours"),
            round(Config::getInstance()->auction->auctionTime / 3600, 1));
        $view->vars['noMoreAuctions'] = sprintf(T("Auction", "You can only have x auctions at a time"), $maxAuctions);
        $view->vars['auctions'] = '';
        $view->vars['checker'] = $session->getChecker();
        $view->vars['itemsToSale'] = '';
        $view->vars['ajaxItemsToSale'] = '';
        $heroItems = new HeroItems();
        $result = $m->getAvailableItemsToSell($session->getPlayerId());
        $gender = $m->getHeroGender($session->getPlayerId());
        while ($row = $result->fetch_assoc()) {
            $item = $heroItems->getHeroItemProperties($row['btype'], $row['type']);
            $view->vars['itemsToSale'] .= '<div class="" id="item_' . $row['id'] . '" title="' . ($item['name'] . '||' . $item['title']) . '">
                    <div class="itemInInventory item ' . $gender . '_item_' . $row['type'] . ' inventory">
                        <div class="amount">' . number_format_x($row['num']) . '</div>
                    </div>
                </div>';
            $view->vars['ajaxItemsToSale'] .= "\t\t" . 'jQuery(\'#item_' . $row['id'] . '\').on(\'click\', function() { $this.sellItem(jQuery(this).find(\'.item\'), ' . $row['id'] . ' ,' . $row['type'] . ',' . $row['num'] . '); });' . "\n";
        }
        $running = $m->getMyRunningAuctions($session->getPlayerId());
        if ($running->num_rows == 0) {
            $view->vars['auctions'] = '<tr><td colspan="6" class="noData">' . T("Auction", "noAuction") . '</td></tr>';
        } else {
            while ($row = $running->fetch_assoc()) {
                $item = $heroItems->getHeroItemProperties($row['btype'], $row['type']);
                $view->vars['auctions'] .= '<tr>';
                $view->vars['auctions'] .= '<td class="delete">';
                if ($row['bids'] == 0) {
                    $view->vars['auctions'] .= '<a href="hero.php?t=4&action=sell&amp;abort=' . $row['id'] . '"><img alt="delete" src="img/x.gif" class="del"></a>';
                }
                $view->vars['auctions'] .= '</td>';
                $view->vars['auctions'] .= '<td class="icon"><img class="itemCategory itemCategory_' . $typeArray[$row['btype']] . '" src="img/x.gif" title="' . ($item['name'] . '||' . $item['title']) . '" alt="' . ($item['name'] . '<br />' . $item['title']) . '"></td>';
                $view->vars['auctions'] .= '<td class="name">‎' . number_format_x($row['num']) . 'x ' . $item['name'] . '</td>';
                $view->vars['auctions'] .= '<td class="bids">';
                if (true || $row['bids'] == 0) {
                    $view->vars['auctions'] .= '?';
                } else {
                    $view->vars['auctions'] .= $row['bids'];
                }
                $view->vars['auctions'] .= '</td>';
                $view->vars['auctions'] .= '<td class="silver">';
                if (true || $row['bids'] == 0) {
                    $view->vars['auctions'] .= '?';
                } else {
                    $view->vars['auctions'] .= number_format_x($row['silver']);
                }
                $view->vars['auctions'] .= '</td>';
                $view->vars['auctions'] .= '<td class="time">';
                if (true || $row['bids'] == 0) {
                    $view->vars['auctions'] .= T("Auction", "running");
                } else {
                    $view->vars['auctions'] .= secondsToString($row['time'] - time());
                }
                $view->vars['auctions'] .= '</td>';
                $view->vars['auctions'] .= '</tr>';
            }
        }
        $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        if ($page < 1) {
            $page = 1;
        }
        $view->vars['finished'] = '';
        $finished = $m->getMyFinishedAuctions($session->getPlayerId(), $page, $maxAuctions);
        while ($row = $finished->fetch_assoc()) {
            $item = $heroItems->getHeroItemProperties($row['btype'], $row['type']);
            $admin_details = '';
            if ($session->isAdmin() && $row['activeUid'] > 0) {
                $admin_details .= '<a href="spieler.php?uid=' . $row['activeUid'] . '">' . AutomationModel::getPlayerName($row['activeUid']) . '</a>';
            }
            $view->vars['finished'] .= '<tr>';
            $view->vars['finished'] .= '<td class="icon"><img class="itemCategory itemCategory_' . $typeArray[$row['btype']] . '" src="img/x.gif" title="' . ($item['name'] . '||' . $item['title']) . '" alt="' . ($item['name'] . '<br />' . $item['title']) . '"></td>';
            $view->vars['finished'] .= '<td class="name">‎' . number_format_x($row['num']) . 'x ' . $item['name'] . ' ' . $admin_details . '</td>';
            $view->vars['finished'] .= '<td class="bids">';
            if ($row['cancel'] == 1) {
                $view->vars['finished'] .= '?';
            } else {
                $view->vars['finished'] .= $row['bids'];
            }
            $view->vars['finished'] .= '</td>';
            $view->vars['finished'] .= '<td class="silver">';
            if ($row['cancel'] == 1) {
                $view->vars['finished'] .= '?';
            } else {
                $view->vars['finished'] .= number_format_x($row['silver']);
            }
            $view->vars['finished'] .= '</td>';
            $view->vars['finished'] .= '<td class="time">';
            if ($row['cancel'] == 1) {
                $view->vars['finished'] .= T("Auction", "cancelled");
            } else {
                $view->vars['finished'] .= T("Auction", "finished");
            }
            $view->vars['finished'] .= '</td>';
            $view->vars['finished'] .= '</tr>';
        }
        $prefix['action'] = 'sell';
        $prefix['t'] = 4;
        $p = new PageNavigator($page,
            $m->getMyFinishedAuctionsCount($session->getPlayerId()),
            $maxAuctions,
            $prefix,
            "hero.php");
        $view->vars['nav'] = $p->get();
        $this->view->vars['content'] .= $view->output();
    }

    private function bids($canTakePlaceInAuction)
    {
        $typeArray = [
            1 => 'helmet',
            'body',
            'leftHand',
            'rightHand',
            'shoes',
            'horse',
            'bandage25',
            'bandage33',
            'cage',
            'scroll',
            'ointment',
            'bucketOfWater',
            'bookOfWisdom',
            'lawTables',
            'artWork',
        ];
        $filter = $this->showFilters($canTakePlaceInAuction, 'bids');
        $view = new PHPBatchView("hero/AuctionBids");
        $view->vars['currentBid'] = '';
        $view->vars['finished'] = '';
        $view->vars['nav'] = '';
        $view->vars['isAdmin'] = $this->isAdmin;
        $session = Session::getInstance();
        $m = new AuctionModel();
        $heroItems = new HeroItems();
        $current_silver = $session->getAvailableSilver();
        if (isset($_GET['deleteRunning']) && is_numeric($_GET['deleteRunning'])) {
            $db = DB::getInstance();
            $deleteRunning = (int)$_GET['deleteRunning'];
            $db->query("DELETE FROM bids WHERE auctionId={$deleteRunning} AND outbid=1 AND uid=" . Session::getInstance()->getPlayerId());
        }
        $this->processBuy($canTakePlaceInAuction);
        $running = $m->getMyRunningBids($session->getPlayerId(), $filter);
        if (!$running->num_rows) {
            $view->vars['currentBid'] = '<tr><td colspan="' . ($view->vars['isAdmin'] ? 9 : 7) . '" class="noData">' . T("Auction",
                    "noAuction") . '</td></tr>';
        } else {
            while ($row = $running->fetch_assoc()) {
                $view->vars['currentBid'] .= $this->renderAuction($canTakePlaceInAuction,
                    $row,
                    $current_silver,
                    1,
                    $filter,
                    TRUE);
            }
        }
        $page = isset($_REQUEST['page']) ? (int)$_REQUEST['page'] : 1;
        if ($page < 1) {
            $page = 1;
        }
        if (isset($_REQUEST['delete']) && is_array($_REQUEST['delete'])) {
            foreach ($_REQUEST['delete'] as $del) {
                $m->deleteBid($session->getPlayerId(), (int)$del);
            }
        }
        $finished = $m->getMyFinishedBids($session->getPlayerId(), $filter, $page, 20);
        if (!$finished->num_rows) {
            $view->vars['finished'] .= '<tr><td colspan="7" class="noData">' . T("Auction", "noAuction") . '</td></tr>';
        } else {
            while ($row = $finished->fetch_assoc()) {
                $item = $heroItems->getHeroItemProperties($row['btype'], $row['type']);
                $view->vars['finished'] .= '<tr>';
                $view->vars['finished'] .= '<td class="delete"><input type="checkbox" name="delete[]" value="' . $row['id'] . '" class="check" /></td>';
                $view->vars['finished'] .= '<td class="icon"><img class="itemCategory itemCategory_' . $typeArray[$row['btype']] . '" src="img/x.gif" title="' . ($item['name'] . '||' . $item['title']) . '" alt="' . ($item['name'] . '<br />' . $item['title']) . '"></td>';
                $view->vars['finished'] .= '<td class="name">‎' . number_format_x($row['num']) . 'x ' . $item['name'] . '</td>';
                $view->vars['finished'] .= '<td class="bids">' . $row['bids'] . '</td>';
                $view->vars['finished'] .= '<td class="silver">' . number_format_x($row['silver']) . '</td>';
                $view->vars['finished'] .= '<td class="time">' . T("Auction", "finished") . '</td>';
                $view->vars['finished'] .= '<td class="bid ' . ($row['outbid'] ? 'outbid' : 'win') . '">' . ($row['outbid'] ? T("Auction","outbid") : T("Auction", "won")) . '</td>';
                $view->vars['finished'] .= '</tr>';
            }
        }
        $view->vars['filter'] = $filter;
        $view->vars['page'] = $page;
        $prefix['action'] = 'bids';
        $prefix['t'] = 4;
        $prefix['filter'] = $filter;
        $p = new PageNavigator($page, $m->getMyFinishedBidsCount($session->getPlayerId(), $filter), 20, $prefix, 'hero.php');
        $view->vars['nav'] = $p->get();
        $this->view->vars['content'] .= $view->output();
    }

    private function accounting()
    {
        $view = new PHPBatchView("hero/accounting");
        $m = new AuctionModel();
        $booking = $m->getMyBookings(Session::getInstance()->getPlayerId());
        $view->vars['latestBookings'] = '';
        $heroItems = new HeroItems();
        if (!$booking->num_rows) {
            $view->vars['latestBookings'] = '<tr><td colspan="4" class="noData">' . T("Auction",
                    "noBooking") . '</td></tr>';
        } else {
            while ($row = $booking->fetch_assoc()) {
                $view->vars['latestBookings'] .= '<tr>';
                $view->vars['latestBookings'] .= '<td class="date">' . TimezoneHelper::autoDate($row['time']) . '</td>';
                $view->vars['latestBookings'] .= '<td class="cause">';
                if ($row['cause'] === '1') {
                    $view->vars['latestBookings'] .= T("Auction", "Adventure");
                } else {
                    $cause = explode(",", $row['cause']);
                    $item = $heroItems->getHeroItemProperties($cause[1], $cause[2]);
                    if ($cause[0] == 1) {
                        $view->vars['latestBookings'] .= sprintf(T("Auction", "sell x items of y"),
                            $cause[3],
                            $item['name']);
                    } else {
                        $view->vars['latestBookings'] .= sprintf(T("Auction", "buy x items of y"),
                            $cause[3],
                            $item['name']);
                    }
                }
                $view->vars['latestBookings'] .= '</td>';
                $view->vars['latestBookings'] .= '<td class="accounting">' . $row['reserve'] . '</td>';
                $view->vars['latestBookings'] .= '<td class="balance">' . $row['balance'] . '</td>';
                $view->vars['latestBookings'] .= '</tr>';
            }
        }
        $this->view->vars['content'] .= $view->output();
    }

    public function returnContent()
    {
        return $this->view->vars['content'];
    }
}