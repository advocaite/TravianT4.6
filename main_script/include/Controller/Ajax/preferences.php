<?php
namespace Controller\Ajax;
use Core\Helper\PreferencesHelper;
class preferences extends AjaxBase
{
    public function dispatch()
    {
        if(isset($_REQUEST['key'])){
            PreferencesHelper::setPreference($_REQUEST['key'], isset($_REQUEST['value']) ? $_REQUEST['value'] : null);
        }
    }
}