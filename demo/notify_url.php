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

use johnxu\payment\Payment;

require '../vendor/autoload.php';

$config = require './config.php';
\johnxu\tool\Config::getInstance()->batch( $config );

// 支付宝的验签流程
/*try
{
    $res = Payment::getInstance()->verify()->notify();

    if ( $res )
    {
        // TODO: 验签通过

// 验证签名
    }
    file_put_contents( './notify_data.txt', json_encode( $res, JSON_UNESCAPED_UNICODE ) . PHP_EOL, FILE_APPEND );
}
catch ( \johnxu\payment\Exception $e )
{
    var_dump( $e->getMessage() );
}*/

// 微信的验签流程
// 解析xml数据为对象
try
{
    $res = Payment::getInstance()->verify( 'wxpay' )->notify();

    if ( $res ) // 校验通过才会执行
    {
        file_put_contents( './notify_data.txt', json_encode( $res, JSON_UNESCAPED_UNICODE ) . PHP_EOL, FILE_APPEND );
    }
}
catch ( \johnxu\payment\Exception $e )
{
}

// 一定要输入SUCCESS，不然微信服务器一直往这儿发请求
// echo 'SUCCESS';




