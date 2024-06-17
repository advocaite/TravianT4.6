<script type="text/javascript">
    function confirmAction() {
        if (!confirm("Are you sure you want to do this?")) {
            return false;
        }
        return true;
    }
</script>
<h2>Edit village</h2>
<form action="admin.php?action=editVillage&section=editAll&kid=<?= $vars['kid']; ?>" method="POST">
    <input type="hidden" name="kid" value="<?= $vars['kid']; ?>">
    <?= getCheckerInput(); ?>
    <input type="hidden" name="lastResources" value="<?= $vars['lastResources']; ?>">
    <?php for ($i = 1; $i <= 10; ++$i): ?>
        <input type="hidden" name="oldTroops[<?= $i; ?>]" value="<?= $vars['troopsArray'][$i]; ?>">
    <?php endfor; ?>
    <div>
        <div style="float: left; width: 49%;">
            <table id="member">
                <thead>
                <tr>
                    <th colspan="2">Village</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Owner</td>
                    <td>
                        <a href="?action=editPlayer&uid=<?= $vars['owner']; ?>"><?= $vars['ownerName']; ?></a>
                    </td>
                </tr>
                <tr>
                    <td>Village name</td>
                    <td>
                        <input type="text" class="fm" name="villageName" value="<?= $vars['villageName']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Population</td>
                    <td>
                        <?= $vars['pop']; ?>
                    </td>
                </tr>
                <tr>
                    <td>Culture points</td>
                    <td>
                        <?= $vars['cp']; ?>
                    </td>
                </tr>
                </tbody>
            </table>
            <?php if (getCustom('allowInterruptionInGame')): ?>
                <table id="member">
                    <thead>
                    <tr>
                        <th colspan="2">Resources</th>
                    </thead>
                    <tbody>
                    <?= $vars['resources']; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
        <div style="float: right; width: 49%;">

            <table id="member">
                <thead>
                <tr>
                    <th colspan="1">Troop Name</th>
                    <th colspan="1">Number</th>
                    <th colspan="1">Level</th>
                </thead>
                <tbody>
                <?= $vars['troops']; ?>
                </tbody>
            </table>
            <br/>
            <br/>
            <input type="image" value="submit" name="submit" id="btn_save" class="dynamic_img" src="img/x.gif"
                   alt="Save"/>
        </div>
    </div>
</form>
<br/><br/>
<br/><br/>
<br/><br/>
<br/><br/>
<br/><br/>
<br/><br/>
<br/><br/>
<br/><br/>
<br/><br/>
<a href="?action=upgradeVillage&kid=<?= $vars['kid']; ?>">« Upgrade village</a>
<br/>
<a href="?action=editVillage&kid=<?= $vars['kid']; ?>&r=arriveOwnMovements" onclick="return confirmAction();">« Arrive
    all own movements</a>
<br/>
<a style="color: red" href="?action=editVillage&kid=<?= $vars['kid']; ?>&r=deleteVillage"
   onclick="return confirmAction();">« Delete village</a>
<br/>
<a href="?action=editVillage&kid=<?= $vars['kid']; ?>&r=fillResources" onclick="return confirmAction();">« Fill all resources</a>
<br/>
<a href="?action=editPlayer&section=punishPlayer&uid=<?= $vars['owner']; ?>&PunishVillage=<?= $vars['kid']; ?>">« Punish village</a>
<br/><br/>
<br/><br/>
<div style="float: left; width: 49%">
    <table id="profile">
        <thead>
        <tr>
            <th colspan="5">Trainings</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td></td>
            <td>Unit</td>
            <td>Number</td>
            <td>End time</td>
            <td></td>
        </tr>
        <?= $vars['trainings']; ?>
        </tbody>
    </table>
    <br/>
    <table id="profile">
        <thead>
        <tr>
            <th colspan="5">Buildings</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td></td>
            <td>Building</td>
            <td>End time</td>
            <td></td>
        </tr>
        <?= $vars['buildings']; ?>
        </tbody>
    </table>
    <br/>

    <table id="profile">
        <thead>
        <tr>
            <th colspan="3">Celebrations and festivals</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td></td>
            <td>Type</td>
            <td>End time</td>
        </tr>
        <?= $vars['celebrations']; ?>
        </tbody>
    </table>
</div>
<div style="float: right; width: 49%">
    <table id="profile">
        <thead>
        <tr>
            <th colspan="4">Researches</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td></td>
            <td>Unit</td>
            <td>End time</td>
            <td></td>
        </tr>
        <?= $vars['researches']; ?>
        </tbody>
    </table>
    <br/>
    <table id="profile">
        <thead>
        <tr>
            <th colspan="4">Demolishes</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td></td>
            <td>Building</td>
            <td>End time</td>
            <td></td>
        </tr>
        <?= $vars['demolishes']; ?>
        </tbody>
    </table>
    <br/>
    <table id="profile">
        <thead>
        <tr>
            <th colspan="5">Artifacts</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td></td>
            <td>Name</td>
            <td>Conquer time</td>
            <td>Activation time</td>
            <td></td>
        </tr>
        <?= $vars['artifacts']; ?>
        </tbody>
    </table>
</div>