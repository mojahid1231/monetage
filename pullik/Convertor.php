<?php
ob_start();
error_reporting(0);
date_default_timezone_set("Asia/Tashkent");
define('API_KEY','API_TOKEN');
$time = date('H:i');
$sana = date('d.m.Y');

define("DB_SERVER", "localhost"); // Tegilmaydi
define("DB_USERNAME", "user5712_megakonst"); // Mysql baza nomi
define("DB_PASSWORD", "Megakonst"); // Mysql baza paroli
define("DB_NAME", "user5712_megakonst"); // Mysql baza nomi

$connect = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
mysqli_set_charset($connect, "utf8mb4");
if($connect){
    echo "Ulandi.";
}

function bot($method,$steps=[]){
$url = "https://api.telegram.org/bot".API_KEY."/".$method;
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_POSTFIELDS,$steps);
$res = curl_exec($ch);
if(curl_error($ch)){
var_dump(curl_error($ch));
}else{
return json_decode($res);
}
}

$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$text = $message->text;
$cid = $update->message->chat->id;
$uid = $message->from->id;
$mid = $message->message_id;
$chat_id = $message->chat->id;
$name = $message->chat->first_name;
$bot = bot('getme',['bot'])->result->username;
$back = "◀️ Ortga";
$step = file_get_contents("step/$cid/$cid.txt");
$blocks = file_get_contents("data/blocks.txt");
$holat = file_get_contents("data/bot.txt");
$kanal = file_get_contents("data/kanal.txt");
$channel = file_get_contents("data/channel.txt");
$statistika = file_get_contents("data/statistika.txt");
$admins = file_get_contents("data/admins.txt");
$administrator = "ADMIN_ID";
$admin = array($administrator,$admins);

mkdir("data");
mkdir("step");
mkdir("step/$cid");

$home = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🔄 Fayllarni oʻzgartirish"],['text'=>"📊 Statistika"],],
[['text'=>"👨🏻‍💻 Boshqaruv paneli"],],
]
]);

$change = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"☀️ Stikerdan ➡️ Rasmga 🖼"],['text'=>"🖼 Rasmdan ➡️ Stikerga ☀️"],],
[['text'=>"📹 Video ➡️ MP3 🎵"],['text'=>"📹 Video ➡️ Audio 📝"],],
[['text'=>"🎵 MP3 ➡️ Audio 📝"],['text'=>"📹 Video ➡️ Video xabar ⚪️"],],
[['text'=>"$back"],],
]
]);

$panel = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"📝 Pochta tizimi"],['text'=>"📢 Kanallar boshqaruvi"],],
[['text'=>"🔐 Blok tizimi"],['text'=>"⚙ Bot sozlamalari"],],
[['text'=>"📋 Adminlar boshqaruvi"],['text'=>"$back"],],
]
]);

$message_manager = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"💬 Forward xabar yuborish"],],
[['text'=>"👨🏻‍💻 Boshqaruv paneli"],],
]
]);

$channel_manager = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"📢 Kanal qoʻshish"],['text'=>"📢 Kanalni oʻchirish"],],
[['text'=>"📋 Kanallar roʻyxati"],['text'=>"📋 Kanallar roʻyxatini oʻchirish"],],
[['text'=>"👨🏻‍💻 Boshqaruv paneli"],],
]
]);

$blok_manager = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"✅ Blokdan olish"],['text'=>"❌ Bloklash"],],
[['text'=>"📋 Bloklanganlar roʻyxati"],['text'=>"📋 Bloklanganlar roʻyxatini oʻchirish"],],
[['text'=>"👨🏻‍💻 Boshqaruv paneli"],],
]
]);

$bot_manager = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"✅ Botni yoqish"],['text'=>"❌ Botni o‘chirish"],],
[['text'=>"👨🏻‍💻 Boshqaruv paneli"],],
]
]);

$admins_manager = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"➕ Admin qoʻshish"],['text'=>"🛑 Adminlikdan olish"],],
[['text'=>"📋 Adminlar roʻyxati"],['text'=>"📋 Adminlar roʻyxatini oʻchirish"],],
[['text'=>"👨🏻‍💻 Boshqaruv paneli"],],
]
]);

$ortga = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"$back"],],
]
]);

if(isset($message)){
$get = file_get_contents("data/statistika.txt");
if(mb_stripos($get,$uid)==false){
file_put_contents("data/statistika.txt", "$get\n$uid");
}
}

if(in_array($cid,$admin)){}
elseif(mb_stripos($blocks, $uid)!==false){
bot('sendMessage',[
'chat_id' =>$cid,
'text'=>"<b>⚠️ Kechirasiz <a href = 'tg://user?id=$cid'>$name</a>

📛 Siz botdan bloklangansiz!

👨🏻‍💻 Blokdan chiqish uchun bot administratoriga murojaat qiling!</b>",
'parse_mode' =>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"👨‍💻 Administrator",'url'=>"tg://user?id=$administrator"],],
]
])
]);
return false;
}

