<?php

/**
 * 怎样获取类中的 $names ?
 *
 */

class Languages {
	private $names;

	public __construct() {
		$this->names = explode(',', 'PHP,JS,Java,Go');
	}

}



















	/**
	 * 这样？
	 * $names = (new Languages())->getNames();
	 * foreach($names as $name) { ... }
	 */
	public function getNames() {
		return $this->names;
	}

}


