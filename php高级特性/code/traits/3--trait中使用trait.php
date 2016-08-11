<?php

trait firstTrait {
	function firstMethod() { echo "method1"; }
}
  
trait secondTrait {
	// trait 中使用 trait：
    use firstTrait;
    function secondMethod() { echo "method2"; }
}

class firstClass {
    use secondTrait;
}
  
$obj= new firstClass();
  
// Valid
$obj->firstMethod(); // Print : method1
  
// Valid
$obj->secondMethod(); // Print : method2
