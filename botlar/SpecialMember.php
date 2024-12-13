<?php
ob_start();
define('API_KEY',"LITE_TOKEN");
$builder24 = "LITE_ID";
$admins=file_get_contents("admin/admins.txt");
$admin = explode("\n", $admins);
array_push($admin,$builder24);
$user = file_get_contents("admin/user.txt");
$api = file_get_contents("admin/api.txt");
$bot = bot('getme',['bot'])->result->username;
$soat = date('H:i');
$clock = date('H:i:s');
$sana = date("d.m.Y");

function getAdmin($chat){
$url = "https://api.telegram.org/bot".API_KEY."/getChatAdministrators?chat_id=@".$chat;
$result = file_get_contents($url);
$result = json_decode ($result);
return $result->ok;
}

function get($h){
return file_get_contents($h);
}

function put($h,$r){
file_put_contents($h,$r);
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

function sms($id,$tx,$m){
return bot('sendMessage',[
'chat_id'=>$id,
'text'=>$tx,
'parse_mode'=>"HTML",
'reply_markup'=>$m,
]);
}

function joinchat($id){
global $mid;
$array = array("inline_keyboard");
$get = file_get_contents("admin/kanal.txt");
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
$array['inline_keyboard']["$i"][0]['callback_data'] = "result";
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

$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
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

$callback = $update->callback_query;
$data = $update->callback_query->data;
$qid = $update->callback_query->id;
$id = $update->inline_query->id;
$query = $update->inline_query->query;
$query_id = $update->inline_query->from->id;
$cid2 = $update->callback_query->message->chat->id;
$mid2 = $update->callback_query->message->message_id;
$callfrid = $update->callback_query->from->id;
$callname = $update->callback_query->from->first_name;
$calluser = $update->callback_query->from->username;
$surname = $update->callback_query->from->last_name;
$about = $update->callback_query->from->about;
$nameuz = "<a href='tg://user?id=$callfrid'>$callname $surname</a>";

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
if(!file_exists("tugma/key8.txt")){  
file_put_contents("tugma/key8.txt","🎁 Kunlik bonus");
}
if(!file_exists("tugma/key9.txt")){  
file_put_contents("tugma/key9.txt","🎫 Promokod");
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
if(file_put_contents("tugma/qator3.txt",'5'));
}
if(file_get_contents("tugma/qator4.txt")){
}else{
if(file_put_contents("tugma/qator4.txt",'2'));
}

if(file_get_contents("admin/valyuta.txt")){
}else{
if(file_put_contents("admin/valyuta.txt","so'm"));
}
if(file_get_contents("admin/foiz.txt")){
}else{
if(file_put_contents("admin/foiz.txt","10"));
}
if(file_get_contents("admin/foiz2.txt")){
}else{
if(file_put_contents("admin/foiz2.txt","5"));
}
if(file_get_contents("admin/referal.txt")){
}else{
if(file_put_contents("admin/referal.txt",'5'));
}
if(file_get_contents("admin/transfer.txt")){
}else{
if(file_put_contents("admin/transfer.txt",'0'));
}
if(file_get_contents("admin/admins.txt")){
}else{
if(file_put_contents("admin/admins.txt","$builder24"));
}
if(file_get_contents("admin/vip.txt")){
}else{
if(file_put_contents("admin/vip.txt","15000"));
}
if(!file_exists("bonus/bonmiq.txt")){  
file_put_contents("bonus/bonmiq.txt","100");
}
if(!file_exists("bonus/bonnom.txt")){  
file_put_contents("bonus/bonnom.txt","");
}

if(file_get_contents("matn/start.txt")){
}else{
if(file_put_contents("matn/start.txt","<b>🖥 Asosiy menyudasiz</b>"));
}
if(file_get_contents("matn/qoida.txt")){
}else{
if(file_put_contents("matn/qoida.txt",""));
}
if(file_get_contents("matn/qollanma.txt")){
}else{
if(file_put_contents("matn/qollanma.txt",""));
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

$qator1=file_get_contents("tugma/qator1.txt");
$qator2=file_get_contents("tugma/qator2.txt");
$qator3=file_get_contents("tugma/qator3.txt");
$qator4=file_get_contents("tugma/qator4.txt");

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
$tavsif = file_get_contents("nakrutka/$test/$test1/$test2/tavsif.txt");

$by = file_get_contents("pul/$cid.nak");
$by = file_get_contents("pul/$cid2.nak");
$pul = file_get_contents("pul/$cid.txt");
$pul = file_get_contents("pul/$cid2.txt");
$oplata=file_get_contents("oplata/$cid.txt");
$oplata=file_get_contents("oplata/$cid2.txt");
$odam = file_get_contents("odam/$cid.dat");
$odam = file_get_contents("odam/$cid2.dat");
$status=file_get_contents("status/$cid.txt");
$status=file_get_contents("status/$cid2.txt");
$ban = file_get_contents("ban/$cid.txt");
$saved=file_get_contents("step/alijonov.txt");
$narx = file_get_contents("admin/vip.txt");
$kanal = file_get_contents("admin/kanal.txt");
$transfer = file_get_contents("admin/transfer.txt");
$start = file_get_contents("matn/start.txt");
$sayt = file_get_contents("admin/sayt.txt");
$valyuta = file_get_contents("admin/valyuta.txt");
$referal = file_get_contents("admin/referal.txt");
$bonus=file_get_contents("bonus/bonmiq.txt");
$bonusnom=file_get_contents("bonus/bonnom.txt");
if(!file_exists("buyurtma/id.txt")){
file_put_contents("buyurtma/id.txt","0");
}
$promo=file_get_contents("admin/kanal2.txt");
$kod = file_get_contents("step/kod.txt");
$money = file_get_contents("step/money.txt");
$post = file_get_contents("step/mid.txt");
$time = file_get_contents("bonus/$cid2.txt");
$user_id = file_get_contents("azo.dat");
$nomi_manager = file_get_contents("nakrutka/nomi.txt");
$id_manager = file_get_contents("nakrutka/id.txt");
$tavsif_manager = file_get_contents("nakrutka/tavsif.txt");
$api_manager = file_get_contents("nakrutka/apim.txt");
$kurs_manager = file_get_contents("nakrutka/kurs.txt");
$url_manager = file_get_contents("nakrutka/url.txt");
$ban = file_get_contents("ban/$cid.txt");
$apikeys = file_get_contents("nakrutka/api.txt");

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
mkdir("buyurtma");
mkdir("nakrutka");
mkdir("nakrutka/api");

$panel = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"⚙ Asosiy sozlamalar"]],
[['text'=>"📊 Statistika"],['text'=>"🎟 Promokod"]],
[['text'=>"📢 Kanallar"],['text'=>"🛍 Xizmatlar"]],
[['text'=>"🔎 Foydalanuvchini boshqarish"]],
[['text'=>"🎛 Tugmalar"],['text'=>"📃 Matnlar"]],
[['text'=>"🎁 Kunlik bonus sozlamalari"]],
[['text'=>"✉ Xabarnoma"],['text'=>"◀️ Orqaga"]]
]]);

$asosiy = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"*️⃣ Birlamchi sozlamalar"]],
[['text'=>"📋 Adminlar"],['text'=>"💳 Hamyonlar"]],
[['text'=>"⚖️ Foiz qo'yish"],['text'=>"⭐️ Bot dizayni"]],
[['text'=>"🔑 API sozlash"],['text'=>"🗄 Boshqarish"]],
]]);

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

if($tx){
$ban = file_get_contents("ban/$cid.txt");
if($ban == "ban"){
}else{
}}

if($data){
$ban = file_get_contents("ban/$cid2.txt");
if($ban == "ban"){
}else{
}}

if(isset($message)){
$status=file_get_contents("status/$cid.txt");
if($status == null){
file_put_contents("status/$cid.txt",'Oddiy');
}}

if(isset($message)){
$baza = file_get_contents("azo.dat");
if(mb_stripos($baza,$chat_id) !==false){
}else{
$txt="\n$chat_id";
$file=fopen("azo.dat","a");
fwrite($file,$txt);
fclose($file);
bot('sendMessage',[
'chat_id'=>$builder24,
'text'=>"<b>👤 Yangi obunachi qo'shildi</b>",
'parse_mode'=>"html"
]);
}}

if(isset($callback)){
$baza = file_get_contents("azo.dat");
if(mb_stripos($baza,$callfrid) !==false){
}else{
$txt="\n$callfrid";
$file=fopen("azo.dat","a");
fwrite($file,$txt);
fclose($file);
bot('sendMessage',[
'chat_id'=>$builder24,
'text'=>"<b>👤 Yangi obunachi qo'shildi</b>",
'parse_mode'=>"html"
]);
}}

if(isset($message)){
$by = file_get_contents("pul/$cid.nak");
$mmd = $by + 0;
file_put_contents("pul/$cid.nak","$mmd");
$pul = file_get_contents("pul/$cid.txt");
$mm = $pul + 0;
file_put_contents("pul/$cid.txt","$mm");
$oplata=file_get_contents("oplata/$cid.txt");
$mms = $oplata + 0;
file_put_contents("oplata/$cid.txt","$mms");
$odam = file_get_contents("odam/$cid.dat");
$kkd = $odam + 0;
file_put_contents("odam/$cid.dat","$kkd");
}

if($text == "/start"){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"$start",
'parse_mode'=>'html',
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
if(mb_stripos($user_id,"$cid")!==false){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"$start",
'parse_mode'=>'html',
'reply_markup'=>$menyu,
]);
}else{
bot('SendMessage',[
'chat_id'=>$refid,
'text'=>"<b>📳 Sizda yangi taklif mavjud</b>

Agarda ushbu foydalanuvchi hisobini to'ldirsa $referal% miqdori sizga qo'shiladi!",
'parse_mode'=>'html',
]);
file_put_contents("odam/$cid.ref","$refid");
$joinkey = joinchat($cid);
if($joinkey != null){
$odam = file_get_contents("odam/$refid.dat");
$b = $odam + 1;
file_put_contents("odam/$refid.dat","$b");
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"$start",
'parse_mode'=>'html',
'reply_markup'=>$menyu,
]);
unlink("step/$cid.id");
unlink("step/$cid.cid");
}}}}}

if($data == "result"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
if(joinchat($cid2)==true){
$refid = file_get_contents("step/$cid2.id");
$cid3 = file_get_contents("step/$cid2.cid");
if($refid !=$cid3){
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"$start",
'parse_mode'=>'html',
'reply_markup'=>$menyu,
]);
}else{
$odam = file_get_contents("odam/$cid3.dat");
$b = $odam + 1;
file_put_contents("odam/$cid3.dat","$b");
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"$start",
'parse_mode'=>'html',
'reply_markup'=>$menyu,
]);
}
unlink("step/$cid2.id");
unlink("step/$cid2.cid");
}}

if($text == "◀️ Orqaga" and joinchat($cid)==true){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"$start",
'parse_mode'=>'html',
'reply_markup'=>$menyu,
]);
unlink("step/$cid.bol");
unlink("step/$cid.ich");
unlink("step/$cid.xiz");
unlink("step/$cid.step");
unlink("step/alijonov.txt");
}

