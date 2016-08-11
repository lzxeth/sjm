<?php

$handle = fopen("with_t.txt", "rt");

while (($buffer = fgets($handle)) !== false) {
    echo $buffer;
}
 
 