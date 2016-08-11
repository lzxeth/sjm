<?php

//define('HOST', '10.0.6.241');
//define('HOST', '192.168.10.39');
define('HOST', '127.0.0.1');

define('PORT_MEMCACHE', 11211);
define('PORT_MEMCACHE_A', 11211);
define('PORT_MEMCACHE_B', 11212);
define('PORT_MEMCACHE_C', 11213);


define('PORT_REDIS', 6379);

define('PORT_MONGO', 27017);

function echoln($info) {
	print_r($info);
	echo "\n";
}