if($text == "$key3" and joinchat($cid)==true){
if($status=="VIP"){
}else{
$ViP="💎 ViP Status";
}
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🔎 Sizning ID raqamingiz:</b> <code>$cid</code>

<b>💵 Umumiy balansingiz:</b> $pul $valyuta
<b>🗄 Buyurtmalaringiz:</b> $by ta
<b>🔗 Takliflaringiz soni:</b> $odam ta

<b>Statusingiz:</b> $status

<b>💳 Botga kiritgan pullaringiz:</b> $oplata $valyuta",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"$ViP",'callback_data'=>"vip_shop"],['text'=>"🔁 O'tkazmalar",'callback_data'=>"almashish"]],
[['text'=>"💳 Hisobni to'ldirish",'callback_data'=>"oplata"]],
]])
]);
unlink("step/$cid.bol");
unlink("step/$cid.ich");
unlink("step/$cid.xiz");
}

if($data == "kabinet"){
$status=file_get_contents("status/$cid2.txt");
if($status=="VIP"){
}else{
$ViP="💎 ViP Status";
}
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>🔎 Sizning ID raqamingiz:</b> <code>$cid2</code>

<b>💵 Umumiy balansingiz:</b> $pul $valyuta
<b>🗄 Buyurtmalaringiz:</b> $by ta
<b>🔗 Takliflaringiz soni:</b> $odam ta

<b>Statusingiz:</b> $status

<b>💳 Botga kiritgan pullaringiz:</b> $oplata $valyuta",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"$ViP",'callback_data'=>"vip_shop"],['text'=>"🔁 O'tkazmalar",'callback_data'=>"almashish"]],
[['text'=>"💳 Hisobni to'ldirish",'callback_data'=>"oplata"]],
]])
]);
}

if($data == "vip_shop"){
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
]])
]);
}

if($data == "shop"){
if($pul >= $narx){
file_put_contents("status/$cid2.txt","VIP");
$mm = $pul - $narx;
file_put_contents("pul/$cid2.txt",$mm);
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"💎 <b>VIP - statusga muvaffaqiyatli o'tdingiz</b>

Xaridingiz uchun raxmat!",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"kabinet"]],
]])
]);
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$qid,
'text'=>"Hisobingizda mablag' yetarli emas!",
'show_alert'=>true,
]);
}}

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
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$qid,
'text'=>"Hisobingizda mablag' yetarli emas

Minimal o'tkazma miqdori: $transfer $valyuta",
'show_alert'=>true,
]);
}}

if($step == "almashish"){
if($text=="◀️ Orqaga"){
unlink("step/$cid.step");
}else{
if(is_numeric($text)=="true"){
if($text>=$transfer){
if($pul>=$text){
file_put_contents("step/alijonov.txt",$text);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Kerakli foydalanuvchi ID raqamini yuboring:</b>",
'parse_mode'=>'html',
]);
file_put_contents("step/$cid.step",'tran');
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🤷🏻‍♂ Hisobingizda mablag' yetarli emas!</b>

Qayta yuboring:",
'parse_mode'=>'html',
]);
}}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Minimal o'tkazma miqdori:</b> $transfer $valyuta

Qayta yuboring:",
'parse_mode'=>'html',
]);
}}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🤷🏻‍♂ Faqat raqamlardan foydalaning!</b>

<i>Minimal o'tkazma miqdori:</i> $transfer $valyuta",
'parse_mode'=>'html',
]);
}}}

if($step == "tran"){
if($text=="◀️ Orqaga"){
unlink("step/$cid.step");
unlink("step/alijonov.txt");
}else{
if(file_exists("pul/$text.txt")){
$pul = file_get_contents("pul/$cid.txt");
$miqdor = $pul - $saved;
file_put_contents("pul/$cid.txt",$miqdor);
$pul = file_get_contents("pul/$text.txt");
$miqdor = $pul + $saved;
file_put_contents("pul/$text.txt",$miqdor);
bot('SendMessage',[
'chat_id'=>$text,
'text'=>"📳 <a href='tg://user?id=$uid'>$uid</a><b> hisobingizga $saved $valyuta o'tkazdi</b>",
'parse_mode'=>'html',
'disable_web_page_preview'=>true,
]);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>✅</b> <a href='tg://user?id=$text'>Foydalanuvchiga</a><b> $saved $valyuta o'tkazildi</b>",
'parse_mode'=>'html',
'reply_markup'=>$menyu,
]);
unlink("step/$cid.step");
unlink("step/alijonov.txt");
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🤷🏻‍♂ Foydalanuvchi topilmadi</b>

Qayta urinib ko'ring:",
'parse_mode'=>'html',
]);
}}}

if($data == "oplata"){
if($turi == null){
bot('answerCallbackQuery',[
'callback_query_id'=>$qid,
'text'=>"🤷🏻‍♂ To'lov tizimlari qo'shilmagan!",
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
'text'=>"<b>💳 To'lov tizimlaridan birini tanlang:</b>",
'parse_mode'=>"html",
'reply_markup'=>$payment
]);
}}

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
'text'=>"<b>💳 To'lov tizimlaridan birini tanlang:</b>",
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
'text'=>"<b>📋 To'lov tizimi:</b> $turi

<b>💳 Hamyon:</b> <code>$wallet</code>
<b>📝 Izoh:</b> <code>$cid2</code>

$addition",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✅ To'lov qildim",'callback_data'=>"money-$turi"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"orqa"]],
]])
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
}

if(mb_stripos($step, "oplata-")!==false){
$ex = explode("-",$step);
$turi = $ex[1];
if($text=="◀️ Orqaga"){
unlink("step/$cid.step");
}else{
if(is_numeric($text)=="true"){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"🧾 <b>To'lovingizni chek yoki skreenshotini shu yerga yuboring:</b>",
'parse_mode'=>'html',
]);
file_put_contents("step/$cid.step","rasm-$text-$turi");
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"💵 <b>To'lov miqdorini kiriting:</b>",
'parse_mode'=>'html',
]);
}}}

if(mb_stripos($step, "rasm-")!==false){
$ex = explode("-",$step);
$miqdor = $ex[1];
$turi = $ex[2];
if($text=="◀️ Orqaga"){
unlink("step/$cid.step");
}else{
bot('forwardMessage',[
'chat_id'=>$builder24,
'from_chat_id'=>$cid,
'message_id'=>$mid,
]);
bot('SendMessage',[
'chat_id'=>$builder24,
'text'=>"<b>Foydalanuvchi hisobini to'ldirmoqchi!

To'lov tizimi:</b> $turi
<b>Foydalanuvchi:</b> <a href='tg://user?id=$cid'>$cid</a>
<b>To'lov miqdori:</b> $miqdor $valyuta",
'disable_web_page_preview'=>true,
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✅",'callback_data'=>"on-$cid-$miqdor"],['text'=>"❌",'callback_data'=>"off-$cid-$miqdor"]],
]])
]);
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>💌 So'rovingiz adminga yuborildi!</b>

<i>Biroz kuting...</i>",
'parse_mode'=>'html',
'reply_markup'=>$menyu
]);
unlink("step/$cid.step");
}}

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
$refs = file_get_contents("odam/$id.ref");
$cash=$miqdor/100*$referal;
$qosh = $refs + $cash;
file_put_contents("odam/$refs.txt",$qosh);
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$id,
'text'=>"<b>✅ So'rovingiz qabul qilindi!</b>

<i>Hisobingizga $miqdor $valyuta qo'shildi</i>",
'parse_mode'=>'html',
]);
bot('sendMessage',[
'chat_id'=>$refs,
'text'=>"<b>Sizning referalingiz hisobini to'ldirdi sizga +$cash $valyuta berildi!</b>",
'parse_mode'=>"html",
]);
bot('SendMessage',[
'chat_id'=>$builder24,
'text'=>"<b>✅ Foydalanuvchi cheki qabul qilindi!</b>",
'parse_mode'=>'html',
]);
}

if(mb_stripos($data, "off-")!==false){
$ex = explode("-",$data);
$id = $ex[1];
$miqdor = $ex[2];
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"<b>❌ So'rov bekor qilindi!</b>",
'parse_mode'=>'html',
]);
}

if($text == "$key2" and joinchat($cid)==true){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"$key7",'callback_data'=>"taklif"]],
[['text'=>"$key9",'callback_data'=>"promokod"]],
[['text'=>"$bonusnom",'callback_data'=>"bonus"]],
]])
]);
unlink("step/$cid.bol");
unlink("step/$cid.ich");
unlink("step/$cid.xiz");
}

if($data == "pul_ishla"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>📋 Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"$key7",'callback_data'=>"taklif"]],
[['text'=>"$key9",'callback_data'=>"promokod"]],
[['text'=>"$bonusnom",'callback_data'=>"bonus"]],
]])
]);
}

if($data == "bonus"){
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

Keyingi bonusni $hours soat $minutes daqiqadan so'ng olishingiz mumkin",
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
'text'=>"<b>💸 Kunlik bonus</b> - $bonus $valyuta

<b> ✅ Bonus berildi! ✅</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"pul_ishla"]],
]])
]);
}}

if($data == "taklif"){
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"<b>🔗 Sizning taklif havolangiz:</b>

https://t.me/$bot?start=$cid2

<b>Chaqirgan foydalanuvchingiz hisobini to'ldirsa sizga $referal% miqdori sizga beriladi!

Sizning takliflaringiz: $odam ta</b>",
'parse_mode'=>'html',
	'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"pul_ishla"]],
]])
]);
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
file_put_contents("step/$cid2.step",'promo');
}

if($step == "promo"){
if($text=="◀️ Orqaga"){
unlink("step/$cid.step");
}else{
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
unlink("step/$cid.step");
bot('editMessageText',[
'chat_id'=>$promo,
'message_id'=>$post,
'text'=>"<b>✅ Promokod ishlatildi!</b>

🎫 <b>Promokod:</b> <del>$kod</del>
👤 <b>Foydalangan odam:</b> <a href='tg://user?id=$cid'>$cid</a>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"▶️ Botga kirish",'url'=>"https://t.me/$bot"]],
]])
]);
unlink("step/money.txt");
unlink("step/kod.txt");
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⚠️ Bunday promokod topilmadi!</b>",
'parse_mode'=>'html',
]);
}}}

$bolim = file_get_contents("nakrutka/bolim.txt");
$more = explode("\n",$bolim);
$soni = substr_count($bolim,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$ichida=file_get_contents("nakrutka/".$more[$for]."/ichki.txt");
$ta = substr_count($ichida,"\n");
$key[]=["text"=>"$more[$for] - $ta","callback_data"=>"nakrutka=".$more[$for]];
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
}else{
bot('SendMessage',[
'chat_id'=>$chat_id,
'text'=>"<b>Quyidagi ijtimoiy tarmoqlardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$nakrutka
]);
unlink("step/$cid.bol");
unlink("step/$cid.ich");
unlink("step/$cid.xiz");
}}

if($data == "servis"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>Quyidagi ijtimoiy tarmoqlardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$nakrutka
]);
}

if(mb_stripos($data,"nakrutka=")!==false){
$ex=explode("=",$data)[1];
$ichki = file_get_contents("nakrutka/$ex/ichki.txt");
if($ichki == null){
bot('answerCallbackQuery',[
'callback_query_id'=>$qid,
'text'=>"🤷🏻‍♂ Ichki bo'limlar topilmadi!",
'show_alert'=>true,
]);
}else{
$ichki=file_get_contents("nakrutka/$ex/ichki.txt");
$more = explode("\n",$ichki);
$soni = substr_count($ichki,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$ichida = file_get_contents("nakrutka/$ex/".$more[$for]."/xizmat.txt");
$ta = substr_count($ichida,"\n");
$key[]=["text"=>"$more[$for] - $ta","callback_data"=>"tanlash=".$ex."=".$more[$for]];
$keyboard2 = array_chunk($key, $qator2);
$keyboard2[] = [['text'=>"◀️ Orqaga",'callback_data'=>"servis"]];
$ichki2 = json_encode([
'inline_keyboard'=>$keyboard2,
]);
}
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"<b>Quyidagi ichki bo'limlardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$ichki2,
]);
}}

