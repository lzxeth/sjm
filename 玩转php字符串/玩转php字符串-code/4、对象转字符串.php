<?php

class A {
  public $a='1';
  function test(){}
  
  function __toString(){
  	return $this->a;
  } 
}

$a=new A();

echo $a;