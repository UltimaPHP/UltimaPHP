<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class Layer {
	public static $id;
	public static $player;
	public static $itenSerial;
	public static $serial;

	public function __construct($type = null, $player = null, $itemSerial = null) {
		if ($type === null || $player === null || $itemSerial === null) {
			return false;
		}
	}
}