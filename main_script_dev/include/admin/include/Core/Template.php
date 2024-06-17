<?php

class Template
{
    private static $_self;

    public static function getInstance()
    {
        if (!(self::$_self instanceof self)) {
            self::$_self = new self();
        }
        return self::$_self;
    }

    public function load($params, $templateName)
    {
        ob_start();
        require dirname(__DIR__) . DIRECTORY_SEPARATOR . "templates.php";
        return new TemplateSecond(ob_get_clean());
    }
}

class TemplateSecond
{
    private $html;

    public function __construct($html)
    {
        $this->html = $html;
    }

    public function display()
    {
        echo $this->html;
    }

    public function getAsString()
    {
        return $this->html;
    }
}