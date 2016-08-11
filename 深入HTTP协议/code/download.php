<?php
error_reporting(0);
if($_GET['id'] == 1){
	$filename = "mysql_innodb.pdf";
}else{
	header("HTTP/1.0 404 Not Found");
	exit;
}
downloadfile($filename);



function downloadfile($filepath,$filename=''){
	if(!file_exists($filepath)){
		return 1;
	}
	if(''==$filename){
		$tem=explode('/',$filepath);
		$num=count($tem)-1;
		$filename=$tem[$num];
		$filetype=substr($filepath,strrpos($filepath,".")+1);
	}else{
		$filetype=substr($filename,strrpos($filename,".")+1);
	}
	$filesize = filesize($filepath);
	$dateline=time();
	header('date: '.gmdate('d, d m y h:i:s', $dateline).' gmt');
	header('last-modified: '.gmdate('d, d m y h:i:s', $dateline).' gmt');
	header('content-encoding: none');
	header('content-disposition: attachment; filename='.$filename);
	header('content-type: '.$filetype);
	header('content-length: '.$filesize);
	header('accept-ranges: bytes');
	if(!@empty($_SERVER['HTTP_RANGE'])) {
		list($range) = explode('-',(str_replace('bytes=', '', $_SERVER['HTTP_RANGE'])));
		$rangesize = ($filesize - $range) > 0 ?  ($filesize - $range) : 0;
		header('content-length: '.$rangesize);
		header('http/1.1 206 partial content');
		header('content-range: bytes='.$range.'-'.($filesize-1).'/'.($filesize));
	}
	if($fp = @fopen($filepath, 'rb')) {
		@fseek($fp, $range);
		echo fread($fp, filesize($filepath));
	}
	fclose($fp);
	flush();
	ob_flush();
}



?>