<h4 class="round"><?php use Core\Session;echo $vars['headerRound'];?></h4>
<?php if(Session::getInstance()->isAdmin()):?>
<style type="text/css">
    div.statistics td.pla {
        max-width: none;
    }
</style>
<?php endif;?>
<table cellpadding="1" cellspacing="1" id="<?=$vars['tableId'];?>"
       class="row_table_data">
    <thead>
    <?=$vars['tableColumns'];?>
    </thead>
    <tbody>
    <?=$vars['tableBody'];?>
    </tbody>
</table>
<div id="search_navi">
    <form method="post" action="statistiken.php<?=$vars['http_query'];?>">
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
                <table class="transparent">
                    <tr>
                        <td><span>
								<?=T("Statistics", "rank");?> <input type="text" class="text ra"
                                                                     maxlength="5" name="rank"
                                                                     value="<?=$vars['selectedRank'];?>"/>
						</span></td>
                        <td><span>
								<?=T("Global", "General.or");?> <?=T("Statistics", "name");?>: <input type="text"
                                                                                                      class="text name"
                                                                                                      maxlength="20"
                                                                                                      name="name"
                                                                                                      value="<?=$vars['selectedName'];?>"/>
						</span></td>
                        <td>
                            <button type="submit" value="<?=T("Global", "General.ok");?>" name="submit" id="submit"
                                    class="green ">
                                <div class="button-container addHoverClick">
                                    <div class="button-background">
                                        <div class="buttonStart">
                                            <div class="buttonEnd">
                                                <div class="buttonMiddle"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-content"><?=T("Global", "General.ok");?></div>
                                </div>
                            </button>
                            <script type="text/javascript">
                                jQuery(function() {
                                    if (jQuery('#submit')) {
                                        jQuery('#submit').click(function (event) {
                                            jQuery(window).trigger('buttonClicked', [this, {
                                                "type": "submit",
                                                "value": "<?=T("Global", "General.ok");?>",
                                                "name": "submit",
                                                "id": "submit",
                                                "class": "green ",
                                                "title": "",
                                                "confirm": "",
                                                "onclick": ""
                                            }]);
                                        });
                                    }
                                });
                            </script>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </form>
    <?=$vars['Navigator'];?>
    <div class="clear"></div>
</div>