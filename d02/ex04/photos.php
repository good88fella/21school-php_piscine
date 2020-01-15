#!/usr/bin/php
<?php
$c = curl_init($argv[1]);
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
$page = curl_exec($c);
curl_close($c);
if ($page !== false) {
	preg_match_all('/<img.*src\s*=\s*"(.*?)"/si', $page, $matches, PREG_SET_ORDER);
	$dir = parse_url($argv[1], PHP_URL_HOST);
	if (!file_exists($dir) && mkdir($dir)) {
		foreach ($matches as $url) {
			if ($url[1][0] == "/")
				$url[1] = $argv[1] . $url[1];
			$image = file_get_contents($url[1]);
			if ($image !== false) {
				$fileName = strrchr($url[1], "/");
				file_put_contents($dir . $fileName, $image);
			}
		}
	}
}
?>
