<h4 class="round"><?=T(
        "Buildings", "mainBuilding.Demolish building"
    ); ?></h4>
<p><?=T("Buildings", "mainBuilding.demolish_desc"); ?></p>
<?php if ($vars['isDemolishing'] == false): ?>
<form class="demolish_building" action="build.php?gid=15" method="post">
    <input type="hidden" name="gid" value="15"/>
    <input type="hidden" name="a" value="127"/>
    <input type="hidden" name="c" value="<?=$vars['checker']; ?>"/>

    <select id="demolish" name="abriss" class="dropdown">
        <?php foreach ($vars['options'] as $key => $option): ?>
            <option value="<?=$key; ?>"><?=$key; ?>
                . <?=T(
                    "Buildings", $option['itemId'].'.title'
                ); ?> <?=$option['level']; ?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit" value="demolish" id="btn_demolish" class="green ">
        <div class="button-container addHoverClick">
            <div class="button-background">
                <div class="buttonStart">
                    <div class="buttonEnd">
                        <div class="buttonMiddle"></div>
                    </div>
                </div>
            </div>
            <div class="button-content"><?=T(
                    "Buildings", "mainBuilding.demolish"
                ); ?></div>
        </div>
    </button>
    <script type="text/javascript">
        jQuery(function() {
            if (jQuery('#btn_demolish')) {
                jQuery('#btn_demolish').click(function (event) {
                    jQuery(window).trigger('buttonClicked', [this, {
                        "type": "submit",
                        "value": "<?=T("Buildings", "mainBuilding.demolish");?>",
                        "name": "",
                        "id": "btn_demolish",
                        "class": "green ",
                        "title": "",
                        "confirm": "",
                        "onclick": ""
                    }]);
                });
            }
        });
    </script>
    <div class="demolishNow">
        <?=$vars['demolishNow']; ?>
    </div>
    <script type="text/javascript">
        function getGid() {
            var gidSelect = jQuery('#demolish');
            return {additionalData: {gid: gidSelect.val()}};
        }
    </script>
    <?php else: ?>
        <table cellpadding="1" cellspacing="1" id="demolish"
               class="transparent">
            <tr>
                <td class="abort">
                    <button type="button" class="icon "
                            title="<?=T("Global", "General.cancel"); ?>"
                            onclick="window.location.href = 'build.php?gid=15&amp;del=<?=$vars['demolish']['taskId']; ?>'; return false;">
                        <img src="img/x.gif" class="del" alt="del"/></button>
                </td>
                <td>
                    <?=T(
                        "Buildings", $vars['demolish']['itemId'].'.title'
                    ); ?> <span
                        class="level"><?=T(
                            "Buildings", "level"
                        ); ?>: <?=$vars['demolish']['level']; ?></span>
                </td>
                <td class="times">
                    <?=$vars['demolish']['timer']; ?> <?=T(
                        "Global", "General.hour"
                    ); ?>
                    .
                </td>
                <td class="times">
                    <?=T(
                        "Global", "General.endat"
                    ); ?> <?=$vars['demolish']['endat']; ?>.
                </td>
            </tr>
        </table>
        <br/>
        <?=$vars['finishNow']; ?>
    <?php endif; ?>

    <div class="clear"></div>
</form>
<div class="clear"></div>