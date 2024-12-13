<?php

ini_set("display_errors",1);
const API_KEY="LITE_TOKEN";

$adminid = "LITE_ID";
$botuser = bot('getme',['bot'])->result->username;
$start=get("settings/start.txt");

function number($a){
$form = number_format($a,00,' ',' ');
return $form;
}

function put($h,$i){
file_put_contents($h,$i);
}
function get($id){
return file_get_contents($id);
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


function joinX($chat,$id){
$b=bot('getChatMember',[
'chat_id'=>$chat,
'user_id'=>$id,
])->result->status;
if(($b=="creator" or $b=="administrator" or $b=="member")){
return true;
}else{
bot('sendMessage',[
'chat_id'=>$id,
'text'=>"<b>⚠️ Bot kanalda admin emas yoki siz obuna bo'lmagansiz!</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"panel=kanal"]],
]
]),
]);
return false;
}
}

function joinO($chat,$id){
$b=bot('getChatMember',[
'chat_id'=>$chat,
'user_id'=>$id,
])->result->status;
if(($b=="creator" or $b=="administrator" or $b=="member")){
return true;
}else{
bot('sendMessage',[
'chat_id'=>$id,
'text'=>"<b>⚠️ Bot kanalda admin emas yoki siz obuna bo'lmagansiz!</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"start"]],
]
]),
]);
return false;
}
}

function joinA($id,$i){
$b=bot('getChat',[
'chat_id'=>$id,
]);
if($b->ok=="1"){
return true;
}else{
bot('sendMessage',[
'chat_id'=>$i,
'text'=>"<b>⚠️ Foydalanuvchi topilmadi!</b>

Qaytadan urinib ko‘ring:",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"panel=admin"]],
]
]),
]);
return false;
}
}

function joinR($id,$i){
$b=bot('getChat',[
'chat_id'=>$id,
]);
if($b->ok=="1"){
return true;
}else{
bot('sendMessage',[
'chat_id'=>$i,
'text'=>"<b>⚠️ Foydalanuvchi topilmadi!</b>",
'parse_mode'=>"html",
]);
return false;
}
}


function sms($id,$text,$m){
return bot('sendMessage',[
'chat_id'=>$id,
'text'=>"<b>$text</b>",
"parse_mode"=>HTML,
"reply_markup"=>$m,
]);
}

