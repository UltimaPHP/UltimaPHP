<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */

class packet_0xEF extends Packets {

    /**
     * Defines the packet, the length and if there is a client send
     */
    public function __construct($client = false) {
        $this->setPacket(0xEF);

        if ($client) {
            $this->client = $client;
        }
    }

    /**
     * Handle the packet receive
     */
    public function receive($data) {
        if (!$this->client) {
            return false;
        }

        $seed      = hexdec(Functions::implodeByte($data, 1, 4));
        $major     = hexdec(Functions::implodeByte($data, 5, 8));
        $minor     = hexdec(Functions::implodeByte($data, 9, 12));
        $revision  = hexdec(Functions::implodeByte($data, 13, 16));
        $prototype = hexdec(Functions::implodeByte($data, 17, 20));

        UltimaPHP::$socketClients[$this->client]['version'] = [
            'encrypted' => null,
            'seed'      => $seed,
            'major'     => $major,
            'minor'     => $minor,
            'revision'  => $revision,
            'prototype' => $prototype,
            'key1'      => EncryptionDefs::VERSION[$major . $minor . $revision][0],
            'key2'      => EncryptionDefs::VERSION[$major . $minor . $revision][1],
        ];

        return true;
    }
}