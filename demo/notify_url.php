<?php
/**
 * | ---------------------------------------------------------------------------------------------------
 * | Author：johnxu <fsyzxz@163.com>.
 * | ---------------------------------------------------------------------------------------------------
 * | Home: https://www.johnxu.net.
 * | ---------------------------------------------------------------------------------------------------
 * | Data: 2019/1/12
 * | ---------------------------------------------------------------------------------------------------
 * | Desc:
 * | ---------------------------------------------------------------------------------------------------
 */

require '../vendor/autoload.php';

$config = require './config.php';
\johnxu\tool\Config::getInstance()->batch( $config );


// 接收参数
file_put_contents( './notify_data.txt', json_encode( $_POST, JSON_UNESCAPED_UNICODE ) . PHP_EOL, FILE_APPEND );

// 验证签名
file_put_contents( './notify_data.txt', \johnxu\payment\alipay\Support::verifySignature( $_POST, $_POST['sign'], true, true ) . PHP_EOL, FILE_APPEND );


