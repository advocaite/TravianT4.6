<div id="vid">
    <div class="ffBug"></div>
    <div class="greenbox boxVidInfo ">
        <div class="greenbox-top"></div>
        <div class="greenbox-content"><?=T("activation", "thanksForActivation");?></div>
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
                <form method="post" action="activate.php?page=vid">
                    <input type="hidden" name="vid" value="">

                    <div class="container">
                        <div class="vidDescription"><?=T("activation", "pleaseChooseATribe");?>
                            <br><?=T("activation", "vidDescription");?></div>
                        <div class="vidSelect">
                            <div class="kind">
                                <div id="vid3" class="vid vid3 vid3Active"></div>
                                <div id="vid1" class="vid vid1 "></div>
                                <div id="vid2" class="vid vid2"></div>
                            </div>
                            <div class="description-container">
                                <div class="description vid1 vid1Highlight" style="display: none; ">
                                    <div class="bubble"></div>
                                    <div class="text">
                                        <div class="headline"><?=T("Global", "races.1");?></div>
                                        <div class="text">
                                            <div class="special"><?=T("activation", "attributes");?>:</div>
                                            <ul>
                                                <li><?=T("activation", "race1_attributes.0");?><br></li>
                                                <li><?=T("activation", "race1_attributes.1");?><br></li>
                                                <li><?=T("activation", "race1_attributes.2");?></li>
                                                <li><?=T("activation", "race1_attributes.3");?></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="avatar vid1 vid1Highlight"></div>
                                </div>
                                <div class="description vid2 vid2Highlight" style="display: none; ">
                                    <div class="bubble"></div>
                                    <div class="text">
                                        <div class="headline"><?=T("Global", "races.2");?></div>
                                        <div class="text">
                                            <div class="special"><?=T("activation", "attributes");?>:</div>
                                            <ul>
                                                <li><?=T("activation", "race2_attributes.0");?><br></li>
                                                <li><?=T("activation", "race2_attributes.1");?></li>
                                                <li><?=T("activation", "race2_attributes.2");?></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="avatar vid2"></div>
                                </div>
                                <div class="description vid3 vid3Active" style="display: block; ">
                                    <div class="bubble"></div>
                                    <div class="text">
                                        <div class="headline"><?=T("Global", "races.3");?></div>
                                        <div class="text">
                                            <div class="special"><?=T("activation", "attributes");?>:</div>
                                            <ul>
                                                <li><?=T("activation", "race3_attributes.0");?><br></li>
                                                <li><?=T("activation", "race3_attributes.1");?><br></li>
                                                <li><?=T("activation", "race3_attributes.2");?><br></li>
                                                <li><?=T("activation", "race3_attributes.3");?></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="avatar vid3 vid3Active"></div>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="submitButton">
                        <button type="submit" value="submitKind" name="s1" id="submitKind" class="green ">
                            <div class="button-container addHoverClick">
                                <div class="button-background">
                                    <div class="buttonStart">
                                        <div class="buttonEnd">
                                            <div class="buttonMiddle"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="button-content"><?=T("activation", "submitKind");?></div>
                            </div>
                        </button>
                        <script type="text/javascript">
                            jQuery(function() {
                                if (jQuery('#submitKind')) {
                                    jQuery('#submitKind').click(function (event) {
                                        jQuery(window).trigger('buttonClicked', [this, {
                                            "type": "submit",
                                            "value": "<?=T("activation", "submitKind");?>",
                                            "name": "s1",
                                            "id": "submitKind",
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
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var vid = new Travian.Game.Vid('vid3');
</script>
<div id="tpixeliframe_loading" style="display: none; z-index: 1000; position: absolute; top: 0px; left: 0px; width: 100%; height: 100%; background-color:#000; opacity:0.4; -moz-opacity:0.4; FILTER:progid:DXImageTransform.Microsoft.Alpha(opacity=40);"></div>
<script type="text/javascript">
    //<!--
    var tg_load_handler = function() {
        document.getElementById("tpixeliframe_loading").style.display = "none";
    };
    setTimeout(tg_load_handler, 1000);

    window.onload = function() {
        tg_iframe = document.getElementById("tpixeliframe");
        tg_iframe.onload = tg_load_handler;
    };
    document.getElementById("tpixeliframe_loading").style.display = "block";
    //-->
</script>