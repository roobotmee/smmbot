<?php
date_default_timezone_set("Asia/Tashkent");
require("../app/controller/sql_connect.php");

require("mirpay.php");
$time = date('H:i');
ob_start();
define('API_KEY',"7286140147:AAEzofUF0XxgnvknqVMRt8LhkzdF4CWReh0");
$admin="7000454062";
$date_time = date("d.m.Y H:i:s");
$simkey = "Ade5c3089f9e6A2fA8e37ebd96145f7b";
$ff = "35"; 
$simrub = "140"; 
$me = "🔹";
$bot=bot(getMe)->result->username;
$day = date('d');

$mirPay = new MirPay("1243","3cd4006168d9f1bea94e1f7491d44336");
$mirPay->auth();



function enc($var,$exception) {
if($var=="encode"){
return base64_encode($exception);
}elseif($var=="decode"){
return base64_decode($exception);
}
}

function inline($a=[]){
$d=json_encode([
"inline_keyboard"=>$a
]);
return $d;
}
function resize($a=[],$ko=true){
$d=json_encode([
"resize_keyboard"=>$ko,
"keyboard"=>$a
]);
return $d;
}

function encode($var){
	return base64_encode(urlencode($var));
}
function decode($var){
	return htmlspecialchars(urldecode(base64_decode($var)),ENT_QUOTES,'UTF-8');
}

function url_query($url) {
    $qas=array("ssl"=>array("verify_peer"=>false,"verify_peer_name"=>false,),);
    $sf = file_get_contents($url, false, stream_context_create($qas));
    return $sf;
}


function keyboard($a=[]){
$d=json_encode([
inline_keyboard=>$a
]);
return $d;
}

function api_query($s){
$qas = array("ssl"=>array("verify_peer"=>false,"verify_peer_name"=>false));
$content = file_get_contents($s, false, stream_context_create($qas));
return $content ? $content : json_encode(['balance'=>" ?"]);
}



function plusmysql($o,$p){
global $acc;
$db_user = $o;
$db_pass = $p;
$qas = array("ssl"=>array("verify_peer"=>false,"verify_peer_name"=>false,),);
$content = file_get_contents("https://bp.uztan.ru/ispmgr?func=db.edit&username=".$db_user."&name=".$db_user."&password=".$db_pass."&owner=".$isp_user."&confirm=".$db_pass."&type=mysql&remote_access=on&charset=utf8mb4&out=xml&authinfo=".$acc."&sok=ok", false, stream_context_create($qas));
$parse_xml = simplexml_load_string($content);
if(isset($parse_xml->ok)){
$out = array("status"=>"true");
return  json_encode($out);
}else{
$out = array("status"=>"false");
return json_encode($out);
}
}

function arr($p){
$data = json_decode(get("copies/".$p.".txt"),1);
$values=[];
$new_arr = [];
$co=0;
foreach($data as $value){

if(!in_array($value['category'], $new_arr)){
$new_arr[] = $value['category'];
$co++;
$values[] =['id'=>$co,'name'=>$value['category']];
}else{
continue;
}
}
$val = ['count'=>$co,'results'=>$values];
return $values ? json_encode($val) : json_encode(["error"=>1]);
}

function accl($d,$s,$j=false){
return bot('answerCallbackQuery',[
'callback_query_id'=>$d,
'text'=>$s,
'show_alert'=>$j
]);
}

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

function rmdirPro($path){
    $scan = array_diff(scandir($path), ['.','..']);
    foreach($scan as $value){
        if(is_dir("{$path}/{$value}"))
            rmdirPro("{$path}/{$value}");
        else
            @unlink("{$path}/{$value}");
    }
    rmdir($path);
}



function trans($x){
$e = json_decode(file_get_contents("http://translate.googleapis.com/translate_a/single?client=gtx&sl=auto&tl=uz&dt=t&q=".urlencode($x).""),1);
return $e[0][0][0];
}







function number($a){
$form = number_format($a,00,' ',' ');
return $form;
}

function del(){
global $cid,$mid,$chat_id,$message_id;
return bot('deleteMessage',[
'chat_id'=>$chat_id.$cid,
'message_id'=>$message_id.$mid,
]);
}


function edit($id,$mid,$tx,$m){
return bot('editMessageText',[
'chat_id'=>$id,
'message_id'=>$mid,
'text'=>$tx,
'parse_mode'=>"HTML",
'reply_markup'=>$m,
]);
}



function sms($id,$tx,$m){
return bot('sendMessage',[
'chat_id'=>$id,
'text'=>$tx,
'parse_mode'=>"HTML",
'reply_markup'=>$m,
]);
}



function get($h){
return file_get_contents($h);
}

function put($h,$r){
file_put_contents($h,$r);
}

if(get("set/xolat.txt")){
}else{
if(put("set/xolat.txt","✅"));
}




function joinchat($id){
$array = array("inline_keyboard");
$get = file_get_contents("set/channel");
$ex = explode("\n",$get);
$soni = substr_count($get,"@");
if($get == null){
return true;
}else{
for($i=0;$i<=count($ex)-1;$i++){
$first_line = $ex[$i];
$kanall=str_replace("@","",$first_line);
     $ret = bot("getChatMember",[
         "chat_id"=>$first_line,
         "user_id"=>$id,
         ]);
$stat = $ret->result->status;
         if((($stat=="creator" or $stat=="administrator" or $stat=="member"))){
      $array['inline_keyboard']["$i"][0]['text'] = "✅ ".$first_line;
$array['inline_keyboard']["$i"][0]['url'] = "https://t.me/$kanall";
         }else{
$array['inline_keyboard']["$i"][0]['text'] = "❌ ".$first_line;
$array['inline_keyboard']["$i"][0]['url'] = "https://t.me/$kanall";
$uns = true;
}
}
$array['inline_keyboard']["$i"][0]['text'] = "✅ Tekshirish";
$array['inline_keyboard']["$i"][0]['callback_data'] = "result";
if($uns == true){
     bot('sendMessage',[
         'chat_id'=>$id,
         'text'=>"⛔ <b>Botdan foydalanish uchun, quyidagi kanallarga obuna bo'ling:</b>",
'parse_mode'=>html,
'reply_markup'=>json_encode($array),
]);  


}else{
return true;
}
}

}



$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$edituz = $update->callback_query->message->from->id;
$mesuz = $update->callback_query->message->message_id;
$cid = $message->chat->id;
$cidtyp = $message->chat->type;
$miid = $message->message_id;
$name = $message->chat->first_name;
$user1 = $message->from->username;
$tx = $message->text;
$callback = $update->callback_query;
$mmid = $callback->inline_message_id;
$mes = $callback->message;
$mid = $mes->message_id;
$cmtx = $mes->text;
$mmid = $callback->inline_message_id;
$idd = $callback->message->chat->id;
$cbid = $callback->from->id;
$cbuser = $callback->from->username;
$data = $callback->data;
$ida = $callback->id;
$cqid = $update->callback_query->id;
$qid=$cqid;
$cbins = $callback->chat_instance;
$cbchtyp = $callback->message->chat->type;
$step = file_get_contents("step/$from_id.step");
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$mid = $message->message_id;
$msgs = json_decode(file_get_contents('msgs.json'),true);
$data = $update->callback_query->data;
$type = $message->chat->type;
$text = $message->text;
$sd = $message->text;
$uid= $message->from->id;
$gname = $message->chat->title;
$left = $message->left_chat_member;
$new = $message->new_chat_member;
$name = $message->from->first_name;
$bio = $message->from->about;
$repid = $message->reply_to_message->from->id;
$repname = $message->reply_to_message->from->first_name;
$newid = $message->new_chat_member->id;
$leftid = $message->left_chat_member->id;

$botdel = $update->my_chat_member->new_chat_member;
$botdel_id = $update->my_chat_member->from->id;
$userstatus = $botdel->status;

$newname = $message->new_chat_member->first_name;
$leftname = $message->left_chat_member->first_name;
$username = $message->from->username;
$cmid = $update->callback_query->message->message_id;
$cusername = $message->chat->username;
$repmid = $message->reply_to_message->message_id; 
$ccid = $update->callback_query->message->chat->id;
$cuid = $update->callback_query->message->from->id;
$from_id = $message->from->id;
$chat_id = $update->callback_query->message->chat->id;
$message_id = $update->callback_query->message->message_id;
$call = $update->callback_query;
$mes = $call->message;
$data = $call->data;
$qid = $call->id;
$callbackdata = $update->callback_query->data;
$callcid = $mes->chat->id;
$callmid = $mes->message_id;
$callfrid = $call->from->id;
$calluser = $mes->chat->username;
$callfname = $call->from->first_name;
$photo = $message->photo;
$gif = $message->animation;
$video = $message->video;
$music = $message->audio;
$voice = $message->voice;
$sticker = $message->sticker;
$document = $message->document;
$for = $message->forward_from;
$for_id=$for->id;
$contact = $message->contact;
$contactid = $contact->user_id;
$contactuser = $contact->username;
$contactname = $contact->first_name;
$phonenumber = $contact->phone_number;
$cid2=$chat_id;
$mid2=$message_id;
$sana=date("d/m/Y | H:i");

function generate(){
$arr = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','R','S','T','U','V','X','Y','Z','1','2','3','4','5','6','7','8','9','0');
$pass = "";
for($i = 0; $i < 7; $i++){
$index = rand(0, count($arr) - 1);
$pass .= $arr[$index];
}
return $pass;
}




function phone($cid){
global $connect;
$rs = mysqli_query($connect, "SELECT * FROM `phone` WHERE `user_id` = '$cid'");
$rw = mysqli_num_rows($rs);
if($rw){
return true;
}else{
bot("sendMessage",[
    "chat_id"=>$cid,
    "text"=>"<b>Botdan foydalanishni davom ettirish uchun «📲 Telefon raqamni yuborish» tugmasini bosing:</b>",
    "parse_mode"=>"html",
    "reply_markup"=>json_encode([
      "resize_keyboard"=>true,
      "one_time_keyboard"=>true,
      "keyboard"=>[
        [["text"=>"📲 Telefon raqamni yuborish","request_contact"=>true],],
]
]),
]);  
put("user/$cid.step","req_contact");
return false;
}
}

$ddate = date("d/m/Y");
$dresult = mysqli_query($connect, "SELECT * FROM reports WHERE date = '$ddate'");
$drow = mysqli_fetch_assoc($dresult);
if($drow != true){
    mysqli_query($connect,"INSERT INTO reports(`date`) VALUES ('$ddate');");
}

function reports($type,$amount){
    global $connect;
    $date = date("d/m/Y");
    mysqli_query($connect,"UPDATE `reports` SET `$type` = `$type` + '$amount' WHERE `date`='$date'");
}

function adduser($cid){
global $connect;
$result = mysqli_query($connect, "SELECT * FROM users WHERE id = $cid");
$row = mysqli_fetch_assoc($result);
if($row){
mysqli_query($connect,"UPDATE `users` SET `newid`='true' WHERE `id`='$cid'");
}else{
$key = md5(uniqid());
$referal = generate();
$sava = '{"join":"false"}';
reports('users',1);
mysqli_query($connect,"INSERT INTO users(`newid`,`id`,`status`,`balance`,`outing`,`api_key`,`referal`,`free_cate`,`user_detail`,`user_disc`) VALUES ('true','$cid','active','0','0','$key','$referal','false','$sava','false');");
}

}

function user($cid){
global $connect;
$result = mysqli_query($connect, "SELECT * FROM users WHERE id = $cid");
$row = mysqli_fetch_assoc($result);
return $row;
}

if($botdel){
if($userstatus == "kicked"){
$sql = "UPDATE `users` SET `status` = 'deactive' WHERE `id` = '$botdel_id'";
$result = mysqli_query($connect, $sql);
}
}


if(isset($update)) {
$result = mysqli_query($connect,"SELECT * FROM users WHERE id = $cid$chat_id");
$rew = mysqli_fetch_assoc($result);
if($rew['status']=="deactive"){
exit();
}
}



$resu = mysqli_query($connect,"SELECT * FROM `settings`");
$setting = mysqli_fetch_assoc($resu);

mkdir("user");
mkdir("set");


$pul=get("user/$chat_id.pul");
$xolati=get("set/xolat.txt");

$step = get("user/$cid.step");
$stepc = get("user/$chat_id.step");

$ort=json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"➡️ Orqaga"]],
]
]);

$aort=json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄️ Boshqaruv"]],
]
]);



$panel=json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"⚙️ Asosiy sozlamalar"]],
[['text'=>"✉️ Xabar yuborish"],['text'=>"📊 Statistika"]],
[['text'=>"👤 Foydalanuvchi"],['text'=>"⏰ Cron"]],
[['text'=>"🇺🇿 Valyuta"],['text'=>"🛍 Chegirmalar"]],
[['text'=>"🤖 Bot holati"]],
[['text'=>"📞 Nomer API balans"]],
[['text'=>"➡️ Orqaga"]],
]]);

if($text == "🛍 Chegirmalar" and $cid==$admin){
sms($cid,"<b>$text - bo'limi kerakli menuni tanlang:</b>",inline([
[['text'=>"🛒 Chegirma qo‘shish",'callback_data'=>"chegirma=add"]],
]));
}
$m = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM percent WHERE id = 1"))['percent'];
$max = $m-1;
if($data == "chegirma=add" and $chat_id == $admin){





for($i=1;$i<=$max;$i++){
$k[]=['text'=>$i];
}
$keys=array_chunk($k,6);
$keys[] = [['text'=>"🗄️ Boshqaruv"]];
$fgh=json_encode([
'resize_keyboard'=>true,
'keyboard'=>$keys
]);
	
sms($cid2,"<b>➡️ Chegirma miqdorini kiriting:

⚠️ Maksimal kiritish: $max%</b>",$fgh);
put("user/$cid2.step","chegirma1");
}

if($step=="chegirma1" and $text<=$max and is_numeric($text)==1){
sms($cid,"💵 Chegirma narxini kiriting:",$aort);
$upx = json_decode(get("set/chegirma"),1);
$upx['count']=$text;
file_put_contents("set/chegirma",json_encode($upx,JSON_PRETTY_PRINT));
put("user/$cid.step","chegirma2");
}
if($step=="chegirma2" and is_numeric($text)==1){

$max = 31;define('max',$max);
for($i=1;$i<=$max;$i++){
$k[]=['text'=>$i];
}
$keys=array_chunk($k,7);
$keys[] = [['text'=>"🗄️ Boshqaruv"]];
$fgh=json_encode([
'resize_keyboard'=>true,
'keyboard'=>$keys
]);

sms($cid,"📅 Amal qilish muddatini kiriting:

⚠️ Maksimal muddat: ".max." kun",$fgh);
$upx = json_decode(get("set/chegirma"),1);
$upx['price']=floor($text);
file_put_contents("set/chegirma",json_encode($upx,JSON_PRETTY_PRINT));
put("user/$cid.step","chegirma3");
}

if($step=="chegirma3" and $text<=31 and is_numeric($text)==1){
sms($cid,"📋 Chegirma xaqida bir qancha malumotlar kiriting:",null);
$upx = json_decode(get("set/chegirma"),1);
$upx['expire']=floor($text);
file_put_contents("set/chegirma",json_encode($upx,JSON_PRETTY_PRINT));
put("user/$cid.step","chegirma4");
}

if($step=="chegirma4"){
$upx = json_decode(get("set/chegirma"),1);
$upx['about']=$text;
file_put_contents("set/chegirma",json_encode($upx,JSON_PRETTY_PRINT));
put("user/$cid.step","chegirma4");

sms($cid,"
📋 Ma'lumotlarni o‘qib chiqing:

⭐ Chegirma: <b>-".$upx['count']."%</b>
💵 Narxi: <b>".$upx['price']." so‘m</b>
📅 Muddati: <b>".$upx['expire']." kun</b>

<i>".$upx['about']."</i>
",inline([

[['text'=>"✅ Tasdiqlash",'callback_data'=>"addnewdiscount"]],
[['text'=>"❌ O‘chirish",'callback_data'=>"dabsds"]]
]));
put("user/$cid.step","chegirma5");
}

if($data == "addnewdiscount" and $chat_id==$admin){
accl($qid,"⏫ Serverga yuklanmoqda...");
del();
$upx = json_decode(get("set/chegirma"));
$upx->about = base64_encode($upx->about);
if($connect->query("INSERT INTO chegirma(`price`,`count`,`expire`,`about`) VALUES ('$upx->price','$upx->count','$upx->expire','$upx->about')")===TRUE){
sms($cid2,"✅ Malumotlarni saqlash jarayoni tugallandi.",$panel);
unlink("user/$cid2.step");
}else{
sms($cid2,"⚠️ Xatolik yuz berdi.

".$connect->error."",null);
}
}elseif($data == "dabsds") {
	sms($cid2,"🗄️ Boshqaruv",$panel);
	unlink("user/$cid2.step");
	del();
	}

if($xolati=="❌"){
if($data){
if($cid2==$admin){
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$qid,
'text'=>"⛔️ Bot vaqtinchalik o'chirilgan!

Botda ta'mirlash ishlari olib borilayotgan bo'lishi mumkin!",
'show_alert'=>true,
]);
exit();
}
}elseif($text){
if($cid==$admin){
}else{
sms($cid,"⛔️ Bot vaqtinchalik o'chirilgan!

Botda ta'mirlash ishlari olib borilayotgan bo'lishi mumkin!",null);
exit();
}
}
}

if($text=="🤖 Bot holati" and $cid==$admin){
if($xolati=="✅"){$button="❌ O'chirish";
}elseif($xolati=="❌"){$button="✅ Yoqish";}
sms($cid,"<b>🔎 Joriy xolat:</b> $xolati",json_encode(['inline_keyboard'=>[
[['text'=>"$button",'callback_data'=>"xoli"]],
]]));
}

if($data=="botholati"){
if($xolati=="✅"){$button="❌ O'chirish";
}elseif($xolati=="❌"){$button="✅ Yoqish";}
edit($cid2,$mid2,"<b>🔎 Joriy xolat:</b> $xolati",json_encode(['inline_keyboard'=>[
[['text'=>"$button",'callback_data'=>"xoli"]],
]]));
}

if($data=="xoli"){
if($xolati=="❌"){$put="✅";
}elseif($xolati=="✅"){$put="❌";}
del();
sms($cid2,"<b>🤖 Bot ".str_replace(["❌","✅"],["o'chirildi!","yoqildi!"],$put)."</b>",json_encode(['inline_keyboard'=>[
[['text'=>"⏩ Orqaga",'callback_data'=>"botholati"]],
]]));
put("set/xolat.txt",$put);
}

if($text=="⏰ Cron" and $cid==$admin){
sms($cid,"<b>⏰ Quyidagi manzillarni cron qiling!</b>

<b>https://".$_SERVER['SERVER_NAME']."".$_SERVER['SCRIPT_NAME']."?update=send</b>
 <b>- Pochta xabari uchun cron (1 daqiqa)</b>

 <b>https://".$_SERVER['SERVER_NAME']."".$_SERVER['SCRIPT_NAME']."?update=status</b>
<b>- Buyurtma xolati uchun cron (2 daqiqa)</b>

<b>https://".$_SERVER['SERVER_NAME']."/".str_replace(["/","bot.php"],["",""],$_SERVER['PHP_SELF'])."/update.php</b>
 <b>- Narxlarni avtomatik yangilash uchun cron (1 daqiqa)</b>

<b>https://".$_SERVER['SERVER_NAME']."".$_SERVER['SCRIPT_NAME']."?update=discount</b>
 <b>- Chegirmalarni avtomatik xisoblash (1 daqiqa)</b>
 
 <b>https://".$_SERVER['SERVER_NAME']."/".str_replace(["/","bot.php"],["",""],$_SERVER['PHP_SELF'])."/average.php</b>
 <b>- Provayderni avtomatik saqlash (Pravayder ulansa)</b>
",$panel);

}

if($text=='/soati'){


bot("sendMessage",[
    "chat_id"=>$cid,
    "text"=>"Raqamingizni yuboring",
    "parse_mode"=>"html",
    "reply_markup"=>json_encode([
      "resize_keyboard"=>true,
      "one_time_keyboard"=>true,
      "keyboard"=>[
        [["text"=>"📲 Telefon raqamni yuborish","request_contact"=>true],],
]
]),
]);  
put("user/$cid.step","soati");


}



$menu=json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"📞 Nomer olish"],['text'=>"💡 Xizmatlar"]],
[['text'=>"🛒 Buyurtmalar"],['text'=>"💳 Hisobim"]],
[['text'=>"💵 Pul kiritish"],['text'=>"🗣️ Referal"]],
[['text'=>"📕 Qo'llanma"],['text'=>"☎️ Qo'llab-quvvatlash"]],
//*[['text'=>"🤝 Hamkorlik dasturi"]],
]
]);

$menu_p=json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"📞 Nomer olish"],['text'=>"💡 Xizmatlar"]],
[['text'=>"🛒 Buyurtmalar"],['text'=>"💳 Hisobim"]],
[['text'=>"💵 Pul kiritish"],['text'=>"🗣️ Referal"]],
[['text'=>"📕 Qo'llanma"],['text'=>"☎️ Qo'llab-quvvatlash"]],
//*[['text'=>"🤝 Hamkorlik dasturi"]],
[['text'=>"🗄️ Boshqaruv"]],
]
]);


/*
if($text== "🤖 SMM Bot"){
sms($cid, "⚠️ Ushbu bolim vaqtincha ishlamaydi ",null);
exit;
}*/
if($cid==$admin or $chat_id==$admin){
$m=$menu_p;
}else{
$m=$menu;
}

if($text=="🗄️ Boshqaruv" and $cid==$admin){
sms($cid,"<b>🖥️ Boshqaruv paneli</b>",$panel);
unlink("user/$cid.step");
exit;
}

if($text=="📊 Statistika" and $cid==$admin){
$stat=0;
$res = mysqli_query($connect, "SELECT * FROM users");
$stat = mysqli_num_rows($res);
$resi = mysqli_query($connect, "SELECT * FROM orders");
$stati = mysqli_num_rows($resi);
$ac =0;
$dc =0;
$pc =0;
$cc =0;
$bc =0;
$fc =0;
$jc =0;
$ppc=0;
$cp=0;
$stati ? $stati = $stati : $stati = "0";
while($hi=mysqli_fetch_assoc($resi)){
if($hi['status']=="Pending") {
$pc++;
}elseif($hi['status']=="Completed"){
$cc++;
}elseif($hi['status']=="Canceled") {
$bc++;
}elseif($hi['status']=="Failed"){
$fc++;
}elseif($hi['status']=="In progress"){
$jc++;
}elseif($hi['status']=="Partial"){
$ppc++;
}elseif($hi['status']=="Processing"){
$cp++;
}
}

while($h=mysqli_fetch_assoc($res)){
if($h['status']=="active") {
$ac++;
}elseif($h['status']=="deactive"){
$dc++;
}
}
$seco=0;
$resit= mysqli_query($connect, "SELECT * FROM services");
$seco = mysqli_num_rows($resit);


$phs = mysqli_query($connect, "SELECT * FROM phone");
while($da=mysqli_fetch_assoc($phs)){

if($da[phone]['0']=='9' and $da[phone]['2']=='8') {
if(strlen($da[phone])==12){
$uzb++;
}
}elseif($da[phone]['0']=='7') {
if(strlen($da[phone])==11){
$rus++;
}
}elseif($da[phone]['0']=='1') {
if(strlen($da[phone])==11){
$usa++;
}
}else{
$bosh++;
}
}
$da = date("d/m/Y");

$s_payments = number_format(mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM reports WHERE date = '$da'"))['payments'],2,"."," ");
$s_spents = number_format(mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM reports WHERE date = '$da'"))['spents'],2,"."," ");

$result = mysqli_query($connect, 'SELECT SUM(retail) AS price FROM myorder');
$row = mysqli_fetch_assoc($result);
$y_spents = number_format($row['price'],2,"."," ");

sms($cid,"<b>📊 Bot statistikasi:</b>
<b>• Jami foydalanuvchilar: $stat ta</b>

<b>🛒 Barcha buyurtmalar:</b>
<b>• Jami buyurtmalar: $stati ta</b>
<b>• Bajarilgan buyurtmalar: $cc ta</b>
<b>• Kutilayotgan buyurtmalar: $pc ta</b>
<b>• Jarayondagi buyurtmalar: $jc ta</b>
<b>• Bekor qilingan buyurtmalar: $bc ta</b>
<b>• Muvaffaqiyatsiz buyurtmalar: $fc ta</b>
<b>• Qisman bajarilgan buyurtmalar: $ppc ta</b>
<b>• Qayta ishlangan buyurtmalar: $cp ta</b>

<b>📊 Raqamlar</b>
<b>• 🇺🇿 O’zbekiston: $uzb ta</b>
<b>• 🇷🇺 Rossiya: $rus ta</b>
<b>• 🇺🇸 Amerika: $usa ta</b>
<b>• 🔄 Boshqa: $bosh ta</b>

<b>📊 Xizmatlar</b>:
<b>• Barcha xizmatlar: $seco ta</b>

<b>• Aylanma: $s_spents so'm</b>
<b>• Jami aylanma: $y_spents so'm</b>\n
<b>🕓 $da bo'yicha ma'lumot.</b>",keyboard([
//*[['text'=>"🏆 TOP 100 Balans",'callback_data'=>"preyting"]],
[['text'=>"♻️ Buyurtmalar xolatini yangilash",'callback_data'=>"update=orders"]],
[['text'=>"🔙 Orqaga",'callback_data'=>"menu"]],
]));
unlink("user/$cid.step");

}

if((stripos($data,"update=")!==false)){
$resi = mysqli_query($connect, "SELECT * FROM orders");
$stati = mysqli_num_rows($resi);
$ac =0;
$dc =0;
$pc =0;
$cc =0;
$bc =0;
$fc =0;
$jc =0;
$cp =0;
$ppc=0;

$stati ? $stati = $stati : $stati = "0";
while($hi=mysqli_fetch_assoc($resi)){
if($hi['status']=="Pending") {
$pc++;
}elseif($hi['status']=="Completed"){
$cc++;
}elseif($hi['status']=="Canceled") {
$bc++;
}elseif($hi['status']=="Failed"){
$fc++;
}elseif($hi['status']=="In progress"){
$jc++;
}elseif($hi['status']=="Processing"){
$cp++;
}elseif($hi['status']=="Partial"){
$ppc++;
}
}
	
$res = explode("=", $data)[1];
if($res=="orders") {

del();
sms($cid2,"
<b>📊 Buyurtmalar ro'yxati:</b>

<b>• Jami buyurtmalar: $stati ta</b>
<b>• Bajarilgan buyurtmalar: $cc ta</b>
<b>• Kutilayotgan buyurtmalar: $pc</b> 
<b>• Jarayondagi buyurtmalar: $jc ta</b>
<b>• Bekor qilingan buyurtmalar: $bc ta</b>
<b>• Muvaffaqiyatsiz buyurtmalar: $fc ta</b>
<b>• Qisman bajarilgan buyurtmalar: $ppc ta</b>
<b>• Qayta ishlangan buyurtmalar: $cp ta</b>
",keyboard([
[['text'=>"Kutilayotgan buyurtmalarni yangilash",'callback_data'=>"update=pending"]],
[['text'=>"Jarayondagi buyurtmalarni yangilash",'callback_data'=>"update=In progress"]],
[['text'=>"Qisman bajarilgan buyurtmalarni yangilash",'callback_data'=>"update=partial"]],
[['text'=>"Qayta ishlangan buyurtmalarni yangilash",'callback_data'=>"update=processing"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"menu"]],
]));
}elseif($res=="pending"){
del();
sms($cid2,"
<b>📊 Buyurtmalar ro'yxati:</b>

<b>• Kutilayotgan buyurtmalar: $pc ta</b>",keyboard([
[['text'=>"Bajarilgan xolatga o‘tkazish",'callback_data'=>"update=new=Pending=Completed"]],
[['text'=>"Jarayondagi xolatga o‘tkazish",'callback_data'=>"update=new=Pending=In progress"]],
[['text'=>"Orqaga",'callback_data'=>"update=orders"]],
]));
}elseif($res=="processing"){
del();
sms($cid2,"
<b>📊 Buyurtmalar ro'yxati:</b>

<b>• qayta ishlangan buyurtmalar: $cp ta</b>",keyboard([
[['text'=>"Bajarilgan xolatga o‘tkazish",'callback_data'=>"update=new=Processing=Completed"]],
[['text'=>"Jarayondagi xolatga o‘tkazish",'callback_data'=>"update=new=Processing=In progress"]],
[['text'=>"Orqaga",'callback_data'=>"update=orders"]],
]));
}elseif($res=="partial"){
del();
sms($cid2,"
<b>📊 Buyurtmalar ro'yxati:</b>

<b>• Qisman bajarilgan buyurtmalar: $ppc ta</b>",keyboard([
[['text'=>"Bajarilgan xolatga o‘tkazish",'callback_data'=>"update=new=Partial=Completed"]],
[['text'=>"Jarayondagi xolatga o‘tkazish",'callback_data'=>"update=new=Partial=In progress"]],
[['text'=>"Orqaga",'callback_data'=>"update=orders"]],
]));
}elseif($res=="In progress"){
del();
sms($cid2,"
<b>📊 Buyurtmalar ro'yxati:</b>

<b>• Jarayondagi buyurtmalar: $jc ta</b>",keyboard([
[['text'=>"Bajarilgan xolatga o‘tkazish",'callback_data'=>"update=new=In progress=Completed"]],
[['text'=>"Kutilayotgan xolatga o‘tkazish",'callback_data'=>"update=new=In progress=Pending"]],
[['text'=>"Orqaga",'callback_data'=>"update=orders"]],
]));
}elseif($res=="new"){
$out = explode("=",$data)[2];
$inp = explode("=",$data)[3];
$mysqli = mysqli_query($connect, "SELECT * FROM orders WHERE status = '$out'");
while($all = mysqli_fetch_assoc($mysqli)){
$io = $all['order_id'];

$mysa=mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `myorder` WHERE order_id=$io"));
$adm=$mysa['user_id'];

mysqli_query($connect,"UPDATE orders SET status ='$inp' WHERE order_id = $io");
if($inp=="Completed") {
$sav = date("Y.m.d H:i:s");
mysqli_query($connect,"UPDATE myorder SET status='$inp', last_check='$sav' WHERE order_id=$io");
}else{
mysqli_query($connect,"UPDATE myorder SET status='$inp' WHERE order_id=$io");
}

}
del();
sms($cid2,"✅ Jarayon tugallandi.",null);
}
}

