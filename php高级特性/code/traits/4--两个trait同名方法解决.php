<?php
trait firstTrait {
	function sameMethodName() { echo "method in firstTrait\n"; }
}
  
trait secondTrait {
    function sameMethodName() { echo "method in secontTrait\n"; }
}

class firstClass {
    // 使用firstTrait中的sameMethodName()方法而不是用secondTrait中的。:
    use firstTrait, secondTrait {
		firstTrait::sameMethodName insteadof secondTrait;
	}
}
  
$obj = new firstClass();
  
$obj->sameMethodName(); // Print : method in firstTrait
  
