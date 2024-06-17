<?php

namespace Controller\Ajax;

use Controller\Ajax\AjaxBase;
use Core\Helper\PreferencesHelper;

class preferences extends AjaxBase
{
	public function dispatch()
    {
        //if(isset($_POST['key'])){
        //    PreferencesHelper::setPreference($_POST['key'], isset($_POST['value']) ? $_POST['value'] : null);
        //}
		foreach($_POST as $key=>$value){
			PreferencesHelper::setPreference($key,$value);
		}
    }
}