if(in_array($cid,$admin)){}
elseif($holat == "off"){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"<b>🛠 Texnik xizmat davom etmoqda!

▪ Bot maʼmuriyati ushbu bot ichida baʼzi texnik ishlarni olib bormoqda.
▪ Shu sababdan menyu adminlar tomonidan oʻchirilgan va hozirda foydalanuvchilar uchun mavjud emas.
▪ Barcha funksiyalar tugallangandan keyin tiklanadi.

🔰 Agar siz ushbu botning administratori boʻlsangiz, ushbu rejimni oʻchirib qoʻyishingiz mumkin!
👉👨🏻‍💻 Boshqaruv paneli | ⚙ Bot sozlamalari.

📝 Boshqalar uchun:
ℹ️ Keyinroq qaytib keling va bot holatini tekshirish uchun /start tugmasini bosing!</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'remove_keyboard'=>true,
])
]);
return false;
}

if($message){
$kun = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kunlik WHERE user_id = $administrator"))['kun'];
	if(($kun == "0") or (mb_stripos($kun, "-")!==false)){
	exit();
}else{
}
}

if(isset($message) and ($channel == "true")){
$ids = explode("\n",$kanal);
$soni = substr_count($kanal,"@");

foreach($ids as $id){
$keyboards = [];
$k=[];
for ($for = 1; $for <= $soni; $for++) {
$kanall=str_replace("@","",$ids[$for]);

$keyboards[]=["text"=>"$for- kanal","url"=>"https://t.me/$kanall"];
}

$keyboard2=array_chunk($keyboards, 1);
$keyboard=json_encode([
'inline_keyboard'=>$keyboard2,
]);
}

$get = bot('getChatMember',[
'chat_id'=>$id,
'user_id'=>$uid,
])->result->status;

if(in_array($cid,$admin)){}
elseif($get == "member" or $get == "administrator" or $get == "creator"){
}else{
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>❌ Kechirasiz <a href = 'tg://user?id=$cid'>$name</a> siz bizning kanallarimizga obuna boʻlmasangiz botdan foydalana olmaysiz!
🔰 Obuna boʻlib botga qayta /start bosing!</b>",
'parse_mode'=>'html',
'reply_markup'=>$keyboard,
]); 
return false;
}
}

if($text == "/start" or $text == $back){
unlink("step/$cid/$cid.png");
unlink("step/$cid/$cid.jpg");
unlink("step/$cid/$cid.mp3");
unlink("step/$cid/$cid.ogg");
unlink("step/$cid/$cid.mp4");
unlink("step/$cid/$cid.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>👋 Salom <a href = 'tg://user?id=$cid'>$name</a> botimizga xush kelibsiz!
🛠 Ushbu bot orqali siz fayllarni osongina oʻzgartira olasiz!
🔰 Quyidagi menyular orqali botdan foydalaning 👇</b>",
'parse_mode'=>'html',
'reply_markup'=>$home,
]);
}

if($text == "🔄 Fayllarni oʻzgartirish"){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🔰 Kerakli boʻlimni tanlang! 👇</b>",
'parse_mode'=>'html',
'reply_markup'=>$change
]);
}

if($text == "🖼 Rasmdan ➡️ Stikerga ☀️"){
file_put_contents("step/$cid/$cid.txt","photo->png");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🖼 Rasm yuboring!
🔰 Biz uni siz uchun stiker formatda yuboramiz ✅</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga
]);
}

if($message->photo and $step == "photo->png") {
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⏳ Yuklanmoqda...
🛠 Iltimos biroz kuting!</b>",
'parse_mode'=>'html',
]);
bot('deleteMessage',[
'chat_id'=>$cid,
'message_id'=>$mid + 1,
]);
$file = "https://api.telegram.org/file/bot".API_KEY."/".bot('getfile',['file_id'=>$message->photo[1]->file_id])->result->file_path;
file_put_contents("step/$cid/$cid.png",file_get_contents($file));
bot('sendsticker',[
'chat_id'=>$cid,
'sticker'=>new CURLFile("step/$cid/$cid.png"),
'parse_mode'=>'html',
]);
unlink("step/$cid/$cid.png");
}

if($text == "☀️ Stikerdan ➡️ Rasmga 🖼"){
file_put_contents("step/$cid/$cid.txt","png->photo");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>☀️ Stiker yuboring!
🔰 Biz uni siz uchun rasm formatda yuboramiz ✅</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga
]);
}

if($message->sticker and $step == "png->photo"){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⏳ Yuklanmoqda...
🛠 Iltimos biroz kuting!</b>",
'parse_mode'=>'html',
]);
bot('deleteMessage',[
'chat_id'=>$cid,
'message_id'=>$mid + 1,
]);
$file = "https://api.telegram.org/file/bot".API_KEY."/".bot('getfile',['file_id'=>$message->sticker->file_id])->result->file_path;
file_put_contents("step/$cid/$cid.jpg",file_get_contents($file));
bot('sendphoto',[
'chat_id'=>$chat_id,
'photo'=>new CURLFile("step/$cid/$cid.jpg"),
'parse_mode'=>'html',
]);
unlink("step/$cid/$cid.jpg");
}

