<?php
namespace Api;
class ApiAbstractCtrl
{
    protected $response;
    protected $payload;
    public function __construct(&$response, $payload)
    {
        $this->response = &$response;
        $this->payload = &$payload;
    }
}