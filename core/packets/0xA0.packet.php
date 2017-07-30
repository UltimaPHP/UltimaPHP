<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */

class packet_0xA0 extends Packets {

    /**
     * Defines the packet, the length and if there is a client send
     */
    public function __construct($client = false) {
        $this->setPacket(0xA0);

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

        $server = dechex($data[1] . $data[2]);

        UltimaPHP::$socketClients[$this->client]['connected_server'] = ((int) $server - 1);
        UltimaPHP::log("Account " . UltimaPHP::$socketClients[$this->client]['account']->account . " connecting on server " . UltimaPHP::$servers[UltimaPHP::$socketClients[$this->client]['connected_server']]['name']);
        UltimaPHP::$socketClients[$this->client]['account']->sendConnectionConfirmation();
        return true;
    }
}