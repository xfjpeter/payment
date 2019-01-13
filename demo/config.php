<?php

return array(
    'wx'     => array(
        'app_id' => '',
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
