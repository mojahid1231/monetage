<?php
ob_start();
error_reporting(0);
date_Default_timezone_set('Asia/Tashkent');


/*
Ushbu kod @NewGramBot ni asl kodi bo'lib, ushbu kodni @AlijonovUz ( Alijonov Abdulbosit ) tuzib chiqgan.
Mehnatimni qadrlab, manba bilan tarqatasizlar degan umiddaman. Hammaga raxmat !!!
*/


define('AlijonovUz',"API_TOKEN");
$AlijonovUz = "ADMIN_ID";
$admins = file_get_contents("admin/admins.txt");
$admin = explode("\n", $admins);
array_push($admin,$AlijonovUz);
$user = file_get_contents("admin/user.txt");
$api = file_get_contents("admin/api.txt");
$bot = bot('getme',['bot'])->result->username;
$soat = date('H:i');
$clock = date('H:i:s');
$sana = date("d.m.Y");

define("DB_SERVER", "localhost"); // Tegilmaydi
define("DB_USERNAME", "risebuilder"); // Mysql baza nomi
define("DB_PASSWORD", "risebuilder"); // Mysql baza paroli
define("DB_NAME", "risebuilder"); // Mysql baza nomi

$connect = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
mysqli_set_charset($connect, "utf8mb4");
if($connect){
    echo "Ulandi.";
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

function joinchat($id){
global $mid;
$array = array("inline_keyboard");
$get = file_get_contents("admin/kanal.txt");
$ex = explode("\n",$get);
if($get == null){
return true;
	}else{
for($i=0;$i<=count($ex) -1;$i++){
$url = explode("\n",$get)[$i]; 
$a = json_decode(file_get_contents("https://api.telegram.org/bot".AlijonovUz."/getchat?chat_id=$url"));
$name = $a->result->title;
     $ret = bot("getChatMember",[
         "chat_id"=>"$url",
         "user_id"=>$id,
         ]);
$stat = $ret->result->status;
         if((($stat=="creator" or $stat=="administrator" or $stat=="member"))){
      $array['inline_keyboard']["$i"][0]['text'] = "✅ ". $name;
      $array['inline_keyboard']["$i"][0]['url'] = "https://t.me/".str_replace('@','',$url);
         }else{
  $array['inline_keyboard']["$i"][0]['text'] = "❌ ". $name;
      $array['inline_keyboard']["$i"][0]['url'] = "https://t.me/".str_replace('@','',$url);
$uns = true;
}
}
$array['inline_keyboard']["$i"][0]['text'] = "🔄 Tekshirish";
$array['inline_keyboard']["$i"][0]['callback_data'] = "result";
if($uns == true){
     bot('sendMessage',[
         'chat_id'=>$id,
         'text'=>"⛔️ <b>Botdan to'liq foydalanish uchun</b> quyidagi kanallarga obuna bo'ling:",
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

//tugmalar
if(file_get_contents("tugma/key1.txt")){
	}else{
		if(file_put_contents("tugma/key1.txt",'➕ Buyurtma berish'));
	}
if(file_get_contents("tugma/key2.txt")){
	}else{
		if(file_put_contents("tugma/key2.txt","💵 Pul yig'ish"));
	}
if(file_get_contents("tugma/key3.txt")){
	}else{
		if(file_put_contents("tugma/key3.txt",'👔 Kabinet'));
	}
if(file_get_contents("tugma/key4.txt")){
	}else{
		if(file_put_contents("tugma/key4.txt",'📊 Buyurtmani kuzatish'));
	}
if(file_get_contents("tugma/key5.txt")){
	}else{
		if(file_put_contents("tugma/key5.txt",'📨 Yordam'));
	}
if(file_get_contents("tugma/key6.txt")){
	}else{
		if(file_put_contents("tugma/key6.txt",'📚 Bot haqida'));
	}
	if(file_get_contents("tugma/key7.txt")){
	}else{
		if(file_put_contents("tugma/key7.txt",'🖇 Takliflar'));
	}
		if(file_get_contents("tugma/key10.txt")){
	}else{
		if(file_put_contents("tugma/key10.txt",'💳 Pul kiritish'));
	}
	
		if(file_get_contents("tugma/qator1.txt")){
	}else{
		if(file_put_contents("tugma/qator1.txt",'2'));
	}
	if(file_get_contents("tugma/qator2.txt")){
	}else{
		if(file_put_contents("tugma/qator2.txt",'1'));
	}
	if(file_get_contents("tugma/qator3.txt")){
	}else{
		if(file_put_contents("tugma/qator3.txt",'1'));
	}
	if(file_get_contents("tugma/qator4.txt")){
	}else{
		if(file_put_contents("tugma/qator4.txt",'2'));
	}
	if(file_get_contents("tugma/qator5.txt")){
	}else{
		if(file_put_contents("tugma/qator5.txt",'2'));
	}
	if(file_get_contents("tugma/qator6.txt")){
	}else{
		if(file_put_contents("tugma/qator6.txt",'1'));
	}
	if(file_get_contents("tugma/qator7.txt")){
	}else{
		if(file_put_contents("tugma/qator7.txt",'1'));
	}
	
//pul va referal sozlamalar

if(file_get_contents("admin/valyuta.txt")){
	}else{
		if(file_put_contents("admin/valyuta.txt","so'm"));
}
if(file_get_contents("admin/referal.txt")){
	}else{
		if(file_put_contents("admin/referal.txt",'250'));
}
if(file_get_contents("admin/transfer.txt")){
	}else{
		if(file_put_contents("admin/transfer.txt",'0'));
}
if(file_get_contents("admin/admins.txt")){
	}else{
		if(file_put_contents("admin/admins.txt","$AlijonovUz"));
}
if(file_get_contents("admin/vip.txt")){
	}else{
		if(file_put_contents("admin/vip.txt","25000"));
}

if(file_get_contents("admin/holat.txt")){
	}else{
		if(file_put_contents("admin/holat.txt","Yoqilgan"));
}

if(file_get_contents("bonus/status.txt")){
	}else{
if(file_put_contents("bonus/status.txt","O'chirilgan"));
}
if(file_get_contents("bonus/bonus.txt")){
	}else{
if(file_put_contents("bonus/bonus.txt","0"));
}

//matnlar
if(file_get_contents("matn/start.txt")){
	}else{
		if(file_put_contents("matn/start.txt","<b>🖥 Asosiy menyudasiz.</b>"));
}
if(file_get_contents("matn/taklif.txt")){
	}else{
		if(file_put_contents("matn/taklif.txt","⚡️ <b>Sizning taklif havolalaringiz:</b>

<pre>%reflink%</pre>
<pre>%reflink2%</pre>

<b>1 ta taklif uchun %refpay% %currency% beriladi.

Sizning takliflaringiz: %refcount% ta</b>"));
}

$key1 = file_get_contents("tugma/key1.txt");
$key2 = file_get_contents("tugma/key2.txt");
$key3 = file_get_contents("tugma/key3.txt");
$key4 = file_get_contents("tugma/key4.txt");
$key5 = file_get_contents("tugma/key5.txt");
$key6 = file_get_contents("tugma/key6.txt");
$key7 = file_get_contents("tugma/key7.txt");
$key8 = file_get_contents("tugma/key8.txt");
$key9 = file_get_contents("tugma/key9.txt");
$key10 = file_get_contents("tugma/key10.txt");
$key11 = file_get_contents("tugma/key11.txt");
$key12 = file_get_contents("tugma/key12.txt");

$qator1 = file_get_contents("tugma/qator1.txt");
$qator2 = file_get_contents("tugma/qator2.txt");
$qator3 = file_get_contents("tugma/qator3.txt");
$qator4 = file_get_contents("tugma/qator4.txt");
$qator5 = file_get_contents("tugma/qator5.txt");
$qator6 = file_get_contents("tugma/qator6.txt");
$qator7 = file_get_contents("tugma/qator7.txt");

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
$vip = file_get_contents("nakrutka/$test/$test1/$test2/vip.txt");
$min = file_get_contents("nakrutka/$test/$test1/$test2/min.txt");
$max = file_get_contents("nakrutka/$test/$test1/$test2/max.txt");
$tavsif = file_get_contents("nakrutka/$test/$test1/$test2/tavsif.txt");

$pul = file_get_contents("pul/$cid.txt");
$pul = file_get_contents("pul/$cid2.txt");
$oplata = file_get_contents("oplata/$cid.txt");
$oplata = file_get_contents("oplata/$cid2.txt");
$odam = file_get_contents("odam/$cid.dat");
$odam = file_get_contents("odam/$cid2.dat");
$status = file_get_contents("status/$cid.txt");
$status = file_get_contents("status/$cid2.txt");
$ban = file_get_contents("ban/$cid.txt");

$saved = file_get_contents("step/alijonov.txt");
$narx = file_get_contents("admin/vip.txt");
$kanal = file_get_contents("admin/kanal.txt");
$transfer = file_get_contents("admin/transfer.txt");
$valyuta = file_get_contents("admin/valyuta.txt");
$referal = file_get_contents("admin/referal.txt");
$start = str_replace(["%first%","%id%","%botname%","%hour%","%date%"], [$name,$cid,$bot,$soat,$sana],file_get_contents("matn/start.txt"));
$qollanma = str_replace(["%first%","%id%","%hour%","%date%","%user%","%botname%",], [$name,$cid,$soat,$sana,$user,$bot],file_get_contents("matn/qollanma.txt"));
$qoida = str_replace(["%first%","%id%","%hour%","%date%","%user%","%botname%"], [$name,$cid,$soat,$sana,$user,$bot],file_get_contents("matn/qoida.txt"));
$taklif = str_replace(["%first%","%username%","%id%","%hour%","%date%","%reflink%","%reflink2%","%refpay%","%refcount%","%balance%,","%currency%"], [$name,$username,$cid2,$soat,$sana,"https://t.me/$bot?start=VIP$cid2","tg://resolve?domain=$bot&start=VIP$cid2",$referal,$odam,$pul,$valyuta],file_get_contents("matn/taklif.txt"));
$photo = file_get_contents("matn/photo.txt");
$homiy = file_get_contents("matn/homiy.txt");
$holat = file_get_contents("admin/holat.txt");

$promo = file_get_contents("admin/kanal2.txt");
$kod = file_get_contents("step/kod.txt");
$money = file_get_contents("step/money.txt");
$post = file_get_contents("step/mid.txt");
$time = file_get_contents("bonus/$cid2.txt");
$user_id = file_get_contents("azo.dat");

$ref1 = file_get_contents("step/$cid2.txt");
$ref2 = file_get_contents("step/$cid2.id");
$mt = file_get_contents("step/$cid.mt");
$mt2 = file_get_contents("step/$cid.mt2");
mkdir("odam");
mkdir("pul");
mkdir("bonus");
mkdir("status");
mkdir("tizim");
mkdir("oplata");
mkdir("ban");
mkdir("step");
mkdir("admin");
mkdir("tugma");
mkdir("matn");
mkdir("nakrutka");

$panel = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"📢 Kanallarni sozlash"]],
[['text'=>"📊 Statistika"],['text'=>"✉ Xabar Yuborish"]],
[['text'=>"⚙ Asosiy sozlamalar"]],
[['text'=>"🎛 Tugmalar"],['text'=>"📃 Matnlar"]],
[['text'=>"🔎 Foydalanuvchini boshqarish"]],
[['text'=>"📋 Adminlar"],['text'=>"🎟 Promokod"]],
[['text'=>"🎁 Kunlik bonus sozlamalari"]],
[['text'=>"🤖 Bot holati"],['text'=>"⭐️ Bot dizayni"]],
[['text'=>"💵 To'lov holati"],['text'=>"◀️ Orqaga"]]
]
]);

$asosiy = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"*️⃣ Birlamchi sozlamalar"]],
[['text'=>"🔑 API sozlamalari"],['text'=>"💳 Hamyonlar"]],
[['text'=>"🛍 Buyurtmalarni sozlash"]],
[['text'=>"🗄 Boshqarish"]]
]
]);

