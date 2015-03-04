<?php

// example of how to use basic selector to retrieve HTML contents
include('./simplehtmldom_1_5/simple_html_dom.php');
    	$curl = curl_init();
    	curl_setopt($curl, CURLOPT_URL, "http://cs75.tv/2012/summer/");
    	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
	curl_setopt($curl, CURLOPT_AUTOREFERER, TRUE);
	$result = curl_exec ($curl);
	curl_close ($curl);

// get DOM from URL or file
	$html = file_get_html('http://cs75.tv/2012/summer/');

	$num = 0;
// find all link
	foreach($html->find('a') as $e) {
		$links = $e->href." ";
		if (strpos($links,'.mp4.download') !== false) {
			$num++;
			echo $links;
			set_time_limit(0);
			$fp = fopen ('/home/harish/'.$num.'.mp4', 'w+');
		$ch = curl_init($links);
		curl_setopt($ch, CURLOPT_TIMEOUT, 50);
		curl_setopt($ch, CURLOPT_FILE, $fp);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_exec($ch); // get curl response
		curl_close($ch);
		fclose($fp);
	}
}
?>
