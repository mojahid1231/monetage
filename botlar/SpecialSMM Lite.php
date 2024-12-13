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
mkdir("foydalanuvchi/referal");
mkdir("foydalanuvchi/hisob");
mkdir("foydalanuvchi/by");
mkdir("sozlamalar/hamyon");
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
if(!file_exists("foydalanuvchi/hisob/$fid.status")){
file_put_contents("foydalanuvchi/hisob/$fid.status","Oddiy");
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
if(!file_exists("buyurtma/$fid.txt")){
file_put_contents("buyurtma/$fid.txt","");
}
if(!file_exists("statistika/id.txt")){
file_put_contents("statistika/id.txt","0");
}
if(!file_exists("sozlamalar/pul/api.txt")){
file_put_contents("sozlamalar/pul/api.txt","");
}
if(!file_exists("sozlamalar/pul/sayt.txt")){
file_put_contents("sozlamalar/pul/sayt.txt","");
}
if(!file_exists("sozlamalar/pul/valyuta.txt")){
file_put_contents("sozlamalar/pul/valyuta.txt","so'm");
}
if(!file_exists("sozlamalar/pul/vipnarx.txt")){
file_put_contents("sozlamalar/pul/vipnarx.txt","15000");
}
if(!file_exists("sozlamalar/tugma/tugma1.txt")){
file_put_contents("sozlamalar/tugma/tugma1.txt","🗂 Xizmatlarga buyurtma berish");
}
if(!file_exists("sozlamalar/tugma/tugma2.txt")){
file_put_contents("sozlamalar/tugma/tugma2.txt","💰 Balans");
}
if(!file_exists("sozlamalar/tugma/tugma3.txt")){
file_put_contents("sozlamalar/tugma/tugma3.txt","🗣 Referal");
}
if(!file_exists("sozlamalar/tugma/tugma4.txt")){
file_put_contents("sozlamalar/tugma/tugma4.txt","📊 Buyurtmalarim");
}
if(!file_exists("sozlamalar/tugma/tugma5.txt")){
file_put_contents("sozlamalar/tugma/tugma5.txt","📨 Bog'lanish");
}
if(!file_exists("sozlamalar/tugma/tugma6.txt")){
file_put_contents("sozlamalar/tugma/tugma6.txt","📚 Bot haqida");
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
if(file_get_contents("statistika/obunachi.txt")){
} else{
file_put_contents("statistika/obunachi.txt", "0");
}
if(file_get_contents("statistika/admins.txt")){
}else{
if(file_put_contents("statistika/admins.txt","$builder24"));
}

$asosiy=file_get_contents("foydalanuvchi/hisob/$fid.txt");
$hisob=file_get_contents("foydalanuvchi/hisob/$ccid.txt");
$status=file_get_contents("foydalanuvchi/hisob/$fid.status");
$by=file_get_contents("foydalanuvchi/hisob/$fid.nak");
$api=file_get_contents("sozlamalar/pul/api.txt");
$buyurtma=file_get_contents("buyurtma/$fid.txt");
$sayt=file_get_contents("sozlamalar/pul/sayt.txt");
$vipnarx = file_get_contents("sozlamalar/pul/vipnarx.txt");
$pul = file_get_contents("sozlamalar/pul/valyuta.txt");
$taklifpul = file_get_contents("sozlamalar/pul/referal.txt");
$tugma1 = file_get_contents("sozlamalar/tugma/tugma1.txt");
$tugma2 = file_get_contents("sozlamalar/tugma/tugma2.txt");
$tugma3 = file_get_contents("sozlamalar/tugma/tugma3.txt");
$tugma4 = file_get_contents("sozlamalar/tugma/tugma4.txt");
$tugma5 = file_get_contents("sozlamalar/tugma/tugma5.txt");
$tugma6 = file_get_contents("sozlamalar/tugma/tugma6.txt");
$start = file_get_contents("sozlamalar/matn/start.txt");
$qoida = file_get_contents("sozlamalar/matn/qoida.txt");
$qollama = file_get_contents("sozlamalar/matn/qollama.txt");
$kanallar=file_get_contents("sozlamalar/kanal/ch.txt");
#-----------------------------------#
$bolim = file_get_contents("sozlamalar/bot/kategoriya.txt");
$ichkibolim = file_get_contents("sozlamalar/bot/$bolim/ichkibolim.txt");
$type = file_get_contents("sozlamalar/bot/$kategoriya/$ichkibolim/xizmat.txt");
$narx = file_get_contents("sozlamalar/bot/$kategoriya/$ichkibolim/narx.txt");
$id = file_get_contents("sozlamalar/bot/$kategoriya/$ichkibolim/id.txt");
$tavsif = file_get_contents("sozlamalar/bot/$kategoriya/$ichkibolim/tavsif.txt");
$min = file_get_contents("sozlamalar/bot/$kategoriya/$ichkibolim/min.txt");
$max = file_get_contents("sozlamalar/bot/$kategoriya/$ichkibolim/max.txt");
#-----------------------------------#
$kategoriya = file_get_contents("sozlamalar/hamyon/kategoriya.txt");
$raqam = file_get_contents("sozlamalar/hamyon/$kategoriya/raqam.txt");
#-----------------------------------#

$saved = file_get_contents("step/odam.txt");
$ban = file_get_contents("ban/$fid.txt");
$statistika = file_get_contents("statistika/obunachi.txt");
$soat=date("H:i",strtotime("2 hour"));
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
[['text'=>"$tugma2"],['text'=>"$tugma3"]],
[['text'=>"$tugma4"]],
[['text'=>"$tugma5"],['text'=>"$tugma6"]],
]]);

