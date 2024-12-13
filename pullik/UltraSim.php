<?php

date_default_timezone_set("asia/Tashkent");

ob_start();
set_time_limit(0);
define("API_KEY","API_TOKEN");
$admin = "ADMIN_ID";
$bot = bot(getMe)->result->username;

define("DB_SERVER", "localhost"); 
define("DB_USERNAME", "user5712_createsim"); 
define("DB_PASSWORD", "Qqww112233"); 
define("DB_NAME", "user5712_createsim"); 

$connect = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
mysqli_set_charset($connect, "utf8mb4");
if($connect){
    echo "";
}

mkdir("set");


$me=📲;

function joinchat($id,$f="menu=home"){
$array = array("inline_keyboard");
$get = file_get_contents("set/kanal.txt");
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
      $array['inline_keyboard'][$i][0]['text']="✅ ".$first_line;
$array['inline_keyboard'][$i][0]['callback_data']="null";
         }else{
$array['inline_keyboard'][$i][0]['text'] = "❌ ".$first_line;
$array['inline_keyboard'][$i][0]['url'] = "https://t.me/$kanall";
$uns = true;
}
}
$array['inline_keyboard'][$i][0]['text'] = "🔄 Tekshirish";
$array['inline_keyboard'][$i][0]['callback_data'] ="$f";
if($uns == true){
     bot('sendMessage',[
         'chat_id'=>$id,
         'text'=>"⚠️ <b>Botdan foydalanish uchun, quyidagi kanallarga obuna bo'ling:</b>",
'parse_mode'=>html,
'reply_markup'=>json_encode($array),
]);  
exit();
return false;
}else{
return true;
}
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




function sms($id,$text,$m){
return bot('sendMessage',[
'chat_id'=>$id,
'text'=>"<b>$text</b>",
"parse_mode"=>HTML,
"reply_markup"=>$m,
]);
}

function edit($id,$mid,$tx,$m){
return bot('editMessageText',[
'chat_id'=>$id,
'message_id'=>$mid,
'text'=>"<b>$tx</b>",
'parse_mode'=>"HTML",
'reply_markup'=>$m,
]);
}

function del(){
global $cid,$mid,$fromid,$mesid;
return bot('deleteMessage',[
'chat_id'=>$fromid.$cid,
'message_id'=>$mesid.$mid,
]);
}

function addstat($id){
    $check = file_get_contents("stat.txt");
    $rd = explode("\n",$check);
    if(!in_array($id,$rd)){
        file_put_contents("stat.txt","\n".$id,FILE_APPEND);
    }
}

if(get("set/ref")){
}else{
put("set/ref",0);
}

if(get("set/foiz")){
}else{
put("set/foiz",20);
}

if(get("set/rub")){
}else{
put("set/rub",181);
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

$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$tx = $message->text;
$text = $message->text;
$type = $update->message->chat->type;
$mid = $message->message_id;
$fid= $message->chat->id;
$cid = $message->chat->id;
$data = $update->callback_query->data;
$qid = $update->callback_query->id;
$fromid = $update->callback_query->message->chat->id;
$mesid = $update->callback_query->message->message_id;
$callname = $update->callback_query->from->first_name;
$calluser = $update->callback_query->from->username;
$mmid = $update->callback_query->inline_message_id;
$gid = $update->callback_query->message->chat->id;
$name = $update->message->from->first_name;
$username = $message->from->username;



mkdir("step");
mkdir("user");

if(file_get_contents("user/$cid.pul")){
}else{
file_put_contents("user/$cid.pul",0);
}

if(file_get_contents("user/refsum")){
}else{
file_put_contents("user/refsum",0);
}

$refsum=get("user/refsum");

if(file_get_contents("user/$cid.dav")){
}else{
file_put_contents("user/$cid.dav","40|Uzbekistan|any");
}

function get($id){
return file_get_contents($id);
}

function put($h,$r){
file_put_contents($h,$r);
}

if($message){
$kun = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kunlik WHERE user_id=$admin"))['kun'];
	if(($kun == "0") or (mb_stripos($kun, "-")!==false)){
	exit();
}else{
}
}

if(isset($message)){
$ban=get("user/$cid.ban");
if($ban=="ban"){
exit();
}
}

if(isset($update)){
$ban=get("user/$fromid.ban");
if($ban=="ban"){
exit();
}
}

$step=get("step/".$cid.".txt");
$cstep=get("step/".$fromid.".txt");
$pul=get("user/$fromid.pul");

$simkey=get("set/api_key");

$menu=json_encode([
'inline_keyboard'=>[
[['text'=>"📲 Raqam olish",'callback_data'=>"menu=raqam"]],
[['text'=>"🌍 Davlatlar",'callback_data'=>"menu=davlat"],['text'=>"📡 Operatorlar",'callback_data'=>"menu=operator"]],
[['text'=>"💰 Balans",'callback_data'=>"menu=balans"],['text'=>"💳 Pul ishlash",'callback_data'=>"menu=earn"]],
]
]);

$menu1=json_encode([
'inline_keyboard'=>[
[['text'=>"📲 Raqam olish",'callback_data'=>"menu=raqam"]],
[['text'=>"🌍 Davlatlar",'callback_data'=>"menu=davlat"],['text'=>"📡 Operatorlar",'callback_data'=>"menu=operator"]],
[['text'=>"💰 Balans",'callback_data'=>"menu=balans"],['text'=>"💳 Pul ishlash",'callback_data'=>"menu=earn"]],
[['text'=>"🗄️ Boshqaruv",'callback_data'=>"boshqaruv"]],
]
]);

$panel=json_encode([
'inline_keyboard'=>[
[['text'=>"🗄️ Boshqaruv",'callback_data'=>"boshqaruv"]],
]
]);

$api_s=json_encode([
'inline_keyboard'=>[
[['text'=>"💵 API Hisob",'callback_data'=>"hisob"]],
[['text'=>"♻️ APIni yangilash",'callback_data'=>kalit]],
[['text'=>"🗄️ Boshqaruv",'callback_data'=>"boshqaruv"]],
]
]);

if($data=="hisob"){
$urla = file_get_contents("https://api.sms-activate.org/stubs/handler_api.php?api_key=$simkey&action=getBalance");
if($urla=="BAD_KEY" or $urla=="NO_KEY"){
bot('answerCallbackQuery',[
'callback_query_id'=>$qid,
'text'=>"Adashib qoldingiz!",
'show_alert'=>true,
]);
}else{
$h=explode(":",$urla)[1];
bot('answerCallbackQuery',[
'callback_query_id'=>$qid,
'text'=>"API hisobi $h ₽",
'show_alert'=>true,
]);
}
}

if($data=="rKurs"){
$json3=json_decode(file_get_contents("https://cbu.uz/uz/arkhiv-kursov-valyut/json/"),1);
foreach($json3 as $json4){
if($json4['Ccy']=="RUB"){
$rate=$json4['Rate'];
break;
}
}
bot('answerCallbackQuery',[
'callback_query_id'=>$qid,
'text'=>"1₽ - $rate UZS!",
'show_alert'=>true,
]);
}

$apik=get("set/api_key");
$urlaa = file_get_contents("https://api.sms-activate.org/stubs/handler_api.php?api_key=$apik&action=getBalance");
if($urlaa=="BAD_KEY" or $urlaa=="NO_KEY"){
$ass=json_encode([
'inline_keyboard'=>[
[['text'=>"🔑 API kalit ulash",'callback_data'=>kalit],['text'=>"🔗 Taklif narxi",'callback_data'=>taklif],],
[['text'=>"📎 Majburiy obunalar",'callback_data'=>"majburiy"]],
[['text'=>"💵 Kursni o‘rnatish",'callback_data'=>kurs],['text'=>"⚖️ Foizni o‘rnatish",'callback_data'=>foiz]],
[['text'=>"🗄️ Boshqaruv",'callback_data'=>"boshqaruv"]],
]
]);
}else{
$ass=json_encode([
'inline_keyboard'=>[
[['text'=>"🔑 API kalit sozlamalari",'callback_data'=>kalit_s],['text'=>"🔗 Taklif narxi",'callback_data'=>taklif],],
[['text'=>"📎 Majburiy obunalar",'callback_data'=>"majburiy"]],
[['text'=>"💵 Kursni o‘rnatish",'callback_data'=>kurs],['text'=>"⚖️ Foizni o‘rnatish",'callback_data'=>foiz]],
[['text'=>"🗄️ Boshqaruv",'callback_data'=>"boshqaruv"]],
]
]);
}

if($data=="majburiy" and $fromid==$admin){
edit($fromid,$mesid,"📎 Majburiy obunalar",json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Qo‘shish",'callback_data'=>"kanal=add"]],
[['text'=>"*️⃣ Ro‘yxat",'callback_data'=>"kanal=list"],['text'=>"🗑️ O'chirish",'callback_data'=>"kanal=dl"]],
[['text'=>"🗄️ Boshqaruv",'callback_data'=>"boshqaruv"]],
]]));
}

