<?php

namespace Controller\RallyPoint;

use Core\Config;
use Core\FarmlistTracker;
use Core\Helper\TimezoneHelper;
use Core\Helper\WebService;
use Core\Session;
use Game\ExtraModules;
use Game\Formulas;
use Game\SpeedCalculator;
use function miliseconds;
use Model\ArtefactsModel;
use Model\FarmListModel;
use Model\MovementsModel;
use Model\OasesModel;
use Model\RallyPoint\RallyPointModel;
use resources\View\PHPBatchView;
use Securimage;
use const INCLUDE_PATH;
use function getCustom;

if (isset($_REQUEST['loadCaptcha'])) {
    require_once INCLUDE_PATH . "Plugins/securimage/securimage_show.php";
    exit();
}
require_once INCLUDE_PATH . "Plugins/securimage/securimage.php";

class FarmList
{
    private function _showFarmLists()
    {
        $m = new FarmListModel();
        if (isset($_GET['action']) && $_GET['action'] == 'deleteList' && isset($_GET['lid'])) {
            $m->deleteFarmList((int)$_GET['lid'], Session::getInstance()->getPlayerId());
        }
        $json = [];
        $lists = $m->getMyFarmLists(Session::getInstance()->getPlayerId());
        $content = null;
        if (getCustom("autoRaidEnabled")) {
            $content .= '<center><h4 class="round" style="background-color: #CCFFCC;">' . sprintf(T("FarmList",
                    "Auto raid costs %s silver(s) every %s seconds when it hits the farmlist"),
                    Config::getProperty("gold", "autoRaidSilver"),
                    Config::getProperty("game", "autoRaidInterval")) . '</h4></center>';
        }
        $content .= '<div id="raidList">';
        $view = new PHPBatchView("farmlist/showFarmlist");
        $raids = ['lid' => 0, 'num' => 0, 'err' => FALSE, 'err2' => false];
        if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'startRaid' && isset($_REQUEST['slot']) && is_array($_REQUEST['slot']) && !isServerFinished() && !Session::getInstance()->banned() && $_REQUEST['a'] == Session::getInstance()->getChecker()) {
            if (Session::getInstance()->isInVacationMode()) {
                redirect("options.php?s=4");
            }
            Session::getInstance()->changeChecker();
            $slots = array_map("intval", array_keys($_REQUEST['slot']));
            $lid = (int)$_POST['lid'];
            $list = $m->getMyFarmListById($lid, Session::getInstance()->getPlayerId());
            if ($list !== FALSE && $list['auto'] == 0) {
                $raids['lid'] = $lid;
                FarmlistTracker::addTry();
                if ($list['lastRaid'] < (time() - Config::getInstance()->game->farmListInterval)) {
                    $slots = $m->getMultiRaidList(implode(",", $slots), $lid);
                    $calc = new SpeedCalculator();
                    $calc->setTournamentSqLvl($m->getTournamentSqLvl($list['kid']));
                    $calc->setArtefactEffect(ArtefactsModel::getArtifactEffectByType(Session::getInstance()->getPlayerId(), $list['kid'], ArtefactsModel::ARTIFACT_INCREASE_SPEED));
                    $calc->setFrom($list['kid']);
                    $move = new MovementsModel();
                    $rallyPoint = new RallyPointModel();
                    if ($rallyPoint->checkMaxAttacks($list['kid'])) {
                        while ($row = $slots->fetch_assoc()) {
                            $modified_units = [];
                            $calc->hasCata($row['u8'] > 0);
                            $canRaid = TRUE;
                            $speeds = [];
                            if (!$m->checkToFarmListPermissions($row['kid'], Session::getInstance()->hasProtection())) {
                                continue;
                            }
                            if (Session::getInstance()->hasProtection() && !$m->isNatarOrUnOccupiedOasis($row['kid'])) {
                                continue;
                            }
                            $units = $m->getVillageUnits($list['kid']);
                            $unitsToSend = array_fill(1, 11, 0);
                            for ($i = 1; $i <= 10; ++$i) {
                                $v = $row['u' . $i];
                                if ($units['u' . $i] < $v) {
                                    $canRaid = FALSE;
                                    break;
                                }
                            }
                            if (!$canRaid) {
                                continue;
                            }
                            for ($i = 1; $i <= 10; ++$i) {
                                $v = $row['u' . $i];
                                if (!$v) {
                                    continue;
                                }
                                $unitsToSend[$i] = $v;
                                $units['u' . $i] -= $v;
                                if (!isset($modified_units[$i])) {
                                    $modified_units[$i] = 0;
                                }
                                $modified_units[$i] += $v;
                                $speeds[] = Formulas::uSpeed(nrToUnitId($i, Session::getInstance()->getRace()));
                            }
                            if (array_sum($modified_units)) {
                                if (!$m->modifyUnits($list['kid'], $modified_units)) continue;
                            }
                            $raids['num']++;
                            $calc->setTo($row['kid']);
                            $calc->setMinSpeed($speeds);
                            $move->addMovement($list['kid'],
                                $row['kid'],
                                Session::getInstance()->getRace(),
                                $unitsToSend,
                                0,
                                0,
                                0,
                                0,
                                0,
                                MovementsModel::ATTACKTYPE_RAID,
                                miliseconds(),
                                miliseconds() + $calc->calc() * 1000);
                        }
                        $m->setLastRaid($list['id'], $list['owner'], $list['kid'], time());
                    } else {
                        $raids['err2'] = TRUE;
                    }
                } else {
                    $raids['err'] = TRUE;
                }
            }
        }
        $first = 0;
        $firstFlag = true;
        while ($row = $lists->fetch_assoc()) {
            if ($first == 0) {
                $first = $row['id'];
            }
            $slots = $m->getRaidList($row['id']);
            $view->vars['lid'] = $row['id'];
            $view->vars['kid'] = $row['kid'];
            $view->vars['auto'] = $row['auto'];
            $view->vars['numSlots'] = $slots->num_rows;
            $view->vars['name'] = $m->getVillage($row['kid'], 'name')['name'] . ' - ' . $row['name'];
            //new change always minimized
            $view->vars['hide'] = $raids['lid'] != $row['id'];// && !($firstFlag && $row['kid'] == Session::getInstance()->getKid())
            //$view->vars['hide'] = $row['kid'] != Session::getInstance()->getKid() || $raids['lid'] != $row['id'];
            if ($first == 0) {
                $first = $row['id'];
            }
            if ($row['kid'] == Session::getInstance()->getKid()) {
                $firstFlag = false;
            }
            $view->vars['numRaids'] = $raids['lid'] == $row['id'] ? $raids['num'] : -1;
            $view->vars['err'] = $raids['lid'] == $row['id'] ? $raids['err'] : '';
            if ($view->vars['hide']) {
                $content .= $view->output();
                continue;
            }
            $json[$row['id']] = [];
            $json[$row['id']]['troops'] = [];
            $json[$row['id']]['directions'] = [
                "village" => "none",
                "ew" => "none",
                "distance" => "asc",
                "troops" => "none",
                "lastRaid" => "none",
            ];
            $json[$row['id']]['slots'] = [];
            $units = $m->getVillageUnits($row['kid']);
            for ($i = 1; $i <= 10; ++$i) {
                $json[$row['id']]['troops'][$i] = (int)$units['u' . $i];
            }
            $view->vars['slots'] = '';
            while ($slot = $slots->fetch_assoc()) {
                $slot['from_kid'] = $row['kid'];
                $json[$row['id']]['slots'][$slot['id']] = [];
                for ($i = 1; $i <= 10; ++$i) {
                    $json[$row['id']]['slots'][$slot['id']]['troops'][$i] = (int)$slot['u' . $i];
                }
                $view->vars['slots'] .= $this->renderSlot($row['id'], $slot, $row['auto']);
            }
            $content .= $view->output();
        }
        $content .= '<div class="options"><a class="arrow" href="#" onclick="Travian.Game.RaidList.showCreateNewList()">' . T("FarmList",
                "create_new_list") . '</a></div>';
        $json = json_encode($json);
        if ($first != 0) {
            $content .= <<<JS
<script type="text/javascript">
		jQuery(function()
		{
			Travian.Game.RaidList.setData($json);
            jQuery('html, body').animate({
                scrollTop: jQuery('#list{$first}').offset().top
            }, 100);
		});
</script>
JS;
        }
        $content .= '</div>';
        return $content;
    }

    public function renderSlot($lid, $row, $auto = false)
    {
        $m = new FarmListModel();
        $o = new OasesModel();
        $xy = Formulas::kid2xy($row['kid']);
        $HTML = '<tr class="slotRow">';
        if (!$auto) {
            $HTML .= '<td class="checkbox">';
            $HTML .= '<input id="slot' . $row['id'] . '" name="slot[' . $row['id'] . ']" type="checkbox" class="markSlot check" onclick="Travian.Game.RaidList.markSlotForRaid(' . $lid . ', ' . $row['id'] . ', this.checked);" />';
            $HTML .= '</td>';
        }
        $HTML .= '<td class="village">';
        if ($m->checkAttack($row['from_kid'], $row['kid'])) {
            $HTML .= '<img class="att2" src="img/x.gif" title="' . T("FarmList", "outGoingAttack") . '" /> ';
        }
        if ($o->isOasis($row['kid'])) {
            $row['name'] = T("FarmList", $o->isOasisConqured($row['kid']) ? "occupiedOasis" : "unoccupiedOasis");
            $row['name'] .= ' &#x202d;<span class="coordinates coordinatesWrapper"><span class="coordinateX">(' . $xy['x'] . '&#x202c;&#x202c;</span><span class="coordinatePipe">|</span><span class="coordinateY">&#x202d;&#x202d;' . $xy['y'] . '&#x202c;&#x202c;)</span></span>&#x202c;‎';
            $village = ['name' => $row['name'], 'pop' => 2];
        } else {
            $village = $m->getVillage($row['kid'], 'name, pop');
        }
        $HTML .= '<a href="position_details.php?x=' . $xy['x'] . '&y=' . $xy['y'] . '" >' . $village['name'] . '</a></td>';
        $HTML .= '<td class="ew">' . $village['pop'] . '</td>';
        $HTML .= '<td class="distance">' . round($row['distance'], 1) . '</td>';
        $HTML .= '<td class="troops">';
        for ($i = 1; $i <= 10; ++$i) {
            if (!$row['u' . $i]) {
                continue;
            }
            $u = nrToUnitId($i, Session::getInstance()->getRace());
            $HTML .= '<div class="troopIcon"><img class="unit u' . $u . '" title="' . T("Troops", "$u.title") . '" alt="' . T("Troops", "$u.title") . '" src="img/x.gif" /><span class="troopIconAmount">' . $row['u' . $i] . '</span></div>';
        }
        $HTML .= '</td>';
        $HTML .= '<td class="lastRaid">';
        $report = $m->getLastReport(Session::getInstance()->getPlayerId(), $row['kid']);
        if ($report !== FALSE) {
            $HTML .= '<img src="img/x.gif" class="iReport iReport' . $report['type'] . '" title="' . T("Reports", "reportTypes." . $report['type']) . '">';
            if (!empty($report['bounty'])) {
                $bounty = explode(",", $report['bounty']);
                if (isset($bounty[4]) && $bounty[4]) {
                    $resources = array_sum($bounty) - $bounty[4];
                    $style = $resources == $bounty[4] ? 'full' : ($resources == 0 ? 'empty' : 'half');
                    $HTML .= '<img title="' . $resources . '/' . $bounty[4] . '" alt="' . $resources . '/' . $bounty[4] . '" src="img/x.gif" class="carry ' . $style . '" /></a>';
                }
            }
            $HTML .= '<a href="reports.php?id=' . $report['id'] . '|' . $report['private_key'] . '">' . TimezoneHelper::autoDateString($report['time'], TRUE) . '</a>';
        }
        $HTML .= '<div class="clear"></div></td>';
        $HTML .= '<td class="action"><a class="arrow" href="#" onclick="Travian.Game.RaidList.editSlot(' . $lid . ', ' . $row['id'] . '); return false;">' . T("FarmList", "edit") . '</a></td>';
        $HTML .= '</tr>';
        return $HTML;
    }

    private function handleLock()
    {
        $error = false;
        $secureImage = new Securimage();
        if (WebService::isPost() && isset($_POST['code']) && !empty($_POST['code'])) {
            $code = trim($_POST['code']);
            if ($secureImage->check($code) !== false) {
                FarmlistTracker::unlock();
                redirect("build.php?id=39&tt=99");
            }
            $error = true;
        }
        $HTML = '<h4 class="round">' . T("farmListLockHandle", "title") . '</h4>';
        $HTML .= '<form action="build.php?tt=99&id=39" method="POST">';
        $HTML .= T("farmListLockHandle", "desc") . '<br /><br />';
        $HTML .= '
<script type="text/javascript">
function reloadCode(){
    document.getElementById("recaptchaImage").setAttribute("src", "build.php?id=39&tt=99&loadCaptcha&" + Math.random());
}
</script>
<table class="transparent loginTable">
				<tbody>
					<tr>
						<th class="captcha">
						' . T("farmListLockHandle", "captcha") . '</th>
						<td>
                            <img id="recaptchaImage" src="build.php?id=39&tt=99&loadCaptcha">
						</td>
						<td>
						</td>
					</tr>
					<tr>
					<td></td>
					<td>
					<input class="text" type="text" name="code" style="margin-bottom: 3px;">
					<div class="error ' . getDirection() . '" style="font-weight: bold">' . ($error ? T('farmListLockHandle',
                "Sorry you submitted wrong answer") : '') . '</div>

					</td>
