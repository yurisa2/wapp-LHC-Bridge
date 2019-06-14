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
  
  $dbh = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
  $sql = "SELECT * FROM bookmarks where phone = '$phone_only'";
    
  $sth = $dbh->prepare($sql);
  $sth->execute();

  $result = $sth->fetch(PDO::FETCH_ASSOC);
   
  // file_put_contents("res-mysql.json",serialize($result));
  // file_put_contents("res-sql.json",json_encode($sql));
  // file_put_contents("res-name.json",$result["name"]);
  
  if($result["name"] == NULL) {
    $result["name"] = "Cliente";
    if(!$demo) {
    $sql = "INSERT INTO bookmarks (phone, name, obs, user) values 
    ('$phone_only','Cliente Ativo','Entrou em contato espontâneamente','Daray CRM')";
      
    $sth = $dbh->prepare($sql);
    $sth->execute();
    }
    if($demo) file_put_contents("files/".time().".json",json_encode(array($phone_only)));
  }
  
  $lhc = new lhc;
  $lhc->send_msg_lhc($incoming["user_from"],$result["name"],$incoming["message_body"]);
  
} 


?>