<?php
/**
 * yield 
 *  生成器函数实际上是返回一个 Generator 对象
 *  send()为Generator对象的方法
 */

function lineGenerator($file) {
	$fp = fopen($file, 'rb');
	try {
		while($line = fgets($fp)) {
			var_dump(yield $line);
		}

	} finally {
		fclose($fp);
	}
}


$lines = lineGenerator("a.log"); 
foreach($lines as $line) {
	$lines->send('test');	
	echo $line;
}


