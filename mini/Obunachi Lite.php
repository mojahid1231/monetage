<?php
ob_start();
define("builder24",'API_TOKEN');
$builder24 = "ADMIN_ID";
$admins=file_get_contents("admin/admins.txt");
$admin = explode("\n", $admins);
array_push($admin,$builder24);
$bot = bot('getme',['bot'])->result->username;

function name($ch){
$c = bot('getchat',['chat_id' => "@".$ch]);
return $c->result->title;
}

function getAdmin($chat){
$url = "https://api.telegram.org/bot".builder24."/getChatAdministrators?chat_id=@".$chat;
$result = file_get_contents($url);
$result = json_decode ($result);
return $result->ok;
}

function bot($method,$datas=[]){
$url = "https://api.telegram.org/bot".builder24."/".$method;
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

function joinchat($id){
global $mid;
$array = array("inline_keyboard");
$kanallar=file_get_contents("channel.txt");
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

$inew = json_decode(file_get_contents('php://input'));
$message = $inew->message;
$tx = $message->text;
$cid = $message->chat->id;
$mid = $message->message_id;
$text = $message->text;
$chat_id = $message->chat->id;
$message_id = $message->message_id;
$from_id = $message->from->id;
$name = $message->from->first_name;
$username = $message->from->username;
$bio = $message->from->about;

$data = $inew->callback_query->data;
$qid = $inew->callback_query->id;
$cid2 = $inew->callback_query->message->chat->id;
$mid2 = $inew->callback_query->message->message_id;
$callfrid = $inew->callback_query->from->id;
$callname = $inew->callback_query->from->first_name;
$calluser = $inew->callback_query->from->username;
$surname = $inew->callback_query->from->last_name;
$about = $inew->callback_query->from->about;

$step = file_get_contents("step/$cid.step");
$pul = file_get_contents("pul/$cid.txt");
$kpul = file_get_contents("pul/$cid.1txt");
$odam = file_get_contents("odam/$cid.txt");
$ban = file_get_contents("ban/$cid.txt");
$baza = file_get_contents("azo.dat");

$knsh = file_get_contents("admin/kanal_shikoyat.txt");
$valyuta = file_get_contents("admin/valyuta.txt");
$taklif=file_get_contents("admin/taklif.txt");
$kanalo = file_get_contents("admin/kanalobuna.txt");
$kanalt = file_get_contents("admin/kanaltolov.txt");
$saved = file_get_contents("step/inew.txt");
$knhamma = file_get_contents("buyurtma/$cid/hammasi.txt");
$kanallar = file_get_contents("channel.txt");
$buyurtmach = file_get_contents("admin/buyurtma_kanal.txt");
$promo_kanal = file_get_contents("admin/promo_kanal.txt");
$kanalmin =file_get_contents("admin/kanalmin.txt");
$kanalmax =file_get_contents("admin/kanalmax.txt");
$manzil = file_get_contents("nakrutka/$cid/manzil.txt");
$miqdor = file_get_contents("nakrutka/$cid/miqdor.txt");
$mes = file_get_contents("nakrutka/user/$mid.txt");
$kunbonmin = file_get_contents("admin/kunbonus.txt");
$soat=date("H:i",strtotime("2 hour"));
$promo=file_get_contents("admin/promo.txt");
$post = file_get_contents("step/mid.txt");

if(file_get_contents("buyurtma/$cid/hammasi.txt")){
}else{
file_put_contents("buyurtma/$cid/hammasi.txt","0");
}
if(file_get_contents("pul/$cid.txt")){
}else{
file_put_contents("pul/$cid.txt","0");
}
if(file_get_contents("pul/$cid.1txt")){
}else{
file_put_contents("pul/$cid.1txt","0");
}
if(file_get_contents("odam/$cid.txt")){
}else{
file_put_contents("odam/$cid.txt","0");
}
if(file_get_contents("admin/kunbonus.txt")){
}else{
file_put_contents("admin/kunbonus.txt","50");
}
if(file_get_contents("buyurtma/$cid/buyurtma.txt")){
}else{
file_put_contents("buyurtma/$cid/buyurtma.txt","0");
}
if(file_get_contents("buyurtma/$cid2/buyurtma.txt")){
}else{
file_put_contents("buyurtma/$cid2/buyurtma.txt","0");
}
if(file_get_contents("admin/kanal_shikoyat.txt")){
}else{
if(file_put_contents("admin/kanal_shikoyat.txt","10"));
}
if(file_get_contents("admin/taklif.txt")){
}else{
if(file_put_contents("admin/taklif.txt","50"));
}
if(file_get_contents("admin/valyuta.txt")){
}else{
if(file_put_contents("admin/valyuta.txt","so'm"));
}
if(file_get_contents("admin/kanalobuna.txt")){
}else{
if(file_put_contents("admin/kanalobuna.txt","30"));
}
if(file_get_contents("admin/kanaltolov.txt")){
}else{
if(file_put_contents("admin/kanaltolov.txt","25"));
}
if(file_get_contents("admin/buyurtma_kanal.txt")){
}else{
if(file_put_contents("admin/buyurtma_kanal.txt",""));
}
if(file_get_contents("admin/admins.txt")){
}else{
if(file_put_contents("admin/admins.txt","$builder24"));
}
if(file_get_contents("channel.txt")){
}else{
if(file_put_contents("channel.txt",""));
}
if(file_get_contents("admin/kanalmin.txt")){
}else{
if(file_put_contents("admin/kanalmin.txt","5"));
}
if(file_get_contents("admin/kanalmax.txt")){
}else{
if(file_put_contents("admin/kanalmax.txt","500"));
}
if(!file_exists("admin/promo.txt")){

file_put_contents("admin/promo.txt","");

}
#-----------------------------------#
$kategoriya2 = file_get_contents("admin/hamyon/kategoriya.txt");
$raqam = file_get_contents("admin/hamyon/$kategoriya2/raqam.txt");
#-----------------------------------#
mkdir("ban");
mkdir("pul");
mkdir("odam");
mkdir("admin");
mkdir("admin/hamyon");
mkdir("buyurtma");
mkdir("buyurtma/$cid");
mkdir("step");
mkdir("nakrutka");
mkdir("nakrutka/user");
mkdir("nakrutka/shikoyat");
mkdir("nakrutka/$cid");

$panel = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"⚙ Asosiy sozlamalar"]],
[['text'=>"📢 Kanallar"],['text'=>"📊 Statistika"]],
[['text'=>"🎁 Bonuslar"],['text'=>"💳 Hamyonlar"]],
[['text'=>"🔎 Foydalanuvchini boshqarish"]],
[['text'=>"👤 Adminlar"],['text'=>"🎟 Promokod"]],
[['text'=>"✉️ Xabarnoma"],['text'=>"◀️ Orqaga"]],
]]);

$boshqarish = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqarish"]],
]]);

$menu = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"➕ Buyurtma berish"]],
[['text'=>"💳 Hisobim"],['text'=>"💵 Pul ishlash"]],
[['text'=>"☎️ Murojaat"],['text'=>"📚 Bot haqida"]],
]]);

$menus = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"➕ Buyurtma berish"]],
[['text'=>"💳 Hisobim"],['text'=>"💵 Pul ishlash"]],
[['text'=>"☎️ Murojaat"],['text'=>"📚 Bot haqida"]],
[['text'=>"🗄 Boshqarish"]],
]]);

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

$back = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]],
]]);

if($text){
if($ban == "ban"){
exit();
}else{
}}

if($data){
$ban = file_get_contents("ban/$cid2.txt");
if($ban == "ban"){
exit();
}else{
}}

if(isset($message)){
$baza=file_get_contents("azo.dat");
if(mb_stripos($baza,$chat_id) !==false){
}else{
$txt="\n$chat_id";
$file=fopen("azo.dat","a");
fwrite($file,$txt);
fclose($file);
}}

