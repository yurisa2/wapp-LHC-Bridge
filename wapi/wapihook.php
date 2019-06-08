<?php

// $teste = file_get_contents('php://input');

$json = "{\"data\":{\"FromMe\":0,\"RemoteJid\":\"551150342227@s.whatsapp.net\",\"Status\":1,\"Timestamp\":1560000972,\"msgId\":\"3EB06EC4FC4B2A2F9247\",\"msgInfo\":{\"message\":\"alternated\",\"msgType\":\"text\"},\"username\":\"5511996660661\"},\"dataType\":\"msg\",\"username\":\"5511996660661\"}";
$json_dec = json_decode($json);

$incoming["from_me"] = $json_dec->data->FromMe; // USE TO SELECT

$incoming["dataType"] = $json_dec->dataType;
$incoming["user_to"] = $json_dec->username;
$incoming["user_from"] = $json_dec->RemoteJid;
$incoming["msg_id"] = $json_dec->msgId;
$incoming["time"] = $json_dec->data->Timestamp;
$incoming["msgid"] = $json_dec->data->msgId;
$incoming["type"] = $json_dec->msgInfo->msgType;

if($incoming["type"] == "text") {
    $incoming["message_body"] = $json_dec->msgInfo->message;
}

if($incoming["type"] == "image" || $incoming["type"] == "video") {
    $incoming["message_body"] = $json_dec->msgInfo->url .' - '. $json_dec->msgInfo->caption ;
}

if($incoming["type"] == "audio") {
    $incoming["message_body"] = $json_dec->msgInfo->url;
}


echo '<pre>';
var_dump($json_dec);
echo '<br>';
var_dump($incoming);




?>