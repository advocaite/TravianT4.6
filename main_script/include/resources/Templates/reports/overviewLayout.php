<tr>
    <td class="sel">
        <?php if($vars['hasPermission']):?>
            <input class="check" type="checkbox" name="n<?=$vars['i'];?>" value="<?=$vars['noticeId'];?>"/>
        <?php endif;?>
    </td>
    <td class="sub newMessage">
        <a href="reports.php?id=<?=$vars['noticeId'];?>|<?=$vars['private_key'];?>&t=<?=$vars['selectedTabIndex'];?>&amp;toggleState=<?=$vars['viewed'] ? 1 : 0;?>">
            <img src="img/x.gif" class="messageStatus messageStatus<?=$vars['viewed'] ? "Read" : "Unread";?>"
                 alt="<?=T("Reports", $vars['viewed'] ? "Read" : "Unread");?>"
                 title="<?=T("Reports", $vars['viewed'] ? "Read" : "Unread");?>"/>
        </a>
        <img src="img/x.gif" class="iReport iReport<?=$vars['type'];?>" alt="<?=T("Reports", "reportTypes." . $vars['type']);?>"
             title="<?=T("Reports", "reportTypes." . $vars['type']);?>"/>
        <?=$vars['reportIcon'];?>
        <div>
            <a href="reports.php?id=<?=$vars['noticeId'];?>|<?=$vars['private_key'];?>&amp;t=<?=$vars['tabId'];?>"><?=$vars['subject'];?></a>
        </div>
        <div class="clear"></div>
    </td>
    <td class="dat"><?=$vars['date'];?></td>
</tr>