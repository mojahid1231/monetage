<?php
define('API_KEY',"LITE_TOKEN");

$builder24 = "LITE_ID";
$admins=file_get_contents("statistika/admins.txt");
$admin = explode("\n", $admins);
array_push($admin,$builder24);
$xostfile = "RiseBuilder";

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
}}

function deleteFolder($path){
if(is_dir($path) === true){
$files = array_diff(scandir($path), array('.', '..'));
foreach ($files as $file)
deleteFolder(realpath($path) . '/' . $file);
return rmdir($path);
}else if (is_file($path) === true)
return unlink($path);
return false;
}

function get($h){
return file_get_contents($h);
}

function put($h,$r){
file_put_contents($h,$r);
}

function joinchat($id){
global $mid;
$array = array("inline_keyboard");
$kanallar=file_get_contents("sozlamalar/kanal/ch.txt");
if($kanallar == null){
return true;
}else{
$ex = explode("\n",$kanallar);
for($i=0;$i<=count($ex) -1;$i++){
$first_line = $ex[$i];
$first_ex = explode("@",$first_line);
$url = $first_ex[1];
$ism=bot('getChat',['chat_id'=>"@".$url,])->result->title;
$ret = bot("getChatMember",[
"chat_id"=>"@$url",
"user_id"=>$id,
]);
$stat = $ret->result->status;
if((($stat=="creator" or $stat=="administrator" or $stat=="member"))){
$array['inline_keyboard']["$i"][0]['text'] = "✅ ". $ism;
$array['inline_keyboard']["$i"][0]['url'] = "https://t.me/$url";
}else{
$array['inline_keyboard']["$i"][0]['text'] = "❌ ". $ism;
$array['inline_keyboard']["$i"][0]['url'] = "https://t.me/$url";
$uns = true;
}}
$array['inline_keyboard']["$i"][0]['text'] = "🔄 Tekshirish";
$array['inline_keyboard']["$i"][0]['callback_data'] = "check";
if($uns == true){
bot('sendMessage',[
'chat_id'=>$id,
'text'=>"<b>⚠️ Botdan to'liq foydalanish uchun quyidagi kanallarimizga obuna bo'ling!</b>",
'parse_mode'=>'html',
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode($array),
]);
return false;
}else{
return true;
}}}

$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$cid = $message->chat->id;
$tx = $message->text;
$mid = $message->message_id;
$name = $message->from->first_name;
$fid = $message->from->id;
$callback = $update->callback_query;
$data = $callback->data;
$callid = $callback->id;
$ccid = $callback->message->chat->id;
$cmid = $callback->message->message_id;
$from_id = $update->message->from->id;
$token = $message->text;
$text = $message->text;
$message_id = $callback->message->message_id;
$data = $update->callback_query->data;
$callcid=$update->callback_query->message->chat->id;
$doc = $update->message->document;
$doc_id = $doc->file_id;
$cqid = $update->callback_query->id;
$botdel = $update->my_chat_member->new_chat_member; 
$botdelid = $update->my_chat_member->from->id;
$status= $botdel->status;
$callfrid = $update->callback_query->from->id;
$botname = bot('getme',['bot'])->result->username;
#-----------------------------
mkdir("foydalanuvchi");
mkdir("foydalanuvchi/referal");
mkdir("foydalanuvchi/hisob");
mkdir("sozlamalar/kanal");
mkdir("sozlamalar/tugma");
mkdir("sozlamalar/matn");
mkdir("sozlamalar/bot");
mkdir("sozlamalar/pul");
mkdir("statistika");
mkdir("sozlamalar");
mkdir("hamyon");
mkdir("mini");
mkdir("step");
mkdir("ban");
#-----------------------------

if(!file_exists("foydalanuvchi/hisob/$fid.karta")){
file_put_contents("foydalanuvchi/hisob/$fid.karta","0");
}
if(!file_exists("foydalanuvchi/hisob/$fid.txt")){
file_put_contents("foydalanuvchi/hisob/$fid.txt","0");
}
if(!file_exists("foydalanuvchi/referal/$fid.txt")){
file_put_contents("foydalanuvchi/referal/$fid.txt","0");
}
if(!file_exists("sozlamalar/pul/referal.txt")){
file_put_contents("sozlamalar/pul/referal.txt","100");
}
if(!file_exists("sozlamalar/pul/kunlik.narx")){
file_put_contents("sozlamalar/pul/kunlik.narx","100");
}
if(!file_exists("sozlamalar/pul/karta.narx")){
file_put_contents("sozlamalar/pul/karta.narx","10000");
}
if(!file_exists("sozlamalar/pul/bonus.kun")){
file_put_contents("sozlamalar/pul/bonus.kun","7");
}
if(!file_exists("sozlamalar/pul/valyuta.txt")){
file_put_contents("sozlamalar/pul/valyuta.txt","so'm");
}
if(!file_exists("sozlamalar/bot/limit.txt")){
file_put_contents("sozlamalar/bot/limit.txt","30");

}
if(file_get_contents("statistika/admins.txt")){
}else{
if(file_put_contents("statistika/admins.txt","$builder24"));
}
if(!file_exists("sozlamalar/tugma/tugma1.txt")){
file_put_contents("sozlamalar/tugma/tugma1.txt","🖥 Botlarni boshqarish");
}
if(!file_exists("sozlamalar/tugma/tugma2.txt")){
file_put_contents("sozlamalar/tugma/tugma2.txt","💳 Hisobim");
}
if(!file_exists("sozlamalar/tugma/tugma3.txt")){
file_put_contents("sozlamalar/tugma/tugma3.txt","🏦 Pul ishlash");
}
if(!file_exists("sozlamalar/tugma/tugma4.txt")){
file_put_contents("sozlamalar/tugma/tugma4.txt","🛒 Bot do'koni");
}
if(!file_exists("sozlamalar/tugma/tugma5.txt")){
file_put_contents("sozlamalar/tugma/tugma5.txt","☎️ Murojaat");
}
if(!file_exists("sozlamalar/tugma/tugma6.txt")){
file_put_contents("sozlamalar/tugma/tugma6.txt","🔗 Taklifnoma");
}
if(!file_exists("sozlamalar/tugma/tugma7.txt")){
file_put_contents("sozlamalar/tugma/tugma7.txt","🎫 Promokod");
}
if(!file_exists("sozlamalar/kanal/ch.txt")){
file_put_contents("sozlamalar/kanal/ch.txt","");
}
if(!file_exists("sozlamalar/matn/start.txt")){
file_put_contents("sozlamalar/matn/start.txt","<b>🖥 Asosiy menyudasiz</b>");
}
if(!file_exists("sozlamalar/kanal/promo.txt")){
file_put_contents("sozlamalar/kanal/promo.txt","");
}
if(!file_exists("statistika/hammabot.txt")){  
file_put_contents("statistika/hammabot.txt","");
}
if(!file_exists("statistika/bugunodam.txt")){  
file_put_contents("statistika/bugunodam.txt","");
}
if(!file_exists("statistika/payments.txt")){  
file_put_contents("statistika/payments.txt","");
}
if(file_get_contents("statistika/obunachi.txt")){
} else{
file_put_contents("statistika/obunachi.txt", "");
}
if(file_get_contents("statistika/chiqdi.txt")){
} else{
file_put_contents("statistika/chiqdi.txt","");
}

$karta=file_get_contents("foydalanuvchi/hisob/$fid.karta");
$asosiy=file_get_contents("foydalanuvchi/hisob/$fid.txt");
$pul = file_get_contents("sozlamalar/pul/valyuta.txt");
$bkun = file_get_contents("sozlamalar/pul/bonus.kun");
$taklifpul = file_get_contents("sozlamalar/pul/referal.txt");
$tugma1 = file_get_contents("sozlamalar/tugma/tugma1.txt");
$tugma2 = file_get_contents("sozlamalar/tugma/tugma2.txt");
$tugma3 = file_get_contents("sozlamalar/tugma/tugma3.txt");
$tugma4 = file_get_contents("sozlamalar/tugma/tugma4.txt");
$tugma5 = file_get_contents("sozlamalar/tugma/tugma5.txt");
$tugma6 = file_get_contents("sozlamalar/tugma/tugma6.txt");
$tugma7 = file_get_contents("sozlamalar/tugma/tugma7.txt");
$start = file_get_contents("sozlamalar/matn/start.txt");
$promo=file_get_contents("sozlamalar/kanal/promo.txt");
$kanallar=file_get_contents("sozlamalar/kanal/ch.txt");
#-----------------------------------#
$kategoriya = file_get_contents("sozlamalar/bot/kategoriya.txt");
$royxat = file_get_contents("sozlamalar/bot/$kategoriya/royxat.txt");
$type = file_get_contents("sozlamalar/bot/$kategoriya/$royxat/turi.txt");
$tavsif = file_get_contents("sozlamalar/bot/$kategoriya/$royxat/tavsif.txt");
#-----------------------------------#
$kategoriya2 = file_get_contents("hamyon/kategoriya.txt");
$raqam = file_get_contents("hamyon/$kategoriya2/raqam.txt");
#-----------------------------------#

$saved = file_get_contents("step/odam.txt");
$ban = file_get_contents("ban/$fid.txt");
$post = file_get_contents("step/mid.txt");
$statistika = file_get_contents("statistika/obunachi.txt");
$statchiqdi = file_get_contents("statistika/chiqdi.txt");
$hammabot=file_get_contents("statistika/hammabot.txt");
$bugunodam=file_get_contents("statistika/bugunodam.txt");
$adminid=file_get_contents("admin.txt");
$botnomi=file_get_contents("botnomi.txt");
$kunnarx=file_get_contents("sozlamalar/pul/kunlik.narx");
$botlimit=file_get_contents("sozlamalar/bot/limit.txt");
$kartanarx=file_get_contents("sozlamalar/pul/karta.narx");
$soat=date("H:i",strtotime("0 hour"));
$userstep=file_get_contents("step/$fid.txt");

if($tx){
if($ban == "ban"){
exit();
}else{
}}

if($data){
$ban = file_get_contents("ban/$ccid.txt");
if($ban == "ban"){
exit();
}else{
}}

$main_menu = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"$tugma1"]],
[['text'=>"$tugma3"],['text'=>"$tugma2"]],
[['text'=>"$tugma4"],['text'=>"$tugma5"]],
]]);

$main_menuad = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"$tugma1"]],
[['text'=>"$tugma3"],['text'=>"$tugma2"]],
[['text'=>"$tugma4"],['text'=>"$tugma5"]],
[['text'=>"🗄 Boshqaruv"]],
]]);

if(in_array($cid,$admin)){
$menyu = $main_menuad;
}
if(in_array($cid,$admin)){
}else{
$menyu = $main_menu;
}

if(in_array($ccid,$admin)){
$menyus = $main_menuad;
}
if(in_array($ccid,$admin)){
}else{
$menyus = $main_menu;
}

if($tx=="/start"){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"$start",
'parse_mode'=>"html",
'reply_markup'=>$menyu,
]);
unlink("step/$cid.txt");
}

if(mb_stripos($text,"/start")!==false){
$refid = explode(" ",$text);
$refid = $refid[1];
if(strlen($refid)>0 and $refid>0){
if($refid == $cid){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"$start",
'parse_mode'=>'html',
'reply_markup'=>$menyu,
]);
}else{
$statistika = file_get_contents("statistika/obunachi.txt");
if(mb_stripos($statistika,"$cid")!==false){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"$start",
'parse_mode'=>'html',
'reply_markup'=>$menyu,
]);
}else{
bot('SendMessage',[
'chat_id'=>$refid,
'text'=>"<b>📳 Sizda yangi taklif mavjud!</b>",
'parse_mode'=>'html',
]);
file_put_contents("step/$cid.id","$refid");
file_put_contents("step/$cid.cid","$refid");
$joinkey = joinchat($cid);
if($joinkey != null){
$pulim = file_get_contents("foydalanuvchi/hisob/$refid.txt");
$a = $pulim + $taklifpul;
file_put_contents("foydalanuvchi/hisob/$refid.txt","$a");
$odam = file_get_contents("foydalanuvchi/referal/$refid.txt");
$b = $odam + 1;
file_put_contents("foydalanuvchi/referal/$refid.txt","$b");
bot('SendMessage',[
'chat_id'=>$refid,
'text'=>"💵 Hisobingizga $taklifpul $pul qo'shildi!",
'parse_mode'=>'html',
]);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"$start",
'parse_mode'=>'html',
'reply_markup'=>$menyu,
]);
unlink("step/$cid.id");
unlink("step/$cid.cid");
}}}}}

if($data == "check"){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
if(joinchat($ccid)==true){
$refid = file_get_contents("step/$ccid.id");
$cid3 = file_get_contents("step/$ccid.cid");
if($refid !=$cid3){
bot('SendMessage',[
'chat_id'=>$ccid,
'text'=>"$start",
'parse_mode'=>'html',
'reply_markup'=>$menyus,
]);
}else{
$pulim = file_get_contents("foydalanuvchi/hisob/$cid3.txt");
$a = $pulim + $taklifpul;
file_put_contents("foydalanuvchi/hisob/$cid3.txt","$a");
$odam = file_get_contents("foydalanuvchi/referal/$cid3.txt");
$b = $odam + 1;
file_put_contents("foydalanuvchi/referal/$cid3.txt","$b");
bot('SendMessage',[
'chat_id'=>$ccid,
'text'=>"$start",
'parse_mode'=>'html',
'reply_markup'=>$menyus,
]);
bot('SendMessage',[
'chat_id'=>$cid3,
'text'=>"💵 Hisobingizga $taklifpul $pul qo'shildi!",
'parse_mode'=>'html',
]);
unlink("step/$ccid.id");
unlink("step/$ccid.cid");
}}}

$admin1_menu = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"⚙ Asosiy sozlamalar"]],
[['text'=>"📢 Kanallar"],['text'=>"📊 Statistika"]],
[['text'=>"🤖 Konstruktor sozlamalar"]],
[['text'=>"🎛 Tugmalar"],['text'=>"📑 Matnlar"]],
[['text'=>"📨 Xabarnoma"],['text'=>"◀️ Orqaga"]],
]]);