if($text == "📹 Video ➡️ MP3 🎵"){
file_put_contents("step/$cid/$cid.txt","mp4->mp3");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📹 Video yuboring!
🔰 Biz uni siz uchun mp3 formatda yuboramiz ✅</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga
]);
}

if($message->video and $step == 'mp4->mp3') {
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⏳ Yuklanmoqda...
🛠 Iltimos biroz kuting!</b>",
'parse_mode'=>'html',
]);
bot('deleteMessage',[
'chat_id'=>$cid,
'message_id'=>$mid + 1,
]);
$file = "https://api.telegram.org/file/bot".API_KEY."/".bot('getfile',['file_id'=>$message->video->file_id])->result->file_path;
file_put_contents("step/$cid/$cid.mp3",file_get_contents($file));
bot('sendaudio',[
'chat_id'=>$cid,
'audio'=>new CURLFile("step/$cid/$cid.mp3"),
'parse_mode'=>'html',
]);
unlink("step/$cid/$cid.mp3");
}

if($text == "📹 Video ➡️ Audio 📝"){
file_put_contents("step/$cid/$cid.txt","mp4->ogg");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📹 Video yuboring!
🔰 Biz uni siz uchun audio formatda yuboramiz✅</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga
]);
}

if($message->video and $step == 'mp4->ogg') {
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⏳ Yuklanmoqda...
🛠 Iltimos biroz kuting!</b>",
'parse_mode'=>'html',
]);
bot('deleteMessage',[
'chat_id'=>$cid,
'message_id'=>$mid + 1,
]);
$file = "https://api.telegram.org/file/bot".API_KEY."/".bot('getfile',['file_id'=>$message->video->file_id])->result->file_path;
file_put_contents("step/$cid/$cid.ogg",file_get_contents($file));
bot('sendvoice',[
'chat_id'=>$cid,
'voice'=>new CURLFile("step/$cid/$cid.ogg"),
'parse_mode'=>'html',
]);
unlink("step/$cid/$cid.ogg");
}

if($text == "🎵 MP3 ➡️ Audio 📝"){
file_put_contents("step/$cid/$cid.txt","mp3->ogg");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🎧 MP3 musiqa yuboring!
🔰 Biz uni siz uchun audio formatda yuboramiz ✅</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga
]);
}

if($message->audio and $step == "mp3->ogg"){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⏳ Yuklanmoqda...
🛠 Iltimos biroz kuting!</b>",
'parse_mode'=>'html',
]);
bot('deleteMessage',[
'chat_id'=>$cid,
'message_id'=>$mid + 1,
]);
$file = "https://api.telegram.org/file/bot".API_KEY."/".bot('getfile',['file_id'=>$message->audio->file_id])->result->file_path;
file_put_contents("step/$cid/$cid.ogg",file_get_contents($file));
bot('sendvoice',[
'chat_id'=>$cid,
'voice'=>new CURLFile("step/$cid/$cid.ogg"),
'parse_mode'=>'html',
]);
unlink("step/$cid/$cid.ogg");
}

if($text == "📹 Video ➡️ Video xabar ⚪️"){
file_put_contents("step/$cid/$cid.txt","mp4->not");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📹 Video yuboring!
🔰 Biz uni siz uchun video xabar formatda yuboramiz ✅</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga
]);
}

if($message->video and $step == 'mp4->not') {
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⏳ Yuklanmoqda...
🛠 Iltimos biroz kuting!</b>",
'parse_mode'=>'html',
]);
bot('deleteMessage',[
'chat_id'=>$cid,
'message_id'=>$mid + 1,
]);
$file = "https://api.telegram.org/file/bot".API_KEY."/".bot('getfile',['file_id'=>$message->video->file_id])->result->file_path;
file_put_contents("step/$cid/$cid.mp4",file_get_contents($file));
bot('sendVideoNote',[
'chat_id'=>$cid,
'video_note'=>new CURLFile("step/$cid/$cid.mp4"),
'parse_mode'=>'html',
]);
unlink("step/$cid/$cid.mp4");
}

if($text == "📊 Statistika"){
$get = substr_count($statistika,"\n");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>👥 Bot foydalanuvchilari: $get nafar
⏰ Soat: $time | 📆 Sana: $sana</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}

/////panelll///


$callcid = $update->callback_query->message->chat->id;
$callmid = $update->callback_query->message->message_id;
$data = $update->callback_query->data;

