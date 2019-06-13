<?php

ini_set('display_errors','on');

include 'include/include.php';

$wapp = new wapi;
$response = json_decode($wapp->check_online()->response);

$response->time = time();
$response->username = $wapp->username;

$response = json_encode($response);

echo $response;
// var_dump($response);



?>
