<?php
/**
 * 微信扫码支付
 */

require '../../../vendor/autoload.php';

$config = require '../../config.php';

\johnxu\tool\Config::getInstance()->batch( $config );

$payment = \johnxu\payment\Payment::getInstance();

try
{
    $res = $payment->pay( 'wxpay' )->transfer( array(
        'body'         => '当面付款', // 商品描述
        'out_trade_no' => uniqid(), // 商户订单号
        'total_fee'    => 1, // 价格：分
        'auth_code'    => '134589073529925221', // 支付条形码值
    ) );

    var_dump( $res );
}
catch ( \johnxu\payment\Exception $e )
{
}
