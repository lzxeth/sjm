<?php
	
//递归函数实现遍历指定文件下的目录与文件数量  
function total( $dirname, &$dirnum, &$filenum ){  
    $dir=opendir($dirname);  
    while($filename=readdir($dir)){  
        //要判断的是$dirname下的路径是否是目录  
        $newfile=$dirname."/".$filename;   
        if(is_dir($newfile)){  
            //通过递归函数再遍历其子目录下的目录或文件  
            total($newfile,$dirnum,$filenum);  
            $dirnum++;  
        }else{  
            $filenum++;  
        }  
    }  
    closedir($dir);  
}  
    
$dirnum=0;  
$filenum=0;  
total('d:/software',$dirnum,$filenum);  
echo "目录总数：".$dirnum."\n";  
echo "文件总数：".$filenum."\n";   //遍历指定文件目录与文件数量结束  
