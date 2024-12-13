<?php
define('API_KEY',"API_TOKEN");

$builder24 = "ADMIN_ID";
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
mkdir("foydalanuvchi/invest");
mkdir("foydalanuvchi/hisob");
mkdir("sozlamalar/hamyon");
mkdir("sozlamalar/number");
mkdir("sozlamalar/kanal");
mkdir("sozlamalar/tugma");
mkdir("sozlamalar/matn");
mkdir("sozlamalar/pul");
mkdir("statistika");
mkdir("sozlamalar");
mkdir("otkazma");
mkdir("step");
mkdir("ban");
#-----------------------------

if(!file_exists("foydalanuvchi/hisob/$fid.1.txt")){
file_put_contents("foydalanuvchi/hisob/$fid.1.txt","0");
}
if(!file_exists("foydalanuvchi/hisob/$fid.txt")){
file_put_contents("foydalanuvchi/hisob/$fid.txt","0");
}
if(!file_exists("foydalanuvchi/invest/$fid.inchiq")){
file_put_contents("foydalanuvchi/invest/$fid.inchiq","0");
}
if(!file_exists("foydalanuvchi/invest/$fid.inkir")){
file_put_contents("foydalanuvchi/invest/$fid.inkir","0");
}
if(!file_exists("foydalanuvchi/invest/$fid.son")){
file_put_contents("foydalanuvchi/invest/$fid.son","0");
}
if(!file_exists("foydalanuvchi/hisob/$fid.sarmoya")){
file_put_contents("foydalanuvchi/hisob/$fid.sarmoya","0");
}
if(!file_exists("foydalanuvchi/referal/$fid.txt")){
file_put_contents("foydalanuvchi/referal/$fid.txt","0");
}
if(!file_exists("sozlamalar/pul/referal.txt")){
file_put_contents("sozlamalar/pul/referal.txt","100");
}
if(!file_exists("sozlamalar/number/turi.txt")){
file_put_contents("sozlamalar/number/turi.txt","");
}
if(!file_exists("sozlamalar/pul/sarsoni.txt")){
file_put_contents("sozlamalar/pul/sarsoni.txt","2");
}
if(!file_exists("sozlamalar/pul/minpul.txt")){
file_put_contents("sozlamalar/pul/minpul.txt","3000");
}
if(!file_exists("sozlamalar/pul/admin.txt")){
file_put_contents("sozlamalar/pul/admin.txt","");
}
if(!file_exists("sozlamalar/pul/valyuta.txt")){
file_put_contents("sozlamalar/pul/valyuta.txt","so'm");
}
if(!file_exists("sozlamalar/pul/bonmiq.txt")){  
file_put_contents("sozlamalar/pul/bonmiq.txt","100");
}
if(!file_exists("sozlamalar/pul/bonnom.txt")){  
file_put_contents("sozlamalar/pul/bonnom.txt","");
}
if(!file_exists("sozlamalar/tugma/tugma1.txt")){
file_put_contents("sozlamalar/tugma/tugma1.txt","🏦 Investitsiya");
}
if(!file_exists("sozlamalar/tugma/tugma2.txt")){
file_put_contents("sozlamalar/tugma/tugma2.txt","💳 Hisobim");
}
if(!file_exists("sozlamalar/tugma/tugma3.txt")){
file_put_contents("sozlamalar/tugma/tugma3.txt","💵 Pul ishlash");
}
if(!file_exists("sozlamalar/tugma/tugma4.txt")){
file_put_contents("sozlamalar/tugma/tugma4.txt","📨 Bog'lanish");
}
if(!file_exists("sozlamalar/tugma/tugma5.txt")){  
file_put_contents("sozlamalar/tugma/tugma5.txt","🎁 Kunlik bonus");
}
if(!file_exists("sozlamalar/tugma/tugma6.txt")){
file_put_contents("sozlamalar/tugma/tugma6.txt","🔗 Taklifnoma");
}
if(!file_exists("sozlamalar/matn/start.txt")){
file_put_contents("sozlamalar/matn/start.txt","<b>🖥 Asosiy menyudasiz</b>");
}
if(!file_exists("sozlamalar/kanal/ch.txt")){
file_put_contents("sozlamalar/kanal/ch.txt","");
}
if(!file_exists("sozlamalar/kanal/tolovlar.txt")){
file_put_contents("sozlamalar/kanal/tolovlar.txt","");
}
if(file_get_contents("statistika/obunachi.txt")){
} else{
file_put_contents("statistika/obunachi.txt", "0");
}
if(file_get_contents("statistika/admins.txt")){
}else{
if(file_put_contents("statistika/admins.txt","$builder24"));
}
$bonus=file_get_contents("sozlamalar/pul/bonmiq.txt");
$bonusnom=file_get_contents("sozlamalar/pul/bonnom.txt");
$kiritgan=file_get_contents("foydalanuvchi/hisob/$fid.1.txt");
$asosiy=file_get_contents("foydalanuvchi/hisob/$fid.txt");
$sarhisob=file_get_contents("foydalanuvchi/hisob/$fid.sarmoya");
$minpul=file_get_contents("sozlamalar/pul/minpul.txt");
$ads=file_get_contents("sozlamalar/pul/admin.txt");
$sarsoni=file_get_contents("sozlamalar/pul/sarsoni.txt");
$pul = file_get_contents("sozlamalar/pul/valyuta.txt");
$taklifpul = file_get_contents("sozlamalar/pul/referal.txt");
$tugma1 = file_get_contents("sozlamalar/tugma/tugma1.txt");
$tugma2 = file_get_contents("sozlamalar/tugma/tugma2.txt");
$tugma3 = file_get_contents("sozlamalar/tugma/tugma3.txt");
$tugma4 = file_get_contents("sozlamalar/tugma/tugma4.txt");
$tugma5 = file_get_contents("sozlamalar/tugma/tugma5.txt");
$tugma6 = file_get_contents("sozlamalar/tugma/tugma6.txt");
$start = file_get_contents("sozlamalar/matn/start.txt");
$kanallar=file_get_contents("sozlamalar/kanal/ch.txt");
$yangi=file_get_contents("sozlamalar/kanal/tolovlar.txt");
#-----------------------------------#
$kategoriya2 = file_get_contents("sozlamalar/hamyon/kategoriya.txt");
$raqam = file_get_contents("sozlamalar/hamyon/$kategoriya2/raqam.txt");
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
]]);

