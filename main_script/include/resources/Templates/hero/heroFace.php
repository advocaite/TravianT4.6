<div id="heroEditor" class="genderSwitch <?=$vars['heroFace']['gender'];?>">
    <div class="hero_head head">
        <div class="tl">
            <div class="tr"></div>
        </div>
        <div class="bl">
            <div class="br"></div>
        </div>
        <div class="image">
            <?=$vars['heroImage'];?>
        </div>
    </div>
    <div class="attributes">
        <div class="boxes boxesColor gender gray">
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
                <div class="gender-container cf">
                    <div class="info">
                        <div class="headline">
                            <div class="title"><?=T("HeroFace", "Gender");?></div>
                        </div>
                        <div id="genderButtons">
                            <button type="button" id="heroEditorActivateMale"
                                    class="icon <?=$vars['heroFace']['gender'] == "male" ? "iconActive disabled" : '';?>"
                                    title="<?=T("HeroFace", "male");?>" <?=$vars['heroFace']['gender'] == "male" ? 'onclick="if(jQuery(this).hasClass(\'disabled\')){event.stopPropagation(); return false;} else {}" onfocus="jQuery(\'button\', \'input[type!=hidden]\', \'select\').focus(); event.stopPropagation(); return false;"'  : '';?>>
                                <img src="img/x.gif" class="heroEditorActivateMale" alt="heroEditorActivateMale"/>
                            </button>
                            <button type="button" id="heroEditorActivateFemale"
                                    class="icon <?=$vars['heroFace']['gender'] == "female" ? "iconActive disabled" : '';?>"
                                    title="<?=T("HeroFace", "female");?>" <?=$vars['heroFace']['gender'] == "female" ? 'onclick="if(jQuery(this).hasClass(\'disabled\')){event.stopPropagation(); return false;} else {}" onfocus="jQuery(\'button\', \'input[type!=hidden]\', \'select\').focus(); event.stopPropagation(); return false;"' : '';?>>
                                <img src="img/x.gif" class="heroEditorActivateFemale" alt="heroEditorActivateFemale"/>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                <div class="container cf" id="attributesContainer">
                    <div class="info" id="headProfile">
                        <div class="headline switchClosed">
                            <a href="#" class="title"><?=T("HeroFace", "headProfile");?></a>

                            <div class="clear"></div>
                        </div>
                        <div class="details">
                            <?=$vars['heroFaceData']['headProfile'];?>
                            <div class="clear"></div>
                        </div>
                    </div>

                    <div class="info" id="hairColor">
                        <div class="headline switchClosed">
                            <a href="#" class="title"><?=T("HeroFace", "hairColor");?></a>

                            <div class="clear"></div>
                        </div>
                        <div class="details">
                            <?=$vars['heroFaceData']['hairColor'];?>
                            <div class="clear"></div>
                        </div>
                    </div>

                    <div class="info" id="hairStyle">
                        <div class="headline switchClosed">
                            <a href="#" class="title"><?=T("HeroFace", "hairStyle");?></a>

                            <div class="clear"></div>
                        </div>
                        <div class="details">
                            <?=$vars['heroFaceData']['hairStyle'];?>
                            <div class="clear"></div>
                        </div>
                    </div>

                    <div class="info" id="ears">
                        <div class="headline switchClosed">
                            <a href="#" class="title"><?=T("HeroFace", "ears");?></a>

                            <div class="clear"></div>
                        </div>
                        <div class="details">
                            <?=$vars['heroFaceData']['ears'];?>
                            <div class="clear"></div>
                        </div>
                    </div>

                    <div class="info" id="eyebrow">
                        <div class="headline switchClosed">
                            <a href="#" class="title"><?=T("HeroFace", "eyebrow");?></a>

                            <div class="clear"></div>
                        </div>
                        <div class="details">
                            <?=$vars['heroFaceData']['eyebrow'];?>
                            <div class="clear"></div>
                        </div>
                    </div>

                    <div class="info" id="eyes">
                        <div class="headline switchClosed">
                            <a href="#" class="title"><?=T("HeroFace", "eyes");?></a>

                            <div class="clear"></div>
                        </div>
                        <div class="details">
                            <?=$vars['heroFaceData']['eyes'];?>
                            <div class="clear"></div>
                        </div>
                    </div>

                    <div class="info" id="nose">
                        <div class="headline switchClosed">
                            <a href="#" class="title"><?=T("HeroFace", "nose");?></a>

                            <div class="clear"></div>
                        </div>
                        <div class="details">
                            <?=$vars['heroFaceData']['nose'];?>
                            <div class="clear"></div>
                        </div>
                    </div>

                    <div class="info" id="mouth">
                        <div class="headline switchClosed">
                            <a href="#" class="title"><?=T("HeroFace", "mouth");?></a>

                            <div class="clear"></div>
                        </div>
                        <div class="details">
                            <?=$vars['heroFaceData']['mouth'];?>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <?php if($vars['heroFace']['gender'] == "male"):?>
                        <div class="info" id="beard">
                            <div class="headline switchClosed">
                                <a href="#" class="title"><?=T("HeroFace", "beard");?></a>

                                <div class="clear"></div>
                            </div>
                            <div class="details">
                                <?=$vars['heroFaceData']['beard'];?>
                                <div class="clear"></div>
                            </div>
                        </div>
                    <?php endif;?>
                </div>
            </div>
        </div>
        <div class="options">
            <form method="post" name="heroRandom" action="hero.php?t=2">
                <button type="submit" value="<?=T("HeroFace", "random");?>" name="random" id="random" class="green ">
                    <div class="button-container addHoverClick hover">
                        <div class="button-background">
                            <div class="buttonStart">
                                <div class="buttonEnd">
                                    <div class="buttonMiddle"></div>
                                </div>
                            </div>
                        </div>
                        <div class="button-content"><?=T("HeroFace", "random");?></div>
                    </div>
                </button>
            </form>
            <form method="post" name="heroSave" action="hero.php?t=2">
                <input type="hidden" name="attributes" value=""/>
                <button type="submit" value="<?=T("HeroFace", "save");?>" name="save" id="save" class="green ">
                    <div class="button-container addHoverClick ">
                        <div class="button-background">
                            <div class="buttonStart">
                                <div class="buttonEnd">
                                    <div class="buttonMiddle"></div>
                                </div>
                            </div>
                        </div>
                        <div class="button-content"><?=T("HeroFace", "save");?></div>
                    </div>
                </button>
            </form>
        </div>
    </div>
    <div class="clear"></div>
</div>

<script type="text/javascript">
    new Travian.Game.Hero.Editor(<?=json_encode($vars['HeroFaceJson'], JSON_PRETTY_PRINT);?>);
</script>