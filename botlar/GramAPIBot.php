<?php
define('API_KEY',"LITE_TOKEN");

$builder24 = "LITE_ID";
$admins=file_get_contents("statistika/admins.txt");
$admin = explode("\n", $admins);
array_push($admin,$builder24);

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
}
}
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
exit();
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
$callfrid = $update->callback_query->from->id;
$botname = bot('getme',['bot'])->result->username;
#-----------------------------
mkdir("foydalanuvchi");
mkdir("foydalanuvchi/buyurtma");
mkdir("foydalanuvchi/referal");
mkdir("foydalanuvchi/hisob");
mkdir("sozlamalar/hamyon");
mkdir("foydalanuvchi/by");
mkdir("sozlamalar/kanal");
mkdir("sozlamalar/tugma");
mkdir("sozlamalar/matn");
mkdir("sozlamalar/pul");
mkdir("sozlamalar/bot");
mkdir("statistika");
mkdir("sozlamalar");
mkdir("buyurtma");
mkdir("step");
mkdir("ban");
#-----------------------------

if(!file_exists("foydalanuvchi/hisob/$fid.nak")){
file_put_contents("foydalanuvchi/hisob/$fid.nak","0");
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
if(!file_exists("sozlamalar/pul/api.txt")){
file_put_contents("sozlamalar/pul/api.txt","");
}
if(!file_exists("sozlamalar/pul/valyuta.txt")){
file_put_contents("sozlamalar/pul/valyuta.txt","so'm");
}
if(!file_exists("sozlamalar/tugma/xizson.txt")){
file_put_contents("sozlamalar/tugma/xizson.txt","3");
}
if(!file_exists("sozlamalar/tugma/ibyson.txt")){
file_put_contents("sozlamalar/tugma/ibyson.txt","1");
}
if(!file_exists("sozlamalar/tugma/byson.txt")){
file_put_contents("sozlamalar/tugma/byson.txt","1");
}
if(!file_exists("buyurtma/$fid.txt")){
file_put_contents("buyurtma/$fid.txt","");
}
if(!file_exists("sozlamalar/tugma/hamson.txt")){
file_put_contents("sozlamalar/tugma/hamson.txt","1");
}
if(!file_exists("sozlamalar/tugma/tugma1.txt")){
file_put_contents("sozlamalar/tugma/tugma1.txt","➕ Buyurtma berish");
}
if(!file_exists("sozlamalar/tugma/tugma2.txt")){
file_put_contents("sozlamalar/tugma/tugma2.txt","👔 Kabinet");
}
if(!file_exists("sozlamalar/tugma/tugma3.txt")){
file_put_contents("sozlamalar/tugma/tugma3.txt","💵 Pul yig'ish");
}
if(!file_exists("sozlamalar/tugma/tugma4.txt")){
file_put_contents("sozlamalar/tugma/tugma4.txt","📊 Buyurtmani kuzatish");
}
if(!file_exists("sozlamalar/tugma/tugma5.txt")){
file_put_contents("sozlamalar/tugma/tugma5.txt","📨 Yordam");
}
if(!file_exists("sozlamalar/tugma/tugma6.txt")){
file_put_contents("sozlamalar/tugma/tugma6.txt","📚 Bot haqida");
}
if(!file_exists("sozlamalar/tugma/tugma7.txt")){
file_put_contents("sozlamalar/tugma/tugma7.txt","🔗 Taklifnoma");
}
if(!file_exists("sozlamalar/tugma/tugma8.txt")){  
file_put_contents("sozlamalar/tugma/tugma8.txt","🎁 Kunlik bonus");
}
if(!file_exists("sozlamalar/tugma/tugma9.txt")){  
file_put_contents("sozlamalar/tugma/tugma9.txt","🎫 Promokod");
}
if(!file_exists("sozlamalar/matn/start.txt")){
file_put_contents("sozlamalar/matn/start.txt","🖥");
}
if(!file_exists("sozlamalar/matn/qoida.txt")){
file_put_contents("sozlamalar/matn/qoida.txt","<b>Muhum Qoidalari❗️</b>

<i>• Adminga yolgʻon xabar yubormang. Bu uchun botda ban olishingiz mumkin!

• Yordam boʻlimidan foydalanayotganda adminga haqiratli soʻz yozmang. Bu uchun botda ban olishingiz mumkin!

• Buyurtma berilgan linkning buyurtmasi bajarilmasdan oʻsha link uchun yana buyurtma bermang. Bu holdagi xatolik uchun sizga pul qaytarilmaydi!

• Admindan tekinga yoki savob uchun hisobingizni toʻldirishni soʻramang!

• Admin hamyoniga kiritilgan pullar yoki bot hisobidagi pullaringizni chiqarib yoki qaytarib ololmaysiz. Pul kirgizishda summa miqdoriga yaxshilan etibor bering!</i>

<b>Qoʻshimcha maʼlumotlar olish uchun admin bilan bogʻlaning.</b>");
}
if(!file_exists("sozlamalar/matn/qollama.txt")){
file_put_contents("sozlamalar/matn/qollama.txt","<b>Tez-tez beriladigan savollarga javoblar:</b>

⁉️ <b>$botname oʻzi qanday bot va nima vazifa bajaradi?</b>
✅ <i>$botname orqali oʻzingizni Kanal, guruh va profillaringiz obunachi, yoqtirish, koʻrish va boshqa kerakli xizmatlarini koʻpaytirish imkoniyatiga egasiz. Eng muhumi bularning barchasi tez, sifatli, ishonchli va hamyonbob boʻladi.</i>

⁉️ <b>Hisobimni qanday toʻldirsam boʻladi?</b>
✅ <i>Hisobingizni toʻldirish uchun botdagi [Hisobim] boʻlimiga kiring va [Pul kiritish] tugmasinu bosing. Oʻzingizga kerakli hamyonni tanlab toʻlov qiling. Toʻlov haqidagi soʻroʻvingiz 30daqiqa ichida koʻrib chiqiladi.</i>

⁉️ <b>Qanday qilib buyurtma berish mumkin?</b>
✅ <i>Buyurtma berish uchun [Buyurtma berish] boʻlimiga kiring. Oʻzingizga kerakli Ijtimoiy tarmoqni tanlang. Oʻzingizga kerakli boʻlimni tanlang soʻng kerakli xizmatni tanlab miqdor va havolani kiritish kifoya.</i>");
}
if(!file_exists("sozlamalar/kanal/ch.txt")){
file_put_contents("sozlamalar/kanal/ch.txt","");
}
if(!file_exists("sozlamalar/kanal/promo.txt")){
file_put_contents("sozlamalar/kanal/promo.txt","");
}
if(file_get_contents("statistika/obunachi.txt")){
} else{
file_put_contents("statistika/obunachi.txt", "0");
}
if(file_get_contents("statistika/admins.txt")){
}else{
if(file_put_contents("statistika/admins.txt","$builder24"));
}
if(!file_exists("statistika/id.txt")){
file_put_contents("statistika/id.txt","0");
}
if(!file_exists("sozlamalar/pul/bonmiq.txt")){  
file_put_contents("sozlamalar/pul/bonmiq.txt","100");
}
if(!file_exists("sozlamalar/pul/bonnom.txt")){  
file_put_contents("sozlamalar/pul/bonnom.txt","");
}
if(!file_exists("sozlamalar/kanal/promo.txt")){
file_put_contents("sozlamalar/kanal/promo.txt","");
}
$bonus=file_get_contents("sozlamalar/pul/bonmiq.txt");
$bonusnom=file_get_contents("sozlamalar/pul/bonnom.txt");

$kiritgan=file_get_contents("foydalanuvchi/hisob/$fid.1.txt");
$odamcha = file_get_contents("foydalanuvchi/referal/$fid.db");
$asosiy=file_get_contents("foydalanuvchi/hisob/$fid.txt");
$buyurtma=file_get_contents("buyurtma/$fid.txt");
$by=file_get_contents("foydalanuvchi/hisob/$fid.nak");
$api=file_get_contents("sozlamalar/pul/api.txt");
$pul = file_get_contents("sozlamalar/pul/valyuta.txt");
$taklifpul = file_get_contents("sozlamalar/pul/referal.txt");
$hamson = file_get_contents("sozlamalar/tugma/hamson.txt");
$byson = file_get_contents("sozlamalar/tugma/byson.txt");
$ibyson = file_get_contents("sozlamalar/tugma/ibyson.txt");
$xizson = file_get_contents("sozlamalar/tugma/xizson.txt");
$tugma1 = file_get_contents("sozlamalar/tugma/tugma1.txt");
$tugma2 = file_get_contents("sozlamalar/tugma/tugma2.txt");
$tugma3 = file_get_contents("sozlamalar/tugma/tugma3.txt");
$tugma4 = file_get_contents("sozlamalar/tugma/tugma4.txt");
$tugma5 = file_get_contents("sozlamalar/tugma/tugma5.txt");
$tugma6 = file_get_contents("sozlamalar/tugma/tugma6.txt");
$tugma7 = file_get_contents("sozlamalar/tugma/tugma7.txt");
$tugma8 = file_get_contents("sozlamalar/tugma/tugma8.txt");
$tugma9 = file_get_contents("sozlamalar/tugma/tugma9.txt");
$start = file_get_contents("sozlamalar/matn/start.txt");
$qoida = file_get_contents("sozlamalar/matn/qoida.txt");
$qollama = file_get_contents("sozlamalar/matn/qollama.txt");
$kanallar=file_get_contents("sozlamalar/kanal/ch.txt");
$promo=file_get_contents("sozlamalar/kanal/promo.txt");
#-----------------------------------#
$bolim = file_get_contents("sozlamalar/bot/kategoriya.txt");
$ichkibolim = file_get_contents("sozlamalar/bot/$bolim/ichkibolim.txt");
$ichki2bolim = file_get_contents("sozlamalar/bot/$ichkibolim/xizmatbolim.txt");
$type = file_get_contents("sozlamalar/bot/$kategoriya/$ichkibolim/$ichki2bolim/xizmat.txt");
$narx = file_get_contents("sozlamalar/bot/$kategoriya/$ichkibolim/$ichki2bolim/narx.txt");
$id = file_get_contents("sozlamalar/bot/$kategoriya/$ichkibolim/$ichki2bolim/id.txt");
$min = file_get_contents("sozlamalar/bot/$kategoriya/$ichkibolim/$ichki2bolim/min.txt");
$max = file_get_contents("sozlamalar/bot/$kategoriya/$ichkibolim/$ichki2bolim/max.txt");
#-----------------------------------#
$kategoriya = file_get_contents("sozlamalar/hamyon/kategoriya.txt");
$raqam = file_get_contents("sozlamalar/hamyon/$kategoriya/raqam.txt");
#-----------------------------------#

$saved = file_get_contents("step/odam.txt");
$ban = file_get_contents("ban/$fid.txt");
$statistika = file_get_contents("statistika/obunachi.txt");
$post = file_get_contents("step/mid.txt");
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
[['text'=>"$tugma4"]],
[['text'=>"$tugma5"],['text'=>"$tugma6"]],
]]);

