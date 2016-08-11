<?php
//覆盖模式，不会清空已有的文件。
$handle = fopen("write.txt", "c");
fputs($handle, "1");
fseek($handle, 3);
fputs($handle, '2');
 