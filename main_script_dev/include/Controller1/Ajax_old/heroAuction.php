<?php

namespace Controller\Ajax;

use function array_unshift;
use Core\Config;
use function getGameSpeed;

class heroAuction extends AjaxBase
{
    public static function getPackagesFakeAuctionForItemTypeId($itemTypeId)
    {
        $multiply = true;
        $no_multi = self::getNotMultiply();
        $arr = self::getPackagesForItemTypeId($itemTypeId, false);
        if ($itemTypeId == 114 /** Cage */ || $itemTypeId == 107/** Artifact */) {
            if (getGameSpeed() <= 100) {
                $arr = [5, 10, 30];
            } else {
                $arr = [2, 10, 25, 50, 100, 250, 500];
            }
        } else if ($itemTypeId == 106) {
            /** پماد */
            $arr = [5, 10, 30, 50, 100];
            $multiply = false;
        } else if ($itemTypeId == 109) {
            /** Law tablet */
            $arr = [5, 10, 30];
            $multiply = false;
        } else if ($itemTypeId == 111) { //artwork
            if (getGameSpeed() <= 10) {
                $arr = [1];
            } else if (getGameSpeed() <= 100) {
                $arr = [1, 5, 10, 30];
            } else {
                $arr = [1, 5, 10, 30, 50, 100];
            }
            $multiply = false;
        } else if ($itemTypeId == 112 || $itemTypeId == 113) { //bandage
            if (getGameSpeed() <= 100) {
                $arr = [5, 10, 25, 50];
            } else {
                $arr = [5, 10, 25, 50, 100, 250, 500, 1000, 5000];
            }
        }
        if ($multiply && !in_array($itemTypeId, $no_multi)) {
            $arr = self::multiplyPackagesCallback($arr);
        }
        return $arr;
    }

    private static function getNotMultiply()
    {
        return [109, 106, 111];
    }

    public static function getPackagesForItemTypeId($itemTypeId, $multiply = true)
    {
        $no_multi = self::getNotMultiply();
        $arr = [1];
        if (in_array($itemTypeId, [106, 107, 109, 111, 112, 113, 114])) {
            $arr = [5, 10, 30, 50];
            if ($itemTypeId == 112 || $itemTypeId == 113) {
                $arr = [2, 10, 25, 50, 100, 250];
            }
            if ($itemTypeId == 111) {
                array_unshift($arr, 1);
                if (getGameSpeed() <= 10) {
                    $arr = [1]; //official only allows 1 by 1
                }
            }
        }
        if ($multiply && !in_array($itemTypeId, $no_multi)) {
            $arr = self::multiplyPackagesCallback($arr);
        }
        return $arr;
    }

    public static function multiplyPackagesCallback($x)
    {
        if (is_array($x)) {
            return array_map(function ($x) {
                return self::multiplyPackagesCallback($x);
            }, $x);
        }
        if ($x == 1) return $x;
        $x *= Config::getProperty("game", "auction_package_multiplier");
        if ($x % 2 != 0) {
            $x = round5($x);
        }
        return $x;
    }

    public function dispatch()
    {
        $itemTypeId = (int)$_POST['itemTypeId'];
        $this->response['data'] = [1];
        if (in_array($itemTypeId, [106, 107, 109, 111, 112, 113, 114])) {
            $this->response['data'] = self::getPackagesForItemTypeId($itemTypeId);
        }
    }
}