if($tx == "⚙ Asosiy sozlamalar" and in_array($cid,$admin)){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⚙ Asosiy sozlamalar bo'limiga xush kelibsiz!</b>

<i>Nimani o'zgartiramiz?</i>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"*⃣ Birlamchi sozlamalar"]],
[['text'=>"👤 Adminlar"],['text'=>"🎟 Promokod"]],
[['text'=>"🔎 Foydalanuvchini boshqarish"]],
[['text'=>"💳 Hamyonlar"],['text'=>"⏱ To'lov holati"]],
[['text'=>"🗄 Boshqaruv"]],
]])
]);
}

if($tx == "⏱ To'lov holati" and in_array($cid,$admin)){
$txolat=json_decode(file_get_contents("https://".$_SERVER['SERVER_NAME']."/$xostfile/bots/$botnomi/foydalanuvchi/$builder24/$botname/kunlik.tolov"));
$kun = $txolat->kun;
$times = "$sana — $soat";
$b_time = explode(" — ",$times)[1];
$s_time = explode(":",$b_time)[0]*60;
$m_time = explode(":",$b_time)[1];
$minutes = $s_time + $m_time;
$minus = 24*60;
$qoldi = ($minus - $minutes)*60;
$hours = str_pad(floor($qoldi / (60*60)), 2, '0', STR_PAD_LEFT);
$minutes = str_pad(floor(($qoldi - $hours*60*60)/60), 2, '0', STR_PAD_LEFT);
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🤖 @$botname holati: $kun kun

<i>To'lov qilishni unutmang aks holda botingiz o'chiriladi!</i></b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"@$botnomi",'url'=>"t.me/$botnomi"]],
]])
]);
}

if($text == "👤 Adminlar"){
if(in_array($cid,$admin)){
if($cid == $builder24){
bot('SendMessage',[
'chat_id'=>$builder24,
'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📑 Ro'yxatni ko'rish",'callback_data'=>"list"]],
[['text'=>"➕ Qo'shish",'callback_data'=>"add"],['text'=>"🗑 O'chirish",'callback_data'=>"remove"]],
]])
]);
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📑 Ro'yxatni ko'rish",'callback_data'=>"list"]],
]])
]);
}}}

if($data == "admins"){
if($ccid == $builder24){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);	
bot('SendMessage',[
'chat_id'=>$builder24,
'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📑 Ro'yxatni ko'rish",'callback_data'=>"list"]],
[['text'=>"➕ Qo'shish",'callback_data'=>"add"],['text'=>"🗑 O'chirish",'callback_data'=>"remove"]],
]])
]);
}else{
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);	
bot('SendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📑 Ro'yxatni ko'rish",'callback_data'=>"list"]],
]])
]);
}}

if($data == "list"){
$admins=file_get_contents("statistika/admins.txt");
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>📑 Botdagi adminlar ro'yxati:</b>

$admins",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"admins"]],
]])
]);
}

if($data == "add"){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('SendMessage',[
'chat_id'=>$builder24,
'text'=>"*Kerakli ID raqamni kiriting:*",
'parse_mode'=>'MarkDown',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqaruv"]],
]])
]);
file_put_contents("step/$ccid.txt",'add-admin');
}

if($userstep=="add-admin" and $cid == $builder24){
if($tx=="🗄 Boshqarish"){
unlink("step/$cid.step");
}else{
if(is_numeric($text)=="true"){
if($text != $builder24){
file_put_contents("statistika/admins.txt","$admins\n$text");
bot('SendMessage',[
'chat_id'=>$builder24,
'text'=>"✅ *$text* admin qilib tayinlandi!",
'parse_mode'=>'MarkDown',
'reply_markup'=>$admin1_menu,
]);
unlink("step/$cid.txt");
bot('SendMessage',[
'chat_id'=>$text,
'text'=>"<b>Admin qilib tayinlandingiz!</b>",
'parse_mode'=>'html',
'reply_markup'=>$main_menuad,
]);
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Kerakli ID raqamni kiriting:</b>",
'parse_mode'=>'html',
]);
}}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Kerakli ID raqamni kiriting:</b>",
'parse_mode'=>'html',
]);
}}}

if($data == "remove"){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('SendMessage',[
'chat_id'=>$builder24,
'text'=>"<b>Kerakli ID raqamni kiriting:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqaruv"]],
]])
]);
file_put_contents("step/$ccid.txt",'remove-admin');
}

if($userstep == "remove-admin" and $cid == $builder24){
if($tx=="🗄 Boshqarish"){
unlink("step/$cid.step");
}else{
if(is_numeric($text)=="true"){
if($text != $builder24){
$files=file_get_contents("statistika/admins.txt");
$file = str_replace("\n".$text."","",$files);
file_put_contents("statistika/admins.txt",$file);
bot('SendMessage',[
'chat_id'=>$builder24,
'text'=>"✅ *$text* adminlikdan olindi!",
'parse_mode'=>'MarkDown',
'reply_markup'=>$admin1_menu,
]);
unlink("step/$cid.txt");
bot('SendMessage',[
'chat_id'=>$text,
'text'=>"<b>Adminlikdan olindingiz!</b>",
'parse_mode'=>'html',
'reply_markup'=>$main_menu,
]);
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Kerakli ID raqamni kiriting:</b>",
'parse_mode'=>'html',
]);
}}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Kerakli ID raqamni kiriting:</b>",
'parse_mode'=>'html',
]);
}}}

if($tx=="*⃣ Birlamchi sozlamalar" and in_array($cid,$admin)){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>*⃣ Birlamchi sozlamalar bo'limi:

1. Valyuta nomi:</b> $pul
<b>2. Karta narxi:</b> $kartanarx $pul
<b>3. Taklif narxi:</b> $taklifpul $pul
<b>4. Kunlik to'lov narxi:</b> $kunnarx $pul
<b>5. Bonus beriladigan to'lov kun:</b> $bkun kun",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"1",'callback_data'=>"valyuta_nomi"],['text'=>"2",'callback_data'=>"karta_narxi"],['text'=>"3",'callback_data'=>"taklif_narxi"]],
[['text'=>"4",'callback_data'=>"tolov_narxi"],['text'=>"5",'callback_data'=>"bonus_kun"]],
]])
]);
}

if($tx=="🤖 Konstruktor sozlamalar" and in_array($cid,$admin)){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"🤖 <b>Konstruktor sozlamalar bo'limidasiz:</b>

Nimani o'zgartiramiz?",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📂 Bo'limlarni sozlash",'callback_data'=>"kategoriya"]],
[['text'=>"🤖 Botlarni sozlash",'callback_data'=>"BotSet"]],
]])
]);
}

if($data == "bbosh"){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"🤖 <b>Konstruktor sozlamalar bo'limidasiz:</b>

Nimani o'zgartiramiz?",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📂 Bo'limlarni sozlash",'callback_data'=>"kategoriya"]],
[['text'=>"🤖 Botlarni sozlash",'callback_data'=>"BotSet"]],
]])
]);
}

if($data == "kategoriya"){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"📂 <b>Bo'limlarni sozlash bo'limidasiz:</b>

Quyidagilardan foydalaning!",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Bo'lim qo'shish",'callback_data'=>"AdKat"]],
[['text'=>"📄 Ro'yxatlar",'callback_data'=>"listKat"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"bbosh"]]
]])
]);
}

if($data == "BotSet"){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"🤖 <b>Botlarni sozlash bo'limidasiz:</b>

Quyidagilardan foydalaning!",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Bot qo'shish",'callback_data'=>"AdBot"]],
[['text'=>"📄 Ro'yxatlar",'callback_data'=>"listBot"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"bbosh"]]
]])
]);
}

if($data == "listKat"){
$more = explode("\n",$kategoriya);
$soni = substr_count($kategoriya,"\n");
$keys=[];
for ($for = 1; $for <= $soni; $for++) {
$title=str_replace("\n","",$more[$for]);
$botlar = file_get_contents("sozlamalar/bot/".$more[$for]."/royxat.txt");
$ta = substr_count($botlar,"\n");
$keys[]=["text"=>"$title ($ta)","callback_data"=>"setKat-$title"];
$keysboard2 = array_chunk($keys, 1);
$keysboard2[] = [['text'=>"◀️ Orqaga",'callback_data'=>"kategoriya"]];
$key = json_encode([
'inline_keyboard'=>$keysboard2,
]);
}
if($kategoriya != null){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"📁 <b>Quyidagi bo'limlardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$key,
]);
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$callid,
'text'=>"🤷🏻‍♂ Bo'limlar qo'shilmagan!",
'show_alert'=>true,
]);
}}

if(mb_stripos($data, "setKat-")!==false){
$ex = explode("-",$data);
$kat = $ex[1];
$botlar = file_get_contents("sozlamalar/bot/$kat/royxat.txt");
$ta = substr_count($botlar,"\n");
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>➡️ Bo'limning ma'lumotlari:</b> 

<b>Joriy nomi:</b> $kat
<b>Qo'shilgan botlar:</b> $ta ta

@$botname | Konstruktor",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✏ Nomni o'zgartirish",'callback_data'=>"tahrir-$kat"]],
[['text'=>"🗑 O'chirish",'callback_data'=>"delKat-$kat"],['text'=>"◀️ Orqaga",'callback_data'=>"listKat"]]
]])
]);
}

if(mb_stripos($data, "tahrir-")!==false){
$kat = explode("-",$data)[1];
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"📜 <b>Holat:</b> $kat

Yangi qiymatni yuboring:",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqaruv"]],
]])
]);
file_put_contents("step/$ccid.txt","tahrir-$kat");
}

if(mb_stripos($userstep, "tahrir-")!==false){
if($tx=="🗄 Boshqaruv"){
unlink("step/$cid.txt");
}else{
if(isset($text)){
$kat = explode("-",$userstep)[1];
$a = str_replace($kat,$text,$kategoriya);
file_put_contents("sozlamalar/bot/kategoriya.txt",$a);
rename("sozlamalar/bot/$kat","sozlamalar/bot/$text");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$admin1_menu,
]);
unlink("step/$cid.txt");
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⚠️ Faqat harflardan foydalaning!</b>",
'parse_mode'=>'html',
]);
}}}

if(mb_stripos($data, "delKat-")!==false){
$ex = explode("-",$data);
$kat = $ex[1];
$k = str_replace("\n".$kat."","",$kategoriya);
file_put_contents("sozlamalar/bot/kategoriya.txt",$k);
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>$kat - nomli bo'lim o'chirildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$admin1_menu
]);
deleteFolder("sozlamalar/bot/$kat");
}

if($data == "listBot"){
$kategoriya = file_get_contents("sozlamalar/bot/kategoriya.txt");
$more = explode("\n",$kategoriya);
$soni = substr_count($kategoriya,"\n");
$keys=[];
for ($for = 1; $for <= $soni; $for++) {
$title=str_replace("\n","",$more[$for]);
$botlar = file_get_contents("sozlamalar/bot/".$more[$for]."/royxat.txt");
$ta = substr_count($botlar,"\n");
$keys[]=["text"=>"$title ($ta)->","callback_data"=>"setBot-$title"];
$keysboard2 = array_chunk($keys, 1);
$keysboard2[] = [['text'=>"◀️ Orqaga",'callback_data'=>"BotSet"]];
$key = json_encode([
'inline_keyboard'=>$keysboard2,
]);
}
if($kategoriya != null){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⬇️ <b>Quyidagi bo'limlardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$key,
]);
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$callid,
'text'=>"🤷🏻‍♂ Bo'limlar qo'shilmagan!",
'show_alert'=>true,
]);
}}

if(mb_stripos($data, "setBot-")!==false){
$ex = explode("-",$data);
$kat = $ex[1];
$royxat = file_get_contents("sozlamalar/bot/$kat/royxat.txt");
$ids = explode("\n",$royxat);
$soni = substr_count($royxat,"\n");
foreach($ids as  $id){
$key = [];
$text = "";
for ($for = 1; $for <= $soni; $for++) {
$key[]=["text"=>"🤖 $ids[$for]","callback_data"=>"bset-".$ids[$for]."-".$kat];
}
$keysboard2 = array_chunk($key, 1);
$keysboard2[] = [['text'=>"◀️ Orqaga",'callback_data'=>"listBot"]];
$key = json_encode([
'inline_keyboard'=>$keysboard2,
]);
}
if($royxat != null){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"️🤖 <b>Quyidagi botlardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$key,
]);
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$callid,
'text'=>"🤷🏻‍♂ Botlar qo'shilmagan!",
'show_alert'=>true,
]);
}}

if(mb_stripos($data, "bset-")!==false){
$ex = explode("-",$data);
$roy = $ex[1];
$kat = $ex[2];
$tavsif = file_get_contents("sozlamalar/bot/$kat/$roy/tavsif.txt");
$type = file_get_contents("sozlamalar/bot/$kat/$roy/turi.txt");
$narx = file_get_contents("sozlamalar/bot/$kat/$roy/narx.txt");
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>🤖 $type</b>

<b>💬 Interfeys tili:</b> O'zbekcha
<b>💵 Bot ochish narxi:</b> $narx $pul 
<b>📆 Kunlik to'lov narxi:</b> $kunnarx $pul

🎁 Bonus sifatida <b>$bkun kunlik</b> to'lov bepul taqdim etiladi!

<b>*️⃣ Qo'shimcha ma'lumot:</b> $tavsif

@$botname | Konstruktor",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✏ Tavsifni o'zgartirish",'callback_data'=>"editBot-tavsif-$kat-$roy"]],
[['text'=>"✏ Narxini o'zgartirish",'callback_data'=>"editBot-narx-$kat-$roy"]],
[['text'=>"🗑 O'chirish",'callback_data'=>"delBot-$kat-$roy-$type"],['text'=>"◀️ Orqaga",'callback_data'=>"setBot-$kat"]]
]])
]);
}

if(mb_stripos($data, "editBot-")!==false){
$ex = explode("-",$data)[1];
$kat = explode("-",$data)[2];
$roy = explode("-",$data)[3];
$holat = file_get_contents("sozlamalar/bot/$kat/$roy/$ex.txt");
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"📜 <b>Holat:</b> $holat

Yangi qiymatni yuboring:",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqaruv"]],
]])
]);
file_put_contents("step/$ccid.txt","editBot-$ex-$kat-$roy");
}

