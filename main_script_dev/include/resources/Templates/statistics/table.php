<h4 class="round"><?php use Core\Session;echo $vars['headerRound'];?></h4>
<?php if(Session::getInstance()->isAdmin()):?>
<style type="text/css">
    div.statistics td.pla {
        max-width: none;
    }
</style>
<?php endif;?>
<table cellpadding="1" cellspacing="1" style=" border-collapse: collapse;
    background-color: transparent;"id="<?=$vars['tableId']; ?>"
       class="row_table_data">
    <thead style="vertical-align: middle;
    text-align: left;
    padding: 0;
    font-weight: 400;
    font-size: 13px;
    background-color: #fff;">
    <?=$vars['tableColumns'];?>
    </thead>
    <tbody style="border: 1px solid silver;
    border-top: none;
    background-color: #fefdf8;">
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
                <table class="transparent" >
                    <tr style="    float: left;
                                margin-top: 15px;
                                padding: 0 10px
                                    px
                                        ;
                        background-color: #e7e7e7;
                            border-radius: 5px;">
                        <td><span>
								<?=T("Statistics", "Rank");?> <input type="text" class="text ra"
                                                                     maxlength="5" name="rank"
                                                                     value="<?=$vars['selectedRank'];?>"/>
						</span></td>
                        <td><span>
								<?=T("Global", "or");?> <?=T("Statistics", "name");?>: <input type="text"
                                                                                                      class="text name"
                                                                                                      maxlength="20"
                                                                                                      name="name"
                                                                                                      value="<?=$vars['selectedName'];?>"/>
						</span></td>
                        <td>
                            <button type="submit" value="<?=T("Global", " OK ");?>" name="submit" id="submit" class="textButtonV1 green " version="textButtonV1"><?=T("Global", " OK ");?></button>
							<script type="text/javascript">
                                jQuery(function() {
                                    if (jQuery('#submit')) {
                                        jQuery('#submit').click(function (event) {
                                            jQuery(window).trigger('buttonClicked', [this, {
                                                "type": "submit",
                                                "value": "<?=T("Global", " OK ");?>",
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