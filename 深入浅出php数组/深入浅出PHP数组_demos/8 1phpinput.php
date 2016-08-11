<?php
//file1
$raw_post_data = file_get_contents('php://input', 'r');
echo "-------\$_POST------------------\n";
echo var_dump($_POST) . "\n";
echo "-------php://input-------------\n";
echo $raw_post_data;
parse_str($raw_post_data,$p);
echo var_dump($p) . "\n"; 


//file2
$http_entity_body = 'n=' . urldecode('1234567890') . '&p=' . urldecode('╡Бйтр╩об');
$http_entity_type = 'application/x-www-form-urlencoded';
$http_entity_length = strlen($http_entity_body);
$host = 'local.cn';
$port = 80;
$path = '/test/array_demo/-demo.php';
$fp = fsockopen($host, $port, $error_no, $error_desc, 30);
if ($fp) {
    fputs($fp, "POST {$path} HTTP/1.1\r\n");
    fputs($fp, "Host: {$host}\r\n");
    fputs($fp, "Content-Type: {$http_entity_type}\r\n");
    fputs($fp, "Content-Length: {$http_entity_length}\r\n");
    fputs($fp, "Connection: close\r\n\r\n");
    fputs($fp, $http_entity_body . "\r\n\r\n");
    $d = '';
    while (!feof($fp)) {
        $d .= fgets($fp, 4096);
    }
    fclose($fp);
    echo $d;
} 