if(mb_stripos($userstep, "editBot-")!==false){
if($tx=="🗄 Boshqaruv"){
unlink("step/$cid.txt");
}else{
if(isset($text)){
$ex = explode("-",$userstep)[1];
$kat = explode("-",$userstep)[2];
$roy = explode("-",$userstep)[3];
file_put_contents("sozlamalar/bot/$kat/$roy/$ex.txt",$text);
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$admin1_menu,
]);
unlink("step/$cid.txt");
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⚠️ Faqat harflardan foydalaning!</b>",
'parse_mode'=>'html',
]);
}}}

if(mb_stripos($data, "delBot-")!==false){
$ex = explode("-",$data);
$kat = $ex[1];
$roy = $ex[2];
$type = $ex[3];
$royxat = file_get_contents("sozlamalar/bot/$kat/royxat.txt");
$k = str_replace("\n".$roy."","",$royxat);
file_put_contents("sozlamalar/bot/$kat/royxat.txt",$k);
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>$roy - olib tashlandi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$admin1_menu
]);
deleteFolder("sozlamalar/bot/$kat/$roy");
}

if($data == "AdKat"){
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>📝 Yangi bo'lim nomini yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqaruv"]],
]])
]);
file_put_contents("step/$ccid.txt",'AdKat');
}

if($userstep == "AdKat"){
if($tx=="🗄 Boshqaruv"){
unlink("step/$cid.txt");
}else{
$kategoriya = file_get_contents("sozlamalar/bot/kategoriya.txt");
if(mb_stripos($kategoriya,"$text")!==false){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>$text - nomli bo'lim mavjud!</b>

Boshqa nom yuboring:",
'parse_mode'=>'html',
]);
}else{
file_put_contents("sozlamalar/bot/kategoriya.txt","$kategoriya\n$text");
mkdir("sozlamalar/bot/$text");
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>$text - bo'lim qo'shildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$admin1_menu,
]);
unlink("step/$cid.txt");
}}}

if($data == "AdBot"){
$kategoriya = file_get_contents("sozlamalar/bot/kategoriya.txt");
$more = explode("\n",$kategoriya);
$soni = substr_count($kategoriya,"\n");
$keys=[];
for ($for = 1; $for <= $soni; $for++) {
$title=str_replace("\n","",$more[$for]);
$botlar = file_get_contents("sozlamalar/bot/".$more[$for]."/royxat.txt");
$ta = substr_count($botlar,"\n");
$keys[]=["text"=>"$title ($ta)->","callback_data"=>"tanlabot=$title"];
$keysboard2 = array_chunk($keys, 1);
$keysboard2[] = [['text'=>"◀️ Orqaga",'callback_data'=>"BotSet"]];
$AdBot = json_encode([
'inline_keyboard'=>$keysboard2,
]);
}
if($kategoriya != null){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⬇️ <b>Quyidagi bo'limlardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$AdBot,
]);
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$callid,
'text'=>"🤷🏻‍♂ Bo'limlar qo'shilmagan!",
'show_alert'=>true,
]);
}}

if(mb_stripos($data, "tanlabot=")!==false){
$ex = explode("=",$data);
$kat = $ex[1];
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"❓ <b>Qaysi botni qo'shmoqchisiz?</b> 
 
1. SpecialSMM Lite  | 2. SpecialMember 
3. AvtoNakrutka        | 4. Obunachi Lite 
5. ObunachiBot         | 6. AutoNumber  
7. GramAPIBot          | 8. NamozVAQT  
9. SarmoyaBot          | 10. Reklamachi  
11. PulBot Lite          | 12. VideoDown 
13. TurfaBot              |",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"1",'callback_data'=>"addb=SpecialSMM Lite=$kat"],['text'=>"2",'callback_data'=>"addb=SpecialMember=$kat"],['text'=>"3",'callback_data'=>"addb=AvtoNakrutka=$kat"],['text'=>"4",'callback_data'=>"addb=Obunachi Lite=$kat"],['text'=>"5",'callback_data'=>"addb=ObunachiBot=$kat"]],
[['text'=>"6",'callback_data'=>"addb=AutoNumber=$kat"],['text'=>"7",'callback_data'=>"addb=GramAPIBot=$kat"],['text'=>"8",'callback_data'=>"addb=NamozVAQT=$kat"],['text'=>"9",'callback_data'=>"addb=SarmoyaBot=$kat"],['text'=>"10",'callback_data'=>"addb=Reklamachi=$kat"]],
[['text'=>"11",'callback_data'=>"addb=PulBot Lite=$kat"],['text'=>"12",'callback_data'=>"addb=VideoDown=$kat"],['text'=>"13",'callback_data'=>"addb=TurfaBot=$kat"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"AdBot"]],
]])
]);
}

if(mb_stripos($data, "addb=")!==false){
$ex = explode("=",$data);
$turi = $ex[1];
$kat = $ex[2];
$ichida=file_get_contents("sozlamalar/bot/$kat/royxat.txt",);
if(mb_stripos($ichida,"$turi")!==false){
bot('answerCallbackQuery',[
'callback_query_id'=>$callid,
'text'=>"⚠️ ️[$kat] bo'limida ".$turi." turidagi bot mavjud!",
'show_alert'=>true,
]);
}else{
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>✅ $turi tanlandi</b>

📝 Bot uchun narx yuboring:",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqaruv"]],
]])
]);
file_put_contents("step/$ccid.txt","botpul-$kat-$turi");
}}

if(mb_stripos($userstep, "botpul-")!==false){
$ex = explode("-",$userstep);
$kat = $ex[1];
$roy = $ex[2];
if($tx=="🗄 Boshqaruv"){
unlink("step/$cid.txt");
}else{
if(isset($text)){
mkdir("sozlamalar/bot/$kat/$roy");
file_put_contents("sozlamalar/bot/$kat/$roy/turi.txt",$roy);
file_put_contents("sozlamalar/bot/$kat/$roy/narx.txt",$text);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>✅ $text - narxi qabul qilindi</b>

📝 Bot uchun tavsif yuboring:",
'parse_mode'=>'html',
]);
file_put_contents("step/$cid.txt","malumot-$kat-$roy");
}}}

if(mb_stripos($userstep, "malumot-")!==false){
$ex = explode("-",$userstep);
$kat = $ex[1];
$roy = $ex[2];
if($tx=="🗄 Boshqaruv"){
deleteFolder("sozlamalar/bot/$kat/$roy");
unlink("step/$cid.txt");
}else{
if(isset($text)){
file_put_contents("sozlamalar/bot/$kat/$roy/tavsif.txt",$text);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>✅ $kat</b> bo'limiga -> <b>$roy</b> qo'shildi!" ,
'parse_mode'=>'html',
'reply_markup'=>$admin1_menu,
]);
$bolim = file_get_contents("sozlamalar/bot/$kat/royxat.txt");
file_put_contents("sozlamalar/bot/$kat/royxat.txt","$bolim\n$roy");
unlink("step/$cid.txt");
}}}

if($tx == "🗄 Boshqaruv" and in_array($cid,$admin)){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🗄 Boshqaruv paneliga xush kelibsiz!</b>",
'parse_mode'=>"html",
'reply_markup'=>$admin1_menu
]);
unlink("step/$cid.txt");
}

if($data == "oddiy_xabar" and in_array($ccid,$admin)){
$odam=substr_count($statistika,"\n");
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>$odam ta foydalanuvchiga yuboriladigan xabar matnini yuboring:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqaruv"]],
]])
]);
file_put_contents("step/$ccid.txt","oddiy");
}
if($userstep=="oddiy"){
if($tx=="🗄 Boshqaruv"){
unlink("step/$cid.txt");
}else{
$odam=substr_count($statistika,"\n");
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"<b>$odam ta foydalanuvchiga xabar yuborish boshlandi!</b>",
'parse_mode'=>"html",
'reply_markup'=>$admin1_menu,
]);
$odam = explode("\n",$statistika);
foreach($odam as $odamlar){
$usr=bot("sendMessage",[
'chat_id'=>$odamlar,
'text'=>"<b>$text</b>",
'parse_mode'=>'html'
]);
unlink("step/$cid.txt");
}}}
if($usr){
$odam=substr_count($statistika,"\n");
bot("sendmessage",[
'chat_id'=>$cid,
'text'=>"<b>$odam ta foydalanuvchiga muvaffaqiyatli yuborildi</b>",
'parse_mode'=>'html',
'reply_markup'=>$admin1_menu,
]);
unlink("step/$cid.txt");
}

if($data =="forward_xabar" and in_array($ccid,$admin)){
$odam=substr_count($statistika,"\n");
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>$odam ta foydalanuvchiga yuboriladigan xabarni forward shaklida yuboring:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqaruv"]],
]])
]);
file_put_contents("step/$ccid.txt","forward");
}
if($userstep=="forward"){
if($tx=="🗄 Boshqaruv"){
unlink("step/$cid.txt");
}else{
$odam=substr_count($statistika,"\n");
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"<b>$odam ta foydalanuvchiga xabar yuborish boshlandi!</b>",
'parse_mode'=>"html",
'reply_markup'=>$admin1_menu,
]);
$odam = explode("\n",$statistika);
foreach($odam as $odamlar){
$fors=bot("forwardMessage",[
'from_chat_id'=>$cid,
'chat_id'=>$odamlar,
'message_id'=>$mid,
]);
unlink("step/$cid.txt");
}}}
if($fors){
$odam=substr_count($statistika,"\n");
bot("sendmessage",[
'chat_id'=>$cid,
'text'=>"<b>$odam ta foydalanuvchiga muvaffaqiyatli yuborildi</b>",
'parse_mode'=>'html',
'reply_markup'=>$admin1_menu,
]);
unlink("step/$cid.txt");
}

if($data =="obuna_xabar" and in_array($ccid,$admin)){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>Kerakli foydalanuvchi ID raqamini yuboring:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqaruv"]],
]])
]);
file_put_contents("step/$ccid.txt","odamtop");
}

if($userstep=="odamtop"){
if($tx=="🗄 Boshqaruv"){
unlink("step/$cid.txt");
}else{
if(mb_stripos($statistika,"$text")!==false){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Foydalanuvchi topildi, yuboriladigan xabarni kiriting:</b>",
'parse_mode'=>"html",
]);
file_put_contents("step/$ccid.txt","yubor=$text");
}else{
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"<b>Ushbu foydalanuvchi botdan foydalanmaydi!</b>",
'parse_mode'=>"html",
]);
}}}

if(mb_stripos($userstep, "yubor=")!==false){
$ex = explode("=",$userstep);
$odam = $ex[1];
if($tx=="🗄 Boshqaruv"){
unlink("step/$cid.txt");
}else{
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"<b>Xabar yuborildi!</b>",
'parse_mode'=>"html",
'reply_markup'=>$admin1_menu,
]);
unlink("step/$cid.txt");
bot('sendmessage',[
'chat_id'=>$odam,
'text'=>"<b>Adminstrator:</b> $text",
'parse_mode'=>"html",
]);
}}

if($tx=="📨 Xabarnoma" and in_array($cid,$admin)){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📨 Yuboriladigan xabar turini tanlang:</b>",
'parse_mode'=>"html",
'reply_markup'=> json_encode([
'inline_keyboard'=>[
[['text'=>"Oddiy xabar",'callback_data'=>"oddiy_xabar"],['text'=>"Forward xabar",'callback_data'=>"forward_xabar"]],
[['text'=>"Foydalanuvchiga xabar",'callback_data'=>"obuna_xabar"]],
]])
]);
}

if($data=="taklif_narxi" ){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>📝 Yangi qiymatni yuboring:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqaruv"]],
]])
]);
file_put_contents("step/$ccid.txt","taklif");
}
if($userstep == "taklif"){
if($tx=="🗄 Boshqaruv"){
unlink("step/$cid.txt");
}else{
file_put_contents("sozlamalar/pul/referal.txt","$tx");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
'parse_mode'=>"html",
'reply_markup'=>$admin1_menu
]);
unlink("step/$cid.txt");
}}

if($data=="bonus_kun" ){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>📝 Yangi qiymatni yuboring:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqaruv"]],
]])
]);
file_put_contents("step/$ccid.txt","bkun");
}
if($userstep == "bkun"){
if($tx=="🗄 Boshqaruv"){
unlink("step/$cid.txt");
}else{
file_put_contents("sozlamalar/pul/bonus.kun","$tx");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
'parse_mode'=>"html",
'reply_markup'=>$admin1_menu
]);
unlink("step/$cid.txt");
}}

if($data=="tolov_narxi"){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>📝 Yangi qiymatni yuboring:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqaruv"]],
]])
]);
file_put_contents("step/$ccid.txt","kunlik");
}
if($userstep == "kunlik"){
if($tx=="🗄 Boshqaruv"){
unlink("step/$cid.txt");
}else{
file_put_contents("sozlamalar/pul/kunlik.narx","$tx");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
'parse_mode'=>"html",
'reply_markup'=>$admin1_menu
]);
unlink("step/$cid.txt");
}}

if($data=="valyuta_nomi"){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>📝 Yangi qiymatni yuboring:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqaruv"]],
]])
]);
file_put_contents("step/$ccid.txt","valyuta");
}
if($userstep == "valyuta"){
if($tx=="🗄 Boshqaruv"){
unlink("step/$cid.txt");
}else{
file_put_contents("sozlamalar/pul/valyuta.txt","$tx");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
'parse_mode'=>"html",
'reply_markup'=>$admin1_menu
]);
unlink("step/$cid.txt");
}}

if($data=="karta_narxi"){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>📝 Yangi qiymatni yuboring:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqaruv"]],
]])
]);
file_put_contents("step/$ccid.txt","karta");
}
if($userstep == "karta"){
if($tx=="🗄 Boshqaruv"){
unlink("step/$cid.txt");
}else{
file_put_contents("sozlamalar/pul/karta.narx","$tx");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
'parse_mode'=>"html",
'reply_markup'=>$admin1_menu
]);
unlink("step/$cid.txt");
}}

if($tx=="🔎 Foydalanuvchini boshqarish" and in_array($cid,$admin)){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Kerakli foydalanuvchining ID raqamini yuboring:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqaruv"]],
]])
]);
file_put_contents("step/$cid.txt","idraqam");
}

