<?php
//文件不能先存在，否则 fopen() 调用失败并返回 FALSE，并生成一条 E_WARNING 级别的错误信息
$handle = fopen("write.txt", "x");
var_dump($handle);
 