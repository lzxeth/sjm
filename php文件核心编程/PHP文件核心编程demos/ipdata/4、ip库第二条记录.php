<?php
 
 #php -r "echo hex2bin('B2A9CEC4CAB5B4EFE4A8BAFEB5EAB6FEB5EA'); "


#php -r "echo hex2bin('C7ECC9D0B1B1B5C0C7ECD6DDCAD0'); "

$fd=fopen('qqwry.dat', 'rb');

$DataBegin = fread($fd, 4);  //第一条索引的绝对偏移
#$DataEnd = fread($fd, 4) ;   //最后一条索引的绝对偏移

$ipbegin = implode('', unpack('L', $DataBegin));
#$ipend = implode('', unpack('L', $DataEnd));

fseek($fd, $ipbegin+ 7*1 ); //定位到第二条索引

$ipData1 = fread($fd, 4);  //起始IP地址的4个字节 , 内容为 ” 00 00 00 01  “


$ipnum = implode('', unpack('L', $ipData1)); 
if($ipnum < 0) $ipnum += pow(2, 32);  //4294967296，变为正数
// echo $ipnum."\n" ; //结果就是0
echo long2ip($ipnum);exit;
 
$ipData2 = fread($fd, 3);  //3个字节的偏移地址  
$ipPos = implode('', unpack('L', $ipData2.chr(0) ) );  // “  23 00 00  00 ” 补充上4个字节，才能用 L

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
 

//结果是 ： IANA保留地址   CZ88.NET
	

