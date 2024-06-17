<?php
namespace Process;
use Core\Providers\PayGol;
require dirname(__DIR__) . '/include/bootstrap.php';
if(isset($_GET['type']) && $_GET['type'] == 'paygol'){
    (new PayGol())->processIpn();
}