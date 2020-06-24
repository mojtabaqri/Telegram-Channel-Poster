<?php
require_once 'methods.php';
require_once 'config.php';
//end require
$data=json_decode(file_get_contents("php://input"));
$fullMessage=$data->message; //get fullmesage
//if message has attachment $attachment is true ---------------------
$caption='';
$file_id='';
$mediGroupId='';
$messageType='';
$attachment = array("document", "video", "voice", "text",'media_group_id','photo','audio','sticker');
if (array_key_exists('caption',$fullMessage)) $caption=$fullMessage->caption;
foreach ($attachment as $item) if(array_key_exists($item,$fullMessage)) $messageType=$item;
$channel=0;
//-------------------------------------- Message Type defined-------------------------------------
$channelId=getChannelId($fullMessage->text,$caption);
foreach (channels as $key =>  $item ) if ($key==$channelId) $channel=$key;
//---------------------------------------End Find Channel Id ------------------------------------
if($channel<1) exit();

    switch ($messageType)
{
    case "document":
        $file_id=$fullMessage->document->file_id;
        sendDocument(channels[$channel],$file_id,$caption);
        break;
    case "video":
        $file_id=$fullMessage->video->file_id;
        sendvideo(channels[$channel],$file_id,$caption);
        break;
    case "voice":
        $file_id=$fullMessage->voice->file_id;
        sendvoice(channels[$channel],$file_id,$caption);
        break;
    case "text":
        sendMessage(channels[$channel],$fullMessage->text);
        break;
    case "media_group_id":
        sendMessage(admin,"درحال حاضر این متد موجود نیست!");
        break;
    case "photo":
        $file_id=$fullMessage->photo[0]->file_id;
        sendphoto(channels[$channel],$file_id,$caption);
        break;
    case "audio":
        $file_id=$fullMessage->audio->file_id;
        sendaudio(channels[$channel],$file_id,$caption);
        break;
    default:
        sendMessage(admin,"قابل پردازش نیست ! ‼️");
}
//-------------------------------------------------------------------------------------------------------------
