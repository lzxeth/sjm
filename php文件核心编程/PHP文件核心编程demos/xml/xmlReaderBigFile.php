<?php
$items=array();
$reader=new XMLReader();
$reader->open('dede_addonarticle.xml', 'utf-8');
while ($reader->read()){
  //get current data
  if($reader->name=="table" && $reader->nodeType==XMLReader::ELEMENT){
    $item=[];
    while($reader->read() && $reader->name !="table" ){
	  if($reader->nodeType != XMLReader::ELEMENT) continue;
	  
	  $name=$reader->getAttribute('name');
	  $value=$reader->readString();
	  $item[$name]=$value;
    }
     $items[]=$item;
  }
}
$reader->close();

print_r($items);