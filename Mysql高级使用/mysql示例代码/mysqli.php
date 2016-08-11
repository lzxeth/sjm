<?php

$auth = "public' or 1";
$mysqli = new mysqli("localhost", "root", "", "nagios"); 
$sql = "select * from ipinfo where auth=?";
$stmt = $mysqli->prepare($sql);  
$stmt->bind_param('s',$auth);
$stmt->execute();  
$stmt->bind_result($id,$ip, $auth, $status);  

while ($stmt->fetch()) {  
    echo $ip.$auth.$status."\r\n";
}  

$stmt->close();  
$mysqli->close();  



exit;











/*$mysqli = new mysqli("localhost", "root", "", "nagios"); 
$sql = "update ipinfo set status=100 where id=1;update ipinfo set status=200 where id=2";
$mysqli->multi_query($sql);  
$mysqli->close(); */

