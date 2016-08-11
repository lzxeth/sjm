<?php
 
function checkFileType($fileName){
        $file     = fopen($fileName, "rb");
        $bin      = fread($file, 2); //只读2字节
        fclose($file);
        $strInfo  = unpack("C2chars", $bin);// C为无符号整数，网上搜到的都是c，为有符号整数，这样会产生负数判断不正常
        $typeCode = intval($strInfo['chars1'].$strInfo['chars2']);
        $fileType = '';
        return ($typeCode == 255216 /*jpg*/ || $typeCode == 7173 /*gif*/ || $typeCode == 13780 /*png*/);  
}