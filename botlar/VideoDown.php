<?php
ob_start();
error_reporting(0);
date_default_timezone_set("Asia/Tashkent");
define('API_KEY','LITE_TOKEN');
$admins = file_get_contents("data/admins.txt");
$administrator = "LITE_ID";
$admin = array($administrator,$admins);
$time = date('H:i');
$sana = date('d.m.Y');

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

///Avto Webhook!
$a=file_get_contents("https://api.telegram.org/bot".API_KEY."/setwebhook?url=".$_SERVER['SERVER_NAME']."".$_SERVER['SCRIPT_NAME']);
echo $a;
//

function joinchat($id){
global $mid;
$array = array("inline_keyboard");
$get = file_get_contents("data/kanal.txt");
$ex = explode("\n",$get);
if($get == null){
return true;
}else{
$ex = explode("\n",$get);
for($i=0;$i<=count($ex) -1;$i++){
$first_line = $ex[$i];
$first_ex = explode("@",$first_line);
$url = $first_ex[1];
$ism=bot('getChat',['chat_id'=>"@".$url,])->result->title;
$botism = bot('getme',['bot'])->result->username;
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
$array['inline_keyboard']["$i"][0]['url'] = "t.me/$botism?start";
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
$mid = $message->message_id;
$chat_id = $message->chat->id;
$cid = $message->chat->id;
$uid = $message->from->id;
$name = $message->chat->first_name;
$text = $message->text;
$step = file_get_contents("step/$cid/$cid.txt");
$blocks = file_get_contents("data/blocks.txt");
$holat = file_get_contents("data/bot.txt");
$kanal = file_get_contents("data/kanal.txt");
$channel = file_get_contents("data/channel.txt");
$statistika = file_get_contents("data/statistika.txt");
$Loadongg ="📬 ️Yuklanishini kuting...";
$search = "🔎 Qidirilmoqda";
mkdir("data");
mkdir("step");
mkdir("step/$cid");



$panel = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"📊 Statistika"],],
[['text'=>"📢 Kanallar"],['text'=>"📳 Bot holati"],],
[['text'=>"👤 Adminlar"],['text'=>"🔐 Blok tizimi"],],
[['text'=>"📨 Xabar yuborish"],],
]
]);

$message_manager = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"💬 Oddiy xabar"],['text'=>"💬 Forward xabar"],],
[['text'=>"🗄 Boshqarish"],],
]]);

$channel_manager = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"📋 Kanallar ro'yxati"],],
[['text'=>"➕ Qo'shish"],['text'=>"🗑 O'chirish"],],
[['text'=>"🗄 Boshqarish"],],
]]);

$blok_manager = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"📋 Bloklanganlar roʻyxati"],],
[['text'=>"✅ Blokdan olish"],['text'=>"❌ Bloklash"],],
[['text'=>"🗄 Boshqarish"],],
]]);

$bot_manager = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"✅ Botni yoqish"],['text'=>"❌ Botni o‘chirish"],],
[['text'=>"🗄 Boshqarish"],],
]]);

$admins_manager = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"📋 Adminlar roʻyxati"],],
[['text'=>"➕ Admin qoʻshish"],['text'=>"🛑 Adminlikdan olish"],],
[['text'=>"🗄 Boshqarish"],],
]]);

$ortga = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"$back"],],
]]);

if(isset($message)){
if(joinchat($cid)=="true"){
$get = file_get_contents("data/statistika.txt");
if(mb_stripos($get,$uid)==false){
file_put_contents("data/statistika.txt", "$get\n$uid");
}}}

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
]])
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
▪ Barcha funksiyalar tugallangandan keyin tiklanadi.</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'remove_keyboard'=>true,
])
]);
return false;
}

if($text == "/start" and joinchat($cid)=="true"){
unlink("step/$cid/$cid.txt");
unlink("step/$cid/@$bot.mp3");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>👋 Salom <a href = 'tg://user?id=$cid'>$name</a> botimizga xush kelibsiz!

💾 Ushbu bot orqali Instagram YouTube TikTok va Likee tarmoqlaridan video yuklashingiz mumkin</b>",
'parse_mode'=>'html',
]);
bot('sendMessage',[
'chat_id'=>$administrator,
'text'=>"<b>🗄 Assalomu alaykum boshqaruv paneliga xush kelibsiz!</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel,
]);
}

