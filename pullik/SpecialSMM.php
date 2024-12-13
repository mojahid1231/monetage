<?php
ob_start();
error_reporting(0);
date_Default_timezone_set('Asia/Tashkent');

define("AlijonovUz",'API_TOKEN');
$admin = "ADMIN_ID";
$bot = bot('getme',['bot'])->result->username;
$user = file_get_contents("tizim/user.txt");
$api = file_get_contents("tizim/api.txt");
$api_url = file_get_contents("tizim/api_url.txt");
$soat = date('H:i');
$sana = date("d.m.Y");

define("DB_SERVER", "localhost"); // Tegilmaydi
define("DB_USERNAME", "user5712_megakonst"); // Mysql baza nomi
define("DB_PASSWORD", "Megakonst"); // Mysql baza paroli
define("DB_NAME", "user5712_megakonst"); // Mysql baza nomi

$connect = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
mysqli_set_charset($connect, "utf8mb4");
if($connect){
    echo "Ulandi.";
}

function joinchat($id){
global $mid;
$array = array("inline_keyboard");
$get = file_get_contents("tizim/kanal.txt");
$ex = explode("\n",$get);
if($get == null){
return true;
}else{
for($i=0;$i<=count($ex) -1;$i++){
$first_line = $ex[$i];
$first_ex = explode("-",$first_line);
$name = $first_ex[0];
$url = $first_ex[1];
     $ret = bot("getChatMember",[
         "chat_id"=>"@$url",
         "user_id"=>$id,
         ]);
$stat = $ret->result->status;
         if((($stat=="creator" or $stat=="administrator" or $stat=="member"))){
      $array['inline_keyboard']["$i"][0]['text'] = "✅ ". $name;
$array['inline_keyboard']["$i"][0]['url'] = "https://t.me/$url";
         }else{
$array['inline_keyboard']["$i"][0]['text'] = "❌ ". $name;
$array['inline_keyboard']["$i"][0]['url'] = "https://t.me/$url";
$uns = true;
}
}
$array['inline_keyboard']["$i"][0]['text'] = "🔄 Tekshirish";
$array['inline_keyboard']["$i"][0]['callback_data'] = "result";
if($uns == true){
     bot('sendMessage',[
         'chat_id'=>$id,
         'text'=>"⚠️ <b>Botdan foydalanish uchun, quyidagi kanallarga obuna bo'ling:</b>",
'parse_mode'=>html,
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode($array),
]);  
exit();
return false;
}else{
return true;
}
}
}

function getAdmin($chat){
$url = "https://api.telegram.org/bot".AlijonovUz."/getChatAdministrators?chat_id=@".$chat;
$result = file_get_contents($url);
$result = json_decode ($result);
return $result->ok;
}

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

function bot($method,$datas=[]){
	$url = "https://api.telegram.org/bot".AlijonovUz."/".$method;
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

$alijonov = json_decode(file_get_contents('php://input'));
$message = $alijonov->message;
$cid = $message->chat->id;
$name = $message->chat->first_name;
$tx = $message->text;
$step = file_get_contents("step/$cid.step");
$mid = $message->message_id;
$type = $message->chat->type;
$text = $message->text;
$uid= $message->from->id;
$name = $message->from->first_name;
$familya = $message->from->last_name;
$bio = $message->from->about;
$username = $message->from->username;
$chat_id = $message->chat->id;
$message_id = $message->message_id;
$reply = $message->reply_to_message->text;
$nameru = "<a href='tg://user?id=$uid'>$name $familya</a>";

//inline uchun metodlar
$data = $alijonov->callback_query->data;
$qid = $alijonov->callback_query->id;
$id = $alijonov->inline_query->id;
$query = $alijonov->inline_query->query;
$query_id = $alijonov->inline_query->from->id;
$cid2 = $alijonov->callback_query->message->chat->id;
$mid2 = $alijonov->callback_query->message->message_id;
$callfrid = $alijonov->callback_query->from->id;
$callname = $alijonov->callback_query->from->first_name;
$calluser = $alijonov->callback_query->from->username;
$surname = $alijonov->callback_query->from->last_name;
$about = $alijonov->callback_query->from->about;
$nameuz = "<a href='tg://user?id=$callfrid'>$callname $surname</a>";

if(file_get_contents("tugma/key1.txt")){
	}else{
		if(file_put_contents("tugma/key1.txt",'📦 Buyurtma berish'));
	}
if(file_get_contents("tugma/key2.txt")){
	}else{
		if(file_put_contents("tugma/key2.txt","💵 Pul yig'ish"));
	}
	if(file_get_contents("tugma/key3.txt")){
	}else{
		if(file_put_contents("tugma/key3.txt","👔 Kabinet"));
	}
if(file_get_contents("tugma/key4.txt")){
	}else{
		if(file_put_contents("tugma/key4.txt",'📨 Yordam'));
}
if(file_get_contents("tugma/key5.txt")){
	}else{
		if(file_put_contents("tugma/key5.txt","🛍 Buyurtmalar"));
	}
	
if(file_get_contents("tizim/user.txt")){
	}else{
		if(file_put_contents("tizim/user.txt",'Kiritilmagan'));
}
if(file_get_contents("tizim/promo.txt")){
	}else{
		if(file_put_contents("tizim/promo.txt",'Kiritilmagan'));
}
if(file_get_contents("tizim/referal.txt")){
	}else{
		if(file_put_contents("tizim/referal.txt",'250'));
}
if(file_get_contents("tizim/valyuta.txt")){
	}else{
		if(file_put_contents("tizim/valyuta.txt","so'm"));
}

if(file_get_contents("tizim/reklama.txt")){
	}else{
		if(file_put_contents("tizim/reklama.txt","Yoqilgan"));
}

if(file_get_contents("tizim/KanalMin.txt")){
	}else{
		if(file_put_contents("tizim/KanalMin.txt","0"));
}
if(file_get_contents("tizim/KanalMax.txt")){
	}else{
		if(file_put_contents("tizim/KanalMax.txt","1"));
}

if(file_get_contents("tizim/WalletMin.txt")){
	}else{
		if(file_put_contents("tizim/WalletMin.txt","0"));
}
if(file_get_contents("tizim/WalletMax.txt")){
	}else{
		if(file_put_contents("tizim/WalletMax.txt","1"));
}


$key1 = file_get_contents("tugma/key1.txt");
$key2 = file_get_contents("tugma/key2.txt");
$key3 = file_get_contents("tugma/key3.txt");
$key4 = file_get_contents("tugma/key4.txt");
$key5 = file_get_contents("tugma/key5.txt");

$test = file_get_contents("step/test.txt");
$test1 = file_get_contents("step/test1.txt");
$test2 = file_get_contents("step/test2.txt");

$turi = file_get_contents("tizim/turi.txt");
$addition = file_get_contents("tizim/$test/addition.txt");
$wallet = file_get_contents("tizim/$test/wallet.txt");

$bolim = file_get_contents("nakrutka/bolim.txt");
$ichki = file_get_contents("nakrutka/$test/ichki.txt");
$xizmat = file_get_contents("nakrutka/$test/$test1/xizmat.txt");
$servis = file_get_contents("nakrutka/$test/$test1/$test2/id.txt");
$narxi = file_get_contents("nakrutka/$test/$test1/$test2/narxi.txt");
$min = file_get_contents("nakrutka/$test/$test1/$test2/min.txt");
$max = file_get_contents("nakrutka/$test/$test1/$test2/max.txt");
$tavsif = file_get_contents("nakrutka/$test/$test1/$test2/tavsif.txt");

$pul = file_get_contents("pul/$cid.txt");
$pul = file_get_contents("pul/$cid2.txt");
$odam = file_get_contents("odam/$cid.dat");
$odam = file_get_contents("odam/$cid2.dat");
$ban = file_get_contents("ban/$cid.txt");
$baza = file_get_contents("azo.dat");

$kod = file_get_contents("step/kod.txt");
$money = file_get_contents("step/money.txt");
$post = file_get_contents("step/mid.txt");

$valyuta = file_get_contents("tizim/valyuta.txt");
$referal = file_get_contents("tizim/referal.txt");
$saved = file_get_contents("step/alijonov.txt");
$promo = file_get_contents("tizim/promo.txt");
$rek = file_get_contents("tizim/reklama.txt");

$kalit = file_get_contents("tizim/kalit.txt");
$kanal = file_get_contents("tizim/kanal.txt");
$KanalMin = file_get_contents("tizim/KanalMin.txt");
$KanalMax = file_get_contents("tizim/KanalMax.txt");
$WalletMin = file_get_contents("tizim/WalletMin.txt");
$WalletMax = file_get_contents("tizim/WalletMax.txt");

mkdir("pul");
mkdir("ban");
mkdir("step");
mkdir("tizim");
mkdir("odam");
mkdir("tugma");
mkdir("nakrutka");
mkdir("nakrutka/$cid");

$panel = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"⚙ Asosiy sozlamalar"]],
[['text'=>"📊 Statistika"],['text'=>"✉ Xabar yuborish"]],
[['text'=>"🔎 Foydalanuvchini boshqarish"]],
[['text'=>"🎛 Tugmalar"],['text'=>"💵 To'lov holati"]],
[['text'=>"🎫 Promokod"],['text'=>"◀️ Orqaga"]],
]
]);

$asosiy = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"*️⃣ Birlamchi sozlamalar"]],
[['text'=>"🔑 API sozlamalari"],['text'=>"💳 Hamyonlar"]],
[['text'=>"🛍 Buyurtmalarni sozlash"]],
[['text'=>"📢 Kanallar"],['text'=>"⚙ Sozlamalar"]],
[['text'=>"🗄 Boshqarish"]],
]
]);

$menu = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"$key1"]],
[['text'=>"$key2"],['text'=>"$key3"]],
[['text'=>"$key4"],['text'=>"$key5"]],
]
]);

$menus = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"$key1"]],
[['text'=>"$key2"],['text'=>"$key3"]],
[['text'=>"$key4"],['text'=>"$key5"]],
[['text'=>"🗄 Boshqarish"]],
]
]);

$back = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]],
]
]);

$boshqarish = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqarish"]],
]
]);

if($text){
$kun = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kunlik WHERE useri = '$bot'"))['kun'];
	if(($kun == "0") or (mb_stripos($kun, "-")!==false)){
	exit();
}else{
}
}

	if($text){
	if($ban == "ban"){
	exit();
}else{
}
}

if($data){
$ban = file_get_contents("ban/$cid2.txt");
	if($ban == "ban"){
	exit();
}else{
}
}

if(isset($message)){
   $baza = file_get_contents("azo.dat");
   if(mb_stripos($baza,$chat_id) !==false){
   }else{
   $txt="\n$chat_id";
   $file=fopen("azo.dat","a");
   fwrite($file,$txt);
   fclose($file);
   }
}

if($text == "/start" and joinchat($cid)==true){
if($rek == "O'chirilgan"){
	$reklama = "@$bot ga xush kelibsiz!";
}
if($rek == "Yoqilgan"){
	$reklama = "Ushbu bot @MegaKonstBot yordamida ochildi!";
}
	if($cid == $admin){
	bot('SendMessage',[
	'chat_id'=>$admin,
	'text'=>"💎 <b>Salom $name!</b>
	
$reklama",
	'parse_mode'=>'html',
	'reply_markup'=>$menus
	]);
exit();
}else{
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"💎 <b>Salom $name!</b>
	
$reklama",
	'parse_mode'=>'html',
	'reply_markup'=>$menu
	]);
