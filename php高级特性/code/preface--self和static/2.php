<?php
class A {
    public static function who() {
        echo __CLASS__;
    }
    public static function getInstance() {
        return new static(); //----
    }
}

class B extends A {
    public static function who() {
        echo __CLASS__;
    }
}

$a = B::getInstance();
$a->who(); //输出什么？
