<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 *
 * Send the server list to the client
 */
class packet_0x54 extends Packets {


    private $flags = 1;
    private $soundID;
    private $volume = 0;    
    private $targetX;
    private $targetY;
    private $targetZ;
    
    /**
     * Defines the packet, the length and if there is a client send
     */
    public function __construct($client = false) {
        $this->setPacket(0x54);
        $this->setLength(12);

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

        $this->addInt8($this->flags);
        $this->addInt16($this->soundID);
        $this->addInt16($this->volume);
        $this->addInt16($this->targetX);
        $this->addInt16($this->targetY);
        $this->addUInt16($this->targetZ);
        
        return Sockets::out($this->client, $this);
    }

    public function setFlags($flags){
        $this->flags = $flags;
        return true;
    }

    public function setSoundID($soundID){
        $this->soundID = $soundID;
        return true;
    }

    public function setVolume($volume){
        $this->volume = $volume;
        return true;
    }

    public function setTargetPosition($target) {
        $this->targetX = (int)$target['x'];
        $this->targetY = (int)$target['y'];
        $this->targetZ = (int)$target['z'];
        
        return true;
    }

}