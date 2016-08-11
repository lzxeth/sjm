<?php
//标准输入 stdin


$stdin1 = fopen("php://stdin","r");
echo "please input a number!\r\n";
$num = fgets($stdin1);
echo "ok , $num";

//echo "the second type:";
//$stdin2 = fgets(STDIN);
//var_dump($stdin2);

exit;



//标准输出stdout
//第一种方式:
/*$stdout = fopen('php://stdout', 'w');
fwrite($stdout, "1:php://stdout\r\n");
fclose($stdout);
//第二种方式
fwrite(STDOUT, "2:STDOUT\r\n");*/


//标准错误stderr,默认情况会发送到客户端
$stderr = fopen('php://stderr', 'w');
fwrite($stderr, "err1");
fclose($stderr);
fwrite(STDERR, "err2");




?>