exit();
}
}

	if(isset($message)){
$pul = file_get_contents("pul/$cid.txt");
$mm = $pul + 0;
file_put_contents("pul/$cid.txt","$mm");
$odam = file_get_contents("odam/$cid.dat");
$kkd = $odam + 0;
file_put_contents("odam/$cid.dat","$kkd");
}


	if(mb_stripos($text,"VIP")!==false){
$refid = str_replace("/start VIP","",$text);
if($rek == "O'chirilgan"){
	$reklama = "@$bot ga xush kelibsiz!";
}
if($rek == "Yoqilgan"){
	$reklama = "Ushbu bot @MegaKonstBot yordamida ochildi!";
}
if(strlen($refid)>0 and $refid>0){
if($refid == $cid){
bot('SendMessage',[
'chat_id'=>$cid,
	'text'=>"💎 <b>Salom $name!</b>
	
$reklama",
	'parse_mode'=>'html',
'reply_markup'=>$menu,
]);
exit();
}else{
if(mb_stripos($baza,"$cid")!==false){
bot('SendMessage',[
'chat_id'=>$cid,
	'text'=>"💎 <b>Salom $name!</b>
	
$reklama",
	'parse_mode'=>'html',
'reply_markup'=>$menu
]);
exit();
}else{
$pul = file_get_contents("pul/$refid.txt");
$a = $pul + $referal;
file_put_contents("pul/$refid.txt","$a");
$odam = file_get_contents("odam/$refid.dat");
$b = $odam + 1;
file_put_contents("odam/$refid.dat","$b");
bot('sendMessage',[
'chat_id'=>$cid,
	'text'=>"💎 <b>Salom $name!</b>
	
$reklama",
	'parse_mode'=>'html',
'reply_markup'=>$menu,
]);
bot('SendMessage',[
'chat_id'=>$refid,
'text'=>"➕ <b>Sizda yangi taklif bor</b>",
'parse_mode'=>'html',
]);
exit();
}
}
}
}

if($data == "result"){
if($rek == "O'chirilgan"){
	$reklama = "@$bot ga xush kelibsiz!";
}
if($rek == "Yoqilgan"){
	$reklama = "Ushbu bot @MegaKonstBot yordamida ochildi!";
}
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2
]);
if(joinchat($cid2)==true){
 if($cid2 != $admin){
bot('SendMessage',[
'chat_id'=>$cid2,
	'text'=>"💎 <b>Salom $callname!</b>
	
$reklama",
	'parse_mode'=>'html',
	'reply_markup'=>$menu,
]);
exit();
}else{
bot('SendMessage',[
'chat_id'=>$cid2,
	'text'=>"💎 <b>Salom $callname!</b>
	
$reklama",
	'parse_mode'=>'html',
'reply_markup'=>$menus
]);
exit();
}
}
}

if($text == "◀️ Orqaga"){
        if($cid == $admin){
	bot('SendMessage',[
	'chat_id'=>$admin,
	'text'=>"<b>🖥 Asosiy menyuga qaytdingiz.</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$menus,
]);
unlink("step/$cid.step");
unlink("step/alijonov.txt");
exit();
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🖥 Asosiy menyuga qaytdingiz.</b>",
'parse_mode'=>'html',
'reply_markup'=>$menu
]);
unlink("step/$cid.step");
unlink("step/alijonov.txt");
exit();
}
}

if($text == "$key3" and joinchat($cid)==true){
		bot('SendMessage',[
		'chat_id'=>$cid,
	'text'=>"🔑<b> Sizning ID raqamingiz:</b> <code>$cid</code>

💵 <b>Umumiy balansingiz:</b> $pul $valyuta
👥 <b>Takliflaringiz soni:</b> $odam ta",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"💳 Pul kiritish",'callback_data'=>"oplata"]],
]
])
]);
exit();
}

if($data == "kabinet"){
	bot('DeleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
	'text'=>"🔑<b> Sizning ID raqamingiz:</b> <code>$cid2</code>

💵 <b>Umumiy balansingiz:</b> $pul $valyuta
👥 <b>Takliflaringiz soni:</b> $odam ta",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"💳 Pul kiritish",'callback_data'=>"oplata"]],
]
])
]);
exit();
}

$turi = file_get_contents("tizim/turi.txt");
$more = explode("\n",$turi);
$soni = substr_count($turi,"\n");
$keys=[];
for ($for = 1; $for <= $soni; $for++) {
$title=str_replace("\n","",$more[$for]);
$keys[]=["text"=>"$title","callback_data"=>"pay-$title"];
$keysboard2 = array_chunk($keys, 2);
$keysboard2[] = [['text'=>"◀️ Orqaga",'callback_data'=>"kabinet"]];
$payment = json_encode([
'inline_keyboard'=>$keysboard2,
]);
}

if($data == "oplata"){
	if($turi == null){
			bot('answerCallbackQuery',[
	'callback_query_id'=>$qid,
	'text'=>"To'lov tizimlari topilmadi!",
	'show_alert'=>true,
	]);
}else{
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
                'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>"html",
        'reply_markup'=>$payment
]);
}
}

if($data == "orqa"){
        bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>"html",
        'reply_markup'=>$payment
]);
}

if(mb_stripos($data, "pay-")!==false){
	$ex = explode("-",$data);
	$tur = $ex[1];
	$addition = file_get_contents("tizim/$tur/addition.txt");
   $wallet = file_get_contents("tizim/$tur/wallet.txt");
$us = str_replace("@","",$user);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>📋 To'lov tizimi:</b> $tur

<i>💳 Hamyon ( yoki karta ):</i> <code>$wallet</code>
<i>📝 Izoh:</i> <code>$cid2</code>

<b>Qo'shimcha:</b> $addition",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✍ Murojaat",'url'=>"https://t.me/$us"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"orqa"]],
]
])
]);
}

if($text == "$key2"){
	bot('sendMessage',[
	'chat_id'=>$cid,
	'text'=>"📋 <b>Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"🔗 Takliflar",'callback_data'=>"taklif"]],
	[['text'=>"🎫 Promokod",'callback_data'=>"promokod"]]
]
])
]);
exit();
}

if($data == "ishlash"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
]);
bot('sendMessage',[
	'chat_id'=>$cid2,
	'text'=>"📋 <b>Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"🔗 Takliflar",'callback_data'=>"taklif"]],
	[['text'=>"🎫 Promokod",'callback_data'=>"promokod"]]
]
])
]);
exit();
}

if($data == "taklif"){
	bot('editMessageText',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	'text'=>"⚡️ <b>Sizning taklif havolalaringiz:</b>

<pre>https://t.me/$bot?start=VIP$cid2</pre>
<pre>tg://resolve?domain=$bot&start=VIP$cid2</pre>

<b>1 ta taklif uchun $referal $valyuta beriladi.

Sizning takliflaringiz: $odam ta</b>",
'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"↗️ Ulashish",'url'=>"https://t.me/share/url?url=https://t.me/$bot?start=VIP$cid2"]],
	[['text'=>"◀️ Orqaga",'callback_data'=>"ishlash"]]
]
])
]);
}

if($data == "promokod"){
	if($promo == "Kiritilmagan"){
		bot('answerCallbackQuery',[
	'callback_query_id'=>$qid,
	'text'=>"Promokod kanali ulanmagan!",
	'show_alert'=>true,
	]);
		}else{
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
	'text'=>"<b>Promokodni kiriting:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$back
	]);
		file_put_contents("step/$cid2.step",'AlijonovUz');
		exit();
}
}

if($step == "AlijonovUz"){
$kod = file_get_contents("step/kod.txt");
	if($text == $kod){
$money = file_get_contents("step/money.txt");
$a = $pul + $money;
file_put_contents("pul/$cid.txt",$a);        
		bot('SendMessage',[
		'chat_id'=>$cid,
		'text'=>"✅ <b>Promokod to'g'ri kiritildi va hisobingizga $money $valyuta qo'shildi!</b>",
		'parse_mode'=>'html',
		'reply_markup'=>$menu,
		]);
        bot('deleteMessage',[
	'chat_id'=>$promo,
	'message_id'=>$post,
	]);
		bot('SendMessage',[
		'chat_id'=>$promo,
		'text'=>"<b>✅ Promokod ishlatildi!</b>

🎫 <i>Promokod:</i> <code>$kod</code>
👤 <i>Foydalanuvchi:</i> <a href='https://t.me/$username'>$name</a>",
'disable_web_page_preview'=>true,
		'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🤖 Botga kirish",'url'=>"https://t.me/$bot"]]
]
])
]);
unlink("step/money.txt");
unlink("step/kod.txt");
unlink("step/mid.txt");
unlink("step/$cid.step");
exit();
}else{
		bot('SendMessage',[
		'chat_id'=>$cid,
		'text'=>"<b>🙁 Qabul qilinmadi</b>
   Qayta urinib ko'ring:",
		'parse_mode'=>'html',
		]);
		exit();
	}
}

$bolim = file_get_contents("nakrutka/bolim.txt");
$more = explode("\n",$bolim);
$soni = substr_count($bolim,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$title = str_replace("\n","",$more[$for]);
$key[]=["text"=>"$title","callback_data"=>"nakrutka-$title"];
$keyboard2 = array_chunk($key, 2);
$nakrutka = json_encode([
'inline_keyboard'=>$keyboard2,
]);
}


	if($text=="$key1" and joinchat($cid)==true){
		if($bolim == null){
			bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"🤷‍♂️ <b>Bo'limlar mavjud emas!</b>",
	'parse_mode'=>'html',
    ]);
exit();
}else{
	bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"<b>📱 Quyidagi ijtimoiy tarmoqlardan birini tanlang:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$nakrutka
    ]);
exit();
}
}

if($data == "servis"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
	'chat_id'=>$cid2,
	'text'=>"<b>📱 Quyidagi ijtimoiy tarmoqlardan birini tanlang:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$nakrutka
    ]);
exit();
}

if(mb_stripos($data,"nakrutka-")!==false){
$ex=explode("-",$data)[1];
$ichki = file_get_contents("nakrutka/$ex/ichki.txt");
if($ichki == null){
	bot('answerCallbackQuery',[
		'callback_query_id'=>$qid,
		'text'=>"⚠️ Ushbu bo'lim uchun xizmat turlari topilmadi!",
		'show_alert'=>true,
		]);
}else{
	$ichki = file_get_contents("nakrutka/$ex/ichki.txt");
$more = explode("\n",$ichki);
$soni = substr_count($ichki,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$title = str_replace("\n","",$more[$for]);
$key[]=["text"=>"$title","callback_data"=>"tanlash-$title-$ex"];
$keyboard2 = array_chunk($key, 1);
$keyboard2[] = [['text'=>"◀️ Orqaga",'callback_data'=>"servis"]];
$ichki2 = json_encode([
'inline_keyboard'=>$keyboard2,
]);
}
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
'text'=>"<b>⬇️ Kerakli xizmat turini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$ichki2,
]);
}
}

if(mb_stripos($data,"tanlash-")!==false){
$ich = explode("-",$data)[1];
$bolim = explode("-",$data)[2];
$ichki = file_get_contents("nakrutka/$bolim/$ich/xizmat.txt");
if($ichki == null){
bot('answerCallbackQuery',[
'callback_query_id'=>$qid,
'text'=>"⚠️ Ushbu bo'lim uchun xizmat turlari topilmadi!",
'show_alert'=>true,
]);
}else{
$more = explode("\n",$ichki);
$soni = substr_count($ichki,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$title = str_replace("\n","",$more[$for]);
$key[]=["text"=>"$title","callback_data"=>"xizm-$title-$ich-$bolim"];
$keyboard2 = array_chunk($key, 1);
$keyboard2[] = [['text'=>"◀️ Orqaga",'callback_data'=>"servis"]];
$xizmatlar = json_encode([
'inline_keyboard'=>$keyboard2,
]);
}
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
'text'=>"⬇️ <b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$xizmatlar
]);
}
}

if(mb_stripos($data,"xizm-")!==false){
$xiz = explode("-",$data)[1];
$ich = explode("-",$data)[2];
$bolim = explode("-",$data)[3];
$servis = file_get_contents("nakrutka/$bolim/$ich/$xiz/id.txt");
$narxlar = file_get_contents("nakrutka/$bolim/$ich/$xiz/narxi.txt");
$min = file_get_contents("nakrutka/$bolim/$ich/$xiz/min.txt");
$max = file_get_contents("nakrutka/$bolim/$ich/$xiz/max.txt");
$tavsif = file_get_contents("nakrutka/$bolim/$ich/$xiz/tavsif.txt");
$narxi = $narxlar * 1000;
	bot('editMessageText',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	'text'=>"📦 <b><u>$xiz</u></b>

💵 <b><u>Narx (x1000):</u></b> $narxi $valyuta
📑 <b><u>Batafsil ma'lumot:</u></b> $tavsif

🔽 <b><u>Minimal buyurtma miqdori:</u></b> $min ta
🔼 <b><u>Maksimal buyurtma miqdori:</u></b> $max ta",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✅ Tanlash",'callback_data'=>"tanla-$xiz-$servis-$narxi-$min-$max"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"tanlash-$ich-$bolim"]],
]
])
]);
}

