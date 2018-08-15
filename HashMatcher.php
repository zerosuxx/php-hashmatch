<?php

class HashMatcher implements IteratorAggregate {
	private $hash;
	private $algo;

	public function __construct(string $hash, string $algo = 'md5') {
		$this->hash = $hash;
		$this->algo = $algo;
	}

	public function getIterator() {
		$hash = $this->hash;
		$nextHash = null;
		$matchedHash = null;
		yield $hash;
		while($this->hash !== $nextHash) {  
		 $matchedHash = $hash;
			$nextHash = hash($this->algo, $hash);
			$hash = $nextHash;
			yield $nextHash;
		}
		return $matchedHash;
	}
}