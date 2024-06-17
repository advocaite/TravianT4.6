<?php if($vars['showForm']):?>
    <hr />
<form method="post" action="build.php?gid=26&change_capital&s=0">
    <table cellpadding="1" cellspacing="1" class="option quit transparent">
        <tbody>
        <tr>
            <th>
                <?=T("ResidencePalace", "Password");?>:						</th>
            <td>
                <input class="pass text" type="password" name="pw" maxlength="20">
            </td>
        </tr>
        </tbody>
    </table>
    <p class="option">
        <button type="submit" value="ok" name="s1" id="btn_ok" class="green " title="<?=T("Global", "General.ok");?>">
            <div class="button-container addHoverClick ">
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
            jQuery(function()
            {
                    jQuery('#btn_ok').click(function (event)
                    {
                        jQuery(window).trigger('buttonClicked', [this, {"type":"submit","value":"ok","name":"s1","id":"btn_ok","class":"green ","title":"<?=T("Global", "General.ok");?>","confirm":"","onclick":""}]);
                    });
            });
        </script>
    </p>
</form>
    <p class="error option">
        <?=$vars['error'];?>
    </p>
<?php else:?>
    <?php if($vars['isCapital']):?>
        <p class="none"><?=T("ResidencePalace", "This is your capital");?></p>
    <?php elseif($vars['isWW']):?>
        <a class="a arrow disabled" title="<?=T("ResidencePalace", "Cant set ww as capital");?>">
            <?=T("ResidencePalace", "ChangeCapital");?>
        </a>
    <?php else:?>
        <a onclick="return (function() {
                (new Travian.Dialog.Dialog({
                preventFormSubmit: true,
                onOkay: function(dialog, contentElement) {window.location.href = 'build.php?gid=26&change_capital'}}))
                .setContent('<?=T("ResidencePalace", "ConfirmChangeCapital");?>')
                .show();
                return false;
                })()" class="a arrow">
            <?=T("ResidencePalace", "ChangeCapital");?>
        </a>
    <?php endif;?>
<?php endif;?>

