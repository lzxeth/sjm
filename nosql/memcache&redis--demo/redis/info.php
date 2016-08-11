<?php
include '../config.php';

$redis = new Redis();
$redis->connect(HOST, PORT_REDIS);

print_r( $redis->info() );