<?php
$array = array("color" => "ÖÐÎÄÅ¶", 3, 4, 5, 'k' => 'v');
$data = serialize($array);
$data2 = json_encode($array);

echo 'serialize:';
var_dump(unserialize($data));
echo 'json_encode:';
var_dump(json_decode($data2));