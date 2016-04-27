<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
// UNUSED			0xFFFFFFFF	// 0 = not used as well.
// F_RESOURCE		0x80000000	// ALSO: pileable or special macro flag passed to client.
// F_ITEM			0x40000000	// CItem as apposed to CChar based
// O_DISCONNECT  	0x30000000	// Not attached yet.
// O_EQUIPPED		0x20000000	// This item is equipped.
// O_CONTAINED		0x10000000	// This item is inside another container
// O_INDEX_MASK	    0x0FFFFFFF	// lose the upper bits.
// O_INDEX_FREE	    0x01000000	// Spellbook needs unused UID's ?

class Object {

    /**
     * Item variables
     */
    public $cont;
    public $serial;
    public $id;
    public $graphic;
    public $type;
    public $name;

    /**
     * Item Position
     */
    public $location;
    public $pos_x;
    public $pos_y;
    public $pos_z;
    public $hits;
    public $maxHits;
    public $direction;
    public $color;
    public $flags;
    public $value;
    public $amount;
    public $layer;

    function __construct($serial = null) {
        $this->build();
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

    /**
     * Object Buy/Sell methods
     */
    public function buy() {
        
    }

    public function sell() {
        
    }

    /**
     * Object Equip/Unequip methods
     */
    public function equip() {
        
    }

    public function unequip() {
        
    }

    /**
     * Object damage methods
     */
    public function damage() {
        
    }

    public function spellEffect() {
        
    }

    /**
     * Step on item method
     */
    public function step() {
        
    }

    /**
     * Timer events method
     */
    public function timer() {
        
    }

    /**
     * Object Click and DClick methods
     */
    public function click() {
        
    }

    public function dclick() {
        
    }

    /**
     * Object dropping methods
     */
    public function dropOnChar() {
        
    }

    public function dropOnGround() {
        
    }

    public function dropOnItem() {
        
    }

    public function dropOnSeld() {
        
    }

    public function dropOnTrade() {
        
    }

    /**
     * Object pickingup methods
     */
    public function pickupGround() {
        
    }

    public function pickupPack() {
        
    }

    public function pickupSelf() {
        
    }

    public function pickupStack() {
        
    }

    /**
     * Object targeting methods
     */
    public function targOnCancel() {
        
    }

    public function targOnChar() {
        
    }

    public function targOnGround() {
        
    }

    public function targOnItem() {
        
    }

}
