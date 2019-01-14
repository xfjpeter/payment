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

/*echo '<pre>';
print_r( $_GET );
echo '</pre>';*/

$config = require './config.php';
\johnxu\tool\Config::getInstance()->batch( $config );

// 校验签名
// var_dump( \johnxu\payment\alipay\Support::verifySignature( $_GET, $_GET['sign'], true, true ) );


// 支付宝的验签流程
// 校验签名:通过返回数据，没通过返回false
/*try
{
    var_dump( Payment::getInstance()->verify()->return() );
}
catch ( \johnxu\payment\Exception $e )
{
    var_dump( $e->getMessage() );
}*/

// 微信的验签流程
echo '<pre>';
print_r( $_GET );
echo '</pre>';
