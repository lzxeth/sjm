<?php
	
$i=0;
do{
  $i++;
  $name=str_repeat ( "a" ,  $i );
}while(touch($name));

echo strlen($name);
 
