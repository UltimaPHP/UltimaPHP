<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */

class packet_0xB1 extends Packets {

    /**
     * Defines the packet, the length and if there is a client send
     */
    public function __construct($client = false) {
        $this->setPacket(0xB1);

        if ($client) {
            $this->client = $client;
        }
    }

    public function receive($data) {
        if (!$this->client) {
            return false;
        }

        $offset = 0;

        $switchesID = array();
        $textEntries = array();

        $command  = $data[0];
        $packetSize = hexdec(Functions::implodeByte($data, 1, $offset+=2));
        $serial = hexdec(Functions::implodeByte($data, $offset+1, $offset+=4));   
        $gumpID = hexdec(Functions::implodeByte($data, $offset+1, $offset+=4));
        $buttonID = hexdec(Functions::implodeByte($data, $offset+1, $offset+=4));

        if($gumpID == hexdec("0x1CD"))
        {
            $switchesCount = hexdec(Functions::implodeByte($data, $offset+1, $offset+=4));
        }
        else{
            $switchesCount = hexdec(Functions::implodeByte($data, $offset+1, $offset+=4));
        }

        for($i=0;$i<$switchesCount;$i++)
        {
            $switchesID[] = hexdec(Functions::implodeByte($data, $offset+1, $offset+=4));
        }

        if($gumpID == hexdec("0x1CD") && $buttonID == hexdec("0x01") && $switchesCount > hexdec("0x00"))
        {
            $textEntrieCount = hexdec(Functions::implodeByte($data, $offset+1, $offset+=4));
        }else{
            $textEntrieCount = hexdec(Functions::implodeByte($data, $offset+1, $offset+=4));
        }

        for($i=0;$i<$textEntrieCount;$i++)
        {
            $textEntrieID = hexdec(Functions::implodeByte($data, $offset+1, $offset+=2));
            $height = hexdec(Functions::implodeByte($data, $offset+1, $offset+=2));
            $textEntry = Functions::readUnicodeStringSafe(str_split(Functions::implodeByte($data, $offset+1, $offset+=$height), 2));
            $textEntries[] = array(
                "id" => $textEntrieID,
                "height" => $height,
                "textEntry" => $textEntry
            );
        }




        $dialogQueVeioNoPacote = Map::$gumpsIds[$gumpID];
        
        $dialogQueVeioNoPacote::callback($this->client, $buttonID);

        return true;
    }
}