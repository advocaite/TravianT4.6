<style rel="stylesheet">
    .response {
        width: 80%;
        padding: 15px;
        text-align: center;
        justify-content: center;
        vertical-align: middle;
        margin: 0 auto 20px;
        border: 1px solid transparent;
        border-radius: 4px;
    }

    .response.success {
        color: #3c763d;
        background-color: #dff0d8;
        border-color: #d6e9c6;
    }

    .response.danger {
        color: #a94442;
        background-color: #f2dede;
        border-color: #ebccd1;
    }
</style>
<h1>Add Natars Farm</h1>
<form action="admin.php?action=addNatarsFarm" method="POST">
    <table id="member" cellpadding="1" cellspacing="1">
        <thead>
        <tr>
            <th colspan="6">Add Natars Farm</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Resources level</td>
            <td>
                <input type="number" class="fm" name="resources_level" max=10 value="<?= $vars['resources_level']; ?>">
            </td>
        </tr>
        <tr>
            <td>Extra storage count</td>
            <td>
                <input type="number" class="fm" name="extra_storage" min=0 max=10 value="<?= $vars['extra_storage']; ?>">
            </td>
        </tr>
        <tr>
            <td>Villages on each side</td>
            <td>
                <input type="number" class="fm" name="village_count" value="<?= $vars['village_count']; ?>">
            </td>
        </tr>
        <tr>
            <td>Side</td>
            <td>
                <input <?= ($vars['deploy_se'] ? 'checked' : ''); ?> type="checkbox" name="deploy_se" value="1"> SE
                <input <?= ($vars['deploy_sw'] ? 'checked' : ''); ?> type="checkbox" name="deploy_sw" value="1"> SW
                <input <?= ($vars['deploy_ne'] ? 'checked' : ''); ?> type="checkbox" name="deploy_ne" value="1"> NE
                <input <?= ($vars['deploy_nw'] ? 'checked' : ''); ?> type="checkbox" name="deploy_nw" value="1"> NW
            </td>
        </tr>
        <tr>
            <td colspan="2" class="on"><input type="image" src="img/admin/b/ok1.gif" value="submit"></td>
        </tr>
        </tbody>
    </table>
</form>
<br><br>
<?php if (isset($vars['success'])): ?>
    <div class="response success"><?= $vars['success']; ?></div>
<?php endif; ?>
<?php if (isset($vars['error'])): ?>
    <div class="response danger"><?= $vars['error']; ?></div>
<?php endif; ?>