if(preg_match('(https://youtu.be)',$text) or preg_match('(http://www.youtube.com)',$text)){
if(!preg_match('(/dl_)',$text)){
if(!$data){
$YutDl= json_decode(file_get_contents("https://lmasat.tk/API/api_c/bhth.php?url=".$text),true);
$YutDl2 = $YutDl["url"][0]["url"];
$metitle = $YutDl["meta"]["title"];
$mda = $YutDl["meta"]["duration"];
$iddv = $YutDl["id"];
$Phho = "sendphoto";
$pog=bot($Phho,[
'chat_id'=>$chat_id,
'photo'=>"https://youtu.be/$iddv",
'caption'=>"*🎬 [$metitle](https://youtu.be/$iddv) \n 🕑 $mda*",
'parse_mode'=>"markdown",
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"$FictionsVideo[0]",'callback_data'=>'mo##'.$iddv]],
[['text'=>"$FictionsVideo[1]",'callback_data'=>'mo1##'.$iddv],['text'=>"$FictionsVideo[2]",'callback_data'=>'mo2##'.$iddv]],
]])
])->result->message_id;
file_put_contents("msgid.txt",$pog);
}}}

if($update->inline_query){
$text_inline = $update->inline_query->query;
$iid=$update->inline_query->id;
$idchat = $update->inline_query->chat->id; 
$idms = $update->inline_query->message_id; 

$text_inline=str_replace(' ','-',$text_inline);
$result = json_decode(file_get_contents("https://lmasat.tk/API/api_c/index.php?search=".urlencode($text_inline)))->results;
$keyboard["inline_keyboard"]=[];
for($i=0;$i < count($result);$i++){
$res[$i] = [
'type'=>'article',
'id'=>base64_encode(rand(5,555)), 'thumb_url'=>$result[$i]->image,
'title'=>$result[$i]->title,
'description' => "".$result[$i]->views." Views  - Time ".$result[$i]->duration."", 'input_message_content'=>['parse_mode'=>'HTML','message_text'=>"https://www.youtube.com/watch?v=".$result[$i]->url],
];
}
$r = json_encode($res);
bot('answerInlineQuery',[
'inline_query_id'=>$update->inline_query->id,
'results' =>($r)
]);
}

if(preg_match('(https://)',$text) or preg_match('(http://)',$text)){
if(!preg_match('(https://youtu.be)',$text)){
if(!preg_match('(http://www.youtube.com)',$text)){
$YutDl= json_decode(file_get_contents("https://lmasat.tk/API/api_c/index.php?url=" . urlencode($text)),true);

$YutDl1 = $YutDl["url"][0]["url"];
$mmusc=$YutDl["url"][1]["url"];
$metitle = $YutDl["meta"]["title"];
$mda = $YutDl["meta"]["duration"];
$Video = new CURLFile($YutDl1);
	$kls=bot('sendMessage',[      
'chat_id'=>$chat_id,   
'text'=>"*$Loadongg*",
'parse_mode'=>"markdown",
])->result->message_id;

bot('sendvideo',[ 
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'video'=>$Video,
'caption' =>" $Botu - $metitle, $mda",
]);

bot('deletemessage',[
'chat_id'=>$chat_id,
'message_id'=>$kls,
]);
}}}

$msgid = file_get_contents("msgid.txt");
if($vidi[0] == "mo"){
bot('deletemessage',[
'chat_id'=>$chat_id,
'message_id'=>$msgid,
]);

$kls=bot('sendMessage',[      
'chat_id'=>$chat_id,   
'text'=>"*$Loadongg*",
'parse_mode'=>"markdown",
])->result->message_id;
sleep(1);
bot('EditMessageText',[
'chat_id'=>$chat_id2,
'message_id'=>$kls,
"text"=>"*$Uploading*",
'parse_mode'=>"markdown",
]);
$YutDl= json_decode(file_get_contents("https://lmasat.tk/API/api_c/index.php?url=https://youtu.be/".$vidi[1]),true);
$YutDl1 = $YutDl["url"][0]["url"];
$metitle = $YutDl["meta"]["title"];
$sizee = $YutDl["url"][3]["filesize"];
$mda = $YutDl["meta"]["duration"];
$Video = new CURLFile($YutDl1);
file_put_contents("$vidi[1].mp4",file_get_contents($YutDl1));

bot('sendvideo',[ 
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'video'=>new CURLFile("$vidi[1].mp4"),
'caption' =>" $Botu - $metitle, $mda $fi",
]);
bot('deletemessage',[
'chat_id'=>$chat_id,
'message_id'=>$kls,
]);
unlink("$vidi[1].mp4");
}

