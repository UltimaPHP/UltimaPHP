<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class Object {

    /**
     * Item variables
     */
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
        if (method_exists($this, "typeStart")) {
            $this->typeStart();
        }
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
    }
}