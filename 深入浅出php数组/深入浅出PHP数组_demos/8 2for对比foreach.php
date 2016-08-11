<?php

/**
 * array_walk 和 foreach, for 的效率的比较。
 * 我们要测试的是foreach, for, 和 array_walk的效率的问题。 
 */

//产生一个1000000的一个数组。
$max = 10000000;
$test_arr = range(0, $max);
$temp = '';
//我们分别用三种方法测试求这些数加上1的值的时间。




// for 的方法
$startTime = microtime(true);
for ($i = 0; $i < $max; $i++) {
    $temp = $temp + 1;   //用数组做循环，但每次循环不操作数组
}
$endTime = microtime(true);
$t = $endTime - $startTime;
echo "使用for, 没有对数组操作 花费: {$t} \n";

// foreach 的方法
$startTime = microtime(true);
foreach ($test_arr as $k => &$v) {
    $temp = $temp + 1;
}
$endTime = microtime(true);
$t = $endTime - $startTime;
echo "使用 foreach 没有对数组操作 花费 : {$t}\n\n\n";








$startTime = microtime(true);
for ($i = 0; $i < $max; $i++) {
    $test_arr[$i] = $test_arr[$i] + 1;
}
$endTime = microtime(true);
$t = $endTime - $startTime;
echo "使用for 并且直接对数组进行了操作 花费: {$t}\n";

$startTime = microtime(true);
//foreach ($test_arr as $k => &$v) {
foreach ($test_arr as $k => $v) {
    $v = $v + 1;
    //$test_arr[$k] = $v + 1;
}
$endTime = microtime(true);
$t = $endTime - $startTime;
echo "使用 foreach 直接对数组操作 : {$t}\n\n\n";







$startTime = microtime(true);
for ($i = 0; $i < $max; $i++) {
    addOne($test_arr[$i]);
}
$endTime = microtime(true);
$t = $endTime - $startTime;
echo "使用for 调用函数对数组操作 花费 : {$t}\n";


$startTime = microtime(true);
foreach ($test_arr as $k => &$v) {
    addOne($v);
}
$endTime = microtime(true);
$t = $endTime - $startTime;
echo "使用 foreach 调用函数对数组操作 : {$t}\n\n\n";





function addOne(&$item) {
    $item = $item + 1;
}
