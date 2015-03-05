<?php
/*
	Anyone is free to copy, modify, publish, use, compile, sell, or
	distribute this software, either in source code form or as a compiled
	binary, for any purpose, commercial or non-commercial, and by any
	means.
*/

/*      
	Includes a library written at simplehtmldom.sourceforge.net for parsing the 
	HTML.Use of a regular expression is also preferred but can sometimes result
	in bad results.
*/
	include('./simplehtmldom_1_5/simple_html_dom.php');

// Create a DOM from URL or file
	$html = file_get_html('http://cs75.tv/2012/summer/');

	$num = 0;
// searches for all links in the parsed $html
	foreach($html->find('a') as $e) {
		$links = $e->href." ";
/*
	Specify any term that was found in the required URL in strpos and like in this case
	the .mp4 extension of the file to be downloaded. Make sure the site doesn't have
	two separate links for viewing and for download, and if it does have, then
	download-link's extension has to be provided like here '.mp4.download' .
 
*/
		if (strpos($links,'.mp4.download') !== false) {
			$num++;
			echo $links;
// created to set indefinte time to download. 	
			set_time_limit(0);
/*	
	specify the directory here as the first argument for fopen or the download will be in your 
	current working directory which probably would be 'curl-links-master' where you extracted .
	
*/
			$fp = fopen ($num.'.mp4', 'w+');
			$ch = curl_init($links);
			curl_setopt($ch, CURLOPT_TIMEOUT, 50);
			curl_setopt($ch, CURLOPT_FILE, $fp);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_exec($ch); 
			curl_close($ch);
			fclose($fp);
		}
	}
	if($num === 0)
		echo 'Specific link was not found!';
?>
