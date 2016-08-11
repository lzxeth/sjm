<?php
$items=array();
$reader=new XMLReader();
$reader->open('collection.xml', 'utf-8');
while ($reader->read()){
  //get current data
  if($reader->name=="cd" && $reader->nodeType==XMLReader::ELEMENT){
    $item=[];
    while($reader->read() && $reader->name !="cd" ){
    	if($reader->nodeType!=XMLReader::ELEMENT)continue;
		$name=$reader->name;
		$value=$reader->readString();
		// echo $key=$reader->getAttribute('name');
		$item[$name]=$value;
    }
     $items[]=$item;
  }
}
$reader->close();

print_r($items);