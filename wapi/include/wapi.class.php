<?php

class wapp {
  public function __construct() 
  {
    
    $this->api = new RestClient([
    'base_url' => $confg["url"], 
  ]);
  }
  
  public function send_msg_wapp($phone,$msg,$custom_id) {
    global $config;

    $params["token"] = $config["token"];
    $params["uid"] = $config["phone"];
    $params["to"] = $phone;
    $params["custom_uid"] = $custom_id;
    $params["text"] = $msg;
      
    
    $result = $this->api->post("send/chat", $params);
    // var_dump($result);
    // file_put_contents('send_msg_wapp.txt',json_encode($params)); //DEBUG
  }
  
  
}


?>