if(mb_stripos($data, "tanla-")!==false){
	$ex = explode("-",$data);
	$xiz = $ex[1];
	$servis = $ex[2];
	$narxi = $ex[3];
	$min = $ex[4];
	$max = $ex[5];
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
	'text'=>"<b><u>Kerakli buyurtma miqdorini kiriting:</u></b>",
	'parse_mode'=>'html',
	'reply_markup'=>$back,
	]);
	file_put_contents("step/$cid2.step","next-$xiz-$servis-$narxi-$min-$max");
	exit();
}

if(mb_stripos($step, "next-")!==false){
        if(is_numeric($text)=="true"){
	$ex = explode("-",$step);
	$xiz = $ex[1];
	$servis = $ex[2];
	$narx = $ex[3];
	$min = $ex[4];
	$max = $ex[5];	
	if($text >= $min and $text <= $max){
$pul = file_get_contents("pul/$cid.txt");
$narxi = $text / 1000 * $narx;
if($pul >= $narxi){
file_put_contents("nakrutka/$cid/$cid.son",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>✅ $text ta buyurtma qabul qilindi</b>

🔗 <i>Buyurtma havolasini yuboring:</i>

❕ <b>Namuna:</b> https://havola ( yoki telegram kanallar, hamda guruhlar uchun - @user )",
'disable_web_page_preview'=>true,
	'parse_mode'=>'html',
	]);
	file_put_contents("step/$cid.step","nexts-$xiz-$servis-$narxi");
	exit();
}else{
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Hisobingizda yetarli mablag' mavjud emas!</b>

Qayta urinib ko'ring:",
	'parse_mode'=>'html',
	]);
	exit();
}
}else{
$min = $ex[4];
$max = $ex[5];
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>🚫 Minimal buyurtma - $min ta
Maksimal buyurtma - $max ta</b>

Qayta urinib ko'ring:",
	'parse_mode'=>'html',
	]);
	exit();
}
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Faqat raqamlardan foydalaning!</b>",
'parse_mode'=>'html',
]);
exit();
}
}


if(mb_stripos($step, "nexts-")!==false){
if((mb_stripos($text,"https://")!==false) or (mb_stripos($text,"@")!==false)){
	  $ex = explode("-",$step);
	$xiz = $ex[1];
	$servis = $ex[2];
	$narxi = $ex[3];
file_put_contents("nakrutka/$cid/$cid.url",$text);
$son = file_get_contents("nakrutka/$cid/$cid.son");
$url = file_get_contents("nakrutka/$cid/$cid.url");
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>✅ Qabul qilindi!

⚠️ Buyurtmani tasdiqlashdan oldin, quyidagi ma'lumotlarni tekshirib chiqing:

Buyurtma turi:</b> $xiz
🔗 <b>Havola:</b> $url
👤 <b>Buyurtma miqdori:</b> $son ta
💳 <b>Buyurtma narxi:</b> $narxi $valyuta
💵 <b>Sizning balansingiz:</b> $pul $valyuta

❔ Barchasi to'g'ri kiritilganiga ishonchingiz komilmi? ✅ <b>Ha</b> tugmasini bosganingizdan so'ng, hisobingizdan $narxi $valyuta yechib olinadi va buyurtma yuboriladi!",
	'disable_web_page_preview'=>true,
	'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✅ Tasdiqlash",'callback_data'=>"tasdiq-$servis-$narxi"]],
[['text'=>"🚫 Bekor qilish",'callback_data'=>"bekor"]],
]
])
]);
 unlink("step/$cid.step");
exit();
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Bu havola emas! Havolani to'g'ri yuboring:</b>",
'parse_mode'=>'html',
]);
exit();
}
}

if(mb_stripos($data, "tasdiq-")!==false){
	$ex = explode("-",$data);
	$servis = $ex[1];
	$narxi = $ex[2];
	$son = file_get_contents("nakrutka/$cid2/$cid2.son");
	$url = file_get_contents("nakrutka/$cid2/$cid2.url");
	$pul = file_get_contents("pul/$cid2.txt");
   $ayir = $pul - $narxi;
   file_put_contents("pul/$cid2.txt","$ayir");
$json = json_decode(file_get_contents("$api_url?key=$api&action=add&service=$servis&link=$url&quantity=$son"),true);
$order = $json['order'];
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"⏱ <i>Yuklanmoqda...</i>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
       'text'=>"⏱ <i>Yuklanmoqda...</i>",
       'parse_mode'=>'html',
]);
     bot('deleteMessage',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>✅ Buyurtma qabul qilindi!

Buyurtma ID si:</b> <code>$order</code>

<i>Yuqoridagi ID orqali buyurtmangiz haqida ma'lumot olishingiz mumkin!</i>",
'parse_mode'=>'html',
'reply_markup'=>$menu,
]);
}

if($data == "bekor"){
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
              'text'=>"⏱ <i>Yuklanmoqda...</i>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
       'text'=>"⏱ <i>Yuklanmoqda...</i>",
       'parse_mode'=>'html',
]);
     bot('deleteMessage',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>⛔️ Bekor qilindi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$menu,
]);
unlink("nakrutka/$cid2/$cid2.son");
unlink("nakrutka/$cid2/$cid2.url");
exit();
}

if($text=="$key4" and joinchat($cid)==true){
		bot('SendMessage',[
		'chat_id'=>$cid,
		'text'=>"<b>Murojaat matnini kiriting:</b>",
'parse_mode'=>'html',
'reply_markup'=>$back,
]);
file_put_contents("step/$cid.step",'murojaat');
exit();
}

if($step == "murojaat"){
    bot('SendMessage',[
      'chat_id'=>$cid,
      'text'=>"<b>Murojaat qabul qilindi. Javobni kuting!</b>",
      'parse_mode'=>'html',
      'reply_markup'=>$menu,
      ]);
      bot('SendMessage',[
        'chat_id'=>$admin,
        'text'=>"<a href='https://t.me/$username'>$cid</a> <b>dan yangi xabar:</b> $text",
        'parse_mode'=>'html',
'disable_web_page_preview'=>true,
        'reply_markup'=>json_encode([
          'inline_keyboard'=>[
            [['text'=>"📝 Javob yozish",'callback_data'=>"send-$cid"]],           
            ]
           ])
        ]);
        unlink("step/$cid.step");
        exit();
}

if(mb_stripos($data, "send-")!==false){
  $ex = explode("-",$data);
  $id = $ex[1];
  bot('deleteMessage',[
    'chat_id'=>$cid2,
    'message_id'=>$mid2,
    ]);
    bot('sendMessage',[
      'chat_id'=>$admin,
      'text'=>"<b>Xabaringizni kiriting:</b>",
      'parse_mode'=>'html',
      'reply_markup'=>$back,
    ]);
    file_put_contents("step/$cid2.step","send-$id");
    exit();
  }

if(mb_stripos($step, "send-")!==false){
$ex = explode("-",$step);
$id = $ex[1];
  bot('sendMessage',[
    'chat_id'=>$id,
    'text'=>$text,
    'parse_mode'=>'html',
    ]);
  bot('sendMessage',[
    'chat_id'=>$admin,
    'text'=>"✅ <b>Xabaringiz yuborildi!</b>",
    'parse_mode'=>'html',
    'reply_markup'=>$menus,
    ]);
    unlink("step/$cid.step");
    exit();
}


if($text=="$key5" and joinchat($cid)==true){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Buyurtma ID sini kiriting:</b>",
'parse_mode'=>'html',
'reply_markup'=>$back,
]);
file_put_contents("step/$cid.step","1");
exit();
}

if($step == "1"){
if(is_numeric($text)==true){
$orderstat=json_decode(file_get_contents("$api_url?key=$api&action=status&order=$text"),true);
if($orderstat['status'] !=null or $orderstat['remains'] !=null){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"✅ <b>Buyurtma topildi!</b>

• <b>Buyurtma ID raqami:</b> $text
• <b>Buyurtma xolati:</b> ".$orderstat['status']."
<b>• Buyurtma miqdori:</b> ".$orderstat['remains']."",
'parse_mode'=>'html',
]);
unlink("step/$cid.step");
exit();
}else{
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Ushbu ID dagi buyurtma sizga tegishli emas!</b>

Boshqa buyurtma ID sini yuboring:",
'parse_mode'=>'html',
]);
exit();
}
}else{
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Buyurtma ID sini kiriting:</b>",
'parse_mode'=>'html',
]);
exit();
}
}

//<------ Admin Panel -------->//

if($text == "🗄 Boshqarish"){
if($cid == $admin){
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Admin paneliga xush kelibsiz!</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$panel,
	]);
	unlink("step/$cid.step");
	unlink("step/alijonov.txt");
   unlink("step/test.txt");
	exit();
}
}

if($data == "boshqarish"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
}

if($text == "💵 To'lov holati"){
if($cid == $admin){
	$kun = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kunlik WHERE useri = '$bot'"))['kun'];
$times = "$sana — $soat";
$b_time = explode(" — ",$times)[1];
$s_time = explode(":",$b_time)[0]*60;
$m_time = explode(":",$b_time)[1];
$minutes = $s_time + $m_time;
$minus = 24*60;
$qoldi = ($minus - $minutes)*60;
$hours = str_pad(floor($qoldi / (60*60)), 2, '0', STR_PAD_LEFT);
$minutes = str_pad(floor(($qoldi - $hours*60*60)/60), 2, '0', STR_PAD_LEFT);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"⏱ <b>$kun kun, $hours soat, $minutes daqiqadan so'ng bot uyqu rejimiga o'tkaziladi.

➕ Muddatni uzaytirish uchun @MegaKonstBot ga o'ting!</b>

<i>Diqqat Muddatni faqatgina asosiy admin uzaytirishi mumkin!</i>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"@MegaKonstBot",'url'=>"https://t.me/RixBuilderBot"]],
]
])
]);
exit();
}
}

if($data == "foydalanuvchi"){
$pul = file_get_contents("pul/$saved.txt");
$odam = file_get_contents("odam/$saved.dat");
$ban = file_get_contents("ban/$saved.txt");
if($ban == null){
	$bans = "🔔 Banlash";
}
if($ban == "ban"){
	$bans = "🔕 Bandan olish";
}
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>Foydalanuvchi topildi!

ID:</b> <a href='tg://user?id=$saved'>$saved</a>
<b>Balans: $pul $valyuta
Takliflar: $odam ta</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"$bans",'callback_data'=>"ban"]],
[['text'=>"➕ Pul qo'shish",'callback_data'=>"plus"],['text'=>"➖ Pul ayirish",'callback_data'=>"minus"]]
]
])
]);
exit();
}

if($text == "🔎 Foydalanuvchini boshqarish"){
if($cid == $admin){
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Kerakli foydalanuvchining ID raqamini kiriting:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$boshqarish
	]);
file_put_contents("step/$cid.step",'iD');
exit();
}
}

if($step == "iD"){
if($cid == $admin){
if(file_exists("pul/$text.txt")){
file_put_contents("step/alijonov.txt",$text);
$pul = file_get_contents("pul/$text.txt");
$odam = file_get_contents("odam/$text.dat");
$ban = file_get_contents("ban/$text.txt");
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
<b>Balans: $pul $valyuta
Takliflar: $odam ta</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"$bans",'callback_data'=>"ban"]],
[['text'=>"➕ Pul qo'shish",'callback_data'=>"plus"],['text'=>"➖ Pul ayirish",'callback_data'=>"minus"]]
]
])
]);
unlink("step/$cid.step");
exit();
}else{
bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Foydalanuvchi topilmadi.</b>

Qayta urinib ko'ring:",
'parse_mode'=>'html',
]);
exit();
}
}
}




//qo'shish
if($data == "plus"){
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"<a href='tg://user?id=$saved'>$saved</a> <b>ning hisobiga qancha pul qo'shmoqchisiz?</b>",
'parse_mode'=>"html",
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"◀️ Orqaga",'callback_data'=>"foydalanuvchi"]]
]
])
]);
file_put_contents("step/$cid2.step",'plus');
}

