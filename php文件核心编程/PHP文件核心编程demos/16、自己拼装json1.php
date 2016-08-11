<?php
/*
$a=['北\京'=>['a',123=>[] ],'热门'];
 
echo json_encode($a, JSON_PRETTY_PRINT |  JSON_UNESCAPED_UNICODE );
exit; 
$str=file_get_contents('c:/demos/1.txt');

$json=json_decode($str,true);
print_r($json);

echo json_last_error_msg();
*/
	 
$format = '["%s",%d,%b]';
$jsonstr= sprintf($format, '张三丰', 16 , false );
$json=json_decode($jsonstr);
print_r($json);
echo json_last_error_msg();