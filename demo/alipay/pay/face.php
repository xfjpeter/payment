<?php
/**
 * | ---------------------------------------------------------------------------------------------------
 * | Author：johnxu <fsyzxz@163.com>.
 * | ---------------------------------------------------------------------------------------------------
 * | Home: https://www.johnxu.net.
 * | ---------------------------------------------------------------------------------------------------
 * | Data: 2019/1/11
 * | ---------------------------------------------------------------------------------------------------
 * | Desc: 当面付
 * | ---------------------------------------------------------------------------------------------------
 * | Doc：https://docs.open.alipay.com/api_1/alipay.trade.pay
 * | ---------------------------------------------------------------------------------------------------
 */

require '../../../vendor/autoload.php';

use johnxu\tool\Config;
use johnxu\payment\Payment;

$config = require '../../config.php';

try
{
    $alipay = Payment::getInstance( $config )->pay( 'alipay' );

    $payment = $alipay->face( array(
        'out_trade_no' => uniqid(),
        'total_amount' => '0.01',
        'subject'      => '当面付款',
        'auth_code'    => '280109961603010965', // 条码值
        'scene'        => 'bar_code', // 条码支付，取值：bar_code, 声波支付，取值：wave_code
    ) );

    echo '<pre>';
    print_r( $payment );
    echo '</pre>';
}
catch ( \johnxu\payment\Exception $e )
{
}

/**
 * 支付成功的结果
 * stdClass Object
 * (
 * [alipay_trade_pay_response] => stdClass Object
 * (
 * [code] => 10000
 * [msg] => Success
 * [buyer_logon_id] => hlw***@sandbox.com
 * [buyer_pay_amount] => 0.01
 * [buyer_user_id] => 2088102169195376
 * [buyer_user_type] => PRIVATE
 * [fund_bill_list] => Array
 * (
 * [0] => stdClass Object
 * (
 * [amount] => 0.01
 * [fund_channel] => ALIPAYACCOUNT
 * )
 *
 * )
 *
 * [gmt_payment] => 2019-01-12 23:35:54
 * [invoice_amount] => 0.01
 * [out_trade_no] => 5c3a0958c34a0
 * [point_amount] => 0.00
 * [receipt_amount] => 0.01
 * [total_amount] => 0.01
 * [trade_no] => 2019011222001495370500536139
 * )
 *
 * [sign] => joyJ36ZYxshSioakbBedxPovRdEJ8CeyOUZZv7RnJILN7gbpkAoeSmWSPOEv4gZcaN720axhgclgMN++TaDNgAhtJwPlcc99VzZfVf6bhavwMYg7YbS43iL48fLHqnWNv9U3AVTgY10JIfELi9/mPAgdbd+3GLdgXnvf5JuKfLK7e9xgETn8TQPSPgmORWMK+9OUKBAHkWsYoT1komnaeeA/t92bQ+8VgjEJc5iVJEfmBc6Yxg86+Po3I3XDHxj68PM9PfxLrifGXA2UORYrheXLdI35ET8kcY2tgwKMP6sBBgsjmImzOHRIk+B1XSkitmfr4+u3600bz3Whz9htaQ==
 * )
 */

/**
 * 已经支付过的结果
 * stdClass Object
 * (
 * [alipay_trade_pay_response] => stdClass Object
 * (
 * [code] => 10003
 * [msg] =>  order success pay inprocess
 * [buyer_logon_id] => hlw***@sandbox.com
 * [buyer_pay_amount] => 0.00
 * [buyer_user_id] => 2088102169195376
 * [buyer_user_type] => PRIVATE
 * [invoice_amount] => 0.00
 * [out_trade_no] => 5c3a0868d26f2
 * [point_amount] => 0.00
 * [receipt_amount] => 0.00
 * [total_amount] => 0.01
 * [trade_no] => 2019011222001495370500535759
 * )
 *
 * [sign] => c86NWayu0d3t2yFPQAz28i48qp0M9Fonf5cyXGSlWFh0O7qXkLUBzRdYfUL/sB+0AfXyfoWtHh1uLgOHnpAFQh/DFIhgCMfGVE1KDDRL5nuqOtzFbzRrEU2N8RiVEFyrBwp3Z/XCPD1MRSSZ2KXOkEz+NGIYQVt0YjQrW64IRUintgwFYms5w3Us0N0nRXOFP0mHRBxr9FvHt3paG0pWvFzU9zCjE0g33KQueT5ID6nxLSDU+zW21VmYXqwJwSwnipNCp7guFiap44Wppta50bezHFXBy/DVbfZ8p9HQhp1t9kL7q1VoYvk4erow5lOiq30sKW48kgCKWkSa2daQDg==
 * )
 */

/**
 * auth_code错误的结果
 * stdClass Object
 * (
 * [alipay_trade_pay_response] => stdClass Object
 * (
 * [code] => 40004
 * [msg] => Business Failed
 * [sub_code] => ACQ.PAYMENT_AUTH_CODE_INVALID
 * [sub_msg] => 支付失败，获取顾客账户信息失败，请顾客刷新付款码后重新收款，如再次收款失败，请联系管理员处理。[SOUNDWAVE_PARSER_FAIL]
 * [buyer_pay_amount] => 0.00
 * [invoice_amount] => 0.00
 * [point_amount] => 0.00
 * [receipt_amount] => 0.00
 * )
 *
 * [sign] => Xz/MLdmlgKy0zQLmBcbdgcSsobxYyZTCB08Y7S4Q8/TsgibhwO4No2ZXwJ7s6sgOr+v1dof5uqcxj/xZq9JKtei+n6/NvL4WV4Q5cHxBdShYBkz5uLDnFoxXobJBBSL+PCnNuoBRwMUvCsg3XgHsxuE+5X/gAcDMgVzGBzcQGNgOSRqxKnGraSEL5ieFqzBmN2xuLdoGUBwsA+vU+qOsnPxJ9vK+rvCVsaAIca+8QHedfRfR5biRLRNsRIx8gETneaSLTTEIb33Ej15L6kY6MaP9L9XiTXRfLDslog+paaJeQmD4fsFgBDiu+eEUm/Okzj5iQceJnQKxDHRh25zT6Q==
 * )
 */



