<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */

class packet_0x02 extends Packets {

    /**
     * Defines the packet, the length and if there is a client send
     */
    public function __construct($client = false) {
        $this->setPacket(0x02);

        if ($client) {
            $this->client = $client;
        }
    }

    /**
     * Packet received when the player try to walk/move
     *
     * Directions:
     *     0x00 - North
     *     0x01 - Northeast
     *     0x02 - East
     *     0x03 - Southeast
     *     0x04 - South
     *     0x05 - Southwest
     *     0x06 - West
     *     0x07 - Northwest
     */
    public function receive($data) {
        if (!$this->client) {
            return false;
        }

        $command             = Functions::strToHex(Functions::hexToChr($data, 0, 0, true));
        $direction           = Functions::strToHex(Functions::hexToChr($data, 1, 1, true));
        $sequence_number     = Functions::strToHex(Functions::hexToChr($data, 2, 2, true));
        $fastwalk_prevention = Functions::strToHex(Functions::hexToChr($data, 3, 6, true));
        UltimaPHP::$socketClients[$this->client]['account']->player->movePlayer(false, $direction, $sequence_number, $fastwalk_prevention);

        return true;
    }
}