if(mb_stripos($text,"/start")!==false){
$refid = explode(" ",$text);
$refid = $refid[1];
if(strlen($refid)>0 and $refid>0){
if($refid == $cid){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"🖥",
'parse_mode'=>'html',
'reply_markup'=>$menyu,
]);
}else{
if(mb_stripos($baza,"$cid")!==false){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"🖥",
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
}
$joinkey = joinchat($cid);
if($joinkey != null){
$pulim = file_get_contents("pul/$refid.txt");
$a = $pulim + $taklif;
file_put_contents("pul/$refid.txt","$a");
$odam = file_get_contents("odam/$refid.txt");
$b = $odam + 1;
file_put_contents("odam/$refid.txt","$b");
bot('SendMessage',[
'chat_id'=>$refid,
'text'=>"<i>Hisobingizga $taklif $valyuta qo'shildi!</i>",
'parse_mode'=>'html',
]);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"🖥",
'parse_mode'=>'html',
'reply_markup'=>$menyu,
]);
}}}}

if($data == "check"){
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
'text'=>"🖥",
'parse_mode'=>'html',
'reply_markup'=>$menyus,
]);
}else{
$pulim = file_get_contents("pul/$cid3.txt");
$a = $pulim + $taklif;
file_put_contents("pul/$cid3.txt","$a");
$odam = file_get_contents("odam/$cid3.txt");
$b = $odam + 1;
file_put_contents("odam/$cid3.txt","$b");
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"🖥",
'parse_mode'=>'html',
'reply_markup'=>$menyus,
]);
bot('SendMessage',[
'chat_id'=>$cid3,
'text'=>"<i>Hisobingizga $taklif $valyuta qo'shildi!</i>",
'parse_mode'=>'html',
]);
unlink("step/$cid2.id");
unlink("step/$cid2.cid");
}}}

if($text=="/start"){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"🖥",
'parse_mode'=>'html',
'reply_markup'=>$menyu,
]);
unlink("step/$cid.step");
unlink("step/$cid.id");
}

if($text == "◀️ Orqaga" and joinchat($cid)==true){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"🖥",
'parse_mode'=>'html',
'reply_markup'=>$menyu,
]);
unlink("step/$cid.step");
unlink("step/$cid.id");
}

if($text=="💵 Pul ishlash" and joinchat($cid)==true){
if($buyurtmach==null){
$kanal="Editphp";
}else{
$kanal="$buyurtmach";
}
if($buyurtmagr==null){
$kanal2="Editphp";
}else{
$kanal2="$buyurtmagr";
}
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>ℹ️ Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📢 Kanalga kirish",'url'=>"https://t.me/$kanal"]],
[['text'=>"🔗 Taklifnoma",'callback_data'=>"takliflar"]],
[['text'=>"🎫 Promokod",'callback_data'=>"promokod"]],
]])
]);
}

if($data=="promokod"){ 
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>Promokodni yuboring:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]])
]);
file_put_contents("step/$cid2.step","getcoin");
}

if($step == 'getcoin'){
if($text=="◀️ Orqaga"){
unlink("step/$cid.txt");
}else{
$code = file_get_contents("code.txt");
if($text == $code){
$promopul = file_get_contents("codemiq.txt");
$balans = file_get_contents("pul/$cid.txt");
$qoshildi = $balans + $promopul;
file_put_contents("pul/$cid.txt","$qoshildi");
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
[['text'=>"▶️ Botga kirish",'url'=>"https://t.me/$bot"]],
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

if($data=="pul_ishlash" and joinchat($cid2)==true){
if($buyurtmach==null){
$kanal="Editphp";
}else{
$kanal="$buyurtmach";
}
if($buyurtmagr==null){
$kanal2="Editphp";
}else{
$kanal2="$buyurtmagr";
}
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>ℹ️ Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📢 Kanalga kirish",'url'=>"https://t.me/$kanal"]],
[['text'=>"🔗 Taklifnoma",'callback_data'=>"takliflar"]],
[['text'=>"🎫 Promokod",'callback_data'=>"promokod"]],
]])
]);
}

$vaqt = date('d-m-y');
mkdir("bonus");
if($data == "kunbonus" and joinchat($cid2)==true){
$bonustime = file_get_contents("bonus/$callfrid.txt");
$bonusrand = file_get_contents("admin/kunbonus.txt");
if($bonustime == $vaqt){
bot('answerCallbackQuery',[
'callback_query_id'=>$qid,
'text'=>"📛 Siz bonus olib bo'lgansiz!",
'show_alert'=>true,
]);
}else{
$olmos=file_get_contents("pul/$callfrid.txt");
$bonus=$olmos+$bonusrand;
file_put_contents("pul/$callfrid.txt","$bonus");
file_put_contents("bonus/$callfrid.txt","$vaqt");
bot("editMessageText",[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"<b>💸 Kunlik bonus - $bonusrand $valyuta

✅ Bonus berildi! ✅</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"kabinet"]],
]])
]);
}}

if($data == "takliflar" and joinchat($cid2)==true){
$odam = file_get_contents("odam/$cid2.txt");
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>⚡️ Sizning taklif havolangiz:</b>

<code>https://t.me/$bot?start=$cid2</code>

<b>1 ta taklif uchun $taklif $valyuta beriladi

Sizning takliflaringiz: $odam ta</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"pul_ishlash"]],
]])
]);
}

if($text == "💳 Hisobim" and joinchat($cid)==true){
$kunbonnom=file_get_contents("admin/nom.txt");
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🔑 Sizning ID raqamingiz:</b> <code>$cid</code>

💵 <b>Umumiy balansingiz:</b> $pul $valyuta
👥 <b>Takliflaringiz soni:</b> $odam ta
🗄 <b>Buyurtmalaringiz:</b> $knhamma ta

💳 <b>Botga kiritgan pullaringiz:</b> $kpul $valyuta",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔁 O'tkazmalar",'callback_data'=>"otkazma"],['text'=>"$kunbonnom",'callback_data'=>"kunbonus"]],
[['text'=>"💳 Hisobni to'ldirish",'callback_data'=>"toldirish"]],
]])
]);
}

if($data == "otkazma" and joinchat($cid2)=="true"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>Foydalanuvchi ID raqamini yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]]
]])
]);
file_put_contents("step/$cid2.txt","otkazma");
}

if($step == "otkazma"){
if($text=="◀️ Orqaga"){
unlink("step/$cid.txt");
}else{
$odambor = file_get_contents("pul/$text.txt");
if($odambor){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>O'tkazma miqdorini yuboring:

💵 Asosiy balans:</b> $pul $valyuta",
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

if(mb_stripos($step, "otkazma2-")!==false){
if($text=="◀️ Orqaga"){
unlink("step/$cid.txt");
}else{
$ex = explode("-",$step);
$odam = $ex[1];
$qoshiladi=file_get_contents("pul/$odam.txt");
$olinadi = file_get_contents("pul/$cid.txt");
$komisa = $text / 1 * 1;
if($olinadi>=$komisa and $text>=0){
$plus = $qoshiladi + $text;
$minus = $olinadi - $komisa;
file_put_contents("pul/$odam.txt","$plus");
file_put_contents("pul/$cid.txt","$minus");
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

if($data == "kabinet" and joinchat($cid2)==true){
$pul = file_get_contents("pul/$cid2.txt");
$kpul = file_get_contents("pul/$cid2.1txt");
$odam = file_get_contents("odam/$cid2.txt");
$knhamma=file_get_contents("buyurtma/$cid2/hammasi.txt");
$kunbonnom=file_get_contents("admin/nom.txt");
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>🔑 Sizning ID raqamingiz:</b> <code>$cid2</code>

💵 <b>Umumiy balansingiz:</b> $pul $valyuta
👥 <b>Takliflaringiz soni:</b> $odam ta
🗄 <b>Buyurtmalaringiz:</b> $knhamma ta

💳 <b>Botga kiritgan pullaringiz:</b> $kpul $valyuta",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔁 O'tkazmalar",'callback_data'=>"otkazma"],['text'=>"$kunbonnom",'callback_data'=>"kunbonus"]],
[['text'=>"💳 Hisobni to'ldirish",'callback_data'=>"toldirish"]],
]])
]);
}

