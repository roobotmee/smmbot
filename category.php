<?php
ob_start();



require("app/controller/sql_connect.php");

$category = $_REQUEST['category'] ?? 1;
$type = $_REQUEST['type'] ?? "category";

if($type == 'category'){

$tariffs = $connect->query("SELECT * FROM `services` WHERE `category_id` = '$category' AND `service_status` = 'on'");

$data = [];

while($row = $tariffs->fetch_assoc())
{
    $data[] = [
         'id' => $row['service_id'],
         'price'=>$row['service_price'],
         'average'=>$row['service_average'],
         'desc'=>strip_tags(base64_decode($row['service_desc'])),
         'name' => base64_decode($row['service_name']),
         'type' => $row['service_type'],
         'min' => $row['service_min'],
         'max' => $row['service_max']
        ];
}

}else{
    $service_id = $_REQUEST['service_id'];
    $tariff = $connect->query("SELECT * FROM `services` WHERE `service_id` = '$service_id' AND `service_status` = 'on'")->fetch_assoc();
    $data = [
         'id' => $tariff['service_id'],
         'price'=>$tariff['service_price'],
         'average'=>$tariff['service_average'],
         'desc'=>strip_tags(base64_decode($tariff['service_desc'])),
         'name' => base64_decode($tariff['service_name']),
         'type' => $tariff['service_type'],
         'min' => $tariff['service_min'],
         'max' => $tariff['service_max']
        ];
}

if($type == "price") {
	$service_id = $_REQUEST['service_id'];
    $tariff = $connect->query("SELECT * FROM `services` WHERE `service_id` = '$service_id' AND `service_status` = 'on'")->fetch_assoc();
    $data = [
         
         'price'=>$tariff['service_price']/1000*$_REQUEST['quantity'],
         
        ];
}

header('Content-type: application/json');

echo json_encode(['data' => $data]);
