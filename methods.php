<?php
require_once 'config.php';
function bot($method, $datas = [])
{
    $url = "https://api.telegram.org/bot" . apiKey . "/" . $method;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($datas));
    $res = curl_exec($ch);
    if (curl_error($ch))
    {
        var_dump(curl_error($ch));
    }
    else
    {
        return json_decode($res);
    }
}
//-----------------------------------------methods-------------------------------------------------------------
function getChannelId($message=null ,$caption=null)
{
if ($message!=null){
    return analyse($message)   ;
}
    else{return analyse($caption);}
}
function analyse($text)
{
    $text=(ltrim(rtrim($text)));
    $channelId=substr($text, 0, 1);
    return $channelId;
}
function renderText($text)
{
    return explode(":",$text)[1];
}
function SendMessage($chat_id, $text){
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>$text,
        'parse_mode'=>'MarkDown']);
}
function sendphoto($chat_id, $photo, $captionl){
    bot('sendphoto',[
        'chat_id'=>$chat_id,
        'photo'=>$photo,
        'caption'=>$captionl,
    ]);
}
function sendaudio($chat_id, $audio, $caption, $title ,$performer){
    bot('sendaudio',[
        'chat_id'=>$chat_id,
        'audio'=>$audio,
        'caption'=>$caption,
        'title'=>$title,
        'performer'=>$performer
    ]);
}
function sendDocument($chat_id, $document, $caption=null){
    bot('senddocument',[
        'chat_id'=>$chat_id,
        'document'=>$document,
        'caption'=>$caption
    ]);
}

function sendvideo($chat_id, $video, $caption){
    bot('sendvideo',[
        'chat_id'=>$chat_id,
        'video'=>$video,
        'caption'=>$caption
    ]);
}
function sendvoice($chat_id, $voice, $caption){
    bot('sendvoice',[
        'chat_id'=>$chat_id,
        'voice'=>$voice,
        'caption'=>$caption
    ]);
}
