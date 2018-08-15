<?php

require_once 'HashMatcher.php';

$string = isset($argv[1]) ? $argv[1] : 'a';
$hash = md5($string);
$hm = new HashMatcher($hash, 'md5');

$c = 4000000;
$i = 0;
foreach($hm as $k => $hash) {
	if($i % $c === 0) echo number_format($k, 2, ',', ' ') . ' - ' . $hash . PHP_EOL;
	$i++;
}

