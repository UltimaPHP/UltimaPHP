<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class Functions {

    public static function getClientVersion($client = null) {
        if ($client === null) {
            return false;
        }

        if (!isset(UltimaPHP::$socketClients[$client]['version']) || !is_array(UltimaPHP::$socketClients[$client]['version'])) {
            return false;
        }

        return UltimaPHP::$socketClients[$client]['version'];
    }

    public static function RandomList($list) {
        if ($list === null) {
            return false;
        }
        $newList = array_rand($list, 1);

        return $newList[0];
    }

    public static function strToHex($string, $addEmptyByte = false) {
        $hex = '';
        for ($i = 0; $i < strlen($string); $i++) {
            $hex .= ($addEmptyByte ? "00" : "") . substr('0' . dechex(ord($string[$i])), -2);
        }
        return strToUpper($hex);
    }

    public static function hexToChr($data, $from = null, $to = null, $explodeOnChr = false) {
        if (is_array($data)) {
            $hex = self::implodeByte($data, $from, $to);
        } else {
            $hex = $data;
        }

        $string = '';
        for ($i = 0; $i < strlen($hex) - 1; $i += 2) {
            $string .= chr(hexdec($hex[$i] . $hex[$i + 1]));
        }

        if ($explodeOnChr) {
            $string = explode(chr(0), $string);
            $string = $string[0];
        }

        return $string;
    }

    public static function implodeByte($byteArray = array(), $from, $to) {
        $ret = "";
        $err = false;
        for ($i = $from; $i <= $to; $i++) {
            if (!isset($byteArray[$i])) {
                $err = true;
            }
            $ret .= $byteArray[$i];
        }

        if ($err) {
            echo "Erro dealing with this byte array:\n";
            print_r($byteArray);
        }
        return $ret;
    }

    public static function readUnicodeStringSafe($data = array()) {
        $text = "";

        foreach ($data as $key => $value) {
            if (hexdec($value) >= 0x20 && hexdec($value) < 0xFFFE) {
                $text .= chr(hexdec($value));
            }
        }

        return $text;
    }

    public static function isChar($serial) {

		if(get_parent_class(Map::getBySerial($serial)) === "Mobile"){
			return false;			
		}
		
        if (($serial & (UltimaPHP::BITMASK_ITEM | UltimaPHP::BITMASK_RESOURCE)) == 0) {
            return self::isValidSerial($serial);
        }
        return false;
    }

    public static function isValidSerial($serial) {
        return ($serial && ($serial & UltimaPHP::BITMASK_INDEX_MASK) != UltimaPHP::BITMASK_INDEX_MASK);
    }

    public static function read_byte($file, $length) {
        if (($val = fread($file, $length)) == FALSE) {
            return -1;
        }

        switch ($length) {
        case 4:$val = unpack('l', $val);
            break;
        case 2:$val = unpack('s', $val);
            break;
        case 1:$val = unpack('c', $val);
            break;
        default:$val = unpack('l*', $val);
            return $val;
        }
        return ($val[1]);
    }

    public static function fromChar8($hex = null) {
        $num = hexdec($hex);
        if ($num > 0xFF) {return false;}
        if ($num >= 0x80) {
            return -(($num ^ 0xFF) + 1);
        } else {
            return $num;
        }
    }

    public static function toChar8($int = 0) {
        if ($int < -127 || $int > 127) {
            return "00";
        }

        return strtoupper(str_pad(dechex(ord(pack("c", $int))), 2, "0", STR_PAD_LEFT));
    }

    public static function rglob($pattern, $flags = 0) {
        $files = glob($pattern, $flags);
        foreach (glob(dirname($pattern) . '/*', GLOB_ONLYDIR | GLOB_NOSORT) as $dir) {
            $files = array_merge($files, self::rglob($dir . '/' . basename($pattern), $flags));
        }
        return $files;
    }

    public static function inRangeView($position, $updateRange) {
        return ($position['x'] >= $updateRange['from']['x'] && $position['x'] <= $updateRange['to']['x'] && $position['y'] >= $updateRange['from']['y'] && $position['y'] <= $updateRange['to']['y'] ? true : false);
    }

    public static  function progressBar($done, $total, $msg = null) {
        $perc = floor(($done / $total) * 100);
        echo date("H:i:s") . ": {$msg}: {$perc}%\r";
        if ($perc >= 100) {
            echo "\n";
        }
    }

}