if($data =="preyting"){
	$res = mysqli_query($connect,"SELECT * FROM `users`ORDER BY balance DESC LIMIT 100");
while($roww = mysqli_fetch_assoc($res)){
$id = $roww['id'];
$pul = floor($roww['balance']);
$member = $roww['refnum'];
$stat = mysqli_num_rows($res);
$top .= "<a href='tg://user?id=$id'>$id</a> - <i>$pul</i> $valyuta\n";
}
$ids = explode("\n","\n$top");
$soi = substr_count($top,"\n");
$soni = $soi;
foreach($ids as  $id){
$keyboards = [];
$text = "";
for ($i = 1; $i <= $soni; $i++) {
$title = str_replace("\n","",$ids[$i]);
$text .= "<b>$i)</b> ".$ids[$i]." \n";
}
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>💡 TOP-100 balanslar reytingi

$text</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"▶️ Orqaga",'callback_data'=>"menu"]]
]
])
]);
exit();
}
}

if(($step=="req_contact") and (isset($phonenumber))){
$phonenumber = str_replace("+","","$phonenumber");
if(joinchat($cid)=="true"){
if(is_numeric($phonenumber)==1){
if($contactid==$cid){

$connect->query("INSERT INTO `phone`(`user_id`,`phone`,`status`) VALUES ('$cid','$phonenumber','active')");
sms($cid,"✅ Foydalanishingiz mumkin.",$m);
unlink("user/$cid.step");
exit;






}else{
sms($cid,"⚠️ Faqat o‘zingizning raqamingizni yuboring",null);
exit;
}
}else{
sms($cid,"🇺🇿 O'zbekiston fuqarolari foydalanishi mumkin",null);
exit;
}
}
}

if((mb_stripos($step,"sendcode")!==false and joinchat($cid)==1)){
$phone = explode("=",$step)[1];
$code = explode("=",$step)[2];
$tims = explode("=",$step)[3];

if($text == "🔄 Qayta yuborish") {
if($tims == date("H:i")){
sms($cid,"1️⃣ Daqiqadan so'ng qayta yuborish mumkin",null);
exit;
}else{
$code = rand(11111,99999);
get("https://api.xssh.uz/smsv1/spes.php?id=273&token=doFiTIEmULxleugMqAGKbJNSjBfQRODHtapyXnrYVsPkvZh&number=".$phone."&text=".urlencode("Sizning login kodingiz ".$code." H7BtB68thI")."");
sms($cid,"📝 <b>$phone</b> raqamiga yuborilgan 5 sonali kodni kiriting

⚠️ 1 daqiqa ichida kod kelmasa «<b>🔄 Qayta yuborish</b>» tugmasini bosing.",resize([
[['text'=>"🔄 Qayta yuborish"]],
]));
put("user/$cid.step","sendcode=$phone=$code=".date("H:i")."");
exit;
}
}
	
if($code==$text and is_numeric($text)==1){
$connect->query("INSERT INTO `phone`(`user_id`,`phone`,`status`) VALUES ('$cid','$phone','active')");
sms($cid,"✅ $phone raqamingiz tasdiqlandi",$m);
unlink("user/$cid.step");
exit;
}else{
sms($cid,"⚠️ Kod xato kiritildi",null);
exit;
}
}

if($text == "✉️ Xabar yuborish" and $cid == $admin){
$result = mysqli_query($connect, "SELECT * FROM `send`");
$row = mysqli_fetch_assoc($result);

if(!$row){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📨 Yuboriladigan xabar turini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>keyboard([
[['text'=>"📢 Telegram profil",'callback_data'=>'tgakount']],

]),
]);
//put("user/$cid.step","send");

}else{
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📑 Hozirda botda xabar yuborish jarayoni davom etmoqda. Yangi xabar yuborish uchun eski yuborilayotgan xabar barcha foydalanuvchilarga yuborilishini kuting!</b>",
'parse_mode'=>'html',
'reply_markup'=>inline([

[['text'=>"🗑 O‘chirish",'callback_data'=>"senddelete"]],
])
]);

}
}


if($data=="tgakount" and $cid2==$admin){
del();
sms($cid2,"<b>📨 Yuboriladigan xabarni kiriting</b>",$aort);
put("user/$cid2.step","sendtg");
}


if($data == "senddelete" and $chat_id==$admin){
$delstat = $connect->query("DELETE FROM `send`");
if($delstat===TRUE){
sms($cid2,"🗑️ O‘chirildi",$panel);
}else{
sms($cid2,"
⚠️ Xatolik yuz berdi.

".$connect->error."",$panel);
}
}

if($step== "sendtg" and $cid==$admin){
$result = mysqli_query($connect, "SELECT * FROM users");
$stat = mysqli_num_rows($result);
$res = mysqli_query($connect,"SELECT * FROM users WHERE user_id = '$stat'");
$row = mysqli_fetch_assoc($res);
$user_id = $row['id'];
$time1 = date('H:i', strtotime('+1 minutes'));
$time2 = date('H:i', strtotime('+2 minutes'));
$time3 = date('H:i', strtotime('+3 minutes'));
$time4 = date('H:i', strtotime('+4 minutes'));
$time5 = date('H:i', strtotime('+5 minutes'));
$tugma = json_encode($update->message->reply_markup);
$reply_markup = base64_encode($tugma);
mysqli_query($connect, "INSERT INTO `send` (`time1`,`time2`,`time3`,`time4`,`time5`,`start_id`,`stop_id`,`admin_id`,`message_id`,`reply_markup`,`step`) VALUES ('$time1','$time2','$time3','$time4','$time5','0','$user_id','$admin','$mid','$reply_markup','tg')");
bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"<b>📋 Saqlandi!
📑 Xabar foydalanuvchilarga $time1 da yuborish boshlanadi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("user/$cid.step");

}

$result = mysqli_query($connect, "SELECT * FROM `send`"); 
$row = mysqli_fetch_assoc($result);
$sendstep = $row['step'];
if($_GET['update']=="send" and $sendstep=="tg"){
$row1 = $row['time1'];
$row2 = $row['time2'];
$row3 = $row['time3'];
$row4 = $row['time4'];
$row5 = $row['time5'];
$start_id = $row['start_id'];
$stop_id = $row['stop_id'];
$admin_id = $row['admin_id'];
$mied = $row['message_id'];
$tugma = $row['reply_markup'];
if($tugma == "bnVsbA=="){
$reply_markup = "";
}else{
$reply_markup = base64_decode($tugma);
}
$time1 = date('H:i', strtotime('+1 minutes'));
$time2 = date('H:i', strtotime('+2 minutes'));
$time3 = date('H:i', strtotime('+3 minutes'));
$time4 = date('H:i', strtotime('+4 minutes'));
$time5 = date('H:i', strtotime('+5 minutes'));
$limit = 150;

if($time == $row1 or $time == $row2 or $time == $row3 or $time == $row4 or $time == $row5){
$sql = "SELECT * FROM `users` LIMIT $start_id,$limit";
$res = mysqli_query($connect,$sql);
while($a = mysqli_fetch_assoc($res)){
$id = $a['id'];
if($id == $stop_id){
bot('CopyMessage',[
'chat_id'=>$id,
'from_chat_id'=>$admin_id,
'message_id'=>$mied,
'disable_web_page_preview'=>true,
'reply_markup'=>$reply_markup
]);

bot('sendMessage',[
'chat_id'=>$admin_id,
'text'=>"<b>✅ ️Xabar barcha bot foydalanuvchilariga yuborildi!</b>",
'parse_mode'=>'html'
]);
mysqli_query($connect, "DELETE FROM `send`");
exit;
}else{
bot('CopyMessage',[
'chat_id'=>$id,
'from_chat_id'=>$admin_id,
'message_id'=>$mied,
'disable_web_page_preview'=>true,
'reply_markup'=>$reply_markup
]);
}
}
mysqli_query($connect, "UPDATE `send` SET `time1` = '$time1'");
mysqli_query($connect, "UPDATE `send` SET `time2` = '$time2'");
mysqli_query($connect, "UPDATE `send` SET `time3` = '$time3'");
mysqli_query($connect, "UPDATE `send` SET `time4` = '$time4'");
mysqli_query($connect, "UPDATE `send` SET `time5` = '$time5'");
$get_id = $start_id + $limit;
mysqli_query($connect, "UPDATE `send` SET `start_id` = '$get_id'");
bot('sendMessage',[
'chat_id'=>$admin_id,
'text'=>"<b>✅ Yuborildi: $get_id</b>",
'parse_mode'=>'html'
]);
}
echo json_encode(["status"=>true,"cron"=>"Sending message"]);
}

if($data == "active_ref"){
    bot('deleteMessage',[
	'chat_id'=>$chat_id,
	'message_id'=>$message_id,
	]);
	mysqli_query($connect, "UPDATE `settings` SET `ref_competation` = 'on' WHERE `id` = '1'");
	bot("sendMessage",[
	    'chat_id'=>$chat_id,
	    'text'=> "♻️ Referal aksiya faollashtirildi !",
	    'parse_mode'=>"html",
	 ]);
}
if($data == "stop_ref"){
    bot('deleteMessage',[
	'chat_id'=>$chat_id,
	'message_id'=>$message_id,
	]);
	mysqli_query($connect, "UPDATE `settings` SET `ref_competation` = 'off' WHERE `id` = '1'");
	$res = mysqli_query($connect, "SELECT * FROM users");
    while($h=mysqli_fetch_assoc($res)){
        $id = $h['id'];
        mysqli_query($connect, "UPDATE `users` SET `ref_competation` = '0' WHERE `id` = '$id'");
    }
	bot("sendMessage",[
	    'chat_id'=>$chat_id,
	    'text'=> "🛑 Referal aksiya to'xtatildi.",
	    'parse_mode'=>"html",
	 ]);
}


$panel2=json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🛍 Xizmatlarni sozlash"]],
[['text'=>"💵 Kursni o‘rnatish"],['text'=>"🔎 Buyurtma"]],
[['text'=>"⚖️ Foizni o‘rnatish"],['text'=>"🔑 API sozlamalari"]],
[['text'=>"📢 Kanallar"],['text'=>"⚙️ Sozlamalar"]],
[['text'=>"🗄️ Boshqaruv"]],
]]);



if($text=="⚙️ Sozlamalar" and $cid==$admin){
$r_c = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM settings WHERE id=1"))['ref_competation'];
if($r_c == "on"){
    sms($cid,"<b>⭐ Kerakli bo'limni tanlang:</b>",json_encode([
    inline_keyboard=>[
    [['text'=>"?? Matnlar sozlamalari",callback_data=>"birlamch=matn"]],
    [['text'=>"💳 Hamyonlar sozlamalari",callback_data=>"birlamch=cards"]],
    [['text'=>"⚡️ Referal aksiya [ 🛑 ]",'callback_data'=>"stop_ref"]],
    [['text'=>" 🏆 TOP Referal (Konkurs)",'callback_data'=>"konkurs"]],
    [['text'=>" 💳 Hamyon",'callback_data'=>"new"]],
    ]]));
}else{
    sms($cid,"<b>⭐ Kerakli bo'limni tanlang:</b>",json_encode([
    inline_keyboard=>[
    [['text'=>"📑 Matnlar sozlamalari",callback_data=>"birlamch=matn"]],
    [['text'=>"💳 Hamyonlar sozlamalari",callback_data=>"birlamch=cards"]],
    [['text'=>"⚡️ Referal aksiya [ ✅ ]",'callback_data'=>"active_ref"]],
    [['text'=>" 🏆 TOP Referal (Konkurs)",'callback_data'=>"konkurs"]],
    
    ]]));
}
}



if((stripos($data,"birlamch=")!==false)){
$res=explode("=",$data)[1];
if($res=="matn"){
edit($chat_id,$message_id,"👉 Sozlama turini tanlang:",json_encode([
inline_keyboard=>[
[['text'=>"📑 Nomini o‘zgartirish",callback_data=>"birlamch=editM"]],
[['text'=>"Orqaga",callback_data=>"birlamch=exit"]],
]]));
}elseif($res=="tugma"){
edit($chat_id,$message_id,"👉 Sozlama turini tanlang:",json_encode([
inline_keyboard=>[
[['text'=>"📑 Nomini o‘zgartirish",callback_data=>"birlamch=editT"]],
[['text'=>"Orqaga",callback_data=>"birlamch=exit"]],
]]));
}elseif($res=="exit"){
del();
sms($chat_id,"⭐ Kerakli bo'limni tanlang:",json_encode([
inline_keyboard=>[
[['text'=>"📑 Matnlarni sozlash",callback_data=>"birlamch=matn"]],
[['text'=>"💳 Hamyonlar sozlamalari",callback_data=>"birlamch=cards"]],
]]));
}elseif($res=="editM"){
edit($chat_id,$message_id,"
📑 Kerakli matnni tanlang:

1. Yangi buyurtma uchun matn
2. Kabinet uchun matn
3. Referal narxi",json_encode([
inline_keyboard=>[
[['text'=>"1",callback_data=>"birlamchi=orders"],['text'=>"2",callback_data=>"birlamchi=kabinet"]],
[['text'=>"3",callback_data=>"birlamchi=referal"]],
[['text'=>"Orqaga",callback_data=>"birlamch=matn"]],
]]));
}elseif($res == "cards"){
del();
$delturi = file_get_contents("set/payments.txt");
$delmore = explode("\n",$delturi);
$delsoni = substr_count($delturi,"\n");
$key=[];
for ($delfor = 1; $delfor <= $delsoni; $delfor++) {
$title=str_replace("\n","",$delmore[$delfor]);
$key[]=["text"=>"$title - ni o'chirish","callback_data"=>"delPayMethod-$title"];
$keyboard2 = array_chunk($key, 1);
$keyboard2[] = [['text'=>"➕ Yangi to'lov tizimi qo'shish",'callback_data'=>"new"]];
$keyboard2[] = [['text'=>"Orqaga",callback_data=>"birlamch=exit"]];
$pay = json_encode([
'inline_keyboard'=>$keyboard2,
]);
}
if($cid2==$admin){
if($delturi == null){
bot('SendMessage',[
	'chat_id'=>$cid2,
	'text'=>"<b>Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
		'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Yangi to'lov tizimi qo'shish",'callback_data'=>"new"]],
[['text'=>"Orqaga",callback_data=>"birlamch=exit"]],
]
])
]);

}else{
	bot('SendMessage',[
	'chat_id'=>$cid2,
	'text'=>"<b>Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
		'reply_markup'=>$pay
]);

}
}
}elseif($res=="autopays"){
edit($cid2,$mid2,"👉 Kerakli tolov tizimini tanlang:",keyboard([
[['text'=>"💳 PAYME",'callback_data'=>"autopay=payme"]],
[['text'=>"Orqaga",callback_data=>"birlamch=exit"]],
]));
}
}

if(mb_stripos($data,"delPayMethod-")!==false){
	$ex = explode("-",$data)[1];
	$delturi = file_get_contents("set/payments.txt");
	$delturi = str_replace("\n".$ex."","",$delturi);
   file_put_contents("set/payments.txt",$delturi);
bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
bot('SendMessage',[
	'chat_id'=>$cid2,
	'text'=>"🗑️ <b>To'lov tizimi o'chirildi!</b>",
		'parse_mode'=>'html',
	'reply_markup'=>$asosiy
]);
rmdirPro("set/pay/$ex");
}

if($data == "new"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
   ]);
   bot('sendMessage',[
   'chat_id'=>$cid2,
   'text'=>"🔠 <b>Yangi to'lov tizimi nomini yuboring:</b>",
   'parse_mode'=>'html',
   'reply_markup'=>$aort
	]);
	file_put_contents("user/$cid2.step",'turi');
	
}

if($step == "turi"){
if($cid==$admin){
if(isset($text)){
put("set/title.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"🔢 <b>Ushbu to'lov tizimidagi hamyoningiz raqamini yuboring:</b>",
	'parse_mode'=>'html',
	]);
	file_put_contents("user/$cid.step",'wallet');
	
}
}
}


if($step == "wallet"){
if($cid==$admin){

put("set/wallet.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"✅ <b>Ushbu to'lov tizimi orqali hisobni to'ldirish bo'yicha ma'lumotni yuboring:</b>

<i>Misol uchun, \"Ushbu to'lov tizimi orqali pul yuborish jarayonida izoh kirita olmasligingiz mumkin. Ushbu holatda, biz bilan bog'laning.</i>\"",
'parse_mode'=>'html',
	]);
	file_put_contents("user/$cid.step",'addition');
	
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"🔢 <b>Faqat raqamlardan foydalaning!</b>",
'parse_mode'=>'html',
]);


}
}

if($step == "addition"){
		if($cid==$admin){
	if(isset($text)){
$ttest=get("set/title.txt");
file_put_contents("set/payments.txt","\n".$ttest,FILE_APPEND);
mkdir("set/pay");
mkdir("set/pay/$ttest");
file_put_contents("set/pay/$ttest/addition.txt","$text");
file_put_contents("set/pay/$ttest/wallet.txt",get("set/wallet.txt"));
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"✅ <b>$ttest to'lov tizimi qo'shildi!</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$panel,
	]);
	unlink("user/$cid.step");
	
}
}
}


if((stripos($data,"referr=")!==false)){
$res = explode("=",$data)[1];
$fo = explode("=",$data)[2];
if($res=="xolati"){
$m = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM settings WHERE id = 1"))["ref_status"];
if($m == "on"){
$tx = "✅";
$kb = json_encode([
inline_keyboard=>[
[['text'=>"«❌»",'callback_data'=>"referr=ok=off"]],
[['text'=>"Orqaga",callback_data=>"birlamch=exit"]],
]]);
}elseif($m == "off"){
$tx = "❌";
$kb = json_encode([
inline_keyboard=>[
[['text'=>"«✅»",'callback_data'=>"referr=ok=on"]],
[['text'=>"Orqaga",callback_data=>"birlamch=exit"]],
]]);
}
edit($cid2,$mid2,"🎁 Referal tugma xolati: $tx",$kb);
}elseif($res=="ok") {
mysqli_query($connect,"UPDATE settings SET ref_status = '$fo' WHERE id = 1");
$m = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM settings WHERE id = 1"))["ref_status"];
if($m == "on"){
$tx = "✅";
$kb = json_encode([
inline_keyboard=>[
[['text'=>"«❌»",'callback_data'=>"referr=ok=off"]],
[['text'=>"Orqaga",callback_data=>"birlamch=exit"]],
]]);
}elseif($m == "off"){
$tx = "❌";
$kb = json_encode([
inline_keyboard=>[
[['text'=>"«✅»",'callback_data'=>"referr=ok=on"]],
[['text'=>"Orqaga",callback_data=>"birlamch=exit"]],
]]);
}
edit($cid2,$mid2,"🎁 Referal tugma xolati: $tx",$kb);
}elseif($res=="edit") {
$m = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM settings WHERE id = 1"))["bonus"];
del();
sms($cid2,"
🔢 Referal bonus miqdorini kiriting. (raqamlarda)

📝 Hozirgi xolati: $m%",$aort);
put("user/$cid2.step","*##");
}
}
if($step=="*##" and $cid==$admin){
if(is_numeric($text)==1){
mysqli_query($connect,"UPDATE settings SET bonus = '$text' WHERE id = 1");
sms($cid,"✅ O‘zgarish saqlandi",$panel);
unlink("user/$cid.step");

}
}
if((stripos($data,"birlamchi=")!==false)){
$res = explode("=",$data)[1];
if($res=="start"){
$arr = "<code>{balance} </code> - Foydalanuvchi hisobi\n<pre>{name}</pre> - Foydalanuvchi ismi\n<pre>{time} </pre> - Hozirgi vaqt (UTC+5 / UZ)";
}elseif($res=="kabinet") {
$arr ="<code>{id}</code> - Foydalanuvchi IDsi\n<code>{balance}</code> - Foydalanuvchi hisobi\n<code>{outing}</code> - Kiritgan pullar miqdori\n<code>{orders}</code> - Buyurtmalari soni\n<code>{phone}</code> - Telefon raqami";
}elseif($res=="referal") {
$arr = "1 ta taklif uchun tolov miqdorini kiriting:";
}elseif($res=="orders") {
$arr ="<pre>{order}</pre> - Buyurtma IDsi (standard)\n<pre>{order_api}</pre> - Buyurtma IDsi (API)";
}
put("bir.txt",$res);
del();
sms($chat_id,"
📝 Yangi matnlarni kiriting.

⚙️ O‘zgaruvchilar:
$arr

📝 Hozirgi matnlar",$aort);
$m  = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM settings WHERE id = 1"))[$res];
sms($chat_id,enc("decode",$m),null);
put("user/$chat_id.step","!?+-");
}
if($step=="!?+-" and $cid==$admin){

$vq = get("bir.txt");
$vo = enc("encode",$text);
mysqli_query($connect,"UPDATE settings SET `$vq` = '$vo' WHERE id = 1");
sms($cid,"✅ O‘zgartirishlar saqlandi",$panel);
unlink("bir.txt");
unlink("user/$cid.step");
exit;
}


if($text=="🔎 Buyurtma" and $cid == $admin){
	if($cid == $admin){
$resi = mysqli_query($connect, "SELECT * FROM orders");
$stati = mysqli_num_rows($resi);
sms($cid,"<b>🔢 Barcha buyurtmalar: $stati ta

➡️ Buyurtma IDsini kiriting:</b>",$aort);
put("user/$cid.step",orders2);
exit;
}}


if($step=="orders2" and $cid==$admin and is_numeric($text)==1){
$amyorder= mysqli_query($connect, "SELECT * FROM myorder WHERE order_id = '$text'");
$myorder = mysqli_fetch_assoc($amyorder);
$aorders = mysqli_query($connect, "SELECT * FROM orders WHERE order_id = '$text'");
$orders = mysqli_fetch_assoc($aorders);
if(!$myorder){
sms($cid,"<b>❌ Buyurtma topilmadi</b>.",$aort);
}else{
$providers= mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `providers` WHERE id = ".$orders['provider']." "));
$apiurl = $providers['api_url'];
$apikey =$providers['api_key'];
$api = json_decode(get("$apiurl?key=$apikey&action=status&order=".$orders['api_order'].""), 1);
$server=str_replace(["/api/adapter/default/index","/api/v1","/api/v2","https://"],["","","",""],$providers['api_url']);
if(($myorder['status']=="Pending") and ($orders['status']=="Pending")) {
$orderstatus = "Bajarilmoqda.";
}elseif(($myorder['status']=="Completed") and ($orders['status']=="Completed")){
$orderstatus = "Bajarilgan.";
}elseif(($myorder['status']=="Canceled") and ($orders['status']=="Canceled")) {
$orderstatus = "Bekor qilingan.";
}elseif(($myorder['status']=="In progress") and ($orders['status']=="In progress")){
$orderstatus = "Jarayonda.";
}elseif(($myorder['status']=="Partial") and ($orders['status']=="Partial")){
$orderstatus = "Qisman bajarilgan.";
}elseif($myorder['status']=="Processing"){
$orderstatus = "Qayta ishlamoqda.";
}
sms($cid,"
<b>Server Orders</b>
<b>*️⃣ Server:</b> $server
<b>🔢 Server Buyurtma IDsi:</b> <code>".$orders['api_order']."</code>
<b>☑️ Server Buyurtma xolati:</b> <code>".$api['status']."</code>

<b>Orders</b>
<b>*️⃣ Server:</b> $server
<b>🔢 Server Buyurtma IDsi:</b> <code>".$orders['api_order']."</code>
<b>☑️ Server Buyurtma xolati:</b> $orderstatus

<b>My Orders</b>
<b>🛍 Buyurtma IDsi:</b> <code>$text</code>
<b>♻️ Buyurtma xolati:</b> $orderstatus
<b>⏰ Buyurtma sanasi:</b> ".$myorder['order_create']."
<b>💰 Buyurtma narxi:</b> ".$myorder['retail']." so'm
<b>👤 Buyurtmachi:</b> <a href='tg://user?id=".$myorder['user_id']."'>".$myorder['user_id']."</a>",json_encode([
	'inline_keyboard'=>[
]
	]));
unlink("user/$cid.step");
}
exit;
}



if($text == "🔑 API sozlamalari" and $cid==$admin){
	if($cid == $admin){
	bot('SendMessage',[
	'chat_id'=>$cid,
'text'=>"<b>Quyidagi bo'limlardan birini tanlang:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"➕ API qo‘shish",'callback_data'=>"api"],['text'=>"🗑️ O‘chirish",'callback_data'=>"deleteapi"]],
	[['text'=>"📝 Taxrirlash",'callback_data'=>"apio=taxrirlash"],['text'=>"💵 Balansni ko'rish",'callback_data'=>"balans"]],
	[['text'=>"🔙 Orqaga",'callback_data'=>"menu"]],
]
	])
	]);
	exit;
}
}

if((stripos($data,"apio=")!==false and $chat_id==$admin)){
$res=explode("=",$data)[1];
if($res=="taxrirlash") {
edit($cid2,$mid2,"📝 Taxrirlash menyusini tanlang",keyboard([
[['text'=>"🔑 Kalitni o‘zgartirish",'callback_data'=>"apio=kalit"]],
[['text'=>"⬅️ Orqaga", callback_data=>"api1"]],
]));
}elseif($res=="kalit") {
$pr=0;
$prs="";
$a = mysqli_query($connect,"SELECT * FROM providers");
$c = mysqli_num_rows($a);
while($s = mysqli_fetch_assoc($a)){
$pr++;
$prtxt=str_replace(["/api/adapter/default/index","/api/v1","/api/v2","https://"],["","","",""],$s['api_url']);
$prs.="$pr: <b>$prtxt\n</b>";
$k[]=["text"=>$pr,"callback_data"=>"apio=edit=".$s['id']];
}
$keyboard2=array_chunk($k,3);
$keyboard2[]=[['text'=>"Orqaga",'callback_data'=>"api1"]];
$kb=json_encode([inline_keyboard=>$keyboard2]);
if(!$c){
	bot('answerCallbackQuery',[
		'callback_query_id'=>$qid,
		'text'=>"⚠️ Provayderlar topilmadi!",
		'show_alert'=>true,
		]);
	}else{
     bot('editMessageText',[
        'chat_id'=>$chat_id,
       'message_id'=>$message_id,
       'text'=>"Provayderni tanlang:

$prs
",
'parse_mode'=>"HTML",
'reply_markup'=>$kb,
]);

}
}elseif($res=="edit") {
del();
$co=explode("=",$data)[2];
sms($cid2,"🔠 Yangi kalitni kiriting:",$aort);
put("user/$cid2.step","kalitnew=$co");
}
}


if((mb_stripos($step,"kalitnew=")!==false) and $cid==$admin){
sms($cid,"✅ O‘zgartirish muvaffaqiyatli amalga oshirildi.",$panel);
$io = explode("=",$step)[1];
mysqli_query($connect,"UPDATE providers SET api_key = '$text' WHERE id = $io");
unlink("user/$cid.step");

}


if($data == "deleteapi" and $chat_id==$admin){
$pr=0;
$prs="";
$a = mysqli_query($connect,"SELECT * FROM providers");
$c = mysqli_num_rows($a);
while($s = mysqli_fetch_assoc($a)){
$pr++;
$prtxt=str_replace(["/api/adapter/default/index","/api/v1","/api/v2","https://"],["","","",""],$s['api_url']);
$prs.="$pr: <b>$prtxt\n</b>";
$k[]=["text"=>$pr,"callback_data"=>"apidel=".$s['id']];
}
$keyboard2=array_chunk($k,3);
$keyboard2[]=[['text'=>"Orqaga",'callback_data'=>"api1"]];
$kb=json_encode([inline_keyboard=>$keyboard2]);
if(!$c){
	bot('answerCallbackQuery',[
		'callback_query_id'=>$qid,
		'text'=>"⚠️ Provayderlar topilmadi!",
		'show_alert'=>true,
		]);
	}else{
     bot('editMessageText',[
        'chat_id'=>$chat_id,
       'message_id'=>$message_id,
       'text'=>"Provayderni tanlang:

$prs
",
'parse_mode'=>"HTML",
'reply_markup'=>$kb,
]);
exit;
}
}

if((stripos($data,"apidel=")!==false)){
$res = explode("=",$data)[1];
del();
mysqli_query($connect,"DELETE FROM providers WHERE id = $res");
mysqli_query($connect,"DELETE FROM services WHERE api_service = $res");
sms($cid2,"🗑️ Provayderni o‘chirish yakunlandi.",null);
}

if($data == "api1" and $chat_id==$admin){
	bot('deleteMessage',[
	'chat_id'=>$chat_id,
	'message_id'=>$message_id,
	]);
	bot('SendMessage',[
	'chat_id'=>$chat_id,
'text'=>"<b>Quyidagi bo'limlardan birini tanlang:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"➕ API qo‘shish",'callback_data'=>"api"],['text'=>"🗑️ O‘chirish",'callback_data'=>"deleteapi"]],
	[['text'=>"📝 Taxrirlash",'callback_data'=>"apio=taxrirlash"],['text'=>"💵 Balansni ko'rish",'callback_data'=>"balans"]],
    [['text'=>"🔙 Orqaga",'callback_data'=>"menu"]],
]
	])
	]);
	exit;
}

if($data == "api"){
	bot('deleteMessage',[
	'chat_id'=>$chat_id,
	'message_id'=>$message_id,
	]);
	bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"<b>API manzilini yuboring:

📎 Namuna:</b> <code>https://tezgram.uz/api/v2</code>",
	'parse_mode'=>'html',
	'reply_markup'=>$boshqarish,
	]);
	file_put_contents("user/$chat_id.step",'api_url');
	exit;
}

if($step == "api_url"){
	if($cid == $admin){
   if(mb_stripos($text, "https://")!==false or mb_stripos($text, "http://")!==false){
	if(isset($text)){
	file_put_contents("set/api_url",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b> $text qabul qilindi!
	
	Endi esa ushbu saytdan olingan Kalitni kiriting:</b>",
'disable_web_page_preview'=>true,
	'parse_mode'=>'html',
	]);
	file_put_contents("user/$cid.step",'api');
	exit;
}
}else{
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>API manzilini yuboring:

Namuna:</b> <pre>https://tezgram.uz/api/v2</pre>",
	'parse_mode'=>'html',
]);
exit;
}
}
}

if($step == "api"){
	if($cid == $admin){
	if(isset($text)){
$balans = json_decode(file_get_contents(get("set/api_url")."?key=$text&action=balance"),true);
if(isset($balans['error'])){
$admsg="⚠️ Balansni olish imkoni bo'lmadi

Extimol API kalit mavjud emas";
}else{
global $connect;
$admsg="<b>💵 API balansi:</b> ".$balans['balance']." ".$balans['currency']."";
$apc = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM providers"));
$api_url = get("set/api_url");
mysqli_query($connect,"INSERT INTO providers(`api_url`,`api_key`) VALUES ('$api_url','$text')");
}
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>$admsg</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$asosiy,
	]);
	unlink("user/$cid.step");
	
}
}
}


