<?php
include '../config.php';
ini_set('default_socket_timeout', -1);

$redis = new Redis();
$redis->connect(HOST, PORT_REDIS);

function callback($redis, $chan, $msg) {
    switch($chan) {
        case 'reg:email':
            echoln("send reg mail $msg");
            break;
        case 'password:email':
            echoln("send password mail $msg");
            break;
		default:
			var_dump($msg);
    }
	
	sleep(3);
}

$redis->subscribe(array('reg:email'), 'callback');
