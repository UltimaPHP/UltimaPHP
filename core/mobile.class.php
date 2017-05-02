<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class Mobile {
    /* Server variables */
    public $instanceType = UltimaPHP::INSTANCE_MOBILE;

    /* Player variables */
    public $id;
    public $serial;
    public $name;
    public $body;
    public $color;
    public $sex;
    // Flags -- init
    public $frozen;
    public $female;
    public $flying;
    public $yellowHealthBar;
    public $ignoreMobiles;
    public $warmode;
    public $hidden;
    public $paralyzed;
    public $blessed;
    // Flags -- end
    public $race;
    public $position;
    public $hits;
    public $maxhits;
    public $mana;
    public $maxmana;
    public $stam;
    public $maxstam;
    public $str;
    public $maxstr;
    public $int;
    public $maxint;
    public $dex;
    public $maxdex;
    public $statscap;
    public $pets;
    public $maxpets;
    public $resist_physical;
    public $resist_fire;
    public $resist_cold;
    public $resist_poison;
    public $resist_energy;
    public $luck;
    public $render_range;
    public $damage_min;
    public $damage_max;
    public $karma;
    public $fame;
    public $title;
    public $skills = [];
    public $virtualarmor;

    /* Temporary Variables */
    public $mapRange = [];

    function __construct($serial = null) {
        if ($serial === null) {
            $this->id = Map::newSerial('mobile');
            $this->serial = $this->id;
        }
        $this->summon();
    }

    /**
     * Draw mobile for client
     */
    public function draw($client) {
        $packet = "78";
        $packet .= str_pad(dechex(23), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad($this->serial, 8, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($this->body), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($this->position['x']), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($this->position['y']), 4, "0", STR_PAD_LEFT);
        $packet .= Functions::toChar8($this->position['z']);
        $packet .= str_pad(dechex($this->position['facing']), 2, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($this->color), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex(0x40), 2, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex(0x06), 2, "0", STR_PAD_LEFT);
        $packet .= "00000000";

        Sockets::out($client, $packet);
    }

    public function statusBarInfo($client) {
        echo "Status bar from  mobile ".$this->name." (UID: ".$this->serial.")\n";
    }
}