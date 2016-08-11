<?php
include '../config.php';

$redis = new Redis();
$redis->connect(HOST, PORT_REDIS);

$redis->delete('list:reg:email');

for($i=0; $i<10; $i++) {
	$redis->rPush('list:reg:email', "reg:email:$i");
}

// 可以观察worker的任务顺序，passord:email总是优先被执行

$redis->rPush('list:password:email', "password:email:1");

sleep(2);
$redis->rPush('list:password:email', "password:email:2");

sleep(2);
$redis->rPush('list:password:email', "password:email:3");