if($data == "balans" and $chat_id==$admin){
$pr=0;
$prs="";
$a = mysqli_query($connect,"SELECT * FROM providers");
$c = mysqli_num_rows($a);
while($s = mysqli_fetch_assoc($a)){
$pr++;
$sv = $connect->query("SELECT * FROM `services` WHERE `api_service` = '$s[id]'")->num_rows;
$prtxt=str_replace(["/api/adapter/default/index","/api/v1","/api/v2","https://"],["","","",""],$s['api_url']);
$sa= json_decode(api_query($s['api_url']."?key=".$s['api_key']."&action=balance"));

$prs.="<b>".$pr."</b>: $prtxt - ".$sa->balance." ".$sa->currency." - ($sv ta xizmat)\n";
$k[]=["text"=>$pr,"url"=>$s['api_url']."?key=".$s['api_key']."&action=balance"];
}
$keyboard2=array_chunk($k,3);
$keyboard2[]=[['text'=>"⬅️ Orqaga",'callback_data'=>"api1"]];
$kb=json_encode([
'inline_keyboard'=>$keyboard2,
]);
if(!$c){
	bot('answerCallbackQuery',[
		'callback_query_id'=>$qid,
		'text'=>"⚠️ Provayderlar topilmadi!",
		'show_alert'=>true,
		]);
	}else{
     bot('editMessageText',[
        'chat_id'=>$chat_id,
       'message_id'=>$message_id,
       'text'=>"<b>🔑 API sozlamalarini tanlang:

$prs
</b>",
'parse_mode'=>"HTML",
'reply_markup'=>$kb,
]);

}
}


if($text=="🤝 Hamkorlik dasturi" || $text == "/api" and joinchat($cid)==1 and phone($cid)==1){
$result = mysqli_query($connect,"SELECT * FROM `users` WHERE id = '$cid'");
$rew = mysqli_fetch_assoc($result);
sms($cid,"<b>🔗 API domeni\n
<code>https://".$_SERVER['HTTP_HOST']."/api/v2</code>\n
🔑 API kalitingiz:\n
<code>".$rew['api_key']."</code>\n
💵 Balansingiz: 
<b>".floor($rew['balance'])." so'm.</b>

🤖 @$bot - Biznesingiz hamkori!</b>",keyboard([
[['text'=>"📝 Qo‘llanma",'web_app'=>['url'=>"https://".$_SERVER['HTTP_HOST']."/api"]]],
[['text'=>"🔄 APIni yangilash",'callback_data'=>"apidetail=newkey"]],
]));
}

if((stripos($data,"apidetail=")!==false)){
$res = explode("=",$data)[1];
if($res == "newkey"){
$newkey = md5(uniqid());
mysqli_query($connect,"UPDATE users SET api_key = '$newkey' WHERE id = '$chat_id'");
$result = mysqli_query($connect,"SELECT * FROM `users` WHERE id = '$chat_id'");
$rew = mysqli_fetch_assoc($result);
bot('editMessageText',[
'chat_id'=>$chat_id,
'parse_mode'=>"html",
'message_id'=>$message_id,
'text'=>"<b>✅ API kalit yangilandi.

<code>".$rew['api_key']."</code>

💵 API hisobi:
<b>".floor($rew['balance'])."</b> so‘m
</b>",
'reply_markup'=>keyboard([
[['text'=>"📝 Qo‘llanma",'web_app'=>['url'=>"https://".$_SERVER['HTTP_HOST']."/api"]]],
[['text'=>"🔄 APIni yangilash",'callback_data'=>"apidetail=newkey"]],
])
]);
}elseif($res == "qoll") {
	bot('editMessageText',[
'chat_id'=>$chat_id,
'parse_mode'=>"html",
'message_id'=>$message_id,
'text'=>"<b>❓ APi nima?
Botimizdagi xizmatlarni siz ham o'z botingizga yoki saytingizga ulab ishlatishingiz mumkin. Buni ishlatish oson va qulay. Ushbu tizim xavfsizligi taminlanagan. Ko'proq imkoniyat bilan foydalaning. Sizni api kalitingiz agarda boshqalarga ma'lum bo'lsa yangisiga almashtiring. Albatta botga ulash uchun qo'llanma mavjud.

🔑 APi kalitni ishlatish haqida web saytimiz: ".$_SERVER['HTTP_HOST']."

⚠️ Diqqat APi kalitni begona kishiga bermang. Sizning api kalitiz begonalar qo'liga tushsa tezda api kalitni yangilang. Agarda begonalar qo'liga tushgan apidan berilgan xizmat puli qaytarilmaydi. Bu holat ximoyalangan va sizdan boshqa kishisiz aytmasangiz apini bila olmaydi.
</b>",
'reply_markup'=>keyboard([
[['text'=>"📝 Qo‘llanma",'web_app'=>['url'=>"https://".$_SERVER['HTTP_HOST']."/api"]]],
[['text'=>"🔄 APIni yangilash",'callback_data'=>"apidetail=newkey"]],
])
]);
}
	
	
}





if($text=="➡️ Orqaga"and phone($cid)==1 and joinchat($cid)==1 and phone($cid)==1){
sms($cid,"<b>🖥️ Asosiy menyudasiz</b>",$m);
unlink("user/$cid.step");
exit();
}

if($text=="☎️ Qo'llab-quvvatlash" and joinchat($cid)==1 and phone($cid)==1){
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"<b>☎️ Savollar uchun: @TezGramADs

🔉 Kanal: @TezGramUz

💬 Guruh: @TezGramChat</b>",
'parse_mode'=>"html",
'reply_markup'=>$home,
]);
exit();
}

if($text == "🛍 Xizmatlarni sozlash" and $cid==$admin){
		bot('sendMessage',[
		'chat_id'=>$cid,
		'text'=>"<b>⭐ Quyidagilardan birini tanlang:</b>",
		'parse_mode'=>'html',
		'reply_markup'=>json_encode([
		'inline_keyboard'=>[
		[['text'=>"📂 Bo'limlarni sozlash",'callback_data'=>"bolim"]],
		[['text'=>"📂 Ichki bo'limlarni sozlash",'callback_data'=>"ichki"]],
		[['text'=>"🛍 Xizmatlarni sozlash",'callback_data'=>"xizmat"]],
		[['text'=>"🔙 Orqaga",'callback_data'=>"menu"]]
]
])
]);

}

if($data == "xsetting" and $chat_id==$admin ){
del();
		bot('sendMessage',[
		'chat_id'=>$chat_id,
		'text'=>"<b>⭐ Quyidagilardan birini tanlang:</b>",
		'parse_mode'=>'html',
		'reply_markup'=>json_encode([
		'inline_keyboard'=>[
		[['text'=>"📂 Bo'limlarni sozlash",'callback_data'=>"bolim"]],
		[['text'=>"📂 Ichki bo'limlarni sozlash",'callback_data'=>"ichki"]],
		[['text'=>"🛍 Xizmatlarni sozlash",'callback_data'=>"xizmat"]],
		[['text'=>"🔙 Orqaga",'callback_data'=>"menu"]]
]
])
]);

}

if($data == "bolim"and $chat_id==$admin){
     bot('editMessageText',[
        'chat_id'=>$chat_id,
       'message_id'=>$message_id,
       'text'=>"<b>⭐ Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Yangi bo'lim qo'shish",'callback_data'=>"newFol"]],
[['text'=>"📝 Tahrirlash",'callback_data'=>"editFol"]],
[['text'=>"🗑️ O'chirish",'callback_data'=>"delFol"]],
[['text'=>"⬅️ Orqaga", 'callback_data'=>"xsetting"]],
]
])
]);
}

if($data == "editFol"and $chat_id==$admin){
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
       'text'=>"<b>⭐ Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📝 Nomini o'zgartirish",'callback_data'=>"editFols"]],
]
])
]);
}


if($data == "editFols"and $chat_id==$admin){
$a = mysqli_query($connect,"SELECT * FROM categorys");
$c = mysqli_num_rows($a);
while($s = mysqli_fetch_assoc($a)){
$k[]=['text'=>enc("decode",$s['category_name']),'callback_data'=>"editFolss-".$s['category_id']];
}

$keyboard2=array_chunk($k,3);
$kb=json_encode([
'inline_keyboard'=>$keyboard2,
]);
if(!$c){
	bot('answerCallbackQuery',[
		'callback_query_id'=>$qid,
		'text'=>"⚠️ Bo'limlar topilmadi!",
		'show_alert'=>true,
		]);
	}else{
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
       'text'=>"<b>⭐ Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$kb
]);
}
}

if(mb_stripos($data, "editFolss-")!==false){
	$ex = explode("-",$data)[1];
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
]);
   bot('sendMessage',[
   'chat_id'=>$cid2,
   'text'=>"<b>📋 Yangi qiymatni kiriting:</b>",
   'parse_mode'=>'html',
   'reply_markup'=>$aort
]);
file_put_contents("user/$cid2.step","editFol-$ex");

}

if((mb_stripos($step,"editFol-")!==false)){
	$ex = explode("-",$step)[1];
if(isset($text)){
$text=enc("encode",$text);
mysqli_query($connect,"UPDATE categorys SET category_name = '$text' WHERE category_id = $ex");
		bot('SendMessage',[
		'chat_id'=>$cid,
		'text'=>"<b>Muvaffaqiyatli o'zgartirildi.</b>",
		'parse_mode'=>'html',
		'reply_markup'=>$panel2
]);
unlink("user/$cid.step");

}
}



if($data=="delFol"and $chat_id==$admin){
$a = mysqli_query($connect,"SELECT * FROM categorys");
$c = mysqli_num_rows($a);
while($s = mysqli_fetch_assoc($a)){
$k[]=['text'=>enc("decode",$s['category_name']),'callback_data'=>"delFols=".$s['category_id']];
}

$keyboard2=array_chunk($k,1);
$kb=json_encode([
'inline_keyboard'=>$keyboard2,
]);
if(!$c){
	bot('answerCallbackQuery',[
		'callback_query_id'=>$qid,
		'text'=>"⚠️ Bo‘limlar topilmadi!",
		'show_alert'=>true,
		]);
	}else{
edit($chat_id,$message_id,"<b>🔽 Quyidagi xizmatlardan birini tanlang!</b>",$kb);

}
}

if(mb_stripos($data, "delFols=")!==false){
	$ex = explode("=",$data)[1];
	$sd = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM categorys WHERE category_id  = $ex"));
	$cd=$sd['category_id'];
	$d=enc("decode",$sd['category_name']);
$qd = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM cates WHERE category_id  = $ex"));
$sa=$qd['cate_id'];
mysqli_query($connect,"DELETE FROM services WHERE category_id=$sa");
mysqli_query($connect,"DELETE FROM cates WHERE category_id = $cd");
mysqli_query($connect,"DELETE FROM categorys WHERE category_id='$ex'");
     bot('deleteMessage',[
	'chat_id'=>$chat_id,
	'message_id'=>$message_id,
]);
   bot('sendMessage',[
   'chat_id'=>$chat_id,
       'text'=>"Bo'lim olib tashlandi!",
'parse_mode'=>'html',
'reply_markup'=>$panel2
]);

}



if($data == "newFol"and $chat_id==$admin){
	bot('deleteMessage',[
	'chat_id'=>$chat_id,
	'message_id'=>$message_id,
]);
   bot('sendMessage',[
   'chat_id'=>$chat_id,
   'text'=>"<b>📋 Yangi bo'lim nomini yuboring:</b>",
   'parse_mode'=>'html',
   'reply_markup'=>$aort
]);
file_put_contents("user/$chat_id.step",'newFol');

}

if($step == "newFol"){
$res = mysqli_query($connect, "SELECT * FROM `categorys`");
$n = mysqli_fetch_assoc($res);
$text=enc("encode",$text);
mysqli_query($connect,"INSERT INTO categorys(category_name,category_status) VALUES('$text','ON');");
		bot('SendMessage',[
		'chat_id'=>$cid,
		'text'=>"Bo'lim qo'shildi!",
		'parse_mode'=>'html',
		'reply_markup'=>$panel2
]);
unlink("user/$cid.step");

}


if($data == "ichki"){
     bot('editMessageText',[
        'chat_id'=>$chat_id,
       'message_id'=>$message_id,
       'text'=>"<b>⭐ Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Yangi ichki bo'lim qo'shish",'callback_data'=>"newFold"]],
[['text'=>"📝 Tahrirlash",'callback_data'=>"editFold"]],
[['text'=>"🗑️ O'chirish",'callback_data'=>"delFold"]],
[['text'=>"⬅️ Orqaga", 'callback_data'=>"xsetting"]],
]
])
]);
}

if($data == "editFold"){
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
       'text'=>"<b>⭐ Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📝 Nomini o'zgartirish",'callback_data'=>"editFolds"]],
]
])
]);
}



if($data == "editFolds"){
$a = mysqli_query($connect,"SELECT * FROM categorys");
while($s = mysqli_fetch_assoc($a)){
$k[]=['text'=>enc("decode",$s['category_name']),'callback_data'=>"editFolds-".$s['category_id']];
}

$keyboard2=array_chunk($k,1);
$kb=json_encode([
'inline_keyboard'=>$keyboard2,
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
       'text'=>"<b>⭐ Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$kb
]);
}

if(mb_stripos($data, "editFolds-")!==false){
$n = explode("-",$data)[1];
$new_arr = [];
$k = [];
$a = mysqli_query($connect,"SELECT * FROM cates WHERE category_id = $n");
$c = mysqli_num_rows($a);
while($s = mysqli_fetch_assoc($a)){
if(!in_array(enc("decode",$s['name']), $new_arr)){
$new_arr[] = enc("decode",$s['name']);
$k[]=['text'=>enc("decode",$s['name']),'callback_data'=>"editFoldm-".$s['cate_id']];
}
}
$keyboard2=array_chunk($k,1);
$kb=json_encode([
'inline_keyboard'=>$keyboard2,
]);
if(!$c){
	bot('answerCallbackQuery',[
		'callback_query_id'=>$qid,
		'text'=>"⚠️ Ushbu bo'lim uchun xizmat turlari topilmadi!",
		'show_alert'=>true,
		]);
	}else{
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
       'text'=>"<b>⭐ Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$kb
]);
}
}

if(mb_stripos($data, "editFoldm-")!==false){
	$ex = explode("-",$data)[1];
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
]);
   bot('sendMessage',[
   'chat_id'=>$cid2,
   'text'=>"<b>📋 Yangi qiymatni kiriting:</b>",
   'parse_mode'=>'html',
   'reply_markup'=>$boshqarish
]);
file_put_contents("user/$cid2.step","editFoldms-$ex");

}

if(mb_stripos($step, "editFoldms-")!==false){
	$ex = explode("-",$step)[1];
	if(isset($text)){
	$text=enc("encode",$text);
		mysqli_query($connect,"UPDATE cates SET name = '$text' WHERE cate_id = $ex");
		bot('SendMessage',[
		'chat_id'=>$cid,
		'text'=>"<b>Muvaffaqiyatli o'zgartirildi.</b>",
		'parse_mode'=>'html',
		'reply_markup'=>$panel2
]);
unlink("user/$cid.step");

}

}





if($data == "delFold"){
$a = mysqli_query($connect,"SELECT * FROM categorys");
while($s = mysqli_fetch_assoc($a)){
$k[]=['text'=>enc("decode",$s['category_name']),'callback_data'=>"delFolds=".$s['category_id']];
}

$keyboard2=array_chunk($k,3);
$kb=json_encode([
'inline_keyboard'=>$keyboard2,
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
       'text'=>"<b>⭐ Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$kb
]);
}

if(mb_stripos($data, "delFolds=")!==false){
$bolim = explode("=",$data)[1];
$new_arr = [];
$k = [];
$a = mysqli_query($connect,"SELECT * FROM cates WHERE category_id = $bolim");
$c = mysqli_num_rows($a);
while($s = mysqli_fetch_assoc($a)){
if(!in_array(enc("decode",$s['name']), $new_arr)){
$new_arr[] = enc("decode",$s['name']);
$k[]=['text'=>enc("decode",$s['name']),'callback_data'=>"delFolm=".$s['cate_id']];
}
}
$keyboard2=array_chunk($k,1);
$keyboard2[]=[['text'=>"⬅️ Orqaga",'callback_data'=>"absd"]];
$kb=json_encode([
'inline_keyboard'=>$keyboard2,
]);
if(!$c){
	bot('answerCallbackQuery',[
		'callback_query_id'=>$qid,
		'text'=>"⚠️ Ushbu bo'lim uchun xizmat turlari topilmadi!",
		'show_alert'=>true,
		]);
	}else{
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
     'text'=>"<b>⭐ Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$kb
]);
}
}

if(mb_stripos($data, "delFolm=")!==false){
	$ex = explode("=",$data)[1];

$qd = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM cates WHERE cate_id  = $ex"));
$sa=$qd['cate_id'];
$d = enc("decode",$qd['name']);
mysqli_query($connect,"DELETE FROM services WHERE category_id=$sa");
mysqli_query($connect,"DELETE FROM cates WHERE cate_id=$ex");
     bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
]);
   bot('sendMessage',[
   'chat_id'=>$cid2,
       'text'=>"Ichki bo'lim olib tashlandi!",
'parse_mode'=>'html',
'reply_markup'=>$panel2
]);

}


if($data == "newFold"){
$a = mysqli_query($connect,"SELECT * FROM categorys");
while($s = mysqli_fetch_assoc($a)){
$k[]=['text'=>enc("decode",$s['category_name']),'callback_data'=>"adFol=".$s['category_id']];
}

$keyboard2=array_chunk($k,3);
$kb=json_encode([
'inline_keyboard'=>$keyboard2,
]);
     bot('editMessageText',[
        'chat_id'=>$chat_id,
       'message_id'=>$message_id,
       'text'=>"<b>⭐ Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$kb
]);
}


if(mb_stripos($data, "adFol=")!==false){
	$ex = explode("=",$data)[1];
	file_put_contents("set/c.txt",$ex);
	bot('deleteMessage',[
	'chat_id'=>$chat_id,
	'message_id'=>$message_id,
]);
   bot('sendMessage',[
   'chat_id'=>$chat_id,
   'text'=>"<b>📋 Yangi ichki bo'lim nomini yuboring:</b>",
   'parse_mode'=>'html',
   'reply_markup'=>$aort
]);
file_put_contents("user/$chat_id.step",'newFold');
}

if($step=="newFold") {
sms($cid,"📝 Ushbu bo‘limga kirish uchun 1 martalik to‘lov qilinsinmi?",inline([
[['text'=>"Ha",'callback_data'=>"opFol=true"],['text'=>"Yo‘q",'callback_data'=>'opFol=false']],
]));
put("user/$cid.step",'newFold2');
put("set/cs.txt",enc('encode',$text));
}
if((stripos($data,'opFol=')!==false and $stepc)){
	$y = explode("=",$data)[1];
	if($y=="true") {
		sms($chat_id,"?? Ushbu bo‘limga kirish narxini kiriting
		
		*️⃣ Namuna: 10000",null);
		put("user/$chat_id.step",'newFold3');
	}elseif($y=="false") {
		$ci=get("set/c.txt");
$to=get("set/cs.txt");
$open = json_encode(['open'=>false,'price'=>0]);
mysqli_query($connect,"INSERT INTO cates(`name`,`category_id`,`open`) VALUES ('$to','$ci','$open')");
sms($chat_id,"Ichki bo'lim qo'shildi!",null);
unlink("user/$chat_id.step");
}
}


	
	
	
	
if($step == "newFold3"){
		if(isset($text)){
$ci=get("set/c.txt");
$to=get("set/cs.txt");
$open = json_encode(['open'=>true,'price'=>$text]);
mysqli_query($connect,"INSERT INTO cates(`name`,`category_id`,`open`) VALUES ('$to','$ci','$open')");
		bot('sendMessage',[
		'chat_id'=>$cid,
		'text'=>"Ichki bo'lim qo'shildi!",
		'parse_mode'=>'html',
		'reply_markup'=>$panel2
]);
unlink("user/$cid.step");

}
}


if($data == "xizmat"){
     bot('editMessageText',[
        'chat_id'=>$chat_id,
       'message_id'=>$message_id,
       'text'=>"<b>⭐ Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Yangi xizmat qo'shish",'callback_data'=>"newXiz"]],
[['text'=>"📥 Xizmatlarni yuklab olish",'callback_data'=>"uplXiz"]],
[['text'=>"📝 Tahrirlash",'callback_data'=>"editXiz"]],
[['text'=>"🗑️ O'chirish",'callback_data'=>"delXiz"]],
[['text'=>"⬅️ Orqaga", 'callback_data'=>"xsetting"]],
]
])
]);
}

if($data == "uplXiz"){
$a = mysqli_query($connect,"SELECT * FROM categorys");
$c = mysqli_num_rows($a);
while($s = mysqli_fetch_assoc($a)){
$k[]=['text'=>enc("decode",$s['category_name']),'callback_data'=>"uplad=".$s['category_id']];
}
$keyboard2=array_chunk($k,3);
$kb=json_encode([
'inline_keyboard'=>$keyboard2,
]);
if(!$c){
	bot('answerCallbackQuery',[
		'callback_query_id'=>$qid,
		'text'=>"⚠️ Bo‘limlar topilmadi!",
		'show_alert'=>true,
		]);
	}else{
     bot('editMessageText',[
        'chat_id'=>$chat_id,
       'message_id'=>$message_id,
       'text'=>"<b>⭐ Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$kb
]);
}
}


if(mb_stripos($data, "uplad=")!==false){
$n = explode("=",$data)[1];
$upx = json_decode(get("set/upladd.json"),1);
$upx['category_id']=$n;
file_put_contents("set/upladd.json",json_encode($upx,JSON_PRETTY_PRINT));
$new_arr = [];
$k = [];
$a = mysqli_query($connect,"SELECT * FROM cates WHERE category_id = $n");
$c = mysqli_num_rows($a);
while($s = mysqli_fetch_assoc($a)){
if(!in_array(enc("decode",$s['name']), $new_arr)){
$new_arr[] = enc("decode",$s['name']);
$k[]=['text'=>enc("decode",$s['name']),'callback_data'=>"uplads-".$s['cate_id']];
}
}
$keyboard2=array_chunk($k,1);
$keyboard2[]=[['text'=>"⬅️ Orqaga",'callback_data'=>"uplXiz"]];
$kb=json_encode([
'inline_keyboard'=>$keyboard2,
]);
if(!$c){
	bot('answerCallbackQuery',[
		'callback_query_id'=>$qid,
		'text'=>"⚠️ Ushbu bo'lim uchun xizmat turlari topilmadi!",
		'show_alert'=>true,
		]);
	}else{
bot('editMessageText',[
        'chat_id'=>$chat_id,
       'message_id'=>$message_id,
'text'=>"<b>⭐ Quyidagilardan birini tanlang:</b>",
   'parse_mode'=>'html',
   'reply_markup'=>$kb
]);
}
}

if(stripos($data,"uplads-")!==false){
$n = explode("-",$data)[1];
$upx = json_decode(get("set/upladd.json"),1);
$upx['cate_id']=$n;
file_put_contents("set/upladd.json",json_encode($upx,JSON_PRETTY_PRINT));
$pr=0;
$prs="";
$a = mysqli_query($connect,"SELECT * FROM providers");
$c = mysqli_num_rows($a);
while($s = mysqli_fetch_assoc($a)){
$pr++;
$prtxt=str_replace(["/api/adapter/default/index","/api/v1","/api/v2","https://"],["","","",""],$s['api_url']);
$prs.="<b>".$pr."</b>: $prtxt\n";
$k[]=['text'=>$pr,'callback_data'=>"uplprv-".$s['id']];
}
$keyboard2=array_chunk($k,3);
$kb=json_encode([
'inline_keyboard'=>$keyboard2,
]);
if(!$c){

	bot('answerCallbackQuery',[
		'callback_query_id'=>$qid,
		'text'=>"⚠️ Provayderlar topilmadi!",
		'show_alert'=>true,
		]);
	}else{
		del();
     bot('sendMessage',[
        'chat_id'=>$chat_id,
       'text'=>"<b>🔑 Provayderni tanlang:
 
$prs</b>",
'parse_mode'=>"HTML",
'reply_markup'=>$kb,
]);

}
}

if(stripos($data,"uplprv-")!==false){
$n = explode("-",$data)[1];
$upx = json_decode(get("set/upladd.json"),1);
$upx['provider']=$n;
file_put_contents("set/upladd.json",json_encode($upx,JSON_PRETTY_PRINT));
edit($chat_id,$message_id,"<b>🔑 Provayderning API valyutasini tanlang:</b>",json_encode([
inline_keyboard=>[
[['text'=>"UZS",'callback_data'=>"uplval-UZS-".$upx['provider']]],
[['text'=>"USD",'callback_data'=>"uplval-USD-".$upx['provider']]],
[['text'=>"RUB",'callback_data'=>"uplval-RUB-".$upx['provider']]],
[['text'=>"INR",'callback_data'=>"uplval-INR-".$upx['provider']]],
[['text'=>"TRY",'callback_data'=>"uplval-TRY-".$upx['provider']]],
]]));
exit;
}


if(stripos($data,"uplval-")!==false){
$n = explode("-",$data)[1];
$prv = explode("-",$data)[2];
$upx = json_decode(get("set/upladd.json"),1);
$upx['currency']=$n;
file_put_contents("set/upladd.json",json_encode($upx,JSON_PRETTY_PRINT));
$h = json_decode(arr($prv));
$ko=1;
if($h->error) {
bot('answerCallbackQuery',[
		'callback_query_id'=>$qid,
		'text'=>"⚠️ Serverda nosozlik

Qaytadan urining",
		'show_alert'=>true,
		]);
		exit;
		}else{
for($i=0;$i<=15;$i++){
if($h->results[$i]->name){
$arr3 []=['text'=>"".$h->results[$i]->name."",'callback_data'=>"apload=$i=$prv"];
}
}
}
$arr = array_chunk($arr3,1);
$arr[]=[['text'=>"⬅️ Orqaga",'callback_data'=>"xizmat"],['text'=>"▶️ Keyingi",'callback_data'=>"nexti=next=$prv=$ko=$i"]];
$kb = json_encode([
'inline_keyboard'=>$arr,
]);

edit($chat_id,$message_id,"<b>⭐ Kerakli xizmat turini tanlang</b>",$kb);

}

if((stripos($data,"nexti=")!==false)){
$res=explode("=",$data)[1];
$prv=explode("=",$data)[2];
$ko=explode("=", $data)[3];
$kl=explode("=",$data)[4];
$h = json_decode(arr($prv));
$ko=$kl;
if($h->error) {
bot('answerCallbackQuery',[
		'callback_query_id'=>$qid,
		'text'=>"⚠️ Serverda nosozlik

Qaytadan urining",
		'show_alert'=>true,
		]);
		exit;
		}else{
if($res=="next"){
$ma = $kl+15;
}
if($res=="back"){
$ma = $kl-15;
}
for($i=$kl;$i<=$ma;$i++){
$d = $h->results[$i]->name ? $h->results[$i]->name : "";
if($h->results[$i]->name){
$arr2[]=['text'=>$d,'callback_data'=>"apload=$i=$prv"];
}}
$arr3=$arr2 ?? "false";
if($arr3=="false"){
accl($qid,"⚠️ Boshqa qator qolmadi",1);
exit;
}
$arr = array_chunk($arr3,1);

$arr[]=[['text'=>"◀️ Orqaga",'callback_data'=>"nexti=back=$prv=$ko=$i"],['text'=>"📥 Yangi xizmat yuklash",'callback_data'=>"uplXiz"],['text'=>"▶️ Keyingi",'callback_data'=>"nexti=next=$prv=$ko=$i"]];
$kb = json_encode([
'inline_keyboard'=>$arr,
]);
edit($chat_id,$message_id,"<b>⭐ Kerakli xizmat turini tanlang:</b>",$kb);
exit();
}
}

