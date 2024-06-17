<?php if($viewSwitcher == 'onLoadProvider'):?>
    <!DOCTYPE html>
    <html class="onloader">
    <head>
        <title><?php echo sprintf(T("Main", "Loading [provider]"), $vars['providerName']);?>... </title>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta http-equiv="imagetoolbar" content="no">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style type="text/css">html,body{margin:0;padding:0;background-color:#e9e9e9;font-size:14px;font-family:Verdana,Arial,Helvetica,sans-serif;color:#333;direction:<?php echo T("Main", "Direction");?>}.small{font-size:12px;font-weight:normal}a{text-decoration:none}a:link{color:#7da519}a:visited{color:#7da519}a:hover{color:#557d1e}a:active{color:#557d1e}table.containertable{margin:35px auto 0 auto;text-align:center}td.container,div.messagebox{background-color:#fff;border:2px solid #d6d6d6}td.container{padding:4px;text-align:center}#buttonSealDiv{padding:4px;text-align:center}table.messagetable{text-align:<?php echo T("Main", "Direction") != 'RTL' ? 'left' : 'right';?>}td.subtitle{text-align:center;padding-bottom:4px;font-size:14px;font-weight:bold;border-bottom:2px solid #d6d6d6}td.logo{padding-top:5px;width:130px;vertical-align:top}td.message{width:470px;padding:6px 6px 6px 12px;vertical-align:middle;text-align:<?php echo T("Main", "Direction") != 'RTL' ? 'left' : 'right';?>}td.closewindow{padding:2px;text-align:right;font-size:12px;font-weight:bold}div.messagebox{position:relative;margin:75px auto 75px auto;padding:20px;width:300px;text-align:center;font-size:16px;font-weight:bold;white-space:nowrap}div.messageboxButton{margin:25px auto 5px auto;padding:20px 20px 10px 20px}div.buttonTop{position:relative;border-radius:5px 5px 0 0;background-color:#ccc;padding:2px;width:100%}div.buttonBottom{font-weight:normal;border-radius:0 0 5px 5px;background-color:#eaeaea;margin:0 0 20px 0}.button{color:#FFF;width:100%;border:1px solid #36780f;-webkit-border-radius:5px;-moz-border-radius:5px;border-radius:5px;font-family:arial,helvetica,sans-serif;padding:5px;text-shadow:-1px -1px 0 rgba(0,0,0,0.3);font-weight:bold;text-align:center;color:#fff;background-color:#62ae2a;background-image:-webkit-gradient(linear,left top,left bottom,color-stop(0%,#62ae2a),color-stop(100%,#a5da6e));background-image:-webkit-linear-gradient(top,#a5da6e,#62ae2a);background-image:-moz-linear-gradient(top,#a5da6e,#62ae2a);background-image:-ms-linear-gradient(top,#a5da6e,#62ae2a);background-image:-o-linear-gradient(top,#a5da6e,#62ae2a);background-image:linear-gradient(top,#a5da6e,#62ae2a);filter:progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr=#62AE2A,endColorstr=#A5DA6E)}span.defect_message{color:#C00}.units{font-size:smaller}</style>
    </head>
    <body onload="setTimeout(function(){loadProvider('<?php echo $vars['order'];?>')}, 1000);">
    <noscript><?php echo T("Main", "Please enable JavaScript in your Browser to continue");?>.</noscript>
    <div class="messagebox messageboxButton">
        <img src="<?php echo \Core\WebService::get_real_base_url();?>process/img/games/travian4.jpg" alt="travian4">

        <div class="buttonTop"><?php echo T("Main", "Your choosen product");?>:</div>
        <div class="buttonTop buttonBottom">
            <?php echo $vars['goldNum'];?> <?php echo T("Main", "Gold");?><br/>
            <span class="units">(<?php echo $vars['productName'];?>)</span>
        </div>
        <div class="buttonTop"><?php echo T("Main", "Your choosen provider");?>:<br/></div>
        <div class="buttonTop buttonBottom">
            <img src="<?php echo \Core\WebService::get_real_base_url();?>process/img/providers/default/<?php echo $vars['providerImage'];?>" alt="<?php echo $vars['providerName'];?>">
        </div>
        <div class="buttonTop"><?php echo T("Main", "To pay");?>:</div>
        <div class="buttonTop buttonBottom">
            <span class="bold"><?php echo $vars['priceAndMoneyUnit'];?><br/></span>
            <span class="small">(<?php echo T("Main", "final consumer price");?>)</span>
        </div>
        <form action="index.php">
            <button class="buttonBottom button" type="submit"> <?php echo T("Main", "Buy");?> </button>
            <input type="hidden" name="METHOD" value="preLoadProvider"/>
            <input type="hidden" name="ORDER" value="<?php echo $vars['order'];?>"/>
        </form>
    </div>
    <div id="container"></div>
    </body>
    </html>
<?php elseif($viewSwitcher == 'errorMessage'):?>
    <!DOCTYPE html>
<html class="message">
<head>
    <title><?php echo sprintf(T("Main", "TG Payment GmbH - [title]"), $vars['title']);?> </title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo \Core\WebService::get_real_base_url();?>process/img/icons/traviangames.ico" type="image/x-ico; charset=binary" />
    <link rel="icon" href="<?php echo \Core\WebService::get_real_base_url();?>process/img/icons/traviangames.ico" type="image/x-ico; charset=binary" />
    <style type="text/css">html,body{margin:0;padding:0;background-color:#e9e9e9;font-size:14px;font-family:Verdana,Arial,Helvetica,sans-serif;color:#333;direction:<?php echo T("Main", "Direction");?>}.small{font-size:12px;font-weight:normal}a{text-decoration:none}a:link{color:#7da519}a:visited{color:#7da519}a:hover{color:#557d1e}a:active{color:#557d1e}table.containertable{margin:35px auto 0 auto;text-align:center}td.container,div.messagebox{background-color:#fff;border:2px solid #d6d6d6}td.container{padding:4px;text-align:center}#buttonSealDiv{padding:4px;text-align:center}table.messagetable{text-align:<?php echo T("Main", "Direction") != 'RTL' ? 'left' : 'right';?>}td.subtitle{text-align:center;padding-bottom:4px;font-size:14px;font-weight:bold;border-bottom:2px solid #d6d6d6}td.logo{padding-top:5px;width:130px;vertical-align:top}td.message{width:430px;padding:6px 6px 6px 12px;vertical-align:middle;text-align:<?php echo T("Main", "Direction") != 'RTL' ? 'left' : 'right';?>}td.closewindow{padding:2px;text-align:<?php echo T("Main", "Direction") == 'RTL' ? 'left' : 'right';?>;font-size:12px;font-weight:bold}div.messagebox{position:relative;margin:75px auto 75px auto;padding:20px;width:300px;text-align:center;font-size:16px;font-weight:bold;white-space:nowrap}div.messageboxButton{margin:25px auto 5px auto;padding:20px 20px 10px 20px}div.buttonTop{position:relative;border-radius:5px 5px 0 0;background-color:#ccc;padding:2px;width:100%}div.buttonBottom{font-weight:normal;border-radius:0 0 5px 5px;background-color:#eaeaea;margin:0 0 20px 0}.button{color:#FFF;width:100%;border:1px solid #36780f;-webkit-border-radius:5px;-moz-border-radius:5px;border-radius:5px;font-family:arial,helvetica,sans-serif;padding:5px;text-shadow:-1px -1px 0 rgba(0,0,0,0.3);font-weight:bold;text-align:center;color:#fff;background-color:#62ae2a;background-image:-webkit-gradient(linear,left top,left bottom,color-stop(0%,#62ae2a),color-stop(100%,#a5da6e));background-image:-webkit-linear-gradient(top,#a5da6e,#62ae2a);background-image:-moz-linear-gradient(top,#a5da6e,#62ae2a);background-image:-ms-linear-gradient(top,#a5da6e,#62ae2a);background-image:-o-linear-gradient(top,#a5da6e,#62ae2a);background-image:linear-gradient(top,#a5da6e,#62ae2a);filter:progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr=#62AE2A,endColorstr=#A5DA6E)}span.defect_message{color:#C00}.units{font-size:smaller}</style>
</head>
<body ><table class="containertable">
    <tr>
        <td class="container">
            <table class="messagetable">
                <tr>
                    <td colspan="2" class="subtitle"><?php echo $vars['title'];?></td>
                </tr>
                <tr>
                    <td class="logo"><a href="<?php echo \Core\WebService::get_real_base_url();?>" target="_blank"><img src="<?php echo \Core\WebService::get_real_base_url();?>process/img/payment_themes/default/logo-small.jpg" width="119" height="46" alt="" border="0"/><br/><br/></a></td>
                    <td class="message"><?php echo $vars['message'];?><br /><br /></td>
                </tr>
                <tr>
                    <td colspan="2" class="closewindow">
                        <a href="#" onclick="window.close()" title="<?php echo T("Main", "Close Window");?>"><?php echo T("Main", "Close Window");?></a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
<?php elseif($viewSwitcher == 'preLoadProvider'):?>
    <!DOCTYPE html>
<html class="onloader">
<head>
    <title><?php echo sprintf(T("Main", "Loading [ProviderName]"), $vars['providerName']);?>... </title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta http-equiv="imagetoolbar" content="no">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script type="text/javascript">
        <!--
        function createRequestObject() {
            var ro;
            var browser = navigator.appName;
            if (browser == 'Microsoft Internet Explorer') {
                ro = new ActiveXObject('Microsoft.XMLHTTP');
            } else {
                ro = new XMLHttpRequest();
            }
            return ro;
        }
        var http = createRequestObject();

        function loadProvider(order) {
            window.location = 'index.php?METHOD=loadProvider&ORDER=' + order;
        }

        function loadProviderHtml(order) {
            http.open('get', 'index.php?METHOD=loadProviderHtml&ORDER=' + order);
            http.onreadystatechange = handleLoadProviderHtmlResponse;
            http.send(null);
        }

        function handleLoadProviderHtmlResponse() {
            if (http.readyState == 4) {
                if (http.status == 200) {
                    var response = http.responseText;
                    var target = document.getElementById('container');
                    target.innerHTML = response;
                    document.getElementById("paymentSubmit").submit();
                } else {
                    // TODO: ADD REDIRECT TO STANDARD ERROR PAGE
                    var target = document.getElementById('container');
                    target.innerHTML = 'Error: unable to load payment provider. ('+ http.statusText +')';
                }
            }
        }
        //-->
    </script>
    <style type="text/css">html,body{margin:0;padding:0;background-color:#e9e9e9;font-size:14px;font-family:Verdana,Arial,Helvetica,sans-serif;color:#333;direction:<?php echo T("Main", "Direction");?>}.small{font-size:12px;font-weight:normal}a{text-decoration:none}a:link{color:#7da519}a:visited{color:#7da519}a:hover{color:#557d1e}a:active{color:#557d1e}table.containertable{margin:35px auto 0 auto;text-align:center}td.container,div.messagebox{background-color:#fff;border:2px solid #d6d6d6}td.container{padding:4px;text-align:center}#buttonSealDiv{padding:4px;text-align:center}table.messagetable{text-align:<?php echo T("Main", "Direction") == 'RTL' ? 'right' : 'left';?>}td.subtitle{text-align:center;padding-bottom:4px;font-size:14px;font-weight:bold;border-bottom:2px solid #d6d6d6}td.logo{padding-top:5px;width:130px;vertical-align:top}td.message{width:470px;padding:6px 6px 6px 12px;vertical-align:middle;text-align:<?php echo T("Main", "Direction") == 'RTL' ? 'right' : 'left';?>}td.closewindow{padding:2px;text-align:right;font-size:12px;font-weight:bold}div.messagebox{position:relative;margin:75px auto 75px auto;padding:20px;width:300px;text-align:center;font-size:16px;font-weight:bold;white-space:nowrap}div.messageboxButton{margin:25px auto 5px auto;padding:20px 20px 10px 20px}div.buttonTop{position:relative;border-radius:5px 5px 0 0;background-color:#ccc;padding:2px;width:100%}div.buttonBottom{font-weight:normal;border-radius:0 0 5px 5px;background-color:#eaeaea;margin:0 0 20px 0}.button{color:#FFF;width:100%;border:1px solid #36780f;-webkit-border-radius:5px;-moz-border-radius:5px;border-radius:5px;font-family:arial,helvetica,sans-serif;padding:5px;text-shadow:-1px -1px 0 rgba(0,0,0,0.3);font-weight:bold;text-align:center;color:#fff;background-color:#62ae2a;background-image:-webkit-gradient(linear,left top,left bottom,color-stop(0%,#62ae2a),color-stop(100%,#a5da6e));background-image:-webkit-linear-gradient(top,#a5da6e,#62ae2a);background-image:-moz-linear-gradient(top,#a5da6e,#62ae2a);background-image:-ms-linear-gradient(top,#a5da6e,#62ae2a);background-image:-o-linear-gradient(top,#a5da6e,#62ae2a);background-image:linear-gradient(top,#a5da6e,#62ae2a);filter:progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr=#62AE2A,endColorstr=#A5DA6E)}span.defect_message{color:#C00}.units{font-size:smaller}</style>
</head>
<?php if($vars['isHTML']):?>
    <body onload="loadProviderHtml('<?php echo $vars['order'];?>')">
<?php else:?>
    <body onload="setTimeout(function(){loadProvider('<?php echo $vars['order'];?>')}, 1000);">
<?php endif;?>
<noscript><?php echo T("Main", "Please enable JavaScript in your Browser to continue");?>.</noscript>
<div class="messagebox">
    <img src="<?php echo \Core\WebService::get_real_base_url();?>process/img/payment_themes/default/logo-big.png" width="190" height="96" alt=""><br><br>
    <img src="<?php echo \Core\WebService::get_real_base_url();?>process/img/payment_themes/default/loading.gif" width="48" height="48" alt="loading"><br><br>
    <?php echo sprintf(T("Main", "Loading [ProviderName]"), $vars['providerName']);?>...</div>
<div id="container"></div>
</body>
</html>
<?php elseif($viewSwitcher == 'voucher'):?>
    <form method="post" name="tgp_redeem_voucher" id="tgp_redeem_voucher" action="index.php">
        <input type="hidden" name="METHOD" value="brokerPayment">
        <input type="hidden" name="ORDER" value="<?php echo $vars['order'];?>">
        <p><?php echo T("Main", 'To redeem a voucher, please enter the voucher code in this field and click on the "Redeem" button The voucher will be credited to your account immediately');?></p>
        <?php if(isset($vars['error']) && !empty($vars['error'])) echo '<p style="font-weight:bold; color:red;">'.$vars['error'].'</p>';?>
        <?php if(isset($vars['success']) && !empty($vars['success'])) echo '<p style="font-weight:bold; color:green;">'.$vars['success'].'</p>';?>
        <?php if(!isset($vars['success']) || empty($vars['success'])):?>
            <table>
                <tbody><tr>
                    <td><input type="text" size="40" name="voucher_code" value=""></td>
                    <td><input type="submit" id="redeem_submit" name="redeem_submit" value="<?php echo T("Main", "Redeem");?>" onclick=" window.setTimeout(function() {document.getElementById('redeem_submit').disabled=true;}, 1);"></td>
                </tr>
                </tbody></table>
        <?php endif;?>
        <br>
        <?php echo T("Main", "For more information about vouchers and the official Voucher Resellers please click here");?>: <a href="http://www.traviangames.com/voucher/" target="_blank" class="btn btn-info btn-xs"><?php echo T("Main", "More Info");?></a><br>
    </form>
<?php endif;?>