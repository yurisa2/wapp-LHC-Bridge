<?php

include 'wapi/include/wapi.config.php';
include 'wapi/include/vendor/autoload.php';
include 'wapi/include/wapi.class.php';

$from_LHC = $_POST;

$from_LHC = json_decode($from_LHC['params']);

$data = array();
$data["phone"] = json_decode($from_LHC->chat->additional_data)[0]->value;
$data["msg"] = $from_LHC->msg->name_support . ': ' . $from_LHC->msg->msg;

$wapp = new wapi($config);
$wapp->send_msg_wapi($data["phone"],$data["msg"]);
// var_dump($from_LHC); //DEBUG

file_put_contents('wapi_post.json',$_POST);
// file_put_contents('wapi_data.json',json_encode($data));

?>