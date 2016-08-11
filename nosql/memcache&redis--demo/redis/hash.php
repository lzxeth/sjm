<?php
include '../config.php';

$redis = new Redis();
$redis->connect(HOST, PORT_REDIS);

$redis->delete('user:1');
$redis->hMset('user:1', array('name' => 'Joe', 'salary' => 2000));
$redis->hIncrBy('user:1', 'salary', 100); // Joe earns 100 more now.

var_dump($redis->hGetAll('user:1'));

