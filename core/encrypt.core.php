<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class Encrypt {

    /**
     * Decrypts the packets received from the client on the first connection
     */
    public static function decryptPacket($data, $version = null) {
        if ($version === null || !is_array($version) || $version['major'] <= 0) {
            return $data;
        }

        $seed = $version['seed'];
        $key1 = $version['key1'];
        $key2 = $version['key2'];

        $orgTable1 = ((((~$seed) ^ 0x00001357) << 16) | (($seed ^ 0xFFFFAAAA) & 0x0000FFFF)) & 0xFFFFFFFF;
        $orgTable2 = ((($seed ^ 0x43210000) >> 16) | (((~$seed) ^ 0xABCDFFFF) & 0xFFFF0000)) & 0xFFFFFFFF;

        for ($i = 0; $i < count($data); $i++) {
            $data[$i] = strtoupper(str_pad(dechex(($orgTable1 ^ hexdec($data[$i])) & 0xFF), 2, "0", STR_PAD_LEFT));

            $oldkey0 = $orgTable1;
            $oldkey1 = $orgTable2;

            $orgTable1 = ((($oldkey0 >> 1) | ($oldkey1 << 31)) ^ $key2) & 0xFFFFFFFF;
            $orgTable2 = (((((($oldkey1 >> 1) | ($oldkey0 << 31)) ^ ($key1 - 1)) >> 1) | ($oldkey0 << 31)) ^ $key1) & 0xFFFFFFFF;
        }

        return $data;
    }

    /**
     * Retrive the client key based on the version
     * Converted from: https://github.com/gokaygurcan/poc/blob/develop/index.js#L79-L98
     */
    public static function calculateKeys($major, $minor, $revision, $prototype) {
        $key1 = ($major << 23) | ($minor << 14) | ($revision << 4);
        $key1 ^= ($revision * $revision) << 9;
        $key1 ^= $minor * $minor;
        $key1 ^= ($minor * 11) << 24;
        $key1 ^= ($revision * 7) << 19;
        $key1 ^= 0x2c13a5fd;

        $key2 = ($major << 22) | ($revision << 13) | ($minor << 3);
        $key2 ^= ($revision * $revision * 3) << 10;
        $key2 ^= $minor * $minor;
        $key2 ^= ($minor * 13) << 23;
        $key2 ^= ($revision * 7) << 18;
        $key2 ^= 0xa31d527f;

        return [
            $key1,
            $key2
        ];
    }
}