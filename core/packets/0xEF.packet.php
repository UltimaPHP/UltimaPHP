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
        $this->setLength(21);

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

        $id        = $this->getInt8($data);
        $seed      = hexdec($this->getInt32($data));
        $major     = hexdec($this->getInt32($data));
        $minor     = hexdec($this->getInt32($data));
        $revision  = hexdec($this->getInt32($data));
        $prototype = hexdec($this->getInt32($data));
        
        /* Check if client version is the sabe as the server default */
        if (!Functions::isValidClient($major, $minor, $revision, $prototype)) {
            UltimaPHP::log("Connection attempt blocked from ". UltimaPHP::$socketClients[$this->client]['ip'] . " due wrong client version ($major.$minor.$revision.$prototype)", UltimaPHP::LOG_WARNING);
            socket_close(UltimaPHP::$socketClients[$this->client]['socket']);
            unset(UltimaPHP::$socketClients[$this->client]);
            return false;
        }

        $keys = Encrypt::calculateKeys($major, $minor, $revision, $prototype);
        UltimaPHP::$socketClients[$this->client]['version'] = [
            'encrypted' => null,
            'seed'      => $seed,
            'major'     => $major,
            'minor'     => $minor,
            'revision'  => $revision,
            'prototype' => $prototype,
            'key1'      => $keys[0],
            'key2'      => $keys[1]
        ];

        return true;
    }
}