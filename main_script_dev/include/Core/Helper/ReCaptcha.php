<?php

namespace Core\Helper;
class ReCaptchaResponse
{
    public $success;
    public $errorCodes;
}

class ReCaptcha
{
    private static $_signupUrl     = "https://www.google.com/recaptcha/admin";
    private static $_siteVerifyUrl = "https://www.google.com/recaptcha/api/siteverify?";
    private        $_secret;
    private static $_version       = "php_1.0";

    function __construct($secret)
    {
        if ($secret == null || $secret == "") {
            die("To use reCAPTCHA you must get an API key from <a href='"
                . self::$_signupUrl . "'>" . self::$_signupUrl . "</a>");
        }
        $this->_secret = $secret;
    }

    private function _encodeQS($data)
    {
        $req = "";
        foreach ($data as $key => $value) {
            $req .= $key . '=' . urlencode(stripslashes($value)) . '&';
        }
        // Cut the last '&'
        $req = substr($req, 0, strlen($req) - 1);
        return $req;
    }

    /**
     * Submits an HTTP GET to a reCAPTCHA server.
     *
     * @param string $path url path to recaptcha server.
     * @param array $data array of parameters to be sent.
     *
     * @return array response
     */
    private function _submitHTTPGet($path, $data)
    {
        $req = $this->_encodeQS($data);
        $response = file_get_contents($path . $req);
        return $response;
    }

    /**
     * Calls the reCAPTCHA siteverify API to verify whether the user passes
     * CAPTCHA test.
     *
     * @param string $remoteIp IP address of end user.
     * @param string $response response string from recaptcha verification.
     *
     * @return ReCaptchaResponse
     */
    public function verifyResponse($remoteIp, $response)
    {
        // Discard empty solution submissions
        if ($response == null || strlen($response) == 0) {
            $recaptchaResponse = new ReCaptchaResponse();
            $recaptchaResponse->success = false;
            $recaptchaResponse->errorCodes = 'missing-input';
            return $recaptchaResponse;
        }
        $getResponse = $this->_submitHttpGet(
            self::$_siteVerifyUrl,
            array(
                'secret'   => $this->_secret,
                'remoteip' => $remoteIp,
                'v'        => self::$_version,
                'response' => $response
            )
        );
        $answers = json_decode($getResponse, true);
        $recaptchaResponse = new ReCaptchaResponse();
        if (trim($answers ['success']) == true) {
            $recaptchaResponse->success = true;
        } else {
            $recaptchaResponse->success = false;
            $recaptchaResponse->errorCodes = isset($answers['error-codes']) ? $answers['error-codes'] : [];
        }
        return $recaptchaResponse;
    }
}