<?php
include 'include/include.php';

$from_LHC = $_POST;

$from_LHC = json_decode($from_LHC['params']);

$data = array();
$data["phone"] = json_decode($from_LHC->chat->additional_data)[0]->value;
$data["msg"] = $from_LHC->msg->name_support . ': ' . $from_LHC->msg->msg;

$evaluate_msg = explode("=", $from_LHC->msg->msg);

if($evaluate_msg[0] == "[file") $type = "media";
else $type = "text";

$wapp = new wapi;

if($type == "text") $send = $wapp->send_msg_wapi($data["phone"],$data["msg"]);


if($type == "media") {
$file_id = explode("_",$evaluate_msg[1]);
$file_id = $file_id[0];

$lhc_fp = new lhc;
$image = $lhc_fp->get_file_data($file_id);


$send = $wapp->send_media_msg_wapi($data["phone"],$image["fpath"],$image["upload_name"]);
}


if($_POST["debug"] == true) {
  $data["phone"] = $_POST["phone"];
  $data["msg"] = $_POST["msg"];  
}


if($_POST["debug"] == true) echo '<pre>'; var_dump($send);

if(json_decode($send->response,true)["error"] == 1)  {
  $lhc = new lhc;
  $lhc->send_msg_lhc($data["phone"],$data["phone"],"Administrador: [b]ALERTA! " . json_decode($send->response,true)["message"]."[/b]");

  if($_POST["debug"] == true)  var_dump(json_decode($send->response,true)["message"]);
}


file_put_contents('wapi_post.json',$_POST);
file_put_contents('wapi_send.json',serialize($send));
// file_put_contents('wapi_data.json',json_encode($data));

?>