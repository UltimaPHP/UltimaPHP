<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 *
 * Send the server list to the client
 */
class packet_0xA8 extends Packets {
    /**
     * Defines the packet, the length and if there is a client send
     */
    public function __construct($client = false) {
        $this->setPacket(0xA8);

        if ($client) {
            $this->client = $client;
        }
    }

    /**s
     * Handle the packet receive
     */
    public function send() {
        if (!$this->client) {
            return false;
        }

        $this->addInt8(0xFF);
        $this->addInt16(count(UltimaPHP::$servers));

        foreach (UltimaPHP::$servers as $key => $server) {
            $ip = explode(".", $server['ip']);

            $this->addInt16(($key + 1));
            $this->addText($server['name'], 64);
            $this->addInt8($server['full']);
            $this->addInt8($server['timezone']);
            $this->addInt8($ip[3]);
            $this->addInt8($ip[2]);
            $this->addInt8($ip[1]);
            $this->addInt8($ip[0]);
        }

        Sockets::out($this->client, $this);
        return true;
    }
}