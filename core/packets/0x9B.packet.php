<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */

class packet_0x9B extends Packets {

    /**
     * Defines the packet, the length and if there is a client send
     */
    public function __construct($client = false) {
        $this->setPacket(0x9B);

        if ($client) {
            $this->client = $client;
        }
    }

    public function receive($data) {
        if (!$this->client) {
            return false;
        }

        $teste = new HelpMenuGump($this->client);
        $teste->show();

        return true;
    }
}