if($userstep=="idraqam"){
if($tx=="🗄 Boshqaruv"){
unlink("step/$cid.txt");
}else{
if(file_exists("foydalanuvchi/hisob/$tx.txt")){
file_put_contents("step/odam.txt",$tx);
$asos = file_get_contents("foydalanuvchi/hisob/$tx.txt");
$odam = file_get_contents("foydalanuvchi/referal/$tx.txt");
$ban = file_get_contents("ban/$text.txt");
if($ban == null){
$bans = "🔔 Banlash";
}
if($ban == "ban"){
$bans = "🔕 Bandan olish";
}
bot("sendMessage",[
"chat_id"=>$cid,
"text"=>"<b>✅ Foydalanuvchi topildi:</b> <a href='tg://user?id=$tx'>$tx</a>

<b>Asosiy balans:</b> $asos $pul
<b>Takliflari:</b> $odam ta",
'parse_mode'=>"html",
"reply_markup"=>json_encode([
'inline_keyboard'=>[
[['text'=>"$bans",'callback_data'=>"ban"]],
[['text'=>"➕ Pul qo'shish",'callback_data'=>"qoshish"],['text'=>"➖ Pul ayirish",'callback_data'=>"ayirish"]],
]])
]); 
unlink("step/$cid.txt");
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Ushbu foydalanuvchi botdan foydalanmaydi!</b>

<i>Qayta yuboring:</i>",
'parse_mode'=>'html',
]);
}}}

if($data=="ban"){
$ban = file_get_contents("ban/$saved.txt");
if($builder24 != $saved){
if($ban == "ban"){
unlink("ban/$saved.txt");
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>Foydalanuvchi bandan olindi!</b>",
'parse_mode'=>"html",
'reply_markup'=>$admin1_menu,
]);
bot('sendMessage',[
'chat_id'=>$saved,
'text'=>"<b>Admin tomonidan bandan olindingiz!</b>",
'parse_mode'=>"html",
]);
}else{
file_put_contents("ban/$saved.txt",'ban');
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>Foydalanuvchi banlandi!</b>",
'parse_mode'=>"html",
]);
bot('sendMessage',[
'chat_id'=>$saved,
'text'=>"<b>Admin tomonidan ban oldingiz!</b>",
'parse_mode'=>"html",
]);
}}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$callid,
'text'=>"Asosiy adminni bloklash mumkin emas!",
'show_alert'=>true,
]);
}}

if($data == "qoshish"){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'parse_mode'=>"html",
'text'=>"<a href='tg://user?id=$saved'>$saved</a> <b>ning hisobiga qancha pul qo'shmoqchisiz?</b>",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqaruv"]],
]])
]);
file_put_contents("step/$ccid.txt","qoshish");
}

if($userstep == "qoshish"){
if($tx=="🗄 Boshqaruv"){
unlink("step/$cid.txt");
}else{
bot('sendMessage',[
'chat_id'=>$saved,
'text'=>"<b>Adminlar tomonidan hisobingiz $tx $pul to'ldirildi</b>",
'parse_mode'=>"html",
]);
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Foydalanuvchi hisobiga $tx $pul qo'shildi</b>",
'parse_mode'=>"html",
'reply_markup'=>$admin1_menu,
]);
$get = file_get_contents("foydalanuvchi/hisob/$saved.txt");
$get += $tx;
file_put_contents("foydalanuvchi/hisob/$saved.txt", $get);
$gets = file_get_contents("foydalanuvchi/hisob/$saved.1.txt");
$gets += $tx;
file_put_contents("foydalanuvchi/hisob/$saved.1.txt", $gets);
unlink("step/$cid.txt");
}}

if($data == "ayirish"){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'parse_mode'=>"html",
'text'=>"<a href='tg://user?id=$saved'>$saved</a> <b>ning hisobidan qancha pul ayirmoqchisiz?</b>",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqaruv"]],
]])
]);
file_put_contents("step/$ccid.txt","ayirish");
}

if($userstep == "ayirish"){
if($tx=="🗄 Boshqaruv"){
unlink("step/$cid.txt");
unlink("step/odam.txt");
}else{
bot('sendMessage',[
'chat_id'=>$saved,
'text'=>"<b>Adminlar tomonidan hisobingizdan $tx $pul olib tashlandi</b>",
'parse_mode'=>"html",
]);
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Foydalanuvchi hisobidan $tx $pul olib tashlandi</b>",
'parse_mode'=>"html",
'reply_markup'=>$admin1_menu,
]);
$get = file_get_contents("foydalanuvchi/hisob/$saved.txt");
$get -= $tx;
file_put_contents("foydalanuvchi/hisob/$saved.txt", $get);
unlink("step/$cid.txt");
unlink("step/odam.txt");
}}

if($tx=="💳 Hamyonlar" and in_array($cid,$admin)){
$kategoriya = file_get_contents("hamyon/kategoriya.txt");
$more = explode("\n",$kategoriya);
$soni = substr_count($kategoriya,"\n");
$keys=[];
for ($for = 1; $for <= $soni; $for++) {
$title=str_replace("\n","",$more[$for]);
$keys[]=["text"=>"$title - o'chirish","callback_data"=>"delete-$title"];
$keysboard2 = array_chunk($keys, 1);
$keysboard2[] = [['text'=>"🆕 Yangi hamyon qo'shish",'callback_data'=>"hamyon"]];
$key = json_encode([
'inline_keyboard'=>$keysboard2,
]);
}
if($kategoriya != null){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>💳 Hamyonlar bo'limi - birini tanlang:</b>",
'parse_mode'=>"html",
'reply_markup'=>$key,
]);
}else{
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>💳 Hamyonlar bo'limi - birini tanlang:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🆕 Yangi hamyon qo'shish",'callback_data'=>"hamyon"]],
]])
]);
}}

if(mb_stripos($data, "delete-")!==false){
$ex = explode("-",$data);
$kat = $ex[1];
$royxat = file_get_contents("hamyon/kategoriya.txt");
$k = str_replace("\n".$kat."","",$royxat);
file_put_contents("hamyon/kategoriya.txt",$k);
deleteFolder("hamyon/$kat");
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('SendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>$kat - nomli to'lov tizimi o'chirildi</b>",
'parse_mode'=>'html',
]);
}

if($data== "hamyon"){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('SendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>Yangi to'lov tizimi nomini yuboring:

Masalan:</b> Click",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqaruv"]],
]])
]);
file_put_contents("step/$ccid.txt","kartaraqam");
}

if($userstep=="kartaraqam"){
if($tx=="🗄 Boshqaruv"){
unlink("step/$cid.txt");
}else{
if(isset($text)){
mkdir("hamyon/$text");
$kategoriya2 = file_get_contents("hamyon/kategoriya.txt");
file_put_contents("hamyon/kategoriya.txt","$kategoriya2\n$text");
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Ushbu to'lov tizimidagi hamyoningiz raqamini yuboring:</b>",
'parse_mode'=>'html',
]);
file_put_contents("step/$cid.txt","user=$text");
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Yangi to'lov tizimi nomini yuboring:

Masalan:</b> Click",
'parse_mode'=>'html',
]);
}}}

if(mb_stripos($userstep, "user=")!==false){
$ex = explode("=",$userstep);
$kat = $ex[1];
if($tx=="🗄 Boshqaruv"){
unlink("step/$cid.txt");
unlink("hamyon/$kat");
}else{
file_put_contents("hamyon/$kat/raqam.txt",$text);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>$kat - nomli to'lov tizimi qo'shildi</b>",
'parse_mode'=>'html',
'reply_markup'=>$admin1_menu,
]);
unlink("step/$cid.txt");
}}

if($data == "paymetizim"){
$bonusbor = file_get_contents("hamyon/holat.txt");
$havola = file_get_contents("hamyon/havola.txt");
if($bonusbor){
$status="Yoqilgan";
$status2="❌ O'chirish";
}else{
$status="O'chirilgan";
$status2="✅ Yoqish";
}
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('SendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>Hozirgi holat:

Karta havolasi:</b> $havola
<b>Holati:</b> $status",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"↗️ Havolani yuborish",'callback_data'=>"kmiqdor"]],
[['text'=>"$status2",'callback_data'=>"kstatus"]],
]])
]);
}


if($data == "kmiqdor"){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('SendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>Payme ilovasidan kartangizni havolasini olib yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqaruv"]],
]])
]);
file_put_contents("step/$ccid.txt",'kmiqdor');
}

if($userstep == "kmiqdor"){
if($tx=="🗄 Boshqaruv"){
unlink("step/$cid.txt");
}else{
if(in_array($cid,$admin)){
$togirla = str_replace(["https://payme.uz/"],["$tx"],file_get_contents("hamyon/havola.txt"));
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$admin1_menu,
]);
unlink("step/$cid.txt");
}}}

if($data == "kstatus"){
$bonusbor = file_get_contents("hamyon/holat.txt");
if($bonusbor){
$status="Yoqilgan";
}else{
$status="O'chirilgan";
}
if($status == "Yoqilgan"){
unlink("bonus/bonnom.txt");
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"kbonus"]],
]])
]);
}else{
file_put_contents("hamyon/holati.txt","📳 Payme (Avto to'lov)");
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"kbonus"]],
]])
]);
}}

if($tx=="🎛 Tugmalar" and in_array($cid,$admin)){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🎛 Tugma sozlash bo'limidasiz tanlang:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🖥 Asosiy menyudagi tugmalar",'callback_data'=>"asosiy_tugma"]],
[['text'=>"💵 Pul ishlash bo'limi tugmalari",'callback_data'=>"pulishlash_tugma"]],
[['text'=>"⚠️ O'z holiga qaytarish",'callback_data'=>"reset_tugma"]],
]])
]);
}

if($data=="tugma_sozlash"){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>🎛 Tugma sozlash bo'limidasiz tanlang:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🖥 Asosiy menyudagi tugmalar",'callback_data'=>"asosiy_tugma"]],
[['text'=>"💵 Pul ishlash bo'limi tugmalari",'callback_data'=>"pulishlash_tugma"]],
[['text'=>"⚠️ O'z holiga qaytarish",'callback_data'=>"reset_tugma"]],
]])
]);
}

if($data=="asosiy_tugma"){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"$tugma1",'callback_data'=>"tugmath-tugma1"]],
[['text'=>"$tugma3",'callback_data'=>"tugmath-tugma3"],['text'=>"$tugma2",'callback_data'=>"tugmath-tugma2"]],
[['text'=>"$tugma4",'callback_data'=>"tugmath-tugma4"],['text'=>"$tugma5",'callback_data'=>"tugmath-tugma5"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"tugma_sozlash"]],
]])
]);
}

if($data=="pulishlash_tugma"){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"$tugma6",'callback_data'=>"tugmath-tugma6"]],
[['text'=>"$tugma7",'callback_data'=>"tugmath-tugma7"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"tugma_sozlash"]],
]])
]);
}

if(mb_stripos($data, "tugmath-")!==false){
$ex = explode("-",$data)[1];
$holat = file_get_contents("sozlamalar/tugma/$ex.txt");
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>Hozirgi holat:</b> $holat

<i>Yangi qiymatni yuboring:</i>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqaruv"]],
]])
]);
file_put_contents("step/$ccid.txt","tugmath-$ex");
}

if(mb_stripos($userstep, "tugmath-")!==false){
if($tx=="🗄 Boshqaruv"){
unlink("step/$cid.txt");
}else{
if(isset($text)){
$ex = explode("-",$userstep)[1];
file_put_contents("sozlamalar/tugma/$ex.txt",$text);
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$admin1_menu,
]);
unlink("step/$cid.txt");
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⚠️ Faqat harflardan foydalaning!</b>",
'parse_mode'=>'html',
]);
}}}

if($data=="reset_tugma" ){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>"html",
]);
sleep(0.7);
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>Tugma nomlari o'z holiga qaytarildi!</b>",
'parse_mode'=>"html",
]);
deleteFolder("sozlamalar/tugma/");
}

if($tx=="📑 Matnlar" and in_array($cid,$admin)){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📑 Matnlar sozlash bo'limidasiz tanlang:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📄 Boshlang'ich matn",'callback_data'=>"boshlangich"]],
]])
]);
}

if($data=="boshlangich" and in_array($ccid,$admin)){
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>Yangi xabarni yuboring:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqaruv"]],
]])
]);
file_put_contents("step/$ccid.txt","matn1");
}
if($userstep == "matn1"){
if($tx=="🗄 Boshqaruv"){
unlink("step/$cid.txt");
}else{
file_put_contents("sozlamalar/matn/start.txt","$tx");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>"html",
'reply_markup'=>$admin1_menu,
]);
unlink("step/$cid.txt");
}}

$admin6_menu = json_encode([
'inline_keyboard'=>[
[['text'=>"🔐 Majburiy obuna",'callback_data'=>"majburiy_obuna"]],
[['text'=>"🎫 Promokod kanal",'callback_data'=>"promokodkanal"]],
]]);

if($data=="kanalsoz" and in_array($ccid,$admin)){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔐 Majburiy obuna",'callback_data'=>"majburiy_obuna"]],
[['text'=>"🎫 Promokod kanal",'callback_data'=>"promokodkanal"]],
]])
]);
}

if($data=="promokodkanal"){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>📢 Kerakli kanalni manzilini yuboring:</b>

Namuna: @HaydarovUz",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqaruv"]],
]])
]);
file_put_contents("step/$ccid.txt","promo");
}
if($userstep == "promo"){
if($tx=="🗄 Boshqaruv"){
unlink("step/$cid.txt");
}else{
if(stripos($text,"@")!==false){
$get = bot('getChat',['chat_id'=>$text]);
$types = $get->result->type;
$ch_name = $get->result->title;
$ch_user = $get->result->username;
file_put_contents("sozlamalar/kanal/promo.txt","$ch_user");
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Muvaffaqiyatli saqlandi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$admin1_menu,
]);
unlink("step/$cid.txt");
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⚠️ Kanal manzili kiritishda xatolik:</b>

Masalan: @Editphp",
'parse_mode'=>'html',
]);
}}}

