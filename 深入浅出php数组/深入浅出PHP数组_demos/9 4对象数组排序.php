<?php

class Person {
	
	private $name;
	private $age;
	
	function __construct($name, $age) {
	   $this->name=$name;
	   $this->age=$age;
	}
	
	public function getAge (){
		return $this->age;
	}

}

$objs=array();
$objs[]=new Person( '张三', 18 );
$objs[]=new Person( '李四', 56 );
$objs[]=new Person( '王五', 9 );
$objs[]=new Person( '赵六', 25 );


usort($objs,function($obja,$objb){
	return ($obja->getAge()- $objb->getAge() );
});

print_r($objs);