if($data == "toldirish" and joinchat($cid2)==true){
$kategoriya = file_get_contents("admin/hamyon/kategoriya.txt");
$more = explode("\n",$kategoriya);
$soni = substr_count($kategoriya,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$title = str_replace("\n","",$more[$for]);
$key[]=["text"=>"$title","callback_data"=>"karta-$title"];
$keyboard2 = array_chunk($key, 1);
$keyboard2[] = [['text'=>"◀️ Orqaga",'callback_data'=>"kabinet"]];
$bolim = json_encode([
'inline_keyboard'=>$keyboard2,
]);
}
if($kategoriya == null){
bot("answerCallbackQuery",[
"callback_query_id"=>$qid,
"text"=>"⚠️ To'lov tizimlari qo'shilmagan!",
"show_alert"=>true,
]);
}else{
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"<b>💳 To'lov tizimlaridan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$bolim,
]);
}}

if(mb_stripos($data, "karta-")!==false){
$ex = explode("-",$data);
$kategoriya = $ex[1];
$raqam = file_get_contents("admin/hamyon/$kategoriya/raqam.txt");
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"<b>📲 To‘lov turi:</b> <u>$kategoriya</u>

💳 Karta: <code>$raqam</code>
📝 Izoh: #ID$cid2

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
[['text'=>"◀️ Orqaga",'callback_data'=>"toldirish"]],
]])
]);
}

if($data == "tolov"){
bot('DeleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>📝 Pul miqdorini yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]],
]])
]);
file_put_contents("step/$cid2.step",'oplata');
}

if($step == "oplata"){
if($text=="◀️ Orqaga"){
unlink("step/$cid.step");
}else{
file_put_contents("step/hisob.$cid",$text);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🧾 To'lov haqidagi chekni yuboring:</b>",
'parse_mode'=>'html',
]);
file_put_contents("step/$cid.step",'rasm');
}}

if($step == "rasm"){
if($text=="◀️ Orqaga"){
unlink("step/$cid.step");
}else{
$photo = $message->photo;
$file = $photo[count($photo)-1]->file_id;
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⏱ So'rovingiz adminga yuborildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$menyu,
]);
$hisob=file_get_contents("step/hisob.$cid");
unlink("step/$cid.step");
bot('sendPhoto',[
'chat_id'=>$builder24,
'photo'=>$file,
'caption'=>"📄 <b>Foydalanuvchidan check:

👮‍♂️ Foydalanuvchi:</b> <a href='https://tg://user?id=$cid'>$cid</a>
💵 <b>To'lov miqdori:</b> $hisob $valyuta",
'disable_web_page_preview'=>true,
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✅ To'ldirish",'callback_data'=>"on=$cid"],['text'=>"❌ O'chirish",'callback_data'=>"off=$cid"]],
]])
]);
}}

if(mb_stripos($data,"on=")!==false){
$odam=explode("=",$data)[1];
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
$hisob=file_get_contents("step/hisob.$odam");
bot('SendMessage',[
'chat_id'=>$odam,
'text'=>"<b>✅ So'rovingiz qabul qilindi!</b>

<i>Hisobingiz $hisob $valyuta ga to'ldirildi</i>",
'parse_mode'=>'html',
]);
$currency=file_get_contents("pul/$odam.1txt");
$get = file_get_contents("pul/$odam.txt");
$get += $hisob;
$currency += $hisob;
file_put_contents("pul/$odam.txt",$get);
file_put_contents("pul/$odam.1txt",$currency);
bot('SendMessage',[
'chat_id'=>$builder24,
'text'=>"<b>✅ Foydalanuvchi hisobi $hisob $valy ga to'ldirildi!</b>",
'parse_mode'=>'html',
]);
unlink("step/hisob.$odam");
}

if(mb_stripos($data,"off=")!==false){
$odam=explode("=",$data)[1];
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
$hisob=file_get_contents("step/hisob.$odam");
bot('SendMessage',[
'chat_id'=>$odam,
'text'=>"<b>⚠️ So'rovingiz qabul qilinmadi!</b>",
'parse_mode'=>'html',
]);
bot('SendMessage',[
'chat_id'=>$builder24,
'text'=>"<b>⚠️ Foydalanuvchi cheki o'chirildi!</b>",
'parse_mode'=>'html',
]);
unlink("step/hisob.$odam");
}

if($text=="☎️ Murojaat" and joinchat($cid)==true){
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
}

if($data=="boglanish" and joinchat($cid2)==true){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>📝 Murojaat matnini yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]],
]])
]);
file_put_contents("step/$cid2.step","murojat");
}

if($step=="murojat"){
if($text=="◀️ Orqaga"){
unlink("step/$cid.step");
}else{
file_put_contents("step/$cid.murojat","$cid");
$murojat=file_get_contents("step/$cid.murojat");
bot('sendMessage',[
'chat_id'=>$builder24,
'text'=>"<b>📨 Yangi murojat keldi:</b> $murojat

<b>📑 Murojat matni:</b> $text

<b>⏰ Kelgan vaqti:</b> $soat",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"💌 Javob yozish",'callback_data'=>"yozish=$murojat"]],
]])
]);
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>✅ Murojaatingiz yuborildi.</b>

<i>Tez orada javob qaytaramiz!</i>",
'parse_mode'=>'html',
'reply_markup'=>$menyu,
]);
unlink("step/$murojat.step");
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
if($tx=="◀️ Orqaga"){
unlink("step/$cid.step");
unlink("step/$cid.javob");
}else{
$murojat=file_get_contents("step/$cid.javob");
bot('sendMessage',[
'chat_id'=>$murojat,
'text'=>"<b>☎️ Administrator:</b>

$text",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"☎️ Murojaat",'callback_data'=>"boglanish"]],
]])
]);
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Javob yuborildi</b>",
'parse_mode'=>"html",
'reply_markup'=>$menus,
]);
unlink("step/$murojat.murojat");
unlink("step/$cid.step");
unlink("step/$cid.javob");
}}

if($text=="📚 Bot haqida" and joinchat($cid)==true){
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"<b>Ma'lumot olish uchun, quyidagi tugmalardan foydalaning:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📊 Statistika",'callback_data'=>"statbot"]],
[['text'=>"📚 Qo'llanma",'callback_data'=>"qollanma"]],
[['text'=>"⚠️ Qoidalar",'callback_data'=>"qoida"]],
]])
]);
}

if($data=="orqa"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendmessage',[
'chat_id'=>$cid2,
'text'=>"<b>Ma'lumot olish uchun, quyidagi tugmalardan foydalaning:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📊 Statistika",'callback_data'=>"statbot"]],
[['text'=>"📚 Qo'llanma",'callback_data'=>"qollanma"]],
[['text'=>"⚠️ Qoidalar",'callback_data'=>"qoida"]],
]])
]);
}

if($data == "statbot"){
$obsh = substr_count($baza,"\n");
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"<b>📊 Bot foydalanuvchilari soni: $obsh ta</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"orqa"]],
]])
]);
}

