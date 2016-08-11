<?php

/*
 * callback & closure & Event
 * 与2.php的区别：
 * FileDB继承了一个组件Component,
 * 该组件的作用是给方法添加事件(on),触发事件(trigger),判断是否有事件(hasEventHandlers)
 * 效果就是在执行完insert后又触发了afterInsert事件，afterInsert中包含on绑定的匿名函数，数组形式。
 * 
 */ 

trait Singleton {    //单例模式的trait
    protected static $_instance;

    final public static function getInstance() {
        if(!isset(self::$_instance)) {
            self::$_instance = new static();
        }

        return self::$_instance;
    }

    private function __construct() {
        $this->init();
    }

    protected function init() {}

    final private function __wakeup() {}
    final private function __clone() {}
}



class FileDb extends Component {  //继承一个组件，use一个trait
    use Singleton;

    private $_filePath;
    private $_fp;



    protected function init() {
        $this->_filePath = DB_FILE;
        $this->_fp = fopen($this->_filePath, 'a+');
    }

    public function __destruct() {
        fclose($this->_fp);
    }


    public function insert(array $row) {
        fputcsv($this->_fp, $row);

        if($this->hasEventHandlers('afterInsert')) {    //判断是否有afterInsert事件。
            $this->trigger('afterInsert', $row);  //触发afterInsert事件。
        }
 
    }

}


abstract class Component {
    protected $_events = [];
	
    /*
     * 添加事件
     * params 事件名，回调函数
     */
    public final function on($eventName, $handler) {  
        if(!isset($this->_events[$eventName])) {  
            $this->_events[$eventName] = [];
        }

        if(is_callable($handler)) {
            $this->_events[$eventName][] = $handler;   //给同一个事件名添加多个事件
        }
    }

    public final function trigger($eventName, $data) {
        if(isset($this->_events[$eventName])) {
            foreach($this->_events[$eventName] as $handler) {   //循环当前事件中的匿名函数数组，调用每一个匿名函数
                call_user_func($handler, $data);
            }
        }
    }

    public function hasEventHandlers($eventName) {
        return !empty($this->_events[$eventName]);
    }

}




// step 1:

define('DB_FILE', '/tmp/test2.db');


$fileDb = FileDb::getInstance();

$fileDb->on('afterInsert', function($row) {
    echo "Inserted (From ".__FUNCTION__.")\n";   //从输出中看出__FUNCTION__在匿名函数中输出closure
});
$fileDb->on('afterInsert', function($row) {
    echo "Inserted2 (From ".__FUNCTION__.")\n";
});


$fileDb->insert(array('sijiaomao', 'cat@animals.org'));  

/*
 * 上边的insert后页面输出Inserted (From {closure})    Inserted2 (From {closure})
 * 
 */ 