if($text == "👨🏻‍💻 Boshqaruv paneli"){
if(in_array($cid,$admin)){
unlink("step/$cid/$cid.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>👨🏻‍💻 Boshqaruv paneliga xush kelibsiz!
📋 Quyidagi boʻlimlardan birini tanlang!</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel,
]);
}else{
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>👨‍💻 Bu bo‘limni faqat bot administratori ishlata oladi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$home,
]);
}
}

if(in_array($cid,$admin)){
if($text == "📝 Pochta tizimi"){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📝 Pochta tizimi boʻlimidasiz!
📋 Quyidagi boʻlimlardan birini tanlang!</b>",
'parse_mode'=>'html',
'reply_markup'=>$message_manager,
]);
}
}

if($text == "💬 Forward xabar yuborish"){
file_put_contents("step/$cid/$cid.txt","forward");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>💬 Foydalanuvchilarga yuboriladigan xabarni forward qiling!</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
'disable_web_page_preview'=>true,
]);
}

if($step == "forward" and $text!= "/start" and $text!= $back and $text!= "👨🏻‍💻 Boshqaruv paneli"){
unlink("step/$cid/$cid.txt");
bot('sendMessage',[
  'chat_id'=>$cid,
  'text'=>"*Xabar Yuborish Boshlandi* ✅",
'parse_mode'=>'MarkDown',
  ]);
$x=0;
$y=0;
$explode = explode("\n",$statistika);
foreach($explode as $id){
	$ok=bot('forwardMessage',[
'chat_id' =>$id, 
'from_chat_id' =>$cid, 
'message_id' =>$mid, 
])->ok;
if($ok==true){
}else{
$okk=bot('forwardMessage',[
'chat_id' =>$id, 
'from_chat_id' =>$cid, 
'message_id' =>$mid, 
])->ok;
}
if($okk==true or $ok==true){
$x=$x+1;
bot('editMessageText',[
  'chat_id'=>$cid,
'message_id'=>$mid,
'text'=>"✅ <b>Yuborildi:</b> $x

❌ <b>Yuborilmadi:</b> $y",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
}elseif($okk==false){
$y=$y+1;
bot('editmessagetext',[
'chat_id'=>$cid,
'message_id'=>$mid + 1,
'text'=>"✅ <b>Yuborildi:</b> $x

❌ <b>Yuborilmadi:</b> $y",
'parse_mode'=>'html',
]);
}
bot('editmessagetext',[
'chat_id'=>$cid,
'message_id'=>$mid + 1,
'text'=>"✅ <b>Yuborildi:</b> $x

❌ <b>Yuborilmadi:</b> $y",
'parse_mode'=>'html',
]);
}
}

if($forward){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>👥 Forward xabaringiz barcha bot foydalanuvchilariga yuborildi!✅</b>",
'parse_mode'=>'html',
'reply_markup'=>$message_manager,
]);
}

if(in_array($cid,$admin)){
if($text == "📢 Kanallar boshqaruvi"){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📢 Kanallar boshqaruvi boʻlimidasiz!
📋 Quyidagi boʻlimlardan birini tanlang!</b>",
'parse_mode'=>'html',
'reply_markup'=>$channel_manager,
]);
}
}

if(in_array($cid,$admin)){
if($text == "📢 Kanal qoʻshish"){
file_put_contents("step/$cid/$cid.txt","kanal");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📡 Kanal qo‘shish uchun kanal havolasini yuboring!
🔰 Masalan: @PcoUz_vlogs</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}
}

if($step == "kanal" and $text!= "/start" and $text!= $back and $text!= "👨🏻‍💻 Boshqaruv paneli"){
if(mb_stripos($kanal,"$text")!==false){
}else{
file_put_contents("data/kanal.txt","$kanal\n$text");
file_put_contents("data/channel.txt","true");
unlink("step/$cid/$cid.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📡 Kanalingiz botga muvaffaqiyatli qo‘shildi!
🤖 Endi botni kanalingizga admin qiling!</b>",
'parse_mode'=>'html',
'reply_markup'=>$channel_manager,
]);
}
}

if(in_array($cid,$admin)){
if($text == "📢 Kanalni oʻchirish"){
$ids = explode("\n",$kanal);
$soni = substr_count($kanal,"@");
foreach($ids as $id){
$keyboards = [];
$k=[];
for ($for = 1; $for <= $soni; $for++) {
$kanall=str_replace("@","",$ids[$for]);
$title = str_replace("\n","",$ids[$for]);
$keyboards[]=["text"=>"🗑 $title","callback_data"=>"delchane-$title"];
}
$keyboard2=array_chunk($keyboards, 1);
$keyboard=json_encode([
'inline_keyboard'=>$keyboard2,
]);
}
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 Quyidagi kanallardan birini tanlang!</b>",
'parse_mode'=>'html',
'reply_markup'=>$keyboard,
]);
}
}

