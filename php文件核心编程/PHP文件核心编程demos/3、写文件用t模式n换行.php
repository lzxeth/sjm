<?php

$handle = fopen("with_t.txt", "wt");

if ($handle) {
	fputs($handle,"a\n") ;
	fputs($handle,"b\n") ;
	fputs($handle,"c\n") ;
	fclose($handle);
}
 