if($vidi[0] == "mo1"){
$YutDl= json_decode(file_get_contents("https://lmasat.tk/API/api_c/index.php?url=https://youtu.be/".$vidi[1]),true);
$YutDl2 = $YutDl["url"][1]["url"];
$metitle = $YutDl["meta"]["title"];
$mda = $YutDl["meta"]["duration"];
$Music =new CURLFile($YutDl2);
file_put_contents("$vidi[1].mp3",file_get_contents($YutDl2));
bot('deletemessage',[
'chat_id'=>$chat_id,
'message_id'=>$msgid,
]);
$kls=bot('sendMessage',[      
'chat_id'=>$chat_id,   
'text'=>"*$Loadongg*",
'parse_mode'=>"markdown",
])->result->message_id;
sleep(1);
bot('EditMessageText',[
'chat_id'=>$chat_id2,
'message_id'=>$kls,
"text"=>"*$Uploading*",
'parse_mode'=>"markdown",
]);
bot('sendaudio',[
'chat_id'=>$chat_id,
'audio'=>new CURLFile("$vidi[1].mp3"),
'performer'=>"$title",
'title'=>"
$Botu - $metitle, $mda",
'caption' =>"*
🎵︙$metitle 
🕧︙$mda*",
'thumb'=>$thumb,
'parse_mode'=>'MarkDown',
]);
bot('deletemessage',[
'chat_id'=>$chat_id,
'message_id'=>$kls,
]);
unlink("$vidi[1].mp3");
}

if($vidi[0] == "mo2"){
$YutDl= json_decode(file_get_contents("https://lmasat.tk/API/api_c/index.php?url=https://youtu.be/".$vidi[1]),true);
$YutDl2 = $YutDl["url"][0]["url"];
$metitle = $YutDl["meta"]["title"];
$mda = $YutDl["meta"]["duration"];
$Music =new CURLFile($YutDl2);
bot('deletemessage',[
'chat_id'=>$chat_id,
'message_id'=>$msgid,
]);

$kls=bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"*$Loadongg*",
'parse_mode'=>"markdown",
])->result->message_id;
sleep(1);
bot('EditMessageText',[
'chat_id'=>$chat_id2,
'message_id'=>$kls,
"text"=>"*$Uploading*",
'parse_mode'=>"markdown",
]); 

bot('sendvoice',[
'chat_id'=>$chat_id,
'voice'=>$Music,  
'caption' =>"*$Botu - $metitle, $mda*",
]);

bot('deletemessage',[
'chat_id'=>$chat_id,
'message_id'=>$kls,
]);
}

if($text == "/panel"){
if(in_array($cid,$admin)){
unlink("step/$cid/$cid.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🗄 Assalomu alaykum boshqaruv paneliga xush kelibsiz!</b>",
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
}}

if($text == "📊 Statistika"){
if(in_array($cid,$admin)){
$odam=substr_count($statistika,"\n");
$load = sys_getloadavg();
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>💡 O'rtacha yuklanish:</b> <code>$load[0]</code>

👥 <b>Foydalanuvchilar: $odam ta</b>",
'parse_mode'=>"html",
]);
}}

if($text == "🗄 Boshqarish"){
if(in_array($cid,$admin)){
unlink("step/$cid/$cid.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🗄 Assalomu alaykum boshqaruv paneliga xush kelibsiz!</b>",
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
}}

if(in_array($cid,$admin)){
if($text == "📨 Xabar yuborish"){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 Yuboriladigan xabar turini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$message_manager,
]);
}}

if($text == "💬 Oddiy xabar"){
file_put_contents("step/$cid/$cid.txt","oddiy");
$lich=substr_count($statistika,"\n");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>$lich ta foydalanuvchiga yuboriladigan xabar matnini yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqarish"],],
]])
]);
}

if($step == "oddiy" and $text!= "/start" and $text!= $back and $text!= "🗄 Boshqarish"){
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"<b>Xabar yuborish boshlandi!</b>",
'parse_mode'=>"html",
'reply_markup'=>$panel,
]);
unlink("step/$cid/$cid.txt");
$explode = explode("\n",$statistika);
foreach($explode as $id){
$oddiy = bot('sendMessage',[
'chat_id' =>$id,
'text' =>$text,
'parse_mode'=>'HTML',
]);
}}

