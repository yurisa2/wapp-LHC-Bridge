<?php
ini_set('display_errors','on');

include 'include/lhc.config.php';
include 'include/lhrestapi.php';
include 'include/lhc.class.php';

$wapp = $_POST;

  
  $lhc = new lhc;

  $lhc->send_msg_lhc($_POST["user_from"],$_POST["user_name"],$_POST["message_body"]);
}

// var_dump($_POST);


file_put_contents('lhchook.json',json_encode($wapp));


?>
