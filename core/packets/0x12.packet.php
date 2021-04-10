<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */

class packet_0x12 extends Packets {

    /**
     * Defines the packet, the length and if there is a client send
     */
    public function __construct($client = false) {
        $this->setPacket(0x12);

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

        $command = $data[0];
        $size    = hexdec(Functions::implodeByte(1, 2, $data));
        $type    = $data[3];
        $args    = Functions::hexToChr($data, 4, ($size - 1));
        $unknown = 0x00;

        switch ($type) {
            case 0x00: // Go
                break;
            case 0xC7: // Animate
                break;
            case 0x24: // Use skill
                break;
            case 0x43: // Open spellbook
                break;
            case 0x27: // Cast spell from book
                break;
            case 0x58: // Open door
                break;
            case 0x56: // Cast spell from macro
                break;
            case 0xF4: // Invoke virtues from macro
                break;
            case 0x2F: // Old scroll double click
                /*
                 * This command is still sent for items 0xEF3 - 0xEF9
                 *
                 * Command is one of three, depending on the item ID of the scroll:
                 * - [scroll serial]
                 * - [scroll serial] [target serial]
                 * - [scroll serial] [x] [y] [z]
                 */
                break;
            default:
                echo "Unknown text-command type";
                break;
        }
    }
}