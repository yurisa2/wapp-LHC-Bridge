<?php
ini_set('display_errors','on');

include 'include/lhc.config.php';
include 'include/lhrestapi.php';
include 'include/lhc.class.php';

$json = file_get_contents('php://input');

// file_put_contents("in.wapp_hook-json.json",$json);

include 'wapi/wapihook.php';

file_put_contents("in.wapp_hook-incoming.json",json_encode($incoming));

if($incoming["from_me"] == 0) {  
  $lhc = new lhc;
  $lhc->send_msg_lhc($incoming["user_from"],$incoming["user_from"],$incoming["message_body"]);
}

?>