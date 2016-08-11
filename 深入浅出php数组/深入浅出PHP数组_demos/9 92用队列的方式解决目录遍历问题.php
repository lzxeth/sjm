<?php

function  getfiles($path='.'){
	$queue=array($path);

	while (!empty($queue)) {
		$currentPath=array_shift($queue);
		$currentDir = dir($currentPath);
		while (false !== ($filePath = $currentDir->read())) {
		   if( '.' == $filePath || '..' == $filePath ){
		   		continue;
		   }
		   if(is_dir($currentPath.'/'.$filePath)){
		   	   array_push($queue, $currentPath.'/'.$filePath);
		   }
		   echo $currentPath.'/'.$filePath."\n";
		}
		$currentDir->close();
	}

}

getfiles('d:/software');