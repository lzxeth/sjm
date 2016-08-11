<?php

$file = "collection.xml";
$depth = array();

function startElement($parser, $name, $attrs) 
{
    global $depth;
     /*
    for ($i = 0; $i < $depth[$parser]; $i++) {
        echo "  ";
    }*/
    //echo "$name\n";
    print_r($attrs);
    //$depth[$parser]++;
}

function endElement($parser, $name) 
{
    global $depth;
    //$depth[$parser]--;
}

function data($parser, $data) {
	var_dump($data);
}
    
$xml_parser = xml_parser_create('UTF-8');
xml_parser_set_option ( $xml_parser , XML_OPTION_SKIP_WHITE  , 1 ) ;
xml_parser_set_option ( $xml_parser , XML_OPTION_CASE_FOLDING  , 0 ) ;

xml_set_element_handler($xml_parser, "startElement", "endElement");
xml_set_character_data_handler($xml_parser, "data");

$fp = fopen($file, "r");
 

while ($data = fread($fp, 4096)) {
    if (!xml_parse($xml_parser, $data, feof($fp))) {
        die(sprintf("XML error: %s at line %d",
                    xml_error_string(xml_get_error_code($xml_parser)),
                    xml_get_current_line_number($xml_parser)));
    }
}
xml_parser_free($xml_parser);