if($step == "plus"){
if($cid == $admin){
if(is_numeric($text)=="true"){
bot('sendMessage',[
'chat_id'=>$saved,
'text'=>"<b>Adminlar tomonidan hisobingiz $text $valyuta to'ldirildi</b>",
'parse_mode'=>"html",
'reply_markup'=>$menu,
]);
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Foydalanuvchi hisobiga $text $valyuta qo'shildi!</b>",
'parse_mode'=>"html",
'reply_markup'=>$panel,
]);
$pul = file_get_contents("pul/$saved.txt");
$miqdor = $pul + $text;
file_put_contents("pul/$saved.txt",$miqdor);
$oplata = file_get_contents("oplata/$saved.txt");
$plus = $oplata + $text;
file_put_contents("oplata/$saved.txt",$plus);
unlink("step/alijonov.txt");
unlink("step/$cid.step");
exit();
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Faqat raqamlardan foydalaning!</b>",
'parse_mode'=>'html',
'protect_content'=>true,
]);
exit();
}
}
}

//ayirish
if($data=="minus"){
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"<a href='tg://user?id=$saved'>$saved</a> <b>ning hisobiga qancha pul ayirmoqchisiz?</b>",
'parse_mode'=>"html",
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"◀️ Orqaga",'callback_data'=>"foydalanuvchi"]]
]
])
]);
file_put_contents("step/$cid2.step",'minus');
}

if($step == "minus"){
	if($cid == $admin){
if(is_numeric($text)=="true"){
bot('sendMessage',[
'chat_id'=>$saved,
'text'=>"<b>Adminlar tomonidan hisobingizdan $text $valyuta olib tashlandi</b>",
'parse_mode'=>"html",
'reply_markup'=>$menu,
]);
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Foydalanuvchi hisobidan $text $valyuta olib tashlandi!</b>",
'parse_mode'=>"html",
'reply_markup'=>$panel,
]);
$pul = file_get_contents("pul/$saved.txt");
$miqdor = $pul - $text;
file_put_contents("pul/$saved.txt",$miqdor);
unlink("step/alijonov.txt");
unlink("step/$cid.step");
exit();
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Faqat raqamlardan foydalaning!</b>",
'parse_mode'=>'html',
]);
exit();
}
}
}

if($data=="ban"){
$ban = file_get_contents("ban/$saved.txt");
if($admin != $saved){
	if($ban == "ban"){
	unlink("ban/$saved.txt");
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"<b>Foydalanuvchi ($saved) bandan olindi!</b>",
'parse_mode'=>"html",
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"◀️ Orqaga",'callback_data'=>"foydalanuvchi"]]
]
])
]);
}else{
file_put_contents("ban/$saved.txt",'ban');
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"<b>Foydalanuvchi ($saved) banlandi!</b>",
'parse_mode'=>"html",
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"◀️ Orqaga",'callback_data'=>"foydalanuvchi"]]
]
])
]);
}
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$qid,
'text'=>"Asosiy adminlarni blocklash mumkin emas!",
'show_alert'=>true,
]);
}
}

if($text == "✉ Xabar yuborish" and $cid == $admin){
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Yuboriladigan xabar turini tanlang;</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"Oddiy",'callback_data'=>"send"]],
  [['text'=>"Yopish",'callback_data'=>"boshqarish"]],	
	]
	])
	]);
	exit();
}

if($data == "send"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"*Xabaringizni kiriting:*",
'parse_mode'=>"markdown",
'reply_markup'=>$boshqarish
]);
 file_put_contents("step/$cid2.step","send");
exit();
}

if($step == "send"){
	if($cid == $admin){
$lich = file_get_contents("azo.dat");
$lichka = explode("\n",$lich);
foreach($lichka as $lichkalar){
$okuser=bot("SendMessage",[
'chat_id'=>$lichkalar,
'text'=>$text,
'parse_mode'=>'html',
'disable_web_page_preview'=>true,
]);
}
}
}
if($okuser){
bot("sendmessage",[
'chat_id'=>$admin,
'text'=>"<b>Xabaringiz yuborildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
exit();
}

if($text == "📊 Statistika"){
	if($cid == $admin){
$baza = file_get_contents("azo.dat");
$obsh = substr_count($baza,"\n");
$start_time = round(microtime(true) * 1000);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"",
'parse_mode'=>'html',
]);
$end_time = round(microtime(true) * 1000);
$ping = $end_time - $start_time;
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"💡 <b>PING:</b> <code>$ping</code>
👥 <b>Foydalanuvchilar:</b> $obsh ta",
'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"Yopish",'callback_data'=>"boshqarish"]]
]
])
]);
exit();
}
}

if($text == "🎫 Promokod"){
if($cid == $admin){
if($promo != "Kiritilmagan"){
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Yangi promokodni kiriting:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$boshqarish,
	]);
	file_put_contents("step/$cid.step",'pro');
	exit();
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"📢 <b>Promokod kanali ulanmagan!</b>",
'parse_mode'=>'html',
]);
exit();
}
}
}

if($step == "pro"){
		if($cid == $admin){
			if(isset($text)){
	file_put_contents("step/kod.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Beriladigan pul miqdorini kiriting:</b>",
	'parse_mode'=>'html',
	]);
	file_put_contents("step/$cid.step",'Next_Promo');
	exit();
}
}
}

if($step == "Next_Promo"){
		if($cid == $admin){
if(is_numeric($text)=="true"){
	file_put_contents("step/money.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"✅ <b>Promokod muvaffaqiyatli yaratildi!</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$panel,
	]);
$msg = bot('SendMessage',[
	'chat_id'=>$promo,
	'text'=>"💡 <b>Yangi Promokod!</b>

🎫 <i>Promokod:</i> <code>$kod</code>
💵 <i>Promokod qiymati: $text $valyuta</i>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🤖 Botga kirish",'url'=>"https://t.me/$bot"]]
]
])
])->result->message_id;
file_put_contents("step/mid.txt",$msg);
unlink("step/$cid.step");
exit();
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Faqat raqamlardan foydalaning!</b>",
'parse_mode'=>'html',
]);
exit();
}
}
}

if($text == "🎛 Tugmalar"){
if($cid == $admin){
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
		'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📦 Buyurtma berish",'callback_data'=>"key1"]],
[['text'=>"💵 Pul yig'ish",'callback_data'=>"key2"],['text'=>"👔 Kabinet",'callback_data'=>"key3"]],
[['text'=>"📨 Yordam",'callback_data'=>"key4"],['text'=>"🛍 Buyurtmalar",'callback_data'=>"key5"]],
[['text'=>"Yopish",'callback_data'=>"boshqarish"]]
]
])
]);
exit();
}
}

if($data == "key1"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
	'text'=>"<b>Tugma uchun yangi nom yuboring:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$boshqarish
	]);
	file_put_contents("step/$cid2.step",'key1');
	exit();
}

if($step == "key1"){
if($cid == $admin){
if(isset($text)){
	file_put_contents("tugma/key1.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Qabul qilindi!</b>

<i>Tugma nomi</i> <b>$text</b> <i>ga o'zgartirildi.</i>",
'parse_mode'=>'html',
'reply_markup'=>$panel,
  ]);
unlink("step/$cid.step");
exit();
}
}
}

if($data == "key2"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
	'text'=>"<b>Tugma uchun yangi nom yuboring:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$boshqarish
	]);
	file_put_contents("step/$cid2.step",'key2');
	exit();
}

if($step == "key2"){
if($cid == $admin){
if(isset($text)){
	file_put_contents("tugma/key2.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Qabul qilindi!</b>

<i>Tugma nomi</i> <b>$text</b> <i>ga o'zgartirildi.</i>",
'parse_mode'=>'html',
'reply_markup'=>$panel,
  ]);
unlink("step/$cid.step");
exit();
}
}
}

if($data == "key3"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
	'text'=>"<b>Tugma uchun yangi nom yuboring:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$boshqarish
	]);
	file_put_contents("step/$cid2.step",'key3');
	exit();
}

if($step == "key3"){
if($cid == $admin){
if(isset($text)){
	file_put_contents("tugma/key3.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Qabul qilindi!</b>

<i>Tugma nomi</i> <b>$text</b> <i>ga o'zgartirildi.</i>",
'parse_mode'=>'html',
'reply_markup'=>$panel,
  ]);
unlink("step/$cid.step");
exit();
}
}
}

if($data == "key4"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
	'text'=>"<b>Tugma uchun yangi nom yuboring:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$boshqarish
	]);
	file_put_contents("step/$cid2.step",'key4');
	exit();
}

if($step == "key4"){
if($cid == $admin){
if(isset($text)){
	file_put_contents("tugma/key4.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Qabul qilindi!</b>

<i>Tugma nomi</i> <b>$text</b> <i>ga o'zgartirildi.</i>",
'parse_mode'=>'html',
'reply_markup'=>$panel,
  ]);
unlink("step/$cid.step");
exit();
}
}
}

if($data == "key5"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
	'text'=>"<b>Tugma uchun yangi nom yuboring:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$boshqarish
	]);
	file_put_contents("step/$cid2.step",'key5');
	exit();
}

if($step == "key5"){
if($cid == $admin){
if(isset($text)){
	file_put_contents("tugma/key5.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Qabul qilindi!</b>

<i>Tugma nomi</i> <b>$text</b> <i>ga o'zgartirildi.</i>",
'parse_mode'=>'html',
'reply_markup'=>$panel,
  ]);
unlink("step/$cid.step");
exit();
}
}
}

if($text == "⚙ Asosiy sozlamalar"){
	if($cid == $admin){
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>⚙️ Asosiy sozlamalar bo'limiga xush kelibsiz!</b>

<i>Nimani o'zgartiramiz?</i>",
	'parse_mode'=>'html',
	'reply_markup'=>$asosiy,
	]);
	exit();
}
}

if($text == "🔑 API sozlamalari"){
	if($cid == $admin){
	bot('SendMessage',[
	'chat_id'=>$cid,
'text'=>"<b>Hozirgi API manzili:</b>
<code>$api_url</code>
<b>Hozirgi API kalit:</b> 
<code>$api</code>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"API ni yangisiga almashtirish",'callback_data'=>"api"]],
	[['text'=>"Balansni ko'rish",'callback_data'=>"balans"]],
	[['text'=>"Yopish",'callback_data'=>"boshqarish"]]
	]
	])
	]);
	exit();
}
}

if($data == "api1"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
'text'=>"<b>Hozirgi API manzili:</b>
<code>$api_url</code>
<b>Hozirgi API kalit:</b> 
<code>$api</code>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"API ni yangisiga almashtirish",'callback_data'=>"api"]],
	[['text'=>"Balansni ko'rish",'callback_data'=>"balans"]],
	[['text'=>"Yopish",'callback_data'=>"boshqarish"]]
	]
	])
	]);
	exit();
}

if($data == "api"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
	'text'=>"<b>API manzilini yuboring:
Namuna:</b> <pre>https://uzgram.ru/api/v1</pre>",
	'parse_mode'=>'html',
	'reply_markup'=>$boshqarish,
	]);
	file_put_contents("step/$cid2.step",'api_url');
	exit();
}

if($step == "api_url"){
	if($cid == $admin){
   if(mb_stripos($text, "https://")!==false){
	if(isset($text)){
	file_put_contents("tizim/api_url.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"$text <b>qabul qilindi!</b>
	
	Endi esa ushbu saytdan olingan API'ni kiriting:",
'disable_web_page_preview'=>true,
	'parse_mode'=>'html',
	]);
	file_put_contents("step/$cid.step",'api');
	exit();
}
}else{
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>API manzilini yuboring:
Namuna:</b> <pre>https://uzgram.ru/api/v1</pre>",
	'parse_mode'=>'html',
]);
exit();
}
}
}

if($step == "api"){
	if($cid == $admin){
	if(isset($text)){
	file_put_contents("tizim/api.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>API qabul qilindi!</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$asosiy,
	]);
	unlink("step/$cid.step");
	exit();
}
}
}


if($data == "balans"){
if($api == null){
bot('answerCallbackQuery',[
'callback_query_id'=>$qid,
'text'=>"API mavjud emas!",
'show_alert'=>true,
]);
}else{
$balans = json_decode(file_get_contents("$api_url?key=$api&action=balance"),true);
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>Kuting...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>Kuting...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
       'text'=>"<b>💵 API balansi:</b> ".$balans['balance']." $valyuta",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"api1"]],
]
])
]);
}
}