$main_menuad = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"$tugma1"]],
[['text'=>"$tugma3"],['text'=>"$tugma2"]],
[['text'=>"$tugma4"]],
[['text'=>"$tugma5"],['text'=>"$tugma6"]],
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
'text'=>"Hisobingizga $taklifpul $pul qo'shildi!",
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
$odam = file_get_contents("foydalanuvchi/referal/$cid3.txt");
$b = $odam + 1;
file_put_contents("foydalanuvchi/hisob/$cid3.txt","$a");
file_put_contents("foydalanuvchi/referal/$cid3.txt","$b");
bot('SendMessage',[
'chat_id'=>$ccid,
'text'=>"$start",
'parse_mode'=>'html',
'reply_markup'=>$menyus,
]);
bot('SendMessage',[
'chat_id'=>$cid3,
'text'=>"Hisobingizga $taklifpul $pul qo'shildi!",
'parse_mode'=>'html',
]);
unlink("step/$ccid.id");
unlink("step/$ccid.cid");
}}}

$admin1_menu = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"⚙ Asosiy sozlamalar"]],
[['text'=>"📊 Statistika"],['text'=>"🛍 Xizmatlar"]],
[['text'=>"🔎 Foydalanuvchini boshqarish"]],
[['text'=>"👤 Adminlar"],['text'=>"🎟 Promokod"]],
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
[['text'=>"📢 Kanallar"],['text'=>"💳 Hamyonlar"]],
[['text'=>"🎁 Bonus sozlamalari"]],
[['text'=>"🔑 API sozlash"],['text'=>"⭐️ Bot dizayni"]],
[['text'=>"🗄 Boshqaruv"]],
]])
]);
}

if($tx=="⭐️ Bot dizayni" and in_array($cid,$admin)){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⭐️ Bot dizayni sozlamalari:</b>

<b>1. Bo'limlar qatori</b>: $byson ta
<b>2. Ichki bo'limlar qatori</b>: $ibyson ta
<b>3. Xizmatlar qatori</b>: $xizson ta
<b>4. Hamyonlar qatori</b>: $hamson ta",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"1",'callback_data'=>"byson"],['text'=>"2",'callback_data'=>"ibyson"],['text'=>"3",'callback_data'=>"xizson"],['text'=>"4",'callback_data'=>"hamson"]],
]])
]);
}

if($data=="botdizayn"){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>⭐️ Bot dizayni sozlamalari:</b>

<b>1. Bo'limlar qatori</b>: $byson ta
<b>2. Ichki bo'limlar qatori</b>: $ibyson ta
<b>3. Xizmatlar qatori</b>: $xizson ta
<b>4. Hamyonlar qatori</b>: $hamson ta",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"1",'callback_data'=>"byson"],['text'=>"2",'callback_data'=>"ibyson"],['text'=>"3",'callback_data'=>"xizson"],['text'=>"4",'callback_data'=>"hamson"]],
]])
]);
}

if($data=="byson"){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>Bo'limlar nechi qatordan bo'lishini hohlaysiz?</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"1⃣",'callback_data'=>"tah-byson-1"],['text'=>"2⃣",'callback_data'=>"tah-byson-2"],['text'=>"3⃣",'callback_data'=>"tah-byson-3"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"botdizayn"]],
]])
]);
}

if($data=="ibyson"){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>Ichki bo'limlar nechi qatordan bo'lishini hohlaysiz?</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"1⃣",'callback_data'=>"tah-ibyson-1"],['text'=>"2⃣",'callback_data'=>"tah-ibyson-2"],['text'=>"3⃣",'callback_data'=>"tah-ibyson-3"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"botdizayn"]],
]])
]);
}

if($data=="xizson"){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>Xizmatlar nechi qatordan bo'lishini hohlaysiz?</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"3⃣",'callback_data'=>"tah-xizson-3"],['text'=>"4⃣",'callback_data'=>"tah-xizson-4"],['text'=>"5⃣",'callback_data'=>"tah-xizson-5"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"botdizayn"]],
]])
]);
}

if($data=="hamson"){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>Hamyonlar nechi qatordan bo'lishini hohlaysiz?</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"1⃣",'callback_data'=>"tah-hamson-1"],['text'=>"2⃣",'callback_data'=>"tah-hamson-2"],['text'=>"3⃣",'callback_data'=>"tah-hamson-3"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"botdizayn"]],
]])
]);
}

if(mb_stripos($data, "tah-")!==false){
$ex = explode("-",$data);
$file = $ex[1];
$son = $ex[2];
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"botdizayn"]],
]])
]);
file_put_contents("sozlamalar/tugma/$file.txt","$son");
}

if($tx=="🎁 Bonus sozlamalari" and in_array($cid,$admin)){
$bonusbor = file_get_contents("sozlamalar/pul/bonnom.txt","$tugma8");
if($bonusbor){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🎁 Kunlik bonus sozlamalari

Bonus miqdori:</b> $bonus $pul
<b>Bonus olish vaqti:</b> 24 soat

<b>Status:</b> Yoqilgan",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🎁 Bonus miqdorini sozlash",'callback_data'=>"bonus_miqdor"]],
[['text'=>"💡 Status (O'chirish)",'callback_data'=>"bonus_ochirish"]],
]])
]);
}else{
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🎁 Kunlik bonus sozlamalari

Bonus miqdori:</b> $bonus $pul
<b>Bonus olish vaqti:</b> 24 soat

<b>Status:</b> O'chirilgan",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🎁 Bonus miqdorini sozlash",'callback_data'=>"bonus_miqdor"]],
[['text'=>"💡 Status (Yoqish)",'callback_data'=>"bonus_yoqish"]],
]])
]);
}}

if($data=="bonus_ochirish"){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>Bonus olish uchun ruxsat statusi o'zgartirildi.</b>

Yangi status: O'chirildi",
'parse_mode'=>"html",
]);
unlink("sozlamalar/pul/bonnom.txt");
}

if($data=="bonus_yoqish"){
file_put_contents("sozlamalar/pul/bonnom.txt","$tugma8");
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>Bonus olish uchun ruxsat statusi o'zgartirildi.</b>

Yangi status: Yoqildi",
'parse_mode'=>"html",
]);
}

if($data=="bonus_miqdor"){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>📝 Yangi miqdorini yuboring:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqaruv"]],
]])
]);
file_put_contents("step/$ccid.txt","bonus");
}
if($userstep == "bonus"){
if($tx=="🗄 Boshqaruv"){
unlink("step/$cid.txt");
}else{
file_put_contents("sozlamalar/pul/bonmiq.txt","$tx");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
'parse_mode'=>"html",
'reply_markup'=>$admin1_menu,
]);
unlink("step/$cid.txt");
}}

if($tx=="🔑 API sozlash" and in_array($cid,$admin)){
if($api==null){
$ap1="<b>kiritilmagan</b>";
$apt="🆕 APIni kiritish";
}else{
$ap1 = "<code>$api</code>"; 
$apt="🆕 APIni almashtirish";
}
$balance= json_decode(file_get_contents("https://gramapi.uz/api/v2?key=$api&action=balance"),true);
$valyuta=$balance['currency'];
if($balance['balance']==null){
$balans = "Mavjud emas";
}else{
$balans = "".$balance['balance']." $valyuta";
}
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"📄<b> API ma'lumotlari:</b>
➖➖➖➖➖➖➖➖➖➖➖
<b>API kalit:</b>
$ap1

<b>API balans:</b>
$balans
➖➖➖➖➖➖➖➖➖➖➖
<i>Quyidagilardan birini tanlang:</i>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"$apt",'callback_data'=>"yangiapi"]],
]])
]);
}

if($data=="yangiapi"){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>@GramAPIBot dan olingan APIni yuboring:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqaruv"]],
]])
]);
file_put_contents("step/$ccid.txt","api");
}
if($userstep == "api"){
if($tx=="🗄 Boshqaruv"){
unlink("step/$cid.txt");
}else{
$balance= json_decode(file_get_contents("https://gramapi.uz/api/v2?key=$text&action=balance"),true);
$valyuta=$balance['currency'];
if($balance['balance']==null){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>@GramAPIBot dan olingan APIni yuboring:</b>",
'parse_mode'=>"html",
]);
}else{
file_put_contents("sozlamalar/pul/api.txt","$tx");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>API kalit qabul qilindi!

API balans:</b> ".$balance['balance']." $valyuta",
'parse_mode'=>"html",
'reply_markup'=>$admin1_menu,
]);
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
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"<b>Xabar yuborish boshlandi!</b>",
'parse_mode'=>"html",
'reply_markup'=>$admin1_menu,
]);
$odam = explode("\n",$statistika);
foreach($odam as $odamlar){
$usr=bot("sendMessage",[
'chat_id'=>$odamlar,
'text'=>$text,
'parse_mode'=>'HTML'
]);
unlink("step/$cid.txt");
}}}
if($usr){
$odam=substr_count($statistika,"\n");
bot("sendmessage",[
'chat_id'=>$admin,
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
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"<b>Xabar yuborish boshlandi!</b>",
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
'chat_id'=>$admin,
'text'=>"<b>$odam ta foydalanuvchiga muvaffaqiyatli yuborildi</b>",
'parse_mode'=>'html',
'reply_markup'=>$admin1_menu,
]);
unlink("step/$cid.txt");
}

if($tx=="📨 Xabarnoma" and in_array($cid,$admin)){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📨 Yuboriladigan xabar turini tanlang:</b>",
'parse_mode'=>"html",
'reply_markup'=> json_encode([
'inline_keyboard'=>[
[['text'=>"Oddiy xabar",'callback_data'=>"oddiy_xabar"]],
[['text'=>"Forward xabar",'callback_data'=>"forward_xabar"]],
]])
]);
}
if($tx == "🛍 Xizmatlar" and in_array($cid,$admin)){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📁 Bo'limlarni sozlash",'callback_data'=>"kategoriya"]],
[['text'=>"📁 Ichki bo'lim sozlash",'callback_data'=>"ichkibolim"]],
[['text'=>"🛍 Xizmatlarni sozlash",'callback_data'=>"xizmatlar"]],
[['text'=>"🗑 Barchasini tozalash",'callback_data'=>"toza"]],
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
'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📁 Bo'limlarni sozlash",'callback_data'=>"kategoriya"]],
[['text'=>"📁 Ichki bo'lim sozlash",'callback_data'=>"ichkibolim"]],
[['text'=>"🛍 Xizmatlarni sozlash",'callback_data'=>"xizmatlar"]],
[['text'=>"🗑 Barchasini tozalash",'callback_data'=>"toza"]],
]])
]);
}

if($data == "toza"){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>⚠️ Ushbu holatda xizmatlarni tozalasangiz, keyinchalik qayta tiklab bo'lmaydi</b>

Shu bilan birgalikda bo'lim, ichki bo'lim va xizmatlar barchasi o'chiriladi!",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✅ Tasdiqlash",'callback_data'=>"barcha2"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"bbosh"]],
]])
]);
}

