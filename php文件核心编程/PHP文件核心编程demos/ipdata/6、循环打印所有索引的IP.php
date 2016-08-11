<?php
 
 
$fd=fopen('qqwry.dat', 'rb');

$DataBegin = fread($fd, 4);  //第一条索引的绝对偏移
$DataEnd = fread($fd, 4) ;   //最后一条索引的绝对偏移

$ipbegin = implode('', unpack('L', $DataBegin));
( $ipbegin < 0 ) && $ipbegin += pow(2, 32); 

$ipend = implode('', unpack('L', $DataEnd));
( $ipend < 0 ) && $ipend += pow(2, 32); 

 echo "ipbegin = $ipbegin \n";
 echo "ipend = $ipend \n";
/*

$ipbegin <=  $ipnum <  $ipend

这种情况取 $ipbegin

*/
for( $ipPos=$ipbegin ;  $ipPos <=$ipend  ;  $ipPos=$ipPos+7 ){
	fseek($fd, $ipPos ); //定位到ipPos
	$ipData1 = fread($fd, 4);  //起始IP地址的4个字节 
	$ipnum = implode('', unpack('L', $ipData1)); 
	if($ipnum < 0) $ipnum += pow(2, 32); 
	echo "ipPos = $ipPos ", "ipnum = $ipnum  " , long2ip($ipnum)  ,"  \n";
}

