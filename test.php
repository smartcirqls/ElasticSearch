<?php
header('Content-Type:text/plain');
ini_set('display_errors', '1');
//phpinfo();
//print 'Hi'; die;
$hosts = ['127.0.0.1:9200'];
require 'vendor/autoload.php';	

$client = Elasticsearch\ClientBuilder::create()           // Instantiate a new ClientBuilder
			->setHosts($hosts)      // Set the hosts
			->build(); 

$file_handle = fopen("/home/aniket/Desktop/responses-01022018.log", "r");


while (!feof($file_handle)) {
	$line = fgets($file_handle);

	$params['body'][] = [
			'index' => [
				'_index' => 'smartcode1',
				'_type' => 'source1',
			]
		];
		$params['body'][] = json_decode($line, true);
		//$responses = $client->bulk($params);
				
	}

$responses = $client->bulk($params);
fclose($file_handle)

?>
