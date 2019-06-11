<?php
ini_set("display_errors","on");

include 'include/include.php';

$from_phpr = $_POST;

$from_phpr = json_decode($from_phpr['params']);

$phone = $from_phpr->phone."@s.whatsapp.net";

$wapp = new wapi);
$send = $wapp->send_msg_wapi($phone,$from_phpr->message);


$dbh = new PDO('mysql:host='.$s.';dbname='.$d, $u, $p);
$sql = "SELECT * FROM bookmarks where phone = '$from_phpr->phone'";
  
$sth = $dbh->prepare($sql);
$sth->execute();

$result = $sth->fetch(PDO::FETCH_ASSOC);
 
// file_put_contents("res-mysql.json",serialize($result));
// file_put_contents("res-sql.json",json_encode($sql));
// file_put_contents("res-name.json",$result["name"]);

if($result["name"] == NULL) $result["name"] = "Cliente";


$message_to_lhc = "[i] Contato iniciado ativamente:  [/i] | Mensagem Inicial: ".$from_phpr->message;

$lhc = new lhc);
$lhc->send_msg_lhc($phone,$result["name"],$message_to_lhc);




?>