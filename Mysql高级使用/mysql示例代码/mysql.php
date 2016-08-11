<?php

$id="1";

$mysqllink = mysql_connect("localhost","root","");
mysql_select_db("nagios");
$sql = "select ip from ipinfo where id=$id";
var_dump($sql);exit;
$query = mysql_query($sql);
while($ipinfo = mysql_fetch_array($query,MYSQL_ASSOC)){
	$list[] = $ipinfo;
}
mysql_close($mysqllink);
var_dump($list);











/*$user = "admin";
$password = "123' or 1 or password = 'abc";
$query = sprintf("SELECT * FROM users WHERE user='%s' AND password='%s'",
mysql_real_escape_string($user),
mysql_real_escape_string($password));
var_dump($query);*/

