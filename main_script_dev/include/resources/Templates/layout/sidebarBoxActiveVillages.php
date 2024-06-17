<div id="sidebarBoxActiveVillage" class="sidebarBox">
 <div class="header ">
	<div class="buttonsWrapper">
	   <?=$vars['marketplace']; ?>
	   <?=$vars['barracks']; ?>
	   <?=$vars['stable']; ?>
	   <?=$vars['workshop']; ?>
	  
	</div>
 </div>
 <div class="content">
	<div class="playerName"><?=$vars['playerName']; ?></div>
	<div id="villageName" class="boxTitle editable">
	   <form>
		  <input class="villageInput" type="text" maxlength="20" name="villageName" value="<?=filter_var($vars['villageName'], FILTER_SANITIZE_STRING); ?>">
		  <svg viewBox="0 0 12.79 18.77" class="rename">
			 <path d="M4 15.61l1.68.9L.8 18.77 0 13.42l1.75.95zm8.25-13.39L8.36.12A1 1 0 0 0 7 .55L1.19 11.22a1 1 0 0 0 .42 1.41l3.89 2.1a1.05 1.05 0 0 0 1.41-.42l5.76-10.68a1 1 0 0 0-.42-1.41z"></path>
		  </svg>
	   </form>
	</div>
	<div class="loyalty <?=$vars['loyalty'] > 100 ? "high" : (($vars['loyalty'] >= 50 || $vars['loyalty'] == 100) ? "medium" : "low"); ?>">
	   <?= T("ResidencePalace", "Loyalty"); ?>: <span>‭‭<?=round($vars['loyalty']); ?>‬%‬</span>
	</div>
	<script type="text/javascript" data-cmp-info="6">
	   function saveChanges(newVillageName) {
		Travian.api('village/change-name', {
			data: {
				name: newVillageName,
				did: '<?=$vars['villageId'];?>'
			},
			success: function(data) {
			},
				  error: function(body) {
					  var errorDialog = new Travian.Dialog.Dialog({
						  buttonOk: true,
						  buttonCloseOnClickOk: true,
						  preventFormSubmit: true
					  });
					  errorDialog.setContent(body.errorMsg);
					  errorDialog.show();
				  }
		});
	   }
	   
	   jQuery(function() {
		var villageNameForm = jQuery('#villageName form');
		var villageNameInput = jQuery('#villageName input');
	   
		villageNameInput.on('focusout', function () {
			saveChanges(villageNameInput.val())
		});
	   
		villageNameForm.on('submit', function (event) {
			event.preventDefault();
				  villageNameInput.blur();
		});
	   })
	</script>
 </div>
</div>