$delturi = file_get_contents("tizim/turi.txt");
$delmore = explode("\n",$delturi);
$delsoni = substr_count($delturi,"\n");
$key=[];
for ($delfor = 1; $delfor <= $delsoni; $delfor++) {
$title=str_replace("\n","",$delmore[$delfor]);
$key[]=["text"=>"$title - ni o'chirish","callback_data"=>"del-$title"];
$keyboard2 = array_chunk($key, 1);
$keyboard2[] = [['text'=>"➕ Yangi to'lov tizimi qo'shish",'callback_data'=>"new"]];
$pay = json_encode([
'inline_keyboard'=>$keyboard2,
]);
}

if($text == "💳 Hamyonlar"){
	if($cid == $admin){
if($turi == null){
bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
		'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Yangi to'lov tizimi qo'shish",'callback_data'=>"new"]],
]
])
]);
exit();
}else{
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
		'reply_markup'=>$pay
]);
exit();
}
}
}

if($data == "hamyon"){
if($turi == null){
bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
bot('SendMessage',[
	'chat_id'=>$cid2,
	'text'=>"<b>Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
		'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Yangi to'lov tizimi qo'shish",'callback_data'=>"new"]],
]
])
]);
exit();
}else{
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
bot('SendMessage',[
	'chat_id'=>$cid2,
	'text'=>"<b>Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
		'reply_markup'=>$pay
]);
exit();
}
}

if(mb_stripos($data,"del-")!==false){
	$ex = explode("-",$data);
	$tur = $ex[1];
	$k = str_replace("\n".$tur."","",$turi);
   file_put_contents("tizim/turi.txt",$k);
$a = $WalletMin - 1;
file_put_contents("tizim/WalletMin.txt",$a);
	bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>Kuting...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>Kuting...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"$tur - <b>To'lov tizimi olib tashlandi.</b>",
		'parse_mode'=>'html',
	'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"hamyon"]],
]
])
	]);
	deleteFolder("tizim/$tur");
}

	/*$test = file_get_contents("step/test.txt");
   $k = str_replace("\n".$test."","",$turi);
   file_put_contents("tizim/turi.txt",$k);
deleteFolder("tizim/$test");
unlink("step/test.txt");
exit();*/

if($data == "new"){
if($WalletMin != $WalletMax){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
   ]);
   bot('sendMessage',[
   'chat_id'=>$cid2,
   'text'=>"<b>Yangi to'lov tizimi nomini yuboring:</b>",
   'parse_mode'=>'html',
   'reply_markup'=>$boshqarish
	]);
	file_put_contents("step/$cid2.step",'turi');
	exit();
}else{
	bot('answerCallbackQuery',[
	'callback_query_id'=>$qid,
	'text'=>"Limitga yetib kelgansiz!",
	'show_alert'=>true,
	]);
}
}


if($step == "turi"){
	if($cid == $admin){
	if(isset($text)){
		mkdir("tizim/$text");
file_put_contents("tizim/turi.txt","$turi\n$text");
	file_put_contents("step/test.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Ushbu to'lov tizimidagi hamyoningiz raqamini yuboring:</b>",
	'parse_mode'=>'html',
	]);
	file_put_contents("step/$cid.step",'wallet');
	exit();
}
}
}


if($step == "wallet"){
	if($cid == $admin){
	    if(is_numeric($text)=="true"){
file_put_contents("tizim/$test/wallet.txt","$wallet\n$text");
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Ushbu to'lov tizimi orqali hisobni to'ldirish bo'yicha ma'lumotni yuboring:</b>

<i>Misol uchun, Ushbu to'lov tizimi orqali pul yuborish jarayonida izoh kirita olmasligingiz mumkin. Ushbu holatda, biz bilan bog'laning. Havola: @AlijonovUz</i>",
'parse_mode'=>'html',
	]);
	file_put_contents("step/$cid.step",'addition');
	exit();
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Faqat raqamlardan foydalaning!</b>",
'parse_mode'=>'html',
]);
exit();
}
}
}

if($step == "addition"){
	if($cid == $admin){
	if(isset($text)){
file_put_contents("tizim/$test/addition.txt","$addition\n$text");
$a = $WalletMin + 1;
file_put_contents("tizim/WalletMin.txt",$a);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Yangi to'lov tizimi qo'shildi!</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$asosiy,
	]);
	unlink("step/$cid.step");
	unlink("step/test.txt");
	exit();
}
}
}

if($text == "🛍 Buyurtmalarni sozlash"){
	if($cid == $admin){
		bot('SendMessage',[
		'chat_id'=>$cid,
		'text'=>"<b>Quyidagilardan birini tanlang:</b>",
		'parse_mode'=>'html',
		'reply_markup'=>json_encode([
		'inline_keyboard'=>[
		[['text'=>"📂 Bo'limlarni sozlash",'callback_data'=>"bolim"]],
		[['text'=>"📂 Ichki bo'limlarni sozlash",'callback_data'=>"ichki"]],
		[['text'=>"🛍 Xizmatlarni sozlash",'callback_data'=>"xizmat"]]
]
])
]);
exit();
}
}

if($data == "buy"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
]);
   bot('sendMessage',[
   'chat_id'=>$cid2,
	'text'=>"<b>Quyidagilardan birini tanlang:</b>",
		'parse_mode'=>'html',
		'reply_markup'=>json_encode([
		'inline_keyboard'=>[
		[['text'=>"📂 Bo'limlarni sozlash",'callback_data'=>"bolim"]],
		[['text'=>"📂 Ichki bo'limlarni sozlash",'callback_data'=>"ichki"]],
		[['text'=>"🛍 Xizmatlarni sozlash",'callback_data'=>"xizmat"]]
]
])
]);
exit();
}

if($data == "bolim"){
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
       'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"Yangi bo'lim qo'shish",'callback_data'=>"newFol"]],
[['text'=>"Tahrirlash",'callback_data'=>"editFol"]],
[['text'=>"O'chirish",'callback_data'=>"delFol"]],
]
])
]);
}

if($data == "ichki"){
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
       'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"Yangi ichki bo'lim qo'shish",'callback_data'=>"newFold"]],
[['text'=>"Tahrirlash",'callback_data'=>"editFold"]],
[['text'=>"O'chirish",'callback_data'=>"delFold"]],
]
])
]);
}

if($data == "xizmat"){
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
       'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"Yangi xizmat qo'shish",'callback_data'=>"newXiz"]],
[['text'=>"Tahrirlash",'callback_data'=>"editXiz"]],
[['text'=>"O'chirish",'callback_data'=>"delXiz"]],
]
])
]);
}

if($data == "editFol"){
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
       'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"Nomini o'zgartirish",'callback_data'=>"editFols"]],
[['text'=>"Orqaga",'callback_data'=>"buy"]]
]
])
]);
}

if($data == "editFold"){
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
       'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"Nomini o'zgartirish",'callback_data'=>"editFolds"]],
[['text'=>"Orqaga",'callback_data'=>"buy"]]
]
])
]);
}

if($data == "editXiz"){
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
       'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"Nomini o'zgartirish",'callback_data'=>"editNomi"]],
[['text'=>"Servis IDni o'zgartirish",'callback_data'=>"editXizmat-id"]],
[['text'=>"Narxini o'zgartirish",'callback_data'=>"editXizmat-narxi"]],
[['text'=>"Tavsifni o'zgartirish",'callback_data'=>"editXizmat-tavsif"]],
[['text'=>"Min. miqdorni o'zgartirish",'callback_data'=>"editXizmat-min"]],
[['text'=>"Maks. miqdorni o'zgartirish",'callback_data'=>"editXizmat-max"]],
[['text'=>"Orqaga",'callback_data'=>"buy"]]
]
])
]);
}

//edit
$bolim = file_get_contents("nakrutka/bolim.txt");
$more = explode("\n",$bolim);
$soni = substr_count($bolim,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$title = str_replace("\n","",$more[$for]);
$key[]=["text"=>"$title","callback_data"=>"editFolss-$title"];
$keyboard2 = array_chunk($key, 1);
$keyboard2[] = [['text'=>"Orqaga",'callback_data'=>"buy"]];
$editFol = json_encode([
'inline_keyboard'=>$keyboard2,
]);
}

if($data == "editFols"){
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
       'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$editFol
]);
}


if(mb_stripos($data, "editFolss-")!==false){
	$ex = explode("-",$data)[1];
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
]);
   bot('sendMessage',[
   'chat_id'=>$cid2,
   'text'=>"<b>Yangi qiymatni kiriting:</b>",
   'parse_mode'=>'html',
   'reply_markup'=>$boshqarish
]);
file_put_contents("step/$cid2.step","editFol-$ex");
exit();
}

if(mb_stripos($step, "editFol-")!==false){
	$ex = explode("-",$step)[1];
	if($cid == $admin){
		if(isset($text)){
		$bolim = file_get_contents("nakrutka/bolim.txt");
		$str = str_replace($ex,$text,$bolim);
      file_put_contents("nakrutka/bolim.txt",$str);
      rename("nakrutka/$ex","nakrutka/$text");
		bot('SendMessage',[
		'chat_id'=>$cid,
		'text'=>"<b>Muvaffaqiyatli o'zgartirildi.</b>",
		'parse_mode'=>'html',
		'reply_markup'=>$asosiy
]);
unlink("step/$cid.step");
exit();
}
}
}

$bolim = file_get_contents("nakrutka/bolim.txt");
$more = explode("\n",$bolim);
$soni = substr_count($bolim,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$title = str_replace("\n","",$more[$for]);
$key[]=["text"=>"$title","callback_data"=>"editFolds-$title"];
$keyboard2 = array_chunk($key, 1);
$keyboard2[] = [['text'=>"Orqaga",'callback_data'=>"buy"]];
$editFold = json_encode([
'inline_keyboard'=>$keyboard2,
]);
}

if($data == "editFolds"){
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
       'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$editFold
]);
}

if(mb_stripos($data, "editFolds-")!==false){
$bolim = explode("-",$data)[1];
$ichki = file_get_contents("nakrutka/$bolim/ichki.txt");
$more = explode("\n",$ichki);
$soni = substr_count($ichki,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$title = str_replace("\n","",$more[$for]);
$key[]=["text"=>"$title","callback_data"=>"editFoldm-$title-$bolim"];
$keyboard2 = array_chunk($key, 1);
$keyboard2[] = [['text'=>"Orqaga",'callback_data'=>"buy"]];
$editFolds = json_encode([
'inline_keyboard'=>$keyboard2,
]);
}
if($ichki == null){
	bot('answerCallbackQuery',[
		'callback_query_id'=>$qid,
		'text'=>"Hech narsa topilmadi!",
		'show_alert'=>true,
		]);
	}else{
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
       'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$editFolds
]);
}
}

if(mb_stripos($data, "editFoldm-")!==false){
	$ex = explode("-",$data)[1];
	$bolim = explode("-",$data)[2];
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
]);
   bot('sendMessage',[
   'chat_id'=>$cid2,
   'text'=>"<b>Yangi qiymatni kiriting:</b>",
   'parse_mode'=>'html',
   'reply_markup'=>$boshqarish
]);
file_put_contents("step/$cid2.step","editFoldms-$ex-$bolim");
exit();
}

if(mb_stripos($step, "editFoldms-")!==false){
	$ex = explode("-",$step)[1];
	$bolim = explode("-",$step)[2];
	if($cid == $admin){
		if(isset($text)){
		$ichki = file_get_contents("nakrutka/$bolim/ichki.txt");
		$str = str_replace($ex,$text,$ichki);
      file_put_contents("nakrutka/$bolim/ichki.txt",$str);
      rename("nakrutka/$bolim/$ex","nakrutka/$bolim/$text");
		bot('SendMessage',[
		'chat_id'=>$cid,
		'text'=>"<b>Muvaffaqiyatli o'zgartirildi.</b>",
		'parse_mode'=>'html',
		'reply_markup'=>$asosiy
]);
unlink("step/$cid.step");
exit();
}
}
}

$bolim = file_get_contents("nakrutka/bolim.txt");
$more = explode("\n",$bolim);
$soni = substr_count($bolim,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$title = str_replace("\n","",$more[$for]);
$key[]=["text"=>"$title","callback_data"=>"editNoms-$title"];
$keyboard2 = array_chunk($key, 1);
$keyboard2[] = [['text'=>"Orqaga",'callback_data'=>"buy"]];
$editNom = json_encode([
'inline_keyboard'=>$keyboard2,
]);
}

