<?
header('Content-type: application/json');
require ("../app/controller/sql_connect.php");



$my = mysqli_query($connect,"SELECT * FROM myorder WHERE user_id = '6503193171'");

while($a = mysqli_fetch_assoc($my)){
$array[]=['id'=>$a['order_id']];



}




$jsonData = json_encode($array);;
$dataArray = json_decode($jsonData, true);

if ($dataArray !== null) {
    $reversedData = array_reverse($dataArray);
    $reversedJson = json_encode($reversedData);

    if ($reversedJson !== false) {
        echo $reversedJson;
    } else {
        echo "JSON ma'lumotlarini qaytadan o'rgatib bo'lmadi.";
    }
} else {
    echo "JSON ma'lumotlarini o'qib olishda xatolik yuz berdi.";
}