if((stripos($data,"kanal=")!==false)){
$rp=explode("=",$data)[1];
if($rp=="list"){
$ops=get("set/kanal.txt");
if(empty($ops)){
sms($fromid,"🤷‍♂️ Xechqanday kanal topilmadi.",null);
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
sms($fromid,"👉 Barcha kanallar:",$keyboard);
}
}elseif($rp=="dl"){
$ops=get("set/kanal.txt");
if(empty($ops)){
sms($fromid,"🤷‍♂️ Xechqanday kanal topilmadi.",null);
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
sms($fromid,"🗑️ O‘chiriladigan kanalni tanlang:",$keyboard);
}
}elseif(mb_stripos($rp,"del@")!==false){
$d=explode("@",$rp)[1];
$ops=get("set/kanal.txt");
$soni = explode("\n",$ops);
if(count($soni)==1){
unlink("set/kanal.txt");
}else{
$ss="@".$d;
$ops=str_replace("\n".$ss."","",$ops);
put("set/kanal.txt",$ops);
}
del();
sms($fromid,"✅ O‘chirildi",null);
}elseif($rp=="add"){
del();
sms($fromid,"
♻️ Kanal userini kiriting

Namuna: @username",json_encode([
'inline_keyboard'=>[
[['text'=>"🗄️ Boshqaruv",'callback_data'=>"boshqaruv"]],
]
]));
put("step/$fromid.txt","kanal_add");
}
}

if($step=="kanal_add"){
if(mb_stripos($text,"@")!==false){
$kanal=get("set/kanal.txt");
sms($cid,"✅ Saqlandi!",json_encode([
'inline_keyboard'=>[
[['text'=>"🗄️ Boshqaruv",'callback_data'=>"boshqaruv"]],
]
]));
if($kanal==null){
file_put_contents("set/kanal.txt",$text);
}else{
file_put_contents("set/kanal.txt","$kanal\n$text");
}
unlink("step/$fromid.txt");
}
}


if($data=="kalit_s" and $fromid==$admin){
$urla = file_get_contents("https://api.sms-activate.org/stubs/handler_api.php?api_key=$simkey&action=getBalance");
if($urla=="BAD_KEY" or $urla=="NO_KEY"){
bot('answerCallbackQuery',[
'callback_query_id'=>$qid,
'text'=>"Adashib qoldingiz!",
'show_alert'=>true,
]);
}else{
edit($fromid,$mesid,"👇 Kerakli tugmani tanlang:",$api_s);
}
}

if($data=="boshqaruv" and $fromid==$admin){
edit($fromid,$mesid,"
👇 Boshqaruv paneli

🗄️ Kerakli bo‘limni tanlang:",json_encode([
'inline_keyboard'=>[
[['text'=>"🔔Xabar yuborish",'callback_data'=>"panel=send"],['text'=>"⚙️ Asosiy sozlamalar",'callback_data'=>"panel=asosiy"]],
[['text'=>"🇺🇿 Rubl kursi",'callback_data'=>rKurs],['text'=>"📊 Statistika",'callback_data'=>"panel=stat"]],
[['text'=>"👤 Foydalanuvchini boshqarish",'callback_data'=>"panel=control"]],
[['text'=>"💵 To‘lov holati",'callback_data'=>"panel=holat"],['text'=>"⬇️ Orqaga",'callback_data'=>"menu=home"]],
]]));
unlink("step/$fromid.txt");
exit();
}


if($data=="kurs" and $fromid==$admin){
edit($fromid,$mesid,"
💵 1 ₽ narxini kiriting:

♻️ Joriy narx: ".get("set/rub")." so‘m",$panel);
put("step/$fromid.txt","updRub");
}

if($step=="updRub"){
if(is_numeric($text)){
sms($cid,"✅ Saqlandi!",$panel);
put("set/rub",$text);
}
unlink("step/$cid.txt");
}

if($data=="taklif" and $fromid==$admin){
edit($fromid,$mesid,"
🔗 Taklif narxini kiriting

♻️ Joriy narx: ".get("user/refsum")." so‘m",$panel);
put("step/$fromid.txt","updT");
}

if($step=="updT"){
if(is_numeric($text)){
sms($cid,"✅ Saqlandi!",$panel);
put("user/refsum",$text);
}
unlink("step/$cid.txt");
}



if($data=="kalit" and $fromid==$admin){
edit($fromid,$mesid,"🔑 API kalitni yuboring

API kalit olish manzili: sms-activate.org",$panel);
put("step/$fromid.txt","updAPI");
}

if($step=="updAPI"){
if(isset($text)){
$urla = file_get_contents("https://api.sms-activate.org/stubs/handler_api.php?api_key=$text&action=getBalance");
if($urla=="BAD_KEY" or $urla=="NO_KEY"){
sms($cid,"⚠️ Noma'lum API kalit

Qaytadan urining",$panel);
}else{
sms($cid,"✅ Saqlandi!",$panel);
put("set/api_key",$text);
}
unlink("step/$cid.txt");
}
}

if($data=="foiz" and $fromid==$admin){
edit($fromid,$mesid,"
⭐ Xizmatlar uchun foizni kiriting

♻️ Joriy foiz: ".get("set/foiz")."%",$panel);
put("step/$fromid.txt","updFoiz");
}

if($step=="updFoiz" and $text>0){
if(is_numeric($text)){
sms($cid,"✅ Saqlandi!",$panel);
put("set/foiz",$text);
}
unlink("step/$cid.txt");
}








if((stripos($data,"panel=")!==false)){
$res=explode("=",$data)[1];
if($res=="stat"){
$stat=substr_count(get("stat.txt"),"\n");
edit($fromid,$mesid,"📊 Bot obunachilari: $stat ta",json_encode([
'inline_keyboard'=>[
[['text'=>"♻️ Yangilash",'callback_data'=>"panel=stat"]],
[['text'=>"⬇️ Orqaga", 'callback_data'=>"boshqaruv"]],
]]));
}elseif($res=="send"){
edit($fromid,$mesid,"👇 Xabaringizni kiriting:",json_encode([
'inline_keyboard'=>[
[['text'=>"⬇️ Orqaga", 'callback_data'=>"boshqaruv"]],
]]));
file_put_contents("step/$fromid.txt","sendPost");
}elseif($res=="asosiy"){
edit($fromid,$mesid,"⚙️ Asosiy sozlamalar:",$ass);
}elseif($res == control){
edit($fromid,$mesid,"<b>Kerakli foydalanuvchining ID raqamini kiriting:</b>",$panel);
file_put_contents("step/$fromid.txt",'iD');
}elseif($res ==holat){
$kun = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kunlik WHERE user_id=$admin"))['kun'];
edit($fromid,$mesid,"
💵 <b>To'lov holati:

⏳  $kun kundan so'ng bot uyqu rejimiga o'tkaziladi.</b>",json_encode([
	'inline_keyboard'=>[
[['text'=>"Yangilash",'callback_data'=>"panel=holat"],['text'=>"@CreateSimBot",'url'=>"https://t.me/CreateSIMBot"]],
[['text'=>"🗄️ Boshqaruv",'callback_data'=>"boshqaruv"]],
]]));
exit();
}
}

$saved = file_get_contents("user/us.id");

if($step == "iD"){
if($cid == $admin){
if(file_exists("user/$text.pul")){
file_put_contents("user/us.id",$text);
$pul = file_get_contents("user/$text.pul");
$ban = file_get_contents("user/$text.ban");
if($ban == null){
$bans = "🔔 Banlash";
}
if($ban == "ban"){
$bans = "🔕 Bandan olish";
}
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Qidirilmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
        'chat_id'=>$cid,
        'message_id'=>$mid + 1,
        'text'=>"<b>Qidirilmoqda...</b>",
       'parse_mode'=>'html',
]);
bot('editMessageText',[
      'chat_id'=>$cid,
     'message_id'=>$mid + 1,
'text'=>"<b>Foydalanuvchi topildi!

ID:</b> <a href='tg://user?id=$text'>$text</a>
<b>Balans: $pul so‘m</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"$bans",'callback_data'=>"ban"]],
[['text'=>"➕ Pul qo'shish",'callback_data'=>"plus"],['text'=>"➖ Pul ayirish",'callback_data'=>"minus"]]
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
'chat_id'=>$fromid,
'message_id'=>$mesid,
'text'=>"<a href='tg://user?id=$saved'>$saved</a> <b>ning hisobiga qancha pul qo'shmoqchisiz?</b>",
'parse_mode'=>"html",
	'reply_markup'=>$panel,
]);
file_put_contents("step/$fromid.txt",'plus');
}

if($step == "plus"){
if($cid == $admin){
if(is_numeric($text)=="true"){
bot('sendMessage',[
'chat_id'=>$saved,
'text'=>"<b>Adminlar tomonidan hisobingiz $text so‘m to'ldirildi</b>",
'parse_mode'=>"html",
'reply_markup'=>$menu,
]);
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Foydalanuvchi hisobiga $text so‘m qo'shildi!</b>",
'parse_mode'=>"html",
'reply_markup'=>$panel,
]);
$pul = file_get_contents("user/$saved.pul");
$miqdor = $pul + $text;
file_put_contents("user/$saved.pul",$miqdor);
unlink("step/$cid.txt");

}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Faqat raqamlardan foydalaning!</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel,
]);

}
}
}

