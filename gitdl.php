<?php
ob_start();
define('cyberi_modafan_wlaiat_bot','997951577:AAFrXYZrZhEP7dtcXF7rKOSXXmPqD1U0wKc');
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".cyberi_modafan_wlaiat_bot."/".$method;
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
$message_id = $message->message_id;
$chat_id = $message->chat->id;
$text1 = $message->text;
$fadmin = $message->from->id;
$chatid = $update->callback_query->message->chat->id;
$data = $update->callback_query->data;
$messageid = $update->callback_query->message->message_id;
mkdir("data");
mkdir("data/$fadmin");
$step= file_get_contents("data/$fadmin/one.txt","a+");
if($text1=="/start"){
 file_put_contents("data/$fadmin/one.txt","null");
 bot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"سلام خوش آمدید\n\nشما با این ربات میتوانید بصورت مستقیم فایل رو از گیتاب دانلود کنید\nبراش شروع دکمه شروع را بزنید \n\n<i>Create By</i> : @AvengerTm",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀شروع",'callback_data'=>"start"]],
[['text'=>"🌟درباره ما",'callback_data'=>"about"]]
]]),
 ]);
 }elseif($data=="about"){
bot('editmessagetext',[
'chat_id'=>$chatid,
'text'=>"درباره تیم Avenger💠 :
بهـــترین تیـــم در زمـــینه لـــوا و پــی اچـ پــی
@AvengerTm
🛃مدیـــر اصــلی تیـــم:
@dev_mohammad
✏بـــرنامــه نویـــسان تیـــم:
@Sudo_AvengerTm
@MegaPHP",
'message_id'=>$messageid,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"↩برگشت",'callback_data'=>"back"]]
]]),
]);
}elseif($data=="start"){
file_put_contents("data/$chatid/one.txt","start");
bot('editmessagetext',[
'chat_id'=>$chatid,
'text'=>"خوب ادرس گیت هاب خود را بفرستید\nتا در صورت وجود ادرس فایل مستقیم برای شما فرستاده شود...\n⛔توجه : حتما با http شروع شود و در اخر هم .git نداشته باشد⛔\n\nCreate By : @AvengerTm",
'message_id'=>$messageid,
]);

}elseif($data=="back"){
file_put_contents("data/$chatid/one.txt","null");
bot('editmessagetext',[
 'chat_id'=>$chatid,
 'text'=>"سلام خوش آمدید\n\nشما با این ربات میتوانید بصورت مستقیم فایل رو از گیتاب دانلود کنید\nبراش شروع دکمه شروع را بزنید \n\n<i>Create By</i> : @AvengerTm",
'message_id'=>$messageid,
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀شروع",'callback_data'=>"start"]],
[['text'=>"🌟درباره ما",'callback_data'=>"about"]]
]]),
]);
}elseif($step=="start"){
if(strpos($text1,"http://github.com/")!==false || strpos($text1,"https://github.com/")!==false ){
$one=str_replace("https://","",$text1);
$two=str_replace("http://","",$one);
$five="https://codeload.$two/zip/master";
$three=file_put_contents("data/$fadmin/Avenger.zip",file_get_contents($five));
$file=file_get_contents("data/$fadmin/Avenger.zip");
if($file==null){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"این یک لینک سایت گیت هاب نیس⛔\n\nلطفا لینک یک سایت گیت هاب معتبر بفرستید :",
]);

}else{
sleep(2);
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"در حال دانلود...",
'message_id'=>$message_id,
]);
sleep(3);
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"دانلود شد✅\n\nدر حال فرستادن فایل...",
]);
sleep(3);
bot('senddocument',[
'chat_id'=>$chat_id,
'document'=>new CURLFile("data/$fadmin/Avenger.zip"),
'caption'=>"فایل شما آماده شد✅\n\nCreate By: @AvengerTm",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"♻شروع دوباره",'callback_data'=>"start"]],
]]),
]);
file_put_contents("data/$fadmin/one.txt","null");
unlink("data/$fadmin/Avenger.zip");
}}else{
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"این یک لینک سایت گیت هاب نیست⛔⛔\n\nلطفا لینک یک سایت گیت هاب معتبر بفرستید :",
]);
}}else{
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"این دستور موجود نیست \n/start\nرو بزنید...",
]);
}
?>
