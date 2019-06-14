<?php
ini_set('display_errors','on');

include 'include/include.php';


if($demo) {
$dbh = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);

$sql_chats = "DELETE FROM `lh_chat` WHERE time < (UNIX_TIMESTAMP(NOW()) - 300)";
$sql_msg = "DELETE FROM `lh_msg` WHERE time < (UNIX_TIMESTAMP(NOW()) - 300)";


$sth = $dbh->prepare($sql_chats);
$sth->execute();

$sth2 = $dbh->prepare($sql_msg);
$sth2->execute();
}


?>