if((stripos($data,"apload=")!==false)){
$qa = explode("=", $data)[1];
$qa=$qa+1;
$prv=explode("=",$data)[2];
$h = json_decode(arr($prv),1);
if($h['error']){
bot('answerCallbackQuery',[
		'callback_query_id'=>$qid,
		'text'=>"⚠️ Serverda nosozlik
	
Qaytadan urining",
		'show_alert'=>true,
		]);
exit;
		}
foreach($h['results'] as $vs){
if($vs['id']==$qa){
$nq = $vs['name'] ? $nq=$vs['name'] : "";
}
}
bot('answerCallbackQuery',[
		'callback_query_id'=>$qid,
		'text'=>"$nq - uchun xizmatlar qidirilmoqda

Iltimos kuting...",
		'show_alert'=>true,
		]);
$upx = json_decode(get("set/upladd.json"),1);
$upx['category']=$nq;
file_put_contents("set/upladd.json",json_encode($upx,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
$s = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `providers` WHERE id = $prv"));
$j=json_decode(file_get_contents("copies/".$prv.".txt"),1);
$service_count = 0;
$serviceid = 0;
foreach($j as $el){
if($el['category']==$nq){

$service_count++;
$serviceid++;

/*if(mb_stripos($el['name']," - ")!==false){
	$name=explode(" - ",$el["name"]);
	$name = trim($name[1]);
	}else{
	$name = $el['name'];
	}*/
$name = $el['name'];
$txe = $el['service'];
$min=$el["min"];
$max=$el["max"];
$type=$el['type'];
$service_ide=$el['service'];
$cancel=$el['cancel'] ? 'true':'false';
$dripfeed=$el['dripfeed'] ? 'true':'false';
$refill=$el['refill'] ? 'true':'false';

$k[]=['text'=>"🆔 : $txe $name",'callback_data'=>"couple=$prv=".$txe];
}
}
$ko =array_chunk($k,1);
if(empty($service_count)) {
bot('answerCallbackQuery',[
		'callback_query_id'=>$qid,
		'text'=>"⚠️ Serverda nosozlik
	
Qaytadan urining",
		'show_alert'=>true,
		]);
exit;
}else{
$ko[]=[['text'=>"✅ Barchasini yuklab olish",'callback_data'=>"allapl=$prv"]];
}
$ko[]=[['text'=>"📥 Yangi xizmat yuklash",'callback_data'=>"uplXiz"]];
$ko[]=[['text'=>"⬅️ Orqaga",'callback_data'=>"xizmat"]];
$kb = json_encode([
inline_keyboard=>$ko
]);
edit($chat_id,$message_id,"<b>$nq

🔢 Xizmatlar soni: $service_count - ta</b>",$kb);

}


if((stripos($data,"allapl=")!==false)){
del();
	$prv=explode("=",$data)[1];
$mas=bot('sendMessage',[
		'chat_id'=>$chat_id,
		'text'=>"📂 Yuklab olish boshlandi!..

🔔 Iltimos kuting.",
		])->result->message_id;
		
		$upx = json_decode(get("set/upladd.json"),1);
		
$s = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `providers` WHERE id = $prv"));

$j=json_decode(file_get_contents("copies/".$prv.".txt"),1);
if(empty($j)){
edit($cid2,$mas,"⚠️ Serverda nosozlik

Qaytadan urining",null);
exit;
}else{
$service_id = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM `services`"));
foreach($j as $el){
if($el['category']==$upx['category']){
$service_id++;
/*
if(mb_stripos($el['name']," - ")!==false){
	$name=explode(" - ",$el["name"]);
	$name = trim($name[1]);
	}else{
	$name = $el['name'];
	}*/

$name = $el['name'];
$tas = $el['service'];
$min=$el["min"];
$max=$el["max"];
$rate=$el["rate"];
$type=$el['type'];
$cancel=$el['cancel'] ? 'true':'false';
$dripfeed=$el['dripfeed'] ? 'true':'false';
$refill=$el['refill'] ? 'true':'false';

if($upx['currency']=="USD"){
$fr=get("set/usd");
}elseif($upx['currency']=="RUB"){
$fr=get("set/rub");
}elseif($upx['currency']=="INR"){
$fr=get("set/inr");
}elseif($upx['currency']=="TRY"){
$fr=get("set/try");
}elseif($upx['currency']=="UZS"){
$fr = 1;
}

$foiz=mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM percent WHERE id = 1"))['percent'];
$rate=$rate*$fr;
$rp=$rate/100;
$rp=$rp*$foiz+$rate;


$service_price = $rp;
$category_id=$upx['cate_id'];
$api_service=$prv; 
$api_currency =$upx['currency']; 
$name = str_replace(["𝗾","𝘄","𝗲","𝗿","𝘁","𝘆","𝘂","𝗶","𝗼","𝗽","𝗮","𝘀","𝗱","𝗳","𝗴","𝗵","𝗷","𝗸","𝗹","𝘇","𝘅","𝗰","𝘃","𝗯","𝗻","𝗺","𝗤","??","𝗘","𝗥","𝗧","𝗬","𝗨","𝗜","𝗢","𝗣","𝗔","𝗦","𝗗","𝗙","𝗚","𝗛","𝗝","𝗞","𝗟","𝗭","𝗫","𝗖","𝗩","𝗕","𝗡","𝗠"],["q","w","e","r","t","y","u","i","o","p","a","s","d","f","g","h","j","k","l","z","x","c","v","b","n","m","Q","W","E","R","T","Y","U","I","O","P","A","S","D","F","G","H","J","K","L","Z","X","C","V","B","N","M"], $name);
$service_name = base64_encode(mb_convert_encoding(trans($name),"UTF-8","UTF-8"));
$service_desc=null;
$service_edit = "true";
$sq=mysqli_query($connect,"INSERT INTO 
services(`get_api`,`service_average`,`service_status`,`service_edit`,`service_price`,`category_id`,`service_api`,`api_service`,`api_currency`,`service_type`,`api_detail`,`service_name`,`service_desc`,`service_min`,`service_max`,`type`) VALUES ('on','Malumot yoq','on','$service_edit','$service_price','$category_id','$tas','$api_service','$api_currency','$type','{\"name\":\"$name\",\"min\":\"$min\",\"max\":\"$max\",\"type\":\"$type\",\"cancel\":\"$cancel\",\"refill\":\"$refill\",\"dripfeed\":\"$dripfeed\"}','$service_name','$service_desc','$min','$max','api');");
}
}

edit($chat_id,$mas,"<b>✅ Yuklab olish jarayoni tugallandi.</b>",null);
unlink("user/$chat_id.step");

}
}




if((stripos($data,"couple=")!==false)){
	$prv = explode("=",$data)[1];
	$sd=explode("=",$data)[2];
$mas=bot('sendMessage',[
		'chat_id'=>$chat_id,
		'text'=>"📂 Yuklab olish boshlandi!..

🔔 Iltimos kuting.",
		])->result->message_id;
		
		$upx = json_decode(get("set/upladd.json"),1);
		
$s = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `providers` WHERE id = $prv"));

$j=json_decode(file_get_contents("copies/".$prv.".txt"),1);
if(empty($j)){
edit($cid2,$mas,"⚠️ Serverda nosozlik

Qaytadan urining",null);
exit;
}else{
$service_id = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM `services`"));
foreach($j as $el){
if($el['service']==$sd){
$service_id++;
/*
if(mb_stripos($el['name']," - ")!==false){
	$name=explode(" - ",$el["name"]);
	$name = trim($name[1]);
	}else{
	$name = $el['name'];
	}*/

$name = ($el['name']);
$tas = $el['service'];
$min=$el["min"];
$max=$el["max"];
$rate=$el["rate"];
$type=$el['type'];
$cancel=$el['cancel'] ? 'true':'false';
$dripfeed=$el['dripfeed'] ? 'true':'false';
$refill=$el['refill'] ? 'true':'false';

if($upx['currency']=="USD"){
$fr=get("set/usd");
}elseif($upx['currency']=="RUB"){
$fr=get("set/rub");
}elseif($upx['currency']=="INR"){
$fr=get("set/inr");
}elseif($upx['currency']=="TRY"){
$fr=get("set/try");
}elseif($upx['currency']=="UZS"){
$fr = 1;
}

$foiz=mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM percent WHERE id = 1"))['percent'];
$rate=$rate*$fr;
$rp=$rate/100;
$rp=$rp*$foiz+$rate;


$service_price = $rp;
$category_id=$upx['cate_id'];
$api_service=$prv; 
$api_currency =$upx['currency']; 
$name = str_replace(["𝗾","𝘄","𝗲","𝗿","𝘁","𝘆","𝘂","𝗶","𝗼","𝗽","𝗮","𝘀","𝗱","𝗳","𝗴","𝗵","𝗷","𝗸","𝗹","𝘇","𝘅","𝗰","𝘃","𝗯","𝗻","𝗺","𝗤","𝗪","𝗘","𝗥","𝗧","𝗬","𝗨","𝗜","𝗢","𝗣","𝗔","𝗦","𝗗","𝗙","𝗚","𝗛","𝗝","𝗞","𝗟","𝗭","𝗫","𝗖","𝗩","𝗕","𝗡","𝗠"],["q","w","e","r","t","y","u","i","o","p","a","s","d","f","g","h","j","k","l","z","x","c","v","b","n","m","Q","W","E","R","T","Y","U","I","O","P","A","S","D","F","G","H","J","K","L","Z","X","C","V","B","N","M"], $name);
$service_name = base64_encode(mb_convert_encoding(trans($name),"UTF-8","UTF-8"));
$service_desc=null;
$service_edit = "true";
//mysqli_query($connect,"INSERT INTO services(`service_average`,`service_status`,`service_edit`,`service_price`,`category_id`,`service_api`,`api_service`,`api_currency`,`service_type`,`api_detail`,`service_name`,`service_desc`,`service_min`,`service_max`,`type`) VALUES ('Ma'/lumot yetarli emas','on','$service_edit','$service_price','$category_id','$tas','$api_service','$api_currency','$type','{\"name\":\"$name\",\"min\":\"$min\",\"max\":\"$max\",\"type\":\"$type\",\"cancel\":\"$cancel\",\"refill\":\"$refill\",\"dripfeed\":\"$dripfeed\"}','$service_name','$service_desc','$min','$max','api');");
}
}
if($connect->query("INSERT INTO services(`get_api`,`service_average`,`service_status`,`service_edit`,`service_price`,`category_id`,`service_api`,`api_service`,`api_currency`,`service_type`,`api_detail`,`service_name`,`service_desc`,`service_min`,`service_max`,`type`) VALUES ('on','Malumot yoq','on','$service_edit','$service_price','$category_id','$tas','$api_service','$api_currency','$type','{\"name\":\"$name\",\"min\":\"$min\",\"max\":\"$max\",\"type\":\"$type\",\"cancel\":\"$cancel\",\"refill\":\"$refill\",\"dripfeed\":\"$dripfeed\"}','$service_name','$service_desc','$min','$max','api');") === TRUE){

edit($chat_id,$mas,"<b>✅ Yuklab olish jarayoni tugallandi.</b>",null);
unlink("user/$chat_id.step");
}else{
edit($chat_id,$mas,"⚠️ Yuklab olish jarayonidagi xatolik\n\n".$connect->error,null);
}

}
}




if($data == "editXiz"){
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
       'text'=>"<b>⭐ Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔑 API xizmat IDsini o'zgartirish",'callback_data'=>"editXizmat-service_api"]],
[['text'=>"📝 Xizmat nomini o'zgartirish",'callback_data'=>"editXizmat-service_name"]],
[['text'=>"📋 Malumotlarni o'zgartirish", 'callback_data'=>"editXizmat-service_desc"]],
[['text'=>"💰 Narxini o‘zgartirish",'callback_data'=>"editXizmat-service_price"]],
[['text'=>"🔢 Min buyurtmani o‘zgartirish",'callback_data'=>"editXizmat-service_min"]],
[['text'=>"🔢 Max buyurtmani o‘zgartirish",'callback_data'=>"editXizmat-service_max"]],
[['text'=>"⏰ Bajarilish vaqtini o‘zgartirish",'callback_data'=>"editXizmat-service_average"]],
[['text'=>"📯 Holatini o‘zgartirish",'callback_data'=>"editXizmat-service_status"]],
[['text'=>"#️⃣ API Buyurtmasini o'zgartirish",'callback_data'=>"editXizmat-get_api"]],
[['text'=>"⬅️ Orqaga", 'callback_data'=>"xizmat"]],
]
])
]);
}

if(mb_stripos($data, "editXizmat-")!==false){
$nomi = explode("-",$data)[1];
file_put_contents("user/$cid2.txt",$nomi);
$a = mysqli_query($connect,"SELECT * FROM categorys");
$c = mysqli_num_rows($a);
while($s = mysqli_fetch_assoc($a)){
$k[]=['text'=>enc("decode",$s['category_name']),'callback_data'=>"editXizmats-".$s['category_id']];
}

$keyboard2=array_chunk($k,3);
$keyboard2[]=[['text'=>"⬅️ Orqaga",'callback_data'=>"editXiz"]];
$kb=json_encode([
'inline_keyboard'=>$keyboard2,
]);
if(!$c){
	bot('answerCallbackQuery',[
		'callback_query_id'=>$qid,
		'text'=>"⚠️ Tarmoqlar topilmadi!",
		'show_alert'=>true,
		]);
	}else{
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
       'text'=>"<b>⭐ Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$kb
]);
}
}


if(mb_stripos($data, "editXizmats-")!==false){
$bolim = explode("-",$data)[1];
$new_arr = [];
$k = [];
$a = mysqli_query($connect,"SELECT * FROM cates WHERE category_id = $bolim");
$c = mysqli_num_rows($a);
while($s = mysqli_fetch_assoc($a)){
if(!in_array(enc("decode",$s['name']), $new_arr)){
$new_arr[] = enc("decode",$s['name']);
$k[]=['text'=>enc("decode",$s['name']),'callback_data'=>"editXt-".$s['cate_id']];
}
}
$keyboard2=array_chunk($k,1);
$keyboard2[]=[['text'=>"⬅️ Orqaga",'callback_data'=>"editXizmat-$bolim"]];
$kb=json_encode([
'inline_keyboard'=>$keyboard2,
]);
if(!$c){
	bot('answerCallbackQuery',[
		'callback_query_id'=>$qid,
		'text'=>"⚠️ Ushbu bo'lim uchun xizmat turlari topilmadi!",
		'show_alert'=>true,
		]);
	}else{
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
       'text'=>"<b>⭐ Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$kb
]);
}
}


if(mb_stripos($data, "editXt-")!==false){
$txts = "<b>⭐ Quyidagilardan birini tanlang:</b>\n\n";
$turi = file_get_contents("user/$cid2.txt");
if($turi == "service_status" or $turi == "service_name" or $turi == "service_average"){
$txts.= "⚫ - O'chirilgan xizmat\n\n⚪ - Aktiv xizmat\n\n";
}
$n=explode("-",$data)[1];
$a = mysqli_query($connect,"SELECT * FROM services WHERE category_id = '$n'");
$c = mysqli_num_rows($a);
while($s = mysqli_fetch_assoc($a)){
$as++;
$turi = file_get_contents("user/$cid2.txt");
if($turi == "service_status" or $turi == "service_name" or $turi == "service_average"){
if($s['service_status']=="on")$icon = "⚪";
if($s['service_status']=="off")$icon = "⚫";

}
$txts.="<b>".$as."</b>: ".base64_decode($s['service_name'])."\n";
$k[]=['text'=>$icon." ".$as,'callback_data'=>"editXts-".$s['service_id']];
}
$keyboard2=array_chunk($k,3);
$keyboard2[]=[['text'=>"⬅️ Orqaga",'callback_data'=>"menu"]];
$kb=json_encode([
'inline_keyboard'=>$keyboard2,
]);
if(!$c){
	bot('answerCallbackQuery',[
		'callback_query_id'=>$qid,
		'text'=>" ⚠️ Ushbu bo'lim uchun xizmatlar topilmadi!",
		'show_alert'=>true,
		]);
	}else{
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
    'text'=>"$txts",
'parse_mode'=>'html',
'reply_markup'=>$kb
]);
}
}

if(mb_stripos($data, "editXts-")!==false){
	$xiz = explode("-",$data)[1];
	$turi = file_get_contents("user/$cid2.txt");
if($turi == "get_api"){
 $keyboards = resize([
 [['text'=>"🔔 Yoqish"],['text'=>"🔕 To‘xtatish"]],
 [['text'=>"🗄️ Boshqaruv"]]
 ]);
 }elseif($turi == "service_status"){
 $keyboards = resize([
 [['text'=>"🔔 Yoqish"],['text'=>"🔕 To‘xtatish"]],
 [['text'=>"🗄️ Boshqaruv"]]
 ]);
 }else{
 $keyboards=$boshqaruv;
 }
 
   bot('sendMessage',[
   'chat_id'=>$cid2,
   'text'=>"<b>🔢 Yangi qiymatni kiriting:</b>",
   'parse_mode'=>'html',
   'reply_markup'=>$keyboards
]);
file_put_contents("user/$cid2.step","editXizmatlar-$xiz");

}

if(mb_stripos($step, "editXizmatlar-")!==false){
	$xiz = explode("-",$step)[1];
	$ex = file_get_contents("user/$cid.txt");
	if($cid == $admin and isset($text)){
		if($ex=="service_desc"){
		$ex = file_get_contents("user/$cid.txt");
		$vo = base64_encode($text);
		mysqli_query($connect,"UPDATE services SET service_desc='$vo' WHERE service_id = $xiz");
		}elseif($ex=="service_name"){
		$ex = file_get_contents("user/$cid.txt");
		$vo = base64_encode($text);
		mysqli_query($connect,"UPDATE services SET service_name='$vo' WHERE service_id = $xiz");
		}elseif($ex=="service_api"){
		$ex = file_get_contents("user/$cid.txt");
		$vo = $text;
		mysqli_query($connect,"UPDATE services SET service_api='$vo' WHERE service_id = $xiz");
		}elseif($ex=="service_price"){
		$ex = file_get_contents("user/$cid.txt");
		$vo = $text;
		mysqli_query($connect,"UPDATE services SET service_edit='false', service_price='$vo' WHERE service_id = $xiz");
		}elseif($ex=="service_min"){
		$ex = file_get_contents("user/$cid.txt");
		$vo = $text;
		mysqli_query($connect,"UPDATE services SET service_edit='false', service_min='$vo' WHERE service_id = $xiz");
		}elseif($ex=="service_max"){
		$ex = file_get_contents("user/$cid.txt");
		$vo = $text;
		mysqli_query($connect,"UPDATE services SET service_edit='false', service_max='$vo' WHERE service_id = $xiz");
		}elseif($ex=="service_average"){
		$ex = file_get_contents("user/$cid.txt");
		$vo = $text;
		mysqli_query($connect,"UPDATE services SET service_average='$vo' WHERE service_id = $xiz");
		}elseif($ex=="service_status"){
		$ex = file_get_contents("user/$cid.txt");
		if($text == "🔔 Yoqish") $status = "on";
		if($text == "🔕 To‘xtatish") $status = "off";
		mysqli_query($connect,"UPDATE services SET service_status='$status' WHERE service_id = $xiz");
		}elseif($ex=="get_api"){
		$ex = file_get_contents("user/$cid.txt");
		if($text == "🔔 Yoqish") $status = "on";
		if($text == "🔕 To‘xtatish") $status = "off";
		mysqli_query($connect,"UPDATE services SET get_api='$status' WHERE service_id = $xiz");
		}
		
		
		
		
		
		
		
		
		
		bot('SendMessage',[
		'chat_id'=>$cid,
		'text'=>"<b>✅ Muvaffaqiyatli o'zgartirildi.</b>",
		'parse_mode'=>'html',
		'reply_markup'=>$panel2
]);
unlink("user/$cid.step");

}
}




if($data == "delXiz"){
$a = mysqli_query($connect,"SELECT * FROM categorys");
$c = mysqli_num_rows($a);
while($s = mysqli_fetch_assoc($a)){
$k[]=['text'=>enc("decode",$s['category_name']),'callback_data'=>"deleteXiz-".$s['category_id']];
}
$keyboard2=array_chunk($k,3);
$kb=json_encode([
'inline_keyboard'=>$keyboard2,
]);
if(!$c){
	bot('answerCallbackQuery',[
		'callback_query_id'=>$qid,
		'text'=>"⚠️ Bo‘limlar topilmadi!",
		'show_alert'=>true,
		]);
	}else{
     bot('editMessageText',[
        'chat_id'=>$chat_id,
       'message_id'=>$message_id,
       'text'=>"<b>⭐ Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$kb
]);

}
}

if(mb_stripos($data, "deleteXiz-")!==false){
	$n = explode("-",$data)[1];
   file_put_contents("set/c.txt",$ex);
$new_arr = [];
$k = [];
$a = mysqli_query($connect,"SELECT * FROM cates WHERE category_id = $n");
$c = mysqli_num_rows($a);
while($s = mysqli_fetch_assoc($a)){
if(!in_array(enc("decode",$s['name']), $new_arr)){
$new_arr[] = enc("decode",$s['name']);
$k[]=['text'=>enc("decode",$s['name']),'callback_data'=>"delx-".$s['cate_id']];
}
}
$keyboard2=array_chunk($k,1);
$keyboard2[]=[['text'=>"⬅️ Orqaga",'callback_data'=>"newXiz"]];
$kb=json_encode([
'inline_keyboard'=>$keyboard2,
]);
if(!$c){
	bot('answerCallbackQuery',[
		'callback_query_id'=>$qid,
		'text'=>"⚠️ Ushbu bo'lim uchun xizmat turlari topilmadi!",
		'show_alert'=>true,
		]);
	}else{
bot('editMessageText',[
        'chat_id'=>$chat_id,
       'message_id'=>$message_id,
'text'=>"<b>⭐ Quyidagilardan birini tanlang:</b>",
   'parse_mode'=>'html',
   'reply_markup'=>$kb
]);
}
}

if(mb_stripos($data, "delx-")!==false){
	$n=explode("-",$data)[1];
$as=0;
$a = mysqli_query($connect,"SELECT * FROM services WHERE category_id = '$n'");
$c = mysqli_num_rows($a);
while($s = mysqli_fetch_assoc($a)){
$as++;
$narx = $s['service_price'];
$txts.="<b>".$as."</b>: ".base64_decode($s['service_name'])." $narx - so‘m\n";

$k[]=['text'=>$as,'callback_data'=>"delmat-".$s['service_id']];
}
$keyboard2=array_chunk($k,5);
$kb=json_encode([
'inline_keyboard'=>$keyboard2,
]);
if(!$c){
	bot('answerCallbackQuery',[
		'callback_query_id'=>$qid,
		'text'=>"⚠️ Ushbu bo'lim uchun xizmatlar topilmadi!",
		'show_alert'=>true,
		]);
	}else{
edit($chat_id,$message_id,"<b>👉 O‘zingizga kerakli xizmatni tanlang:

$txts</b>",$kb);

}
}

if(mb_stripos($data, "delmat-")!==false){
$ichki = explode("-",$data)[1];
mysqli_query($connect,"DELETE FROM services WHERE service_id = $ichki");
     
   bot('sendMessage',[
   'chat_id'=>$cid2,
       'text'=>"<b>🗑️ Xizmat o‘chirildi!</b>",
'parse_mode'=>'html',
]);

}







if($data == "newXiz"){
$a = mysqli_query($connect,"SELECT * FROM categorys");
$c = mysqli_num_rows($a);
while($s = mysqli_fetch_assoc($a)){
$k[]=['text'=>enc("decode",$s['category_name']),'callback_data'=>"add=".$s['category_id']];
}
$keyboard2=array_chunk($k,3);
$kb=json_encode([
'inline_keyboard'=>$keyboard2,
]);
if(!$c){
	bot('answerCallbackQuery',[
		'callback_query_id'=>$qid,
		'text'=>"⚠️ Bo‘limlar topilmadi!",
		'show_alert'=>true,
		]);
	}else{
     bot('editMessageText',[
        'chat_id'=>$chat_id,
       'message_id'=>$message_id,
       'text'=>"<b>⭐ Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$kb
]);
}
}


if(mb_stripos($data, "add=")!==false){
$n = explode("=",$data)[1];
file_put_contents("set/c.txt",$n);
$new_arr = [];
$k = [];
$a = mysqli_query($connect,"SELECT * FROM cates WHERE category_id = $n");
$c = mysqli_num_rows($a);
while($s = mysqli_fetch_assoc($a)){
if(!in_array(enc("decode",$s['name']), $new_arr)){
$new_arr[] = enc("decode",$s['name']);
$k[]=['text'=>enc("decode",$s['name']),'callback_data'=>"adds-".$s['cate_id']];
}
}
$keyboard2=array_chunk($k,1);
$keyboard2[]=[['text'=>"⬅️ Orqaga",'callback_data'=>"newXiz"]];
$kb=json_encode([
'inline_keyboard'=>$keyboard2,
]);
if(!$c){
	bot('answerCallbackQuery',[
		'callback_query_id'=>$qid,
		'text'=>"⚠️ Ushbu bo'lim uchun xizmat turlari topilmadi!",
		'show_alert'=>true,
		]);
	}else{
bot('editMessageText',[
        'chat_id'=>$chat_id,
       'message_id'=>$message_id,
'text'=>"<b>⭐ Quyidagilardan birini tanlang:</b>",
   'parse_mode'=>'html',
   'reply_markup'=>$kb
]);
}
}

if(mb_stripos($data, "adds-")!==false){
$pw=explode("-",$data)[1];
$adds=json_decode(get("set/adds.json"),1);
$adds['cate_id']=$pw;
$a = mysqli_query($connect,"SELECT * FROM providers");
$c = mysqli_num_rows($a);
if(!$c){
bot('answerCallbackQuery',[
		'callback_query_id'=>$qid,
		'text'=>"⚠️ Provayderlar topilmadi!",
		'show_alert'=>true,
		]);
	}else{
$adds['category_id']=file_get_contents("set/c.txt");
put("set/adds.json",json_encode($adds,JSON_UNESCAPED_UNICODE));
	bot('deleteMessage',[
	'chat_id'=>$chat_id,
	'message_id'=>$message_id,
]);
   bot('sendMessage',[
   'chat_id'=>$chat_id,
   'text'=>"<b>📋 Yangi xizmat nomini yuboring:</b>",
   'parse_mode'=>'html',
   'reply_markup'=>$aort
]);
file_put_contents("user/$chat_id.step",'servisw');

}
}
if($step == "servisw"){
$pr=0;
$prs="";
$a = mysqli_query($connect,"SELECT * FROM providers");
$c = mysqli_num_rows($a);
while($s = mysqli_fetch_assoc($a)){
$pr++;
$prtxt=str_replace(["/api/v1","/api/v2","https://"],["","",""],$s['api_url']);
$prs.="<b>".$pr."</b>: $prtxt\n";
$k[]=['text'=>$pr,'callback_data'=>"checkC-".$s['id']];
}
$keyboard2=array_chunk($k,3);
$kb=json_encode([
'inline_keyboard'=>$keyboard2,
]);
if(!$c){
	bot('sendMessage',[
		chat_id=>$cid,
		'text'=>"⚠️ Provayderlar topilmadi!",
		]);
	}else{
     bot('sendMessage',[
        'chat_id'=>$cid,
       'text'=>"🔑 Provayderni tanlang:
 
$prs",
'parse_mode'=>"HTML",
'reply_markup'=>$kb,
]);

put("set/adds.json.name",$text);
file_put_contents("user/$cid.step","servis0");

}
}

if((stripos($data,"checkC-")!==false and $stepc=="servis0" and $chat_id==$admin)){
$pw=explode("-",$data)[1];
sms($chat_id,"<b>🔑 Provayderning API xizmatlari bolimida korsatilgan valyutani tanlang</b>:",json_encode([
'inline_keyboard'=>[
[['text'=>"UZS ",'callback_data'=>"checkP-UZS"]],
[['text'=>"USD ",'callback_data'=>"checkP-USD"]],
[['text'=>"RUB ",'callback_data'=>"checkP-RUB"]],
[['text'=>"INR ",'callback_data'=>"checkP-INR"]],
[['text'=>"TRY ",'callback_data'=>"checkP-TRY"]],
[['text'=>"◀️ Orqaga ",'callback_data'=>"del"]],
]]));
$adds=json_decode(get("set/adds.json"),1);
$adds['api_service']=$pw;
put("set/adds.json",json_encode($adds,JSON_UNESCAPED_UNICODE));
file_put_contents("user/$chat_id.step",'servis1');
}

if((stripos($data,"checkP-")!==false and  $stepc=="servis1" and $chat_id==$admin)){
$pw=explode("-",$data)[1];
if(isset($data)){
del();
sms($chat_id,"<b>📝 Xizmat xaqida malumotlar kiriting:

⚠️ Ma'lumot kiritish ni xoxlamasangiz <b>Kiritilmagan</b> tugmasini bosing</b>",json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"Kiritilmagan"]],
[['text'=>"🗄️ Boshqaruv"]],
]]));
$adds=json_decode(get("set/adds.json"),1);
$adds['api_currency']=$pw;
put("set/adds.json",json_encode($adds,JSON_UNESCAPED_UNICODE));
file_put_contents("user/$chat_id.step",'servis2');
}
}
if(($step=="servis2" and $cid==$admin)){
if(isset($text)){
sms($cid,"💵 Buyurtma narxini yuboring (1000 ta) uchun",$aort);
if($text=="Kiritilmagan"){
put("set/adds.json.desc","");
}else{
put("set/adds.json.desc",$text);
}
file_put_contents("user/$cid.step",'servis3');
}
}

if($step == "servis3" and $cid==$admin){
sms($cid,"<b>⏰ Ushbu xizmatning o‘rtacha bajarilish vaqtini yuboring

⚠️ Agar malumotlar yoq bo’lsa «Malumot yoq» tugmasini bosing</b>",json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"Malumot yoq"]],
[['text'=>"🗄️ Boshqaruv"]],
]]));
$adds=json_decode(get("set/adds.json"),1);
$adds['service_price']=$text;
put("set/adds.json",json_encode($adds,JSON_UNESCAPED_UNICODE));
file_put_contents("user/$cid.step",'servis4');

}



if(($step=="servis4" and $cid==$admin)){

sms($cid,"🆔 Xizmat IDsini yuboring:",$aort);
$adds=json_decode(get("set/adds.json"),1);
$adds['service_average']=$text;
put("set/adds.json",json_encode($adds,JSON_UNESCAPED_UNICODE));
file_put_contents("user/$cid.step",'servisID');
}

