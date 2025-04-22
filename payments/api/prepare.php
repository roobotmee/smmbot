<?php
header('Content-type: application/json');
$get = $_REQUEST;

$res = [
'click_trans_id'=>(int)$get['click_trans_id'],
'merchant_trans_id'=>(int)$get['merchant_trans_id'],
'error'=>0,
'error_note'=>"Success",
'merchant_prepare_id'=>(int)rand(34,98298)
];
echo json_encode($res,JSON_PRETTY_PRINT);