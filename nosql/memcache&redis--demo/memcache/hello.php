<?php
$mem = new Memcache;
$mem->connect('127.0.0.1',  11211);

$mem->set("str_key", "String to store in memcached");
$mem->set("num_key", 123);
$mem->increment('num_key', 2);

$object = new StdClass;
$object->attribute = 'test';
$mem->set("obj_key", $object);

$array = Array('assoc'=>123, 345, 567);
$mem->set("arr_key", $array);

var_dump($mem->get('str_key'));
var_dump($mem->get('num_key'));
var_dump($mem->get('obj_key'));

$mem->set('image',  file_get_contents('files/image.jpg'));
$mem->set('1.rar',  file_get_contents('files/1.rar'));

$mem->set('a10m',  str_repeat('a', 1024 * 1024 * 10));
//echo $mem->get('a10m');


for ($i=1; $i<1000; $i++) {
	$mem->set("for:".$i, str_repeat('0', $i*100));
}








