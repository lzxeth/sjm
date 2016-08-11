<?php

//对象的序列化
class A {
    public $one = "嘿嘿！";
    public function show_one() {
        echo $this->one;
    }
}
$a = new A;
$s = serialize($a);

$b = unserialize($s);
// 现在可以使用对象$b里面的函数 show_one()
$a->show_one();