if(mb_stripos($data, "delchane-")!==false){
$explode = explode("delchane-",$data);
$explode = $explode[1];
$k = str_replace("\n".$explode."","",$kanal);
file_put_contents("data/kanal.txt",$k);
bot('deleteMessage',[
'chat_id'=>$callcid,
'message_id'=>$callmid,
]);
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"<b>✅ Kanal muvaffaqiyatli oʻchirildi!</b>",
'parse_mode'=>'html',
]);
}


if(in_array($cid,$admin)){
if($text == "📋 Kanallar roʻyxati"){
if($kanal == null){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 Botga ulangan kanallar mavjud emas!</b>",
'parse_mode'=>'html',
'reply_markup'=>$channel_manager,
]);
}else{
$ids = explode("\n",$kanal);
$soni = substr_count($kanal,"@");
foreach($ids as $id){
$keyboards = [];
$k=[];
for ($for = 1; $for <= $soni; $for++) {
$kanall=str_replace("@","",$ids[$for]);
$title = str_replace("\n","",$ids[$for]);
$keyboards[]=["text"=>"📡 $title","url"=>"https://t.me/$kanall"];
}
$keyboard2=array_chunk($keyboards, 1);
$keyboard=json_encode([
'inline_keyboard'=>$keyboard2,
]);
}
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 Kanallar roʻyxati:</b>",
'parse_mode'=>'html',
'reply_markup'=>$keyboard,
]);
}
}
}

if(in_array($cid,$admin)){
if($text == "📋 Kanallar roʻyxatini oʻchirish"){
if($kanal == null){
unlink("data/kanal.txt");
unlink("data/channel.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 Botga ulangan kanallar mavjud emas!</b>",
'parse_mode'=>'html',
'reply_markup'=>$channel_manager,
]);
}else{
unlink("data/kanal.txt");
unlink("data/channel.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 Kanallar roʻyxati muvaffaqiyatli oʻchirildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$channel_manager,
]);
}
}
}

if(in_array($cid,$admin)){
if($text == "🔐 Blok tizimi"){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🔐 Blok tizimi boʻlimidasiz!
📋 Quyidagi boʻlimlardan birini tanlang!</b>",
'parse_mode'=>'html',
'reply_markup'=>$blok_manager,
]);
}
}

if(in_array($cid,$admin)){
if($text == "✅ Blokdan olish"){
	if($blocks == null){
		bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 Botda bloklanganlar mavjud emas!</b>",
'parse_mode'=>'html',
]);
}else{
file_put_contents("step/$cid/$cid.txt","unblock");
$ids = explode("\n",$blocks);
$soni = substr_count($blocks,"\n");
foreach($ids as $id){
$keyboards = [];
$k=[];
for ($for = 1; $for <= $soni; $for++) {
$title = str_replace("\n","",$ids[$for]);
$a = json_decode(file_get_contents("https://api.telegram.org/bot".API_KEY."/getchat?chat_id=$title"));
$name = $a->result->first_name;
$keyboards[]=["text"=>"♻️ $name","callback_data"=>"blokcon-$title"];
}
$keyboard2=array_chunk($keyboards, 1);
$keyboard=json_encode([
'inline_keyboard'=>$keyboard2,
]);
}
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🚫 Blokdan olinadigan foydalanuvchini ID raqamini kiriting!
⬇️ Yoki quyidagilarni tanlang!</b>",
'parse_mode'=>'html',
'reply_markup'=>$keyboard,
]);
}
}
}

if(mb_stripos($data, "blokcon-")!==false){
$explode = explode("blokcon-",$data);
$explode = $explode[1];
unlink("step/$callcid/$callcid.txt");
$bl = str_replace("$explode", " ", $blocks);
file_put_contents("data/blocks.txt", "$bl");
bot('deleteMessage',[
'chat_id'=>$callcid,
'message_id'=>$callmid,
]);
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"<b>🔰 Foydalanuvchi blokdan olindi! ✅</b>",
'parse_mode'=>'html',
]);
bot('sendMessage',[
'chat_id'=>$explode,
'text'=>"<b>🎉 Siz blokdan muvaffaqiyatli olindingiz!

🔄 Yana botni ishlatishingiz mumkin!

🤖 Botga qayta /start bosing ✅</b>",
'parse_mode'=>'html',
'reply_markup'=>$home,
]);
}

if(in_array($cid,$admin)){
if($step == "unblock" and $text!= "/start" and $text!= $back and $text!= "👨🏻‍💻 Boshqaruv paneli"){
unlink("step/$cid/$cid.txt");
if(mb_stripos($blocks, $text)==false){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>👨🏻‍💻 Ushbu foydalanuvchi botdan bloklanmagan!</b>",
'parse_mode'=>'html',
'reply_markup'=>$blok_manager,
]);
}else{
$bl = str_replace("$text", " ", $blocks);
file_put_contents("data/blocks.txt", "$bl");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🔰 Foydalanuvchi blokdan olindi! ✅</b>",
'parse_mode'=>'html',
'reply_markup'=>$blok_manager,
]);
bot('sendMessage',[
'chat_id'=>$text,
'text'=>"<b>🎉 Siz blokdan muvaffaqiyatli olindingiz!

🔄 Yana botni ishlatishingiz mumkin!

🤖 Botga qayta /start bosing ✅</b>",
'parse_mode'=>'html',
'reply_markup'=>$home,
]);
}
}
}