if($data=="barcha2"){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>Barcha malumotlar tozlalandi</b>",
'parse_mode'=>"html",
]);
deleteFolder("sozlamalar/bot/");
}

if($data == "kategoriya"){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Bo'lim qo'shish",'callback_data'=>"AdKat"]],
[['text'=>"📝 Tahrirlash",'callback_data'=>"tahrirlash"]],
[['text'=>"🗑 O'chirish",'callback_data'=>"ochirish"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"bbosh"]]
]])
]);
}

if($data == "AdKat"){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>Yangi bo'lim nomini yuboring</b>",
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
$bolim = file_get_contents("sozlamalar/bot/kategoriya.txt");
file_put_contents("sozlamalar/bot/kategoriya.txt","$bolim\n$text");
mkdir("sozlamalar/bot/$text");
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>$text - nomli bo'lim qo'shildi</b>",
'parse_mode'=>'html',
'reply_markup'=>$admin1_menu,
]);
unlink("step/$cid.txt");
}}

if($data == "tahrirlash"){
$more = explode("\n",$bolim);
$soni = substr_count($bolim,"\n");
$keys=[];
for ($for = 1; $for <= $soni; $for++) {
$keys[]=["text"=>"$more[$for]","callback_data"=>"tahrir-".$more[$for]];
$keysboard2 = array_chunk($keys, $byson);
$keysboard2[] = [['text'=>"◀️ Orqaga",'callback_data'=>"kategoriya"]];
$key = json_encode([
'inline_keyboard'=>$keysboard2,
]);
}
if($bolim != null){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$key,
]);
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$callid,
'text'=>"🔒 Bo'limlar mavjud emas!",
'show_alert'=>true,
]);
}}

if(mb_stripos($data, "tahrir-")!==false){
$kat = explode("-",$data)[1];
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>Yangi qiymatni yuboring:</b>",
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
$kat = explode("-",$userstep)[1];
$a = str_replace($kat,$text,$bolim);
file_put_contents("sozlamalar/bot/kategoriya.txt",$a);
rename("sozlamalar/bot/$kat","sozlamalar/bot/$text");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$admin1_menu,
]);
unlink("step/$cid.txt");
}}

if($data == "ochirish"){
$more = explode("\n",$bolim);
$soni = substr_count($bolim,"\n");
$keys=[];
for ($for = 1; $for <= $soni; $for++) {
$keys[]=["text"=>"$more[$for]","callback_data"=>"delKat-".$more[$for]];
$keysboard2 = array_chunk($keys, $byson);
$keysboard2[] = [['text'=>"◀️ Orqaga",'callback_data'=>"kategoriya"]];
$key = json_encode([
'inline_keyboard'=>$keysboard2,
]);
}
if($bolim != null){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>🗑 O'chirish uchun bo'limni tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$key,
]);
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$callid,
'text'=>"🔒 Bo'limlar mavjud emas!",
'show_alert'=>true,
]);
}}

if(mb_stripos($data, "delKat-")!==false){
$ex = explode("-",$data);
$kat = $ex[1];
$k = str_replace("\n".$kat."","",$bolim);
file_put_contents("sozlamalar/bot/kategoriya.txt",$k);
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>$kat - nomli bo'lim o'chirildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$admin1_menu,
]);
deleteFolder("sozlamalar/bot/$kat");
}

if($data == "ichkibolim"){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Ichki bo'lim qo'shish",'callback_data'=>"Adichki"]],
[['text'=>"📝 Tahrirlash",'callback_data'=>"tahririchki"]],
[['text'=>"🗑 O'chirish",'callback_data'=>"ochirishichki"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"bbosh"]]
]])
]);
}

if($data == "Adichki"){
$more = explode("\n",$bolim);
$soni = substr_count($bolim,"\n");
$keys=[];
for ($for = 1; $for <= $soni; $for++) {
$ichida = file_get_contents("sozlamalar/bot/".$more[$for]."/ichkibolim.txt");
$ta = substr_count($ichida,"\n");
$keys[]=["text"=>"$more[$for] $ta->","callback_data"=>"adim-".$more[$for]];
$keysboard2 = array_chunk($keys, $byson);
$keysboard2[] = [['text'=>"◀️ Orqaga",'callback_data'=>"ichkibolim"]];
$key = json_encode([
'inline_keyboard'=>$keysboard2,
]);
}
if($bolim != null){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$key,
]);
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$callid,
'text'=>"🔒 Bo'limlar mavjud emas!",
'show_alert'=>true,
]);
}}

if(mb_stripos($data, "adim-")!==false){
$ex = explode("-",$data);
$kat = $ex[1];
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>$kat tanlandi</b>

📝 Ichki bo'lim nomini yuboring:",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqaruv"]],
]])
]);
file_put_contents("step/$ccid.txt","ichkibolimnomi-$kat");
}

if(mb_stripos($userstep, "ichkibolimnomi-")!==false){
$ex = explode("-",$userstep);
$kat = $ex[1];
if($tx=="🗄 Boshqaruv"){
unlink("step/$cid.txt");
}else{
$royxat = file_get_contents("sozlamalar/bot/$kat/ichkibolim.txt");
file_put_contents("sozlamalar/bot/$kat/ichkibolim.txt","$royxat\n$text");
mkdir("sozlamalar/bot/$kat/$text");
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>$text - nomli ichki bo'lim qo'shildi</b>",
'parse_mode'=>'html',
'reply_markup'=>$admin1_menu,
]);
unlink("step/$cid.txt");
}}

if($data == "tahririchki"){
$more = explode("\n",$bolim);
$soni = substr_count($bolim,"\n");
$keys=[];
for ($for = 1; $for <= $soni; $for++) {
$ichida = file_get_contents("sozlamalar/bot/".$more[$for]."/ichkibolim.txt");
$ta = substr_count($ichida,"\n");
$keys[]=["text"=>"$more[$for] $ta->","callback_data"=>"tahmich-".$more[$for]];
$keysboard2 = array_chunk($keys, $byson);
$keysboard2[] = [['text'=>"◀️ Orqaga",'callback_data'=>"ichkibolim"]];
$key = json_encode([
'inline_keyboard'=>$keysboard2,
]);
}
if($bolim != null){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$key,
]);
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$callid,
'text'=>"🔒 Bo'limlar mavjud emas!",
'show_alert'=>true,
]);
}}

if(mb_stripos($data, "tahmich-")!==false){
$ex = explode("-",$data);
$kat = $ex[1];
file_put_contents("step/$ccid.bol","$kat");
$ichkibolim = file_get_contents("sozlamalar/bot/$kat/ichkibolim.txt");
$more = explode("\n",$ichkibolim);
$soni = substr_count($ichkibolim,"\n");
$keys=[];
for ($for = 1; $for <= $soni; $for++) {
$keys[]=["text"=>"$more[$for]","callback_data"=>"tahichk-".$more[$for]];
$keysboard2 = array_chunk($keys, $ibyson);
$keysboard2[] = [['text'=>"◀️ Orqaga",'callback_data'=>"tahririchki"]];
$key = json_encode([
'inline_keyboard'=>$keysboard2,
]);
}
if($ichkibolim != null){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>📝 Tahrirlash uchun birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$key,
]);
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$callid,
'text'=>"🔒 Ichki bo'limlar mavjud emas!",
'show_alert'=>true,
]);
}}

if(mb_stripos($data, "tahichk-")!==false){
$ex = explode("-",$data);
$roy = $ex[1];
$kat = file_get_contents("step/$ccid.bol");
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>Yangi qiymatni yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqaruv"]],
]])
]);
file_put_contents("step/$ccid.txt","tahririchki2-$kat-$roy");
}

if(mb_stripos($userstep, "tahririchki2-")!==false){
if($tx=="🗄 Boshqaruv"){
unlink("step/$cid.txt");
}else{
$kat = explode("-",$userstep)[1];
$roy = explode("-",$userstep)[2];
$ichki=file_get_contents("sozlamalar/bot/$kat/ichkibolim.txt");
$a = str_replace("$roy", "$text", $ichki);
file_put_contents("sozlamalar/bot/$kat/ichkibolim.txt",$a);
rename("sozlamalar/bot/$kat/$roy","sozlamalar/bot/$kat/$text");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$admin1_menu,
]);
unlink("step/$cid.txt");
}}

if($data == "ochirishichki"){
$more = explode("\n",$bolim);
$soni = substr_count($bolim,"\n");
$keys=[];
for ($for = 1; $for <= $soni; $for++) {
$ichida = file_get_contents("sozlamalar/bot/".$more[$for]."/ichkibolim.txt");
$ta = substr_count($ichida,"\n");
$keys[]=["text"=>"$more[$for] $ta->","callback_data"=>"deltanich-".$more[$for]];
$keysboard2 = array_chunk($keys, $byson);
$keysboard2[] = [['text'=>"◀️ Orqaga",'callback_data'=>"ichkibolim"]];
$key = json_encode([
'inline_keyboard'=>$keysboard2,
]);
}
if($bolim != null){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$key,
]);
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$callid,
'text'=>"🔒 Bo'limlar mavjud emas!",
'show_alert'=>true,
]);
}}

if(mb_stripos($data, "deltanich-")!==false){
$ex = explode("-",$data);
$kat = $ex[1];
file_put_contents("step/$ccid.bol","$kat");
$royxat = file_get_contents("sozlamalar/bot/$kat/ichkibolim.txt");
$more = explode("\n",$royxat);
$soni = substr_count($royxat,"\n");
$keys=[];
for ($for = 1; $for <= $soni; $for++) {
$title=str_replace("\n","",$more[$for]);
$keys[]=["text"=>"$more[$for]","callback_data"=>"deleteich-".$more[$for]];
$keysboard2 = array_chunk($keys, $ibyson);
$keysboard2[] = [['text'=>"◀️ Orqaga",'callback_data'=>"ochirishichki"]];
$key = json_encode([
'inline_keyboard'=>$keysboard2,
]);
}
if($bolim != null){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>🗑 O'chirish uchun birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$key,
]);
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$callid,
'text'=>"🔒 Ichki bo'limlar mavjud emas!",
'show_alert'=>true,
]);
}}

if(mb_stripos($data, "deleteich-")!==false){
$ex = explode("-",$data);
$roy = $ex[1];
$kat = file_get_contents("step/$ccid.bol");
$royxat = file_get_contents("sozlamalar/bot/$kat/ichkibolim.txt");
$k = str_replace("\n".$roy."","",$royxat);
file_put_contents("sozlamalar/bot/$kat/ichkibolim.txt",$k);
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>$roy - nomli ichki bo'lim o'chirildi</b>",
'parse_mode'=>'html',
'reply_markup'=>$admin1_menu,
]);
deleteFolder("sozlamalar/bot/$kat/$roy");
}

if($data == "xizmatlar"){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Xizmat qo'shish",'callback_data'=>"adxiz"]],
[['text'=>"📝 Tahrirlash",'callback_data'=>"xiztah"]],
[['text'=>"🗑 O'chirish",'callback_data'=>"xizochir"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"bbosh"]]
]])
]);
}

