<?php

class NotFoundCtrl
{
    public function __construct()
    {
        $dispatcher = Dispatcher::getInstance();
        $dispatcher->appendContent('<div id="content" class="error_site"><div style="margin-top: 50px;">
	<center>
		<h1>404 - File not found</h1>
		<img src="img/x.gif" class="e404" title="Not Found" alt="Not Found"><br />
		<p>We looked 404 times already but can\'t find anything, Not even an X marking the spot.</p>
	</center>
</div></div>');
    }
}