if(in_array($cid,$admin)){
if($text == "❌ Bloklash"){
file_put_contents("step/$cid/$cid.txt","block");
$ids = explode("\n",$statistika);
$soni = substr_count($statistika,"\n");
foreach($ids as $id){
$keyboards = [];
$k=[];
for ($for = 1; $for <= $soni; $for++) {
$title = str_replace("\n","",$ids[$for]);
$a = json_decode(file_get_contents("https://api.telegram.org/bot".API_KEY."/getchat?chat_id=$title"));
$name = $a->result->first_name;
$keyboards[]=["text"=>"🚫 $name","callback_data"=>"blokcla-$title"];
}
$keyboard2=array_chunk($keyboards, 1);
$keyboard=json_encode([
'inline_keyboard'=>$keyboard2,
]);
}
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🚫 Bloklanadigan foydalanuvchini ID raqamini kiriting!
⬇️ Yoki quyidagilarni tanlang!</b>",
'parse_mode'=>'html',
'reply_markup'=>$keyboard,
]);
}
}

if(mb_stripos($data, "blokcla-")!==false){
$explode = explode("blokcla-",$data);
$explode = $explode[1];
unlink("step/$callcid/$callcid.txt");
file_put_contents("data/blocks.txt", "$blocks\n$explode");
bot('deleteMessage',[
'chat_id'=>$callcid,
'message_id'=>$callmid,
]);
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"<b>🔰 Foydalanuvchi bloklandi! ✅</b>",
'parse_mode'=>'html',
]);
bot('sendMessage',[
'chat_id'=>$explode,
'text'=>"<b>🚫 Siz bizning botimizdan bloklandingiz!

🔄 Endi botdan foydalana olmaysiz!

👨‍💻 Blokdan chiqish uchun bot administratoriga murojaat qiling!</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'remove_keyboard'=>true,
])
]);
}


if(in_array($cid,$admin)){
if($step == "block" and $text!= "/start" and $text!= $back and $text!= "👨🏻‍💻 Boshqaruv paneli"){
if(mb_stripos($blocks, $text)==false){
file_put_contents("data/blocks.txt", "$blocks\n$text");
unlink("step/$cid/$cid.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🔰 Foydalanuvchi bloklandi! ✅</b>",
'parse_mode'=>'html',
'reply_markup'=>$blok_manager,
]);
bot('sendMessage',[
'chat_id'=>$text,
'text'=>"<b>🚫 Siz bizning botimizdan bloklandingiz!

🔄 Endi botdan foydalana olmaysiz!

👨‍💻 Blokdan chiqish uchun bot administratoriga murojaat qiling!</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'remove_keyboard'=>true,
])
]);
}else{
unlink("step/$cid/$cid.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>👨🏻‍💻 Ushbu foydalanuvchi botdan allaqachon bloklangan!</b>",
'parse_mode'=>'html',
'reply_markup'=>$blok_manager,
]);
}
}
}

if(in_array($cid,$admin)){
if($text == "📋 Bloklanganlar roʻyxati"){
if($blocks == null){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 Botdan bloklanganlar mavjud emas!</b>",
'parse_mode'=>'html',
'reply_markup'=>$blok_manager,
]);
}else{
	$ids = explode("\n",$blocks);
$soni = substr_count($blocks,"\n");
foreach($ids as $id){
$keyboards = [];
$k=[];
for ($for = 1; $for <= $soni; $for++) {
$title = str_replace("\n","",$ids[$for]);
$a = json_decode(file_get_contents("https://api.telegram.org/bot".API_KEY."/getchat?chat_id=$title"));
$name = $a->result->first_name;
$keyboards[]=["text"=>"👤 $name","callback_data"=>"haqida-$title"];
}
$keyboard2=array_chunk($keyboards, 1);
$keyboard=json_encode([
'inline_keyboard'=>$keyboard2,
]);
}
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 Botdan bloklanganlar roʻyxati:</b>",
'parse_mode'=>'html',
'reply_markup'=>$keyboard,
]);
}
}
}

if(mb_stripos($data, "haqida-")!==false){
$explode = explode("haqida-",$data);
$explode = $explode[1];
$a = json_decode(file_get_contents("https://api.telegram.org/bot".API_KEY."/getchat?chat_id=$explode"));
$name = $a->result->first_name;
$user = $a->result->username;
$bio = $a->result->bio;
bot('deleteMessage',[
'chat_id'=>$callcid,
'message_id'=>$callmid,
]);
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"<b>🗣 Foydalanovchi nomi: $name
🔰 Usernamesi: @$user
📄 Biosi: $bio</b>",
'parse_mode'=>'html',
]);
}