if($step=="servisID"){
if(is_numeric($text)){
$pw = json_decode(get("set/adds.json"));
$cure = $pw->api_service;
$ap = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM providers WHERE id = $cure"));
$surl=$ap['api_url'];
$skey=$ap['api_key'];
$j=json_decode(get($surl."?key=".$skey."&action=services"), true);
foreach($j as $el){
if($el['service']=="$text"){
$name=urlencode($el["name"]);
$min=$el["min"];
$max=$el["max"];
$rate=$el["rate"];
$rate=$el["rate"];
$type=$el['type'];
$tas = $el['service'];
$cancel=$el['cancel'] ? 'true':'false';
$dripfeed=$el['dripfeed'] ? 'true':'false';
$refill=$el['refill'] ? 'true':'false';
break;
}
}


if(empty($min) and empty($max)){
sms($cid,"<b>🔕 Noma'lum xatolik yuz berdi.

Qaytadan xizmat IDsini yuboring:</b>",null);
}else{
$category_id=$pw->cate_id;
$service_price = $pw->service_price;
$api_service=$pw->api_service; 
$api_currency =$pw->api_currency; 
$average =$pw->service_average; 
$service_name = base64_encode(mb_convert_encoding(get("set/adds.json.name"),"UTF-8","UTF-8"));
$service_desc = base64_encode(get("set/adds.json.desc"));
$service_edit = "true";
if($connect->query("INSERT INTO services(`get_api`,`service_average`,`service_status`,`service_price`,`service_edit`,`category_id`,`service_api`,`api_service`,`api_currency`,`service_type`,`api_detail`,`service_name`,`service_desc`,`service_min`,`service_max`) VALUES ('on','$average','on','$service_price','$service_edit','$category_id','$text','$api_service','$api_currency','$type','{\"name\":\"$name\",\"min\":\"$min\",\"max\":\"$max\",\"type\":\"$type\",\"cancel\":\"$cancel\",\"refill\":\"$refill\",\"dripfeed\":\"$dripfeed\"}','$service_name','$service_desc','$min','$max');")===TRUE){
sms($cid,"<b>✅ Yangi xizmat qo'shildi.</b>",$panel2);
}else{
sms($cid,"⚠️ Hatolik  (MySQL)
". $connect->error."",null);
}

}
}

}




if($text=="💵 Pul kiritish" and joinchat($cid)==1 and phone($cid)==1){
$ops=get("set/payments.txt");
$s=explode("\n",$ops);
$soni = substr_count($ops,"\n");
for($i=1;$i<=$soni;$i++){
$k[]=['text'=>$s[$i],'callback_data'=>"payBot=".$s[$i]];
}
$keyboard2=array_chunk($k,1);
$keyboard2[]=[['text'=>"🔹 Click [ Avto ]",'callback_data'=>"click"]];
$keyboard2[]=[['text'=>"💳 Payme [ Avto ]",'callback_data'=>"paymeuz"]];
//*$keyboard2[]=[['text'=>"🅿️ Payeer [ Avto ]",'callback_data'=>"payeer"]];
$keyboard2[]=[['text'=>"☎️ Admin orqali",url=>"tg://user?id=6044744982"]];
$keyboard2[]=[['text'=>"🔙 Orqaga",'callback_data'=>"menu"]];


$kb=json_encode([
'inline_keyboard'=>$keyboard2,
]);
sms($cid,"<b>👇Pastdagi berilgan tugmalardan birini tanlang va to'lov summasini kiriting hamda sizga berilgan havola orqali to'lovni amalga oshiring va tasdiqlang!

 ⚠️ Diqqat! Barcha to'lov tizimlari xavfsiz siz to'lov qilganinggizdan so'ng kartangizdan ortiqcha pul yechilmaydi va kartangizga ulanilmaydi. Bot hisobidagi pulingizni qaytarish imkoni yo'q iltimos hisobingizni kerakli miqdorda to'ldiring! Click, Payeer to'lov tizimlari bilan shartnoma asosida qonuniy hamkorlik qilingan❗️

👤 ID raqam: <code>".$rew['user_id']."</code></b>",$kb);
}


if($text=="⚙️ Asosiy sozlamalar" and $cid==$admin){
sms($cid,$text,$panel2);
}


if($text=="💵 Kursni o‘rnatish" and $cid==$admin){
sms($cid,"💵 <b>Valyuta kurslar ro‘yxati.</b>",json_encode([
'inline_keyboard'=>[
[['text'=>"AQSH dollari ($)",'callback_data'=>"course=usd"]],
[['text'=>"Rossiya rubli (₽)",'callback_data'=>"course=rub"]],
[['text'=>"Hindston rupiysi (₹)",'callback_data'=>"course=inr"]],
[['text'=>"Turkiya lirasi (₺)",'callback_data'=>"course=try"]],
[['text'=>"🔙 Orqaga",'callback_data'=>"menu"]],
]]));

}

if((stripos($data,"course=")!==false)){
$val=explode("=",$data)[1];
if(get("set/".$val."")){
$VAL=get("set/".$val);
}else{
$VAL=0;
}
del();
sms($chat_id,"<b>1 - ".strtoupper($val)." narxini kiriting:

♻️ Joriy narx: ".$VAL." so‘m</b>",$aort);
put("user/$chat_id.step","course=$val");
}

if((mb_stripos($step,"course=")!==false and is_numeric($text))){
$val=explode("=",$step)[1];
put("set/".$val,"$text");
sms($cid,"
✅ 1 - ".strtoupper($val)." narxi $text so‘mga o‘zgardi",$panel);
unlink("user/$cid.step");

}


if($text=="⚖️ Foizni o‘rnatish" and $cid==$admin){
$m = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM percent WHERE id = 1"))['percent'];
$m ? $m : 0;
sms($cid,"<b>⭐ Bot xizmatlari uchun foizni kiriting

♻️ Joriy foiz: $m%</b>",$aort);
put("user/$cid.step","updFoiz");

}

if($step=="updFoiz"){
if(is_numeric($text)){
mysqli_query($connect,"UPDATE percent SET percent = '$text' WHERE id = 1");
$m = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM percent WHERE id = 1"))['api'];
$m ? $m : 0;
sms($cid,"<b>✅ O‘zgartirish muvaffaqiyatli bajarildi.</b>",$panel);
}
put("user/$cid.step","");
}


$saved = file_get_contents("user/us.id");

if($text=="👤 Foydalanuvchi" and $cid==$admin){
if($cid == $admin){
$keybot = json_encode([
'inline_keyboard'=>[
[['text'=>"🔹 Tartib raqam orqali",'callback_data'=>"orqali=user_id"]],
[['text'=>"🔹 ID raqam orqali",'callback_data'=>"orqali=id"]],
]]);
sms($cid,"<b>📋 Quyidagilardan birini tanlang:</b>",$keybot);
}
}

if(mb_stripos($data,"orqali=")!==false){
$by=explode("=",$data)[1];
if($by=="id"){$k="ID";}else{$k="tartib";}
del();
sms($cid2,"<b>Foydalanuvchi $k raqamini kiriting:</b>",$aort);
put("user/$cid2.step","by—$by");
exit();
}
if(mb_stripos($step,"by—")!==false){
$bz=explode("—",$step)[1];
if($cid == $admin){
$rew = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM users WHERE $bz = $text"));
if($rew){
$idi = $rew['id'];
$id = $rew['id'];
file_put_contents("user/us.id",$idi);
$pul = floor($rew['balance']);
$pullar = floor($rew['outing']);
$ban = $rew['status'];
$number = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM phone WHERE user_id = $idi"));
$numbers = $number['phone'];
$key = $rew['api_key'];
$status = $rew['status'];
if($ban == "active"){
 $bans = "🔔 Banlash";
}
if($ban == "deactive"){
 $bans = "🔕 Bandan olish";
}


bot('sendMessage',[
      'chat_id'=>$cid,
     'message_id'=>$mid + 1,
'text'=>"<b>👤 Foydalanuvchi topildi!

<b>🆔 ID:</b> <a href='tg://user?id=$idi'>$text</a></b>
<b>👤 Tartib raqam:</b> <code>$idi</code>
<b>💵 Balans: $pul so‘m</b>
<b>💰 Kiritgan pullari: $pullar soʻm</b>
<b>☎️ Raqam: +$numbers</b>
<b>🔑 Api kalit: <code>$key</code></b>
<b>♻️ Holati: $status</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
 'inline_keyboard'=>[
[['text'=>"$bans",'callback_data'=>"ban"]],
[['text'=>"➕ Pul qo'shish",'callback_data'=>"plus"],['text'=>"➖ Pul ayirish",'callback_data'=>"minus"]],
[['text'=>"🔙 Orqaga",'callback_data'=>"menu"]]
]
])
]);
unlink("user/$cid.step");
}else{
bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Foydalanuvchi topilmadi.</b>

Qayta urinib ko'ring:",
'parse_mode'=>'html',
]);
}
}

}

if($data == "plus"){
bot('sendMessage',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>"<a href='tg://user?id=$saved'>$saved</a> <b>ning hisobiga qancha pul qo'shmoqchisiz?</b>",
'parse_mode'=>"html",
	'reply_markup'=>$aort,
]);
file_put_contents("user/$chat_id.step",'plus');

}

if($step == "plus"){
if($cid == $admin){
if(is_numeric($text)=="true"){
bot('sendMessage',[
'chat_id'=>$saved,
'text'=>"<b>💳 Hisobingizga $text so‘m qo'shildi</b>",
'parse_mode'=>"html",
'reply_markup'=>$menu,
]);
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Foydalanuvchi hisobiga $text so‘m qo'shildi!</b>",
'parse_mode'=>"html",
'reply_markup'=>$panel,
]);
$rew = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM users WHERE id = $saved"));
$miqdor = $text+$rew['balance'];
$p2 =$text+$rew['outing'];
mysqli_query($connect,"UPDATE users SET balance=$miqdor, outing=$p2 WHERE id =$saved");
unlink("user/$cid.step");
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Faqat raqamlardan foydalaning!</b>",
'parse_mode'=>'html',
'protect_content'=>true,
]);

}
}

}

if($data == "minus"){
bot('sendMessage',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>"<a href='tg://user?id=$saved'>$saved</a> <b>ning hisobidan qancha pul ayirmoqchisiz?</b>",
'parse_mode'=>"html",
	'reply_markup'=>$aort,
]);
file_put_contents("user/$chat_id.step",'minus');

}

if($step == "minus"){
if($cid == $admin){
if(is_numeric($text)=="true"){
bot('sendMessage',[
'chat_id'=>$saved,
'text'=>"<b>💳 Hisobingizdan $text so‘m olindi.</b>",
'parse_mode'=>"html",
'reply_markup'=>$menu, 
]);
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Foydalanuvchi hisobidan $text so‘m olindi!</b>",
'parse_mode'=>"html",
'reply_markup'=>$panel,
]);
$rew = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM users WHERE id = $saved"));
$miqdor =$rew['balance'] - $text;
$p2 =$rew['outing'] - $text;
mysqli_query($connect,"UPDATE users SET balance=$miqdor WHERE id =$saved");
unlink("user/$cid.step");
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Faqat raqamlardan foydalaning!</b>",
'parse_mode'=>'html',
'protect_content'=>true,
]);
}
}

}

if($data=="ban"){
$rew = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM users WHERE id = $saved"));
if($admin!=$saved){
if($rew['status'] == "deactive"){
mysqli_query($connect,"UPDATE users SET status='active' WHERE id =$saved");
bot('sendMessage',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>"<b>Foydalanuvchi ($saved) bandan olindi!</b>",
'parse_mode'=>"html",
	'reply_markup'=>$panel,
]);
}else{
mysqli_query($connect,"UPDATE users SET status='deactive' WHERE id =$saved");
bot('sendMessage',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>"<b>Foydalanuvchi ($saved) banlandi!</b>",
'parse_mode'=>"html",
	'reply_markup'=>$panel,
]);
}
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$qid,
'text'=>"Bloklash mumkin emas!",
'show_alert'=>true,
]);
}

}


if($data=="result" and joinchat($chat_id)==1){
if(joinchat($chat_id)==1){
	$usid = get("user/$chat_id.id");
$pul = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM users WHERE id=$usid"))['balance'];
$a = $pul+enc("decode",$setting['referal']);
mysqli_query($connect,"UPDATE users SET balance = $a WHERE id = $usid");
$text = "
<a href='tg://user?id=$chat_id'>✅ Foydalanuvchi</a> <b> botimizdan foydalanib boshladi!</b>

Hisobingizga ".enc("decode",$setting['referal'])." so‘m qo'shildi!";
sms($usid,"$text",$m);
$p = get("user/$usid.users");
put("user/$usid.users",$p+1);
unlink("user/$chat_id.id");
}
del();
sms($chat_id,"🖥️ Asosiy menyudasiz",$m);

}



if($data == "buyurtmalarim"){
$key = [];
$sql = "SELECT * FROM `myorder` WHERE `user_id` = '$cid2' ORDER BY order_id DESC LIMIT 0,5";
$res = mysqli_query($connect,$sql);
while($row = mysqli_fetch_assoc($res)){
$uidOrder = $row['order_id'];
$xolat = $row['status'];
if($xolat == "Completed"){
$tgsti = "✅";
}elseif($xolat == "Pending"){
$tgsti = "⏳";
}elseif($xolat == "In progress"){
$tgsti = "⏱️";
}elseif($xolat == "Canceled"){
$tgsti = "❌";
}elseif($xolat == "Processing"){
$tgsti = "🔄";
}elseif($xolat == "Partial"){
$tgsti = "💡";
}else{
$tgsti = "❗️ Ma'lumot yo'q.";
}
$xizmatName = base64_decode($turi);
$barcha .= "<b>$uidOrder - $tgsti ".trans($row['status'])."</b>\n\n";
}
$result = mysqli_query($connect, "SELECT * FROM `myorder` WHERE `user_id` = '$cid2'");
$row = mysqli_fetch_assoc($result);
if($row){
$getstat = mysqli_query($connect, "SELECT * FROM `myorder` WHERE `user_id` = '$cid2'");
$stat = mysqli_num_rows($getstat);
$get_st = ceil($stat/5);
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>🆔 Buyurtma idsi - 📯 Holati</b>\n\n$barcha",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"1/$get_st",'callback_data'=>"#null"],['text'=>"➡️",'callback_data'=>"keyingi=5=1"]],
[['text'=>"♻️ Qayta tiklash",'callback_data'=>"tiklash"]],
[['text'=>"🔎 Buyurtma ma'lumoti",'callback_data'=>"myordersearchid"]],
]
])
]);
exit();
}else{
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>🤷‍♂️ Sizga tegishli buyurtmalar topilmadi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$home
]);
exit();
}
}

if($text == "🛒 Buyurtmalar"){
$key = [];
$sql = "SELECT * FROM `myorder` WHERE `user_id` = '$cid' ORDER BY order_id DESC LIMIT 0,5";
$res = mysqli_query($connect,$sql);
while($row = mysqli_fetch_assoc($res)){
$uidOrder = $row['order_id'];
$xolat = $row['status'];
if($xolat == "Completed"){
$tgsti = "✅";
}elseif($xolat == "Pending"){
$tgsti = "⏳";
}elseif($xolat == "In progress"){
$tgsti = "⏱️";
}elseif($xolat == "Canceled"){
$tgsti = "❌";
}elseif($xolat == "Processing"){
$tgsti = "🔄";
}elseif($xolat == "Partial"){
$tgsti = "💡";
}else{
$tgsti = "❗️ Ma'lumot yo'q.";
}
$xizmatName = base64_decode($turi);
$barcha .= "<b>$uidOrder - $tgsti ".trans($row['status'])."</b>\n\n";
}
$result = mysqli_query($connect, "SELECT * FROM `myorder` WHERE `user_id` = '$cid'");
$row = mysqli_fetch_assoc($result);
if($row){
$getstat = mysqli_query($connect, "SELECT * FROM `myorder` WHERE `user_id` = '$cid'");
$stat = mysqli_num_rows($getstat);
$get_st = ceil($stat/5);
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🆔 Buyurtma idsi - 📯 Holati</b>\n\n$barcha",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"1/$get_st",'callback_data'=>"#null"],['text'=>"➡️",'callback_data'=>"keyingi=5=1"]],
[['text'=>"♻️ Qayta tiklash",'callback_data'=>"tiklash"]],
[['text'=>"🔎 Buyurtma ma'lumoti",'callback_data'=>"myordersearchid"]],
]
])
]);
exit();
}else{
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🤷‍♂️ Sizga tegishli buyurtmalar topilmadi</b>",
'parse_mode'=>'html',
'reply_markup'=>$home
]);
exit();
}
}


if(mb_stripos($data, "keyingi=")!==false){
$explodes = explode("=",$data);
$explode = $explodes[1];
$nexts_1 = $explodes[2];
$next_1 = $nexts_1 + 1;
$explode1 = $explode + 5;
$key = [];
$sql = "SELECT * FROM `myorder` WHERE `user_id` = '$cid2'  ORDER BY order_id DESC LIMIT $explode,5";
$res = mysqli_query($connect,$sql);
while($row = mysqli_fetch_assoc($res)){
$uidOrder = $row['order_id'];
$xolat = $row['status'];
if($xolat == "Completed"){
$tgsti = "✅";
}elseif($xolat == "Pending"){
$tgsti = "⏳";
}elseif($xolat == "In progress"){
$tgsti = "⏱️";
}elseif($xolat == "Canceled"){
$tgsti = "❌";
}elseif($xolat == "Processing"){
$tgsti = "🔄";
}elseif($xolat == "Partial"){
$tgsti = "💡";
}else{
$tgsti = "❗️ Ma'lumot yo'q.";
}
$xizmatName = base64_decode($turi);
$barcha .= "<b>$uidOrder - $tgsti ".trans($row['status'])."</b>\n\n";
}
$result = mysqli_query($connect, "SELECT * FROM `myorder` WHERE `user_id` = '$cid2' ORDER BY order_id DESC LIMIT $explode,5");
$row = mysqli_fetch_assoc($result);
if($row){
$getstat = mysqli_query($connect, "SELECT * FROM `myorder` WHERE `user_id` = '$cid2'");
$stat = mysqli_num_rows($getstat);
$get_st = ceil($stat/5);
if($next_1 == $get_st){
$tug_1 = json_encode([
'inline_keyboard'=>[
[['text'=>"⬅️",'callback_data'=>"orqaga=$explode=$nexts_1"],['text'=>"$next_1/$get_st",'callback_data'=>"#null"]],
[['text'=>"♻️ Qayta tiklash",'callback_data'=>"tiklash"]],
[['text'=>"🔎 Buyurtma ma'lumoti",'callback_data'=>"myordersearchid"]],
]
]);
}else{
$tug_1 = json_encode([
'inline_keyboard'=>[
[['text'=>"$next_1/$get_st",'callback_data'=>"#null"]],
[['text'=>"⬅️",'callback_data'=>"orqaga=$explode=$nexts_1"],['text'=>"➡️",'callback_data'=>"keyingi=$explode1=$next_1"]],
[['text'=>"♻️ Qayta tiklash",'callback_data'=>"tiklash"]],
[['text'=>"🔎 Buyurtma ma'lumoti",'callback_data'=>"myordersearchid"]],
]
]);
}
bot('EditMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2, 
'text'=>"<b>🆔 Buyurtma idsi - 📯 Holati</b>\n\n$barcha",
'parse_mode'=>'html',
'reply_markup'=>$tug_1,
]);
exit();
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$cqid,
'text'=>"⚠️ Boshqa qator qomadi",
'show_alert'=>true
]);
exit();
}
}

if(mb_stripos($data, "orqaga=")!==false){
$explodes = explode("=",$data);
$explode = $explodes[1];
$backs_1 = $explodes[2];
if($explode == "0"){
bot('answerCallbackQuery',[
'callback_query_id'=>$cqid,
'text'=>"⚠️ Boshqa qator qomadi",
'show_alert'=>true
]);
exit();
}else{
$explode1 = $explode - 5;
$key = [];
$sql = "SELECT * FROM `myorder` WHERE `user_id` = '$cid2' ORDER BY order_id DESC LIMIT $explode1,5";
$res = mysqli_query($connect,$sql);
while($row = mysqli_fetch_assoc($res)){
$uidOrder = $row['order_id'];
$xolat = $row['status'];
if($xolat == "Completed"){
$tgsti = "✅";
}elseif($xolat == "Pending"){
$tgsti = "⏳";
}elseif($xolat == "In progress"){
$tgsti = "⏱️";
}elseif($xolat == "Canceled"){
$tgsti = "❌";
}elseif($xolat == "Processing"){
$tgsti = "🔄";
}elseif($xolat == "Partial"){
$tgsti = "💡";
}else{
$tgsti = "❗️ Ma'lumot yo'q.";
}
$xizmatName = base64_decode($turi);
$barcha .= "<b>$uidOrder - $tgsti ".trans($row['status'])."</b>\n\n";
}
$result = mysqli_query($connect, "SELECT * FROM `myorder` WHERE `user_id` = '$cid2' ORDER BY order_id DESC LIMIT $explode1,5");
$row = mysqli_fetch_assoc($result);
if($row){
$getstat = mysqli_query($connect, "SELECT * FROM `myorder` WHERE `user_id` = '$cid2'");
$stat = mysqli_num_rows($getstat);
$get_st = ceil($stat/5);
if($backs_1 == 1){
$tug_1 = json_encode([
'inline_keyboard'=>[
[['text'=>"$backs_1/$get_st",'callback_data'=>"#null"],['text'=>"➡️",'callback_data'=>"keyingi=$explode=$backs_1"]],
[['text'=>"♻️ Qayta tiklash",'callback_data'=>"tiklash"]],
[['text'=>"🔎 Buyurtma ma'lumoti",'callback_data'=>"myordersearchid"]],
]
]);
}else{
$tug_1 = json_encode([
'inline_keyboard'=>[
[['text'=>"$backs_1/$get_st",'callback_data'=>"#null"]],
[['text'=>"⬅️",'callback_data'=>"orqaga=$explode1=$back_1"],['text'=>"➡️",'callback_data'=>"keyingi=$explode=$backs_1"]],
[['text'=>"♻️ Qayta tiklash",'callback_data'=>"tiklash"]],
[['text'=>"🔎 Buyurtma ma'lumoti",'callback_data'=>"myordersearchid"]],
]
]);
}
bot('EditMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2, 
'text'=>"<b>🆔 Buyurtma idsi - 📯 Holati</b>\n\n$barcha",
'parse_mode'=>'html',
'reply_markup'=>$tug_1,
]);
exit();
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$cqid,
'text'=>"⚠️ Xatolik:",
'show_alert'=>true
]);
exit();
}
}
}


if($data == "tiklash"){
$key = [];
$sirta = mysqli_query($connect, "SELECT * FROM `myorder` WHERE `refill` = 'tr=$cid2'");
$alstat = mysqli_num_rows($sirta);
$sql = "SELECT * FROM `myorder` WHERE `refill` = 'tr=$cid2' ORDER BY order_id DESC LIMIT 0,20";
$res = mysqli_query($connect,$sql);
while($row = mysqli_fetch_assoc($res)){
$uidOrder = $row['order_id'];
$xolat = $row['status'];
if($xolat == "Completed"){
$tgsti = "✅ Bajarildi";
}elseif($xolat == "Pending" or $xolat == "In progress"){
$tgsti = "🔄 Bajarilmoqda...";
}elseif($xolat == "Canceled"){
$tgsti = "⛔ Buyurtma bekor qilingan.";
}elseif($xolat == "Processing"){
$tgsti = "♻️ Qayta ishlash";
}elseif($xolat == "Partial"){
$tgsti = "✔️ Qisman";
}else{
$tgsti = "❗️ Ma'lumot mavjud emas.";
}
$xizmatName = base64_decode($turi);
$key[] = ["text"=>"♻️ $uidOrder","callback_data"=>"refill=$uidOrder"];
$keyboard2 = array_chunk($key, 2);
if($alstat == 20){
$keyboard2[] = [['text'=>"⏩",'callback_data'=>"reafill=next=20"]];
$keyboard2[] = [['text'=>"🔙 Orqaga",'callback_data'=>"buyurtmalarim"]];
}else{
$keyboard2[] = [['text'=>"🔙 Orqaga",'callback_data'=>"buyurtmalarim"]];
}
$keyboard = json_encode([
'inline_keyboard'=>$keyboard2
]);
}
$result = mysqli_query($connect, "SELECT * FROM `myorder` WHERE `refill` = 'tr=$cid2'");
$row = mysqli_fetch_assoc($result);
if($row){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>♻️ Qayta tiklamoqchi bo'lgan buyurtmani tanlang.</b>",
'parse_mode'=>'html',
'reply_markup'=>$keyboard
]);
exit();
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$cqid,
'text'=>"❗️ Sizda qayta tiklash uchun sizda buyurtma yo'q",
'show_alert'=>true
]);
exit();
}
}

if(mb_stripos($data, "reafill=")!==false){
$explodes = explode("=",$data);
$exs = $explodes[1];
$excount = $explodes[2];
if($exs == "next"){
$explode1 = $excount + 2;
$key = [];
$sql = "SELECT * FROM `myorder` WHERE `refill` = 'tr=$cid2' ORDER BY order_id DESC LIMIT $excount,20";
$res = mysqli_query($connect,$sql);
while($row = mysqli_fetch_assoc($res)){
$uidOrder = $row['order_id'];
if($xolat == "Completed"){
$tgsti = "✅ Bajarildi";
}elseif($xolat == "Pending" or $xolat == "In progress"){
$tgsti = "🔄 Bajarilmoqda...";
}elseif($xolat == "Canceled"){
$tgsti = "⛔ Buyurtma bekor qilingan.";
}elseif($xolat == "Processing"){
$tgsti = "♻️ Qayta ishlash";
}elseif($xolat == "Partial"){
$tgsti = "✔️ Qisman";
}else{
$tgsti = "❗️ Ma'lumot mavjud emas.";
}
$key[] = ["text"=>"♻️ $uidOrder","callback_data"=>"refill=$uidOrder"];
$keyboard2 = array_chunk($key, 2);
$keyboard2[] = [['text'=>"⏪",'callback_data'=>"reafill=back=$excount"],['text'=>"⏩",'callback_data'=>"reafill=next=$explode1"]];
$keyboard2[] = [['text'=>"🔙 Orqaga",'callback_data'=>"buyurtmalarim"]];
$keyboard = json_encode([
'inline_keyboard'=>$keyboard2
]);
}
$result = mysqli_query($connect, "SELECT * FROM `myorder` WHERE `refill` = 'tr=$cid2' ORDER BY order_id DESC LIMIT $excount,20");
$row = mysqli_fetch_assoc($result);
if($row){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>♻️ Qayta tiklamoqchi bo'lgan buyurtmani tanlang.</b>",
'parse_mode'=>'html',
'reply_markup'=>$keyboard,
]);
exit();
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$cqid,
'text'=>"⚠️ Boshqa qator qomadi.",
'show_alert'=>true
]);
exit();
}
}elseif($exs == "back"){
if($excount == "0"){
bot('answerCallbackQuery',[
'callback_query_id'=>$cqid,
'text'=>"⚠️ Boshqa qator qomadi",
'show_alert'=>true
]);
exit();
}else{
$explode1 = $excount - 20;
$key = [];
$sql = "SELECT * FROM `myorder` WHERE `refill` = 'tr=$cid2' ORDER BY order_id DESC LIMIT $explode1,20";
$res = mysqli_query($connect,$sql);
while($row = mysqli_fetch_assoc($res)){
$uidOrder = $row['order_id'];
$xolat = $row['status'];
if($xolat == "Completed"){
$tgsti = "✅ Bajarildi";
}elseif($xolat == "Pending" or $xolat == "In progress"){
$tgsti = "🔄 Bajarilmoqda...";
}elseif($xolat == "Canceled"){
$tgsti = "⛔ Buyurtma bekor qilingan.";
}elseif($xolat == "Processing"){
$tgsti = "♻️ Qayta ishlash";
}elseif($xolat == "Partial"){
$tgsti = "✔️ Qisman";
}else{
$tgsti = "❗️ Ma'lumot mavjud emas.";
}
$key[] = ["text"=>"♻️ $uidOrder","callback_data"=>"refill=$uidOrder"];
$keyboard2 = array_chunk($key, 2);
$keyboard2[] = [['text'=>"⏪",'callback_data'=>"reafill=back=$explode1"],['text'=>"⏩",'callback_data'=>"reafill=next=$excount"]];
$keyboard2[] = [['text'=>"🔙 Orqaga",'callback_data'=>"buyurtmalarim"]];
$keyboard = json_encode([
'inline_keyboard'=>$keyboard2
]);
}
$result = mysqli_query($connect, "SELECT * FROM `myorder` WHERE `refill` = 'tr=$cid2' ORDER BY order_id DESC LIMIT $explode1,20");
$row = mysqli_fetch_assoc($result);
if($row){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>♻️ Qayta tiklamoqchi bo'lgan buyurtmani tanlang.</b>",
'parse_mode'=>'html',
'reply_markup'=>$keyboard,
]);
exit();
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$cqid,
'text'=>"⚠️ Xatolik:",
'show_alert'=>true
]);
exit();
}
}
}
}


if(mb_stripos($data, "refill=")!==false){
$explodes = explode("=",$data);
$exs = $explodes[1];
$or_id = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `orders` WHERE `order_id` = '$exs'"))['api_order'];
$APIID = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `orders` WHERE `order_id` = '$exs'"))['provider'];
$api_key = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `providers` WHERE `id` = '$APIID'"))['api_key'];
$api_url = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `providers` WHERE `id` = '$APIID'"))['api_url'];
$sendOrder = json_decode(file_get_contents("$api_url?action=refill&key=$api_key&order=$or_id"),true);
$statusID = $sendOrder['error'];
$refillID = $sendOrder['refill'];
if(isset($refillID)){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>✅ Qayta tiklashga yuborildi.
♻️ Qayta tiklash ID:</b> <code>$refillID</code>",
'parse_mode'=>'html',
'reply_markup'=>$home
]);
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$cqid,
'text'=>"".trans($statusID)."",
'show_alert'=>true
]);
exit();
}
}

if($data=="myordersearchid" and joinchat($cid2)==1) {
$resi = mysqli_query($connect, "SELECT * FROM orders");
$stati = mysqli_num_rows($resi);
del();
sms($cid2,"<b>🆔 O'zingizga kerak buyurtma ID raqamini yuboring:</b>",$ort);
put("user/$cid2.step","myorder");
exit;
}

if($step=="myorder" and is_numeric($text)==1){
$orde = mysqli_query($connect, "SELECT * FROM myorder WHERE order_id = '$text'");
$order = mysqli_fetch_assoc($orde);
if(!$order){
sms($cid,"❌ Buyurtma topilmadi.",$m);
}else{
if($order['user_id'] == $cid){
$row = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM myorder WHERE order_id = $text"));
$pro = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM providers WHERE id = ".$row['provider'].""));
$j=json_decode(get($pro['api_url']."?key=".$pro['api_key']."&action=status&order=".$row['api_order'].""),1);
$start_count = "".$j['start_count']."";
$qold = "".$j['remains']."";

if($order['status'] == "Completed"){
$status = "✅ Bajarildi";
}
if($order['status'] == "Pending" or $order['status'] == "In progress" or $order['status'] == "Partial"){
$status = "⏳Bajarilmoqda";
}
if($order['status'] == "Processing"){
$status = "🔄 Qayta ishlanmoqda.";
}
if($order['status'] == "Canceled"){
$status = "⛔️ Bekor qilingan.";
}

if($status == "Completed" or $status == "Canceled"){
$qold = 0;
}

if($qold == null){
$qold = 0;
}

$services = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `services` WHERE service_id = $row[service]"));

$cates = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM cates WHERE cate_id = $services[category_id]"));
$cate = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM categorys WHERE category_id  = $cates[category_id]"));
$cat_nam = base64_decode($cate['category_name']);
$ser_nam = base64_decode($services['service_name']);


bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🆔 Buyurtma: <code>$text</code>
🕐 Sanasi: $row[order_create]
🛒 Xizmat: $ser_nam - $cat_nam
💵 Narxi: $row[retail] so'm  
📯 Holati: $status</b>",
'parse_mode'=>'html',
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"⏪ Orqaga",'callback_data'=>"menu"]],
]
])
]);
}else{
sms($cid,"<b>⚠️ Bu buyurtma sizga tegishli emas.</b>",$m);
}
unlink("user/$cid.step");
}
exit;
}

if($text=="/start" and joinchat($cid)==1){
$rew = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM users WHERE id = $cid"));
$referal = file_get_contents("user/$cid.users"); if($referal == null){$referal = "0";}
$resi = mysqli_query($connect, "SELECT * FROM orders"); 
sms($cid,"<b>👋 Assalomu alaykum $name !

🤖 Bizning nakrutka botimizga xush kelibsiz: 👇
Ijtimoiy tarmoqlar ( Telegram, Instagram, TikTok va YouTube ) uchun obunachi, like, ko'rishlar hamda reaksiyalarni ko'paytirishingiz mumkin

👤 ID raqam:</b> <code>".$rew['user_id']."</code>",$m);
unlink("user/$cid.step");
exit();
}

if($data == "menu"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>🖥️ Asosiy menyudasiz

👤 ID raqam: <code>".$rew['user_id']."</code></b>",
'parse_mode'=>'html',
'reply_markup'=>$m,
]);
}


