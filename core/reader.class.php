<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class Reader {
    const FILE_STRING       = 0x00;
    const FILE_TILEDATA     = 0x01;
    const FILE_MAP_FILE     = 0x02;
    const FILE_STATIC_INDEX = 0x03;
    const FILE_STATIC_FILE  = 0x04;

    /* Class variables */
    public $fileType;

    public function __construct($filePath = null, $type = self::FILE_STRING) {
        $this->fileType   = $type;
        $this->fileHolder = fopen($filePath, "rb");
        return $this;
    }

    public function read($length = 0) {
        return fread($this->fileHolder, $length);
    }

    public function setPosition($offset = 0) {
        fseek($this->fileHolder, $offset);
    }

    public function readUInt8() {
        return self::uInt8(fread($this->fileHolder, 1));
    }

    public function readInt8() {
        return self::int8(fread($this->fileHolder, 1));
    }

    public function readUInt16() {
        return self::uInt16(fread($this->fileHolder, 2));
    }

    public function readInt16() {
        return self::int16(fread($this->fileHolder, 2));
    }

    public function readUInt32() {
        return self::uInt32(fread($this->fileHolder, 4));
    }

    public function readInt32() {
        return self::int32(fread($this->fileHolder, 4));
    }

    public function readUInt64() {
        return self::uInt64(fread($this->fileHolder, 8));
    }

    public function readInt64() {
        return self::int64(fread($this->fileHolder, 8));
    }

    public static function int8($i) {
        return is_int($i) ? pack("c", $i) : unpack("c", $i)[1];
    }

    public static function uInt8($i) {
        return is_int($i) ? pack("C", $i) : unpack("C", $i)[1];
    }

    public static function int16($i) {
        return is_int($i) ? pack("s", $i) : unpack("s", $i)[1];
    }

    public static function uInt16($i, $endianness = false) {
        $f = is_int($i) ? "pack" : "unpack";

        if ($endianness === true) {
            // big-endian
            $i = $f("n", $i);
        } else if ($endianness === false) {
            // little-endian
            $i = $f("v", $i);
        } else if ($endianness === null) {
            // machine byte order
            $i = $f("S", $i);
        }

        return is_array($i) ? $i[1] : $i;
    }

    public static function int32($i) {
        return is_int($i) ? pack("l", $i) : unpack("l", $i)[1];
    }

    public static function uInt32($i, $endianness = false) {
        $f = is_int($i) ? "pack" : "unpack";

        if ($endianness === true) {
            // big-endian
            $i = $f("N", $i);
        } else if ($endianness === false) {
            // little-endian
            $i = $f("V", $i);
        } else if ($endianness === null) {
            // machine byte order
            $i = $f("L", $i);
        }

        return is_array($i) ? $i[1] : $i;
    }

    public static function int64($i) {
        return is_int($i) ? pack("q", $i) : unpack("q", $i)[1];
    }

    public static function uInt64($i, $endianness = false) {
        $f = is_int($i) ? "pack" : "unpack";

        if ($endianness === true) {
            // big-endian
            $i = $f("J", $i);
        } else if ($endianness === false) {
            // little-endian
            $i = $f("P", $i);
        } else if ($endianness === null) {
            // machine byte order
            $i = $f("Q", $i);
        }

        return is_array($i) ? $i[1] : $i;
    }
}