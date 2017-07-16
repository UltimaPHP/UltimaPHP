<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 *
 * Send the server list to the client
 */
class packet_0x21 extends Packets {

    private $x = 0;
    private $y = 0;
    private $z = 0;
    private $d = 0;
    private $s = 0;

    /**
     * Defines the packet, the length and if there is a client send
     */
    public function __construct($client = false) {
        $this->setPacket(0x21);

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

        $this->addInt8($this->getSequence());
        $this->addInt16($this->getX());
        $this->addInt16($this->getY());
        $this->addInt8($this->getDirection());
        $this->addInt8($this->getZ());

        return Sockets::out($this->client, $this);
    }

    public function setPosition($x = 0, $y = 0, $z = 0, $direction = 0, $sequence = 0) {
        if ($x == 0 || $y == 0) {
            return false;
        }

        $this->setX($x);
        $this->setY($y);
        $this->setZ($z);
        $this->setDirection($direction);
        $this->setSequence($sequence);

        return true;
    }

    public function setX($x = 0) {
        if ($x == 0) {
            return false;
        }

        $this->x = (int) $x;
        return true;
    }

    public function getX() {
        return $this->x;
    }

    public function setY($y = 0) {
        if ($y == 0) {
            return false;
        }

        $this->y = (int) $y;
        return true;
    }

    public function getY() {
        return $this->y;
    }

    public function setZ($z = 0) {
        $this->z = (int) $z;
        return true;
    }

    public function getZ() {
        return $this->z;
    }

    public function setDirection($direction = 0) {
        $this->d = (int) $direction;
        return true;
    }

    public function getDirection() {
        return $this->d;
    }

    public function setSequence($sequence = 0) {
        $this->s = (int) $sequence;
        return true;
    }

    public function getSequence() {
        return $this->s;
    }
}