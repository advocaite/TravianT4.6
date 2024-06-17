<?php

namespace Controller;

use Core\Dispatcher;
use Core\Session;

abstract class AbstractCtrl
{
    protected $session;

    public function __construct()
    {
        $this->session = Session::getInstance();
    }


    /** a class of View to render output. */
    public $view;

    /**
     * renders the view and will return it as html output.
     */
    abstract public function render();

    /**
     * before render things like checking session accesses and others..
     */
    abstract protected function beforeRender();

    /**
     * actions to be done after rendering completed.
     */
    abstract protected function afterRender();

    /**
     * this redirects inner MVC pattern actually it will just change the Controller.
     */
    final protected function innerRedirect($controller, $print = TRUE)
    {
        $dispatcher = new Dispatcher();
        $dispatcher->dispatch($controller, $print);
        exit(0);
    }

    /**
     * @param     $url
     * @param int $code
     *
     * outer redirect function.
     */
    final protected function redirect($url, $code = 302)
    {
        if (!$url) {
            return;
        }
        // Close any db connections before exit
        // Clear out any previously sent content
        if (!in_array($code, [301, 302])) {
            $code = 302;
        }
        header("Location: " . $url, TRUE, $code);
        exit();
    }
}