if($data == "xizochir"){
$more = explode("\n",$bolim);
$soni = substr_count($bolim,"\n");
$keys=[];
for ($for = 1; $for <= $soni; $for++) {
$ichida = file_get_contents("sozlamalar/bot/".$more[$for]."/ichkibolim.txt");
$ta = substr_count($ichida,"\n");
$keys[]=["text"=>"$more[$for] $ta->","callback_data"=>"xizdel-".$more[$for]];
$keysboard2 = array_chunk($keys, $byson);
$keysboard2[] = [['text'=>"◀️ Orqaga",'callback_data'=>"xizmatlar"]];
$key = json_encode([
'inline_keyboard'=>$keysboard2,
]);
}
if($bolim != null){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$key,
]);
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$callid,
'text'=>"🔒 Bo'limlar mavjud emas!",
'show_alert'=>true,
]);
}}

if(mb_stripos($data, "xizdel-")!==false){
$ex = explode("-",$data);
$kat = $ex[1];
$royxat = file_get_contents("sozlamalar/bot/$kat/ichkibolim.txt");
file_put_contents("step/$ccid.bol","$kat");
$more = explode("\n",$royxat);
$soni = substr_count($royxat,"\n");
$keys=[];
for ($for = 1; $for <= $soni; $for++) {
$ichida = file_get_contents("sozlamalar/bot/$kat/".$more[$for]."/xizmatbolim.txt");
$ta = substr_count($ichida,"\n");
$keys[]=["text"=>"$more[$for] $ta->","callback_data"=>"delochir-".$more[$for]];
$keysboard2 = array_chunk($keys, $ibyson);
$keysboard2[] = [['text'=>"◀️ Orqaga",'callback_data'=>"xizochir"]];
$key = json_encode([
'inline_keyboard'=>$keysboard2,
]);
}
if($royxat != null){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$key,
]);
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$callid,
'text'=>"🔒 Ichki bo'limlar mavjud emas!",
'show_alert'=>true,
]);
}}

if(mb_stripos($data, "delochir-")!==false){
$ex = explode("-",$data);
$roy = $ex[1];
$kat = file_get_contents("step/$ccid.bol");
file_put_contents("step/$ccid.ich","$roy");
$royxat = file_get_contents("sozlamalar/bot/$kat/$roy/xizmatbolim.txt");
$ids = explode("\n",$royxat);
$soni = substr_count($royxat,"\n");
foreach($ids as $id){
$key = [];
$text = "";
for ($for = 1; $for <= $soni; $for++) {
$text .= "<b>$for</b> ".$ids[$for]."\n";
$key[]=["text"=>"$for","callback_data"=>"deletexiz-".$ids[$for]];
}
$keysboard2 = array_chunk($key, $xizson);
$keysboard2[] = [['text'=>"◀️ Orqaga",'callback_data'=>"xizdel-$kat"]];
$key = json_encode([
'inline_keyboard'=>$keysboard2,
]);
}
if($royxat != null){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"🗑 <b>O'chiriladigan xizmatni tanlang:</b>

$text",
'parse_mode'=>'html',
'reply_markup'=>$key,
]);
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$callid,
'text'=>"🔒 Ichki bo'limlar mavjud emas!",
'show_alert'=>true,
]);
}}

if(mb_stripos($data, "deletexiz-")!==false){
$ex = explode("-",$data);
$xiz = $ex[1];
$roy = file_get_contents("step/$ccid.ich");
$kat = file_get_contents("step/$ccid.bol");
$royxat = file_get_contents("sozlamalar/bot/$kat/$roy/xizmatbolim.txt");
$k = str_replace("\n".$xiz."","",$royxat);
file_put_contents("sozlamalar/bot/$kat/$roy/xizmatbolim.txt",$k);
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>$xiz - nomli xizmat o'chirildi</b>",
'parse_mode'=>'html',
'reply_markup'=>$admin1_menu,
]);
deleteFolder("sozlamalar/bot/$kat/$roy/$xiz");
}

if($data == "xiztah"){
$more = explode("\n",$bolim);
$soni = substr_count($bolim,"\n");
$keys=[];
for ($for = 1; $for <= $soni; $for++) {
$ichida = file_get_contents("sozlamalar/bot/".$more[$for]."/ichkibolim.txt");
$ta = substr_count($ichida,"\n");
$keys[]=["text"=>"$more[$for] $ta->","callback_data"=>"tanla-".$more[$for]];
$keysboard2 = array_chunk($keys, $byson);
$keysboard2[] = [['text'=>"◀️ Orqaga",'callback_data'=>"xizmatlar"]];
$key = json_encode([
'inline_keyboard'=>$keysboard2,
]);
}
if($bolim != null){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$key,
]);
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$callid,
'text'=>"🔒 Bo'limlar mavjud emas!",
'show_alert'=>true,
]);
}}

if(mb_stripos($data, "tanla-")!==false){
$ex = explode("-",$data);
$kat = $ex[1];
file_put_contents("step/$ccid.bol","$kat");
$royxat = file_get_contents("sozlamalar/bot/$kat/ichkibolim.txt");
$more = explode("\n",$royxat);
$soni = substr_count($royxat,"\n");
$keys=[];
for ($for = 1; $for <= $soni; $for++) {
$ichida = file_get_contents("sozlamalar/bot/$kat/".$more[$for]."/xizmatbolim.txt");
$ta = substr_count($ichida,"\n");
$keys[]=["text"=>"$more[$for] $ta->","callback_data"=>"tanxiz-".$more[$for]];
$keysboard2 = array_chunk($keys, $ibyson);
$keysboard2[] = [['text'=>"◀️ Orqaga",'callback_data'=>"xiztah"]];
$key = json_encode([
'inline_keyboard'=>$keysboard2,
]);
}
if($royxat != null){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$key,
]);
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$callid,
'text'=>"🔒 Ichki bo'limlar mavjud emas!",
'show_alert'=>true,
]);
}}

if(mb_stripos($data, "tanxiz-")!==false){
$ex = explode("-",$data);
$kat = file_get_contents("step/$ccid.bol");
$roy = $ex[1];
file_put_contents("step/$ccid.ich","$ich");
$royxat = file_get_contents("sozlamalar/bot/$kat/$roy/xizmatbolim.txt");
$ids = explode("\n",$royxat);
$soni = substr_count($royxat,"\n");
foreach($ids as $id){
$key = [];
$text = "";
for ($for = 1; $for <= $soni; $for++) {
$text .= "<b>$for.</b> ".$ids[$for]."\n";
$key[]=["text"=>"$for","callback_data"=>"tahrirla-".$ids[$for]];
}
$keysboard2 = array_chunk($key, $xizson);
$keysboard2[] = [['text'=>"◀️ Orqaga",'callback_data'=>"tanla-$kat"]];
$key = json_encode([
'inline_keyboard'=>$keysboard2,
]);
}
if($royxat != null){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"📋 <b>Kerakli xizmatni tanlang:</b>

$text",
'parse_mode'=>'html',
'reply_markup'=>$key,
]);
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$callid,
'text'=>"🔒 Xizmatlar mavjud emas!",
'show_alert'=>true,
]);
}}

if(mb_stripos($data, "tahrirla-")!==false){
$ex = explode("-",$data);
$kat = file_get_contents("step/$ccid.bol");
$roy = file_get_contents("step/$ccid.ich");
$xiz = $ex[1];
$xizmat = file_get_contents("sozlamalar/bot/$kat/$roy/$xiz/xizmat.txt");
$narx = file_get_contents("sozlamalar/bot/$kat/$roy/$xiz/narx.txt");
$min = file_get_contents("sozlamalar/bot/$kat/$roy/$xiz/min.txt");
$max = file_get_contents("sozlamalar/bot/$kat/$roy/$xiz/max.txt");
$id = file_get_contents("sozlamalar/bot/$kat/$roy/$xiz/id.txt");
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b><u>🔑 Xizmat IDsi:</u></b> $id

<b><u>📝 Xizmat nomi:</u></b> $xizmat
<b><u>💵 Narxi (1000x):</u></b> $narx $pul

<b><u>🔽 Minimal buyurtma:</u></b> $min ta
<b><u>🔼 Maksimal buyurtma:</u></b> $max ta",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📝 Nomni tahrirlash",'callback_data'=>"nomi-".$xiz]],
[['text'=>"📝 IDni tahrirlash",'callback_data'=>"editBot-id-".$xiz],['text'=>"📝 Narxni tahrirlash",'callback_data'=>"editBot-narx-".$xiz]],
[['text'=>"📝 Min. tahrirlash",'callback_data'=>"editBot-min-".$xiz],['text'=>"📝 Max. tahrirlash",'callback_data'=>"editBot-max-".$xiz]],
[['text'=>"◀️ Orqaga",'callback_data'=>"tanxiz-$kat-$roy"]]
]])
]);
}

if(mb_stripos($data, "nomi-")!==false){
$kat = file_get_contents("step/$ccid.bol");
$roy = file_get_contents("step/$ccid.ich");
$xiz = explode("-",$data)[1];
$holat = file_get_contents("sozlamalar/bot/$kat/$roy/$xiz/xizmat.txt");
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
file_put_contents("step/$ccid.txt","editnomi-xizmat-$kat-$roy-$xiz");
}

if(mb_stripos($userstep, "editnomi-")!==false){
if($tx=="🗄 Boshqaruv"){
unlink("step/$cid.txt");
}else{
$ex = explode("-",$userstep)[1];
$kat = explode("-",$userstep)[2];
$roy = explode("-",$userstep)[3];
$xiz = explode("-",$userstep)[4];
$ichki=file_get_contents("sozlamalar/bot/$kat/$roy/xizmatbolim.txt");
$a = str_replace("$roy", "$text", $ichki);
file_put_contents("sozlamalar/bot/$kat/$roy/xizmatbolim.txt",$a);
file_put_contents("sozlamalar/bot/$kat/$roy/$xiz/xizmat.txt",$text);
rename("sozlamalar/bot/$kat/$roy/$xiz","sozlamalar/bot/$kat/$roy/$text");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$admin1_menu,
]);
unlink("step/$cid.txt");
}}

if(mb_stripos($data, "editBot-")!==false){
$ex = explode("-",$userstep)[1];
$kat = file_get_contents("step/$ccid.bol");
$roy = file_get_contents("step/$ccid.ich");
$xiz = explode("-",$userstep)[2];
$holat = file_get_contents("sozlamalar/bot/$kat/$roy/$xiz/$ex.txt");
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
file_put_contents("step/$ccid.txt","editBot-$ex-$kat-$roy-$xiz");
}

