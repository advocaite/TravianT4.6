<span style="color: #800000;"><strong><?= T("Reports", "ManagementDesc"); ?></strong></span>
<form action="reports.php?t=7" method="post">
    <?php
    $select = '<select name="reportType">';
    foreach (T("Reports", "ManagementOptions") as $key => $value) {
        $selected = $vars['selectedReportType'] == $key;
        $select .= '<option value="' . $key . '" '.($selected ? 'selected' : '').'>' . $value . '</option>';
    }
    $select .= '</select>';
    $select1 = '<select name="startTime">';
    foreach (T("Reports", "startTime") as $key => $value) {
        $selected = $vars['selectedTime'] == $key;
        $select1 .= '<option value="' . $key . '" '.($selected ? 'selected' : '').'>' . $value . '</option>';
    }
    $select1 .= '</select>';
    ?>
    <p><?= sprintf(T("Reports", "ManagementDeleteDesc"), $select, $select1, getButton([
            "class" => "green",
            "type"  => "submit",
            "value" => T("Reports", "ButtonOK"),
        ], [], T("Reports", "ButtonOK"))); ?></p>
</form>
<?php if(isset($vars['removed_count'])):?>
<p style="font-color: green;"><strong><?=sprintf(T("Reports", "%s report(s) removed successfully"), $vars['removed_count']);?></strong></p>
<?php endif;?>
<h4 class="round"><?=T("Reports", "ReportsStatistics");?></h4>
<table cellspacing="1" style="width: 50%;">
    <tr>
        <td><?=T("Reports", "ReportsWithoutCasualties");?></td>
        <td><?=$vars['ReportsWithoutCasualties'];?></td>
    </tr>
    <tr>
        <td><?=T("Reports", "ReportsWithCasualties");?></td>
        <td><?=$vars['ReportsWithCasualties'];?></td>
    </tr>
    <tr>
        <td><?=T("Reports", "ReportsDefWithoutCasualties");?></td>
        <td><?=$vars['ReportsDefWithoutCasualties'];?></td>
    </tr>
    <tr>
        <td><?=T("Reports", "ReportsDefWithCasualties");?></td>
        <td><?=$vars['ReportsDefWithCasualties'];?></td>
    </tr>
    <tr>
        <td><?=T("Reports", "ReportsOtherReports");?></td>
        <td><?=$vars['ReportsOtherReports'];?></td>
    </tr>
    <tr>
        <td><?=T("Reports", "AllReportsCount");?></td>
        <td><?=$vars['AllReportsCount'];?></td>
    </tr>
</table>