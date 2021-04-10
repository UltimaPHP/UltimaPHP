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

        $command  = Functions::implodeByte(0, 0, $data);
        $length   = hexdec(Functions::implodeByte(1, 2, $data));
        $unknow1  = hexdec(Functions::implodeByte(3, 3, $data));
        $unknow2  = hexdec(Functions::implodeByte(4, 7, $data));
        $unknow3  = hexdec(Functions::implodeByte(8, 11, $data));
        $unknow4  = hexdec(Functions::implodeByte(12, 15, $data));
        $unknow5  = hexdec(Functions::implodeByte(16, 19, $data));
        $count    = hexdec(Functions::implodeByte(20, 20, $data));
        $dir      = hexdec(Functions::implodeByte(21, 21, $data));
        $running  = (hexdec(Functions::implodeByte(22, 25, $data)) == 2 ? true : false);
        $position = [
            'x' => hexdec(Functions::implodeByte(26, 29, $data)),
            'y' => hexdec(Functions::implodeByte(30, 33, $data)),
            'z' => hexdec(Functions::implodeByte(34, 37, $data)),
        ];

        UltimaPHP::$socketClients[$this->client]['account']->player->newMovePlayer(false, $position, $dir, $running, $count);
        return true;
    }
}