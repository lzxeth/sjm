<?php
include '../config.php';
ini_set('default_socket_timeout', -1);

$redis = new Redis();
$redis->connect(HOST, PORT_REDIS);

while($user = $redis->blPop('list:password:email', 'list:reg:email', 0)) {
	echoln($user);
	sleep(1);
}