function del($id,$mid){
return bot('deleteMessage',[
'chat_id'=>$id,
'message_id'=>$mid,
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

$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$data = $update->callback_query->data;
$chat_id = $update->callback_query->message->chat->id;
$messageid = $message->message_id;
$id = $update->callback_query->id;
$cid = $message->from->id;
$from_id = $update->callback_query->from->id;
$firstname = $message->from->first_name;
$first_name = $update->callback_query->from->first_name;
$user_name = $update->callback_query->from->username;
$lastname = $message->from->last_name;
$message_id = $update->callback_query->message->message_id;
$text = $message->text;
$messagereply = $message->reply_to_message->message_id;
$user = $message->from->username;
$userid = $update->callback_query->from->username;
$query = $update->inline_query->query;
$inlineid = $update->inline_query->from->id;
$for = $message->forward_from;
$for_id=$for->id;

mkdir("settings");
mkdir("user");

if(get("settings/delids.txt")){
}else{
put("settings/delids.txt","0");
}
$delid=get("settings/delids.txt");

if(get("settings/kanalLimit.txt")){
}else{
put("settings/kanalLimit.txt","50000");
}
$kanalLimit=get("settings/kanalLimit.txt");

if(get("settings/adminLimit.txt")){
}else{
put("settings/adminLimit.txt","40000");
}
$adminLimit=get("settings/adminLimit.txt");

$step=get("user/$cid.step");
if(get("user/$cid.pul")){
}else{
put("user/$cid.pul",0);
}
$pul=get("user/$cid.pul");

if(get("settings/ref.txt")){
}else{
put("settings/ref.txt","0");
}
$ref=get("settings/ref.txt");

if(get("settings/val.txt")){
}else{
put("settings/val.txt","₽");
}
$valyuta=get("settings/val.txt");

if(get("settings/narxi.txt")){
}else{
put("settings/narxi.txt","0");
}
$narxi=get("settings/narxi.txt");

if(get("settings/elon.url")){
}else{
put("settings/elon.url","@HaydarovUz");
}
$elon=get("settings/elon.url");

if(get("settings/elonlar.txt")){
}else{
put("settings/elonlar.txt","👁‍🗨 E'lonlarni kuzatish");
}
$elonlar=get("settings/elonlar.txt");

if(get("settings/qoshish.txt")){
}else{
put("settings/qoshish.txt","🆕 E'lon qo'shish");
}
$qoshish=get("settings/qoshish.txt");

if(get("settings/hisob.txt")){
}else{
put("settings/hisob.txt","📱 Kabinetim");
}
$hisob=get("settings/hisob.txt");

if(get("settings/admins.txt")){
}else{
put("settings/admins.txt","$adminid");
}
$admin=get("settings/admins.txt");

if(get("settings/start.txt")){
}else{
put("settings/start.txt","
@%botuser% - reklama almashinuvi! Kanalingizda reklama sotib olish yoki sotish ancha oson va qulayroq!

Kanalingizdagi reklama sotish bo'yicha e'lon qo'shish uchun quyidagi tugmani bosing

Barcha e'lonlar %elon% kanalida e'lon qilinadi");
}
$cstep=get("user/$chat_id.step");
function addstat($id){
    $check = file_get_contents("settings/stat.txt");
    $rd = explode("\n",$check);
    if(!in_array($id,$rd)){
        file_put_contents("settings/stat.txt","\n".$id,FILE_APPEND);
    }
}


function joinchat($did){
$kanal=get("settings/joinchat.txt");
if($kanal==null){
return true;
}
$ids = explode("\n",$kanal);
$soni = substr_count($kanal,"@");
foreach($ids as $id){
$keyboards = [];
$k=[];
for ($for = 1; $for <= $soni; $for++) {
$kanall=str_replace("@","",$ids[$for]);
$ism=bot('getChat',['chat_id'=>"@".$kanall])->result->title;
$keyboards[]=["text"=>"$ism","url"=>"https://t.me/$kanall"];
}
$keyboard2=array_chunk($keyboards, 1);
$keyboard2[]=[["text"=>"✅ Tasdiqlash","callback_data"=>"start"]];
$keyboard=json_encode([
'inline_keyboard'=>$keyboard2,
]);
}
$get = bot('getChatMember',[
'chat_id'=>$id,
'user_id'=>$did,
])->result->status;
if($get == "member" or $get == "administrator" or $get == "creator"){
return true;
}else{
bot('sendMessage',[
'chat_id'=>$did,
'text'=>"
<b>⚠️ Botdan to'liq foydalanish uchun quyidagi kanallarimizga obuna bo'ling!</b>",
'parse_mode'=>'html',
'reply_markup'=>$keyboard,
]); 
return false;
}
}

$menu=json_encode([
'inline_keyboard'=>[
[['text'=>"$elonlar",'url'=>"https://t.me/".str_replace("@","",$elon).""]],
[['text'=>"$qoshish",'callback_data'=>"user=qoshish"],['text'=>"$hisob",'callback_data'=>"user=hisob"]],
[['text'=>"🗄 Boshqaruv paneli",'callback_data'=>"panel"]],
]
]);

$panel=json_encode([
'inline_keyboard'=>[
[['text'=>"📊 Statistika",'callback_data'=>"panel=stat=$panel"],['text'=>"📢 Kanallar",'callback_data'=>"panel=kanal"]],
[['text'=>"🔎 Foydalanuvchini boshqarish",'callback_data'=>"panel=boshqarish"]],
[['text'=>"🎛️ Tugmalar",'callback_data'=>"panel=tugma"],['text'=>"📃 Matnlar",'callback_data'=>"panel=text"]],
[['text'=>"🤵 Adminlar",'callback_data'=>"panel=admin"],['text'=>"💵 Narx sozlash",'callback_data'=>"panel=narx"]],
[['text'=>"🚀 Xabarnoma",'callback_data'=>"panel=xabar"],['text'=>"◀️ Orqaga",'callback_data'=>"start"]],
]
]);

$menu2=json_encode([
'inline_keyboard'=>[
[['text'=>"$elonlar",'url'=>"https://t.me/".str_replace("@","",$elon).""]],
[['text'=>"$qoshish",'callback_data'=>"user=qoshish"],['text'=>"$hisob",'callback_data'=>"user=hisob"]],
]
]);
$soat=date('H:i:s');
$sana=date("Y-m-d");
$start=str_replace("%name%",$firstname.$first_name,$start);
$start=str_replace("%id%",$chat_id.$cid,$start);
$start=str_replace("%botuser%",$botuser,$start);
$start=str_replace("%date%",$sana,$start);
$start=str_replace("%time%",$soat,$start);
$start=str_replace("%username%",$user,$start);
$start=str_replace("%elon%",$elon,$start);
$start=str_replace("%reflink%","https://t.me/$botuser?start=$cid$chat_id",$start);

if($text=="/start" and joinchat($cid)==1){
$refd=get("data/".$cid.".id");
$pul=get("user/$refd.pul");
$pul=$pul+$ref;
put("user/".$refd.".pul",$pul);
sms($refd,"+$ref $valyuta",null);
put("data/$cid.id",0);
put("user/$cid.step","");
if(mb_stripos($admin,$cid)!==false){
sms($cid,$start,$menu);
}else{
sms($cid,$start,$menu2);
}
}

if((stripos($data,"user=")!==false)){
$res=explode("=",$data)[1];
if($res=="hisob"){
$pul=get("user/$chat_id.pul");
edit($chat_id,$message_id,"
<b>🖥️ Kabinetingizga xush kelibsiz</b>

🔎 ID raqamingiz: <code>$chat_id</code>
💵 Balansingiz: <b>$pul $valyuta</b>

<b>@$botuser - bilan oson reklama soting yoki sotib oling!</b>",json_encode([
'inline_keyboard'=>[
[['text'=>"🔗 Taklifnoma",'callback_data'=>"user=ref"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"start"]],
]]));
}elseif($res=="qoshish"){
$pul=get("user/$chat_id.pul");
if($pul>=$narxi){
edit($chat_id,$message_id,"Kanal yoki guruxingiz manzilini yuboring: 
(masalan: $elon)",json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"start"]],
]]));
put("user/$chat_id.step","new_1");
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$id,
'text'=>"
E'lon joylash narxi: $narxi $valyuta

Hisobingizda yetarli mablag‘ mavjud emas",
'show_alert'=>true,
]);
}
}elseif($res=="ref"){
edit($chat_id,$message_id,"
🔗 Takliflar orqali pul ishlash

<code>https://t.me/$botuser?start=$chat_id</code>

👤 Taklif narxi: $ref $valyuta",json_encode([
'inline_keyboard'=>[
[['text'=>"↗️ Ulashish",'url'=>"https://t.me/share/url?url=https://t.me/$botuser?start=$chat_id"]],
[['text'=>"⬅️ Orqaga",'callback_data'=>"user=hisob"]],
]
]));
}
}

if($data=="start" and joinchat($chat_id)==1){
$refd=get("data/".$chat_id.".id");
$pul=get("user/$refd.pul");
$pul=$pul+$ref;
put("user/".$refd.".pul",$pul);
sms($refd,"+$ref $valyuta",null);
put("data/$chat_id.id",0);
put("user/$chat_id.step","");
put("user/$chat_id-order.json","");
if(mb_stripos($admin,$chat_id)!==false){
edit($chat_id,$message_id,$start,$menu);
}else{
edit($chat_id,$message_id,$start,$menu2);
}
}

if($data=="panel" or $data=="orqa"){
if(mb_stripos($admin,$chat_id)!==false){
put("user/$chat_id.step","");
edit($chat_id,$message_id,"👨‍💻 Assalomu alaykum, admin panelga xush kelibsiz!",$panel);
}
}

