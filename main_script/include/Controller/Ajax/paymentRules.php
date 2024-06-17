<?php
namespace Controller\Ajax;
class paymentRules extends AjaxBase
{
	public function dispatch()
	{
        $this->response['data']['html'] = T("PaymentWizard", "PaymentRulesHTML");
	}
}