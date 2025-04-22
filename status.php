<?php
define("DB_SERVER","localhost"); 
define("DB_USERNAME","ali609_tezgramuz"); 
define("DB_PASSWORD","pF7sP4kK2o"); 
define("DB_NAME","ali609_tezgramuz");
$site_url = $_SERVER['HTTP_HOST'];
$connect = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
mysqli_set_charset($connect,"utf8mb4");

define('API_KEY',"6700959176:AAEIdsoLsbxrC2dEKrfAidkmHTE7U4IpsIQ");

function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}

if (!in_array($_SERVER['REMOTE_ADDR'], array('185.71.65.92', '185.71.65.189', '149.202.17.210'))) return;

if (isset($_POST['m_operation_id']) && isset($_POST['m_sign']))
{
	$m_key = 'Gpp2S31BArPAfU29';

	$arHash = array(
		$_POST['m_operation_id'],
		$_POST['m_operation_ps'],
		$_POST['m_operation_date'],
		$_POST['m_operation_pay_date'],
		$_POST['m_shop'],
		$_POST['m_orderid'],
		$_POST['m_amount'],
		$_POST['m_curr'],
		$_POST['m_desc'],
		$_POST['m_status']
	);

	if (isset($_POST['m_params']))
	{
		$arHash[] = $_POST['m_params'];
	}

	$arHash[] = $m_key;

	$sign_hash = strtoupper(hash('sha256', implode(':', $arHash)));

	if ($_POST['m_sign'] == $sign_hash && $_POST['m_status'] == 'success')
	{
	    $dcur = $_POST['m_curr'];
	    $d_amount = $_POST['m_amount'];
	    if($dcur == "USD"){
	       $usdkurs=file_get_contents("bot/set/usd");
	    $miqdor = $d_amount*$usdkurs;
	    }elseif($dcur == "RUB"){
	        $rubkurs=file_get_contents("bot/set/rub");
	    $miqdor = $d_amount*$rubkurs;
	    }
	    $usid = base64_decode($_POST['m_desc']);
	    $ba = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM users WHERE id = $usid"));
$a = $ba['balance'] + $miqdor;
$b = $ba['outing'] + $miqdor;
mysqli_query($connect,"UPDATE users SET balance = '$a' WHERE id = $usid");
mysqli_query($connect,"UPDATE users SET outing = '$b' WHERE id = $usid");
bot('sendMessage',[
'chat_id'=>$usid,
'text'=>" <b>➕ Hisobingiz to'ldirildi.
💵 To'lov turi: 🅿️ PAYEER (avto)

💰 To'ldirilgan summa: $miqdor so'm</b>",
'parse_mode'=>'html',
]);
bot('sendMessage',[
'chat_id'=>"6097885667",
'text'=>"➕ <b>Foydalanuvchi (<code>$usid</code>) hisobiga $miqdor so'm qo'shildi. ( 🅿️ PAYEER (avto) orqali)</b>",
'parse_mode'=>'html',
]);      
		ob_end_clean(); exit($_POST['m_orderid'].'|success');
	}

	ob_end_clean(); exit($_POST['m_orderid'].'|error');
}
?>