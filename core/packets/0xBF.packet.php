<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */

class packet_0xBF extends Packets {

    /**
     * Defines the packet, the length and if there is a client send
     */
    public function __construct($client = false) {
        $this->setPacket(0xBF);

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

        $comand    = $data[0];
        $length    = hexdec($data[1] . $data[2]);
        $subcomand = hexdec($data[3] . $data[4]);
        switch ($subcomand) {
            case 5:
                // Screen Size
                $unknow1 = Functions::hexToChr($data, 5, 6, true);
                $x       = Functions::hexToChr($data, 7, 8, true);
                $y       = Functions::hexToChr($data, 9, 10, true);
                $unknow2 = Functions::hexToChr($data, 11, 12, true);
                break;
            case 11:
                // Client language
                $language                                      = Functions::hexToChr($data, 5, 8);
                UltimaPHP::$socketClients[$this->client]['language'] = $language;
                break;
            case 15:
                // ClientType
                $unk1                                      = hexdec($data[5]);
                $ClientType                                = Functions::hexToChr($data, 6, 9);
                UltimaPHP::$socketClients[$this->client]['type'] = $ClientType;
                break;
        }

        return true;
    }
}