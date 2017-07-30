<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */

class packet_0x75 extends Packets {

    /**
     * Defines the packet, the length and if there is a client send
     */
    public function __construct($client = false) {
        $this->setPacket(0x75);

        if ($client) {
            $this->client = $client;
        }
    }

    /**
     * Handle the packet receive
     */
    public function receive($data) {
        $command = $data[0];
        $serial  = $data[1] . $data[2] . $data[3] . $data[4];
        $name    = Functions::hexToChr($data, 5, 30, true);
        $instance = Map::getBySerial($serial);
        if (!$instance) {
            return false;
        }
        return $instance->setName($name);
    }
}