if($oddiy){
$lich=substr_count($statistika,"\n");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>$lich ta foydalanuvchiga muvaffaqiyatli yuborildi</b>",
'parse_mode'=>'html',
]);
}

if($text == "💬 Forward xabar"){
file_put_contents("step/$cid/$cid.txt","forward");
$lich=substr_count($statistika,"\n");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>$lich ta foydalanuvchiga yuboriladigan forward xabarni yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqarish"],],
]])
]);
}

if($step == "forward" and $text!= "/start" and $text!= $back and $text!= "🗄 Boshqarish"){
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"<b>Xabar yuborish boshlandi!</b>",
'parse_mode'=>"html",
'reply_markup'=>$panel,
]);
unlink("step/$cid/$cid.txt");
$explode = explode("\n",$statistika);
foreach($explode as $id){
$forward = bot('forwardMessage',[
'chat_id' =>$id, 
'from_chat_id' =>$cid, 
'message_id' =>$mid, 
]);
}}

if($forward){
$lich=substr_count($statistika,"\n");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>$lich ta foydalanuvchiga muvaffaqiyatli yuborildi</b>",
'parse_mode'=>'html',
]);
}

if(in_array($cid,$admin)){
if($text == "📢 Kanallar"){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📢 Kanallar boshqaruvi boʻlimidasiz!</b>",
'parse_mode'=>'html',
'reply_markup'=>$channel_manager,
]);
}}

if(in_array($cid,$admin)){
if($text == "➕ Qo'shish"){
file_put_contents("step/$cid/$cid.txt","kanal");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"➕ <b>Kerakli kanalni manzilini yuboring:

Namuna:</b> @HaydarovUz",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqarish"],],
]])
]);
}}

if($step == "kanal" and $text!= "/start" and $text!= $back and $text!= "🗄 Boshqarish"){
if(mb_stripos($kanal,"$text")!==false){
}else{
if($kanal == null){
file_put_contents("data/kanal.txt",$text);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>$text - kanal qo'shildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid/$cid.txt");
}else{
file_put_contents("data/kanal.txt","$kanal\n$text");
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>$text - kanal qo'shildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid/$cid.txt");
}}}

if(in_array($cid,$admin)){
if($text == "🗑 O'chirish"){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"🗑 <b>Barcha kanallar o'chirildi!</b>",
'parse_mode'=>'html',
]);
unlink("data/kanal.txt");
}}

if(in_array($cid,$admin)){
if($text == "📋 Kanallar ro'yxati"){
if($kanal == null){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Hech qanday kanallar ulanmagan!</b>",
'parse_mode'=>'html',
'reply_markup'=>$channel_manager,
]);
}else{
$soni = substr_count($kanal,"@");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📢 Kanallar ro'yxati:</b>

$kanal

<b>Ulangan kanallar soni:</b> $soni ta",
'parse_mode'=>'html',
'reply_markup'=>$channel_manager,
]);
}}}

if(in_array($cid,$admin)){
if($text == "🔐 Blok tizimi"){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🔐 Blok tizimi boʻlimidasiz!</b>",
'parse_mode'=>'html',
'reply_markup'=>$blok_manager,
]);
}
}

if(in_array($cid,$admin)){
if($text == "✅ Blokdan olish"){
file_put_contents("step/$cid/$cid.txt","unblock");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🚫 Blokdan olinadigan foydalanuvchini ID raqamini kiriting!</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}
}

if(in_array($cid,$admin)){
if($step == "unblock" and $text!= "/start" and $text!= $back and $text!= "/panel"){
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
'text'=>"<b>🔰 Foydalanuvchi blokdan olindi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$blok_manager,
]);
bot('sendMessage',[
'chat_id'=>$text,
'text'=>"<b>🎉 Siz blokdan muvaffaqiyatli olindingiz!

🤖 Botga qayta /start bosing</b>",
'parse_mode'=>'html',
'reply_markup'=>$home,
]);
}}}

if(in_array($cid,$admin)){
if($text == "❌ Bloklash"){
file_put_contents("step/$cid/$cid.txt","block");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🚫 Bloklanadigan foydalanuvchini ID raqamini kiriting!</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}
}

