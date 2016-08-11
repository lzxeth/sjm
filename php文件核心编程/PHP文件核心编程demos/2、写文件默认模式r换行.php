<?php

$handle = fopen("without_t_r.txt", "w");

if ($handle) {
	fputs($handle,"a\r") ;
	fputs($handle,"b\r") ;
	fputs($handle,"c\r") ;
	fclose($handle);
}
 