$main_menuad = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"$tugma1"]],
[['text'=>"$tugma2"],['text'=>"$tugma3"]],
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
[['text'=>"📢 Kanallar"],['text'=>"📊 Statistika"]],
[['text'=>"🔎 Foydalanuvchini boshqarish"]],
[['text'=>"🎛 Tugmalar"],['text'=>"📑 Matnlar"]],
[['text'=>"🎁 Kunlik bonus sozlamalari"]],
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
[['text'=>"💳 Hamyonlar"],['text'=>"👤 Adminlar"]],
[['text'=>"💵 Yechish tizimi"],['text'=>"🗄 Boshqaruv"]],
]])
]);
}

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

if($tx=="🎁 Kunlik bonus sozlamalari" and in_array($cid,$admin)){
$bonusbor = file_get_contents("sozlamalar/pul/bonnom.txt","$tugma5");
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
file_put_contents("sozlamalar/pul/bonnom.txt","$tugma5");
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

if($tx=="*⃣ Birlamchi sozlamalar" and in_array($cid,$admin)){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>*⃣ Birlamchi sozlamalar bo'limiga xush kelibsiz!</b>

<i>Nimani o'zgartiramiz?</i>",
'parse_mode'=>"html",
'reply_markup'=> json_encode([
'inline_keyboard'=>[
[['text'=>"📋 Hozirgi holat",'callback_data'=>"hozirgi_holat"]],
[['text'=>"💵 Sarmoya (%)",'callback_data'=>"sarmoya_narxi"],['text'=>"🔐 Admin useri",'callback_data'=>"admin_user"]],
[['text'=>"💳 Minimal pul yechish narxi",'callback_data'=>"min_pul"]],
[['text'=>"🔗 Taklif narxi",'callback_data'=>"taklif_narxi"],['text'=>"💶 Valyuta nomi",'callback_data'=>"valyuta_nomi"]],
]])
]);
}

if($data == "asosiy"){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('SendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>*⃣ Birlamchi sozlamalar bo'limiga xush kelibsiz!</b>

<i>Nimani o'zgartiramiz?</i>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📋 Hozirgi holat",'callback_data'=>"hozirgi_holat"]],
[['text'=>"💵 Sarmoya (%)",'callback_data'=>"sarmoya_narxi"],['text'=>"🔐 Admin useri",'callback_data'=>"admin_user"]],
[['text'=>"💳 Minimal pul yechish narxi",'callback_data'=>"min_pul"]],
[['text'=>"🔗 Taklif narxi",'callback_data'=>"taklif_narxi"],['text'=>"💶 Valyuta nomi",'callback_data'=>"valyuta_nomi"]],
]])
]);
}

if($data=="hozirgi_holat"){
$ads=file_get_contents("sozlamalar/pul/admin.txt");
if($ads==null){
$ad="Kiritilmagan";
}else{
$ad="$ads";
}
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>Hozirgi holat:</b>

<b>1. Valyuta:</b> $pul
<b>1. Sarmoya foizi:</b> $sarsoni%
<b>2. Taklif narxi:</b> $taklifpul $pul
<b>2. Admin useri:</b> $ad
<b>3. Pul yechish narxi:</b> $minpul $pul",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"asosiy"]]
]])
]);
}

if($data == "admin_user"){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('SendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>📝 Yangi qiymatni yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqaruv"]],
]])
]);
file_put_contents("step/$ccid.txt","admin-user");
}

if($userstep == "admin-user"){
if($tx=="🗄 Boshqaruv"){
unlink("step/$cid.txt");
}else{
if(mb_stripos($text,"@")!==false){
file_put_contents("sozlamalar/pul/admin.txt",$text);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$admin1_menu,
]);
unlink("step/$cid.txt");
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⚠️ Xato kiritildi!</b>",
'parse_mode'=>'html',
]);
}}}

if($data=="sarmoya_narxi"){
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
file_put_contents("step/$ccid.txt","sarmoya");
}
if($userstep == "sarmoya"){
if($tx=="🗄 Boshqaruv"){
unlink("step/$cid.txt");
}else{
file_put_contents("sozlamalar/pul/sarsoni.txt","$tx");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
'parse_mode'=>"html",
'reply_markup'=>$admin1_menu
]);
unlink("step/$cid.txt");
}}

if($data=="min_pul"){
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
file_put_contents("step/$ccid.txt","yech");
}
if($userstep == "yech"){
if($tx=="🗄 Boshqaruv"){
unlink("step/$cid.txt");
}else{
file_put_contents("sozlamalar/pul/minpul.txt","$text");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
'parse_mode'=>"html",
'reply_markup'=>$admin1_menu
]);
unlink("step/$cid.txt");
}}

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
if($userstep == "taklif" ){
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
$kirit=file_get_contents("foydalanuvchi/hisob/$tx.1.txt");
$sarhisob=file_get_contents("foydalanuvchi/hisob/$tx.sarmoya");
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
<b>Sarmoya balans:</b> $sarhisob $pul
<b>Takliflari:</b> $odam ta

<b>Kiritgan pullari:</b> $kirit $pul",
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
'chat_id'=>$yangi,
'text'=>"<b>🔹 Foydalanuvchi: <u>$saved</u> hisobini $tx $pul'ga to'ldirdi!</b>",
'parse_mode'=>'html',
"reply_markup"=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔹 Foydalanuvchi",'url'=>"tg://user?id=$saved"]],
]])
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
file_put_contents("step/$ccid.txt","minus");
}

