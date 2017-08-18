<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 *
 * Send the server list to the client
 */
class packet_0xDD extends Packets {
    
    private $textCompress, $layoutCompress, $compression;
    private $x, $y, $layout, $text;
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
        
        $this->layoutCompress = bin2hex(zlib_encode($this->layout, ZLIB_ENCODING_DEFLATE));
        $this->textCompress = bin2hex(zlib_encode($this->text, ZLIB_ENCODING_DEFLATE));       
        $this->comp = new Compression();                      
    }

    /**s
     * Handle the packet receive
     */
    public function send() {
        if (!$this->client) {
            return false;
        }

        $this->addInt16(1011);// Size packet   
        $this->addInt32(12900166);
        $this->addInt32(1704);
        $this->addInt32($this->x);
        $this->addInt32($this->y);      
        $this->addInt32(strlen($this->layoutCompress)-4);//Entries Length + 4
        $this->addInt32(strlen($this->layout));//Layout Length
        $this->addText($this->layoutCompress);
        $this->addInt32(0);//Lines Count
        $this->addInt32(strlen($this->textCompress)-4);//String Length + 4
        $this->addText(strlen($this->text)); //String Decoded + 4
        $this->addText($this->textCompress);             
        
        Sockets::out($this->client, $this);        
        return true;
    }
}