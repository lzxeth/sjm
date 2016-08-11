<?php
	
$dest=fopen('dest.txt','wb');
$file1=fopen('file1.txt','rb');
$file2=fopen('file2.txt','rb');
while($line=fgets($file1)){
  fwrite($dest,$line);
}
while($line=fgets($file2)){
  fwrite($dest,$line);
}
