<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */

class packet_0x73 extends Packets {

    /**
     * Defines the packet, the length and if there is a client send
     */
    public function __construct($client = false) {
        $this->setPacket(0x73);

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

        if (isset(UltimaPHP::$socketClients[$this->client]['account'])) {
            UltimaPHP::$socketClients[$this->client]['account']->sendPingResponse();
        } else {
            socket_close(UltimaPHP::$socketClients[$this->client]['socket']);
            unset(UltimaPHP::$socketClients[$this->client]);
        }
    }
}