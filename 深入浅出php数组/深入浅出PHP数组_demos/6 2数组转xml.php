<?php

function array2xml($array)
{
    $xml = '<?xml version="1.0" encoding="UTF-8"?>';
    $xml.="\n<items>\n";
    foreach ($array as $key => $val) {
        $xml.="<$key>$val</$key>\n";
    }
    $xml.="</items>\n";
    return $xml;
}
function array2xml2($array)
{
    $string = <<<XML
<?xml version='1.0' encoding='utf-8'?>
<items>
</items>
XML;
    $xml = simplexml_load_string($string);
    foreach ($array as $key => $row) {
        $node = $xml->addChild($key, $row);
    }
    return $xml->asXML();
}

function xml2array($xml)
{
    $items = (array) (simplexml_load_string($xml));
    return $items;
}

$items = [ 'name' => 'andy', 'age' => 52];
$xml = array2xml2($items);
//echo $xml;

var_dump( xml2array($xml) == $items);


