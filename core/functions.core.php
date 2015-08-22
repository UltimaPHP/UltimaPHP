<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */

class Functions
{
	public static function strToHex($string) {
		$hex = '';
		for ($i = 0; $i < strlen($string); $i++) {
			$hex.= substr('0' . dechex(ord($string[$i])) , -2);
		}
		return strToUpper($hex);
	}
	
	public static function hexToChr($data, $from = null, $to = null, $explodeOnChr = false) {
		if (is_array($data)) {
			$hex = self::implodeByte($data, $from, $to);
		} 
		else {
			$hex = $data;
		}
		
		$string = '';
		for ($i = 0; $i < strlen($hex) - 1; $i+= 2) {
			$string.= chr(hexdec($hex[$i] . $hex[$i + 1]));
		}
		
		if ($explodeOnChr) {
			$string = explode(chr(0) , $string);
			$string = $string[0];
		}
		
		return $string;
	}
	
	public static function implodeByte($byteArray = array() , $from, $to) {
		$ret = "";
		for ($i = $from; $i <= $to; $i++) {
			$ret.= $byteArray[$i];
		}
		return $ret;
	}
}
?>