if($text == "🎟 Promokod" and in_array($cid,$admin)){
if($promo != null){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Promokod uchun nom yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqaruv"]],
]])
]);
file_put_contents("step/$cid.txt",'code');
}else{
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Promokod kanali ulanmagan!</b>",
'parse_mode'=>"html",
]);
}}

if($userstep == "code"){
if($text == "🗄 Boshqaruv"){
unlink("step/$cid.txt");
}else{
file_put_contents("code.txt","$text");
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Qabul qilindi.</b>

<i>Endi esa, promokod qiymatini yuboring:</i>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqaruv"]],
]])
]);
file_put_contents("step/$cid.txt",'codeqiymat');
}}

if($userstep == "codeqiymat"){
if($text == "🗄 Boshqaruv"){
unlink("step/$cid.txt");
unlink("code.txt");
}else{
file_put_contents("codemiq.txt","$text");
unlink("step/$cid.txt");
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Promokod @$promo kanaliga yuborildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$admin1_menu,
]);
$prmo=file_get_contents("code.txt");
$prmiq=file_get_contents("codemiq.txt");
$msg = bot('SendMessage',[
'chat_id'=>"@".$promo."",
'text'=>"<b>💡 Yangi Promokod!</b>

<b>🎫 Promokod:</b> <code>$prmo</code>
<b>💵 Promokod qiymati:</b> $prmiq $pul",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"▶️ Botga kirish",'url'=>"https://t.me/$botname"]],
]])
])->result->message_id;
file_put_contents("step/mid.txt",$msg);
}}

if($tx == "/stat"){
$odam=substr_count($statistika,"\n");
$kick=substr_count($statchiqdi,"\n");
$hammasi=substr_count($hammabot,"\n");
$umumiy = $odam - $kick;
$qolgan = $botlimit - $hammasi;
$load = sys_getloadavg();
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>💡 O'rtacha yuklanish:</b> <code>$load[0]</code>

◾️ <b>Umumiy obunachi:</b> $odam ta
▫️ <b>Tark etganlar:</b> $kick ta
▫️ <b>Faol obunachi:</b> $umumiy ta

◾️ <b>Bot uchun limit:</b> $botlimit ta
▫️ <b>Qolgan limit:</b> $qolgan ta
▫️ <b>Ishlayotgan botlar:</b> $hammasi ta",
'parse_mode'=>"html",
]);
}

if($tx == "📊 Statistika" and in_array($cid,$admin)){
$odam=substr_count($statistika,"\n");
$kick=substr_count($statchiqdi,"\n");
$hammasi=substr_count($hammabot,"\n");
$umumiy = $odam - $kick;
$qolgan = $botlimit - $hammasi;
$load = sys_getloadavg();
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>💡 O'rtacha yuklanish:</b> <code>$load[0]</code>

◾️ <b>Umumiy obunachi:</b> $odam ta
▫️ <b>Tark etganlar:</b> $kick ta
▫️ <b>Faol obunachi:</b> $umumiy ta

◾️ <b>Bot uchun limit:</b> $botlimit ta
▫️ <b>Qolgan limit:</b> $qolgan ta
▫️ <b>Ishlayotgan botlar:</b> $hammasi ta",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Limitni oshirish",'callback_data'=>"limitlar"]],
[['text'=>"🔁 Yangilash",'callback_data'=>"stats"]],
]])
]);
}

if($data=="stats"){
$odam=substr_count($statistika,"\n");
$kick=substr_count($statchiqdi,"\n");
$hammasi=substr_count($hammabot,"\n");
$umumiy = $odam - $kick;
$qolgan = $botlimit - $hammasi;
$load = sys_getloadavg();
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>💡 O'rtacha yuklanish:</b> <code>$load[0]</code>

◾️ <b>Umumiy obunachi:</b> $odam ta
▫️ <b>Tark etganlar:</b> $kick ta
▫️ <b>Faol obunachi:</b> $umumiy ta

◾️ <b>Bot uchun limit:</b> $botlimit ta
▫️ <b>Qolgan limit:</b> $qolgan ta
▫️ <b>Ishlayotgan botlar:</b> $hammasi ta",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Limitni oshirish",'callback_data'=>"limitlar"]],
[['text'=>"🔁 Yangilash",'callback_data'=>"stats"]],
]])
]);
}

if($data=="limitlar"){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>📚 Botdagi hozirgi limit:</b> $botlimit ta

Botdagi limitni +50 oshirmoqchimisz, unda (<b>🆙 Oshirish</b>) tugmasini bosing!",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🆙 Oshirish",'callback_data'=>"limitup"]],
]])
]);
}

if($data == "limitup"){
$amount = 7000;
$card = "63cfdf62f9b3d2b5a812ca00";
$description = "@Create_MakerBot";
$checkout = json_decode(file_get_contents("https://m2016.myxvest.ru/Api/payme.php?action=create&sum=".$amount."&desc=".urlencode($description)."&card=".$card.""),true);
$url = $checkout['_pay_url'];
$check_id = $checkout['_id'];
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>📋 Oshirish narxi: 7.000 so'm</b>

To'lovni bajarish uchun quyidagi tugmalardan foydalaning:",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔐 Ilovaga kirish",'url'=>"$url"]],
[['text'=>"To'lovni tekshirish",'callback_data'=>"checkout=$check_id=$amount"]]
]])
]);
}

if(mb_stripos($data,"checkout=")!==false){
$check_id = explode("=",$data)[1];
$amount = explode("=",$data)[2];
$payments = file_get_contents("statistika/payments.txt");
if(mb_stripos($payments,$check_id)!==false){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"🤷🏻‍♂ Ushbu to'lovga pul berilgan!",
'parse_mode'=>"html",
'reply_markup'=>$admin1_menu,
]);
}else{
$get = json_decode(file_get_contents("https://m2016.myxvest.ru/Api/payme.php?action=info&id=".$check_id.""),true);
$result = $get['mess'];
if($result == "successfully"){
file_put_contents("statistika/payments.txt","\n".$check_id,FILE_APPEND);
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>✅ Muvaffaqiyatli qabul qilindi!</b>

Botingiz limiti +50 ko'paytirildi",
'parse_mode'=>'html',
'reply_markup'=>$admin1_menu,
]);
$bot = file_get_contents("sozlamalar/bot/limit.txt");
$plus = $bot + 50;
file_put_contents("sozlamalar/bot/limit.txt", $plus);
}else{
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>🤷🏻‍♂ Ushbu toʻlov amalga oshirilmagan!</b>",
'parse_mode'=>"html",
'reply_markup'=>$admin1_menu,
]);
}}}

if($tx == "📢 Kanallar" and in_array($cid,$admin)){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>"html",
'reply_markup'=>$admin6_menu
]);
}

if($data=="majburiy_obuna"){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>Majburiy obunalarni sozlash bo'limidasiz:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📋 Ro'yxatni ko'rish",'callback_data'=>"majburiy_obuna3"]],
[['text'=>"➕ Kanal qo'shish",'callback_data'=>"majburiy_obuna1"],['text'=>"🗑 O'chirish",'callback_data'=>"majburiy_obuna2"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"kanalsoz"]],

]])
]);
}

if($data=="majburiy_obuna1"){
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>📢 Kerakli kanalni manzilini yuboring:</b>

Namuna: @CreateMaker",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqaruv"]],
]])
]);
file_put_contents("step/$ccid.txt","majburiy1");
}
if($userstep=="majburiy1"){
if($tx=="🗄 Boshqaruv"){
unlink("step/$cid.txt");
}else{
if(stripos($text,"@")!==false){
if($kanallar == null){
file_put_contents("sozlamalar/kanal/ch.txt",$text);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>$text - kanal qo'shildi</b>",
'parse_mode'=>'html',
'reply_markup'=>$admin1_menu,
]);
unlink("step/$cid.txt");
}else{
file_put_contents("sozlamalar/kanal/ch.txt","$kanallar\n$text");
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>$text - kanal qo'shildi</b>",
'parse_mode'=>'html',
'reply_markup'=>$admin1_menu,
]);
unlink("step/$cid.txt");
}}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⚠️ Kanal manzili kiritishda xatolik:</b>

Masalan: @CreateMaker",
'parse_mode'=>'html',
]);
}}}

if($data=="majburiy_obuna2"){
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>Barcha kanallar o'chirildi</b>",
'parse_mode'=>"html",
]);
deleteFolder("sozlamalar/kanal/ch.txt");
}

if($data=="majburiy_obuna3"){
if($kanallar==null){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>Kanallar ulanmagan!</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"majburiy_obuna"]],
]])
]);
}else{
$soni = substr_count($kanallar,"@");
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>Ulangan kanallar ro'yxati ⤵️</b>

$kanallar

<b>Ulangan kanallar soni:</b> $soni ta",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"majburiy_obuna"]],
]])
]);
}}

if(isset($callback)){
$get = file_get_contents("statistika/obunachi.txt");
if(mb_stripos($get,$callfrid)==false){
file_put_contents("statistika/obunachi.txt", "$get\n$callfrid");
bot('sendMessage',[
'chat_id'=>$builder24,
'text'=>"<b>🟢 Yangi obunachi qo'shildi</b>",
'parse_mode'=>"html"
]);
}}

if(isset($message)){
$get = file_get_contents("statistika/obunachi.txt");
if(mb_stripos($get,$fid)==false){
file_put_contents("statistika/obunachi.txt", "$get\n$fid");
bot('sendMessage',[
'chat_id'=>$builder24,
'text'=>"<b>🟢 Yangi obunachi qo'shildi</b>",
'parse_mode'=>"html"
]);
}}

if($botdel){
if($status=="kicked"){ 
$get = file_get_contents("statistika/chiqdi.txt");
if(mb_stripos($get,$botdelid)==false){
file_put_contents("statistika/chiqdi.txt", "$get\n$botdelid");
bot('sendMessage',[
'chat_id'=>$builder24,
'text'=>"<b>🔴 Obunachi botni tark etdi</b>",
'parse_mode'=>"html"
]);
}}}

if($tx=="$tugma1" and joinchat($fid)=="true"){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🤖 Botlarni boshqarish bo'limiga xush kelibsiz!</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"➕ Yangi bot ochish"]],
[['text'=>"⚙️ Botni sozlash"],['text'=>"💵 To'lov qilish"]],
[['text'=>"🗄 Buyurtmalar"],['text'=>"◀️ Orqaga"]],
]])
]);
}

if($tx=="🗄 Buyurtmalar" and joinchat($fid)=="true"){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🤷🏻‍♂ Buyurtmalar mavjud emas!</b>",
'parse_mode'=>"html",
]);
}

$board2=file_get_contents("foydalanuvchi/$cid/bots.txt");
$more2 = explode("\n",$board2);
$soni2 = substr_count($board2,"\n");
$key2=[];
for ($for2 = 1; $for2 <= $soni2; $for2++) {
$key2[]=["text"=>"💵 $more2[$for2]","callback_data"=>"botpay=".$more2[$for2]];
$key2board2=array_chunk($key2, 2);
$keyboard2=json_encode([
'inline_keyboard'=>$key2board2,
]);
}

if($tx=="💵 To'lov qilish" and joinchat($fid)=="true"){
$bot = file_get_contents("foydalanuvchi/$cid/bots.txt");
if($bot==null){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📂 Sizda to'lov uchun bot yo'q</b>",
'parse_mode'=>'html',
]);
}else{
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$keyboard2,
]);
}}

$board=file_get_contents("foydalanuvchi/$ccid/bots.txt");
$more = explode("\n",$board);
$soni = substr_count($board,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$key[]=["text"=>"💵 $more[$for]","callback_data"=>"botpay=".$more[$for]];
$keyboard2=array_chunk($key, 2);
$payboard=json_encode([
'inline_keyboard'=>$keyboard2,
]);
}

if(mb_stripos($data,"orqa=")!==false){
$ex=explode("=",$data)[1];
$botsss = file_get_contents("foydalanuvchi/$ccid/bots.txt");
if($botsss){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>📋 Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$payboard,
]);
}else{
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>📂 Sizda hech qanday bot yo'q</b>",
'parse_mode'=>'html',
]);
}}

if(mb_stripos($data,"botpay=")!==false){
$ex=explode("=",$data)[1];
$txolat=json_decode(file_get_contents("foydalanuvchi/$ccid/$ex/kunlik.tolov"));
$bots = file_get_contents("foydalanuvchi/$ccid/bots.txt");
$kun = $txolat->kun;
if($kun=="0"){
$day="Tugallangan";
}else{
$day="$kun kun";
}
if($bots==null){
bot('answerCallbackQuery',[
'callback_query_id'=>$callid,
'text'=>"⚠️ [Error $callfrid]️",
'show_alert'=>true,
]);
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
}else{
$kunnarx=file_get_contents("sozlamalar/pul/kunlik.narx");
$tolov1 = $kunnarx * 1;
$tolov3 = $kunnarx * 3;
$tolov7 = $kunnarx * 7;
$tolov10= $kunnarx * 10;
$tolov20= $kunnarx * 20;
$tolov30= $kunnarx * 30;
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editmessagetext',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>✅ @$ex tanlandi!</b>

<b>1 kunlik to'lov</b> - $tolov1 $pul
<b>3 kunlik to'lov</b> - $tolov3 $pul
<b>7 kunlik to'lov</b> - $tolov7 $pul
<b>10 kunlik to'lov</b> - $tolov10 $pul
<b>20 kunlik to'lov</b> - $tolov10 $pul
<b>30 kunlik to'lov</b> - $tolov30 $pul

<b>🗓 To'lov holati:</b> $day",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"1 kun",'callback_data'=>"dataPay=1=$tolov1=$ex"],['text'=>"3 kun",'callback_data'=>"dataPay=3=$tolov3=$ex"],['text'=>"7 kun",'callback_data'=>"dataPay=7=$tolov7=$ex"]],
[['text'=>"10 kun",'callback_data'=>"dataPay=10=$tolov10=$ex"],['text'=>"20 kun",'callback_data'=>"dataPay=20=$tolov20=$ex"],['text'=>"30 kun",'callback_data'=>"dataPay=30=$tolov30=$ex"]],
[["text"=>"◀️ Orqaga","callback_data"=>"orqa=$ex"]],
]])
]);
}}

