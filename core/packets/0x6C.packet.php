<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */

class packet_0x6C extends Packets {

    private $type;
    private $senderSerial;
    private $flags;
    private $objectSerial;
    private $X;
    private $Y;
    private $Z;
    private $graphic;

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

        UltimaPHP::$socketClients[$this->client]['account']->player->targetAction($this->client, $targetData);
        
    }

    /**s
     * Handle the packet transmission
     */
    public function send() {
        if (!$this->client) {
            return false;
        }

        $this->addInt8($this->type);
        $this->addInt32($this->senderSerial);
        $this->addInt8($this->flags);
        $this->addInt32($this->objectSerial);
        $this->addInt16($this->X);
        $this->addInt16($this->Y);
        $this->addInt16($this->Z);
        $this->addInt16($this->graphic);
                    
        return Sockets::out($this->client, $this);
    }

    public function setType($type){
        $this->type = $type;
        return true;
    }

    public function setSenderSerial($senderSerial){
        $this->senderSerial = $senderSerial;
        return true;
    }

    public function setFlags($flags){
        $this->flags = $flags;
        return true;
    }

    public function setObjectSerial($objectSerial){
        $this->objectSerial = $objectSerial;
        return true;
    }

    public function setX($X){
        $this->X = $X;
        return true;
    }

    public function setY($Y){
        $this->Y = $Y;
        return true;
    }

    public function setZ($Z){
        $this->Z = $Z;
        return true;
    }

    public function setGraphic($graphic){
        $this->graphic = $graphic;
        return true;
    }
}