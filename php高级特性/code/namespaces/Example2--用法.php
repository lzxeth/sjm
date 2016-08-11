<?php
namespace sjm\study;

include('./Example.php');

//use sjm\Example;

//$example = new Example(); // 使用 use "导入" 后，可以直接写类名
$example = new \sjm\Example(); // 如果不是用use，就要写完整的命名空间+类名,前面的 \ 表示从根命名空间开始，如果忽略则表示相对命名空间，从 sjm\study 开始。

