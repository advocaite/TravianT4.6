<?php $maxStoreLength = strlen($vars['maxstore']);?>
<?php $maxCropLength = strlen($vars['maxcrop']);?>
<div id="build" class="exchangeResources">
    <p class="npc_desc">
        <?=T("npc", "npc_desc"); ?>
    </p>
    <input type="hidden" name="action" value="exchangeResources">
    <input type="hidden" name="did" value="<?=$vars['kid']; ?>">
    <table id="npc" cellpadding="1" cellspacing="1">
        <thead>
        <tr>
            <td class="all">
                <a href="#" onclick="exchangeResources.fillup(0); return false;">
                    <i class="r1"></i>
                </a>
                <span id="org0"><?=$vars['currentResources'][0]; ?></span>
            </td>
            <td class="all">
                <a href="#" onclick="exchangeResources.fillup(1); return false;">
                    <i class="r2"></i>
                </a>
                <span id="org1"><?=$vars['currentResources'][1]; ?></span>
            </td>
            <td class="all">
                <a href="#" onclick="exchangeResources.fillup(2); return false;">
                    <i class="r3"></i>
                </a>
                <span id="org2"><?=$vars['currentResources'][2]; ?></span>
            </td>
            <td class="all">
                <a href="#" onclick="exchangeResources.fillup(3); return false;">
                    <i class="r4"></i>
                </a>
                <span id="org3"><?=$vars['currentResources'][3]; ?></span>
            </td>
            <td class="deco"></td>
            <td class="sum"><?=T("npc", "remain"); ?>:&nbsp;<span id="sum"><?=$vars['currentResourcesSum']; ?></span></td>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="sel">
                <input type="text" class="text" onkeyup="exchangeResources.calculateRest();" name="desired[0]" size="5" maxlength="<?=$maxStoreLength;?>" value="<?=$vars['defaultValues']['r1']; ?>">
            </td>
            <td class="sel">
                <input type="text" class="text" onkeyup="exchangeResources.calculateRest();" name="desired[1]" size="5" maxlength="<?=$maxStoreLength;?>" value="<?=$vars['defaultValues']['r2']; ?>">
            </td>
            <td class="sel">
                <input type="text" class="text" onkeyup="exchangeResources.calculateRest();" name="desired[2]" size="5" maxlength="<?=$maxStoreLength;?>" value="<?=$vars['defaultValues']['r3']; ?>">
            </td>
            <td class="sel">
                <input type="text" class="text" onkeyup="exchangeResources.calculateRest();" name="desired[3]" size="5" maxlength="<?=$maxCropLength;?>" value="<?=$vars['defaultValues']['r4']; ?>">
            </td>
            <td class="deco"></td>
            <td class="sum"><?=T("npc", "sum"); ?>:&nbsp;<span id="newsum"><?=$vars['newSum']; ?></span></td>
        </tr>
        <tr>
            <td class="rem">
                <span id="diff0">-<?=$vars['currentResources'][0]; ?></span>
            </td>
            <td class="rem">
                <span id="diff1">-<?=$vars['currentResources'][1]; ?></span>
            </td>
            <td class="rem">
                <span id="diff2">-<?=$vars['currentResources'][2]; ?></span>
            </td>
            <td class="rem">
                <span id="diff3">-<?=$vars['currentResources'][3]; ?></span>
            </td>
            <td class="deco"></td>
            <td class="sum"><?=T("npc", "remain"); ?>:&nbsp;<span id="remain"><?=$vars['remainResources']; ?></span></td>
        </tr>
        </tbody>
    </table>
    <p id="submitButton" class="disableButtonHandler">
        <?=$vars['redeemButton']; ?>
    </p>
    <p id="submitText" style="display: block;">
        <?=$vars['distributeButton']; ?>
    </p>
    <script>
        var exchangeResources = new Travian.Game.Marketplace.ExchangeResources(jQuery('table#npc'));
        // used as callback in paymentfeature to get data for the action
        function returnInputValues() {
            var inputFields = jQuery('div#build.exchangeResources input');
            var returnObject = {};
            inputFields.each(function(_, element) {
                element = jQuery(element);
                returnObject[element.attr('name')] = element.val();
            });
            return returnObject;
        }
    </script>
</div>