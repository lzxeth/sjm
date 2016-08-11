<?php

$items1 = [ 'a', 'b', 'c'];
$items2 = [ 'name' => 'andy', 'age' => 52, NULL => 87, '' => 89];

print_r($items1);
print_r($items2);


exit;


//用数字下标构建索引数组
$items[0] = 'abc123';
$items[1] = 'abc456';

print_r($items);

//省略下标构建索引数组
$items[] = 'abc123';
$items[] = 'abc456';
print_r($items);

//用字符串键构造关联数组
$items['name'] = 'andy';
$items['age'] = 52;

print_r($items);