$menu = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"$key1"]],
[['text'=>"$key2"],['text'=>"$key3"]],
[['text'=>"$key4"]],
[['text'=>"$key5"],['text'=>"$key6"]],
]
]);

$menus = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"$key1"]],
[['text'=>"$key2"],['text'=>"$key3"]],
[['text'=>"$key4"]],
[['text'=>"$key5"],['text'=>"$key6"]],
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

if(in_array($cid,$admin)){
$menyu = $menus;
}
if(in_array($cid,$admin)){
}else{
$menyu = $menu;
}

if(in_array($cid2,$admin)){
$menyus = $menus;
}
if(in_array($cid2,$admin)){
}else{
$menyus = $menu;
}


if($text){
$kun = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kunlik WHERE useri = $bot"))['kun'];
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

if($text){
 if($holat == "O'chirilgan"){
	if(in_array($cid,$admin)){
}else{
	bot('sendMessage',[
	'chat_id'=>$cid,
	'text'=>"⛔️ <b>Bot vaqtinchalik o'chirilgan!</b>

<i>Botda ta'mirlash ishlari olib borilayotgan bo'lishi mumkin!</i>",
'parse_mode'=>'html',
]);
exit();
}
}else{
}
}

if($data){
 if($holat == "O'chirilgan"){
	if(in_array($cid2,$admin)){
}else{
	bot('answerCallbackQuery',[
		'callback_query_id'=>$qid,
		'text'=>"⛔️ Bot vaqtinchalik o'chirilgan!

Botda ta'mirlash ishlari olib borilayotgan bo'lishi mumkin!",
		'show_alert'=>true,
		]);
exit();
}
}else{
}
}
	
if(isset($message)){
$status = file_get_contents("status/$cid.txt");
if($status == null){
	file_put_contents("status/$cid.txt",'Oddiy');
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

if($text == "/start"){
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>$start,
	'parse_mode'=>'html',
        'disable_web_page_preview'=>true,
	'reply_markup'=>$menyu,
	]);
exit();
}

	if(isset($message)){
$pul = file_get_contents("pul/$cid.txt");
$mm = $pul + 0;
file_put_contents("pul/$cid.txt","$mm");
$oplata = file_get_contents("oplata/$cid.txt");
$mms = $oplata + 0;
file_put_contents("oplata/$cid.txt","$mms");
$odam = file_get_contents("odam/$cid.dat");
$kkd = $odam + 0;
file_put_contents("odam/$cid.dat","$kkd");
}


	if(mb_stripos($text,"VIP")!==false){
$refid = str_replace("/start VIP","",$text);
if(strlen($refid)>0 and $refid>0){
if($refid == $cid){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>$start,
'parse_mode'=>'html',
'disable_web_page_preview'=>true,
'reply_markup'=>$menyu,
]);
exit();
}else{
if(mb_stripos($user_id,"$cid")!==false){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>$start,
'parse_mode'=>'html',
'disable_web_page_preview'=>true,
'reply_markup'=>$menyu,
]);
exit();
}else{
file_put_contents("step/$cid.id",$refid);
file_put_contents("step/$cid.txt",$refid);
$odam = file_get_contents("odam/$refid.dat");
$b = $odam + 1;
file_put_contents("odam/$refid.dat","$b");
bot('sendMessage',[
'chat_id'=>$cid,
    'text'=>$start,
    'parse_mode'=>'html',
'disable_web_page_preview'=>true,
'reply_markup'=>$menyu,
]);
bot('SendMessage',[
'chat_id'=>$refid,
'text'=>"➕ <b>Sizda yangi taklif bor</b>",
'parse_mode'=>'html',
'disable_web_page_preview'=>true,
]);
exit();
}
}
}
}

if($data == "result"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2
]);
if(joinchat($cid2)==true){
if($ref1 != $ref2){
bot('SendMessage',[
'chat_id'=>$cid2,
	'text'=>"✅ <b>Obunangiz tasdiqlandi. Bosh menyudasiz.</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$menyus,
]);
exit();
}else{
$pul = file_get_contents("pul/$ref2.txt");
$a = $pul + $referal;
file_put_contents("pul/$ref2.txt","$a");
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"✅ <b>Obunangiz tasdiqlandi. Bosh menyudasiz.</b>",
'parse_mode'=>'html',
'reply_markup'=>$menyus
]);
bot('SendMessage',[
'chat_id'=>$ref2,
'text'=>"✅ <b>Hisobingizga $referal $valyuta qo'shildi!</b>",
'parse_mode'=>'html',
]);
unlink("step/$cid2.txt");
unlink("step/$cid2.id");
exit();
}
}
}

if($text == "◀️ Orqaga"){
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>🖥 Asosiy menyuga qaytdingiz.</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$menyu,
]);
unlink("step/$cid.step");
unlink("step/alijonov.txt");
exit();
}

if($text == "$key3" and joinchat($cid)==true){
$keys[]=['text'=>"$key12",'callback_data'=>"vip_shop"];
$keys[]=['text'=>"$key11",'callback_data'=>"almashish"];
$keys[]=['text'=>"$key10",'callback_data'=>"oplata"];
$keys2 = array_chunk($keys, $qator5);
$keys3 = json_encode([
'inline_keyboard'=>$keys2,
]);
		bot('SendMessage',[
		'chat_id'=>$cid,
		'text'=>"🔑<b> Sizning ID raqamingiz:</b> <code>$cid</code>

💵 <b>Umumiy balansingiz:</b> $pul $valyuta
👥 <b>Takliflaringiz soni:</b> $odam ta

<b>Statusingiz:</b> $status

<b>💳 Botga kiritgan pullaringiz:</b> $oplata $valyuta",
'parse_mode'=>'html',
'reply_markup'=>$keys3
]);
exit();
}

if($data == "kabinet"){
$status = file_get_contents("status/$cid2.txt");
$keys[]=['text'=>"$key12",'callback_data'=>"vip_shop"];
$keys[]=['text'=>"$key11",'callback_data'=>"almashish"];
$keys[]=['text'=>"$key10",'callback_data'=>"oplata"];
$keys2 = array_chunk($keys, $qator5);
$keys3 = json_encode([
'inline_keyboard'=>$keys2,
]);
	bot('DeleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
	'text'=>"🔑<b> Sizning ID raqamingiz:</b> <code>$cid2</code>

💵 <b>Umumiy balansingiz:</b> $pul $valyuta
👥 <b>Takliflaringiz soni:</b> $odam ta

<b>Statusingiz:</b> $status

<b>💳 Botga kiritgan pullaringiz:</b> $oplata $valyuta",
'parse_mode'=>'html',
'reply_markup'=>$keys3
]);
exit();
}

if($data == "vip_shop"){
$status = file_get_contents("status/$cid2.txt");
	if($status == "VIP"){
        bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"💎 <b>VIP - statusga muvaffaqiyatli o'tdingiz.</b>

Xaridingiz uchun raxmat!",
'parse_mode'=>"html",
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"kabinet"]],
]
])
]);
}else{
	bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>💎 VIP narxi - $narx $valyuta</b>

Haqiqatdan ham sotib olmoqchimisiz?",
'parse_mode'=>"html",
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
[['text'=>"Sotib olish",'callback_data'=>"shop"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"kabinet"]],
]
])
]);
}
}

