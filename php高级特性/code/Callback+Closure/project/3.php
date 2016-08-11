<?php

// callback & closure & Event

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


    public function insert(array $row) {
        fputcsv($this->_fp, $row);

        if($this->hasEventHandlers('afterInsert')) {
            $this->trigger('afterInsert', $row);
        }
 
    }

}


abstract class Component {
    protected $_events = [];

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

}




// step 1:

define('DB_FILE', '/tmp/test2.db');


$fileDb = FileDb::getInstance();

$fileDb->on('afterInsert', function($row) {
    echo "Inserted (From ".__FUNCTION__.")\n";
});

$fileDb->insert(array('sijiaomao', 'cat@animals.org'));























