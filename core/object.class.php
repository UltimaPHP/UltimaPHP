<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class Object {
    /* Server variables */
    public $instanceType = UltimaPHP::INSTANCE_OBJECT;

    /* Object variables */
    public $serial;
    public $id;
    public $graphic;
    public $type;
    public $name;
    public $position;
    public $hits;
    public $maxHits;
    public $direction;
    public $flags;
    public $color  = 0;
    public $value  = 0;
    public $amount = 1;

    /* Equipable info */
    public $twohands = false;
    public $equiped  = false;
    public $layer    = LayersDefs::INVALID;

    public function __construct($serial = null) {
        $this->build();
        $this->typeStart();
        if ($serial === null) {
            $this->id     = Map::newSerial("object");
            $this->serial = dechex(UltimaPHP::BITMASK_ITEM | $this->id);
        }
    }

    public function draw($client) {
        $packet = "F3";
        $packet .= "0001";
        $packet .= "00";
        $packet .= str_pad($this->serial, 8, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($this->graphic), 4, "0", STR_PAD_LEFT);
        $packet .= "00";
        $packet .= str_pad(dechex($this->amount), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($this->amount), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($this->position['x']), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($this->position['y']), 4, "0", STR_PAD_LEFT);
        $packet .= Functions::toChar8($this->position['z']);
        $packet .= str_pad(dechex(($this->equiped ? $this->layer : LayersDefs::INVALID)), 2, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($this->color), 4, "0", STR_PAD_LEFT);
        $packet .= "20";
        $packet .= "0000";

        Sockets::out($client, $packet);

        return true;
    }

    /**
     * Display a message above the object
     * It client not sent, send to all players around the object
     */
    public function message($text = null, $color = 0, $font = 3, $client = false) {
        if ($text === null || strlen($text) == 0) {
            return false;
        }

        $tmpPacket = Functions::strToHex($text);
        $packet    = "1C";
        $packet .= str_pad(dechex(ceil(strlen($tmpPacket) / 2) + 45), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad($this->serial, 8, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($this->graphic), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex(0), 2, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($color), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($font), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad(Functions::strToHex($this->name), 60, "0", STR_PAD_RIGHT);
        $packet .= $tmpPacket;
        $packet .= "00";

        if ($client) {
            Sockets::out($client, $packet, false);
        } else {
            Map::sendPacketRangePosition($packet, $this->position);
        }

        return true;
    }

    /**
     * Display a "say" message above the object
     * It client not sent, send to all players around the object
     */
    public function say($text = null, $color = 0, $font = 3, $client = false) {
        if ($text === null || mb_strlen($text) == 0) {
            return false;
        }

        $tmpPacket = Functions::mbStrToHex($text, true);

        $packet    = "AE";
        $packet .= str_pad(dechex(ceil(strlen($tmpPacket) / 2) + 50), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad($this->serial, 8, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($this->graphic), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex(0), 2, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($color), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($font), 4, "0", STR_PAD_LEFT);
        $packet .= Functions::strToHex("ENU ");
        $packet .= str_pad(Functions::strToHex($this->name), 60, "0", STR_PAD_RIGHT);
        $packet .= $tmpPacket;
        $packet .= "0000";

        if ($client) {
            Sockets::out($client, $packet, false);
        } else {
            Map::sendPacketRangePosition($packet, $this->position);
        }

        return true;
    }
 
    public function click($client = null) {
        if ($client === null) {
            return false;
        }

        return $this->message($this->name, 0, 3, $client);
    }

    public function dclick($client = null) {
        if ($client === null) {
            return false;
        }

        return $this->say("I'm a " . $this->name . " and i accep unicode text, like: ãéíôú", 0x07a1);
    }
}