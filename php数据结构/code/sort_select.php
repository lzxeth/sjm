<?php
$list = array(10,3,5,7,18,11,45,64,74,23,21,6);
$list = selectsort($list);
print_r($list);
function select_sort($list){
	$count = count($list);
	for ($i=0; $i < $count; $i++) { 
		$k = $i;
		for ($j=$i+1; $j < $count; $j++) { 
			if($list[$k] > $list[$j]){
				$k = $j;
			}
		}
		if($k != $i){
			$tem = $list[$i];
			$list[$i] = $list[$k];
			$list[$k] = $tem;
		}
	}
	return $list;
}


function selectsort($numbers){
	$cnt=count($numbers);
	for($i=0;$i<$cnt-1;$i++){//循环比较
		for($j=$i+1;$j<$cnt;$j++){
			if($numbers[$j]<$numbers[$i]){//执行交换
				$temp=$numbers[$i];
				$numbers[$i]=$numbers[$j];
				$numbers[$j]=$temp;
			}
		}
	}
return$numbers;
}


?>