if($data == "qoida"){
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"<b>Muhum qoidalar bilan tanishing:</b>

<i>• Adminga yolgʻon xabar yubormang. Bu uchun botda ban olishingiz mumkin!

• Murojaat boʻlimidan foydalanayotganda adminga haqiratli soʻz yozmang. Bu uchun botda ban olishingiz mumkin!

• Admindan tekinga yoki savob uchun hisobingizni toʻldirishni soʻramang!

• Admin hamyoniga kiritilgan pullar yoki bot hisobidagi pullaringizni chiqarib yoki qaytarib ololmaysiz. Pul kirgizishda summa miqdoriga yaxshilan etibor bering!</i>

<b>Qoʻshimcha maʼlumotlar olish uchun administrator bilan bogʻlang!</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"☎️ Administrator",url=>"tg://user?id=$admin"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"orqa"]],
]])
]);
}

if($data == "qollanma"){
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"<b>Tez-tez beriladigan savollarga javoblar:

⁉️ $bot oʻzi qanday bot va nima vazifa bajaradi?</b>
✅ <i>$bot orqali oʻzingizni kanal va guruh uchun obunachi koʻpaytirish imkoniyatiga egasiz. Eng muhumi bularning barchasi tez, sifatli, ishonchli va hamyonbob boʻladi!</i>

⁉️ <b>Hisobimni qanday toʻldirsam boʻladi?</b>
✅ <i>Hisobingizni toʻldirish uchun botdagi "."Hisobim"." boʻlimiga kiring va "."Pul kiritish"." tugmasini bosing. Oʻzingizga kerakli hamyonni tanlab toʻlov qiling. Toʻlov haqidagi soʻroʻvingiz 24-soat ichida koʻrib chiqiladi!</i>

⁉️ <b>Qanday qilib buyurtma berish mumkin?</b>
✅ <i>Buyurtma berish uchun "."Buyurtma berish"." boʻlimiga kiring. Oʻzingizga kerakli boʻlimni tanlang soʻng kerakli xizmatni tanlab miqdor va havolani kiritish kifoya!</i>

⁉️ ️<b>Agarda bot haqida savol yoki takliflaringiz bo'lsa administrator bilan bog'laning!</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"☎️ Administrator",url=>"tg://user?id=$admin"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"orqa"]],
]])
]);
}

if($text == "➕ Buyurtma berish" and joinchat($cid)==true){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⬇️ Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📢 Telegram - kanal",'callback_data'=>"kanal"]],
]])
]);
}

if($data == "buyurtma" and joinchat($cid2)==true){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>⬇️ Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📢 Telegram - kanal",'callback_data'=>"kanal"]],
]])
]);
}

if($data=="kanal" and joinchat($cid2)==true){
if($buyurtmach==null){
bot("answerCallbackQuery",[
"callback_query_id"=>$qid,
"text"=>"⚠️ Buyurtmalar kanali ulanmagan!",
"show_alert"=>true,
]);
}else{
$pul = file_get_contents("pul/$cid2.txt");
$kanalmin = $pul / $kanalo;
$kanalmax = floor($kanalmin);
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"📢 <b>Ushbu bot kanalingizga obunachilar yig'ib olishingizga yordam beradi</b>

👤 1 ta obunachi - <b>$kanalo $valyuta</b>
💳 Balansingiz: <b>$pul $valyuta</b>

📊 Siz <b>$kanalmax ta obunachini</b> buyurtma qilishingiz mumkin!",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Obunachi qo'shish",'callback_data'=>"addkn"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"buyurtma"]]
]])
]);
}}

if($data =="addkn" and joinchat($cid2)==true){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>Buyurtma miqdorini yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>$back,
]);
file_put_contents("step/$cid2.step",'miqdorkn');
}

if($step == "miqdorkn"){
$min = "$kanalmin";
$max = "$kanalmax";
if(is_numeric($text)=="true"){
if($text >= $min and $text <= $max){
$inew = $text * $kanalo;
if($pul >= $inew){
file_put_contents("nakrutka/$cid/miqdor.txt",$text);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Buyurtma miqdori: $text ta</b>

<i>Kanalingiz manzilini yuboring:
Namuna:</i> @$buyurtmach",
'parse_mode'=>'html',
]);
file_put_contents("step/$cid.step",'manzilkn');
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Hisobingizda yetarli mablag' mavjud emas!</b>

<i>Qayta kiriting:</i>",
'parse_mode'=>'html',
]);
}
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Minimal buyurtma - $min ta, 
Maksimal buyurtma - $max ta</b>

Qayta kiriting:",
'parse_mode'=>'html',
]);
}
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Raqamlardan foydalanib kiriting:</b>",
'parse_mode'=>'html',
]);
}}

if($step == "manzilkn"){
if(stripos($text,"@")!==false){
$get = bot('getChat',['chat_id'=>$text]);
$types = $get->result->type;
$ch_name = $get->result->title;
$ch_user = $get->result->username;
if($types != "supergroup" and $types != "group"){
if($types=="channel"){
$pulmiq=file_get_contents("nakrutka/$cid/miqdor.txt");
file_put_contents("nakrutka/$cid/manzil.txt",$text);
$inew = $pulmiq * $kanalo;
unlink("step/$cid.step");
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 Malumotnoma: </b> Buyurtma ma'lumotlarini tekshiring va tasdiqlang!

📜 <b>Buyurtma turi:</b> Telegram - kanal
🔢 <b>Buyurtma miqdori:</b> $pulmiq ta
🔗 <b>Buyurtma havolasi:</b> $text
💵 <b>Buyurtma narx:</b> $inew $valyuta

💳 <b>Sizning balansingiz:</b> $pul $valyuta",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✅ Tasdiqlash",'callback_data'=>"trueresultkn"]],
]])
]);
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>❗️ Bunday kanal topilmadi:</b>

<i>Qayta urinib ko'ring:</i>",
'parse_mode'=>'html',
]);
}
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>❗️ Guruh qo'shish mumkin emas:</b>

<i>Qayta urinib ko'ring:</i>",
'parse_mode'=>'html',
]);
}
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>❗️ Manzil @$buyurtmach ko'rinishda bo'lishi kerak.</b>

<i>Qayta urinib ko'ring:</i>",
'parse_mode'=>'html',
]);
}}

if($data=="trueresultkn" and joinchat($cid2)==true){
$knnak=file_get_contents("nakrutka/$cid2/manzil.txt");
$get = bot('getChat',['chat_id'=>$knnak]);
$ch_user = $get->result->username;
$ch_name = $get->result->title;
$ch_id = $get->result->id;
if(getAdmin($ch_user)!= true){
bot('answerCallbackQuery',[
'callback_query_id'=>$qid,
'text'=>"Bot kanalga admin qilinmagan!

Admin qilib ✅ Tasdiqlash tugmasini bosing!",
'show_alert'=>true,
]);
}else{
$pul = file_get_contents("pul/$cid2.txt");
$pulmiq=file_get_contents("nakrutka/$cid2/miqdor.txt");
$inew = $pulmiq * $kanalo;
$m = $pul - $inew;
file_put_contents("pul/$cid2.txt",$m);
$knnak=file_get_contents("nakrutka/$cid2/manzil.txt");
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b> ✅ Buyurtmangiz kanalga yuborildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$menyus,
]);
unlink("step/$cid2.step");
bot('sendMessage',[
'chat_id'=>"@".$buyurtmach."",
'text'=>"<b>📢 Quyidagi kanalga obuna bo'ling:

(🔎)-</b> @$ch_user
<b>(➕)-</b> $pulmiq ta

<b>💵 Kanalga obuna bo'ling va tekshirish tugmasini bosing!
(🤖)-</b> @$bot",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"⏩ Kanalga kirish",'url'=>"https://t.me/$ch_user"]],
[['text'=>"✅ Tekshirish",'callback_data'=>"tekshirkn=$pulmiq=$cid2=$ch_user"]],
[['text'=>"🗄",'callback_data'=>"buyurtma=$pulmiq=$cid2=$ch_user"],['text'=>"🔞",'callback_data'=>"yomon1=$pulmiq=$cid2=$ch_user"],['text'=>"🗑",'callback_data'=>"delete1=$pulmiq=$cid2=$ch_user"]],
[['text'=>"🤖 Botga kirish",'url'=>"https://t.me/$bot"]],
]])
]);
$knhamma = file_get_contents("buyurtma/$cid2/hammasi.txt");
$knhamma += 1;
file_put_contents("buyurtma/$cid2/hammasi.txt", $knhamma);
}}

