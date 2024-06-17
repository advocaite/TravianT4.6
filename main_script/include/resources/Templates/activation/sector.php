<div id="sector">
    <form method="post" action="activate.php?page=sector">
        <div class="ffBug"></div>

        <div class="greenbox boxVidInfo">
            <div class="greenbox-top"></div>
            <div class="greenbox-content">
                <?=$vars['vidSelected'];?>
                <div class="changeVid"><a href="activate.php?page=vid"><?=T("activation", "changeVid");?></a></div>
            </div>
            <div class="greenbox-bottom"></div>
            <div class="clear"></div>
        </div>
        <div class="boxes boxGrey boxesColor gray">
            <div class="boxes-tl"></div>
            <div class="boxes-tr"></div>
            <div class="boxes-tc"></div>
            <div class="boxes-ml"></div>
            <div class="boxes-mr"></div>
            <div class="boxes-mc"></div>
            <div class="boxes-bl"></div>
            <div class="boxes-br"></div>
            <div class="boxes-bc"></div>
            <div class="boxes-contents cf">
                <div class="content">
                    <div class="sectorDescription"><?=T("activation", "sectorDescription");?></div>
                    <div class="sectorSelect">
                        <div class="map">
                            <div id="nw" class="sector nw a">
                                <div class="highlight "></div>
                            </div>
                            <div id="ne" class="sector ne a">
                                <div class="highlight active"></div>
                            </div>
                            <div id="sw" class="sector sw a">
                                <div class="highlight "></div>
                            </div>
                            <div id="se" class="sector se a">
                                <div class="highlight "></div>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="start">
                            <div class="center">
                                <select name="sector">
                                    <option value="nw"><?=T("activation", "sector_nw");?></option>
                                    <option value="ne"><?=T("activation", "sector_ne");?></option>
                                    <option value="sw"><?=T("activation", "sector_sw");?></option>
                                    <option value="se"><?=T("activation", "sector_se");?></option>
                                </select>
                            </div>
                        </div>
                        <div class="buttonContainer">
                            <button type="submit" value="submitSector" name="s1" id="submitSector" class="green ">
                                <div class="button-container addHoverClick">
                                    <div class="button-background">
                                        <div class="buttonStart">
                                            <div class="buttonEnd">
                                                <div class="buttonMiddle"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-content"><?=T("activation", "submitSector");?></div>
                                </div>
                            </button>
                            <script type="text/javascript">
                                jQuery(function() {
                                    if (jQuery('#submitSector')) {
                                        jQuery('#submitSector').click(function (event) {
                                            jQuery(window).trigger('buttonClicked', [this, {
                                                "type": "submit",
                                                "value": "<?=T("activation", "submitSector");?>",
                                                "name": "s1",
                                                "id": "submitSector",
                                                "class": "green ",
                                                "title": "",
                                                "confirm": "",
                                                "onclick": ""
                                            }]);
                                        });
                                    }
                                });
                            </script>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="avatar vid<?=$vars['vid'];?>"></div>
                </div>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
    var sector = new Travian.Game.Sector('ne');
</script>
<div class="clear"></div>