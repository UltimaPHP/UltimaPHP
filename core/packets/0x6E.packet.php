<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 *
 * Send the server list to the client
 */
class packet_0x6E extends Packets {

    private $serial;
    private $action;
    private $frameCount;
    private $repeatTimes;
    private $forward;
    private $repeat;
    private $delay;
    
    /**
     * Defines the packet, the length and if there is a client send
     */
    public function __construct($client = false) {
        $this->setPacket(0x6E);
        $this->setLength(14);

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

        $this->addInt32($this->serial);
        $this->addInt16($this->action);
        $this->addInt16($this->frameCount);
        $this->addInt16($this->repeatTimes);
        $this->addInt8($this->forward);
        $this->addInt8($this->repeat);
        $this->addInt8($this->delay);
        
        return Sockets::out($this->client, $this);
    }

    public function setSerial($serial){
        $this->serial = $serial;
        return true;
    }

    public function setAction($action){
        $this->action = $action;
        return true;
    }

    public function setFrameCount($frameCount){
        $this->frameCount = $frameCount;
        return true;
    }

    public function setRepeatTimes($repeatTimes){
        $this->repeatTimes = $repeatTimes;
        return true;
    }

    public function setForward($forward){
        $this->forward = $forward;
        return true;
    }

    public function setRepeat($repeat){
        $this->repeat = $repeat;
        return true;
    }

    public function setDelay($delay){
        $this->delay = $delay;
        return true;
    }

}