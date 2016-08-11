<?php

$string = <<<XML
<?xml version='1.0'?>
<document>
  <cmd>login</cmd>
  <login>imdonkey</login>
</document>
XML;

$xml = simplexml_load_string($string);
print_r($xml);