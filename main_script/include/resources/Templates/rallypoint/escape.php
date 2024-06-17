<br/>
<a name="troopEscape"></a>
<h4 class="round"><?php use Core\Config;
    use Core\Database\DB;
    use Core\Session;
    use Game\Formulas;
    use Core\Locale;
    use Model\ProfileModel;

    echo T("RallyPoint", "EvasionSettings"); ?></h4>
<?php if ($vars['goldClub']): ?>
    <form class="troopEscape" action="build.php#troopEscape" method="post">
        <div class="troopEscape">
            <input type="hidden" name="id" value="39"/>
            <input type="hidden" name="troopEscape" value="<?=$vars['evasion']; ?>"/>
            <input type="hidden" name="tt" value="0"/>
            <input class="check" id="troop_escape_active" name="troop_escape_active"
                   type="checkbox"<?=$vars['evasion'] == 1 ? "checked" : ''; ?>
                   value="<?=$vars['evasion'] == 1 ? "true" : "false"; ?>"/>
            <label for="troop_escape_active"><?=T("RallyPoint", "EvasionDesc"); ?></label>
        </div>
        <p><?=T("RallyPoint", $vars['heroEvasion'] == 0 ? "HeroShowDesc" : "HeroHideDesc"); ?></p>
        <div>
            <?=$vars['evasionSaveButton']; ?>
        </div>
    </form>
    <?php
    if (Config::getProperty("custom", "allowEvasionForAllVillages")):
        $session = Session::getInstance();
        $db = DB::getInstance();
        $villages = $db->query("SELECT kid, name, pop, evasion, isWW, capital FROM vdata WHERE owner={$session->getPlayerId()}");
        if ($vars['evasion'] && $villages->num_rows > 1): ?>
            <hr/>
            <h4 class="round"><?=T("Profile", "Escape in villages"); ?></h4>
            <table cellpadding="1" cellspacing="1" id="villages">
                <thead>
                <tr>
                    <td class="name" style="width: 25%;"><?=T("Profile", "Name"); ?></td>
                    <td class="inhabitants" style="width: 10%;"><?=T("Profile", "Inhabitants"); ?></td>
                    <td class="coords" style="width: 10%;"><?=T("Profile", "Coordinates"); ?></td>
                    <td style="width: 5%"><?=T("Profile", "Status"); ?></td>
                </tr>
                </thead>
                <tbody>
                <?php
                $direction = strtolower(getDirection());
                $m = new ProfileModel();
                while ($row = $villages->fetch_assoc()) {
                    $xy = Formulas::kid2xy($row['kid']);
                    $enabled = $row['evasion'] == 1;
                    $extra = null;
                    if ($row['isWW']) {
                        $extra .= ' <span style="font-size: 11px;color: #777;">(' . T("Profile", "WoW") . ')</span>';
                    }
                    if ($m->isThereAnArtifact($row['kid'])) {
                        $extra .= ' <span style="font-size: 11px;color: #777;">(' . T("Profile", "Artifact") . ')</span>';
                    }
                    if ($row['capital']) {
                        $extra .= ' <span style="font-size: 11px;color: #777;">(' . T("Profile", "capital") . ')</span>';
                    }
                    echo '<tr>';
                    echo '<td class="name"><a href="karte.php?d=' . $row['kid'] . '">' . $row['name'] . '</a> ' . $extra . '</td>';
                    echo '<td class="inhabitants" style="text-align: center;">' . $row['pop'] . '</td>';
                    echo '<td class="coords" style="text-align: center;"><a class="" href="karte.php?x=' . $xy['x'] . '&amp;y=' . $xy['y'] . '">‎‭<span class="coordinates coordinatesWrapper coordinatesAligned coordinates' . $direction . '"><span class="coordinateX">(‭' . $xy['x'] . '‬‬</span><span class="coordinatePipe">|</span><span class="coordinateY">‭' . $xy['y'] . '‬‬)</span></span>‬‎</a></td>';
                    echo '<td style="text-align: center;"><select onchange="toggleState(' . $row['kid'] . ', this);"><option value="1" ' . ($enabled ? 'selected' : '') . '>' . T("Profile", "Active") . '</option><option value="0" ' . (!$enabled ? 'selected' : '') . '>' . T("Profile", "inActive") . '</option></select></td>';
                    echo '</tr>';
                }
                ?>
                </tbody>
            </table>
            <script type="text/javascript">
                function toggleState(kid, box) {
                    Travian.ajax({
                        data: {
                            cmd: "toggleEvasionState",
                            kid: kid
                        },
                        onSuccess: function (a) {
                            selectItemByValue(box, a.result);
                        },
                        onFailure: function (e) {
                            selectItemByValue(box.selectedIndex == 0 ? 1 : 0);
                        }
                    })
                }
                function selectItemByValue(elmnt, value) {
                    for (var i = 0; i < elmnt.options.length; i++) {
                        if (elmnt.options[i].value === value) {
                            elmnt.selectedIndex = i;
                            break;
                        }
                    }
                }
            </script>
        <?php endif; ?>
    <?php endif; ?>
<?php else: ?>
    <div class="build_desc"><p><?=$vars['goldClubEvasionDesc']; ?></p>
        <?=$vars['goldClubButton']; ?>
    </div>
<?php endif; ?>