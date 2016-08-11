<?php
include '../config.php';

$redis = new Redis();
$redis->connect(HOST, PORT_REDIS);

$redis->multi(Redis::PIPELINE);
$redis->set('key1', 'val1');
$redis->get('key1');
$redis->set('key2', 'val2');
$redis->get('key2');

$ret = $redis->exec();

var_dump($ret);

/*
$ret == array(
    0 => TRUE,
    1 => 'val1',
    2 => TRUE,
    3 => 'val2');
*/