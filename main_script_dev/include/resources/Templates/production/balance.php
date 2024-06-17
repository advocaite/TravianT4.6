<?php

use Core\Database\DB;
use Core\Session;
use Core\Village;
use Game\Formulas;
use Model\ArtefactsModel;

$wwEffect = Village::getInstance()->isWW() && ArtefactsModel::wwPlansReleased() ? 1 / 2 : 1;
$helper = new Game\GoldHelper();
?>
<div class="cropBalanceContainer">
    <?php
    ob_start();
    $totalProd = 0;
    $totalBonus = 0;
    $boostTotalBonus = 0;
    foreach ($vars['boost'][$vars['tabIndex']] as $boost) {
        $level = $vars['bonusBuilding'][$boost];
        if ($boost == 45) {
            $boostTotalBonus += ($level * 0.05) * $vars['oasesBonus']['bonus'][$vars['tabIndex'] - 1];
        } else {
            $boostTotalBonus += $level * 5;
        }
    }
    foreach ($vars['productionFields'] as $field) {
        $bonus = round5($field['value'] * ($boostTotalBonus + $vars['oasesBonus']['bonus'][$field['item_id'] - 1]) / 100);
        $totalProd += $field['value'];
        $totalBonus += $bonus;
    }
    $loadingCrop = Village::getInstance()->getCropLoading();
    ?>
    <div class="balanceCropBalancePart">
        <table cellspacing="0" cellpadding="0" class="row_table_data">
            <tbody>
            <tr>
                <td><?= T("productionOverview", "Production of buildings and oases"); ?></td>
                <td class="numberCell"><?= number_format_x($totalProd + $totalBonus); ?></td>
            </tr>
            <tr>
                <td><?= T("productionOverview", "Population and construction orders"); ?></td>
                <td class="numberCell">-<?= number_format_x(Village::getInstance()->getPop() + $loadingCrop); ?>
                    ‎
                </td>
            </tr>
            <tr class="subtotal">
                <td class="bold"><?= T("inGame", "resources.r5"); ?></td>
                <td class="bold numberCell"><?= number_format_x(
                        ($totalProd + $totalBonus) - Village::getInstance()->getPop() - $loadingCrop
                    ); ?></td>
            </tr>
            <tr>
                <td><?= T("productionOverview", "Incomplete construction orders"); ?></td>
                <td class="numberCell"><?= number_format_x($loadingCrop); ?></td>
            </tr>
            <tr>
                <td><?= T("productionOverview", "hero_production"); ?></td>
                <td class="numberCell"><?= number_format_x($vars['heroProd'][3]); ?></td>
            </tr>
            <tr class="<?= !$vars['bonusPlus'][3] ? 'inactive' : ''; ?>">
                <td>
                    +25%‎ <?= T("productionOverview",
                        "production"); ?><?= !$vars['bonusPlus'][3] ? '    (' . T("productionOverview",
                            "inactive") . ')' : ''; ?></td>
                <td class="numberCell"><?= number_format_x(round(($totalProd + $totalBonus + $vars['heroProd'][3]) / 4)); ?></td>
            </tr>
            <tr class="subtotal">
                <td class="bold"><?= T("productionOverview", "interim_balance"); ?>
                    =
                </td>
                <td class="numberCell bold"><?= number_format_x($totalProd + $totalBonus - Village::getInstance()->getPop() + $vars['heroProd'][$vars['tabIndex'] - 1] + ($vars['bonusPlus'][$vars['tabIndex'] - 1] ? round(($totalProd + $totalBonus + $vars['heroProd'][$vars['tabIndex'] - 1]) / 4) : 0)); ?></td>
            </tr>
            </tbody>
        </table>
    </div>
    <?php
    function getOasesAsString($kid)
    {
        $kid = (int)$kid;
        $db = DB::getInstance();
        $find = $db->query("SELECT kid FROM odata WHERE did=$kid");
        if (!$find->num_rows) {
            return null;
        }
        $oases = [];
        while ($row = $find->fetch_assoc()) {
            $oases[] = $row['kid'];
        }
        $find->free();

        return implode(",", $oases);
    }


    $hdp = Village::getInstance()->getHorseDrinkingPoolLvl();
    $db = DB::getInstance();
    $totalOwnHDP = 0;
    $units = $db->query("SELECT * FROM units WHERE kid=" . Village::getInstance()->getKid())->fetch_assoc();
    $inVillage = 0;
    for ($i = 1; $i <= 11; ++$i) {
        $inVillage += $units['u' . $i] * Formulas::uUpkeep(nrToUnitId($i, Session::getInstance()->getRace()), 0);
        if (Formulas::checkHDPEffect(nrToUnitId($i, Session::getInstance()->getRace()), $hdp)) {
            $totalOwnHDP += $units['u' . $i] * Formulas::getHDPAndNonHDPDiffCrop(nrToUnitId($i,
                    Session::getInstance()->getRace()),
                    $hdp);
        }
    }
    $enf = $db->query("SELECT * FROM enforcement WHERE kid=" . Session::getInstance()->getKid());
    $enforcement = 0;
    while ($row = $enf->fetch_assoc()) {
        for ($i = 1; $i <= 11; ++$i) {
            $enforcement += $row['u' . $i] * Formulas::uUpkeep(nrToUnitId($i, Session::getInstance()->getRace()), 0);
            if (Formulas::checkHDPEffect(nrToUnitId($i, Session::getInstance()->getRace()), $hdp)) {
                $totalOwnHDP += $row['u' . $i] * Formulas::getHDPAndNonHDPDiffCrop(nrToUnitId($i,
                        Session::getInstance()->getRace()),
                        $hdp);
            }
        }
    }
    $imprisoned = 0;
    $trapped = $db->query("SELECT * FROM trapped WHERE kid=" . Session::getInstance()->getKid());
    while ($row = $trapped->fetch_assoc()) {
        for ($i = 1; $i <= 11; ++$i) {
            $imprisoned += $row['u' . $i] * Formulas::uUpkeep(nrToUnitId($i, Session::getInstance()->getRace()), 0);
            if (Formulas::checkHDPEffect(nrToUnitId($i, Session::getInstance()->getRace()), $hdp)) {
                $totalOwnHDP += $row['u' . $i] * Formulas::getHDPAndNonHDPDiffCrop(nrToUnitId($i,
                        Session::getInstance()->getRace()),
                        $hdp);
            }
        }
    }
    $kid = Session::getInstance()->getKid();
    $onTheWay = 0;
    $trapped = $db->query("SELECT * FROM movement WHERE ((kid=$kid AND mode=0) OR (to_kid=$kid AND mode=1))");
    while ($row = $trapped->fetch_assoc()) {
        for ($i = 1; $i <= 11; ++$i) {
            $onTheWay += $row['u' . $i] * Formulas::uUpkeep(nrToUnitId($i, Session::getInstance()->getRace()), 0);
            if (Formulas::checkHDPEffect(nrToUnitId($i, Session::getInstance()->getRace()), $hdp)) {
                $totalOwnHDP += $row['u' . $i] * Formulas::getHDPAndNonHDPDiffCrop(nrToUnitId($i,
                        Session::getInstance()->getRace()),
                        $hdp);
            }
        }
    }
    $total = $inVillage + $enforcement + $onTheWay + $imprisoned;
    $artEff = ArtefactsModel::getArtifactEffectByType(Session::getInstance()->getPlayerId(),
        Session::getInstance()->getKid(),
        \Model\ArtefactsModel::ARTIFACT_DIET);
    $sum = floor(($total - $totalOwnHDP) * $artEff * $wwEffect);
    $total_mine = $sum;
    ?>
    <div class="balanceCropBalancePart balanceTroops">
        <div class="boxes boxesColor gray">
            <div class="boxes-tl"></div>
            <div class="boxes-tr"></div>
            <div class="boxes-tc"></div>
            <div class="boxes-ml"></div>
            <div class="boxes-mr"></div>
            <div class="boxes-mc"></div>
            <div class="boxes-bl"></div>
            <div class="boxes-br"></div>
            <div class="boxes-bc"></div>
            <div class="boxes-contents cf">
                <div class="switchDown  " id="ownBalanceTroops">
                    <div class="switchDownCloseStateContainer ">
                        <div
                                class="switchClosed headline"><?= T("productionOverview",
                                "Consumption of own troops"); ?></div>
                        <div class="switchDownContent">
                            <span class="bold"><?= number_format_x(0 - $sum); ?>‎</span>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="switchDownOpenStateContainer hide">
                        <div
                                class="switchOpened headline"><?= T("productionOverview",
                                "Consumption of own troops"); ?></div>
                        <div class="clear"></div>
                        <div class="switchDownContent">
                            <table>
                                <tbody>
                                <tr>
                                    <td class="troopLabel">
                                        - <?= T("productionOverview", "in village"); ?></td>
                                    <td class="numberCell"><?= number_format_x(0 - $inVillage); ?>
                                        ‎
                                    </td>
                                </tr>
                                <tr>
                                    <td class="troopLabel">
                                        - <?= T("productionOverview",
                                            "in oasis or reinforcements from own villages"); ?></td>
                                    <td class="numberCell"><?= number_format_x(0 - $enforcement); ?>
                                        ‎
                                    </td>
                                </tr>
                                <tr>
                                    <td class="troopLabel">
                                        - <?= T("productionOverview", "on the way"); ?></td>
                                    <td class="numberCell"><?= number_format_x(0 - $onTheWay); ?>
                                        ‎
                                    </td>
                                </tr>
                                <tr>
                                    <td class="troopLabel">
                                        - <?= T("productionOverview", "imprisoned"); ?></td>
                                    <td class="numberCell"><?= number_format_x(0 - $imprisoned); ?>
                                        ‎
                                    </td>
                                </tr>
                                <tr class=" <?= $artEff <> 1 ? '' : 'inactive'; ?>">
                                    <td class="troopLabel"><?= T("productionOverview", "Artefact bonus"); ?></td>
                                    <td class="numberCell"><?= number_format_x($total - ($total * $artEff)); ?></td>
                                </tr>
                                <?php if ($wwEffect < 1): ?>
                                    <tr>
                                        <td class="troopLabel"><?= T("productionOverview", "WW effect"); ?></td>
                                        <td class="numberCell"><?= number_format_x($total - ($total * $wwEffect)); ?></td>
                                    </tr>
                                <?php endif; ?>
                                <?php if (Session::getInstance()->getRace() == 1): ?>
                                    <tr class=" <?= $totalOwnHDP >= 1 ? '' : 'inactive'; ?>">
                                        <td class="troopLabel"><?= T("productionOverview", "HDP"); ?></td>
                                        <td class="numberCell"><?= number_format_x($totalOwnHDP); ?></td>
                                    </tr>
                                <?php endif; ?>
                                <tr class="subtotal">
                                    <td class="bold"><?= T("productionOverview", "sum"); ?></td>
                                    <td class="numberCell bold"><?= number_format_x(0 - $sum); ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
                <script type="text/javascript">
                    jQuery(function () {
                        new Travian.Game.SwitchDown('#ownBalanceTroops');
                    });
                </script>
            </div>
        </div>
    </div>
    <?php
    function getHDP($kid)
    {
        $db = DB::getInstance();
        $buildings = $db->query("SELECT `f18t`, `f19`, `f19t`, `f20`, `f20t`, `f21`, `f21t`, `f22`, `f22t`, `f23`, `f23t`, `f24`, `f24t`, `f25`, `f25t`, `f26`, `f26t`, `f27`, `f27t`, `f28`, `f28t`, `f29`, `f29t`, `f30`, `f30t`, `f31`, `f31t`, `f32`, `f32t`, `f33`, `f33t`, `f34`, `f34t`, `f35`, `f35t`, `f36`, `f36t`, `f37`, `f37t`, `f38`, `f38t` FROM fdata WHERE kid={$kid}");
        if (!$buildings->num_rows) {
            return 0;
        }
        $buildings = $buildings->fetch_assoc();
        for ($i = 18; $i <= 38; ++$i) {
            if ($buildings['f' . $i . 't'] == 41) {
                return $buildings['f' . $i];
            }
        }

        return 0;
    }

    $totalHDP = 0;
    $enf = $db->query("SELECT * FROM enforcement WHERE to_kid=" . Session::getInstance()->getKid());
    $inVillage = 0;
    while ($row = $enf->fetch_assoc()) {
        $hdp = getHDP($row['kid']);//set hdp of kid
        for ($i = 1; $i <= 11; ++$i) {
            $inVillage += $row['u' . $i] * Formulas::uUpkeep(nrToUnitId($i, $row['race']), 0);
            if (Formulas::checkHDPEffect(nrToUnitId($i, Session::getInstance()->getRace()), $hdp)) {
                $totalHDP += $row['u' . $i] * Formulas::getHDPAndNonHDPDiffCrop(nrToUnitId($i,
                        Session::getInstance()->getRace()),
                        $hdp);
            }
        }
    }
    $oases = getOasesAsString(Village::getInstance()->getKid());
    $enforcement = 0;
    if (!empty($oases)) {
        $enf = $db->query("SELECT * FROM enforcement WHERE to_kid IN($oases)");
        while ($row = $enf->fetch_assoc()) {
            $hdp = getHDP($row['kid']);//set hdp of kid
            for ($i = 1; $i <= 11; ++$i) {
                $enforcement += $row['u' . $i] * Formulas::uUpkeep(nrToUnitId($i, $row['race']), 0);
                if (Formulas::checkHDPEffect(nrToUnitId($i, Session::getInstance()->getRace()), $hdp)) {
                    $totalHDP += $row['u' . $i] * Formulas::getHDPAndNonHDPDiffCrop(nrToUnitId($i,
                            Session::getInstance()->getRace()),
                            $hdp);
                }
            }
        }
    }
    $total = $inVillage + $enforcement;
    $sum = floor(($total - $totalHDP) * $artEff * $wwEffect);
    $total_mine += $sum;
    ?>
    <div class="balanceCropBalancePart balanceTroops">
        <div class="boxes boxesColor gray">
            <div class="boxes-tl"></div>
            <div class="boxes-tr"></div>
            <div class="boxes-tc"></div>
            <div class="boxes-ml"></div>
            <div class="boxes-mr"></div>
            <div class="boxes-mc"></div>
            <div class="boxes-bl"></div>
            <div class="boxes-br"></div>
            <div class="boxes-bc"></div>
            <div class="boxes-contents cf">
                <div class="switchDown  " id="foraignBalanceTroops">
                    <div class="switchDownCloseStateContainer ">
                        <div
                                class="switchClosed headline"><?= T("productionOverview",
                                "Consumption of foreign troops"); ?></div>
                        <div class="switchDownContent">
                            <span class="bold"><?= number_format_x(0 - $sum); ?>‎</span>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="switchDownOpenStateContainer hide">
                        <div
                                class="switchOpened headline"><?= T("productionOverview",
                                "Consumption of foreign troops"); ?></div>
                        <div class="clear"></div>
                        <div class="switchDownContent">
                            <table>
                                <tbody>
                                <tr>
                                    <td class="troopLabel">
                                        - <?= T("productionOverview", "in village"); ?></td>
                                    <td class="numberCell"><?= number_format_x(0 - $inVillage); ?></td>
                                </tr>
                                <tr>
                                    <td class="troopLabel">
                                        - <?= T("productionOverview",
                                            "in oasis or reinforcements from own villages"); ?></td>
                                    <td class="numberCell"><?= number_format_x(0 - $enforcement); ?></td>
                                </tr>
                                <tr class=" <?= $artEff <> 1 ? '' : 'inactive'; ?>">
                                    <td class="troopLabel"><?= T("productionOverview", "Artefact bonus"); ?></td>
                                    <td class="numberCell"><?= number_format_x($total - ($total * $artEff)); ?></td>
                                </tr>
                                <?php if ($wwEffect < 1): ?>
                                    <tr>
                                        <td class="troopLabel"><?= T("productionOverview", "WW effect"); ?></td>
                                        <td class="numberCell"><?= number_format_x($total - ($total * $wwEffect)); ?></td>
                                    </tr>
                                <?php endif; ?>
                                <?php if (Session::getInstance()->getRace() == 1): ?>
                                    <tr class=" <?= $totalOwnHDP >= 1 ? '' : 'inactive'; ?>">
                                        <td class="troopLabel"><?= T("productionOverview", "HDP"); ?></td>
                                        <td class="numberCell"><?= number_format_x($totalHDP); ?></td>
                                    </tr>
                                <?php endif; ?>
                                <tr class="subtotal">
                                    <td class="bold"><?= T("productionOverview", "sum"); ?></td>
                                    <td class="numberCell bold"><?= number_format_x(0 - $sum); ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
                <script type="text/javascript">
                    jQuery(function () {
                        new Travian.Game.SwitchDown('#foraignBalanceTroops');
                    });
                </script>
            </div>
        </div>
    </div>
    <div class="balanceCropBalancePart">
        <table cellspacing="0" cellpadding="0" class="row_table_data">
            <tbody>
            <tr class="total">
                <td class="bold"><?= T("productionOverview", "Crop balance"); ?>
                    =
                </td>
                <td class="bold numberCell"><?= number_format_x(($totalProd + $totalBonus - Village::getInstance()->getPop() + $vars['heroProd'][$vars['tabIndex'] - 1] + ($vars['bonusPlus'][$vars['tabIndex'] - 1] ? round(($totalProd + $totalBonus + $vars['heroProd'][$vars['tabIndex'] - 1]) / 4) : 0)) - $total_mine); ?></td>
            </tr>
            </tbody>
        </table>
    </div>
    <?php
    $content = ob_get_clean();
    ?>
    <div class="productionBoostSpeechBubble">
        <div class="productionBoostResourceSpeechBubble">
            <div class="fluidSpeechBubble-container">
                <div class="fluidSpeechBubble">
                    <div class="fluidSpeechBubble-tl"></div>
                    <div class="fluidSpeechBubble-tr"></div>
                    <div class="fluidSpeechBubble-tc"></div>
                    <div class="fluidSpeechBubble-ml"></div>
                    <div class="fluidSpeechBubble-mr"></div>
                    <div class="fluidSpeechBubble-mc"></div>
                    <div class="fluidSpeechBubble-bl"></div>
                    <div class="fluidSpeechBubble-br"></div>
                    <div class="fluidSpeechBubble-bc"></div>
                    <div class="speechArrowBack"></div>
                    <div class="fluidSpeechBubble-contents cf">
                        <form id="fluidSpeechBubble" method="post" action="">
                            <p><?= T("productionOverview", "productionWithBoost"); ?>
                                : <span
                                        class="bold"><?= number_format_x(($totalProd + $totalBonus - Village::getInstance()->getPop() + $vars['heroProd'][$vars['tabIndex'] - 1] + (round(($totalProd + $totalBonus + $vars['heroProd'][$vars['tabIndex'] - 1]) / 4))) - $total_mine); ?></span>
                            </p>

                            <div>
                                <?= $helper->getProductionBoostButton(4, false, false, true); ?>
                            </div>
                            <div class="productionBoostSpeechBubbleFurtherInfo">
                                <p><?= T("productionOverview", "productionBoostSpeechBubbleFurtherInfo"); ?></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= $content; ?>
    <div class="clear"></div>
    <?php
    /*
    <div class="emptyStorageSpeechBubble">
        <div class="fluidSpeechBubble-container">
            <div class="fluidSpeechBubble">
                <div class="fluidSpeechBubble-tl"></div>
                <div class="fluidSpeechBubble-tr"></div>
                <div class="fluidSpeechBubble-tc"></div>
                <div class="fluidSpeechBubble-ml"></div>
                <div class="fluidSpeechBubble-mr"></div>
                <div class="fluidSpeechBubble-mc"></div>
                <div class="fluidSpeechBubble-bl"></div>
                <div class="fluidSpeechBubble-br"></div>
                <div class="fluidSpeechBubble-bc"></div>
                <div class="speechArrowBack"></div>
                <div class="fluidSpeechBubble-contents cf"><p>زمان باقی مانده برای خالی شدن انبار غذا و نیروهای به دلیل گرسنگی خواهند مرد: <span class="bold">1d 06:11:52</span></p></div>
            </div>
        </div>
    </div>
    */
    ?>
</div>