if(in_array($cid,$admin)){
if($step == "block" and $text!= "/start" and $text!= $back and $text!= "/panel"){
if(mb_stripos($blocks, $text)==false){
file_put_contents("data/blocks.txt", "$blocks\n$text");
unlink("step/$cid/$cid.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🔰 Foydalanuvchi bloklandi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$blok_manager,
]);
bot('sendMessage',[
'chat_id'=>$text,
'text'=>"<b>🚫 Siz bizning botimizdan bloklandingiz!</b>",
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
}}}

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
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 Botdan bloklanganlar roʻyxati:
$blocks</b>",
'parse_mode'=>'html',
'reply_markup'=>$blok_manager,
]);
}}}

if(in_array($cid,$admin)){
if($text == "📳 Bot holati"){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⚙ Bot sozlamalari boʻlimidasiz!</b>",
'parse_mode'=>'html',
'reply_markup'=>$bot_manager,
]);
}}

if(in_array($cid,$admin)){
if($text == "✅ Botni yoqish"){
unlink("data/bot.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>️✅ Bot muvaffaqiyatli yoqildi!</b>",
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
'text'=>"<b>️❌ Bot muvaffaqiyatli oʻchirildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$bot_manager,
]);
}
}

if(in_array($cid,$admin)){
if($text == "👤 Adminlar"){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>👤 Adminlar boshqaruvi boʻlimidasiz!</b>",
'parse_mode'=>'html',
'reply_markup'=>$admins_manager,
]);
}
}

if(in_array($cid,$admin)){
if($text == "➕ Admin qoʻshish"){
file_put_contents("step/$cid/$cid.txt","setadmins");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>👨‍💻 Foydalanuvchi ID raqamini kiriting</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}
}

if($step == "setadmins" and $text!= "/start" and $text!= $back and $text!= "/panel"){
if(is_numeric($text)){
if(mb_stripos($statistika,$text)!==false){
file_put_contents("data/admins.txt","$admins\n$text");
unlink("step/$cid/$cid.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📝 <a href = 'tg://user?id=$text'>$text</a> foydalanuvchi botga admin qilib tayinlandi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$admins_manager,
]);
bot('sendMessage',[
'chat_id'=>$text,
'text'=>"<b>👨‍💻 Siz botga admin qilib tayinlandingiz!</b>",
'parse_mode'=>'html',
'reply_markup'=>$home,
]);
}else{
unlink("step/$cid/$cid.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Foydalanuvchi bazada mavjud emas!</b>",
'parse_mode'=>'html',
'reply_markup'=>$admins_manager,
]);
}
}else{
unlink("step/$cid/$cid.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Faqat raqamlardan foydalaning!</b>",
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
'text'=>"<b>Botda adminlar topilmadi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$admins_manager,
]);
}else{
file_put_contents("step/$cid/$cid.txt","deladmins");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>👨‍💻 Foydalanuvchi ID raqamini kiriting</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}}}

if($step == "deladmins" and $text!= "/start" and $text!= $back and $text!= "/panel"){
if(is_numeric($text)){
if(mb_stripos($admins,$text)!==false){
unlink("step/$cid/$cid.txt");
$ad = str_replace("\n".$text."","",$admins);
file_put_contents("data/admins.txt",$ad);
unlink("step/$cid/$cid.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 <a href = 'tg://user?id=$text'>$text</a> foydalanuvchi bot adminligidan olib tashlandi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$admins_manager,
]);
bot('sendMessage',[
'chat_id'=>$text,
'text'=>"<b>👨‍💻 Siz bot adminligidan olib tashlandingiz!</b>",
'parse_mode'=>'html',
'reply_markup'=>$home,
]);
}else{
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 <a href = 'tg://user?id=$text'>$text</a> foydalanuvchi botda admin emas!</b>",
'parse_mode'=>'html',
'reply_markup'=>$admins_manager,
]);
}
}else{
unlink("step/$cid/$cid.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Faqat raqamlardan foydalaning!</b>",
'parse_mode'=>'html',
'reply_markup'=>$admins_manager,
]);
}}

if(in_array($cid,$admin)){
if($text == "📋 Adminlar roʻyxati"){
if($admins == null){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Botda adminlar topilmadi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$admins_manager,
]);
}else{
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 Adminlar roʻyxati:

$admins</b>",
'parse_mode'=>'html',
'reply_markup'=>$admins_manager,
]);
}}}
?>