if($data == "shop"){
	if($pul >= $narx){		
file_put_contents("status/$cid2.txt","VIP");
$mm = $pul - $narx;
	file_put_contents("pul/$cid2.txt",$mm);
	bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>" <b>Kuting...</b>",
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
'text'=>"💎 <b>VIP - statusga muvaffaqiyatli o'tdingiz.</b>

Xaridingiz uchun raxmat!",
'parse_mode'=>'html',
       'reply_markup'=>json_encode([
        'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"kabinet"]],
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

if($data == "almashish"){
	if($pul>=$transfer){
			bot('deleteMessage',[			
			'chat_id'=>$cid2,
			'message_id'=>$mid2,
			]);
			bot('sendMessage',[
			'chat_id'=>$cid2,
			'text'=>"<b>Qancha mablag'ingizni o'tkazmoqchisiz?</b>

<i>Minimal o'tkazma miqdori:</i> $transfer $valyuta",
			'parse_mode'=>'html',
			'reply_markup'=>$back,
			]);		
			file_put_contents("step/$cid2.step",'almashish');
			exit();
		}else{
			bot('answerCallbackQuery',[
			'callback_query_id'=>$qid,
			'text'=>"Hisobingizda minimal o'tkazma uchun yetarli mablag' mavjud emas.

Minimal o'tkazma miqdori: $transfer $valyuta",
			'show_alert'=>true,
			]);
		}
	}

	if($step == "almashish"){		
if(is_numeric($text)=="true"){	
if($text>=$transfer){
	if($pul>=$text){	
		file_put_contents("step/alijonov.txt",$text);
			bot('SendMessage',[
			'chat_id'=>$cid,
			'text'=>"<b>Kerakli foydalanuvchi ID raqamini yuboring:
o'tkazma komissiyasi:</b> 0.01%",
			'parse_mode'=>'html',
			]);		
				file_put_contents("step/$cid.step",'tran');
				exit();
		}else{	
			bot('SendMessage',[
			'chat_id'=>$cid,
				'text'=>"<b>Qancha mablag'ingizni o'tkazmoqchisiz?</b>

<i>Minimal o'tkazma miqdori:</i> $transfer $valyuta",
			'parse_mode'=>'html',
			]);		
			exit();
}
}else{
bot('SendMessage',[
			'chat_id'=>$cid,
				'text'=>"<b>Qancha mablag'ingizni o'tkazmoqchisiz?</b>

<i>Minimal o'tkazma miqdori:</i> $transfer $valyuta",
			'parse_mode'=>'html',
			]);		
			exit();
}
}else{
bot('SendMessage',[
	'chat_id'=>$cid,
			'text'=>"<b>Qancha mablag'ingizni o'tkazmoqchisiz?</b>

<i>Minimal o'tkazma miqdori:</i> $transfer $valyuta",
			'parse_mode'=>'html',
			]);		
			exit();
}
}

if($step == "tran"){
if(file_exists("pul/$text.txt")){
$pul = file_get_contents("pul/$cid.txt");
$miqdor = $pul - $saved;
file_put_contents("pul/$cid.txt",$miqdor);
$pul = file_get_contents("pul/$text.txt");
$miqdor = $pul + $saved;
file_put_contents("pul/$text.txt",$miqdor);
bot('SendMessage',[
'chat_id'=>$text,
'text'=>"$cid <b>tomonidan hisobingizga $saved $valyuta o'tkazildi.</b>",
'parse_mode'=>'html',
'disable_web_page_preview'=>true,
]);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"$text <b>ga $saved $valyuta o'tkazildi. Hisobingizdan $saved $valyuta olib tashlandi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$menyu,
]);
unlink("step/$cid.step");
unlink("step/alijonov.txt");
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


if($data == "oplata"){
	if($turi == null){
			bot('answerCallbackQuery',[
	'callback_query_id'=>$qid,
	'text'=>"To'lov tizimlari topilmadi!",
	'show_alert'=>true,
	]);
}else{
	$turi = file_get_contents("tizim/turi.txt");
$more = explode("\n",$turi);
$soni = substr_count($turi,"\n");
$keys=[];
for ($for = 1; $for <= $soni; $for++) {
$title=str_replace("\n","",$more[$for]);
$keys[]=["text"=>"$title","callback_data"=>"pay-$title"];
$keysboard2 = array_chunk($keys, $qator4);
$keysboard2[] = [['text'=>"◀️ Orqaga",'callback_data'=>"kabinet"]];
$payment = json_encode([
'inline_keyboard'=>$keysboard2,
]);
}
        bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>" <b>Kuting...</b>",
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
        'text'=>"👇 <b>Quyidagi to'lov tizimlaridan birini tanlang:</b>",
'parse_mode'=>"html",
        'reply_markup'=>$payment
]);
}
}

if($data == "orqa"){
	$turi = file_get_contents("tizim/turi.txt");
$more = explode("\n",$turi);
$soni = substr_count($turi,"\n");
$keys=[];
for ($for = 1; $for <= $soni; $for++) {
$title=str_replace("\n","",$more[$for]);
$keys[]=["text"=>"$title","callback_data"=>"pay-$title"];
$keysboard2 = array_chunk($keys, $qator4);
$keysboard2[] = [['text'=>"◀️ Orqaga",'callback_data'=>"kabinet"]];
$payment = json_encode([
'inline_keyboard'=>$keysboard2,
]);
}
        bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"👇 <b>Quyidagi to'lov tizimlaridan birini tanlang:</b>",
'parse_mode'=>"html",
        'reply_markup'=>$payment
]);
}

if(mb_stripos($data, "pay-")!==false){
	$ex = explode("-",$data);
	$turi = $ex[1];
	$addition = file_get_contents("tizim/$turi/addition.txt");
   $wallet = file_get_contents("tizim/$turi/wallet.txt");
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
	'text'=>"<b>📋 To'lov tizimi:</b> $turi

<b>💳 Hamyon ( yoki karta ):</b> <code>$wallet</code>
<b>📝 Izoh:</b> <code>$cid2</code>
$addition",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✅ To'lov qildim",'callback_data'=>"money-$turi"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"orqa"]],
]
])
]);
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
	'text'=>"💵 <b>To'lov miqdorini kiriting:</b>",
	'parse_mode'=>'html',
'reply_markup'=>$back,
	]);	file_put_contents("step/$cid2.step","oplata-$turi");
exit();
}

if(mb_stripos($step, "oplata-")!==false){
$ex = explode("-",$step);
$turi = $ex[1];
if(is_numeric($text)=="true"){
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"🧾 <b>To'lovingizni chek yoki skreenshotini shu yerga yuboring:</b>",
	'parse_mode'=>'html',
	]);
file_put_contents("step/$cid.step","rasm-$text-$turi");
exit();
}else{
bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"💵 <b>To'lov miqdorini kiriting:</b>",
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
'chat_id'=>$AlijonovUz,
'from_chat_id'=>$cid,
'message_id'=>$mid,
]);
bot('SendMessage',[
'chat_id'=>$AlijonovUz,
'text'=>"<b>Foydalanuvchi hisobini to'ldirmoqchi!

To'lov tizimi:</b> $turi
<b>Foydalanuvchi:</b> <a href='tg://user?id=$cid'>$cid</a>
<b>To'lov miqdori:</b> $miqdor $valyuta",
'disable_web_page_preview'=>true,
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✅",'callback_data'=>"on-$cid-$miqdor"],['text'=>"❌",'callback_data'=>"off-$cid-$miqdor"]],
]
])
]);
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"❇️ <b>Hisobni to'ldirganingiz haqida ma'lumot asosiy adminga yuborildi. <u>Agar to'lovni amalga oshirganingiz haqida ma'lumot mavjud bo'lsa,</u> hisobingiz to'ldiriladi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$menyu
]);
unlink("step/$cid.step");
exit();
}

if(mb_stripos($data, "on-")!==false){
	$ex = explode("-",$data);
	$id = $ex[1];
        $miqdor = $ex[2];
$pul = file_get_contents("pul/$id.txt");
$a = $pul + $miqdor;
file_put_contents("pul/$id.txt",$a);
$oplata = file_get_contents("oplata/$id.txt");
$b = $oplata + $miqdor;
file_put_contents("oplata/$id.txt",$b);
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$id,
	'text'=>"💵 <b>Hisobingiz $miqdor $valyuta ga to'ldirildi!</b>",
	'parse_mode'=>'html',
	]);
		bot('SendMessage',[
	'chat_id'=>$AlijonovUz,
	'text'=>"💵 <b>Foydalanuvchi (</b>$id<b>) hisobi $miqdor $valyuta ga to'ldirildi.</b>",
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

<i>Foydalanuvchi:</i> $id
<i>Miqdor:</i> $miqdor $valyuta",
	'parse_mode'=>'html',
	]);		
}

if($text == "$key2" and joinchat($cid)==true){
$keys[]=['text'=>"$key7",'callback_data'=>"taklif"];
$keys[]=['text'=>"$key8",'callback_data'=>"promokod"];
$keys[]=['text'=>"$key9",'callback_data'=>"bonus"];
$keys2 = array_chunk($keys, $qator6);
$keys3 = json_encode([
'inline_keyboard'=>$keys2,
]);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Quyidagilardan birini tanlang ⤵️</b>",
	'parse_mode'=>'html',
		'reply_markup'=>$keys3
]);
exit();
}

if($data == "pul_ishla"){
$keys[]=['text'=>"$key7",'callback_data'=>"taklif"];
$keys[]=['text'=>"$key8",'callback_data'=>"promokod"];
$keys[]=['text'=>"$key9",'callback_data'=>"bonus"];
$keys2 = array_chunk($keys, $qator6);
$keys3 = json_encode([
'inline_keyboard'=>$keys2,
]);
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
	'text'=>"<b>Quyidagilardan birini tanlang ⤵️</b>",
	'parse_mode'=>'html',
		'reply_markup'=>$keys3
]);
exit();
}

if($data == "bonus"){
$status = file_get_contents("bonus/status.txt");
if($status == "Yoqilgan"){
	if($time == $sana){
$times = "$sana — $soat";
$b_time = explode(" — ",$times)[1];
$s_time = explode(":",$b_time)[0]*60;
$m_time = explode(":",$b_time)[1];
$minutes = $s_time + $m_time;
$minus = 24*60;
$qoldi = ($minus - $minutes)*60;
$hours = str_pad(floor($qoldi / (60*60)), 2, '0', STR_PAD_LEFT);
$minutes = str_pad(floor(($qoldi - $hours*60*60)/60), 2, '0', STR_PAD_LEFT);
	bot('answerCallbackQuery',[
	'callback_query_id'=>$qid,
	'text'=>"❌ Bugun bonus olgansiz!

Keyingi bonusni $hours soat $minutes daqiqadan so'ng olishingiz mumkin.",
	'show_alert'=>true,
	]);
}else{
$bonus = file_get_contents("bonus/bonus.txt");
$pul = file_get_contents("pul/$cid2.txt");
$bons = $pul + $bonus;
file_put_contents("pul/$cid2.txt","$bons");
file_put_contents("bonus/$cid2.txt","$sana");
        bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>💸 Kunlik bonus - $bonus $valyuta

Homiy:</b>

$homiy

<b> ✅ Bonus berildi! ✅</b>",
'parse_mode'=>'html',
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"pul_ishla"]],
]
])
]);
}
}else{
bot('answerCallbackQuery',[
		'callback_query_id'=>$qid,
		'text'=>"🎁 Kunlik bonus bo'limi faolsizlantirilgan!",
		'show_alert'=>true,
		]);
}
}

if($data == "taklif"){
	if($photo == null){
		bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
'text'=>$taklif,
'parse_mode'=>'html',
	'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"pul_ishla"]],
]
])
]);
}else{
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendPhoto',[
	'chat_id'=>$cid2,
'photo'=>$photo,
	'caption'=>$taklif,
	'parse_mode'=>'html',
'disable_web_page_preview'=>true,
		'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"pul_ishla"]],
]
])
]);
exit();
}
}