if((stripos($data,"panel=")!==false and (mb_stripos($admin,$chat_id)!==false) )){
$res=explode("=",$data)[1];
put("user/$chat_id.step","");
if($res=="stat"){
$adm=get("settings/admins.txt");
$a=substr_count($adm,"\n");
$kan=get("settings/joinchat.txt");
$k=substr_count($kan,"\n");
$fil=get("settings/stat.txt");
$dl=get("settings/delids.txt");
$dl=substr_count($dl,"\n");
$stat=substr_count($fil,"\n");
$f=$stat-$dl;
edit($chat_id,$message_id,"
📊 @$botuser - statistikasi:

◾️ Foydalanuvchilar: <b>$stat</b>
◾️ Faol foydalanuvchilar: <b>$f</b>
◾️ O‘chirilgan foydalanuvchilar: <b>$dl</b>
",json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"orqa"]],
]]));
}else if($res=="narx"){
edit($chat_id,$message_id,"
<i> Hozirgi ma'lumotlar:
 
1. E'lon joylash narxi: <b>$narxi</b>
2. Asosiy valyuta: <b>$valyuta</b>
3. Taklif narxi: <b>$ref</b>
Quyidagi o’zgartirish tugmasini tanlang:</i>",json_encode([
'inline_keyboard'=>[
[['text'=>"1",'callback_data'=>"narx=elon"],['text'=>"2",'callback_data'=>"narx=val"],['text'=>"3",'callback_data'=>"narx=ref"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"orqa"]],
]]));
}else if($res=="boshqarish"){
edit($chat_id,$message_id,"Kerakli foydalanuvchi ID raqamini yuboring:",json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"orqa"]],
]]));
put("user/$chat_id.step","boshqarish");
}else if($res=="xabar"){
edit($chat_id,$message_id,"
Quyidagi xabar yuborish turini tanlang:

1. «Forward» shaklida xabar yuboring
2. Oddiy matnli xabar (tugma rasm videolarsiz)",json_encode([
'inline_keyboard'=>[
[['text'=>"1",'callback_data'=>"send=1"],['text'=>"2",'callback_data'=>"send=2"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"orqa"]],
]]));
}else if($res=="text"){
edit($chat_id,$message_id,"
1. /start buyrug‘i uchun javob

Quyidagi o‘zgartirish tugmasini tanlang:
",json_encode([
'inline_keyboard'=>[
[['text'=>"1",'callback_data'=>"text=1"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"orqa"]],
]]));
}else if($res=="tugma") {
edit($chat_id,$message_id,"📁 Quyidagi tugmadan birini tanlang:",json_encode([
'inline_keyboard'=>[
[['text'=>$elonlar,'callback_data'=>"tugma=1"]],
[['text'=>$qoshish,'callback_data'=>"tugma=2"],['text'=>$hisob,'callback_data'=>"tugma=3"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"orqa"]],
]]));
}else if($res=="kanal"){
edit($chat_id,$message_id,"Quyidagilardan birini tanlang:",json_encode([
'inline_keyboard'=>[
[['text'=>"📢 Majburiy obuna",'callback_data'=>"panel=majbur"],['text'=>"🚀 Buyurtmalar kanali",'callback_data'=>"panel=buyurtma"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"orqa"]],
]]));
}elseif($res=="majbur"){
edit($chat_id,$message_id,"📢 Majburiy obuna sozlash bo'limidasiz!",json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Kanal qo'shish",'callback_data'=>"kanal=add"]],
[['text'=>"📃 Ro‘yxat",'callback_data'=>"kanal=royxat"],['text'=>"🗑️ O’chirish",'callback_data'=>"kanal=del"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"panel=kanal"]],
]]));
}elseif($res=="buyurtma"){
edit($chat_id,$message_id,"
Hozirgi kanal: $elon

Kanalni o‘zgartirish uchun quyidagi tugmadan foydalaning
",json_encode([
'inline_keyboard'=>[
[['text'=>"📃 Kanalni o‘zgartirish",'callback_data'=>"kanal=orderEdit"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"panel=kanal"]],
]]));
}elseif($res=="admin"){
edit($chat_id,$message_id,"Adminlar sozlamasi kerakli bo‘limni tanlang:",json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Yangi admin qo‘shish",'callback_data'=>"admin=add"]],
[['text'=>"📃 Adminlar ro‘yxati",'callback_data'=>"admin=royxat"], ['text'=>"🗑️ Adminlikdan olish",'callback_data'=>"admin=del"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"panel"]],
]]));
}
}

if((stripos($data,"kanal=")!==false and (mb_stripos($admin,$chat_id)!==false) )){
$res=explode("=",$data)[1];
if($res=="orderEdit") {
edit($chat_id,$message_id,"Yangi kanal manzilini kiriting:
Namuna: $elon (@ bu belgisi bo‘lishi shart)",json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"panel=buyurtma"]],
]]));
put("user/$chat_id.step","orderAdd");
}else if($res=="royxat"){
$kanal=get("settings/joinchat.txt");
$soni =substr_count($kanal,"@");
if($kanal!=null){
$ids = explode("\n",$kanal);
for($i=1;$i<=$soni;$i++){
$kanall=str_replace("@","",$ids[$i]);
$ism=bot('getChat',['chat_id'=>"@".$kanall])->result->title;
$keyboards[]=["text"=>"$ism","url"=>"https://t.me/$kanall"];
}
$keyboard2=array_chunk($keyboards,1);
$keyboard2[]=[['text'=>"◀️ Orqaga",'callback_data'=>"panel=majbur"]];
$keyboard=json_encode([
'inline_keyboard'=>$keyboard2,
]);
edit($chat_id,$message_id,"📃 Kanallar ro‘yxati",$keyboard);
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$id,
'text'=>"🔕 Boshqa kanallar topilmadi",
'show_alert'=>true,
]);
}
}elseif($res=="del"){
$kanal=get("settings/joinchat.txt");
$soni =substr_count($kanal,"@");
if($kanal!=null){
$ids = explode("\n",$kanal);
for($i=1;$i<=$soni;$i++){
$kanall=str_replace("@","",$ids[$i]);
$keyboards[]=["text"=>"@$kanall","callback_data"=>"del=@$kanall"];
}
$keyboard2=array_chunk($keyboards,2);
$keyboard2[]=[['text'=>"◀️ Orqaga",'callback_data'=>"panel=majbur"]];
$keyboard=json_encode([
'inline_keyboard'=>$keyboard2,
]);
edit($chat_id,$message_id,"📃 Kanallar ro‘yxati",$keyboard);
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$id,
'text'=>"🔕 Boshqa kanallar topilmadi",
'show_alert'=>true,
]);
}
}elseif($res=="add") {
$kanal=get("settings/joinchat.txt");
$soni =substr_count($kanal,"\n");
if($kanalLimit-1>=$soni){
edit($chat_id,$message_id,"Kanal manzilini yuboring
Namuna: $elon (@ bo‘lishi shart)",json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"panel=majbur"]],
]]));
put("user/$chat_id.step","kanalAdd");
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$id,
'text'=>"🔕 Limit maksimal darajaga yetdi.",
'show_alert'=>true,
]);
}
}
}