if(mb_stripos($userstep, "editBot-")!==false){
if($tx=="🗄 Boshqaruv"){
unlink("step/$cid.txt");
}else{
if(isset($text)){
$ex = explode("-",$userstep)[1];
$kat = explode("-",$userstep)[2];
$roy = explode("-",$userstep)[3];
$xiz = explode("-",$userstep)[4];
file_put_contents("sozlamalar/bot/$kat/$roy/$xiz/$ex.txt",$text);
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

if($data == "adxiz"){
$bolim = file_get_contents("sozlamalar/bot/kategoriya.txt");
$more = explode("\n",$bolim);
$soni = substr_count($bolim,"\n");
$keys=[];
for ($for = 1; $for <= $soni; $for++) {
$ichida = file_get_contents("sozlamalar/bot/".$more[$for]."/ichkibolim.txt");
$ta = substr_count($ichida,"\n");
$keys[]=["text"=>"$title $ta->","callback_data"=>"addb-".$more[$for]];
$keysboard2 = array_chunk($keys, $byson);
$keysboard2[] = [['text'=>"◀️ Orqaga",'callback_data'=>"bbosh"]];
$AdBot = json_encode([
'inline_keyboard'=>$keysboard2,
]);
}

if($bolim != null){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$AdBot,
]);
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$callid,
'text'=>"🔒 Bo'limlar mavjud emas!",
'show_alert'=>true,
]);
}}

if(mb_stripos($data, "addb-")!==false){
$ex = explode("-",$data);
$kat = $ex[1];
$bolim = file_get_contents("sozlamalar/bot/$kat/ichkibolim.txt");
$more = explode("\n",$bolim);
$soni = substr_count($bolim,"\n");
$keys=[];
for ($for = 1; $for <= $soni; $for++) {
$ichida = file_get_contents("sozlamalar/bot/$kat/".$more[$for]."/xizmatbolim.txt");
$ta = substr_count($ichida,"\n");
$keys[]=["text"=>"$more[$for] $ta->","callback_data"=>"addxiz-".$more[$for]."-".$kat];
$keysboard2 = array_chunk($keys, $ibyson);
$keysboard2[] = [['text'=>"◀️ Orqaga",'callback_data'=>"xizmatlar"]];
$AdBot = json_encode([
'inline_keyboard'=>$keysboard2,
]);
}

if($bolim != null){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$AdBot,
]);
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$callid,
'text'=>"🔒 Ichki bo'limlar mavjud emas!",
'show_alert'=>true,
]);
}}

if(mb_stripos($data, "addxiz-")!==false){
$ex = explode("-",$data);
$roy =$ex[1];
$kat = $ex[2];
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>✅ Ichki bo'lim tanlandi</b>

📝 Xizmat nomini yuboring:",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqaruv"]],
]])
]);
file_put_contents("step/$ccid.txt","xizmatnomi-$kat-$roy");
}

if(mb_stripos($userstep, "xizmatnomi-")!==false){
$ex = explode("-",$userstep);
$kat = $ex[1];
$roy =$ex[2];
if($tx=="🗄 Boshqaruv"){
unlink("step/$cid.txt");
}else{
$royxat = file_get_contents("sozlamalar/bot/$kat/$roy/xizmatbolim.txt");
file_put_contents("sozlamalar/bot/$kat/$roy/xizmatbolim.txt","$royxat\n$text");
mkdir("sozlamalar/bot/$kat/$roy/$text");
file_put_contents("sozlamalar/bot/$kat/$roy/$text/xizmat.txt",$text);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"$text <b>nomi qabul qilindi.</b>

📝 Xizmat ID raqamini yuboring:",
'parse_mode'=>'html',
]);
file_put_contents("step/$cid.txt","xizmatid-$kat-$roy-$text");
}}

if(mb_stripos($userstep, "xizmatid-")!==false){
$ex = explode("-",$userstep);
$kat = $ex[1];
$roy = $ex[2];
$xiz = $ex[3];
if($tx=="🗄 Boshqaruv"){
unlink("step/$cid.txt");
unlink("sozlamalar/bot/$kat/$roy/$xiz");
$royxat = file_get_contents("sozlamalar/bot/$kat/$roy/xizmatbolim.txt");
$k = str_replace("\n".$xiz."","",$royxat);
file_put_contents("sozlamalar/bot/$kat/$roy/xizmatbolim.txt",$k);
}else{
if(is_numeric($text)==true){
file_put_contents("sozlamalar/bot/$kat/$roy/$xiz/id.txt",$text);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>$text qabul qilindi</b>

📝 Xizmat narxini yuboring:",
'parse_mode'=>'html',
]);
file_put_contents("step/$cid.txt","xizmatnarx-$kat-$roy-$xiz");
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⚠️ Faqat raqamlardan foydalaning!</b>",
'parse_mode'=>'html',
]);
}}}

if(mb_stripos($userstep, "xizmatnarx-")!==false){
$ex = explode("-",$userstep);
$kat = $ex[1];
$roy = $ex[2];
$xiz = $ex[3];
if($tx=="🗄 Boshqaruv"){
unlink("step/$cid.txt");
unlink("sozlamalar/bot/$kat/$roy/$xiz");
$royxat = file_get_contents("sozlamalar/bot/$kat/$roy/xizmatbolim.txt");
$k = str_replace("\n".$xiz."","",$royxat);
file_put_contents("sozlamalar/bot/$kat/$roy/xizmatbolim.txt",$k);
}else{
if(is_numeric($text)==true){
file_put_contents("sozlamalar/bot/$kat/$roy/$xiz/narx.txt",$text);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>$text $pul narxi qabul qilindi</b>

📝 Buyurtma (min) miqdorini yuboring:",
'parse_mode'=>'html',
]);
file_put_contents("step/$cid.txt","xizmatmin-$kat-$roy-$xiz");
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⚠️ Faqat harflardan foydalaning!</b>",
'parse_mode'=>'html',
]);
}}}

if(mb_stripos($userstep, "xizmatmin-")!==false){
$ex = explode("-",$userstep);
$kat = $ex[1];
$roy = $ex[2];
$xiz = $ex[3];
if($tx=="🗄 Boshqaruv"){
unlink("step/$cid.txt");
unlink("sozlamalar/bot/$kat/$roy/$xiz");
$royxat = file_get_contents("sozlamalar/bot/$kat/$roy/xizmatbolim.txt");
$k = str_replace("\n".$xiz."","",$royxat);
file_put_contents("sozlamalar/bot/$kat/$roy/$xiz/xizmatbolim.txt",$k);
}else{
if(is_numeric($text)==true){
file_put_contents("sozlamalar/bot/$kat/$roy/$xiz/min.txt",$text);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>$text ta qabul qilindi</b>

📝 Buyurtma (max) miqdorini yuboring:",
'parse_mode'=>'html',
]);
file_put_contents("step/$cid.txt","xizmatmax-$kat-$roy-$xiz");
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⚠️ Faqat raqamlardan foydalaning!</b>",
'parse_mode'=>'html',
]);
}}}

if(mb_stripos($userstep, "xizmatmax-")!==false){
$ex = explode("-",$userstep);
$kat = $ex[1];
$roy = $ex[2];
$xiz = $ex[3];
if($tx=="🗄 Boshqaruv"){
unlink("step/$cid.txt");
unlink("sozlamalar/bot/$kat/$roy/$xiz");
$royxat = file_get_contents("sozlamalar/bot/$kat/$roy/xizmatbolim.txt");
$k = str_replace("\n".$xiz."","",$royxat);
file_put_contents("sozlamalar/bot/$kat/$roy/xizmatbolim.txt",$k);
}else{
if(is_numeric($text)==true){
file_put_contents("sozlamalar/bot/$kat/$roy/$xiz/max.txt",$text);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>✅ Yangi xizmat qo'shildi</b>",
'parse_mode'=>'html',
'reply_markup'=>$admin1_menu,
]);
unlink("step/$cid.txt");
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⚠️ Faqat raqamlardan foydalaning!</b>",
'parse_mode'=>'html',
]);
}}}

if($data=="taklif_narxi"){
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
$by = file_get_contents("foydalanuvchi/hisob/$tx.nak");
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
<b>Buyurtmalari:</b> $by ta
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
'reply_markup'=>$admin1_menu,
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

if($userstep == "valayir"){
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

if($tx=="*⃣ Birlamchi sozlamalar" and in_array($cid,$admin)){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>*⃣ Birlamchi sozlamalar bo'limi:

1. Valyuta nomi:</b> $pul
<b>2. Taklif narxi:</b> $taklifpul $pul",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"1",'callback_data'=>"valyuta_nomi"],['text'=>"2",'callback_data'=>"taklif_narxi"]],
]])
]);
}

if($tx=="💳 Hamyonlar" and in_array($cid,$admin)){
$kategoriya = file_get_contents("sozlamalar/hamyon/kategoriya.txt");
$more = explode("\n",$kategoriya);
$soni = substr_count($kategoriya,"\n");
$keys=[];
for ($for = 1; $for <= $soni; $for++) {
$title=str_replace("\n","",$more[$for]);
$keys[]=["text"=>"$title- ni o'chirish","callback_data"=>"delete-$title"];
$keysboard2 = array_chunk($keys, $hamson);
$keysboard2[] = [['text'=>"➕ Yangi to'lov tizimi qo'shish",'callback_data'=>"yangi_tolov"]];
$key = json_encode([
'inline_keyboard'=>$keysboard2,
]);
}
if($kategoriya != null){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>"html",
'reply_markup'=>$key,
]);
}else{
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Yangi to'lov tizimi qo'shish",'callback_data'=>"yangi_tolov"]],
]])
]);
}}

if(mb_stripos($data, "delete-")!==false){
$ex = explode("-",$data);
$kat = $ex[1];
$royxat = file_get_contents("sozlamalar/hamyon/kategoriya.txt");
$k = str_replace("\n".$kat."","",$royxat);
file_put_contents("sozlamalar/hamyon/kategoriya.txt",$k);
deleteFolder("sozlamalar/hamyon/$kat");
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('SendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>To'lov tizimi o'chirildi!</b>",
'parse_mode'=>'html',
]);
}

if($data== "yangi_tolov"){
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
file_put_contents("step/$ccid.txt","tolov");
}

if($userstep=="tolov"){
if($tx=="🗄 Boshqaruv"){
unlink("step/$cid.txt");
}else{
if(isset($text)){
$kategoriya2 = file_get_contents("sozlamalar/hamyon/kategoriya.txt");
file_put_contents("sozlamalar/hamyon/kategoriya.txt","$kategoriya2\n$text");
mkdir("sozlamalar/hamyon/$text");
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Ushbu to'lov tizimidagi hamyoningiz raqamini yuboring:</b>",
'parse_mode'=>'html',
]);
file_put_contents("step/$cid.txt","raqam-$text");
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Yangi to'lov tizimi nomini yuboring:

Masalan:</b> Click",
'parse_mode'=>'html',
]);
}}}

