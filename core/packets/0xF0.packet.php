<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */

class packet_0xF0 extends Packets {

    /**
     * Defines the packet, the length and if there is a client send
     */
    public function __construct($client = false) {
        $this->setPacket(0xF0);

        if ($client) {
            $this->client = $client;
        }
    }

    /**
     * New Packet received when the player try to walk/move
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

        $command  = Functions::implodeByte($data, 0, 0, true);
        $length   = hexdec(Functions::implodeByte($data, 1, 2, true));
        $unknow1  = hexdec(Functions::implodeByte($data, 3, 3, true));
        $unknow2  = hexdec(Functions::implodeByte($data, 4, 7, true));
        $unknow3  = hexdec(Functions::implodeByte($data, 8, 11, true));
        $unknow4  = hexdec(Functions::implodeByte($data, 12, 15, true));
        $unknow5  = hexdec(Functions::implodeByte($data, 16, 19, true));
        $count    = hexdec(Functions::implodeByte($data, 20, 20, true));
        $dir      = hexdec(Functions::implodeByte($data, 21, 21, true));
        $running  = (hexdec(Functions::implodeByte($data, 22, 25, true)) == 2 ? true : false);
        $position = [
            'x' => hexdec(Functions::implodeByte($data, 26, 29, true)),
            'y' => hexdec(Functions::implodeByte($data, 30, 33, true)),
            'z' => hexdec(Functions::implodeByte($data, 34, 37, true)),
        ];

        UltimaPHP::$socketClients[$this->client]['account']->player->newMovePlayer(false, $position, $dir, $running, $count);
        return true;
    }
}