if($userstep == "minus"){
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

$yechturi=file_get_contents("sozlamalar/number/turi.txt");
$delmore = explode("\n",$yechturi);
$delsoni = substr_count($yechturi,"\n");
$key=[];
for ($delfor = 1; $delfor <= $delsoni; $delfor++) {
$title=str_replace("\n","",$delmore[$delfor]);
$key[]=["text"=>"$title - ni o'chirish","callback_data"=>"del-$title"];
$keyboard2 = array_chunk($key, 1);
$keyboard2[] = [['text'=>"➕ Yechish tizimi qo'shish",'callback_data'=>"new"]];
$pay2 = json_encode([
'inline_keyboard'=>$keyboard2,
]);
}

if($text == "💵 Yechish tizimi" and in_array($cid,$admin)){
if($yechturi == null){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Yechish tizimi qo'shish",'callback_data'=>"new"]],
]])
]);
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$pay2,
]);
}}

if($data == "tolovtizim"){
if($yechturi == null){
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
[['text'=>"➕ Yechish tizimi qo'shish",'callback_data'=>"new"]],
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
'reply_markup'=>$pay
]);
}}

if(mb_stripos($data,"del-")!==false){
$ex = explode("-",$data);
$tur = $ex[1];
$royxat = file_get_contents("sozlamalar/number/turi.txt");
$k = str_replace("\n".$tur."","",$royxat);
file_put_contents("sozlamalar/number/turi.txt",$k);
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"$tur - <b>Yechish tizimi o'chirildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"tolovtizim"]],
]])
]);
}

if($data == "new"){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>Yechish to'lov tizimi nomini yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqaruv"]],
]])
]);
file_put_contents("step/$ccid.txt",'turi');
}

if($userstep == "turi"){
if($tx=="🗄 Boshqarish"){
unlink("step/$cid.txt");
}else{
if(isset($text)){
$yechturi=file_get_contents("sozlamalar/number/turi.txt");
file_put_contents("sozlamalar/number/turi.txt","$yechturi\n$text");
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>To'lov tizimi qo'shildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$admin1_menu,
]);
unlink("step/$cid.txt");
}}}

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
unlink("sozlamalar/hamyon/$kat");
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

if($tx == "🎛 Tugmalar" and in_array($cid,$admin)){
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
[['text'=>"$tugma2",'callback_data'=>"tugmath-tugma2"],['text'=>"$tugma3",'callback_data'=>"tugmath-tugma3"]],
[['text'=>"$tugma4",'callback_data'=>"tugmath-tugma4"]],
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
[['text'=>"$tugma5",'callback_data'=>"tugmath-tugma5"]],
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

if($tx == "📑 Matnlar" and in_array($cid,$admin)){
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

if($data=="boshlangich"){
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
[['text'=>"🔐 To'lovlar uchun",'callback_data'=>"tolovlar"]],
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
[['text'=>"🔐 To'lovlar uchun",'callback_data'=>"tolovlar"]],
]])
]);
unlink("step/$ccid.txt");
}

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
[['text'=>"🏆 Hisob reyting",'callback_data'=>"preyting"]],
[['text'=>"🔁 Yangilash",'callback_data'=>"stats"]],
]])
]);
}

if($data =="preyting"){
$daten = [];
$rev = [];
$fayllar = glob("foydalanuvchi/hisob/*.*");
foreach($fayllar as $file){
if(mb_stripos($file,".txt")!==false){
$value = file_get_contents($file);
$id = str_replace(["foydalanuvchi/hisob/",".txt"],["",""],$file);
$daten[$value] = $id;
$rev[$id] = $value;
}
echo $file;
}
asort($rev);
$reversed = array_reverse($rev);
for($i=0;$i<10;$i+=1){
$order = $i+1;
$id = $daten["$reversed[$i]"];
$text.= "<b>{$order}</b>. <a href='tg://user?id={$id}'>{$id}</a> - "."<code>".$reversed[$i]."</code>"." <b>$pul</b>"."\n";
}
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>🏆 Top-10 hisob reyting:

$text</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"stats"]],
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
[['text'=>"🏆 Hisob reyting",'callback_data'=>"preyting"]],
[['text'=>"🔁 Yangilash",'callback_data'=>"stats"]],
]])
]);
}
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
unlink("step/$cid.txt");
}

if($data=="tolovlar"){
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
file_put_contents("step/$ccid.txt","tolovlar");
}
if($userstep == "tolovlar"){
if($tx=="🗄 Boshqaruv"){
unlink("step/$cid.txt");
}else{
if(stripos($text,"@")!==false){
file_put_contents("sozlamalar/kanal/tolovlar.txt",$text);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>$text - kanal qo'shildi</b>",
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

if($tx=="$tugma1" and joinchat($fid)=="true"){
$inbor=file_get_contents("sozlamalar/invest/$cid/invest.txt");
if($inbor){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>💳 Pulingizni kundan-kunga hech qanday sarflashlarsiz ko'paytirishning eng oson va ishonchli yo'li bu:</b> <i>Investitsiya</i>

<b>❗️Investitsiya bu nima?</b>
<i>Siz shunchaki pulingizni sarmoya saytga yoki botga tikib qo'yishingiz va mumkin. Pulingiz esa kuniga ma'lum miqdorda ko'payib boraveradi, pulni olish vaqti yoki turish muddatini o'zingiz kiritasiz va muddati tugagandan so'ng pulingiz ma'lum miqdorga ko'payib keladi!</i>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"⏳ Investitsiya holati",'callback_data'=>"investbor"]],
[['text'=>"📁 Investitsiyalarim",'callback_data'=>"investlar"]],
]])
]);
unlink("foydalanuvchi/zayafka.$cid");
}else{
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>💳 Pulingizni kundan-kunga hech qanday sarflashlarsiz ko'paytirishning eng oson va ishonchli yo'li bu:</b> <i>Investitsiya</i>

<b>❗️Investitsiya bu nima?</b>
<i>Siz shunchaki pulingizni sarmoya saytga yoki botga tikib qo'yishingiz va mumkin. Pulingiz esa kuniga ma'lum miqdorda ko'payib boraveradi, pulni olish vaqti yoki turish muddatini o'zingiz kiritasiz va muddati tugagandan so'ng pulingiz ma'lum miqdorga ko'payib keladi!</i>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Investitsiya kiritish",'callback_data'=>"invest"]],
[['text'=>"📁 Investitsiyalarim",'callback_data'=>"investlar"]],
]])
]);
unlink("foydalanuvchi/zayafka.$cid");
}}