if(mb_stripos($userstep, "raqam-")!==false){
$ex = explode("-",$userstep);
$kat = $ex[1];
if($tx=="🗄 Boshqaruv"){
unlink("step/$cid.txt");
deleteFolder("sozlamalar/hamyon/$kat");
}else{
file_put_contents("sozlamalar/hamyon/$kat/raqam.txt",$text);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Yangi to'lov tizimi qo'shildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$admin1_menu,
]);
unlink("step/$cid.txt");
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
[['text'=>"$tugma4",'callback_data'=>"tugmath-tugma4"]],
[['text'=>"$tugma5",'callback_data'=>"tugmath-tugma5"],['text'=>"$tugma6",'callback_data'=>"tugmath-tugma6"]],
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
[['text'=>"$tugma7",'callback_data'=>"tugmath-tugma7"]],
[['text'=>"$tugma9",'callback_data'=>"tugmath-tugma9"]],
[['text'=>"$tugma8",'callback_data'=>"tugmath-tugma8"]],
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

if($data=="reset_tugma"){
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
[['text'=>"📄 Boshlang'ich xabar",'callback_data'=>"boshlangich"]],
[['text'=>"📝 Qoidani o'zgartirish",'callback_data'=>"qoidani"]],
[['text'=>"📝 Qo'llanmani o'zgartirish",'callback_data'=>"qollanmani"]],
]])
]);
}

if($data=="boshlangich" ){
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

if($data=="qoidani"){
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
file_put_contents("step/$ccid.txt","matn2");
}
if($userstep == "matn2"){
if($tx=="🗄 Boshqaruv"){
unlink("step/$cid.txt");
}else{
file_put_contents("sozlamalar/matn/qoida.txt","$tx");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>"html",
'reply_markup'=>$admin1_menu,
]);
unlink("step/$cid.txt");
}}

if($data=="qollanmani"){
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
file_put_contents("step/$ccid.txt","matn3");
}
if($userstep == "matn3"){
if($tx=="🗄 Boshqaruv"){
unlink("step/$cid.txt");
}else{
file_put_contents("sozlamalar/matn/info.txt","$tx");
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

if($data=="kanalsoz"){
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
unlink("step/$ccid.txt");
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

Masalan: @HaydarovUz",
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

if($tx == "📊 Statistika" and in_array($cid,$admin)){
$lichka=file_get_contents("statistika/obunachi.txt");
$lich=substr_count($lichka,"\n");
$load = sys_getloadavg();
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>💡 O'rtacha yuklanish:</b> <code>$load[0]</code>

👥 <b>Foydalanuvchilar: $lich ta</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔁 Yangilash",'callback_data'=>"stats"]],
]])
]);
}

if($data=="stats"){
$lichka=file_get_contents("statistika/obunachi.txt");
$lich=substr_count($lichka,"\n");
$load = sys_getloadavg();
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>💡 O'rtacha yuklanish:</b> <code>$load[0]</code>

👥 <b>Foydalanuvchilar: $lich ta</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔁 Yangilash",'callback_data'=>"stats"]],
]])
]);
}
if($tx=="📢 Kanallar" and in_array($cid,$admin)){
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
unlink("step/$cid.txt");
}

if($data=="majburiy_obuna1"){
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
file_put_contents("step/$ccid.txt","majburiy1");
}
if($userstep == "majburiy1"){
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

Masalan: @HaydarovUz",
'parse_mode'=>'html',
]);
}}}

if($data=="majburiy_obuna2"){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>🗑 Kanallar o'chirildi!</b>",
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
➖➖➖➖➖➖➖➖

<i>$kanallar</i>

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
'text'=>"<b>👤 Yangi obunachi qo'shildi</b>",
'parse_mode'=>"html"
]);
}}

if(isset($message)){
$get = file_get_contents("statistika/obunachi.txt");
if(mb_stripos($get,$fid)==false){
file_put_contents("statistika/obunachi.txt", "$get\n$fid");
bot('sendMessage',[
'chat_id'=>$builder24,
'text'=>"<b>👤 Yangi obunachi qo'shildi</b>",
'parse_mode'=>"html"
]);
}}

if($text=="$tugma1" and joinchat($cid)==true){
$more = explode("\n",$bolim);
$soni = substr_count($bolim,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$ichida = file_get_contents("sozlamalar/bot/".$more[$for]."/ichkibolim.txt");
$ta = substr_count($ichida,"\n");
$key[]=["text"=>"$more[$for] - $ta","callback_data"=>"bolim-".$more[$for]];
$keyboard2 = array_chunk($key, $byson);
$bolim = json_encode([
'inline_keyboard'=>$keyboard2,
]);
}
if($bolim == null){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⚠️ Bo'limlar mavjud emas!</b>",
'parse_mode'=>'html',
]);
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Quyidagi ijtimoiy tarmoqlardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$bolim,
]);
unlink("foydalanuvchi/by/buyurtma.$cid");
}}

if($data == "orqaga" and joinchat($ccid)=="true"){
$more = explode("\n",$bolim);
$soni = substr_count($bolim,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$ichida = file_get_contents("sozlamalar/bot/".$more[$for]."/ichkibolim.txt");
$ta = substr_count($ichida,"\n");
$key[]=["text"=>"$more[$for] - $ta","callback_data"=>"bolim-".$more[$for]];
$keyboard2 = array_chunk($key, $byson);
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
'text'=>"<b>Quyidagi ijtimoiy tarmoqlardan birini tanlang:</b>",
'parse_mode'=>"html",
'reply_markup'=>$bolim,
]);
}

if(mb_stripos($data, "bolim-")!==false){
$ex = explode("-",$data);
$kat = $ex[1];
file_put_contents("step/$ccid.bol","$kat");
$royxat = file_get_contents("sozlamalar/bot/$kat/ichkibolim.txt");
$more = explode("\n",$royxat);
$soni = substr_count($royxat,"\n");
$keys=[];
for ($for = 1; $for <= $soni; $for++) {
$ichida = file_get_contents("sozlamalar/bot/$kat/".$more[$for]."/xizmatbolim.txt");
$ta = substr_count($ichida,"\n");
$keys[]=["text"=>"$more[$for] ($ta)","callback_data"=>"ichki-".$more[$for]];
$keysboard2 = array_chunk($keys, $ibyson);
$keysboard2[] = [['text'=>"◀️ Orqaga",'callback_data'=>"orqaga"]];
$key = json_encode([
'inline_keyboard'=>$keysboard2,
]);
}
if($royxat != null){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>Quyidagi ichki bo'limlardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$key,
]);
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$callid,
'text'=>"⚠ Ichki bo'liml mavjud emas!",
'show_alert'=>true,
]);
}}

if(mb_stripos($data, "ichki-")!==false){
$ex = explode("-",$data);
$roy = $ex[1];
$kat = file_get_contents("step/$ccid.bol");
file_put_contents("step/$ccid.ich","$roy");
$royxat = file_get_contents("sozlamalar/bot/$kat/$roy/xizmatbolim.txt");
$ids = explode("\n",$royxat);
$soni = substr_count($royxat,"\n");
foreach($ids as $id){
$key = [];
$text = "";
for ($for = 1; $for <= $soni; $for++) {
$narx=file_get_contents("sozlamalar/bot/$kat/$roy/".$ids[$for]."/narx.txt");
$text .= "<b>$for.</b> ".$ids[$for]." - $narx $pul\n";
$key[]=["text"=>"$for","callback_data"=>"byxiz-".$ids[$for]];
}
$keysboard2 = array_chunk($key, $xizson);
$keysboard2[] = [['text'=>"◀️ Orqaga",'callback_data'=>"bolim-".$kat]];
$key = json_encode([
'inline_keyboard'=>$keysboard2,
]);
}
if($royxat != null){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>Quyidagi xizmatlardan birini tanlang:</b>

$text",
'parse_mode'=>'html',
'reply_markup'=>$key,
]);
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$callid,
'text'=>"⚠ Xizmatlar mavjud emas!",
'show_alert'=>true,
]);
}}

if(mb_stripos($data, "byxiz-")!==false){
$ex = explode("-",$data);
$royxat = file_get_contents("step/$ccid.ich");
$kategoriya = file_get_contents("step/$ccid.bol");
$xiz = $ex[1];
$xizmat = file_get_contents("sozlamalar/bot/$kategoriya/$royxat/$xiz/xizmat.txt");
$narx=file_get_contents("sozlamalar/bot/$kategoriya/$royxat/$xiz/narx.txt");
$id=file_get_contents("sozlamalar/bot/$kategoriya/$royxat/$xiz/id.txt");
$min=file_get_contents("sozlamalar/bot/$kategoriya/$royxat/$xiz/min.txt");
$max=file_get_contents("sozlamalar/bot/$kategoriya/$royxat/$xiz/max.txt");
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b><u>📝 Xizmat nomi:</u></b> $xizmat

<b><u>💵 Narxi (1000x):</u></b> $narx $pul
<b><u>📑 Batafsil ma'lumot:</u> Tez boshlash. Buyurtma berishda yaxshilab etibor bering aks holda buyurtma bekor qilinmaydi. Agarda buyurtma bekor bo'lsa pul avto qaytariladi!</b>

<b><u>🔽 Minimal buyurtma:</u></b> $min ta
<b><u>🔼 Maksimal buyurtma:</u></b> $max ta",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✅ Buyurtma berish",'callback_data'=>"buyurtma-$xizmat-$narx-$min-$max-$id"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"ichki-".$royxat."-".$kategoriya]],
]])
]);
}

if(mb_stripos($data, "buyurtma-")!==false){
$ex = explode("-",$data);
$xiz = $ex[1];
$narx = $ex[2];
$min = $ex[3];
$max = $ex[4];
$id = $ex[5];
$balance= json_decode(file_get_contents("https://gramapi.uz/api/v2?key=$api&action=balance"),true);
if($balance['balance']==null or $balance['balance']=="0"){
bot('deleteMessage',[ 
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('SendMessage',[ 
'chat_id'=>$ccid,
'text'=>"<b>⛔️ Texnik xatolik</b>

Botga API ulanmagan yoki API balansda pul mavjud emas!", 
'parse_mode'=>'html',
]);
}else{
bot('SendMessage',[ 
'chat_id'=>$ccid,
'text'=>"<b><u><i>Kerakli buyurtma miqdorini kiriting:</i></u></b>", 
'parse_mode'=>'html', 
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]])
]);
file_put_contents("step/$ccid.txt","by-$xiz-$narx-$min-$max-$id");
}}

