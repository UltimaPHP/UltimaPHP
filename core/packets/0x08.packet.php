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
        $item_serial      = Functions::implodeByte($data, 1, 4);
        $x                = hexdec(Functions::implodeByte($data, 5, 6));
        $y                = hexdec(Functions::implodeByte($data, 7, 8));
        $z                = hexdec(Functions::fromChar8($data[9]));
        $grid_location    = $data[10];
        $conatiner_serial = Functions::implodeByte($data, 11, 14);
        return UltimaPHP::$socketClients[$this->client]['account']->player->dropItem($item_serial, ['x' => $x, 'y' => $y, 'z' => $z], $grid_location, $conatiner_serial);
    }
}