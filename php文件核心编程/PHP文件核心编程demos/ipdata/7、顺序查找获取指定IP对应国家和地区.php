<?php
 
 //把ip字符串转为long类型
 $ipstr="124.205.137.226";
$iplong = sprintf( "%u",ip2long($ipstr) );
 
 
 
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
$ipnum = 0;
for( $ipPos=$ipbegin ;  ($ipnum < $iplong) && ($ipPos <=$ipend)   ;  $ipPos=$ipPos+7 ){
	fseek($fd, $ipPos ); //定位到ipPos
	$ipData1 = fread($fd, 4);  //起始IP地址的4个字节 
	$ipnum = implode('', unpack('L', $ipData1)); 
	if($ipnum < 0) $ipnum += pow(2, 32); 
}

//重新往前定位到ipPos
fseek($fd, $ipPos -7*2 ); 

$ipData1 = fread($fd, 4);  //起始IP地址的4个字节
$ipnum = implode('', unpack('L', $ipData1)); 
if($ipnum < 0) $ipnum += pow(2, 32);   
 
echo  ' ipnum= '.$ipnum ."\n";
 
$ipData2 = fread($fd, 3);  //3个字节的偏移地址  
$ipPos = implode('', unpack('L', $ipData2.chr(0) ) );  

fseek($fd, $ipPos ); //定位到实际的数据记录
$IP = fread($fd, 4); //读取第4个字节的IP地址 FF 00 00 01 


$ipAddr1='';  //国家地址
$ipAddr2='';  //地区地址

$ipFlag = fread($fd, 1); //读取1个字节的标志位

if($ipFlag == chr(1)) {
	$ipSeek = fread($fd, 3);   //如果是标志1，则读取3个字节的 绝对偏移
	$ipSeek = implode('', unpack('L', $ipSeek.chr(0)));
	fseek($fd, $ipSeek);  //定位后，继续读取1个字节，判断是否 需要继续重新定向？
	$ipFlag = fread($fd, 1);
}

if($ipFlag == chr(2)) {
	$AddrSeek = fread($fd, 3);  //如果是标志2，则读取3个字节的 绝对偏移
	$ipFlag = fread($fd, 1);  //继续读取1个字节，判断是否 需要继续重新定向？
	if($ipFlag == chr(2)) {
		$AddrSeek2 = fread($fd, 3);
		$AddrSeek2 = implode('', unpack('L', $AddrSeek2.chr(0)));
		fseek($fd, $AddrSeek2);
	} else {
		fseek($fd, -1, SEEK_CUR);
	}

	while(($char = fread($fd, 1)) != chr(0))
	$ipAddr2 .= $char;

	$AddrSeek = implode('', unpack('L', $AddrSeek.chr(0)));
	fseek($fd, $AddrSeek);

	while(($char = fread($fd, 1)) != chr(0))
	$ipAddr1 .= $char;
} else {
	fseek($fd, -1, SEEK_CUR);
	
	while(($char = fread($fd, 1)) != chr(0)){
		$ipAddr1 .= $char;
	}

	$ipFlag = fread($fd, 1);
	if($ipFlag == chr(2)) {
		$AddrSeek2 = fread($fd, 3);
		$AddrSeek2 = implode('', unpack('L', $AddrSeek2.chr(0)));
		fseek($fd, $AddrSeek2);
	} else {
		fseek($fd, -1, SEEK_CUR);
	}
	while(($char = fread($fd, 1)) != chr(0))
	$ipAddr2 .= $char;
}
fclose($fd);

echo $ipaddr = "$ipAddr1 $ipAddr2";
 

//结果是 ：  
	