if(mb_stripos($userstep, "by-")!==false){
$ex = explode("-",$userstep);
$xiz = $ex[1];
$narx = $ex[2];
$min = $ex[3];
$max = $ex[4];
$id = $ex[5];
if($tx=="◀️ Orqaga"){
unlink("step/$cid.txt");
}else{
if(is_numeric($text)=="true"){ 
if($text >= $min and $text <= $max){
$umumiy = $narx / 1000;
$miqdor = $text * $umumiy;
if($asosiy >= $miqdor){
mkdir("foydalanuvchi/by/");
file_put_contents("foydalanuvchi/by/$cid.son","$text"); 
bot('SendMessage',[ 
'chat_id'=>$cid,
'text'=>"<b>✅ $text ta buyurtma qabul qilindi 

🔗 Kerakli havolani yuboring: 

❕ Namuna:</b> <i>https://havola</i>", 
'disable_web_page_preview'=>true, 
'parse_mode'=>'html', 
]); 
file_put_contents("step/$cid.txt","buy-$xiz-$narx-$min-$max-$id"); 
}else{ 
bot('SendMessage',[ 
'chat_id'=>$cid, 
'text'=>"<b>Hisobingizda yetarli mablag' mavjud emas!</b> 
 
Qayta urinib ko'ring:", 
'parse_mode'=>'html', 
]); 
}}else{ 
$minby = "$min"; 
$maxby = "$max"; 
bot('SendMessage',[ 
'chat_id'=>$cid, 
'text'=>"<b>Minimal buyurtma - $minby ta 
Maksimal buyurtma - $maxby ta</b> 

Qayta urinib ko'ring:", 
'parse_mode'=>'html', 
]);
}}else{ 
bot('SendMessage',[ 
'chat_id'=>$cid, 
'text'=>"<b>Faqat raqamlardan foydalaning!</b>", 
'parse_mode'=>'html', 
]); 
}}}

if(mb_stripos($userstep, "buy-")!==false){
$ex = explode("-",$userstep);
$xiz = $ex[1];
$narx = $ex[2];
$min = $ex[3];
$max = $ex[4];
$id = $ex[5];
if($tx=="◀️ Orqaga"){
unlink("step/$cid.txt");
}else{
if(mb_stripos($text, "https://")!==false){ 
file_put_contents("foydalanuvchi/by/$cid.url","$text");
$son = file_get_contents("foydalanuvchi/by/$cid.son"); 
$url = file_get_contents("foydalanuvchi/by/$cid.url");
$umumiy = $narx / 1000;
$miqdor = $son * $umumiy;
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📦 Buyurtma:</b> $xiz

<b>🔗 Havola:</b> $url

<b>🔢 Buyurtma miqdori:</b> $son ta
<b>💳 Buyurtma narxi:</b> $miqdor $pul
<b>💵 Sizning balansingiz:</b> $asosiy $pul

<i>⚠️ Buyurtmani tasdiqlashdan oldin, ma'lumotlarni tekshirib chiqing!</i>", 
'disable_web_page_preview'=>true, 
'parse_mode'=>'html', 
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✅ Tasdiqlash",'callback_data'=>"byber-$xiz-$miqdor-$son-$id"]],
]])
]);
unlink("step/$cid.txt");
}else{ 
bot('SendMessage',[ 
'chat_id'=>$cid, 
'text'=>"<b>Havola noto'g'ri kiritilgan!</b> 
 
Qayta urunib ko'ring:", 
'parse_mode'=>'html', 
]);
}}}

if(mb_stripos($data, "byber-")!==false){
$ex = explode("-",$data);
$xiz = $ex[1];
$miqdor = $ex[2];
$son = $ex[3];
$id = $ex[4];
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$update->callback_query->message->message_id,
]);
$nak = file_get_contents("foydalanuvchi/by/buyurtma.$ccid");
if(stripos($nak,"$callfrid") !== false){
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"$start",
'parse_mode'=>"html",
'reply_markup'=>$menyus,
]);
unlink("step/$ccid.txt");
}else{
$url = file_get_contents("foydalanuvchi/by/$ccid.url");
file_put_contents("foydalanuvchi/by/buyurtma.$ccid","\n".$callfrid,FILE_APPEND);
$urll=json_decode(file_get_contents("https://gramapi.uz/api/v2?key=$api&action=add&link=$url&quantity=$son&service=$id"),true);
$order=$urll['order'];
if($order==null){
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>⚠️ Buyurtma qabul qilinmadi!</b>",
'parse_mode'=>"html",
'disable_web_page_preview'=>true,
]);
}else{
$pulim = file_get_contents("foydalanuvchi/hisob/$ccid.txt");
$ayir = $pulim - $miqdor; 
file_put_contents("foydalanuvchi/hisob/$ccid.txt","$ayir");
$nakby = file_get_contents("foydalanuvchi/hisob/$ccid.nak");
$plus = $nakby + 1; 
file_put_contents("foydalanuvchi/hisob/$ccid.nak","$plus"); 
$idlar=file_get_contents("statistika/id.txt");
$pls = $idlar + 1; 
file_put_contents("statistika/id.txt","$pls");
mkdir("buyurtma/$pls");
file_put_contents("buyurtma/$pls/order.txt","$order");
file_put_contents("buyurtma/$pls/egasi.txt","$ccid");
file_put_contents("buyurtma/$pls/miqdor.txt","$miqdor");
file_put_contents("buyurtma/$pls/soni.txt","$son");
$fy = file_get_contents("buyurtma/$ccid.txt");
file_put_contents("buyurtma/$ccid.txt","$fy\n$pls");
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>✅ Buyurtma qabul qilindi!

Buyurtma IDsi:</b> <code>$pls</code>

<i>Yuqoridagi ID orqali buyurtmangiz haqida ma'lumot olishingiz mumkin!</i>",
'parse_mode'=>"html",
'disable_web_page_preview'=>true,
]);
bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"<b>🆕 Yangi buyurtma</b>

<b>📦 Buyurtma turi:</b> $xiz
<b>🔗 Havola:</b> $url
<b>🔢 Buyurtma miqdori:</b> $son ta
<b>💵 Buyurtma narxi:</b> $miqdor $pul

<b>🆔 Buyurtma IDsi:</b> <code>$order</code>",
'parse_mode'=>"html",
'disable_web_page_preview'=>true,
]);
}}}

if($tx=="$tugma2" and joinchat($fid)=="true"){
$odam=file_get_contents("foydalanuvchi/referal/$cid.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🔎 ID raqamingiz:</b> <code>$cid</code>

<b>💵 Asosiy balans:</b> $asosiy $pul
<b>🗄 Buyurtmalaringiz:</b> $by ta
<b>🔗 Takliflaringiz:</b> $odam ta",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔁 O'tkazmalar",'callback_data'=>"otkazma"]],
[['text'=>"💳 Hisobni to'ldirish",'callback_data'=>"oplata"]],
]])
]);
}

if($data == "otkazma" and joinchat($ccid)=="true"){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>Foydalanuvchi ID raqamini yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]])
]);
file_put_contents("step/$ccid.txt","otkazma");
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
if($cid==$admin){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>✅</b> <a href='tg://user?id=$odam'>Foydalanuvchiga</a><b> $text $pul o'tkazildi</b>",
'parse_mode'=>'html',
'reply_markup'=>$main_menuad,
]);
unlink("step/$cid.txt");
}else{
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>✅</b> <a href='tg://user?id=$odam'>Foydalanuvchiga</a><b> $text $pul o'tkazildi</b>",
'parse_mode'=>'html',
'reply_markup'=>$main_menu,
]);
unlink("step/$cid.txt");
}
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

if($data == "orqaga12" and joinchat($ccid)=="true"){
$hisob = file_get_contents("foydalanuvchi/hisob/$ccid.txt");
$by = file_get_contents("foydalanuvchi/hisob/$ccid.nak");
$odam=file_get_contents("foydalanuvchi/referal/$ccid.txt");
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('SendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>🔎 ID raqamingiz:</b> <code>$ccid</code>

<b>💵 Asosiy balans:</b> $hisob $pul
<b>🗄 Buyurtmalaringiz:</b> $by ta
<b>🔗 Takliflaringiz:</b> $odam ta",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔁 O'tkazmalar",'callback_data'=>"otkazma"]],
[['text'=>"💳 Hisobni to'ldirish",'callback_data'=>"oplata"]],
]])
]);
}

if($tx == "◀️ Orqaga" and joinchat($fid)=="true"){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"$start",
'parse_mode'=>"html",
'reply_markup'=>$menyu,
]);
unlink("step/$cid.txt");
unlink("foydalanuvchi/by/buyurtma.$cid");
}

if($data=="oplata" and joinchat($ccid)==true){
$kategoriya = file_get_contents("sozlamalar/hamyon/kategoriya.txt");
$more = explode("\n",$kategoriya);
$soni = substr_count($kategoriya,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$title = str_replace("\n","",$more[$for]);
$key[]=["text"=>"$title","callback_data"=>"karta-$title"];
$keyboard2 = array_chunk($key, $hamson);
$keyboard2[] = [['text'=>"◀️ Orqaga",'callback_data'=>"orqaga12"]];
$bolim = json_encode([
'inline_keyboard'=>$keyboard2,
]);
}
if($kategoriya == null){
bot("answerCallbackQuery",[
"callback_query_id"=>$callid,
"text"=>"⚠️ To'lov tizimlari qo'shilmagan!",
"show_alert"=>true,
]);
}else{
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>💳 To'lov tizimlaridan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$bolim,
]);
}}

if(mb_stripos($data, "karta-")!==false){
$ex = explode("-",$data);
$kategoriya = $ex[1];
$raqam = file_get_contents("sozlamalar/hamyon/$kategoriya/raqam.txt");
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
[['text'=>"◀️ Orqaga",'callback_data'=>"oplata"]],
]])
]);
}

if($data == "tolov" and joinchat($ccid)=="true"){
bot('DeleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('SendMessage',[
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
$hisob=file_get_contents("step/hisob.$fid");
unlink("step/$fid.txt");
bot('sendPhoto',[
'chat_id'=>$builder24,
'photo'=>$file,
'caption'=>"📄 <b>Foydalanuvchidan check:

👮‍♂️ Foydalanuvchi:</b> <a href='https://tg://user?id=$cid'>$name</a>
🔎 <b>ID raqami:</b> $fid
💵 <b>To'lov miqdori:</b> $hisob $pul",
'disable_web_page_preview'=>true,
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✅ Tasdiqlash",'callback_data'=>"on=$fid"],['text'=>"❌ Bekor qilish",'callback_data'=>"off=$fid"]],
]])
]);
}}

if(mb_stripos($data,"on=")!==false){
$odam=explode("=",$data)[1];
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
$hisob=file_get_contents("step/hisob.$odam");
bot('SendMessage',[
'chat_id'=>$odam,
'text'=>"<b>✅ So'rovingiz qabul qilindi!</b>

Hisobingizga $hisob $pul qo'shildi",
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
unlink("step/hisob.$odam");
}

if(mb_stripos($data,"off=")!==false){
$odam=explode("=",$data)[1];
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
$hisob=file_get_contents("step/hisob.$odam");
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
unlink("step/hisob.$odam");
}

if($tx=="$tugma3" and joinchat($fid)=="true"){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"$tugma7",'callback_data'=>"taklifnoma"]],
[['text'=>"$tugma9",'callback_data'=>"promokod"]],
[['text'=>"$bonusnom",'callback_data'=>"kunlik"]],
]])
]);
}

if($data == "orqaga3" and joinchat($ccid)=="true"){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('SendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>📋 Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"$tugma7",'callback_data'=>"taklifnoma"]],
[['text'=>"$tugma9",'callback_data'=>"promokod"]],
[['text'=>"$bonusnom",'callback_data'=>"kunlik"]],
]])
]);
}

