<?php

namespace Api\Ctrl;

use Api\ApiAbstractCtrl;
use Core\WebService;

class ConfigCtrl extends ApiAbstractCtrl
{
    public function loadConfig()
    {
        global $globalConfig;
        $lang = $globalConfig['staticParameters']['default_language'];
        if($lang == 'en') $lang = 'international';
        $keyValue = [
            'ir' => 'ir',
            'us' => 'international',
            'uk' => 'international',
        ];
        $countryFlag = strtolower(geoip_country_code_by_name(WebService::ipAddress()));
        if(isset($keyValue[$countryFlag])){
            $lang = $keyValue[$countryFlag];
        }
        $this->response = [
            'defaultLang' => $lang,
            'globalCssClass' => $globalConfig['staticParameters']['global_css_class'],
            'autoCheckTermsAndConditions' => true,
            'registrationRecommendedMinSecondsPast' => -3600,
            'showLoginAfterServerFinished' => true,
        ];
    }
}