if(($step=="kanalAdd" and (mb_stripos($admin,$cid)!==false) and (mb_stripos($text,"@")!==false) )){
$kan=get("settings/joinchat.txt");
if(mb_stripos($kan,$text)!==false){
sms($cid,"Siz bu manzilni qo‘sha olmaysiz!

Boshqa manzil kiritib ko‘ring:",json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"panel=majbur"]],
]]));
}else{
if(joinX($text,$cid)==1){
sms($cid,"Kanal manzili saqlandi!",json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"panel=majbur"]],
]]));
$kan=get("settings/joinchat.txt");
put("settings/joinchat.txt","$kan\n$text");
put("user/$cid.step","");
}
}
}
if(($step=="orderAdd" and (mb_stripos($admin,$cid)!==false) and (mb_stripos($text,"@")!==false) )){
if(joinX($text,$cid)==1){
sms($cid,"Buyurtmalar kanali manzili saqlandi!",json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"panel=buyurtma"]],
]]));
put("settings/elon.url","$text");
put("user/$cid.step","");
}
}

if(stripos($data,"del=")!==false and (mb_stripos($admin,$chat_id)!==false) ){
$k2=explode("=",$data)[1];
$kanal=get("settings/joinchat.txt");
if(mb_stripos($kanal,$k2)!==false){
$k = str_replace("\n".$k2."","",$kanal);
file_put_contents("settings/joinchat.txt",$k);
bot('answerCallbackQuery',[
'callback_query_id'=>$id,
'text'=>"✅ Kanal o‘chirildi",
'show_alert'=>true,
]);
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$id,
'text'=>"🔕 Bu kanal topilmadi",
'show_alert'=>true,
]);
}
}

if((stripos($data,"tugma=")!==false and (mb_stripos($admin,$chat_id)!==false) )){
$id=explode("=",$data)[1];
if($id=="1") {
edit($chat_id,$message_id,"Yangi nomini kiriting:",json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"panel=tugma"]],
]]));
put("user/$chat_id.step","tugma_1");
}elseif($id=="2") {
edit($chat_id,$message_id,"Yangi nomini kiriting:",json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"panel=tugma"]],
]]));
put("user/$chat_id.step","tugma_2");
}elseif($id=="3") {
edit($chat_id,$message_id,"Yangi nomini kiriting:",json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"panel=tugma"]],
]]));
put("user/$chat_id.step","tugma_3");
}elseif($id=="4") {
edit($chat_id,$message_id,"Yangi nomini kiriting:",json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"panel=tugma"]],
]]));
put("user/$chat_id.step","tugma_4");
}
}
if(($step=="tugma_1" and (mb_stripos($admin,$cid)!==false) )){
sms($cid,"Tugma nomi $text ga o‘zgardi",json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"panel=tugma"]],
]]));
put("settings/elonlar.txt",$text);
put("user/$cid.step","");
}if(($step=="tugma_2" and (mb_stripos($admin,$cid)!==false) )){
sms($cid,"Tugma nomi $text ga o‘zgardi",json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"panel=tugma"]],
]]));
put("settings/qoshish.txt",$text);
put("user/$cid.step","");
}if(($step=="tugma_3" and (mb_stripos($admin,$cid)!==false) )){
sms($cid,"Tugma nomi $text ga o‘zgardi",json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"panel=tugma"]],
]]));
put("settings/hisob.txt",$text);
put("user/$cid.step","");
}if(($step=="tugma_4" and (mb_stripos($admin,$cid)!==false) )){
sms($cid,"Tugma nomi $text ga o‘zgardi",json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"panel=tugma"]],
]]));
put("settings/kiritish.txt",$text);
put("user/$cid.step","");
}

if((stripos($data,"text=")!==false and (mb_stripos($admin,$chat_id)!==false) )){
$res=explode("=",$data)[1];
if($res=="1") {
edit($chat_id,$message_id,"
/start buyrug‘i uchun yangi matnlarni kiriting

O‘zgaruvchilar:

<code>%botuser%</code>: Bot nomi (username)
<code>%date%</code>: Joriy yil oy sana
<code>%time%</code>: Joriy vaqt (O‘zbekiston)
<code>%username%</code>: Foydalanuvchi nomi (username)
<code>%name%</code>: Foydalanuchi nomi (Ismi)
<code>%id%</code>: Foydalanuvchi IDsi
<code>%elon%</code>: E'lonlar kanali
<code>%reflink%</code>: Foydalanuvchi referal havolasi",json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"panel=text"]],
]]));
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>$start,
]);
put("user/$chat_id.step","startText");
}
}
if(($step=="startText" and (mb_stripos($admin,$cid)!==false) )){
sms($cid,"/start buyrug‘i uchun javob saqlandi!",json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"panel=text"]],
]]));
put("settings/start.txt",$text);
put("user/$cid.step","");
}

if((stripos($data,"send=")!==false and (mb_stripos($admin,$chat_id)!==false) )){
$res=explode("=",$data)[1];
if($res=="1") {
edit($chat_id,$message_id,"Foydalanuvchilarga yuboriladigan xabarni forward shaklida yuboring:",json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"panel=xabar"]],
]]));
put("user/$chat_id.step","xabar_1");
}elseif($res=="2") {
edit($chat_id,$message_id,"Foydalanuvchilarga yuboriladigan xabar matnini yuboring:",json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"panel=xabar"]],
]]));
put("user/$chat_id.step","xabar_2");
}
}

if(($step=="xabar_1" and (mb_stripos($admin,$cid)!==false) )){
sms($cid,"Xabar yuborish boshlandi!",json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"panel=xabar"]],
]]));
$fil=get("settings/stat.txt");
$us=explode("\n",$fil);
foreach($us as $as){
$ok=bot('forwardMessage',[
'chat_id'=>$as,
'from_chat_id'=>$cid,
'message_id'=>$message->message_id,
]);
if($ok->ok=="1") {
$y=get("user/true.txt");
put("user/true.txt",$y+1);
}
put("user/$cid.step","");
}
sms($cid,"
Xabar yuborish tugadi!

Yuborildi: ".get("user/true.txt")."
",json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"panel=xabar"]],
]]));
put("user/true.txt",0);
put("user/$cid.step","");
}
if(($step=="xabar_2" and (mb_stripos($admin,$cid)!==false) )){
if($text){
sms($cid,"Xabar yuborish boshlandi!",json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"panel=xabar"]],
]]));
$fil=get("settings/stat.txt");
$us=explode("\n",$fil);
foreach($us as $as){
$ok=bot('sendMessage',[
'chat_id'=>$as,
'text'=>$text,
'parse_mode'=>HTML,
]);
if($ok->ok=="1") {
$y=get("user/true.txt");
put("user/true.txt",$y+1);
}
put("user/$cid.step","");
}
sms($cid,"
Xabar yuborish tugadi!

Yuborildi: ".get("user/true.txt")."
",json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"panel=xabar"]],
]]));
put("user/true.txt",0);
put("user/$cid.step","");
}else{
sms($cid,"Faqat matnlar mumkin!

Qaytadan urining:",json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"panel=xabar"]],
]]));
}
}