if(mb_stripos($data,"tanlash=")!==false){
$i = explode("=",$data)[2];
$b = explode("=",$data)[1];
$ichki = file_get_contents("nakrutka/$b/$i/xizmat.txt");
file_put_contents("step/$cid2.bol", "$b");
file_put_contents("step/$cid2.ich", "$i");
if($ichki == null){
bot('answerCallbackQuery',[
'callback_query_id'=>$qid,
'text'=>"🤷🏻‍♂ Xizmatlar topilmadi!",
'show_alert'=>true,
]);
}else{
$s=explode("\n",$ichki);
$soni = substr_count($ichki,"\n");
$key=[];
for($i=1;$i<=$soni;$i++){
$key[]=["text"=>"$i - $s[$i]","callback_data"=>"xizm=".$s[$i]];
}
$keysboard2 = array_chunk($key, 1);
$keysboard2[] = [['text'=>"◀️ Orqaga",'callback_data'=>"servis"]];
$xizmatlar = json_encode([
'inline_keyboard'=>$keysboard2,
]);
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"<b>Quyidagi xizmatlardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$xizmatlar
]);
}}

if(mb_stripos($data,"xizm=")!==false){
$xiz = explode("=",$data)[1];
$bolim = file_get_contents("step/$cid2.bol");
$ich = file_get_contents("step/$cid2.ich");
$s4=file_get_contents("nakrutka/$bolim/$ich/$xiz/id.txt");
$s1=file_get_contents("nakrutka/$bolim/$ich/$xiz/tavsif.txt");
$sayt = file_get_contents("nakrutka/$bolim/$ich/$xiz/url.txt");
$api = file_get_contents("nakrutka/$bolim/$ich/$xiz/api.txt");
file_put_contents("step/$cid2.xiz","$xiz");
$j=json_decode(file_get_contents("$sayt?key=$api&action=services"), true);
foreach($j as $el){
if($el['service']==$s4){
$name=$el["name"];
$min=$el["min"];
$max=$el["max"];
$rate=$el["rate"];
$rate2=$el["rate"];
$type=strtolower($el['type']);
break;
}
}
$fr=file_get_contents("nakrutka/$bolim/$ich/$xiz/kurs.txt");
$ff=file_get_contents("admin/foiz.txt");
$ff2=file_get_contents("admin/foiz2.txt");
$rate=$rate*$fr;
$rp=$rate/100;
$rp=$rp*$ff+$rate;

$rps=$rp/100*$ff2;
$rr=$rp-$rps;

$rate2=$rate2*$fr;
$rp2=$rate2/100;
$rp2=$rp2*$ff2+$rate2;
$status=file_get_contents("status/$cid2.txt");
if($status == "VIP"){
$ra = $rp;
}else{
$ra = $rp2;
}
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"<b><u>📦 Xizmat:</u> $xiz</b>

<b><u>💵 Xizmat narxi (1000x):</u></b> ".round($rp,2)." $valyuta

<b><u>📑 Batafsil ma'lumot:</u> $s1</b>

<b><u>⬇️ Minimal buyurtma:</u></b> ".($min)." ta
<b><u>⬆️ Maksimal buyurtma:</u></b> ".($max)." ta

<b><u>💎 VIP foydalanuvchilar uchun</u></b>: ".($rp2)." $valyuta",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✅ Buyurtma berish",'callback_data'=>"buyurtma-$ra-$min-$max-$s4"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"tanlash=$bolim=$ich"]],
]])
]);
}

if(mb_stripos($data, "buyurtma-")!==false){
$ex = explode("-",$data);
$narx = $ex[1];
$min = $ex[2];
$max = $ex[3];
$id = $ex[4];
bot('SendMessage',[ 
'chat_id'=>$cid2,
'text'=>"<b><u><i>Kerakli buyurtma miqdorini kiriting:</i></u></b>", 
'parse_mode'=>'html', 
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]])
]);
file_put_contents("step/$cid2.step","by-$narx-$min-$max-$id");
}

if(mb_stripos($step, "by-")!==false){
$ex = explode("-",$step);
$narx = $ex[1];
$min = $ex[2];
$max = $ex[3];
$id = $ex[4];
if($tx=="◀️ Orqaga"){
unlink("step/$cid.step");
}else{
if(is_numeric($text)=="true"){ 
if($text >= $min and $text <= $max){
$umumiy = $narx / 1000;
$miqdor = $text * $umumiy;
if($pul >= $miqdor){
file_put_contents("step/$cid.son","$text"); 
bot('SendMessage',[ 
'chat_id'=>$cid,
'text'=>"<b>✅ $text ta buyurtma qabul qilindi 

🔗 Kerakli havolani yuboring: 

❕ Namuna:</b> <i>https://havola</i>", 
'disable_web_page_preview'=>true, 
'parse_mode'=>'html', 
]); 
file_put_contents("step/$cid.step","buy-$narx-$min-$max-$id"); 
}else{ 
bot('SendMessage',[ 
'chat_id'=>$cid, 
'text'=>"<b>Hisobingizda yetarli mablag' mavjud emas!</b> 
 
Qayta urinib ko'ring:",
'parse_mode'=>'html',
]);
}}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Minimal buyurtma - $min ta 
Maksimal buyurtma - $max ta</b> 

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

if(mb_stripos($step, "buy-")!==false){
$ex = explode("-",$step);
$narx = $ex[1];
$min = $ex[2];
$max = $ex[3];
$id = $ex[4];
if($tx=="◀️ Orqaga"){
unlink("step/$cid.step");
}else{
if(mb_stripos($text, "https://")!==false){ 
file_put_contents("step/$cid.url","$text");
$son = file_get_contents("step/$cid.son"); 
$url = file_get_contents("step/$cid.url");
$xiz = file_get_contents("step/$cid.xiz");
$umumiy = $narx / 1000;
$miqdor = $son * $umumiy;
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📦 Buyurtma:</b> $xiz

<b>🔗 Havola:</b> $url

<b>🔢 Buyurtma miqdori:</b> $son ta
<b>💳 Buyurtma narxi:</b> $miqdor $valyuta
<b>💵 Sizning balansingiz:</b> $pul $valyuta

<i>⚠️ Buyurtmani tasdiqlashdan oldin, ma'lumotlarni tekshirib chiqing!</i>", 
'disable_web_page_preview'=>true, 
'parse_mode'=>'html', 
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✅ Tasdiqlash",'callback_data'=>"byber-$miqdor-$son-$id"]],
]])
]);
unlink("step/$cid.step");
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
$miqdor = $ex[1];
$son = $ex[2];
$id = $ex[3];
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$update->callback_query->message->message_id,
]);
file_put_contents("step/by.$cid2");
$nak = file_get_contents("step/by.$cid2");
if(stripos($nak,"$callfrid") !== false){
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"$start",
'parse_mode'=>"html",
'reply_markup'=>$menyu,
]);
unlink("step/$cid2.step");
}else{
$bolim = file_get_contents("step/$cid2.bol");
$ich = file_get_contents("step/$cid2.ich");
$xiz = file_get_contents("step/$cid2.xiz");
$sayt = file_get_contents("nakrutka/$bolim/$ich/$xiz/url.txt");
$api = file_get_contents("nakrutka/$bolim/$ich/$xiz/api.txt");
$url = file_get_contents("step/$cid2.url");
$urll=json_decode(file_get_contents("$sayt?key=$api&action=add&link=$url&quantity=$son&service=$id"),true);
$order=$urll['order'];
if($order==null){
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>⚠️ Buyurtma qabul qilinmadi!</b>",
'parse_mode'=>"html",
',reply_markup'=>$menyu,
]);
unlink("step/$cid2.url");
unlink("step/$cid2.son");
unlink("step/$cid2.bol");
unlink("step/$cid2.ich");
unlink("step/$cid2.xiz");
unlink("step/by.$cid2");
}else{
$pulim = file_get_contents("pul/$cid2.txt");
$ayir = $pulim - $miqdor; 
file_put_contents("pul/$cid2.txt","$ayir");
$nakby = file_get_contents("pul/$cid2.nak");
$plus = $nakby + 1; 
file_put_contents("pul/$cid2.nak","$plus"); 
$idlar=file_get_contents("buyurtma/id.txt");
$pls = $idlar + 1; 
file_put_contents("buyurtma/id.txt","$pls");
mkdir("buyurtma/$pls");
file_put_contents("buyurtma/$pls/order.txt","$order");
file_put_contents("buyurtma/$pls/egasi.txt","$cid2");
file_put_contents("buyurtma/$pls/miqdor.txt","$miqdor");
file_put_contents("buyurtma/$pls/soni.txt","$son");
file_put_contents("buyurtma/$pls/api.txt","$api");
file_put_contents("buyurtma/$pls/sayt.txt","$sayt");
$fy = file_get_contents("buyurtma/$ccid.txt");
file_put_contents("buyurtma/$ccid.txt","$fy\n$pls");
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>✅ Buyurtma qabul qilindi!

Buyurtma IDsi:</b> <code>$pls</code>

<i>Yuqoridagi ID orqali buyurtmangiz haqida ma'lumot olishingiz mumkin!</i>",
'parse_mode'=>"html",
'reply_markup'=>$menyus,
]);
unlink("step/$cid2.url");
unlink("step/$cid2.son");
unlink("step/$cid2.bol");
unlink("step/$cid2.ich");
unlink("step/$cid2.xiz");
unlink("step/by.$cid2");
bot('sendMessage',[
'chat_id'=>$builder24,
'text'=>"<b>🆕 Yangi buyurtma</b>

<b>📦 Buyurtma turi:</b> $xiz
<b>🔗 Havola:</b> $url
<b>🔢 Buyurtma miqdori:</b> $son ta
<b>💵 Buyurtma narxi:</b> $miqdor $valyuta

<b>🆔 Buyurtma IDsi:</b> <code>$pls</code>",
'parse_mode'=>"html",
]);
}}}

if($text=="$key4" and joinchat($cid)==true){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🆔 Buyurtma IDsini yuboring:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]])
]);
file_put_contents("step/$cid.step","bytop");
unlink("step/$cid.bol");
unlink("step/$cid.ich");
unlink("step/$cid.xiz");
}

if($step=="bytop"){
if($text=="◀️ Orqaga"){
unlink("step/$cid.step");
}else{
$byyoq=file_get_contents("buyurtma/$tx/order.txt");
if($byyoq){
if(is_numeric($text)){
$sayt=file_get_contents("buyurtma/$tx/sayt.txt");
$api=file_get_contents("buyurtma/$tx/api.txt");
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
unlink("step/$cid.step");
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

if($text=="$key5" and joinchat($cid)==true){
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
file_put_contents("step/$cid.step","murojat");
unlink("step/$cid.bol");
unlink("step/$cid.ich");
unlink("step/$cid.xiz");
}

if($step=="murojat"){
if($text=="◀️ Orqaga"){
unlink("step/$cid.step");
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
unlink("step/$cid.step");
}}

if(mb_stripos($data,"yozish=")!==false){
$odam=explode("=",$data)[1];
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>Javob matnini yuboring:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]],
]])
]);
file_put_contents("step/$cid2.step","javob");
file_put_contents("step/$cid2.javob","$odam");
}

