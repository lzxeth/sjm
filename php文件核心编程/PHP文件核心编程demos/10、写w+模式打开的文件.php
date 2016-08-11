<?php

$handle = fopen("write.txt", "w+");
fputs($handle, '我写写！');
rewind($handle);  //倒回文件指针的位置
$content=fgets($handle);
var_dump($content);
 