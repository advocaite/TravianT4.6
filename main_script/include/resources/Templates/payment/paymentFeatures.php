<div class="contentBorder infoArea">
    <div class="contentBorder-tl"></div>
    <div class="contentBorder-tr"></div>
    <div class="contentBorder-tc"></div>
    <div class="contentBorder-ml"></div>
    <div class="contentBorder-mr"></div>
    <div class="contentBorder-mc"></div>
    <div class="contentBorder-bl"></div>
    <div class="contentBorder-br"></div>
    <div class="contentBorder-bc"></div>
    <div class="contentBorder-contents cf">
        <?php
        use Core\Config;
        use Core\Helper\TimezoneHelper;
        use Core\Session;
        use Core\Village;
        use Game\GoldHelper;
        use Game\Formulas;
        use Model\TrainingModel;
        use Model\BattleSetter;
        function buildFeature($featureName, $coins, $wwInAvailable, $delivery, $img='')
        {
            $featureName = explode("_", $featureName);
            if (sizeof($featureName) == 2) {
                $percent = $featureName[1];
            }
            $featureName = $featureName[0];
            $isMoreProtection = substr($featureName, 0, 14) == 'moreProtection';
            $HTML = '<div class="feature featureBooking ">';
            $HTML .= '<input type="hidden" class="premiumFeatureName hide" name="featureName" value="' . $featureName . '">';
            $HTML .= '<div class="featureContent">';
            $end = null;
            if ($featureName == 'fasterTraining') {
                $end .= getEnd(Session::getInstance()->get("fasterTraining"));
            } else if ($featureName == 'atkBonus') {
                $end .= getEnd(Session::getInstance()->get("atkBonusExpireTime"));
            } else if ($featureName == 'defBonus') {
                $end .= getEnd(Session::getInstance()->get("defBonusExpireTime"));
            }
            if ($isMoreProtection) {
                $featureNameForTranslation = 'moreProtection';
                $featureNameDescForTranslation = 'moreProtectionDesc';
            } else {
                $featureNameForTranslation = $featureName;
                $featureNameDescForTranslation = $featureName . 'Desc';
            }
            if(!empty($img)){
                $HTML .= '<div class="premiumFeatureBuilding" style="width:auto;height:100%"><img src="img/x.gif" class="building '.$img.'" alt=""></div>';
            }
            $HTML .= '<h3 class="featureTitle">' . (isset($percent) ? sprintf(T("PaymentWizard", $featureNameForTranslation), $percent) : T("PaymentWizard", $featureNameForTranslation)) . $end . '</h3>';
            $HTML .= '<div class="featureRemainingTime featureSubtitle subtitle"><span class="">' . T("PaymentWizard", $featureNameDescForTranslation) . '</span></div>';
            $HTML .= '<div class="featureButton">' . (new GoldHelper())->renderBuyButton($featureName, $coins, $wwInAvailable) . '</div>';
            if ($isMoreProtection || in_array($featureName, ['fasterTraining', 'atkBonus', 'defBonus'])) {
                $HTML .= '<div class="featureDuration featureRenewal featureButtonSubtitle subtitle">' . T("PaymentWizard", "Bonus duration") . ': <span class="bold">' . ($delivery == 0 ? T("PaymentWizard", "Immediately") : $delivery) . '</span>  ' . ($delivery == 0 ? '' : T("PaymentWizard", "hour")) . '  </div>';
            } else {
                $HTML .= '<div class="featureDuration featureRenewal featureButtonSubtitle subtitle">' . T("PaymentWizard", "delivery") . ': <span class="bold">' . ($delivery == 0 ? T("PaymentWizard", "Immediately") : $delivery) . '</span>  ' . ($delivery == 0 ? '' : T("PaymentWizard", "Minutes")) . '  </div>';
            }
            $HTML .= '</div>';
            $HTML .= '</div>';
            return $HTML;
        }
        function buildBuildings($featureName,$title, $coins, $wwInAvailable, $delivery, $bid)
        {
            $disabled = false;
            $HTML = '<div class="feature featureBooking ">';
            $HTML .= '<input type="hidden" class="premiumFeatureName hide" name="featureName" value="' . $featureName . '">';
            $HTML .= '<div class="featureContent">';
            $end = null;
            $featureNameForTranslation = $title;
            $featureNameDescForTranslation = $title . 'Desc';
            
            $village = Village::getInstance();
            if(substr($bid, 0, 3) != 'res'){

                if(in_array($bid, array(10,11,38,39))){
                    $alreadyBuilt = $village->findBuildingsByGid($bid);
                    $fieldId = 0;
                    foreach($alreadyBuilt as $index => $building){
                        if($building['level']!=20){
                            $fieldId = $index;
                            continue;
                        }
                    }
    
                }
                else{
                    $fieldId = $village->findBuildingByGid($bid);        
                    if ($fieldId != 0 && $village->getField($fieldId)['level'] == 20) $disabled=true;            
                }
                if ($fieldId == 0 && empty($village->getEmptyFields())) $disabled=true;
                
                $HTML .= '<div class="premiumFeatureBuilding" style="width:auto;height:100%"><img src="img/x.gif" class="building g'.$bid.'" alt=""></div>';
            }else{
                $disabled = true;
                $resourceLevel = preg_replace('/[^0-9]/', '', $bid);
                for ($i = 1; $i <= 18; ++$i) {
                    if ($village->getField($i)['level'] >= $resourceLevel){
                        $disabled &=true;
                    }else{
                        $disabled &=false;
                    }
                }
            }

            $HTML .= '<h3 class="featureTitle">' . sprintf(T("PaymentWizard", $featureNameForTranslation)) . '</h3>';
            $HTML .= '<div class="featureRemainingTime featureSubtitle subtitle"><span class="">' . T("PaymentWizard", $featureNameDescForTranslation) . '</span></div>';
            $HTML .= '<div class="featureButton">' . (new GoldHelper())->renderBuyButton($featureName, $coins, $wwInAvailable,$disabled) . '</div>';
            $HTML .= '<div class="featureDuration featureRenewal featureButtonSubtitle subtitle">' . T("PaymentWizard", "delivery") . ': <span class="bold">' . ($delivery == 0 ? T("PaymentWizard", "Immediately") : $delivery) . '</span>  ' . ($delivery == 0 ? '' : T("PaymentWizard", "Minutes")) . '  </div>';
            $HTML .= '</div>';
            $HTML .= '</div>';
            return $HTML;
        }

        function buildAnimalFeature($featureName, $modifier, $coins, $wwInAvailable, $delivery)
        {
            $model = new BattleSetter();
            $animals = [];
                      
            $rate = Config::getProperty("game", "useNanoseconds") ? 1e9 : (Config::getProperty("game", "useMilSeconds") ? 1e3 : 1);
            $legionaire = Formulas::$data['units'][0][0];
            $legionaire_id = nrToUnitId(1, 1);  
            $legionaire_train =  round(($modifier * 3600 * $rate) / Formulas::uTrainingTime($legionaire_id, 20));
            $legionaire_def = $model->stat_with_upg($legionaire['def_i'], $legionaire['cu'], 1) + $model->stat_with_upg($legionaire['def_c'], $legionaire['cu'], 1);  
            $baseLineDef = ($legionaire_train * $legionaire_def) / 10;

            for ($k = 0; $k<=9; $k++){
                $unit = Formulas::$data['units'][3][$k];
                $def = $model->stat_with_upg($unit['def_i'], $unit['cu'], 1) + $model->stat_with_upg($unit['def_c'], $unit['cu'], 1);  
                $animals[$k] = floor($baseLineDef / $def);
            }

            $HTML = '<div class="feature featureBooking " style="height: 85px">';
            $HTML .= '<input type="hidden" class="premiumFeatureName hide" name="featureName" value="' . $featureName . '">';
            $HTML .= '<div class="featureContent">';
            $HTML .= '<table style="width: 80%; border: 0"><tbody><tr style="border: 0;">';

            for ($i = 0; $i <= 4; ++$i) {
                $HTML .= '<td style="border: 0; height: 20%; font-size:11px"><img class="unit u' . ($i + 30 + 1) . '" src="img/x.gif"><br />' . number_format_x($animals[$i]) . '</td>';
            }
            $HTML .= '</tr><tr style="border: 0;">';
            for ($i = 5; $i <= 9; ++$i) {
                $HTML .= '<td style="border: 0; font-size:11px"><img class="unit u' . ($i + 30 + 1) . '" src="img/x.gif"><br />' . number_format_x($animals[$i]) . '</td>';
            }
            $HTML .= '</tr></tbody></table>';
            $HTML .= '<div class="featureButton">' . (new GoldHelper())->renderBuyButton($featureName, $coins, $wwInAvailable) . '</div>';
            $HTML .= '<div class="featureDuration featureRenewal featureButtonSubtitle subtitle">' . T("PaymentWizard", "delivery") . ': <span class="bold">' . ($delivery == 0 ? T("PaymentWizard", "Immediately") : $delivery) . '</span>  ' . ($delivery == 0 ? '' : T("PaymentWizard", "Minutes")) . '</div>';
            $HTML .= '</div>';
            $HTML .= '</div>';
            return $HTML;
        }

        function buildSingleResourcesFeature($packs, $wwInAvailable)
        {            
            $productionAvg = (Formulas::fieldProduction(20) * 4);
            $HTML = '<div class="feature featureBlock">';
            $HTML .= '<h2>Buy Resources Individually</h2>';
            $HTML .= '<div class="featuresInline">';
            foreach ($packs as $index => $package) {
                $featureName = 'buyResources' . $index;
                $coins = $package['coins'];
                $delivery = $package['delivery'];
                $resourceId = $package['resource'];
                $resourceAmt =  ($package['hours']) * $productionAvg;

                $HTML .= '<div class="featureData single">';
                    $HTML .= '<div class="featureTitle">';
                        $HTML .=  $package['name'];
                        $HTML .= '<input type="hidden" class="premiumFeatureName hide" name="featureName" value="' .$featureName . '">';               
                    $HTML .= '</div>';     
                    $HTML .= '<div class="featureImg">';       
                    $HTML .= '<i class="a'.($resourceId).'"></i>';   
                    $HTML .= '</div>';    
                    $HTML .= '<div class="featureAmt">';
                        $HTML .= '<div class="inlineIcon resources r'.($resourceId).'"><i class="r'.($resourceId).'"></i>&nbsp;<span class="value ">' . number_format_x($resourceAmt) . '</span></div>';
                    $HTML .= '</div>';     
                    $HTML .= '<div class="featureBuyButton">';     
                        $HTML .= '<div class="">' . (new GoldHelper())->renderBuyButton($featureName, $coins, $wwInAvailable) . '</div>';
                        $HTML .= '<div class="featureButtonSubtitle subtitle">' . T("PaymentWizard", "delivery") . ': <span class="bold">' . ($delivery == 0 ? T("PaymentWizard", "Immediately") : $delivery) . '</span>  ' . ($delivery == 0 ? '' : T("PaymentWizard", "Minutes")) . '</div>';
                    $HTML .= '</div>';   
                $HTML .= '</div>';   
            }
            $HTML .= '</div>';
            $HTML .= '</div>';
            return $HTML;         
        }

        function buildComboResourcesFeature($packs, $wwInAvailable)
        {
            $productionAvg = (Formulas::fieldProduction(20) * 4);
            $HTML = '<div class="feature featureBlock">';
            $HTML .= '<h2>Buy one of our Combo Packages</h2>';
            $HTML .= '<div class="featuresInline">';
            foreach ($packs as $index => $package) {
                $featureName = 'buyResources' . $index;
                $coins = $package['coins'];
                $delivery = $package['delivery'];

                $HTML .= '<div class="featureData combo">';
                    $HTML .= '<div class="featureTitle">';
                        $HTML .=  $package['name'];
                        $HTML .= '<input type="hidden" class="premiumFeatureName hide" name="featureName" value="' .$featureName . '">';               
                    $HTML .= '</div>';     
                    $HTML .= '<div class="featureImg">';       
                    $HTML .= '<i class="aCombo"></i>';   
                    $HTML .= '</div>';    
                    $HTML .= '<div class="featureAmt resourcesInline">';
                        //foreach($resources as $i => $resource){
                        for($i = 0; $i < 4; $i++){                            
                            $resourceId = $i;
                            $resourceAmt =  ($package['hours']) * $productionAvg;
                            $HTML .= '<div class="inlineIcon resources"><i class="r'.($i + 1).'"></i>&nbsp;<span class="value ">' . number_format_x($resourceAmt) . '</span></div>';
                        }
                    $HTML .= '</div>';     
                    $HTML .= '<div class="featureBuyButton">';     
                        $HTML .= '<div class="">' . (new GoldHelper())->renderBuyButton($featureName, $coins, $wwInAvailable) . '</div>';
                        $HTML .= '<div class="featureButtonSubtitle subtitle">' . T("PaymentWizard", "delivery") . ': <span class="bold">' . ($delivery == 0 ? T("PaymentWizard", "Immediately") : $delivery) . '</span>  ' . ($delivery == 0 ? '' : T("PaymentWizard", "Minutes")) . '</div>';
                    $HTML .= '</div>';   
                $HTML .= '</div>';   
            }

            $HTML .= '</div>';
            $HTML .= '</div>';
            return $HTML;  
        }

        function getEnd($time, $autoExtend = false)
        {
            if ($time < time()) {
                return '';
            }
            if (($time - time()) > 86400) {
                $hldDays = round(($time - time()) / 86400);
                return '<span class=""> (' . T("PaymentWizard", "Days remaining") . ' ' . $hldDays . ' ' . T("PaymentWizard", "until") . ' ' . TimezoneHelper::date("H:i:s", $time) . ')</span>';
            } else {
                return '<span class="bonusEndsSoon"> (' . sprintf(T("PaymentWizard", "EndsAtX"), TimezoneHelper::date("H:i:s", $time)) . ')</span>';
            }
        }

        function buildTroopsFeature($unitType, $packs, $wwInAvailable)
        {
            $unitId = nrToUnitId($unitType, Session::getInstance()->getRace());
            $HTML = '<div class="featuresInline">';

            $HTML .= '<table style="width: 100%; border: 0">';
            $HTML .= '<thead>';
                $HTML .= '<tr>';
                    $HTML .= '<td>'. T("PaymentWizard", "Troop type") .'</td>';
                    $HTML .= '<td>'. T("PaymentWizard", "Amount") .'</td>';
                    $HTML .= '<td>'. T("PaymentWizard", "Delivery") .'</td>';
                    $HTML .= '<td>'. T("PaymentWizard", "Price") .'</td>';
                $HTML .= '</tr>';
            $HTML .= '</thead>';
            $HTML .= '<tbody>';
            $HTML .= '<tr style="border: 0;">';
            $HTML .= '<td rowspan="6">';
                $HTML .= '<a href="#" onclick="return Travian.Game.iPopup('. $unitId .',1);">';
                    $HTML .= '<img class="unitSection u'. $unitId .'Section" src="img/x.gif" alt="'. T("Troops", $unitId . '.title') .'" title="'. T("Troops", $unitId . '.title') .'"/>';
                $HTML .= '</a> ';
                $HTML .= '<a href="#" class="zoom" onclick="return Travian.Game.unitZoom('. $unitId .');">';
                    $HTML .= '<img class="zoom" src="img/x.gif" alt="zoom in" title="'. T("inGame", "zoomIn") .'"/>';
                $HTML .= '</a>';
            $HTML .= '</td>';

            $HTML .= insertTroopTableFragment($unitType, 0, $packs[0], $wwInAvailable);
            array_shift($packs);

            $HTML .= '</tr>';
            foreach ($packs as $index => $package) {
                $HTML .= '<tr>';
                    $HTML .= insertTroopTableFragment($unitType, $index, $package, $wwInAvailable);
                $HTML .= '</tr>';
            }
            $HTML .= '</tbody></table>';
            $HTML .= '</div>';
            return $HTML;  
        }

        function insertTroopTableFragment($unitType, $index, $unitPack, $wwInAvailable)
        {
            $featureName = 'buyTroops' . $unitType . $index; 
            $unitId = nrToUnitId($unitType, Session::getInstance()->getRace());            
            $rate = Config::getProperty("game", "useNanoseconds") ? 1e9 : (Config::getProperty("game", "useMilSeconds") ? 1e3 : 1);
            $amount =  round(($unitPack['hours'] * 3600 * $rate) / Formulas::uTrainingTime($unitId, 20));

            $HTML = '<td>'.number_format_x($amount).'</td>';
            $HTML .= '<td>'.($unitPack['delivery'] == 0 ? T("PaymentWizard", "Immediately") : $unitPack['delivery']) . '</span>  ' . ($unitPack['delivery'] == 0 ? '' : T("PaymentWizard", "Minutes")).'</td>';
            $HTML .= '<td>'.(new GoldHelper())->renderBuyButton($featureName, $unitPack['coins'], $wwInAvailable).'</td>';
            
            return $HTML;  
        }

        $config = Config::getInstance();
        $step = 0;

        $order = []; ?>
        <?php if ($vars['enabledFeatures']['general']):$step++;
            $order['generalOptions'] = $step; ?>
            <a href="#"
               onclick="jQuery('.paymentWizardMenu').addClass('hide');jQuery('.buyGoldInfoStep').removeClass('active');jQuery('.buyGoldInfoStep#<?=$step; ?>').addClass('active');jQuery('.paymentWizardMenu#generalOptions').removeClass('hide');">
                <div
                        class="buyGoldInfoStep <?=$step == 1 ? 'active' : ''; ?>"
                        id="<?=$step; ?>">
                    <div
                            class="buyGoldInfoStepNumber"><?=$step; ?></div>
                    <div
                            class="buyGoldInfoStepLabel"><?=T("PaymentWizard", "General"); ?>
                        :
                    </div>
                    <div
                            class="buyGoldInfoStepContent"><?=T("PaymentWizard", "GeneralOptions"); ?></div>
                </div>
            </a>
        <?php endif; ?>
        <?php if ($vars['enabledFeatures']['buyBuildings']):$step++;
            $order['buyBuildings'] = $step; ?>
            <a href="#"
               onclick="jQuery('.paymentWizardMenu').addClass('hide');jQuery('.buyGoldInfoStep').removeClass('active');jQuery('.buyGoldInfoStep#<?=$step; ?>').addClass('active');jQuery('.paymentWizardMenu#buyBuildings').removeClass('hide');">
                <div
                        class="buyGoldInfoStep <?=$step == 1 ? 'active' : ''; ?>"
                        id="<?=$step; ?>">
                    <div
                            class="buyGoldInfoStepNumber"><?=$step; ?></div>
                    <div
                            class="buyGoldInfoStepLabel"><?=T("PaymentWizard", "Buildings"); ?>
                        :
                    </div>
                    <div
                            class="buyGoldInfoStepContent"><?=T("PaymentWizard", "buyBuildings"); ?></div>
                </div>
            </a>
        <?php endif; ?>
        <?php if ($vars['enabledFeatures']['buyResources']):$step++;
            $order['buyResources'] = $step; ?>
            <a href="#"
               onclick="jQuery('.paymentWizardMenu').addClass('hide');jQuery('.buyGoldInfoStep').removeClass('active');jQuery('.buyGoldInfoStep#<?=$step; ?>').addClass('active');jQuery('.paymentWizardMenu#buyResources').removeClass('hide');">
                <div
                        class="buyGoldInfoStep <?=$step == 1 ? 'active' : ''; ?>"
                        id="<?=$step; ?>">
                    <div
                            class="buyGoldInfoStepNumber"><?=$step; ?></div>
                    <div
                            class="buyGoldInfoStepLabel"><?=T("PaymentWizard", "Resources"); ?>
                        :
                    </div>
                    <div
                            class="buyGoldInfoStepContent"><?=T("PaymentWizard", "buyResources"); ?></div>
                </div>
            </a>
        <?php endif; ?>
        <?php if ($vars['enabledFeatures']['buyTroops']):$step++;
            $order['buyTroops'] = $step; ?>
            <a href="#"
               onclick="jQuery('.paymentWizardMenu').addClass('hide');jQuery('.buyGoldInfoStep').removeClass('active');jQuery('.buyGoldInfoStep#<?=$step; ?>').addClass('active');jQuery('.paymentWizardMenu#buyTroops').removeClass('hide');">
                <div
                        class="buyGoldInfoStep <?=$step == 1 ? 'active' : ''; ?>"
                        id="<?=$step; ?>">
                    <div
                            class="buyGoldInfoStepNumber"><?=$step; ?></div>
                    <div
                            class="buyGoldInfoStepLabel"><?=T("PaymentWizard", "Troops"); ?>
                        :
                    </div>
                    <div
                            class="buyGoldInfoStepContent"><?=T("PaymentWizard", "buyTroops"); ?></div>
                </div>
            </a>
        <?php endif; ?>
        <?php if ($vars['enabledFeatures']['buyAnimal']):$step++;
            $order['buyAnimal'] = $step; ?>
            <a href="#"
               onclick="jQuery('.paymentWizardMenu').addClass('hide');jQuery('.buyGoldInfoStep').removeClass('active');jQuery('.buyGoldInfoStep#<?=$step; ?>').addClass('active');jQuery('.paymentWizardMenu#buyAnimal').removeClass('hide');">
                <div
                        class="buyGoldInfoStep <?=$step == 1 ? 'active' : ''; ?>"
                        id="<?=$step; ?>">
                    <div
                            class="buyGoldInfoStepNumber"><?=$step; ?></div>
                    <div
                            class="buyGoldInfoStepLabel"><?=T("PaymentWizard", "Troops"); ?>
                        :
                    </div>
                    <div
                            class="buyGoldInfoStepContent"><?=T("PaymentWizard", "buyAnimal"); ?></div>
                </div>
            </a>
        <?php endif; ?>
        <?php if ($vars['enabledFeatures']['moreProtection']):$step++;
            $order['moreProtection'] = $step; ?>
            <a href="#"
               onclick="jQuery('.paymentWizardMenu').addClass('hide');jQuery('.buyGoldInfoStep').removeClass('active');jQuery('.buyGoldInfoStep#<?=$step; ?>').addClass('active');jQuery('.paymentWizardMenu#moreProtection').removeClass('hide');">
                <div
                        class="buyGoldInfoStep <?=$step == 1 ? 'active' : ''; ?>"
                        id="<?=$step; ?>">
                    <div
                            class="buyGoldInfoStepNumber"><?=$step; ?></div>
                    <div
                            class="buyGoldInfoStepLabel"><?=T("PaymentWizard", "Protection"); ?>:
                    </div>
                    <div
                            class="buyGoldInfoStepContent"><?=T("PaymentWizard", "Protection Packages"); ?></div>
                </div>
            </a>
        <?php endif; ?>
        <?php if ($vars['enabledFeatures']['extraPower']):$step++;
            $order['power'] = $step; ?>
            <a href="#"
               onclick="jQuery('.paymentWizardMenu').addClass('hide');jQuery('.buyGoldInfoStep').removeClass('active');jQuery('.buyGoldInfoStep#<?=$step; ?>').addClass('active');jQuery('.paymentWizardMenu#power').removeClass('hide');">
                <div
                        class="buyGoldInfoStep <?=$step == 1 ? 'active' : ''; ?>"
                        id="<?=$step; ?>">
                    <div
                            class="buyGoldInfoStepNumber"><?=$step; ?></div>
                    <div
                            class="buyGoldInfoStepLabel"><?=T("PaymentWizard", "Power"); ?></div>
                    <div
                            class="buyGoldInfoStepContent"><?=T("PaymentWizard", "Attack/Defense Bonus"); ?></div>
                </div>
            </a>
        <?php endif; ?>
        <script type="text/javascript">
            function productPurchased(data) {
                    var dialog = new Travian.Dialog.Dialog({preventFormSubmit: true});
                if (data.type === 'animal') {
                    dialog.setContent('<?=T("PaymentWizard", "Animals purchased");?>');
                } else if (data.type === 'troops') {
                    dialog.setContent('<?=T("PaymentWizard", "Troops purchased");?>');
                } else if (data.type === 'building') {
                    dialog.setContent('<?=T("PaymentWizard", "Building upgraded");?>');
                } else {
                    dialog.setContent('<?=T("PaymentWizard", "Resources purchased!");?>');
                }
                dialog.show();
                jQuery(".accountBalance span")[0].html(data.newGold);
            }
        </script>
    </div>
