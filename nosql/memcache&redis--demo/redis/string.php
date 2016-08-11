<?php
include '../config.php';

$redis = new Redis();
$redis->connect(HOST, PORT_REDIS);

// 设置
$redis->set('username', 'sijiaomao');
echoln($redis->get('username'));

// 加值
$redis->set('age', 18);
$redis->incr('age');
$redis->incr('age');
echoln($redis->get('age'));

$redis->incrBy('age', 10);
echoln($redis->get('age'));

//存储多个值
$data = array(
	'key0'=>'val0',
	'key1'=>'val1',
	'key2'=>'val2'
);
$redis->mset($data);

echoln($redis->mget(['key0', 'key1', 'key2']));


