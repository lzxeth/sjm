<?php
//ab -n 1000 -c 100 http://localhost/nosql/memcached/session_mem.php

ini_set("session.save_handler", "memcache");
ini_set("session.save_path", "tcp://".HOST.":".PORT_MEMCACHE);

session_start();
$_SESSION['s'] = "sijiaomao";

for($i=0; $i<100; $i++) {
	$_SESSION['s'.rand(1, 9999999).rand(1, 9999999).$i] = "sijiaomao";
}

echo $_SESSION['s'];

