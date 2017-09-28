<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 *
 * Send the server list to the client
 */
class packet_0xDD extends Packets {
    
    private $textCompress, $layoutCompress, $compression;
    private $x, $y, $layout, $text, $sizePacket;
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
        
        $this->layoutCompress = Functions::strToHex(zlib_encode($this->layout, ZLIB_ENCODING_DEFLATE));
        $this->textCompress = Functions::strToHex(zlib_encode($this->text, ZLIB_ENCODING_DEFLATE));       
        $this->compression = new Compression();                       
        
        $this->sizePacket = (42 + strlen($this->layoutCompress) + strlen($this->textCompress))/2;                
    }

    /**s
     * Handle the packet receive
     */
    public function send() {
        if (!$this->client) {
            return false;
        }
        echo $this->sizePacket. "\n\n";
        $this->addInt16($this->sizePacket);// Size packet   
        $this->addInt32(2);
        $this->addInt32(2);
        $this->addInt32($this->x);
        $this->addInt32($this->y);      
        $this->addInt32((strlen($this->layoutCompress)/2)-4);//Entries Length - 4
        $this->addInt32(strlen($this->layout)/2);//Layout Length
        $this->addHexStr($this->layoutCompress);
        $this->addInt32(0);//Lines Count
        $this->addInt32((strlen($this->textCompress)/2)-4);//String Length - 4
        $this->addInt32(strlen($this->text)/2); //Text Length Decoded
        $this->addHexStr($this->textCompress);
        
        echo $this->getPacketStr(); 
        echo "\n\n". $this->layoutCompress . "\n\n";
        
        Sockets::out($this->client, $this);        
        return true;
    }
}