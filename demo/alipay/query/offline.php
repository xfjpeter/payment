<?php
/**
 * | ---------------------------------------------------------------------------------------------------
 * | Author：johnxu <fsyzxz@163.com>.
 * | ---------------------------------------------------------------------------------------------------
 * | Home: https://www.johnxu.net.
 * | ---------------------------------------------------------------------------------------------------
 * | Data: 2019/1/11
 * | ---------------------------------------------------------------------------------------------------
 * | Desc: 统一收单线下交易查询
 * | ---------------------------------------------------------------------------------------------------
 * | Doc：https://docs.open.alipay.com/api_1/alipay.trade.query/
 * | ---------------------------------------------------------------------------------------------------
 */

require '../../../vendor/autoload.php';

use johnxu\tool\Config;
use johnxu\payment\Payment;

$config = require '../../config.php';

try
{
    $alipay = Payment::getInstance( $config )->query( 'alipay' );

    $payment = $alipay->offline( array(
        // 'out_trade_no' => '5c3a122c4f3d6',
        'trade_no' => '2019011222001495370500536138',
        'org_pid'  => '',
    ) );

    echo '<pre>';
    print_r( $payment );
    echo '</pre>';
}
catch ( \johnxu\payment\Exception $e )
{
}



/**
 * 返回错误信息
 * stdClass Object
 * (
 * [alipay_trade_query_response] => stdClass Object
 * (
 * [code] => 40004
 * [msg] => Business Failed
 * [sub_code] => ACQ.TRADE_NOT_EXIST
 * [sub_msg] => 交易不存在
 * [buyer_pay_amount] => 0.00
 * [invoice_amount] => 0.00
 * [out_trade_no] => 5c3a122c4f3d6
 * [point_amount] => 0.00
 * [receipt_amount] => 0.00
 * )
 *
 * [sign] => Sb8Jk7EKLmWl7FIqoq/eQNVmq4Ci0IbXShdNaDNihXcqC1k5ZRMp7ZxCofZb9xm4qPsclN1WtaujdmQLzJXMeqMP8Sstj+eoWGc1Abo9FeLkvkFVhCOnnFl2SgDuBfnQ17GNuzZ3DpRCqs6DJkH00EtvAJ2UQDdoK4pSq8GlvCCgYrvB+QUIIH9wniSxmt1mt0RP/4LtiXsc7Je5tpi0sc3nXwFilSJij5nYwvQ3ciNEHXT9Rdlbr/d7OHQQvqyBN6xTI/+CkCdcY9NcTgNhjuJkyLV/LmRTp/E5y9MbgoeSG26NByGU16aCHVMaczFyNyqzdgwRkD0mULZXeZH3/g==
 * )
 */

/**
 * 查询成功
 * stdClass Object
 * (
 * [alipay_trade_query_response] => stdClass Object
 * (
 * [code] => 10000
 * [msg] => Success
 * [buyer_logon_id] => hlw***@sandbox.com
 * [buyer_pay_amount] => 0.01
 * [buyer_user_id] => 2088102169195376
 * [buyer_user_type] => PRIVATE
 * [fund_bill_list] => Array
 * (
 * [0] => stdClass Object
 * (
 * [amount] => 0.01
 * [fund_channel] => ALIPAYACCOUNT
 * )
 *
 * )
 *
 * [invoice_amount] => 0.01
 * [out_trade_no] => 5c3a067192a43
 * [point_amount] => 0.00
 * [receipt_amount] => 0.01
 * [send_pay_date] => 2019-01-12 23:23:30
 * [total_amount] => 0.01
 * [trade_no] => 2019011222001495370500536138
 * [trade_status] => TRADE_SUCCESS
 * )
 *
 * [sign] => IEqTAHXuo8r70O58+kCJ7H6QSdpGidNw+9u6yEuVEoRUWUacl8oiYAjOaZ+nJl1pxa/XmJ7XiDDAkfTX8mwlNbJ34MaJqg/hmR9wLb0KH5tooEefBj2IG+ALpNFxMBuIgLoCNgloYVWoDtPJGogZufvoiSOJS0cJeKs8KeS3JCFI7ReSDpOfncccMqJD7loLt01wi65U5Sf7nErWbXFGBUJX45WpbfNtZe9MrKAp/PWu6nK7BuBS6hibpGCZuLMdqeRQqOAGGZMLjzLxe7HY5PayVBmc4uooj78ZWOpo/OJc7cyG6qR0pIeN6XXkco61qPvlWp/RvUVw9NjKCix0ng==
 * )
 */