if($data == "editNomi"){
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
       'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$editNom
]);
}

if(mb_stripos($data, "editNoms-")!==false){
$bolim = explode("-",$data)[1];
file_put_contents("step/$cid2.txt","$bolim");
$ichki = file_get_contents("nakrutka/$bolim/ichki.txt");
$more = explode("\n",$ichki);
$soni = substr_count($ichki,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$title = str_replace("\n","",$more[$for]);
$key[]=["text"=>"$title","callback_data"=>"editx-$title"];
$keyboard2 = array_chunk($key, 1);
$keyboard2[] = [['text'=>"Orqaga",'callback_data'=>"buy"]];
$editNomi = json_encode([
'inline_keyboard'=>$keyboard2,
]);
}
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
       'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$editNomi
]);
}

if(mb_stripos($data, "editx-")!==false){
$ichki = explode("-",$data)[1];        
$bolim = file_get_contents("step/$cid2.txt");
$xizmat = file_get_contents("nakrutka/$bolim/$ichki/xizmat.txt");
if($xizmat == null){
	bot('answerCallbackQuery',[
		'callback_query_id'=>$qid,
		'text'=>"Hech narsa topilmadi!",
		'show_alert'=>true,
		]);
	}else{
$more = explode("\n",$xizmat);
$soni = substr_count($xizmat,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$title = str_replace("\n","",$more[$for]);
$key[]=["text"=>"$title","callback_data"=>"editNomlari-$title"];
file_put_contents("step/$cid2.txt","test-$bolim-$ichki");
$keyboard2 = array_chunk($key, 1);
$keyboard2[] = [['text'=>"Orqaga",'callback_data'=>"buy"]];
$editNomlari = json_encode([
'inline_keyboard'=>$keyboard2,
]);
}
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
    'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$editNomlari
]);
}
}

if(mb_stripos($data, "editNomlari-")!==false){
$test = file_get_contents("step/$cid2.txt");
	$xiz = explode("-",$data)[1];
	$bolim = explode("-",$test)[1];        
        $ichki = explode("-",$test)[2];        
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
]);
   bot('sendMessage',[
   'chat_id'=>$cid2,
   'text'=>"<b>Yangi qiymatni kiriting:</b>",
   'parse_mode'=>'html',
   'reply_markup'=>$boshqarish
]);
file_put_contents("step/$cid2.step","editNomi-$xiz-$bolim-$ichki");
exit();
}

if(mb_stripos($step, "editNomi-")!==false){
	$xiz = explode("-",$step)[1];
	$bolim = explode("-",$step)[2];
	$ichki = explode("-",$step)[3];
	if($cid == $admin){
		if(isset($text)){
		$xizmat = file_get_contents("nakrutka/$bolim/$ichki/xizmat.txt");
		$str = str_replace($xiz,$text,$xizmat);
      file_put_contents("nakrutka/$bolim/$ichki/xizmat.txt",$str);
      rename("nakrutka/$bolim/$ichki/$xiz","nakrutka/$bolim/$ichki/$text");
		bot('SendMessage',[
		'chat_id'=>$cid,
		'text'=>"<b>Muvaffaqiyatli o'zgartirildi.</b>",
		'parse_mode'=>'html',
		'reply_markup'=>$asosiy
]);
unlink("step/$cid.step");
unlink("step/$cid.txt");
exit();
}
}
}


if(mb_stripos($data, "editXizmat-")!==false){
$nomi = explode("-",$data)[1];
file_put_contents("step/$cid2.txt",$nomi);
$bolim = file_get_contents("nakrutka/bolim.txt");
$more = explode("\n",$bolim);
$soni = substr_count($bolim,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$title = str_replace("\n","",$more[$for]);
$key[]=["text"=>"$title","callback_data"=>"editXizmats-$title"];
$keyboard2 = array_chunk($key, 1);
$keyboard2[] = [['text'=>"Orqaga",'callback_data'=>"buy"]];
$editXizmat = json_encode([
'inline_keyboard'=>$keyboard2,
]);
}
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
       'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$editXizmat
]);
}

if(mb_stripos($data, "editXizmats-")!==false){
$bolim = explode("-",$data)[1];
$ichki = file_get_contents("nakrutka/$bolim/ichki.txt");
$more = explode("\n",$ichki);
$soni = substr_count($ichki,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$title = str_replace("\n","",$more[$for]);
$key[]=["text"=>"$title","callback_data"=>"editXt-$title-$bolim"];
$keyboard2 = array_chunk($key, 1);
$keyboard2[] = [['text'=>"Orqaga",'callback_data'=>"buy"]];
$editXizmat = json_encode([
'inline_keyboard'=>$keyboard2,
]);
}
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
       'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$editXizmat
]);
}

if(mb_stripos($data, "editXt-")!==false){
        $ichki = explode("-",$data)[1];
        $bolim = explode("-",$data)[2];
$xizmat = file_get_contents("nakrutka/$bolim/$ichki/xizmat.txt");
if($xizmat == null){
	bot('answerCallbackQuery',[
		'callback_query_id'=>$qid,
		'text'=>"Hech narsa topilmadi!",
		'show_alert'=>true,
		]);
	}else{
$more = explode("\n",$xizmat);
$soni = substr_count($xizmat,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$title = str_replace("\n","",$more[$for]);
$key[]=["text"=>"$title","callback_data"=>"editXts-$title-$ichki-$bolim"];
$keyboard2 = array_chunk($key, 1);
$keyboard2[] = [['text'=>"Orqaga",'callback_data'=>"buy"]];
$editX = json_encode([
'inline_keyboard'=>$keyboard2,
]);
}
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
    'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$editX
]);
}
}

if(mb_stripos($data, "editXts-")!==false){
	$xiz = explode("-",$data)[1];
	$ichki = explode("-",$data)[2];
	$bolim = explode("-",$data)[3];
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
]);
   bot('sendMessage',[
   'chat_id'=>$cid2,
   'text'=>"<b>Yangi qiymatni kiriting:</b>",
   'parse_mode'=>'html',
   'reply_markup'=>$boshqarish
]);
file_put_contents("step/$cid2.step","editXizmatlar-$xiz-$bolim-$ichki");
exit();
}

if(mb_stripos($step, "editXizmatlar-")!==false){
	$xiz = explode("-",$step)[1];
	$bolim = explode("-",$step)[2];
	$ichki = explode("-",$step)[3];
	$ex = file_get_contents("step/$cid.txt");
	if($cid == $admin){
		if(isset($text)){
      file_put_contents("nakrutka/$bolim/$ichki/$xiz/$ex.txt",$text);
		bot('SendMessage',[
		'chat_id'=>$cid,
		'text'=>"<b>Muvaffaqiyatli o'zgartirildi.</b>",
		'parse_mode'=>'html',
		'reply_markup'=>$asosiy
]);
unlink("step/$cid.step");
unlink("step/$cid.txt");
exit();
}
}
}

//del
$bolim = file_get_contents("nakrutka/bolim.txt");
$more = explode("\n",$bolim);
$soni = substr_count($bolim,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$title = str_replace("\n","",$more[$for]);
$key[]=["text"=>"$title","callback_data"=>"delFols-$title"];
$keyboard2 = array_chunk($key, 1);
$keyboard2[] = [['text'=>"Orqaga",'callback_data'=>"buy"]];
$delFol = json_encode([
'inline_keyboard'=>$keyboard2,
]);
}

if($data == "delFol"){
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
        'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$delFol
]);
}

if(mb_stripos($data, "delFols-")!==false){
	$ex = explode("-",$data)[1];
   $k = str_replace("\n".$ex."","",$bolim);
   file_put_contents("nakrutka/bolim.txt",$k);
   deleteFolder("nakrutka/$ex");
     bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
]);
   bot('sendMessage',[
   'chat_id'=>$cid2,
       'text'=>"<b>$ex</b> - bo'lim olib tashlandi!",
'parse_mode'=>'html',
'reply_markup'=>$asosiy
]);
exit();
}

$bolim = file_get_contents("nakrutka/bolim.txt");
$more = explode("\n",$bolim);
$soni = substr_count($bolim,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$title = str_replace("\n","",$more[$for]);
$key[]=["text"=>"$title","callback_data"=>"delFolds-$title"];
$keyboard2 = array_chunk($key, 1);
$keyboard2[] = [['text'=>"Orqaga",'callback_data'=>"buy"]];
$delFold = json_encode([
'inline_keyboard'=>$keyboard2,
]);
}

if($data == "delFold"){
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
       'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$delFold
]);
}

if(mb_stripos($data, "delFolds-")!==false){
	$bolim = explode("-",$data)[1];
$ichki = file_get_contents("nakrutka/$bolim/ichki.txt");
$more = explode("\n",$ichki);
$soni = substr_count($ichki,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$title = str_replace("\n","",$more[$for]);
$key[]=["text"=>"$title","callback_data"=>"delFolm-$title-$bolim"];
$keyboard2 = array_chunk($key, 1);
$keyboard2[] = [['text'=>"Orqaga",'callback_data'=>"buy"]];
$delFolds = json_encode([
'inline_keyboard'=>$keyboard2,
]);
}
if($ichki == null){
	bot('answerCallbackQuery',[
		'callback_query_id'=>$qid,
		'text'=>"⚠️ Ushbu bo'lim uchun xizmat turlari topilmadi!",
		'show_alert'=>true,
		]);
	}else{
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
     'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$delFolds
]);
}
}

if(mb_stripos($data, "delFolm-")!==false){
	$ex = explode("-",$data)[1];
	$bolim = explode("-",$data)[2];
	$del = file_get_contents("nakrutka/$bolim/ichki.txt");
   $k = str_replace("\n".$ex."","",$del);
   file_put_contents("nakrutka/$bolim/ichki.txt",$k);
   deleteFolder("nakrutka/$bolim/$ex");
     bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
]);
   bot('sendMessage',[
   'chat_id'=>$cid2,
       'text'=>"<b>$ex</b> - ichki bo'lim olib tashlandi!",
'parse_mode'=>'html',
'reply_markup'=>$asosiy
]);
exit();
}

$bolim = file_get_contents("nakrutka/bolim.txt");
$more = explode("\n",$bolim);
$soni = substr_count($bolim,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$title = str_replace("\n","",$more[$for]);
$key[]=["text"=>"$title","callback_data"=>"deleteXiz-$title"];
$keyboard2 = array_chunk($key, 1);
$keyboard2[] = [['text'=>"Orqaga",'callback_data'=>"buy"]];
$delXiz = json_encode([
'inline_keyboard'=>$keyboard2,
]);
}

if($data == "delXiz"){
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
       'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$delXiz
]);
}

if(mb_stripos($data, "deleteXiz-")!==false){
	$bolim = explode("-",$data)[1];
$ichki = file_get_contents("nakrutka/$bolim/ichki.txt");
$more = explode("\n",$ichki);
$soni = substr_count($ichki,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$title = str_replace("\n","",$more[$for]);
$key[]=["text"=>"$title","callback_data"=>"delx-$title-$bolim"];
$keyboard2 = array_chunk($key, 1);
$keyboard2[] = [['text'=>"Orqaga",'callback_data'=>"buy"]];
$delXizs = json_encode([
'inline_keyboard'=>$keyboard2,
]);
}
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
       'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$delXizs
]);
}

if(mb_stripos($data, "delx-")!==false){
	$ichki = explode("-",$data)[1];
	$bolim = explode("-",$data)[2];
$xizmat = file_get_contents("nakrutka/$bolim/$ichki/xizmat.txt");
if($xizmat == null){
	bot('answerCallbackQuery',[
		'callback_query_id'=>$qid,
		'text'=>"⚠️ Ushbu bo'lim uchun xizmat turlari topilmadi!",
		'show_alert'=>true,
		]);
	}else{
$more = explode("\n",$xizmat);
$soni = substr_count($xizmat,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$title = str_replace("\n","",$more[$for]);
$key[]=["text"=>"$title","callback_data"=>"delmat-$title-$ichki-$bolim"];
$keyboard2 = array_chunk($key, 1);
$keyboard2[] = [['text'=>"Orqaga",'callback_data'=>"buy"]];
$delsXiz = json_encode([
'inline_keyboard'=>$keyboard2,
]);
}
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
    'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$delsXiz
]);
}
}

