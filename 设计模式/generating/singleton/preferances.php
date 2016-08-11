<?php

//解决两个问题：
//1.再全局范围内只有一个实例
//2.修改后全局都改

class Preferences {
    private $props = array();
    private static $instance;

    private function __construct() { }

    public static function getInstance($type) {  //通过type控制为多例模式
        if ( empty( self::$instance[$type] ) ) {
            self::$instance[$type] = new Preferences();
        }
        return self::$instance[$type];
    }

    public function setProperty( $key, $val ) {
        $this->props[$key] = $val;
    }

    public function getProperty( $key ) {
        return $this->props[$key];
    }
	
	final private function __wakeup(){}
	final private function __clone(){}

}

$pref = Preferences::getInstance('site');
$pref->setProperty( "name", "matt" );

$pref2 = Preferences::getInstance('site'); //此处的类还是上边的类
echo $pref2->getProperty( "name" );
