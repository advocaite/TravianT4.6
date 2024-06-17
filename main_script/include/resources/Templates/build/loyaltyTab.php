<div id="loyaltyTab">
    <?=T(
        "ResidencePalace",
        "A palace or residence protect a village from being conquered If the seat of government has been destroyed, a village`s loyalty can be lowered by attacks with chieftains, chiefs and senators If the loyalty is lowered to zero, the village will join the attacker`s empire An ongoing great celebration in the village of either attacker or defender will increase or lower the rate at which each attacking administrator will lower the loyalty Each level of the seat of government increases the speed at which the loyalty of a village increases to 100% again A hero stationed in the village can use tablets of law to additionally increase loyalty"
    ); ?>

    <br>
    <br>
    <?=T("ResidencePalace", "Loyalty in the current village"); ?>: <span
        class="currentLoyalty"><?=$vars['loyalty']; ?>%‬‎</span>
    <br>
    <br>
    <h4 class="round"><?=T(
            "ResidencePalace", "Loyalty overview"
        ); ?></h4>
    <table cellpadding="1" cellspacing="1">
        <thead>
        <tr>
            <th><?=T("ResidencePalace", "village"); ?></th>
            <td><?=T("ResidencePalace", "Inhabitants"); ?></td>
            <td><?=T("ResidencePalace", "Loyalty"); ?></td>
        </tr>
        </thead>
        <tbody>
        <?=$vars['content']; ?>
        </tbody>
    </table>
</div>