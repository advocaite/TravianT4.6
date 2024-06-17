<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<?php use Core\Helper\WebService;

    function domain(){
		return 'http://' . WebService::getRealDomain() . '/';
	}
	?>
	<title>Travian installation</title>
	<link rel=stylesheet type="text/css" href="<?=domain();?>m_un.css">
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="content-language" content="ir" />
</head>
<body>
<div class="div1" align="right"></div>
<img src="/img/x.gif" width="1" height="90" border="0" alt="l">
<table cellspacing="0" cellpadding="0">
	<tbody>
	<tr valign="top">
		<td width="130"></td>
		<td class="s1"><img src="/img/x.gif" width="1" height="10" border="0"></td>
		<td class="s2">
			<center><span style="color: red; font-weight: bold;"><?=@$vars['error'];?></span></center>
			<span style="color: green; font-weight: bold;">After this installation you need to continue installation from command line.</span>
			<form method="post" name="snd" action="index.php?action=install">
				<br>
				<div class="p1">
					<table width="100%" cellspacing="1" cellpadding="0">
						<tbody>
						<tr>
							<td>
								<label>Database Settings:</label>
								<br />
							</td>
						</tr>
						<tr>
							<td>
								<label>Hostname:</label>
								<input class="fm fm110" type="text" name="db_host" value="<?=$vars['db_host'];?>">
								<span class="e f7"></span>
							</td>
						</tr>
						<tr>
							<td>
								<label>Username:</label>
								<input class="fm fm110" type="text" name="db_user" value="<?=$vars['db_user'];?>">
								<span class="e f7"></span>
							</td>
						</tr>
						<tr>
							<td>
								<label>Password:</label>
								<input class="fm fm110" type="password" name="db_pass" value="<?=$vars['db_pass'];?>">
								<span class="e f7"></span>
							</td>
						</tr>
						<tr>
							<td>
								<label>Database:</label>
								<input class="fm fm110" type="text" name="db_db" value="<?=$vars['db_db'];?>">
								<span class="e f7"></span>
							</td>
						</tr>
						<tr>
							<td>
								<hr />
								<label>Settings:</label>
								<br />
							</td>
						</tr>
						<tr>
							<td>
								<label>Server name(index):</label>
								<input class="fm fm110" type="text" name="server_name" value="<?=$vars['server_name'];?>">
								<span class="e f7"></span>
							</td>
						</tr><tr>
							<td>
								<label>Need preRegistration code:</label>
								<input class="fm fm110" type="number" min="0" name="need_preregister_code" value="<?=$vars['need_preregister_code'];?>">
								<span class="e f7"></span>
							</td>
						</tr>
						<tr>
							<td>
								<label>Show server as promoted:</label>
								<input class="fm fm110" type="number" min="0" max="1" name="server_promoted" value="<?=$vars['server_promoted'];?>">
								<span class="e f7"></span>
							</td>
						</tr>
						<tr>
							<td>
								<label>Default Language:</label>
								<select name="language">
									<option value="ir" <?=$vars['language'] === 'ir' ? 'selected' : '';?>>فارسی</option>
									<option value="en" <?=$vars['language'] === 'en' ? 'selected' : '';?>>English</option>
								</select>
								<span class="e f7"></span>
							</td>
						</tr>
						<tr>
							<td>
								<hr />
								<label>Game Settings:</label>
								<br />
							</td>
						</tr>
						<tr>
							<td>
								<label>Speed:</label>
								<input class="fm fm110" type="number" min="1" max="10000" name="game_speed" value="<?=$vars['game_speed'];?>">
								<span class="e f7"></span>
							</td>
						</tr>
						<tr>
							<td>
								<label>Movement speed:</label>
								<input class="fm fm110" type="number" min="1" max="10000" name="game_movement_speed" value="<?=$vars['game_movement_speed'];?>">
								<span class="e f7"></span>
							</td>
						</tr>
						<tr>
							<td>
								<label>Start time:</label>
								<input class="fm fm110" type="text" name="game_start_time" value="<?=date("Y/m/d H:i", $vars['game_start_time']);?>">
								<span class="e f7"></span>
							</td>
						</tr>
						<tr>
							<td>
								<label>Round length:</label>
								<input class="fm fm110" type="number" min="1" max="365" name="game_round_length" value="<?=$vars['game_round_length'];?>">
								<span class="e f7"></span>
							</td>
						</tr>
						<tr>
							<td>
								<label>Storage multiplier:</label>
								<input class="fm fm110" type="number" min="1" name="game_storage_multiplier" value="<?=$vars['game_storage_multiplier'];?>">
								<span class="e f7"></span>
							</td>
						</tr>
						<tr>
							<td>
								<label>Protection hours:</label>
								<input class="fm fm110" type="number" min="1" max="192" name="game_protection_hours" value="<?=$vars['game_protection_hours'];?>">
								<span class="e f7"></span>
							</td>
						</tr>
						<tr>
							<td>
								<label>Medals interval seconds:</label>
								<input class="fm fm110" type="number" min="3600" max="604800" name="game_medals_interval" value="<?=$vars['game_medals_interval'];?>">
								<span class="e f7"></span>
							</td>
						</tr>
						</tbody>
					</table>
				</div>
				<p align="center">
					<input type="Submit" name="" value="&nbsp; install &nbsp;">
				</p>
				<p align="center"></p>
			</form>
		</td>
	</tr>
	</tbody>
</table>
</body>
</html>