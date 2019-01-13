<?php
/**
 * | ---------------------------------------------------------------------------------------------------
 * | Author：johnxu <fsyzxz@163.com>.
 * | ---------------------------------------------------------------------------------------------------
 * | Home: https://www.johnxu.net.
 * | ---------------------------------------------------------------------------------------------------
 * | Data: 2019/1/11
 * | ---------------------------------------------------------------------------------------------------
 * | Desc: 统一收单交易撤销接口
 * | ---------------------------------------------------------------------------------------------------
 * | Document：https://docs.open.alipay.com/api_1/alipay.trade.cancel/
 * | ---------------------------------------------------------------------------------------------------
 */

require '../../../vendor/autoload.php';

use johnxu\tool\Config;
use johnxu\payment\Payment;

$config = require '../../config.php';

try
{
    $alipay = Payment::getInstance( $config )->trade( 'alipay' );

    $payment = $alipay->cancel( array(
        'trade_no'     => '',
        'out_trade_no' => '5c3a0958c34a0',
    ) );

    echo '<pre>';
    print_r( $payment );
    echo '</pre>';
}
catch ( \johnxu\payment\Exception $e )
{
}



/**
 * 成功
 * stdClass Object
 * (
 * [alipay_trade_cancel_response] => stdClass Object
 * (
 * [code] => 10000
 * [msg] => Success
 * [action] => refund
 * [out_trade_no] => 5c3a0958c34a0
 * [retry_flag] => N
 * [trade_no] => 2019011222001495370500536139
 * )
 *
 * [sign] => RhIk88tWkBMIVozTZWQ60AfsfvD+zwMC2N6ZawoP/WQw7rjABKZ9Bgd3lYztH2J9S1O7+NtZMY/w896m+ANLilewn/870V7wRRiimYFtpy+zKZ/RFtSWFpRqmw+UmJkPMqzqEjyxRKgjt6oOg65zkNgQjc1Wxuhw9M0KLmQkKCLUC5iA7QL7PusFzFqv0z8tTrhQVRPYpAH2g5I44bqTK5th4gLqiu4zUSw72kALFwt9f5qOJ7ckh50ZQonMYcBym4tU+dzXT92268n030lA9rFaXQDl9w5lXivd0bl6gNpj+ajVXiRi+tS7WOQ+12jrl3wJeh4ST45ddeVFE5Az2A==
 * )
 */


