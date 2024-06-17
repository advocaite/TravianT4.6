<div class="questText">
    <h2 class="questTitle" style="text-align: center;"><?=T("DailyQuest", "Earn free gold!!!");?></h2>
    <br />
    <div class="questDescription">
        <div title="" style="" class="enumerableElementsImage tutorial_09_reward_image" id="questDescription">
            <?=T("DailyQuest", "voteQuestDescription");?></div>
        <br>
        <h4><?=T("DailyQuest", "Vote");?>:</h4>
        <div class="questTasks">
            <ul id="questTodolist">
                <li class="finished"><img title="" alt="" src="img/x.gif"><?=T("DailyQuest", "if you abuse the vote system you will be banned");?></li>
                <li class="finished"><img title="" alt="" src="img/x.gif"><?=T("DailyQuest", "Click on Consultant to open Hints page");?></li>
        </div>
        <h4 class="questRewardTitle"><?=T("DailyQuest", "Your Reward:");?></h4>
        <div class="questTasks">
            <ul id="questTodolist">
                <li class=""><img title="" alt="" src="img/x.gif"><?=T("DailyQuest", "VoteRewardDesc");?> </li>
            </ul>
        </div>
    </div>
    <br><br>
    <ul>
        <?php
        foreach($vars['Voting'] as $key => $value){
            echo $value['content'] . '&nbsp;';
        }
        ?>
    </ul>
</div>
