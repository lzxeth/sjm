<?php

// singleton & late static 单例和延迟静态绑定

class fileDb {
    private $_filePath;
    private $_fp;
    protected static $_instance;

    public static function getInstance() {
        if(!isset(self::$_instance)) {
            self::$_instance = new static();   //延迟静态绑定
        }

        return self::$_instance;
    }

    private function __construct() {   //构造方法私有，为单例准备
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


 

define('DB_FILE', '/tmp/test.db');

$fileDb = fileDb::getInstance();
$fileDb->insert(array('sijiaomao', 'cat@animals.org'));























