<tr>
    <td class="sub">
        <div class="reportIcon <?=$vars['reportIcon'];?>"></div>
        <div class="reportText"><?=$vars['reportText'];?></div>
    </td>
    <td class="coords"><a class="" href="karte.php?x=<?=$vars['x'];?>&amp;y=<?=$vars['y'];?>">‎&#x202d;<span class="coordinates coordinatesWrapper coordinatesAligned coordinates<?=strtolower(getDirection());?>"><span class="coordinateX">(<?=$vars['x'];?></span><span class="coordinatePipe">|</span><span class="coordinateY"><?=$vars['y'];?>)</span></span>‎</a></td>
    <td class="dist"><?=$vars['distance'];?></td>
    <td class="dat"><?=$vars['date'];?></td>
</tr>