<div class="a2b">
    <form method="post" name="snd" action="build.php?id=39&amp;tt=2">
        <input type="hidden" name="timestamp" value="<?php use Core\Session;
        echo $vars['timestamp'];?>"/>
        <input type="hidden" name="timestamp_checksum" value="<?=$vars['timestamp_checksum'];?>"/>
        <input type="hidden" name="b" value="1"/>
        <input type="hidden" name="currentDid" value="<?=$vars['village']['did'];?>"/>
        <?=getCheckerInput();?>
        <table id="troops" cellpadding="1" cellspacing="1">
            <?=$vars['troopsTable'];?>
        </table>

        <div class="destination">
            <div class="boxes boxesColor gray">
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
                    <table cellpadding="0" cellspacing="0" class="transparent compact">
                        <tbody>
                        <tr>
                            <td><span><?=T("RallyPoint", "Village");?>:</span></td>
                            <td class="compactInput"><input type="text" id="enterVillageName"
                                                            class="text village" name="dname" value="<?=$vars['to']['dname'];?>"
                                                            maxlength="25"/></td>
                        </tr>
                        </tbody>
                    </table>

                    <table cellpadding="0" cellspacing="0" class="transparent compact">
                        <tbody>
                        <tr>
                            <td><span class="or"><?=T("RallyPoint", "or");?></span>

                                <div class="coordinatesInput">
                                    <div class="xCoord">
                                        <label for="xCoordInput">X:</label>
                                        <input type="text" maxlength="4" value="<?=$vars['to']['x'];?>" name="x" id="xCoordInput"
                                               class="text coordinates x "/>
                                    </div>
                                    <div class="yCoord">
                                        <label for="yCoordInput">Y:</label>
                                        <input type="text" maxlength="4" value="<?=$vars['to']['y'];?>" name="y" id="yCoordInput"
                                               class="text coordinates y "/>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                <div class="clear"></div>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <script type="text/javascript">
                        jQuery(function() {
                            new Travian.Game.AutoCompleter.VillageName('enterVillageName');
                        });
                    </script>

                </div>
            </div>
        </div>

        <div class="option">
            <label> <input type="radio" class="radio" name="c" value="2"
                    <?=$vars['attackTypes'][2]['checked'] ? 'checked="checked"' : '';?>
                    <?=$vars['attackTypes'][2]['disabled'] ? 'disabled="disabled"' : '';?>
                    />
                <?=T("RallyPoint", "reinforcement");?>        </label>
            <br/> <label> <input type="radio" class="radio" name="c"
                    <?=$vars['attackTypes'][3]['checked'] ? 'checked="checked"' : '';?>
                    <?=$vars['attackTypes'][3]['disabled'] ? 'disabled="disabled"' : '';?>
                                 value="3"/>
                <?=T("RallyPoint", "attack");?>: <?=T("RallyPoint", "normal");?>        </label> <br/> <label> <input
                    type="radio" class="radio" name="c"
                    value="4"
                    <?=$vars['attackTypes'][4]['checked'] ? 'checked="checked"' : '';?>
                    <?=$vars['attackTypes'][4]['disabled'] ? 'disabled="disabled"' : '';?>
                    />
                <?=T("RallyPoint", "attack");?>: <?=T("RallyPoint", "raid");?>        </label>

        </div>
        <?php if($vars['showHeroChangeHomeCheckBox']):?>
            <div class="redeployHero">
                <label><input class="redeployHeroSetting check"
                              type="checkbox" <?=$vars['process']['settings']['redeployHero'] ? 'checked="checked="checked"' : '';?>
                              name="redeployHero" value="1"/><?=T("RallyPoint", "changeHeroHomeVillage");?></label>
            </div>
        <?php endif;?>
        <div class="clear"></div>
        <button type="submit" value="ok" name="s1" id="btn_ok" class="green " title="<?=T("RallyPoint", "send");?>">
            <div class="button-container addHoverClick">
                <div class="button-background">
                    <div class="buttonStart">
                        <div class="buttonEnd">
                            <div class="buttonMiddle"></div>
                        </div>
                    </div>
                </div>
                <div class="button-content"><?=T("RallyPoint", "send");?></div>
            </div>
        </button>
        <script type="text/javascript">
            jQuery(function() {
                if (jQuery('#btn_ok')) {
                    jQuery('#btn_ok').click(function (event) {
                        jQuery(window).trigger('buttonClicked', [this, {
                            "type": "submit",
                            "value": "<?=T("RallyPoint", "send");?>",
                            "name": "s1",
                            "id": "btn_ok",
                            "class": "green ",
                            "title": "<?=T("RallyPoint", "send");?>",
                            "confirm": "",
                            "onclick": ""
                        }]);
                    });
                }
            });
        </script>
    </form>
    <?php if($vars['process']['beforeError']):?>
        <p class="error"><?=$vars['process']['beforeErrorMsg'];?></p>
    <?php endif;?>

</div>