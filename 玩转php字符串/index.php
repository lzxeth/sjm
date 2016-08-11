<?php
interface Demo {
	public function p($a);
}
class Child implements Demo {
	public function p($a) {
		return $a;
	}
}

$d = new Child ();
echo $d->p ( 3 );

$arr = [1,4,3,5,2];
for($i=0;$i<count($arr);$i++){
	for($j=0;$j<count($arr)-1;$j++){
		if($arr[$j] > $arr[$j+1]){
			list($arr[$j], $arr[$j+1]) = array($arr[$j+1], $arr[$j]);
		}
	}
}

print_r($arr);

$a = 1;
$b = 2;
$a = $a^$b;
$b = $b^$a;
$a = $a^$b;
echo $a,$b;    //亦或，相同为0，不同为1，A^B^B=A,亦或一个数两次还是自己。A^B == B^A,与顺序无关
echo 1^2; 

//14题：直接选择会导致数据不稳定，（数据不稳定：3,9,3会把后边的3倒到前边）