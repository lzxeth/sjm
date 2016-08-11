<?php
 
 
$ipstr='255.255.255.244';



$ip = explode('.', $ipstr);
$ipnum = $ip[0] * 16777216 + $ip[1] * 65536 + $ip[2] * 256 + $ip[3];
// $ip1*pow(256,3)+$ip2*pow(256,2)+$ip3*256+$ip4;
echo $ipnum."\n";

echo sprintf( "%u",ip2long($ipstr) ) ."\n";

echo long2ip($ipnum) ."\n";

//这个方式等同于如下代码

$ipnum = ip2long($ipstr);
if($ipnum < 0) $ipnum += pow(2, 32);
echo $ipnum."\n";



//4294967295
 
