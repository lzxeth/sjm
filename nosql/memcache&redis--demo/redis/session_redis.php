<?php
//ab -n 1000 -c 100 http://localhost/nosql/memcached/session_mem.php

ini_set("session.save_handler", "redis");
ini_set("session.save_path", "tcp://".HOST.":".PORT_REDIS);

session_start();


$_SESSION['s'] = "sijiaomao";

echo $_SESSION['s'];
