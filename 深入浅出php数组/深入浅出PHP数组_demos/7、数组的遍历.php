<?php

$peoples = array('张三','李四','王五','赵六');


echo "1、for语句循环遍历 \n";
$num=count($peoples);
for($i = 0; $i < $num ; $i++){
    echo $peoples[$i],"\n";
}

echo "2、foreach循环遍历 \n";
foreach ($peoples as $people) {
	echo $people,"\n";
}
#foreach自己不依赖于数组指针的位置，但是他会把数组指针移位


echo "3、while 结合 each的遍历\n";
$fruit = array('a' => 'apple', 'b' => 'banana', 'c' => 'cranberry');

reset($fruit);
while (list($key, $val) = each($fruit)) {
    echo "$key => $val\n";
}


echo "4、array_walk 回调遍历\n";
array_walk($peoples, function($people){
	echo $people,"\n";
});


echo "5、current和next  内部指针遍历\n";
reset($peoples); //防止被其它的移动位置影响到
while ($people = current($peoples)) {
	echo $people,"\n";
	next($peoples);
}
