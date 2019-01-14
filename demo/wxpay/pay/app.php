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
    $result = $payment->pay( 'wxpay' )->app( array(
        'body'         => 'app支付测试', // 商品描述
        'out_trade_no' => uniqid(), // 商户订单号
        'total_fee'    => 1, // 价格：分
    ) );

    var_dump( $result );
}
catch ( \johnxu\payment\Exception $e )
{
    echo $e->getMessage();
}
