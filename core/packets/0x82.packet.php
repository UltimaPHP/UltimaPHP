<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */

class packet_0x82 extends Packets {

    private $reason;

    /**
     * Defines the packet, the length and if there is a client send
     */
    public function __construct($client = false) {
        $this->setPacket(0x82);

        if ($client) {
            $this->client = $client;
        }
    }
    
    /**s
     * Handle the packet receive
     */
    public function send() {
        if (!$this->client) {
            return false;
        }

        $this->addInt8($this->reason);
        
        Sockets::out($this->client, $this);

        return true;

    } 

    public function setReason($reason = 4) {
        $this->reason = $reason;
        return true;
    }

}