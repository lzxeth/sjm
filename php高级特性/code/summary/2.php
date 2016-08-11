<?php

// trait，把1.php的单例模式改为trait.

trait Singleton {
    protected static $_instance;

    final public static function getInstance() {  //final定义为不能覆盖
        if(!isset(self::$_instance)) {
            self::$_instance = new static();
        }

        return self::$_instance;
    }

    private function __construct() {  //此处的构造方法私有了，所以use的类需要一个init()方法来实现自己的__construct
        $this->init();
    }

    protected function init() {}

    final private function __wakeup() {}   //防止通过反序列化实例化对象，private防止调用，final防止覆盖
    final private function __clone() {}    //防止clone
}



class fileDb {
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
    }

}


// step 1:

define('DB_FILE', '/tmp/test2.db');
$fileDb = fileDb::getInstance();
$fileDb->insert(array('sijiaomao', 'cat@animals.org'));