$main_menuad = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"$tugma1"]],
[['text'=>"$tugma2"],['text'=>"$tugma3"]],
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
[['text'=>"📢 Kanallar"],['text'=>"🛍 Xizmatlar"]],
[['text'=>"📊 Statistika"],['text'=>"👤 Adminlar"]],
[['text'=>"🔎 Foydalanuvchini boshqarish"]],
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
[['text'=>"💳 Hamyonlar"],['text'=>"🔑 API sozlash"]],
[['text'=>"🗄 Boshqaruv"]],
]])
]);
}

if($tx=="*⃣ Birlamchi sozlamalar" and in_array($cid,$admin)){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>*⃣ Birlamchi sozlamalar bo'limi:

1. Valyuta nomi:</b> $pul
<b>2. Taklif narxi:</b> $taklifpul $pul
<b>3. ViP (status) narxi:</b> $vipnarx $pul",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"1",'callback_data'=>"valyuta_nomi"],['text'=>"2",'callback_data'=>"taklif_narxi"],['text'=>"3",'callback_data'=>"vip_narxi"]],
]])
]);
}

if($tx=="🔑 API sozlash" and in_array($cid,$admin)){ 
if($api==null){ 
$ap1="kiritilmagan"; 
}else{ 
$ap1="<code>$api</code>";
}
if($sayt==null){ 
$sayt1="kiritilmagan"; 
}else{ 
$sayt1="$sayt"; 
} 
$balance= json_decode(file_get_contents("$sayt?key=$api&action=balance"),true); 
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
<b>API havola:</b> 
$sayt1 
 
<b>API kalit:</b> 
$ap1 
➖➖➖➖➖➖➖➖➖➖➖", 
'parse_mode'=>"html", 
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[ 
[['text'=>"APIni yangisiga almashtirish",'callback_data'=>"yangimanzil"]], 
[['text'=>"Balansni ko'rish",'callback_data'=>"apibalans"]], 
]]) 
]); 
} 
 
if($data=="apibalans"){
if($api==null or $sayt==null){
bot('answerCallbackQuery',[ 
'callback_query_id'=>$callid, 
'text'=>"🤷🏻‍♂ API kalit kiritilmagan!",
'show_alert'=>true,
]);
}else{
$balance= json_decode(file_get_contents("$sayt?key=$api&action=balance"),true);
$valyuta=$balance['currency']; 
bot('answerCallbackQuery',[ 
'callback_query_id'=>$callid, 
'text'=>"API balansi: ".$balance['balance']." $valyuta",
'show_alert'=>true,
]);
}}

if($data=="yangimanzil" and in_array($ccid,$admin)){ 
bot('deleteMessage',[ 
'chat_id'=>$ccid, 
'message_id'=>$cmid, 
]); 
bot('sendMessage',[ 
'chat_id'=>$ccid, 
'text'=>"<b>Kerakli saytning API qo'llanmasida ko'rsatilgan API havolani yuboring: 
 
Masalan:</b> <code>https://gramapi.uz/api/v2</code>", 
'parse_mode'=>"html", 
'reply_markup'=>json_encode([ 
'resize_keyboard'=>true, 
'keyboard'=>[ 
[['text'=>"🗄 Boshqaruv"]], 
]]) 
]); 
file_put_contents("step/$ccid.txt","manzil"); 
} 
if($userstep == "manzil"){ 
if(mb_stripos($text, "api/v")!==false){ 
if($tx=="🗄 Boshqaruv"){ 
unlink("step/$cid.txt"); 
}else{ 
file_put_contents("sozlamalar/pul/sayt.txt","$tx");
bot('sendMessage',[ 
'chat_id'=>$cid, 
'text'=>"<b>$tx dan olingan API kalitni yuboring:</b>", 
'parse_mode'=>"html", 
]); 
file_put_contents("step/$cid.txt","api-$text"); 
}}else{ 
bot('sendMessage',[ 
'chat_id'=>$cid, 
'text'=>"<b>Namuna:</b> <code>https://gramapi.uz/api/v2</code>", 
'parse_mode'=>"html", 
]); 
}}
 
if(mb_stripos($userstep, "api-")!==false){ 
$isayt = explode("-",$userstep)[1]; 
if($tx=="🗄 Boshqaruv"){ 
unlink("sozlamalar/pul/sayt.txt"); 
unlink("step/$cid.txt"); 
}else{
$sayt=file_get_contents("sozlamalar/pul/sayt.txt");
$balance= json_decode(file_get_contents("$sayt?key=$text&action=balance"),true); 
$valyuta=$balance['currency']; 
if($balance['balance']==null){ 
bot('sendMessage',[ 
'chat_id'=>$cid, 
'text'=>"<b>$sayt dan olingan API kalitni yuboring:</b>", 
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

if($data=="barcha2" and in_array($ccid,$admin)){
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
[['text'=>"➕ Yangi bo'lim qo'shish",'callback_data'=>"AdKat"]],
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

if($data=="tahrirlash"){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>📋 Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📝 Nomini o'zgartirish",'callback_data'=>"nom_ozgartirish"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"kategoriya"]]
]])
]);
}

if($data == "nom_ozgartirish"){
$more = explode("\n",$bolim);
$soni = substr_count($bolim,"\n");
$keys=[];
for ($for = 1; $for <= $soni; $for++) {
$keys[]=["text"=>"$more[$for]","callback_data"=>"tahrir-".$more[$for]];
$keysboard2 = array_chunk($keys, 2);
$keysboard2[] = [['text'=>"◀️ Orqaga",'callback_data'=>"tahrirlash"]];
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
'text'=>"🤷🏻‍♂ Bo'limlar topilmadi!",
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
$keysboard2 = array_chunk($keys, 2);
$keysboard2[] = [['text'=>"◀️ Orqaga",'callback_data'=>"kategoriya"]];
$key = json_encode([
'inline_keyboard'=>$keysboard2,
]);
}
if($bolim != null){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>🗑 O'chiriladigan bo'limni tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$key,
]);
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$callid,
'text'=>"🤷🏻‍♂ Bo'limlar topilmadi!",
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
'text'=>"<b>$kat - nomli bo'lim o'chirildi</b>",
'parse_mode'=>'html',
'reply_markup'=>$admin1_menu,
]);
deleteFolder("sozlamalar/bot/$kat");
}

