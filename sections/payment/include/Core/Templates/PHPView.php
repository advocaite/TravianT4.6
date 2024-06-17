<?php

namespace Core\Templates;
class PHPView
{
    public $vars = array();
    public $filename;

    public function __construct()
    {
        $this->filename = __DIR__ . DIRECTORY_SEPARATOR . 'Templates.php';
    }

    public function display($viewSwitcher = null)
    {
        $vars = $this->vars;
        require($this->filename);
    }

    public function render($viewSwitcher = null)
    {
        ob_start();
        $this->display($viewSwitcher);
        return ob_get_clean();
    }

    public function output($viewSwitcher = null)
    {
        return $this->render($viewSwitcher);
    }
} 