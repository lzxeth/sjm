<?php
/**
 * 提取 access.log 各行中的 ip 和 request-url ，通过 foreach 遍历显示
 */


class AccessRecord {
	private $segments = [];
	public function __construct($row) {
		preg_match('/((?:\d{1,3}.){3}\d{1,3}).*?"[A-Z]{3,}\s(.*?)\s/', $row, $rs);
		$this->segments = array($rs[1], $rs[2]);
	}
	public function getIp() {
		return $this->segments[0];
	}
	public function getUrl() {
		return $this->segments[1];
	}
}


class AccessLogIterator implements Countable, Iterator {  //Countable:只要实现一个count方法，48行写了用途。
	private $filepath; 
	private $fp;
	private $currentContent; //当前行的内容
	private $linePointer; //当前行的指针（行号）
	private $count; //文件行数总计


	public function __construct($filepath) {
		$this->filepath = $filepath;
		$this->init();
	}
	
	/**
	  * 初始化，打开文件，重置文件指针
	  */
	private function init() {
		$this->linePointer = -1;    //因为第一行是0
		$this->currentContent = NULL;
		if(is_null($this->fp)) {
			$this->fp = fopen($this->filepath, 'rb');
		}
		rewind($this->fp);      //重置文件的指针
	}

	/**
	  * Countable 接口中需实现的方法，用于 count($obj) 返回结果
	  */
	public function count() {
		if(is_null($this->count)) {
			$this->count = intval(shell_exec("wc -l '{$this->filepath}'"));
		}
		return $this->count;
	}		

	public function current() {
		return $this->currentContent;
	}

	public function key() {
		return $this->linePointer;
	}

	public function next() {
		++$this->linePointer;
		if($this->linePointer < $this->count()) {
			$this->currentContent = new AccessRecord(fgets($this->fp));
		}
	}

	/**
	  * foreach 开始时调用 
	  */
	public function rewind() {
		$this->init();
		$this->next();
	}

	public function valid() {
		return $this->linePointer < $this->count();
	}

}

$t = new AccessLogIterator('./a.log');
echo 'Total: '.count($t).'<br />';

$i=0;
foreach($t as $key => $record) {

	echo $key.': '.$record->getIp()."\t".$record->getUrl().'<br />';
}
