<?php
include '../config.php';

$redis = new Redis();
$redis->connect(HOST, PORT_REDIS);


$redis->publish('reg:email', 'user:1');
sleep(1);
$redis->publish('reg:email', 'user:2');
sleep(1);
$redis->publish('password:email', 'user:3');
sleep(1);
$redis->publish('password:email', 'user:4');