if((stripos($data,"narx=")!==false and (mb_stripos($admin,$chat_id)!==false) )){
$res=explode("=",$data)[1];
if($res=="elon") {
edit($chat_id,$message_id,"E‘lon joylash narxini kiriting:",json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"panel=narx"]],
]]));
put("user/$chat_id.step","Elon");
}elseif($res=="val") {
edit($chat_id,$message_id,"Yangi valyutani kiriting:",json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"panel=narx"]],
]]));
put("user/$chat_id.step","Val");
}elseif($res=="ref") {
edit($chat_id,$message_id,"Yangi qiymatni kiriting:",json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"panel=narx"]],
]]));
put("user/$chat_id.step","ref");
}
}

if(($step=="ref" and (mb_stripos($admin,$cid)!==false) )){
sms($cid,"Taklif narxi $text ga o‘zgardi",json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"panel=narx"]],
]]));
put("settings/ref.txt",$text);
put("user/$cid.step","");
}

if(($step=="Val" and (mb_stripos($admin,$cid)!==false) )){
sms($cid,"Asosiy valyuta $text ga o‘zgardi",json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"panel=narx"]],
]]));
put("settings/val.txt",$text);
put("user/$cid.step","");
}

if(($step=="Elon" and (mb_stripos($admin,$cid)!==false) )){
sms($cid,"E'lon joylash narxi $text ga o‘zgardi",json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"panel=narx"]],
]]));
put("settings/narxi.txt",$text);
put("user/$cid.step","");
}

if(($step=="boshqarish" and is_numeric($text) and (mb_stripos($admin,$cid)!==false) )){
$id=get("user/$text.pul");
if($id!=null){
sms($cid,"
Foydalanuvchi topildi:
Foydalanuvchi IDsi: <a href='tg://user?id=$text'>$text</a>
Foydalanuvchi balansi: $id 

Quyidagi tugmalarni tanlang:
",json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Pul qo‘shish",'callback_data'=>"set=qosh=$text"],['text'=>"➖ Pul olish",'callback_data'=>"set=ol=$text"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"panel=boshqarish"]],
]]));
}else{
sms($cid,"
Foydalanuvchi topilmadi

Qaytadan urining:",json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"panel=boshqarish"]],
]]));
}
}

if((stripos($data,"set=")!==false and (mb_stripos($admin,$chat_id)!==false) )){
$res=explode("=",$data)[1];
$my=explode("=",$data)[2];
if($res=="qosh"){
edit($chat_id,$message_id,"Foydalanuvchi xisobini qanchaga to‘ldirmoqchisiz?",json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"panel=boshqarish"]],
]]));
put("user/$chat_id.step","pulQosh");
put("user/$chat_id.id",$my);
}elseif($res=="ol"){
edit($chat_id,$message_id,"Foydalanuvchi xisobidan qancha ayirmoqchisiz",json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"panel=boshqarish"]],
]]));
put("user/$chat_id.step","minus");
put("user/$chat_id.id",$my);
}
}

if(($step=="pulQosh" and (mb_stripos($admin,$cid)!==false) )){
sms($cid,"$text $valyuta qoshildi",json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"panel=boshqarish"]],
]]));
$my=get("user/$cid.id");
$pul=get("user/$my.pul");
put("user/$my.pul",$pul+$text);
sms($my,"+$text $valyuta",null);
put("user/$cid.step","");
put("user/$cid.id","");
}
if(($step=="minus" and (mb_stripos($admin,$cid)!==false) )){
sms($cid,"$text $valyuta ayirildi",json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"panel=boshqarish"]],
]]));
$my=get("user/$cid.id");
$pul=get("user/$my.pul");
put("user/$my.pul",$pul-$text);
sms($my,"-$text $valyuta",null);
put("user/$cid.step","");
put("user/$cid.id","");
}

if((stripos($data,"admin=")!==false and (mb_stripos($admin,$chat_id)!==false) )){
$res=explode("=",$data)[1];
if($res=="royxat"){
$ad=get("settings/admins.txt");
$soni =substr_count($ad,"\n");
if($ad!="$adminid"){
$ids = explode("\n",$ad);
for($i=1;$i<=$soni;$i++){
$idi=$ids[$i];
$keyboards[]=["text"=>"[$i] $idi","url"=>"tg://user?id=$idi"];
}
$keyboard2=array_chunk($keyboards,1);
$keyboard2[]=[['text'=>"◀️ Orqaga",'callback_data'=>"panel=admin"]];
$keyboard=json_encode([
'inline_keyboard'=>$keyboard2,
]);
edit($chat_id,$message_id,"📃 Adminlar ro‘yxati",$keyboard);
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$id,
'text'=>"🔕 Boshqa adminlar topilmadi",
'show_alert'=>true,
]);
}
}elseif($res=="del"){
$ad=get("settings/admins.txt");
$soni =substr_count($ad,"\n");
if($ad!="$adminid"){
$ids = explode("\n",$ad);
for($i=1;$i<=$soni;$i++){
$idi=$ids[$i];
$keyboards[]=["text"=>"[$i] $idi","callback_data"=>"delAd=$idi"];
}
$keyboard2=array_chunk($keyboards,1);
$keyboard2[]=[['text'=>"◀️ Orqaga",'callback_data'=>"panel=admin"]];
$keyboard=json_encode([
'inline_keyboard'=>$keyboard2,
]);
edit($chat_id,$message_id,"📃 O‘chirish mumkin bo’lgan adminlar ro‘yxati",$keyboard);
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$id,
'text'=>"🔕 Boshqa adminlar topilmadi",
'show_alert'=>true,
]);
}
}elseif($res=="add"){
$ad2=get("settings/admins.txt");
$ad3 =substr_count($ad2,"\n");
if($adminLimit-1>=$ad3){
edit($chat_id,$message_id,"
Kerakli foydalanuvchi IDsini kiriting:",json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"panel=admin"]],
]]));
put("user/$chat_id.step","addA");
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$id,
'text'=>"🔕 Limit maksimal darajaga yetdi.",
'show_alert'=>true,
]);
}
}
}

if(($step=="addA"  and (mb_stripos($admin,$cid)!==false))){
if($for){
$text=$for_id;
}
if(joinA($text,$cid)==1){
sms($cid,"Yangi admin qo‘shildi",json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"panel=admin"]],
]]));
$ad=get("settings/admins.txt");
put("settings/admins.txt",$ad."\n".$text);
put("user/$cid.step","");
}
}
if((stripos($data,"delAd=")!==false and (mb_stripos($admin,$chat_id)!==false))){
$k2=explode("=",$data)[1];
$ad=get("settings/admins.txt");
if(mb_stripos($ad,$k2)!==false){
$k = str_replace("\n".$k2."","",$ad);
file_put_contents("settings/admins.txt",$k);
bot('answerCallbackQuery',[
'callback_query_id'=>$id,
'text'=>"✅ Admin o‘chirildi",
'show_alert'=>true,
]);
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$id,
'text'=>"🔕 Bu admin topilmadi",
'show_alert'=>true,
]);
}
}