if($step=="javob"){
if($text=="◀️ Orqaga"){
unlink("step/$builder24.step");
unlink("step/$builder24.javob");
}else{
$murojat=file_get_contents("step/$cid.javob");
bot('sendMessage',[
'chat_id'=>$murojat,
'text'=>"<b>☎️ Administrator:</b>

$tx",
'parse_mode'=>'html',
]);
bot('sendMessage',[
'chat_id'=>$builder24,
'text'=>"<b>Javob yuborildi</b>",
'parse_mode'=>"html",
'reply_markup'=>$menyu,
]);
unlink("step/$builder24.step");
unlink("step/$builder24.javob");
}}

if($text == "$key6" and joinchat($cid)==true){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Ma'lumot olish uchun, quyidagi tugmalardan foydalaning:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📚 Qo'llanma",'callback_data'=>"qollanma"]],
[['text'=>"⚠️ Qoidalar",'callback_data'=>"qoida"]],
]])
]);
unlink("step/$cid.bol");
unlink("step/$cid.ich");
unlink("step/$cid.xiz");
}

if($data == "back"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>Ma'lumot olish uchun, quyidagi tugmalardan foydalaning:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📚 Qo'llanma",'callback_data'=>"qollanma"]],
[['text'=>"⚠️ Qoidalar",'callback_data'=>"qoida"]],
]])
]);
}

if($data == "qollanma"){
$qollanma=file_get_contents("matn/qollanma.txt");
if($qollanma == null){
bot('answerCallbackQuery',[
'callback_query_id'=>$qid,
'text'=>"🤷🏻‍♂ Qo'shilmagan!",
'show_alert'=>true,
]);
}else{
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"$qollanma",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"back"]],
]])
]);
}}

if($data == "qoida"){
$qoida = file_get_contents("matn/qoida.txt");
if($qoida == null){
bot('answerCallbackQuery',[
'callback_query_id'=>$qid,
'text'=>"🤷🏻‍♂ Qo'shilmagan!",
'show_alert'=>true,
]);
}else{
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"$qoida",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"back"]],
]])
]);
}}

//<----- Admin Panel ------>

if($text=="⚖️ Foiz qo'yish" and in_array($cid,$admin)){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🛍 Bot xizmatlari uchun foizni yuboring:

Masalan:</b> 5",
'parse_mode'=>'html',
'reply_markup'=>$boshqarish,
]);
put("step/$cid.step","updFoiz");
}

if($step=="updFoiz"){
if($tx=="🗄 Boshqarish"){
unlink("step/$cid.step");
}else{
file_put_contents("admin/foiz.txt","$text");
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>💎 VIP xizmatlari uchun foizni yuboring:

Masalan:</b> 5",
'parse_mode'=>'html',
'reply_markup'=>$boshqarish,
]);
put("step/$cid.step","up2");
}}


if($step=="up2"){
if($tx=="🗄 Boshqarish"){
unlink("step/$cid.step");
}else{
file_put_contents("admin/foiz2.txt","$text");
sms($cid,"<b>✅ Malumotlar saqlandi!</b>",$panel);
unlink("step/$cid.step");
}}

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
}}

if($text == "🔎 Foydalanuvchini boshqarish"){
if(in_array($cid,$admin)){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Kerakli foydalanuvchining ID raqamini kiriting:</b>",
'parse_mode'=>'html',
'reply_markup'=>$boshqarish
]);
file_put_contents("step/$cid.step",'iD');
}}

if($step == "iD"){
if($tx=="🗄 Boshqarish"){
unlink("step/$cid.step");
}else{
if(in_array($cid,$admin)){
if(file_exists("pul/$text.txt")){
file_put_contents("step/alijonov.txt",$text);
$pul = file_get_contents("pul/$text.txt");
$odam = file_get_contents("odam/$text.dat");
$status=file_get_contents("status/$text.txt");
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
'text'=>"<b>Foydalanuvchi topildi!

ID:</b> <a href='tg://user?id=$text'>$text</a>
<b>Balans: $pul $valyuta
Takliflar: $odam ta</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"$bans",'callback_data'=>"ban"]],
[['text'=>"➕ Pul qo'shish",'callback_data'=>"plus"],['text'=>"➖ Pul ayirish",'callback_data'=>"minus"]],
[['text'=>"$vip",'callback_data'=>"add_vip"]],
]])
]);
unlink("step/$cid.step");
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Foydalanuvchi topilmadi.</b>

Qayta urinib ko'ring:",
'parse_mode'=>'html',
]);
}}}}

if($data == "plus"){
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<a href='tg://user?id=$saved'>$saved</a> <b>ning hisobiga qancha pul qo'shmoqchisiz?</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqarish"]],
]])
]);
file_put_contents("step/$cid2.step",'plus');
}

if($step == "plus"){
if($tx=="🗄 Boshqarish"){
unlink("step/$cid.step");
}else{
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
$refs = file_get_contents("odam/$saved.ref");
$cash=$text/100*$referal;
$qosh = $refs + $cash;
file_put_contents("odam/$refs.txt",$qosh);
bot('sendMessage',[
'chat_id'=>$refs,
'text'=>"<b>Sizning referalingiz hisobini to'ldirdi sizga +$cash $valyuta berildi!</b>",
'parse_mode'=>"html",
]);
unlink("step/alijonov.txt");
unlink("step/$cid.step");
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Faqat raqamlardan foydalaning!</b>",
'parse_mode'=>'html',
]);
}}}}

if($data=="minus"){
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<a href='tg://user?id=$saved'>$saved</a> <b>ning hisobiga qancha pul ayirmoqchisiz?</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqarish"]],
]])
]);
file_put_contents("step/$cid2.step",'minus');
}

if($step == "minus"){
if($tx=="🗄 Boshqarish"){
unlink("step/$cid.step");
}else{
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
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Faqat raqamlardan foydalaning!</b>",
'parse_mode'=>'html',
]);
}}}}

if($data=="ban"){
$ban = file_get_contents("ban/$saved.txt");
if($builder24 != $saved){
if($ban == "ban"){
unlink("ban/$saved.txt");
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>Foydalanuvchi ($saved) bandan olindi!</b>",
'parse_mode'=>"html",
]);
}else{
file_put_contents("ban/$saved.txt",'ban');
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>Foydalanuvchi ($saved) banlandi!</b>",
'parse_mode'=>"html",
]);
}}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$qid,
'text'=>"Asosiy adminlarni blocklash mumkin emas!",
'show_alert'=>true,
]);
}}

if($data=="add_vip"){
$status = file_get_contents("status/$saved.txt");
if($status == "VIP"){
file_put_contents("status/$saved.txt",'Oddiy');
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>Foydalanuvchi ($saved) VIP dan olindi!</b>",
'parse_mode'=>"html",
]);
}else{
file_put_contents("status/$saved.txt",'VIP');
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>Foydalanuvchi ($saved) VIP ga qo'shildi!</b>",
'parse_mode'=>"html",
]);
}}

if($text == "✉ Xabarnoma"){
if(in_array($cid,$admin)){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Yuboriladigan xabar turini tanlang;</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"Oddiy xabar",'callback_data'=>"send"]],
[['text'=>"Forward xabar",'callback_data'=>"forsend"]],
]])
]);
}}

if($data == "send"){
$lich=substr_count($user_id,"\n");
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>$lich ta foydalanuvchiga yuboriladigan xabar matnini yuboring:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqarish"]],
]])
]);
file_put_contents("step/$cid2.step","oddiy");
}
if($step=="oddiy"){
if($tx=="🗄 Boshqarish"){
unlink("step/$cid.step");
}else{
if(in_array($cid,$admin)){
$lich=substr_count($user_id,"\n");
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"<b>$lich ta foydalanuvchiga xabar yuborish boshlandi!</b>",
'parse_mode'=>"html",
'reply_markup'=>$panel,
]);
$lichka = explode("\n",$user_id);
foreach($lichka as $lichkalar){
$usr=bot("sendMessage",[
'chat_id'=>$lichkalar,
'text'=>$text,
'parse_mode'=>'HTML'
]);
unlink("step/$cid.step");
}}}}
if($usr){
$lich=substr_count($user_id,"\n");
bot("sendmessage",[
'chat_id'=>$cid,
'text'=>"<b>$lich ta foydalanuvchiga muvaffaqiyatli yuborildi</b>",
'parse_mode'=>'html',
]);
unlink("step/$cid.step");
}

if($data == "forsend"){
$lich=substr_count($user_id,"\n");
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>$lich ta foydalanuvchiga yuboriladigan forward xabarni yuboring:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqarish"]],
]])
]);
file_put_contents("step/$cid2.step","forward");
}
if($step=="forward"){
if($tx=="🗄 Boshqarish"){
unlink("step/$cid.step");
}else{
if(in_array($cid,$admin)){
$lich=substr_count($user_id,"\n");
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"<b>$lich ta foydalanuvchiga xabar yuborish boshlandi!</b>",
'parse_mode'=>"html",
'reply_markup'=>$panel,
]);
$lichka = explode("\n",$user_id);
foreach($lichka as $lichkalar){
$fors=bot("forwardMessage",[
'from_chat_id'=>$cid,
'chat_id'=>$lichkalar,
'message_id'=>$mid,
]);
unlink("step/$cid.step");
}}}}
if($fors){
$lich=substr_count($user_id,"\n");
bot("sendmessage",[
'chat_id'=>$cid,
'text'=>"<b>$lich ta foydalanuvchiga muvaffaqiyatli yuborildi</b>",
'parse_mode'=>'html',
]);
unlink("step/$cid.step");
}

if($text == "📊 Statistika"){
if(in_array($cid,$admin)){
$obsh = substr_count($user_id,"\n");
$load = sys_getloadavg();
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>💡 O'rtacha yuklanish:</b> <code>$load[0]</code>

👥 <b>Foydalanuvchilar:</b> $obsh ta",
'parse_mode'=>'html',
]);
}}

if($text == "📢 Kanallar"){
if(in_array($cid,$admin)){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔐 Majburiy obunalar",'callback_data'=>"majburiy"]],
[['text'=>"🆕️ Promokod uchun",'callback_data'=>"promo"]],
]])
]);
}}

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
[['text'=>"🆕️ Promokod uchun",'callback_data'=>"promo"]],
]])
]);
}

if($data == "majburiy"){
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"<b>Majburiy obunalarni sozlash bo'limidasiz:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📑 Kanallar ro'yxati",'callback_data'=>"royxat"]],
[['text'=>"➕ Qo'shish",'callback_data'=>"qoshish"],['text'=>"🗑 O'chirish",'callback_data'=>"ochirish"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"kanallar"]],
]])
]);
}

if($data == "qoshish"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"📢 <b>Kerakli kanalni manzilini yuboring:

Namuna:</b> @HaydarovUz",
'parse_mode'=>'html',
'reply_markup'=>$boshqarish,
]);
file_put_contents("step/$cid2.step","qo'shish");
}

if($step == "qo'shish"){
if($tx=="🗄 Boshqarish"){
unlink("step/$cid.step");
}else{
if(in_array($cid,$admin)){
if(mb_stripos($text, "@")!==false){
if($kanal == null){
file_put_contents("admin/kanal.txt",$text);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>$text - kanal qo'shildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}else{
file_put_contents("admin/kanal.txt","$kanal\n$text");
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>$text - kanal qo'shildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Qayta urunib ko'ring:</b>",
'parse_mode'=>'html',
]);
}}}}

