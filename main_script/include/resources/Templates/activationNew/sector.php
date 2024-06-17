<a id="backButton" class="contentTitleButton" href="activate.php?page=vid" title="<?=T("ActivationNew", "back");?>"></a>
<div class="activationScreen">
    <?=T("ActivationNew", "sectorSelectDescription");?>
    <form method="post" action="activate.php?page=confirmation">
        <div id="presentation" class="sectors">
            <div id="activationMapContainer">
                <div id="map" class="">
                    <?php $rand = ['nw', 'no', 'sw', 'so'][mt_rand(0, 3)]; ?>

                    <input type="radio" name="sector" value="nw" id="sector_nw" <?=($rand == 'nw' ? 'checked="checked"' : null);?>>
                    <label for="sector_nw" <?=($rand == 'nw' ? 'data-text="'.T("ActivationNew", "RECOMMENDED").'"' : '');?>><?=T("ActivationNew", "North - West");?></label>

                    <input type="radio" name="sector" value="no" id="sector_no" <?=($rand == 'no' ? 'checked="checked"' : null);?>>
                    <label for="sector_no" <?=($rand == 'no' ? 'data-text="'.T("ActivationNew", "RECOMMENDED").'"' : '');?>><?=T("ActivationNew", "North - East");?></label>

                    <input type="radio" name="sector" value="sw" id="sector_sw" <?=($rand == 'sw' ? 'checked="checked"' : null);?>>
                    <label for="sector_sw" <?=($rand == 'sw' ? 'data-text="'.T("ActivationNew", "RECOMMENDED").'"' : '');?>><?=T("ActivationNew", "South - West");?></label>

                    <input type="radio" name="sector" value="so" id="sector_so" <?=($rand == 'so' ? 'checked="checked"' : null);?>>
                    <label for="sector_so" <?=($rand == 'so' ? 'data-text="'.T("ActivationNew", "RECOMMENDED").'"' : '');?>><?=T("ActivationNew", "South - East");?></label>
                </div>
            </div>
        </div>

        <div class="buttonContainer">
            <button type="submit" value="<?=T("ActivationNew", "Confirm");?>" id="<?=($button_id = get_button_id());?>" class="orange ">
                <div class="button-container addHoverClick">
                    <div class="button-background">
                        <div class="buttonStart">
                            <div class="buttonEnd">
                                <div class="buttonMiddle"></div>
                            </div>
                        </div>
                    </div>
                    <div class="button-content"><?=T("ActivationNew", "Confirm");?></div>
                </div>
            </button>
            <script type="text/javascript" id="<?=$button_id;?>_script">
                jQuery(function() {
                        jQuery('#<?=$button_id;?>').click(function (event) {
                            jQuery(window).trigger('buttonClicked', [this, {"type":"submit","value":"<?=T("ActivationNew", "Confirm");?>","name":"","id":"<?=$button_id;?>","class":"orange ","title":"","confirm":"","onclick":""}]);
                        });
                });
            </script>

        </div>

    </form>
</div>