$botdel = $update->my_chat_member->new_chat_member;
$botdelid = $update->my_chat_member->from->id;
$userstatus= $botdel->status;
if($botdel){
if($userstatus=="kicked"){
$delid=get("settings/delids.txt");
if(!mb_stripos($delid,$botdelid)!==false){
put("settings/delids.txt",$delid."\n".$botdelid);
} 
}
}

if(isset($message)){
$delid=get("settings/delids.txt");
if(mb_stripos($delid,$cid)!==false){
$delid=get("settings/delids.txt");
$k = str_replace("\n".$cid."","",$delid);
put("settings/delids.txt",$k);
}
}

if(($step=="new_1" and joinO($text,$cid)==1 and (mb_stripos($text,"@")!==false))){
sms($cid,"Kanal yoki guruxingiz toifasini tanlang:",json_encode([
'inline_keyboard'=>[
[['text'=>"Blog",'callback_data'=>"tp=Blog=$text"],['text'=>"Biznes loixalar",'callback_data'=>"tp=Biznes loixalar=$text"]],
[['text'=>"Hazillar",'callback_data'=>"tp=Hazillar=$text"],['text'=>"Criptovalyutalar",'callback_data'=>"tp=Criptovalyutalar=$text"]],
[['text'=>"Musiqa",'callback_data'=>"tp=Musiqa=$text"],['text'=>"Yangiliklar",'callback_data'=>"tp=Yangiliklar=$text"]],
[['text'=>"Salomatlik va Sport",'callback_data'=>"tp=Salomatlik va Sport=$text"],['text'=>"San'at va fotosuratlar",'callback_data'=>"tp=San'at va fotosuratlar=$text"]],
[['text'=>"Texnalogyalar",'callback_data'=>"tp=Texnalogyalar=$text"],['text'=>"Sayohatlar",'callback_data'=>"tp=Sayohatlar=$text"]],
[['text'=>"Moda va go'zallik",'callback_data'=>"tp=Moda va go'zallik=$text"],['text'=>"Sotuvlar bizneslar",'callback_data'=>"tp=Sotuvlar bizneslar=$text"]],
[['text'=>"Siyosat",'callback_data'=>"tp=Siyosat=$text"],['text'=>"Video filmlar",'callback_data'=>"tp=Video filmlar=$text"]],
[['text'=>"Kitoblar",'callback_data'=>"tp=Kitoblar=$text"],['text'=>"O'yin va dasturlar",'callback_data'=>"tp=O'yin va dasturlar=$text"]],
[['text'=>"Marketing va reklamalar",'callback_data'=>"tp=Marketing va reklamalar=$text"],['text'=>"Oshpazlik",'callback_data'=>"tp=Oshpazlik=$text"]],
[['text'=>"Pul ishlash",'callback_data'=>"tp=Pul ishlash=$text"],['text'=>"Iqtisodiyot",'callback_data'=>"tp=Iqtisodiyot=$text"]],
[['text'=>"Kanal va botlar yangiliklari",'callback_data'=>"tp=Kanal va botlar yangiliklari=$text"],['text'=>"Dizayn",'callback_data'=>"tp=Dizayn=$text"]],
[['text'=>"Shaxsiy blog",'callback_data'=>"tp=Shaxsiy blog=$text"],['text'=>"IT yangiliklari",'callback_data'=>"tp=IT yangiliklari=$text"]],
[['text'=>"Biznes loixalar",'callback_data'=>"tp=Biznes loixalar=$text"],['text'=>"Boshqa",'callback_data'=>"tp=Boshqa=$text"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"start"]],
]
]));
put("user/$cid.step","new_2");
}

if((stripos($data,"tp=")!==false and $cstep=="new_2" and joinchat($chat_id)==1)){
$type=explode("=",$data)[1];
$link=explode("=",$data)[2];
$s['toifa']=$type;
$s['link']=$link;
$s['narx']=null;
$s['chegirma']=null;
$s['top']=null;
$s['lenta']=null;
$s['PR']=null;
put("user/$chat_id-order.json",json_encode($s,JSON_PRETTY_PRINT));
edit($chat_id,$message_id,"Kanalingiz yoki guruxingizdagi reklama narxini tanlang yoki kiriting:",json_encode([
'inline_keyboard'=>[
[['text'=>"10₽",'callback_data'=>"tp=10"],['text'=>"50₽",'callback_data'=>"tp=50"]],
[['text'=>"250₽",'callback_data'=>"tp=250"],['text'=>"500₽",'callback_data'=>"tp=500"]],
[['text'=>"1000₽",'callback_data'=>"tp=1000"],['text'=>"5000₽",'callback_data'=>"tp=5000"]],
[['text'=>"7500₽",'callback_data'=>"tp=7500"],['text'=>"10000₽",'callback_data'=>"tp=10000"]],
[['text'=>"9000₽",'callback_data'=>"tp=9000"],['text'=>"13000₽",'callback_data'=>"tp=13000"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"start"]],]
]));
put("user/$chat_id.step","new_3");
}

