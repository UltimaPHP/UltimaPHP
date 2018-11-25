<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 *
 * Send the server list to the client
 */
class packet_0xF7 extends Packets {


    private $size;
    private $innerPacketsCount;
    private $innerPacketStructure;   

    /**
     * Defines the packet, the length and if there is a client send
     */
    public function __construct($client = false) {
        $this->setPacket(0xF7);

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

        $this->addInt16($innerPacketsCount);
        $this->organizeInnerPacket();
        $this->setLength($this->getLength());

        return Sockets::out($this->client, $this);
    }

    public function setInnerPacket($innerPacketsCount){
        $this->innerPacketsCount = $innerPacketsCount;
        return true;
    }

    public function setInnerPacketStructure($innerPacketStructure){
        $this->innerPacketStructure = $innerPacketStructure;
        return true;
    }

    public function organizeInnerPacket()
    {
        $innerStructureArray = str_split(str_pad($this->innerPacketStructure, ($this->innerPacketsCount*2),"0", STR_PAD_LEFT),2);

        for($i=0;$i<$this->innerPacketsCount;$i++)
        {
            $this->addInt8($innerStructureArray[$i]);
        }
    }

}