if($data == "promokod"){
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

if($step == "AlijonovUz"){
$kod = file_get_contents("step/kod.txt");
	if($text == $kod){
$money = file_get_contents("step/money.txt");
$a = $pul + $money;
file_put_contents("pul/$cid.txt",$a);        
		bot('SendMessage',[
		'chat_id'=>$cid,
			'text'=>"✅ <b>Promokodni to'g'ri yubordingiz va hisobingizga $money $valyuta qo'shildi!</b>",
		'parse_mode'=>'html',
		'reply_markup'=>$menyu,
		]);
        bot('editMessageText',[
	'chat_id'=>$promo,
	'message_id'=>$post,
		'text'=>"🎫 — <b><del>$kod</del></b>
💰 — <b>$money $valyuta</b>

✅ <a href='tg://user?id=$cid'>$name</a>",
'disable_web_page_preview'=>true,
		'parse_mode'=>'html',
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
$keyboard2 = array_chunk($key, $qator1);
$nakrutka = json_encode([
'inline_keyboard'=>$keyboard2,
]);
}


	if($text == "$key1" and joinchat($cid)==true){
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
$keyboard2 = array_chunk($key, $qator2);
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
$keyboard2 = array_chunk($key, $qator3);
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
$status = file_get_contents("status/$cid2.txt");
	if($status == "VIP"){
$xiz = explode("-",$data)[1];
$ich = explode("-",$data)[2];
$bolim = explode("-",$data)[3];
$servis = file_get_contents("nakrutka/$bolim/$ich/$xiz/id.txt");
$narxlar = file_get_contents("nakrutka/$bolim/$ich/$xiz/narxi.txt");
$vip = file_get_contents("nakrutka/$bolim/$ich/$xiz/vip.txt");
$min = file_get_contents("nakrutka/$bolim/$ich/$xiz/min.txt");
$max = file_get_contents("nakrutka/$bolim/$ich/$xiz/max.txt");
$tavsif = file_get_contents("nakrutka/$bolim/$ich/$xiz/tavsif.txt");
$a = $narxlar * 1000;
$narxi = $vip * 1000;
	bot('editMessageText',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	'text'=>"📦 <b><u>$xiz</u></b>

💵 <b><u>Narx (x1000):</u></b> $a $valyuta
📑 <b><u>Batafsil ma'lumot:</u></b> $tavsif

🔽 <b><u>Minimal buyurtma miqdori:</u></b> $min ta
🔼 <b><u>Maksimal buyurtma miqdori:</u></b> $max ta

<i>💎 VIP foydalanuvchilar uchun narx (x1000): <del>$a</del> - $narxi $valyuta</i>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✅ Tanlash",'callback_data'=>"tanla-$xiz-$servis-$narxi-$min-$max-$a"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"tanlash-$ich-$bolim"]],
]
])
]);
}else{
	$xiz = explode("-",$data)[1];
$ich = explode("-",$data)[2];
$bolim = explode("-",$data)[3];
$servis = file_get_contents("nakrutka/$bolim/$ich/$xiz/id.txt");
$narxlar = file_get_contents("nakrutka/$bolim/$ich/$xiz/narxi.txt");
$vip = file_get_contents("nakrutka/$bolim/$ich/$xiz/vip.txt");
$min = file_get_contents("nakrutka/$bolim/$ich/$xiz/min.txt");
$max = file_get_contents("nakrutka/$bolim/$ich/$xiz/max.txt");
$tavsif = file_get_contents("nakrutka/$bolim/$ich/$xiz/tavsif.txt");
$a = $narxlar * 1000;
$narxi = $vip * 1000;
	bot('editMessageText',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	'text'=>"📦 <b><u>$xiz</u></b>

💵 <b><u>Narx (x1000):</u></b> $a $valyuta
📑 <b><u>Batafsil ma'lumot:</u></b> $tavsif

🔽 <b><u>Minimal buyurtma miqdori:</u></b> $min ta
🔼 <b><u>Maksimal buyurtma miqdori:</u></b> $max ta

<i>💎 VIP foydalanuvchilar uchun narx (x1000): <del>$a</del> - $narxi $valyuta</i>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✅ Tanlash",'callback_data'=>"tanla-$xiz-$servis-$a-$min-$max"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"tanlash-$ich-$bolim"]],
]
])
]);
}
}

if(mb_stripos($data, "tanla-")!==false){
	$ex = explode("-",$data);
	$xiz = $ex[1];
	$servis = $ex[2];
	$narxi = $ex[3];
	$min = $ex[4];
	$max = $ex[5];
	$a = $ex[6];
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
	file_put_contents("step/$cid2.step","next-$xiz-$servis-$narxi-$min-$max-$a");
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
	$ab = $ex[6];
	if($text >= $min and $text <= $max){
$pul = file_get_contents("pul/$cid.txt");
$narxi = $text / 1000 * $narx;
$a = $text / 1000 * $ab;
if($pul >= $narxi){
	mkdir("nakrutka/$cid");
file_put_contents("nakrutka/$cid/$cid.son",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>✅ $text ta buyurtma qabul qilindi</b>

🔗 <i>Buyurtma havolasini yuboring:</i>

❕ <b>Namuna:</b> https://havola ( yoki telegram kanallar, hamda guruhlar uchun - @user )",
'disable_web_page_preview'=>true,
	'parse_mode'=>'html',
	]);
	file_put_contents("step/$cid.step","nexts-$xiz-$servis-$narxi-$a");
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
$status = file_get_contents("status/$cid.txt");
	if($status == "VIP"){
   $ex = explode("-",$step);
	$xiz = $ex[1];
	$servis = $ex[2];
	$narxi = $ex[3];
	$a = $ex[4];
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
💳 <b>Buyurtma narxi: <del>$a</del> - $narxi $valyuta</b>
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
}
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
$json = json_decode(file_get_contents("https://uzgram.ru/api/v1?key=$api&action=add&service=$servis&link=$url&quantity=$son"),true);
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
'reply_markup'=>$menyus,
]);
deleteFolder("nakrutka/$cid2");
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
'reply_markup'=>$menyus,
]);
deleteFolder("nakrutka/$cid2");
exit();
}



if($text=="$key4" and joinchat($cid)==true){
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
$orderstat=json_decode(file_get_contents("https://uzgram.ru/api/v1?key=$api&action=status&order=$text"),true);
if($orderstat['status'] !=null or $orderstat['remains'] !=null){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"✅ <b>Buyurtma topildi!</b>

• <b>Buyurtma ID raqami:</b> $text
• <b>Buyurtma xolati:</b> ".$orderstat['status']."
<b>• Buyurtma miqdori:</b> ".$orderstat['remains']."",
'parse_mode'=>'html',
'reply_markup'=>$menyu
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

if($text == "$key5" and joinchat($cid)==true){
if($mt == null){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"📝 <b>Murojaat maqsadini yuboring:</b>

<i>Maksimal 24 belgi</i>",
'parse_mode'=>'html',
'reply_markup'=>$back
]);
file_put_contents("step/$cid.step","maqsadi");
exit();
}else{
bot('SendMessage',[
'chat_id'=>$cid,
    'text'=>"📋 <b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
       'reply_markup'=>json_encode([
          'inline_keyboard'=>[          
[['text'=>"$mt",'callback_data'=>"mt"]],           
]
])      
]);
exit();
}
}

if($data == "yordam"){
$mt = file_get_contents("step/$cid2.mt");
if($mt == null){
bot('deleteMessage',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"📝 <b>Murojaat maqsadini yuboring:</b>

<i>Maksimal 24 belgi</i>",
'parse_mode'=>'html',
'reply_markup'=>$back
]);
file_put_contents("step/$cid2.step","maqsadi");
exit();
}else{
bot('deleteMessage',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
    'text'=>"📋 <b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
       'reply_markup'=>json_encode([
          'inline_keyboard'=>[          
[['text'=>"$mt",'callback_data'=>"mt"]],           
]
])      
]);
exit();
}
}

if($data == "mt"){
	$mt = file_get_contents("step/$cid2.mt");
	$mt2 = file_get_contents("step/$cid2.mt2");
	bot('editMessageText',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	'text'=>"$mt
	
$mt2",
   'parse_mode'=>'html',
	'reply_markup'=>json_encode([
   'inline_keyboard'=>[          
[['text'=>"🗑 O'chirib tashlash",'callback_data'=>"delmt"]],   
[['text'=>"◀️ Orqaga",'callback_data'=>"yordam"]],  
]
])      
]);
}

if($data == "delmt"){
	bot('editMessageText',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	'text'=>"<b>Murojaat o'chirib tashlandi.</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
   'inline_keyboard'=>[             
[['text'=>"◀️ Orqaga",'callback_data'=>"yordam"]],  
]
])      
]);
unlink("step/$cid2.mt");
unlink("step/$cid2.mt2");
}

if($step == "maqsadi"){
if(strlen($text)<"24"){
file_put_contents("step/$cid.mt",$text);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"📝 <b>Murojaat matnini yuboring:</b>",
'parse_mode'=>'html',
]);
file_put_contents("step/$cid.step","matni");
exit();
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"📝 <b>Murojaat maqsadini yuboring:</b>

<i>Maksimal 24 belgi</i>",
'parse_mode'=>'html',
]);
exit();
}
}

if($step == "matni"){
file_put_contents("step/$cid.mt2",$text);
bot('SendMessage',[
'chat_id'=>$AlijonovUz,
    'text'=>"<b>Yangi murojaat:

Maqsad:</b> $mt

<b>Matn:</b> $text",
'disable_web_page_preview'=>true,
'parse_mode'=>'html',
       'reply_markup'=>json_encode([
          'inline_keyboard'=>[
            [['text'=>"Javob berish",'callback_data'=>"javob-$cid"]],           
            ]
           ])      
]);
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"✅ <b>Murojaatingiz yuborildi.</b>

Tez orada javob qaytaramiz!",
'parse_mode'=>"html",
'reply_markup'=>$menyu
]);
unlink("step/$cid.step");
exit();
}

