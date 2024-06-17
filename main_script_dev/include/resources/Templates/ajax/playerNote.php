<div id="playerNotePopup">
    <span class="error" id="playerNotePopupError"></span>
    <form method="post" action="" id="playerNoteForm">
        <label for="playerNoteText"><?=T("Profile", "NoteDescription");?></label>
        <p></p>
        <textarea id="playerNoteText" maxlength="500" name="playerNoteText" cols="60" rows="8"><?=$vars['note'];?></textarea>
        <div class="buttonWrapper buttons">
            <button type="submit" value="<?=T("Global", "General.save");?>" id="<?=($button_id = get_button_id());?>" class="textButtonV1 green " version="textButtonV1"><?=T("Global", "General.save");?></button>
			<script type="text/javascript" id="<?=$button_id;?>_script">
				jQuery(function() {
					jQuery('button#<?=$button_id;?>').click(function () {
						jQuery(window).trigger('buttonClicked', [this, {"type":"submit","value":"<?=T("Global", "General.save");?>","name":"","id":"<?=$button_id;?>","class":"textButtonV1 green ","title":"<?=T("Global", "General.save");?>","confirm":"","onclick":"","version":"textButtonV1"}]);
					});
				});
			</script>
        </div>
    </form>
</div>
<script type="text/javascript" data-cmp-info="6">
	jQuery(function () {

	    var playerNoteForm = jQuery('#playerNoteForm');

        playerNoteForm.on('submit', function(e) {
			e.preventDefault();

			new Travian.Game.AllianceMembers(
					{
						data: {
							affectedPlayerID: <?=$vars['playerID'];?>,
														noteText: playerNoteForm.find('textarea').val(),
																					action: 'save',
							hasNote: '1',
							hasSpecialization: '0'
						},
						context: 'playerNote',
						buttonOk: false,
						darkOverlay: true
					}
			);
		});

	});
	function maxLength(el) {
	    el = jQuery(el);

		if (el.attr('maxlength') !== 'undefined') {

			var max = el.attr('maxlength');
			el.on('keypress', function () {
				if (jQuery(this).val().length >= max) return false;
			});
		}
	}
	maxLength(document.getElementById("playerNoteText"));
</script>