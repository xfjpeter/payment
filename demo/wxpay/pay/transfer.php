<?php

/**
 * 微信扫码支付
 */

require '../../../vendor/autoload.php';

$config = require '../../config.php';

\johnxu\tool\Config::getInstance()->batch($config);

$payment = \johnxu\payment\Payment::getInstance();

try {
    $res = $payment->pay('wxpay')->transfer(array(
        'openid'           => '用户的openid', // 用户的openid
        'partner_trade_no' => uniqid(), // 商户订单号
        'desc'             => '转账描述', //
        'check_name'       => 'NO_CHECK', // 是否校验姓名
        'amount'           => 1, // 转账金额，分
    ));

    var_dump($res);
} catch (\johnxu\payment\Exception $e) { }
