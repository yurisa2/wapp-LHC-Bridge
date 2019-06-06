<?php


class lhc {
  public function __construct() 
  {
    $this->LHCRestAPI = new LHCRestAPI(LHC_URL, LHC_USERNAME, LHC_KEY);
    
  }
  
  
  public function get_chat_data($no){
    $retorno = NULL;
    
    $response = $this->LHCRestAPI->execute('chats', array());
    
    var_dump($response);
    
    foreach ($response->list as $key => $value) {
      
      if(is_object(json_decode($value->additional_data)[0]) && ($value->status == 0 || $value->status == 1) &&
      json_decode($value->additional_data)[0]->value == $no
      )
      {
        // echo $value->id . ' - ' . $value->status . ' - ' . json_decode($value->additional_data)[0]->value;
        // echo '<br>';
        $retorno = array('id' => $value->id,
        'hash' => $value->hash);
      }
    }
    // var_dump($no);
    // print_r($response->list);
    
    return $retorno;
  }
  public function start_new_chat($from_phone,$from_name,$msg) {
    
    $response = $this->LHCRestAPI->execute('startchat', array(
      
      'Username' => $from_name . " - " . $from_phone,   // From what page chat has started
      'Question' => $msg,    // Initial message from user
      'data' => json_encode(array('tel' =>  array('val' => $from_phone))), // Store additional chat information
      'proactive' => true             // Start chat based on proactive data
    ), array(
      'vid' => $vid // You can pass visitor id so chat will be associated with this visitor
    ), 'POST',
    true,
    $urlAppend);
    
    return $chat_id;
  }
  
  public function send_msg_user($id,$hash,$msg) {
    $response = $this->LHCRestAPI->execute('addmsguser', array(
      'chat_id' => $id,
      'hash' => $hash,
      'msg' => $msg
    ), array(), 'POST');
    
  }
  
  public function send_msg_lhc($from_phone,$from_name,$msg) {
    // Check if there's a openchat, if not, start new
    
    
    
    $chat_id = $this->get_chat_data($from_phone)["id"];
    $chat_hash = $this->get_chat_data($from_phone)["hash"];
    
    if($chat_id > 0) $this->send_msg_user($chat_id,$chat_hash,$msg);
    else {
      $chat_id = $this->start_new_chat($from_phone,$from_name,$msg);
    
    }
        
  }  
}


?>