<style rel="stylesheet">
    .transfer-gold {
        margin-top: -20px;
    }

    .transfer-gold .center {
        text-align: center;
    }

    .transfer-gold .alert {
        position: relative;
        padding: .75rem 1.25rem;
        margin-bottom: 1rem;
        border: 1px solid transparent;
        border-radius: .25rem;
    }

    .transfer-gold .warning {
        font-weight: bold;
    }

    .transfer-gold .alert-success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
    }

    .transfer-gold .alert-danger {
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
    }

    table.recentTransfers td, .transfer-gold table.recentTransfers th {
        text-align: center !important;
    }
</style>
<div class="transfer-gold">
    <p>
        <?= T("TransferGold", "desc"); ?>
        <br>
        <br>
        <span class="warning"><?= sprintf(T("TransferGold", "transfer_cost"), 5); ?></span>
        <br>
        <br>
        <span class="warning"><?= T("TransferGold", "only_bought"); ?></span>
    </p>
    <?php if ($vars['success']): ?>
        <div class="alert alert-success">
            <strong><?= $vars['success']; ?></strong>
        </div>
    <?php endif; ?>
    <?php if (sizeof($vars['errors'])): ?>
        <div class="alert alert-danger">
            <?= T("TransferGold", "the_following_errors"); ?>

            <ul>
                <?php foreach ($vars['errors'] as $err): ?>
                    <li><?= $err; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <form method="post" action="voucher.php?t=3">
        <table cellpadding="1" cellspacing="1" class="row_table_data">
            <input type="hidden" name="c" value="<?= $vars['checker']; ?>">
            <input type="hidden" name="c2" value="<?= time(); ?>">
            <tr>
                <td><?= T("TransferGold", "available_gold"); ?>:</td>
                <td>
                    <?= $vars['availableGold']; ?> <img src="img/x.gif" class="gold">
                </td>
            </tr>
            <tr>
                <td><?= T("TransferGold", "SenderEmailAddress"); ?>:</td>
                <td>
                    <input class="name text" type="email" id="fromPlayerEmail" name="fromPlayerEmail" value="<?= $vars['fromPlayerEmail']; ?>">
                </td>
            </tr>
            <tr>
                <td><?= T("TransferGold", "gold_amount"); ?>:</td>
                <td>
                    <input class="name text" type="number" id="gold_amount" min="30"
                           max="<?= $vars['availableGold']; ?>" name="gold_amount"
                           value="<?= $vars['goldAmount']; ?>">
                    <img src="img/x.gif" class="gold">
                </td>
            </tr>
            <tr>
                <td><?= T("TransferGold", "cost"); ?>:</td>
                <td>
                    <span id="transferCost">0</span> <img src="img/x.gif" class="gold">
                </td>
            </tr>
            <tr>
                <td><?= T("TransferGold", "target_player"); ?>:</td>
                <td>
                    <input class="name text" type="text" value="<?= $vars['targetPlayer']; ?>" name="target_player"
                           id="enterPlayerName" maxlength="20">
                </td>
            </tr>
            <tr>
                <td colspan="2" class="center">
                    <button type="submit" value="ok" name="s1" id="btn_ok" class="green " title="Transfer">
                        <div class="button-container addHoverClick">
                            <div class="button-background">
                                <div class="buttonStart">
                                    <div class="buttonEnd">
                                        <div class="buttonMiddle"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-content"><?= T("TransferGold", "transfer"); ?></div>
                        </div>
                    </button>
                </td>
            </tr>
        </table>
    </form>
    <br>
    <?php if (sizeof($vars['recent_transfers'])): ?>
        <h2><?= T("TransferGold", "recent_transfers"); ?>:</h2>
        <br>
        <table cellpadding="1" cellspacing="1" id="player" class="row_table_data recentTransfers">
            <thead>
            <tr>
                <th>#</th>
                <th><?= T("TransferGold", "player"); ?></th>
                <th><?= T("TransferGold", "amount"); ?></th>
                <th><?= T("TransferGold", "date"); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($vars['recent_transfers'] as $transfer): ?>
                <tr>
                    <td><?= $transfer['id']; ?></td>
                    <td><a href="spieler.php?uid=<?= $transfer['to_uid']; ?>"><?= $transfer['player']; ?></a></td>
                    <td><?= $transfer['amount']; ?></td>
                    <td><?= $transfer['date']; ?></td>
                </tr>
            <?php endforeach; ?>

            </tbody>
        </table>
        <br>
        <?=$vars['pagination'];?>
    <?php endif; ?>
</div>
<script type="text/javascript">
    var calculateCost = function () {
        jQuery('#transferCost').text(Math.ceil(jQuery('#gold_amount').val() * 0.05));
    };
    jQuery(function () {
        calculateCost();
        jQuery("#gold_amount")
            .change(calculateCost)
            .keyup(calculateCost)
            .keydown(calculateCost)
            .keyup(calculateCost)
            .keypress(calculateCost);
        new Travian.Game.AutoCompleter.UserName(jQuery('input#enterPlayerName'));
    });
</script>