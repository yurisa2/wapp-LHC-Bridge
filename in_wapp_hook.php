<?php
ini_set('display_errors','on');

include 'include/include.php';


$json = file_get_contents('php://input');

// file_put_contents("in.wapp_hook-json.json",$json);
$wapi = new wapi;
$incoming = $wapi->process_json_input($json);

// file_put_contents("in.wapp_hook-incoming.json",json_encode($incoming));

if($incoming["from_me"] == 0) {  
  
  $arr = explode("@", $incoming["user_from"]);
  $phone_only = $arr[0];  
  
  $dbh = new PDO('mysql:host='.$s.';dbname='.$d, $u, $p);
  $sql = "SELECT * FROM bookmarks where phone = '$phone_only'";
    
  $sth = $dbh->prepare($sql);
  $sth->execute();

  $result = $sth->fetch(PDO::FETCH_ASSOC);
   
  // file_put_contents("res-mysql.json",serialize($result));
  // file_put_contents("res-sql.json",json_encode($sql));
  // file_put_contents("res-name.json",$result["name"]);
  
  if($result["name"] == NULL) $result["name"] = "Cliente";
  
  $lhc = new lhc;
  $lhc->send_msg_lhc($incoming["user_from"],$result["name"],$incoming["message_body"]);
  
} 


?>