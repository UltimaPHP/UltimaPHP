<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */

class packet_0xD6 extends Packets {

    /**
     * Defines the packet, the length and if there is a client send
     */
    public function __construct($client = false) {
        $this->setPacket(0xD6);

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
            'id'           => $data[0],
            'size'         => hexdec($data[1]),
            'senderSerial' => hexdec($data[2] . $data[3] . $data[4] . $data[5]),
            'flags'        => hexdec($data[6]),
            'objectSerial' => hexdec($data[7] . $data[8] . $data[9] . $data[10]),
            'x'            => hexdec($data[11] . $data[12]),
            'y'            => hexdec($data[13] . $data[14]),
            'z'            => hexdec($data[15] . $data[16]),
            'graphic'      => hexdec($data[17] . $data[18]),
        ];
        UltimaPHP::$socketClients[$this->client]['account']->player->targetAction($this->client, $targetData);
    }
}