if($data == "xizmatlar"){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Yangi xizmat qo'shish",'callback_data'=>"adxiz"]],
[['text'=>"📝 Tahrirlash",'callback_data'=>"xizmatsoz"]],
[['text'=>"🗑 O'chirish",'callback_data'=>"ochir"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"bbosh"]]
]])
]);
}

if($data == "ochir"){
$more = explode("\n",$bolim);
$soni = substr_count($bolim,"\n");
$keys=[];
for ($for = 1; $for <= $soni; $for++) {
$keys[]=["text"=>"$more[$for] ->","callback_data"=>"delxiz-".$more[$for]];
$keysboard2 = array_chunk($keys, 2);
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
'text'=>"🤷🏻‍♂ Bo'limlar topilmadi!",
'show_alert'=>true,
]);
}}

if(mb_stripos($data, "delxiz-")!==false){
$ex = explode("-",$data);
$kat = $ex[1];
$royxat = file_get_contents("sozlamalar/bot/$kat/ichkibolim.txt");
file_put_contents("step/$ccid.bol","$kat");
$ids = explode("\n",$royxat);
$soni = substr_count($royxat,"\n");
foreach($ids as  $id){
$key = [];
$text = "";
for ($for = 1; $for <= $soni; $for++) {
$text .= "<b>$for.</b> ".$ids[$for]."\n";
$key[]=["text"=>"$for","callback_data"=>"ochirdim=".$ids[$for]];
}
$keysboard2 = array_chunk($key, 5);
$keysboard2[] = [['text'=>"◀️ Orqaga",'callback_data'=>"xizmatsoz"]];
$key = json_encode([
'inline_keyboard'=>$keysboard2,
]);
}
if($royxat != null){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>Kerakli xizmatni tanlang:</b>

$text",
'parse_mode'=>'html',
'reply_markup'=>$key,
]);
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$callid,
'text'=>"🤷🏻‍♂ Xizmatlar topilmadi!",
'show_alert'=>true,
]);
}}

if(mb_stripos($data, "ochirdim=")!==false){
$ex = explode("=",$data);
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
'text'=>"<b>$roy - nomli xizmat o'chirildi</b>",
'parse_mode'=>'html',
'reply_markup'=>$admin1_menu,
]);
deleteFolder("sozlamalar/bot/$kat/$roy");
unlink("step/$ccid.bol");
}

if($data == "xizmatsoz"){
$more = explode("\n",$bolim);
$soni = substr_count($bolim,"\n");
$keys=[];
for ($for = 1; $for <= $soni; $for++) {
$keys[]=["text"=>"$more[$for] ->","callback_data"=>"tanla-".$more[$for]];
$keysboard2 = array_chunk($keys, 2);
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
'text'=>"🤷🏻‍♂ Bo'limlar topilmadi!",
'show_alert'=>true,
]);
}}

if(mb_stripos($data, "tanla-")!==false){
$ex = explode("-",$data);
$kat = $ex[1];
$royxat = file_get_contents("sozlamalar/bot/$kat/ichkibolim.txt");
file_put_contents("step/$ccid.bol","$kat");
$ids = explode("\n",$royxat);
$soni = substr_count($royxat,"\n");
foreach($ids as  $id){
$key = [];
$text = "";
for ($for = 1; $for <= $soni; $for++) {
$text .= "<b>$for.</b> ".$ids[$for]."\n";
$key[]=["text"=>"$for","callback_data"=>"tahrirla=".$ids[$for]];
}
$keysboard2 = array_chunk($key, 5);
$keysboard2[] = [['text'=>"◀️ Orqaga",'callback_data'=>"xizmatsoz"]];
$key = json_encode([
'inline_keyboard'=>$keysboard2,
]);
}
if($royxat != null){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>Kerakli xizmatni tanlang:</b>

$text",
'parse_mode'=>'html',
'reply_markup'=>$key,
]);
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$callid,
'text'=>"🤷🏻‍♂ Xizmatlar topilmadi!",
'show_alert'=>true,
]);
}}

if(mb_stripos($data, "tahrirla=")!==false){
$ex = explode("=",$data);
$kat = file_get_contents("step/$ccid.bol");
$roy = $ex[1];
file_put_contents("step/$ccid.ich","$roy");
$xizmat = file_get_contents("sozlamalar/bot/$kat/$roy/xizmat.txt");
$narx = file_get_contents("sozlamalar/bot/$kat/$roy/narx.txt");
$tavsif = file_get_contents("sozlamalar/bot/$kat/$roy/tavsif.txt");
$min = file_get_contents("sozlamalar/bot/$kat/$roy/min.txt");
$max = file_get_contents("sozlamalar/bot/$kat/$roy/max.txt");
$id = file_get_contents("sozlamalar/bot/$kat/$roy/id.txt");
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b><u>🗄 Xizmat nomi:</u></b> $xizmat
<b><u>🔑 Xizmat IDsi:</u></b> $id

<b><u>💵 Buyurtma narxi:</u></b> $narx $pul
<b><u>📑 Malumot:</u></b> <i>$tavsif</i>

<b><u>🔽 Minimal buyurtma:</u></b> $min ta
<b><u>🔼 Maksimal buyurtma:</u></b> $max ta

<b><u>💎 ViP foydalanuvchilar uchun:</u></b> $vip $pul",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📝 Nomini tahrirlash",'callback_data'=>"nomi-xizmat"],['text'=>"📝 IDni tahrirlash",'callback_data'=>"editBot-id"]],
[['text'=>"📝 Narxini tahrirlash",'callback_data'=>"editBot-narx"],['text'=>"📝 ViP narx tahririlash",'callback_data'=>"editBot-vip"]],
[['text'=>"📝 Tavsifni tahrirlash",'callback_data'=>"editBot-tavsif"]],
[['text'=>"📝 Min. tahrirlash",'callback_data'=>"editBot-min"],['text'=>"📝 Max. tahrirlash",'callback_data'=>"editBot-max"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"tanla-".$kat]]
]])
]);
}

