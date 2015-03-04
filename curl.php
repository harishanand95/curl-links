<?php
require './src/Curl/Curl.php';
// example of how to use basic selector to retrieve HTML contents
include('./simplehtmldom_1_5/simple_html_dom.php');
    $curl = curl_init();
    curl_setopt ($curl, CURLOPT_URL, "http://cdn.cs75.net/2012/summer/");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($curl, CURLOPT_AUTOREFERER, TRUE);
    $result = curl_exec ($curl);
    curl_close ($curl);
	print_r($result);
$fp = fopen('test.html', 'w');
fwrite($fp, $result);
fclose($fp);
// get DOM from URL or file
	$html = file_get_html('test.html');

// find all link
foreach($html->find('a') as $e) 
    echo $e->href . '<br>';

#use \Curl\Curl;
#$curl = new Curl();
#$curl->setOpt(CURLOPT_ENCODING , 'gzip');
#$curl->download('https://www.example.com/image.png', '/tmp/myimage.png');
?>