if(mb_stripos($data, "javob-")!==false){
  $ex = explode("-",$data);
  $id = $ex[1];
$mt = file_get_contents("step/$id.mt");
if($mt != null){
  bot('deleteMessage',[
    'chat_id'=>$cid2,
    'message_id'=>$mid2,
    ]);
    bot('sendMessage',[
      'chat_id'=>$cid2,
      'text'=>"<b>Javob matnini kiriting:</b>",
      'parse_mode'=>'html',
      'reply_markup'=>$back,
    ]);
    file_put_contents("step/$cid2.step","javob-$id");
    exit();
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$qid,
'text'=>"Ushbu murojaatga javob berilgan yoki murojaat o'chirib tashlangan!",
'show_alert'=>true,
]);
}
}

if(mb_stripos($step, "javob-")!==false){
$ex = explode("-",$step);
$id = $ex[1];
  bot('sendMessage',[
    'chat_id'=>$id,
    'text'=>$text,
    'parse_mode'=>'html',
  'reply_markup'=>json_encode([
          'inline_keyboard'=>[
[['text'=>"📨 Yordam",'callback_data'=>"yordam"]],           
]
])      
]);
  bot('sendMessage',[
    'chat_id'=>$cid,
    'text'=>"<b>Javob yuborildi.</b>",
    'parse_mode'=>'html',
    'reply_markup'=>$menus,
    ]);
    unlink("step/$cid.step");
    unlink("step/$id.mt");
    unlink("step/$id.mt2");
    exit();
}

if($text == "$key6" and joinchat($cid)==true){
$keys[]=['text'=>"📊 Statistika",'callback_data'=>"stat"];
$keys[]=['text'=>"📚 Qo'llanma",'callback_data'=>"qollanma"];
$keys[]=['text'=>"⚠️ Qoidalar",'callback_data'=>"qoida"];
$keys2 = array_chunk($keys, $qator7);
$keys3 = json_encode([
'inline_keyboard'=>$keys2,
]);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Ma'lumot olish uchun, quyidagi tugmalardan foydalaning:</b>",
	'parse_mode'=>'html',
'reply_markup'=>$keys3
]);
exit();
}

if($data == "back"){
$keys[]=['text'=>"📊 Statistika",'callback_data'=>"stat"];
$keys[]=['text'=>"📚 Qo'llanma",'callback_data'=>"qollanma"];
$keys[]=['text'=>"⚠️ Qoidalar",'callback_data'=>"qoida"];
$keys2 = array_chunk($keys, $qator7);
$keys3 = json_encode([
'inline_keyboard'=>$keys2,
]);
        bot('deleteMessage',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
]);
		bot('SendMessage',[
	'chat_id'=>$cid2,
	'text'=>"<b>Ma'lumot olish uchun, quyidagi tugmalardan foydalaning:</b>",
	'parse_mode'=>'html',
'reply_markup'=>$keys3
]);
exit();
}

if($data == "stat"){
$baza = file_get_contents("azo.dat");
$us = substr_count($baza,"\n");
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
'text'=>"📊 <b>Bot foydalanuvchilari soni: $us ta</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"back"]],
]
]),
]);
}

	if($data == "qollanma"){
		if($qollanma == null){
			bot('answerCallbackQuery',[
			'callback_query_id'=>$qid,
			'text'=>"Qo'shilmadi!",
			'show_alert'=>true,
			]);
		}else{
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
		'text'=>"$qollanma",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"back"]],
]
]),
]);
}
}

if($data == "qoida"){
	if($qoida == null){
		bot('answerCallbackQuery',[
		'callback_query_id'=>$qid,
		'text'=>"Qo'shilmadi!",
		'show_alert'=>true,
		]);
		}else{
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
		'text'=>"$qoida",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"back"]],
]
]),
]);
}
}

//<----- Admin Panel ------>

if($text == "🗄 Boshqarish"){
	if(in_array($cid,$admin)){
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
if(in_array($cid,$admin)){
	$kun = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kunlik WHERE useri = $bot"))['kun'];
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

➕ Muddatni uzaytirish uchun @RixBuilderBot ga o'ting!</b>

<i>Diqqat Muddatni faqatgina asosiy admin uzaytirishi mumkin!</i>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"Yangilash",'callback_data'=>"update"]],
[['text'=>"@RixBuilderBot",'url'=>"https://t.me/RixBuilderBot"]],
]
])
]);
exit();
}
}

if($data == "update"){
$kun = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kunlik WHERE useri = $bot"))['kun'];
$times = "$sana — $soat";
$b_time = explode(" — ",$times)[1];
$s_time = explode(":",$b_time)[0]*60;
$m_time = explode(":",$b_time)[1];
$minutes = $s_time + $m_time;
$minus = 24*60;
$qoldi = ($minus - $minutes)*60;
$hours = str_pad(floor($qoldi / (60*60)), 2, '0', STR_PAD_LEFT);
$minutes = str_pad(floor(($qoldi - $hours*60*60)/60), 2, '0', STR_PAD_LEFT);
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
		'text'=>"⏱ <b>$kun kun, $hours soat, $minutes daqiqadan so'ng bot uyqu rejimiga o'tkaziladi.

➕ Muddatni uzaytirish uchun @RixBuilderBot ga o'ting!</b>

<i>Diqqat Muddatni faqatgina asosiy admin uzaytirishi mumkin!</i>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"Yangilash",'callback_data'=>"update"]],
[['text'=>"@RixBuilderBot",'url'=>"https://t.me/RixBuilderBot"]],
]
])
]);
exit();
}


if($data == "foydalanuvchi"){
$pul = file_get_contents("pul/$saved.txt");
$odam = file_get_contents("odam/$saved.dat");
$status = file_get_contents("status/$saved.txt");
$ban = file_get_contents("ban/$saved.txt");
if($status == "Oddiy"){
	$vip = "💎 VIP ga qo'shish";
}
if($status == "VIP"){
	$vip = "❌ VIP dan olish";
}
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
[['text'=>"$vip",'callback_data'=>"add_vip"]],
[['text'=>"➕ Pul qo'shish",'callback_data'=>"plus"],['text'=>"➖ Pul ayirish",'callback_data'=>"minus"]]
]
])
]);
exit();
}

if($text == "🔎 Foydalanuvchini boshqarish"){
if(in_array($cid,$admin)){
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
if(in_array($cid,$admin)){
if(file_exists("pul/$text.txt")){
file_put_contents("step/alijonov.txt",$text);
$pul = file_get_contents("pul/$text.txt");
$odam = file_get_contents("odam/$text.dat");
$status = file_get_contents("status/$text.txt");
$ban = file_get_contents("ban/$text.txt");
if($status == "Oddiy"){
	$vip = "💎 VIP ga qo'shish";
}
if($status == "VIP"){
	$vip = "❌ VIP dan olish";
}
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
[['text'=>"$vip",'callback_data'=>"add_vip"]],
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
if(in_array($cid,$admin)){
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
		if(in_array($cid,$admin)){
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
if($AlijonovUz != $saved){
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

if($data=="add_vip"){
	$status = file_get_contents("status/$saved.txt");
	if($status == "VIP"){
		file_put_contents("status/$saved.txt",'Oddiy');
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"<b>Foydalanuvchi ($saved) VIP dan olindi!</b>",
'parse_mode'=>"html",
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"◀️ Orqaga",'callback_data'=>"foydalanuvchi"]]
]
])
]);
}else{
	file_put_contents("status/$saved.txt",'VIP');
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"<b>Foydalanuvchi ($saved) VIP ga qo'shildi!</b>",
'parse_mode'=>"html",
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"◀️ Orqaga",'callback_data'=>"foydalanuvchi"]]
]
])
]);
}
}

//xabar
if($text == "✉ Xabar Yuborish"){
if(in_array($cid,$admin)){
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Yuboriladigan xabar turini tanlang;</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"Userga",'callback_data'=>"user"]],
	[['text'=>"Oddiy",'callback_data'=>"send"]],
  [['text'=>"Yopish",'callback_data'=>"boshqarish"]],	
	]
	])
	]);
	exit();
}
}

if($data == "user"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>Foydalanuvchi iD raqamini kiriting:</b>",
'parse_mode'=>'html',
'reply_markup'=>$boshqarish,
]);
file_put_contents("step/$cid2.step",'user');
exit();
}

if($step == "user"){
if(in_array($cid,$admin)){
if(is_numeric($text)=="true"){
file_put_contents("step/alijonov.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Xabaringizni kiriting:</b>",
	'parse_mode'=>'html',
	]);
file_put_contents("step/$cid.step",'xabar');
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

if($step == "xabar"){
if(in_array($cid,$admin)){
	bot('SendMessage',[
	'chat_id'=>$saved,
	'text'=>"$text",
        'parse_mode'=>'html',
'disable_web_page_preview'=>true,

	]);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Xabaringiz yuborildi ✅</b>",
       'parse_mode'=>'html',
        'reply_markup'=>$panel,
	]);
	unlink("step/$cid.step");
	unlink("step/alijonov.txt");
	exit();
}
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
 file_put_contents("step/$cid2.step","send-user");
exit();
}

if($step == "send-user"){
if(in_array($cid,$admin)){
$lich = file_get_contents("azo.dat");
$lichka = explode("\n",$lich);
foreach($lichka as $lichkalar){
$okuser=bot("sendmessage",[
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
'chat_id'=>$cid,
'text'=>"<b>Hammaga yuborildi ✅</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
exit();
}

if($text == "📊 Statistika"){
	if(in_array($cid,$admin)){
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
'text'=>"💡 <b>O'rtacha yuklanish:</b> <code>$ping</code>
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

if($text == "📢 Kanallarni sozlash"){
	if(in_array($cid,$admin)){
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
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
'text'=>"<i>Kanalingiz manzilini yuborishdan avval botni kanalingizga admin qilib olishingiz kerak!</i>

📢 <b>Kerakli kanalni manzilini yuboring:

Namuna:</b> @RixBuilder",
'parse_mode'=>'html',
'reply_markup'=>$boshqarish,
]);
file_put_contents("step/$cid2.step","qo'shish");
exit();
}

if($step == "qo'shish"){
if(in_array($cid,$admin)){
if(isset($text)){		
if(mb_stripos($text, "@")!==false){
if($kanal == null){
file_put_contents("admin/kanal.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$panel
]);
unlink("step/$cid.step");
exit();
}else{
file_put_contents("admin/kanal.txt","$kanal\n$text");
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$panel
]);
unlink("step/$cid.step");
exit();
}
}else{
	bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Qayta urunib ko'ring:</b>",
'parse_mode'=>'html',
]);
exit();
}
}
}
}

