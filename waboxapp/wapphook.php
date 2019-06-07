<?php

include 'include/wapp.config.php';
include 'include/vendor/autoload.php';

include 'include/wapp.class.php';


$from_LHC = $_POST;

$from_LHC = json_decode($from_LHC['params']);


$phone = json_decode($from_LHC->chat->additional_data)[0]->value;
$msg = $from_LHC->msg->name_support . ': ' . $from_LHC->msg->msg;
$custom_id = $from_LHC->msg->time;

$wapp = new wapp;
$wapp->send_msg_wapp($phone,$msg,$custom_id);

file_put_contents('wappmsg.json',$custom_id);

?>