if(stripos($data,"yomon1=")!==false && stripos($baza,"$callfrid")!==false){
$pulmiq1 = $ex[1];
$egasi = $ex[2];
$k_user = $ex[3];
$yomon = file_get_contents("nakrutka/shikoyat/$mid2.txt");
if(stripos($yomon,"$callfrid")!== false){
bot('answercallbackquery', [
'callback_query_id'=>$qid,
'text'=>"⚠️ Shikoyat qilib bo'lgansiz!",
'show_alert'=>true
]);
}else{
file_put_contents("nakrutka/shikoyat/$mid2.txt","\n".$callfrid,FILE_APPEND);
bot('answercallbackquery',[
'callback_query_id'=>$qid,
'text'=>"✅ Shikoyatingiz qabul qilindi!",
'show_alert'=>true
]);
$sh = substr_count(file_get_contents("nakrutka/shikoyat/$mid2.txt"),"\n");
bot('sendMessage',[
'chat_id'=>$builder24,
'parse_mode'=>'markdown',
'text'=>"⚠️ [$mid2](https://t.me/$buyurtmach/$mid2) *sonli buyurtmaga shikoyat tushdi!*",
'disable_web_page_preview'=>true,
]);
}

if($sh>=$knsh){
bot('deleteMessage',[
'chat_id'=>"@".$buyurtmach."",
'message_id'=>$mid2,
]);
bot('sendMessage',[
"chat_id"=>$egasi,
"text"=>"❗️ <b>Sizning @$k_user buyurtmangiz o'chirildi:</b>

Shikoyatlar soni $knsh-taga yetdi!",
"parse_mode"=>'html',
]);
$knhamma = file_get_contents("buyurtma/$egasi/hammasi.txt");
$knhamma -= 1;
file_put_contents("buyurtma/$egasi/hammasi.txt", $knhamma);
unlink("nakrutka/user/$mid2.txt");
unlink("nakrutka/shikoyat/$mid2.txt");
}}

if(stripos($data,"buyurtma=")!==false){
$ex = explode("=",$data);
$pulmiq = $ex[1];
$cid2 = $ex[2];
$user = $ex[3];
$idkan = bot('getchat',['chat_id'=>"@".$kn_user,])->result->id;
$okey = substr_count(file_get_contents("nakrutka/user/$mid2.txt"),"\n");
$shikoyat= substr_count(file_get_contents("nakrutka/shikoyat/$mid2.txt"),"\n");
bot('answercallbackquery',[
'callback_query_id'=>$qid,
'text'=>"📊 Buyurtma holati: Aktiv

🔗 Manzil: @$user
🗣 Buyurtma: $pulmiq ta
✅ Bajarildi: $okey ta
⚠️ Shikoyat: $shikoyat ta",
'show_alert'=>true,
]);
}

if(stripos($data,"delete1=")!==false && stripos($baza,"$callfrid")!==false){
$ex = explode("=",$data);
$egasi = $ex[2];
$kn_user = $ex[3];
if(stripos($egasi,"$callfrid")!== false){
bot('deleteMessage',[
'chat_id'=>"@".$buyurtmach."",
'message_id'=>$mid2,
]);
bot('sendMessage',[
"chat_id"=>$egasi,
"text"=>"🗑 <b>Sizning @$kn_user buyurtmangiz o'chirildi!</b>",
"parse_mode"=>'html',
]);
$knhamma = file_get_contents("buyurtma/$egasi/hammasi.txt");
$knhamma -= 1;
file_put_contents("buyurtma/$egasi/hammasi.txt", $knhamma);
unlink("nakrutka/user/$mid2.txt");
unlink("nakrutka/shikoyat/$mid2.txt");
}else{
bot('answercallbackquery',[
'callback_query_id'=>$qid,
'text'=>"⚠️ Siz buyurtmani o'chira olmaysiz!",
'show_alert'=>true,
]);
}}

if(stripos($data,"tekshirkn=")!==false && stripos($baza,"$callfrid")!==false){
$ex = explode("=",$data);
$miqdor = $ex[1];
$id = $ex[2];
$manzil = $ex[3];
$ue = file_get_contents("nakrutka/user/$mid2.txt");
if(stripos($ue,"$callfrid") !== false){
bot('answercallbackquery', [
'callback_query_id'=>$qid,
'text'=>"❌ Siz bu buyurtmadan pul olgansiz!",
'show_alert'=> true,
]);
}else{
$okch = json_decode(file_get_contents("https://api.telegram.org/bot".builder24."/getChatMember?chat_id=@".$manzil."&user_id=".$callfrid))->result->status;
if($okch=='member' || $okch=='creator' || $okch=='administrator'){
$user = substr_count(file_get_contents("nakrutka/user/$mid2.txt"),"\n");
if($user>=5){
$narx3 = $kanalt;
}else{
$narx3 = $kanalt;
}
file_put_contents("nakrutka/user/$mid2.txt","\n".$callfrid,FILE_APPEND);
$pul = file_get_contents("pul/$callfrid.txt");
$puls = $pul + $narx3;
file_put_contents("pul/$callfrid.txt","$puls");
$holat = file_get_contents("buyurtma/$id/buyurtma.txt");
$addh = $holat + 1;
file_put_contents("buyurtma/$id/buyurtma.txt","$addh");
bot('answercallbackquery',[
'callback_query_id'=>$qid,
'text'=>"📳 Hisobingizga $narx3 $valyuta qo'shildi!",
'show_alert'=> true,
]);
}else{
bot('answercallbackquery', [
'callback_query_id'=>$qid,
'text'=>"⛔ Kanalga obuna bo'lmadingiz!",
'show_alert'=> true,
]);
}}

$okey = substr_count(file_get_contents("nakrutka/user/$mid2.txt"),"\n");
if($okey>=$miqdor){
bot('deleteMessage',[
'chat_id'=>"@".$buyurtmach."",
'message_id'=>$mid2,
]);
bot('sendMessage',[
"chat_id"=>$id,
"text"=>"✅ <b>Sizning @$manzil buyurtmangiz muvaffaqiyatli bajarildi!</b>",
"parse_mode"=>'html',
]);
unlink("nakrutka/user/$mid2.txt");
unlink("nakrutka/shikoyat/$mid2.txt");
}

if(getAdmin($manzil) != true){
bot('deleteMessage',[
'chat_id'=>"@".$buyurtmach."",
'message_id'=>$mid2,
]);
bot('sendMessage',[
"chat_id"=>$id,
'text'=>"⚠️ <b>Buyurtmangiz bekor qilindi!

Sababi:</b> Bot kanaldan adminlikdan olindi.",
"parse_mode"=>'html',
]);
$knhamma = file_get_contents("buyurtma/$id/hammasi.txt");
$knhamma -= 1;
file_put_contents("buyurtma/$id/hammasi.txt", $knhamma);
unlink("nakrutka/user/$mid2.txt");
}}

#Panel____-----____Boshqaruv

if($text == "📢 Kanallar"){
if(in_array($cid,$admin)){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔐 Majburiy obuna",'callback_data'=>"majburiy"]],
[['text'=>"📢 Vazifalar kanali",'callback_data'=>"vazifa"]],
[['text'=>"🎫 Promokod kanali",'callback_data'=>"promokodkanal"]],
]])
]);
}}

