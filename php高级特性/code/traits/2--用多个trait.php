<?php
trait firstTrait {
	function firstMethod() { echo "method1"; }
}
  
trait secondTrait {
	// trait 中也可以用抽象方法
    abstract function secondMethod();
}

class firstClass {
    // 使用多个 trait:
    use firstTrait, secondTrait;

	function secondMethod() {
		//...
	}
}
  
$obj = new firstClass();
  
// Valid
$obj->firstMethod(); // Print : method1
  
// Valid
$obj->secondMethod(); // Print : method2
