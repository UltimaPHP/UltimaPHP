<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */

class packet_0xB1 extends Packets {

    /**
     * Defines the packet, the length and if there is a client send
     */
    public function __construct($client = false) {
        $this->setPacket(0xB1);

        if ($client) {
            $this->client = $client;
        }
    }

    public function receive($data) {
        if (!$this->client) {
            return false;
        }

        print_r($data);

        return true;
    }
}