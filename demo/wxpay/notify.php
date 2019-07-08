<?php

use johnxu\payment\Exception;

require '../../../vendor/autoload.php';

$config = require '../../config.php';
\johnxu\tool\Config::getInstance()->batch($config);
$payment = \johnxu\payment\Payment::getInstance();

try {
  $payment->verify('wxpay')->notify();
} catch (Exception $e) {
  var_dump($e->getMessage());
}

$payment->response('wxpay')->send();
