<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 *
 * Send the server list to the client
 */
class packet_0xA9 extends Packets {

    private $sizePacket;
    private $charCount;
    private $chars;
    private $citiesCount;
    private $cities;
    private $flags;
    private $lastCharLost;
    /**
     * Defines the packet, the length and if there is a client send
     */
    public function __construct($client = false) {
        $this->setPacket(0xA9);

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

        $this->addInt8($this->charCount);

        for ($i = 0; $i < $this->charCount; $i++) {
            if ($i < count($this->chars)) {
                $this->addText($this->chars[$i]['name'], 30);
                $this->addText("", 30);
            } else {
                $this->addText("", 60);
            }
        }

        $this->addInt8($this->citiesCount);

        foreach ($this->cities as $key => $location) {
            $this->addInt8($key);
            $this->addText($location['name'], 32);
            $this->addText($location['area'], 32);
            $this->addInt32($location['position']['x']);
            $this->addInt32($location['position']['y']);
            $this->addInt32($location['position']['z']);
            $this->addInt32($location['position']['map']);
            $this->addInt32($location['cliloc']);
            $this->addInt32(0);
        }

        $this->addInt32(dechex($this->flags));
        $this->addInt16($this->lastCharLost);

        Sockets::out($this->client, $this);
        return true;
    }

    public function setSizePacket($sizePacket) {
        $this->sizePacket = $sizePacket;
        return true;
    }

    public function setCharCount($charCount) {
        $this->charCount = (int) $charCount;
        return true;
    }

    public function setChars($chars) {
        $this->chars = $chars;
        return true;
    }

    public function setCitiesCount($citiesCount) {
        $this->citiesCount = (int) $citiesCount;
        return true;
    }

    public function setCities($cities) {
        $this->cities = $cities;
        return true;
    }

    public function setFlags($flags) {
        $this->flags = $flags;
        return true;
    }

    public function setLastCharLost($lastCharLost) {
        $this->lastCharLost = (int) $lastCharLost;
        return true;
    }
}