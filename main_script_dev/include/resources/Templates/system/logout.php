<h4><?php

    use Core\Database\GlobalDB;
    function addInformation(){
        $config = \Core\Config::getInstance();
        if(empty($config->dynamic->loginInfoTitle) || empty($config->dynamic->loginInfoHTML)){
            return null;
        }
        return '<br /><div class="roundedCornersBox big">
            <h4><div class="statusMessage">'.$config->dynamic->loginInfoTitle.'</div></h4>
            <div id="contractSpacer"></div>
            <div id="contract" class="contractWrapper">
                <div class="contractLink">
                    <div>'.$config->dynamic->loginInfoHTML.'</div>
                    
                    <br />
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>';
    }
    echo T("Logout", "thanks_for_your_visit");?></h4>
<p>
	<?=T("Logout", "cookieDesc");?>:</p>
<p>
	<a class="arrow" href="login.php?del_cookie"><?=T("Logout", "delete_cookies");?></a>
</p>
<div class="greenbox cf relogin">
	<div class="greenbox-top"></div>
	<div class="greenbox-content">
		<h5><?=T("Logout", "back_to_the_game");?></h5>

		<form name="login" method="post" action="dorf1.php">
			<table class="transparent reloginTable">
				<tr class="account">
					<th class="accountName">
						<?=T("Login", "accountNameOrEmailAddress");?> :
					</th>
					<td>
						<input type="text" name="name" value="<?=$vars['username'];?>" class="text"/><br/>
					</td>
				</tr>
				<tr class="pass">
					<th>
						<?=T("Login", "pass");?>                    </th>
					<td>
						<input type="password" maxlength="20" name="password" value="" class="text"/><br/>
					</td>
				</tr>
			</table>
			<div class="submitButton">
				<button type="submit" value="<?=T("Login", "Login");?>" name="s1" id="reloginButton" class="green "
				        onclick="document.login.w.value=screen.width+':'+screen.height;">
					<div class="button-container addHoverClick ">
						<div class="button-background">
							<div class="buttonStart">
								<div class="buttonEnd">
									<div class="buttonMiddle"></div>
								</div>
							</div>
						</div>
						<div class="button-content"><?=T("Login", "Login");?></div>
					</div>
				</button>
			</div>
			<input type="hidden" name="w" value=""/>
			<input type="hidden" name="login" value="<?=$vars['time'];?>"/>
			<?php if($vars['lowRes']):?>
				<input type="hidden" name="lowRes" value="<?=$vars['lowRes'];?>"/>
			<?php endif;?>
		</form>
	</div>
	<div class="greenbox-bottom"></div>
</div>
<?=addInformation();?>
	<?php
	$db = GlobalDB::getInstance();
	$result = $db->query("SELECT * FROM bannerShop WHERE expire >=" . time());
	if($result->num_rows){
	    echo '<div class="bannerShop">';
    }
	while($row = $result->fetch_assoc()){
		echo $row['content'];
	}
    if($result->num_rows){
        echo '</div>';
    }
	?>
<!--
<div class="bannerMoreGames">
    <h5>More games</h5>
    <div class="moreGames">
        <div class="game game0 game-image">	<a href="http://games.traviangames.com/105111111191000/22" class="enumerableElementsImageLink" target="_blank" title="Rail Nation">
                <img id="railnation_game_image" src="http://img.travian.com/moreGames/v2/Railnation.jpg" class="enumerableElementsImage railnation_game_image" style="" alt="Rail Nation" />
                <img id="railnation_game_imageHover" src="http://img.travian.com/moreGames/v2/Railnation-hover.jpg" class="hide enumerableElementsImage railnation_game_image hover" style="" alt="Rail Nation" />	</a>
        </div><div class="game game1 game-image">	<a href="http://games.traviangames.com/107811111191000/12" class="enumerableElementsImageLink" target="_blank" title="Goalunited">
                <img id="goalunited_game_image" src="http://img.travian.com/moreGames/v2/Goalunited.gif" class="enumerableElementsImage goalunited_game_image" style="" alt="Goalunited" />
                <img id="goalunited_game_imageHover" src="http://img.travian.com/moreGames/v2/Goalunited-hover.gif" class="hide enumerableElementsImage goalunited_game_image hover" style="" alt="Goalunited" />	</a>
        </div><div class="game game2 game-image">	<a href="http://games.traviangames.com/107811111191000/28" class="enumerableElementsImageLink" target="_blank" title="Epic Arena">
                <img id="epicArena_game_image" src="http://img.travian.com/moreGames/v2/EpicArena.png" class="enumerableElementsImage epicArena_game_image" style="" alt="Epic Arena" />
                <img id="epicArena_game_imageHover" src="http://img.travian.com/moreGames/v2/EpicArena-hover.png" class="hide enumerableElementsImage epicArena_game_image hover" style="" alt="Epic Arena" />	</a>
        </div>
        <script type="text/javascript">

            jQuery(function()
            {
                new Travian.Game.MoreGames(
                        {
                            countOfGamesToShow: 3
                        });
            });
        </script>	</div>
</div>

<div id="div-gpt-ad-1319642673733-0" class="bannerAdvertising">
    <h5>Advertisement</h5>
    <script type="text/javascript">
        jQuery(function()
        {
            window.googletag = window.googletag || {};
            googletag.cmd = googletag.cmd || [];
            Travian.insertScript('http://www.googletagservices.com/tag/js/gpt.js');
            googletag.cmd.push(function()
            {
                googletag.defineSlot('/4668275/Rectangle', [300, 250], 'div-gpt-ad-1319642673733-0').addService(googletag.pubads());
                googletag.enableServices();
            });
            googletag.cmd.push(function()
            {
                googletag.display('div-gpt-ad-1319642673733-0');
            });
        });
    </script>
</div>
<div class="bannerShop">
    <a href="https://www.facebook.com/traviannews" target="_blank">
        <img src="img/x.gif" alt="Travian Facebook" />
    </a>
</div>
--->