if($data == "ochirish"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
'text'=>"<b>O'chirilishi kerak bo'lgan kanalning manzilini yuboring:

Namuna:</b> @RixBuilder",
'parse_mode'=>'html',
'reply_markup'=>$boshqarish,
]);
file_put_contents("step/$cid2.step","Kanal_o'chirish");
exit();
}

if($step == "Kanal_o'chirish"){
if(in_array($cid,$admin)){
if(isset($text)){	
if(mb_stripos($text, "@")!==false){
$files = file_get_contents("admin/kanal.txt");
$file = str_replace("\n".$text."","",$files);
file_put_contents("admin/kanal.txt",$file);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$panel
]);
unlink("step/$cid.step");
exit();
}else{
	bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Qayta urunib ko'ring:</b>",
'parse_mode'=>'html',
]);
exit();
}
}
}
}


if($data == "royxat"){
$soni = substr_count($kanal,"@");
if($kanal == null){
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
       'text'=>"<b>Hech qanday kanallar ulanmagan!</b>",
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
	'text'=>"<i>Kanalingiz manzilini yuborishdan avval botni kanalingizga admin qilib olishingiz kerak!</i>

📢 <b>Kerakli kanalni manzilini yuboring:

Namuna:</b> @RixBuilder",
	'parse_mode'=>'html',
	'reply_markup'=>$boshqarish,
	]);
	file_put_contents("step/$cid2.step","promokod");
	exit();
}

if(($step == "promokod") and (in_array($cid,$admin))){
if(mb_stripos($text,"@")!==false){
$get = bot('getChat',[
'chat_id'=>$text
]);
$types = $get->result->type;
$ch_name = $get->result->title;
$ch_user = $get->result->username;
if(getAdmin($ch_user)== true){
file_put_contents("admin/kanal2.txt","@$ch_user");
file_put_contents("tugma/key8.txt","🎫 Promokod");
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Qabul qilindi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel,
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


if($text == "📋 Adminlar"){
if(in_array($cid,$admin)){
	if($cid == $AlijonovUz){
	bot('SendMessage',[
	'chat_id'=>$AlijonovUz,
	'text'=>"<b>Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
   [['text'=>"➕ Yangi admin qo'shish",'callback_data'=>"add"]],
   [['text'=>"📑 Ro'yxat",'callback_data'=>"list"],['text'=>"🗑 O'chirish",'callback_data'=>"remove"]],
	[['text'=>"Yopish",'callback_data'=>"boshqarish"]]
	]
	])
	]);
	exit();
}else{	
bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
   [['text'=>"📑 Ro'yxat",'callback_data'=>"list"]],
[['text'=>"Yopish",'callback_data'=>"boshqarish"]]
	]
	])
	]);
	exit();
}
}
}

if($data == "admins"){
if($cid2 == $AlijonovUz){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);	
bot('SendMessage',[
	'chat_id'=>$AlijonovUz,
	'text'=>"<b>Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
   [['text'=>"➕ Yangi admin qo'shish",'callback_data'=>"add"]],
   [['text'=>"📑 Ro'yxat",'callback_data'=>"list"],['text'=>"🗑 O'chirish",'callback_data'=>"remove"]],
	[['text'=>"Yopish",'callback_data'=>"boshqarish"]]
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
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
   [['text'=>"📑 Ro'yxat",'callback_data'=>"list"]],
[['text'=>"Yopish",'callback_data'=>"boshqarish"]]
	]
	])
	]);
	exit();
}
}

if($data == "list"){
	$admins = file_get_contents("admin/admins.txt");
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
       'text'=>"<b>👮 Adminlar ro'yxati:</b>

$admins",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"admins"]],
]
])
]);
}

if($data == "add"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$AlijonovUz,
'text'=>"*Kerakli iD raqamni kiriting:*",
'parse_mode'=>'MarkDown',
'reply_markup'=>$boshqarish
]);
file_put_contents("step/$cid2.step",'add-admin');
exit();
}
if($step == "add-admin" and $cid == $AlijonovUz){
if(is_numeric($text)=="true"){
if($text != $AlijonovUz){
file_put_contents("admin/admins.txt","$admins\n$text");
bot('SendMessage',[
'chat_id'=>$AlijonovUz,
'text'=>"✅ *$text* endi botda admin.",
'parse_mode'=>'MarkDown',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
exit();
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Kerakli iD raqamni kiriting:</b>",
'parse_mode'=>'html',
]);
exit();
}
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Kerakli iD raqamni kiriting:</b>",
'parse_mode'=>'html',
]);
exit();
}
}

if($data == "remove"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$AlijonovUz,
'text'=>"<b>Kerakli iD raqamni kiriting:</b>",
'parse_mode'=>'html',
'reply_markup'=>$boshqarish
]);
file_put_contents("step/$cid2.step",'remove-admin');
exit();
}
if($step == "remove-admin" and $cid == $AlijonovUz){
if(is_numeric($text)=="true"){
if($text != $AlijonovUz){
$files = file_get_contents("admin/admins.txt");
$file = str_replace("\n".$text."","",$files);
file_put_contents("admin/admins.txt",$file);
bot('SendMessage',[
'chat_id'=>$AlijonovUz,
'text'=>"✅ *$text* endi botda admin emas.",
'parse_mode'=>'MarkDown',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
exit();
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Kerakli iD raqamni kiriting:</b>",
'parse_mode'=>'html',
]);
exit();
}
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Kerakli iD raqamni kiriting:</b>",
'parse_mode'=>'html',
]);
exit();
}
}

if($text == "🎟 Promokod"){
if(in_array($cid,$admin)){
if($promo != null){
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Promokod uchun nom yuboring:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$boshqarish,
	]);
	file_put_contents("step/$cid.step",'pro');
	exit();
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Promokod yuboriladigan kanal ulanmagan!</b>",
'parse_mode'=>'html',
]);
exit();
}
}
}

if($step == "pro"){
		if(in_array($cid,$admin)){
			if(isset($text)){
	file_put_contents("step/kod.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Qabul qilindi.</b>

Endi esa, promokod qiymatini yuboring:",
	'parse_mode'=>'html',
	]);
	file_put_contents("step/$cid.step",'Next_Promo');
	exit();
}
}
}

if($step == "Next_Promo"){
		if(in_array($cid,$admin)){
if(is_numeric($text)=="true"){
	file_put_contents("step/money.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Tayyor. Promokod $promo kanaliga yuborildi.</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$panel,
	]);
$msg = bot('SendMessage',[
	'chat_id'=>$promo,
	'text'=>"🎫 — <code>$kod</code>
💰 — <b>$text $valyuta</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➡️ $bot",'url'=>"https://t.me/$bot"]]
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

if($text == "🎁 Kunlik bonus sozlamalari"){
	if(in_array($cid,$admin)){
$status = file_get_contents("bonus/status.txt");
$bonus = file_get_contents("bonus/bonus.txt");
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Hozirgi holat:
	
1. Kunlik bonus miqdori:</b> $bonus $valyuta
<b>2. Status:</b> $status",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"🎁 Kunlik bonus miqdorini sozlash",'callback_data'=>"kmiqdor"]],
[['text'=>"💡 Statusni o'zgartirish",'callback_data'=>"kstatus"]],
[['text'=>"Yopish",'callback_data'=>"boshqarish"]]
]
])
]);
exit();
}
}

if($data == "kbonus"){
$status = file_get_contents("bonus/status.txt");
$bonus = file_get_contents("bonus/bonus.txt");
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
	'text'=>"<b>Hozirgi holat:
	
1. Kunlik bonus miqdori:</b> $bonus $valyuta
<b>2. Status:</b> $status",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"🎁 Kunlik bonus miqdorini sozlash",'callback_data'=>"kmiqdor"]],
[['text'=>"💡 Statusni o'zgartirish",'callback_data'=>"kstatus"]],
[['text'=>"Yopish",'callback_data'=>"boshqarish"]]
]
])
]);
exit();
}


if($data == "kmiqdor"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
	'text'=>"<b>Yangi kunlik bonus miqdorini yuboring:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$boshqarish,
	]);
	file_put_contents("step/$cid2.step",'kmiqdor');
	exit();
}

if($step == "kmiqdor"){
	if(in_array($cid,$admin)){
	if(is_numeric($text)=="true"){
	file_put_contents("bonus/bonus.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$panel,
	]);
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

if($data == "kstatus"){
$status = file_get_contents("bonus/status.txt");
	if($status == "Yoqilgan"){
file_put_contents("bonus/status.txt","O'chirilgan");
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
       'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"kbonus"]],
]
])
]);
}else{
file_put_contents("bonus/status.txt","Yoqilgan");
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
       'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"kbonus"]],
]
])
]);
}
}


if($text == "🤖 Bot holati"){
	if(in_array($cid,$admin)){
	if($holat == "Yoqilgan"){
		$xolat = "O'chirish";
	}
	if($holat == "O'chirilgan"){
		$xolat = "Yoqish";
	}
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Hozirgi holat:</b> $holat",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"$xolat",'callback_data'=>"bot"]],
[['text'=>"Yopish",'callback_data'=>"boshqarish"]]
]
])
]);
exit();
}
}

if($data == "xolat"){
	if($holat == "Yoqilgan"){
		$xolat = "O'chirish";
	}
	if($holat == "O'chirilgan"){
		$xolat = "Yoqish";
	}
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
	'text'=>"<b>Hozirgi holat:</b> $holat",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"$xolat",'callback_data'=>"bot"]],
[['text'=>"Yopish",'callback_data'=>"boshqarish"]]
]
])
]);
exit();
}

if($data == "bot"){
if($holat == "Yoqilgan"){
file_put_contents("admin/holat.txt","O'chirilgan");
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
       'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"xolat"]],
]
])
]);
}else{
file_put_contents("admin/holat.txt","Yoqilgan");
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
       'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"xolat"]],
]
])
]);
}
}

if($text == "⭐️ Bot dizayni"){
	if(in_array($cid,$admin)){
		bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"⭐️ <b>Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"🎛 Tugma qatorlari",'callback_data'=>"qatorlar"]],
[['text'=>"Yopish",'callback_data'=>"boshqarish"]]
]
])
]);
exit();
}
}

if($data == "dizayn"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
	'text'=>"⭐️ <b>Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"🎛 Tugma qatorlari",'callback_data'=>"qatorlar"]],
[['text'=>"Yopish",'callback_data'=>"boshqarish"]]
]
])
]);
exit();
}

