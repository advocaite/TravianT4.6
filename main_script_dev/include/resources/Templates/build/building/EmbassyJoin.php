<table cellpadding="1" cellspacing="1" id="join" class="transparent">
    <form method="post" action="build.php">
        <input type="hidden" name="id" value="<?=$vars['buildingIndex']; ?>">
        <input type="hidden" name="a" value="2">
        <tbody>
        <?=$vars['tbody']; ?>
        </tbody>
    </form>
</table>
<?php if (isset($vars['error'])): ?>
    <div class="error">
        <?=$vars['error']; ?>
    </div>
<?php endif; ?>