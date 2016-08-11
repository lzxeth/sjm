<?php
#http://zengrong.net/post/1715.htm
//为了移植性考虑，建议使用rb来读取文件
$fh = fopen("top.png", "rb");
//仅读取前面的8个字节
$head = fread($fh, 8);
//echo $head."\n";
$pnginfo = unpack("Chead/C3string/C4number", $head);
print_r($pnginfo);
$type='';
for($i=1;$i<=3;$i++){
    $type.=chr($pnginfo['string'.$i]);
}
echo $type;

fclose($fh);