<?php

namespace Controller\Ajax;

use Game\Formulas;
use resources\View\PHPBatchView;

class marketPlaceGoBack extends AjaxBase
{
    public function dispatch()
    {
        if (!isset($_REQUEST['kid'])) return;
        $xy = Formulas::kid2xy($_REQUEST['kid']);
        $view = new PHPBatchView('build/marketPlaceGoBack');
        $view->vars['dname'] = isset($_REQUEST['dname']) ? $_REQUEST['dname'] : null;
        $view->vars['x2'] = isset($_REQUEST['x2']) ? $_REQUEST['x2'] : null;
        $view->vars['x'] = $xy['x'];
        $view->vars['y'] = $xy['y'];
        $this->response['data']['formular'] = $view->output();
        $prepare = T("MarketPlace", "prepare");
        $this->response['data']['button'] = <<<HTML
<button type="submit" value="{$prepare}" id="enabledButton" class="green prepare" tabindex="10">
<div class="button-container addHoverClick">
    <div class="button-background">
        <div class="buttonStart">
            <div class="buttonEnd">
                <div class="buttonMiddle"></div>
            </div>
        </div>
    </div>
    <div class="button-content">{$prepare}</div>
</div></button>
<script type="text/javascript" id="enabledButton_script">jQuery(function () {
        jQuery('button#enabledButton').click(function () {
            jQuery(window).trigger('buttonClicked', [this, {
                "type": "submit",
                "value": "{$prepare}",
                "name": "",
                "id": "enabledButton",
                "class": "green prepare",
                "title": "",
                "confirm": "",
                "onclick": "",
                "tabindex": 10
            }]);
        });
    });
</script>
HTML;
    }
}