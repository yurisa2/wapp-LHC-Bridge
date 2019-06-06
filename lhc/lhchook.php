<?php
ini_set('display_errors','on');

include 'include/lhrestapi.php';
include 'include/lhc.config.php';
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

if($_POST["event"] == "message")
{
  $from_phone = $_POST["contact[uid]"];
  $from_name = $_POST["contact[name]"];
  $msg = $_POST["message[body][text]"];
  
  $lhc = new lhc;
  
  $lhc->send_msg_lhc($from_phone,$from_name,$msg);
}


?>