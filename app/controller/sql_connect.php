<?php
ob_start();
define("DB_SERVER","localhost"); 
define("DB_USERNAME","roo337_twopenel"); 
define("DB_PASSWORD","kX6cA7mZ8y"); 
define("DB_NAME","roo337_twopenel");

$connect = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
mysqli_set_charset($connect,"utf8mb4");
$bot = "RunSmmBot";
$th = mysqli_query($connect,"SELECT * FROM `settings` WHERE id = 1");
$row = mysqli_fetch_assoc($th);
$theme = $row['site_theme'];
$style =$row['site_style'];

?>