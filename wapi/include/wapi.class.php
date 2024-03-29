<?php

// echo __FILE__ . " INCLUDED";

class wapi {
  public function __construct() 
  {
    $this->username = WAPI_USER;
    
    $this->api = new RestClient([
      'base_url' => WAPI_URL, 
    ]);
  }
  
  public function login_wapi() {
    $params["username"] = $this->username;
    
    file_put_contents('login_wapi-response.json',json_encode($result));
    
    return $result;
  }
  
  
  
  public function check_online() {
    $params["username"] = $this->username;
        
    $result = $this->api->get('online/'.$params["username"],array(),
    array(
          'Authorization' => WAPI_TOKEN
  ));
    // 
    // $result = json_decode($result);
    // $result->time = time();
    // 
    // $result = json_encode($result);
    
  
    file_put_contents('files_laststatus.json',$result);
    
    return $result;
  }
  
  
  
  public function send_msg_wapi($phone,$msg) {
    // $this->login_wapi();
    
    $params["username"] = $this->username;
    // $params["jid"] = $phone."@s.whatsapp.net";
    $params["jid"] = $phone;
    $params["message"] = base64_encode($msg);
    
    // var_dump($params);
    
    $result = $this->api->post('sendTextMessage', json_encode($params), 
    array('Content-Type' => 'application/json',
          'Authorization' => WAPI_TOKEN
  ));
    //   echo "Depois do POST - RESULT";
    // 
    // var_dump($result);
    // file_put_contents('send_msg_wapi.txt',json_encode($params)); //DEBUG
    // file_put_contents('send_msg_wapi-result.txt',serialize($result)); //DEBUG
    
    
    return $result;
  }
  
  public function process_json_input($json) {
    $json_dec = json_decode($json);
    
    
    $processed["from_me"] = $json_dec->data->FromMe; // USE TO SELECT
    
    $processed["dataType"] = $json_dec->dataType;
    $processed["user_to"] = $json_dec->username;
    $processed["user_from"] = $json_dec->data->RemoteJid;
    $processed["msg_id"] = $json_dec->data->msgId;
    $processed["time"] = $json_dec->data->Timestamp;
    $processed["msgid"] = $json_dec->data->msgId;
    $processed["type"] = $json_dec->data->msgInfo->msgType;
    
    if($processed["type"] == "text") {
      $processed["message_body"] = $json_dec->data->msgInfo->message;
    }
    
    if($processed["type"] == "image" || $processed["type"] == "video") {
      
      $imgs = file_get_contents(WAPI_URL.$json_dec->data->msgInfo->url);
      
      file_put_contents("./".$json_dec->data->msgInfo->url,$imgs);
      
      $processed["message_body"] = "[url=".WS_URL."/wapp-LHC-Bridge/".$json_dec->data->msgInfo->url."]IMAGEM-VIDEO[/url]";
      // $processed["message_body"] = __FILE__.$json_dec->data->msgInfo->url .' - '. $json_dec->data->msgInfo->caption ;
      
      
    }
    
    if($processed["type"] == "audio") {
      $imgs = file_get_contents(WAPI_URL.$json_dec->data->msgInfo->url);
      
      file_put_contents("./".$json_dec->data->msgInfo->url,$imgs);
      
      $processed["message_body"] = "[url=".WS_URL."/wapp-LHC-Bridge/".$json_dec->data->msgInfo->url."]AUDIO[/url]";
    }
    return $processed;
  }
  
  
  public function send_media_msg_wapi($phone,$fileUrl,$fileName,$op) {
    $this->login_wapi();
    
    $params["username"] = $this->username;
    $params["jid"] = $phone;
    $params["fileName"] = $fileName;
    $params["fileURL"] = WS_URL.'/lhc_web/'.$fileUrl;
    $params["caption"] = base64_encode("Enviado por: ".$op);
  // 
  // file_put_contents("wapi_filename.txt",$params["fileName"]);
  // file_put_contents("direto_api.json",json_encode($params));
  // 
    $result = $this->api->post('sendMediaMessage', json_encode($params), 
    array('Content-Type' => 'application/json',
  'Authorization' => WAPI_TOKEN
));
  
    return $result;
  }
  
  
}


?>