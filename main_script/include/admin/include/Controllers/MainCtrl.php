<?php

use Core\Helper\TimezoneHelper;
use Core\Helper\WebService;
use Core\Session;

class MainCtrl
{
    public function __construct()
    {
        $name = Session::getInstance()->getAdminUid() <= 0 ? 'Administrator' : 'Multihunter';
        $color = Session::getInstance()->getAdminUid() <= 0 ? 'red' : 'blue';
        Dispatcher::getInstance()->appendContent('<font size="3">
	<b><br><br>
		<center>

			Welcome To
				Administrator			Control panel
		</center>
	</b>

</font>
<div align="center">
    <img src="img/admin/u11.gif" width="468" height="360" border="0">
</div><br /><br /><br /><br />

	<h3>Hello <b>'.Session::getInstance()->getName().'</b>, You are logged in as:

	<b>
	<font color="'.$color.'"><small>'.$name.'</small></font></h3>
	</b><h5> <div class="point2"><b>Today is <b>'.TimezoneHelper::date('l j F Y').'</b>.</b></div>
	  <div class="point2">Your Ip addresses: '.WebService::ipAddress().'</div>
	</h5>
	<br /><br /><br />

');
    }
}