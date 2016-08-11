<?php

use model\Test;

spl_autoload_register(function($className) {
	include(__DIR__.'/'.str_replace('\\', '/', $className).'.php'); //把命名空间的\转为/,当找不到类名时会把类名和命名空间名一并传入。
});

$test = new Test();
$test->query();