if($data == "tugma1" and joinchat($ccid)=="true"){
$inbor=file_get_contents("sozlamalar/invest/$ccid/invest.txt");
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
if($inbor){
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>💳 Pulingizni kundan-kunga hech qanday sarflashlarsiz ko'paytirishning eng oson va ishonchli yo'li bu:</b> <i>Investitsiya</i>

<b>❗️Investitsiya bu nima?</b>
<i>Siz shunchaki pulingizni sarmoya saytga yoki botga tikib qo'yishingiz va mumkin. Pulingiz esa kuniga ma'lum miqdorda ko'payib boraveradi, pulni olish vaqti yoki turish muddatini o'zingiz kiritasiz va muddati tugagandan so'ng pulingiz ma'lum miqdorga ko'payib keladi!</i>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"⏳ Investitsiya holati",'callback_data'=>"investbor"]],
[['text'=>"📁 Investitsiyalarim",'callback_data'=>"investlar"]],
]])
]);
unlink("foydalanuvchi/zayafka.$ccid");
}else{
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>💳 Pulingizni kundan-kunga hech qanday sarflashlarsiz ko'paytirishning eng oson va ishonchli yo'li bu:</b> <i>Investitsiya</i>

<b>❗️Investitsiya bu nima?</b>
<i>Siz shunchaki pulingizni sarmoya saytga yoki botga tikib qo'yishingiz va mumkin. Pulingiz esa kuniga ma'lum miqdorda ko'payib boraveradi, pulni olish vaqti yoki turish muddatini o'zingiz kiritasiz va muddati tugagandan so'ng pulingiz ma'lum miqdorga ko'payib keladi!</i>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Investitsiya kiritish",'callback_data'=>"invest"]],
[['text'=>"📁 Investitsiyalarim",'callback_data'=>"investlar"]],
]])
]);
unlink("foydalanuvchi/zayafka.$ccid");
}}

if($data=="investlar" and joinchat($ccid)=="true"){
$inkir=file_get_contents("foydalanuvchi/invest/$ccid.inkir");
$inchiq=file_get_contents("foydalanuvchi/invest/$ccid.inchiq");
$inson=file_get_contents("foydalanuvchi/invest/$ccid.son");
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>📊 Investitsiyalar soni:</b> $inson ta

• <b>Kiritilgan pullar:</b> $inkir $pul
• <b>Chiqarilgan pullar:</b> $inchiq $pul",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"tugma1"]],
]])
]);
}

if($data=="investbor" and joinchat($ccid)=="true"){
$inpul=file_get_contents("sozlamalar/invest/$ccid/invest.txt");
$inmiq=file_get_contents("sozlamalar/invest/$ccid/miqdor.txt");
$txolat=json_decode(file_get_contents("sozlamalar/invest/$ccid/invest.kun"));
$kun = $txolat->kun;
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>🗓 Investitsiya holati:</b> $kun-kun

• <b>Kiritilgan pul:</b> $inmiq $pul
• <b>Chiqariladigan pul:</b> $inpul $pul

Agar investitsiyani bekor qilsangiz kiritgan pulingiz qaytariladi!",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"❌ Bekor qilish",'callback_data'=>"inbekor-$inmiq-$inpul"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"tugma1"]],
]])
]);
}

if(mb_stripos($data, "inbekor-")!==false){
$ex = explode("-",$data);
$miqdor = $ex[1];
$invest = $ex[2];
$pulim = file_get_contents("foydalanuvchi/hisob/$ccid.txt");
$m = $pulim + $miqdor;
file_put_contents("foydalanuvchi/hisob/$ccid.txt",$m);
$zayafka = file_get_contents("foydalanuvchi/zayafka.$ccid");
if(stripos("$zayafka","$callfrid") !== false){
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"$start",
'parse_mode'=>"html",
'reply_markup'=>$menyus,
]);
unlink("step/$ccid.txt");
}else{
file_put_contents("foydalanuvchi/zayafka.$ccid","\n".$callfrid,FILE_APPEND);
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>⚠️ Kiritilgan investitsiya bekor qilindi!</b>

<b>Asosiy balansingizga: $miqdor $pul qaytarildi!</b>",
'parse_mode'=>"html",
'reply_markup'=>$menyus,
]);
unlink("step/$ccid.txt");
deleteFolder("sozlamalar/invest/$ccid");
$inkir=file_get_contents("foydalanuvchi/invest/$ccid.inkir");
$minus=$inkir-$miqdor;
file_put_contents("foydalanuvchi/invest/$ccid.inkir","$minus");
$inson=file_get_contents("foydalanuvchi/invest/$ccid.son");
$minus1=$inson - 1;
file_put_contents("foydalanuvchi/invest/$ccid.son","$minus1");
}}