if($data == "qatorlar"){
	bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
       'text'=>"1️⃣ <b>Buyurtma bo'limlar qatori:</b> $qator1 qator
2️⃣ <b>Ichki bo'limlar qatori:</b> $qator2 qator
3️⃣ <b>Xizmatlar ro'yxati qatori:</b> $qator3 qator
4️⃣ <b>To'lov tizimlari ro'yxati qatori:</b> $qator4 qator
5⃣ <b>Kabinet bo'limlar qatori:</b> $qator5 qator
6⃣ <b>Pul ishlash bo'limlar qatori:</b> $qator6 qator
7⃣ <b>Bot haqida bo'limlar qatori:</b> $qator7 qator",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"1️⃣",'callback_data'=>"qator-qator1"],['text'=>"2️⃣",'callback_data'=>"qator-qator2"],['text'=>"3️⃣",'callback_data'=>"qator-qator3"],['text'=>"4️⃣",'callback_data'=>"qator-qator4"]],
[['text'=>"5⃣",'callback_data'=>"qator-qator5"],['text'=>"6⃣",'callback_data'=>"qator-qator6"],['text'=>"7⃣",'callback_data'=>"qator-qator7"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"dizayn"]],
]
])
]);
}

if(mb_stripos($data, "qator-")!==false){
	$ex = explode("-",$data);
	$qator = $ex[1];
	bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
       'text'=>"<b>Yangi qiymatni tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"1",'callback_data'=>"qiymat-$qator-1"],['text'=>"2",'callback_data'=>"qiymat-$qator-2"],['text'=>"3",'callback_data'=>"qiymat-$qator-3"]],
[['text'=>"Orqaga",'callback_data'=>"qatorlar"]],
]
])
]);
}

if(mb_stripos($data, "qiymat-")!==false){
	$ex = explode("-",$data);
	$qator = $ex[1];
	$qiymat = $ex[2];
	file_put_contents("tugma/$qator.txt",$qiymat);
	bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
       'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"Orqaga",'callback_data'=>"qatorlar"]],
]
])
]);
}

if($text == "⚙ Asosiy sozlamalar"){
		if(in_array($cid,$admin)){
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
if(in_array($cid,$admin)){
if($api == null){
bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"🔑 <b>Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"➕ Yangi API qo'shish",'callback_data'=>"api"]],
[['text'=>"Yopish",'callback_data'=>"boshqarish"]]
	]
	])
	]);
	exit();
}else{
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Hozirgi API kalit:</b> 
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
}

if($data == "api1"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
'text'=>"<b>Hozirgi API kalit:</b> 
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
	'text'=>"<b>API kalitni yuboring:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$boshqarish,
	]);
	file_put_contents("step/$cid2.step",'api');
	exit();
}

if($step == "api"){
		if(in_array($cid,$admin)){
	if(isset($text)){
	file_put_contents("admin/api.txt",$text);
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
$json = json_decode(file_get_contents("https://uzgram.ru/api/v1?key=$api&action=balance"),true);
$balance = $json['balance'];
$currency = $json['currency'];
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
       'text'=>"<b>💵 API balansi:</b> $balance $currency",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"api1"]],
]
])
]);
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
		if(in_array($cid,$admin)){
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
}

if($step == "turi"){
		if(in_array($cid,$admin)){
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
		if(in_array($cid,$admin)){
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
		if(in_array($cid,$admin)){
	if(isset($text)){
file_put_contents("tizim/$test/addition.txt","$addition\n$text");
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
	if(in_array($cid,$admin)){
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
[['text'=>"VIP narxini o'zgartirish",'callback_data'=>"editXizmat-vip"]],
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
	if(in_array($cid,$admin)){
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
	if(in_array($cid,$admin)){
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
//if(mb_stripos($test, "test-")!==false){
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
	if(in_array($cid,$admin)){
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
	if(in_array($cid,$admin)){
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
if($bolim == null){
bot('answerCallbackQuery',[
		'callback_query_id'=>$qid,
		'text'=>"Hech narsa topilmadi!",
		'show_alert'=>true,
		]);
}else{
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
        'text'=>"<b>Quyidagilardan birini tanlang:</b>

<i>Diqqat, bir bosish orqali tanlangan xizmat turi (yoki bo'lim) ni o'chirib yuborishingiz mumkin!</i>",
'parse_mode'=>'html',
'reply_markup'=>$delFol
]);
}
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
 'text'=>"<b>O'chirish yakunlandi!</b>",
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
		'text'=>"Hech narsa topilmadi!",
		'show_alert'=>true,
		]);
	}else{
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
'text'=>"<b>Quyidagilardan birini tanlang:</b>

<i>Diqqat, bir bosish orqali tanlangan xizmat turi (yoki bo'lim) ni o'chirib yuborishingiz mumkin!</i>",
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
       'text'=>"<b>O'chirish yakunlandi!</b>",
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
		'text'=>"Hech narsa topilmadi!",
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
    'text'=>"<b>Quyidagilardan birini tanlang:</b>

<i>Diqqat, bir bosish orqali tanlangan xizmat turi (yoki bo'lim) ni o'chirib yuborishingiz mumkin!</i>",
'parse_mode'=>'html',
'reply_markup'=>$delsXiz
]);
}
}

if(mb_stripos($data, "delmat-")!==false){
        $xizmat = explode("-",$data)[1];
	$ichki = explode("-",$data)[2];
	$bolim = explode("-",$data)[3];
	$del = file_get_contents("nakrutka/$bolim/$ichki/xizmat.txt");
   $k = str_replace("\n".$xizmat."","",$del);
   file_put_contents("nakrutka/$bolim/$ichki/xizmat.txt",$k);
   deleteFolder("nakrutka/$bolim/$ichki/$xizmat");
     bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
]);
   bot('sendMessage',[
   'chat_id'=>$cid2,
       'text'=>"<b>O'chirish yakunlandi!</b>",
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
	if(in_array($cid,$admin)){
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
	if(in_array($cid,$admin)){
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
if($bolim == null){
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
'reply_markup'=>$adds,
]);
}
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
   'reply_markup'=>$addz
]);
}
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
	if(in_array($cid,$admin)){
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
	if(in_array($cid,$admin)){
		if(isset($text)){
		if(is_numeric($text)==true){
			file_put_contents("nakrutka/$test/$test1/$test2/id.txt",$text);
		bot('SendMessage',[
		'chat_id'=>$cid,
		'text'=>"<b>$text</b> qabul qilindi.

Ushbu xizmat doirasida 1 ta foydalanuvchi narxini kiriting:",
		'parse_mode'=>'html',	
]);
file_put_contents("step/$cid.step",'VIP-uchun');
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

if($step == "VIP-uchun"){
	if(in_array($cid,$admin)){
		if(isset($text)){
		if(is_numeric($text)==true){
			file_put_contents("nakrutka/$test/$test1/$test2/narxi.txt",$text);
		bot('SendMessage',[
		'chat_id'=>$cid,
		'text'=>"<b>$text</b> qabul qilindi.

Ushbu xizmat doirasida VIP uchun 1 ta foydalanuvchi narxini kiriting:",
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
	if(in_array($cid,$admin)){
		if(isset($text)){
		if(is_numeric($text)==true){
			file_put_contents("nakrutka/$test/$test1/$test2/vip.txt",$text);
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
	if(in_array($cid,$admin)){
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
	if(in_array($cid,$admin)){
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
	if(in_array($cid,$admin)){
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
		if(in_array($cid,$admin)){
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>*️⃣  Birlamchi sozlamalar bo'limidasiz.</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📋 Hozirgi holatni ko'rish",'callback_data'=>"holat"]],
[['text'=>"💶 Valyuta",'callback_data'=>"valyuta"],['text'=>"💸 Taklif narxi",'callback_data'=>"narx"]],
[['text'=>"🔁 Pul o'tkazish narxi",'callback_data'=>"transfer"],['text'=>"💎 VIP narxi",'callback_data'=>"vnarx"]],
[['text'=>"🔗 Taklif bo'limi rasmini o'zgartirish",'callback_data'=>"rasm"]],
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
[['text'=>"🔁 Pul o'tkazish narxi",'callback_data'=>"transfer"],['text'=>"💎 VIP narxi",'callback_data'=>"vnarx"]],
[['text'=>"🔗 Taklif bo'limi rasmini o'zgartirish",'callback_data'=>"rasm"]],
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
3. VIP narxi - $narx $valyuta
4. Pul o'tkazish narxi: $transfer $valyuta
5. Admin useri: $user</i>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"birlamchi"]],
]
])
]);
}

if($data == "rasm"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
	'text'=>"<b>Kerakli surat havolasini yuboring:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$boshqarish,
	]);
	file_put_contents("step/$cid2.step",'rasm');
	exit();
}

if($step == "rasm"){
	if(in_array($cid,$admin)){
	if(isset($text)){
file_put_contents("matn/photo.txt",$text);
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
		if(in_array($cid,$admin)){
	if(isset($text)){
	file_put_contents("admin/valyuta.txt",$text);
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
		if(in_array($cid,$admin)){
	if(isset($text)){
	file_put_contents("admin/referal.txt",$text);
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

if($data == "vnarx"){
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
	file_put_contents("step/$cid2.step",'vnarx');
	exit();
}

if($step == "vnarx"){
		if(in_array($cid,$admin)){
	if(isset($text)){
	file_put_contents("admin/vip.txt",$text);
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

if($data == "transfer"){
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
	file_put_contents("step/$cid2.step",'transfer');
	exit();
}

if($step == "transfer"){
		if(in_array($cid,$admin)){
	if(isset($text)){
	file_put_contents("admin/transfer.txt",$text);
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
		if(in_array($cid,$admin)){
	if(isset($text)){
        file_put_contents("admin/user.txt",$text);
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

if($text == "📃 Matnlar"){
		if(in_array($cid,$admin)){
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
		'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"Boshlang'ich matni",'callback_data'=>"matn1"]],
[['text'=>"Qo'llanma",'callback_data'=>"matn2"]],
[['text'=>"Qoidalar",'callback_data'=>"matn3"]],
[['text'=>"Taklif matni",'callback_data'=>"matn4"]],
[['text'=>"🔖 Homiy matni",'callback_data'=>"matn5"]],
[['text'=>"Yopish",'callback_data'=>"boshqarish"]]
]
])
]);
exit();
}
}

if($data == "matn1"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
	'text'=>"<b>Boshlang'ich matnini yuboring:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$boshqarish,
	]);
	file_put_contents("step/$cid2.step",'matn1');
	exit();
}

if($step == "matn1"){
		if(in_array($cid,$admin)){
	if(isset($text)){
        file_put_contents("matn/start.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$panel,
	]);
	unlink("step/$cid.step");
	exit();
}
}
}

if($data == "matn2"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
	'text'=>"<b>Qo'llanma matnini yuboring:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$boshqarish,
	]);
	file_put_contents("step/$cid2.step",'matn2');
	exit();
}

if($step == "matn2"){
		if(in_array($cid,$admin)){
	if(isset($text)){
file_put_contents("matn/qollanma.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$panel,
	]);
	unlink("step/$cid.step");
	exit();
}
}
}

if($data == "matn3"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
	'text'=>"<b>Qoida matnini yuboring:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$boshqarish,
	]);
	file_put_contents("step/$cid2.step",'matn3');
	exit();
}

if($step == "matn3"){
		if(in_array($cid,$admin)){
	if(isset($text)){
	file_put_contents("matn/qoida.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$panel,
	]);
	unlink("step/$cid.step");
	exit();
}
}
}

if($data == "matn4"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
	'text'=>"<b>Taklif matnini yuboring:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$boshqarish,
	]);
	file_put_contents("step/$cid2.step",'matn4');
	exit();
}

if($step == "matn4"){
		if(in_array($cid,$admin)){
	if(isset($text)){
        file_put_contents("matn/taklif.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$panel,
	]);
	unlink("step/$cid.step");
	exit();
}
}
}

if($data == "matn5"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
	'text'=>"<b>Homiy matnini yuboring:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$boshqarish,
	]);
	file_put_contents("step/$cid2.step",'matn5');
	exit();
}

if($step == "matn5"){
		if(in_array($cid,$admin)){
	if(isset($text)){
        file_put_contents("matn/homiy.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$panel,
	]);
	unlink("step/$cid.step");
	exit();
}
}
}

if($text == "🎛 Tugmalar"){
		if(in_array($cid,$admin)){
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
		'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🖥 Asosiy menyudagi tugmalar",'callback_data'=>"asosiy"]],
[['text'=>"💵 Pul ishlash bo'limi tugmalari",'callback_data'=>"pul_ishlash"]],
[['text'=>"👔 Kabinet bo'limi tugmalari",'callback_data'=>"hisobim"]],
[['text'=>"⚠️ O'z holiga qaytarish",'callback_data'=>"reset"]],
[['text'=>"Yopish",'callback_data'=>"boshqarish"]]
]
])
]);
exit();
}
}