if($data=="promokodkanal"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>📢 Kerakli kanalni manzilini yuboring:</b>

Namuna: @HaydarovUz",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqarish"]],
]])
]);
file_put_contents("step/$cid2.step","promo");
}
if($step == "promo" ){
if($tx=="🗄 Boshqaridh"){
unlink("step/$cid.step");
}else{
if(stripos($text,"@")!==false){
$get = bot('getChat',['chat_id'=>$text]);
$types = $get->result->type;
$ch_name = $get->result->title;
$ch_user = $get->result->username;
file_put_contents("admin/promo.txt", "$ch_user");
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Muvaffaqiyatli saqlandi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel,
]);
unlink("step/$cid.step");
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⚠️ Kanal manzili kiritishda xatolik:</b>

Masalan: @HaydarovUz",
'parse_mode'=>'html',
]);
}}}

if($data=="kanalsoz"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔐 Majburiy obuna",'callback_data'=>"majburiy"]],
[['text'=>"📢 Vazifalar kanali",'callback_data'=>"vazifa"]],
[['text'=>"🎫 Promokod kanali",'callback_data'=>"promokodkanal"]],
]])
]);
}

if($data=="majburiy"){
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"<b>Majburiy obunalarni sozlash bo'limidasiz:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📋 Ro'yxatni ko'rish",'callback_data'=>"mroyxat"]],
[['text'=>"➕ Qo'shish",'callback_data'=>"kqosh"],['text'=>"🗑 O'chirish",'callback_data'=>"kochir"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"kanalsoz"]],
]])
]);
}

if($data=="kqosh"){
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>📢 Kerakli kanalni manzilini yuboring:</b>

Namuna: @HaydarovUz",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqarish"]],
]])
]);
file_put_contents("step/$cid2.step","qosh");
}
if($step == "qosh"){
if($tx=="🗄 Boshqarish"){
unlink("step/$cid.step");
}else{
if(stripos($text,"@")!==false){
if($kanallar == null){
file_put_contents("channel.txt",$text);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>$text - kanal qo'shildi</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel,
]);
unlink("step/$cid.step");
}else{
file_put_contents("channel.txt","$kanallar\n$text");
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>$text - kanal qo'shildi</b>",
'parse_mode'=>'html',
'reply_markup'=>$admin1_menu,
]);
unlink("step/$cid.step");
}}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⚠️ Kanal manzili kiritishda xatolik:</b>

Masalan: @HaydarovUz",
'parse_mode'=>'html',
]);
}}}

if($data=="kochir"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>🗑 Kanallar o'chirildi!</b>",
'parse_mode'=>"html",
]);
unlink("channel.txt");
}

if($data=="mroyxat"){
if($kanallar==null){
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"<b>Kanallar ulanmagan!</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"majburiy"]],
]])
]);
}else{
$soni = substr_count($kanallar,"@");
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"<b>Ulangan kanallar ro'yxati ⤵️</b>

<i>$kanallar</i>

<b>Ulangan kanallar soni:</b> $soni ta",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"majburiy"]],
]])
]);
}}

if($data=="vazifa"){
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"<b>Vazifa kanalni sozlash bo'limidasiz:</b>

<b>Kanal uchun:</b> @$buyurtmach",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📢 Kanal uchun",'callback_data'=>"vazifa1"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"kanalsoz"]],
]])
]);
}

if($data=="vazifa1"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>📢 Kerakli kanalni (@siz) yuboring:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqarish"]],
]])
]);
file_put_contents("step/$cid2.step","vazifa1");
}
if($step == "vazifa1"){
if($text=="🗄 Boshqarish"){
unlink("step/$cid.step");
}else{
if(stripos($text,"@")==false){
file_put_contents("admin/buyurtma_kanal.txt","$text");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>@$text qabul qilindi!</b>

⚠️ @$bot ni kanalingizga admin qiling!",
'parse_mode'=>"html",
'reply_markup'=>$panel,
]);
unlink("step/$cid.step");
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⚠️ Kanal manzili kiritishda xatolik:</b>

Masalan: HaydarovUz",
'parse_mode'=>'html',
]);
}}}

if($text == "🗄 Boshqarish"){
if(in_array($cid,$admin)){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Assalomu alaykum admin panelga xush kelibsiz!</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel,
]);
unlink("step/inew.txt");
unlink("step/$cid.step");
unlink("code.txt");
unlink("codemiq.txt"); 
}}

if($data == "boshqarish"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
unlink("step/$cid.step");
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>Assalomu alaykum admin panelga xush kelibsiz!</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel,
]);
}

if($data == "asosiy"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>⚙️ Asosiy sozlamalar bo'limiga xush kelibsiz!</b>

<i>Nimani o'zgartiramiz?</i>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"⚙ Kanal sozlamalari",'callback_data'=>"kanal_sozlash"]],
[['text'=>"🔗 Taklif narxi",'callback_data'=>"taklif"],['text'=>"💶 Valyuta nomi",'callback_data'=>"valyuta"]],
]])
]);
}

if($data == "valyuta"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>📝 Yangi valyuta nomini yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>$boshqarish,
]);
file_put_contents("step/$cid2.step",'valyuta');
}

if($step == "valyuta"){
if($text == "🗄 Boshqarish"){
unlink("step/$cid.step");
}else{
file_put_contents("admin/valyuta.txt",$text);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel,
]);
unlink("step/$cid.step");
}}

if($data == "taklif"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>📝 Yangi taklif narxini yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>$boshqarish,
]);
file_put_contents("step/$cid2.step",'taklif');
}

if($step == "taklif"){
if($text == "🗄 Boshqarish"){
unlink("step/$cid.step");
}else{
file_put_contents("admin/taklif.txt",$text);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel,
]);
unlink("step/$cid.step");
}}

if($text == "⚙ Asosiy sozlamalar"){
if(in_array($cid,$admin)){
$baza = file_get_contents("azo.dat");
$obsh = substr_count($baza,"\n");
$load = sys_getloadavg();
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⚙️ Asosiy sozlamalar bo'limiga xush kelibsiz!</b>

<i>Nimani o'zgartiramiz?</i>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"⚙ Kanal sozlamalari",'callback_data'=>"kanal_sozlash"]],
[['text'=>"🔗 Taklif narxi",'callback_data'=>"taklif"],['text'=>"💶 Valyuta nomi",'callback_data'=>"valyuta"]],
]])
]);
}}

if($data=="kanal_sozlash"){
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"<b>⚙️ Kanal sozlash bo'limiga xush kelibsiz!</b>

Buyurtma shikoyat: <b>$knsh</b> ta
1ta obunachi narxi: <b>$kanalo</b> $valyuta
Obuna uchun to'lov: <b>$kanalt</b> $valyuta
Min buyurtma soni: <b>$kanalmin</b> ta
Max buyurtma soni: <b>$kanalmax</b> ta",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🚫 Shikoyatni sozlash",'callback_data'=>"kn_shikoyat"]],
[['text'=>"👤 Obunachi narxi",'callback_data'=>"kn_obunarx"],['text'=>"💴 Obuna uchun to'lov",'callback_data'=>"kn_narx"]],
[['text'=>"⬇️ Min buyurtma",'callback_data'=>"kn_min"],['text'=>"⬆️ Max buyurtma",'callback_data'=>"kn_max"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"asosiy"]],
]])
]);
}

if($data == "kn_shikoyat"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>📝 Yangi qiymatni yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>$boshqarish,
]);
file_put_contents("step/$cid2.step",'shikoyat');
}

if($step == "shikoyat"){
if($text == "🗄 Boshqarish"){
unlink("step/$cid.step");
}else{
if(is_numeric($text)=="true"){
file_put_contents("admin/kanal_shikoyat.txt",$text);
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
'protect_content'=>true,
]);
}}}

