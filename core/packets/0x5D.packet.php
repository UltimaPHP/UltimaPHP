<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */

class packet_0x5D extends Packets {

    /**
     * Defines the packet, the length and if there is a client send
     */
    public function __construct($client = false) {
        $this->setPacket(0x5D);

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

        $command      = $data[0];
        $charname     = Functions::hexToChr($data, 5, 34, true);
        $clientflag   = Functions::hexToChr($data, 37, 40, true);
        $loginaccount = Functions::hexToChr($data, 45, 48, true);
        $slotchoosen  = hexdec($data[65] . $data[66] . $data[67] . $data[68]);
        $clientIP     = hexdec($data[69]) . "." . hexdec($data[70]) . "." . hexdec($data[71]) . "." . hexdec($data[72]);
        UltimaPHP::$socketClients[$this->client]['account']->loginCharacter($slotchoosen);

        return true;
    }
}