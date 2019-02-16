<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 *
 * Send the server list to the client
 */
class packet_0xE2 extends Packets {

    private $mobileSerial;
    private $animationType;
    private $action;
    private $delay;
    
    /**
     * Defines the packet, the length and if there is a client send
     */
    public function __construct($client = false) {
        $this->setPacket(0xE2);
        $this->setLength(10);

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

        $this->addInt32($this->mobileSerial);
        $this->addInt16($this->animationType);
        $this->addInt16($this->action);
        $this->addInt8($this->delay);
        
        return Sockets::out($this->client, $this);
    }

    public function setMobileSerial($mobileSerial){
        $this->mobileSerial = $mobileSerial;
        return true;
    }

    public function setAnimationType($animationType){
        $this->animationType = $animationType;
        return true;
    }

    public function setAction($action){
        $this->action = $action;
        return true;
    }

    public function setDelay($delay){
        $this->delay = $delay;
        return true;
    }

}