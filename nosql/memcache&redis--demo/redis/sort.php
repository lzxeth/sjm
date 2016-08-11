<?php
include '../config.php';

$redis = new Redis();
$redis->connect(HOST, PORT_REDIS);

$key = 'tag:redis:articles';
$redis->delete($key);
$redis->sadd($key, 5);
$redis->sadd($key, 4);
$redis->sadd($key, 2);
$redis->sadd($key, 1);
$redis->sadd($key, 3);

var_dump($redis->sort($key)); // 1,2,3,4,5
var_dump($redis->sort($key, array('sort' => 'desc', 'limit'=>[2,2]))); // 3, 2
var_dump($redis->sort($key, array('sort' => 'desc', 'store' => 'out'))); // (int)5

/*
var_dump('string: '.Redis::REDIS_STRING);
var_dump('set: '.Redis::REDIS_SET);
var_dump('list: '.Redis::REDIS_LIST);
var_dump('zset: '.Redis::REDIS_ZSET);
var_dump('hash: '.Redis::REDIS_HASH);
var_dump('other: '.Redis::REDIS_NOT_FOUND);
*/
var_dump($redis->lRange('out', 0, -1)); // 0 到最后一个
var_dump($redis->lRange('out', 0, -2)); // 0 到倒数第2个