if($data=="invest" and joinchat($ccid)==true){
$inbor=file_get_contents("sozlamalar/invest/$ccid/invest.txt");
if($inbor){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('answerCallbackQuery',[
'callback_query_id'=>$callid,
'text'=>"⚠️ Sizda aktiv sarmoya mavjud!",
'show_alert'=>true,
]);
}else{
$misol1 = 1000 / 10;
$misol2 = $misol1 * $sarsoni;
$javob = 1000 + $misol2;
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>➕ Investitsiya kiritish bo'limiga xush kelibsiz!</b>

Siz botga pul kiritib qo'ysangiz kuniga ($sarsoni%) dan ko'payadi

<b><i>Agarda pulingiz kuniga $sarsoni% dan ko'paysa, siz 1000 $pul kiritib qo'ysangiz 10 kundan so'ng $javob $pul bot hisobingizga avto tushiriladi va siz pulni bot orqali chiqarib olishingiz mumkin.</i></b>

<b>🔔 Siz faqat pul kiritasiz va ma'lum vaqtdan so'ng tikilgan pulni foiz bilan chiqarib olasiz!</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"5 kun",'callback_data'=>"inv-5"],['text'=>"10 kun",'callback_data'=>"inv-10"],['text'=>"15 kun",'callback_data'=>"inv-15"]],
[['text'=>"20 kun",'callback_data'=>"inv-20"],['text'=>"25 kun",'callback_data'=>"inv-25"],['text'=>"30 kun",'callback_data'=>"inv-30"]],
[['text'=>"40 kun",'callback_data'=>"inv-40"],['text'=>"50 kun",'callback_data'=>"inv-50"],['text'=>"60 kun",'callback_data'=>"inv-60"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"tugma1"]],
]])
]);
}}

if(mb_stripos($data, "inv-")!==false){
$inbor=file_get_contents("sozlamalar/invest/$ccid/invest.txt");
if($inbor){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('answerCallbackQuery',[
'callback_query_id'=>$callid,
'text'=>"⚠️ Sizda aktiv sarmoya mavjud!",
'show_alert'=>true,
]);
}else{
$ex = explode("-",$data);
$kun = $ex[1];
$sarhisob=file_get_contents("foydalanuvchi/hisob/$ccid.sarmoya");
if($sarhisob !=="0"){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>✅ $kun-kun qabul qilindi!</b>

Kitirmoqchi bo'lgan pulingizni yuboring:",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"$sarhisob"]],
[['text'=>"◀️ Orqaga"]],
]])
]);
file_put_contents("step/$ccid.txt","sarpul-$kun");
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$callid,
'text'=>"⚠️ Sarmoya hisobingiz 0 ga teng!",
'show_alert'=>true,
]);
}}}

if(mb_stripos($userstep, "sarpul-")!==false){
$ex = explode("-",$userstep);
$kun = $ex[1];
$kirit = $text/100*$sarsoni;
$invest = $kirit*$kun+$text;
if($tx=="◀️ Orqaga"){
unlink("step/$cid.txt");
}else{
if($sarhisob >= $text){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📖 Sarmoya ma'lumoti!</b>

• <b>Kutiladigan kun:</b> $kun-kun

• <b>Kiritiladigan pul:</b> $text $pul
• <b>Chiqariladigan pul:</b> $invest $pul

<b>⚠️ Agarda davom etishni hohlasangiz [ Tasdiqlash ] tugmasini bosing!</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✅ Tasdiqlash",'callback_data'=>"invok-$kun-$text-$invest"]],
[['text'=>"❌ Bekor qilish",'callback_data'=>"bekor"]]
]])
]);
unlink("step/$cid.txt");
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"⚠️ <b>Mablag'yetarli emas!</b>",
'parse_mode'=>'html',
]);
}}}

if(mb_stripos($data, "invok-")!==false){
$ex = explode("-",$data);
$kun = $ex[1];
$miqdor = $ex[2];
$invest = $ex[3];
$pulim = file_get_contents("foydalanuvchi/hisob/$ccid.sarmoya");
$m = $pulim - $miqdor;
file_put_contents("foydalanuvchi/hisob/$ccid.sarmoya",$m);
$zayafka = file_get_contents("foydalanuvchi/zayafka.$ccid");
if(stripos("$zayafka","$callfrid") !== false){
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"$start",
'parse_mode'=>"html",
'reply_markup'=>$menyus,
]);
unlink("step/$ccid.txt");
}else{
file_put_contents("foydalanuvchi/zayafka.$ccid","\n".$callfrid,FILE_APPEND);
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$builder24,
'text'=>"<b>🔹 Foydalanuvchi: <u><a href='tg://user?id=$ccid'>$ccid</a></u> botga investitsiya kiritdi!</b>

• <b>Kiritilgan kun:</b> $kun-kun

• <b>Kiritilgan pul:</b> $miqdor $pul
• <b>Chiqariladigan pul:</b> $invest $pul",
'parse_mode'=>'html',
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>✅ Investitsiya muvaffaqiyatli qabul qilindi!</b>",
'parse_mode'=>"html",
'reply_markup'=>$menyus,
]);
unlink("step/$ccid.txt");
mkdir("sozlamalar/invest");
mkdir("sozlamalar/invest/$ccid");
file_put_contents("sozlamalar/invest/$ccid/invest.txt","$invest");
file_put_contents("sozlamalar/invest/$ccid/miqdor.txt","$miqdor");
$inkir=file_get_contents("foydalanuvchi/invest/$ccid.inkir");
$plus=$inkir+$miqdor;
file_put_contents("foydalanuvchi/invest/$ccid.inkir","$plus");
$inson=file_get_contents("foydalanuvchi/invest/$ccid.son");
$plus1=$inson + 1;
file_put_contents("foydalanuvchi/invest/$ccid.son","$plus1");
date_default_timezone_set('Asia/Tashkent');
$t=date("d");
$d['sana']=$t;
$d['kun']=$kun;
file_put_contents("sozlamalar/invest/$ccid/invest.kun",json_encode($d));
}}

