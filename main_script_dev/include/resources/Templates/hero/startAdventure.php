<script type="text/javascript">
	var adventureList = new Travian.AdventureList();
</script>
<div id="tileDetails" class="<?=$vars['tileClass'];?>">
	<div class="detailImage"></div>
	<div class="clear"></div>
	<div class="adventureStatusMessage">
		<div class="heroStatusMessage ">
			<?php if($vars['hasRallyPoint']==0):?>
				<div class="heroStatusMessage header error">
					<?=T("HeroAdventure", "No rallyPoint");?></div>
			<?php else:?>
				<img alt="Held tot!" src="img/x.gif" class="heroStatus<?=$vars['status'];?>">
				<?=$vars['statusMessage'];?>
			<?php endif;?>
		</div>
	</div>
	<?php if($vars['hasRallyPoint'] == 1 and $vars['dead'] == 0):?>
		<strong><?=T("HeroAdventure", "Duration to the adventure");?>:</strong>
		<br/>
		<?=$vars['arrival_text'];?>
		<br/>
		<br/>
	<?php endif;?>
	<div class="adventureSend">
		<div class="adventureSendButton">
			<form class="adventureSendButton" method="post" action="start_adventure.php">
				<div>

					<input type="hidden" name="send" value="1">
					<input type="hidden" name="kid" value="<?=$vars['kid'];?>">
					<input type="hidden" name="from" value="<?=$vars['from'];?>">
					<input type="hidden" name="a" value="1">
					<?php if($vars['status'] == 100 and $vars['hasRallyPoint'] == 1):?>
						<button type="submit" value="<?=T("HeroAdventure", "StartAdventure");?>" name="start" id="start"
						        class="green ">
							<div class="button-container addHoverClick ">
								<div class="button-background">
									<div class="buttonStart">
										<div class="buttonEnd">
											<div class="buttonMiddle"></div>
										</div>
									</div>
								</div>
								<div class="button-content"><?=T("HeroAdventure", "StartAdventure");?></div>
							</div>
						</button>
					<?php else:?>
						<button type="button" onclick="window.location.href = 'dorf2.php'; return false;"
						        value="<?=T("HeroAdventure", "ok");?>" name="ok" id="ok" class="green ">
							<div class="button-container addHoverClick ">
								<div class="button-background">
									<div class="buttonStart">
										<div class="buttonEnd">
											<div class="buttonMiddle"></div>
										</div>
									</div>
								</div>
								<div class="button-content"><?=T("HeroAdventure", "ok");?></div>
							</div>
						</button>
					<?php endif;?>

				</div>
			</form>
		</div>
		<div class="adventureBackButton">
			<a href="hero.php?t=3" class="a arrow"><?=T("HeroAdventure", "back");?></a>
		</div>
	</div>
</div>