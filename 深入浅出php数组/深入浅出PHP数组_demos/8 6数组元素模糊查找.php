<?php

 $array=[
	12312.3123,
	'abc123123',
	4444444444,
	'123abcdef'=>'abcdefghijk',
	'abc9999999',
 ];

$fl_array = preg_grep("/^abc.+$/", $array);
print_r($fl_array);











// 返回所有包含浮点数的元素
//$fl_array = preg_grep("/^(\d+)?\.\d+$/", $array);