<?php

namespace App\Http\Controllers;

use App\Models\BusinessSetting;
use App\Seller;
use Illuminate\Support\Facades\Session;

# IF BROWSE FROM LOCAL HOST, KEEP true
define("CITIGATE_IS_LOCAL_HOST", true);

class Citigate
{
    protected $citigate_submit_url;
    protected $citigate_validation_url;
    protected $citigate_mode;
    protected $citigate_data;
    protected $citigate_merchantName;
    protected $citigate_merchantPassword;
    protected $citigate_success_url;
    protected $citigate_callback_url;

    public $error = '';

    public function __construct()
    {
        if (Session::has('payment_type')) {
            if (Session::get('payment_type') == 'cart_payment') {
                # IF SANDBOX TRUE, THEN IT WILL CONNECT WITH CITIGATE SANDBOX (TEST) SYSTEM
                if (BusinessSetting::where('type', 'citigate_sandbox')->first()->value == 1) {
                    define("CITIGATE_IS_SANDBOX", true);
                } else {
                    define("CITIGATE_IS_SANDBOX", false);
                }
                //$this->setCitigateMode((CITIGATE_IS_SANDBOX) ? 1 : 0);
                $this->citigate_merchantName = env('CITIGATE_MerchantName');
                $this->citigate_merchantPassword = env('CITIGATE_MerchantPassword');
            }
        }
        $this->citigate_submit_url = "https://gw-test.cgate.tech/orion/hosted/Payment.aspx";
        $this->citigate_success_url = "https://gwtest.cgate.tech/orion/tester/TestReturn.aspx";
        $this->citigate_callback_url = "https://gwtest.cgate.tech/orion/tester/TestCallback.ashx";
    }

    public function initiate($post_data, $get_pay_options = false)
    {
        if ($post_data != '' && is_array($post_data)) {
            header("Location: " . env('CITIGATE_URL') . '?' . http_build_query($post_data));
            exit;
        } else {
            $msg = "Please provide a valid information list about transaction with transaction id, amount, success url, fail url, cancel url, store id and pass at least";
            $this->error = $msg;
            return false;
        }
    }

    public function getResultData()
    {
        return $this->citigate_data;
    }
}
