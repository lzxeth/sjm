<?php
if(php_sapi_name() != 'cli') ob_start('nl2br');

// 如下代码，最终输出什么？

function trytest() {
	try {
		echo "try\n";
	//	throw new Exception("I'm dying, Help!!");
		die;
		return false;
	} catch ( Exception $e ) {
		echo $e->getMessage()."\n";
	} finally {
		echo "finally\n";
		return true;
	}
}

var_dump(trytest());

