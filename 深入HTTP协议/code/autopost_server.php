<?php

$key = $_POST['key'];
$data = $_POST['data'];

if($key == '123'){
	file_put_contents("data.txt", "$data\r\n",FILE_APPEND);
	exit("ok");
}  

?>