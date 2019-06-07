<?php
ini_set('display_errors','on');

include 'include/lhc.config.php';
include 'include/lhrestapi.php';
include 'include/lhc.class.php';

// "event": "message",
// "token": "abcd1234",
// "contact[uid]": "34666123456",
// "contact[name]": "Peter",
// "contact[type]": "user",
// "message[dtm]": 1487082303,
// "message[uid]": "62397B58E3E0B",
// "message[cuid]": "",
// "message[dir]": "i",
// "message[type]": "chat",
// "message[body][text]": "Hey! How are you doing?",
// "message[ack]": 3

$wapp = $_POST;

if($wapp["event"] == "message")
{
  $from_phone = $wapp["contact"]["uid"];
  $from_name = $wapp["contact"]["name"];
  $msg = $wapp["message"]["body"]["text"];

  // 
  // var_dump($from_phone);
  // var_dump($from_name);
  // var_dump($msg);
  // // exit;
  
  $lhc = new lhc;
  
  
  
  
  $lhc->send_msg_lhc($from_phone,$from_name,$msg);
}

file_put_contents('lhchook.json',json_encode($_POST));

?>