if(mb_stripos($data, "nomi-")!==false){
$kat = file_get_contents("step/$ccid.bol");
$roy = file_get_contents("step/$ccid.ich");
$holat = file_get_contents("sozlamalar/bot/$kat/$roy/xizmat.txt");
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
file_put_contents("step/$ccid.txt","editnomi-xizmat-$kat-$roy");
}

if(mb_stripos($userstep, "editnomi-")!==false){
if($tx=="🗄 Boshqaruv"){
unlink("step/$cid.txt");
}else{
$ex = explode("-",$userstep)[1];
$kat = explode("-",$userstep)[2];
$roy = explode("-",$userstep)[3];
$ichki=file_get_contents("sozlamalar/bot/$kat/ichkibolim.txt");
$a = str_replace("$roy", "$text", $ichki);
file_put_contents("sozlamalar/bot/$kat/ichkibolim.txt",$a);
file_put_contents("sozlamalar/bot/$kat/$roy/xizmat.txt",$text);
rename("sozlamalar/bot/$kat/$roy","sozlamalar/bot/$kat/$text");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$admin1_menu,
]);
unlink("step/$cid.txt");
}}

if(mb_stripos($data, "editBot-")!==false){
$ex = explode("-",$data)[1];
$kat = file_get_contents("step/$ccid.bol");
$roy = file_get_contents("step/$ccid.ich");
$holat = file_get_contents("sozlamalar/bot/$kat/$roy/$ex.txt");
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
'text'=>"<b>Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$admin1_menu,
]);
unlink("step/$cid.txt");
unlink("step/$cid.bol");
unlink("step/$cid.ich");
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
$keys[]=["text"=>"$more[$for]","callback_data"=>"addb-".$more[$for]];
$keysboard2 = array_chunk($keys, 2);
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
'text'=>"🤷🏻‍♂ Bo'limlar topilmadi!",
'show_alert'=>true,
]);
}}

if(mb_stripos($data, "addb-")!==false){
$ex = explode("-",$data);
$kat = $ex[1];
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>✅ $kat tanlandi</b>

📝 Xizmat nomini yuboring:",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqaruv"]],
]])
]);
file_put_contents("step/$ccid.txt","xizmatnomi-$kat");
}

if(mb_stripos($userstep, "xizmatnomi-")!==false){
$ex = explode("-",$userstep);
$kat = $ex[1];
if($tx=="🗄 Boshqaruv"){
unlink("step/$cid.txt");
}else{
$royxat = file_get_contents("sozlamalar/bot/$kat/ichkibolim.txt");
file_put_contents("sozlamalar/bot/$kat/ichkibolim.txt","$royxat\n$text");
mkdir("sozlamalar/bot/$kat/$text");
file_put_contents("sozlamalar/bot/$kat/$text/xizmat.txt",$text);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"$text <b>nomi qabul qilindi.</b>

📝 Xizmat ID raqamini yuboring:",
'parse_mode'=>'html',
]);
file_put_contents("step/$cid.txt","xizmatid-$kat-$text-$text");
}}

if(mb_stripos($userstep, "xizmatid-")!==false){
$ex = explode("-",$userstep);
$kat = $ex[1];
$roy = $ex[2];
$type = $ex[3];
if($tx=="🗄 Boshqaruv"){
unlink("step/$cid.txt");
unlink("sozlamalar/bot/$kat/$roy");
$royxat = file_get_contents("sozlamalar/bot/$kat/ichkibolim.txt");
$k = str_replace("\n".$roy."","",$royxat);
file_put_contents("sozlamalar/bot/$kat/ichkibolim.txt",$k);
}else{
if(is_numeric($text)==true){
file_put_contents("sozlamalar/bot/$kat/$roy/id.txt",$text);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>$text qabul qilindi</b>

📝 Xizmat narxini yuboring:",
'parse_mode'=>'html',
]);
file_put_contents("step/$cid.txt","xizmatnarx-$kat-$roy-$type");
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
$type = $ex[3];
if($tx=="🗄 Boshqaruv"){
unlink("step/$cid.txt");
unlink("sozlamalar/bot/$kat/$roy");
$royxat = file_get_contents("sozlamalar/bot/$kat/ichkibolim.txt");
$k = str_replace("\n".$roy."","",$royxat);
file_put_contents("sozlamalar/bot/$kat/ichkibolim.txt",$k);
}else{
if(is_numeric($text)==true){
file_put_contents("sozlamalar/bot/$kat/$roy/narx.txt",$text);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>$text $pul narxi qabul qilindi</b>

📝 ViP foydalanuvchilar uchun narx yuboring:",
'parse_mode'=>'html',
]);
file_put_contents("step/$cid.txt","vipuchun-$kat-$roy-$type");
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⚠️ Faqat raqamlardan foydalaning!</b>",
'parse_mode'=>'html',
]);
}}}

if(mb_stripos($userstep, "vipuchun-")!==false){
$ex = explode("-",$userstep);
$kat = $ex[1];
$roy = $ex[2];
$type = $ex[3];
if($tx=="🗄 Boshqaruv"){
unlink("step/$cid.txt");
unlink("sozlamalar/bot/$kat/$roy");
$royxat = file_get_contents("sozlamalar/bot/$kat/ichkibolim.txt");
$k = str_replace("\n".$roy."","",$royxat);
file_put_contents("sozlamalar/bot/$kat/ichkibolim.txt",$k);
}else{
if(is_numeric($text)==true){
file_put_contents("sozlamalar/bot/$kat/$roy/vip.txt",$text);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>$text $pul narxi qabul qilindi</b>

📝 Xizmat haqida malumot yuboring:",
'parse_mode'=>'html',
]);
file_put_contents("step/$cid.txt","xizmatinfo-$kat-$roy-$type");
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⚠️ Faqat raqamlardan foydalaning!</b>",
'parse_mode'=>'html',
]);
}}}

