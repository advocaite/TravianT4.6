<div class="helpInfoBlock">
	<a target="_blank" href="<?php use Core\Config;

    echo getAnswersUrl();?>" class="helpHeadLine"><?=T("Help", "FAQ - Answers");?></a>
	<a target="_blank" href="<?=getAnswersUrl();?>"
	   class="helpText"><?=T("Help", "Here, you can find your answers about Travian If you really can't find your answer here, you can also contact our ingame support afterwards");?>
		.</a>
</div>

<div class="helpInfoBlock">
	<a target="_blank" href="<?=Config::getInstance()->settings->indexUrl;?>spielregeln.php" class="helpHeadLine"><?=T("Help", "Game rules");?></a>
	<a target="_blank" href="<?=Config::getInstance()->settings->indexUrl;?>spielregeln.php"
	   class="helpText"><?=T("Help", "Here, you can find the current game rules");?></a>
</div>

<div class="helpInfoBlock">
	<a href="help.php?page=support" class="helpHeadLine"><?=T("Help", "Contact ingame support");?></a>
	<a href="help.php?page=support"
	   class="helpText"><?=T("Help", "If you couldn't find an answer, contact the ingame support here");?></a>
</div>

<div class="helpInfoBlock">
	<a href="#"
	   onclick="jQuery(window).trigger('startPaymentWizard', {data:{activeTab: 'plusSupport'}}); this.blur(); return false;"
	   class="helpHeadLine"><?=T("Help", "Plus questions");?></a>
	<a href="#"
	   onclick="jQuery(window).trigger('startPaymentWizard', {data:{activeTab: 'plusSupport'}}); this.blur(); return false;"
	   class="helpText"><?=T("Help", "You can ask questions about payment and premium features here");?></a>
</div>

<div class="helpInfoBlock">
	<a target="_blank" href="<?=getForumUrl();?>" class="helpHeadLine"><?=T("Help", "Forum");?></a>
	<a target="_blank" href="<?=getForumUrl();?>"
	   class="helpText"><?=T("Help", "On our Forum, you can meet and converse with other players");?></a>
</div>

<div class="helpInfoBlock">
	<a href="#" class="helpHeadLine" onclick="return Travian.Game.iPopup(0,0);"><?=T("Help", "Short instruction");?></a>
	<a href="#" onclick="return Travian.Game.iPopup(0,0);"
	   class="helpText"><?=T("Help", "Here you can find short explanations about the troops and buildings found in Travian");?></a>
</div>

<div class="helpInfoBlock">
	<a href="#" class="helpHeadLine"
	   onclick="return Travian.Game.Overlay.openOverlay()"><?=T("Help", "Interface help");?></a>
	<a href="#" onclick="return Travian.Game.Overlay.openOverlay()"
	   class="helpText"><?=T("Help", "An overview of the user interface with short descriptions of the different functions");?></a>
</div>