<div class="boxes buildingList">
    <div class="boxes-tl"></div>
    <div class="boxes-tr"></div>
    <div class="boxes-tc"></div>
    <div class="boxes-ml"></div>
    <div class="boxes-mr"></div>
    <div class="boxes-mc"></div>
    <div class="boxes-bl"></div>
    <div class="boxes-br"></div>
    <div class="boxes-bc"></div>
    <div class="boxes-contents cf">
        <?php if($vars['normal'] > 0):?>
            <?=T("Buildings", "Buildings");?>:
            <?=$vars['finishNowButton'];?>
        <?php endif;?>
        <?=$vars['buildings'];?>
    </div>
</div>
<script type="text/javascript">
    var bld =<?=$vars['buildsJson'];?>;
</script>