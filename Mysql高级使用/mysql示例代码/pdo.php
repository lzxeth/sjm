<?php

$dsn = "mysql:host=localhost;dbname=nagios";  
$dbh = new PDO($dsn, "root", "");  

$sql = "select ip,auth,status from ipinfo where auth=?";
$sth = $dbh->prepare($sql);  
$sth->execute(array("public"));  
while($result = $sth->fetch(PDO::FETCH_OBJ)){
	$list[] = $result;
}
var_dump($list);



   

