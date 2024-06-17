<div class="bonus-donation-gold">
    <img class="res_big" src="img/x.gif">
    <div class="bonus-donation-gold-container">
        <div class="bonus-donation-gold-title">
            <?=T("AllianceBonus", "Your contribution will be tripled");?>
        </div>
        <div class="bonus-donation-gold-start-value">
            <?=sprintf(T("AllianceBonus", "Contribution: %s resources"), array_sum($vars['resources']));?>
            <div class="bonus-donation-gold-arrowMultiply">
                x 3
            </div>
        </div>
        <div class="bonus-donation-gold-outcome-value">
            <?=sprintf(T("AllianceBonus", "Tripled: %s resources"), '<strong>'.(3*array_sum($vars['resources'])).'</strong>');?>
        </div>
        <div class="bonus-donation-buttons-popup">
                <span id="buttonDonate">
                    <?php
                    use Core\Config;
                    $wayOfPayment = ['featureKey' => 'AllianceBonusDonation', 'context' => '', 'closeAllDialogs' => true];
                    $data = [
                        "data" => [
                            "type" => "button",
                            'value' => T("AllianceBonus", "Contribute"),
                            'confirm' => '',
                            'onclick' => 'Travian.Game.AllianceDonation.donate(\'donateGoldConfirm\', this.id, Travian.Game.AllianceDonation.getDonationParams(\'donateGoldConfirm\', this))',
                            'wayOfPayment' => $wayOfPayment,
                        ]
                    ];

                    if($vars['goldIsAvailable']){
                        unset($data['data']['wayOfPayment']);
                    } else {
                        unset($data['data']['onclick']);
                    }
                    echo getButton(
                        ['id' => 'donate_gold_confirm',
                            "type" => "button",
                            "class" => "gold ",
                            'title' => '',
                            'coins' => Config::getProperty("gold", "allianceBonus3xGold")
                        ],
                        $data, T("AllianceBonus", "Contribute"));
                    ?>
</span>
        </div>
        <span id="donateGoldConfirmSum" class="hide"><?=(array_sum($vars['resources']) * 3);?></span>
        <input type="hidden" id="donateGoldConfirm1" value="<?=$vars['resources'][0];?>">
        <input type="hidden" id="donateGoldConfirm2" value="<?=$vars['resources'][1];?>">
        <input type="hidden" id="donateGoldConfirm3" value="<?=$vars['resources'][2];?>">
        <input type="hidden" id="donateGoldConfirm4" value="<?=$vars['resources'][3];?>">
    </div>
</div>