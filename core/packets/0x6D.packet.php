<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 *
 * Send the server list to the client
 */
class packet_0x6D extends Packets {

    private $musicID;
    
    /**
     * Defines the packet, the length and if there is a client send
     */
    public function __construct($client = false) {
        $this->setPacket(0x6D);
        $this->setLength(3);

        if ($client) {
            $this->client = $client;            
        }
    }

    /**s
     * Handle the packet transmission
     */
    public function send() {
        if (!$this->client) {
            return false;
        }

        $this->addInt16($this->musicID);
        
        return Sockets::out($this->client, $this);
    }

    public function setMusicID($musicID){
        $this->musicID = $musicID;
        return true;
    }

}