if(in_array($cid,$admin)){
if($text == "📋 Bloklanganlar roʻyxatini oʻchirish"){
if($blocks == null){
unlink("data/blocks.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 Botdan bloklanganlar mavjud emas!</b>",
'parse_mode'=>'html',
'reply_markup'=>$blok_manager,
]);
}else{
unlink("data/blocks.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 Bloklanganlar roʻyxati muvaffaqiyatli oʻchirildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$blok_manager,
]);
}
}
}

if(in_array($cid,$admin)){
if($text == "⚙ Bot sozlamalari"){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⚙ Bot sozlamalari boʻlimidasiz!
📋 Quyidagi boʻlimlardan birini tanlang!</b>",
'parse_mode'=>'html',
'reply_markup'=>$bot_manager,
]);
}
}

if(in_array($cid,$admin)){
if($text == "✅ Botni yoqish"){
unlink("data/bot.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⚠️ Bot muvaffaqiyatli yoqildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$bot_manager,
]);
}
}

if(in_array($cid,$admin)){
if($text == "❌ Botni o‘chirish"){
file_put_contents("data/bot.txt","off");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⚠️ Bot muvaffaqiyatli oʻchirildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$bot_manager,
]);
}
}

if(in_array($cid,$admin)){
if($text == "📋 Adminlar boshqaruvi"){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 Adminlar boshqaruvi boʻlimidasiz!
📋 Quyidagi boʻlimlardan birini tanlang!</b>",
'parse_mode'=>'html',
'reply_markup'=>$admins_manager,
]);
}
}

if(in_array($cid,$admin)){
if($text == "➕ Admin qoʻshish"){
file_put_contents("step/$cid/$cid.txt","setadmins");
$ids = explode("\n",$statistika);
$soni = substr_count($statistika,"\n");
foreach($ids as $id){
$keyboards = [];
$k=[];
for ($for = 1; $for <= $soni; $for++) {
$title = str_replace("\n","",$ids[$for]);
$a = json_decode(file_get_contents("https://api.telegram.org/bot".API_KEY."/getchat?chat_id=$title"));
$name = $a->result->first_name;
$keyboards[]=["text"=>"🔝 $name","callback_data"=>"addadm-$title"];
}
$keyboard2=array_chunk($keyboards, 1);
$keyboard=json_encode([
'inline_keyboard'=>$keyboard2,
]);
}
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>👨‍💻 Administrator qoʻshish uchun foydalanuvchi ID raqamini kiriting
⬇️ Yoki quyidagilarni tanlang!</b>",
'parse_mode'=>'html',
'reply_markup'=>$keyboard,
]);
}
}

if(mb_stripos($data, "addadm-")!==false){
$explode = explode("addadm-",$data);
$explode = $explode[1];
unlink("step/$callcid/$callcid.txt");
file_put_contents("data/admins.txt","$admins\n$explode");
bot('deleteMessage',[
'chat_id'=>$callcid,
'message_id'=>$callmid,
]);
$a = json_decode(file_get_contents("https://api.telegram.org/bot".API_KEY."/getchat?chat_id=$explode"));
$name = $a->result->first_name;
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"<b>📝 <a href = 'tg://user?id=$explode'>$name</a> ID raqamli foydalanuvchi botga administrator qilib tayinlandi!</b>",
'parse_mode'=>'html',
]);
bot('sendMessage',[
'chat_id'=>$explode,
'text'=>"<b>👨‍💻 Siz botga administrator qilib tayinlandingiz!</b>",
'parse_mode'=>'html',
'reply_markup'=>$home,
]);
}

if($step == "setadmins" and $text!= "/start" and $text!= $back and $text!= "👨🏻‍💻 Boshqaruv paneli"){
if(is_numeric($text)){
if(mb_stripos($statistika,$text)!==false){
file_put_contents("data/admins.txt","$admins\n$text");
unlink("step/$cid/$cid.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📝 <a href = 'tg://user?id=$text'>$text</a> ID raqamli foydalanuvchi botga administrator qilib tayinlandi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$admins_manager,
]);
bot('sendMessage',[
'chat_id'=>$text,
'text'=>"<b>👨‍💻 Siz botga administrator qilib tayinlandingiz!</b>",
'parse_mode'=>'html',
'reply_markup'=>$home,
]);
}else{
unlink("step/$cid/$cid.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>👨‍💻 Ushbu foydalanuvchi bazada mavjud emas!</b>",
'parse_mode'=>'html',
'reply_markup'=>$admins_manager,
]);
}
}else{
unlink("step/$cid/$cid.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 ID raqam kiritayotganda faqat raqamlardan foydalaning!</b>",
'parse_mode'=>'html',
'reply_markup'=>$admins_manager,
]);
}
}