if($text=="🇺🇿 Valyuta" and $cid==$admin){
$json3=json_decode(file_get_contents("https://cbu.uz/uz/arkhiv-kursov-valyut/json/"),1);
foreach($json3 as $json4){
if($json4['Ccy']=="USD"){
$usd=$json4['Rate'];
break;
}
}
foreach($json3 as $json4){
if($json4['Ccy']=="RUB"){
$rub=$json4['Rate'];
break;
}
}
foreach($json3 as $json4){
if($json4['Ccy']=="INR"){
$inr=$json4['Rate'];
break;
}
}
foreach($json3 as $json4){
if($json4['Ccy']=="TRY"){
$try=$json4['Rate'];
break;
}
}

sms($cid,"<b>1 $(USD) - $usd UZS
1 ₽(RUB) - $rub UZS
1 ₹(INR) - $inr UZS
1 ₺(TRY) - $try UZS</b>",$panel);

}

if($text=="💳 Hisobim" and joinchat($cid)==1 and phone($cid)==1) {
$rew = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM users WHERE id = $cid"));
$orders = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM myorder WHERE user_id = '$cid'"));
$number = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM phone WHERE user_id = $cid"));
$numbers = $number['phone'];
$kabinet =str_replace(["{outing}","{balance}","{id}","{orders}","{phone}"],["".floor($rew['outing'])."","".floor($rew['balance'])."",$rew['user_id'], $orders, $numbers],enc("decode",$setting['kabinet']));
sms($cid,$kabinet,json_encode([
inline_keyboard=>[
[['text'=>"💵 Hisob to'ldirish",'callback_data'=>"menu=tolov"]],
//*[['text'=>"🛍️ Chegirma olish",'callback_data'=>"menu=chegirma"]],
]]));

}

if((stripos($data,"menu=")!==false and joinchat($chat_id)==1 and phone($chat_id)==1)){
$res=explode("=",$data)[1];
if($res=="tolov"){
$ops=get("set/payments.txt");
$s=explode("\n",$ops);
$soni = substr_count($ops,"\n");
for($i=1;$i<=$soni;$i++){
$k[]=['text'=>$s[$i],'callback_data'=>"payBot=".$s[$i]];
}
$keyboard2=array_chunk($k,1);
$keyboard2[]=[['text'=>"🔹 Click [ Avto ]",'callback_data'=>"click"]];
$keyboard2[]=[['text'=>"💳 Payme [ Avto ]",'callback_data'=>"paymeuz"]];
//*$keyboard2[]=[['text'=>"🅿️ Payeer [ Avto ]",'callback_data'=>"payeer"]];
$keyboard2[]=[['text'=>"☎️ Admin orqali",url=>"tg://user?id=6044744982"]];
$keyboard2[]=[['text'=>"🔙 Orqaga",'callback_data'=>"menu"]];


$kb=json_encode([
'inline_keyboard'=>$keyboard2,
]);
edit($chat_id,$message_id,"<b>👇Pastdagi berilgan tugmalardan birini tanlang va to'lov summasini kiriting hamda sizga berilgan havola orqali to'lovni amalga oshiring va tasdiqlang!

 ⚠️ Diqqat! Barcha to'lov tizimlari xavfsiz siz to'lov qilganinggizdan so'ng kartangizdan ortiqcha pul yechilmaydi va kartangizga ulanilmaydi. Bot hisobidagi pulingizni qaytarish imkoni yo'q iltimos hisobingizni kerakli miqdorda to'ldiring! Click, Payeer to'lov tizimlari bilan shartnoma asosida qonuniy hamkorlik qilingan❗️

👤 ID raqam: <code>".$rew['user_id']."</code></b>",$kb);


}elseif($res == "chegirma") {
$_txt_ ="<b>📋 Quyidagilardan birini tanlang:</b>\n";
$a = mysqli_query($connect,"SELECT * FROM chegirma");
$c = mysqli_num_rows($a);
while($s = mysqli_fetch_assoc($a)){
$i++;
$_txt_.="\n<b>⭐ Chegirma: <b>-".$s['count']."%</b>
💵 Narxi: <b>".number($s['price'])." so‘m</b>
📅 Muddati: <b>".$s['expire']." kun</b>
➖➖➖➖➖➖➖➖➖➖➖➖➖➖</b>";
	
$k[]=['text'=>$i,'callback_data'=>"set_disc-".$s['id']];
}

$keyboard2=array_chunk($k,2);
$kb=json_encode([
'inline_keyboard'=>$keyboard2,
]);
if(!$c){
accl($qid,"⚠️ Chegirma turlari mavjud emas",1);
}else{
edit($cid2,$mid2,$_txt_,$kb);
}
}elseif($res=="PAYEER"){
del();
sms($cid2,"💳 Hisobingizni qanchaga to'ldirmoqchisiz 

💵 To'lov miqdorini kiriting (so'm)

⬇️ Minimal 2000 so‘m",$ort);
put("user/$chat_id.step","payeer");
}
}







if($text == "/discount" or $text == "/start discount") {
$_txt_ ="<b>📋 Quyidagilardan birini tanlang:</b>\n\n";
$a = mysqli_query($connect,"SELECT * FROM chegirma");
$c = mysqli_num_rows($a);
while($s = mysqli_fetch_assoc($a)){
$i++;
$_txt_.="<b>⭐ Chegirma: -".$s['count']."%</b>
<b>💵 Narxi:".number($s['price'])." so‘m</b>
<b>📅 Muddati:".$s['expire']." kun</b>
➖➖➖➖➖➖➖➖➖➖➖➖➖➖";
	
$k[]=['text'=>$i,'callback_data'=>"set_disc-".$s['id']];
}

$keyboard2=array_chunk($k,2);
$kb=json_encode([
'inline_keyboard'=>$keyboard2,
]);
if(!$c){
sms($cid,"⚠️ Chegirma turlari mavjud emas",null);
}else{
sms($cid,$_txt_,$kb);
}
}


if((stripos($data,"set_disc-")!==false and joinchat($chat_id)==1)){
accl($qid,"♻️ Ma'lumotlar yuklanmoqda...");
$idi = explode("-",$data)[1];
$a = mysqli_query($connect,"SELECT * FROM chegirma WHERE id = '$idi'");
$s = mysqli_fetch_assoc($a);
edit($cid2,$mid2,"<b>📋 Quyidagilar bilan tanishing:</b>

<b>⭐ Chegirma: <b>-".$s['count']."%</b>
💵 Narxi: <b>".number($s['price'])." so‘m</b>
📅 Muddati: <b>".$s['expire']." kun</b></b>

<i>".enc("decode",$s['about'])."</i>",inline([
[['text'=>"✅ Obuna bo‘lish",'callback_data'=>"disc_buy-$idi"]],
[['text'=>"⬅️ Orqaga",'callback_data'=>"menu=chegirma"]],
]));
}
if((mb_stripos($data,"disc_buy-")!==false and joinchat($chat_id)==1)){
$idi = explode("-",$data)[1];
$a = mysqli_query($connect,"SELECT * FROM chegirma WHERE id = '$idi'");
$s = mysqli_fetch_assoc($a);
if((user($chat_id)['balance']>=$s['price'])){
$sa['join']=true;
$sa['detail']['expire']=$s['expire'];
$sa['detail']['count']=$s['count'];
$sa['detail']['date']=date("d");
$data = json_encode($sa);
$newBal = user($chat_id)['balance']-$s['price'];
mysqli_query($connect,"UPDATE `users` SET `user_disc` = 'true',`balance` = '$newBal',`user_detail` = '$data' WHERE `id` = '$chat_id'");
accl($qid,"<b>✅ Sotib olish muvaffaqiyatli bajarildi.

🛒 Barcha nakrutka xizmatlari uchun -".$s['count']."% chegirma o‘rnatildi.</b>",1);
sms("$admin","
✅ Chegirma sotib olindi.
📲 ID: ".user($chat_id)['user_id']."
🛒 Chegirma: -".$s['count']."%
💵 Narxi: ".$s['price']."
🤖 Botimiz: @$bot",null);
del();
}else{
accl($qid,"⚠️ Mablag‘ yetarli emas",1);
}
}


if($_GET['update']=="discount"){
$hh = mysqli_query($connect,"SELECT * FROM `users` WHERE `user_disc`='true'");
while($a = mysqli_fetch_assoc($hh)){
$idis = $a['user_id'];
$avi = json_decode(user($a['id'])['user_detail'],1);
$currentime=date("d");
if($currentime!=$avi['detail']['date']){
$av = json_decode(user($a['id'])['user_detail'],1);
if($avi['detail']['expire']=="0" or $avi['detail']['expire']<="1"){
mysqli_query($connect,"UPDATE `users` SET `user_disc` = 'false' WHERE `user_id`= '$idis'");
$av['join']=false;
$av['detail']['expire']=0;
sms($a['id'],"<b>⚠️ Chegirmangiz vaqti tugadi

⭐ Bizni tanlaganingiz uchun raxmat.</b>",null);
}else{
$av['join']=true;
$av['detail']['expire']=$av['detail']['expire']-1;
mysqli_query($connect,"UPDATE `users` SET `user_disc` = 'true' WHERE `user_id`= '$idis'");
sms($a['id'],"<b>⭐ Chegirmangiz tugashiga: ".$av['detail']['expire']." kun qoldi.</b>",null);

}
$av['detail']['date']=date("d");
$av['detail']['count']=$av['detail']['count'];

$data = json_encode($av);

mysqli_query($connect,"UPDATE `users` SET `user_detail` = '$data' WHERE `user_id`= '$idis'");
$abs[]=['id'=>$idis,'data'=>[$av]];
}

}
$saa = $abs ?? [['id'=>"false",'data'=>"false"]];
$ava = ["status"=>true,'cron'=>"Update discounts","update"=>$saa];
echo json_encode($ava,JSON_PRETTY_PRINT);
}




if((stripos($data,"payBot=")!==false)){
$h=explode("=", $data)[1];
$card=get("set/pay/$h/wallet.txt");
$info=get("set/pay/$h/addition.txt");
edit($cid2,$mid2,"
<b>To'lov tizimi:</b><b> $h</b>

<b>💳 Hamyon:</b> <code>$card</code>
   
<b>$info</b>
",json_encode([
'inline_keyboard'=>[
[['text'=>"✅ To'lov qildim",'callback_data'=>"money-$h"]],
[['text'=>"⏪ Orqaga",'callback_data'=>"menu=tolov"]],
]]));
}

if(mb_stripos($data, "money-")!==false){
$ex = explode("-",$data);
$turi = $ex[1];
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"💵 <b>To'lov miqdorini kiriting.

Kartaga qancha tashlagan bo'lsangiz shuni kiriting
	
Minimal: 1 000 so'm</b>",
'parse_mode'=>'html',
'reply_markup'=>$ort,
]);
file_put_contents("user/$cid2.step","oplata-$turi");
exit();
}

if(mb_stripos($step, "oplata-")!==false){
$ex = explode("-",$step);
$turi = $ex[1];
if(is_numeric($text)=="true"){
if($text < 1000){
bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"💵 <b>Minimal: 1 000 so'm</b>",
	'parse_mode'=>'html',
]);
exit();
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"📃 <b>To'lov chekini rasmini yuboring</b>",
'parse_mode'=>'html',
]);
file_put_contents("user/$cid.step","rasm-$text-$turi");
}
exit();
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"💵 <b>To'lov miqdorini kiriting:</b>
	
<b>Minimal: 1 000 so'm</b>",
'parse_mode'=>'html',
]);
exit();
}
}

if(mb_stripos($step, "rasm-")!==false){
	$ex = explode("-",$step);
	$miqdor = $ex[1];
        $turi = $ex[2];
bot('forwardMessage',[
'chat_id'=>"$admin",
'from_chat_id'=>$cid,
'message_id'=>$mid,
]);
$data = date("Y.m.d H:i:s");
$del = bot('sendMessage', [
'chat_id'=>"$admin",
'text'=>"<b>Foydalanuvchi hisobini to'ldirmoqchi!</b>

<b>💳 To'lov tizimi:</b> $turi
<b>👤 Foydalanuvchi:</b> <a href='tg://user?id=$cid'>$cid</a>
<b>💰 To'lov miqdori:</b> $miqdor so'm
<b>⏰ Sana: $data</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✅",'callback_data'=>"on-$cid-$miqdor-$del"],['text'=>"❌",'callback_data'=>"off-$cid-$miqdor"]],
]
])
])->result->message_id;
bot('sendMessage',[ 
'chat_id'=>$cid,
'text'=>"<b>✅ To'lov qabul qilindi hamda bot tomonidan tekshirilishni kuting!</b>",
'parse_mode'=>'html',
'reply_markup'=>$m,
]);
unlink("user/$cid.step");
exit();
}

if(mb_stripos($data, "on-")!==false){
$ex = explode("-",$data);
$id = $ex[1];
$miqdor = $ex[2];
$del = $ex[3];
$ba = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM users WHERE id = $id"));
$a = $ba['balance'] + $miqdor;
$b = $ba['outing'] + $miqdor;
mysqli_query($connect,"UPDATE users SET balance = '$a' WHERE id = $id");
mysqli_query($connect,"UPDATE users SET outing = '$b' WHERE id = $id");
reports('payments',$miqdor);
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendMessage',[
'chat_id'=>$id,
'text'=>"✅<b>To'lovingiz tastiqlandi.

📳 Hisobingizga $miqdor so'm qo'shildi</b>",
'parse_mode'=>'html',
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'message_id'=>$del,
'text'=>"➕ <b>Foydalanuvchi ($id) hisobiga $miqdor so'm qo'shildi.</b>",
'parse_mode'=>'html',
]);      
exit();
}

if(mb_stripos($data, "off-")!==false){
$ex = explode("-",$data);
$id = $ex[1];
$miqdor = $ex[2];
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"<b>⚠️ Bekor qilindi.</b>

👤 <b>Foydalanuvchi:</b> <a href='tg://user?id=$id'>$id</a>
💰 <b>To'lov miqdor:</b> $miqdor so'm",
'parse_mode'=>'html',
]);
bot('sendMessage',[
'chat_id'=>$id,
'text'=>"<b>⚠️ $miqdor so'm to'lovingiz bekor qilindi.</b>",
'parse_mode'=>'html',
]);		
}

if($data == "click"){
del();
sms($chat_id,"<b>💵 Balansizni necha so'mga to'ldirmoqchisiz?.
📰 Minimal miqdor: 1000 so'm</b>",$ort);
put("user/$chat_id.step","oplata_click");
}


if($step=="oplata_click" and is_numeric($text)==1){
if(preg_match('%^[0-9]%',trim($text))){
if($text>=1000 and $text<=10000000){
    $result = mysqli_query($connect, "SELECT * FROM users WHERE id = $cid");
$row = mysqli_fetch_assoc($result);
$myid = $row['user_id'];
$click_menu = json_encode([
inline_keyboard=>[
[['text'=>"↗️ To'lovga o'tish",'url'=>"https://my.click.uz/services/pay?service_id=34690&merchant_id=26628&amount=$text&transaction_param=$myid&return_url=https://t.me/tezgrambot"]],
]]);
bot("sendVideo",[
"chat_id"=>$cid,
'video'=>"https://t.me/VertualADS/208",
"caption"=>"<b>🔹 Click [ Avto ] - qo'llanmasi.

⚠️ To'lov to'langandan keyin bot balansiga avtomatik tashlab beriladi. 

💳 To'lov midori: $text so'm.</b>",
"parse_mode"=>"html",
"reply_markup"=>$click_menu
]);  
//*sms($cid,"<b>🏠 Bosh sahifa</b>",$m);
unlink("user/$cid.step");
}else{
sms($cid2,"<b>💵 Balansizni necha so'mga to'ldirmoqchisiz?.
📰 Minimal miqdor: 1000 so'm</b>",$ort);
put("user/$chat_id.step","oplata_click");
}
}
}

if($data == "paymeuz"){
$step = file_get_contents("step/$cid2.step");
bot('sendmessage',[
'chat_id'=>$cid2,
'text'=>"<b>💵 Balansizni necha so'mga to'ldirmoqchisiz?.
📰 Minimal miqdor: 1000 so'm</b>",
'parse_mode'=>html,
'reply_markup'=>$ort
]);
file_put_contents("user/$cid2.step","paymeuz");
}

if($step=="paymeuz" and is_numeric($text)==1){
if(preg_match('%^[0-9]%',trim($text))){
if($text>=1000 and $text<=100000){
$json=json_decode(get("https://smart.missim.uz/create?key=da972bb5cf00946cf681dc86bfcd6b3f&amount=$text"),1);
$card=$json['card'];
$amount=$json['amount'];
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"<b>✅ To'lov miqdori qabul qilindi

💰 To'lov: $amount so'm
❌ <del>$text</del> so'm emas
 ✅ $amount so‘m o‘tkazing
 
💳 Pul o'tkazish uchun karta: <code>$card</code>

⚠️ Barcha to'lovlar orasida sizning to'lovingizni aniqlash uchun to'lov miqdoriga $amount so'm qo'shildi.

➕ Bot hisobingizga $amount so'm o'tkaziladi</b>",
'parse_mode'=>html,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
    [["text"=>"🔁 Tekshirish","callback_data"=>"tek|$amount"]],
]])
]);
unlink("user/$cid.step");
}else{
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"<b>📰 Minimal 1000 so‘m</b>",
'parse_mode'=>html,
]);
}  
}else{
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"<b> 🔢 Faqat raqamlardan foydalaning!</b>",
'parse_mode'=>html,
]);
}}

if((stripos($data,"tek|")!==false)){
    $amount=explode("|",$data)[1];
$json=json_decode(get("https://smart.missim.uz/checkout?key=da972bb5cf00946cf681dc86bfcd6b3f&amount=$amount&day=$day"),1);
$status=$json['status'];
if($status == "payed"){
bot('sendmessage',[
'chat_id'=>$cid2,
'text'=>"<b>💳 Hisobingizga $amount so'm qo'shildi!</b>",
'parse_mode'=>html,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
]])
]);
bot('editMessageReplyMarkup',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔁 Tekshirish",'callback_data'=>"checked"]],
]
])
]);
$kabinet = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM users WHERE id = $cid2"));
$a = $kabinet['balance'] + $amount;
mysqli_query($connect,"UPDATE users SET balance = '$a' WHERE id = $cid2");
$kabinet1 = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM users WHERE id = $cid2"));
$b = $kabinet1['outing'] + $amount;
mysqli_query($connect,"UPDATE users SET outing = '$b' WHERE id = $cid2");
unlink("user/$cid2.step");
}else{
    bot("answerCallbackQuery",[
"callback_query_id"=>$qid,
"text"=>"⚠️ To'lov amalga oshirilmagan!",
"show_alert"=>true,
]);
}}

if($data == "payeer"){
$usd = get("set/usd");
$rub = get("set/rub");
edit($cid2,$mid2,"
<b>💳 To'lov turini tanlang:

1$ - $usd so'm 
1₽ - $rub so'm</b>",json_encode([
'inline_keyboard'=>[
[['text'=>"USD",'callback_data'=>"oppay-USD"],['text'=>"RUBL",'callback_data'=>"oppay-RUB"]],
[['text'=>"⏪ Orqaga",'callback_data'=>"menu=tolov"]],
]]));
}


if(mb_stripos($data, "oppay-")!==false){
$ex = explode("-",$data);
$turi = $ex[1];
$usd = get("set/usd");
$rub = get("set/rub");
if($turi == "USD"){
$matincha = "<b>💳 To'lov miqdorini kiriting: [ 1$ = $usd so'm ]

❗️ Miqdor son ko'rinishda yuboring!</b>";
}else{
$matincha = "<b>💳 To'lov miqdorini kiriting: [ 1₽ = $rub so'm ]

❗️ Miqdor son ko'rinishda yuboring!</b>";
}
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"$matincha",
'parse_mode'=>'html',
'reply_markup'=>$ort,
]);
file_put_contents("user/$cid2.step","oplata_payer-$turi");
exit();
}

if(mb_stripos($step, "oplata_payer-")!==false){
if($text < 0.01){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"💵 <b>Minimal: 0.01 rubl yoki usd</b>",
'parse_mode'=>'html',
]);
exit();
}else{
$ex = explode("-",$step);
$turi = $ex[1];
if(is_numeric($text)=="true"){
$uniqide = uniqid(uniqid());
$echomenu = file_get_contents("https://tezgram.uz/add_pay.php?amount=$text&order_id=$uniqide&desc=$cid&curr=$turi", false);
bot('sendVideo',[
'video'=>"https://t.me/VertualADS/102",
'chat_id'=>$cid,
'parse_mode'=>'html',
'caption'=>"<b>✅ To'lovga o'tishingiz mumkin.

⚠️ To'lov to'langandan keyin bot balansiga avtomatik tashlab beriladi.</b>",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"↗️ To'lovga o'tish",'url'=>"$echomenu"]],
]
])
]);
file_put_contents("user/$cid.step","null");
exit();
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"🔢 Son ko'rinishda yuboring. Namuna: 100",
'parse_mode'=>'html',
]);
exit();
}
}
}

if($text=="🗣️ Referal" and joinchat($cid)==1 and phone($cid)==1){
$result = mysqli_query($connect, "SELECT * FROM users WHERE id = $cid");
$row = mysqli_fetch_assoc($result);
$myid = $row['user_id'];
$member = $row['referrals'];
bot('Sendphoto',[
'chat_id'=>$cid,
'photo'=>"https://t.me/VertualADS/194",
'caption'=>"<b>🎈 Sizning taklif havolangiz:

<b>👉 https://t.me/$bot?start=user$myid</b>\n
 <b>⚠️ Soxta profillarni taklif qilish va yolg'on reklama blok bo'lishiga sabab bo'ladi!</b>
 
 🗣️ Sizning referallaringiz: $member ta
 
⚡ Sizga har bir taklif qilgan ".enc("decode",$setting['referal'])." so'm beriladi!</b>

<b>👤ID raqam: <code>$myid</code></b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
inline_keyboard=>[
[['text'=>"♻️ Uashish",'url'=>"https://t.me/share/url/?url=https://t.me/$bot?start=user$myid"]],
[['text'=>" 💎 Haftalik referal",'callback_data'=>"href"]],
]
]),
]);
}

if($data=="ref_orqa"){
bot('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
]);
$result = mysqli_query($connect, "SELECT * FROM users WHERE id = $chat_id");
$row = mysqli_fetch_assoc($result);
$myid = $row['user_id'];
$member = $row['referrals'];
bot('Sendphoto',[
'chat_id'=>$chat_id,
'photo'=>"https://t.me/VertualADS/194",
'caption'=>"<b>🎈 Sizning referal havolangiz:👇🏻

<b>👉 https://t.me/$bot?start=user$myid</b>\n
 <b>⚠️ Soxta profillarni taklif qilish va yolg'on reklama blok bo'lishiga sabab bo'ladi!</b>
 
🗣️ Sizning referallaringiz: $member ta
 
⚡ Sizga har bir taklif qilgan ".enc("decode",$setting['referal'])." so'm beriladi!</b>

<b>👤ID raqam: <code>$myid</code></b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
inline_keyboard=>[
[['text'=>"♻️ Uashish",'url'=>"https://t.me/share/url/?url=https://t.me/$bot?start=user$myid"]],
[['text'=>" 💎 Haftalik referal",'callback_data'=>"href"]],
]
]),
]);
}

if($data=="konkurs"){
bot('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
]);
showTopRef();
}

function showTopRef()
{
    global $connect,$chat_id;
    $res = mysqli_query($connect,"SELECT * FROM `users` ORDER BY ref_competation DESC LIMIT 15");
    while($row = mysqli_fetch_assoc($res)){
        $id = $row['id'];
        $member = $row['ref_competation'];
        if(preg_match("/^\d+$/",$id)){
            $top .= "<a href='tg://user?id=$id'>$id</a>  -  <b>$member</b> ta 💎\n";
        }
    }
    $ids = explode("\n","\n$top");
    $soi = substr_count($top,"\n");
    $soni = 10;
    $sts = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM settings WHERE id = 1"))['ref_competation'];
    if($sts == "on"){
        $matn_s = "♻️ Referal aksiya davom etmoqda...";
    }else{
        $matn_s = "🛑 Referal aksiya mavjud emas !";
    }
    foreach($ids as  $id){
        for ($i = 1; $i <= $soni; $i++) {
            $title = str_replace("\n","",$ids[$i]);
            $text1 .= "<b>$i)</b> ".$ids[$i]."\n";
            }
            $date = date("d/m/Y H:i:s");
            bot('sendMessage',[
                'chat_id'=>$chat_id,
                'text'=>"<b>⚡ Mavjud natijalar:\nSo'rov: 📎 Ball bo'yicha\n\nTOP reyting: 10 ta\n\n$text1 \n$matn_s\n\n$date</b>",
                'parse_mode'=>"html",
                'reply_markup'=>json_encode([
                    'inline_keyboard'=>[
                    [['text'=>" ♻️ Ma'lumotlarni yangilash",'callback_data'=>"konkurs"]],
                        //*[['text'=>"🔙 Orqaga",'callback_data'=>"menu"]],
                        ]
                    ])
                ]);
            exit();
    }
}

if($data=="href"){
bot('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
]);
$result = mysqli_query($connect, "SELECT * FROM users WHERE id = $chat_id");
$row = mysqli_fetch_assoc($result);
$myid = $row['user_id'];
$href = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM users WHERE id = $chat_id"))['ref_competation'];
            bot('sendMessage',[
                'chat_id'=>$chat_id,
                'text'=>"<b>Haftalik referal konkursi:

Ushbu konkursda siz ham ishtirok etayapsiz, shartlar esa juda oddiy. Shunchaki sizga berilgan referal havolani do'stlaringizga tarqatib referal to'plang va haftalik referal uchun olmos yig'ing. Har bir taklifingiz uchun 1 💎 beriladi!. Hafta oxirida eng ko'p 💎 yig'gan foydalanuvchilarimizga pul mukofotlari beriladi ! 

🔢 Haftalik referal: $href 💎

Sizning referal havolangiz: 

https://t.me/$bot?start=user$myid
 </b>",
                'parse_mode'=>"html",
                'disable_web_page_preview'=>true,
                'reply_markup'=>json_encode([
                    'inline_keyboard'=>[
                        [['text'=>"🔙 Orqaga",'callback_data'=>"ref_orqa"]],
                        ]
                    ])
                ]);
}


if($text=="📕 Qo'llanma" and joinchat($cid)==1 and phone($cid)==1){
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"<b>TezGram botidan qanday foydalanish haqida qo'llanma! 

Qo'llanmani ko'rish uchun pastdagi tugmani bosing: 👇</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🗂️ Xizmatlardan foydalanish",'callback_data'=>"xizmat1"]],
//*[['text'=>"📞 Vertual raqam olish",'callback_data'=>"nomer1"]],
[['text'=>"🔹 Click [Avto]",'callback_data'=>"click1"]],
[['text'=>"💳 Payme [Avto]",'callback_data'=>"payme1"]],
//*[['text'=>"🅿️ Payeer [Avto]",'callback_data'=>"payeers"]],
]
])
]);
exit();
}

if($data == "xizmat1"){
bot('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
]);
bot('SendVideo',[
'chat_id'=>$chat_id,
'video'=>"https://t.me/VertualADS/105",
'caption'=>"<b>🗂️ Xizmalarga buyurtma berish - qo'llanmasi.

@TezGramUz | @TezGramBot</b>", 
'parse_mode'=>'html',
]);
}

if($data == "nomer1"){
bot('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
]);
bot('SendVideo',[
'chat_id'=>$chat_id,
'video'=>"https://t.me/VertualADS/116",
'caption'=>"<b>?? Vertual raqam olish - qo'llanmasi.

@TezGramUz | @TezGramBot</b>", 
'parse_mode'=>'html',
]);
}

if($data == "payeers"){
bot('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
]);
bot('SendVideo',[
'chat_id'=>$chat_id,
'video'=>"https://t.me/VertualADS/102",
'caption'=>"<b> 🅿️ Payeer [Avto] - orqali to'lov qilish qo'llanmasi.

@TezGramUz | @TezGramBot</b>", 
'parse_mode'=>'html',
]);
}

if($data == "click1"){
bot('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
]);
bot('SendVideo',[
'chat_id'=>$chat_id,
'video'=>"https://t.me/VertualADS/208",
'caption'=>"<b> 🔹 Click [Avto] - orqali hisobni toʻldirish uchun qoʻllanma.

@TezGramUz | @TezGramBot</b>", 
'parse_mode'=>'html',
]);
}

if($data == "payme1"){
bot('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
]);
bot('SendVideo',[
'chat_id'=>$chat_id,
'video'=>"https://t.me/VertualADS/209",
'caption'=>"<b>💳 Payme [Avto] - orqali hisobni toʻldirish uchun qoʻllanma.

@TezGramUz | @TezGramBot</b>", 
'parse_mode'=>'html',
]);
}

if($text=="📢 Kanallar" and $cid==$admin){
sms($cid,$text,json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Qo‘shish",'callback_data'=>"kanal=add"]],
[['text'=>"*️⃣ Ro‘yxat",'callback_data'=>"kanal=list"],['text'=>"🗑️ O'chirish",'callback_data'=>"kanal=dl"]],
]]));

}

