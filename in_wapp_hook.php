<?php
ini_set('display_errors','on');

include 'lhc/include/lhc.config.php';
include 'lhc/include/lhrestapi.php';
include 'lhc/include/lhc.class.php';

$json = file_get_contents('php://input');

// file_put_contents("in.wapp_hook-json.json",$json);

include 'wapi/wapihook.php';

file_put_contents("in.wapp_hook-incoming.json",json_encode($incoming));

if($incoming["from_me"] == 0) {  
  
  
  $arr = explode("@", $incoming["user_from"]);
  $phone_only = $arr[0];  
  
$dbh = new PDO('mysql:host='.$s.';dbname='.$d, $u, $p);
$sql = "SELECT * FROM bookmarks where phone = '$phone_only'";
  
$sth = $dbh->prepare($sql);
$sth->execute();



$result = $sth->fetch(PDO::FETCH_ASSOC);
  
  file_put_contents("res-mysql.json",serialize($result));
  file_put_contents("res-sql.json",serialize($sql));
  
  $lhc = new lhc($config_lhc);
  $lhc->send_msg_lhc($incoming["user_from"],$incoming["user_from"],$incoming["message_body"]);
  
} //This was not supposed to be working, but I guess its denying from the other end.....whatever. Will try to activate to keep clean operation


?>