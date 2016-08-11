<?php

/**
 * Callback functions
 * 
 * 第一种方式为调用外部函数
 * 第二种方式为内部create_function方式，避免污染全局空间，现在不推荐这样写
 * 第三种匿名函数的方式是现在推荐的写法,php5.3之后。
 */

$textArray = array('Hello World!', 'Hello, Empire of China!');
//$textArray = array('"Hello" "World!"', '"Hello", "Empire" "of" "China"!');

//--------------------第一种写法---------------------------

function quoteWords($textArray) {
     if (!function_exists ('quoteWordsHelper')) {

         function quoteWordsHelper($string) {
             return preg_replace('/(\w+)/','"$1"',$string);
         }

     }

     return array_map('quoteWordsHelper', $textArray);

}

$quotedArray = quoteWords($textArray);


//--------------------第二种写法---------------------------


function quoteWords2($textArray) {

    return array_map(create_function('$string', 
        'return preg_replace(\'/(\w+)/\', \'"$1"\', $string);'
    ), $textArray);

}


$quotedArray = quoteWords2($textArray);



//----------------------第三种写法-------------------------


function quoteWords3($textArray) {

    return array_map(function($string) { 
        return preg_replace('/(\w+)/', '"$1"', $string);
    }, $textArray);

}


$quotedArray = quoteWords3($textArray);
print_r($quotedArray);


