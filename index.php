<?php

require_once 'HashMatcher.php';

function writeFile($file, $data, $options = null) {
    file_put_contents($file, $data, $options);
}

$string = isset($argv[1]) ? $argv[1] : 'a';
$hash = md5($string);
$hm = new HashMatcher($hash, 'md5');
$startDate = date('Y-m-d H:i:s');

$c = 4000000;
$gen = $hm->getIterator();
//writeFile($string . '.txt', '');
foreach($gen as $k => $nextHash) {
	    if($k % $c === 0) {
	        writeFile($string . '.txt', number_format($k, 0, ',', ' ') . ' - ' . $startDate . ' - ' . date('Y-m-d H:i:s') . ' - ' . $nextHash . PHP_EOL);
	    }
}
writeFile($string . '.txt', $startDate . ' - ' . date('Y-m-d H:i:s') . PHP_EOL  . $hash . PHP_EOL . '----> ' . $gen->getReturn() . PHP_EOL . $nextHash);
