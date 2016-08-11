<?php
/*去掉utf8签名 */
 
/* 方法一：读取文件前三个字符，然后判断处理  */
function removebom($filename){
	$contents=file_get_contents($filename);
	$charset[1] = substr($contents, 0, 1);
	$charset[2] = substr($contents, 1, 1);
	$charset[3] = substr($contents, 2, 1);
	if (ord($charset[1]) == 239 && ord($charset[2]) == 187 &&ord($charset[3]) == 191) {
		$rest = substr($contents, 3);
		file_put_contents ($filename, $rest);
	}
}

/* 方法二：采用正则的16进制查找替换 */
 
$contents=file_get_contents('u.txt');
$contents=preg_replace('/\xef\xbb\xbf/','',$contents);
file_put_contents('u.txt', $contents);
 

/* 方法三：读取文件后，直接文件指针定位，忽略前三个字节 */
$fp=fopen('u.txt','rw');
fseek($fp,3);
$contents='';
while (($buffer = fgets($fp, 4096)) !== false) {
    $contents.=$buffer;
}
file_put_contents('u.txt',$contents);


/* 方法三：打包特殊的标记，然后用字符串替换掉 */
function remove_utf8_bom($text){
    $bom = pack('H*','EFBBBF');
    $text = preg_replace("/^$bom/", '', $text);
    return $text;
}

