<?php

$handle = fopen("without_t.txt", "w");

if ($handle) {
	fputs($handle,"a\n") ;
	fputs($handle,"b\n") ;
	fputs($handle,"c\n") ;
	fclose($handle);
}
 