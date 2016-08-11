<?php

namespace   sjm;  //定义命名空间，防止和php的mysql类，memcached类冲突

abstract class Storage {
    protected $next;
    abstract public function get($key);

    public function append(Storage $next) {
        if(is_null($this->next)) {
            $this->next = $next;
        } else {
            $this->next->append($next);
        }
    }
}

class Memcache extends  Storage {
    private $data = array(
        '1'=>'today',
        '2'=>'is',
    );

    public function get($key) {
        // 此处可以是memcache的方法，为演示方便都用了数组。
        if(array_key_exists($key, $this->data)) {
            return $this->data[$key];
        } else {
            return $this->next->get($key);
        }
    }
}

class Mysql extends Storage {
    private $data = array(
        '1'=>'today',
        '2'=>'is',
        '3'=>'a',
        '4'=>'good day',
    );

    public function get($key) {
        // 此处应该是MySQL 的方法，如SELECT * FROM...为演示方便都用了数组。
        if(array_key_exists($key, $this->data)) {
            return $this->data[$key];
        } else {
            return null;
        }
    }
}


$mysql = new Mysql();
$stor = new Memcache();
$stor->append($mysql);
echo $stor->get('4');
