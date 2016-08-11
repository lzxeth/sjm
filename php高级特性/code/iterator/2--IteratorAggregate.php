<?php

/**
 * 怎样获取类中的 $names ?
 * 1. implements IteratorAggregate
 * 2. function getIterator()
 * 3. foreach ...
 */

class Languages implements IteratorAggregate {
	private $names;

	public function __construct() {
		$this->names = explode(',', 'PHP,JS,Java,Go');
	}

	/**
	  * IteratorAggregate 中定义的,必须实现
	  */
	public function getIterator() {
		return new ArrayIterator($this->names);
	}

}

$langs = new Languages();
foreach($langs as $lang) {
	echo "$lang\n";
}


/**
        ArrayIterator也是继承Traversable ，就是返回一个数组的迭代器。
		看在线手册。手册右边列出来的很多**Iterator，可以遍历目录和文件等，
		把ArrayIterator替换成其他的就可以实现相应的功能。
 * 
 **/