date_default_timezone_set('Asia/Tashkent'); 
$t=date("d"); 
$glob=glob("sozlamalar/invest/*/invest.txt"); 
foreach($glob as $globa){
$ids = str_replace(["sozlamalar/invest/","/invest.txt"], ["",""], $globa); 
$files = json_decode(file_get_contents("sozlamalar/invest/$ids/invest.kun")); 
echo $files->kun; 
if($files->sana!=$t){ 
$d["sana"]=$t;
$d["kun"]=$files->kun-1; 
file_put_contents("sozlamalar/invest/$ids/invest.kun",json_encode($d)); 
}
if($files->kun==0 or $files->kun<=0){
$pulber=file_get_contents("sozlamalar/invest/$ids/invest.txt");
$pul = file_get_contents("foydalanuvchi/hisob/$ids.txt");
$m = $pul + $pulber;
file_put_contents("foydalanuvchi/hisob/$ids.txt",$m);
$inchiq=file_get_contents("foydalanuvchi/invest/$fid.inchiq");
$plus=$inchiq+$pulber;
file_put_contents("foydalanuvchi/invest/$fid.ininchiq","$plus");
bot('sendMessage',[ 
'chat_id'=>$ids, 
'text'=>"<b>🪪 Sarmoyangiz muvaffaqiyatli tugatildi!</b>

<i>Asosiy hisobingizga $pulber $pul qo'shildi</i>",
'parse_mode'=>'html',
]);
deleteFolder("sozlamalar/invest/$ids"); 
}}

if($tx=="$tugma2" and joinchat($fid)=="true"){
$odam=file_get_contents("foydalanuvchi/referal/$cid.txt");
if(in_array($cid,$admin)){
$botda = "Adminstrator";
}else{
$botda = "Foydalanuvchi";
}
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"
┌🏛<b>Sizning botdagi hisobingiz</b>
├<b>Botdagi vazifa:</b> $botda
├<b>ID raqamingiz:</b> <code>$cid</code>
├<b>Asosiy balans:</b> $asosiy $pul
├<b>Sarmoya balans:</b> $sarhisob $pul
├<b>Takliflaringiz:</b> $odam ta
├<b>Kiritilgan pullar:</b> $kiritgan $pul
└<b>@$botname Official 2023</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"💳 Pul yechish",'callback_data'=>"yechish"],['text'=>"🔁 Almashtirish",'callback_data'=>"almash"]],
[['text'=>"➕ Hisobni to'ldirish",'callback_data'=>"oplata"]],
]])
]);
unlink("foydalanuvchi/zayafka.$cid");
}

$turi = file_get_contents("sozlamalar/number/turi.txt");
$more = explode("\n",$turi);
$soni = substr_count($turi,"\n");
$keys=[];
for ($for = 1; $for <= $soni; $for++) {
$title=str_replace("\n","",$more[$for]);
$keys[]=["text"=>"$title","callback_data"=>"pay-$title"];
$keysboard2 = array_chunk($keys, 2);
$keysboard2[] = [['text'=>"◀️ Orqaga",'callback_data'=>"orqaga12"]];
$pay = json_encode([
'inline_keyboard'=>$keysboard2,
]);
}

if($data == "yechish"){
$turi = file_get_contents("sozlamalar/number/turi.txt");
if($turi != null){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('SendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>💳 Pul yechish tizimlaridan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$pay
]);
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$callid,
'text'=>"⚠️ Pul yechish tizimlari qo'shilmagan!",
'show_alert'=>true,
]);
}}

if(mb_stripos($data, "pay-")!==false){
$ex = explode("-",$data);
$wallet = $ex[1];
$pulim = file_get_contents("foydalanuvchi/hisob/$ccid.txt");
if($pulim>=$minpul){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('SendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>✅ $wallet qabul qilindi!</b>

Hamyon raqamini yuboring:",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]],
]])
]);
file_put_contents("step/$ccid.txt","wallet-$wallet");
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$callid,
'text'=>"⚠️ Minimal pul yechish narxi: $minpul $pul",
'show_alert'=>true,
]);
}}

if(mb_stripos($userstep, "wallet-")!==false){
$ex = explode("-",$userstep);
$wallet = $ex[1];
if($tx=="◀️ Orqaga"){
unlink("step/$cid.txt");
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>❕Qancha pul yechmoqchisiz?</b>

<b>Asosiy balans:</b> $asosiy $pul (komissa 5%)",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]],
]])
]);
file_put_contents("step/$cid.txt","miqdor-$wallet-$text");
}}

if(mb_stripos($userstep, "miqdor-")!==false){
$ex = explode("-",$userstep);
$wallet = $ex[1];
$num = $ex[2];
$foiz = $text/100*5;
$miqdor = $text - $foiz;
if($tx=="◀️ Orqaga"){
unlink("step/$cid.txt");
}else{
if($text >= $minpul){
if($asosiy >= $text){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"✅ <b>Qabul qilindi!</b>\n\n• <b>To'lov turi:</b> $wallet\n• <b>Pul miqdori:</b> $miqdor $pul\n• <b>Hamyon raqamingiz:</b> $num\n\n<b>Ma'lumotlar to'g'ri ekanligiga ishonch hosil qilgan bo'lsangiz, ✅ Tasdiqlash tugmasini bosing!</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✅ Tasdiqlash",'callback_data'=>"tasdiq-$wallet-$num-$miqdor"]],
[['text'=>"❌ Bekor qilish",'callback_data'=>"bekor"]]
]])
]);
unlink("step/$cid.txt");
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"⚠️ <b>Hisobingizda mablag'yetarli emas!</b>",
'parse_mode'=>'html',
]);
}}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⚠️ Minimal pul yechish narxi: $minpul $pul</b>",
'parse_mode'=>'html',
]);
}}}

