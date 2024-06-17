<?php if (isset($vars['codeEmpty'])): ?>
    <p class="warning">
        <?=T("EVerify", "NO_CODE_ENTERED");?>
        <?=T("EVerify", "TO_LOGIN_PLEASE_CLICK_HERE");?>
    </p>
<?php elseif (isset($vars['invalidCode'])): ?>
    <p style="color: red; font-weight: bold;">
        <?=T("EVerify", "ENTERED_CODE_INVALID");?>
        <?=T("EVerify", "TO_LOGIN_PLEASE_CLICK_HERE");?>
    </p>
<?php elseif (isset($vars['emailExists'])): ?>
    <p style="color: red; font-weight: bold;">
        <?=T("EVerify", "EMAIL_EXISTS_CANT_VERIFY");?>
        <br />
        <?=T("EVerify", "TO_LOGIN_PLEASE_CLICK_HERE");?>
    </p>
<?php elseif (isset($vars['emailBlacklisted'])): ?>
    <p style="color: red; font-weight: bold;">
        <?=T("EVerify", "EMAIL_BLACKLISTED_CANT_VERIFY");?>
        <br />
        <?=T("EVerify", "TO_LOGIN_PLEASE_CLICK_HERE");?>
    </p>
<?php elseif (isset($vars['notFound'])): ?>
    <p class="warning">
        <?=T("EVerify", "NO_MATCHING_ROWS_FOUND");?>
        <br />
        <?=T("EVerify", "TO_LOGIN_PLEASE_CLICK_HERE");?>
    </p>
<?php elseif (isset($vars['success'])): ?>
    <p style="color: white; font-weight: bold;">
        <?=T("EVerify", "YOUR_ACCOUNT_WAS_VERIFIED_SUCCESSFULLY");?>
        <?=T("EVerify", "TO_LOGIN_PLEASE_CLICK_HERE");?>
    </p>
<?php endif; ?>