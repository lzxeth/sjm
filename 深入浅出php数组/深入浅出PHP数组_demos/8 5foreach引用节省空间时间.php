<?php
$start = microtime(true);
echo memory_get_usage(true) . "\n";
$a = array();
for ($i = 0; $i < 50000; $i++) {
    $a[] = array(1);
}
//foreach ($a as $k => $v) {
//    $a[$k] = array(1);
//    break;
//}
foreach ($a as $k => &$v) {
    $v = array(1);
    break;
}
unset($v);
echo memory_get_usage(true) . "\n";
$end = microtime(true);
$cost = $end - $start;
echo $cost."\n";
