<?php

$fh=fopen('dest.txt','a');

$fh1=fopen('file1.txt','r');
while( ($data=fgets($fh1)) !== false ){
	fwrite($fh,$data);
}
fclose($fh1);

$fh2=fopen('file2.txt','r');
while( ($data=fgets($fh2)) !== false  ){
	fwrite($fh,$data);
}
fclose($fh2);

fclose($fh);