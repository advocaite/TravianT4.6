<div id="sidebarBoxDailyquests" class="sidebarBox   ">
	<div class="sidebarBoxBaseBox">
		<div class="baseBox baseBoxTop">
			<div class="baseBox baseBoxBottom">
				<div class="baseBox baseBoxCenter"></div>
			</div>
		</div>
	</div>
	<div class="sidebarBoxInnerBox">
		<div class="innerBox header ">
                <div class="travianBirthdayRibbon" id="travianBirthdayRibbon">
                    <div class="headline"><?php
                        use Core\Config;
                        use Core\Session;
                        echo T("DailyQuest", "VotingSystemTitle"); ?> (<?=$vars['totalVotes'];?>)</div>
                </div>
                <div
                        class="boxTitle"><?=T("DailyQuest", "VotingSystemTitle"); ?></div>
            </div>
		<div class="innerBox content">
				<div class="questAchievementContainer">
                    <?php if($vars['maxVotesReached']):?>
                        <p class="warning"><?=T("DailyQuest", "You`ve reached max voting limit Try again later");?></p>
                    <?php else:?>
                        <?php $x = 0;?>
                        <?php foreach($vars['voting_services'] as $service): $x++;?>
                            <button coins="<?=$service['gold'];?>" style="margin-bottom: 3px" <?=(is_null($service['votingLog']) ? 'onclick="window.open(\'' . $service['link'] . '\', \'_blank\');"' : '');?> type="button" id="<?=$button_id = get_button_id(); ?>"
                                    class="gold <?=(is_null($service['votingLog']) ? '' : 'disabled');?> questButtonOverviewAchievements">
                                <div class="button-container addHoverClick ">
                                    <div class="button-background">
                                        <div class="buttonStart">
                                            <div class="buttonEnd">
                                                <div class="buttonMiddle"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-content">
                                        <?=T("DailyQuest", "Vote");?> #<?=($x);?>
                                        <?php if(!is_null($service['votingLog'])):?>
                                            (<?=appendTimer(($service['votingLog']['time'] + $service['voteInterval']) - time());?>)
                                        <?php endif;?>
                                        <img src="img/x.gif" class="goldIcon" alt="">
                                        <span class="goldValue"><?=$service['gold'];?></span>
                                    </div>
                                </div>
                            </button>
                            <br />
                        <?php endforeach;?>
                    <?php endif;?>
				</div>
		</div>
		<div class="innerBox footer">
		</div>
	</div>
</div>