</tr>
<tr>
					<td></td>
					<td><a href="#" onclick="reloadCode();">' . T("farmListLockHandle", "newCode") . '</a></td>
                    </tr>
					<tr>
					<tr>
					<td>
					</td>
					<td>
						<button type="submit" value="' . T("farmListLockHandle", "submit") . '"  class="green ">
							<div class="button-container addHoverClick ">
								<div class="button-background">
									<div class="buttonStart">
										<div class="buttonEnd">
											<div class="buttonMiddle"></div>
										</div>
									</div>
								</div>
								<div class="button-content">' . T("farmListLockHandle", "submit") . '</div>
							</div>
						</button>
					</td>
					<td>
					</td>
				</tr>
				</tbody>
			</table>';
        $HTML .= '</form>';
        return $HTML;
    }

    public function procContent()
    {
        if (FarmlistTracker::isLocked()) {
            return $this->handleLock();
        }
        $js = null;
        if (Session::getInstance()->hasProtection()) {
            $js .= '<span class="warning">' . T("FarmList", "underProtection") . '</span><br /><br />';
        }
        if (Config::getProperty("extraSettings", "addFarms", "enabled")) {
            if (Session::getInstance()->hasProtection()) {
                $js .= '<br /><br />';
            }
            $addFarmsBtn = ExtraModules::showButton("addFarms");
            if (!empty($addFarmsBtn)) {
                $js .= $addFarmsBtn . '<br /><br />';
            }
        }
        $js .= <<<HTML
<script type="text/javascript">
function f3321bf4b28aad28366b5d58a9e532b849088a512(event){
    if(!isEventTrusted(event)){
            window.location.reload();
            event.preventDefault();
            return false;
    }
}
function isEventTrusted(event){
    if(typeof(event.isTrusted) != "undefined"){
        //chrome
        return event.isTrusted == true;
    }
    if(typeof(event.clientX) != "undefined"){
        //firefox
        return (event.clientX > 0 && event.clientY > 0 && event.layerX > 0 && event.layerY > 0);
    }
    
    return true;
}
function attackFarmList(lid, type, event) {
    if(!isEventTrusted(event)){
            window.location.reload();
            return;
    }
    var c = Travian.WindowManager.getWindows();
    var d =(c.length) ? c[c.length-1]:null;
    if(c.length>0&&!!d){
        c[c.length-1].close()
    }
    Travian.ajax({
        data: {
            cmd: "raidList",
            method: "loading"
        },
        onSuccess: function (a) {
            var dialog = new Travian.Dialog.Dialog({buttonOk: true, overlayCancel: false,preventFormSubmit: true});
            dialog.setContent(a.html);
		    dialog.show();
            Travian.ajax({
                data: {
                    cmd: "raidList",
                    method: "attackFarmList",
                    lid: lid,
                    type: type
                },
                onSuccess: function (a) {
                    var c = Travian.WindowManager.getWindows();
                    var d =(c.length) ? c[c.length-1]:null;
                    if(c.length>0&&!!d){
                        c[c.length-1].close()
                    }
                    if(a.functionToCall !== undefined){
                        if(a.functionToCall === "reloadUrl"){
                            window.location.reload();
                        }
                    }
                    dialog = new Travian.Dialog.Dialog({buttonOk: true, overlayCancel: false, onOkay: function () {
                            window.ajaxToken = a.ajaxToken;
                        },preventFormSubmit: true});
                    dialog.setContent(a.html);
		            dialog.show();
                },
                onFailure: function (a) {
                    var c = Travian.WindowManager.getWindows();
                    var d =(c.length) ? c[c.length-1]:null;
                    if(c.length>0&&!!d){
                        c[c.length-1].close()
                    }
                     if(a.functionToCall !== undefined){
                        if(a.functionToCall === "reloadUrl"){
                            window.location.reload();
                        }
                    }
                    dialog = new Travian.Dialog.Dialog({buttonOk: true, overlayCancel: false, onOkay: function () {
                            window.location.reload();
                        },preventFormSubmit: true});
                    dialog.setContent('Request failed!');
		            dialog.show();
                }
            });
        }
    });
}
function editFarmList(a) {
    Travian.ajax({
        data: {cmd: "raidList", method: "ActionEditAllSlotsForm", listId: a},
        onSuccess: function (e) {
            new Travian.Dialog.Dialog({buttonOk: false, context: "raidAddSlotDialog"})
                .setContent(e.html)
                .show();
            return true
        }
    });
}
</script>
HTML;
        return $js . $this->_showFarmLists();
    }
}