if($data == "ochirish"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>Barcha kanallar o'chirildi!</b>",
'parse_mode'=>'html',
]);
deleteFolder("admin/kanal.txt");
}

if($data == "royxat"){
$soni = substr_count($kanal,"@");
if($kanal == null){
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"<b>Hech qanday kanallar ulanmagan!</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"majburiy"]],
]])
]);
}else{
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
]])
]);
}}

if($data == "promo"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"📢 <b>Kerakli kanalni manzilini yuboring:

Namuna:</b> @HaydarovUz",
'parse_mode'=>'html',
'reply_markup'=>$boshqarish,
]);
file_put_contents("step/$cid2.step","promokod");
}

if(($step == "promokod") and (in_array($cid,$admin))){
if($tx=="🗄 Boshqarish"){
unlink("step/$cid.step");
}else{
if(mb_stripos($text,"@")!==false){
$get = bot('getChat',[
'chat_id'=>$text
]);
$types = $get->result->type;
$ch_name = $get->result->title;
$ch_user = $get->result->username;
if(getAdmin($ch_user)== true){
file_put_contents("admin/kanal2.txt","@$ch_user");
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>$text - kanal saqlandi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel,
]);
unlink("step/$cid.step");
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Bot ushbu kanalda admin emas yoki noto'g'ri kanal manzili yuborildi!</b>",
'parse_mode'=>'html',
]);
}}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"⚠️ <b>Kanal manzili kiritishda xatolik!</b>

Qayta urinib ko'ring:",
'parse_mode'=>'html',
]);
}}}

if($text == "📋 Adminlar"){
if(in_array($cid,$admin)){
if($cid == $builder24){
bot('SendMessage',[
'chat_id'=>$builder24,
'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Yangi admin qo'shish",'callback_data'=>"add"]],
[['text'=>"📑 Ro'yxat",'callback_data'=>"list"],['text'=>"🗑 O'chirish",'callback_data'=>"remove"]],
]])
]);
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📑 Ro'yxat",'callback_data'=>"list"]],
]])
]);
}}}

if($data == "admins"){
if($cid2 == $builder24){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);	
bot('SendMessage',[
'chat_id'=>$builder24,
'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Yangi admin qo'shish",'callback_data'=>"add"]],
[['text'=>"📑 Ro'yxat",'callback_data'=>"list"],['text'=>"🗑 O'chirish",'callback_data'=>"remove"]],
]])
]);
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
]])
]);
}}

if($data == "list"){
$admins=file_get_contents("admin/admins.txt");
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"<b>👮 Adminlar ro'yxati:</b>

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
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$builder24,
'text'=>"*Kerakli iD raqamni kiriting:*",
'parse_mode'=>'MarkDown',
'reply_markup'=>$boshqarish
]);
file_put_contents("step/$cid2.step",'add-admin');
}

if($step=="add-admin" and $cid == $builder24){
if($tx=="🗄 Boshqarish"){
unlink("step/$cid.step");
}else{
if(is_numeric($text)=="true"){
if($text != $builder24){
file_put_contents("admin/admins.txt","$admins\n$text");
bot('SendMessage',[
'chat_id'=>$builder24,
'text'=>"✅ *$text* endi botda admin",
'parse_mode'=>'MarkDown',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Kerakli iD raqamni kiriting:</b>",
'parse_mode'=>'html',
]);
}}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Kerakli iD raqamni kiriting:</b>",
'parse_mode'=>'html',
]);
}}}

if($data == "remove"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$builder24,
'text'=>"<b>Kerakli iD raqamni kiriting:</b>",
'parse_mode'=>'html',
'reply_markup'=>$boshqarish
]);
file_put_contents("step/$cid2.step",'remove-admin');
}

if($step == "remove-admin" and $cid == $builder24){
if($tx=="🗄 Boshqarish"){
unlink("step/$cid.step");
}else{
if(is_numeric($text)=="true"){
if($text != $builder24){
$files=file_get_contents("admin/admins.txt");
$file = str_replace("\n".$text."","",$files);
file_put_contents("admin/admins.txt",$file);
bot('SendMessage',[
'chat_id'=>$builder24,
'text'=>"✅ *$text* endi botda admin emas",
'parse_mode'=>'MarkDown',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Kerakli iD raqamni kiriting:</b>",
'parse_mode'=>'html',
]);
}}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Kerakli iD raqamni kiriting:</b>",
'parse_mode'=>'html',
]);
}}}

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
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Promokod yuboriladigan kanal ulanmagan!</b>",
'parse_mode'=>'html',
]);
}}}

if($step == "pro"){
if($tx=="🗄 Boshqarish"){
unlink("step/$cid.step");
}else{
if(in_array($cid,$admin)){
file_put_contents("step/kod.txt",$text);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Qabul qilindi.</b>

Endi esa, promokod qiymatini yuboring:",
'parse_mode'=>'html',
]);
file_put_contents("step/$cid.step",'Next_Promo');
}}}

if($step == "Next_Promo"){
if($tx=="🗄 Boshqarish"){
unlink("step/$cid.step");
}else{
if(in_array($cid,$admin)){
if(is_numeric($text)=="true"){
file_put_contents("step/money.txt",$text);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Promokod $promo kanaliga yuborildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel,
]);
$msg = bot('SendMessage',[
'chat_id'=>$promo,
'text'=>"<b>💡 Yangi Promokod!</b>

<b>🎫 Promokod:</b> <code>$kod</code>
<b>💵 Promokod qiymati:</b> $text $valyuta",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"▶️ Botga kirish",'url'=>"https://t.me/$bot"]],
]])
])->result->message_id;
file_put_contents("step/mid.txt",$msg);
unlink("step/$cid.step");
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Faqat raqamlardan foydalaning!</b>",
'parse_mode'=>'html',
]);
}}}}

if($text == "🎁 Kunlik bonus sozlamalari"){
if(in_array($cid,$admin)){
$bonusbor = file_get_contents("bonus/bonnom.txt","$key8");
if($bonusbor){
$status="Yoqilgan";
}else{
$status="O'chirilgan";
}
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Hozirgi holat:

Kunlik bonus miqdori:</b> $bonus $valyuta
<b>Bonus olish vaqti:</b> 24 soat

<b>Status:</b> $status",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🎁 Kunlik bonus miqdorini sozlash",'callback_data'=>"kmiqdor"]],
[['text'=>"💡 Statusni o'zgartirish",'callback_data'=>"kstatus"]],
]])
]);
}}

if($data == "kbonus"){
$bonusbor = file_get_contents("bonus/bonnom.txt","$key8");
if($bonusbor){
$status="Yoqilgan";
}else{
$status="O'chirilgan";
}
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>Hozirgi holat:

Kunlik bonus miqdori:</b> $bonus $valyuta
<b>Bonus olish vaqti:</b> 24 soat

<b>Status:</b> $status",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🎁 Bonus miqdorini sozlash",'callback_data'=>"kmiqdor"]],
[['text'=>"💡 Statusni o'zgartirish",'callback_data'=>"kstatus"]],
]])
]);
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
}

if($step == "kmiqdor"){
if($tx=="🗄 Boshqarish"){
unlink("step/$cid.step");
}else{
if(in_array($cid,$admin)){
if(is_numeric($text)=="true"){
file_put_contents("bonus/bonmiq.txt","$tx");
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel,
]);
unlink("step/$cid.step");
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Faqat raqamlardan foydalaning!</b>",
'parse_mode'=>'html',
]);
}}}}

if($data == "kstatus"){
$bonusbor = file_get_contents("bonus/bonnom.txt","$key8");
if($bonusbor){
$status="Yoqilgan";
}else{
$status="O'chirilgan";
}
if($status == "Yoqilgan"){
unlink("bonus/bonnom.txt");
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"kbonus"]],
]])
]);
}else{
file_put_contents("bonus/bonnom.txt","$key8");
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"kbonus"]],
]])
]);
}}

if($text == "⭐️ Bot dizayni"){
if(in_array($cid,$admin)){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"1️⃣ <b>Bo'limlar qatori:</b> $qator1 qator
2️⃣ <b>Ichki bo'lim qatori:</b> $qator2 qator
3️⃣ <b>Xizmatlar qatori:</b> $qator3 qator
4️⃣ <b>To'lov tizim qatori:</b> $qator4 qator",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"1",'callback_data'=>"qator-qator1"],['text'=>"2",'callback_data'=>"qator-qator2"],['text'=>"3",'callback_data'=>"qator-qator3"],['text'=>"4",'callback_data'=>"qator-qator4"]],
]])
]);
}}

if($data == "qatorlar"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"1️⃣ <b>Bo'limlar qatori:</b> $qator1 qator
2️⃣ <b>Ichki bo'lim qatori:</b> $qator2 qator
3️⃣ <b>Xizmatlar qatori:</b> $qator3 qator
4️⃣ <b>To'lov tizim qatori:</b> $qator4 qator",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"1",'callback_data'=>"qator-qator1"],['text'=>"2",'callback_data'=>"qator-qator2"],['text'=>"3",'callback_data'=>"qator-qator3"],['text'=>"4",'callback_data'=>"qator-qator4"]],
]])
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
[['text'=>"1⃣",'callback_data'=>"qiymat-$qator-1"],['text'=>"2⃣",'callback_data'=>"qiymat-$qator-2"],['text'=>"3⃣",'callback_data'=>"qiymat-$qator-3"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"qatorlar"]],
]])
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
[['text'=>"◀️ Orqaga",'callback_data'=>"qatorlar"]],
]])
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
}}

if($text == "🔑 API sozlash"){
if(in_array($cid,$admin)){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"🔑 <b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Yangi API qo'shish",'callback_data'=>"api"]],
[['text'=>"⚙️ API larni tahrirlash",'callback_data'=>"apilarim"]],
]])
]);
}}

if($data == "api_sozlanma"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"🔑 <b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Yangi API qo'shish",'callback_data'=>"api"]],
[['text'=>"⚙️ API larni tahrirlash",'callback_data'=>"apilarim"]],
]])
]);
}

if($data == "apilarim"){
if($apikeys == null){
bot('answerCallbackQuery',[
'callback_query_id'=>$qid,
'text'=>"Hech narsa topilmadi!",
'show_alert'=>true,
]);
}else{
$apikeys = file_get_contents("nakrutka/api.txt");
$ids = explode("\n",$apikeys);
$soni = substr_count($apikeys,"\n");
$keyboards = [];
for ($i = 1; $i <= $soni; $i++) {
$title = str_replace("\n","",$ids[$i]);
$url = file_get_contents("nakrutka/api/$ids[$i].txt");
$text .= "<b>$i.</b> $url\n";
$keyboards[]=["text"=>"$i","callback_data"=>"web=$title"];
}
$key = array_chunk($keyboards, 5);
$key[] = [['text'=>"◀️ Orqaga",'callback_data'=>"api_sozlanma"]];
$apilarda = json_encode([
'inline_keyboard'=>$key,
]);
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>📑 Sizning API lar ro'yxati:</b>

$text",
'parse_mode'=>'html',
'disable_web_page_preview'=>true,
'reply_markup'=>$apilarda
]);
}}

