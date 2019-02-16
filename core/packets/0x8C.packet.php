<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */

class packet_0x8C extends Packets {

    private $ip;
    private $port;
    private $authid;

    /**
     * Defines the packet, the length and if there is a client send
     */
    public function __construct($client = false) {
        $this->setPacket(0x8C);

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

        $this->addInt8((int)$this->ip[0]);
        $this->addInt8((int)$this->ip[1]);
        $this->addInt8((int)$this->ip[2]);
        $this->addInt8((int)$this->ip[3]);
        $this->addInt16((int)$this->port);
        $this->addInt8($this->authid['major']);
        $this->addInt8($this->authid['minor']);
        $this->addInt8($this->authid['revision']);
        $this->addInt8($this->authid['prototype']);
        
        Sockets::out($this->client, $this);

        return true;

    } 

    public function setIp($ip) {
        $this->ip = $ip;
        return true;
    }

    public function setPort($port) {
        $this->port = (int)$port;
        return true;
    }

    public function setAuthID($authid) {
        $this->authid = $authid;
        return true;
    }
}