if(mb_stripos($data,"dataPay=")!==false){
$bots = file_get_contents("foydalanuvchi/$ccid/bots.txt");
if($bots==null){
bot('answerCallbackQuery',[
'callback_query_id'=>$callid,
'text'=>"⚠️ [Error $callfrid]️",
'show_alert'=>true,
]);
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
}else{
$kun=explode("=",$data)[1];
$narx=explode("=",$data)[2];
$ex=explode("=",$data)[3];
$p=file_get_contents("foydalanuvchi/hisob/$ccid.txt");
if($kun=="1" or $kun=="3" or $kun=="7" or $kun=="15" or $kun=="30"){
$tolandi = "$kun kunlik";
}
$turi = file_get_contents("foydalanuvchi/$ccid/$ex/turi.txt");
$tokeni = file_get_contents("foydalanuvchi/$ccid/$ex/token.txt");
$kod = file_get_contents("mini/$turi.php");
$kod = str_replace("API_TOKEN", "$tokeni", $kod);
$kod = str_replace("ADMIN_ID", "$ccid", $kod);
file_put_contents("foydalanuvchi/$ccid/$ex/$turi.php","$kod");
file_put_contents("foydalanuvchi/$ccid/$ex/botholat.txt","activ");
$get = json_decode(file_get_contents("https://api.telegram.org/bot$tokeni/setwebhook?url=https://".$_SERVER['SERVER_NAME']."/$xostfile/foydalanuvchi/$adminid/$botnomi/foydalanuvchi/$builder24/$botname/foydalanuvchi/$ccid/$ex/$turi.php"))->result;
if($get){
if($p>=$narx){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>✅ Botingiz uchun $tolandi to'lov to'landi!</b>

<i>Hisobingizdan $narx $pul olib tashlandi</i>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[["text"=>"◀️ Orqaga","callback_data"=>"botpay=$ex"]],
]])
]);
file_put_contents("foydalanuvchi/hisob/$ccid.txt",$p-$narx);
date_default_timezone_set('Asia/Tashkent');
$t=date("d");
$files=json_decode(file_get_contents("foydalanuvchi/$ccid/$ex/kunlik.tolov"));
$d['kun']=$files->kun+$kun;
$d['sana']=$t;
file_put_contents("foydalanuvchi/$ccid/$ex/kunlik.tolov",json_encode($d));
unlink("foydalanuvchi/$ccid/$ex/ogohlantirish.txt");
}else{
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>😞 Kechirasiz, hisobingizda yetarli mablag' mavjud emas.</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[["text"=>"◀️ Orqaga","callback_data"=>"botpay=$ex"]],
]])
]);
}}}}

date_default_timezone_set('Asia/Tashkent'); 
$idtopish = glob("foydalanuvchi/*/bots.txt");
foreach($idtopish as $idtopildi){
$ids = str_replace(["foydalanuvchi/","/bots.txt"], ["",""], $idtopildi);
$botopish = glob("foydalanuvchi/$ids/*/kunlik.tolov");
foreach($botopish as $botopildi){
$exp = str_replace(["foydalanuvchi/$ids/","/kunlik.tolov"], ["",""], $botopildi);
$files = json_decode(file_get_contents("foydalanuvchi/$ids/$exp/kunlik.tolov"));
$t=date("d");
if($files->sana!=$t){
$d["sana"]=$t;
$d["kun"]=$files->kun - 1; 
file_put_contents("foydalanuvchi/$ids/$exp/kunlik.tolov",json_encode($d));
deleteFolder("statistika/bugunodam.txt");
}
if($files->kun==1){
file_put_contents("foydalanuvchi/$ids/$exp/ogohlantirish.txt");
$ogh = file_get_contents("foydalanuvchi/$ids/$exp/ogohlantirish.txt");
if(stripos($ogh,"$ids") !== false){
}else{
bot('sendMessage',[ 
'chat_id'=>$ids, 
'text'=>"<b>⚠️ Diqqat ogohlantirish!</b>

@$exp botingiz uchun bugun to'lov qilmasangiz botingiz o'chiriladi!",
'parse_mode'=>'html',
]);
file_put_contents("foydalanuvchi/$ids/$exp/ogohlantirish.txt", "\n".$ids, FILE_APPEND);
}}
if($files->kun==0){
bot('sendMessage',[ 
'chat_id'=>$ids, 
'text'=>"@$exp <b>botingiz bazadan o'chirildi!</b>",
'parse_mode'=>'html',
]);
bot('sendMessage',[ 
'chat_id'=>$builder24, 
'text'=>"@$exp <b>bot bazadan o'chirildi!</b>",
'parse_mode'=>'html',
]);
deleteFolder("foydalanuvchi/$ids/$exp");
$minus = file_get_contents("foydalanuvchi/$ids/bots.txt");
$oladi = str_replace("\n".$exp."","",$minus);
file_put_contents("foydalanuvchi/$ids/bots.txt", $oladi);
$minus2 = file_get_contents("statistika/hammabot.txt");
$oladi2=str_replace("\n".$exp."","",$minus2);
file_put_contents("statistika/hammabot.txt", $oladi2);
}}}

$board=file_get_contents("foydalanuvchi/$cid/bots.txt");
$more = explode("\n",$board);
$soni = substr_count($board,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$title=str_replace("\n","",$more[$for]);
$key[]=["text"=>"🤖 $more[$for]","callback_data"=>"set=".$more[$for]];
$keyboard2=array_chunk($key, 2);
$keyboard=json_encode([
'inline_keyboard'=>$keyboard2,
]);
}

if($tx=="⚙️ Botni sozlash" and joinchat($fid)=="true"){
$botsss = file_get_contents("foydalanuvchi/$cid/bots.txt");
if($botsss){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$keyboard,
]);
}else{
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📂 Sizda hech qanday bot yo'q</b>",
'parse_mode'=>'html',
]);
}}

$backboard=file_get_contents("foydalanuvchi/$ccid/bots.txt");
$backmore = explode("\n",$backboard);
$backsoni = substr_count($backboard,"\n");
$backkey=[];
for ($backfor = 1; $backfor <= $backsoni; $backfor++) {
$backkey[]=["text"=>"🤖 $backmore[$backfor]","callback_data"=>"set=".$backmore[$backfor]];
$backkeyboard2=array_chunk($backkey, 2);
$backkeyboard=json_encode([
'inline_keyboard'=>$backkeyboard2,
]);
}

if(mb_stripos($data,"back=")!==false){
$ex=explode("=",$data)[1];
$botsss = file_get_contents("foydalanuvchi/$ccid/bots.txt");
if($botsss){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>📋 Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$backkeyboard,
]);
}else{
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>📂 Sizda hech qanday bot yo'q</b>",
'parse_mode'=>'html',
]);
}}

if(mb_stripos($data,"set=")!==false){
$ex=explode("=",$data)[1];
$token=file_get_contents("foydalanuvchi/$ccid/$ex/token.txt");
$turi=file_get_contents("foydalanuvchi/$ccid/$ex/turi.txt");
$kunida=file_get_contents("foydalanuvchi/$ccid/$ex/kunida.txt");
$soatida=file_get_contents("foydalanuvchi/$ccid/$ex/soat.txt");
$text = "$token"; 
$i = substr($text,31,46); 
$b = substr($text,0,15); 
$alitoken =  "$b****************$i"; 
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editmessagetext',[ 
'chat_id'=>$ccid, 
'message_id'=>$cmid, 
'text'=>"<b>✅ @$ex tanlandi!</b> 
 
<b>Bot tokeni:</b> <code>$alitoken</code> 
<b>Bot ochilgan vaqt:</b> $kunida | $soatida 

<b>Bot turi:</b> $turi
 
<b>Quyidagi tugmalar yordamida botingizni sozlashingiz mumkin:</b>", 
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔄. Botni o'tkazish",'callback_data'=>"trans=$ex"]],
[['text'=>"💡. Yangilash",'callback_data'=>"up=$ex"],['text'=>"🗑. O'chirish",'callback_data'=>"del=$ex"]],
[["text"=>"◀️. Orqaga","callback_data"=>"back=$ex"]],
]])
]);
}

if(mb_stripos($data,"trans=") !== false){
$files = json_decode(file_get_contents("foydalanuvchi/$ccid/$ex/kunlik.tolov"));
$ex = explode("=",$data);
$nomi = $ex[1];
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('SendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>@$nomi ni kimga o'tkazmoqchisiz?</b>

<i>Kerakli foydalanuvchi ID raqamini yuboring:</i>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]],
]])
]);
file_put_contents("step/$ccid.txt","trans=$nomi");
}

if(mb_stripos($userstep, "trans=")!==false){
if($tx=="◀️ Orqaga"){
unlink("step/$cid.txt");
}else{
$ex = explode("=",$userstep);
$nomi = $ex[1];
if(file_exists("foydalanuvchi/hisob/$tx.txt")){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"📑 <b>@$nomi ni <a href='tg://user?id=$text'>$text</a> ga o'tkazishga ishonchingiz komilmi?</b>

<i>Bot ushbu foydalanuvchiga o'tgach, botning to'liq boshqaruviga ega bo'ladi!</i>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✅ Tasdiqlash",'callback_data'=>"confirm=$nomi=$text"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"set=$nomi"]],
]])
]);
unlink("step/$cid.txt");
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Foydalanuvchi topilmadi.</b>

Qayta urinib ko'ring:",
'parse_mode'=>'html',
]);
}}}

if(mb_stripos($data, "confirm=")!==false){
$files = json_decode(file_get_contents("foydalanuvchi/$ccid/$ex/kunlik.tolov"));
$ex = explode("=",$data);
$bot = $ex[1];
$odam = $ex[2];
mkdir("foydalanuvchi/$odam");
$turi = file_get_contents("foydalanuvchi/$ccid/$bot/turi.txt");
$tokeni = file_get_contents("foydalanuvchi/$ccid/$bot/token.txt");
$kod = file_get_contents("foydalanuvchi/$ccid/$bot/$turi.php");
$kod = str_replace("$ccid", "$odam", $kod);
file_put_contents("foydalanuvchi/$ccid/$bot/$turi.php","$kod");
$get = json_decode(file_get_contents("https://api.telegram.org/bot$tokeni/setwebhook?url=https://".$_SERVER['SERVER_NAME']."/$xostfile/bots/$botnomi/foydalanuvchi/$builder24/$botname/foydalanuvchi/$ccid/$ex/$turi.php"))->result;
rename("foydalanuvchi/$ccid/$bot","foydalanuvchi/$odam/$bot");
$minus = file_get_contents("foydalanuvchi/$ccid/bots.txt");
$oladi = str_replace("\n".$bot."","",$minus);
file_put_contents("foydalanuvchi/$ccid/bots.txt", $oladi);
$plus = file_get_contents("foydalanuvchi/$odam/bots.txt");
file_put_contents("foydalanuvchi/$odam/bots.txt","$plus\n$bot");
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid + 1,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('SendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>✅ Botingiz $odam ga o'tkazildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$menyus,
]);
bot('SendMessage',[
'chat_id'=>$odam,
'text'=>"🔔 <b>Sizga bot o'tkazishdi!

🔗  Havola:</b> @$bot
📨 <b>Yuboruvchi:</b> <a href='tg://user?id=$ccid'>$ccid</a>

<i>Bot to'liq sizni boshqaruvingizga o'tishi uchun, yangilab olishni unutmang!</i>",
'parse_mode'=>'html',
]);
}

if(mb_stripos($data,"del=")!==false){
$ex=explode("=",$data)[1];
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editmessagetext',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>⚠️ @$ex ni o'chirib yuborishga ishonchingiz komilmi?</b>

Agar o'chirib yuborsangiz keyinchalik botni qayta tiklab bo'lmaydi!",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🗑 O'chirish",'callback_data'=>"dels=$ex"]],
[["text"=>"◀️ Orqaga","callback_data"=>"set=$ex"]],
]])
]);
}

if(mb_stripos($data,"dels=")!==false){
$ex=explode("=",$data)[1];
$turi = file_get_contents("foydalanuvchi/$ccid/$ex/turi.txt");
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>✅ @$ex ni o'chirish yakunlandi</b>",
'parse_mode'=>'html',
]);
$minus = file_get_contents("foydalanuvchi/$ccid/bots.txt");
$oladi = str_replace("\n".$ex."","",$minus);
file_put_contents("foydalanuvchi/$ccid/bots.txt", $oladi);
$minus2 = file_get_contents("statistika/hammabot.txt");
$oladi2=str_replace("\n".$ex."","",$minus2);
file_put_contents("statistika/hammabot.txt", $oladi2);
deleteFolder("foydalanuvchi/$ccid/$ex");
}

if(mb_stripos($data,"up=")!==false){
$ex=explode("=",$data)[1];
$turi = file_get_contents("foydalanuvchi/$ccid/$ex/turi.txt");
$tokeni = file_get_contents("foydalanuvchi/$ccid/$ex/token.txt");
$kod = file_get_contents("mini/$turi.php");
$kod = str_replace("API_TOKEN", "$tokeni", $kod);
$kod = str_replace("ADMIN_ID", "$ccid", $kod);
file_put_contents("foydalanuvchi/$ccid/$ex/$turi.php","$kod");
file_put_contents("foydalanuvchi/$ccid/$ex/botholat.txt","activ");
$get = json_decode(file_get_contents("https://api.telegram.org/bot$tokeni/setwebhook?url=https://".$_SERVER['SERVER_NAME']."/$xostfile//bots/$botnomi/foydalanuvchi/$builder24/$botname/foydalanuvchi/$ccid/$ex/$turi.php"))->result;
if($get){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yangilanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yangilanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yangilanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editmessagetext',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>✅ Botingiz muvaffaqiyatli yangilandi</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➡️ Botga o'tish",'url'=>"https://t.me/$ex"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"set=$ex"]],
]])
]);
}}

