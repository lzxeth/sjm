<?php

$list = array(39, 38, 22, 45, 23, 67, 31, 15, 41);
$count = count($list);
$num = 0;

//bubble($num);
$newlist = bubbleSort($list);
print_r($newlist);


function bubbleSort($numbers){
	$cnt=count($numbers);
	for($i=0;$i<$cnt-1;$i++){//循环比较
		for($j=0;$j<$cnt-1-$i;$j++){
			if($numbers[$j]>$numbers[$j+1]){//执行交换
				$temp=$numbers[$j+1];
				$numbers[$j+1]=$numbers[$j];
				$numbers[$j]=$temp;
			}
		}
	}
return$numbers;
}




function bubble($num){
	global $list,$count;
	if($num < $count){
		for ($i=0; $i < $count-1 ; $i++) { 
			if($list[$i] > $list[$i+1] ){
				$tem = $list[$i];
				$list[$i] = $list[$i+1];
				$list[$i+1] = $tem;
			}	
		}
		$num++;
		bubble($num);
	}
	
}


?>