<?php  
//变量引用
/*$a = "ABC";  
$b = &$a;  
echo $a;  
echo $b; 
$b = "EFG";  
echo $a;
echo $b; 
exit();*/

//函数引用传递
/*function  foo(&$a){  
	$a = $a + 100 ;  
} 
$b = 1 ;  
//echo $b ;  
foo($b); 
echo $b ; 
exit();
*/


//函数引用返回
/*function test(){
	&$b=0;//申明一个静态变量
	$b=$b+1;
	echo "######".$b."@@@\r\n";
	return $b;
}
$a=test(); //1

$a=5;
$a=test(); //1 or 6
$a=&test();// 1 or 2 or 7
$a=10;
$a=test();//
exit();
*/

//对象的引用
class a{
	var $abc="ABC";
}
$b=new a;
$c=$b;
echo $b->abc;//这里输出ABC
echo $c->abc;//这里输出ABC
$b->abc="DEF";
echo $c->abc;//这里输出DEF
