<?php

// echo __FILE__ . " INCLUDED";

class wapi {
  public function __construct($config) 
  {
  
    $this->username = $config["username"];
  
    $this->api = new RestClient([
    'base_url' => $config["url"], 
  ]);
  }
  
  public function login_wapi() {
    $params["username"] = $this->username;

    $result = $this->api->get('sendTextMessage', json_encode($params), 
    array('Content-Type' => 'application/json'));
    
    file_put_contents('login_wapi-response.json',serialize($result));
    
    return $result;
  }
  
  public function send_msg_wapi($phone,$msg) {
    $this->login_wapi();
    
    $params["username"] = $this->username;
    // $params["jid"] = $phone."@s.whatsapp.net";
    $params["jid"] = $phone;
    $params["message"] = base64_encode($msg);
      
      // var_dump($params);
  
    $result = $this->api->post('sendTextMessage', json_encode($params), 
    array('Content-Type' => 'application/json'));
    //   echo "Depois do POST - RESULT";
    // 
    // var_dump($result);
    // file_put_contents('send_msg_wapi.txt',json_encode($params)); //DEBUG
    // file_put_contents('send_msg_wapi-result.txt',serialize($result)); //DEBUG
    
    
    return $result;
  }
  
  
}


?>