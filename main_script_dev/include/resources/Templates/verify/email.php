<div style="text-align: <?= (strtolower(getDirection()) == 'rtl' ? 'right' : 'left'); ?>; direction: <?= strtolower(getDirection()); ?>">
    <?= sprintf(T("EVerify", "email.HELLO_X"), $vars['playerName']); ?>
    <br/>
    <?= T("EVerify", "email.THANKS_FOR_REGISTERING_ACCOUNT"); ?>
    <br/>
    <?= T("EVerify", "email.INSTRUCTIONS"); ?>
    <br/>
    <a href="<?= $vars['verification_url']; ?>"><?= $vars['verification_url']; ?></a>
    <br/>
    ---------------------------------------------------------------------------------------------------------------------------------
    <br/>
    <?= T("EVerify", "email.YOUR_ACCESS_DATA"); ?>:
    <br/>
    <?= T("EVerify", "email.PLAYER_NAME"); ?>: <?= $vars['playerName']; ?><br>
    <?= T("EVerify", "email.EMAIL_ADDRESS"); ?>: <?= $vars['email']; ?><br>
    <?= T("EVerify", "email.GAME_WORLD"); ?>: <?= getWorldId(); ?>
    <br/>
    <?= T("EVerify", "email.VERIFICATION_CODE"); ?>: <span style="direction: ltr"><?= $vars['verification_code']; ?></span>
    <br/>
    ---------------------------------------------------------------------------------------------------------------------------------
    <br/>
    <?= T("EVerify", "email.GAME_HINTS"); ?>:
    <br/>
    <?= sprintf(T("EVerify", "email.IN_OUR_ANSWERS_AND_FORUM"), '<a href="' . getAnswersUrl() . '">' . getAnswersUrl() . '</a>', '<a href="' . getForumUrl() . '">' . getForumUrl() . '</a>'); ?>
    <br/>
    <?= T("EVerify", "email.HAVE_A_GOOD_TIME_AND_MANY_GLORIOUS_BATTLES"); ?>
    <?= T("EVerify", "email.YOUR_TRAVIAN_TEAM"); ?>
</div>