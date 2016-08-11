<?php
/*
【四脚猫】每日一题（4月9日） ：从m个数中选出n个数来(0<n<=m)，要求n个数之间不能有重复，其和等于一个定值k。求一段程序，罗列所有的可能。	
http://stackoverflow.com/questions/728972/finding-all-the-subsets-of-a-set
http://stackoverflow.com/questions/6092781/finding-the-subsets-of-an-array-in-php
*/
define('K',18);

$nums=array(11, 18, 12, 1, -2, 20, 8, 10, 7, 6);

$numscount=count($nums);

$subscount = 2<< ($numscount-1); //每一次左移动都表示“乘以 2”。
 
 
for($i=1; $i<$subscount; $i++){
	$subitem=array();
	$binstr=decbin($i);
	$binstr=str_pad($binstr,$numscount,'0',STR_PAD_LEFT );//填充左边0，实现0补全
	for($j=0; $j<$numscount; $j++){
		if(1==$binstr[$j]){
			$subitem[]=$nums[$j];
		}
	}
	if(K==array_sum($subitem)){
		echo json_encode($subitem)."\n";
	}
}

 

 