if(mb_stripos($userstep, "xizmatinfo-")!==false){
$ex = explode("-",$userstep);
$kat = $ex[1];
$roy = $ex[2];
$type = $ex[3];
if($tx=="🗄 Boshqaruv"){
unlink("step/$cid.txt");
unlink("sozlamalar/bot/$kat/$roy");
$royxat = file_get_contents("sozlamalar/bot/$kat/ichkibolim.txt");
$k = str_replace("\n".$roy."","",$royxat);
file_put_contents("sozlamalar/bot/$kat/ichkibolim.txt",$k);
}else{
if(isset($text)){
file_put_contents("sozlamalar/bot/$kat/$roy/tavsif.txt",$text);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Qabul qilindi</b>

📝 Buyurtma (min) miqdorini yuboring:",
'parse_mode'=>'html',
]);
file_put_contents("step/$cid.txt","xizmatmin-$kat-$roy-$type");
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
$type = $ex[3];
if($tx=="🗄 Boshqaruv"){
unlink("step/$cid.txt");
unlink("sozlamalar/bot/$kat/$roy");
$royxat = file_get_contents("sozlamalar/bot/$kat/ichkibolim.txt");
$k = str_replace("\n".$roy."","",$royxat);
file_put_contents("sozlamalar/bot/$kat/ichkibolim.txt",$k);
}else{
if(is_numeric($text)==true){
file_put_contents("sozlamalar/bot/$kat/$roy/min.txt",$text);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>$text ta qabul qilindi</b>

📝 Buyurtma (max) miqdorini yuboring:",
'parse_mode'=>'html',
]);
file_put_contents("step/$cid.txt","xizmatmax-$kat-$roy-$type");
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
$type = $ex[3];
if($tx=="🗄 Boshqaruv"){
unlink("step/$cid.txt");
unlink("sozlamalar/bot/$kat/$roy");
$royxat = file_get_contents("sozlamalar/bot/$kat/ichkibolim.txt");
$k = str_replace("\n".$roy."","",$royxat);
file_put_contents("sozlamalar/bot/$kat/ichkibolim.txt",$k);
}else{
if(is_numeric($text)==true){
file_put_contents("sozlamalar/bot/$kat/$roy/max.txt",$text);
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

if($data=="taklif_narxi" and in_array($ccid,$admin)){
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

if($data=="valyuta_nomi" and in_array($ccid,$admin)){
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

if($data=="vip_narxi" and in_array($ccid,$admin)){
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
file_put_contents("step/$ccid.txt","vipnarxi");
}
if($userstep == "vipnarxi"){
if($tx=="🗄 Boshqaruv"){
unlink("step/$cid.txt");
}else{
file_put_contents("sozlamalar/pul/vipnarx.txt","$tx");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
'parse_mode'=>"html",
'reply_markup'=>$admin1_menu
]);
unlink("step/$cid.txt");
}}

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
$bylar = file_get_contents("foydalanuvchi/hisob/$tx.nak");
$status = file_get_contents("foydalanuvchi/hisob/$tx.status");
$kirit=file_get_contents("foydalanuvchi/hisob/$tx.1.txt");
$odam = file_get_contents("foydalanuvchi/referal/$tx.txt");
$ban = file_get_contents("ban/$text.txt");
if($status == "Oddiy"){
$vip = "💎 VIPga qo'shish";
}
if($status == "ViP"){
$vip = "❌ VIPdan olish";
}
if($ban == null){
$bans = "🔔 Banlash";
}
if($ban == "ban"){
$bans = "🔕 Bandan olish";
}
bot("sendMessage",[
"chat_id"=>$cid,
"text"=>"<b>✅ Foydalanuvchi topildi:</b> <a href='tg://user?id=$tx'>$tx</a>

<b>💵 Balans:</b> $asos $pul
<b>📦 Status:</b> $status
<b>👥 Do'stlar:</b> $odam ta
<b>🗂 Buyurtmalar:</b> $bylar ta",
'parse_mode'=>"html",
"reply_markup"=>json_encode([
'inline_keyboard'=>[
[['text'=>"$bans",'callback_data'=>"ban"]],
[['text'=>"➕ Pul qo'shish",'callback_data'=>"qoshish"],['text'=>"➖ Pul ayirish",'callback_data'=>"ayirish"]],
[['text'=>"$vip",'callback_data'=>"add_vip"]],
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

if($data=="add_vip"){
$status = file_get_contents("foydalanuvchi/hisob/$saved.status");
if($status=="Oddiy"){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<a href='tg://user?id=$saved'>Foydalanuvchi</a> ViPga qo'shildi!",
'parse_mode'=>"html",
'reply_markup'=>$admin1_menu,
]);
bot('sendMessage',[
'chat_id'=>$saved,
'text'=>"<b>Admin tomonidan ViPga qo'shildingiz!</b>",
'parse_mode'=>"html",
]);
file_put_contents("foydalanuvchi/hisob/$saved.status","ViP");
}else{
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<a href='tg://user?id=$saved'>Foydalanuvchi</a> <b>ViP dan olindi!</b>",
'parse_mode'=>"html",
'reply_markup'=>$admin1_menu,
]);
bot('sendMessage',[
'chat_id'=>$saved,
'text'=>"<b>Admin tomonidan ViPdan olindingiz!</b>",
'parse_mode'=>"html",
]);
file_put_contents("foydalanuvchi/hisob/$saved.status","Oddiy");
}}

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

if($tx=="💳 Hamyonlar" and in_array($cid,$admin)){
$kategoriya = file_get_contents("sozlamalar/hamyon/kategoriya.txt");
$more = explode("\n",$kategoriya);
$soni = substr_count($kategoriya,"\n");
$keys=[];
for ($for = 1; $for <= $soni; $for++) {
$title=str_replace("\n","",$more[$for]);
$keys[]=["text"=>"$title- ni o'chirish","callback_data"=>"delete-$title"];
$keysboard2 = array_chunk($keys, 1);
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
if(is_numeric($text)){
file_put_contents("sozlamalar/hamyon/$kat/raqam.txt",$text);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Yangi to'lov tizimi qo'shildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$admin1_menu,
]);
unlink("step/$cid.txt");
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Ushbu to'lov tizimidagi hamyoningiz raqamini yuboring:</b>",
'parse_mode'=>'html',
]);
}}}