if($data == "kn_obunarx"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>📝 Yangi qiymatni yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>$boshqarish,
]);
file_put_contents("step/$cid2.step",'knobunarx');
}

if($step == "knobunarx"){
if($text == "🗄 Boshqarish"){
unlink("step/$cid.step");
}else{
if(is_numeric($text)=="true"){
file_put_contents("admin/kanalobuna.txt","$text");
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
'protect_content'=>true,
]);
}}}

if($data == "kn_narx"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>📝 Yangi qiymatni yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>$boshqarish,
]);
file_put_contents("step/$cid2.step",'knnarx');
}

if($step == "knnarx"){
if($text == "🗄 Boshqarish"){
unlink("step/$cid.step");
}else{
if(is_numeric($text)=="true"){
file_put_contents("admin/kanaltolov.txt",$text);
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
'protect_content'=>true,
]);
}}}

if($data == "kn_min"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>📝 Yangi qiymatni yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>$boshqarish,
]);
file_put_contents("step/$cid2.step",'knmin');
}

if($step == "knmin"){
if($text == "🗄 Boshqarish"){
unlink("step/$cid.step");
}else{
if(is_numeric($text)=="true"){
file_put_contents("admin/kanalmin.txt",$text);
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
'protect_content'=>true,
]);
}}}

if($data == "kn_max"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>📝 Yangi qiymatni yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>$boshqarish,
]);
file_put_contents("step/$cid2.step",'knmax');
}

if($step == "knmax"){
if($text == "🗄 Boshqarish"){
unlink("step/$cid.step");
}else{
if(is_numeric($text)=="true"){
file_put_contents("admin/kanalmax.txt",$text);
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
'protect_content'=>true,
]);
}}}

if($text == "📊 Statistika"){
if(in_array($cid,$admin)){
$baza = file_get_contents("azo.dat");
$obsh = substr_count($baza,"\n");
$load = sys_getloadavg();
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>💡 O'rtacha yuklanish:</b> <code>$load[0]</code>

👥 <b>Foydalanuvchilar: $obsh ta</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔁 Yangilash",'callback_data'=>"stat"]],
]])
]);
}}

if($data == "stat"){
$baza = file_get_contents("azo.dat");
$obsh = substr_count($baza,"\n");
$load = sys_getloadavg();
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>💡 O'rtacha yuklanish:</b> <code>$load[0]</code>

👥 <b>Foydalanuvchilar: $obsh ta</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔁 Yangilash",'callback_data'=>"stat"]],
]])
]);
}

if($text == "🎟 Promokod"){
if(in_array($cid,$admin)){
if($promo != null){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Promokod uchun nom yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqarish"]],
]])
]);
file_put_contents("step/$cid.step",'code');
}else{
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Promokod kanali ulanmagan!</b>",
'parse_mode'=>"html",
]);
}}}

if($step == "code"){
if($text == "🗄 Boshqarish"){
unlink("step/$cid.step");
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
[['text'=>"🗄 Boshqarish"]],
]])
]);
file_put_contents("step/$cid.step",'codeqiymat');
}}

if($step == "codeqiymat"){
if($text == "🗄 Boshqarish"){
unlink("step/$cid.step");
unlink("code.txt");
}else{
file_put_contents("codemiq.txt","$text");
unlink("step/$cid.step");
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Promokod @$promo kanaliga yuborildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel,
]);
$prmo=file_get_contents("code.txt");
$prmiq=file_get_contents("codemiq.txt");
$msg = bot('SendMessage',[
'chat_id'=>"@".$promo."",
'text'=>"<b>💡 Yangi Promokod!</b>

<b>🎫 Promokod:</b> <code>$prmo</code>
<b>💵 Promokod qiymati:</b> $prmiq $valyuta",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"▶️ Botga kirish",'url'=>"https://t.me/$bot"]],
]])
])->result->message_id;
file_put_contents("step/mid.txt",$msg);
}}

if($text == "🎁 Bonuslar"){
if(in_array($cid,$admin)){
$bonusbor = file_get_contents("admin/nom.txt","🎁 Kunlik bonus");
if($bonusbor){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Hozirgi holat:</b>

Bonus miqdori: <b>$kunbonmin</b> $valyuta
Status: <b>Yoqilgan</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🎁 Miqdorni sozlash",'callback_data'=>"bonus_miqdor"]],
[['text'=>"💡 O'chirish",'callback_data'=>"bonus_ochirish"]],
]])
]);
}else{
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Hozirgi holat:</b>

Bonus miqdori: <b>$kunbonmin</b> $valyuta
Status: <b>O'chirilgan</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🎁 Miqdorni sozlash",'callback_data'=>"bonus_miqdor"]],
[['text'=>"💡 Yoqish",'callback_data'=>"bonus_yoqish"]],
]])
]);
}}}

if($data == "bonus_ochirish"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>Bonus olish uchun ruxsat statusi o'zgartirildi.</b>

Yangi status: O'chirildi",
'parse_mode'=>"html",
]);
unlink("admin/nom.txt");
}

if($data=="bonus_yoqish"){
file_put_contents("admin/nom.txt","🎁 Kunlik bonus");
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>Bonus olish uchun ruxsat statusi o'zgartirildi.</b>

Yangi status: Yoqildi",
'parse_mode'=>"html",
]);
}

if($data=="bonus_miqdor"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>📝 Yangi qiymatni yuboring:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqarish"]],
]])
]);
file_put_contents("step/$cid2.step","bonus");
}
if($step == "bonus"){
if($tx=="🗄 Boshqarish"){
unlink("step/$cid.step");
}else{
if(is_numeric($text)=="true"){
file_put_contents("admin/kunbonus.txt",$text);
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
'parse_mode'=>"html",
'reply_markup'=>$panel,
]);
unlink("step/$cid.step");
}}}

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
[['text'=>"📑 Ro'yxatni ko'rish",'callback_data'=>"list"]],
[['text'=>"➕ Qo'shish",'callback_data'=>"add"],['text'=>"🗑 O'chirish",'callback_data'=>"remove"]],
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
[['text'=>"📑 Ro'yxatni ko'rish",'callback_data'=>"list"]],
]])
]);
}}

if($data == "list"){
$admins=file_get_contents("admin/admins.txt");
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
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
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$builder24,
'text'=>"*Kerakli ID raqamni kiriting:*",
'parse_mode'=>'MarkDown',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqarish"]],
]])
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
'text'=>"✅ *$text* admin qilib tayinlandi!",
'parse_mode'=>'MarkDown',
'reply_markup'=>$panel,
]);
unlink("step/$cid.step");
bot('SendMessage',[
'chat_id'=>$text,
'text'=>"<b>$builder24 </b>tomonidan admin qilib tayinlandingiz!",
'parse_mode'=>'html',
'reply_markup'=>$menyu,
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
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$builder24,
'text'=>"<b>Kerakli ID raqamni kiriting:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqarish"]],
]])
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
'text'=>"✅ *$text* adminlikdan olindi!",
'parse_mode'=>'MarkDown',
'reply_markup'=>$panel,
]);
unlink("step/$cid.step");
bot('SendMessage',[
'chat_id'=>$text,
'text'=>"<b>$builder24 </b>tomonidan adminlikdan olindingiz!",
'parse_mode'=>'html',
'reply_markup'=>$menyu,
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

if($tx=="💳 Hamyonlar"){
if(in_array($cid,$admin)){
$kategoriya = file_get_contents("admin/hamyon/kategoriya.txt");
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
}}}

if(mb_stripos($data, "delete-")!==false){
$ex = explode("-",$data);
$kat = $ex[1];
$royxat = file_get_contents("admin/hamyon/kategoriya.txt");
$k = str_replace("\n".$kat."","",$royxat);
file_put_contents("admin/hamyon/kategoriya.txt",$k);
unlink("admin/hamyon/$kat");
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>To'lov tizimi o'chirildi!</b>",
'parse_mode'=>'html',
]);
}

