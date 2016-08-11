<?php
include '../config.php';
ini_set('default_socket_timeout', -1);

$redis = new Redis();
$redis->connect(HOST, PORT_REDIS);

function callback($redis, $chan, $msg) {
    echo "$msg\n";
	sleep(3);
}

$redis->subscribe(array('channel:2'), 'callback');
