<?php
$items = array(
	array('http://www.abc.com/a/', 100, 120),
	array('http://www.abc.com/b/index.php', 50, 80),
	array('http://www.abc.com/a/index.html', 90, 100),
	array('http://www.abc.com/a/?id=12345', 200, 33),
	array('http://www.abc.com/c/index.html', 10, 20),
	array('http://www.abc.com/abc/', 10, 30)
);

$new_arr = array();
foreach($items as $k=>$val){
    $newkey = substr($val[0],0,strrpos($val[0],"/")+1);
    if(isset($new_arr[$newkey])){
        $new_arr[$newkey][1]+= $val[1];
        $new_arr[$newkey][2]+= $val[2];
    }else{
        $new_arr[$newkey][0] = $newkey;
        $new_arr[$newkey][1] = $val[1];
        $new_arr[$newkey][2] = $val[2];
    }
}
sort($new_arr);

print_r($new_arr);