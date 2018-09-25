<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */

class packet_0xD6 extends Packets {

    private $objects = [];

    /**
     * Defines the packet, the length and if there is a client send
     */
    public function __construct($client = false) {
        $this->setPacket(0xD6);

        if ($client) {
            $this->client = $client;
        }
    }

    /**
     * Handle the packet sending
     * 
     * D6
     * 00 3D
     * 00 01
     * 00 00 00 01
     * 00 00
     * 00 00 00 01
     * 
     * 00 10 05 BD
     * 00 1E
     * 4F 00 77 00 6E 00 65 00 72 00 20 00 09 00 58 00 61 00 62 00 6C 00 61 00 75 00 09 00 20 00
     * 
     * 00 0F 88 E5
     * 00 00
     * 
     * 00 00 00 00
     *
     */
    public function send() {
        if (!$this->client) {
            return false;
        }
    }

    public function addObject($serial = null) {
        if ($serial === null) {
            return false;
        }

        $this->objects[] = $serial;
    }
}