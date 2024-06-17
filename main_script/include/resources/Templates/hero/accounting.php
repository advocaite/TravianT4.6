<table id="silverAccounting" cellspacing="1" cellpadding="1">
    <thead>
    <tr>
        <th class="date"><?=T("Auction", "date");?></th>
        <th class="cause"><?=T("Auction", "cause");?></th>
        <th class="accounting"><?=T("Auction", "reserve");?></th>
        <th class="balance"><?=T("Auction", "balance");?></th>
    </tr>
    </thead>
    <?=$vars['latestBookings'];?>
    <tbody class="latestBookings">
    </tbody>
    <tbody>
    <tr class="oldBalance">
        <td colspan="4" class="oldBalance"><span class="balanceSince"><?=T("Auction", "balanceSince");?></span></td>
    </tr>
    </tbody>
</table>
<script type="text/javascript">
    jQuery(function() {
        if (jQuery('#showHideBlockedSilverDetails')) {
            jQuery('#showHideBlockedSilverDetails').click(function (e) {
                Travian.toggleSwitch(jQuery('#silverAccounting .currentBids'), jQuery('#silverAccounting .openedClosedSwitch'));
                Travian.toggleSwitchDescription(jQuery('#silverAccounting .openedClosedSwitch'), '<?=T("Auction", "showAccounting");?>', '<?=T("Auction", "hideAccounting");?>');
            });
        }
    });
</script>