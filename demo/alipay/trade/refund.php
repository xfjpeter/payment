<?php
/**
 * | ---------------------------------------------------------------------------------------------------
 * | Author：johnxu <fsyzxz@163.com>.
 * | ---------------------------------------------------------------------------------------------------
 * | Home: https://www.johnxu.net.
 * | ---------------------------------------------------------------------------------------------------
 * | Data: 2019/1/11
 * | ---------------------------------------------------------------------------------------------------
 * | Desc: 统一收单交易退款接口
 * | ---------------------------------------------------------------------------------------------------
 * | Document：https://docs.open.alipay.com/api_1/alipay.trade.refund/
 * | ---------------------------------------------------------------------------------------------------
 */

require '../../../vendor/autoload.php';

use johnxu\tool\Config;
use johnxu\payment\Payment;

$config = require '../../config.php';

try
{
    $alipay = Payment::getInstance( $config )->trade( 'alipay' );

    $payment = $alipay->refund( array(
        'trade_no'      => '', // 支付宝订单号（二选一）
        'out_trade_no'  => '5c3a0958c34a0', // 商户订单号（二选一）
        'refund_amount' => '0.01', // 退款金额
    ) );

    echo '<pre>';
    print_r( $payment );
    echo '</pre>';
}
catch ( \johnxu\payment\Exception $e )
{
}

/**
 * 错误返回
 * stdClass Object
 * (
 * [alipay_trade_refund_response] => stdClass Object
 * (
 * [code] => 40004
 * [msg] => Business Failed
 * [sub_code] => ACQ.TRADE_HAS_CLOSE
 * [sub_msg] => 交易已经关闭
 * [refund_fee] => 0.00
 * [send_back_fee] => 0.00
 * )
 *
 * [sign] => dqEMNUHuoFW6s/VZsG1YO+0I/LjUduICkcPohp8MWY6dSXLVx6LUZZJ5lnTpuvxvUYfzucAyWMBiz3V4jWiHO6hOL/PPiaJYlLQVCk9gzu/eikK0VKQuUwfWtN8mjnI1tzvKBAFVTxPIjGMM2laAGg7sKgGDt+41w1vbjO2MEWm9jPZcsij4S3O81xcoVMKZy2StCrDzrJc1KDFMD/VPOkJ3TUFHSwF09Fl3tNnxqA6GkOER6XHMx46WH4ySKi2u/Tl50653AU50DjdXtXTiwkSn5gRYohR5X7ZMRtzrnYPb+cJp2wUd9j5tYgjTxV7bcZy6L/kCQ0+D9YOmRpNe/A==
 * )
 */


