<?php

// 生成器函数实际上是返回一个 Generator 对象
// 此文件演示 Generator 对象的 send() 方法：

function lineGenerator($file) {
	$fp = fopen($file, 'rb');
	try {
		while($line = fgets($fp)) {
			yield $line;
		}

	} finally {
		fclose($fp);
	}
}

$lines = lineGenerator("./b.log"); 
foreach($lines as $key=>$line) {
	$lines->send('stop');

	echo $line;
}


