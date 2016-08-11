<?php
$array1 = array("color" => "red", 2, 3);
$array2 = array("color" => "green", 3, 4, 5, 'k' => 'v');
$result = array_merge($array1, $array2);

$data = var_export($result,TRUE);
$data = "<?php return $data;";

file_put_contents('arraydata.txt',$data);

$foo = include 'arraydata.txt';
var_dump($foo);
