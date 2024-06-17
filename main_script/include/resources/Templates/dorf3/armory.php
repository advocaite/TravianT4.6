<table cellpadding="1" cellspacing="1" class="under_progress">
    <thead>
    <tr>
        <th rowspan="2"><?php
            use Core\Session;

            echo T("villageOverview", "Village"); ?></th>
        <th rowspan="2"><?=T("villageOverview", "inResearch"); ?></th>
        <th colspan="8"><?=T("villageOverview", "research_level"); ?></th>
    </tr>
    <tr>
        <?php
        for($i = 1; $i <= 8; ++$i){
            $unitId = nrToUnitId($i, Session::getInstance()->getRace());
            $title = T("Troops", "$unitId.title");
            echo '<th><img class="unit u'.$unitId.'" src="img/x.gif" title="'.$title.'" alt="'.$title.'"/></th>';
        }
        ?>
    </tr>
    </thead>
    <tbody>
        <?php
        foreach($vars['villages'] as $vill){
            if($vill['kid'] == $vars['curKid']){
                echo '<tr class="hl">';
            } else {
                echo '<tr>';
            }
            echo '<td><a href="build.php?newdid='.$vill['kid'].'&gid=13">'.$vill['name'].'</a></td>';
            echo '<td><a href="build.php?newdid='.$vill['kid'].'&gid=13">';
            $researchInProgressStmt = $vill['research_inProgress'];
            if(!$researchInProgressStmt->num_rows){
                echo '<span title="'.T("villageOverview", "Armory").'" class="dot">•</span>';
            } else {
                $tmp = [];
                while($row = $researchInProgressStmt->fetch_assoc()){
                    if(!isset($tmp[$row['nr']]))
                        $tmp[$row['nr']] = 0;

                    ++$tmp[$row['nr']];

                    $unitId = nrToUnitId($row['nr'], Session::getInstance()->getRace());
                    $title = T("Troops", "$unitId.title");
                    echo '<img class="unit u'.$unitId.'" src="img/x.gif" alt="'.$title.'" title="'.$title.' '.T("Buildings", "level").' '.(1+$vill['research_level']['u' . $row['nr']]+$tmp[$row['nr']]).'">';
                }
            }
            echo '</a>';
            for($i = 1; $i <= 8; ++$i){
                $researchLevel = $vill['research_level']['u' . $i];
                if($researchLevel){
                    echo '<td>'.$researchLevel.'</td>';
                } else {
                    echo '<td class="none">'.$researchLevel.'</td>';
                }
            }
            echo '</td></tr>';
        }
        ?>
    </tbody>
</table>