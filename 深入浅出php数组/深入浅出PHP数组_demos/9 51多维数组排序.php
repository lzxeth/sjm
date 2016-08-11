<?php

$items=array(
	array('id'=>12,'name'=>'张三' ,'age'=>18),
	array('id'=>8,'name'=>'李四' ,'age'=>30),
	array('id'=>19,'name'=>'王五' ,'age'=>10),
	array('id'=>4,'name'=>'赵六' ,'age'=>39),
	array('id'=>86,'name'=>'孙七' ,'age'=>6),
);


//方法1：用usort
usort($items,function($itema,$itemb){
	return ($itema['id'] -$itemb['id']);
});

print_r($items);



//方法2：用 array_multisort
/*
$ids =array_column($items , 'id' );

array_multisort($ids, SORT_ASC, $items);

print_r($items);
*/
