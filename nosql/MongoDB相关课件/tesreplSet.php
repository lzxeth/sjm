<?php

define('DB_STR', "mongodb://127.0.0.1:27017,127.0.0.1:27018,127.0.0.1:27019,127.0.0.1:27020");
define('DB_NAME', 'test');

try {
	$m = new MongoClient( DB_STR , array("replicaSet" => "mySet") );
	$db = $m->selectDB(DB_NAME);
} catch(MongoConnectionException $e) {
	exit("数据库连接失败！");
}
$collection = $db->selectCollection('user');
$cursor = $collection->find( array('gender'=>0) )->sort(array('age'=>1));
foreach ($cursor as $item) { 
 	print_r($item);
}
 
$m->close();

 