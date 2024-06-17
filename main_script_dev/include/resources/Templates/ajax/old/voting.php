<h5 style="color: #7b624c; text-align: center;"><?= sprintf(T("Voting", "description"), $vars['votingGold'] . ' <img src="img/x.gif" class="gold">'); ?></h5>
<br />
<div style="text-align: center">
    <?php
    if (isset($vars['Voting']['TopG'])) {
        $details = $vars['Voting']['TopG'];
        if (is_null($details['votingLog'])) {
            echo getButton([
                "type" => "button",
                'class' => 'gold',
                'onClick' => 'window.open(\'' . $details['link'] . '\', \'_blank\');',
                'coins' => $vars['votingGold'],
            ], [], T("Voting", "Vote at TopG"));
        } else {
            echo getButton([
                "type" => "button",
                'class' => 'gold disabled',
                'coins' => $vars['votingGold'],
            ], [], sprintf(T("Voting", "Next vote in %s hours"), secondsToString(($details['votingLog']['time'] + 43200) - time())));
        }
    }
    if (isset($vars['Voting']['ArenaTop100'])) {
        $details = $vars['Voting']['ArenaTop100'];
        if (is_null($details['votingLog'])) {
            echo getButton([
                "type" => "button",
                'class' => 'gold',
                'coins' => $vars['votingGold'],
                'onClick' => 'window.open(\'' . $details['link'] . '\', \'_blank\');',
            ], [], T("Voting", "Vote at Arena Top 100"));
        } else {
            echo getButton([
                "type" => "button",
                'class' => 'gold disabled',
                'coins' => $vars['votingGold'],
            ], [], sprintf(T("Voting", "Next vote in %s hours"), secondsToString(($details['votingLog']['time'] + 43200) - time())));
        }

    }
    if (isset($vars['Voting']['GTop100'])) {
        $details = $vars['Voting']['GTop100'];
        if (is_null($details['votingLog'])) {
            echo getButton([
                "type" => "button",
                'class' => 'gold',
                'coins' => $vars['votingGold'],
                'onClick' => 'window.open(\'' . $details['link'] . '\', \'_blank\');',
            ], [], T("Voting", "Vote at GTop100"));
        } else {
            echo getButton([
                "type" => "button",
                'class' => 'gold disabled',
                'coins' => $vars['votingGold'],
            ], [], sprintf(T("Voting", "Next vote in %s hours"), secondsToString(($details['votingLog']['time'] + 86400) - time())));
        }
    }
    ?>
</div>
