<?php
include '../config.php';

$redis = new Redis();
$redis->connect(HOST, PORT_REDIS);

for($i=0; $i<10; $i++) {
	$redis->publish('reg:email', "user:$i");
}
