<?php
 error_reporting(E_ALL);
$a = array(1);
$a[] = &$a;
//$c = &$a;
//$d = &$a;
//$c = null;
//$c =1;
//unset($a);
unset($a);
xdebug_debug_zval('a');
//var_dump(get_defined_vars()); 