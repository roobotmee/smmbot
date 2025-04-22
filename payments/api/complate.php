<?php
header('Content-type: application/json');
define('API_KEY',"6700959176:AAEIdsoLsbxrC2dEKrfAidkmHTE7U4IpsIQ");

$connect = new mysqli('localhost','ali609_tezgramuz','pF7sP4kK2o','ali609_tezgramuz');

function check($check){
$checks = file_get_contents("checks.txt");
if(mb_stripos($checks,$check)!==false){
return false;
}else{
return true;
}
}

function user($cid){
global $connect;
$result = mysqli_query($connect, "SELECT * FROM users WHERE user_id = $cid");
$row = mysqli_fetch_assoc($result);
return $row;
}


$get = $_REQUEST;

if($get['merchant_trans_id'] and $get['error_note']=="Success" and $get['click_trans_id'] and $get['amount'] and $get['sign_string'] and $get['sign_time']){
if(check($get['click_trans_id'])==true){
file_put_contents("checks.txt","\n".$get['click_trans_id'],FILE_APPEND);
$comment =$get['merchant_trans_id'];
$amount = $get['amount'];

$a = user($comment);
$id = $a['id'];
$put = $a['balance']+$amount;

$connect->query("UPDATE `users` SET `balance` = '$put' WHERE `user_id` = '$comment'");
file_get_contents("https://api.telegram.org/bot".API_KEY."/sendMessage?chat_id=$id&text=".urlencode("💳 Hisobingizga $amount so'm qo'shildi.")."");

$res = [
'click_trans_id'=>$get[click_trans_id],
'merchant_trans_id'=>(int)$get[merchant_trans_id],
'error'=>0,
'error_note'=>$get['error_note'],
'merchant_confirm_id'=>(int)rand(38,91071)
];

echo json_encode($res,JSON_PRETTY_PRINT);
}
}


