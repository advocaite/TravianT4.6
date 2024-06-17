<?php use Core\Session;?>
<div>
    <div style="float:left; width: 49%;">
        <form action="admin.php?action=gifts" method="POST">
            <input type="hidden" name="section" value="giftResources">
            <?= getCheckerInput(); ?>
            <table id="member" style="width:300px;">
                <thead>
                <tr>
                    <th colspan="2">Give Everyone Free Resources</th>
                </tr>
                <tr>
                    <td class="hab">Resource</td>
                    <td>Amount</td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <center>
                            <img src="img/admin/r/1.gif"> Wood
                        </center>
                    </td>
                    <td>
                        <center>
                            <input class="fm" name="wood" value="1" maxlength="40000">
                        </center>
                    </td>
                </tr>

                <tr>
                    <td>
                        <center>
                            <img src="img/admin/r/2.gif"> Clay
                        </center>
                    </td>
                    <td>
                        <center>
                            <input class="fm" name="clay" value="1" maxlength="40000">
                        </center>
                    </td>
                </tr>

                <tr>
                    <td>
                        <center>
                            <img src="img/admin/r/1.gif"> Iron
                        </center>
                    </td>
                    <td>
                        <center>
                            <input class="fm" name="iron" value="1" maxlength="40000">
                        </center>
                    </td>
                </tr>

                <tr>
                    <td>
                        <center>
                            <img src="img/admin/r/4.gif"> Crop
                        </center>
                    </td>
                    <td>
                        <center>
                            <input class="fm" name="crop" value="1" maxlength="40000">
                        </center>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <center>
                            <?php $session_checker_key = Session::getCheckerName() . "=" . Session::getInstance()->getChecker(); ?>
                            <button type="button"
                                    onclick="window.location.href='/admin.php?action=gifts&fullResources&<?= $session_checker_key; ?>'">
                                Full all resources
                            </button>
                        </center>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <center>
                            <input type="image" src="img/admin/b/ok1.gif" value="submit" title="Gift">
                        </center>
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
        <br/><br/>
    </div>
    <div style="float:right; width:49%;">
        <form action="admin.php?action=gifts" method="POST">
            <input type="hidden" name="section" value="giftGold">
            <?= getCheckerInput(); ?>
            <table id="member" style="width:300px;">
                <thead>
                <tr>
                    <th colspan="2">Give Everyone Free gold</th>
                </tr>
                <tr>
                    <td>Amount</td>
                    <td></td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <center>
                            <b>How much gold?</b>
                        </center>
                    </td>
                    <td>
                        <center>
                            <input class="fm" name="give_gold" value="20" maxlength="40" style="width: 30%">&nbsp;
                            <img src="img/admin/gold.gif" class="gold" alt="Gold" name="gold" title="Gold"/>
                        </center>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <center>
                            <input type="image" src="img/admin/b/ok1.gif" value="submit"
                                   title="Give Players Free Gold">
                        </center>
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
        <form action="admin.php?action=gifts" method="POST">
            <input type="hidden" name="section" value="giftUidGold">
            <?= getCheckerInput(); ?>
            <table id="member" style="width:300px;">
                <thead>
                <tr>
                    <th colspan="2">Give Free gold for specific user</th>
                </tr>
                <tr>
                    <td>Amount</td>
                    <td></td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <center>
                            <b>How much gold?</b>
                        </center>
                    </td>
                    <td>
                        <center>
                            <input class="give_gold" name="giftUidGold" value="<?= $vars['giftUidGold']; ?>" maxlength="4"> &nbsp;
                            <img src="img/admin/gold.gif" class="gold" alt="Gold" name="gold" title="Gold"/>
                        </center>
                    </td>
                </tr>
                <tr>
                    <td>
                        <center>
                            <b>For which user (id)?</b>
                        </center>
                    </td>
                    <td>
                        <center>
                            <input class="give_gold" name="giftUid" value="<?= $vars['giftUid']; ?>">&nbsp;
                        </center>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <center>
                            <input type="image" src="img/admin/b/ok1.gif" value="submit" title="Give free gold">
                        </center>
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>
<?php if (!empty($vars['error'])) echo '<br />'; ?>
<p style="margin-top: 300px;"><font color="Red"><b><?= $vars['error']; ?></b></font></p>