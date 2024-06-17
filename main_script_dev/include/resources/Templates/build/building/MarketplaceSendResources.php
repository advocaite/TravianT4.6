<form id="send_resources" class="send_resources" method="post" name="snd"
      action="build.php">
    <input type="hidden" name="dname" id="dname"
           value="<?= $vars['dname']; ?>"/>
    <input type="hidden" name="t" id="t" value="5"/>
    <input type="hidden" name="id" id="id"
           value="<?= $vars['index']; ?>"/>
    <input type="hidden" name="a" id="a"
           value="<?= $vars['my_kid']; ?>"/>
    <input type="hidden" name="sz" id="sz" value="748"/>
    <input type="hidden" name="kid" id="kid"
           value="<?= $vars['kid']; ?>"/>
    <input type="hidden" name="c" id="c"
           value="<?= $vars['checker']; ?>"/>
    <input type="hidden" name="x2" id="x2" value="<?= $vars['x2']; ?>"/>
    <table id="target_validate" class="res_target" cellpadding="1"
           cellspacing="1">
        <tr>
            <th>
                <?= T("MarketPlace", "Target"); ?>
            </th>
            <td class="vil">
                <?= $vars['dname']; ?>
                <a class=""
                   href="karte.php?x=<?= $vars['x']; ?>&amp;y=<?= $vars['y']; ?>">
                    <span class="coordinates coordinatesWrapper"><span
                                class="coordinateX">(<?= $vars['x']; ?></span><span class="coordinatePipe">|</span><span
                                class="coordinateY"><?= $vars['y']; ?>)</span></span>
                </a>
            </td>
        </tr>
        <tr>
            <th>
                <?= T("MarketPlace", "Player"); ?>:
            </th>
            <td>
                <a href="spieler.php?uid=<?= $vars['uid']; ?>">
                    <?= $vars['playerName']; ?>
                </a>
            </td>
        </tr>
        <tr>
            <th>
                <?= T("MarketPlace", "Alliance"); ?>:
            </th>
            <td>
                <?= $vars['allianceName']; ?>
            </td>
        </tr>
        <tr>
            <th>
                <?= T("Global", "General.duration"); ?>:
            </th>
            <td>
                <?= $vars['durationInSeconds']; ?>
            </td>
        </tr>
        <tr>
            <th>
                <?= T("MarketPlace", "Merchants"); ?>:
            </th>
            <td>
                <?= $vars['merchantsNeeded']; ?>
            </td>
        </tr>
        <tr>
            <td>
            </td>
            <td>
                <?= $vars['x2']; ?>&times; <?= T("MarketPlace", "go"); ?>
            </td>
        </tr>
    </table>
    <div class="clear">
    </div>
</form>