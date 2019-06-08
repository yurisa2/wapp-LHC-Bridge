<?php
ini_set("display_erros","on");

include 'wapi/include/wapi.config.php';
include 'wapi/include/vendor/autoload.php';
include 'wapi/include/wapi.class.php';


$from_LHC = $_POST;

echo '<pre>';

$phone = $from_LHC["phone"];
$msg = $from_LHC["msg"];

$wapp = new wapi($config);
$wapp->send_msg_wapi($phone,$msg);
// 
// var_dump($_POST); //DEBUG
//  var_dump($phone); //DEBUG
//  var_dump($msg); //DEBUG


?>