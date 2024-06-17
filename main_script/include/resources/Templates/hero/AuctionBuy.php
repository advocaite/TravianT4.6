<table cellspacing="1" cellpadding="1">
    <thead>
    <tr>
        <th class="name" colspan="2"><?=T("Auction", "desc"); ?></th>
        <?php if ($vars['isAdmin']): ?>
            <td>Owner</td>
            <td>Buyer</td>
        <?php endif; ?>
        <th class="bids"><img alt="<?=T("Auction", "bids"); ?>" title="<?=T("Auction", "bids"); ?>"
                              class="bids"
                              src="img/x.gif"></th>
        <th class="silver"><img alt="<?=T("Auction", "silver"); ?>"
                                title="<?=T("Auction", "silver"); ?>" class="silver"
                                src="img/x.gif"></th>
        <th class="time"><img alt="<?=T("Auction", "clock"); ?>" title="<?=T("Auction", "clock"); ?>"
                              class="clock"
                              src="img/x.gif"></th>
        <th class="bid"><?=T("Auction", "bid"); ?></th>
    </tr>
    </thead>
    <tbody>
    <?=$vars['results']; ?>
    </tbody>
</table>
<div class="footer">
    <?=$vars['nav']; ?>
</div>