if(mb_stripos($data, "delmat-")!==false){
	$ex = explode("-",$data)[1];
	$ichki = explode("-",$data)[2];
	$bolim = explode("-",$data)[3];
	$del = file_get_contents("nakrutka/$bolim/$ichki/xizmat.txt");
   $k = str_replace("\n".$ex."","",$del);
   file_put_contents("nakrutka/$bolim/$ichki/xizmat.txt",$k);
   deleteFolder("nakrutka/$bolim/$ichki/$ex");
     bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
]);
   bot('sendMessage',[
   'chat_id'=>$cid2,
       'text'=>"<b>$ex</b> - xizmati olib tashlandi!",
'parse_mode'=>'html',
'reply_markup'=>$asosiy
]);
exit();
}


//new
if($data == "newFol"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
]);
   bot('sendMessage',[
   'chat_id'=>$cid2,
   'text'=>"<b>Yangi bo'lim nomini yuboring:</b>",
   'parse_mode'=>'html',
   'reply_markup'=>$boshqarish
]);
file_put_contents("step/$cid2.step",'newFol');
exit();
}

if($step == "newFol"){
if($cid == $admin){
		if(isset($text)){
			mkdir("nakrutka/$text");
			file_put_contents("nakrutka/bolim.txt","$bolim\n$text");
		bot('SendMessage',[
		'chat_id'=>$cid,
		'text'=>"<b>$text</b> nomli bo'lim qo'shildi!",
		'parse_mode'=>'html',
		'reply_markup'=>$asosiy
]);
unlink("step/$cid.step");
exit();
}
}
}

$bolim = file_get_contents("nakrutka/bolim.txt");
$more = explode("\n",$bolim);
$soni = substr_count($bolim,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$title = str_replace("\n","",$more[$for]);
$key[]=["text"=>"$title","callback_data"=>"adFol-$title"];
$keyboard2 = array_chunk($key, 1);
$keyboard2[] = [['text'=>"Orqaga",'callback_data'=>"buy"]];
$adFol = json_encode([
'inline_keyboard'=>$keyboard2,
]);
}

if($data == "newFold"){
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
       'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$adFol
]);
}


if(mb_stripos($data, "adFol-")!==false){
	$ex = explode("-",$data)[1];
	file_put_contents("step/test.txt",$ex);
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
]);
   bot('sendMessage',[
   'chat_id'=>$cid2,
   'text'=>"<b>Yangi ichki bo'lim nomini yuboring:</b>",
   'parse_mode'=>'html',
   'reply_markup'=>$boshqarish
]);
file_put_contents("step/$cid2.step",'newFold');
exit();
}

if($step == "newFold"){
if($cid == $admin){
		if(isset($text)){
			mkdir("nakrutka/$test/$text");
			file_put_contents("nakrutka/$test/ichki.txt","$ichki\n$text");
		bot('SendMessage',[
		'chat_id'=>$cid,
		'text'=>"<b>$text</b> nomli ichki bo'lim qo'shildi!",
		'parse_mode'=>'html',
		'reply_markup'=>$asosiy
]);
unlink("step/$cid.step");
exit();
}
}
}

$bolim = file_get_contents("nakrutka/bolim.txt");
$more = explode("\n",$bolim);
$soni = substr_count($bolim,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$title = str_replace("\n","",$more[$for]);
$key[]=["text"=>"$title","callback_data"=>"add-$title"];
$keyboard2 = array_chunk($key, 1);
$keyboard2[] = [['text'=>"Orqaga",'callback_data'=>"buy"]];
$adds = json_encode([
'inline_keyboard'=>$keyboard2,
]);
}


if($data == "newXiz"){
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
       'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$adds,
]);
}

if(mb_stripos($data, "add-")!==false){
	$ex = explode("-",$data)[1];
   file_put_contents("step/test.txt",$ex);
$ichki = file_get_contents("nakrutka/$ex/ichki.txt");
$more = explode("\n",$ichki);
$soni = substr_count($ichki,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$title = str_replace("\n","",$more[$for]);
$key[]=["text"=>"$title","callback_data"=>"adds-$title"];
$keyboard2 = array_chunk($key, 1);
$keyboard2[] = [['text'=>"Orqaga",'callback_data'=>"buy"]];
$addz = json_encode([
'inline_keyboard'=>$keyboard2,
]);
}
	bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
'text'=>"<b>Quyidagilardan birini tanlang:</b>",
   'parse_mode'=>'html',
   'reply_markup'=>$addz
]);
}

if(mb_stripos($data, "adds-")!==false){
   $ex = explode("-",$data)[1];
   file_put_contents("step/test1.txt",$ex);
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
]);
   bot('sendMessage',[
   'chat_id'=>$cid2,
   'text'=>"<b>Yangi xizmat nomini yuboring:</b>",
   'parse_mode'=>'html',
   'reply_markup'=>$boshqarish
]);
file_put_contents("step/$cid2.step",'ServisID');
exit();
}

if($step == "ServisID"){
	if($cid == $admin){
		if(isset($text)){
			if($api != null){
			mkdir("nakrutka/$test/$test1/$text");
			file_put_contents("nakrutka/$test/$test1/xizmat.txt","$xizmat\n$text");
			file_put_contents("step/test2.txt",$text);
		bot('SendMessage',[
		'chat_id'=>$cid,
		'text'=>"<b>$text</b> qabul qilindi. Endi esa, ushbu xizmatning Servis ID sini kiriting:",
		'parse_mode'=>'html',		
]);
file_put_contents("step/$cid.step",'1ta');
exit();
}else{
	bot('SendMessage',[
		'chat_id'=>$cid,
		'text'=>"<b>API topilmadi!</b>

Avval botning API sini sozlab oling!",
		'parse_mode'=>'html',		
]);
exit();
}
}
}
}
if($step == "1ta"){
if($cid == $admin){
		if(isset($text)){
		if(is_numeric($text)==true){
			file_put_contents("nakrutka/$test/$test1/$test2/id.txt",$text);
		bot('SendMessage',[
		'chat_id'=>$cid,
		'text'=>"<b>$text</b> qabul qilindi.

Ushbu xizmat doirasida 1 ta foydalanuvchi narxini kiriting:",
		'parse_mode'=>'html',	
]);
file_put_contents("step/$cid.step",'minimal');
exit();
}else{
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Faqat raqamlardan foydalaning!</b>",
	'parse_mode'=>'html',
]);
exit();
}
}
}
}

if($step == "minimal"){
if($cid == $admin){
		if(isset($text)){
		if(is_numeric($text)==true){
			file_put_contents("nakrutka/$test/$test1/$test2/narxi.txt",$text);
		bot('SendMessage',[
		'chat_id'=>$cid,
		'text'=>"<b>$text</b> qabul qilindi.

Ushbu xizmat doirasida minimal buyurtma miqdorini kiriting:",
		'parse_mode'=>'html',
]);
file_put_contents("step/$cid.step",'maksimal');
exit();
}else{
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Faqat raqamlardan foydalaning!</b>",
	'parse_mode'=>'html',
]);
exit();
}
}
}
}

if($step == "maksimal"){
if($cid == $admin){
		if(isset($text)){
		if(is_numeric($text)==true){
			file_put_contents("nakrutka/$test/$test1/$test2/min.txt",$text);
		bot('SendMessage',[
		'chat_id'=>$cid,
		'text'=>"<b>$text</b> qabul qilindi.

Ushbu xizmat doirasida maksimal buyurtma miqdorini kiriting:",
		'parse_mode'=>'html',
]);
file_put_contents("step/$cid.step",'tavsif');
exit();
}else{
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Faqat raqamlardan foydalaning!</b>",
	'parse_mode'=>'html',
]);
exit();
}
}
}
}

if($step == "tavsif"){
if($cid == $admin){
		if(isset($text)){
		if(is_numeric($text)==true){
			file_put_contents("nakrutka/$test/$test1/$test2/max.txt",$text);
		bot('SendMessage',[
		'chat_id'=>$cid,
		'text'=>"<b>$text</b> qabul qilindi.

Ushbu xizmat haqida ma'lumot kiriting:",
		'parse_mode'=>'html',
]);
file_put_contents("step/$cid.step","add-bo'lim");
exit();
}else{
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Faqat raqamlardan foydalaning!</b>",
	'parse_mode'=>'html',
]);
exit();
}
}
}
}

if($step == "add-bo'lim"){
if($cid == $admin){
		if(isset($text)){
			file_put_contents("nakrutka/$test/$test1/$test2/tavsif.txt",$text);
		bot('SendMessage',[
		'chat_id'=>$cid,
	   'text'=>"<b>Yangi xizmat muvaffaqiyatli qo'shildi!</b>",
   'parse_mode'=>'html',
   'reply_markup'=>$asosiy
]);
unlink("step/$cid.step");
exit();
}
}
}

if($text == "*️⃣ Birlamchi sozlamalar"){
	if($cid == $admin){
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>*️⃣  Birlamchi sozlamalar bo'limidasiz.</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📋 Hozirgi holatni ko'rish",'callback_data'=>"holat"]],
[['text'=>"💶 Valyuta",'callback_data'=>"valyuta"],['text'=>"💸 Taklif narxi",'callback_data'=>"narx"]],
[['text'=>"📎 Admin useri",'callback_data'=>"admin"],['text'=>"Yopish",'callback_data'=>"boshqarish"]]
]
])
]);
exit();
}
}

if($data == "birlamchi"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
	'text'=>"<b>*️⃣  Birlamchi sozlamalar bo'limidasiz.</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📋 Hozirgi holatni ko'rish",'callback_data'=>"holat"]],
[['text'=>"💶 Valyuta",'callback_data'=>"valyuta"],['text'=>"💸 Taklif narxi",'callback_data'=>"narx"]],
[['text'=>"📎 Admin useri",'callback_data'=>"admin"],['text'=>"Yopish",'callback_data'=>"boshqarish"]]
]
])
]);
exit();
}

if($data == "holat"){
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>Kuting...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>Kuting...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
       'text'=>"<b>Hozirgi birlamchi sozlamalar:</b>

<i>1. Valyuta - $valyuta
2. Taklif narxi - $referal $valyuta
3. Admin useri: $user</i>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"birlamchi"]],
]
])
]);
}

if($data == "valyuta"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
   'text'=>"📝 <b>Yangi qiymatni yuboring:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$boshqarish,
	]);
	file_put_contents("step/$cid2.step",'valyuta');
	exit();
}

if($step == "valyuta"){
	if($cid == $admin){
	if(isset($text)){
	file_put_contents("tizim/valyuta.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$asosiy,
	]);
	unlink("step/$cid.step");
	exit();
}
}
}

if($data == "narx"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
'text'=>"📝 <b>Yangi qiymatni yuboring:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$boshqarish,
	]);
	file_put_contents("step/$cid2.step",'taklif');
	exit();
}

if($step == "taklif"){
	if($cid == $admin){
	if(isset($text)){
	file_put_contents("tizim/referal.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$asosiy,
	]);
	unlink("step/$cid.step");
	exit();
}
}
}

if($data == "admin"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
'text'=>"📝 <b>Yangi qiymatni yuboring:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$boshqarish,
	]);
	file_put_contents("step/$cid2.step",'admin');
	exit();
}

if($step == "admin"){
	if($cid == $admin){
	if(isset($text)){
        file_put_contents("tizim/user.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$asosiy,
	]);
	unlink("step/$cid.step");
	exit();
}
}
}


if($text == "📢 Kanallar"){
if($cid == $admin){
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"🔐 Majburiy obunalar",'callback_data'=>"majburiy"]],
[['text'=>"*⃣ Qo'shimcha kanallar",'callback_data'=>"qoshimcha"]],
[['text'=>"Yopish",'callback_data'=>"boshqarish"]]
]
])
]);
exit();
}
}

if($data == "kanallar"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
	'text'=>"<b>Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"🔐 Majburiy obunalar",'callback_data'=>"majburiy"]],
[['text'=>"*⃣ Qo'shimcha kanallar",'callback_data'=>"qoshimcha"]],
[['text'=>"Yopish",'callback_data'=>"boshqarish"]]
]
])
]);
exit();
}

