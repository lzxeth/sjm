<?php

$array1 = array("color" => "red", 2, 3);
$array2 = array("color" => "green", 3, 4, 5, 'k' => 'v');
$result = array_merge($array1, $array2);
print_r($result);

$array1 = array(2, 2=>3);
$array2 = array(3, 4, 5);
print_r($array1 + $array2);

print_r(array_merge(array(3 => 'test', 5 => 'test2')));
