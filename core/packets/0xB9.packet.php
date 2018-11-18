<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */

class packet_0xB9 extends Packets {

    private $flags;

    /**
     * Defines the packet, the length and if there is a client send
     */
    public function __construct($client = false) {
        $this->setPacket(0xB9);
        $this->setLength(5);

        if ($client) {
            $this->client = $client;
        }
        
    }

    /**
     * Handle the packet sending
     */
    public function send() {
        if (!$this->client) {
            return false;
        }

        $this->addInt32($this->flags);        
        
        return Sockets::out($this->client, $this);
    }

    public function setFlags($flags) {
        $this->flags = $flags;
        return true;
    }
}