if($data == "minus"){
bot('sendMessage',[
'chat_id'=>$fromid,
'message_id'=>$mesid,
'text'=>"<a href='tg://user?id=$saved'>$saved</a> <b>ning hisobiga qancha pul qo'shmoqchisiz?</b>",
'parse_mode'=>"html",
	'reply_markup'=>$panel,
]);
file_put_contents("step/$fromid.txt",'minus');
}

if($step == "minus"){
if($cid == $admin){
if(is_numeric($text)==true){
bot('sendMessage',[
'chat_id'=>$saved,
'text'=>"<b>Adminlar tomonidan hisobingizdan $text so‘m olindi.</b>",
'parse_mode'=>"html",
'reply_markup'=>$menu,
]);
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Foydalanuvchi hisobidan $text so‘m olindi!</b>",
'parse_mode'=>"html",
'reply_markup'=>$panel,
]);
$pul = file_get_contents("user/$saved.pul");
$miqdor = $pul - $text;
file_put_contents("user/$saved.pul",$miqdor);
unlink("step/$cid.txt");

}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Faqat raqamlardan foydalaning!</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel,
]);
}
}
}

if($data=="ban"){
$ban = file_get_contents("user/$saved.ban");
if($admin!=$saved){
if($ban == "ban"){
unlink("user/$saved.ban");
bot('sendMessage',[
'chat_id'=>$fromid,
'message_id'=>$mesid,
'text'=>"<b>Foydalanuvchi ($saved) bandan olindi!</b>",
'parse_mode'=>"html",
	'reply_markup'=>$panel,
]);
}else{
file_put_contents("user/$saved.ban",'ban');
bot('sendMessage',[
'chat_id'=>$fromid,
'message_id'=>$mesid,
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

if(mb_stripos($text,"/start")!==false){
$refid=explode(" ",$text)[1];
if(strlen($refid)>0 and is_numeric($refid)){
$us=get("stat.txt");
if($refid==$cid and joinchat($cid,"menu=home")==1){
sms($cid,"☝️ <b>Hurmatli foydalanuvchi!</b>

Botga o'zingizni taklif qila olmaysiz!",null);
}else{
$us=file_get_contents("stat.txt");
if(mb_stripos($us,$cid)!==false and joinchat($cid,"menu=home")==1){
sms($cid,"<b>Hurmatli foydalanuvchi!</b>

Doʻstingiz sizni taklif qila olmaydi!",$menu);
}else{
file_put_contents("user/".$cid.".ref",$refid);
if(joinchat($cid,"menu=home")==1) {
$refname=bot('getChat',[chat_id=>$refid])->result->first_name;
sms($cid,"🔔 Sizni: $refname taklif etdi",null);
addstat($refid);
sms($refid,"🔔 Sizning balansingizga $refsum so‘m qo‘shildi",null);
$refpul=get("user/$refid.pul");
file_put_contents("user/$refid.pul",$refpul+$refsum);
file_put_contents("user/$cid.ref","\n".$refid,FILE_APPEND);
}
}
}
}else{
if($cid==$admin){
$menu=$menu1;
}else{
$menu=$menu;
}
sms($cid,"
📖 @$bot ga xush kelibsiz

👇Kerakli tugmani tanlang",$menu);
}
}


addstat($cid);

if((stripos($data,"menu=")!==false and joinchat($fromid)==1)){
if($fromid==$admin){
$menu=$menu1;
}else{
$menu=$menu;
}
unlink("step/$fromid.txt");
$res=explode("=",$data)[1];
if($res=="balans"){
edit($fromid,$mesid,"
💰 Sizning balans: ".get("user/$fromid.pul")." so‘m

🌍 Sizning joriy davlat: ".explode("|",get("user/$fromid.dav"))[1]."
",$menu);
}elseif($res=="davlat") {
$url = json_decode(file_get_contents("https://api.sms-activate.org/stubs/handler_api.php?api_key=$simkey&action=getCountries"), true);
$urla = file_get_contents("https://api.sms-activate.org/stubs/handler_api.php?api_key=$simkey&action=getCountries");
if($urla=="BAD_KEY" or $urla=="NO_KEY"){
bot('answerCallbackQuery',[show_alert=>1,
'callback_query_id'=>$qid,
'text'=>"Nomalum xatolik keyinroq urinib koring",
]);
}else{
$key = [];
for ($i = 0; $i < 39; $i++) {
$key[] = ["text" => $url["$i"]['eng'], 'callback_data' => "davl=".$url["$i"]['id']."=".$url["$i"]['eng']];
}
$key1 = array_chunk($key,3);
$key1[]=[["text"=>"1/5","callback_data"=>"null"],['text'=>"▶️",'callback_data'=>"davlat2"]];
$key1[]=[['text'=>"⬇️ Orqaga",'callback_data'=>"menu=home"]];
bot('editMessageText',[
'chat_id'=>$fromid,
'message_id'=>$mesid,
'text'=>"🌍 Davlatlar ro'yxati
👇 Kerakli davlatni tanlang", 
'parse_mode'=>'markdown',
'reply_markup' => json_encode([
 'inline_keyboard'=>$key1,
 ]),
]);
}
}elseif($res=="operator") {
$urla = file_get_contents("https://api.sms-activate.org/stubs/handler_api.php?api_key=$simkey&action=getCountries");
if($urla=="BAD_KEY" or $urla=="NO_KEY"){
bot('answerCallbackQuery',[show_alert=>1,
'callback_query_id'=>$qid,
'text'=>"Nomalum xatolik keyinroq urinib koring",
]);
}else{
$coid=explode("|",get("user/$fromid.dav"))[0];
$key = [];
$url = json_decode(file_get_contents("https://api.sms-activate.org/stubs/handler_api.php?api_key=$simkey&action=getOperators&country=$coid"), true);
for ($i = 0; $i<count($url['countryOperators'][$coid]); $i++) {
$key[] = ["text" =>"📞 ".$url['countryOperators'][$coid][$i], 'callback_data' =>"operator=".$url['countryOperators'][$coid][$i]];
}
$key1 = array_chunk($key,3);
$key1[]=[['text'=>"📞 any",'callback_data'=>"operator=any"]];
$key1[]=[['text'=>"⬇️ Orqaga",'callback_data'=>"menu=home"]];
edit($fromid,$mesid,"
🌍 Sizning davlat: ".explode("|",get("user/$fromid.dav"))[1]."

📲 Kerakli operatorni tanlang:",json_encode([inline_keyboard=>$key1]));
}
}elseif($res=="home" and joinchat($fromid,"menu=home")==1){
edit($fromid,$mesid,"📖 @$bot ga xush kelibsiz

👇Kerakli tugmani tanlang",$menu);
$refs=get("user/$fromid.ref");
sms($refs,"🔔 Sizning balansingizga $refsum so‘m qo‘shildi",null);
$refpul=get("user/$refs.pul");
file_put_contents("user/$refs.pul",$refpul+$refsum);
unlink("user/$fromid.ref");
exit();
}elseif($res=="raqam" and joinchat($fromid,"menu=raqam")==1){
$urla = file_get_contents("https://api.sms-activate.org/stubs/handler_api.php?api_key=$simkey&action=getCountries");
if($urla=="BAD_KEY" or $urla=="NO_KEY"){
bot('answerCallbackQuery',[show_alert=>1,
'callback_query_id'=>$qid,
'text'=>"Nomalum xatolik keyinroq urinib koring",
]);
}else{
bot('editMessageText',[
'chat_id'=>$fromid,
'message_id'=>$mesid,
'text'=>"👇O‘zingizga kerakli tarmoqni tanlang: ",
'parse_mode'=>'markdown',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"$me Telegram",'callback_data'=>"buy_tg"],['text'=>"$me Instagram",'callback_data'=>"buy_ig"]],
[['text'=>"$me Viber",'callback_data'=>"buy_vi"],['text'=>"$me Facebook",'callback_data'=>"buy_fb"]],
[['text'=>"$me TikTok",'callback_data'=>"buy_lf"],['text'=>"$me Twitter",'callback_data'=>"buy_tw"]],
[['text'=>"$me WhatsApp",'callback_data'=>"buy_wh"],['text'=>"$me Google",'callback_data'=>"buy_go"]],
[['text'=>"$me Imo",'callback_data'=>"buy_im"],['text'=>"$me Snapchat",'callback_data'=>"buy_fu"]],
[['text'=>"$me Mail.ru",'callback_data'=>"buy_ma"],['text'=>"$me OLX",'callback_data'=>"buy_sn"]],
[['text'=>"$me PayPal",'callback_data'=>"buy_ts"],['text'=>"$me Yandex",'callback_data'=>"buy_ha"]],
[['text'=>"$me Stream",'callback_data'=>"buy_mt"],['text'=>"$me Tinder",'callback_data'=>"buy_oi"]],
[['text'=>"$me Mamba",'callback_data'=>"buy_fd"],['text'=>"$me Dent",'callback_data'=>"buy_zz"]],
[['text'=>"$me Kakao Talk",'callback_data'=>"buy_kt"],['text'=>"$me LinkediN",'callback_data'=>"buy_tn"]],
[['text'=>"1/16",'callback_data'=>"null"],['text'=>"▶️",'callback_data'=>"next=2"]],
[['text'=>"⬇️Oraqaga",'callback_data'=>"menu=home"]],
]
])
]);
}
}elseif($res=="earn"){
edit($fromid,$mesid,"👇 Qaysi usulda pul ishlashni xoxlaysiz",json_encode([
inline_keyboard=>[
[['text'=>"🔗 Taklifnoma",'callback_data'=>"menu=ref"]],
[['text'=>"📞 Admin orqali",'url'=>"tg://user?id=$admin"]],
[['text'=>"⬇️Oraqaga",'callback_data'=>"menu=home"]],
]]));
}elseif($res=="ref"){
edit($fromid,$mesid,"
🔗 Taklifnoma orqali pul ishlash

🔗 Sizning xavolangiz: t.me/$bot?start=$fromid

👤 1 ta taklif uchun $refsum so‘m",
json_encode([inline_keyboard=>[
[['text'=>"⬇️ Orqaga",'callback_data'=>"menu=earn"]],
]]));
}
}


$next_2=json_encode([
'inline_keyboard'=>[
[['text'=>"$me Tencent QQ",'callback_data'=>"buy_qq"],['text'=>"$me Magnit",'callback_data'=>"buy_mg"]],
[['text'=>"$me Ukrnet",'callback_data'=>"buy_hu"],['text'=>"$me Skout",'callback_data'=>"buy_wg"]],
[['text'=>"$me EasyPay",'callback_data'=>"buy_rz"],['text'=>"$me Q12Triva",'callback_data'=>"buy_vf"]],
[['text'=>"$me Pyro music",'callback_data'=>"buy_ny"],['text'=>"$me Wolt",'callback_data'=>"buy_rr"]],
[['text'=>"$me CliQQ",'callback_data'=>"buy_fe"],['text'=>"$me SsoidneT",'callback_data'=>"buy_la"]],
[['text'=>"$me Proton mail",'callback_data'=>"buy_dp"],['text'=>"$me CityMobil",'callback_data'=>"buy_yf"]],
[['text'=>"$me PGBonus",'callback_data'=>"buy_fx"],['text'=>"$me Mega",'callback_data'=>"buy_qr"]],
[['text'=>"$me Sport master",'callback_data'=>"buy_yk"],['text'=>"$me Careem",'callback_data'=>"buy_ls"]],
[['text'=>"$me Bigo live",'callback_data'=>"buy_bl"],['text'=>"$me Keybase",'callback_data'=>"buy_bf"]],
[['text'=>"$me Ntt game",'callback_data'=>"buy_zy"],['text'=>"$me Survery time",'callback_data'=>"buy_gd"]],
[['text'=>"◀️",'callback_data'=>"menu=raqam"],['text'=>"2/16",'callback_data'=>"null"],['text'=>"▶️",'callback_data'=>"next=3"]],
[['text'=>"⬇️Oraqaga",'callback_data'=>"menu=home"]],
]
]);

$next_3=json_encode([
'inline_keyboard'=>[
[['text'=>"$me My love",'callback_data'=>"buy_fy"],['text'=>"$me Mosru",'callback_data'=>"buy_ce"]],
[['text'=>"$me Truecaller",'callback_data'=>"buy_tl"],['text'=>"$me Globus",'callback_data'=>"buy_hm"]],
[['text'=>"$me Bolt",'callback_data'=>"buy_tx"],['text'=>"$me Shope",'callback_data'=>"buy_ka"]],
[['text'=>"$me Перекресток",'callback_data'=>"buy_pl"],['text'=>"$me Burger King",'callback_data'=>"buy_ip"]],
[['text'=>"$me Prom",'callback_data'=>"buy_cm"],['text'=>"$me Alipay/Alibaba",'callback_data'=>"buy_hw"]],
[['text'=>"$me Karusel",'callback_data'=>"buy_de"],['text'=>"$me IVI",'callback_data'=>"buy_jc"]],
[['text'=>"$me inDriver",'callback_data'=>"buy_rl"],['text'=>"$me Happn",'callback_data'=>"buy_df"]],
[['text'=>"$me Rutube",'callback_data'=>"buy_ui"],['text'=>"$me Magnolia",'callback_data'=>"buy_up"]],
[['text'=>"$me Foodpanda",'callback_data'=>"buy_nz"],['text'=>"$me Weibo",'callback_data'=>"buy_kf"]],
[['text'=>"$me BillMill",'callback_data'=>"buy_ri"],['text'=>"$me QuiPP",'callback_data'=>"buy_cc"]],
[['text'=>"◀️",'callback_data'=>"next=2"],['text'=>"3/16",'callback_data'=>"null"],['text'=>"▶️",'callback_data'=>"next=4"]],
[['text'=>"⬇️Oraqaga",'callback_data'=>"menu=home"]],
]
]);

$next_4=json_encode([
'inline_keyboard'=>[
[['text'=>"$me OKta",'callback_data'=>"buy_lr"],['text'=>"$me JDCom",'callback_data'=>"buy_za"]],
[['text'=>"$me MTS Cashback",'callback_data'=>"buy_da"],['text'=>"$me FiqsY",'callback_data'=>"buy_ug"]],
[['text'=>"$me KuCoinPlay",'callback_data'=>"buy_sq"],['text'=>"$me Papara",'callback_data'=>"buy_zr"]],
[['text'=>"$me Wish",'callback_data'=>"buy_xv"],['text'=>"$me iCrypeX",'callback_data'=>"buy_cx"]],
[['text'=>"$me PaddyPower",'callback_data'=>"buy_cw"],['text'=>"$me Baidu",'callback_data'=>"buy_li"]],
[['text'=>"$me Dominoss pizza",'callback_data'=>"buy_dz"],['text'=>"$me Paycell",'callback_data'=>"buy_xz"]],
[['text'=>"$me LentA",'callback_data'=>"buy_rd"],['text'=>"$me Payberry",'callback_data'=>"buy_qb"]],
[['text'=>"$me Drom",'callback_data'=>"buy_hz"],['text'=>"$me GlobalteL",'callback_data'=>"buy_gl"]],
[['text'=>"$me Deliveroo",'callback_data'=>"buy_zk"],['text'=>"$me Socios",'callback_data'=>"buy_ia"]],
[['text'=>"$me Wmaraci",'callback_data'=>"buy_xl"],['text'=>"$me YemekSepeti",'callback_data'=>"buy_yu"]],
[['text'=>"◀️",'callback_data'=>"next=3"],['text'=>"4/16",'callback_data'=>"null"],['text'=>"▶️",'callback_data'=>"next=5"]],
[['text'=>"⬇️Oraqaga",'callback_data'=>"menu=home"]],
]
]);

$next_5=json_encode([
'inline_keyboard'=>[
[['text'=>"$me Nike",'callback_data'=>"buy_ew"],['text'=>"$me Glo MyGlo",'callback_data'=>"buy_ae"]],
[['text'=>"$me YouStar",'callback_data'=>"buy_gb"],['text'=>"$me PCA",'callback_data'=>"buy_cy"]],
[['text'=>"$me RosaKhutor",'callback_data'=>"buy_qm"],['text'=>"$me eBay",'callback_data'=>"buy_dh"]],
[['text'=>"$me Система город",'callback_data'=>"buy_yb"],['text'=>"$me GG",'callback_data'=>"buy_qe"]],
[['text'=>"$me Grindr",'callback_data'=>"buy_yw"],['text'=>"$me OffGamers",'callback_data'=>"buy_uz"]],
[['text'=>"$me Heosiburadacom",'callback_data'=>"buy_gx"],['text'=>"$me Coinbase",'callback_data'=>"buy_re"]],
[['text'=>"$me dbRuA",'callback_data'=>"buy_tj"],['text'=>"$me Hilly",'callback_data'=>"buy_rt"]],
[['text'=>"$me SneakersNstuff",'callback_data'=>"buy_sf"],['text'=>"$me Dostavista",'callback_data'=>"buy_sv"]],
[['text'=>"$me 32Red",'callback_data'=>"buy_qi"],['text'=>"$me Blizzard",'callback_data'=>"buy_bz"]],
[['text'=>"$me eZbuY",'callback_data'=>"buy_db"],['text'=>"$me coinField",'callback_data'=>"buy_vw"]],
[['text'=>"◀️",'callback_data'=>"next=4"],['text'=>"5/16",'callback_data'=>"null"],['text'=>"▶️",'callback_data'=>"next=6"]],
[['text'=>"⬇️Oraqaga",'callback_data'=>"menu=home"]],
]
]);

$next_6=json_encode([
'inline_keyboard'=>[
[['text'=>"$me Airtel",'callback_data'=>"buy_zl"],['text'=>"$me yandexGo",'callback_data'=>"buy_wf"]],
[['text'=>"$me MrGreen",'callback_data'=>"buy_lw"],['text'=>"$me Rediffmail",'callback_data'=>"buy_co"]],
[['text'=>"$me Miloan",'callback_data'=>"buy_ey"],['text'=>"$me PaytM",'callback_data'=>"buy_ge"]],
[['text'=>"$me Dhani",'callback_data'=>"buy_os"],['text'=>"$me CMTuzdan",'callback_data'=>"buy_ql"]],
[['text'=>"$me Mercado",'callback_data'=>"buy_cq"],['text'=>"$me DiDi",'callback_data'=>"buy_xk"]],
[['text'=>"$me Monese",'callback_data'=>"buy_py"],['text'=>"$me Kotak811",'callback_data'=>"buy_rv"]],
[['text'=>"$me Hopi",'callback_data'=>"buy_jl"],['text'=>"$me TrendYoll",'callback_data'=>"buy_pr"]],
[['text'=>"$me Justdating",'callback_data'=>"buy_pu"],['text'=>"$me Pairs",'callback_data'=>"buy_dk"]],
[['text'=>"$me Touchance",'callback_data'=>"buy_fm"],['text'=>"$me SnappFood",'callback_data'=>"buy_ph"]],
[['text'=>"$me NCsoft",'callback_data'=>"buy_sw"],['text'=>"$me Tosla",'callback_data'=>"buy_nr"]],
[['text'=>"◀️",'callback_data'=>"next=5"],['text'=>"6/16",'callback_data'=>"null"],['text'=>"▶️",'callback_data'=>"next=7"]],
[['text'=>"⬇️Oraqaga",'callback_data'=>"menu=home"]],
]
]);

$next_7=json_encode([
'inline_keyboard'=>[
[['text'=>"$me ininal",'callback_data'=>"buy_hy"],['text'=>"$me PaySend",'callback_data'=>"buy_tr"]],
[['text'=>"$me CDKeys",'callback_data'=>"buy_pq"],['text'=>"$me Avon",'callback_data'=>"buy_ff"]],
[['text'=>"$me GodoPizza",'callback_data'=>"buy_sd"],['text'=>"$me MCDonalds",'callback_data'=>"buy_ry"]],
[['text'=>"$me eBike Gewinnspiel",'callback_data'=>"buy_le"],['text'=>"$me JKF",'callback_data'=>"buy_hr"]],
[['text'=>"$me MyFishka",'callback_data'=>"buy_qa"],['text'=>"$me Craigslist",'callback_data'=>"buy_wk"]],
[['text'=>"$me Foody",'callback_data'=>"buy_kw"],['text'=>"$me Grab",'callback_data'=>"buy_ig"]],
[['text'=>"$me Zalo",'callback_data'=>"buy_mj"],['text'=>"$me LiveScore",'callback_data'=>"buy_eu"]],
[['text'=>"$me 888Casino",'callback_data'=>"buy_ll"],['text'=>"$me Gamer",'callback_data'=>"buy_ed"]],
[['text'=>"$me Huya",'callback_data'=>"buy_pp"],['text'=>"$me  Weststein",'callback_data'=>"buy_th"]],
[['text'=>"$me Tango",'callback_data'=>"buy_xr"],['text'=>"$me Global24",'callback_data'=>"buy_iz"]],
[['text'=>"◀️",'callback_data'=>"next=6"],['text'=>"7/16",'callback_data'=>"null"],['text'=>"▶️",'callback_data'=>"next=8"]],
[['text'=>"⬇️Oraqaga",'callback_data'=>"menu=home"]],
]
]);

$next_8=json_encode([
'inline_keyboard'=>[
[['text'=>"$me МВидео",'callback_data'=>"buy_tk"],['text'=>"$me Sheerid",'callback_data'=>"buy_rx"]],
[['text'=>"$me 99App",'callback_data'=>"buy_ki"],['text'=>"$me CAIXA",'callback_data'=>"buy_my"]],
[['text'=>"$me OfferUP",'callback_data'=>"buy_zm"],['text'=>"$me Swvl",'callback_data'=>"buy_tq"]],
[['text'=>"$me Haraj",'callback_data'=>"buy_au"],['text'=>"$me Taksheel",'callback_data'=>"buy_ei"]],
[['text'=>"$me Hamrahaval",'callback_data'=>"buy_rp"],['text'=>"$me Gamekit",'callback_data'=>"buy_pa"]],
[['text'=>"$me Sikayet var",'callback_data'=>"buy_fs"],['text'=>"$me Getir",'callback_data'=>"buy_ul"]],
[['text'=>"$me Irancell",'callback_data'=>"buy_cf"],['text'=>"$me Alfa",'callback_data'=>"buy_bt"]],
[['text'=>"$me Disney Hotstar",'callback_data'=>"buy_ud"],['text'=>"$me Agroinform",'callback_data'=>"buy_qu"]],
[['text'=>"$me Humblebundle",'callback_data'=>"buy_un"],['text'=>"$me  Faberlic",'callback_data'=>"buy_rm"]],
[['text'=>"$me Cafebazaar",'callback_data'=>"buy_uo"],['text'=>"$me Cryptocom",'callback_data'=>"buy_ti"]],
[['text'=>"◀️",'callback_data'=>"next=7"],['text'=>"8/16",'callback_data'=>"null"],['text'=>"▶️",'callback_data'=>"next=9"]],
[['text'=>"⬇️Oraqaga",'callback_data'=>"menu=home"]],
]
]);

$next_9=json_encode([
'inline_keyboard'=>[
[['text'=>"$me Gittigdiyor",'callback_data'=>"buy_nk"],['text'=>"$me Mzdaqatar",'callback_data'=>"buy_jm"]],
[['text'=>"$me Algida",'callback_data'=>"buy_lp"],['text'=>"$me Cita Previa",'callback_data'=>"buy_si"]],
[['text'=>"$me Potato chat",'callback_data'=>"buy_fj"],['text'=>"$me Bitaqaty",'callback_data'=>"buy_pt"]],
[['text'=>"$me Праймериз 2020",'callback_data'=>"buy_qc"],['text'=>"$me Amasia",'callback_data'=>"buy_yo"]],
[['text'=>"$me Dream11",'callback_data'=>"buy_ve"],['text'=>"$me Oriflame",'callback_data'=>"buy_qh"]],
[['text'=>"$me Bykea",'callback_data'=>"buy_iu"],['text'=>"$me Immowelt",'callback_data'=>"buy_ib"]],
[['text'=>"$me Digikala",'callback_data'=>"buy_zv"],['text'=>"$me Wing Money",'callback_data'=>"buy_jb"]],
[['text'=>"$me Yaay",'callback_data'=>"buy_vn"],['text'=>"$me GameArena",'callback_data'=>"buy_wn"]],
[['text'=>"$me Вита експресс",'callback_data'=>"buy_bj"],['text'=>"$me Auchan",'callback_data'=>"buy_st"]],
[['text'=>"$me Ricpay",'callback_data'=>"buy_ev"],['text'=>"$me Blued",'callback_data'=>"buy_qn"]],
[['text'=>"◀️",'callback_data'=>"next=8"],['text'=>"9/16",'callback_data'=>"null"],['text'=>"▶️",'callback_data'=>"next=10"]],
[['text'=>"⬇️Oraqaga",'callback_data'=>"menu=home"]],
]
]);

$next_10=json_encode([
'inline_keyboard'=>[
[['text'=>"$me Paxful",'callback_data'=>"buy_dn"],['text'=>"$me PurePlatform",'callback_data'=>"buy_lk"]],
[['text'=>"$me Banqi",'callback_data'=>"buy_vk"],['text'=>"$me 1Xbet",'callback_data'=>"buy_wj"]],
[['text'=>"$me Mobile01",'callback_data'=>"buy_wk"],['text'=>"$me Aitu",'callback_data'=>"buy_jj"]],
[['text'=>"$me Adidas",'callback_data'=>"buy_an"],['text'=>"$me Самокат",'callback_data'=>"buy_jr"]],
[['text'=>"$me Верный",'callback_data'=>"buy_nb"],['text'=>"$me Humta",'callback_data'=>"buy_gv"]],
[['text'=>"$me Diver",'callback_data'=>"buy_dw"],['text'=>"$me MoMo",'callback_data'=>"buy_hc"]],
[['text'=>"$me Eneba",'callback_data'=>"buy_uf"],['text'=>"$me Verse",'callback_data'=>"buy_kn"]],
[['text'=>"$me TaoBao",'callback_data'=>"buy_qd"],['text'=>"$me onTaxi",'callback_data'=>"buy_zf"]],
[['text'=>"$me Hotline",'callback_data'=>"buy_gi"],['text'=>"$me Tatneft",'callback_data'=>"buy_uc"]],
[['text'=>"$me RrsA",'callback_data'=>"buy_mn"],['text'=>"$me Douyu",'callback_data'=>"buy_ak"]],
[['text'=>"◀️",'callback_data'=>"next=9"],['text'=>"10/16",'callback_data'=>"null"],['text'=>"▶️",'callback_data'=>"next=11"]],
[['text'=>"⬇️Oraqaga",'callback_data'=>"menu=home"]],
]
]);

$next_11=json_encode([
'inline_keyboard'=>[
[['text'=>"$me Uklon",'callback_data'=>"buy_cp"],['text'=>"$me Moneylion",'callback_data'=>"buy_qo"]],
[['text'=>"$me Apple",'callback_data'=>"buy_wx"],['text'=>"$me Cloubhouse",'callback_data'=>"buy_et"]],
[['text'=>"$me Nifty",'callback_data'=>"buy_px"],['text'=>"$me PingPong",'callback_data'=>"buy_jh"]],
[['text'=>"$me Mailru Group",'callback_data'=>"buy_lb"],['text'=>"$me BitClout",'callback_data'=>"buy_lt"]],
[['text'=>"$me Skroutz",'callback_data'=>"buy_sk"],['text'=>"$me MapleSea",'callback_data'=>"buy_oh"]],
[['text'=>"$me Rozetka",'callback_data'=>"buy_km"],['text'=>"$me GalaxyWin",'callback_data'=>"buy_af"]],
[['text'=>"$me Ziglu",'callback_data'=>"buy_tt"],['text'=>"$me Likee",'callback_data'=>"buy_jf"]],
[['text'=>"$me CityBase",'callback_data'=>"buy_az"],['text'=>"$me Allegro",'callback_data'=>"buy_yn"]],
[['text'=>"$me YouGotGift",'callback_data'=>"buy_wl"],['text'=>"$me Lazada",'callback_data'=>"buy_dl"]],
[['text'=>"$me TradingWiew",'callback_data'=>"buy_gc"],['text'=>"$me Fiverr",'callback_data'=>"buy_cn"]],
[['text'=>"◀️",'callback_data'=>"next=10"],['text'=>"11/16",'callback_data'=>"null"],['text'=>"▶️",'callback_data'=>"next=12"]],
[['text'=>"⬇️Oraqaga",'callback_data'=>"menu=home"]],
]
]);

$next_12=json_encode([
'inline_keyboard'=>[
[['text'=>"$me Gabi",'callback_data'=>"buy_ou"],['text'=>"$me Kwai",'callback_data'=>"buy_vp"]],
[['text'=>"$me Детский мир",'callback_data'=>"buy_rj"],['text'=>"$me Yubo",'callback_data'=>"buy_uh"]],
[['text'=>"$me iQiYi",'callback_data'=>"buy_es"],['text'=>"$me СберМегаМаркет",'callback_data'=>"buy_be"]],
[['text'=>"$me Glovi",'callback_data'=>"buy_aq"],['text'=>"$me iFood",'callback_data'=>"buy_pd"]],
[['text'=>"$me Quack",'callback_data'=>"buy_zw"],['text'=>"$me Mocospace",'callback_data'=>"buy_gm"]],
[['text'=>"$me Dundle",'callback_data'=>"buy_fi"],['text'=>"$me Switips",'callback_data'=>"buy_hg"]],
[['text'=>"$me Faceit",'callback_data'=>"buy_qz"],['text'=>"$me Lyka",'callback_data'=>"buy_gz"]],
[['text'=>"$me PaysafeCard",'callback_data'=>"buy_jq"],['text'=>"$me Onet",'callback_data'=>"buy_ue"]],
[['text'=>"$me LightChat",'callback_data'=>"buy_xf"],['text'=>"$me GoFundMe",'callback_data'=>"buy_bp"]],
[['text'=>"$me Meta",'callback_data'=>"buy_vy"],['text'=>"$me JamesDelivery",'callback_data'=>"buy_ea"]],
[['text'=>"◀️",'callback_data'=>"next=11"],['text'=>"12/16",'callback_data'=>"null"],['text'=>"▶️",'callback_data'=>"next=13"]],
[['text'=>"⬇️Oraqaga",'callback_data'=>"menu=home"]],
]
]);

$next_13=json_encode([
'inline_keyboard'=>[
[['text'=>"$me Stoloto",'callback_data'=>"buy_hj"],['text'=>"$me Vkusvill",'callback_data'=>"buy_sh"]],
[['text'=>"$me ShellBox",'callback_data'=>"buy_vg"],['text'=>"$me RedBook",'callback_data'=>"buy_qf"]],
[['text'=>"$me Trip",'callback_data'=>"buy_nq"],['text'=>"$me BIP",'callback_data'=>"buy_ww"]],
[['text'=>"$me Ельдорадо",'callback_data'=>"buy_ke"],['text'=>"$me Whoosh",'callback_data'=>"buy_qj"]],
[['text'=>"$me KazanExpress",'callback_data'=>"buy_ol"],['text'=>"$me Akulaku",'callback_data'=>"buy_tm"]],
[['text'=>"$me KeyPay",'callback_data'=>"buy_ra"],['text'=>"$me СберМаркет",'callback_data'=>"buy_xj"]],
[['text'=>"$me Betfair",'callback_data'=>"buy_vd"],['text'=>"$me Gojek",'callback_data'=>"buy_ni"]],
[['text'=>"$me Fastmail",'callback_data'=>"buy_mr"],['text'=>"$me AliExpress",'callback_data'=>"buy_hx"]],
[['text'=>"$me Metro",'callback_data'=>"buy_bv"],['text'=>"$me HandyPick",'callback_data'=>"buy_sj"]],
[['text'=>"$me ChaingeFinance",'callback_data'=>"buy_td"],['text'=>"$me Iwplay",'callback_data'=>"buy_dm"]],
[['text'=>"◀️",'callback_data'=>"next=12"],['text'=>"13/16",'callback_data'=>"null"],['text'=>"▶️",'callback_data'=>"next=14"]],
[['text'=>"⬇️Oraqaga",'callback_data'=>"menu=home"]],
]
]);

$next_14=json_encode([
'inline_keyboard'=>[
[['text'=>"$me Groupme",'callback_data'=>"buy_xs"],['text'=>"$me NimoTv",'callback_data'=>"buy_kz"]],
[['text'=>"$me Stripe",'callback_data'=>"buy_nu"],['text'=>"$me EyeCon",'callback_data'=>"buy_kr"]],
[['text'=>"$me Lidl",'callback_data'=>"buy_pz"],['text'=>"$me Twitch",'callback_data'=>"buy_hb"]],
[['text'=>"$me GalaxyChat",'callback_data'=>"buy_xe"],['text'=>"$me ЗдравСити",'callback_data'=>"buy_io"]],
[['text'=>"$me Iti",'callback_data'=>"buy_ad"],['text'=>"$me Setel",'callback_data'=>"buy_zg"]],
[['text'=>"$me RevoLut",'callback_data'=>"buy_ij"],['text'=>"$me СберАптека",'callback_data'=>"buy_sl"]],
[['text'=>"$me 163Com",'callback_data'=>"buy_wp"],['text'=>"$me Hermes",'callback_data'=>"buy_en"]],
[['text'=>"$me Kaggle",'callback_data'=>"buy_zo"],['text'=>"$me HeyBox",'callback_data'=>"buy_vx"]],
[['text'=>"$me Band",'callback_data'=>"buy_hl"],['text'=>"$me Potato",'callback_data'=>"buy_lq"]],
[['text'=>"$me ChampionCasino",'callback_data'=>"buy_uj"],['text'=>"$me Roposo",'callback_data'=>"buy_ga"]],
[['text'=>"◀️",'callback_data'=>"next=13"],['text'=>"14/16",'callback_data'=>"null"],['text'=>"▶️",'callback_data'=>"next=15"]],
[['text'=>"⬇️Oraqaga",'callback_data'=>"menu=home"]],
]
]);

$next_15=json_encode([
'inline_keyboard'=>[
[['text'=>"$me Wise",'callback_data'=>"buy_bo"],['text'=>"$me KFC",'callback_data'=>"buy_fz"]],
[['text'=>"$me  OkCupid",'callback_data'=>"buy_vm"],['text'=>"$me Pocket52",'callback_data'=>"buy_ch"]],
[['text'=>"$me PayZapp",'callback_data'=>"buy_yp"],['text'=>"$me AgriDevelop",'callback_data'=>"buy_cs"]],
[['text'=>"$me CourseHero",'callback_data'=>"buy_yg"],['text'=>"$me Santander",'callback_data'=>"buy_lj"]],
[['text'=>"$me Poshmark",'callback_data'=>"buy_oz"],['text'=>"$me TanTan",'callback_data'=>"buy_wh"]],
[['text'=>"$me Izi",'callback_data'=>"buy_wt"],['text'=>"$me Okko",'callback_data'=>"buy_og"]],
[['text'=>"$me MPL",'callback_data'=>"buy_xq"],['text'=>"$me Ovo",'callback_data'=>"buy_xh"]],
[['text'=>"$me Vinted",'callback_data'=>"buy_kc"],['text'=>"$me 4Fun",'callback_data'=>"buy_hk"]],
[['text'=>"$me Около",'callback_data'=>"buy_yz"],['text'=>"$me Sizeer",'callback_data'=>"buy_eo"]],
[['text'=>"$me Букмекерские",'callback_data'=>"buy_ft"],['text'=>"$me Noon",'callback_data'=>"buy_tf"]],
[['text'=>"◀️",'callback_data'=>"next=14"],['text'=>"15/16",'callback_data'=>"null"],['text'=>"▶️",'callback_data'=>"next=16"]],
[['text'=>"⬇️Oraqaga",'callback_data'=>"menu=home"]],
]
]);

$next_16=json_encode([
'inline_keyboard'=>[
[['text'=>"$me Megago",'callback_data'=>"buy_lv"],['text'=>"$me Zomato",'callback_data'=>"buy_dy"]],
[['text'=>"$me DewuPoison",'callback_data'=>"buy_lx"],['text'=>"$me GiftCloud",'callback_data'=>"buy_nn"]],
[['text'=>"$me Bilibili",'callback_data'=>"buy_zs"],['text'=>"$me Vivo",'callback_data'=>"buy_kx"]],
[['text'=>"$me Twilio",'callback_data'=>"buy_ee"],['text'=>"$me IndiaGold",'callback_data'=>"buy_tp"]],
[['text'=>"$me RoyalWin",'callback_data'=>"buy_ku"],['text'=>"$me SuperS",'callback_data'=>"buy_ca"]],
[['text'=>"$me Xiaomi",'callback_data'=>"buy_yu"],['text'=>"$me Siply",'callback_data'=>"buy_np"]],
[['text'=>"$me Meliuz",'callback_data'=>"buy_uy"],['text'=>"$me Lamoda",'callback_data'=>"buy_sb"]],
[['text'=>"$me Zilch",'callback_data'=>"buy_zd"],['text'=>"$me Biedronka",'callback_data'=>"buy_zn"]],
[['text'=>"$me Nanovest",'callback_data'=>"buy_je"],['text'=>"$me CallApp",'callback_data'=>"buy_gw"]],
[['text'=>"$me Bit",'callback_data'=>"buy_qk"],['text'=>"$me InFund",'callback_data'=>"buy_xi"]],
[['text'=>"◀️",'callback_data'=>"next=15"],['text'=>"16/16",'callback_data'=>"null"]],
[['text'=>"⬇️Oraqaga",'callback_data'=>"menu=home"]],
]
]);


if((stripos($data,"next=")!==false and joinchat($fromid)==1)){
$ex=explode("=",$data)[1];
$fc="next_".$ex;
$pa=$$fc;
if(empty($pa)){
bot("answerCallbackQuery",[
"callback_query_id"=>$update->callback_query->id,
'text'=>"Boshqa tarmoqlar topilmadi",
"show_alert"=>true,
]);
}else{
bot('editMessageText',[
'text'=>"👇O‘zingizga kerakli tarmoqni tanlang:",
'chat_id'=>$fromid,
'message_id'=>$mesid,
'reply_markup'=>$pa,
]);
}
}

if(mb_stripos($data,"buy")!==false and joinchat($fromid)==1 ){
$ex=explode("_",$data);
$xizmat=$ex[1];
$op=explode("|",get("user/$fromid.dav"))[2];
$json = json_decode(file_get_contents("https://api.sms-activate.org/stubs/handler_api.php?api_key=$simkey&action=getTopCountriesByService&operator=$op&service=".$xizmat), true);
$id=explode("|",get("user/$fromid.dav"))[0];
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
$dav=explode("|",get("user/$fromid.dav"))[1];
$ff=get("set/foiz");
$fr=get("set/rub");
$rate=$rate*$fr;
$rp=$rate/100;
$na=$rp*$ff+$rate;
edit($fromid,$mesid,"
🌍 Davlat: $dav

🔢 Qolgan raqamlar: $tson ta
💰 Raqam narxi: $na so‘m",json_encode([
inline_keyboard=>[
[['text'=>"📲 Raqam olish",'callback_data'=>"olish=$xizmat=$id=$op=$na"]],
[['text'=>"⬇️ Orqaga",'callback_data'=>"menu=raqam"]],
]]));
}


if((stripos($data,"olish=")!==false and joinchat($fromid)==1)){
$xiz=explode("=",$data)[1];
$id=explode("=",$data)[2];
$op=explode("=",$data)[3];
$pric=explode("=",$data)[4];
if($pul>=$pric){
$arrContextOptions=array(
"ssl"=>array(
"verify_peer"=>false,
"verify_peer_name"=>false,),);
$response = file_get_contents("https://api.sms-activate.org/stubs/handler_api.php?api_key=$simkey&action=getNumber&service=$xiz&country=$id&operator=$op", false, stream_context_create($arrContextOptions));
$pieces = explode(":",$response);
$simid = $pieces[1];
$phone = $pieces[2];
if($response=="NO_NUMBERS") {
$msgs="Raqamlar qolmadi!";
}elseif($response=="NO_BALANCE") {
$msgs="Noma'lum xatolik yuz berdi iltimos keyinroq urinib ko'ring";
}
if($response == "NO_NUMBERS" or $response == "NO_BALANCE"){
bot("answerCallbackQuery",[
"callback_query_id"=>$update->callback_query->id,
'text'=>$msgs,
"show_alert"=>true,
]);
}elseif(mb_stripos($response,"ACCESS_NUMBER")!==false){
file_put_contents("user/$fromid.pul",$pul-$pric);
bot('editmessagetext',[
'chat_id'=>$fromid,
'message_id'=>$mesid,
'text'=>"
*✅Siz raqamni oldingiz:*
💰Narxi: *$pric* so‘m
📲Nomer: `+$phone`
 
👇Diqqat o‘qing

*Profilga ikki bosqichli parol o‘rnatilgan bo‘lsa biz bunga javob bermaymiz!*

*Siz agar telegram uchun nomer olgan bo'lsangiz faqat rasmiy telegramdan foydalaning aks xolda kod kelmasligi mumkin *

*📩SMS kelishini kuting*

*📧Kod botga yuboriladi!*

Agar SMS 5 daqiqa ichida kelmasa, raqamni bekor qiling, aks holda pul qaytarilmaydi.",
'parse_mode'=>'markdown',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📩SMS-kod olish",'callback_data'=>"pcode_".$simid."_".$pric]],
[['text'=>"❌ Bekor qilish",'callback_data'=>"otmena_".$simid."_".$pric],],
]
])
]);
}
}else{
bot("answerCallbackQuery",[
"callback_query_id"=>$update->callback_query->id,
'text'=>"Pullaringiz kamlik qiladi",
"show_alert"=>true,
]);
}
}

if((stripos($data,"pcode_")!==false and joinchat($fromid)==1)){
$ex=explode("_",$data);
$simid=$ex[1];
$so=$ex[2];
$sims=file_get_contents("simcard.txt");
if(mb_stripos($sims,$simid)!==false){
bot('answerCallbackQuery',[
'callback_query_id'=>$qid,
'text'=>"❌ No'malum buyruq.",
'show_alert'=>true,
]);
exit();
}else{
$response = file_get_contents("https://api.sms-activate.org/stubs/handler_api.php?api_key=$simkey&action=getStatus&id=$simid", false);
if (mb_stripos($response,"STATUS_OK")!==false){
$pieces = explode(":", $response);
$smskod = $pieces[1];
bot('editmessagetext',[
'chat_id'=>$fromid,
'message_id'=>$mesid,
'text'=>"🔑 Faollashtirish kodi: `$smskod`",
'parse_mode'=>'markdown',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"♻️ Yana nomer olish",'callback_data'=>"menu=raqam"],],
[['text'=>"🏠Bosh menyu",'callback_data'=>"menu=home"],],
]
]) 
]);
}elseif($response=="STATUS_CANCEL") {
edit($fromid,$mesid,"♻️ Balansingizga $so so‘m qaytarildi.",$menu);
file_put_contents("user/$fromid.pul",$pul+$so);
file_put_contents("simcard.txt","\n".$simid,FILE_APPEND);
}elseif($response=="BAD_STATUS") {
edit($fromid,$mesid,"
📖 @$bot ga xush kelibsiz

👇Kerakli tugmani tanlang",$menu);
}else{
bot("answerCallbackQuery",[
"callback_query_id"=>$update->callback_query->id,
'text'=>"Kod kelmadi",
"show_alert"=>true,
]);
}
}
}

