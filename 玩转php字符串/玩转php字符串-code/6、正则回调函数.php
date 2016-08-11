<?php 
// 将文本中的年份增加一年.
$text = "下一个愚人节是： 04/01/2014\n";
$text.= "圣诞节是：  12/24/2013\n";
// 回调函数
 
echo preg_replace_callback("|(\d{2}/\d{2})/(\d{4})|",
            function($matches){
            	 	return ($matches[2]+1).'/'.$matches[1] ;
            },
$text);