if($data == "bekor"){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('SendMessage',[
'chat_id'=>$ccid,
'text'=>"$start",
'parse_mode'=>'html',
'reply_markup'=>$menyus,
]);
}

if(mb_stripos($data, "tasdiq-")!==false){
$ex = explode("-",$data);
$wallet = $ex[1];
$number = $ex[2];
$miqdor = $ex[3];
$pul = file_get_contents("foydalanuvchi/hisob/$ccid.txt");
$m = $pul - $miqdor;
file_put_contents("foydalanuvchi/hisob/$ccid.txt",$m);
$zayafka = file_get_contents("foydalanuvchi/zayafka.$ccid");
if(stripos("$zayafka","$callfrid") !== false){
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"$start",
'parse_mode'=>"html",
'reply_markup'=>$menyus,
]);
unlink("step/$ccid.txt");
}else{
file_put_contents("foydalanuvchi/zayafka.$ccid","\n".$callfrid,FILE_APPEND);
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>✉️ Pul yechib olish uchun adminga ariza yuborildi!</b>",
'parse_mode'=>"html",
'reply_markup'=>$menyus,
]);
unlink("step/$ccid.txt");
bot('SendMessage',[
'chat_id'=>$builder24,
'text'=>"💵 <a href='tg://user?id=$ccid'>$ccid</a> <b>pul yechib olmoqchi!</b>

• <b>To'lov turi:</b> $wallet
• <b>Pul miqdori:</b> $miqdor
• <b>Hamyon raqami:</b> $number",
'disable_web_page_preview'=>true,
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✅ To'landi",'callback_data'=>"tolandi-$ccid-$number-$miqdor"],['text'=>"❌ To'lanmadi",'callback_data'=>"tolanmadi-$ccid-$miqdor"]],
]])
]);
}}

if(mb_stripos($data,"tolandi-")!==false){
$ex = explode("-",$data);
$id = $ex[1];
$number = $ex[2];
$miqdor = $ex[3];
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('SendMessage',[
'chat_id'=>$builder24,
'text'=>"<a href='tg://user?id=$id'>Foydalanuvchi</a><b> $miqdor $pul puli to'lab berildi!</b>",
'parse_mode'=>'html',
]);
bot('sendMessage',[
'chat_id'=>$yangi,
'text'=>"<b>🔹 Foydalanuvchi: <u>$id</u> puli $miqdor $pul to'lab berildi!</b>",
'parse_mode'=>'html',
"reply_markup"=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔹 Foydalanuvchi",'url'=>"tg://user?id=$id"]],
]])
]);
bot('SendMessage',[
'chat_id'=>$id,
'text'=>"<b>✅ Pullaringiz to'lab berildi</b>

<i>Biz bilan bo'ling va pullaringizni hech qanday sarflashlarsiz ko'paytiring!</i>",
'parse_mode'=>'html',
]);
unlink("foydalanuvchi/zayafka.$id");
}

if(mb_stripos($data,"tolanmadi-")!==false){
$ex = explode("-",$data);
$id = $ex[1];
$miqdor = $ex[2];
$pul = file_get_contents("foydalanuvchi/hisob/$id.txt");
$m = $pul + $miqdor;
file_put_contents("foydalanuvchi/hisob/$id.txt",$m);
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('SendMessage',[
'chat_id'=>$builder24,
'text'=>"<a href='tg://user?id=$id'>Foydalanuvchi</a> <b>arizasi bekor qilindi!</b>",
'parse_mode'=>'html',
]);
bot('SendMessage',[
'chat_id'=>$id,
'text'=>"<b>⚠️ Arizangiz bekor qilindi!</b>",
'parse_mode'=>'html',
]);
unlink("foydalanuvchi/zayafka.$id");
}

if($data == "orqaga12" and joinchat($ccid)=="true"){
$hisob = file_get_contents("foydalanuvchi/hisob/$ccid.txt");
$kiritgan = file_get_contents("foydalanuvchi/hisob/$ccid.1.txt");
$sar = file_get_contents("foydalanuvchi/hisob/$ccid.sarmoya");
$odam=file_get_contents("foydalanuvchi/referal/$ccid.txt");
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
if(in_array($ccid,$admin)){
$botda = "Adminstrator";
}else{
$botda = "Foydalanuvchi";
}
bot('SendMessage',[
'chat_id'=>$ccid,
'text'=>"
┌🏛<b>Sizning botdagi hisobingiz</b>
├<b>Botdagi vazifa:</b> $botda
├<b>ID raqamingiz:</b> <code>$ccid</code>
├<b>Asosiy balans:</b> $hisob $pul
├<b>Sarmoya balans:</b> $sar $pul
├<b>Takliflaringiz:</b> $odam ta
├<b>Kiritilgan pullar:</b> $kiritgan $pul
└<b>@$botname Official 2023</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"💳 Pul yechish",'callback_data'=>"yechish"],['text'=>"🔁 Almashtirish",'callback_data'=>"almash"]],
[['text'=>"➕ Hisobni to'ldirish",'callback_data'=>"oplata"]],
]])
]);
}

if($data == "almash" and joinchat($ccid)=="true"){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>🔂 Almashuv turini tanlang:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"Asosiy -> Sarmoya",'callback_data'=>"assar"]],
[['text'=>"Sarmoya -> Asosiy",'callback_data'=>"saras"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"orqaga12"]],
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
unlink("foydalanuvchi/zayafka.$cid");
}

if($data=="assar" and joinchat($ccid)=="true"){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
$hisob = file_get_contents("foydalanuvchi/hisob/$ccid.txt");
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>Qancha mablag'ingizni o'tkazmoqchisiz?

Hisobingiz:</b> $hisob $pul",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]])
]);

