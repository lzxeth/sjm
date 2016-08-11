<?php

$arr = array(
	array('name' => 'jake', 'score' => '80', 'grade' => 'A'),
	array('name' => 'jin', 'score' => '70', 'grade' => 'A'),
	array('name' => 'john', 'score' => '80', 'grade' => 'A'),
	array('name' => 'ben',  'score' => '20', 'grade' => 'B')
);
	
$names =array_column($arr , 'name' );
$scores =array_column($arr , 'score' );
$grades =array_column($arr , 'grade' );

array_multisort($scores, SORT_DESC, $names, $arr);

print_r($scores);
print_r($names);

print_r($arr);
