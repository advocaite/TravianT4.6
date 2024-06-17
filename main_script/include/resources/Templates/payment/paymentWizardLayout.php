<?php if($vars['class'] == 'buyGold'):?>
<div id="paymentWizardContainer">
<?php endif;?>
	<div id="paymentWizard" class="<?php use Core\Database\GlobalDB;
	use Core\Session;echo $vars['class']; ?>">
		<input class="paymentWizardAnswersLink hide" type="hidden"
			   name="answersLink"
			   value="<?=isset($vars['answersLink']) && $vars['answersLink'] ? $vars['answersLink'] : ''; ?>">

		<div class="contentWrapper">
			<?=$vars['content']; ?>
		</div>
		<div class="header">
			<ul>
				<li <?=$vars['class'] == 'buyGold' ? 'class="active"' : 'style="margin-top: -1px; height: 33px;"'; ?>>
					<a href="#" class="tabButton buyGold" onclick="return false;">
						<div class="tabBtnBGPart start">
							<div class="tabBtnBGPart end">
								<div class="tabBtnBGPart middle"></div>
							</div>
						</div>
						<div
							class="text"><?=T("PaymentWizard", "Buy gold"); ?></div>
						<img src="img/x.gif" class="tabBtnImg">
					</a>

					<div class="tabBorder"></div>
				</li>
				<li <?=$vars['class'] == 'pros' ? 'class="active"' : 'style="margin-top: -1px; height: 33px;"'; ?>>
					<a href="#" class="tabButton pros" onclick="return false;">
						<div class="tabBtnBGPart start">
							<div class="tabBtnBGPart end">
								<div class="tabBtnBGPart middle"></div>
							</div>
						</div>
						<div
							class="text"><?=T("PaymentWizard", "Advantages"); ?></div>
						<img src="img/x.gif" class="tabBtnImg">
					</a>

					<div class="tabBorder"></div>
				</li>
				<?php if(getDisplay("showPlusSupportTab")): ?>
				<li <?=$vars['class'] == 'plusSupport' ? 'class="active"' : 'style="margin-top: -1px; height: 33px;"'; ?>>
					<a href="#" class="tabButton plusSupport"
					   onclick="return false;">
						<div class="tabBtnBGPart start">
							<div class="tabBtnBGPart end">
								<div class="tabBtnBGPart middle"></div>
							</div>
						</div>
						<div
							class="text"><?=T("PaymentWizard", "Plus Support"); ?></div>
						<img src="img/x.gif" class="tabBtnImg">
					</a>

					<div class="tabBorder"></div>
				</li>
				<?php endif;?>
				<li <?=$vars['class'] == 'earnGold' ? 'class="active"' : 'style="margin-top: -1px; height: 33px;"'; ?>>
					<a href="#" class="tabButton earnGold" onclick="return false;">
						<div class="tabBtnBGPart start">
							<div class="tabBtnBGPart end">
								<div class="tabBtnBGPart middle"></div>
							</div>
						</div>
						<div
							class="text"><?=T("PaymentWizard", "Earn Gold"); ?></div>
						<img src="img/x.gif" class="tabBtnImg">
					</a>

					<div class="tabBorder"></div>
				</li>
				<li <?=$vars['class'] == 'openOrders' ? 'class="active"' : 'style="margin-top: -1px; height: 33px;"'; ?>>
					<a href="#" class="tabButton openOrders" onclick="return false;">
						<div class="tabBtnBGPart start">
							<div class="tabBtnBGPart end">
								<div class="tabBtnBGPart middle"></div>
							</div>
						</div>
						<div
							class="text"><?=T("PaymentWizard", "Open orders"); ?></div>
						<img src="img/x.gif" class="tabBtnImg">
					</a>
					<div class="tabBorder"></div>
				</li>
				<?php if($vars['plusFeaturesEnabled']): ?>
					<li <?=$vars['class'] == 'paymentFeatures' ? 'class="active"' : 'style="margin-top: -1px; height: 33px;"'; ?>>
						<a href="#" class="tabButton paymentFeatures"
						   onclick="return false;">
							<div class="tabBtnBGPart start">
								<div class="tabBtnBGPart end">
									<div class="tabBtnBGPart middle"></div>
								</div>
							</div>
							<div class="text"><img src="/img/starGold.png"
												   style="vertical-align: middle;width: 22px;">&nbsp;<?=T("PaymentWizard", "paymentFeatures"); ?>
							</div>
							<!--  <img src="img/x.gif" class="tabBtnImg"> -->
						</a>

						<div class="tabBorder"></div>
					</li>
				<?php endif; ?>
				<li class="clear"></li>
			</ul>
		</div>
		<div class="headerPlayerInfo">
			<?php if($vars['class'] == "buyGold"):?>
			<div id="locationSelector">
				<?=T("PaymentWizard", "Location"); ?>:
				<select name="location" class="buyGoldLocation">
					<?php
					$result = GlobalDB::getInstance()->query("SELECT * FROM locations");
					$locations = [];
					$def = $_SESSION[Session::getInstance()->fixSessionPrefix('default_payment_location')];
					while ($row = $result->fetch_assoc()) {
						echo '<option value="'.$row['id'].'" '.($def == $row['id'] ? 'selected' : '').'>'.$row['location'].'</option>';
					}
					?>
				</select>
			</div>
			<?php endif;?>
			<div class="accountBalance v2">
				<?=T("PaymentWizard", "Gold"); ?>: <img src="img/x.gif" class="gold" alt="<?=T("PaymentWizard", "Gold"); ?>">
                <span>
                    <?php if(getCustom("serverIsFreeGold")):?>
                        <b><?=T("Global", "Unlimited");?></b>
                    <?php else:?>
                        <?=Session::getInstance()->getAvailableGold(); ?>
                    <?php endif;?>
                </span>
			</div>
			<div class="clear"></div>
		</div>
	</div>
<?php if($vars['class'] == 'buyGold'):?>
    </div>
<?php endif;?>