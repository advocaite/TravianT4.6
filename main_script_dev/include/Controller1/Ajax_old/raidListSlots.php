<?php

namespace Controller\Ajax;

use Controller\RallyPoint\FarmList;
use Core\Session;
use Game\Formulas;
use Core\Locale;
use Model\FarmListModel;
use resources\View\PHPBatchView;

class raidListSlots extends AjaxBase
{
    public function dispatch()
    {
        $lid = (int)$_POST['lid'];
        if (!isset($_POST['sort'])) {
            $_POST['sort'] = 'distance';
        }
        if (!isset($_POST['direction'])) {
            $_POST['direction'] = 'asc';
        }
        $sort = in_array($_POST['sort'], [
            "village",
            "ew",
            "distance",
            "troops",
            "lastRaid",
        ]) ? $_POST['sort'] : 'distance';
        $direction = in_array($_POST['direction'], ["asc", "desc",]) ? $_POST['direction'] : 'asc';
        $m = new FarmListModel();
        $list = $m->getMyFarmListById($lid, Session::getInstance()->getPlayerId());
        if ($list === FALSE) {
            return;
        }
        $slotsArray = [];
        $slots = $m->getRaidList($lid);
        while ($row = $slots->fetch_assoc()) {
            $xy = Formulas::kid2xy($row['kid']);
            if ($isOasis = $m->isOasis($row['kid'])) {
                $name = T("FarmList", $m->isOasisConqured($row['kid']) ? "occupiedOasis" : "unoccupiedOasis");
                $name .= ' &#x202d;<span class="coordinates coordinatesWrapper"><span class="coordinateX">(' . $xy['x'] . '&#x202c;&#x202c;</span><span class="coordinatePipe">|</span><span class="coordinateY">&#x202d;&#x202d;' . $xy['y'] . '&#x202c;&#x202c;)</span></span>&#x202c;‎</a';
            } else {
                $name = $m->getVillage($row['kid'], 'name')['name'];
            }
            $units = [];
            $sum = 0;
            for ($i = 1; $i <= 10; ++$i) {
                $units[$i] = $row['u' . $i];
                $sum += $units[$i];
            }
            $lastRaid = $sort == 'lastRaid' ? $m->getLastReport(Session::getInstance()->getPlayerId(), $row['kid']) : false;
            $slotsArray[] = array_merge([
                'name' => $name,
                'pop' => $isOasis ? 2 : $m->getVillage($row['kid'], 'pop')['pop'],
                'distance' => $row['distance'],
                'troops' => $sum,
                'lastRaid' => $lastRaid !== FALSE ? $lastRaid['time'] : 1e8,//some large number.
            ], $row);
        }
        $this->sortSlots($slotsArray, $sort, $direction);
        $this->response['data']['html'] = '';
        $units = $m->getVillageUnits($list['kid']);
        for ($i = 1; $i <= 11; ++$i) {
            $this->response['data']['list']['troops'][$i] = (int)$units['u' . $i];
        }
        $this->response['data']['list']['directions']['village'] = $sort == 'village' ? $direction : 'none';
        $this->response['data']['list']['directions']['ew'] = $sort == 'ew' ? $direction : 'none';
        $this->response['data']['list']['directions']['distance'] = $sort == 'distance' ? $direction : 'none';
        $this->response['data']['list']['directions']['troops'] = $sort == 'troops' ? $direction : 'none';
        $this->response['data']['list']['directions']['lastRaid'] = $sort == 'lastRaid' ? $direction : 'none';
        $this->response['data']['list']['slots'] = [];
        $this->response['data']['sort'] = $sort;
        $this->response['data']['direction'] = $direction;
        $view = new PHPBatchView("farmlist/ajaxFarmlist");
        $view->vars['lid'] = $list['id'];
        $view->vars['kid'] = $list['kid'];
        $view->vars['numSlots'] = sizeof($slotsArray);
        $view->vars['name'] = $m->getVillage($list['kid'], 'name')['name'] . ' - ' . $list['name'];
        $view->vars['numRaids'] = 0;
        $view->vars['slots'] = '';
        $view->vars['auto'] = $list['auto'];
        $c = new FarmList();
        foreach ($slotsArray as $slot) {
            $slot['from_kid'] = $list['kid'];
            for ($i = 1; $i <= 10; ++$i) {
                $this->response['data']['list']['slots'][$slot['id']]['troops'][$i] = (int)$slot['u' . $i];
            }
            $view->vars['slots'] .= $c->renderSlot($list['id'], $slot, $list['auto']);
        }
        $this->response['data']['html'] = $view->output();
    }

    private function sortSlots(&$slotsArray, $sort, $direction)
    {
        switch ($sort) {
            case 'name':
                if ($direction == 'desc') {
                    $slotsArray = rsort($slotsArray);
                } else {
                    $slotsArray = sort($slotsArray, SORT_STRING);
                }
                break;
            case 'ew':
                if ($direction == 'asc') {
                    usort($slotsArray, function ($a, $b) {
                        $result = 0;
                        if ($a['pop'] > $b['pop']) {
                            $result = 1;
                        } else if ($a['pop'] < $b['pop']) {
                            $result = -1;
                        }
                        return $result;
                    });
                    break;
                }
                usort($slotsArray, function ($a, $b) {
                    $result = 0;
                    if ($a['pop'] < $b['pop']) {
                        $result = 1;
                    } else if ($a['pop'] > $b['pop']) {
                        $result = -1;
                    }
                    return $result;
                });
                break;
            case 'distance':
                if ($direction == 'asc') {
                    usort($slotsArray, function ($a, $b) {
                        $result = 0;
                        if ($a['distance'] > $b['distance']) {
                            $result = 1;
                        } else if ($a['distance'] < $b['distance']) {
                            $result = -1;
                        }
                        return $result;
                    });
                    break;
                }
                usort($slotsArray, function ($a, $b) {
                    $result = 0;
                    if ($a['distance'] < $b['distance']) {
                        $result = 1;
                    } else if ($a['distance'] > $b['distance']) {
                        $result = -1;
                    }
                    return $result;
                });
                break;
            case 'troops':
                if ($direction == 'asc') {
                    usort($slotsArray, function ($a, $b) {
                        $result = 0;
                        if ($a['troops'] > $b['troops']) {
                            $result = 1;
                        } else if ($a['troops'] < $b['troops']) {
                            $result = -1;
                        }
                        return $result;
                    });
                    break;
                }
                usort($slotsArray, function ($a, $b) {
                    $result = 0;
                    if ($a['troops'] < $b['troops']) {
                        $result = 1;
                    } else if ($a['troops'] > $b['troops']) {
                        $result = -1;
                    }
                    return $result;
                });
                break;
            case 'lastRaid':
                if ($direction == 'asc') {
                    usort($slotsArray, function ($a, $b) {
                        $result = 0;
                        if ($a['lastRaid'] > $b['lastRaid']) {
                            $result = 1;
                        } else if ($a['lastRaid'] < $b['lastRaid']) {
                            $result = -1;
                        }
                        return $result;
                    });
                    break;
                }
                usort($slotsArray, function ($a, $b) {
                    $result = 0;
                    if ($a['lastRaid'] < $b['lastRaid']) {
                        $result = 1;
                    } else if ($a['lastRaid'] > $b['lastRaid']) {
                        $result = -1;
                    }
                    return $result;
                });
                break;
        }
    }
} 