if(in_array($cid,$admin)){
if($text == "🛑 Adminlikdan olish"){
if($admins == null){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 Botda administratorlar mavjud emas!</b>",
'parse_mode'=>'html',
'reply_markup'=>$admins_manager,
]);
}else{
	$ids = explode("\n",$admins);
$soni = substr_count($admins,"\n");
foreach($ids as $id){
$keyboards = [];
$k=[];
for ($for = 1; $for <= $soni; $for++) {
$title = str_replace("\n","",$ids[$for]);
$a = json_decode(file_get_contents("https://api.telegram.org/bot".API_KEY."/getchat?chat_id=$title"));
$name = $a->result->first_name;
$keyboards[]=["text"=>"🚫 $name","callback_data"=>"deladm-$title"];
}
$keyboard2=array_chunk($keyboards, 1);
$keyboard=json_encode([
'inline_keyboard'=>$keyboard2,
]);
}
file_put_contents("step/$cid/$cid.txt","deladmins");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>👨‍💻 Administratorni olib tashlash uchun foydalanuvchi ID raqamini kiriting
⬇️ Yoki quyidagilarni tanlang!</b>",
'parse_mode'=>'html',
'reply_markup'=>$keyboard,
]);
}
}
}

if(mb_stripos($data, "deladm-")!==false){
$explode = explode("deladm-",$data);
$explode = $explode[1];
unlink("step/$callcid/$callcid.txt");
$ad = str_replace("\n".$explode."","",$admins);
file_put_contents("data/admins.txt",$ad);
bot('deleteMessage',[
'chat_id'=>$callcid,
'message_id'=>$callmid,
]);
$a = json_decode(file_get_contents("https://api.telegram.org/bot".API_KEY."/getchat?chat_id=$explode"));
$name = $a->result->first_name;
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"<b>📝 <a href = 'tg://user?id=$explode'>$name</a> ID raqamli foydalanuvchi bot administratorligidan olib tashlandi!</b>",
'parse_mode'=>'html',
]);
bot('sendMessage',[
'chat_id'=>$explode,
'text'=>"<b>👨‍💻 Siz bot administratorligidan olib tashlandingiz!</b>",
'parse_mode'=>'html',
'reply_markup'=>$home,
]);
}

if($step == "deladmins" and $text!= "/start" and $text!= $back and $text!= "👨🏻‍💻 Boshqaruv paneli"){
if(is_numeric($text)){
if(mb_stripos($admins,$text)!==false){
unlink("step/$cid/$cid.txt");
$ad = str_replace("\n".$text."","",$admins);
file_put_contents("data/admins.txt",$ad);
unlink("step/$cid/$cid.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 <a href = 'tg://user?id=$text'>$text</a> ID raqamli foydalanuvchi bot administratorligidan olib tashlandi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$admins_manager,
]);
bot('sendMessage',[
'chat_id'=>$text,
'text'=>"<b>👨‍💻 Siz bot administratorligidan olib tashlandingiz!</b>",
'parse_mode'=>'html',
'reply_markup'=>$home,
]);
}else{
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 <a href = 'tg://user?id=$text'>$text</a> ID raqamli foydalanuvchi botda administrator emas!</b>",
'parse_mode'=>'html',
'reply_markup'=>$admins_manager,
]);
}
}else{
unlink("step/$cid/$cid.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 ID raqam kiritayotganda faqat raqamlardan foydalaning!</b>",
'parse_mode'=>'html',
'reply_markup'=>$admins_manager,
]);
}
}

if(in_array($cid,$admin)){
if($text == "📋 Adminlar roʻyxati"){
if($admins == null){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 Botda administratorlar mavjud emas!</b>",
'parse_mode'=>'html',
'reply_markup'=>$admins_manager,
]);
}else{
	$ids = explode("\n",$admins);
$soni = substr_count($admins,"\n");
foreach($ids as $id){
$keyboards = [];
$k=[];
for ($for = 1; $for <= $soni; $for++) {
$title = str_replace("\n","",$ids[$for]);
$a = json_decode(file_get_contents("https://api.telegram.org/bot".API_KEY."/getchat?chat_id=$title"));
$name = $a->result->first_name;
$keyboards[]=["text"=>"👤 $name","callback_data"=>"haqida-$title"];
}
$keyboard2=array_chunk($keyboards, 1);
$keyboard=json_encode([
'inline_keyboard'=>$keyboard2,
]);
}
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 Administratorlar roʻyxati:</b>",
'parse_mode'=>'html',
'reply_markup'=>$keyboard,
]);
}
}
}

if(in_array($cid,$admin)){
if($text == "📋 Adminlar roʻyxatini oʻchirish"){
if($admins == null){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 Botda administratorlar mavjud emas!</b>",
'parse_mode'=>'html',
'reply_markup'=>$admins_manager,
]);
}else{
unlink("data/admins.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 Administratorlar roʻyxati muvaffaqiyatli oʻchirildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$admins_manager,
]);
}
}
}
?>