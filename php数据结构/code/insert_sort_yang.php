<?php
function easy_select($array){
	$len = count($array);
	for($i=$len-1;$i>=0;$i--){
		$index = $i;
		for($j=$i-1;$j>=0;$j--){
		 if($array[$index]<$array[$j]){
			$index = $j;	
		  }
		}
		$tempValue = $array[$index];
		$array[$index] = $array[$i];
		$array[$i] = $tempValue;
	}
	return $array;
}
$arr=array(10,23,23,1,4,21,4,532,35,324);
print_r(easy_select($arr));

