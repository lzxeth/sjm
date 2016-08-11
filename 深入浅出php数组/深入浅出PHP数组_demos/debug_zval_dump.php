<?php
$a = array('youa', '生活', '票务');
foreach ($a as $key => &$value) {
    echo "$key:\n";
    debug_zval_dump($a[0]);
    debug_zval_dump($a[1]);
    debug_zval_dump($a[2]);
    $value = $value . "必胜";
    //unset($value);
}

debug_zval_dump($a);