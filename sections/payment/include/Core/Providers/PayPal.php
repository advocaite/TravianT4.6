<?php

namespace Core\Providers;

use Core\WebService;

class PayPal
{
    private $last_error;
    private $ipn_response;
    private $ipn_data = array();
    private $fields = array();
    private static $instance;

    public function __construct()
    {
        $this->setField('rm', '2');           // Return method = POST
        $this->setField('cmd', '_xclick');
    }

    public static function getInstance()
    {
        if (!(self::$instance instanceof PayPal)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function loadProvider($info, $price, $order, $connectInfo)
    {
        $baseUrl = WebService::get_real_base_url() . 'process/index.php?METHOD=onProviderReturn&ORDER=' . $order;
        $this->setField('return', $baseUrl . '&result=success');
        $this->setField('cancel_return', $baseUrl . '&result=cancel');
        $this->setField('notify_url', $baseUrl . '&result=ipnCheck');
        $this->setField('item_name', $info);
        $this->setField('amount', ($price + 0.30));
        $this->setField('business', $connectInfo);
        $this->setField('tax_rate', '3');
        $this->redirectByPOST();
    }

    public function setField($field, $value)
    {
        $this->fields[$field] = $value;
    }

    private function submitPOST()
    {
        echo '<form method="post" name="paypal_form" action="' . $this->getPaypalUrl() . '">';
        foreach ($this->fields as $name => $value) {
            echo "<input type=\"hidden\" name=\"$name\" value=\"$value\"/>\n";
        }
        echo '</form>';
    }

    private function redirectByPOST()
    {
        redirect($this->getPaypalUrl() . '?' . http_build_query($this->fields));
        exit();
    }

    private function getPaypalUrl()
    {
        return 'https://www.paypal.com/cgi-bin/webscr';
    }

    public function validate_ipn()
    {
        $url_parsed = parse_url($this->getPaypalUrl());
        $post_string = '';
        foreach ($_POST as $field => $value) {
            $this->ipn_data[$field] = $value;
            $post_string .= $field . '=' . urlencode(stripslashes($value)) . '&';
        }
        $post_string .= "cmd=_notify-validate"; // append ipn command
        $fp = fsockopen('ssl://www.paypal.com', 443, $errno, $errstr, 30);
        if (!$fp) {
            $this->last_error = "fsockopen error no. $errno: $errstr";
            return false;
        } else {
            fputs($fp, "POST {$url_parsed['path']} HTTP/1.1\r\n");
            fputs($fp, "Host: {$url_parsed['host']}\r\n");
            fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
            fputs($fp, "Content-length: " . strlen($post_string) . "\r\n");
            fputs($fp, "Connection: close\r\n\r\n");
            fputs($fp, $post_string . "\r\n\r\n");
            while (!feof($fp)) {
                $this->ipn_response .= fgets($fp, 1024);
            }
            fclose($fp);
        }
        if (strpos($this->ipn_response, 'VERIFIED') !== FALSE) {
            return true;
        } else {
            Mailer::sendAdminReport("IPN Validation Failed", DB::Singleton()->real_escape_string(print_r($_POST)));
            $this->last_error = 'IPN Validation Failed.';
            return false;
        }
    }
}