if($tx=="🎛 Tugmalar" and in_array($cid,$admin)){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🎛 Tugma sozlash bo'limidasiz tanlang:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"$tugma1",'callback_data'=>"tugmath-tugma1"]],
[['text'=>"$tugma2",'callback_data'=>"tugmath-tugma2"],['text'=>"$tugma4",'callback_data'=>"tugmath-tugma4"]],
[['text'=>"$tugma3",'callback_data'=>"tugmath-tugma3"]],
[['text'=>"$tugma5",'callback_data'=>"tugmath-tugma5"],['text'=>"$tugma6",'callback_data'=>"tugmath-tugma6"]],
[['text'=>"⚠️ O'z holiga qaytarish",'callback_data'=>"reset_tugma"]],
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

if($data=="reset_tugma" and in_array($ccid,$admin)){
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

if($data=="qoidani" and in_array($ccid,$admin)){
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

if($data=="qollanmani" and in_array($ccid,$admin)){
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

if($tx == "📊 Statistika" and in_array($cid,$admin)){
$odam=substr_count($statistika,"\n");
$load = sys_getloadavg();
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>💡 O'rtacha yuklanish:</b> <code>$load[0]</code>

👥 <b>Foydalanuvchilar: $odam ta</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔁 Yangilash",'callback_data'=>"stats"]],
]])
]);
}

if($data=="stats"){
$odam=substr_count($statistika,"\n");
$load = sys_getloadavg();
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>💡 O'rtacha yuklanish:</b> <code>$load[0]</code>

👥 <b>Foydalanuvchilar: $odam ta</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔁 Yangilash",'callback_data'=>"stats"]],
]])
]);
}

if($tx == "📢 Kanallar" and in_array($cid,$admin)){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📋 Ro'yxatni ko'rish",'callback_data'=>"majburiy_obuna3"]],
[['text'=>"➕ Kanal qo'shish",'callback_data'=>"majburiy_obuna1"],['text'=>"🗑 O'chirish",'callback_data'=>"majburiy_obuna2"]],
]])
]);
}

if($data=="majburiy_obuna"){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📋 Ro'yxatni ko'rish",'callback_data'=>"majburiy_obuna3"]],
[['text'=>"➕ Kanal qo'shish",'callback_data'=>"majburiy_obuna1"],['text'=>"🗑 O'chirish",'callback_data'=>"majburiy_obuna2"]],
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
file_put_contents("sozlamalar/kanal/ch.txt", $text);
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
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
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
$bolim = file_get_contents("sozlamalar/bot/kategoriya.txt");
$more = explode("\n",$bolim);
$soni = substr_count($bolim,"\n");
foreach($more as $mor){
$keys=[];
for ($for = 1; $for <= $soni; $for++) {
$ich=file_get_contents("sozlamalar/bot/".$more[$for]."/ichkibolim.txt");
$xizta = substr_count($ich,"\n");
$keys[]=["text"=>"$more[$for] ($xizta)","callback_data"=>"bolim=".$more[$for]];
}
$keysboard2 = array_chunk($keys, 2);
$bolimlar = json_encode([
'inline_keyboard'=>$keysboard2,
]);
}
if($bolim == null){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🤷🏻‍♂ Bo'limlar topilmadi!</b>",
'parse_mode'=>'html',
]);
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Quyidagi ijtimoiy tarmoqlardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$bolimlar,
]);
unlink("foydalanuvchi/by/buyurtma.$cid");
unlink("step/$cid.bol");
unlink("step/$cid.ich");
}}

if($data == "orqaga" and joinchat($ccid)=="true"){
$bolim = file_get_contents("sozlamalar/bot/kategoriya.txt");
$more = explode("\n",$bolim);
$soni = substr_count($bolim,"\n");
foreach($more as $mor){
$keys=[];
for ($for = 1; $for <= $soni; $for++) {
$ich=file_get_contents("sozlamalar/bot/".$more[$for]."/ichkibolim.txt");
$xizta = substr_count($ich,"\n");
$keys[]=["text"=>"$more[$for] ($xizta)","callback_data"=>"bolim=".$more[$for]];
}
$keysboard2 = array_chunk($keys, 2);
$bolim = json_encode([
'inline_keyboard'=>$keysboard2,
]);
}
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b> Quyidagi ijtimoiy tarmoqlardan birini tanlang:</b>",
'parse_mode'=>"html",
'reply_markup'=>$bolim,
]);
}

