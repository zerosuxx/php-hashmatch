<?php
//1.0
require_once 'HashMatcher.php';

function writeFile($file, $data, $options = null) {
    file_put_contents($file, $data, $options);
}

function readFileLines($file) {
    if(file_exists($file)) {
        return file($file);
    }
}

$string = isset($argv[1]) ? $argv[1] : 'a';
$c = isset($argv[2]) ? $argv[2] : 4000000;
$file = $string . '.txt';
$startDate = date('Y-m-d H:i:s');
$hash = md5($string);
$i = 0;

$contents = readFileLines($file);
if($contents) {
    $data = explode(' - ', trim($contents[0]));
    if(count($data) === 4) {
        $i = str_replace(' ', '', $data[0]);
        $startDate = $data[1];
        $hash = $data[3];
    }
}

$hm = new HashMatcher($hash, 'md5');
$gen = $hm->getIterator();
foreach($gen as $k => $nextHash) {
	    if($i % $c === 0) {
	        writeFile($file, number_format($i, 0, ',', ' ') . ' - ' . $startDate . ' - ' . date('Y-m-d H:i:s') . ' - ' . $nextHash . PHP_EOL);
	    }
	    $i++;
}
writeFile($file, $startDate . ' - ' . date('Y-m-d H:i:s') . PHP_EOL  . $hash . PHP_EOL . '----> ' . $gen->getReturn() . PHP_EOL . $nextHash);