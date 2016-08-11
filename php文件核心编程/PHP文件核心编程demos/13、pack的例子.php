<?php
	
 
	$items=unpack('C4','ABCD');
	
	print_r($items);
	exit;
	
	$data=file_get_contents('./my.db');
	$items=unpack('A20name/Sage/a20email',$data);
	
	print_r($items);
	exit;

 /*
	
  	 $name = pack('A10', '张三丰');  
	 $email = pack('a20', 'zhangsf@qq.com'); //a -- 将字符串以 NULL 字符填满
 	  fwrite($fh, $name);
 	  fwrite($fh, $email);
 	 exit;
 
 
	 $name = pack('A20', '张三丰'); //将字符串以 空格填满
        $age = pack('S', 23);
        $email = pack('a20', 'zhangsf@qq.com'); //a -- 将字符串以 NULL 字符填满
        fwrite($fh, $name . $age . $email);
        exit; 

	


	 $data = pack('A20Sa20', '张三丰', '2313427189' ,'zhangsf@qq.com');  
        fwrite($fh, $data);
     */  
     


//$items=unpack('A20name/Sage/a20email',$data);
print_r($items);
exit;
        
  	$hex=bin2hex('张三丰');
	echo $out = pack("H*", $hex); 
	
	
	$items=unpack('C4', 'ABCD');
	
	
	
	print_r($items);
	
//echo pack('HH',0x504b, 0x0304);
//echo pack('H*', 0x504b );

echo pack('H4', '504b' );

