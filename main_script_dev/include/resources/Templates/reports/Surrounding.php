<table cellpadding="1" cellspacing="1" id="overview" class="row_table_data reportSurround">
    <thead>
    <tr>
        <th><?=T("Reports", "Subject");?></th>
        <th class="sent"><?=T("Reports", "location");?></th>
        <th class="sent"><?=T("Reports", "distance");?></th>
        <th class="sent"><?=T("Reports", "Sent");?></th>
    </tr>
    </thead>
    <tbody>
    <?=$vars['tbody'];?>
    </tbody>
</table>
<div class="footer">
    <?=$vars['navigator'];?>
</div>
