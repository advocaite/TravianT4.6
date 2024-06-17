<a id="backButton" class="contentTitleButton" href="activate.php?page=sector" title="<?=T("ActivationNew", "back");?>"></a>
<div class="activationScreen">
    <form method="post" action="activate.php?page=dorf">
        <div id="presentation" class="confirmation">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 540 250">
                <filter id="inset" x="0" y="0">
                    <feGaussianBlur stdDeviation="20" result="blur"></feGaussianBlur>
                    <feComposite in2="SourceAlpha" operator="arithmetic" k2="-1" k3="1" result="shadowDiff"></feComposite>
                    <feFlood flood-color="#bb8050"></feFlood>
                    <feComposite in2="shadowDiff" operator="in"></feComposite>
                    <feComposite in2="SourceGraphic" operator="over" result="firstfilter"></feComposite>
                    <feFlood flood-color="#bb8050"></feFlood>
                    <feComposite in2="shadowDiff" operator="in"></feComposite>
                    <feComposite in2="firstfilter" operator="over" result="secondfilter"></feComposite>
                    <feFlood flood-color="#bb8050"></feFlood>
                    <feComposite in2="shadowDiff" operator="in"></feComposite>
                    <feComposite in2="secondfilter" operator="over"></feComposite>
                </filter>
                <g class="descriptionBoxWithArrow">
                    <path class="outer" d="M10 10 V310 H530 V10 Z"></path>
                    <path class="inner" filter="url(#inset)" d="M10 10 V310 H530 V10 Z"></path>
                </g>
            </svg>
            <div id="activationMapContainer">
                <div id="map" class="">
                    <input type="radio" name="sector" value="nw" id="sector_nw" disabled="disabled" <?=($vars['sector'] == 'nw' ? 'checked="checked"' : '');?>>
                    <label for="sector_nw"><?=T("ActivationNew", "North - West");?></label>
                    <input type="radio" name="sector" value="no" id="sector_no" disabled="disabled" <?=(($vars['sector'] == 'no' || $vars['sector'] == 'ne') ? 'checked="checked"' : '');?>>
                    <label for="sector_no"><?=T("ActivationNew", "North - East");?></label>
                    <input type="radio" name="sector" value="sw" id="sector_sw" disabled="disabled" <?=($vars['sector'] == 'sw' ? 'checked="checked"' : '');?>>
                    <label for="sector_sw"><?=T("ActivationNew", "South - West");?></label>
                    <input type="radio" name="sector" value="so" id="sector_so" disabled="disabled" <?=(($vars['sector'] == 'so' || $vars['sector'] == 'se') ? 'checked="checked"' : '');?>>
                    <label for="sector_so"><?=T("ActivationNew", "South - East");?></label>
                </div>
            </div>
            <div id="selectedTribe" class="tribe<?=$vars['race'];?>">
                <input type="hidden" name="vid" value="<?=$vars['race'];?>" />
                <div class="character"></div>
                <h2 class="tribeName"><?=T("Global", "races." . $vars['race']);?></h2>
            </div>
        </div>
        <div class="acceptChallenge">
            <?=T("ActivationNew", "selectionComplete");?>
        </div>
        <div class="buttonContainer">
            <button  type="submit" value="<?=T("ActivationNew", "PLAY NOW");?>" id="<?=($button_id=get_button_id());?>" class="green ">
                <div class="button-container addHoverClick">
                    <div class="button-background">
                        <div class="buttonStart">
                            <div class="buttonEnd">
                                <div class="buttonMiddle"></div>
                            </div>
                        </div>
                    </div>
                    <div class="button-content"><?=T("ActivationNew", "PLAY NOW");?></div>
                </div>
            </button>
            <script type="text/javascript" id="<?=$button_id;?>_script">
                jQuery(function() {
                        jQuery('#<?=$button_id;?>').click(function (event) {
                            jQuery(window).trigger('buttonClicked', [this, {"type":"submit","value":"<?=T("ActivationNew", "PLAY NOW");?>","name":"","id":"<?=$button_id;?>","class":"green ","title":"","confirm":"","onclick":""}]);
                        });
                });
            </script>
            <div id="sparkles">
                <div class="sparkles1"></div>
                <div class="sparkles2"></div>
                <div class="sparkles3"></div>
                <div class="sparkles4"></div>
                <div class="sparkles5"></div>
                <div class="sparkles6"></div>
            </div>
        </div>
    </form>
</div>