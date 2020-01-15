<?php
if ($_SERVER["PHP_AUTH_USER"] == "zaz" && $_SERVER["PHP_AUTH_PW"] == "Ilovemylittleponey") {
	if (($img = file_get_contents('../img/42.png')) !== false) {
		$img = base64_encode($img);
	}
	echo "<html><body>" . "\n" . "Hello Zaz<br />" . "\n";
	echo "<img src='data:image/png;base64,$img'>" . "\n";
	echo "</body></html>" . "\n";
} else {
	header('HTTP/1.0 401 Unauthorized');
	header('Date: Tue, 26 Mar 2013 09:42:42 GMT');
	header('WWW-Authenticate: Basic realm="Member area"');
	header('Content-Length: 72');
	echo "<html><body>That area is accessible for members only</body></html>" . "     \n";
}
?>
