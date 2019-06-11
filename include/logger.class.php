<?php

class logger {
  public function __construct($module,$function,$attr,$request,$response)   {
    
    $this->module  = $module;
    $this->function = $function;
    $this->attr = $attr;
    $this->request = $request;
    $this->response = $response;
  }
  
  
  public function send_log() {
    
    $dbh = new PDO('mysql:host='.$s.';dbname='.$d, $u, $p);
    $sql = "insert into bridge_logs (module,function,attr,request,response) values
    '$this->module',  '$this->function',  '$this->attr',  '$this->request',  '$this->response'  ";
      
    $sth = $dbh->prepare($sql);
    $sth->execute();

  }
}


?>