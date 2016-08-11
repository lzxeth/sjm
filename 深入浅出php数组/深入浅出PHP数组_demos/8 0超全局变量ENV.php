<?php

#1 $GLOBALS 范例

function test() {
    $foo = "local variable";
    echo '$foo in global scope: ' . $GLOBALS["foo"] . "\n";
    echo '$foo in current scope: ' . $foo . "\n";
}

$foo = "global content";
test();

#与所有其他超全局变量不同，$GLOBALS在PHP中总是可用的。 


print_r($_ENV);



function test2()
{
    print_r($_ENV);
}
$_ENV[]='test';
//test2();
