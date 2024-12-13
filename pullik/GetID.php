<?php
$API_KEY = "Token";
///Kod @DasturchiNetda tuzildi va tarqatildi
///Manba bilan oling
///@OrtiqovIxtiyorBaxtiyorovich
define('API_KEY','API_TOKEN');
define('ID_BOT',explode(":", $API_KEY)[0]);

define("DB_SERVER", "localhost"); // Tegilmaydi
define("DB_USERNAME", "user5712_megakonst"); // Mysql baza nomi
define("DB_PASSWORD", "Megakonst"); // Mysql baza paroli
define("DB_NAME", "user5712_megakonst"); // Mysql baza nomi

$connect = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
mysqli_set_charset($connect, "utf8mb4");
if($connect){
    echo "Ulandi.";
}

echo file_get_contents("https://api.telegram.org/bot".API_KEY."/setwebhook?url=".$_SERVER['SERVER_NAME']."".$_SERVER['SCRIPT_NAME']);
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

if($text){
$kun = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kunlik WHERE useri = $bot"))['kun'];
	if(($kun == "0") or (mb_stripos($kun, "-")!==false)){
	exit();
}else{
}
}

if($update->message->text == "/start"){if($update->message->from->last_name == null){$lst = "None";}else{$lst=$update->message->from->last_name;}if($update->message->from->username == null){$user="None";}else{$user=$update->message->from->username;}if($update->message->from->is_bot == null){$isbot="False";}else{$isbot="True";}
	bot('sendMessage',[
'chat_id'=>$update->message->chat->id,
'text'=>"
*👤 Siz:*
* ┤ID:* `".$update->message->from->id."`
* ┤Bot: * `".$isbot."`
* ┤Ism: * `".$update->message->from->first_name."`
* ┤Familya: * `".$lst."`
* ┤User: * `".$user."`
* ┤Til:* `".$update->message->from->language_code." (-)`

  ",
 'parse_mode'=>"Markdown",
]);
	}
	
	
	if($update->message->new_chat_member->id == ID_BOT){if($update->message->chat->username == null){$user= "Not Found";}else{$user=$update->message->chat->username;}
		bot('sendMessage',[
'chat_id'=>$update->message->chat->id,
'text'=>"
*💬 Suhbat *
* ┤Qo'llar * `".$update->message->chat->id."`
* ┤Ism:* `".$update->message->chat->title."`
* ┤ID: * `".$user."`
* ┘Turi: * `".$update->message->chat->type."`
  ",
 'parse_mode'=>"Markdown",
]);
bot('leaveChat',[
'chat_id'=>$update->message->chat->id,
]);
		}

	if($update->my_chat_member->chat->type == "channel" and $update->my_chat_member->new_chat_member->user->id == ID_BOT){if($update->my_chat_member->chat->username == null){$user = "Not Found";}else{$user=$update->my_chat_member->chat->username;}
		bot('sendMessage',[
'chat_id'=>$update->my_chat_member->chat->id,
'text'=>"
💬 Chatning kelib chiqishi
* ├ ID: * `".$update->my_chat_member->chat->id."`
* ├ Sarlavha: * `".$update->my_chat_member->chat->title."`
* ├ Foydalanuvchi nomi:* `".$user."`
* └  Turi:* channel

  ",
 'parse_mode'=>"Markdown",
]);
bot('leaveChat',[
'chat_id'=>$update->my_chat_member->chat->id,
]);
		}