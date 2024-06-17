<div class="buildingList">
	<?php if($vars['normal'] > 0):?>
		<h5><?=T("Buildings", "Buildings");?>:</h5>
		<?=$vars['finishNowButton'];?>
	<?php endif;?>
	<?=$vars['buildings'];?>
</div>
<script type="text/javascript" data-cmp-info="6">var bld =<?=$vars['buildsJson'];?>;</script>