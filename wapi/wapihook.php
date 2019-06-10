<?php

// $teste = file_get_contents('php://input');

// $json = "{"data":{"FromMe":0,"RemoteJid":"551150342227@s.whatsapp.net","Status":1,"Timestamp":1560000972,"msgId":"3EB06EC4FC4B2A2F9247","msgInfo":{"message":"alternated","msgType":"text"},"username":"5511996660661"},"dataType":"msg","username":"5511996660661"}";
$json_dec = json_decode($json);

$incoming["from_me"] = $json_dec->data->FromMe; // USE TO SELECT

$incoming["dataType"] = $json_dec->dataType;
$incoming["user_to"] = $json_dec->username;
$incoming["user_from"] = $json_dec->data->RemoteJid;
$incoming["msg_id"] = $json_dec->msgId;
$incoming["time"] = $json_dec->data->Timestamp;
$incoming["msgid"] = $json_dec->data->msgId;
$incoming["type"] = $json_dec->data->msgInfo->msgType;

if($incoming["type"] == "text") {
    $incoming["message_body"] = $json_dec->data->msgInfo->message;
}

if($incoming["type"] == "image" || $incoming["type"] == "video") {
  
    $imgs = file_get_contents("https://in.wapi.xyz/".$json_dec->data->msgInfo->url);
    
    file_put_contents("./".$json_dec->data->msgInfo->url,$imgs);
  
    $incoming["message_body"] = "[url=http://sa2.com.br/whatsapp_lhc/wapp-LHC-Bridge/".$json_dec->data->msgInfo->url."]IMAGEM[/url]";
    // $incoming["message_body"] = __FILE__.$json_dec->data->msgInfo->url .' - '. $json_dec->data->msgInfo->caption ;
  
    
}

if($incoming["type"] == "audio") {
    $imgs = file_get_contents("https://in.wapi.xyz/".$json_dec->data->msgInfo->url);
    
    file_put_contents("./".$json_dec->data->msgInfo->url,$imgs);
  
    $incoming["message_body"] = "[url=http://sa2.com.br/whatsapp_lhc/wapp-LHC-Bridge/".$json_dec->data->msgInfo->url."]AUDIO[/url]";
  }

// 
// echo '<pre>';
// var_dump($json_dec);
// echo '<br>';
// var_dump($incoming);
// 
// 


?>