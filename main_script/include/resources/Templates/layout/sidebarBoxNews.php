<div id="sidebarBoxNews<?=$vars['count']; ?>"
     class="sidebarBox   sidebarBoxNews">
	<div class="sidebarBoxBaseBox">
		<div class="baseBox baseBoxTop">
			<div class="baseBox baseBoxBottom">
				<div class="baseBox baseBoxCenter"></div>
			</div>
		</div>
	</div>
	<div class="sidebarBoxInnerBox">
		<div class="innerBox header noHeader">
		</div>
		<div class="innerBox content">
			<a href="#" onclick="
				$H(
				{
				data:
				{
				cmd: 'news',
				id: '<?=$vars['id']; ?>'
				}
				}).dialog(); return false;">                    <?=$vars['shortDesc']; ?>            </a>
		</div>
		<div class="innerBox footer">
			<?php if(!empty($vars['moreLink'])): ?>
				<a target="_blank"
				   href="<?=$vars['moreLink']; ?>">...<?=T("Global", "moreInformation"); ?></a>
			<?php endif; ?>
		</div>
	</div>
</div>