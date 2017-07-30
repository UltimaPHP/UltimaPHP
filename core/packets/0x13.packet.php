<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */

class packet_0x13 extends Packets {

    /**
     * Defines the packet, the length and if there is a client send
     */
    public function __construct($client = false) {
        $this->setPacket(0x13);

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

        $command   = $data[0];
        $serial    = $data[1] . $data[2] . $data[3] . $data[4];
        $layer     = $data[5];
        $container = $data[6] . $data[7] . $data[8] . $data[9];
        UltimaPHP::$socketClients[$this->client]['account']->player->equipRequest($serial, $layer, $container);
    }
}