if($data == "majburiy"){
	bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>Kuting...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>Kuting...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
'text'=>"<b>Majburiy obunalarni sozlash bo'limidasiz:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Qo'shish",'callback_data'=>"qoshish"]],
[['text'=>"📑 Ro'yxat",'callback_data'=>"royxat"],['text'=>"🗑 O'chirish",'callback_data'=>"ochirish"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"kanallar"]]
]
])
]);
}

if($data == "qoshish"){
if($KanalMin != $KanalMax){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
	'text'=>"<b>Kanalingiz userini kiriting:

Namuna:</b> RixBuilder-RixBuilder
( Kanal nomi-Kanal_useri )",
'parse_mode'=>'html',
	'reply_markup'=>$boshqarish,
	]);
	file_put_contents("step/$cid2.step","qo'shish");
	exit();
}else{
	bot('answerCallbackQuery',[
	'callback_query_id'=>$qid,
	'text'=>"Limitga yetib kelgansiz!",
	'show_alert'=>true,
	]);
}
}

if($step == "qo'shish"){
if($cid == $admin){
if(isset($text)){		
if(mb_stripos($text,"-")!==false){
if($kanal == null){
$a = $KanalMin + 1;
file_put_contents("tizim/KanalMin.txt",$a);
file_put_contents("tizim/kanal.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$admin,
	'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$asosiy
]);
unlink("step/$cid.step");
exit();
}else{
$a = $KanalMin + 1;
file_put_contents("tizim/KanalMin.txt",$a);
file_put_contents("tizim/kanal.txt","$kanal\n$text");
	bot('SendMessage',[
	'chat_id'=>$admin,
	'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$asosiy
]);
unlink("step/$cid.step");
exit();
}
}else{
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Kanalingiz userini kiriting:

Namuna:</b> RixBuilder-RixBuilder
( Kanal nomi-Kanal_useri )",
'parse_mode'=>'html',
]);
exit();
}
}
}
}

if($data == "ochirish"){
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"⏱ <b>Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
       'text'=>"✅ <b>Kanallar muvaffaqiyatli o'chirildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"majburiy"]],
]
])
]);
unlink("tizim/KanalMin.txt");
unlink("tizim/kanal.txt");
}

if($data == "royxat"){
$soni = substr_count($kanal,"-");
if($kanal == null){
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"⏱ <b>Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
       'text'=>"📂 <b>Kanallar ro'yxati bo'sh!</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"majburiy"]],
]
])
]);
}else{
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"⏱ <b>Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
       'text'=>"<b>📢 Kanallar ro'yxati:</b>

$kanal

<b>Ulangan kanallar soni:</b> $soni ta",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"majburiy"]],
]
])
]);
}
}

if($data == "qoshimcha"){
	bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>Kuting...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>Kuting...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
'text'=>"<b>Quyidagilardan birini tanlang:

Hozirgi holat:
Promokod uchun kanal:</b> $promo",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🆕️ Promokod uchun",'callback_data'=>"promo"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"kanallar"]]
]
])
]);
}

if($data == "promo"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>Kanalingiz userini yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>$boshqarish,
]);
file_put_contents("step/$cid2.step",'kanal');
exit();
}

if($step == "kanal" and $cid == $admin){
if(stripos($text,"@")!==false){
$get = bot('getChat',[
'chat_id'=>$text
]);
$types = $get->result->type;
$ch_name = $get->result->title;
$ch_user = $get->result->username;
if(getAdmin($ch_user)== true){
file_put_contents("tizim/promo.txt","@$ch_user");
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$asosiy,
]);
unlink("step/$cid.step");
exit();
}else{
	bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Bot ushbu kanalda admin emas yoki noto'g'ri kanal manzili yuborildi!</b>",
'parse_mode'=>'html',
]);
exit();
}
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"⚠️ <b>Kanal manzili kiritishda xatolik!</b>

Qayta urinib ko'ring:",
'parse_mode'=>'html',
]);
exit();
}
}


if($text == "⚙ Sozlamalar" and $cid == $admin){
	if($kalit == null){
		bot('sendMessage',[
		'chat_id'=>$cid,
		'text'=>"🔽 <b>Quyidagilardan birini tanlang:</b>",
		'parse_mode'=>'html',
		'reply_markup'=>json_encode([
		'inline_keyboard'=>[
[['text'=>"➕ HASH kalitni ulash",'callback_data'=>"api_hash"]],
[['text'=>"Yopish",'callback_data'=>"boshqarish"]]
]
])
]);
exit();
}else{
	bot('sendMessage',[
		'chat_id'=>$cid,
		'text'=>"🔽 <b>Quyidagilardan birini tanlang:</b>",
		'parse_mode'=>'html',
		'reply_markup'=>json_encode([
		'inline_keyboard'=>[
[['text'=>"🛍 Xaridlar bo'limi",'callback_data'=>"xaridlar"]],
[['text'=>"📄 Ma'lumotlar",'callback_data'=>"mal"],['text'=>"🔄 Qayta o'rnatish",'callback_data'=>"api_hash"]],
[['text'=>"Yopish",'callback_data'=>"boshqarish"]]
]
])
]);
exit();
}
}

if($data == "sozlama"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
	'text'=>"🔽 <b>Quyidagilardan birini tanlang:</b>",
		'parse_mode'=>'html',
		'reply_markup'=>json_encode([
		'inline_keyboard'=>[
[['text'=>"🛍 Xaridlar bo'limi",'callback_data'=>"xaridlar"]],
[['text'=>"📄 Ma'lumotlar",'callback_data'=>"mal"],['text'=>"🔄 Qayta o'rnatish",'callback_data'=>"api_hash"]],
[['text'=>"Yopish",'callback_data'=>"boshqarish"]]
]
])
]);
exit();
}
	

if($data == "mal"){
$result = mysqli_query($connect,"SELECT * FROM api WHERE api = '$kalit'");
$row = mysqli_fetch_assoc($result);
if(!$row){
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"⚠️ <b>Diqqat, HASH kalitingiz yaroqsiz!</b>

Qayta o'rnating:",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"sozlama"]],
]
])
]);
}else{
$api_id = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM api WHERE api = '$kalit'"))['user_id'];
$pul = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kabinet WHERE user_id = '$api_id'"))['pul'];
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"💵 <b>Asosiy balansingiz:</b> $pul so'm

📗 <i>Botdagi ba'zi bir pullik funksiyalar, limitlar yoki reklamalarni sotib olayotganingizda kerakli mablag' shu balansingizdan yechiladi.</i>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"sozlama"]],
]
])
]);
}
}

if($data == "reklama"){
	bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"<b>Botdagi reklamani olib tashlashingizga ishonchingiz komilmi?

⭐ Reklamani olib tashlash narxi:</b> 5 000 so'm

<i>Agar ishonchingiz komil bo'lsa, Roziman tugmasini bosing!</i>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✅ Roziman",'callback_data'=>"rozi"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"xaridlar"]],
]
])
]);
}

if($data == "rozi"){
$api_id = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM api WHERE api = '$kalit'"))['user_id'];
$pul = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kabinet WHERE user_id = '$api_id'"))['pul'];
if($pul >= 5000){
$a = $pul - 5000;
mysqli_query($connect,"UPDATE kabinet SET pul = $a WHERE user_id = $api_id");
	file_put_contents("tizim/reklama.txt","O'chirilgan");
	bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"✅ <b>Reklama muvaffaqiyatli olib tashlandi!</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"xaridlar"]],
]
])
]);
}else{
	bot('answerCallbackQuery',[
	'callback_query_id'=>$qid,
	'text'=>"Hisobingizda yetarli mablag' mavjud emas!",
	'show_alert'=>true,
	]);
}
}

if($data == "xaridlar"){
if($rek == "Yoqilgan"){
	$reklama = "⭐ Reklama";
}
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"🔽 <b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📑 Ro'yxat",'callback_data'=>"roy"]],
[['text'=>"📢 Kanallar",'callback_data'=>"lim-KanalMax"],['text'=>"💳 Hamyonlar",'callback_data'=>"lim-WalletMax"]],
[['text'=>"$reklama",'callback_data'=>"reklama"],['text'=>"◀️ Orqaga",'callback_data'=>"sozlama"]],
]
])
]);
}

if($data == "roy"){
	bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"📑 <b>Ro'yxatlar:

1. Kanal ulash:</b> $KanalMin/$KanalMax
2. <b>Hamyon ulash:</b> $WalletMin/$WalletMax
3. <b>Reklama:</b> $rek",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"xaridlar"]],
]
])
]);
}

if(mb_stripos($data, "lim-")!==false){
	$ex = explode("-",$data);
	$limit = $ex[1];
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
'text'=>"<b>Qancha limit sotib olmoqchisiz?</b>

<i>1 ta limit narxi - 1500 so'm</i>",
	'parse_mode'=>'html',
	'reply_markup'=>$boshqarish,
	]);
	file_put_contents("step/$cid2.step","sale-$limit");
	exit();
}

if(mb_stripos($step, "sale-")!==false){
	$ex = explode("-",$step);
	$limit = $ex[1];
	if($text >= "1" and $text <= "10"){
$api_id = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM api WHERE api = '$kalit'"))['user_id'];
$pul = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kabinet WHERE user_id = '$api_id'"))['pul'];
$narxi = $text * 1500;
if($pul >= $narxi){
		bot('SendMessage',[
	'chat_id'=>$cid,
'text'=>"<b>$text</b> ta limit sotib olishingizga ishonchingiz komilmi?

<i>Agar limitlarni sotib olsangiz, limit uchun olinadigan mablag' @MegaKonstBot dagi hisobingizdan yechiladi!</i>",
	'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✅ Tasdiqlash",'callback_data'=>"tas-$limit-$text"]],
[['text'=>"🚫 Bekor qilish",'callback_data'=>"sbekor"]],
]
])
]);
unlink("step/$cid.step");
exit();
}else{
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Hisobingizda yetarli mablag' mavjud emas!</b>

Qayta urinib ko'ring:",
	'parse_mode'=>'html',
	]);
	exit();
}
}else{
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Minimal miqdor - 1 ta
Maksimal miqdor - 10 ta</b>

Qayta urinib ko'ring:",
	'parse_mode'=>'html',
	]);
	exit();
}
}

if(mb_stripos($data, "tas-")!==false){
	$ex = explode("-",$data);
	$limit = $ex[1];
	$soni = $ex[2];
$api_id = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM api WHERE api = '$kalit'"))['user_id'];
$pul = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kabinet WHERE user_id = '$api_id'"))['pul'];
$lim = file_get_contents("tizim/$limit.txt");
$narx = $soni * 1500;
$a = $pul - $narx;
$b = $lim + $soni;
file_put_contents("tizim/$limit.txt",$b);
mysqli_query($connect,"UPDATE kabinet SET pul = $a WHERE user_id = '$api_id'");
	bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
'text'=>"✅ <b>Limitlar muvaffaqiyatli qo'shildi!</b>

Xaridingiz uchun raxmat!",
'parse_mode'=>'html',
'reply_markup'=>$asosiy
]);
}

if($data == "sbekor"){
	bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
'text'=>"🚫 <b>Bekor qilindi!</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$asosiy,
	]);
	unlink("step/$cid2.step");
}

if($data == "api_hash"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
'text'=>"<b>@MegaKonstBot dan olingan HASH kalitni kiriting:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$boshqarish,
	]);
	file_put_contents("step/$cid2.step",'kalit');
	exit();
}

if($step == "kalit" and $cid == $admin){
$result = mysqli_query($connect,"SELECT * FROM api WHERE api = '$text'");
$row = mysqli_fetch_assoc($result);
if(!$row){
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"<b>Ushbu HASH kalit mavjud emas!</b>

Qayta urunib ko'ring:",
'parse_mode'=>"html",
]);
exit();
}else{
        file_put_contents("tizim/kalit.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$asosiy,
	]);
	unlink("step/$cid.step");
	exit();
}
}


if(isset($message)){
	if($cid == $admin){
		bot('SendMessage',[
		'chat_id'=>$admin,
		'text'=>"🖥",
		'parse_mode'=>'html',
		'reply_markup'=>$menus,
		]);
	}else{
		bot('SendMessage',[
		'chat_id'=>$cid,
		'text'=>"🖥",
		'parse_mode'=>'html',
		'reply_markup'=>$menu,
		]);
	}
}

?>