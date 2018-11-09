<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */

class packet_0x6C extends Packets {

    /**
     * Defines the packet, the length and if there is a client send
     */
    public function __construct($client = false) {
        $this->setPacket(0x6C);
        $this->setLength(19);

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
        
        $targetData = [
            'id'      => $this->getInt8($data),
            'target'  => hexdec($this->getInt8($data)),
            'cursor'  => hexdec($this->getInt32($data)),
            'type'    => hexdec($this->getInt8($data)),
            'serial'  => hexdec($this->getInt32($data)),
            'x'       => hexdec($this->getInt16($data)),
            'y'       => hexdec($this->getInt16($data)),
            'z'       => hexdec($this->getInt16($data)),
            'graphic' => hexdec($this->getInt16($data)),
        ];

        print_r($targetData);

        UltimaPHP::$socketClients[$this->client]['account']->player->targetAction($this->client, $targetData);
        
    }
}