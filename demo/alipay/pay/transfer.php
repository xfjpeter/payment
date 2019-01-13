<?php
/**
 * | ---------------------------------------------------------------------------------------------------
 * | Author：johnxu <fsyzxz@163.com>.
 * | ---------------------------------------------------------------------------------------------------
 * | Home: https://www.johnxu.net.
 * | ---------------------------------------------------------------------------------------------------
 * | Data: 2019/1/11
 * | ---------------------------------------------------------------------------------------------------
 * | Desc: 转账到个人
 * | ---------------------------------------------------------------------------------------------------
 * | Doc：https://docs.open.alipay.com/api_28/alipay.fund.trans.toaccount.transfer/
 * | ---------------------------------------------------------------------------------------------------
 */

require '../../../vendor/autoload.php';

use johnxu\tool\Config;
use johnxu\payment\Payment;

$config = require '../../config.php';

try
{
    $alipay = Payment::getInstance( $config )->pay( 'alipay' );

    $payment = $alipay->transfer( array(
        'out_biz_no'    => uniqid(),
        'amount'        => '0.1', // 转账金额
        'payee_account' => 'hlwvaw9112@sandbox.com', // 收款方帐号
    ) );

    echo '<pre>';
    print_r( $payment );
    echo '</pre>';

}
catch ( \johnxu\payment\Exception $e )
{
}


/**
 * 转账成功
 * stdClass Object
 * (
 * [alipay_fund_trans_toaccount_transfer_response] => stdClass Object
 * (
 * [code] => 10000
 * [msg] => Success
 * [order_id] => 20190112110070001502950000165703
 * [out_biz_no] => 5c3a0e7cd9d97
 * [pay_date] => 2019-01-12 23:57:49
 * )
 *
 * [sign] => nU3T/VMY0zpig8RAAvxecXvWt+XpvT3vYynfDELg2HfWBHggzIOtgv5SqhbprL3SWnMwGl3CnPxcPUFLLKzS9tNQSYOL320IxbQ11GO68pw8A/DcGmupNQpCCcuirTE3t8NKApTt0pY0Fon/j8NFU5bcdIHOtv/XIwdrqaW2alcFlPgTqRXv5G6rj8uoQey+emOX1vBlJqZWfP+b37WBZK/VQzRm57x7xkYsQxS99oCsW67KV2crPluaFaDlDXN76ciTJE3KqH2BRTZ78V9y1I9+1AivKFRRR4CgbOVoTfT8CNsYOp9SQYngNxekxC12KK0OCzfL6BXweDns6lLJhw==
 * )
 */


