<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */

class packet_0x98 extends Packets {

    /**
     * Defines the packet, the length and if there is a client send
     */
    public function __construct($client = false) {
        $this->setPacket(0x98);

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

        $command = $data[0];
        $size    = hexdec(Functions::implodeByte($data, 1, 2));
        $serial  = Functions::implodeByte($data, 3, 6);

        if (Functions::isChar($serial) || Functions::isMobile($serial)) {
            UltimaPHP::$socketClients[$this->client]['account']->player->sendCharName($serial);
        }
    }
}