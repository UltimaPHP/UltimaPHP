<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class Encrypt {

    /**
     * Decrypts the packets received from the client on the first connection
     */
    public static function decryptLoginPacket($data, $version = null) {
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

    public static function gameDecrypt($data, $version = null) {
        if ($version === null || !is_array($version) || $version['major'] <= 0) {
            return $data;
        }

        $seed = $version['seed'];
        $key1 = $version['key1'];
        $key2 = $version['key2'];
    }
}