if((stripos($data,"tp=")!==false and $cstep=="new_3" or $step=="new_3")){
if($text and is_numeric($text)){
sms($cid,"Kanalingizda reklama chegirmasini tanlang yoki kiriting:",json_encode([
'inline_keyboard'=>[
[['text'=>"10%",'callback_data'=>"tp=10"],['text'=>"20%",'callback_data'=>"tp=20"]],
[['text'=>"30%",'callback_data'=>"tp=30"],['text'=>"40%",'callback_data'=>"tp=40"]],
[['text'=>"50",'callback_data'=>"tp=50"],['text'=>"60%",'callback_data'=>"tp=60"]],
[['text'=>"70%",'callback_data'=>"tp=70"],['text'=>"80%",'callback_data'=>"tp=80"]],
[['text'=>"Chegirma yoq",'callback_data'=>"tp=Chegirma yoq"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"start"]],]
]));
put("user/$cid.step","new_4");
$f=json_decode(get("user/$cid-order.json"),1);
$s['toifa']=$f[toifa];
$s['link']=$f[link];
$s['narx']=$text;
$s['chegirma']=null;
$s['top']=null;
$s['lenta']=null;
$s['PR']=null;
put("user/$cid-order.json",json_encode($s,JSON_PRETTY_PRINT));
}else{
$narx=explode("=",$data)[1];
edit($chat_id,$message_id,"Kanalingizda reklama chegirmasini tanlang yoki kiriting
(Maksimal 90%)",json_encode([
'inline_keyboard'=>[
[['text'=>"10%",'callback_data'=>"tp=10"],['text'=>"20%",'callback_data'=>"tp=20"]],
[['text'=>"30%",'callback_data'=>"tp=30"],['text'=>"40%",'callback_data'=>"tp=40"]],
[['text'=>"50%",'callback_data'=>"tp=50"],['text'=>"60%",'callback_data'=>"tp=60"]],
[['text'=>"70%",'callback_data'=>"tp=70"],['text'=>"80%",'callback_data'=>"tp=80"]],
[['text'=>"Chegirma yoq",'callback_data'=>"tp=Chegirma yoq"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"start"]],]
]));
put("user/$chat_id.step","new_4");
$f=json_decode(get("user/$chat_id-order.json"),1);
$s['toifa']=$f[toifa];
$s['link']=$f[link];
$s['narx']=$narx;
$s['chegirma']=null;
$s['top']=null;
$s['lenta']=null;
$s['PR']=null;
put("user/$chat_id-order.json",json_encode($s));
}
}

if((stripos($data,"tp=")!==false and $cstep=="new_4" or $step=="new_4")){
$fo=explode("=",$data)[1];
if($text and is_numeric($text)){
sms($cid,"Reklama postining yuqori qism (TOP) da boʻlishi kafolatlangan soatlar sonini tanlang yoki kiriting:",json_encode([
'inline_keyboard'=>[
[['text'=>"Bir soatdan kamroq",'callback_data'=>"tp=Bir soatdan kamroq"]],
[['text'=>"1 soat",'callback_data'=>"tp=1"],['text'=>"3 soat",'callback_data'=>"tp=3"],['text'=>"5 soat",'callback_data'=>"tp=5"]],
[['text'=>"6 soat",'callback_data'=>"tp=6"],['text'=>"12 soat",'callback_data'=>"tp=12"],['text'=>"24 soat",'callback_data'=>"tp=24"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"start"]],]
]));
put("user/$cid.step","new_5");
$f=json_decode(get("user/$cid-order.json"),1);
$s['toifa']=$f[toifa];
$s['link']=$f[link];
$s['narx']=$f[narx];
$s['chegirma']=$text;
$s['top']=null;
$s['lenta']=null;
$s['PR']=null;
put("user/$cid-order.json",json_encode($s,JSON_PRETTY_PRINT));
}else{
$fo=explode("=",$data)[1];
edit($chat_id,$message_id,"Reklama postining yuqori qism (TOP) da boʻlishi kafolatlangan soatlar sonini tanlang yoki kiriting:",json_encode([
'inline_keyboard'=>[
[['text'=>"Bir soatdan kamroq",'callback_data'=>"tp=Bir soatdan kamroq"]],
[['text'=>"1 soat",'callback_data'=>"te=1"],['text'=>"3 soat",'callback_data'=>"te=3"],['text'=>"5 soat",'callback_data'=>"te=5"]],
[['text'=>"6 soat",'callback_data'=>"te=6"],['text'=>"12 soat",'callback_data'=>"te=12"],['text'=>"24 soat",'callback_data'=>"te=24"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"start"]],]
]));
put("user/$chat_id.step","new_5");
$f=json_decode(get("user/$chat_id-order.json"),1);
$s['toifa']=$f[toifa];
$s['link']=$f[link];
$s['narx']=$f[narx];
$s['chegirma']=$fo;
$s['top']=null;
$s['lenta']=null;
$s['PR']=null;
put("user/$chat_id-order.json",json_encode($s,JSON_PRETTY_PRINT));
}
}

if(($cstep=="new_5" or $step=="new_5")){
$fo=explode("=",$data)[1];
if($text){
sms($cid,"Reklama posti tasmadan (kanaldan) necha soatdan keyin olib tashlanishini tanlang yoki kiritingm:",json_encode([
'inline_keyboard'=>[
[['text'=>"Doimiy",'callback_data'=>"tp=Doimiy"]],
[['text'=>"12 soat",'callback_data'=>"tp=12"],['text'=>"24 soat",'callback_data'=>"tp=3"],['text'=>"72 soat",'callback_data'=>"tp=72"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"start"]],]
]));
put("user/$cid.step","new_5_1");
$f=json_decode(get("user/$cid-order.json"),1);
$s['toifa']=$f[toifa];
$s['link']=$f[link];
$s['narx']=$f['narx'];
$s['chegirma']=$f[chegirma];
$s['top']=$text;
$s['lenta']=null;
$s['PR']=null;
put("user/$cid-order.json",json_encode($s,JSON_PRETTY_PRINT));
}else{
edit($chat_id,$message_id,"Reklama postining yuqori qism (KANAL) da boʻlishi kafolatlangan soatlar sonini tanlang yoki kiriting:",json_encode([
'inline_keyboard'=>[
[['text'=>"Doimiy",'callback_data'=>"tp=Doimiy"]],
[['text'=>"12 soat",'callback_data'=>"tp=12"],['text'=>"24 soat",'callback_data'=>"tp=3"],['text'=>"72 soat",'callback_data'=>"tp=72"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"start"]],
]
]));
put("user/$chat_id.step","new_5_1");
$f=json_decode(get("user/$chat_id-order.json"),1);
$s['toifa']=$f[toifa];
$s['link']=$f[link];
$s['narx']=$f[narx];
$s['chegirma']=$f['chegirma'];
$s['top']=$fo;
$s['lenta']=null;
$s['PR']=null;
put("user/$chat_id-order.json",json_encode($s,JSON_PRETTY_PRINT));
}
}

