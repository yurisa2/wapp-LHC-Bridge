<?php
ini_set('display_errors','on');

include 'lhc/include/lhc.config.php';
include 'lhc/include/lhrestapi.php';
include 'lhc/include/lhc.class.php';

$incoming = $_POST;

// file_put_contents("in.wapp_hook-json.json",$json);

// include 'wapi/wapihook.php';

file_put_contents("in.wapp_hook-incoming.json",json_encode($incoming));

// if($incoming["from_me"] == 0) {  
  $lhc = new lhc($config);
  $lhc->send_msg_lhc($incoming["user_from"],$incoming["user_from"],$incoming["message_body"]);
  
// }

?>