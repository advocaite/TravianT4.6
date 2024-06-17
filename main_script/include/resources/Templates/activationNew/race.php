<div class="activationScreen">
    <?=T("ActivationNew", "vidSelectDescription");?>
    <form method="post" action="activate.php?page=vid">
        <div id="presentation">
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
                    <path class="outer" d="M10 10 V230 H20 l20 20 l20 -20 H530 V10 Z"></path>
                    <path class="inner" filter="url(#inset)" d="M10 10 V230 H20 l20 20 l20 -20 H530 V10 Z"></path>
                </g>
            </svg>

            <div id="tribeSelectors">
                <input type="radio" name="vid" value="3" id="tribe3" checked="checked" />
                <label class="selector" for="tribe3"></label>
                <div class="tribeDescription" data-text="<?=T("ActivationNew", "recommendedForNewPlayers");?>">
                    <h2><?=T("Global", "races.3");?></h2>
                    <ul>
                        <?php foreach(T("ActivationNew", "race3_attributes") as $text):?>
                            <li><?=$text;?></li>
                        <?php endforeach;?>
                    </ul>
                </div>
                <input type="radio" name="vid" value="1" id="tribe1" />
                <label class="selector" for="tribe1"></label>
                <div class="tribeDescription">
                    <h2><?=T("Global", "races.1");?></h2>
                    <ul>
                        <?php foreach(T("ActivationNew", "race1_attributes") as $text):?>
                        <li><?=$text;?></li>
                        <?php endforeach;?>
                    </ul>
                </div>
                <input type="radio" name="vid" value="2" id="tribe2" />
                <label class="selector" for="tribe2"></label>
                <div class="tribeDescription">
                    <h2><?=T("Global", "races.2");?></h2>
                    <ul>
                        <?php foreach(T("ActivationNew", "race2_attributes") as $text):?>
                            <li><?=$text;?></li>
                        <?php endforeach;?>
                    </ul>
                </div>
                <?php if(in_array(6, $vars['tribes'])):?>
                    <input type="radio" name="vid" value="6" id="tribe6" />
                    <label class="selector" for="tribe6" data-text="<?=T("ActivationNew", "New");?>"></label>
                    <div class="tribeDescription">
                        <h2><?=T("Global", "races.6");?></h2>
                        <ul>
                            <?php foreach(T("ActivationNew", "race6_attributes") as $text):?>
                                <li><?=$text;?></li>
                            <?php endforeach;?>
                        </ul>
                    </div>
                    <!--- ADD NEW ICON --->
                <?php endif;?>
                <?php if(in_array(7, $vars['tribes'])):?>
                    <input type="radio" name="vid" value="7" id="tribe7" />
                    <label class="selector" for="tribe7" data-text="<?=T("ActivationNew", "New");?>"></label>
                    <div class="tribeDescription">
                        <h2><?=T("Global", "races.7");?></h2>
                        <ul>
                            <?php foreach(T("ActivationNew", "race7_attributes") as $text):?>
                                <li><?=$text;?></li>
                            <?php endforeach;?>
                        </ul>
                    </div>
                    <!--- ADD NEW ICON --->
                <?php endif;?>
            </div>
        </div>
        <div class="buttonContainer">
            <button type="submit" value="<?=T("ActivationNew", "Confirm");?>" id="<?=$button_id=get_button_id();?>" class="orange ">
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

<script type="text/javascript">
    jQuery(function() {
        new Travian.Game.Activation();
        //Travian.Game.WelcomeScreen.show();
    });
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