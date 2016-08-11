<?php
include('../config.php');
$mem = new Memcache();
$mem->connect(HOST, PORT_MEMCACHE);

echo "stats\n";
print_r($mem->getStats());

echo "\nstats slabs\n";
print_r($mem->getStats('slabs'));

echo "\nstats items\n";
print_r($mem->getStats('items'));
