<h4 class="spacer round"><?=T("MarketPlace", "Trade routes");?></h4>
<div class="build_desc">
    <?=T("MarketPlace", "tradeRouteDesc");?>
    <br/>
    <button type="button" class="gold builder " id="<?=$vars['goldClubButtonId'];?>">
        <div class="button-container addHoverClick">
            <div class="button-background">
                <div class="buttonStart">
                    <div class="buttonEnd">
                        <div class="buttonMiddle"></div>
                    </div>
                </div>
            </div>
            <div class="button-content"><?=T("MarketPlace", "GoldClub");?></div>
        </div>
    </button>
    <script type="text/javascript">
        jQuery(function() {
            if (jQuery('#<?=$vars['goldClubButtonId'];?>')) {
                jQuery('#<?=$vars['goldClubButtonId'];?>').click(function (event) {
                    jQuery(window).trigger('buttonClicked', [this, {
                        "type": "button",
                        "class": "gold builder ",
                        "value": "<?=T("MarketPlace", "GoldClub");?>",
                        "goldclubDialog": {
                            "featureKey": "tradeRoute",
                            "infoIcon": "http:\/\/t4.answers.travian.com\/index.php?aid=Travian Answers#go2answer"
                        },
                        "title": "<?=T("MarketPlace", "Trade routes");?>||<?=T("MarketPlace", "needToBeActive");?>",
                        "id": "<?=$vars['goldClubButtonId'];?>"
                    }]);
                });
            }
        });
    </script>
</div>