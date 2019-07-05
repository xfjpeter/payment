<?php

return array(
    'wxpay'  => array(
        'dev'        => true,
        'app_id'     => 'wx426b3015555a46be',
        'mch_id'     => '1900009851',
        'key'        => '8934e7d15453e97507ef794cf7b0519d',
        'sign_type'  => 'HMAC-SHA256', // 签名类型，默认为MD5，支持HMAC-SHA256和MD5。
        'secret'     => '7813490da6f1265e4901ffb80afaa36f',
        'cert_client' => '', // optional，退款等情况时用到
        'cert_key'   => '', // optional，退款等情况时用到
        'notify_url' => 'http://pay.johnxu.net/demo/notify_url.php',
        'return_url' => 'http://pay.johnxu.net/demo/return_url.php'
    ),
    'alipay' => array(
        'debug'               => true,
        'dev'                 => true,
        'charset'             => 'utf-8',
        'sign_type'           => 'RSA2',
        'app_id'              => '2016090900471394',
        'platform_public_key' => __DIR__ . '/pem/platform_key.pem', // 可以填写文件路径，也可以填写字符串
        'user_private_key'    => __DIR__ . '/pem/private_key.pem', // 同上
        'user_public_key'     => __DIR__ . '/pem/public_key.pem', // 同上
        'return_url'          => 'http://pay.johnxu.net/demo/return_url.php', // 同步通知地址
        'notify_url'          => 'http://pay.johnxu.net/demo/notify_url.php' // 异步通知地址
    )
);
