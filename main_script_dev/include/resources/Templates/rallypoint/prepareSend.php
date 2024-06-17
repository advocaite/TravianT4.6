<div class="a2b">
    <form method="post" action="build.php?id=39&amp;tt=2">
        <table id="short_info" cellpadding="1" cellspacing="1">
            <tbody>
            <tr>
                <th><?=T("RallyPoint", "target");?>:</th>
                <td><?=$vars['process']['settings']['to']['villageName'];?>
                    <a class="" href="karte.php?x=<?=$vars['process']['settings']['to']['x'];?>&amp;y=<?=$vars['process']['settings']['to']['y'];?>">
                        <span class="coordinates coordinatesWrapper"><span class="coordinateX">(&#8238;&#8237;<?=$vars['process']['settings']['to']['x'];?>&#8236;&#8236;</span><span class="coordinatePipe">|</span><span class="coordinateY">&#8238;&#8237;<?=$vars['process']['settings']['to']['y'];?>&#8236;&#8236;)</span></span>
                    </a>
                </td>
            </tr>
            <tr>
                <th><?=T("RallyPoint", "player");?>:</th>
                <td><a href="spieler.php?uid=<?=$vars['process']['settings']['to']['uid'];?>"><?=$vars['process']['settings']['to']['playerName'];?></a>
                </td>
            </tr>
            </tbody>
        </table>
        <?=$vars['process']['settings']['troop_details'];?>
        <?php if($vars['process']['settings']['redeployHero']):?>
        <p><?=sprintf(T("RallyPoint", "Changed successfully: %s will be the new home village for hero"), $vars['process']['settings']['to']['villageName']);?></p>
        <?php endif;?>
        <?php if($vars['process']['settings']['redeployHero']):?>
        <input type="hidden" name="redeployHero" value="1"/>
        <?php endif;?>
        <input type="hidden" name="timestamp" value="<?=$vars['process']['settings']['timestamp'];?>"/>
        <input type="hidden" name="timestamp_checksum" value="<?=$vars['process']['settings']['timestamp_checksum'];?>"/>
        <input type="hidden" name="id" value="39"/>
        <input type="hidden" name="a" value="<?=$vars['process']['settings']['a2bId'];?>"/>
        <input type="hidden" name="c" value="<?=$vars['process']['settings']['attack_type'];?>"/>
        <input type="hidden" name="kid" value="<?=$vars['process']['settings']['to']['kid'];?>"/>
        <input type="hidden" name="t1" value="<?=$vars['process']['settings']['units'][1];?>"/>
        <input type="hidden" name="t2" value="<?=$vars['process']['settings']['units'][2];?>"/>
        <input type="hidden" name="t3" value="<?=$vars['process']['settings']['units'][3];?>"/>
        <input type="hidden" name="t4" value="<?=$vars['process']['settings']['units'][4];?>"/>
        <input type="hidden" name="t5" value="<?=$vars['process']['settings']['units'][5];?>"/>
        <input type="hidden" name="t6" value="<?=$vars['process']['settings']['units'][6];?>"/>
        <input type="hidden" name="t7" value="<?=$vars['process']['settings']['units'][7];?>"/>
        <input type="hidden" name="t8" value="<?=$vars['process']['settings']['units'][8];?>"/>
        <input type="hidden" name="t9" value="<?=$vars['process']['settings']['units'][9];?>"/>
        <input type="hidden" name="t10" value="<?=$vars['process']['settings']['units'][10];?>"/>
        <input type="hidden" name="t11" value="<?=$vars['process']['settings']['units'][11];?>"/>
        <input type="hidden" name="sendReally" value="1"/>
        <input type="hidden" name="troopsSent" value="1"/>
        <input type="hidden" name="currentDid" value="<?=$vars['village']['did'];?>"/>
        <input type="hidden" name="b" value="2"/>
        <input type="hidden" name="dname" value="<?=$vars['process']['settings']['to']['dname'];?>"/>
        <input type="hidden" name="x" value="<?=$vars['process']['settings']['to']['x'];?>"/>
        <input type="hidden" name="y" value="<?=$vars['process']['settings']['to']['y'];?>"/>
        <div id="rallyPointButtonsContainer">
            <button type="submit" value="edit" name="edit" id="btn_edit" class="green ">
                <div class="button-container addHoverClick">
                    <div class="button-background">
                        <div class="buttonStart">
                            <div class="buttonEnd">
                                <div class="buttonMiddle"></div>
                            </div>
                        </div>
                    </div>
                    <div class="button-content"><?=T("RallyPoint", "edit");?></div>
                </div>
            </button>
            <script type="text/javascript" id="btn_edit_script">
                jQuery(function() {
                        jQuery('#btn_edit').click(function (event) {
                            jQuery(window).trigger('buttonClicked', [this, {"type":"submit","value":"edit","name":"edit","id":"btn_edit","class":"green ","title":"<?=T("RallyPoint", "edit");?>","confirm":"","onclick":""}]);
                        });
                });
            </script>
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
            <script type="text/javascript" id="btn_ok_script">
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
        </div>
    </form>
    <?php if($vars['process']['error']):?>
        <p class="error"><?=$vars['process']['errorMsg'];?></p>
    <?php endif;?>
</div>