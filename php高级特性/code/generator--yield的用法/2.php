<?php
/**
 * 产生 key=>value
 */

function lineGenerator($file) {
	$fp = fopen($file, 'rb');
	try {
		while($line = fgets($fp)) {
			$lineParts = explode(' ', $line, 2);
			yield $lineParts[0] => $lineParts[1];
		}

	} finally {
		fclose($fp);
	}
}

foreach(lineGenerator("./a.log") as $ip=>$line) {
	
	echo $ip .' => '. $line;
}


