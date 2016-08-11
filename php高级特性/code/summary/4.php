<?php

/*
 * behavior & decorator 
 * 与3.php不同，3是事件：使用事件，可以在特定的时点，触发执行预先设定的一段代码
 * 当前代码是，行为：
 * 使用行为（behavior）可以在不修改现有类的情况下，对类的功能进行扩充。 
 * 通过将行为绑定到一个类，可以使类具有行为本身所定义的属性和方法，就好像类本来就有这些属性和方法一样。
 *  而且不需要写一个新的类去继承或包含现有类。
 * 
 */ 

trait Singleton {
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



class FileDb extends Component {
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

    public function getFilePointer() {
        return $this->_fp;
    }

    public function insert(array $row) {
        fputcsv($this->_fp, $row);

        if($this->hasEventHandlers('afterInsert')) {
            $this->trigger('afterInsert', $row);
        }
 
    }

}


abstract class Component {
    protected $_events = [];
    protected $_behaviors = [];   //定义存放行为的容器，其实就是存放的key为类名，value为类的实例化的数组。array('DbBehavior'=>new DbBehavior())

    public final function on($eventName, $handler) {
        if(!isset($this->_events[$eventName])) {
            $this->_events[$eventName] = [];
        }

        if(is_callable($handler)) {
            $this->_events[$eventName][] = $handler;
        }
    }

    public final function trigger($eventName, $data) {
        if(isset($this->_events[$eventName])) {
            foreach($this->_events[$eventName] as $handler) {
                call_user_func($handler, $data);
            }
        }
    }

    public function hasEventHandlers($eventName) {
        return !empty($this->_events[$eventName]);
    }

	/*
	 * 添加一个行为
	 * $name为类名，$behavior为类的实例化
	 * 只有instanceof Behavior类的实例化才能作为扩展功能类用，扩展功能类就是行为。
	 */
    public function attachBehavior($name, $behavior) {  
        if($behavior instanceof Behavior) {
            $this->_behaviors[$name] = $behavior;  //把当前new DbBehavior 添加到行为属性里，方便用这个类的方法。
            $behavior->attach($this);
        }
    }

    public function __call($name, $params) {          //调用当前类的不存在的方法触发call函数，判断这个方法是否在扩展的行为类里边。
        foreach($this->_behaviors as $behavior) {    //循环当前的所有行为查找是否包含传入的方法$name。
            if(method_exists($behavior, $name)) {
                $method = new ReflectionMethod($behavior, $name); //反射找到的行为中的方法，判断当前方法的属性。
                if($method->isPublic()) {  //判断是不是公有方法
                    return call_user_func_array([$behavior, $name], $params);  //return 才能得到结果。
                }
            }
        }

        throw new Exception('Unknown method: '.get_class($this)."::$name()");  //行为中也没有当前方法的话返回Exception.
    }

}


abstract class Behavior {
    public $owner;

    public function attach($to) {   
        $this->owner = $to;
    }
}

class DbBehavior extends Behavior {

	/*
	 * 获取文件中第一行的函数。
	 * 但是当前的$fp是通过调用该类的类传入进来的，当前类的方法只负责返回第一行。
	 * 通过在FileDb类绑定行为的时候通过$behavior->attach($this) 把FileDb类赋值给$owner.
	 */
    public function getFirstRecord() {
        $fp = $this->owner->getFilePointer();   //调用FileDb类中的getFilePointer方法得到$fp.
        $pos = ftell($fp);   //获取文件指针
        rewind($fp);
        $firstLine = fgets($fp);
        fseek($fp, $pos);  //返回第一行后再把文件指向原指针位置。
        return $firstLine;
    }
}




// step 1:

define('DB_FILE', '/tmp/test2.db');


$fileDb = FileDb::getInstance();

$fileDb->on('afterInsert', function($row) {
    echo "Inserted (From ".__FUNCTION__.")\n";
});



$fileDb->insert(array('sijiaomao', 'cat@animals.org'));

$fileDb->attachBehavior('DbBehavior', new DbBehavior());

echo "The First Line is: ".$fileDb->getFirstRecord();





















