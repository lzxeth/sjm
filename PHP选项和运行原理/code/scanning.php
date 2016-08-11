<?php
 
$code =<<<'PHP_CODE'
<?php
//这是注释
echo "Hello, world\n";
$data = 1 + 1;
echo $data;
PHP_CODE;
 
  
print_r(token_get_all($code));