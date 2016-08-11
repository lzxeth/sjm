<?php

$myfile =fopen('top.png' ,'r');
fseek($myfile,1);
$bytes=fread($myfile,3);
echo($bytes);