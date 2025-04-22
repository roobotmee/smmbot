<?php
$m_shop = '2072164879';
$m_orderid = $_GET['order_id'];
$amount = $_GET['amount'];
$m_amount = number_format($amount, 2, '.', '');
$comment = $_GET['desc'];
$m_curr = $_GET['curr'];
$m_desc = base64_encode($comment);
$m_key = 'Gpp2S31BArPAfU29';

$arHash = array(
  $m_shop,
  $m_orderid,
  $m_amount,
  $m_curr,
  $m_desc
);

/*
$arParams = array(
  'success_url' => 'http://neosmm.uz/new_success_url',
  //'fail_url' => 'http://neosmm.uz/new_fail_url',
  //'status_url' => 'http://neosmm.uz/new_status_url',
  'reference' => array(
    'var1' => '1',
    //'var2' => '2',
    //'var3' => '3',
    //'var4' => '4',
    //'var5' => '5',
  ),
  //'submerchant' => 'mail.com',
);

$key = md5('Ключ для шифрования дополнительных параметров'.$m_orderid);

$m_params = @urlencode(base64_encode(openssl_encrypt(json_encode($arParams), 'AES-256-CBC', $key, OPENSSL_RAW_DATA)));

$arHash[] = $m_params;
*/

$arHash[] = $m_key;

$sign = strtoupper(hash('sha256', implode(':', $arHash)));

echo "https://payeer.com/merchant/?m_shop=$m_shop&m_orderid=$m_orderid&&m_amount=$m_amount&m_curr=$m_curr&m_desc=$m_desc&m_sign=$sign";
?>