if((stripos($data,"kanal=")!==false)){
$rp=explode("=",$data)[1];
if($rp=="list"){
$ops=get("set/channel");
if(empty($ops)){
sms($chat_id,"🤷‍♂️ Xechqanday kanal topilmadi.",null);

}else{
$s=explode("\n",$ops);
$soni = substr_count($ops,"\n");
for($i=0;$i<=count($s)-1;$i++){
$k[]=['text'=>$s[$i],'url'=>"t.me/".str_replace("@","",$s[$i])];
}
$keyboard2=array_chunk($k,2);
$keyboard=json_encode([
'inline_keyboard'=>$keyboard2,
]);
sms($chat_id,"👉 Barcha kanallar:",$keyboard);

}
}elseif($rp=="dl"){
$ops=get("set/channel");
if(empty($ops)){
sms($chat_id,"🤷‍♂️ Xechqanday kanal topilmadi.",null);

}else{
$s=explode("\n",$ops);
$soni = substr_count($ops,"\n");
for($i=0;$i<=count($s)-1;$i++){
$k[]=['text'=>$s[$i],'callback_data'=>"kanal=del".$s[$i]];
}
$keyboard2=array_chunk($k,2);
$keyboard=json_encode([
'inline_keyboard'=>$keyboard2,
]);
sms($chat_id,"🗑️ O‘chiriladigan kanalni tanlang:",$keyboard);
}
}elseif(mb_stripos($rp,"del@")!==false){
$d=explode("@",$rp)[1];
$ops=get("set/channel");
$soni = explode("\n",$ops);
if(count($soni)==1){
unlink("set/channel");
}else{
$ss="@".$d;
$ops=str_replace("\n".$ss."","",$ops);
put("set/channel",$ops);
}
del();
sms($chat_id,"✅ O‘chirildi",null);
}elseif($rp=="add"){
del();
sms($chat_id,"<b>📢 Kanal userini kiriting

Namuna: @username</b>",$aort);
put("user/$chat_id.step","kanal_add");

}
}

if($step=="kanal_add"){
if(mb_stripos($text,"@")!==false){
$kanal=get("set/channel");
sms($cid,"✅ Saqlandi!",$panel);
if($kanal==null){
file_put_contents("set/channel",$text);
}else{
file_put_contents("set/channel","$kanal\n$text");
}
unlink("user/$chat_id.step");

}
}

if($text == "📞 Nomer olish") {
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"❗️*Bo'limdan foydalanish uchun ushbu shartlarga roziligingizni bildiring

- Sizga virtual nomer berilganda uni bemalol almashtirishingiz yoki bekor qilishingiz mumkin bo'ladi va buning uchun pul olinmaydi
- Agar sizga sms kod kelsa virtual nomerni boshqa almashtirolmaysiz va nomer uchun pul yechiladi
- Agarda kelgan kod notog'ri bo'lsa siz berilgan 20 daqiqa ichida yangi sms kod so'rashingiz mumkin va buning uchun ortiqcha pul olinmaydi
- Agar sizga sms kelsa lekin nomerga kira olmasangiz hamda berilgan 20 daqiqani ham o'tkazib yuborsangiz nomer baribir sizga sotilgan hisoblanadi va buning uchun da'volar qabul qilinmaydi
- Bot orqali olgan nomeringizni o'chirsangiz yoki u block bo'lsa nomer tiklab berilmaydi
- Telegram uchun nomer olganingizda Kod telegram orqali yuborildi deyilgan habar chiqsa nomerni darhol bekor qiling! (Aks holda katta ehtimol bilan nomerda 2 bosqichli parol o'rnatilgan bo'lishi mumkin)

☝️ Yuqoridagi holatlar uchun da'volar qabul qilinmaydi chunki bunga rozilik bildirgan bo'lasiz*",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'remove_keyboard'=>true,
'inline_keyboard'=>[
[['text'=>"✅ Roziman",'callback_data'=>"hop"]],
[['text'=>"❌ Bekor qilish",'callback_data'=>"yoqot"]],
]])
]);
}

if($text == "📞 Nomer API balans" and $cid==$admin){
$url = file_get_contents("https://api.sms-activate.org/stubs/handler_api.php?api_key=$simkey&action=getBalance");
$h=explode(":",$url)[1];
sms($cid,"<b>📄 API ma'lumotlari: 
➖➖➖➖➖➖➖➖➖➖➖ 
Ulangan sayt:</b>
<code>sms-activate.org</code>
 
<b>API kalit:</b>
<code>$simkey</code>

<b>API hisob:</b> $h ₽
➖➖➖➖➖➖➖➖➖➖➖",null);
unlink("user/$cid.step");
exit;
}


if($data == "b"){
bot('editmessagetext',[
'chat_id'=>$cid2, 
'message_id'=>$mid2, 
'text'=>"*‍Asosiy menyuga qaytdingiz.*", 
'parse_mode'=>"markdown", 
'reply_markup'=>$m, 
]);
bot('answerCallbackQuery',[
'callback_query_id'=>$qid,
'text'=>"⚙️ Ta'mirlanmoqda...!",
'show_alert'=>true,
]);
}


if($data=="hop") {
$url = json_decode(file_get_contents("https://api.sms-activate.org/stubs/handler_api.php?api_key=$simkey&action=getCountries"), true);
$urla = file_get_contents("https://api.sms-activate.org/stubs/handler_api.php?api_key=$simkey&action=getCountries");
if($urla=="BAD_KEY" or $urla=="NO_KEY"){
bot('answerCallbackQuery',[
'callback_query_id'=>$qid,
'text'=>"⚠️ Botga API kalit ulanmagan!",
'show_alert'=>true,
]);
}else{
$key = [];
for ($i = 0; $i < 10; $i++) {
if($url["$i"]['eng'] == "Russia"){
$n = "🇷🇺 Rossiya";
}elseif ($url["$i"]['eng'] == "Ukraine"){
$n = "🇺🇦 Ukraina";
}elseif ($url["$i"]['eng'] == "Kazakhstan"){
$n = "🇰🇿 Qozog'iston";
}elseif ($url["$i"]['eng'] == "China"){
$n = "🇨🇳 Xitoy";
}elseif ($url["$i"]['eng'] == "Philippines"){
$n = "🇵🇭 Filippin";
}elseif ($url["$i"]['eng'] == "Myanmar"){
$n = "🇲🇲 Myanma";
}elseif ($url["$i"]['eng'] == "Indonesia"){
$n = "🇮🇩 Indoneziya";
}elseif ($url["$i"]['eng'] == "Malaysia"){
$n = "🇲🇾 Malayziya";
}elseif ($url["$i"]['eng'] == "Kenya"){
$n = "🇰🇪 Keniya";
}elseif ($url["$i"]['eng'] == "Tanzania"){
$n = "🇹🇿 Tanzaniya";
}
$id = $url["$i"]['id'];
$name = $url["$i"]['eng'];
$key[] = ["text" =>"$n",'callback_data' => "raqam=tg=ig=fb=tw=vi=oi=ts=go=$id=$n"];
}
$key1 = array_chunk($key,1);
$key1[]=[["text"=>"1/6","callback_data"=>"null"],['text'=>"⏭️",'callback_data'=>"davlat2"]];
$key1[]=[['text'=>"🔍 Qidiruv","callback_data"=>"Search"],['text'=>"📈 Top Davlatlar",'callback_data'=>"top"]];
$key1[]=[['text'=>"🔙 Orqaga","callback_data"=>"bekormenu"]];
bot('EditMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"*Nomer olish uchun davlatlar ro'yxati:*", 
'parse_mode'=>'markdown',
'reply_markup' => json_encode([
 'inline_keyboard'=>$key1,
]),
]);
}}


if ($data == "top") {
    bot('editMessageText', [
        'chat_id' => $chat_id,
        'message_id' => $message_id,
        'text' => "<b>Nomer olish uchun davlatlar ro'yxati:</b>",
        'parse_mode' => 'html',
        'reply_markup' => json_encode([
            'inline_keyboard' => [
                [['text' => "🇮🇩 Indoneziya", 'callback_data' => "raqam=tg=ig=fb=tw=vi=oi=ts=go=6=🇮🇩 Indoneziya"]], 
                [['text' => "🇺🇿 O'zbekiston", 'callback_data' => "raqam=tg=ig=fb=tw=vi=oi=ts=go=40=🇺🇿 O'zbekiston"]], 
                [['text'=>"🔍 Qidiruv","callback_data"=>"Search"],['text'=>"📈 Top Davlatlar",'callback_data'=>"top"]], 
                [['text'=>"🔙 Orqaga","callback_data"=>"hop"]], 
            ]
        ])
    ]);
    exit();
}


if($data=="Search" and joinchat($cid2)==1){
bot('editmessagetext',[
'chat_id'=>$cid2, 
'message_id'=>$mid2, 
'text'=>"<b>🔍 Mamlakatni qidirish uchun davlat nomini yozing! 
Masalan: O'zbekiston</b>", 
'parse_mode'=>"html",  
]);
put("user/$cid2.step","Country"); 
}

if ($step == "Country") {
$country_name = $text;
$data = json_decode(get("https://nitrosms.ru/nitrosms_bot/country/country.json"), true);
$buttons = [];
foreach ($data as $country) {
if($country['name'] == $country_name) {
$country_id = $country['id'];
$found = true;
$emoji_flag = $country['flang'];
$fname = "$emoji_flag $country_name";
$buttons[] = ['text' => "$fname", 'callback_data' => "raqam=tg=ig=fb=tw=vi=oi=ts=go=$country_id=$fname"];
$buttons[] = ['text' => "🔙 Orqaga", 'callback_data' => "bekormenu"];
}
}

$key = array_chunk($buttons, 1);
if($found) {
bot('sendMessage', [
'chat_id' => $cid,
'text' => "<b>Nomer olish uchun davlatlar ro'yxati:</b>",
'parse_mode' => 'HTML',
'reply_markup' =>json_encode([
'inline_keyboard'=>$key,
])
]);
unlink("user/$cid.step");
} else {
$message = "🚫 Davlat topilmadi. Iltimos, to'g'ri nomni kiriting.";
bot('sendMessage', [
'chat_id' => $cid,
'text' => $message,
'parse_mode' => 'HTML',
'reply_markup' => $m,
]);
unlink("user/$cid.step");
}
}


if($data=="davlat2") {
$key = [];
$url = json_decode(file_get_contents("https://api.sms-activate.org/stubs/handler_api.php?api_key=$simkey&action=getCountries"), true);
for ($i = 10; $i < 20; $i++) {
if($url["$i"]['eng'] == "Vietnam"){
$flang = '🇻🇳 Vetnam';
}else if($url["$i"]['eng'] == "Kyrgyzstan"){
$flang = "🇰🇬 Qirg'iziston";
}else if($url["$i"]['eng'] == "USA (virtual)"){
$flang = '🇺🇸 AQSH';
}else if($url["$i"]['eng'] == "Israel"){
$flang = '🇮🇱 Isroil';
}else if($url["$i"]['eng'] == "HongKong"){
$flang = '🇭🇰 Gonkong';
}else if($url["$i"]['eng'] == "Poland"){
$flang = '🇲🇨 Polsha';
}else if($url["$i"]['eng'] == "England"){
$flang = '🇬🇧 Angilya';
}else if($url["$i"]['eng'] == "Madagascar"){
$flang = '🇲🇬 Madagaskar';
}else if($url["$i"]['eng'] == "DCongo"){
$flang = '🇨🇩 Kongo';
}else if($url["$i"]['eng'] == "Nigeria"){
$flang = '🇳🇬 Nigeriya'; 
}
$id = $url["$i"]['id'];
$name = $url["$i"]['eng'];
$key[] = ["text" =>"$flang", 'callback_data' => "raqam=tg=ig=fb=tw=vi=oi=ts=go=$id=$flang"];
}
$key1 = array_chunk($key,1);
$key1[]=[['text'=>"⏮️",'callback_data'=>"hop"],["text"=>"2/6","callback_data"=>"null"],['text'=>"⏭️",'callback_data'=>"davlat3"]];
$key1[]=[['text'=>"🔍 Qidiruv","callback_data"=>"Search"],['text'=>"📈 Top Davlatlar",'callback_data'=>"top"]];
$key1[]=[['text'=>"🔙 Orqaga","callback_data"=>"bekormenu"]];
bot('EditMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"*Nomer olish uchun davlatlar ro'yxati:*", 

'parse_mode'=>'markdown',
'reply_markup' => json_encode([
 'inline_keyboard'=>$key1,
 ]),
]);
}

if($data=="davlat3") {
$key = [];
$url = json_decode(file_get_contents("https://api.sms-activate.org/stubs/handler_api.php?api_key=$simkey&action=getCountries"), true);
for ($i = 20; $i < 30; $i++) {
if($url["$i"]['eng'] == "Macao"){
$n = "🇲🇴 Makao";
}elseif ($url["$i"]['eng'] == "Egypt"){
$n = "🇪🇬 Misr";
}elseif ($url["$i"]['eng'] == "India"){
$n = "🇮🇳 Hindiston";
}elseif ($url["$i"]['eng'] == "Ireland"){
$n = "🇮🇪 Irlandiya";
}elseif ($url["$i"]['eng'] == "Cambodia"){
$n = "🇰🇭 Kambodja";
}elseif ($url["$i"]['eng'] == "Laos"){
$n = "🇱🇦 Laos";
}elseif ($url["$i"]['eng'] == "Haiti"){
$n = "🇭🇹 Gaiti";
}elseif ($url["$i"]['eng'] == "Ivory"){
$n = "🇨🇮 Ivory";
}elseif ($url["$i"]['eng'] == "Gambia"){
$n = "🇬🇲 Gambiya";
}elseif ($url["$i"]['eng'] == "Serbia"){
$n = "🇷🇸 Serbiya";
}                                
$id = $url["$i"]['id'];
$name = $url["$i"]['eng'];
$key[] = ["text" =>"$n", 'callback_data' => "raqam=tg=ig=fb=tw=vi=oi=ts=go=$id=$n"];
}
$key1 = array_chunk($key,1);
$key1[]=[['text'=>"⏮️",'callback_data'=>"davlat2"],["text"=>"3/6","callback_data"=>"null"],['text'=>"⏭️",'callback_data'=>"davlat4"]];
$key1[]=[['text'=>"🔍 Qidiruv","callback_data"=>"Search"],['text'=>"📈 Top Davlatlar",'callback_data'=>"top"]];
$key1[]=[['text'=>"🔙 Orqaga","callback_data"=>"bekormenu"]];
bot('EditMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"*Nomer olish uchun davlatlar ro'yxati:*", 

'parse_mode'=>'markdown',
'reply_markup' => json_encode([
 'inline_keyboard'=>$key1,
 ]),
]);
}

if($data=="davlat4") {
$key = [];
$url = json_decode(file_get_contents("https://api.sms-activate.org/stubs/handler_api.php?api_key=$simkey&action=getCountries"), true);
for ($i = 30; $i < 40; $i++) {
if($url["$i"]['eng'] == "Yemen"){
$n = "🇾🇪 Yaman";
}elseif ($url["$i"]['eng'] == "Southafrica"){
$n = "🇿🇦 Janubiy Afrika";
}elseif ($url["$i"]['eng'] == "Romania"){
$n = "🇷🇴 Ruminiya";
}elseif ($url["$i"]['eng'] == "Colombia"){
$n = "🇨🇴 Kolumbiya";
}elseif ($url["$i"]['eng'] == "Estonia"){
$n = "🇪🇪 Estoniya";
}elseif ($url["$i"]['eng'] == "Azerbaijan"){
$n = "🇦🇿 Ozarbayjon";
}elseif ($url["$i"]['eng'] == "Canada"){
$n = "🇨🇦 Kanada";
}elseif ($url["$i"]['eng'] == "Morocco"){
$n = "??🇦 Marokash";
}elseif ($url["$i"]['eng'] == "Ghana"){
$n = "🇬🇭 Gana";
}elseif ($url["$i"]['eng'] == "Argentina"){
$n = "🇦🇷 Argentina";
}  
$id = $url["$i"]['id'];
$name = $url["$i"]['eng'];
$key[] = ["text" =>"$n", 'callback_data' => "raqam=tg=ig=fb=tw=vi=oi=ts=go=$id=$n"];
}
$key1 = array_chunk($key,1);
$key1[]=[['text'=>"⏮️",'callback_data'=>"davlat3"],["text"=>"4/6","callback_data"=>"null"],['text'=>"⏭️",'callback_data'=>"davlat5"]];
$key1[]=[['text'=>"🔍 Qidiruv","callback_data"=>"Search"],['text'=>"📈 Top Davlatlar",'callback_data'=>"top"]];
$key1[]=[['text'=>"🔙 Orqaga","callback_data"=>"bekormenu"]];
bot('EditMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"*Nomer olish uchun davlatlar ro'yxati:*", 

'parse_mode'=>'markdown',
'reply_markup' => json_encode([
 'inline_keyboard'=>$key1,
]),
]);
}

if($data=="davlat5") {
$key = [];
$url = json_decode(file_get_contents("https://api.sms-activate.org/stubs/handler_api.php?api_key=$simkey&action=getCountries"), true);
for ($i = 40; $i < 50; $i++) {
if($url["$i"]['eng'] == "Uzbekistan"){
$n = "🇺🇿 O'zbekiston";
}elseif ($url["$i"]['eng'] == "Cameroon"){
$n = "🇨🇲 Kamerun";
}elseif ($url["$i"]['eng'] == "Chad"){
$n = "🇹🇩 Chad";
}elseif ($url["$i"]['eng'] == "Germany"){
$n = "🇩🇪 Germaniya";
}elseif ($url["$i"]['eng'] == "Lithuania"){
$n = "🇱🇹 Litva";
}elseif ($url["$i"]['eng'] == "Croatia"){
$n = "🇭🇷 Xorvatiya";
}elseif ($url["$i"]['eng'] == "Sweden"){
$n = "🇸🇪 Shvetsiya";
}elseif ($url["$i"]['eng'] == "Iraq"){
$n = "🇮🇶 Iroq";
}elseif ($url["$i"]['eng'] == "Netherlands"){
$n = "🇳🇱 Niderlandiya";
}elseif ($url["$i"]['eng'] == "Latvia"){
$n = "🇱🇻 Latviya";
} 
$id = $url["$i"]['id'];
$name = $url["$i"]['eng'];
$key[] = ["text" =>"$n", 'callback_data' => "raqam=tg=ig=fb=tw=vi=oi=ts=go=$id=$n"];
}
$key1 = array_chunk($key,1);
$key1[]=[['text'=>"⏮️",'callback_data'=>"davlat3"],["text"=>"5/6","callback_data"=>"null"],['text'=>"⏭️",'callback_data'=>"davlat6"]];
$key1[]=[['text'=>"🔍 Qidiruv","callback_data"=>"Search"],['text'=>"📈 Top Davlatlar",'callback_data'=>"top"]];
$key1[]=[['text'=>"🔙 Orqaga","callback_data"=>"bekormenu"]];
bot('EditMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"*Nomer olish uchun davlatlar ro'yxati:*", 

'parse_mode'=>'markdown',
'reply_markup' => json_encode([
 'inline_keyboard'=>$key1,
 ]),
]);
}

if($data=="davlat6") {
$key = [];
$url = json_decode(file_get_contents("https://api.sms-activate.org/stubs/handler_api.php?api_key=$simkey&action=getCountries"), true);
for ($i = 53; $i < 63; $i++) {
if($url["$i"]['eng'] == "Saudiarabia"){
$n = "🇸🇦 Saudiya Arabistoni";
}else if($url["$i"]['eng'] == "Mexico"){
$n = "🇲🇽 Meksika";
}else if($url["$i"]['eng'] == "Taiwan"){
$n = "🇹🇼 Tayvan";
}else if($url["$i"]['eng'] == "Spain"){
$n = "🇪🇸 Ispaniya";
}else if($url["$i"]['eng'] == "Iran"){
$n = "🇮🇷 Eron";
}else if($url["$i"]['eng'] == "Algeria"){
$n = "🇩🇿 Jazoir";
}else if($url["$i"]['eng'] == "Slovenia"){
$n = "🇸🇮 Sloveniya";
}else if($url["$i"]['eng'] == "Bangladesh"){
$n = "🇧🇩 Bangladesh";
}else if($url["$i"]['eng'] == "Senegal"){
$n = "🇸🇳 Senegal";
}else if($url["$i"]['eng'] == "Turkey"){
$n = "🇹🇷 Turkiya";
} 
$id = $url["$i"]['id'];
$key[] = ["text" =>"$n",'callback_data' => "raqam=tg=ig=fb=tw=vi=oi=ts=go=$id=$n"];
}
$key1 = array_chunk($key,1);
$key1[]=[['text'=>"⏮️",'callback_data'=>"davlat5"],["text"=>"6/6","callback_data"=>"null"]];
$key1[]=[['text'=>"🔍 Qidiruv","callback_data"=>"Search"],['text'=>"📈 Top Davlatlar",'callback_data'=>"top"]];
$key1[]=[['text'=>"🔙 Orqaga","callback_data"=>"bekormenu"]];
bot('editmessagetext',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"*Nomer olish uchun davlatlar ro'yxati:*", 

'parse_mode'=>'markdown',
'reply_markup' => json_encode([
 'inline_keyboard'=>$key1,
 ]),
]);
}


if(mb_stripos($data,"buy=")!==false){
$ex=explode("=",$data);
$xizmat=$ex[1];
$dav=$ex[3];
$json = json_decode(file_get_contents("https://api.sms-activate.org/stubs/handler_api.php?api_key=$simkey&action=getTopCountriesByService&operator=any&service=".$xizmat), true);
$id=$ex[2];
$country = $id;
foreach($json as $element){
if($element['country'] == $country){
$rate=$element['retail_price'];
$tson=$element['count'];
break; 
}
}
if(empty($tson)){
$tson=0;
}else{
$tson=$tson;
}
$rate=$rate*$simrub;
$rp=$rate/100;
$na=$rp*$ff+$rate;
$a = json_decode(file_get_contents("http://translate.googleapis.com/translate_a/single?client=gtx&sl=auto&tl=uz&dt=t&q=$dav"),1);
$tar = $a[0][0][0];
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>🌍 Davlat:</b> $tar

<b>🔢 Qolgan raqamlar: $tson ta
💰 Raqam narxi: $na so‘m</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✅ Sotib olish",'callback_data'=>"olish=$xizmat=$id=any=$na"]],
[['text'=>"🔙 Orqaga",'callback_data'=>"raqam=$id=$dav"]],
]])
]);
}


if(mb_stripos($data, "raqam=")!==false){
$ex = explode("=",$data);
$tg=$ex[1];
$Insta=$ex[2];
$fb=$ex[3];
$twitter=$ex[4];
$imo=$ex[5];
$str=$ex[6];
$snap=$ex[7];
$google=$ex[8];
$davlat = $ex[10];
$urla = file_get_contents("https://api.sms-activate.org/stubs/handler_api.php?api_key=$simkey&action=getCountries");
if($urla=="BAD_KEY" or $urla=="NO_KEY"){
bot('answerCallbackQuery',[show_alert=>1,
'callback_query_id'=>$qid,
'text'=>"⚠️ Botga API kalit ulanmagan!",
]);
}else{

##------------------------------------->Telegram<------------------------------------##

$json = json_decode(file_get_contents("https://api.sms-activate.org/stubs/handler_api.php?api_key=$simkey&action=getTopCountriesByService&operator=any&service=".$tg), true);
$id=$ex[9];
$country = $id;
foreach($json as $element){
if($element['country'] == $country){
$rate=$element['retail_price'];
$tson=$element['count'];
break; 
}
}
if(empty($tson)){
$tson=0;
}else{
$tson=$tson;
}
$rate=$rate*$simrub;
$rp=$rate/100;
$tna=$rp*$ff+$rate;

##------------------------------------->Instagram<------------------------------------##

$igson = json_decode(file_get_contents("https://api.sms-activate.org/stubs/handler_api.php?api_key=$simkey&action=getTopCountriesByService&operator=any&service=".$Insta), true);
$id=$ex[9];
$country = $id;
foreach($igson as $element){
if($element['country'] == $country){
$rate=$element['retail_price'];
$ison=$element['count'];
break; 
}
}
if(empty($ison)){
$ison=0;
}else{
$ison=$ison;
}
$rate=$rate*$simrub;
$rp=$rate/100;
$ina=$rp*$ff+$rate;

##------------------------------------->Fecbook<------------------------------------##

$fbson = json_decode(file_get_contents("https://api.sms-activate.org/stubs/handler_api.php?api_key=$simkey&action=getTopCountriesByService&operator=any&service=".$fb), true);
$id=$ex[9];
$country = $id;
foreach($fbson as $element){
if($element['country'] == $country){
$rate=$element['retail_price'];
$fson=$element['count'];
break; 
}
}
if(empty($fson)){
$fson=0;
}else{
$fson=$fson;
}
$rate=$rate*$simrub;
$rp=$rate/100;
$fna=$rp*$ff+$rate;

##------------------------------------->Twitter<------------------------------------##

$twson = json_decode(file_get_contents("https://api.sms-activate.org/stubs/handler_api.php?api_key=$simkey&action=getTopCountriesByService&operator=any&service=".$twitter), true);
$id=$ex[9];
$country = $id;
foreach($twson as $element){
if($element['country'] == $country){
$rate=$element['retail_price'];
$wson=$element['count'];
break; 
}
}
if(empty($wson)){
$ttson=0;
}else{
$wson=$wson;
}
$rate=$rate*$simrub;
$rp=$rate/100;
$wna=$rp*$ff+$rate;


##------------------------------------->Imo<------------------------------------##

$mson = json_decode(file_get_contents("https://api.sms-activate.org/stubs/handler_api.php?api_key=$simkey&action=getTopCountriesByService&operator=any&service=".$imo), true);
$id=$ex[9];
$country = $id;
foreach($mson as $element){
if($element['country'] == $country){
$rate=$element['retail_price'];
$son=$element['count'];
break; 
}
}
if(empty($son)){
$son=0;
}else{
$son=$son;
}
$rate=$rate*$simrub;
$rp=$rate/100;
$imna=$rp*$ff+$rate;



##------------------------------------->Snapchat<------------------------------------##

$chson = json_decode(file_get_contents("https://api.sms-activate.org/stubs/handler_api.php?api_key=$simkey&action=getTopCountriesByService&operator=any&service=".$snap), true);
$id=$ex[9];
$country = $id;
foreach($chson as $element){
if($element['country'] == $country){
$rate=$element['retail_price'];
$schson=$element['count'];
break; 
}
}
if(empty($schson)){
$schson=0;
}else{
$schson=$schson;
}
$rate=$rate*$simrub;
$rp=$rate/100;
$schna=$rp*$ff+$rate;

##------------------------------------->Tinder<------------------------------------##

$tunson = json_decode(file_get_contents("https://api.sms-activate.org/stubs/handler_api.php?api_key=$simkey&action=getTopCountriesByService&operator=any&service=".$str), true);
$id=$ex[9];
$country = $id;
foreach($tunson as $element){
if($element['country'] == $country){
$rate=$element['retail_price'];
$stson=$element['count'];
break; 
}
}
if(empty($stson)){
$stson=0;
}else{
$stson=$stson;
}
$rate=$rate*$simrub;
$rp=$rate/100;
$stna=$rp*$ff+$rate;


##------------------------------------->Google<------------------------------------##

$jgson = json_decode(file_get_contents("https://api.sms-activate.org/stubs/handler_api.php?api_key=$simkey&action=getTopCountriesByService&operator=any&service=".$google), true);
$id=$ex[9];
$country = $id;
foreach($jgson as $element){
if($element['country'] == $country){
$rate=$element['retail_price'];
$gson=$element['count'];
break; 
}
}
if(empty($gson)){
$gson=0;
}else{
$gson=$gson;
}
$rate=$rate*$simrub;
$rp=$rate/100;
$gna=$rp*$ff+$rate;


bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2, 
'text'=>"*📞 Nomerni qaysi ijtimoiy tarmoq uchun olmoqchisiz?

 Davlat: $davlat

$me Telegram - $tna so'm
$me Instagram -  $ina so'm
$me Facebook - $fna so'm
$me Twitter - $wna so'm
$me Google - $gna so'm 
$me Viber - $imna so'm
$me Tinder $stna so'm 
$me PayPal - $schna so'm*",
'parse_mode'=>'markdown',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"$me Telegram - $tson ta",'callback_data'=>"olish=tg=$id=any=$tna=$davlat"],['text'=>"$me Instagram - $ison ta",'callback_data'=>"olish=ig=$id=any=$ina=$davlat"]],
[['text'=>"$me Facebook - $fson ta",'callback_data'=>"olish=fb=$id=any=$fna=$davlat"],['text'=>"$me Twitter - $wson ta",'callback_data'=>"olish=tw=$id=any=$wna=$davlat"]],
/*[['text'=>"$me Mail.ru - $mason ta",'callback_data'=>"olish=ma=$id=$davlat"],*/[['text'=>"$me Google - $gson ta",'callback_data'=>"olish=go=$id=any=$gna=$davlat"],
['text'=>"$me Viber - $son ta",'callback_data'=>"olish=vi=$id=any=$imna=$davlat"]],[['text'=>"$me Tinder $stson ta",'callback_data'=>"olish=oi=$id=any=$stna=$davlat"], 
['text'=>"$me PayPal - $schson ta",'callback_data'=>"olish=ts=$id=any=$schna=$davlat"]],
[['text'=>"🔙 Orqaga",'callback_data'=>"hop"],['text'=>"Menu",'callback_data'=>"orqa"]], 
]])
]);
}}



if(stripos($data,"olish=")!==false){
$xiz=explode("=",$data)[1];
$id=explode("=",$data)[2];
$op=explode("=",$data)[3];
$pric=explode("=",$data)[4];
$davlat=explode("=",$data)[5];
$result = mysqli_query($connect, "SELECT * FROM users WHERE id = $cid2");
$row = mysqli_fetch_assoc($result);
$foyid= $row['user_id'];
$pul = $row['balance'];
if(($row['balance']>=$pric)){
$arrContextOptions=array(
"ssl"=>array(
"verify_peer"=>false,
"verify_peer_name"=>false,),);
$response = file_get_contents("https://api.sms-activate.org/stubs/handler_api.php?api_key=$simkey&action=getNumber&service=$xiz&country=$id&operator=$op", false, stream_context_create($arrContextOptions));
$pieces = explode(":",$response);
$simid = $pieces[1];
$phone = $pieces[2];
if($response=="NO_NUMBERS") {
$msgs="❌ Bu tarmoq uchun nomer mavjud emas!";
}elseif($response=="NO_BALANCE") {
$msgs="⚠️ Xatolik yuz berdi!";
}
if($response == "NO_NUMBERS" or $response == "NO_BALANCE"){
bot("answerCallbackQuery",[
"callback_query_id"=>$update->callback_query->id,
'text'=>$msgs,
"show_alert"=>true,
]);
}elseif(mb_stripos($response,"ACCESS_NUMBER")!==false){
$result = mysqli_query($connect, "SELECT * FROM users WHERE id = $cid2");
$row = mysqli_fetch_assoc($result);
$foyid= $row['user_id'];
$pul = $row['balance'];
$miqdor = $row['balance']-$pric;
mysqli_query($connect,"UPDATE users SET balance=$miqdor  WHERE id =$cid2");
bot('editmessagetext',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"
🛎 *Sizga nomer berildi
🌍 Davlat: $davlat 
💸 Narxi: $pric so'm
📞 Nomeringiz: +$phone

Nusxalash:* `$phone`

*📨 Kodni olish uchun « 📩 SMS-kod olish » tugmasini bosing! 

❗️Nomer uchun sms xabarni botning o'zidan olasiz
Agar sms kelmasa yoki raqam blocklangan bo'lsa uni bekor qiling va pulingiz qaytariladi
Smsni kutishga 20 daqiqa berildi
Agar Kod telegram orqali yuborildi deyilgan xabar chiqsa nomerni darhol bekor qiling! (Aks holda katta ehtimol bilan nomerda 2 bosqichli parol o'rnatilgan bo'lishi mumkin)
Yangi sms xabar olish uchun yangi sms tugmasini bosing

👤ID raqam:* `$foyid`",
'parse_mode'=>'markdown',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📩 SMS-kod olish",'callback_data'=>"pcode_".$simid."_".$pric]],
[['text'=>"❌ Bekor qilish",'callback_data'=>"otmena_".$simid."_".$pric],],
]
])
]);
}
}else{
bot("answerCallbackQuery",[
"callback_query_id"=>$update->callback_query->id,
'text'=>"❗Sizda mablag' yetarli emas!",
"show_alert"=>true,
]);
}
}