if($data== "yangi_tolov"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>Yangi to'lov tizimi nomini yuboring:

Masalan:</b> Click",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqarish"]],
]])
]);
file_put_contents("step/$cid2.step","tolov");
}

if($step=="tolov"){
if($tx=="🗄 Boshqarish"){
unlink("step/$cid.txt");
}else{
if(isset($text)){
$kategoriya2 = file_get_contents("admin/hamyon/kategoriya.txt");
file_put_contents("admin/hamyon/kategoriya.txt","$kategoriya2\n$text");
mkdir("admin/hamyon/$text");
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Ushbu to'lov tizimidagi hamyoningiz raqamini yuboring:</b>",
'parse_mode'=>'html',
]);
file_put_contents("step/$cid.step","raqam-$text");
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Yangi to'lov tizimi nomini yuboring:

Masalan:</b> Click",
'parse_mode'=>'html',
]);
}}}

if(mb_stripos($step, "raqam-")!==false){
$ex = explode("-",$step);
$kat = $ex[1];
if($tx=="🗄 Boshqarish"){
unlink("step/$cid.txt");
unlink("admin/hamyon/$kat");
}else{
file_put_contents("admin/hamyon/$kat/raqam.txt",$text);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Yangi to'lov tizimi qo'shildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel,
]);
unlink("step/$cid.step");
}}

if($text == '✉️ Xabarnoma'){
if(in_array($cid,$admin)){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Yuboriladigan xabar turini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"Oddiy xabar",'callback_data'=>"send"]],
[['text'=>"Forward xabar",'callback_data'=>"forsend"]],
]])
]);
}}

if($data == "send"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"*Barcha foydalanuvchilarga yuboriladigan xabarni matn shaklida yuboring:*",
'parse_mode'=>"markdown",
'reply_markup'=>$boshqarish,
]); file_put_contents("step/$cid2.step","users");
}

if($step=="users"){
if($text == "🗄 Boshqarish"){
unlink("step/$cid.step");
}else{
bot("sendmessage",[
'chat_id'=>$cid,
'text'=>"<b>Xabar yuborish boshlandi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
$lich = file_get_contents("azo.dat");
$lichka = explode("\n",$lich);
foreach($lichka as $lichkalar){
$okuser=bot("sendmessage",[
'chat_id'=>$lichkalar,
'text'=>$text,
'parse_mode'=>'html',
'disable_web_page_preview'=>true,
]);
}}
if($okuser){
bot("sendmessage",[
'chat_id'=>$cid,
'text'=>"<b>Xabar yuborish yakunlandi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}}

if($data == "forsend"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"*Barcha foydalanuvchilarga yuboriladigan xabarni forward shaklida yuboring:*",
'parse_mode'=>"markdown",
'reply_markup'=>$boshqarish,
]); file_put_contents("step/$cid2.step","forusers");
}

if($step=="forusers"){
if($text == "🗄 Boshqarish"){
unlink("step/$cid.step");
}else{
bot("sendmessage",[
'chat_id'=>$cid,
'text'=>"<b>Xabar yuborish boshlandi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
$lich = file_get_contents("azo.dat");
$lichka = explode("\n",$lich);
foreach($lichka as $lichkalar){
$okforuser=bot("forwardMessage",[
'chat_id'=>$lichkalar,
'from_chat_id'=>$cid,
'message_id'=>$mid,
'disable_web_page_preview'=>true,
]);
}}

if($okforuser){
bot("sendmessage",[
'chat_id'=>$cid,
'text'=>"<b>Xabar yuborish yakunlandi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
}}

if($text == "🔎 Foydalanuvchini boshqarish"){
if(in_array($cid,$admin)){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Kerakli foydalanuvchining ID raqamini yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>$boshqarish
]);
file_put_contents("step/$cid.step",'iD');
}}

if($step == "iD"){
if($text == "🗄 Boshqarish"){
unlink("step/$cid.step");
}else{
if(file_exists("pul/$text.txt")){
if(file_exists("ban/$text.txt")){
file_put_contents("step/inew.txt",$text);
$pul = file_get_contents("pul/$text.txt");
$odam = file_get_contents("odam/$text.txt");
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Foydalanuvchi topildi!

ID:</b> <a href='tg://user?id=$text'>$text</a>

<b>Balansi: $pul $valyuta
Takliflari: $odam ta</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔕 Bandan olish",'callback_data'=>"unban"]],
[['text'=>"➕ Pul qo'shish",'callback_data'=>"plus"],['text'=>"➖ Pul ayirish",'callback_data'=>"minus"]],
]])
]);
unlink("step/$cid.step");
}else{
file_put_contents("step/inew.txt",$text);
$pul = file_get_contents("pul/$text.txt");
$odam = file_get_contents("odam/$text.txt");
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Foydalanuvchi topildi!

ID:</b> <a href='tg://user?id=$text'>$text</a>

<b>Balansi: $pul $valyuta
Takliflari: $odam ta</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔔 Banlash",'callback_data'=>"ban"]],
[['text'=>"➕ Pul qo'shish",'callback_data'=>"plus"],['text'=>"➖ Pul ayirish",'callback_data'=>"minus"]],
]])
]);
unlink("step/$cid.step");
}
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Ushbu foydalanuvchi botdan foydalanmaydi!</b>

<i>Boshqa ID raqamni kiriting:</i>",
'parse_mode'=>'html',
]);
}}}

if($data == "plus"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<a href='tg://user?id=$saved'>$saved</a> <b>ning hisobiga qancha pul qo'shmoqchisiz?</b>",
'parse_mode'=>"html",
'reply_markup'=>$boshqarish,
]);
file_put_contents("step/$cid2.step",'plus');
}

if($step == "plus"){
if($text == "🗄 Boshqarish"){
unlink("step/$cid.step");
}else{
if(is_numeric($text)=="true"){
bot('sendMessage',[
'chat_id'=>$saved,
'text'=>"<b>Adminlar tomonidan hisobingiz $text $valyuta to'ldirildi</b>",
'parse_mode'=>"html",
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
$kpul=file_get_contents("pul/$saved.1txt");
$plus = $kpul + $text;
file_put_contents("pul/$saved.1txt",$plus);
unlink("step/inew.txt");
unlink("step/$cid.step");
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Faqat raqamlardan foydalaning!</b>",
'parse_mode'=>'html',
'protect_content'=>true,
]);
}}}

if($data=="minus"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<a href='tg://user?id=$saved'>$saved</a> <b>ning hisobiga qancha pul ayirmoqchisiz?</b>",
'parse_mode'=>"html",
'reply_markup'=>$boshqarish,
]);
file_put_contents("step/$cid2.step",'minus');
}

if($step == "minus"){
if($text == "🗄 Boshqarish"){
unlink("step/$cid.step");
}else{
if(is_numeric($text)=="true"){
bot('sendMessage',[
'chat_id'=>$saved,
'text'=>"<b>Adminlar tomonidan hisobingizdan $text $valyuta olib tashlandi</b>",
'parse_mode'=>"html",
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
unlink("step/inew.txt");
unlink("step/$cid.step");
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Faqat raqamlardan foydalaning!</b>",
'parse_mode'=>'html',
]);
}}}

if($data=="ban"){
file_put_contents("ban/$saved.txt",'ban');
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<a href='tg://user?id=$saved'>$saved</a> <b>banlandi</b>",
'parse_mode'=>"html",
'reply_markup'=>$panel,
]);
}

if($data=="unban"){
unlink("ban/$saved.txt");
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<a href='tg://user?id=$saved'>$saved</a> <b>banlandan olindi</b>",
'parse_mode'=>"html",
'reply_markup'=>$panel,
]);
}

?>