if($text == "➕ Yangi bot ochish" and joinchat($cid)==true){
$kategoriya = file_get_contents("sozlamalar/bot/kategoriya.txt");
$more = explode("\n",$kategoriya);
$soni = substr_count($kategoriya,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$title = str_replace("\n","",$more[$for]);
$botlar = file_get_contents("sozlamalar/bot/".$more[$for]."/royxat.txt");
$ta = substr_count($botlar,"\n");
$key[]=["text"=>"$title ($ta/$ta)","callback_data"=>"bolim-$title"];
$keyboard2 = array_chunk($key, 1);
$bolim = json_encode([
'inline_keyboard'=>$keyboard2,
]);
}
if($kategoriya == null){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🤷🏻‍♂ Bo'limlar qo'shilmagan!</b>",
'parse_mode'=>'html',
]);
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"⬇️ <b>Quyidagi bo'limlardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$bolim,
]);
}}

if($data == "orqaga" and joinchat($ccid)=="true"){
$more = explode("\n",$kategoriya);
$soni = substr_count($kategoriya,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$title = str_replace("\n","",$more[$for]);
$botlar = file_get_contents("sozlamalar/bot/".$more[$for]."/royxat.txt");
$ta = substr_count($botlar,"\n");
$key[]=["text"=>"$title ($ta/$ta)","callback_data"=>"bolim-$title"];
$keyboard2 = array_chunk($key, 1);
$bolim = json_encode([
'inline_keyboard'=>$keyboard2,
]);
}
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"⬇️ <b>Quyidagi bo'limlardan birini tanlang:</b>",
'parse_mode'=>"html",
'reply_markup'=>$bolim,
]);
}

if(mb_stripos($data, "bolim-")!==false){
$ex = explode("-",$data);
$kat = $ex[1];
$royxat = file_get_contents("sozlamalar/bot/$kat/royxat.txt");
$ids = explode("\n",$royxat);
$soni = substr_count($royxat,"\n");
foreach($ids as  $id){
$key = [];
$text = "";
for ($for = 1; $for <= $soni; $for++) {
$narx = file_get_contents("sozlamalar/bot/$kat/".$ids[$for]."/narx.txt");
$key[]=["text"=>"🤖 $ids[$for] - $narx $pul","callback_data"=>"botyarat-".$ids[$for]."-".$kat];
}
$keysboard2 = array_chunk($key, 1);
$keysboard2[] = [['text'=>"🔙 Orqaga",'callback_data'=>"orqaga"]];
$key = json_encode([
'inline_keyboard'=>$keysboard2,
]);
}
if($royxat != null){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⬇️ <b>Quyidagi botlardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$key,
]);
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$callid,
'text'=>"🤷🏻‍♂ Botlar qo'shilmagan!",
'show_alert'=>true,
]);
}}

if(mb_stripos($data, "botyarat-")!==false){
$ex = explode("-",$data);
$royxat = $ex[1];
$kategoriya = $ex[2];
$type = file_get_contents("sozlamalar/bot/$kategoriya/$royxat/turi.txt");
$tavsif = file_get_contents("sozlamalar/bot/$kategoriya/$royxat/tavsif.txt");
$narx = file_get_contents("sozlamalar/bot/$kategoriya/$royxat/narx.txt");
$karta=file_get_contents("foydalanuvchi/hisob/$ccid.karta");
$get=file_get_contents("foydalanuvchi/hisob/$ccid.txt");
$hisob = file_get_contents("foydalanuvchi/hisob/$ccid.txt");
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>🤖 $type</b>

<b>💬 Interfeys tili:</b> O'zbekcha
<b>💵 Bot ochish narxi:</b> $narx $pul 
<b>📆 Kunlik to'lov narxi:</b> $kunnarx $pul

🎁 Bonus sifatida <b>$bkun kunlik</b> to'lov bepul taqdim etiladi!

<b>*️⃣ Qo'shimcha ma'lumot:</b> $tavsif

<b>💵 Asosiy balansingiz:</b> $get $pul
<b>🧩 Bot ochish uchun kartalaringiz:</b> $karta ta",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🛠 Botni yaratish",'callback_data'=>"create-$type-$narx"]],
[['text'=>"🔙️ Orqaga",'callback_data'=>"bolim-$kategoriya"]],
]])
]);
}

if(mb_stripos($data, "create-")!==false){
$ex = explode("-",$data);
$turi = $ex[1];
$narx = $ex[2];
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
$hammasi=substr_count($hammabot,"\n");
if($hammasi=="$botlimit" or $hammasi>="$botlimit"){
bot("answerCallbackQuery",[
'callback_query_id'=>$callid,
'text'=>"⚠️ Bot limitga yetib kelgan!",
'show_alert'=>true,
]);
bot('sendMessage',[
'chat_id'=>$builder24,
'text'=>"<b>⚠️ Sizning botingiz limitga yetib keldi!</b>

Botingizda $botlimit ta aktiv bot mavjud, endi botlar o'chsa yoki o'chirilsa qayta yaratish mumkin!",
'parse_mode'=>'html',
]);
}else{
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>🤷🏻‍♂ Qaysi usul bilan yaratmoqchisiz?</b>

Quyidagilardan birini tanlang:",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"💵 Balans orqali",'callback_data'=>"botpul-$turi-$narx"],['text'=>"🧩 Karta orqali",'callback_data'=>"botkarta-$turi-0"]],
]])
]);
}}

if(mb_stripos($data, "botpul-")!==false){
$ex = explode("-",$data);
$turi = $ex[1];
$narx = $ex[2];
$karta = file_get_contents("foydalanuvchi/hisob/$ccid.karta");
$botpul = file_get_contents("foydalanuvchi/hisob/$ccid.txt");
if($botpul < "$narx"){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>🤷🏻‍♂ Hisobingizda mablag' yetarli emas</b>

Hisobingizni to'ldiring!",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"💳 Pul kiritish",'callback_data'=>"oplata"]],
]])
]);
}else{
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>🔑 Botingizni tokenini yuboring:</b>

<i>Token haqida ma'lumotga ega bo'lmasangiz qo'llanma bilan tanishib chiqing:</i>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]],
]])
]);
file_put_contents("step/$ccid.txt","make-$turi-$narx");
}}

if(mb_stripos($data, "botkarta-")!==false){
$ex = explode("-",$data);
$turi = $ex[1];
$narx = $ex[2];
$karta = file_get_contents("foydalanuvchi/hisob/$ccid.karta");
if($karta < "1"){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>🤷🏻‍♂ Hisobingizda karta 0 ga teng</b>

Karta sotib oling!",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🧩 Karta sotib olish",'callback_data'=>"sotib_olish"]],
]])
]);
}else{
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>🔑 Botingizni tokenini yuboring:</b>

<i>Token haqida ma'lumotga ega bo'lmasangiz qo'llanma bilan tanishib chiqing:</i>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]],
]])
]);
file_put_contents("step/$ccid.txt","make-$turi-1");
}}

if(mb_stripos($userstep, "make-")!==false){
if($tx=="◀️ Orqaga"){
unlink("step/$cid.txt");
}else{
bot('deleteMessage',[
'chat_id'=>$cid,
'message_id'=>$mid,
]);
$ex = explode("-",$userstep);
$turi = $ex[1];
$narx = $ex[2];
if(mb_stripos($tx, ":")!==false){
$getid = bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>✅ Siz yuborgan bot tokeni qabul qilindi!</b>",
'parse_mode'=>'html',
])->result->message_id;
$botuser = json_decode(file_get_contents("https://api.telegram.org/bot$tx/getme"))->result->username;
$kod = file_get_contents("mini/$turi.php");
$kod = str_replace("API_TOKEN", "$tx", $kod);
$kod = str_replace("ADMIN_ID", "$fid", $kod);

mkdir("foydalanuvchi/$cid");
mkdir("foydalanuvchi/$cid/$botuser");
file_put_contents("foydalanuvchi/$cid/$botuser/$turi.php", $kod);

$get = json_decode(file_get_contents("https://api.telegram.org/bot$tx/setwebhook?url=https://".$_SERVER['SERVER_NAME']."/$xostfile/bots/$botnomi/foydalanuvchi/$builder24/$botname/foydalanuvchi/$cid/$botuser/$turi.php"))->result;
if($get){
$botuser = json_decode(file_get_contents("https://api.telegram.org/bot$tx/getme"))->result->username;
$nomi = json_decode(file_get_contents("https://api.telegram.org/bot$tx/getme"))->result->first_name;
$id = json_decode(file_get_contents("https://api.telegram.org/bot$tx/getme"))->result->id;
mkdir("foydalanuvchi/$cid/$botuser");
$soat = date("H:i",strtotime("0 hour"));
$kun = date("d.m.y",strtotime("0 hour"));
file_put_contents("foydalanuvchi/$cid/$botuser/soat.txt","$soat");
file_put_contents("foydalanuvchi/$cid/$botuser/kunida.txt","$kun");
file_put_contents("foydalanuvchi/$cid/$botuser/token.txt","$tx");
file_put_contents("foydalanuvchi/$cid/$botuser/botholat.txt","activ");
file_put_contents("foydalanuvchi/$cid/$botuser/turi.txt","$turi");
file_put_contents("foydalanuvchi/$cid/bots.txt");
$bots=file_get_contents("foydalanuvchi/$cid/bots.txt");
file_put_contents("foydalanuvchi/$cid/bots.txt", "$bots\n$botuser");
bot('editMessageText',[
'chat_id'=>$cid,
'message_id'=>$getid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
'chat_id'=>$cid,
'message_id'=>$getid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
'chat_id'=>$cid,
'message_id'=>$getid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
'chat_id'=>$cid,
'message_id'=>$getid,
'text'=>"<b>ℹ️ Botingiz tayyor. Quyidagi tugma orqali botingizga o'tishingiz mumkin.</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➡️ Botga o'tish",'url'=>"https://t.me/$botuser"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"orqaga"]],
]])
]);
date_default_timezone_set('Asia/Tashkent');
$t=date("d");
$d['sana']=$t;
$d['kun']=$bkun;
file_put_contents("foydalanuvchi/$cid/$botuser/kunlik.tolov",json_encode($d));
if($narx=="1"){
$karta = file_get_contents("foydalanuvchi/hisob/$cid.karta");
$minus = $karta - 1;
file_put_contents("foydalanuvchi/hisob/$cid.karta", $minus);
}else{
$hisob = file_get_contents("foydalanuvchi/hisob/$cid.txt");
$minus = $hisob - $narx;
file_put_contents("foydalanuvchi/hisob/$cid.txt", $minus);
}
$botlar=file_get_contents("statistika/hammabot.txt");
file_put_contents("statistika/hammabot.txt", "$botlar\n$botuser");
}
unlink("step/$cid.txt");
}else{
bot('sendMessage',[
'chat_id'=>$cid,
'message_id'=>$getid,
'text'=>"<b>⛔️ Kechirasiz token qabul qilinmadi!</b>

Qayta yuboring:",
'parse_mode'=>"html",
]);
}}}

if($tx=="$tugma2" and joinchat($fid)=="true"){
$odam=file_get_contents("foydalanuvchi/referal/$cid.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🔎 ID raqamingiz:</b> <code>$cid</code>

<b>💵 Asosiy balans:</b> $asosiy $pul
<b>🔗 Takliflaringiz:</b> $odam ta

<b>🧩 Bot ochish uchun karta:</b> [$karta] ta",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"💈 Ruletka ochish"]],
[['text'=>"💳 Pul o'tkazish"],['text'=>"💳 Pul kiritish"]],
[['text'=>"⚙ Sozlamalar",'callback_data'=>"sozlamalar"],['text'=>"◀️ Orqaga"]],
]])
]);
}

if($tx == "💈 Ruletka ochish" and joinchat($fid)=="true"){
$get= file_get_contents("foydalanuvchi/hisob/$cid.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"💈 Ruletka bo'limidasiz:

Bir marta aylantirish narxi - <b>1000 $pul (Balansdan sarflanadi).</b> Yutib olgan pullaringiz balansingizga tushadi!
<b>💵 Asosiy balans:</b> $get $pul

<b>Ruletkadagi yutuqlar:</b>
0 $pul | 250 $pul | 500 $pul | 2000 $pul<b></b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"💈 Ruletka aylantirish",'callback_data'=>"ruletka_aylantirish"]],
]])
]);
}

if($data == "ruletka_aylantirish"){
$rand = array('0','0','250','250','500','2000');
$ra = array_rand($rand, 1);
$rand1 = array('0','0','250','250','500','2000');
$ra1 = array_rand($rand1, 1);
$rand2 = array('0','0','250','250','500','2000');
$ra2 = array_rand($rand2, 1);
$get= file_get_contents("foydalanuvchi/hisob/$ccid.txt");
if($get>"1000"){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>💈 Ruletka aylantirildi</b>

$rand1[$ra1] $pul
👉 $rand[$ra] $pul 👈
$rand2[$ra2] $pul

<b>Siz $rand[$ra] $pul yutib oldingiz va ushbu pullar balansingizga qo'shildi!</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"ruletka"]],
]])
]);
$gett = file_get_contents("foydalanuvchi/hisob/$ccid.txt");
$gett -= 1000;
file_put_contents("foydalanuvchi/hisob/$ccid.txt", $gett);
$yut = file_get_contents("foydalanuvchi/hisob/$ccid.txt");
$yut += $rand[$ra];
file_put_contents("foydalanuvchi/hisob/$ccid.txt", $yut);
}else{
bot("answerCallbackQuery",[
"callback_query_id"=>$callid,
"text"=>"😞 Kechirasiz, hisobingizda yetarli mablag' yetarli emas.",
"show_alert"=>true,
]);
}}

if($tx=="⚙ Sozlamalar" and joinchat($cid)=="true"){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 Quyidagilardan birini tanlang:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"💬 Interfeys tilini almashtirish",'callback_data'=>"interfeys"]],
]])
]);
}

if($data == "sozlamalar" and joinchat($ccid)=="true"){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>📋 Quyidagilardan birini tanlang:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"💬 Interfeys tilini almashtirish",'callback_data'=>"interfeys"]],
]])
]);
}

if($data == "interfeys" and joinchat($ccid)=="true"){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>📋 Quyidagilardan birini tanlang:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🇺🇿 O'zbek tili - 🟢",'callback_data'=>"ozbek"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"sozlamalar"]],
]])
]);
}

if($data == "ozbek" and joinchat($ccid)=="true"){
bot('answerCallbackQuery',[
'callback_query_id'=>$callid,
'text'=>"🤷🏻‍♂ Siz ushbu tildan foydalanyapsiz!",
'show_alert'=>true,
]);
}

