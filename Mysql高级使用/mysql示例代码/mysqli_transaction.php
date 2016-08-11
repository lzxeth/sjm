<?php
$mysqli=new mysqli('localhost','root','','nagios');
$mysqli->autocommit(false);//开始事务
$query="update ipinfo set status=123  where id=1";
$mysqli->query($query);


$id=1;
$sql = "select * from ipinfo where id=?";
$stmt = $mysqli->prepare($sql);  
$stmt->bind_param('d',$id);
$stmt->execute();  
$stmt->bind_result($id,$ip, $auth, $status);  
while ($stmt->fetch()) {  
    echo $ip.$auth.$status."\r\n";
} 

$mysqli->rollback();//回滚
//$mysqli->commit();      //提交事务
$mysqli->autocommit(true);//不使用事务