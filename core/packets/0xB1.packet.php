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

        $command  = $data[0];
        $packetSize = hexdec(Functions::implodeByte($data, 1, 2));
        $serial = hexdec(Functions::implodeByte($data, 3, 6));
        $gumpID = hexdec(Functions::implodeByte($data, 7, 10));
        $buttonID = hexdec(Functions::implodeByte($data, 11, 14));
        $switchesCount = hexdec(Functions::implodeByte($data, 15, 18));

        $dialogQueVeioNoPacote = Map::$gumpsIds[$gumpId];

        print_r($dialogQueVeioNoPacote);

        return true;
    }
}