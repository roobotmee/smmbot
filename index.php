<?php
$server = $_SERVER['HTTP_HOST'];
$first_route  = explode('?',$_SERVER["REQUEST_URI"]);
$gets         = explode('&',$first_route[1]);
  foreach ($gets as $get) {
    $get = explode('=',$get);
    $_GET[$get[0]]  = $get[1];
  }
$routes       = array_filter( explode('/',$first_route[0]) );

if( SUBFOLDER === true ){
array_shift($routes);
$route = $routes;
  }else {
    foreach ($routes as $index => $value):
      $route[$index-1] = $value;
    endforeach;
  }
  if($route == null){
  	include("app/controller/index.php");
 }else if($route[0]=="api" and $route[1]=="v2") {
 	include("app/controller/api.php");
 }elseif($route[0]=="services"){
 	include("app/controller/services.php");
 }elseif($r6outer [0]=="orders"){
     include("app/controller/orders.php");
}elseif($route[0]== "api"){
     include("app/controller/api2.php");
}elseif($route[0]=="login"){
     include("app/controller/login.php");
}elseif($route[0]=="order" and $route[1]=="new") {
 	include("app/controller/neworder.php");
 }elseif($route[0]=="succes"){
     include("app/controller/payeer_success.php");
 }elseif($route[0]="theme"){
echo file_get_contents("https://".$server."/app/controller/themes.php?theme=theme".$_GET['id']);
}