<?php

#1 一个简单数组

$array = array(
    "foo" => "bar",
    "bar" => "foo",
);

// 自 PHP 5.4 起
$array = [
    "foo" => "bar",
    "bar" => "foo",
];


#2 类型强制与覆盖示例

$array = array(
    1 => "a",
    "1" => "b",
    1.5 => "c",
    true => "d",
);

var_dump($array);


#3 混合 integer 和 string 键名

$array = array(
    "foo" => "bar",
    "bar" => "foo",
    100 => -100,
    -100 => 100,
);
var_dump($array);


#4 没有键名的索引数组

$array = array("foo", "bar", "hallo", "world");
var_dump($array);


#5 仅对部分单元指定键名

$array = array(
    6 => "c",
    7 => "d",
);
echo ' num= ' . count($array);

var_dump($array);


#6 访问数组单元（问：如何确定数组是几纬的？）

$array = array(
    "foo" => "bar",
    42 => 24,
    "multi" => array(
        "dimensional" => array(
            "array" => "foo"
        )
    )
);

var_dump($array["foo"]);
var_dump($array[42]);
var_dump($array["multi"]["dimensional"]["array"]);


#7 数组间接引用

function getArray()
{
    return array(1, 2, 3);
}

// on PHP 5.4
$secondElement = getArray()[1];

// previously
$tmp = getArray();
$secondElement = $tmp[1];

// or
list(, $secondElement) = getArray();


# 用方括号（花括号也可）的语法新建／修改
$arr = array(5 => 1, 12 => 2);
$arr[] = 56;
$arr["x"] = 42;
unset($arr[5]);
unset($arr);
