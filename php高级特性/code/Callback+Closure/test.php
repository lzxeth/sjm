<?php

class Test {
    private static $t = 22;
    
    public static function getInstance() {
        return static::$t;
    }
}

class T2 extends Test {
    public static $t=23;
    public function getT() {
        return self::$t;
    }
}

$t = new T2();
print_r(T2::getInstance());
//print_r(getT());
