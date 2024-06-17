<div class="fighterType">
    <div class="boxes boxesColor <?=$vars['isAttacker'] ? "red" : "green";?>">
        <div class="boxes-tl"></div>
        <div class="boxes-tr"></div>
        <div class="boxes-tc"></div>
        <div class="boxes-ml"></div>
        <div class="boxes-mr"></div>
        <div class="boxes-mc"></div>
        <div class="boxes-bl"></div>
        <div class="boxes-br"></div>
        <div class="boxes-bc"></div>
        <div class="boxes-contents cf"><?=T("combat", $vars['isAttacker'] ? "attacker" : "defender");?>
            : <?=T("Global", "races." . $vars['race']);?></div>
    </div>
</div>
<div class="clear"></div>
<table class="results <?=$vars['isAttacker'] ? "attacker" : "defender";?>" cellpadding="1" cellspacing="1">
    <thead>
    <tr>
        <td class="role"></td>
        <?=$vars['units'];?>

    </tr>
    </thead>
    <tbody>
    <tr>
        <th><?=T("combat", "troops");?></th>
        <?=$vars['Troops'];?>
    </tr>
    <tr>
        <th><?=T("combat", "casualties");?></th>
        <?=$vars['Loses'];?>
    </tr>
    </tbody>
</table>