<?php

class Person {
	public function __get($property) {
		$method = "get{$property}";
		if(method_exists($this, $method)) {
			return $this->$method();
		}
	}

	public function getName() {
		return "Sijiaomao";
	}

	public function getAge() {
		return 1;
	}
}

$cat = new Person();
echo $cat->name;

