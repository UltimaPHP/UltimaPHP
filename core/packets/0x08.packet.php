<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */

class packet_0x08 extends Packets {

    /**
     * Defines the packet, the length and if there is a client send
     */
    public function __construct($client = false) {
        $this->setPacket(0x08);

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

        $command          = $data[0];
        $item_serial      = Functions::implodeByte(1, 4, $data);
        $x                = hexdec(Functions::implodeByte(5, 6, $data));
        $y                = hexdec(Functions::implodeByte(7, 8, $data));
        $z                = hexdec(Functions::fromChar8($data[9]));
        $grid_location    = $data[10];
        $conatiner_serial = Functions::implodeByte(11, 14, $data);
        return UltimaPHP::$socketClients[$this->client]['account']->player->dropItem($item_serial, ['x' => $x, 'y' => $y, 'z' => $z], $conatiner_serial, $grid_location);
    }
}