<?php
header('Content-type: application/json');
require ("../app/controller/sql_connect.php");



function get($h){
return file_get_contents($h);
}

$request= get("https://tezgram.uz/bot/average.php");
if($request=="saved"){

$yu = mysqli_query($connect,"SELECT * FROM services WHERE service_edit = 'true'");
while($do = mysqli_fetch_assoc($yu)){
$prv = $do['api_service'];

$j=json_decode(get("copies/".$prv.".txt"),1);
foreach($j as $ve){
if($ve['service']==$do['service_api']){

$min = $ve['min'];
$max = $ve['max'];
$rate = $ve['rate'];
$doi = $do['service_id'];

if($do['api_currency']=="USD"){
$fr=get("set/usd");
}elseif($do['api_currency']=="RUB"){
$fr=get("set/rub");
}elseif($do['api_currency']=="INR"){
$fr=get("set/inr");
}elseif($do['api_currency']=="TRY"){
$fr=get("set/try");
}elseif($do['api_currency']=="UZS"){
$fr = 1;
}
$foiz=mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM percent WHERE id = 1"))['percent'];
$rate=$rate*$fr;
$rp=$rate/100;
$rp=$rp*$foiz+$rate;
mysqli_query($connect,"UPDATE services SET service_min='$min', service_max='$max' WHERE service_id=$doi");
if($do['service_price']!="$rp"){
mysqli_query($connect,"UPDATE services SET service_price='$rp' WHERE service_id=$doi");
$aray []=['service_id'=>$doi,"new_order_price"=>$rp,"new_order_min"=>$min,"new_order_max"=>$max];

 }
}
}
}

$arr = ['status'=>true,"cron"=>"Synchronize service: min, max, price",'updates'=>$aray];
echo json_encode($arr,JSON_PRETTY_PRINT);
}