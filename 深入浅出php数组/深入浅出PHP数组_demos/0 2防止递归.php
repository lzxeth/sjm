<?php
$arr = array(1,2);
$arr[] = &$arr;
var_dump($arr);