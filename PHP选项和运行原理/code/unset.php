<?php
//情况一: unset是否可以删除变量,空出内存来?
/*
$string = str_repeat('s',100);
$m = memory_get_usage();
//echo $m."###";
unset($string);
$n = memory_get_usage();
echo $m-$n;
exit;
*/
//情况二: unset是否可以删除引用,空出内存来?
/*$string = str_repeat('s',100);
$l = &$string;
$m = memory_get_usage();
//echo $m."###";
unset($string);
$n = memory_get_usage();
echo $m-$n;
exit;
*/
//情况三:出现垃圾了,unset能否删除,空出内存来?
/*$array = array(str_repeat('s',100));
$array[] = &$array;
$m = memory_get_usage();
//echo $m."###";
$array=null;
//unset($array);
$n = memory_get_usage();
echo $m-$n;
exit;
*/





//情况三出现了,怎么解决?
$array = array(str_repeat('s',100));
$array[] = &$array;
$m = memory_get_usage();
//echo $m."###";
unset($array);

gc_enable();
$x = gc_collect_cycles();

$n = memory_get_usage();
echo $m-$n;


?>