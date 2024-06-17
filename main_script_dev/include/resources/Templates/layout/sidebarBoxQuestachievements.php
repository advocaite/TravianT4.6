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
                <div class="headline"><?php use Core\Session;

                    echo T("DailyQuest", "Daily Quests"); ?></div>
            </div>
			<div
				class="boxTitle"><?=T("DailyQuest", "Collect daily rewards"); ?></div>
		</div>
		<div class="innerBox content">
			<form>
				<div class="questAchievementContainer">
					<button type="submit"
					        value="<?=T("DailyQuest", "Click for details"); ?>"
					        id="<?=$button_id = get_button_id(); ?>"
					        class="green questButtonOverviewAchievements"
					        questbuttonoverviewachievements="1"
					        onclick="return false;">
						<div class="button-container addHoverClick ">
							<div class="button-background">
								<div class="buttonStart">
									<div class="buttonEnd">
										<div class="buttonMiddle"></div>
									</div>
								</div>
							</div>
							<div
								class="button-content"><?=T("DailyQuest", "Click for details"); ?></div>
						</div>
					</button>
					<script type="text/javascript">
						jQuery(function() {
							if (jQuery('#<?=$button_id;?>')) {
								jQuery('#<?=$button_id;?>').click(function (event) {
									jQuery(window).trigger('buttonClicked', [this, {
										"type": "submit",
										"value": "<?=T("DailyQuest", "Click for details");?>",
										"name": "",
										"id": "<?=$button_id;?>",
										"class": "green questButtonOverviewAchievements",
										"title": "",
										"confirm": "",
										"onclick": "",
										"questButtonOverviewAchievements": true,
										"onClick": "return false;"
									}]);
								});
							}
						});
					</script>
				</div>
			</form>
			<script type="text/javascript">
				<?php
				$m = new \Model\DailyQuestModel();
				$quest = $m->getQuest(Session::getInstance()->getPlayerId());
				$total_points = $m->calcTotalPoints($quest);
				$json = [
					'achievementquests' => [
						'questsTotal' => 10,
						'questsCompleted' => $m->getTotalCompletedQuests($quest),
						'name' => 'Achievement Quests',
						'quests' => $m->getQuestData($quest),
					],
				];

				if(($quest['reward1Done'] + $quest['reward2Done'] + $quest['reward3Done'] + $quest['reward4Done']) < 4 && $total_points >= 25){
					$json['achievementrewards'] = [
						'questsTotal' => 4,
						'questsCompleted' => $quest['reward1Done'] + $quest['reward2Done'] + $quest['reward3Done'] + $quest['reward4Done'],
						'name' => 'Achievement Rewards',
						'quests' => [],
					];
					$quests = &$json['achievementrewards']['quests'];
					if(!$quest['reward1Done'] && $total_points >= 25){
						$quests['AchievementQuestReward_01'] = [
							"id" => "AchievementQuestReward_01",
							"name" => "achievementQuests.achQuestReward_01_name",
							"category" => "achievementrewards",
							"stepType" => "reward",
							"currentStep" => 0,
							"stepCount" => 1,
							"steps" => ["stepId" => 0,"type" => "reward"],
							"answersLink" => "http://t4.answers.travian.com/index.php?aid=%%achievementQuests.achQuestReward_01_answer (en)%%#go2answer",
						];
					}
					if(!$quest['reward2Done'] && $total_points >= 50){
						$quests['AchievementQuestReward_02'] = [
							"id" => "AchievementQuestReward_02",
							"name" => "achievementQuests.achQuestReward_02_name",
							"category" => "achievementrewards",
							"stepType" => "reward",
							"currentStep" => 0,
							"stepCount" => 1,
							"steps" => ["stepId" => 0,"type" => "reward"],
							"answersLink" => "http://t4.answers.travian.com/index.php?aid=%%achievementQuests.achQuestReward_02_answer (en)%%#go2answer",
						];
					}
					if(!$quest['reward3Done'] && $total_points >= 75){
						$quests['AchievementQuestReward_03'] = [
							"id" => "AchievementQuestReward_03",
							"name" => "achievementQuests.achQuestReward_03_name",
							"category" => "achievementrewards",
							"stepType" => "reward",
							"currentStep" => 0,
							"stepCount" => 1,
							"steps" => ["stepId" => 0,"type" => "reward"],
							"answersLink" => "http://t4.answers.travian.com/index.php?aid=%%achievementQuests.achQuestReward_03_answer (en)%%#go2answer",
						];
					}
					if(!$quest['reward4Done'] && $total_points >= 100){
						$quests['AchievementQuestReward_04'] = [
							"id" => "AchievementQuestReward_04",
							"name" => "achievementQuests.achQuestReward_04_name",
							"category" => "achievementrewards",
							"stepType" => "reward",
							"currentStep" => 0,
							"stepCount" => 1,
							"steps" => ["stepId" => 0,"type" => "reward"],
							"answersLink" => "http://t4.answers.travian.com/index.php?aid=%%achievementQuests.achQuestReward_04_answer (en)%%#go2answer",
						];
					}
				}
				?>
				jQuery(function() {
					Travian.Game.Quest.addListData(<?=json_encode($json);?>);
				});
			</script>
		</div>
		<div class="innerBox footer">
		</div>
	</div>
</div>