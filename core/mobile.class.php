<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class Mobile {
    /* Server variables */

    public $mobile;

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
    public $mapRange = array(
        'objects' => array(),
        'players' => array(),
        'npcs'    => array(),
    );

    function __construct($serial = null) {
        $this->summon();
        if ($serial === null) {
            $this->serial = dechex(UltimaPHP::BITMASK_ITEM | dechex(rand(111111, 900000)));
        }
    }

    /**
     * Object create/destroy methods
     */
    public function create() {
        
    }

    public function destroy() {
        
    }
}
?>    