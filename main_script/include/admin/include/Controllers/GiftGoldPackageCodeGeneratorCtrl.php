<?php
require("GoldPackageCodeGeneratorCtrl.php");

class GiftGoldPackageCodeGeneratorCtrl extends GoldPackageCodeGeneratorCtrl
{
    public function __construct()
    {
        parent::__construct(true);
    }
}