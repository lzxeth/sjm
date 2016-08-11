<?php
session_start();

$_SESSION['uid'] = 123;
$_SESSION['abc'] = new a();
//$session_id=session_id(); 
//var_dump($session_id);

class a{
	public $s = 'test';
	public $b = array('12','34');
}
echo serialize($_SESSION['uid']);

?>