<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */

class packet_0xAD extends Packets {

    /**
     * Defines the packet, the length and if there is a client send
     */
    public function __construct($client = false) {
        $this->setPacket(0xAD);

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

        $command  = $data[0];
        $length   = hexdec($data[1] . $data[2]);
        $type     = $data[3];
        $color    = $data[4] . $data[5];
        $font     = hexdec($data[6] . $data[7]);
        $language = Functions::hexToChr($data, 8, 11);
        
        // $types = array(
        //     0x00 => 'Normal ',
        //     0x01 => 'Broadcast/System',
        //     0x02 => 'Emote ',
        //     0x06 => 'System/Lower Corner',
        //     0x07 => 'Message/Corner With Name',
        //     0x08 => 'Whisper',
        //     0x09 => 'Yell',
        //     0x0A => 'Spell',
        //     0x0D => 'Guild Chat',
        //     0x0E => 'Alliance Chat',
        //     0x0F => 'Command Prompts'
        // );

        // Cheks if the type have the 0xc0 mask
        $type_masked = false;
        if (substr($type, 0, 1) == "C") {
            $type = hexdec($type);
            $type &= ~0xC0;
            $type_masked = true;
        }
        
        $actual_byte = 12;
        $text = "";
        if ($type_masked) {
            $value = hexdec($data[$actual_byte] . $data[($actual_byte + 1)]);
            $actual_byte += 2;
            $count = ($value & 0xFFF0) >> 4;
            $hold  = $value & 0xF;
            if ($count < 0 || $count > 50) {
                return;
            }
            $keywordList = array();
            for ($i = 0; $i < $count; $i++) {
                $speechID;
                if (($i & 1) == 0) {
                    $hold <<= 8;
                    $hold |= hexdec($data[$actual_byte]);
                    $actual_byte++;
                    $speechID = $hold;
                    $hold     = 0;
                } else {
                    $value = hexdec($data[$actual_byte] . $data[($actual_byte + 1)]);
                    $actual_byte += 2;
                    $speechID = ($value & 0xFFF0) >> 4;
                    $hold     = $value & 0xF;
                }
                if (!in_array($speechID, $keywordList)) {
                    $keywordList[] = $speechID;
                }
            }
            $text = Functions::readUnicodeStringSafe(array_slice($data, $actual_byte, -1));
        } else {
            $text = Functions::readUnicodeStringSafe(array_slice($data, $actual_byte, -1));
        }
        
        return UltimaPHP::$socketClients[$this->client]['account']->player->speech($type, $color, $font, $language, $text);
    }
}