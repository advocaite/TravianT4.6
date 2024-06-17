<?php

use Core\Config;
use Core\Database\GlobalDB;
use Core\Helper\IPTracker;
use Core\Helper\TimezoneHelper;
use Core\Helper\WebService;
use Core\Session;

class IPBanCtrl
{
    private $countryCodes = [];
    public function __construct()
    {
        $this->countryCodes = Config::getInstance()->countryCodes;
        $params = [
            'ip' => isset($_REQUEST['ip']) ? trim($_REQUEST['ip']) : null,
            'time' => isset($_POST['time']) ? (int)$_POST['time'] : 7200,
            'reason' => isset($_POST['reason']) ? $_POST['reason'] : 'Pushing',
        ];
        if(!isServerFinished() && WebService::isPost() && Session::validateChecker()){
            ;
            if(!empty($params['ip']) && filter_var($params['ip'], FILTER_VALIDATE_IP) !== FALSE){
                if($params['ip'] == WebService::ipAddress()){
                    $params['error'] = 'You cannot block your ip address.';
                } else {
                    IPTracker::blockIP(ip2long($params['ip']), $params['reason'], $params['time']);
                    $params['error'] = 'IP blocked.';
                }
            } else {
                $params['error'] = 'No IPs to block.';
            }
        } else {
            if(!isServerFinished() && isset($_GET['del']) && filter_var($_GET['del'], FILTER_VALIDATE_IP) !== FALSE){
                IPTracker::unblockIP(ip2long($_GET['del']));
            }
        }
        $page = isset($_GET['p']) ? abs((int)$_GET['p']) : 1;
        $db = GlobalDB::getInstance();
        $result = $db->query("SELECT * FROM banIP WHERE (blockTill>".time()." OR blockTill=0) ORDER BY id DESC LIMIT " . (($page - 1) * $this->pageSize) . ", {$this->pageSize}");
        $params['content'] = null;
        while($row = $result->fetch_assoc()){
            $params['content'] .= '<tr>';
            $params['content'] .= '<td style="text-align: center;"><a href="admin.php?action=IPBan&del='.long2ip($row['ip']).'"><img src="img/x.gif" class="del"></a></td>';
            $params['content'] .= '<td style="text-align: center;">'.long2ip($row['ip']).'</td>';
            $countryFlag = '-';
            if(function_exists("geoip_country_code_by_name")){
                $countryFlag = strtoupper(geoip_country_code_by_name(long2ip($row['ip'])));
            }
            $params['content'] .= '<td style="text-align: center;">'.(isset($this->countryCodes[$countryFlag]) ? $this->countryCodes[$countryFlag] : 'Unknown location').'</td>';
            $params['content'] .= '<td style="text-align: center;">'.$row['reason'].'</td>';
            if($row['blockTill'] == 0){
                $params['content'] .= '<td class="on"><span class="f7">'.TimezoneHelper::autoDateString($row['time'], TRUE).' - Forever</td>';
            } else {
                $params['content'] .= '<td class="on"><span class="f7">'.TimezoneHelper::autoDateString($row['time'], TRUE).' - '.TimezoneHelper::autoDateString($row['blockTill'], TRUE).'</td>';
            }
            $params['content'] .= '</tr>';
        }
        if(!$result->num_rows){
            $params['content'] .= '<tr><td colspan="6" class="hab"><span class="errorMessage">No banned IPs.</span></td></tr>';
        }
        $params['navigator'] = $this->getNavigator($page, $db->fetchScalar("SELECT COUNT(id) FROM banIP WHERE (blockTill>".time()." OR blockTill=0)"), ['action' => 'IPBan']);
        \Dispatcher::getInstance()->appendContent(\Template::getInstance()->load($params, 'tpl/banIP.tpl')->getAsString());
    }
    const NEXT_SHAPE = '»';
    const PREVIOUS_SHAPE = '«';
    private $pageSize = 30;
    private function previousPageNavigator($page, $num_rows, $prefix = [])
    {
        $text = self::PREVIOUS_SHAPE;
        $total_pages = ceil($num_rows / $this->pageSize);
        if (($page - 1) >= 1 && ($page - 1) <= $total_pages) {
            $prefix['p'] = --$page;
            $query = http_build_query($prefix);
            return '<a href="?' . $query . '">' . $text . '</a>';
        }
        return $text;
    }

    private function nextPageNavigator($page, $num_rows, $prefix = [])
    {
        $text = self::NEXT_SHAPE;
        $total_pages = ceil($num_rows / $this->pageSize);
        if ((1 + $page) <= $total_pages) {
            $prefix['p'] = ++$page;
            $query = http_build_query($prefix);
            return '<a href="?' . $query . '">' . $text . '</a>';
        }
        return $text;
    }

    private function getNavigator($page, $num_rows, $prefix = [])
    {
        return $this->previousPageNavigator($page, $num_rows, $prefix) . ' | ' . $this->nextPageNavigator($page, $num_rows, $prefix);
    }
}