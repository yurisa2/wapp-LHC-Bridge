<?php

include 'wapi/include/wapi.config.php';
include 'wapi/include/vendor/autoload.php';
include 'wapi/include/wapi.class.php';

// FOR ERROR REPORTING

include 'lhc/include/lhc.config.php';
include 'lhc/include/lhrestapi.php';
include 'lhc/include/lhc.class.php';



$from_LHC = $_POST;

$from_LHC = json_decode($from_LHC['params']);

$data = array();
$data["phone"] = json_decode($from_LHC->chat->additional_data)[0]->value;
$data["msg"] = $from_LHC->msg->name_support . ': ' . $from_LHC->msg->msg;

if($_POST["debug"] == true) {
  $data["phone"] = $_POST["phone"];
  $data["msg"] = $_POST["msg"];
  
}


$wapp = new wapi($config_wapi);
$send = $wapp->send_msg_wapi($data["phone"],$data["msg"]);

if($_POST["debug"] == true) echo '<pre>'; var_dump($send);

if(json_decode($send->response,true)["error"] == 1)  {
  $lhc->send_msg_lhc($data["phone"],$data["phone"],json_decode($send->response,true)["message"]);

  if($_POST["debug"] == true)  var_dump(json_decode($send->response,true)["message"]);
}


file_put_contents('wapi_post.json',$_POST);
file_put_contents('wapi_send.json',serialize($send));
// file_put_contents('wapi_data.json',json_encode($data));

?>