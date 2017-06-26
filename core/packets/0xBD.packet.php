<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */

class packet_0xBD extends Packets {

    /**
     * Defines the packet, the length and if there is a client send
     */
    public function __construct($client = false) {
        $this->setPacket(0xBD);

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

        $comand  = $data[0];
        $length  = hexdec($data[1] . $data[2]);
        $version = explode(".", Functions::hexToChr(implode("", array_slice($data, 3))));

        // Fix for versions with glued last char, IE: 4.0.11c
        if (strlen($version[2]) > 2) {
            $version[3] = substr($version[2], 2) . (isset($version[3]) ? $version[3] : "");
            $version[2] = substr($version[2], 0, 2);
        }

        UltimaPHP::$socketClients[$this->client]['version'] = [
            'major'     => $version[0],
            'minor'     => $version[1],
            'revision'  => $version[2],
            'prototype' => $version[3],
        ];

        return true;
    }
}