if($data=="promokod"){ 
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

🎫 <b>Promokod:</b> <code>$code</code>
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

$vaqt = date('d-m-y');
$frid= $update->callback_query->from->id;
mkdir("foydalanuvchi/bonus");
if($data == "kunlik"){
$bonustime = file_get_contents("foydalanuvchi/bonus/$frid.txt");
if($bonustime == $vaqt){
bot("editMessageText",[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>📛 Siz kunlik bonus olib bo'lgansiz!</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"orqaga3"]],
]])
]);
}else{
$pulim = file_get_contents("foydalanuvchi/hisob/$frid.txt");
$plus=$pulim+$bonus;
file_put_contents("foydalanuvchi/hisob/$frid.txt","$plus");
file_put_contents("foydalanuvchi/bonus/$frid.txt","$vaqt");
bot("editMessageText",[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>💸 Kunlik bonus - $bonus $pul

✅ Bonus berildi! ✅</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"orqaga3"]],
]])
]);
}}

if($data == "taklifnoma" and joinchat($ccid)=="true"){
$odam=file_get_contents("foydalanuvchi/referal/$ccid.txt");
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>🔗 Sizning taklif havolangiz:</b>

<code>https://t.me/$botname?start=$ccid</code>

<b>1 ta taklif uchun $taklifpul so'm beriladi

Sizning takliflaringiz: $odam ta</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"👥 Do'stlarga yuborish",'url'=>"https://t.me/share/url?url=https://t.me/$botname?start=$ccid"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"orqaga3"]],
]])
]);
}

if($text == "$tugma4" and joinchat($cid)=="true"){
$more = explode("\n",$buyurtma);
$soni = substr_count($buyurtma,"\n");
$keys=[];
for ($for = 1; $for <= $soni; $for++) {
$title=str_replace("\n","",$more[$for]);
$keys[]=["text"=>"$title","callback_data"=>"idby-$title"];
$keysboard2 = array_chunk($keys, 5);
$key = json_encode([
'inline_keyboard'=>$keysboard2,
]);
}
if($buyurtma != null){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🗄 Buyurtmalaringiz ro'yxati birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$key,
]);
}else{
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🤷‍♂️ Sizda aktiv buyurtma topilmadi!</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔎 Izlab topish",'callback_data'=>"bytopish"]],
]])
]);
unlink("foydalanuvchi/by/buyurtma.$cid");
}}

if($data=="bytopish" and joinchat($ccid)=="true"){
bot('deleteMessage',[ 
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>🆔 Buyurtma IDsini yuboring:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]])
]);
file_put_contents("step/$ccid.txt","bytop");
}
if($userstep=="bytop"){
if($text=="◀️ Orqaga"){
unlink("step/$cid.txt");
}else{
$byyoq=file_get_contents("buyurtma/$tx/order.txt");
if($byyoq){
if(is_numeric($text)){
$orderstat=json_decode(file_get_contents("https://gramapi.uz/api/v2?key=$api&action=status&order=$byyoq"),true);
$miqdor=$orderstat['remains'];
$xolati=$orderstat['status'];
if($xolati=="Pending"){
$byxol = "Kutilmoqda";
}
if($xolati=="In progress"){
$byxol = "Bajarilmoqda";
}
if($xolati=="Completed"){
$byxol = "Bajarilgan";
}
if($xolati=="Partial"){
$byxol = "Qisman bajarildi";
}
if($xolati=="Processing"){
$byxol = "Qayta ishlanmoqda";
}
if($xolati=="Canceled"){
$byxol = "Bekor qilingan";
}
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>✅ Buyurtma topildi!</b>

<b>🔐 Buyurtma holati:</b> $byxol
<b>🗃 Qoldiq miqdori:</b> $miqdor ta",
'parse_mode'=>"html",
]);
unlink("step/$cid.txt");
}else{
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⚠️ Faqat raqamlardan foydalaning!</b>",
'parse_mode'=>"html",
]);
}}else{
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⚠️ Buyurtma topilmadi!</b>

Qayta urinib ko'ring:",
'parse_mode'=>"html",
]);
}}}

if(mb_stripos($data, "idby-")!==false){
$ex = explode("-",$data);
$soni = $ex[1];
$byxolat=file_get_contents("buyurtma/$soni/order.txt");
$orderstat=json_decode(file_get_contents("https://gramapi.uz/api/v2?key=$api&action=status&order=$byxolat"),true);
$miqdor=$orderstat['remains'];
$xolati=$orderstat['status'];
if($xolati=="Pending"){
$byxol = "Kutilmoqda";
}
if($xolati=="In progress"){
$byxol = "Bajarilmoqda";
}
if($xolati=="Completed"){
$byxol = "Bajarilgan";
}
if($xolati=="Partial"){
$byxol = "Qisman bajarildi";
}
if($xolati=="Processing"){
$byxol = "Qayta ishlanmoqda";
}
if($xolati=="Canceled"){
$byxol = "Bekor qilingan";
}
bot('deleteMessage',[ 
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[ 
'chat_id'=>$ccid,
'text'=>"<b>🆔 Buyurtma ID raqami:</b> <code>$soni</code>

<b>🔐 Buyurtma holati: $byxol</b>
<b>🗃 Qoldiq miqdori:</b> $miqdor ta", 
'parse_mode'=>"html", 
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"orqaby"]],
]])
]);
}

if($data == "orqaby"){
$kategoriya = file_get_contents("buyurtma/$ccid.txt");
$more = explode("\n",$kategoriya);
$soni = substr_count($kategoriya,"\n");
$keys=[];
for ($for = 1; $for <= $soni; $for++) {
$title=str_replace("\n","",$more[$for]);
$keys[]=["text"=>"$title","callback_data"=>"idby-$title"];
$keysboard2 = array_chunk($keys, 5);
$key = json_encode([
'inline_keyboard'=>$keysboard2,
]);
}
if($kategoriya != null){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>🗄 Buyurtmalaringiz ro'yxati birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$key,
]);
}else{
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>🤷‍♂️ Sizda aktiv buyurtma topilmadi!</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔎 Izlab topish",'callback_data'=>"bytopish"]],
]])
]);
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
file_put_contents("step/$cid.txt","murojat");
}

if($userstep=="murojat"){
if($tx=="◀️ Orqaga"){
unlink("step/$cid.txt");
}else{
bot('sendMessage',[
'chat_id'=>$builder24,
'text'=>"<b>📨 Yangi murojat keldi:</b> <a href='tg://user?id=$cid'>$cid</a>

<b>📑 Murojat matni:</b> $tx",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"Javob yozish",'callback_data'=>"yozish=$cid"]],
]])
]);
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>✅ Murojaatingiz yuborildi.</b>

<i>Tez orada javob qaytaramiz!</i>",
'parse_mode'=>'html',
'reply_markup'=>$menyu,
]);
unlink("step/$cid.txt");
}}

if(mb_stripos($data,"yozish=")!==false){
$odam=explode("=",$data)[1];
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
'reply_markup'=>$main_menuad,
]);
unlink("step/$murojat.murojat");
unlink("step/$cid.txt");
unlink("step/$cid.javob");
}}

if($tx=="$tugma6" and joinchat($fid)=="true"){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Ma'lumot olish uchun, quyidagi tugmalardan foydalaning:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📚 Qo'llanma",'callback_data'=>"qollama"]],
[['text'=>"⚠️ Qoidalar",'callback_data'=>"qoidalar"]],
]])
]);
}

if($data=="tugmaolti" and joinchat($ccid)=="true"){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>Ma'lumot olish uchun, quyidagi tugmalardan foydalaning:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📚 Qo'llanma",'callback_data'=>"qollama"]],
[['text'=>"⚠️ Qoidalar",'callback_data'=>"qoidalar"]],
]])
]);
}

if($data == "qollama" and joinchat($ccid)=="true"){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"$qollama",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"tugmaolti"]],
]])
]);
}

if($data == "qoidalar" and joinchat($ccid)=="true"){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"$qoida",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"tugmaolti"]],
]])
]);
}

$bytopish = glob("buyurtma/*/order.txt");
foreach($bytopish as $bytopildi){
$id = str_replace(["buyurtma/","/order.txt"], ["",""], $bytopildi);
$byid = file_get_contents("buyurtma/$id/order.txt");
$ega = file_get_contents("buyurtma/$id/egasi.txt");
$orderstat=json_decode(file_get_contents("https://gramapi.uz/api/v2?key=$api&action=status&order=$byid"),true);
$xolati=$orderstat['status'];
$miqdor=$orderstat['remains'];
if($xolati=="Completed"){
bot('sendMessage',[
'chat_id'=>$ega,
'text'=>"<b>✅ $id - raqamli buyurtma bajarildi!</b>",
'parse_mode'=>"html",
]);
deleteFolder("buyurtma/$id");
$minus=file_get_contents("buyurtma/$ega.txt");
$oladi = str_replace("\n".$id."","",$minus);
file_put_contents("buyurtma/$ega.txt",$oladi);
}
if($xolati=="Canceled"){
$byid=file_get_contents("buyurtma/$id/miqdor.txt");
$soni=file_get_contents("buyurtma/$id/soni.txt");
$umumiy = $byid / $soni;
$plus = $miqdor * $umumiy;
$get = file_get_contents("foydalanuvchi/hisob/$ega.txt");
$get += $plus;
file_put_contents("foydalanuvchi/hisob/$ega.txt", $get);
bot('sendMessage',[
'chat_id'=>$ega,
'text'=>"<b>❌ Buyurtma bekor qilindi!

🆔 Buyurtma IDsi:</b> $id
<b>⚠️ Bajarilmagan buyurtma:</b> $miqdor ta 

<b>💵 Qaytarilgan summa:</b> $plus $pul",
'parse_mode'=>"html",
]);
deleteFolder("buyurtma/$id");
$minus=file_get_contents("buyurtma/$ega.txt");
$oladi = str_replace("\n".$id."","",$minus);
file_put_contents("buyurtma/$ega.txt",$oladi);
}
if($xolati=="Partial"){
$byid=file_get_contents("buyurtma/$id/miqdor.txt");
$soni=file_get_contents("buyurtma/$id/soni.txt");
$umumiy = $byid / $soni;
$plus = $miqdor * $umumiy;
$get = file_get_contents("foydalanuvchi/hisob/$ega.txt");
$get += $plus;
file_put_contents("foydalanuvchi/hisob/$ega.txt", $get);
bot('sendMessage',[
'chat_id'=>$ega,
'text'=>"<b>❌ Buyurtma bekor qilindi!

🆔 Buyurtma IDsi:</b> $id
<b>⚠️ Bajarilmagan buyurtma:</b> $miqdor ta 

<b>💵 Qaytarilgan summa:</b> $plus $pul",
'parse_mode'=>"html",
]);
deleteFolder("buyurtma/$id");
$minus=file_get_contents("buyurtma/$ega.txt");
$oladi = str_replace("\n".$id."","",$minus);
file_put_contents("buyurtma/$ega.txt",$oladi);
}}

?>