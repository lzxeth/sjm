<?php

$handle = fopen("with_t.txt", "r");

while (($buffer = fgets($handle)) !== false) {
    echo $buffer;
}
 
 