<?php

/**
 * trait 基本用法
 */

trait R {
    function rich () {
		//...
	}
}

class HH {
	use R;

	function handsome() {
		//...
	}
}

$obj = new HH();
$obj->rich();