if(stripos($data,"pcode_")!==false and joinchat($cid2)==1){
$ex=explode("_",$data);
$simid=$ex[1];
$so=$ex[2];
$kabinet = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM users WHERE id = $cid2"));
$sims=file_get_contents("simcard.txt");
if(mb_stripos($sims,$simid)!==false){
bot('answerCallbackQuery',[
'callback_query_id'=>$qid,
'text'=>"⛔️ Nomalum buyruq!",
'show_alert'=>true,
]);
exit();
}else{
$response = file_get_contents("https://api.sms-activate.org/stubs/handler_api.php?api_key=$simkey&action=getStatus&id=$simid", false);
if (mb_stripos($response,"STATUS_OK")!==false){
$pieces = explode(":", $response);
$smskod = $pieces[1];
bot('editmessagetext',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"🔑 Faollashtirish kodi: `$smskod`",
'parse_mode'=>'markdown',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔂 Qayta nomer olish",'callback_data'=>"hop"],],
]
])
]);
}elseif($response=="STATUS_CANCEL"){
bot('editmessagetext',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"♻️ Balansingizga $so so‘m qaytarildi",
'parse_mode'=>'markdown',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔂 Qayta nomer olish",'callback_data'=>"hop"],],
]
])
]);
$a = $kabinet['balance'] + $so;
mysqli_query($connect,"UPDATE users SET balance = '$a' WHERE id = $cid2");
file_put_contents("sim/simcard.txt","\n".$simid,FILE_APPEND);
}elseif($response=="BAD_STATUS") {
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"🖥 Asosiy menyudasiz",
'parse_mode'=>'markdown',
]);
}else{
bot("answerCallbackQuery",[
"callback_query_id"=>$update->callback_query->id,
'text'=>"⚠️ SMS kodi kelmadi! 

Birozdan so'ng urinib ko'ring",
"show_alert"=>true,
]);
}
}
}

if(stripos($data,"otmena_")!==false and joinchat($cid2)==1){
$simid=explode("_",$data)[1];
$so=explode("_",$data)[2];
$kabinet = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM users WHERE id = $cid2"));
$sims=file_get_contents("sim/simcard.txt");
$response = file_get_contents("https://api.sms-activate.org/stubs/handler_api.php?api_key=$simkey&action=setStatus&status=8&id=$simid");
if(mb_stripos($sims,$simid)!==false){
bot('answerCallbackQuery',[
'callback_query_id'=>$qid,
'text'=>"⛔️ Nomalum buyruq!",
'show_alert'=>true,
]);
exit();
}else{
if(mb_stripos($response,"ACCESS_CANCEL")!==false){ 
bot('editmessagetext',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"♻️ Balansingizga $so so‘m qaytarildi",
'parse_mode'=>'markdown',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔂 Qayta nomer olish",'callback_data'=>"hop"],],
]
])
]);
$a = $kabinet['balance'] + $so;
mysqli_query($connect,"UPDATE users SET balance = '$a' WHERE id = $cid2");
file_put_contents("sim/simcard.txt","\n".$simid,FILE_APPEND);
}else{
bot("answerCallbackQuery",[
"callback_query_id"=>$update->callback_query->id,
'text'=>" 🔔 Bekor qilish imkoni bo‘lmadi.

Birozdan so'ng urinib ko'ring",
"show_alert"=>true,
]);
}
}
}

if($text=="💡 Xizmatlar" and joinchat($cid)==1 and phone($cid)==1){
$a = mysqli_query($connect,"SELECT * FROM `categorys`");
$c = mysqli_num_rows($a);
while($s = mysqli_fetch_assoc($a)){
$k[]=['text'=>"".enc("decode",$s['category_name']),'callback_data'=>"tanla1=".$s['category_id']];
}
$keyboard2=array_chunk($k,2);
$keyboard2[]=[['text'=>"📝 Ta'riflar",'url'=>"https://".$_SERVER['HTTP_HOST']."/services"]];
$kb=json_encode([
'inline_keyboard'=>$keyboard2,
]);
if($c){
sms($cid,"<b>✅️ Bizning xizmatlar eng arzon va tezkor!\n
👇 Quyidagi Ijtimoiy tarmoqlardan birini tanlang:</b>",$kb);

}else{
sms($cid,"⚠️ Tarmoqlar topilmadi.",null);
exit; 
}
}

if($data=="absd" and joinchat($chat_id)==1){
$a = mysqli_query($connect,"SELECT * FROM `categorys`");
$c = mysqli_num_rows($a);
while($s = mysqli_fetch_assoc($a)){
$catID = $s['category_id'];
$cat = mysqli_query($connect, "SELECT * FROM `cates` WHERE `category_id` = '$catID'");
$count = mysqli_num_rows($cat);
$k[]=['text'=>"".enc("decode",$s['category_name']) ." - $count",'callback_data'=>"tanla1=".$s['category_id']];
}
if(!$c){
    bot('answerCallbackQuery',[
        'callback_query_id'=>$qid,
        'text'=>"⚠️ Tarmoqlar topilmadi!",
        'show_alert'=>true,
        ]);
    }else{
$keyboard2=array_chunk($k,2);
$keyboard2[]=[['text'=>"📝 Ta'riflar",'url'=>"https://".$_SERVER['HTTP_HOST']."/services"]];
$kb=json_encode([
'inline_keyboard'=>$keyboard2,
]);
edit($chat_id,$mid2,"<b>✅️ Bizning xizmatlar eng arzon va tezkor!\n
👇 Quyidagi Ijtimoiy tarmoqlardan birini tanlang:</b>",$kb);
bot('AnswerCallbackQuery',[
'callback_query_id'=>$qid,
'text'=>"✅ Quyidagi tarmoqlardan birini tanlang:",
'show_alert'=>false,
]);
exit; 
}
}


if((mb_stripos($data,"tanla1=")!==false and joinchat($chat_id)==1)){
$n=explode("=",$data)[1];
if($chat_id==$admin){
$about_admin_menus2 = "";
$adm=json_encode(['inline_keyboard'=>[
]]);
}
$nomu = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `categorys` WHERE `category_id` = '$n'"))['category_name'];
$nomz = enc("decode",$nomu);
$adds=json_decode(get("set/sub.json"),1);
$adds['cate_id']=$n;
put("set/sub.json",json_encode($adds));
$new_arr = [];
$k = [];
$a = mysqli_query($connect,"SELECT * FROM cates WHERE category_id = $n");
$c = mysqli_num_rows($a);
while($s = mysqli_fetch_assoc($a)){
if(!in_array(enc("decode",$s['name']), $new_arr)){
$catname = enc("decode",$s['name']);
$new_arr[] = enc("decode",$s['name']);
$catID = $s['cate_id'];
$cat = mysqli_query($connect,"SELECT * FROM services WHERE category_id = '$catID'");
$count = mysqli_num_rows($cat);
$k[]=['text'=>"$catname",'callback_data'=>"tanla2=".$s['cate_id']."=$n"];
}
}
$keyboard2=array_chunk($k,1);
$keyboard2[]=[['text'=>"🔙 Orqaga",'callback_data'=>"absd"]];
$kb=json_encode([
'inline_keyboard'=>$keyboard2,
]);
if(!$c){
    if($chat_id!=$admin){
    bot('answerCallbackQuery',[
        'callback_query_id'=>$qid,
        'text'=>"⚠️ Ushbu bo'lim uchun xizmatlar topilmadi!",
        'show_alert'=>true,
        ]);
    }else{
    edit($chat_id,$message_id,"<b>⚠️ Ushbu bo'lim uchun xizmatlar topilmadi!</b>$about_admin_menus2",$adm);
    }
    }else{
edit($chat_id,$message_id,"<b>$nomz bo‘limiga xush kelibsiz!\n\n👇 Quyidagi ichki bo'limlardan birini tanlang:</b> $about_admin_menus2",$kb);
bot('AnswerCallbackQuery',[
'callback_query_id'=>$qid,
'text'=>"✅ Kerakli xizmat turini tanlang:",
'show_alert'=>false,
]);
exit; 
}
}

if(mb_stripos($data,"tanla2=")!==false and joinchat($chat_id)==1){
$n=explode("=",$data)[1];
$as=0;
$b = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM cates WHERE cate_id = $n"));
$qpay = json_decode($b['open'],1);
if($qpay['open']=="true"){
$av = json_decode(user($chat_id)['free_cate'],1);
if($av['open_'.$n]=="true"){
$a = mysqli_query($connect,"SELECT * FROM services WHERE category_id = '$n' AND service_status = 'on'");
$c = mysqli_num_rows($a);
while($s = mysqli_fetch_assoc($a)){
$as++;
$narx = $s['service_price'];

$k[]=['text'=>"".base64_decode($s['service_name'])." ".floor($narx)." - so‘m",'callback_data'=>"ordered=".$s['service_id']."=".$n];
}
$keyboard2=array_chunk($k,1);
$adds=json_decode(get("set/sub.json"),1);
$keyboard2[]=[['text'=>"◀️ Orqaga",'callback_data'=>"tanla1=".$adds['cate_id']]];
$kb=json_encode([
'inline_keyboard'=>$keyboard2,
]);
if(!$c){
	bot('answerCallbackQuery',[
		'callback_query_id'=>$qid,
		'text'=>"⚠️ Ushbu bo'lim uchun xizmatlar topilmadi!",
		'show_alert'=>true,
		]);
	}else{
edit($chat_id,$message_id,"

<b>✅ Keraki xizmatlardan birini tanlang!</b>",$kb);
exit; 
}
}else{
edit($chat_id,$message_id,"<b>⚠️ Ushbu bo‘limdagi xizmatlardan foydalanish uchun 1 martalik to'lov olinadi

💳 Narxi: ".$qpay['price']." so‘m (1 marta)</b>",inline([
[['text'=>"✅ Sotib olish (".$qpay['price']." so‘m)",'callback_data'=>"opencate=".$qpay['price']."=$n"]],
]));
}
}else{
$a = mysqli_query($connect,"SELECT * FROM services WHERE category_id = '$n' AND service_status = 'on'");
$c = mysqli_num_rows($a);
while($s = mysqli_fetch_assoc($a)){
$as++;
$narxi = floor($s['service_price']);

$av = json_decode(user($chat_id)['user_detail'],1);
if($av['join']=="true"){
$si = $narxi/100*$av['detail']['count'];
$narx = $narxi-$si;
}else{
$narx = $narxi;
}

$k[]=['text'=>"".enc('decode',$s['service_name'])." - $narx so‘m",'callback_data'=>"ordered=".$s['service_id']."=".$n];
}
$keyboard2=array_chunk($k,1);
$adds=json_decode(get("set/sub.json"),1);
$keyboard2[]=[['text'=>"◀️ Orqaga",'callback_data'=>"tanla1=".$adds['cate_id']]];
$kb=json_encode([
'inline_keyboard'=>$keyboard2,
]);
if(!$c){
	bot('answerCallbackQuery',[
		'callback_query_id'=>$qid,
		'text'=>"⚠️ Ushbu bo'lim uchun xizmatlar topilmadi!",
		'show_alert'=>true,
		]);
	}else{
edit($chat_id,$message_id,"💎 <b>Xizmatlardan birini tanlang! 
💴 Narxlar 1000 tasi uchun berilgan:</b>",$kb);
exit; 
}




}
}


if((stripos($data,"opencate=")!==false and joinchat($chat_id)==1)){
	$price = explode("=",$data)[1];
	$cate_id = explode("=",$data)[2];
	if(user($chat_id)['balance']>=$price){
		$newp=user($chat_id)['balance']-$price;
		$config = json_decode(user($chat_id)['free_cate'],true);
$config['open_'.$cate_id]= "true";
$config = json_encode($config);
mysqli_query($connect,"UPDATE `users` SET balance = '$newp', free_cate = '$config' WHERE id = '$chat_id'");
del();
sms($chat_id,"<b>🎁 Muvaffaqiyatli sotib olindi 
✅ Foydalanish mumkin</b>",null);
}else{
	bot('answerCallbackQuery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>"⚠️ Mablag‘ yetarli emas",
'show_alert'=>true,
]);
}
}


if((stripos($data,"ordered=")!==false and joinchat($chat_id)==1)){
$n=explode("=",$data)[1];
$n2=explode("=",$data)[2];
$a = mysqli_query($connect,"SELECT * FROM services WHERE service_id= '$n'");
while($s = mysqli_fetch_assoc($a)){
$nam = base64_decode($s['service_name']);
$sid = $s['service_id'];
$narxi = floor($s['service_price']);
$curr = $s['api_currency'];
$ab = $s['service_desc'] ? $ab=$s['service_desc'] : null;
$api = $s['api_service'];
$type=$s['service_type'];
$spi = $s['service_api'];
$min=$s["service_min"];
$max=$s["service_max"];
$average=$s["service_average"];
}
$av = json_decode(user($chat_id)['user_detail'],1);
if($av['join']=="true"){
$s = $narxi/100*$av['detail']['count'];
$narx = $narxi-$s;
}else{
$narx = $narxi;
}
if($curr=="USD"){
$fr=get("set/usd");
}elseif($curr=="RUB"){
$fr=get("set/rub");
}elseif($curr=="INR"){
$fr=get("set/inr");
}elseif($curr=="TRY"){
$fr=get("set/try");
}
$ab ? $abs = "".base64_decode($ab)."": null;

if($type=="Default" or $type=="default"){
$ab = "
$abs";
}elseif($type=="Package"){
$ab = "$abs";
}

if(empty($min) or empty($max)){
bot('answerCallbackQuery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>"⚠️ Nimadur xato ketdi qaytadan urining.",
'show_alert'=>true,
]);
}else{
	
$msrt = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `services` WHERE `service_id` = '$n'"));
$api_detail = $msrt['api_detail'];
$data_say = json_decode($api_detail, true);

$refilhol = $data_say['refill'];
$cancelhol = $data_say['cancel'];

$descrip = base64_decode($ab);
$nomis = $nam;
$tqs = $tq;
if($refilhol == "true"){
$refilltx = "Mavjud !";
}else{
$refilltx = "Mavjud emas !";
}
if($cancelhol == "true"){
$canceltx = "Mavjud !";
}else{
$canceltx = "Mavjud emas !";
}
edit($chat_id,$message_id,"
<b>".($nam)."</b>$startD $endD\n
<b>🆔 Xizmat IDsi: <code>$sid</code></b>
<b>$ab</b>\n
<b><blockquote>♻️ Qayta tiklash: $refilltx</blockquote></b>

<b>⚠️ Buyurtma vaqtida havolani o‘zgartirish mumkin emas. Aks holda buyurtmangiz tugallangan holatga oʻzgaradi, bu holda biz toʻlovni qaytarmaymiz!</b>

<b>💵 1000 ta - $narx so‘m\n
⏰ Bajarilish vaqti: $average</b>

<b>☝️ Ta‘rif bilan tanishib chiqib «✅ Davom etish» tugmasini bosing.</b>",json_encode([
inline_keyboard=>[
[['text'=>"✅ Davom etish",'callback_data'=>"order=$spi=$min=$max=".$narx."=$type=".$api."=$sid"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"tanla2=$n2"]],
]]));

}
exit; 
}

if((stripos($data,"order=")!==false)){
$oid=explode("=",$data)[1];
$omin=explode("=",$data)[2];
$omax=explode("=", $data)[3];
$orate=explode("=", $data)[4];
$otype=explode("=", $data)[5];
$prov=explode("=",$data)[6];
$serv=explode("=",$data)[7];

if($otype=="Default" or $otype=="default"){
del();
sms($chat_id,"<b>🔢 Kerakli buyurtma miqdorini kiriting:

🔼 Minimal: $omin ta
🔽 Maksimal: $omax ta</b>.",$ort);
put("user/$chat_id.step","order=default=sp1");
put("user/$chat_id.params","$oid=$omin=$omax=$orate=$prov=$serv");
put("user/$chat_id.si",$oid);
exit; 
}elseif($otype=="Package") {
del();
sms($chat_id,"<b>📎 Kerakli xavolani yuboring:</b>",$ort);
put("user/$chat_id.step","order=package=sp2=1=$orate");
put("user/$chat_id.params","$oid=$omin=$omax=$orate=$prov=$serv");
put("user/$chat_id.si",$oid);
exit; 
}
}

$s=explode("=",$step);
if($s[0]=="order" and $s[1]=="default" and $s[2]=="sp1" and is_numeric($text) and joinchat($cid)==1) {
$p=explode("=",get("user/$cid.params"));
$narxi=$p[3]/1000*$text;
if($text>=$p[1] and $text<=$p[2]){
$rew = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM users WHERE id = $cid"));
if(($rew['balance']>=$narxi)){
sms($cid,"
<b>✅ $text saqlandi!

Buyurtma xavolasini yuboring.</b>",$ort);
put("user/$cid.step","order=$s[1]=sp2=$text=$narxi");
put("user/$cid.qu",$text);
exit; 
}else{
sms($cid,"<b>❌ Yetarli mablag‘ mavjud emas
💵 Narxi: $narxi so‘m

Boshqa miqdor kiritib koring:</b>",null);
exit; 
}
}else{
sms($cid,"
<b>⚠️ Buyurtma miqdorini notog’ri kiritilmoqda
 
 ⬇️ Minimal buyurtma: $p[1]
 ⬆️ Maksimal: buyurtma: $p[2]
 
 Boshqa miqdor kiriting</b>",null);
 exit;
 }
 }
 
 

if(($s[0]=="order" and ($s[1]=="default" or $s[1]=="package") and $s[2]=="sp2" and joinchat($cid)==1)){
if($s[1]=="default"){
$pc="🔢 Buyurtma miqdori: $s[3] ta";
}
$rew = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM users WHERE id = $cid"));
if(($rew['balance']>=$s[4])){
if((mb_stripos($tx,"https://")!==false) or (mb_stripos($text,"@")!==false)){
$msid=sms($cid,"<b>➡️ Ma'lumotlarni o‘qib chiqing!

💵 Narxi: $s[4] so‘m
📎 Havola: $text
$pc

❗ Ma'lumotlar to‘g‘ri bo‘lsa (✅ Yuborish) tugmasiga bosing!</b>",json_encode([
'inline_keyboard'=>[
[['text'=>"✅ Tasdiqlash",'callback_data'=>"checkorders=".uniqid()]],
[['text'=>"🚫 Bekor qilish",'callback_data'=>"main"]],
]]))->result->message_id;
put("user/$cid.step","order=$s[1]=sp3=$s[3]=$s[4]=$text");
put("user/$cid.ur",$text);
exit;
}else{
sms($cid,"<b>⚠️ Havola notog’ri yuborilmoqda

Qaytadan xarakat qiling</b>",null);
}
}else{
sms($cid,"<b>❌ Yetarli mablag‘ mavjud emas

Hisobingizni to‘ldirib urinib ko'ring.</b>",$ort);
}
}

$sc=explode("=",get("user/$chat_id.step"));
if((stripos($data,"checkorders=")!==false and $sc[0]=="order" and ($sc[1]=="default" or $sc[1]=="package") and $sc[2]=="sp3" and joinchat($chat_id)==1)){
$rew = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM users WHERE id = $chat_id"));
if($rew['balance']>=$sc[4]){
$sc=explode("=",get("user/$chat_id.step"));
$sp=explode("=",get("user/$chat_id.params"));
$m = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM providers WHERE id = ".$sp[4].""));
$surl = $m['api_url'];
$skey =$m['api_key'];
$j=json_decode(url_query($surl."?key=".$skey."&action=add&service=".get("user/$chat_id.si")."&link=".get("user/$chat_id.ur")."&quantity=".get("user/$chat_id.qu").""),1);
$jid=$j['order'];
$jer=$j['error']??$j['Error'];
if(empty($jid)){
sms($admin,"⚠️ API saytda xatolik yuz berdi!
📊 API id: ".get("user/$chat_id.si")."
📝 API link: $surl
➡️ Bot id: ".$sp[5]."
‼️ Sabab: ".trans(str_replace("."," ",$jer))."",null);
if($jer=="neworder.error.link_duplicate"){
$ns="⚠️ Siz kiritgan havolaga buyurtma bajarilmoqda! Buyurtma bajarilganidan so'ng qaytadan urining.";
}else{$ns="⚠️ Xatolik yuz berdi!";}
bot('answerCallbackQuery', [
'callback_query_id'=>$cqid,
'text'=>"$ns",
'show_alert'=>1,
]);
bot('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
]);
bot('SendMessage',[
'chat_id'=>$chat_id,
'text'=>"🖥️ <b>Asosiy menyudasiz</b>",
'reply_markup'=>$m,
'parse_mode'=>html,
]);
unlink("user/$chat_id.step");
unlink("user/$chat_id.params");
unlink("user/$chat_id.ur");
unlink("user/$chat_id.qu");
unlink("user/$chat_id.si");
exit();
}else{
$oe = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM orders"));
$or=$oe+1;
$sav = date("Y.m.d H:i:s");
mysqli_query($connect,"INSERT INTO myorder(`order_id`,`user_id`,`retail`,`status`,`service`,`order_create`,`last_check`) VALUES ('$or','$chat_id','$sc[4]','Pending','$sp[5]','$sav','$sav');");
mysqli_query($connect,"INSERT INTO orders(`api_order`,`order_id`,`provider`,`status`) VALUES ('$jid','$or','$sp[4]','Pending');");
$rew = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM users WHERE id = $cid"));
$order =str_replace(["{order}","{order_api}"],["$or","$jid"],enc("decode",$setting['orders']));
sms($chat_id,$order,json_encode(['inline_keyboard'=>[
//*[['text'=>"⏩ Orqaga",'callback_data'=>"menu"]],
]
]));
$bdh = $sp[4];
$bdj = $sp[5];
$ur0 = get("user/$chat_id.ur");
$qu0 = get("user/$chat_id.qu");
$si0 = get("user/$chat_id.si");
$retail = $sc[4];
$getname = bot('getchat',['chat_id'=>$chat_id]);
$name = $getname->result->first_name;
$sename = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM services WHERE service_id = $bdj"))['service_name'];
$xizmatn = base64_decode($sename);
$rew = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM users WHERE id = $chat_id"));
$new = $rew['balance']-$sc[4];
reports('orders',1);
reports('spents',$retail);
sms($admin,
"<b>🆕 Yangi buyurtma (@$bot)

🛍️ Buyurtma ID raqami: <code>$or</code>
🆔 Xizmat ID raqami: <code>$bdj</code>
🔢 Buyurtma miqdori: </b>$qu0 ta
📊 <b>Buyurtma narxi:</b> $retail so'm 
📖 <b>Xizmat nomi:</b> $xizmatn
👤 <b>Buyurtmachi: <a href='tg://user?id=$chat_id'>$name</a>
🔗 Havola: <code>$ur0</code></b>
<b>💵 Balansi:</b> $new so'm",json_encode(['inline_keyboard'=>[[['text'=>"🔎 Buyurtma xolati",'callback_data'=>"orderz=$or"]]]]));
$rew = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM users WHERE id = $chat_id"));
$miqdor = $rew['balance']-$sc[4];
mysqli_query($connect,"UPDATE users SET balance=$miqdor WHERE id =$chat_id");
unlink("user/$chat_id.step");
del();
exit;
}
}
}

if(mb_stripos($data,"orderz=")!==false){
$id = str_replace("orderz=","",$data);
$response = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM orders WHERE order_id = $id"))['status'];
if($response=="Completed") {
   $status="✅ Bajarilgan";
   }
   if($response=="In progress") {
   $status="⏳ Bajarilmoqda";
   }
   if($response=="Partial"){
   $status="♻️ Qayta ishlanmoqda";
   }
   if($response=="Pending"){
  $status="⏳ Bajarilmoqda";
  }
  if($response=="Processing"){
  $status="⏳ Bajarilmoqda";
  }
  if($response=="Canceled"){
  $status="🚫 Bekor qilingan";
 }
bot('answerCallbackQuery',[
'callback_query_id'=>$qid,
'text'=>"
🔎 Buyurtma xolati: $status",
'show_alert'=>true,
]);
}

if($_GET['update']=="status"){

$a=[];
$news = [];
$mysql=mysqli_query($connect,"SELECT * FROM `orders`");
while($mys=mysqli_fetch_assoc($mysql)){
$prv=$mys['provider'];
$order=$mys['api_order'];
$uorder=$mys['order_id'];
$uservice = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM myorder WHERE `order_id`='$uorder'"))['service'];
$news[] = $uorder;

if($mys['status']!="Canceled" and $mys['status']!="Completed"){

$m = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `providers` WHERE id = $prv"));
$surl = $m['api_url'];
$skey =$m['api_key'];

$msrt = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `services` WHERE `service_id` = '$uservice'"));
$api_detail = $msrt['api_detail'];
$data_say = json_decode($api_detail, true);

$refilhol = $data_say['refill'];

$mysa=mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `myorder` WHERE order_id=$uorder"));
$sa= json_decode(file_get_contents($surl."?key=".$skey."&action=status&order=".$order.""),1);
$status =$sa['status'];
$adm=$mysa['user_id']??$admin;
$retail=$mysa['retail'];
$service = $mysa['service'];
$a = mysqli_query($connect,"SELECT * FROM services WHERE service_id= '$service'");
while($s = mysqli_fetch_assoc($a)){
$narx = $s['service_price'];
}


$narxi = ($retail/$mysa['quantity']*$sa['remains']);

$qayt = $narxi;



if($status=="Completed"){
$sav = date("Y.m.d H:i:s");
sms($adm,"<b>✅ Sizning <code>$uorder</code> raqamli buyurtmangiz to'liq bajarildi.

⭐ Bizning xizmatlarimizdan foydalanganligingiz uchun raxmat.</b>",null);
$connect->query("UPDATE `orders` SET `status`='Completed' WHERE `order_id`='$uorder'");
$connect->query("UPDATE `orders` SET `status`='Completed' WHERE `order_id`='$uorder'");
if($refilhol == "true"){
    $refuzgr = "tr=$adm";
}else{
    $refuzgr = "fl=$adm";
}
$connect->query("UPDATE `myorder` SET `status`='Completed',`last_check` = '$sav', `refill` = '$refuzgr' WHERE `order_id`='$uorder'");
}elseif($status=="Canceled"){
$rew = mysqli_fetch_assoc($connect->query("SELECT * FROM `users` WHERE `id` = $adm"));
sms($adm,"<b>⚠️ Sizning $uorder raqamli buyurtmangiz bekor qilindi.

💳 Hisobingizga $retail so‘m qaytarildi</b>",null);
$connect->query("UPDATE `orders` SET `status`='Canceled' WHERE `order_id`='$uorder'");
$connect->query("UPDATE `myorder` SET `status`='Canceled' WHERE `order_id`='$uorder'");
$rew = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `users` WHERE `id` = '$adm'"));
$miqdor = $rew['balance']+$retail;
$connect->query("UPDATE `users` SET `balance`='$miqdor' WHERE `id` ='$adm'");
}elseif($status=="Partial"){
$rew = mysqli_fetch_assoc($connect->query("SELECT * FROM `users` WHERE `id` = $adm"));
sms($adm,"<b>📝 Sizning $uorder raqamli buyurtmangizdan ".$sa['remains']." ta buyurtmangiz bajarilmadi.

➡️ Hisobingizga $retail so‘m qaytarildi</b>",null);
$connect->query("UPDATE `orders` SET status='Canceled' WHERE `order_id`='$uorder'");
$connect->query("UPDATE `myorder` SET status='Canceled' WHERE `order_id`='$uorder'");

$rew = mysqli_fetch_assoc($connect->query("SELECT * FROM users WHERE `id` = '$adm'"));
$miqdor = $rew['balance']+$retail;
$connect->query("UPDATE `users` SET `balance`='$miqdor' WHERE id ='$adm'");
}elseif($status!="Canceled" and $status!="Completed" and $status!="Partial"){
$connect->query("UPDATE `orders` SET `status`='$status' WHERE `order_id`='$uorder'");
$connect->query("UPDATE `myorder` SET `status`='$status' WHERE `order_id`='$uorder'");
}
}
}
}

$res = mysqli_query($connect,"SELECT*FROM users WHERE id=$cid");
while($a = mysqli_fetch_assoc($res)){
$flid = $a['id'];
}
if(mb_stripos($text,"/start user")!==false){
$id = str_replace("/start user","",$text);
$refid = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM users WHERE user_id = $id"))['id'];

if(strlen($refid)>0 and $refid>0){
if($refid == $cid){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⚠️ Siz o‘zingizga referal bo‘lishingiz mumkin emas</b>",
'parse_mode'=>'html',
'reply_markup'=>$m,
]);

}else{
if(mb_stripos($flid,"$cid")!==false){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⚠️ Siz bizning botimizda allaqachon mavjudsiz.</b>",
'parse_mode'=>'html',
'reply_markup'=>$m
]);

}else{
$kanal = file_get_contents("set/channel");
$r_c = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM settings WHERE id=1"))['ref_competation'];
if(joinchat($cid)==1){
$pul = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM users WHERE id=$refid"))['balance'];
$a = $pul+enc("decode",$setting['referal']);
mysqli_query($connect,"UPDATE users SET balance = $a WHERE id = $refid");
if($r_c == "on"){
mysqli_query($connect,"UPDATE `users` SET `ref_competation` = `ref_competation` + '1', `referrals` = `referrals` + '1' WHERE `id`='$refid'");
}else{
mysqli_query($connect,"UPDATE `users` SET `referrals` = `referrals` + '1' WHERE `id`='$refid'");
}
$text = "<b>📳 <b>Sizda yangi</b> <a href='tg://user?id=$cid'>taklif</a> <b>mavjud!</b>

Hisobingizga ".enc("decode",$setting['referal'])." so‘m qo'shildi!</b>";
$p = get("user/$refid.users");
put("user/$refid.users",$p+1);
}else{
if($r_c == "on"){
mysqli_query($connect,"UPDATE `users` SET `ref_competation` = `ref_competation` + '1', `referrals` = `referrals` + '1' WHERE `id`='$refid'");
}else{
mysqli_query($connect,"UPDATE `users` SET `referrals` = `referrals` + '1' WHERE `id`='$refid'");
}
file_put_contents("user/$cid.id",$refid);
$text = "<b>📳 <b>Sizda yangi</b> <a href='tg://user?id=$cid'>taklif</a> <b>mavjud!</b></b>";
}
bot('sendMessage',[
'chat_id'=>$cid,
    'text'=>"🖥 Asosiy menyudasiz",
    'parse_mode'=>'html',
'reply_markup'=>$m,
]);
bot('SendMessage',[
'chat_id'=>$refid,
'text'=>$text,
'parse_mode'=>'html',
]);
}
}
}
}


if($message){
adduser($cid);
}