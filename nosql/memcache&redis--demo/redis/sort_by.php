<?php
include '../config.php';

$redis = new Redis();
$redis->connect(HOST, PORT_REDIS);


// 标签集合
// 注：此处的 redis 是标签名
$key = 'tag:redis:articles';
$redis->delete($key);
$redis->sadd($key, 5);
$redis->sadd($key, 1);
$redis->sadd($key, 4);
$redis->sadd($key, 2);
$redis->sadd($key, 3);


// 文章
$redis->hMset('article:1', array('id'=>1, 'title' => '习近平发表讲话纪念邓小平诞辰', 'views' => 100));
$redis->hMset('article:2', array('id'=>2, 'title' => '李克强：取消下放87项审批事项', 'views' => 120));
$redis->hMset('article:3', array('id'=>3, 'title' => '最高法：下班回家顺道买菜出意外算工伤', 'views' => 152));
$redis->hMset('article:4', array('id'=>4, 'title' => '不动产登记局包括6个处和24个编制', 'views' => 10));
$redis->hMset('article:5', array('id'=>5, 'title' => '12家在华日本企业涉垄断被罚12亿 ', 'views' => 6000));

$sortby = array(
	'by' => 'article:*->views',
	'sort' => 'desc',
	'limit' => [2, 2]
);
var_dump($redis->sort($key, $sortby));

