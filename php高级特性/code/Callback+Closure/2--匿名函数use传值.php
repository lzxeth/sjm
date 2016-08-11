<?php

//这个是匿名函数和闭包( Anonymous functions & Closures )的例子


/**
 * 1. the "use" keyword --------------------------------------
 */

$string = "Hello World!\n";

$closure = function() use ($string) { 
    echo $string; 
};

$string = "Hello China\n";

$closure();

// Q: what's the output ? '&'    //输出Hello World! ，use是用的第一个$string,如果是function($string)的写法就是用的第二个了。


/**
 * 2. Closure returned by a function
 * 此函数执行时的$string = "Hello China\n";
 */

function getPrinter(&$string) {

    return function() use($string) {
        echo $string;
    };

}

$printer = getPrinter($string);        //此步不会有任何输出，只是让$printer等于一个匿名函数，但是并没调用。

$string = "Hello Cat\n";

$printer();     //这步才调用匿名函数，输出Hello China，证明是在hello Cat前传入的$string,并且&也不会改变外边的值。即闭包函数不会改变外部变量的值，即使用&也不会。

// Q: what's the output ? '&'


/**
 * 3. The Closure Object
 */

//var_dump($printer);  反射打印出类Closure的实例$printer();闭包函数php会自动转换成内置类Closure的对象实例。

ReflectionObject::export($printer);