if(mb_stripos($data, "web=")!==false){
$ex = explode("=",$data);
$title = $ex[1];
$link = file_get_contents("nakrutka/api/$title.txt");
$orderstat=json_decode(file_get_contents("$link?key=$title&action=balance"),true);
$balance = $orderstat['balance'];
$valyuta = $orderstat['currency'];
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"<b>📄 Tanlangan API ma'lumotlari:</b>
➖➖➖➖➖➖➖➖➖➖➖
<b>API Havola:</b>
<code>$link</code>

<b>API Kalit:</b>
<code>$title</code>

<b>API Balans:</b>
$balance $valyuta
➖➖➖➖➖➖➖➖➖➖➖
<i>Quyidagilardan birini tanlang:</i>",
'disable_web_page_preview'=>true,
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔁 APi kalitni o'zgartirish",'callback_data'=>"update_api=$title"]],
[['text'=>"🗑 O'chirib tashlash",'callback_data'=>"delete_api=$title"]],
[['text'=>"Orqaga",'callback_data'=>"apilarim"]],
]])
]);
}

if(mb_stripos($data, "delete_api=")!==false){
$ex = explode("=",$data)[1];
$k = str_replace("\n".$ex."","",$apikeys);
file_put_contents("nakrutka/api.txt",$k);
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
}

if(mb_stripos($data, "update_api=")!==false){
$ex = explode("=",$data)[1];
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>Yangi API ni yuboring.</b>",
'parse_mode'=>'html',
'reply_markup'=>$boshqarish
]);
file_put_contents("step/$cid2.step","alishtir=$ex");
}

if(mb_stripos($step, "alishtir=")!==false){
$ex = explode("=",$step)[1];
if($tx=="🗄 Boshqarish"){
unlink("step/$cid.step");
}else{
$link = file_get_contents("nakrutka/api/$ex.txt");
$orderstat=json_decode(file_get_contents("$link?key=$text&action=balance"),true);
$status_uz = $orderstat['balance'];
$valyuta=$orderstat['currency'];
if($status_uz !=null){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Yangi API qabul qilindi!</b>

<i>Ushbu API balansi:</i> $status_uz $valyuta",
'parse_mode'=>'html',
'reply_markup'=>$asosiy
]);
$ichki =file_get_contents("nakrutka/api.txt");
$str = str_replace($ex,$text,$ichki);
file_put_contents("nakrutka/api.txt",$str);
rename("nakrutka/api/$ex.txt","nakrutka/api/$text.txt");
unlink("step/$cid.step");
}else{
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Ushbu API haqida ma'lumot topilmadi!</b>

Qayta urinib ko'ring:",
'parse_mode'=>'html',
]);
}}}

if($data == "api"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>Kerakli saytning API qo'llanmasida ko'rsatilgan API havolani yuboring: 
 
Masalan:</b> <code>https://gramapi.uz/api/v2</code>",
'parse_mode'=>'html',
'reply_markup'=>$boshqarish,
]);
file_put_contents("step/$cid2.step",'api_url');
}

if($step == "api_url"){
if($tx=="🗄 Boshqarish"){
unlink("step/$cid.step");
}else{
file_put_contents("admin/api.txt",$text);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>$text dan olingan API kalitni yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>$boshqarish,
]);
file_put_contents("step/$cid.step","api_keys=$text");
}}

if(mb_stripos($step, "api_keys=")!==false){
$ex = explode("=",$step)[1];
if($tx=="🗄 Boshqarish"){
unlink("step/$cid.step");
}else{
$orderstat=json_decode(file_get_contents("$ex?key=$text&action=balance"),true);
$status_uz = $orderstat['balance'];
$valyuta=$orderstat['currency'];
if($status_uz !=null){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>API qabul qilindi!</b>

Ushbu API balansi: $status_uz $valyuta",
'parse_mode'=>'html',
'reply_markup'=>$asosiy
]);
file_put_contents("nakrutka/api.txt","$apikeys\n$text");
file_put_contents("nakrutka/api/$text.txt","$ex");
unlink("step/$cid.step");
}else{
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Ushbu API haqida ma'lumot topilmadi!</b>

Qayta urinib ko'ring:",
'parse_mode'=>'html',
]);
}}}

$delturi = file_get_contents("tizim/turi.txt");
$delmore = explode("\n",$delturi);
$delsoni = substr_count($delturi,"\n");
$key=[];
for ($delfor = 1; $delfor <= $delsoni; $delfor++) {
$title=str_replace("\n","",$delmore[$delfor]);
$key[]=["text"=>"$title - o'chirish","callback_data"=>"del-$title"];
$keyboard2 = array_chunk($key, $qator4);
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
]])
]);
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$pay
]);
}}}

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
]])
]);
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
}}

if(mb_stripos($data,"del-")!==false){
$ex = explode("-",$data);
$tur = $ex[1];
$k = str_replace("\n".$tur."","",$turi);
file_put_contents("tizim/turi.txt",$k);
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"$tur - <b>To'lov tizimi olib tashlandi.</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"hamyon"]],
]])
]);
deleteFolder("tizim/$tur");
}

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
}

if($step == "turi"){
if($tx=="🗄 Boshqarish"){ 
unlink("step/$cid.step"); 
}else{
if(in_array($cid,$admin)){
mkdir("tizim/$text");
file_put_contents("tizim/turi.txt","$turi\n$text");
file_put_contents("step/test.txt",$text);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Ushbu to'lov tizimidagi hamyoningiz raqamini yuboring:</b>",
'parse_mode'=>'html',
]);
file_put_contents("step/$cid.step",'wallet');
}}}

if($step == "wallet"){
if($tx=="🗄 Boshqarish"){ 
unlink("step/$cid.step"); 
}else{
if(in_array($cid,$admin)){
if(is_numeric($text)=="true"){
file_put_contents("tizim/$test/wallet.txt","$wallet\n$text");
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Ushbu to'lov tizimi orqali hisobni to'ldirish bo'yicha ma'lumotni yuboring:</b>

<i>Misol uchun, Ushbu to'lov tizimi orqali pul yuborish jarayonida izoh kirita olmasligingiz mumkin. Ushbu holatda, biz bilan bog'laning. Havola: @Builder24</i>",
'parse_mode'=>'html',
]);
file_put_contents("step/$cid.step",'addition');
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Faqat raqamlardan foydalaning!</b>",
'parse_mode'=>'html',
]);
}}}}

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
}}}

if($text == "🛍 Xizmatlar"){
if(in_array($cid,$admin)){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📂 Bo'limlarni sozlash",'callback_data'=>"bolim"]],
[['text'=>"📂 Ichki bo'lim sozlash",'callback_data'=>"ichki"]],
[['text'=>"🛍 Xizmatlarni sozlash",'callback_data'=>"xizmat"]],
[['text'=>"🗑 Barchasini tozalash",'callback_data'=>"toza"]],
]])
]);
}}

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
[['text'=>"📂 Ichki bo'lim sozlash",'callback_data'=>"ichki"]],
[['text'=>"🛍 Xizmatlarni sozlash",'callback_data'=>"xizmat"]],
[['text'=>"🗑 Barchasini tozalash",'callback_data'=>"toza"]],
]])
]);
}

if($data == "toza"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>⚠️ Ushbu holatda xizmatlarni tozalasangiz, keyinchalik qayta tiklab bo'lmaydi</b>

Shu bilan birgalikda bo'lim, ichki bo'lim va xizmatlar barchasi o'chiriladi!",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✅ Tasdiqlash",'callback_data'=>"barcha2"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"buy"]],
]])
]);
}

if($data=="barcha2"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>Barcha malumotlar tozlalandi</b>",
'parse_mode'=>"html",
]);
deleteFolder("nakrutka/");
}

if($data == "bolim"){
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Yangi bo'lim qo'shish",'callback_data'=>"newFol"]],
[['text'=>"📝 Tahrirlash",'callback_data'=>"editFol"]],
[['text'=>"🗑 O'chirish",'callback_data'=>"delFol"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"buy"]]
]])
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
[['text'=>"➕ Ichki bo'lim qo'shish",'callback_data'=>"newFold"]],
[['text'=>"📝 Tahrirlash",'callback_data'=>"editFold"]],
[['text'=>"🗑 O'chirish",'callback_data'=>"delFold"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"buy"]]
]])
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
[['text'=>"➕ Yangi xizmat qo'shish",'callback_data'=>"newXiz"]],
[['text'=>"📝 Tahrirlash",'callback_data'=>"editXiz"]],
[['text'=>"🗑 O'chirish",'callback_data'=>"delXiz"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"buy"]]
]])
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
[['text'=>"📝 Nomini o'zgartirish",'callback_data'=>"editFols"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"buy"]]
]])
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
[['text'=>"📝 Nomini o'zgartirish",'callback_data'=>"editFolds"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"buy"]]
]])
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
[['text'=>"📝 Nomini o'zgartirish",'callback_data'=>"editNomi"]],
[['text'=>"📝 Kursni o'zgartirish",'callback_data'=>"editXizmat=kurs"]],
[['text'=>"📝 Tavsifni o'zgartirish",'callback_data'=>"editXizmat=tavsif"]],
[['text'=>"📝 Servis IDni o'zgartirish",'callback_data'=>"editXizmat=id"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"buy"]]
]])
]);
}

$bolim = file_get_contents("nakrutka/bolim.txt");
$more = explode("\n",$bolim);
$soni = substr_count($bolim,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$key[]=["text"=>"$more[$for]","callback_data"=>"editFolss=".$more[$for]];
$keyboard2 = array_chunk($key, $qator1);
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


if(mb_stripos($data, "editFolss=")!==false){
$ex = explode("=",$data)[1];
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
file_put_contents("step/$cid2.step","editFol=$ex");
}

if(mb_stripos($step, "editFol=")!==false){
if($tx=="🗄 Boshqarish"){ 
unlink("step/$cid.step"); 
}else{
$ex = explode("=",$step)[1];
if(in_array($cid,$admin)){
$bolim = file_get_contents("nakrutka/bolim.txt");
$str = str_replace($ex,$text,$bolim);
file_put_contents("nakrutka/bolim.txt",$str);
rename("nakrutka/$ex","nakrutka/$text");
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}}}

$bolim = file_get_contents("nakrutka/bolim.txt");
$more = explode("\n",$bolim);
$soni = substr_count($bolim,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$key[]=["text"=>"$more[$for]","callback_data"=>"editFolds=".$more[$for]];
$keyboard2 = array_chunk($key, $qator1);
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

if(mb_stripos($data, "editFolds=")!==false){
$bolim = explode("=",$data)[1];
$ichki = file_get_contents("nakrutka/$bolim/ichki.txt");
$more = explode("\n",$ichki);
$soni = substr_count($ichki,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$key[]=["text"=>"$more[$for]","callback_data"=>"editFoldm=".$more[$for]."=".$bolim];
$keyboard2 = array_chunk($key, $qator2);
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
}}

if(mb_stripos($data, "editFoldm=")!==false){
$ex = explode("=",$data)[1];
$bolim = explode("=",$data)[2];
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
file_put_contents("step/$cid2.step","editFoldms=$ex=$bolim");
}

if(mb_stripos($step, "editFoldms=")!==false){
if($tx=="🗄 Boshqarish"){ 
unlink("step/$cid.step"); 
}else{
$ex = explode("=",$step)[1];
$bolim = explode("=",$step)[2];
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
'reply_markup'=>$panel,
]);
unlink("step/$cid.step");
}}}}