if((stripos($data,"otmena_")!==false and joinchat($fromid)==1)){
$simid=explode("_",$data)[1];
$so=explode("_",$data)[2];
$sims=file_get_contents("simcard.txt");
$response = file_get_contents("https://api.sms-activate.org/stubs/handler_api.php?api_key=$simkey&action=setStatus&status=8&id=$simid");
if(mb_stripos($sims,$simid)!==false){
bot('answerCallbackQuery',[
'callback_query_id'=>$qid,
'text'=>"❌ No'malum buyruq.",
'show_alert'=>true,
]);
exit();
}else{
if(mb_stripos($response,"ACCESS_CANCEL")!==false){ 
edit($fromid,$mesid,"♻️ Balansingizga $so so‘m qaytarildi",json_encode([
'inline_keyboard'=>[
[['text'=>"📲 Raqam olish",'callback_data'=>"menu=raqam"],],
[['text'=>"⬇️ Orqaga",'callback_data'=>"menu=raqam"],],
]]));
file_put_contents("user/$fromid.pul",$pul+$so);
file_put_contents("simcard.txt","\n".$simid,FILE_APPEND);
}else{
bot("answerCallbackQuery",[
"callback_query_id"=>$update->callback_query->id,
'text'=>" 🔔 Bekor qilish imkoni bo‘lmadi.",
"show_alert"=>true,
]);
edit($fromid,$mesid,"
📖 @$bot ga xush kelibsiz

👇Kerakli tugmani tanlang",json_encode([
'inline_keyboard'=>[
[['text'=>"📲 Raqam olish",'callback_data'=>"menu=raqam"],],
[['text'=>"⬇️ Orqaga",'callback_data'=>"back"],],
]]));
}
}
}
if((stripos($data,"operator=")!==false and joinchat($fromid)==1)){
$ex=explode("=",$data);
$oper=$ex[1];
$dav=explode("|",get("user/$fromid.dav"))[1];
$id=explode("|",get("user/$fromid.dav"))[0];
edit($fromid,$mesid,"
♻️ Operator o‘zgardi 

🌍 Xizmat ko'rsatuvchi davlat: $dav
📡 Xizmat ko'rsatuvchi operator: $oper",$menu);
file_put_contents("user/$fromid.dav","$id|$dav|$oper");
}

if($data=="davlat2") {
$key = [];
$url = json_decode(file_get_contents("https://api.sms-activate.org/stubs/handler_api.php?api_key=$simkey&action=getCountries"), true);
for ($i = 39; $i < 78; $i++) {
$key[] = ["text" => $url["$i"]['eng'], 'callback_data' => "davl=".$url["$i"]['id']."=".$url["$i"]['eng']];
}
$key1 = array_chunk($key,3);
$key1[]=[['text'=>"◀️",'callback_data'=>"menu=davlat"],["text"=>"2/5","callback_data"=>"null"],['text'=>"▶️",'callback_data'=>"davlat3"]];
$key1[]=[['text'=>"⬇️ Orqaga",'callback_data'=>"menu=home"]];
bot('editMessageText',[
'chat_id'=>$fromid,
'message_id'=>$mesid,
'text'=>"🌍 Davlatlar ro'yxati
👇 Kerakli davlatni tanlang", 

'parse_mode'=>'markdown',
'reply_markup' => json_encode([
 'inline_keyboard'=>$key1,
 ]),
]);
}

if($data=="davlat3") {
$key = [];
$url = json_decode(file_get_contents("https://api.sms-activate.org/stubs/handler_api.php?api_key=$simkey&action=getCountries"), true);
for ($i = 78; $i < 117; $i++) {
$key[] = ["text" => $url["$i"]['eng'], 'callback_data' => "davl=".$url["$i"]['id']."=".$url["$i"]['eng']];
}
$key1 = array_chunk($key,3);
$key1[]=[['text'=>"◀️",'callback_data'=>"davlat2"],["text"=>"3/5","callback_data"=>"null"],['text'=>"▶️",'callback_data'=>"davlat4"]];
$key1[]=[['text'=>"⬇️ Orqaga",'callback_data'=>"menu=home"]];
bot('editMessageText',[
'chat_id'=>$fromid,
'message_id'=>$mesid,
'text'=>"🌍 Davlatlar ro'yxati
👇 Kerakli davlatni tanlang", 

'parse_mode'=>'markdown',
'reply_markup' => json_encode([
 'inline_keyboard'=>$key1,
 ]),
]);
}

if($data=="davlat4") {
$key = [];
$url = json_decode(file_get_contents("https://api.sms-activate.org/stubs/handler_api.php?api_key=$simkey&action=getCountries"), true);
for ($i = 117; $i < 156; $i++) {
$key[] = ["text" => $url["$i"]['eng'], 'callback_data' => "davl=".$url["$i"]['id']."=".$url["$i"]['eng']];
}
$key1 = array_chunk($key,3);
$key1[]=[['text'=>"◀️",'callback_data'=>"davlat3"],["text"=>"4/5","callback_data"=>"null"],['text'=>"▶️",'callback_data'=>"davlat5"]];
$key1[]=[['text'=>"⬇️ Orqaga",'callback_data'=>"menu=home"]];
bot('editMessageText',[
'chat_id'=>$fromid,
'message_id'=>$mesid,
'text'=>"🌍 Davlatlar ro'yxati
👇 Kerakli davlatni tanlang", 

'parse_mode'=>'markdown',
'reply_markup' => json_encode([
 'inline_keyboard'=>$key1,
 ]),
]);
}

if($data=="davlat5") {
$key = [];
$url = json_decode(file_get_contents("https://api.sms-activate.org/stubs/handler_api.php?api_key=$simkey&action=getCountries"), true);
for ($i = 156; $i < 201; $i++) {
$key[] = ["text" => $url["$i"]['eng'], 'callback_data' => "davl=".$url["$i"]['id']."=".$url["$i"]['eng']];
}
$key1 = array_chunk($key,3);
$key1[]=[['text'=>"◀️",'callback_data'=>"davlat4"],["text"=>"5/5","callback_data"=>"null"]];
$key1[]=[['text'=>"⬇️ Orqaga",'callback_data'=>"menu=home"]];
bot('editMessageText',[
'chat_id'=>$fromid,
'message_id'=>$mesid,
'text'=>"🌍 Davlatlar ro'yxati
👇 Kerakli davlatni tanlang", 

'parse_mode'=>'markdown',
'reply_markup' => json_encode([
 'inline_keyboard'=>$key1,
 ]),
]);
}

if((stripos($data,"davl=")!==false)){
$ex=explode("=",$data);
$id=$ex[1];
$dav=$ex[2];
edit($fromid,$mesid,"
♻️ Sizning davlat o'zgartirildi.

🌍 Joriy davlat: $dav",$menu);
file_put_contents("user/$fromid.dav","$id|$dav|any");
}





if($step == "sendPost"){
$fp=file_get_contents("stat.txt");
$ids=explode("\n",$fp);
foreach($ids as $id){
$user2 = bot('forwardMessage',[
'chat_id'=>$id,
'from_chat_id'=>$admin,
'message_id'=>$message->message_id,
]);
unlink("step/$cid.txt");
}
if($user2){
bot('sendmessage',[
'chat_id'=>$admin,
'text'=>"✅ Xabar yetkazish tugatildi",
]);     
unlink("step/$cid.txt");
}
}