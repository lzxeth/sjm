<?php
trait firstTrait {
	function sameMethodName() { echo "method in firstTrait\n"; }
}
  
trait secondTrait {
    function sameMethodName() { echo "method in secontTrait\n"; }
}

class firstClass {
    use firstTrait, secondTrait {
		// 使用firstTrait中的sameMethodName()方法而不是用secondTrait中的。:
		firstTrait::sameMethodName insteadof secondTrait;
		// 使用secondTrait中的sameMethoName()方法但改名为 anotherMethodName():
		secondTrait::sameMethodName as public anotherMethodName;
	}

}
  
$obj = new firstClass();
  
$obj->sameMethodName(); 
$obj->anotherMethodName();
  
