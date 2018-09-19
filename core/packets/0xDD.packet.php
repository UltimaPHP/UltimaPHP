<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 *
 * Send the server list to the client
 */
class packet_0xDD extends Packets {

    /**
     * Defines the packet, the length and if there is a client send
     */
    private $gump;

    public function __construct($client = false, $gump = null) {
        if ($gump === null || !is_object($gump)) {
            return false;
        }

        if (!isset(class_parents($gump)['Gumps'])) {
            return false;
        }

        $this->setPacket(0xDD);
        $this->setLength(false);

        $this->client = $client;
        $this->gump   = $gump;
        return $this;
    }

    /**
     * Handle the packet sending
     */
    public function send() {
        if (!$this->client) {
            return false;
        }

        $layoutCompressed = Functions::strToHex(zlib_encode($this->gump->getLayout() . chr(00), ZLIB_ENCODING_DEFLATE));
        $textCompressed = Functions::strToHex(zlib_encode(Functions::hexToChr($this->gump->getTextParsed()), ZLIB_ENCODING_DEFLATE));

        $this->addInt32(UltimaPHP::$socketClients[$this->client]['account']->player->serial);
        $this->addInt32($this->gump->getGumpId());
        $this->addInt32($this->gump->getX());
        $this->addInt32($this->gump->getY());
        $this->addInt32((strlen($layoutCompressed) / 2) + 4);
        $this->addInt32(strlen($this->gump->getLayout()) + 1);
        $this->addHexStr($layoutCompressed);
        $this->addInt32(count($this->gump->getText()));
        $this->addInt32((strlen($textCompressed) / 2) + 4);
        $this->addInt32(strlen($this->gump->getTextParsed()) / 2);
        $this->addHexStr($textCompressed);

        Sockets::out($this->client, $this);
        return true;
    }
}