<?php

use Game\Formulas;

?>
<h4>Oasis converter</h4>
<div style="width: 550px;">
    <form method="post" action="admin.php?action=convertOasis">
        <table id="profile">
            <thead>
            <tr>
                <th colspan="2">Convert oasis</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Kid</td>
                <td>
                    <input class="fm fm110" type="number" name="kid" value="<?= $vars['kid']; ?>" required>
                </td>
            </tr>
            <tr>
                <td>Target Oasis type</td>
                <td>
                    <select name="type">
                        <?php
                        $oases = Formulas::$data['oases'];
                        foreach ($oases as $type => $arr) {
                            $resources = [];
                            foreach ($arr as $t => $v) {
                                $resources[] = sprintf('%s: %s', [1 => 'Wood', 'Clay', 'Iron', 'Crop'][$t], 25 * $v);
                            }
                            echo '<option ' . ($vars['type'] == $type ? 'selected' : '') . ' value="' . $type . '">' . implode(" | ",
                                    $resources) . '</option>';
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center">
                    <input type="image" src="img/admin/b/ok1.gif" value="submit">
                </td>
            </tr>
            </tbody>
        </table>
    </form>
    <br />
    <?php foreach ($vars['errors'] as $err): ?>
        <li style="color: red; font-weight: bold"><?= $err; ?></li>
    <?php endforeach; ?>
    <?php if($vars['success']):?>
        <h4 style="color: green; font-weight: bold;">Success.</h4>
    <?php endif;?>
</div>