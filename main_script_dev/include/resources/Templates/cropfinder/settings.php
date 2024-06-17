<form method="post" action="cropfinder.php">
<div class="inputWrapper">
   <table class="transparent">
      <tbody>
         <tr>
            <td>
               <span class="coordInputLabel"><?= T("cropFinder", "Start position:"); ?></span>
               <div class="coordinatesInput">
                  <div class="xCoord">
                     <label for="xCoordInput">X:</label>
                     <input type="text" maxlength="4" value="<?= $vars['x']; ?>" name="x" id="xCoordInput" class="text coordinates x " onkeyup="Travian.Formatter.Filter.aNumber(this)" onpaste="var cih = new Travian.Game.RallyPoint.CoordinatesInputHelper({coordinateXInputId: 'xCoordInput', coordinateYInputId: 'yCoordInput'}); cih.insertCoordinates(event);">
                  </div>
                  <div class="yCoord">
                     <label for="yCoordInput">Y:</label>
                     <input type="text" maxlength="4" value="<?= $vars['y']; ?>" name="y" id="yCoordInput" class="text coordinates y " onkeyup="Travian.Formatter.Filter.aNumber(this)" onpaste="var cih = new Travian.Game.RallyPoint.CoordinatesInputHelper({coordinateXInputId: 'xCoordInput', coordinateYInputId: 'yCoordInput'}); cih.insertCoordinates(event);">
                  </div>
                  <div class="clear"></div>
               </div>
               <span class="clear"></span>
            </td>
         </tr>
         <tr>
            <td>
               Type:						<span class="type">
               <label>
               <input type="radio" class="radio" name="type" value="15"<?= $vars['typ'] == "15" ? ' checked="checked"' : ''; ?> />15 <?= T("cropFinder",
                                "cropper"); ?>							</label>
               </span>
               <span class="type">
               <label>
               <input type="radio" class="radio" name="type" value="9"<?= $vars['typ'] == "9" ? ' checked="checked"' : ''; ?> />9 <?= T("cropFinder",
                                "cropper"); ?>							</label>
               </span>
               <span class="type">
               <label>
               <input type="radio" class="radio" name="type" value="all" <?= $vars['typ'] == "all" ? ' checked="checked"' : ''; ?>/><?= T("cropFinder",
                                "both"); ?>							</label>
               </span>
            </td>
         </tr>
         <tr>
            <td>
               <label>
                  <?= T("cropFinder", "Oasis crop bonus (at least)"); ?>:					
                  <select class="dropdown" name="bonus_getreide">
					<option value="all" <?= $vars['bonus_getreide'] == "all" ? 'selected' : ''; ?>><?= T("cropFinder","any"); ?></option>
					<option value="25" <?= $vars['bonus_getreide'] == "25" ? 'selected' : ''; ?>>+25%</option>
					<option value="50" <?= $vars['bonus_getreide'] == "50" ? 'selected' : ''; ?>>+50%</option>
					<option value="75" <?= $vars['bonus_getreide'] == "75" ? 'selected' : ''; ?>>+75%</option>
					<option value="100" <?= $vars['bonus_getreide'] == "100" ? 'selected' : ''; ?>>+100%</option>
					<option value="125" <?= $vars['bonus_getreide'] == "125" ? 'selected' : ''; ?>>+125%</option>
					<option value="150" <?= $vars['bonus_getreide'] == "150" ? 'selected' : ''; ?>>+150%</option>
                  </select>
               </label>
            </td>
         </tr>
         <tr>
            <td>
               <label>
                <input type="checkbox" id="only_free" name="only_free"
                               value="1" <?= $vars['only_free'] ? 'checked="checked"' : ''; ?>
                               class="check"/>
                        <?= T("cropFinder", "only show unoccupied"); ?></label>
            </td>
         </tr>
      </tbody>
   </table>
</div>
<button type="submit" value="search" name="suchen" id="suchen" class="textButtonV1 green " version="textButtonV1"><?= T("cropFinder", "search"); ?></button>
<script type="text/javascript">
	jQuery(function () {
		if (jQuery('#suchen').length > 0) {
			jQuery('#suchen').click(function (event) {
				jQuery(window).trigger('buttonClicked', [this, {
					"type": "submit",
					"value": "<?=T("cropFinder", "search");?>",
					"name": "suchen",
					"id": "suchen",
					"class": "textButtonV1 green ",
					"title": "",
					"confirm": "",
					"onclick": "",
					"version": "textButtonV1"
				}]);
			});
		}
	});
</script>
<div class="spacer"></div>
</form>