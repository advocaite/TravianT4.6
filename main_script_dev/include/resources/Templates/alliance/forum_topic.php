<h4>
    <a href="allianz.php?s=2&amp;aid=<?=$vars['aid'];?>"><?=$vars['areaName'];?></a>
    <a class="arrowForum" href="allianz.php?s=2&amp;aid=<?=$vars['aid'];?>&amp;fid=<?=$vars['fid'];?>"><?=$vars['forumName'];?></a>
</h4>
<table cellpadding="1" cellspacing="1" id="topics">
    <thead>
    <tr>
        <th></th>
        <th><?=T("Alliance", "Threads");?></th>
        <th><?=T("Alliance", "answer(s)");?></th>
        <th><?=T("Alliance", "Last post");?></th>
    </tr>
    </thead>
    <tbody>
    <?=$vars['content'];?>
    </tbody>
</table>