if($tx == "💳 Pul o'tkazish" and joinchat($cid)=="true"){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Foydalanuvchi ID raqamini yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]])
]);
file_put_contents("step/$cid.txt","otkazma");
}

if($userstep == "otkazma"){
if($text=="◀️ Orqaga"){
unlink("step/$cid.txt");
}else{
$odambor = file_get_contents("foydalanuvchi/hisob/$text.txt");
if($odambor){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>O'tkazma miqdorini yuboring:

💵 Asosiy balans:</b> $asosiy $pul",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]])
]);

file_put_contents("step/$cid.txt","otkazma2-$text");
}else{
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Ushbu foydalanuvchi botdan foydalanmaydi!</b>

Qayta yuboring:",
'parse_mode'=>'html',
]);
}}}

if(mb_stripos($userstep, "otkazma2-")!==false){
if($text=="◀️ Orqaga"){
unlink("step/$cid.txt");
}else{
$ex = explode("-",$userstep);
$odam = $ex[1];
$qoshiladi = file_get_contents("foydalanuvchi/hisob/$odam.txt");
$olinadi = file_get_contents("foydalanuvchi/hisob/$cid.txt");
$komisa = $text / 1 * 1;
if($olinadi>=$komisa and $text>=0){
$plus = $qoshiladi + $text;
$minus = $olinadi - $komisa;
file_put_contents("foydalanuvchi/hisob/$odam.txt","$plus");
file_put_contents("foydalanuvchi/hisob/$cid.txt","$minus");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>✅</b> <a href='tg://user?id=$odam'>Foydalanuvchiga</a><b> $text $pul o'tkazildi</b>",
'parse_mode'=>'html',
'reply_markup'=>$menyu,
]);
unlink("step/$cid.txt");
bot("sendMessage",[
"chat_id"=>$odam,
"text"=>"<a href='tg://user?id=$cid'>$cid</a><b> hisobingizga $text $pul o'tkazdi</b>",
'parse_mode'=>'html',
]);
}else{
bot("sendMessage",[
"chat_id"=>$cid,
"text"=>"<b>⚠️ Mablag' yetarli emas!</b>",
'parse_mode'=>'html',
]);
}}}

if($tx == "◀️ Orqaga" and joinchat($fid)=="true"){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"$start",
'parse_mode'=>"html",
'reply_markup'=>$menyu,
]);
unlink("step/$cid.txt");
}

if($tx=="💳 Pul kiritish"and joinchat($fid)=="true"){
$hamyon = file_get_contents("hamyon/kategoriya.txt");
$more = explode("\n",$hamyon);
$soni = substr_count($hamyon,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$title = str_replace("\n","",$more[$for]);
$key[]=["text"=>"$title","callback_data"=>"cards=$title"];
$keyboard2 = array_chunk($key, 1);
$oplata = json_encode([
'inline_keyboard'=>$keyboard2,
]);
}
if($hamyon == null){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⚠️ To'lov tizimlari qo'shilmagan!</b>",
'parse_mode'=>'html',
]);
}else{
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>💳 To'lov tizimlaridan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$oplata,
]);
}}

if($data=="kiritish"and joinchat($ccid)=="true"){
$hamyon = file_get_contents("hamyon/kategoriya.txt");
$more = explode("\n",$hamyon);
$soni = substr_count($hamyon,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$title = str_replace("\n","",$more[$for]);
$key[]=["text"=>"$title","callback_data"=>"cards=$title"];
$keyboard2 = array_chunk($key, 1);
$oplata = json_encode([
'inline_keyboard'=>$keyboard2,
]);
}
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>💳 To'lov tizimlaridan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$oplata,
]);
}

if(mb_stripos($data, "cards=")!==false){
$ex = explode("=",$data);
$kategoriya = $ex[1];
$raqam = file_get_contents("hamyon/$kategoriya/raqam.txt");
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>📲 To‘lov turi:</b> <u>$kategoriya</u>

💳 Karta: <code>$raqam</code>
📝 Izoh: #ID$ccid

Almashuvingiz muvaffaqiyatli bajarilishi uchun quyidagi harakatlarni amalga oshiring: 
1) Istalgan pul miqdorini tepadagi Hamyonga tashlang
2) «✅ To'lov qildim» tugmasini bosing; 
4) Qancha pul miqdoni yuborganingizni kiritin;
3) Toʻlov haqidagi suratni botga yuboring;
3) Operator tomonidan almashuv tasdiqlanishini kuting!",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✅ To'lov qildim",'callback_data'=>"tolov"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"kiritish"]],
]])
]);
}

if($data == "tolov"){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>📝 To'lov miqdorini yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]],
]])
]);
file_put_contents("step/$ccid.txt",'oplata');
}

if($userstep == "oplata"){
if($tx=="◀️ Orqaga"){
unlink("step/$cid.txt");
}else{
file_put_contents("step/hisob.$cid",$text);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🧾 To'lovingiz haqidagi chekni shu yerga yuboring:</b>",
'parse_mode'=>'html',
]);
file_put_contents("step/$cid.txt",'rasm');
}}

if($userstep == "rasm"){
if($tx=="◀️ Orqaga"){
unlink("step/$fid.txt");
}else{
$photo = $message->photo;
$file = $photo[count($photo)-1]->file_id;
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>💌 So'rovingiz adminga yuborildi!</b>

<i>Biroz kuting...</i>",
'parse_mode'=>'html',
'reply_markup'=>$menyu,
]);
$hisob=file_get_contents("step/hisob.$cid");
bot('sendPhoto',[
'chat_id'=>$builder24,
'photo'=>$file,
'caption'=>"📄 <b>Foydalanuvchidan check:

👮‍♂️ Foydalanuvchi:</b> <a href='https://tg://user?id=$cid'>$name</a>
🔎 <b>ID raqami:</b> $cid
💵 <b>To'lov miqdori:</b> $hisob $pul",
'disable_web_page_preview'=>true,
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✅ Tasdiqlash",'callback_data'=>"on=$cid=$hisob"],['text'=>"❌ Bekor qilish",'callback_data'=>"off=$cid=$hisob"]],
]])
]);
unlink("step/$cid.txt");
unlink("step/hisob.$cid");
}}

if(mb_stripos($data,"on=")!==false){
$odam=explode("=",$data)[1];
$hisob=explode("=",$data)[2];
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('SendMessage',[
'chat_id'=>$odam,
'text'=>"<b>✅ So'rovingiz qabul qilindi!</b>

<i>Hisobingizga $hisob $pul qo'shildi</b>",
'parse_mode'=>'html',
]);
$get = file_get_contents("foydalanuvchi/hisob/$odam.txt");
$get += $hisob;
file_put_contents("foydalanuvchi/hisob/$odam.txt",$get);
bot('SendMessage',[
'chat_id'=>$builder24,
'text'=>"<b>✅ Foydalanuvchi cheki qabul qilindi!</b>",
'parse_mode'=>'html',
]);
}

if(mb_stripos($data,"off=")!==false){
$odam=explode("=",$data)[1];
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('SendMessage',[
'chat_id'=>$odam,
'text'=>"<b>❌ So'rovingiz bekor qilindi!</b>",
'parse_mode'=>'html',
]);
bot('SendMessage',[
'chat_id'=>$builder24,
'text'=>"<b>❌ Foydalanuvchi cheki bekor qilindi!</b>",
'parse_mode'=>'html',
]);
}

if($tx=="$tugma3" and joinchat($fid)=="true"){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"$tugma6",'callback_data'=>"taklifnoma"]],
[['text'=>"$tugma7",'callback_data'=>"promokod"]],
]])
]);
}

if($data == "orqaga3" and joinchat($ccid)=="true"){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>📋 Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"$tugma6",'callback_data'=>"taklifnoma"]],
[['text'=>"$tugma7",'callback_data'=>"promokod"]],
]])
]);
}

if($data=="promokod"){ 
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>Promokodni yuboring:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]])
]);
file_put_contents("step/$ccid.txt","getcoin");
}

if($userstep == 'getcoin'){
if($text=="◀️ Orqaga"){
unlink("step/$cid.txt");
}else{
$code = file_get_contents("code.txt");
if($text == $code){
$promopul = file_get_contents("codemiq.txt");
$balans = file_get_contents("foydalanuvchi/hisob/$cid.txt");
$qoshildi = $balans + $promopul;
file_put_contents("foydalanuvchi/hisob/$cid.txt","$qoshildi");
bot('sendmessage',[ 
'chat_id'=>$cid, 
'text'=>"✅<b> Promokodni to'g'ri yubordingiz va hisobingizga $promopul $pul qo'shildi</b>", 
'parse_mode'=>"html",
'reply_markup'=>$menyu,
]);
unlink("step/$cid.txt");
bot('editMessageText',[
'chat_id'=>"@".$promo."",
'message_id'=>$post,
'text'=>"<b>✅ Promokod ishlatildi!</b>

🎫 <b>Promokod:</b> <del>$code</del>
👤 <b>Foydalangan odam:</b> <a href='tg://user?id=$cid'>$cid</a>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"▶️ Botga kirish",'url'=>"https://t.me/$botname"]],
]])
]);
unlink("code.txt");
unlink("codemiq.txt"); 
}else{ 
bot('sendmessage',[ 
'chat_id'=>$cid, 
'text'=>"<b>⚠️ Bunday promokod topilmadi!</b>",
'parse_mode'=>"html",
]); 
}}}

if($data == "taklifnoma" and joinchat($ccid)=="true"){
$odam=file_get_contents("foydalanuvchi/referal/$ccid.txt");
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>🔗 Sizning taklif havolangiz:</b>

https://t.me/$botname?start=$ccid

<b>1 ta taklif uchun $taklifpul so'm beriladi

Sizning takliflaringiz: $odam ta</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"orqaga3"]],
]])
]);
}

if($tx=="$tugma4" and joinchat($fid)=="true"){
$karta1 = $kartanarx * 1;
$karta3 = $kartanarx * 3;
$karta7 = $kartanarx * 7;
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Karta sotib olish uchun narxlar bilan tanishing!</b>

🧩 <b>[1] dona karta</b> - $karta1 $pul
🧩 <b>[3] dona karta</b> - $karta3 $pul
🧩 <b>[7] dona karta</b> - $karta7 $pul

Quyidagilardan birini tanlang:",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🧩 [1]",'callback_data'=>"card-1-$karta1"],['text'=>"🧩 [3]",'callback_data'=>"card-3-$karta3"],['text'=>"🧩 [7]",'callback_data'=>"card-7-$karta7"]],
]])
]);
}

if($data=="sotib_olish" and joinchat($ccid)=="true"){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
$karta1 = $kartanarx * 1;
$karta3 = $kartanarx * 3;
$karta7 = $kartanarx * 7;
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>Karta sotib olish uchun narxlar bilan tanishing!</b>

🧩 <b>[1] dona karta</b> - $karta1 $pul
🧩 <b>[3] dona karta</b> - $karta3 $pul
🧩 <b>[7] dona karta</b> - $karta7 $pul

Quyidagilardan birini tanlang:",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🧩 [1]",'callback_data'=>"card-1-$karta1"],['text'=>"🧩 [3]",'callback_data'=>"card-3-$karta3"],['text'=>"🧩 [7]",'callback_data'=>"card-7-$karta7"]],
]])
]);
}

if(mb_stripos($data, "card-")!==false){
$ex = explode("-",$data);
$son = $ex[1];
$narx = $ex[2];
$get = file_get_contents("foydalanuvchi/hisob/$ccid.txt");
if($get < "$narx"){
bot("answerCallbackQuery",[
'callback_query_id'=>$callid,
'text'=>"⚠️ Mablag' yetarli emas!

Balansingiz: $get $pul",
'show_alert'=>true,
]);
}else{
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"✅<b> [$son] ta karta uchun to'lov muvaffaqiyatli yechildi!</b>",
'parse_mode'=>'html',
]);
$karta = file_get_contents("foydalanuvchi/hisob/$ccid.karta");
$plus = $karta + $son;
file_put_contents("foydalanuvchi/hisob/$ccid.karta", $plus);
$hisob = file_get_contents("foydalanuvchi/hisob/$ccid.txt");
$minus = $hisob - $narx;
file_put_contents("foydalanuvchi/hisob/$ccid.txt", $minus);
}}

if($tx=="$tugma5" and joinchat($fid)=="true"){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📝 Murojaat matnini yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]],
]])
]);
file_put_contents("step/$cid.txt","suport");
}

if($userstep=="suport"){
if($tx=="◀️ Orqaga"){
unlink("step/$cid.txt");
}else{
bot('sendMessage',[
'chat_id'=>$builder24,
'text'=>"<b>📨 Yangi murojat keldi:</b> <a href='tg://user?id=$cid'>$cid</a>

<b>📑 Murojat matni:</b> $tx

<b>⏰ Kelgan vaqti:</b> $soat",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"Javob yozish",'callback_data'=>"yozish=$cid"]],
]])
]);
}
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>✅ Murojaatingiz yuborildi.</b>

<i>Tez orada javob qaytaramiz!</i>",
'parse_mode'=>'html',
'reply_markup'=>$menyu,
]);
unlink("step/$cid.txt");
}

if(mb_stripos($data,"yozish=")!==false){
$odam=explode("=",$data)[1];
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>Javob matnini yuboring:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]],
]])
]);
file_put_contents("step/$ccid.txt","javob");
file_put_contents("step/$ccid.javob","$odam");
}

if($userstep=="javob"){
if($tx=="◀️ Orqaga"){
unlink("step/$cid.txt");
unlink("step/$cid.javob");
}else{
$murojat=file_get_contents("step/$cid.javob");
bot('sendMessage',[
'chat_id'=>$murojat,
'text'=>"<b>☎️ Administrator:</b>

$tx",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"Javob yozish",'callback_data'=>"boglanish"]],
]])
]);
bot('sendMessage',[
'chat_id'=>$builder24,
'text'=>"<b>Javob yuborildi</b>",
'parse_mode'=>"html",
'reply_markup'=>$menyu,
]);
unlink("step/$murojat.murojat");
unlink("step/$cid.txt");
unlink("step/$cid.javob");
}}
?>