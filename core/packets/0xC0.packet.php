<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 *
 * Send the server list to the client
 */
class packet_0xC0 extends Packets {


    private $type;
    private $charSerial;
    private $targetSerial;
    private $objectId;
    private $srcX;
    private $srcY;
    private $srcZ;
    private $dstX;
    private $dstY;
    private $dstZ;
    private $speed;
    private $duration;
    private $unk1 = 0x00;
    private $boolDirection;
    private $boolExplodes;
    private $hue;
    private $renderMode;


    /**
     * Defines the packet, the length and if there is a client send
     */
    public function __construct($client = false) {
        $this->setPacket(0xC0);
        $this->setLength(36);

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

        $this->addInt8($this->type);
        $this->addInt32($this->charSerial);
        $this->addInt32($this->targetSerial);
        $this->addInt16($this->objectId);
        $this->addInt16($this->srcX);
        $this->addInt16($this->srcY);
        $this->toChar8($this->srcZ);
        $this->addInt16($this->dstX);
        $this->addInt16($this->dstY);
        $this->toChar8($this->dstZ);
        $this->addInt8($this->speed);
        $this->addInt8($this->duration);
        $this->addInt16($this->unk1);
        $this->addInt8($this->boolDirection);
        $this->addInt8($this->boolExplodes);
        $this->addInt32($this->hue);
        $this->addInt32($this->renderMode);        
        
        return Sockets::out($this->client, $this);
    }

    public function setType($type){
        $this->type = $type;
        return true;
    }

    public function setSerialSource($serialSrc){
        $this->charSerial = $serialSrc;
        return true;
    }

    public function setSerialTarget($targetSerial){
        $this->targetSerial = $targetSerial;
        return true;
    }

    public function setObjectId($objectId){
        $this->objectId = $objectId;
        return true;
    }

    public function setSrcPosition($account) {
        $this->srcX = (int)$account['x'];
        $this->srcY = (int)$account['y'];
        $this->srcZ = (int)$account['z'];

        return true;
    }

    public function setDstPosition($dstTarget) {
        $this->dstX = (int)$dstTarget['x'];
        $this->dstY = (int)$dstTarget['y'];
        $this->dstZ = (int)$dstTarget['z'];
        
        return true;
    }

    public function setSpeed($speed){
        $this->speed = (int)$speed;
        return true;
    }

    public function setDuration($duration)
    {
        $this->duration = (int)$duration;
        return true;
    }

    public function setUnknown1($unk1){
        $this->unk1 = $unk1;
        return true;
    }

    public function setFixedDirection($boolDirection)
    {
        $this->boolDirection = (int)$boolDirection;
        return true;
    }

    public function setExplodes($boolExplodes)
    {
        $this->boolExplodes = (int)$boolExplodes;
        return true;
    }

    public function setHue($hue){
        $this->hue = (int)$hue;
        return true;
    }

    public function setRenderMode($renderMode){
        $this->renderMode = (int)$renderMode;
        return true;
    }

}