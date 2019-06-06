<?php
ini_set('display_errors','on');

include 'include/lhrestapi.php';
include 'include/lhc.config.php';
include 'include/lhc.class.php';

$from_phone = $_POST["from_phone"];
$from_name = $_POST["from_name"];
$msg = $_POST["msg"];

$lhc = new lhc;

$lhc->send_msg_lhc($from_phone,$from_name,$msg);

?>