<?php

namespace Api;

use function call_user_func;
use function call_user_func_array;
use Core\Translator;
use Exceptions\ActionNotFoundException;
use Exceptions\CtrlNotFoundException;
use Exceptions\MissingParameterException;
use function method_exists;
use function ucfirst;

class ApiDispatcher
{
    private $response;
    private $payload;

    public function __construct(&$response, $payload, $section, $action)
    {
        $this->response = &$response;
        $this->response['data'] = [];
        $data =& $this->response['data'];
        $this->payload = $payload;
        if ($section == null) {
            $section = 'config';
        }
        $controller = ucfirst($section) . 'Ctrl';
        if (!is_file(__DIR__ . '/Ctrl/' . $controller . '.php')) {
            throw new CtrlNotFoundException("Ctrl \"$controller\" not found.");
        }
        /** @var $controller ApiAbstractCtrl */
        $loader = "\\Api\\Ctrl\\$controller";
        $dispatchedCtrl = new $loader($data, $payload);
        if (!method_exists($dispatchedCtrl, $action)) {
            throw new ActionNotFoundException("Action \"$action\" does not exists in Ctrl \"$controller\".");
        }
        if($section !== 'config'){
            if (!isset($this->payload['lang'])) {
                throw new MissingParameterException("lang");
            }
            Translator::setLanguage($this->payload['lang']);
        }
        call_user_func([$dispatchedCtrl, $action]);
    }
}