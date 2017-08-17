<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 *
 * Send the server list to the client
 */
class packet_0xDD extends Packets {
    
    private $textCompress, $layoutCompress, $compression;
    /**
     * Defines the packet, the length and if there is a client send
     */
    public function __construct($x, $y, $layout, $text, $client = false) {
        $this->setPacket(0xDD);

        if ($client) {
            $this->client = $client;
        }
        $this->x = $x;
        $this->y = $y;
        $this->layout = $layout;
        $this->text = $text;
        
        $this->layoutCompress = zlib_encode($layout, ZLIB_ENCODING_DEFLATE, $level = 1);
        $this->textCompress = zlib_encode($text, ZLIB_ENCODING_DEFLATE, $level = 1);       
        $this->compression = new Compression();                
    }

    /**s
     * Handle the packet receive
     */
    public function send() {
        if (!$this->client) {
            return false;
        }

        $this->addInt16(1011);// Size packet
        $this->addInt32($this->client);
        $this->addInt32(0);
        $this->addInt32($this->x);
        $this->addInt32($this->y);
        $this->addInt32(strlen($this->layout)+4);//Entries Length + 4
        $this->addInt32(strlen($this->layout));//Layout Length
        $this->addText(unpack('H*', $this->compression->compress(strtoupper($this->layoutCompress)))[1]);
        $this->addInt32(0);//Lines Count
        $this->addInt32(strlen($this->text)+4);//String Length + 4
        $this->addText($this->text);//String Length + 4
        $this->addText(unpack('H*', $this->compression->compress(strtoupper($this->textCompress)))[1]);       
        
        Sockets::out($this->client, $this);
        return true;
    }
}