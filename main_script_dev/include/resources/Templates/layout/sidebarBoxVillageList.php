<div id="sidebarBoxVillagelist" class="sidebarBox toggleable <?=$vars['toggle']; ?>">
   <div class="header ">
      <div class="buttonsWrapper">	
	  
		<a id="<?= $button_id = get_button_id(); ?>" class="layoutButton buttonFramed withIcon round overview green " href="/dorf3.php">
		<svg viewBox="0 0 20 14.92" class="overview">
		   <g class="outline">
			  <path d="M10 1.41c4.61 0 8.34 6.05 8.34 6.05s-3.73 6.05-8.34 6.05-8.34-6-8.34-6 3.73-6 8.34-6M10 0C7.7 0 5.38 1.16 3.1 3.44A20.17 20.17 0 0 0 .46 6.72L0 7.46l.46.74a20.17 20.17 0 0 0 2.64 3.28c2.28 2.28 4.6 3.44 6.9 3.44s4.62-1.16 6.9-3.44a20.17 20.17 0 0 0 2.64-3.28l.46-.74-.46-.74a20.17 20.17 0 0 0-2.64-3.28C14.62 1.16 12.3 0 10 0zm.08 11.64a4.5 4.5 0 1 1 4.49-4.49 4.5 4.5 0 0 1-4.49 4.49zm0-7.88a3.39 3.39 0 1 0 3.38 3.39 3.39 3.39 0 0 0-3.38-3.39zm0 5.92a2.53 2.53 0 1 1 2.52-2.53 2.53 2.53 0 0 1-2.52 2.53z"></path>
		   </g>
		   <g class="icon">
			  <path d="M10 1.41c4.61 0 8.34 6.05 8.34 6.05s-3.73 6.05-8.34 6.05-8.34-6-8.34-6 3.73-6 8.34-6M10 0C7.7 0 5.38 1.16 3.1 3.44A20.17 20.17 0 0 0 .46 6.72L0 7.46l.46.74a20.17 20.17 0 0 0 2.64 3.28c2.28 2.28 4.6 3.44 6.9 3.44s4.62-1.16 6.9-3.44a20.17 20.17 0 0 0 2.64-3.28l.46-.74-.46-.74a20.17 20.17 0 0 0-2.64-3.28C14.62 1.16 12.3 0 10 0zm.08 11.64a4.5 4.5 0 1 1 4.49-4.49 4.5 4.5 0 0 1-4.49 4.49zm0-7.88a3.39 3.39 0 1 0 3.38 3.39 3.39 3.39 0 0 0-3.38-3.39zm0 5.92a2.53 2.53 0 1 1 2.52-2.53 2.53 2.53 0 0 1-2.52 2.53z"></path>
		   </g>
		</svg>
		</a>
		<script type="text/javascript" data-cmp-info="6">jQuery('#<?=$button_id;?>').click(function (event){
			jQuery(window).trigger('buttonClicked', [event.delegateTarget,{"type":"green","loadTooltip":null,"boxId":"","disabled":false,"attention":false,"colorBlind":false,"class":"","id":"<?=$button_id;?>","redirectUrl":"\/dorf3.php","redirectUrlExternal":"","svg":"sideBar\/overview.svg","content":""}]);});</script>
		
	  </div>
   </div>
   <div class="content">
      <div class="expansionSlotInfo">
         <div class="boxTitle"><?=T("inGame", "villages"); ?> <span class="slots"><?=$vars['vcount']; ?>‬/‭<?=$vars['total_vcount']; ?></span></div>
         <div class="barWrapper">
            <div class="bar" style="width:<?=$vars['percent']; ?>%">&nbsp;</div>
         </div>
      </div>
      <div class="villageList">
			<?=$vars['villages']; ?>    
      </div>
      <script type="text/javascript" data-cmp-info="6"> 
	  jQuery('#sidebarBoxVillagelist').find('.listEntry.attack span.incomingTroops').one('mouseover', function(event){Travian.Tip.load(event.delegateTarget, 'incomingTroops',{villageId: jQuery(event.delegateTarget).attr('data-id')});}); 
	  Travian.Game.VillageList.enableDragAndDropSorting();</script>
   </div>
</div>