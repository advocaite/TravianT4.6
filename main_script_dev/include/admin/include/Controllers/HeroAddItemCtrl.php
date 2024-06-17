<?php

use Core\Database\DB;
use Core\Helper\WebService;
use Model\AuctionModel;

class HeroAddItemCtrl
{
    public function __construct()
    {
        if(!getCustom('allowInterruptionInGame')){
            $dispatcher = Dispatcher::getInstance();
            $dispatcher->appendContent("<hr><p class='error center'>Disabled by admin.</p><hr>");
            return;
        }
        $params = [
            'delete'    => isset($_REQUEST['delete']) ? $_REQUEST['delete'] == 1 : false,
            'uid'       => isset($_REQUEST['uid']) ? (int)$_REQUEST['uid'] : null,
            'item'      => isset($_REQUEST['item']) ? $_REQUEST['item'] : null,
            'amount'    => isset($_REQUEST['amount']) ? abs((int)$_REQUEST['amount']) : 1,
            'result'    => false,
            'items_arr' => [
                1  => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15],
                2  => [82, 83, 84, 85, 86, 87, 88, 89, 90, 91, 92, 93],
                3  => [
                    61,
                    62,
                    63,
                    64,
                    65,
                    66,
                    67,
                    68,
                    69,
                    73,
                    74,
                    75,
                    76,
                    77,
                    78,
                    79,
                    80,
                    81,
                ],
                4  => [
                    16,
                    17,
                    18,
                    19,
                    20,
                    21,
                    22,
                    23,
                    24,
                    25,
                    26,
                    27,
                    28,
                    29,
                    30,
                    31,
                    32,
                    33,
                    34,
                    35,
                    36,
                    37,
                    38,
                    39,
                    40,
                    41,
                    42,
                    43,
                    44,
                    45,
                    46,
                    47,
                    48,
                    49,
                    50,
                    51,
                    52,
                    53,
                    54,
                    55,
                    56,
                    57,
                    58,
                    59,
                    60,
                    115,
                    116,
                    117,
                    118,
                    119,
                    120,
                    121,
                    122,
                    123,
                    124,
                    125,
                    126,
                    127,
                    128,
                    129,
                    130,
                    131,
                    132,
                    133,
                    134,
                    135,
                    136,
                    137,
                    138,
                    139,
                    140,
                    141,
                    142,
                    143,
                    144,
                ],
                5  => [94, 95, 96, 97, 98, 99, 100, 101, 102],
                6  => [103, 104, 105],
                7  => [112],
                8  => [113],
                9  => [114],
                10 => [107],
                11 => [106],
                12 => [108],
                13 => [110],
                14 => [109],
                15 => [111],
            ]
        ];
        if (!isServerFinished() && WebService::isPost()) {
            list($btype, $type) = explode(":", $params['item']);
            if (!($btype >= 7 && $btype != 12 && $btype != 13)) {
                $params['amount'] = 1;
            }
            $db = DB::getInstance();
            $userExists = $db->fetchScalar("SELECT COUNT(id) FROM users WHERE id={$params['uid']}") > 0;
            if ($userExists) {
                if ($params['amount'] <= 0) {
                    $params['result'] = 'Invalid item amount';
                } else {
                    if (in_array($type, $params['items_arr'][$btype])) {
                        $m = new AuctionModel();
                        if($params['delete']){
                            $m->removeItemFromUser($params['uid'], $btype, $type, $params['amount']);
                            $params['result'] = 'Item was removed from user.';
                        } else {
                            $m->addItemToUser($params['uid'], $btype, $type, $params['amount']);
                            $params['result'] = 'Item was added to user.';
                        }
                    } else {
                        $params['result'] = 'Invalid item chosen.';
                    }
                }
            } else {
                $params['result'] = 'User does not exists.';
            }
        }
        Dispatcher::getInstance()->appendContent(Template::getInstance()->load($params,
            'tpl/heroAddItem.tpl')->getAsString());
    }
}