file_put_contents("step/$ccid.txt","assar");
}
if($userstep == "assar" and $tx !== "◀️ Orqaga" and joinchat($fid)=="true"){
if(is_numeric($text)){
$otkazma = file_get_contents("foydalanuvchi/hisob/$cid.txt");
$otkazma2 = file_get_contents("foydalanuvchi/hisob/$cid.sarmoya");
$csful = $text / 1 * 1;
if($otkazma>=$csful and $tx>=0){
$plus = $otkazma2 + $text;
$minus = $otkazma - $csful;
file_put_contents("foydalanuvchi/hisob/$cid.txt","$minus");
file_put_contents("foydalanuvchi/hisob/$cid.sarmoya","$plus");
bot("sendMessage",[
"chat_id"=>$cid,
"text"=>"<b>✅ Muvaffaqiyatli almashtirildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$menyu,
]);
unlink("step/$cid.txt");
}else{
bot("sendMessage",[
"chat_id"=>$cid,
"text"=>"<b>⚠️ Mablag' yetarli emas!</b>",
'parse_mode'=>'html',
]);
}}else{
bot("sendMessage",[
"chat_id"=>$cid,
"text"=>"<b>⚠️ Raqam bilan kiriting!</b>",
'parse_mode'=>'html',
]);
}}

if($data=="saras" and joinchat($ccid)=="true"){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
$hisob = file_get_contents("foydalanuvchi/hisob/$ccid.sarmoya");
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>Qancha mablag'ingizni o'tkazmoqchisiz?

Hisobingiz:</b> $hisob $pul",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]])
]);

file_put_contents("step/$ccid.txt","saras");
}
if($userstep == "saras" and $tx !== "◀️ Orqaga" and joinchat($fid)=="true"){
if(is_numeric($text)){
$otkazma = file_get_contents("foydalanuvchi/hisob/$cid.sarmoya");
$otkazma2 = file_get_contents("foydalanuvchi/hisob/$cid.txt");
$csful = $text / 1 * 1;
if($otkazma>=$csful and $tx>=0){
$plus = $otkazma + $text;
$minus = $otkazma2 - $csful;
file_put_contents("foydalanuvchi/hisob/$cid.txt","$plus");
file_put_contents("foydalanuvchi/hisob/$cid.sarmoya","$minus");
bot("sendMessage",[
"chat_id"=>$cid,
"text"=>"<b>✅ Muvaffaqiyatli almashtirildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$menyu,
]);
unlink("step/$cid.txt");
}else{
bot("sendMessage",[
"chat_id"=>$cid,
"text"=>"<b>⚠️ Mablag' yetarli emas!</b>",
'parse_mode'=>'html',
]);
}}else{
bot("sendMessage",[
"chat_id"=>$cid,
"text"=>"<b>⚠️ Raqam bilan kiriting!</b>",
'parse_mode'=>'html',
]);
}}

if($data=="oplata" and joinchat($ccid)==true){
$kategoriya = file_get_contents("sozlamalar/hamyon/kategoriya.txt");
$more = explode("\n",$kategoriya);
$soni = substr_count($kategoriya,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$title = str_replace("\n","",$more[$for]);
$key[]=["text"=>"$title","callback_data"=>"karta-$title"];
$keyboard2 = array_chunk($key, 2);
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
bot('sendMessage',[
'chat_id'=>$yangi,
'text'=>"<b>🔹 Foydalanuvchi: <u>$odam</u> hisobini $hisob $pul'ga to'ldirdi!</b>",
'parse_mode'=>'html',
"reply_markup"=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔹 Foydalanuvchi",'url'=>"tg://user?id=$odam"]],
]])
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

if($tx=="$tugma3" and joinchat($fid)=="true"){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"$tugma6",'callback_data'=>"taklifnoma"]],
[['text'=>"$bonusnom",'callback_data'=>"kunlik"]],
]])
]);
unlink("foydalanuvchi/zayafka.$cid");
}

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
[['text'=>"$tugma6",'callback_data'=>"taklifnoma"]],
[['text'=>"$bonusnom",'callback_data'=>"kunlik"]],
]])
]);
}

if($data == "taklifnoma" and joinchat($ccid)=="true"){
$odam=file_get_contents("foydalanuvchi/referal/$ccid.txt");
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>🔗 Sizning taklif havolangiz:</b>

https://t.me/$botname?start=$ccid

<b>1 ta taklif uchun $taklifpul $pul beriladi

Sizning takliflaringiz: $odam ta</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"orqaga3"]],
]])
]);
}

if($tx=="$tugma4" and joinchat($fid)=="true"){
if($ads==null){
$ad="@$botname";
}else{
$ad=="$ads";
}
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📞 Aloqa markazi: $ad</b>

<b>📝 Murojaat matnini yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]],
]])
]);
file_put_contents("step/$cid.txt","murojat");
unlink("foydalanuvchi/zayafka.$cid");
}

if($userstep=="murojat"){
if($tx=="◀️ Orqaga"){
unlink("step/$cid.txt");
}else{
file_put_contents("step/$cid.murojat","$cid");
$murojat=file_get_contents("step/$cid.murojat");
bot('sendMessage',[
'chat_id'=>$builder24,
'text'=>"<b>📨 Yangi murojat keldi:</b> <a href='tg://user?id=$murojat'>$murojat</a>

<b>📑 Murojat matni:</b> $tx

<b>⏰ Kelgan vaqti:</b> $soat",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"Javob yozish",'callback_data'=>"yozish=$murojat"]],
]])
]);
bot('sendMessage',[
'chat_id'=>$murojat,
'text'=>"<b>✅ Murojaatingiz yuborildi.</b>

<i>Tez orada javob qaytaramiz!</i>",
'parse_mode'=>'html',
'reply_markup'=>$menyu,
]);
unlink("step/$murojat.txt");
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
unlink("step/$murojat.murojat");
unlink("step/$cid.txt");
unlink("step/$cid.javob");
}}
?>