<?php
require ("../app/controller/sql_connect.php");
	
$mysql=mysqli_query($connect,"SELECT * FROM `providers`");
while($a=mysqli_fetch_assoc($mysql)){
	$id = $a['id'];
	$url = $a['api_url'];
	$key = $a['api_key'];
	
$file = file_get_contents($url."?key=".$key."&action=services");

$ok = file_put_contents("copies/$id.txt",$file);

}
if($ok){
	echo "saved";
	}