$bolim = file_get_contents("nakrutka/bolim.txt");
$more = explode("\n",$bolim);
$soni = substr_count($bolim,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$key[]=["text"=>"$more[$for]","callback_data"=>"editNoms=".$more[$for]];
$keyboard2 = array_chunk($key, $qator1);
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

if(mb_stripos($data, "editNoms=")!==false){
$bolim = explode("=",$data)[1];
file_put_contents("step/$cid2.bol","$bolim");
$ichki = file_get_contents("nakrutka/$bolim/ichki.txt");
$more = explode("\n",$ichki);
$soni = substr_count($ichki,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$key[]=["text"=>"$more[$for]","callback_data"=>"editx=".$more[$for]];
$keyboard2 = array_chunk($key, $qator2);
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

if(mb_stripos($data, "editx=")!==false){
$ichki = explode("=",$data)[1];        
$bolim = file_get_contents("step/$cid2.bol");
$xizmat = file_get_contents("nakrutka/$bolim/$ichki/xizmat.txt");
file_put_contents("step/$cid2.ich","$ichki");
if($xizmat == null){
bot('answerCallbackQuery',[
'callback_query_id'=>$qid,
'text'=>"Hech narsa topilmadi!",
'show_alert'=>true,
]);
}else{
$ids = explode("\n",$xizmat);
$soni = substr_count($xizmat,"\n");
foreach($ids as $id){
$key = [];
$text = "";
for ($for = 1; $for <= $soni; $for++) {
$text .= "<b>$for.</b> ".$ids[$for]."\n";
$key[]=["text"=>"$for","callback_data"=>"editNomlari=".$ids[$for]];
}
$keysboard2 = array_chunk($key, 5);
$keysboard2[] = [['text'=>"Orqaga",'callback_data'=>"buy"]];
$editNomlari = json_encode([
'inline_keyboard'=>$keysboard2,
]);
}
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"<b>Quyidagilardan birini tanlang:</b>

$text",
'parse_mode'=>'html',
'reply_markup'=>$editNomlari
]);
}}

if(mb_stripos($data, "editNomlari=")!==false){
$xiz = explode("=",$data)[1];
$bolim = file_get_contents("step/$cid2.bol");
$ichki = file_get_contents("step/$cid2.ich");
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
file_put_contents("step/$cid2.step","editNomi=$xiz=$bolim=$ichki");
}

if(mb_stripos($step, "editNomi=")!==false){
if($tx=="🗄 Boshqarish"){ 
unlink("step/$cid.step"); 
}else{
$xiz = explode("=",$step)[1];
$bolim = explode("=",$step)[2];
$ichki = explode("=",$step)[3];
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
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
unlink("step/$cid.txt");
}}}}

if(mb_stripos($data, "editXizmat=")!==false){
$nomi = explode("=",$data)[1];
$bolim = file_get_contents("nakrutka/bolim.txt");
file_put_contents("step/nomi.txt","$nomi");
$more = explode("\n",$bolim);
$soni = substr_count($bolim,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$key[]=["text"=>"$more[$for]","callback_data"=>"editXizmats=".$more[$for]];
$keyboard2 = array_chunk($key, $qator1);
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

if(mb_stripos($data, "editXizmats=")!==false){
$bolim = explode("=",$data)[1];
$ichki = file_get_contents("nakrutka/$bolim/ichki.txt");
file_put_contents("step/$cid2.bol",$bolim);
$more = explode("\n",$ichki);
$soni = substr_count($ichki,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$key[]=["text"=>"$more[$for]","callback_data"=>"editXt=".$more[$for]];
$keyboard2 = array_chunk($key, $qator2);
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

if(mb_stripos($data, "editXt=")!==false){
$ichki = explode("=",$data)[1];
$bolim = file_get_contents("step/$cid2.bol");
$xizmat = file_get_contents("nakrutka/$bolim/$ichki/xizmat.txt");
file_put_contents("step/$cid2.ich",$ichki);
if($xizmat == null){
bot('answerCallbackQuery',[
'callback_query_id'=>$qid,
'text'=>"Hech narsa topilmadi!",
'show_alert'=>true,
]);
}else{
$ids = explode("\n",$xizmat);
$soni = substr_count($xizmat,"\n");
foreach($ids as $id){
$key = [];
$text = "";
for ($for = 1; $for <= $soni; $for++) {
$text .= "<b>$for.</b> ".$ids[$for]."\n";
$key[]=["text"=>"$for","callback_data"=>"editXts=".$ids[$for]];
}
$keyboard2 = array_chunk($key, 5);
$keyboard2[] = [['text'=>"Orqaga",'callback_data'=>"buy"]];
$editX = json_encode([
'inline_keyboard'=>$keyboard2,
]);
}
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"<b>Quyidagilardan birini tanlang:</b>

$text",
'parse_mode'=>'html',
'reply_markup'=>$editX
]);
}}

if(mb_stripos($data, "editXts=")!==false){
$xiz = explode("=",$data)[1];
$ichki = file_get_contents("step/$cid2.ich");
$bolim = file_get_contents("step/$cid2.bol");
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
file_put_contents("step/$cid2.step","editXizmatlar=$xiz=$bolim=$ichki");
}

if(mb_stripos($step, "editXizmatlar=")!==false){
if($tx=="🗄 Boshqarish"){ 
unlink("step/$cid.step"); 
}else{
$xiz = explode("=",$step)[1];
$bolim = explode("=",$step)[2];
$ichki = explode("=",$step)[3];
$ex = file_get_contents("step/nomi.txt");
if(in_array($cid,$admin)){
if(isset($text)){
file_put_contents("nakrutka/$bolim/$ichki/$xiz/$ex.txt",$text);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel,
]);
unlink("step/$cid.step");
unlink("step/$cid.txt");
}}}}

$bolim = file_get_contents("nakrutka/bolim.txt");
$more = explode("\n",$bolim);
$soni = substr_count($bolim,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$key[]=["text"=>"$more[$for]","callback_data"=>"delFols=".$more[$for]];
$keyboard2 = array_chunk($key, $qator1);
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
'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$delFol
]);
}}

if(mb_stripos($data, "delFols=")!==false){
$ex = explode("=",$data)[1];
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
'reply_markup'=>$panel,
]);
}

$bolim = file_get_contents("nakrutka/bolim.txt");
$more = explode("\n",$bolim);
$soni = substr_count($bolim,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$key[]=["text"=>"$more[$for]","callback_data"=>"delFolds=".$more[$for]];
$keyboard2 = array_chunk($key, $qator1);
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

if(mb_stripos($data, "delFolds=")!==false){
$bolim = explode("=",$data)[1];
$ichki = file_get_contents("nakrutka/$bolim/ichki.txt");
$more = explode("\n",$ichki);
$soni = substr_count($ichki,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$key[]=["text"=>"$more[$for]","callback_data"=>"delFolm=".$more[$for]."=".$bolim];
$keyboard2 = array_chunk($key, $qator2);
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
'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$delFolds
]);
}}

if(mb_stripos($data, "delFolm=")!==false){	
$ex = explode("=",$data)[1];
$bolim = explode("=",$data)[2];
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
'reply_markup'=>$panel
]);
}

$bolim = file_get_contents("nakrutka/bolim.txt");
$more = explode("\n",$bolim);
$soni = substr_count($bolim,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$key[]=["text"=>"$more[$for]","callback_data"=>"deleteXiz=".$more[$for]];
$keyboard2 = array_chunk($key, $qator1);
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

if(mb_stripos($data, "deleteXiz=")!==false){
$bolim = explode("=",$data)[1];
$ichki = file_get_contents("nakrutka/$bolim/ichki.txt");
file_put_contents("step/$cid2.bol",$bolim);
$more = explode("\n",$ichki);
$soni = substr_count($ichki,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$key[]=["text"=>"$more[$for]","callback_data"=>"delx=".$more[$for]];
$keyboard2 = array_chunk($key, $qator2);
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

if(mb_stripos($data, "delx=")!==false){
$ichki = explode("=",$data)[1];
$bolim = file_get_contents("step/$cid2.bol");
$xizmat = file_get_contents("nakrutka/$bolim/$ichki/xizmat.txt");
file_put_contents("step/$cid2.ich",$ichki);
if($xizmat == null){
bot('answerCallbackQuery',[
'callback_query_id'=>$qid,
'text'=>"Hech narsa topilmadi!",
'show_alert'=>true,
]);
}else{
$ids = explode("\n",$xizmat);
$soni = substr_count($xizmat,"\n");
foreach($ids as $id){
$key = [];
$text = "";
for ($for = 1; $for <= $soni; $for++) {
$text .= "<b>$for.</b> ".$ids[$for]."\n";
$key[]=["text"=>"$for","callback_data"=>"delmat=".$ids[$for]];
}
$keyboard2 = array_chunk($key, 5);
$keyboard2[] = [['text'=>"Orqaga",'callback_data'=>"buy"]];
$delsXiz = json_encode([
'inline_keyboard'=>$keyboard2,
]);
}
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"<b>Quyidagilardan birini tanlang:</b>

$text",
'parse_mode'=>'html',
'reply_markup'=>$delsXiz
]);
}}

if(mb_stripos($data, "delmat=")!==false){
$xizmat = explode("=",$data)[1];
$ichki = file_get_contents("step/$cid2.ich");
$bolim = file_get_contents("step/$cid2.bol");
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
'reply_markup'=>$panel
]);
}

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
}

if($step == "newFol"){
if($tx=="🗄 Boshqarish"){ 
unlink("step/$cid.step"); 
}else{
if(in_array($cid,$admin)){
mkdir("nakrutka/$text");
file_put_contents("nakrutka/bolim.txt","$bolim\n$text");
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>$text</b> - nomli bo'lim qo'shildi!",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}}}

$bolim = file_get_contents("nakrutka/bolim.txt");
$more = explode("\n",$bolim);
$soni = substr_count($bolim,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$title = str_replace("\n","",$more[$for]);
$key[]=["text"=>"$more[$for]","callback_data"=>"adFol-".$more[$for]];
$keyboard2 = array_chunk($key, $qator1);
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
}

if($step == "newFold"){
if($tx=="🗄 Boshqarish"){ 
unlink("step/$cid.step"); 
}else{
if(in_array($cid,$admin)){
mkdir("nakrutka/$test/$text");
file_put_contents("nakrutka/$test/ichki.txt","$ichki\n$text");
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>$text</b> - nomli ichki bo'lim qo'shildi!",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}}}

$bolim = file_get_contents("nakrutka/bolim.txt");
$more = explode("\n",$bolim);
$soni = substr_count($bolim,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$key[]=["text"=>"$more[$for]","callback_data"=>"add-".$more[$for]];
$keyboard2 = array_chunk($key, $qator1);
$keyboard2[] = [['text'=>"Orqaga",'callback_data'=>"buy"]];
$adds = json_encode([
'inline_keyboard'=>$keyboard2,
]);
}

$apikeys = file_get_contents("nakrutka/api.txt");
$allkey = explode("\n",$apikeys);
$soni = substr_count($apikeys,"\n");
$keyboards = [];
for ($i = 1; $i <= $soni; $i++) {
$title = str_replace("\n","",$allkey[$i]);
$url = file_get_contents("nakrutka/api/$allkey[$i].txt");
$read .= "<b>$i.</b> <code>$url</code>\n";
$keyboards[]=["text"=>"$i","callback_data"=>"add=$title"];
}
$key = array_chunk($keyboards, 3);
$apichalar = json_encode([
'inline_keyboard'=>$key,
]);


if($data == "newXiz"){
if($apikeys == null){
bot('answerCallbackQuery',[
'callback_query_id'=>$qid,
'text'=>"API kalitlar topilmadi",
'show_alert'=>true,
]);
}else{
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"<b>Quyidagilardan birini tanlang:</b>

$read",
'parse_mode'=>'html',
'disable_web_page_preview'=>true,
'reply_markup'=>$apichalar,
]);
}
}

if(mb_stripos($data, "add=")!==false){
$ex = explode("=",$data)[1];
file_put_contents("nakrutka/apim.txt",$ex);
$url = file_get_contents("nakrutka/api/$ex.txt");
file_put_contents("nakrutka/url.txt",$url);
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
file_put_contents("step/$cid2.step","ServisID");
}

if($step == "ServisID"){
if($api != null){
file_put_contents("nakrutka/nomi.txt",$text);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>$text</b> qabul qilindi. Endi esa, ushbu xizmatning Servis ID sini kiriting:",
'parse_mode'=>'html',
]);
file_put_contents("step/$cid.step",'kurs');
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>API topilmadi!</b>

Avval botning API sini sozlab oling!",
'parse_mode'=>'html',
]);
}}

