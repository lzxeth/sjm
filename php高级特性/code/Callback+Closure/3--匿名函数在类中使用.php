<?php

/**
 * Closure inside an object
 */

class Cat {

    private $legs = 4;

    public function sayHi($sound) {      //方法中返回匿名函数，调用次方法相当于赋值一个匿名函数，但匿名函数本身并不会被调用

         return function() use ($sound) {
             echo "{$sound}, I am a cat,";
             echo "I have {$this->legs} legs.\n"; // Can use '$this'
         };

    }

    public function sayBye($sound) {   //返回静态的匿名函数，和方法sayHi相同

         return static function() use ($sound) { //can NOT use '$this'

             echo "{$sound}, I gotta go.\n";
//             echo "I have {$this->legs} legs.\n"; //ERROR!

         };

    }


    public function __invoke() { //use object as a function
        echo "I'm running with {$this->legs} legs now!\n";
    }
}

$sjm = new Cat();
$hi = $sjm->sayHi('Hi');    //把匿名函数赋值给$hi,并没有任何输出
$hi();   //此处调用匿名函数，有输出。

$bye = $sjm->sayBye('Miao');  //把匿名函数赋值给$bye,并没有任何输出
$bye();  //此处调用匿名函数，有输出。


$sjm();  //自动调用__invoke方法。