if(mb_stripos($data, "bolim=")!==false){
$ex = explode("=",$data);
$kat = $ex[1];
$royxat = file_get_contents("sozlamalar/bot/$kat/ichkibolim.txt");
file_put_contents("step/$ccid.bol","$kat");
$ids = explode("\n",$royxat);
$soni = substr_count($royxat,"\n");
foreach($ids as $id){
$key = [];
$text = "";
for ($for = 1; $for <= $soni; $for++) {
$narx = file_get_contents("sozlamalar/bot/$kat/".$ids[$for]."/narx.txt");
$text .= "<b>$for.</b> ".$ids[$for]." - $narx $pul\n";
$key[]=["text"=>"$for","callback_data"=>"byxiz=".$ids[$for]];
}
$keysboard2 = array_chunk($key, 5);
$keysboard2[] = [['text'=>"◀️ Orqaga",'callback_data'=>"orqaga"]];
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
'text'=>"🤷🏻‍♂ Xizmatlar topilmadi!",
'show_alert'=>true,
]);
}}

if(mb_stripos($data, "byxiz=")!==false){
$ex = explode("=",$data);
$kategoriya = file_get_contents("step/$ccid.bol");
$royxat = $ex[1];
$xizmat = file_get_contents("sozlamalar/bot/$kategoriya/$royxat/xizmat.txt");
$narx = file_get_contents("sozlamalar/bot/$kategoriya/$royxat/narx.txt");
$vip = file_get_contents("sozlamalar/bot/$kategoriya/$royxat/vip.txt");
$tavsif = file_get_contents("sozlamalar/bot/$kategoriya/$royxat/tavsif.txt");
$id = file_get_contents("sozlamalar/bot/$kategoriya/$royxat/id.txt");
$min = file_get_contents("sozlamalar/bot/$kategoriya/$royxat/min.txt");
$max = file_get_contents("sozlamalar/bot/$kategoriya/$royxat/max.txt");
$status = file_get_contents("foydalanuvchi/hisob/$ccid.status");
if($status=="Oddiy"){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b><u>🗄 Xizmat:</u></b> $xizmat

<b><u>💵 Xizmat narxi:</u></b> $narx $pul
<b><u>📑 Ma'lumot:</u></b> $tavsif

<b><u>🔽 Minimal buyurtma:</u></b> $min ta
<b><u>🔼 Maksimal buyurtma:</u></b> $max ta

<b><u>💎 ViP foydalanuvchilar uchun:</u></b> $vip $pul",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✅ Buyurtma berish",'callback_data'=>"buyurtma=$xizmat=$narx"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"bolim=$kategoriya"]],
]])
]);
}else{
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b><u>🗄 Xizmat:</u></b> $xizmat

<b><u>💵 Xizmat narxi:</u></b> $narx $pul
<b><u>📑 Ma'lumot:</u></b> $tavsif

<b><u>🔽 Minimal buyurtma:</u></b> $min ta
<b><u>🔼 Maksimal buyurtma:</u></b> $max ta

<b><u>💎 ViP foydalanuvchilar uchun:</u></b> $vip $pul",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✅ Buyurtma berish",'callback_data'=>"buyurtma=$xizmat=$vip"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"bolim=$kategoriya"]],
]])
]);
}}

if(mb_stripos($data, "buyurtma=")!==false){
$ex = explode("=",$data);
$xiz = $ex[1];
$narx = $ex[2];
$balance= json_decode(file_get_contents("$sayt?key=$api&action=balance"),true);
if($balance['balance']==null or $balance['balance']==0){
bot('deleteMessage',[ 
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('SendMessage',[ 
'chat_id'=>$ccid,
'text'=>"<b>⛔️ [Error] xatolik</b>

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
file_put_contents("step/$ccid.txt","by-$xiz-$narx");
}}

if(mb_stripos($userstep, "by-")!==false){
$ex = explode("-",$userstep);
$xiz = $ex[1];
$narx = $ex[2];
if($tx=="◀️ Orqaga"){
unlink("step/$cid.txt");
}else{
if(is_numeric($text)=="true"){
$b = file_get_contents("step/$cid.bol");
$min = file_get_contents("sozlamalar/bot/$b/$xiz/min.txt");
$max = file_get_contents("sozlamalar/bot/$b/$xiz/max.txt");
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
file_put_contents("step/$cid.txt","buy-$xiz-$narx"); 
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
[['text'=>"✅ Tasdiqlash",'callback_data'=>"byber-$xiz-$miqdor-$son"]],
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
unlink("step/$ccid.bol");
unlink("step/$ccid.ich");
}else{
$b = file_get_contents("step/$ccid.bol");
$i = file_get_contents("step/$ccid.ich");
$id = file_get_contents("sozlamalar/bot/$b/$i/id.txt");
$url = file_get_contents("foydalanuvchi/by/$ccid.url");
file_put_contents("foydalanuvchi/by/buyurtma.$ccid","\n".$callfrid,FILE_APPEND);
$urll=json_decode(file_get_contents("$sayt?key=$api&action=add&link=$url&quantity=$son&service=$id"),true);
$order=$urll['order'];
if($order==null){
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>⚠️ Buyurtma qabul qilinmadi!</b>",
'parse_mode'=>"html",
'disable_web_page_preview'=>true,
]);
unlink("step/$ccid.bol");
unlink("step/$ccid.ich");
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
'reply_markup'=>$menyus,
]);
bot('sendMessage',[
'chat_id'=>$builder24,
'text'=>"<b>🆕 Yangi buyurtma</b>

<b>👤 Buyurtma egasi:</b> <code>$ccid</code>
<b>📦 Buyurtma turi:</b> $xiz
<b>🔗 Havola:</b> $url
<b>🔢 Buyurtma miqdori:</b> $son ta
<b>💵 Buyurtma narxi:</b> $miqdor $pul

<b>🆔 Buyurtma IDsi:</b> <code>$pls</code>",
'parse_mode'=>"html",
]);
unlink("step/$ccid.bol");
unlink("step/$ccid.ich");
}}}

if($tx=="$tugma2" and joinchat($fid)=="true"){
if($status=="Oddiy"){
$okstat = "⬆️ Statusni oshirish";
}else{
}
$odam=file_get_contents("foydalanuvchi/referal/$cid.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🔎 ID raqamingiz:</b> <code>$cid</code>

<b>💵 Balansingiz:</b> $asosiy $pul
<b>🗂 Buyurtmalar:</b> $by ta
<b>👥 Do'stlaringiz:</b> $odam ta

<b>📦 Statusingiz:</b> $status",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"$okstat",'callback_data'=>"okstat"]],
[['text'=>"💳 Hisobni to'ldirish",'callback_data'=>"oplata"]],
]])
]);
unlink("foydalanuvchi/by/buyurtma.$cid");
unlink("step/$cid.bol");
unlink("step/$cid.ich");
}

