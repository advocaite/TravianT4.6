<h4 class="round"><?=T("cropFinder", "Croplands");?></h4>
<table cellpadding="1" cellspacing="1" id="croplist">
    <thead>
    <tr>
        <th><?=T("cropFinder", "distance");?></th>
        <th><?=T("cropFinder", "Position");?></th>
        <th><?=T("cropFinder", "Type");?></th>
        <th><?=T("cropFinder", "Oasis");?></th>
        <th><?=T("cropFinder", "Occupied by");?></th>
        <th><?=T("cropFinder", "Alliance");?></th>
    </tr>
    </thead>
    <tbody>
    <?=$vars['tbody'];?>
    </tbody>
</table>
<?=$vars['pages'];?>