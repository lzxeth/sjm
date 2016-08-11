<?php

// behavior & decorator 

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
    protected $_behaviors = [];

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


    public function attachBehavior($name, $behavior) {
        if($behavior instanceof Behavior) {
            $this->_behaviors[$name] = $behavior;
            $behavior->attach($this);
        }
    }

    public function __call($name, $params) {
        foreach($this->_behaviors as $behavior) {
            if(method_exists($behavior, $name)) {
                $method = new ReflectionMethod($behavior, $name);
                if($method->isPublic()) {
                    return call_user_func_array([$behavior, $name], $params);
                }
            }
        }

        throw new Exception('Unknown method: '.get_class($this)."::$name()");
    }

}


abstract class Behavior {
    public $owner;

    public function attach($to) {
        $this->owner = $to;

        $methods = get_class_methods($this); 
        foreach($methods as $methodName) {
            if(strpos($methodName, 'on') === 0 && strlen($methodName) > 2) {
                $this->owner->on(lcfirst(substr($methodName, 2)), [$this, $methodName]);
            }
        }


    }
}

class DbBehavior extends Behavior {
    
    public function getFirstRecord() {
        $fp = $this->owner->getFilePointer();
        $pos = ftell($fp);
        rewind($fp);
        $firstLine = fgets($fp);
        fseek($fp, $pos);
        return $firstLine;
    }

    public function onAfterInsert($row) {
        echo "Inserted (From ".__CLASS__.")\n";
    }


}




// step 1:

define('DB_FILE', '/tmp/test2.db');


$fileDb = FileDb::getInstance();

$fileDb->on('afterInsert', function($row) {
    echo "Inserted (From ".__FUNCTION__.")\n";
});



$fileDb->attachBehavior('DbBehavior', new DbBehavior());
$fileDb->insert(array('sijiaomao', 'cat@animals.org'));


echo "The First Line is: ".$fileDb->getFirstRecord();





















