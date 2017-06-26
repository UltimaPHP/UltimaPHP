<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class Packets {
    /* Default packet variables */
    public $client;
    public $length;
    public $packet;
    public $packetBytes = [];

    /* Defines what is the packet server is building/receiving */
    public function setPacket($packet_id = false) {
        if (!$packet_id) {
            return false;
        }

        $this->packet = $packet_id;
        $this->setLength(PacketsDefs::LENGTH[$packet_id]);
    }

    /**
     * Get the packet ID
     */
    public function getPacket() {
        return $this->packet;
    }
    /**
     * Set the packet length
     * -1 = dynamic packet length
     */
    public function setLength($packet_length = -1) {
        $this->length = $packet_length;
    }

    /**
     * Returns the defined packet length
     */
    public function getLength() {
        return $this->length;
    }

    public function getPacketStr() {
        $packet = str_pad(dechex($this->packet), 2, "0", STR_PAD_LEFT);

        if ($this->length === false) {
            $packet .= str_pad(dechex(count($this->packetBytes) + 3), 4, "0", STR_PAD_LEFT);
        }

        $packet .= implode("", $this->packetBytes);

        return $packet;
    }

    public function addText($text = "", $maxByteSyze = false, $fill_zeros = true, $pad_direction = STR_PAD_RIGHT) {
        $hexStr = str_split(str_pad(Functions::strToHex($text), ($maxByteSyze ? ($maxByteSyze*2) : $maxByteSyze), "0", $pad_direction), 2);

        foreach ($hexStr as $hex) {
            $this->packetBytes[] = $hex;
        }
    }

    public function addUInt8($value = 0) {
        $this->packetBytes[] = $this->uInt8($value);
    }

    public function addInt8($value = 0) {
        $this->packetBytes[] = $this->int8($value);
    }

    public function addUInt16($value = 0) {
        $hexStr = str_split(strtoupper(str_pad(dechex($this->uInt16($value)), 4, "0", STR_PAD_LEFT)),2);
        
        foreach ($hexStr as $hex) {
            $this->packetBytes[] = $hex;
        }
    }

    public function addInt16($value = 0) {
        $hexStr = str_split(strtoupper(str_pad(dechex($this->int16($value)), 4, "0", STR_PAD_LEFT)),2);
        
        foreach ($hexStr as $hex) {
            $this->packetBytes[] = $hex;
        }
    }

    public function addUInt32($value = 0) {
        $this->packetBytes[] = $this->uInt32($value);
    }

    public function addInt32($value = 0) {
        $this->packetBytes[] = $this->int32($value);
    }

    public function addUInt64($value = 0) {
        $this->packetBytes[] = $this->uInt64($value);
    }

    public function addInt64($value = 0) {
        $this->packetBytes[] = $this->int64(fread($this->fileHolder, 8));
    }

    public static function int8($i) {
        return is_int($i) ? strtoupper(str_pad(dechex($i), 2, "0", STR_PAD_LEFT)) : unpack("c", $i)[1];
    }

    public static function uInt8($i) {
        return is_int($i) ? strtoupper(str_pad(dechex($i), 2, "0", STR_PAD_LEFT)) : unpack("C", $i)[1];
    }

    public static function int16($i) {
        return is_int($i) ? strtoupper(str_pad(dechex($i), 2, "0", STR_PAD_LEFT)) : unpack("s", $i)[1];
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