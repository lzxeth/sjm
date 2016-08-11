<?php
/** 
 * 把一个汉字转为unicode的通用函数，不依赖任何库，和别的自定义函数，但有条件
 * 条件：本文件以及函数的输入参数应该用utf－8编码，不然要加函数转换
 * 
 * @param {string} $word 必须是一个汉字
 * @return {string} 一个十进制unicode码，如4f60，代表汉字 “你”
 */
function getUnicodeFromOneUTF8($word) {
  $bytes = str_split($word);    //获取其字符的内部数组表示，$bytes应类似array(228, 189, 160)
  $bin_str = '';
  //转成数字再转成二进制字符串，最后联合起来。
  foreach ($bytes as $byte){
      $bin_str .= decbin(ord($byte));
  }
  //此时，$bin_str应类似11100100 10111101 10100000,如果是汉字"你"
  $bin_str = preg_replace('/^.{4}(.{4}).{2}(.{6}).{2}(.{6})$/','$1$2$3', $bin_str);   //正则截取
  //此时， $bin_str应类似0100111101100000,如果是汉字"你" 
  return bindec($bin_str); //返回类似20320， 汉字"你"
}
 
 
echo $output = getUnicodeFromOneUTF8('北');
 
 
 