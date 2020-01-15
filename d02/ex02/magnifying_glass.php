#!/usr/bin/php
<?php
if ($argc == 2 && file_exists($argv[1])) {
    $file = file_get_contents($argv[1]);
    $file = preg_replace_callback('/<\s*a.*?<\s*\/\s*a\s*>/si', function ($matches) {
		$matches[0] = preg_replace_callback('/(<\s*a.*?>)(.*?)(<)/si',
			function ($matches) {
				return $matches[1] . strtoupper($matches[2]) . $matches[3];
			}, $matches[0]);
		$matches[0] = preg_replace_callback('/(<.*?title\s*=\s*")(.*?)(")/si',
			function ($matches) {
				return $matches[1] . strtoupper($matches[2]) . $matches[3];
				}, $matches[0]);
		return $matches[0];
	}, $file);
    print($file);
}
?>