if(($cstep=="new_5_1" or $step=="new_5_1")){
$fo=explode("=",$data)[1];
if($text){
sms($cid,"Kanalingiz bilan o'zaro PR mumkinmi? (Reklamani shu kabi kanallarning boshqa egalari bilan o'zaro joylashtirish):",json_encode([
'inline_keyboard'=>[
[['text'=>"✅ Mumkin",'callback_data'=>"tp=Mumkin"]],
[['text'=>"❌ Mumkin emas",'callback_data'=>"tp=Mumkin emas"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"start"]],
]
]));
put("user/$cid.step","new_5_2");
$f=json_decode(get("user/$cid-order.json"),1);
$s['toifa']=$f[toifa];
$s['link']=$f[link];
$s['narx']=$f['narx'];
$s['chegirma']=$f[chegirma];
$s['top']=$f[top];
$s['lenta']=$text;
$s['PR']=null;
put("user/$cid-order.json",json_encode($s,JSON_PRETTY_PRINT));
}else{
edit($chat_id,$message_id,"Kanalingiz bilan o'zaro PR mumkinmi? (Reklamani shu kabi kanallarning boshqa egalari bilan o'zaro joylashtirish):",json_encode([
'inline_keyboard'=>[
[['text'=>"✅ Mumkin",'callback_data'=>"tp=Mumkin"]],
[['text'=>"❌ Mumkin emas",'callback_data'=>"tp=Mumkin emas"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"start"]],
]
]));
put("user/$chat_id.step","new_5_2");
$f=json_decode(get("user/$chat_id-order.json"),1);
$s['toifa']=$f[toifa];
$s['link']=$f[link];
$s['narx']=$f[narx];
$s['chegirma']=$f['chegirma'];
$s['top']=$f[top];
$s['lenta']=$fo;
$s['PR']=null;
put("user/$chat_id-order.json",json_encode($s,JSON_PRETTY_PRINT));
}
}

if(($cstep=="new_5_2" and $data)){
$fo=explode("=",$data)[1];
put("user/$chat_id.step","new_5_3");
$f=json_decode(get("user/$chat_id-order.json"),1);
$s['toifa']=$f[toifa];
$s['link']=$f[link];
$s['narx']=$f[narx];
$s['chegirma']=$f['chegirma'];
$s['top']=$f[top];
$s['lenta']=$f[lenta];
$s['PR']=$fo;
put("user/$chat_id-order.json",json_encode($s,JSON_PRETTY_PRINT));
$fi=json_decode(get("user/$chat_id-order.json"),1);
$cou=bot('getChatMembersCount',[
'chat_id'=>$fi[link],
])->result;
if($fi[chegirma]=="Chegirma yoq"){
}else{
$ft="%";
}
if($fi[lenta]=="Doimiy"){
}else{
$ls="soat";
}
if($fi[top]=="Bir soatdan kamroq"){
}else{
$ts="soat";
}
$cheg=$fi['narx']/100*$fi['chegirma'];
$cheg=$fi[narx]-$cheg;
sms($chat_id,"
📢 Kanal: ".$fi[link]."
🔘 Toifa: ".$fi[toifa]."
📈 Foydalanuvchilar: $cou
💳 Reklama narxi: ".number($fi[narx])." ₽
⬇️ Chegirma: ".$fi[chegirma]." $ft
💵 Chegirmadagi narxi: ".number($cheg)." ₽
🔝 TOP dagi turish muddati: ".$fi[top]." $ts
🔛 Lentada turish muddati: ".$fi[lenta]." $ls
🤝 O'zaro PR: ".$fi[PR]."
✅ Admin: Sizning user",null);

sms($chat_id,"📃 Malumotlar to'g'ri bolsa e'lon $elon kanaliga yuboriladi.",json_encode([
'inline_keyboard'=>[
[['text'=>"✅ Ha",'callback_data'=>"tp=SEND"]],
[['text'=>"❌ Yoq",'callback_data'=>"start"]],
]
]));
}

if(($cstep=="new_5_3" and $data)){
$fo=explode("=",$data)[1];
if($fo=="SEND"){
$fi=json_decode(get("user/$chat_id-order.json"),1);
$cou=bot('getChatMembersCount',[
'chat_id'=>$fi[link],
])->result;
if($fi[chegirma]=="Chegirma yoq"){
}else{
$f="%";
}
if($fi[lenta]=="Doimiy"){
}else{
$ls="soat";
}
if($fi[top]=="Bir soatdan kamroq"){
}else{
$ts="soat";
}
if(mb_stripos($admin,$chat_id)!==false){
$me=$menu;
}else{
$me=$menu2;
}
$cheg=$fi['narx']/100*$fi['chegirma'];
$cheg=$fi[narx]-$cheg;
sms($elon,"
📢 Kanal: ".$fi[link]."
🔘 Toifa: ".$fi[toifa]."
📈 Foydalanuvchilar: $cou
💳 Reklama narxi: ".number($fi[narx])." ₽
⬇️ Chegirma: ".$fi[chegirma]." $f
💵 Chegirmadagi narxi: ".number($cheg)." ₽
🔝 TOP dagi turish muddati: ".$fi[top]." $ts
🔛 Lentada turish muddati: ".$fi[lenta]." $ls
🤝 O'zaro PR: ".$fi[PR]."
✅ Admin: @$user_name",json_encode([
'inline_keyboard'=>[
[['text'=>"📢 Kanalni ko‘rish",'url'=>"https://".str_replace("@","t.me/",$fi[link])]],
[['text'=>"💬 Aloqa",'url'=>"tg://user?id=$chat_id"]],
[['text'=>"➕ Kanalingizni qo‘shing",'url'=>"t.me/$botuser"]],
]
]));
edit($chat_id,$message_id,$start,$me);
$pul=get("user/$chat_id.pul");
put("user/$chat_id.pul",$pul-$narxi);
put("user/$chat_id.step","");
put("user/$chat_id-order.json","");
}
}

if(mb_stripos($text,"/start")!==false){
$refid=explode(" ",$text)[1];
if(strlen($refid)>0 and is_numeric($refid)){
$idref = "data/$refid.id";
$us=get("settings/stat.txt");
if($refid==$cid){
sms($cid,"☝️ <b>Hurmatli foydalanuvchi!</b>

Botga o'zingizni taklif qila olmaysiz!",null);
}else{
$us=get("settings/stat.txt");
if(mb_stripos($us,$cid)!==false){
sms($cid,"<b>Hurmatli foydalanuvchi!</b>

Doʻstingiz sizni taklif qila olmaydi!",null);
}else{
put("data/".$cid.".id",$refid);
if(joinchat($cid)==1 and joinR($refid,$cid)==1 and joinchat($refid)==1) {
$refname=bot('getChat',[chat_id=>$refid])->result->first_name;
sms($cid,"🔔 Sizni: $refname taklif etdi",null);
addstat($refid);
$id = "$cid\n";
$handle = fopen("$idref","a+");
fwrite($handle,$id);
fclose($handle);
$refd=get("data/".$cid.".id");
$pul=get("user/$refd.pul");
$pul=$pul+$ref;
put("user/".$refd.".pul",$pul);
sms($refd,"+$ref $valyuta",null);
put("data/$cid",0);
}
}
}
}
}

if(isset($message)){
addstat($cid);
}
