<div id="questTodoListDialog" class="questWrapper questToDoList">
    <?php
    function renderQuest($name, $type, $id, $stepType)
    {
        $name = T("Quest", explode(".", $name)[1]);

        return ' <li class="questName" data-questId="' . $id . '" data-category="' . $type . '"><img src="img/x.gif" alt="Reward Pending"><a href="#" class="arrow quest">' . $name . '</a>' . ($stepType == 'reward' ? '<img class="reward" src="img/x.gif">' : '') . '</li>';
    }

    $data = \Model\Quest::getInstance()->getQuestData();
    if (isset($data['battle'])) {
        echo '<h4 class="round">' . T("Quest",
                "battle") . '<div class="categoryProgress"> ' . $data['battle']['questsCompleted'] . '/' . $data['battle']['questsTotal'] . '</div> </h4>';
        echo '<ul>';
        foreach ($data['battle']['quests'] as $quest) {
            echo renderQuest($quest['name'], 'battle', $quest['id'], $quest['stepType']);
        }
        if ($data['battle']['questsCompleted'] == $data['battle']['questsTotal']) {
            echo '<p>' . T("inGame", "No further tasks available in this category") . '</p>';
        }
        echo '</ul>';
    }
    if (isset($data['economy'])) {
        echo '<h4 class="round">' . T("Quest",
                "economy") . '<div class="categoryProgress"> ' . $data['economy']['questsCompleted'] . '/' . $data['economy']['questsTotal'] . '</div> </h4>';
        echo '<ul>';
        foreach ($data['economy']['quests'] as $quest) {
            echo renderQuest($quest['name'], 'economy', $quest['id'], $quest['stepType']);
        }
        if ($data['economy']['questsCompleted'] == $data['economy']['questsTotal']) {
            echo '<p>' . T("inGame", "No further tasks available in this category") . '</p>';
        }
        echo '</ul>';
    }
    if (isset($data['world'])) {
        echo '<h4 class="round">' . T("Quest",
                "world") . '<div class="categoryProgress"> ' . $data['world']['questsCompleted'] . '/' . $data['world']['questsTotal'] . '</div> </h4>';
        echo '<ul>';
        foreach ($data['world']['quests'] as $quest) {
            echo renderQuest($quest['name'], 'world', $quest['id'], $quest['stepType']);
        }
        if ($data['world']['questsCompleted'] == $data['world']['questsTotal']) {
            echo '<p>' . T("inGame", "No further tasks available in this category") . '</p>';
        }
        echo '</ul>';
    }
    ?>
    <script type="text/javascript">
        jQuery(function() {
            Travian.Game.Quest.bindListDelegation(jQuery('div#questTodoListDialog li'));
        });
    </script>
</div>
