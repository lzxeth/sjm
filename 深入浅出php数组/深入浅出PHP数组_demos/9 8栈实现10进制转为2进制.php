<?php

//十进制数转为2进制数
function dec2bin($dec) {
  $stack = array();
  while ($dec != 0) {
	array_push( $stack, $dec%2 );
	$dec = (int) ($dec / 2 );
  }
  $binstr='';
  while(!empty($stack)){
  	$binstr.=array_pop($stack);
  }
  return $binstr;
}

echo dec2bin(25);