if($step == "kurs"){
if(is_numeric($text)==true){
file_put_contents("nakrutka/id.txt",$text);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>$text</b> qabul qilindi!

Ushbu xizmat uchun kursni yuboring: (Masalan qo'shgan xizmatingiz so'mda bo'lsa = 1 yuboring, rublda bo'lsa = rubl kursi)",
'parse_mode'=>'html',
]);
file_put_contents("step/$cid.step",'1ta');
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Faqat raqamlardan foydalaning!</b>",
'parse_mode'=>'html',
]);
}}

if($step == "1ta"){
if(is_numeric($text)==true){
file_put_contents("nakrutka/kurs.txt",$text);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>$text</b> qabul qilindi.

Ushbu xizmat haqida malumot yuboring:",
'parse_mode'=>'html',
]);
file_put_contents("step/$cid.step",'malumot');
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Faqat raqamlardan foydalaning!</b>",
'parse_mode'=>'html',
]);
}}

$bolim = file_get_contents("nakrutka/bolim.txt");
$more = explode("\n",$bolim);
$soni = substr_count($bolim,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$key[]=["text"=>"$more[$for]","callback_data"=>"mana=".$more[$for]];
$keyboard2 = array_chunk($key, $qator1);
$bolim_manager = json_encode([
'inline_keyboard'=>$keyboard2,
]);
}

if($step == "malumot"){
file_put_contents("nakrutka/tavsif.txt", "$text");
if($bolim){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Ma'lumot qabul qilindi</b>

Quyidagilardan birini tanlang:",
'parse_mode'=>'html',
'reply_markup'=>$bolim_manager
]);
unlink("step/$cid.step");
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Bo'limlarni qo'shib qayta urining!</b>",
'parse_mode'=>'html',
]);
}}

if(mb_stripos($data,"mana=")!==false){
$ex=explode("=",$data)[1];
$ichki = file_get_contents("nakrutka/$ex/ichki.txt");
if($ichki == null){
bot('answerCallbackQuery',[
'callback_query_id'=>$qid,
'text'=>"🤷‍♂️ Ichki bo'limlar topilmadi!",
'show_alert'=>true,
]);
}else{
$ichki = file_get_contents("nakrutka/$ex/ichki.txt");
$more = explode("\n",$ichki);
$soni = substr_count($ichki,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$title = str_replace("\n","",$more[$for]);
$key[]=["text"=>"$title","callback_data"=>"tugatish=".$ex."=".$title];
$keyboard2 = array_chunk($key, $qator2);
$keyboard2[] = [['text'=>"◀️ Orqaga",'callback_data'=>"servis"]];
$ichki_manager = json_encode([
'inline_keyboard'=>$keyboard2,
]);
}
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"⬇️ <b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$ichki_manager
]);
}
}

if(mb_stripos($data,"tugatish=")!==false){
$bolim=explode("=",$data)[1];
$ichki=explode("=",$data)[2];
mkdir("nakrutka/$bolim/$ichki/$nomi_manager");
$xizmat = file_get_contents("nakrutka/$bolim/$ichki/xizmat.txt");
file_put_contents("nakrutka/$bolim/$ichki/xizmat.txt","$xizmat\n$nomi_manager");
file_put_contents("nakrutka/$bolim/$ichki/$nomi_manager/id.txt",$id_manager);
file_put_contents("nakrutka/$bolim/$ichki/$nomi_manager/tavsif.txt",$tavsif_manager);
file_put_contents("nakrutka/$bolim/$ichki/$nomi_manager/kurs.txt",$kurs_manager);
file_put_contents("nakrutka/$bolim/$ichki/$nomi_manager/api.txt",$api_manager);
file_put_contents("nakrutka/$bolim/$ichki/$nomi_manager/url.txt",$url_manager);
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>Yangi xizmat muvaffaqiyatli qo'shildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel,
]);
unlink("nakrutka/id.txt");
unlink("nakrutka/tavsif.txt");
unlink("nakrutka/apim.txt");
unlink("nakrutka/nomi.txt");
unlink("nakrutka/url.txt");
}

if($text == "*️⃣ Birlamchi sozlamalar"){
if(in_array($cid,$admin)){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>*️⃣ Birlamchi sozlamalar bo'limidasiz.</b>

<i>1. Valyuta - $valyuta
2. VIP narxi - $narx $valyuta
3. Taklif foizi - $referal%
4. Pul o'tkazish narxi: $transfer $valyuta</i>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"💶 Valyuta",'callback_data'=>"valyuta"]],
[['text'=>"💎 VIP narxi",'callback_data'=>"vnarx"]],
[['text'=>"💸 Taklif foizi",'callback_data'=>"narx"]],
[['text'=>"🔁 O'tkazma narxi",'callback_data'=>"transfer"]],
]])
]);
}}

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
}

if($step == "valyuta"){
if($tx=="🗄 Boshqarish"){ 
unlink("step/$cid.step"); 
}else{
if(in_array($cid,$admin)){
file_put_contents("admin/valyuta.txt",$text);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$asosiy,
]);
unlink("step/$cid.step");
}}}

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
}

if($step == "taklif"){
if($tx=="🗄 Boshqarish"){ 
unlink("step/$cid.step"); 
}else{
if(in_array($cid,$admin)){
file_put_contents("admin/referal.txt",$text);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$asosiy,
]);
unlink("step/$cid.step");
}}}

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
}

if($step == "vnarx"){
if($tx=="🗄 Boshqarish"){ 
unlink("step/$cid.step"); 
}else{
if(in_array($cid,$admin)){
file_put_contents("admin/vip.txt",$text);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$asosiy,
]);
unlink("step/$cid.step");
}}}

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
}

if($step == "transfer"){
if($tx=="🗄 Boshqarish"){ 
unlink("step/$cid.step"); 
}else{
if(in_array($cid,$admin)){
file_put_contents("admin/transfer.txt",$text);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$asosiy,
]);
unlink("step/$cid.step");
}}}

if($text == "📃 Matnlar"){
if(in_array($cid,$admin)){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"Boshlang'ich matni",'callback_data'=>"matn-start"]],
[['text'=>"Qo'llanma",'callback_data'=>"matn-qollanma"]],
[['text'=>"Qoidalar",'callback_data'=>"matn-qoida"]],
]])
]);
}}

if(mb_stripos($data, "matn-")!==false){
$ex = explode("-",$data);
$matn = $ex[1];
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>Yangi qiymatni yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>$boshqarish,
]);
file_put_contents("step/$cid2.step","tahr-$matn");
}

if(mb_stripos($step, "tahr-")!==false){
$ex = explode("-",$step);
$matn = $ex[1];
if($tx=="🗄 Boshqarish"){ 
unlink("step/$cid.step"); 
}else{
if(in_array($cid,$admin)){
file_put_contents("matn/$matn.txt",$text);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel,
]);
unlink("step/$cid.step");
}}}

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
[['text'=>"⚠️ O'z holiga qaytarish",'callback_data'=>"reset"]],
]])
]);
}}

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
[['text'=>"⚠️ O'z holiga qaytarish",'callback_data'=>"reset"]],
]])
]);
}


if($data == "reset"){
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
]])
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
]])
]);
deleteFolder("tugma");
}

if($data == "asosiy"){
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"$key1",'callback_data'=>"tugmath-key1"]],
[['text'=>"$key2",'callback_data'=>"tugmath-key2"],['text'=>"$key3",'callback_data'=>"tugmath-key3"]],
[['text'=>"$key4",'callback_data'=>"tugmath-key4"]],
[['text'=>"$key5",'callback_data'=>"tugmath-key5"],['text'=>"$key6",'callback_data'=>"tugmath-key6"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"tugmalar"]]
]])
]);
}

if($data == "pul_ishlash"){
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"$key7",'callback_data'=>"tugmath-key7"]],
[['text'=>"$key9",'callback_data'=>"tugmath-key9"]],
[['text'=>"$key8",'callback_data'=>"tugmath-key8"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"tugmalar"]]
]])
]);
}

if(mb_stripos($data, "tugmath-")!==false){
$ex = explode("-",$data)[1];
$holat = file_get_contents("tugma/$ex.txt");
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>Hozirgi holat:</b> $holat

<i>Yangi qiymatni yuboring:</i>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqarish"]],
]])
]);
file_put_contents("step/$cid2.step","tugmath-$ex");
}

if(mb_stripos($step, "tugmath-")!==false){
if($tx=="🗄 Boshqarish"){
unlink("step/$cid.step");
}else{
if(in_array($cid,$admin)){
$ex = explode("-",$step)[1];
file_put_contents("tugma/$ex.txt",$text);
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Muvaffaqiyatli o'zgartirildi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel,
]);
unlink("step/$cid.step");
}}}

$bytopish = glob("buyurtma/*/order.txt");
foreach($bytopish as $bytopildi){
$id = str_replace(["buyurtma/","/order.txt"], ["",""], $bytopildi);
$byid = file_get_contents("buyurtma/$id/order.txt");
$ega = file_get_contents("buyurtma/$id/egasi.txt");
$api = file_get_contents("buyurtma/$id/api.txt");
$sayt = file_get_contents("buyurtma/$id/sayt.txt");
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
$get = file_get_contents("pul/$ega.txt");
$get += $plus;
file_put_contents("pul/$ega.txt", $get);
bot('sendMessage',[
'chat_id'=>$ega,
'text'=>"<b>❌ Buyurtma bekor qilindi!

🆔 Buyurtma IDsi:</b> $id
<b>⚠️ Bajarilmagan buyurtma:</b> $miqdor ta 

<b>💵 Qaytarilgan summa:</b> $plus $valyuta",
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
$get = file_get_contents("pul/$ega.txt");
$get += $plus;
file_put_contents("pul/$ega.txt", $get);
bot('sendMessage',[
'chat_id'=>$ega,
'text'=>"<b>❌ Buyurtma bekor qilindi!

🆔 Buyurtma IDsi:</b> $id
<b>⚠️ Bajarilmagan buyurtma:</b> $miqdor ta 

<b>💵 Qaytarilgan summa:</b> $plus $valyuta",
'parse_mode'=>"html",
]);
deleteFolder("buyurtma/$id");
$minus=file_get_contents("buyurtma/$ega.txt");
$oladi = str_replace("\n".$id."","",$minus);
file_put_contents("buyurtma/$ega.txt",$oladi);
}}

?>