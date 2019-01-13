<?php
/**
 * | ---------------------------------------------------------------------------------------------------
 * | Author：johnxu <fsyzxz@163.com>.
 * | ---------------------------------------------------------------------------------------------------
 * | Home: https://www.johnxu.net.
 * | ---------------------------------------------------------------------------------------------------
 * | Data: 2019/1/11
 * | ---------------------------------------------------------------------------------------------------
 * | Desc: 电脑端支付
 * | ---------------------------------------------------------------------------------------------------
 * | Doc：https://docs.open.alipay.com/270/alipay.trade.page.pay
 * | ---------------------------------------------------------------------------------------------------
 */

require '../../../vendor/autoload.php';

use johnxu\tool\Config;
use johnxu\payment\Payment;

$config = require '../../config.php';

// Config::getInstance()->set( 'alipay', $config['alipay'] );

/*Config::getInstance()->set( 'wx', array( 'url' => 'http://www.baidu.com' ) );

print_r( Config::getInstance()->get( 'wx.url' ) );*/

/*$signature = \johnxu\payment\alipay\Support::signature(
    array(
        'app_id'      => Config::getInstance()->get( 'alipay.app_id' ),
        'method'      => 'alipay.trade.page.pay',
        'format'      => 'json',
        'charset'     => Config::getInstance()->get( 'alipay.charset' ),
        'sign_type'   => Config::getInstance()->get( 'alipay.sign_type' ),
        'timestamp'   => date( 'Y-m-d H:i:s' ),
        'version'     => '1.0',
        'biz_content' => ''
    )
);*/
try
{
    $alipay = Payment::getInstance( $config )->pay( 'alipay' );

    $payment = $alipay->web( array(
        'out_trade_no' => uniqid(),
        'total_amount' => '0.01',
        'subject'      => '测试支付',
        'qr_pay_mode'  => 4,
        'qrcode_width' => 200
    ) );
}
catch ( \johnxu\payment\Exception $e )
{
}






