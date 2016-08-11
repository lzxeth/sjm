<?php
include '../config.php';

$redis = new Redis();
$redis->connect(HOST, PORT_REDIS);


$redis->publish('channel:1', 'user:1');
$redis->publish('channel:2', 'user:2');
sleep(1);

$redis->publish('channel:2', 'user:3');
$redis->publish('channel:1', 'user:4');
sleep(1);

$redis->publish('channel:3', 'user:5');
$redis->publish('channel:1', 'user:6');
sleep(1);

$redis->publish('channel:2', 'user:7');
$redis->publish('channel:3', 'user:8');