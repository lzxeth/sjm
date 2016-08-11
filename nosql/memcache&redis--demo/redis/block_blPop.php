<?php
include '../config.php';

$redis = new Redis();
$redis->connect(HOST, PORT_REDIS);

$redis->delete('key1');
$redis->lPush('key1', 'A');

var_dump($redis->blPop('key1', 10));

// 新开一个的命令行终端执行block_push.php
var_dump($redis->blPop('key1', 20));
