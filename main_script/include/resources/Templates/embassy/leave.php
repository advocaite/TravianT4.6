<span class="alert bold"><?=T("Embassy", "If you leave the alliance your contribution statistics will reset");?>.</span>
<p>
    <?=T("Embassy", "Alliance leave contribution note");?>
</p>
<table cellpadding="1" cellspacing="1" id="leave" class="transparent">
    <tbody>
    <tr>
        <td>
            <button type="button" class="icon allianceLeaveLink"><img src="img/x.gif" class="del" alt="del"></button>
            <a class="allianceLeaveLink" href="javascript:;"><?=T("Embassy", "Leave the alliance");?></a>
        </td>
    </tr>
    </tbody>
</table>
<script type="text/javascript">
    jQuery(function () {
        var allianceDblClickPreventer = new Travian.DoubleClickPreventer();

        allianceDblClickPreventer.timeout = 1000;

        jQuery('button.allianceLeaveLink, a.allianceLeaveLink').on("click", function (e) {
            e.preventDefault();

            if (!allianceDblClickPreventer.check()) {
                return false;
            }

            new Travian.Game.AllianceLeave({
                data: {
                    cmd: 'allianceLeave',
                    allianceId: <?=$vars['aid'];?>,
                    action: 'popup'
                },
                context: 'allianceLeave',
                buttonOk: false,
                darkOverlay: false,
                keepOpen: true
            });
        });
    });
</script>