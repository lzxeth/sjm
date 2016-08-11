<?php
 
$str='hello dfsafs dsaffdsa world1';

var_dump($str==reverse(reverse($str)));

//echo $times.PHP_EOL;
function reverse($str){
	$len=strlen($str);
	$times=(int)($len/2)  ;
	for($i=0; $i<$times; $i++){
		$str[$i]=$str[$i]^$str[$len-$i-1];
		$str[$len-$i-1]=$str[$i]^$str[$len-$i-1];
		$str[$i]=$str[$i]^$str[$len-$i-1];
	}
	return $str;
}

