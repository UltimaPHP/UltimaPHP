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

        $seed      = (int) hexdec(Functions::implodeByte($data, 1, 4));
        $major     = (int) hexdec(Functions::implodeByte($data, 5, 8));
        $minor     = (int) hexdec(Functions::implodeByte($data, 9, 12));
        $revision  = (int) hexdec(Functions::implodeByte($data, 13, 16));
        $prototype = (int) hexdec(Functions::implodeByte($data, 17, 20));
        
        /* Check if client version is the sabe as the server default */
        if (!Functions::isValidClient($major, $minor, $revision, $prototype)) {
            UltimaPHP::log("Connection attempt blocked from ". UltimaPHP::$socketClients[$this->client]['ip'] . " due wrong client version ($major.$minor.$revision.$prototype)", UltimaPHP::LOG_WARNING);
            socket_close(UltimaPHP::$socketClients[$this->client]['socket']);
            unset(UltimaPHP::$socketClients[$this->client]);
            return false;
        }

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