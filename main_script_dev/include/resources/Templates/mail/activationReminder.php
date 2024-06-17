<?php use Core\Config; ?>
<div style="font-size:16px;line-height:25px;font-family:Helvetica, sans-serif;color:#666666;direction:<?=getDirection();?>;text-align: <?=(getDirection() == 'LTR' ? 'left' : 'right');?>" class="padding-copy">
    <?=T("Mail", "Hello");?> <b><?=$vars['name'];?></b>,
    <br/>
    <b><?=sprintf(T("Mail", "Thank you for registering on %s"), Config::getProperty("settings", "worldId"));?></b>
    <br><br> <?=T("Mail", "_TO_ACTIVATE_YOUR_ACCOUNT_PLEASE_");?>
    <br /><br />
    <table align="center" border="0" style="background-image:url('<?=get_gpack_cdn_base_url_with_protocol();?>pics/button_yellow_withouttext1.PNG');background-repeat:no-repeat;background-position:center;" cellspacing="0" cellpadding="0">
        <tbody>
        <tr>
            <td align="center" style="padding:20px;" class="mobile-button-container">
                <table border="0" cellspacing="0" cellpadding="0" class="mobile-button-container">
                    <tbody>
                    <tr>
                        <td align="center">
                            <div>
                                <a href="<?=Config::getProperty("settings", "indexUrl");?>?worldId=<?=Config::getProperty("settings", "worldUniqueId");?>&id=<?=get_random_string(11);?>&activationCode=<?=$vars['activationCode'];?>&server=<?=Config::getProperty("settings", "worldId");?>#register" style="font-size:20px;font-family:Helvetica, sans-serif;color:#492208;text-decoration:none;padding:10px;border:0px;" class="mobile-button" target="_blank"><b><?=T("Mail", "Activate");?></b></a></div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
    <br/>
    <div style="font-family:Helvetica;font-size:18px;">
        <?=T("Mail", "Game world Url");?>: <a href="<?=Config::getProperty("settings", "gameWorldUrl");?>" style="color:#f88c1f;" target="_blank"><?=Config::getProperty("settings", "gameWorldUrl");?></a>
    </div>
    <br/>
    <table border="0" cellpadding="0" cellspacing="0" width="650" class="responsive-table">
        <tbody>
        <tr>
            <td align="center"><img src="<?=get_gpack_cdn_base_url_with_protocol();?>pics/separation_line.png" class="img-max" alt="separation_line.png"></td>
        </tr>
        <tr>
            <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tbody>
                    <tr>
                        <td class="padding" style="padding:30px;font-size:16px;line-height:25px;font-family:Helvetica, Arial, sans-serif;color:#666666;">
                            <?=T("Mail", "Enjoy the game and fight many glorious battles");?>.
                            <br/>
                            <?=T("Mail", "Your Travian Team");?>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
</div>