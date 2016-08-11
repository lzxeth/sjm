<?php

 
try {
	$m = new MongoClient( 'mongodb://127.0.0.1:27017' );
	$db = $m->selectDB('test');
} catch(MongoConnectionException $e) {
	exit("数据库连接失败！");
}
$collection = $db->selectCollection('user');
$cursor = $collection->find( array('gender'=>"0") )->sort(array('age'=>1));
foreach ($cursor as $item) { 
 	print_r($item);
}
 
$m->close();

 