</div>
<div class="contentBorder contentArea">
    <div class="contentBorder-tl"></div>
    <div class="contentBorder-tr"></div>
    <div class="contentBorder-tc"></div>
    <div class="contentBorder-ml"></div>
    <div class="contentBorder-mr"></div>
    <div class="contentBorder-mc"></div>
    <div class="contentBorder-bl"></div>
    <div class="contentBorder-br"></div>
    <div class="contentBorder-bc"></div>
    <div class="contentBorder-contents cf">
        <div class="paymentPopupDialogWrapper">
            <?php if ($vars['enabledFeatures']['general']):$step++; ?>
                <div
                        class="paymentWizardMenu <?=$order['generalOptions'] == 1 ? '' : 'hide'; ?>"
                        id="generalOptions">     
                    <?php if ($config->extraSettings->generalOptions->oneHourOfProduction->enabled): ?>
                        <?=buildFeature('oneHourOfProduction', $config->extraSettings->generalOptions->oneHourOfProduction->coins, true, 0); ?>
                    <?php endif; ?>
                    <?php if ($config->extraSettings->generalOptions->increaseStorage->enabled): ?>
                        <?=buildFeature('increaseStorage', $config->extraSettings->generalOptions->increaseStorage->coins, false, 0); ?>
                    <?php endif; ?>
                    <?php if ($config->extraSettings->generalOptions->finishTraining->enabled): ?>
                        <?=buildFeature('finishTraining', (new TrainingModel())->calculatePriceForInstantTraining(Village::getInstance()->getKid()), false, 0); ?>
                    <?php endif; ?>
                    <?php if ($config->extraSettings->generalOptions->fasterTraining->enabled): ?>
                        <?=buildFeature('fasterTraining_' . $config->extraSettings->generalOptions->fasterTraining->percent, $config->extraSettings->generalOptions->fasterTraining->coins, false, $config->extraSettings->generalOptions->fasterTraining->duration); ?>
                    <?php endif; ?>
                    <?php if ($config->extraSettings->generalOptions->cancelTrainingQueue->enabled): ?>
                        <?=buildFeature('cancelTrainingQueue', $config->extraSettings->generalOptions->cancelTrainingQueue->coins, false, 0); ?>
                    <?php endif; ?>
                    <?php if ($config->extraSettings->generalOptions->smithyUpgradeAllToMax->enabled): ?>
                        <?=buildFeature('smithyUpgradeAllToMax', $config->extraSettings->generalOptions->smithyUpgradeAllToMax->coins, false, 0); ?>
                    <?php endif; ?>
                    <?php if ($config->extraSettings->generalOptions->academyResearchAll->enabled): ?>
                        <?=buildFeature('academyResearchAll', $config->extraSettings->generalOptions->academyResearchAll->coins, false, 0); ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <?php if ($vars['enabledFeatures']['buyResources']):$step++; ?>
                <div
                        class="paymentWizardMenu <?=$order['buyResources'] == 1 ? '' : 'hide'; ?>"
                        id="buyResources">
                    <?php
                    $packages = $config->extraSettings->buyResources['packages'];
                    $single_packages = array_filter($packages, function($elem){return $elem['is_single'];});
                    $combo_packages = array_filter($packages, function($elem){return !$elem['is_single'];});
                    
                    echo buildSingleResourcesFeature($single_packages, true);
                    echo buildComboResourcesFeature($combo_packages, true);
                    if ($config->extraSettings->buyResources['buyInterval'] > 0) {
                        $buyInterval = $config->extraSettings->buyResources['buyInterval'];
                        $timeUnit = TimezoneHelper::getIntervalUnit($buyInterval);
                        echo '<h5 class="warning">' . sprintf(T("PaymentWizard", "You can buy resources every %s %s"), $timeUnit['time'], $timeUnit['unit']) . '</h5>';
                    }
                    ?>
                </div>
            <?php endif; ?>
            <?php if ($vars['enabledFeatures']['buyBuildings']):$step++; ?>
                <div class="paymentWizardMenu <?=$order['buyBuildings'] == 1 ? '' : 'hide'; ?>" id="buyBuildings">
                    <?php 
                    foreach ($config->extraSettings->buyBuildings['packages'] as $name => $package) {
                        echo buildBuildings('buyBuildings'.$name, $package->name, (isset($package->coinsCapital) && Village::getInstance()->isCapital())? $package->coinsCapital : $package->coins, false, 0, $package->bid);
                    }
                    ?>
                </div>
            <?php endif; ?>
            <?php if ($vars['enabledFeatures']['buyTroops']):$step++; ?>
                <div class="paymentWizardMenu <?=$order['buyTroops'] == 1 ? '' : 'hide'; ?>" id="buyTroops">
                    <?php
                    //Session::getInstance()->getRace()
                    foreach ($config->extraSettings->buyTroops['packages'] as $troopId => $packages) {
                        echo buildTroopsFeature($troopId, $packages, true);
                    }
                    if ($config->extraSettings->buyTroops['buyInterval'] > 0) {
                        $buyInterval = $config->extraSettings->buyTroops['buyInterval'];
                        $timeUnit = TimezoneHelper::getIntervalUnit($buyInterval);
                        echo '<h5 class="warning">' . sprintf(T("PaymentWizard", "You can buy troops every %s %s"), $timeUnit['time'], $timeUnit['unit']) . '</h5>';
                    }
                    ?>
                </div>
            <?php endif; ?>
            <?php if ($vars['enabledFeatures']['buyAnimal']):$step++; ?>
                <div
                        class="paymentWizardMenu <?=$order['buyAnimal'] == 1 ? '' : 'hide'; ?>"
                        id="buyAnimal">
                    <?php
                    foreach ($config->extraSettings->buyAnimal['packages'] as $index => $package) {
                        echo buildAnimalFeature('buyAnimal' . $index, $package['modifier'], $package['coins'], true, $package['delivery']);
                    }
                    if ($config->extraSettings->buyAnimal['buyInterval'] > 0) {
                        $buyInterval = $config->extraSettings->buyAnimal['buyInterval'];
                        $timeUnit = TimezoneHelper::getIntervalUnit($buyInterval);
                        echo '<h5 class="warning">' . sprintf(T("PaymentWizard", "You can buy animals every %s %s"), $timeUnit['time'], $timeUnit['unit']) . '</h5>';
                    }
                    ?>
                </div>
            <?php endif; ?>
            <?php if ($vars['enabledFeatures']['extraPower']):$step++; ?>
                <div class="paymentWizardMenu <?=$order['power'] == 1 ? '' : 'hide'; ?>" id="power">
                    <?php if ($config->extraSettings->power->atkBonus->enabled): ?>
                        <?=buildFeature('atkBonus_' . $config->extraSettings->power->atkBonus->percent, $config->extraSettings->power->atkBonus->coins, true, $config->extraSettings->power->atkBonus->duration); ?>
                    <?php endif; ?>
                    <?php if ($config->extraSettings->power->atkBonus->enabled): ?>
                        <?=buildFeature('defBonus_' . $config->extraSettings->power->defBonus->percent, $config->extraSettings->power->defBonus->coins, true, $config->extraSettings->power->defBonus->duration); ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <?php if ($vars['enabledFeatures']['moreProtection']):$step++; ?>
                <div class="paymentWizardMenu <?=$order['moreProtection'] == 1 ? '' : 'hide'; ?>"
                     id="moreProtection">
                    <?php
                    if (Session::getInstance()->hasProtection()) {
                        echo '<h5 class="round">' . sprintf(T("PaymentWizard", "You have %s hour(s) of protection left"), secondsToString(Session::getInstance()->protectionTill() - time())) . '</h5>';
                    } else {
                        echo '<h5 class="round">' . T("PaymentWizard", "You have no protection left") . '</h5>';
                    }
                    ?>
                    <br/>
                    <?php
                    foreach ($config->extraSettings->moreProtection->packages as $index => $package) {
                        if (!$package['enabled']) continue;
                        echo buildFeature('moreProtection' . $index, $package['coins'], false, $package['duration']);
                    }
                    echo '<h5 class="warning">' . sprintf(T("PaymentWizard", "You can buy %s hour(s) of protection per day"), $config->extraSettings->moreProtection->maxPerDay) . '</h5>';
                    ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
