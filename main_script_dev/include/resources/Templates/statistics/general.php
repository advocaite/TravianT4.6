<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<h4 class="round"><?= T("Statistics", "General.Players"); ?></h4>

<table cellpadding="1" cellspacing="1" id="world_player"
       class="transparent">
    <tbody>
    <tr>
        <th><?= T("Statistics", "General.RegisteredPlayers"); ?></th>
        <td><?= $vars['players']['registered']; ?></td>
    </tr>
    <tr>
        <th><?= T("Statistics", "General.ActivePlayers"); ?></th>
        <td><?= $vars['players']['active']; ?></td>
    </tr>
    <?php if (getDisplay("showOnlinePlayers")): ?>
        <tr>
            <th><?= T("Statistics", "General.onlinePlayers"); ?></th>
            <td><?= $vars['players']['online']; ?></td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>
<div class="clear"></div>


<h4 class="round spacer"><?= T("Statistics", "General.Tribes"); ?></h4>

<table cellpadding="1" cellspacing="1" id="world_tribes" class="world">
    <thead>
    <tr class="hover">
        <td><?= T("Statistics", "General.Tribe"); ?></td>
        <td><?= T("Statistics", "General.Registered"); ?></td>
        <td><?= T("Statistics", "General.Percent"); ?></td>
    </tr>
    </thead>
    <tbody>
    <tr class="hover">
        <td><?= T("Statistics", "General.Romans"); ?></td>
        <td><?= $vars['tribes']['Registered'][1]; ?></td>
        <td><?= $vars['tribes']['Percent'][1]; ?></td>
    </tr>
    <tr class="hover">
        <td><?= T("Statistics", "General.Teutons"); ?></td>
        <td><?= $vars['tribes']['Registered'][2]; ?></td>
        <td><?= $vars['tribes']['Percent'][2]; ?></td>
    </tr>
    <tr class="hover">
        <td><?= T("Statistics", "General.Gauls"); ?></td>
        <td><?= $vars['tribes']['Registered'][3]; ?></td>
        <td><?= $vars['tribes']['Percent'][3]; ?></td>
    </tr>
    <?php if (getGame("allowNewTribes")): ?>
        <tr class="hover">
            <td><?= T("Statistics", "General.Egyptians"); ?></td>
            <td><?= $vars['tribes']['Registered'][6]; ?></td>
            <td><?= $vars['tribes']['Percent'][6]; ?></td>
        </tr>
        <tr class="hover">
            <td><?= T("Statistics", "General.Huns"); ?></td>
            <td><?= $vars['tribes']['Registered'][7]; ?></td>
            <td><?= $vars['tribes']['Percent'][7]; ?></td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>
<h4 class="round spacer"><?= T("Statistics", "General.Miscellaneous"); ?></h4>
<table cellpadding="1" cellspacing="1" id="world_misc" class="world">
    <thead>
    <tr class="hover">
        <td><?= T("Statistics", "General.Attacks"); ?></td>
        <td><?= T("Statistics", "General.Casualties"); ?></td>
        <td><?= T("Statistics", "General.Date"); ?></td>
    </tr>
    </thead>
    <tbody>
    <?= $vars['world_misc']; ?>
    </tbody>
</table>
<?php if (true || $vars['hasPlus']): ?>
    <script type="text/javascript">
        // Load the Visualization API and the corechart package.
        google.charts.load('current', {'packages': ['corechart', 'bar']});

        // Set a callback to run when the Google Visualization API is loaded.
        google.charts.setOnLoadCallback(drawChart);

        // Callback that creates and populates a data table,
        // instantiates the pie chart, passes in the data and
        // draws it.
        function drawChart() {

            // Create the data table.
            var data = new google.visualization.DataTable();


            data.addColumn('date', 'Date');
            data.addColumn('number', '<?= T("Statistics", "General.Attacks"); ?>');
            data.addColumn('number', '<?= T("Statistics", "General.Casualties"); ?>');

            data.addRows([
                <?php foreach($vars['casualtiesData'] as $row):?>
                [new Date(<?=$row['time'] * 1000;?>), <?=$row['attacks'];?>, <?=$row['casualties'];?>],
                <?php endforeach;?>
            ]);
            // Set chart options
            var options = {
                chartArea: {},
                vAxis: {
                    format: 'dd.MM',
                    ticks: data.getDistinctValues(0)
                },
            };
            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.BarChart(document.getElementById('casualties_chart'));
            chart.draw(data, options);
        }
    </script>
    <h4 class="round spacer"><?= T("Statistics", "General.Attacks and casualties"); ?></h4>
    <div id="casualties_chart" style="overflow: hidden;"></div>
<?php endif; ?>
<?php if (getDisplay("showCountryFlagsInGeneralStatistics")): ?>
    <style type="text/css">
        table td.flags img {
            height: 11px;
            width: 16px;
            background-image: url(<?=get_gpack_cdn_mainPage_url();?>img_ltr/misc/flags/country_sprite.png);
        }
    </style>
    <h4 class="round spacer"><?= T("Statistics", "General.Country ranks"); ?></h4>
    <table cellpadding="1" cellspacing="1" id="" class="">
        <thead>
        <tr class="hover">
            <td class="ra "></td>
            <td><?= T("Statistics", "General.Country name"); ?></td>
            <td><?= T("Statistics", "General.CountryFlag"); ?></td>
            <td><?= T("Statistics", "General.Players"); ?></td>
            <td><?= T("Statistics", "General.Total country population"); ?></td>
            <td><?= T("Statistics", "General.Points"); ?></td>
        </tr>
        </thead>
        <tbody>
        <?= $vars['country_ranks']; ?>
        </tbody>
    </table>
<?php endif; ?>