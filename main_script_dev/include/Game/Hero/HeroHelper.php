<?php

namespace Game\Hero;

use Core\Database\DB;
use Game\Formulas;

class HeroHelper extends HeroItems
{
    public function calcTotalPower($race, $points, $rightHand, $leftHand, $body)
    {
        return $this->calcPower($race, $points) + $this->calcItemPower($rightHand, $leftHand, $body);
    }

    public function calcPower($race, $points)
    {
        return 100 + $points * ($race == 1 ? 100 : 80);
    }

    public function calcItemPower($rightHand, $leftHand, $body)
    {
        $rightHand = $this->procInput($rightHand);
        $leftHand = $this->procInput($leftHand);
        $body = $this->procInput($body);
        $total = 0;
        if (is_array($rightHand) && (in_array($rightHand['type'], range(16, 60)) || in_array($rightHand['type'], range(115, 144)))) {
            $item = $this->getHeroItemProperties($rightHand['btype'], $rightHand['type']);
            $total += $item['hero_power'];
        }
        if (is_array($leftHand) && in_array($leftHand['type'], [76, 77, 78])) {
            $item = $this->getHeroItemProperties($leftHand['btype'], $leftHand['type']);
            $total += $item['hero_power'];
        }
        if (is_array($body) && $body['type'] >= 88 && $body['type'] <= 93) {
            $item = $this->getHeroItemProperties($body['btype'], $body['type']);
            $total += $item['hero_power'];
        }

        return $total;
    }

    public function procInput($id)
    {
        if (is_array($id)) {
            return $id;
        }
        if ($id == 0) {
            return 0;
        }
        $db = DB::getInstance();
        return (array)$db->query("SELECT * FROM items WHERE proc=1 AND id={$id}")->fetch_assoc();
    }

    //offBonus
    public function calcOffBonus($points)
    {
        return $points * 0.2;
    }

    //defBonus
    public function calcDefBonus($points)
    {
        return $points * 0.2;
    }
//health
    //health
    public function calcTotalHealth($helment, $body, $shoes)
    {
        return $this->calcHealth() + $this->calcItemHealth($helment, $body, $shoes);
    }

    public function calcHealth()
    {
        if(getGameSpeed() <= 10){
            return 10 + (5 * (getGameSpeed() - 1));
        }
        return 10 * min(ceil(getGameSpeed() / 250), 50);
    }

    public function calcItemHealth($helmet, $body, $shoes)
    {
        $helmet = $this->procInput($helmet);
        $body = $this->procInput($body);
        $shoes = $this->procInput($shoes);
        $total = 0;
        if (is_array($helmet) && in_array($helmet['type'], [4, 5, 6])) {
            $item = $this->getHeroItemProperties($helmet['btype'], $helmet['type']);
            $total += $item['reg'];
        }
        if (is_array($body) && in_array($body['type'], [82, 83, 84, 85, 86, 87])
        ) {
            $item = $this->getHeroItemProperties($body['btype'], $body['type']);
            $total += $item['reg'];
        }
        if (is_array($shoes) && in_array($shoes['type'], [94, 95, 96])) {
            $item = $this->getHeroItemProperties($shoes['btype'], $shoes['type']);
            $total += $item['reg'];
        }

        return $total;
    }

    public function calcResist($body)
    {
        $body = $this->procInput($body);
        if (is_array($body)
            && in_array($body['type'], [
                84, 85, 86, 87, 91, 92, 93,
            ])
        ) {
            $item = $this->getHeroItemProperties($body['btype'], $body['type']);
            if (isset($item['resist'])) {
                return $item['resist'];
            }
        }

        return 0;
    }

    public function getBandages($bag)
    {
        $bag = $this->procInput($bag);
        if (is_array($bag) && isset($bag['btype'])
            && in_array($bag['btype'], [
                7, 8,
            ])
        ) {
            $item = $this->getHeroItemProperties($bag['btype'], $bag['type']);

            return ["num" => $bag['num'], "eff" => $item['revive']];
        }

        return ["num" => 0, "eff" => 0];
    }

    public function calcRobPoints($leftHand)
    {
        $leftHand = $this->procInput($leftHand);
        if (is_array($leftHand) && in_array($leftHand['type'], [73, 74, 75])) {
            $item = $this->getHeroItemProperties($leftHand['btype'], $leftHand['type']);

            return $item['raid'];
        }

        return 0;
    }

    public function getCages($bag)
    {
        $bag = $this->procInput($bag);
        if (is_array($bag) && isset($bag['btype']) && $bag['btype'] == 9) {
            return $bag['num'];
        }
        return 0;
    }

    //speed
    public function calcTotalSpeed($race, $horse, $shoes, $cavalryOnly = false)
    {
        return $this->calcSpeed($race, $horse, $cavalryOnly) + $this->calcItemSpeed($horse, $shoes);
    }

    public function calcSpeed($race, $horse, $cavalryOnly = false)
    {
        $horse = $this->procInput($horse);
        $increase = 0;
        if ($race == 7 && $horse && $cavalryOnly) {
            $increase = 3;
        }
        $isCavalry = is_array($horse) && in_array($horse['type'], [103, 104, 105]);
        $base = Formulas::heroSpeed($race, $isCavalry);
        if ($isCavalry) {
            $item = $this->getHeroItemProperties($horse['btype'], $horse['type']);
            return $base + ($item['speed_horse'] + $increase);
        }
        return $base + $increase;
    }

    public function calcItemSpeed($horse, $shoes)
    {
        $horse = $this->procInput($horse);
        $shoes = $this->procInput($shoes);
        if (is_array($horse) && in_array($horse['type'], [103, 104, 105])) {
            if (is_array($shoes) && in_array($shoes['type'], [100, 101, 102])) {
                $item = $this->getHeroItemProperties($shoes['btype'], $shoes['type']);
                return $item['hero_cav_speed'];
            }
        }
        return 0;
    }

    //train speed
    public function calcTrainEffect($helmet)
    {
        $helmet = $this->procInput($helmet);
        $h = [0, 0];
        /** inf|cav */
        if (is_array($helmet) && in_array($helmet['type'], [13, 14, 15])) {
            $item = $this->getHeroItemProperties($helmet['btype'], $helmet['type']);
            $h[0] += $item['inf'];
        }
        if (is_array($helmet) && in_array($helmet['type'], [10, 11, 12])) {
            $item = $this->getHeroItemProperties($helmet['btype'], $helmet['type']);
            $h[1] += $item['cav'];
        }

        return $h;
    }

    //cp
    public function calcMoreCulturePoints($helmet)
    {
        $helmet = $this->procInput($helmet);
        if (is_array($helmet) && in_array($helmet['type'], [7, 8, 9])) {
            $item = $this->getHeroItemProperties($helmet['btype'], $helmet['type']);

            return $item['cp'];
        }

        return 0;
    }

    //exp
    public function calcMoreExp($helmet)
    {
        $helmet = $this->procInput($helmet);
        if (is_array($helmet) && in_array($helmet['type'], [1, 2, 3])) {
            $item = $this->getHeroItemProperties($helmet['btype'], $helmet['type']);

            return $item['exp'];
        }

        return 0;
    }
}