if($data == "tugmalar"){
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
[['text'=>"🖥 Asosiy menyudagi tugmalar",'callback_data'=>"asosiy"]],
[['text'=>"💵 Pul ishlash bo'limi tugmalari",'callback_data'=>"pul_ishlash"]],
[['text'=>"👔 Kabinet bo'limi tugmalari",'callback_data'=>"hisobim"]],
[['text'=>"⚠️ O'z holiga qaytarish",'callback_data'=>"reset"]],
[['text'=>"Yopish",'callback_data'=>"boshqarish"]]
]
])
]);
exit();
}


if($data == "reset"){
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
	'text'=>"<b>Barcha tahrirlangan tugmalar bilan bog'liq sozlamalar o'chirib yuboriladi va birlamchi sozlamalar o'rnatiladi.</b>

<i>Ushbu jarayonni davom ettirsangiz, avvalgi sozlamalarni tiklay olmaysiz, rozimisiz?</i>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"Roziman",'callback_data'=>'roziman']],
	[['text'=>"◀️ Orqaga",'callback_data'=>"tugmalar"]],
]
])
]);
}

if($data == "roziman"){
	bot('editMessageText',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	'text'=>"<b>Tugma sozlamalari o'chirilib, birlamchi sozlamalar o'rnatildi.</b>",
	'parse_mode'=>'html',
		'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"◀️ Orqaga",'callback_data'=>"tugmalar"]],
]
])
]);
deleteFolder("tugma");
}

if($data == "asosiy"){
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
	'text'=>"<b>Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
			'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Buyurtma berish",'callback_data'=>"key1"]],
[['text'=>"💵 Pul yig'ish",'callback_data'=>"key2"],['text'=>"👔 Kabinet",'callback_data'=>"key3"]],
[['text'=>"📊 Buyurtmani kuzatish",'callback_data'=>"key4"]],
[['text'=>"📨 Yordam",'callback_data'=>"key5"],['text'=>"📚 Bot haqida",'callback_data'=>"key6"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"tugmalar"]]
]
])
]);
}

if($data == "pul_ishlash"){
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
	'text'=>"<b>Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
			'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔗 Takliflar",'callback_data'=>"key7"]],
[['text'=>"🎫 Promokod",'callback_data'=>"key8"]],
[['text'=>"🎁 Kunlik bonus",'callback_data'=>"key9"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"tugmalar"]]
]
])
]);
}

if($data == "hisobim"){
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
	'text'=>"<b>Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
			'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"💳 Pul kiritish",'callback_data'=>"key10"]],
[['text'=>"🔁 Pul o'tkazish",'callback_data'=>"key11"]],
[['text'=>"💎 VIP ni sotib olish",'callback_data'=>"key12"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"tugmalar"]]
]
])
]);
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
		if(in_array($cid,$admin)){
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
		if(in_array($cid,$admin)){
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
		if(in_array($cid,$admin)){
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
		if(in_array($cid,$admin)){
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
		if(in_array($cid,$admin)){
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

if($data == "key6"){
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
	file_put_contents("step/$cid2.step",'key6');
	exit();
}

if($step == "key6"){
		if(in_array($cid,$admin)){
if(isset($text)){
	file_put_contents("tugma/key6.txt",$text);
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

if($data == "key7"){
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
	file_put_contents("step/$cid2.step",'key7');
	exit();
}

if($step == "key7"){
		if(in_array($cid,$admin)){
if(isset($text)){
	file_put_contents("tugma/key7.txt",$text);
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

if($data == "key8"){
	if(file_exists("tugma/key8.txt")){
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
	'text'=>"<b>Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
			'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📝 Tahrirlash",'callback_data'=>"keys8"]],
[['text'=>"🗑 O'chirish",'callback_data'=>"delete_key8"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"pul_ishlash"]]
]
])
]);
}else{
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
	'text'=>"<b>Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
			'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Qo'shish",'callback_data'=>"keys8"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"pul_ishlash"]]
]
])
]);
}
}

if($data == "keys8"){
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
	file_put_contents("step/$cid2.step",'key8');
	exit();
}

if($step == "key8"){
if(in_array($cid,$admin)){
if(isset($text)){
	file_put_contents("tugma/key8.txt",$text);
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

if($data == "delete_key8"){
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
	'text'=>"$key8 <b>ni o'chirish yakunlandi.</b>",
	'parse_mode'=>'html',
			'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"pul_ishlash"]]
]
])
]);
unlink("tugma/key8.txt");
}

if($data == "key9"){
	if(file_exists("tugma/key9.txt")){
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
	'text'=>"<b>Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
			'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📝 Tahrirlash",'callback_data'=>"keys9"]],
[['text'=>"🗑 O'chirish",'callback_data'=>"delete_key9"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"pul_ishlash"]]
]
])
]);
}else{
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
	'text'=>"<b>Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
			'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Qo'shish",'callback_data'=>"keys9"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"pul_ishlash"]]
]
])
]);
}
}

if($data == "keys9"){
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
	file_put_contents("step/$cid2.step",'key9');
	exit();
}

if($step == "key9"){
if(in_array($cid,$admin)){
if(isset($text)){
	file_put_contents("tugma/key9.txt",$text);
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

if($data == "delete_key9"){
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
	'text'=>"$key9 <b>ni o'chirish yakunlandi.</b>",
	'parse_mode'=>'html',
			'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"pul_ishlash"]]
]
])
]);
unlink("tugma/key9.txt");
}

if($data == "key10"){
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
	file_put_contents("step/$cid2.step",'key10');
	exit();
}

if($step == "key10"){
		if(in_array($cid,$admin)){
if(isset($text)){
	file_put_contents("tugma/key10.txt",$text);
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

if($data == "key11"){
	if(file_exists("tugma/key11.txt")){
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
	'text'=>"<b>Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
			'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📝 Tahrirlash",'callback_data'=>"keys11"]],
[['text'=>"🗑 O'chirish",'callback_data'=>"delete_key11"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"hisobim"]]
]
])
]);
}else{
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
	'text'=>"<b>Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
			'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Qo'shish",'callback_data'=>"keys11"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"hisobim"]]
]
])
]);
}
}

if($data == "keys11"){
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
	file_put_contents("step/$cid2.step",'key11');
	exit();
}

if($step == "key11"){
if(in_array($cid,$admin)){
if(isset($text)){
	file_put_contents("tugma/key11.txt",$text);
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

if($data == "delete_key11"){
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
	'text'=>"$key11 <b>ni o'chirish yakunlandi.</b>",
	'parse_mode'=>'html',
			'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"hisobim"]]
]
])
]);
unlink("tugma/key11.txt");
}

if($data == "key12"){
	if(file_exists("tugma/key12.txt")){
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
	'text'=>"<b>Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
			'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📝 Tahrirlash",'callback_data'=>"keys12"]],
[['text'=>"🗑 O'chirish",'callback_data'=>"delete_key12"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"hisobim"]]
]
])
]);
}else{
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
	'text'=>"<b>Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
			'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Qo'shish",'callback_data'=>"keys12"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"hisobim"]]
]
])
]);
}
}

if($data == "keys12"){
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
	file_put_contents("step/$cid2.step",'key12');
	exit();
}

if($step == "key12"){
if(in_array($cid,$admin)){
if(isset($text)){
	file_put_contents("tugma/key12.txt",$text);
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

if($data == "delete_key12"){
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
	'text'=>"$key12 <b>ni o'chirish yakunlandi.</b>",
	'parse_mode'=>'html',
			'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"hisobim"]]
]
])
]);
unlink("tugma/key12.txt");
}

if(isset($message)){		
		bot('SendMessage',[
		'chat_id'=>$cid,
		'text'=>"🖥",
		'parse_mode'=>'html',
		'reply_markup'=>$menyu,
		]);
}

?>