if($data == "orqaga12" and joinchat($ccid)=="true"){
$asosiy = file_get_contents("foydalanuvchi/hisob/$ccid.txt");
$status = file_get_contents("foydalanuvchi/hisob/$ccid.status");
$by = file_get_contents("foydalanuvchi/hisob/$ccid.nak");
$odam=file_get_contents("foydalanuvchi/referal/$ccid.txt");
if($status=="Oddiy"){
$okstat = "⬆️ Statusni oshirish";
}else{
}
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('SendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>🔎 ID raqamingiz:</b> <code>$cid</code>

<b>💵 Balansingiz:</b> $asosiy $pul
<b>🗂 Buyurtmalar:</b> $by ta
<b>👥 Do'stlaringiz:</b> $odam ta

<b>📦 Statusingiz:</b> $status",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"$okstat",'callback_data'=>"okstat"]],
[['text'=>"💳 Hisobni to'ldirish",'callback_data'=>"oplata"]],
]])
]);
}

if($data == "okstat" and joinchat($ccid)=="true"){
$asosiy = file_get_contents("foydalanuvchi/hisob/$ccid.txt");
if($get>="$vipnarx"){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>✅ ViP status muvaffaqiyatli sotib olindi!</b>",
'parse_mode'=>"html",
'reply_markup'=>$menyus,
]);
file_put_contents("foydalanuvchi/hisob/$ccid.status","ViP");
}else{
$umumiy = $vipnarx - $asosiy;
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>⚠️ Mablag' yetarli emas sizga yana $umumiy $pul kerak!</b>",
'parse_mode'=>"html",
]);
}}

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
$keyboard2 = array_chunk($key, 1);
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
$currency=file_get_contents("foydalanuvchi/hisob/$odam.1.txt");
$get = file_get_contents("foydalanuvchi/hisob/$odam.txt");
$get += $hisob;
$currency += $hisob;
file_put_contents("foydalanuvchi/hisob/$odam.txt",$get);
file_put_contents("foydalanuvchi/hisob/$odam.1.txt",$currency);
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

if($tx=="$tugma3" and joinchat($cid)=="true"){
$odam=file_get_contents("foydalanuvchi/referal/$cid.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🔗 Sizning taklif havolangiz:</b>

<code>https://t.me/$botname?start=$cid</code>

<b>1 ta taklif uchun $taklifpul $pul beriladi

Sizning takliflaringiz: $odam ta</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"👥 Do'stlarga yuborish",'url'=>"https://t.me/share/url?url=https://t.me/$botname?start=$cid"]],
]])
]);
unlink("step/$cid.bol");
unlink("step/$cid.ich");
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
unlink("step/$cid.bol");
unlink("step/$cid.ich");
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
$orderstat=json_decode(file_get_contents("$sayt?key=$api&action=status&order=$byyoq"),true);
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
$orderstat=json_decode(file_get_contents("$sayt?key=$api&action=status&order=$byxolat"),true);
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
unlink("step/$cid.bol");
unlink("step/$cid.ich");
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
}
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>✅ Murojaatingiz yuborildi.</b>

<i>Tez orada javob qaytaramiz!</i>",
'parse_mode'=>'html',
'reply_markup'=>$menyu,
]);
}

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
unlink("step/$builder24.txt");
unlink("step/$builder24.javob");
}else{
$murojat=file_get_contents("step/$cid.javob");
bot('sendMessage',[
'chat_id'=>$murojat,
'text'=>"<b>☎️ Administrator:</b>

<i>$tx</i>",
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
unlink("step/$builder24.txt");
unlink("step/$builder24.javob");
}}

if($tx=="$tugma6" and joinchat($fid)=="true"){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Ma'lumot olish uchun, quyidagi tugmalardan foydalaning:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📊 Statistika",'callback_data'=>"static"]],
[['text'=>"📚 Qo'llanma",'callback_data'=>"qollama"]],
[['text'=>"⚠️ Qoidalar",'callback_data'=>"qoidalar"]],
]])
]);
unlink("step/$cid.bol");
unlink("step/$cid.ich");
}

if($data=="tugmaolti" and joinchat($ccid)=="true"){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>Ma'lumot olish uchun, quyidagi tugmalardan foydalaning:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📊 Statistika",'callback_data'=>"static"]],
[['text'=>"📚 Qo'llanma",'callback_data'=>"qollama"]],
[['text'=>"⚠️ Qoidalar",'callback_data'=>"qoidalar"]],
]])
]);
}

if($data == "static" and joinchat($ccid)=="true"){
$odam=substr_count($statistika,"\n");
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>👥 Foydalanuvchilar soni: $odam ta</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"tugmaolti"]],
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
$orderstat=json_decode(file_get_contents("$sayt?key=$api&action=status&order=$byid"),true);
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
'text'=>"<b>❌ $id - raqamli buyurtma bekr qilindi!</b>",
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
'text'=>"<b>❌ $id - raqamli buyurtma bekr qilindi!</b>",
'parse_mode'=>"html",
]);
deleteFolder("buyurtma/$id");
$minus=file_get_contents("buyurtma/$ega.txt");
$oladi = str_replace("\n".$id."","",$minus);
file_put_contents("buyurtma/$ega.txt",$oladi);
}}

?>