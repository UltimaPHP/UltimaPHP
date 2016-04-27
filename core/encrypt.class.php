<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class Encrypt {

    /**
     * Client encryption keys list, used to decrypt packets received from encrypted clients
     */
    static $clients = array(
        // 7.0.20
        '7020' => array(
            '02BF084BD',
            '0A0FD127F'
        )
    );

    /**
     * Keys used to decode the first connection packets, using Orign method
     */
    static $currentKey0;
    static $currentKey1;

    /**
     * Defines the first login keys based on the received client seed
     */
    public function defineFistLoginKeys($encryptionSeed) {
        self::$currentKey0 = ((((~$encryptionSeed) ^ 0x00001357) << 16) | (($encryptionSeed ^ 0xFFFFAAAA) & 0x0000FFFF));
        self::$currentKey1 = ((($encryptionSeed ^ 0x43210000) >> 16) | (((~$encryptionSeed) ^ 0xABCDFFFF) & 0xFFFF0000));
    }

    /**
     * Decrypts the packets received from the client on the first connection
     */
    public function firstDecrypt($client, $data) {
        $firstClientKey = self::$clients[(int) UltimaPHP::$conf['server']['client']['major'] . (int) UltimaPHP::$conf['server']['client']['minor'] . (int) UltimaPHP::$conf['server']['client']['revision']][0];
        $secondClientKey = self::$clients[(int) UltimaPHP::$conf['server']['client']['major'] . (int) UltimaPHP::$conf['server']['client']['minor'] . (int) UltimaPHP::$conf['server']['client']['revision']][1];

        $len = strlen($data);
        for ($i = 0; $i < $len; $i++) {
            $data[$i] = (self::$currentKey0 ^ $data[$i]);
            $oldkey0 = self::$currentKey0;
            $oldkey1 = self::$currentKey1;
            self::$currentKey0 = ((($oldkey0 >> 1) | ($oldkey1 << 31)) ^ $secondClientKey);
            self::$currentKey1 = (((((($oldkey1 >> 1) | ($oldkey0 << 31)) ^ ($firstClientKey - 1)) >> 1) | ($oldkey0 << 31)) ^ $firstClientKey);
        }
        return $data;
    }

}

?>