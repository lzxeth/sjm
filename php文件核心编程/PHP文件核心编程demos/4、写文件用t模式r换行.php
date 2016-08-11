<?php

$handle = fopen("with_t_r.txt", "wt"); //\t把\n转换为\r\n

if ($handle) {
	fputs($handle,"a\r") ;
	fputs($handle,"b\r") ;
	fputs($handle,"c\r") ;
	fclose($handle);
}
 