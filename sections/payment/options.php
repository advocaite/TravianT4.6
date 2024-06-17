<?php require("include/bootstrap.php");?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo T("Main", "Travian Games Payment Methods");?></title>
    <link rel="stylesheet" href="/bundles/tgppaymentshop/css/bootstrap.min.css?v=2" type="text/css" charset="utf-8">
    <link rel="stylesheet" href="/bundles/tgppaymentshop/css/thumbnail.css?v=2" type="text/css" charset="utf-8">
    <link rel="stylesheet" href="/bundles/tgppaymentshop/css/info.css?v=2" type="text/css" charset="utf-8">
</head>
<body>
<div class='center-block row'>
    <div class='col-md-8 col-md-offset-2'>
        <header class='row payments'>
            <div class="col-sm-4 col-md-3">
                <img src='/bundles/tgppaymentshop/images/travian-payment-big.png'/>
            </div>
        </header>
        <hr class='row'>
        <div class="alert alert-danger">
            <?php echo T("Main", "No Payment Methods Found");?>...
        </div>
        <div class="row">
            <hr>
        </div>
    </div>
</div>
</body>
</html>