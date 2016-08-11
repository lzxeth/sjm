<?php

$filename = $argv[1];
$number = intval($argv[2]);





$data = '';
if(!file_exists($filename)){
	exit($filename." is not exists!");
}

if(!$number){
	$number = 10;
}

$fp = fopen($filename,"r");
$i = 1;
while($i<=$number){
	$data .= fgets($fp);
	$i++;
}
fclose($fp);
echo $data;

?>