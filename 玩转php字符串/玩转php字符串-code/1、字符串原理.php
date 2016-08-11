<?php
 
$str='good day';

//1、是否可以直接获取某个字符?
echo  $str[0].PHP_EOL;

//2、是否可以修改字符串中的某个字符？
$str[0]='f';
echo $str.PHP_EOL;

//3、是否可以批量覆盖若干字符？
$str[0]='had';
echo $str.PHP_EOL;

//4、是否可以倒着修改字符？
$str[-1]='b';
echo $str.PHP_EOL;

//5、浮点下标访问会怎么样？
$str[1.6]='c';
echo $str.PHP_EOL;

//6、超出范围会怎么样？
$str[10]='!';
echo $str.PHP_EOL;


