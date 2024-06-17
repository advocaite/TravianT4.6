<h2>Punish Player</h2>
    <br/>
    <form method="post" action="?action=editPlayer&section=punishPlayer&uid=<?= $vars['playerId']; ?>&PunishVillage=<?=$vars['PunishVillage'];?>">
        <?= getCheckerInput(); ?>
        <?php if ($vars['banList']): ?>
            <input type="hidden" name="ref" value="bannedList">
        <?php endif; ?>
        <table id="profile" cellpadding="1" cellspacing="1">
            <thead>
            <tr>
                <th colspan="2">Player
                    <a href="admin.php?action=editPlayer&uid=<?= $vars['playerId']; ?>">
                        <?= $vars['playerName']; ?>
                    </a>
                </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Player Name</td>
                <td>
                    <input class="name text" type="text" name="a_name" disabled value="<?= $vars['playerName']; ?>" id="enterPlayerName" maxlength="20">
                </td>
            </tr>
            <?php if(isset($vars['v_name'])):?>
            <tr>
                <td>Village ID (kid):</td>
                <td>
                    <input class="name text" type="text" name="v_name" disabled value="<?= $vars['v_name']; ?>" maxlength="20">
                </td>
            </tr>
           <?php endif;?>
            <tr>
                <td>Punish Resources</td>
                <td>
                    <select name="PunishResources">
                        <?php for ($i = 0; $i <= 100; $i += 5): ?>
                            <option value="<?=$i; ?>" <?=$i == 0 ? 'selected' : ''; ?>><?=$i; ?>
                                %
                            </option>
                        <?php endfor; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Punish Troops</td>
                <td>
                    <select name="PunishTroops">
                        <?php for ($i = 0; $i <= 100; $i += 5): ?>
                            <option value="<?=$i; ?>" <?=$i == 0 ? 'selected' : ''; ?>><?=$i; ?>
                                %
                            </option>
                        <?php endfor; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Punish Buildings (resources)</td>
                <td>
                    <select name="PunishResourcesBuildings">
                        <?php for ($i = 0; $i <= 20; $i += 1): ?>
                            <option value="<?=$i; ?>" <?=$i == 0 ? 'selected' : ''; ?>><?=$i; ?>
                                level
                            </option>
                        <?php endfor; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Punish Buildings (buildings)</td>
                <td>
                    <select name="PunishBuildings">
                        <?php for ($i = 0; $i <= 20; $i += 1): ?>
                            <option value="<?=$i; ?>" <?=$i == 0 ? 'selected' : ''; ?>><?=$i; ?>
                                level
                            </option>
                        <?php endfor; ?>
                    </select>
                </td>
            </tr>
            </tbody>
        </table>
        <p class="btn">
            <input type="image" value="submit" name="submit" id="btn_ok" class="dynamic_img" src="img/x.gif"alt="Save"/>
        </p>
        <?php if ($vars['banList']): ?>
            <a href="?action=bannedList">« go back</a>
        <?php else: ?>
            <a href="?action=editPlayer&uid=<?= $vars['playerId']; ?>">« go back</a>
        <?php endif; ?>
    </form>