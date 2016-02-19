<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class Map
{

	/**
	 * Map loading variables
	 */
	private $chunks = [];
	private $mapSize_x = 7168;
	private $mapSize_y = 4096;
	private $chunkSize = 256; // Number in square

	public function __construct() {
		$chunks_x = ceil($this->mapSize_x / $this->chunkSize);
		$chunks_y = ceil($this->mapSize_y / $this->chunkSize);

		// Build the array that will store map chunks
		for ($x=0; $x < $chunks_x; $x++) {
			$this->chunks[$x] = array();
			for ($y=0; $y < $chunks_y; $y++) {
				$this->chunks[$x][$y] = array();
			}
		}
	}

	/**
	 * Return the chunk number of desired map position
	 */
	public function getChunk($pos_x = null, $pos_y = null) {
		if ($pos_x === null || $pos_y === null || $pos_x <= 0 || $pos_y <= 0 || $pos_x > $this->mapSize_x || $pos_y > $this->mapSize_y) {
			return false;
		}

		return array(
			'x' => (int) ceil($pos_x / $this->chunkSize),
			'y' => (int) ceil($pos_y / $this->chunkSize)
		);
	}

	/**
	 * Function to add information to chunk
	 */
	public function updateMap($pos_x, $pos_y, $pos_z, $data) {}
}